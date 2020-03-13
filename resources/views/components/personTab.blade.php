<div class="nav-wrapper">
    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
        <li class="nav-item">
            <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i> {{ __('Services') }} </a>
        </li>
        <li class="nav-item">
            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i> {{ __('Discounts') }} </a>
        </li>
        <li class="nav-item">
            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="ni ni-calendar-grid-58 mr-2"></i> {{ __('Calls') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-4-tab" data-toggle="tab" href="#tabs-icons-text-4" role="tab" aria-controls="tabs-icons-text-4" aria-selected="false"><i class="ni ni-calendar-grid-58 mr-2"></i> {{ __('Payments') }}</a>
        </li>
    </ul>
</div>
<div class="card shadow">
    <div class="card-body">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                @include('insurees.partials.invoicesTable', ['invoices' => $invoices])
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{ $invoices->links() }}
                    </nav>
                </div>
            </div>
            <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                <div class="col-md-12 col-auto text-right">
                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-form">{{ __('Add') }}</i></button>
                    <br />
                    @component('components.discountsModal',['person_data_id'=>$person_data->id, 'total_invoices'=>$total])
                        
                    @endcomponent
                </div>
                @component('components.discountsTable', ['discounts'=>$person_data->discounts])
                    
                @endcomponent
            </div>
            <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                <div class="col-md-12 col-auto text-right">
                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-call">{{ __('Add') }}</i></button>
                    <br />
                    @component('components.callsModal',['number'=>$person_data->calls->count() + 1, 'person_data_id'=>$person_data->id])
                        
                    @endcomponent
                </div>
                @component('components.callsTable', ['calls'=>$person_data->calls])
                    
                @endcomponent
            </div>
            <div class="tab-pane fade" id="tabs-icons-text-4" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                <div class="col-md-12 col-auto text-right">
                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-payment">{{ __('Add') }}</i></button>
                    <br />
                    @include('payments.partials.addModal',['number'=>$person_data->payments->count() + 1, 'person_data_id'=>$person_data->id])
                </div>
                @include('payments.partials.table', ['payments'=>$person_data->payments, 'person_data_id'=>$person_data->id])
            </div>
        </div>
    </div>
</div>