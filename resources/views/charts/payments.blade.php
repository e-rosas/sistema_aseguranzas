<div class="card">
    <div class="card-header">
        <h5 class="h3 mb-0">Payments</h5>
        <div class="form-row">
            {{--  start_date  --}}
            <div class="form-group {{ $errors->has('start_date') ? ' has-danger' : '' }}">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                    </div>
                    <input type="date" name="start_date" id="input-start_date" class="form-control {{ $errors->has('start_date') ? ' is-invalid' : '' }}"
                    value="{{ old('start_date') }}" required>
                    @if ($errors->has('start_date'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('start_date') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            {{--  end_date  --}}
            <div class="form-group {{ $errors->has('end_date') ? ' has-danger' : '' }}">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                    </div>
                    <input type="date" name="end_date" id="input-end_date" class="form-control {{ $errors->has('end_date') ? ' is-invalid' : '' }}"
                    value="{{ old('end_date') }}" required>
                    @if ($errors->has('end_date'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('end_date') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            {{--  refresh  --}}
            <div class="col text-right">
                <button id="refresh" type="button" class="btn btn-primary btn-sm" onclick="RefreshPayments()">
                    <span class="btn-inner--icon"><i class="fas fa-sync"></i></span>
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="chart">
            <canvas id="payments-chart" class="chart-canvas"></canvas>
        </div>

    </div>
    <div
</div>

@push('headjs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
@endpush
@push('js')
<script>

    function RefreshPayments(){
        $.ajax({
            url: "{{route('calls.store')}}",
            dataType: 'json',
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
                "person_data_id": {{ $person_data_id }},
                "number": number,
                "claim": claim,
                "date": date,
                "comments": comments,
            },
        success: function (response) {
            displayCalls(response.data);
            $('#modal-call').modal('hide')

            }
        });
        return false;
    }

    function addData(chart, label, data) {
        chart.data.labels.push(label);
        chart.data.datasets.forEach((dataset) => {
            dataset.data.push(data);
        });
        chart.update();
    }

    function removeData(chart) {
        chart.data.labels.pop();
        chart.data.datasets.forEach((dataset) => {
            dataset.data.pop();
        });
        chart.update();
    }

    $(document).ready(function(){
        var ctx = document.getElementById('payments-chart').getContext('2d');
        var paymentsChart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'My First dataset',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [0, 10, 5, 2, 20, 30, 45],
                    fill: false,
                }]
            },

            // Configuration options go here
            options: {}
        });
    });
</script>
@endpush
