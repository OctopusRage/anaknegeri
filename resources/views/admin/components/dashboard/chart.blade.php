<div class="card">
    <div class="card-block">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">Statistik</h4>
                <div class="small text-muted">Juni 2017</div>
            </div>
            <!--/.col-->
            <div class="col-sm-7 hidden-sm-down">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group mr-3" data-toggle="buttons" aria-label="First group">
                        <label class="btn btn-outline-secondary">
                            <input type="radio" name="options" id="option1">User
                        </label>
                        <label class="btn btn-outline-secondary active">
                            <input type="radio" name="options" id="option2" checked="">Campaign
                        </label>
                        <label class="btn btn-outline-secondary">
                            <input type="radio" name="options" id="option3">Pelaporan
                        </label>
                    </div>
                </div>
            </div>
            <!--/.col-->
        </div>
        <!--/.row-->
        <div class="chart-wrapper" style="height:300px;margin-top:40px;">
            <canvas id="main-chart" class="chart" height="300"></canvas>
        </div>
    </div>
</div>

@section('pluginjs')
<script src="{{ asset('js/Chart.min.js') }}"></script>
@endsection
@section('viewjs')
<script src="{{ asset('core/js/views/main.js') }}"></script>
@endsection