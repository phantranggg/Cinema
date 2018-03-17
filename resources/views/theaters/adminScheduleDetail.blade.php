@extends('layouts.sidebar')

@section('content')
<div class="content-wrapper">
    <div class="content movie-info-admin">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-bar-chart-o"></i>

                <h3 class="box-title">Thống kê theo khung giờ chiếu</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div id="donut-chart" style="height: 300px;"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var data = {!! json_encode($schedules) !!};
    var count = [];
    for (var i=0;i<data.length;i++) {
        if (data[i].case != null) {
            count[data[i].case] = data[i].count;
        } else {
            count[5] = data[i].count;
        }  
    }
    var donutData = [
      { label: '8h-12h', data: count[1], color: '#00a65a' },
      { label: '12h-16h', data: count[2], color: '#f39c12' },
      { label: '16h-20h', data: count[3], color: '#00c0ef' },
      { label: '20h-24h', data: count[4], color: '#3c8dbc' },
      { label: 'Khác', data: count[5], color: '#d2d6de' }
    ]
    $.plot('#donut-chart', donutData, {
      series: {
        pie: {
          show       : true,
          radius     : 1,
          innerRadius: 0.5,
          label      : {
            show     : true,
            radius   : 2 / 3,
            formatter: labelFormatter,
            threshold: 0.1
          }

        }
      },
      legend: {
        show: false
      }
    });
    function labelFormatter(label, series) {
        return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
        + label
        + '<br>'
        + Math.round(series.percent) + '%</div>'
    }
</script>
@endsection