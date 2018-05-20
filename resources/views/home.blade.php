@extends('layouts.app')

@section('content')
    <!-- MAIN PANEL -->
    <div id="main" role="main">

        <!-- RIBBON -->
        <div id="ribbon">

				<span class="ribbon-button-alignment">
					<span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
						<i class="fa fa-refresh"></i>
					</span>
				</span>

            <!-- breadcrumb -->
            <ol class="breadcrumb">
                <li>Home</li><li>Miscellaneous</li><li>Blank Page</li>
            </ol>
            <!-- end breadcrumb -->

            <!-- You can also add more buttons to the
            ribbon for further usability

            Example below:

            <span class="ribbon-button-alignment pull-right">
            <span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i> Change Grid</span>
            <span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i> Add</span>
            <span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">Search</span></span>
            </span> -->

        </div>
        <!-- END RIBBON -->



        <!-- MAIN CONTENT -->
        <div id="content">

            <div class="show-stat-microcharts">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                    <div class="easy-pie-chart txt-color-orangeDark" data-percent="{{$deco_disp_porcen}}" data-pie-size="50">
                        <span class="percent percent-sign">40</span>
                    </div>
                    <span class="easy-pie-title"> Decos <i class="fa fa-caret-up icon-color-bad"></i> </span>
                    <ul class="smaller-stat hidden-sm pull-right">
                        <li>
                            <span class="label bg-color-greenLight"><i class="fa fa-caret-up"></i> 70%</span>
                        </li>
                        <li>
                            <span class="label bg-color-blueLight"><i class="fa fa-caret-down"></i> 20%</span>
                        </li>
                    </ul>
                   {{-- <div class="sparkline txt-color-greenLight hidden-sm hidden-md pull-right" data-sparkline-type="line" data-sparkline-height="33px" data-sparkline-width="70px" data-fill-color="transparent">
                        130, 187, 250, 257, 200, 210, 300, 270, 363, 247, 270, 363, 247
                    </div>--}}
                </div>

                @foreach($materiales as $material)
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                            <div class="easy-pie-chart txt-color-greenLight" data-percent="{{$material->porcentaje}}" data-pie-size="50">
                                <span class="percent percent-sign">78.9 </span>
                            </div>
                            <span class="easy-pie-title"> {{$material->desc_material}}<i class="fa fa-caret-down icon-color-good"></i></span>
                            <ul class="smaller-stat hidden-sm pull-right">
                                <li>
                                    <span class="label bg-color-blueDark"><i class="fa fa-caret-up"></i> 76%</span>
                                </li>
                                <li>
                                    <span class="label bg-color-blue"><i class="fa fa-caret-down"></i> 3%</span>
                                </li>
                            </ul>
                            <div class="sparkline txt-color-blue hidden-sm hidden-md pull-right" data-sparkline-type="line" data-sparkline-height="33px" data-sparkline-width="70px" data-fill-color="transparent">
                                257, 200, 210, 300, 270, 363, 130, 187, 250, 247, 270, 363, 247
                            </div>
                        </div>
                @endforeach
             {{--   <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                    <div class="easy-pie-chart txt-color-blue" data-percent="23" data-pie-size="50">
                        <span class="percent percent-sign">23 </span>
                    </div>
                    <span class="easy-pie-title"> Transfered <i class="fa fa-caret-up icon-color-good"></i></span>
                    <ul class="smaller-stat hidden-sm pull-right">
                        <li>
                            <span class="label bg-color-darken">10GB</span>
                        </li>
                        <li>
                            <span class="label bg-color-blueDark"><i class="fa fa-caret-up"></i> 10%</span>
                        </li>
                    </ul>
                    <div class="sparkline txt-color-darken hidden-sm hidden-md pull-right" data-sparkline-type="line" data-sparkline-height="33px" data-sparkline-width="70px" data-fill-color="transparent">
                        200, 210, 363, 247, 300, 270, 130, 187, 250, 257, 363, 247, 270
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                    <div class="easy-pie-chart txt-color-darken" data-percent="36" data-pie-size="50">
                        <span class="percent degree-sign">36 <i class="fa fa-caret-up"></i></span>
                    </div>
                    <span class="easy-pie-title"> Temperature <i class="fa fa-caret-down icon-color-good"></i></span>
                    <ul class="smaller-stat hidden-sm pull-right">
                        <li>
                            <span class="label bg-color-red"><i class="fa fa-caret-up"></i> 124</span>
                        </li>
                        <li>
                            <span class="label bg-color-blue"><i class="fa fa-caret-down"></i> 40 F</span>
                        </li>
                    </ul>
                    <div class="sparkline txt-color-red hidden-sm hidden-md pull-right" data-sparkline-type="line" data-sparkline-height="33px" data-sparkline-width="70px" data-fill-color="transparent">
                        2700, 3631, 2471, 2700, 3631, 2471, 1300, 1877, 2500, 2577, 2000, 2100, 3000
                    </div>
                </div>--}}
            </div>


        </div>
        <!-- END MAIN CONTENT -->

    </div>
    <!-- END MAIN PANEL -->
@endsection
