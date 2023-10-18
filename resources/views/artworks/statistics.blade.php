@extends('layouts.app')

@section('content')

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    </head>

    <body>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('Artworks Stats') }}</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <div class="container-xl cadre ">
                    <h2 class="sectiontitle">
                        By Creation Year
                    </h2>
                    <h3 class="subsectiontitle">Top 5 Years</h3>
                    <div class="promotionscount">
                        @foreach ($topFiveYears as $year)
                            <div class="countbox">
                                <div class="information">
                                    <h3 class="count">
                                        {{ $year->count }}
                                    </h3>
                                    <p class="title">
                                        Artworks
                                    </p>
                                    <p class="year">
                                        Year : {{ $year->year }}
                                    </p>
                                </div>
                                <div class="icon"><i class="fas fa-medal"></i></div>
                            </div>
                        @endforeach
                    </div>
                    <h3 class="subsectiontitle">Chart</h3>
                    <?php
                    $arrayData = $artworkCountByYear->toArray();
                    $categories = array_map(function ($item) {
                        return $item['year'];
                    }, $arrayData);
                    $values = array_map(function ($item) {
                        return $item['count'];
                    }, $arrayData);
                    ?>
                    <div class="yearschart" id="chart-container"></div>
                    <h2 class="sectiontitle">
                        Artwork Types
                    </h2>
                    <h3 class="subsectiontitle">Artworks Per Type</h3>
                    <div class="promotionscount">
                        @foreach ($artworkCountByType as $type)
                            <div class="countbox">
                                <div class="information">
                                    <h3 class="count">
                                        {{ $type->count }}
                                    </h3>
                                    <p class="title">
                                        Artworks
                                    </p>
                                    <p class="year">
                                        Type : {{ $type->type }}
                                    </p>
                                </div>
                                <div class="icon"><i class="fas fa-check"></i></div>
                            </div>
                        @endforeach
                    </div>
                    <h3 class="subsectiontitle">Chart</h3>
                    <div id="piechart-container"></div>
                    <h2 class="sectiontitle">
                        By Artists
                    </h2>
                    <h3 class="subsectiontitle">Top 5 Artists</h3>
                    <div class="promotionscount">
                        @foreach ($topArtists as $artist)
                            <div class="countbox">
                                <div class="information">
                                    <h3 class="count">
                                        {{ $artist->count }}
                                    </h3>
                                    <p class="title">
                                        Artworks
                                    </p>
                                    <p class="year">
                                        {{ $artist->first_name }} {{ $artist->last_name }}
                                    </p>
                                </div>
                                <div class="icon"><i class="fas fa-male"></i></div>
                            </div>
                        @endforeach
                    </div>
                    <h3 class="subsectiontitle">Chart</h3>
                    <div id="barchart-container"></div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </body>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        Highcharts.chart('chart-container', {
            chart: {
                type: 'column',


            },
            title: {
                text: 'Artworks By Creation Year'
            },
            xAxis: {
                categories: <?php echo json_encode($categories); ?>
            },
            yAxis: {
                title: {
                    text: 'Artworks'
                }
            },
            series: [{
                name: 'Artworks',
                data: <?php echo json_encode($values); ?>
            }],
            plotOptions: {
                column: {
                    color: '#4981f5' // set the colors for each bar
                }
            }
        });
    </script>
    <script>
    var chartData = {!! $artworkCountByType !!};
    
    Highcharts.chart('piechart-container', {
        title: {
            text: 'Artwork Count By Type'
        },
        series: [{
            type: 'pie',
            name: 'Count',
            data: chartData.map(function(item) {
                return [item.type, item.count];
            })
        }]
    });
</script>
<script>
Highcharts.chart('barchart-container', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Top 5 Artists with the Most Artworks'
    },
    xAxis: {
        type: 'category',
        labels: {
            rotation: -45,
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Artwork Count'
        }
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: 'Artwork Count: <b>{point.y:.0f}</b>'
    },
    series: [{
        name: 'Top Artists',
        data: {!! json_encode($artistchartData) !!},
        dataLabels: {
            enabled: true,
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
            format: '{point.y:.0f}',
            y: 10,
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    }],
    plotOptions: {
                bar: {
                    color: '#4981f5' // set the colors for each bar
                }
            }
});
</script>
@endsection
