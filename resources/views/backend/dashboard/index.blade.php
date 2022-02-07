@extends('backend.layouts.app')
 @section('dashboard','active')
 @section('content')
 <div class="wrapper">
<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-left: 0 !important;">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $today_bet_amount }} ks</h3>

                                <p>Today Bet</p>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $total_bet_amount }} ks</h3>

                                <p>Total Bet</p>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $deposit_amount }} ks</h3>

                                <p>Deposits</p>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $withdraw_amount }} ks</h3>

                                <p>Withdrawals</p>
                            </div>
                        </div>
                    </div>
                <!-- ./col -->
                </div>
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                <!-- Left col -->
                <section class="col-lg-6 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                            <i class="fas fa-chart-pie mr-1"></i>
                            Bets
                            </h3>
                            <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item">
                                <a class="nav-link active" href="#daily-chart" data-toggle="tab">Daily</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" href="#monthly-chart" data-toggle="tab">Monthly</a>
                                </li>
                            </ul>
                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content p-0">
                            <!-- Morris chart - Sales -->
                            <div class="chart tab-pane active" id="daily-chart"
                                style="position: relative; height: 400px;">
                                <canvas id="dailyChart" width="400" height="220"></canvas>
                            </div>
                            <div class="chart tab-pane" id="monthly-chart" style="position: relative; height: 400px;">
                                <canvas id="monthlyChart" width="400" height="220"></canvas>
                            </div>
                            </div>
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- /.card -->
                </section>
                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-6 connectedSortable">
                    <div id="chart_div" style="width: 100%; height: 500px;"></div>
                </section>
                <!-- right col -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
 </div>
  <!-- /.content-wrapper -->
 @endsection
 @section('scripts')
 <script>
    //google deposit and withdraw
    var chart_data = {!! json_encode($data) !!};
    google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {
            // Some raw data (not necessarily accurate)
            var data = google.visualization.arrayToDataTable(chart_data);

            var options = {
                title : 'Monthly Deposits and Withdrawals',
                vAxis: {title: 'Amounts'},
                hAxis: {title: 'Month'},
                seriesType: 'bars',
                series: {2: {type: 'line'}}
            };

            var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }

        //Daily Bet Chart
        var daily_bets = {!! json_encode($daily_bets) !!};
        var label = [];
        var bet_data = [];
        $.each(daily_bets, function(key, value) {
            label.push(value.days);
            bet_data.push(value.total_amount);
        })

        var monthly_bets = {!! json_encode($monthly_bets) !!};
        var monthly_label = [];
        var monthly_bet_data = [];
        $.each(monthly_bets, function(key, value) {
            monthly_label.push(value.months);
            monthly_bet_data.push(value.total_amount);
        })

        const ctx = document.getElementById('dailyChart').getContext('2d');
        const ctm = document.getElementById('monthlyChart').getContext('2d');
        drawChart(ctx, label, bet_data);
        drawChart(ctm, monthly_label, monthly_bet_data);
        function drawChart(ctx, label, bet_data) {
            const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: label,
                datasets: [{
                    label: 'Daily Bet Amount',
                    data: bet_data,
                    backgroundColor: [
                        'rgba(0, 0, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgba(0, 0, 255, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        }
 </script>
 @endsection