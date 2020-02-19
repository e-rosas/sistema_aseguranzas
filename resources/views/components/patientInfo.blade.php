
<div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
    <div class="card card-profile shadow">
        <div class="row justify-content-center">
            <div class="col-lg-3 order-lg-2">
                <div class="card">
                    <a href="#">
                        @if ($person_data->insured==0)
                            <h2>{{ __('Patient') }}</h2>
                        @else 
                            <h2>{{ __('Insuree') }}</h2>
                        @endif
                        
                    </a>
                </div>
            </div>
        </div>
        <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
            <div class="d-flex justify-content-center">
                <a href="#" class="btn btn-sm btn-info mr-4">{{ __('View') }}</a>
            </div>
        </div>
        <div class="card-body pt-0 pt-md-4">
            
            <div class="text-center">
                <h3>
                    {{ $person_data->fullName() }}<span class="font-weight-light"></span>
                </h3>
                <div class="h4 font-weight-300">
                    <span> {{ $person_data->birth_date }} </span>
                </div>
                <div class="h4 font-weight-300">
                    <span> {{ $person_data->address }} </span>
                </div>
                <div class="h4 font-weight-300">
                    <span> {{ $person_data->addressDetails() }} </span>
                </div>
                <div class="h4 font-weight-300">
                    <span> {{ $person_data->phone_number }} </span>
                </div>
                <div class="h4 font-weight-300">
                    <a href="mailto:{{$person_data->email}}">{{$person_data->email}}</a>
                </div>
            </div>
        </div>
    </div>
</div>

   
