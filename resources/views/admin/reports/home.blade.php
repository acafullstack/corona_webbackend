@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
    <script type="text/javascript" src="//cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>
 
    <div style="width: 1300px; height: 800px;">
	    {!! Mapper::render() !!}
    </div>


    @section('script')
    <script src="/assets/plugins/chart.js/Chart.min.js"></script>
    <script src="/assets/dist/js/pages/dashboard3.js"></script>
    @endsection
@endsection
