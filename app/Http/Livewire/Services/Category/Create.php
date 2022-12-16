<?php

namespace App\Http\Livewire\Services\Category;

use App\Models\Services\serviceCategory;
use App\Models\Services\serviceCategoryKeyword;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Illuminate\Support\Collection as SupportCollection;

class Create extends Component
{
    use AuthorizesRequests;  
   

    public $name = '';
    public $status = '';
    public $option = '';
    public $optionValueId = '';
    public $productAddonOptionId = '';
    public SupportCollection $keywords;


    protected $rules = [
        'name' => 'required|max:255|unique:service_categories,name',
        'status' => 'nullable|between:0,1',
        'keywords.*.name' => 'required',
       
    ];
    protected $messages = [
        'keywords.*.name.required' => 'This Name is required.',
       
    ];
    
    public function addInput()
    {    
    $this->keywords->push(['service_category_id'=>'','name' => '']);
    }

    public function updated($propertyName){

        $this->validateOnly($propertyName);
    } 

    public function removeInput($key)
    {
    $this->keywords->pull($key);
    
    }

public function mount()
    {
    $this->fill([
        'keywords' => collect([['service_category_id'=>'', 'name' => '']]),
    ]);
    }

    public function store(){
        $this->validate();
        $serviceCategory = serviceCategory::create([
            'name'         => $this->name,
            'status'        => $this->status ? 1:0,
            
        ]);
       
        foreach($this->keywords as $key => $value){
            $servicekeyword[] = ['service_category_id'=>$serviceCategory->id ,'name' => $value['name'],  'created_at' => Carbon::now(), 'updated_at'=> Carbon::now()]; 
        }
        serviceCategoryKeyword::insert($servicekeyword);
    
        return redirect(route('service-category-management'))->with('status','Service Category successfully created.');
    }

    public function render()
    {
        return view('livewire.services.category.create');
    }
}
