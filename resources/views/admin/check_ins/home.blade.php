@include('layouts.header')


    <style>
        #iw_container  {
                    text-align: center !important;
                        width: 235px;
                            height: 210px;
                }
                #iw_container img  {
                    width: 100px !important;
                    height: 100px !important;
                    border-radius: 50% !important;
                    margin-bottom: 10px;
                }
                #iw_container .iw_title {
                   font-size: 14px;
                }
                #iw_container .iw_title b  {
                   font-size: 19px !important;
                   color: #367fa9;
                }
                
    </style>


    <div style="width: 100%; height: 700px;">
	    {!! Mapper::render() !!}
    </div>


    <script src="/assets/plugins/chart.js/Chart.min.js"></script>
    <script src="/assets/dist/js/pages/dashboard3.js"></script>

@include('layouts.footer')