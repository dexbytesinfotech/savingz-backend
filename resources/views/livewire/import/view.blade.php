<div class="container-fluid py-4">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="mb-0">Records</h5>
                        </div>
                        <div class="col-6 text-end">
                            @if($file->success_count > 0)
                                <a wire:click="uploadNow()" class="btn bg-gradient-success mb-0 me-4"><i
                                        class="material-icons text-sm">sync</i>&nbsp;&nbsp;Proceed Now</a>
                            @endif 
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-4">
                            <div class="nav-wrapper position-relative end-0">
                                <ul class="nav nav-pills nav-fill p-1"  >
                                    <li class="nav-item">
                                        <a  class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" role="tab" aria-selected="true">
                                            Valid
                                            <span class="badge badge-success">{{$file->success_count}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" role="tab" aria-selected="false">
                                           Invalid
                                           <span class="badge badge-primary">{{$file->error_count}}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-8"></div>
                    </div>
                </div>

            
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                @foreach ($header as $head =>  $headValue)
                                    <th class="text-uppercase  text-center text-secondary text-xs font-weight-bolder opacity-7">{{ str_replace('_', ' ',$head) }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="h-100">
                            @foreach ($displayData as $displayKey =>  $displayValue)
                                <tr>
                                     @foreach ($displayValue as $dkey =>  $dValue)
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-secondary text-xs font-weight-normal"> 
                                                {{$dValue}}
                                            </span>
                                        </td>
                                    @endforeach
                                </tr> 
                            @endforeach

                            @if(empty($displayData))
                                <tr>
                                    <td colspan="{{ count($header) }}">
                                           <p class="text-center">No records found!</p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
 

            </div>
        </div>
    </div>
</div>
@push('js')
<script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.min.js"></script>
@endpush
