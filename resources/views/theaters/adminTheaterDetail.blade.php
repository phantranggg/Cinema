@extends('layouts.sidebar')

@section('content')
<div class="content-wrapper">
    <div class="content movie-info-admin">
        <div class="box box-primary">
            <div class="box-header with-border">
            <i class="fa fa-bar-chart-o"></i>

            <h3 class="box-title">Tổng số vé bán được</h3>
   
            </div>
            <div class="box-body">
            <div id="bar-chart" style="height: 300px;"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var data = {!! json_encode($theaters) !!};
    var data2 = [];
    for(var i=0;i<data.length;i++)
        data2.push([data[i].name,data[i].count]);
    var bar_data = {
      data : data2,
      color: '#3c8dbc'
    }
    $.plot('#bar-chart', [bar_data], {
      grid  : {
        borderWidth: 1,
        borderColor: '#f3f3f3',
        tickColor  : '#f3f3f3'
      },
      series: {
        bars: {
          show    : true,
          barWidth: 0.5,
          align   : 'center'
        }
      },
      xaxis : {
        mode      : 'categories',
        tickLength: 0
      }
    })
</script>
@endsection