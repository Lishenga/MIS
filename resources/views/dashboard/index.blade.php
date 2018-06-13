@extends('layouts.master')

@section('breadcrumb')
<ol class="breadcrumb hide-phone p-0 m-0">
    <li class="active">
        <a href="{{ url('/dashboard') }}"> Dashboard</a>
    </li>
</ol>
@stop
@section('page_title') Dashboard @stop
@section('content')
<div class="container">
    <div class="">

                            <div class="col-sm-3">
                                <div class="card-box widget-box-four">
                                    <div id="dashboard-1" class="widget-box-four-chart"><canvas width="80" height="80" style="display: inline-block; width: 80px; height: 80px; vertical-align: top;"></canvas></div>
                                    <div class="wigdet-four-content">
                                        <h4 class="m-t-0 font-16 m-b-5 text-overflow" title="Total Revenue">Finance</h4>
                                        <span style="font-size:80px; font-weight:bold; color:#21c18f;">
                                            <i class="mdi mdi-cash-multiple"></i>
                                        </span>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div><!-- end col -->

                            <div class="col-sm-3">
                                <div class="card-box widget-box-four">
                                    <div id="dashboard-1" class="widget-box-four-chart"><canvas width="80" height="80" style="display: inline-block; width: 80px; height: 80px; vertical-align: top;"></canvas></div>
                                    <div class="wigdet-four-content">
                                        <h4 class="m-t-0 font-16 m-b-5 text-overflow" title="Total Revenue">HR</h4>
                                        <span style="font-size:80px; font-weight:bold; color:#21c18f;">
                                            <i class="mdi mdi-worker"></i>
                                        </span>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div><!-- end col -->


                            <div class="col-sm-3">
                                <div class="card-box widget-box-four">
                                    <div id="dashboard-1" class="widget-box-four-chart"><canvas width="80" height="80" style="display: inline-block; width: 80px; height: 80px; vertical-align: top;"></canvas></div>
                                    <div class="wigdet-four-content">
                                        <h4 class="m-t-0 font-16 m-b-5 text-overflow" title="Total Revenue">Students</h4>
                                        <span style="font-size:80px; font-weight:bold; color:#21c18f;">
                                            <i class="mdi mdi-school"></i>
                                        </span>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div><!-- end col -->


                            <div class="col-sm-3">
                                <div class="card-box widget-box-four">
                                    <div id="dashboard-1" class="widget-box-four-chart"><canvas width="80" height="80" style="display: inline-block; width: 80px; height: 80px; vertical-align: top;"></canvas></div>
                                    <div class="wigdet-four-content">
                                        <h4 class="m-t-0 font-16 m-b-5 text-overflow" title="Total Revenue">Academics</h4>
                                        <span style="font-size:80px; font-weight:bold; color:#21c18f;">
                                            <i class="mdi mdi-book-open-variant"></i>
                                        </span>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div><!-- end col -->


                            <div class="col-sm-3">
                                <div class="card-box widget-box-four">
                                    <div id="dashboard-1" class="widget-box-four-chart"><canvas width="80" height="80" style="display: inline-block; width: 80px; height: 80px; vertical-align: top;"></canvas></div>
                                    <div class="wigdet-four-content">
                                        <h4 class="m-t-0 font-16 m-b-5 text-overflow" title="Total Revenue">Transport</h4>
                                        <span style="font-size:80px; font-weight:bold; color:#21c18f;">
                                            <i class="mdi mdi-car"></i>
                                        </span>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div><!-- end col -->

                            <div class="col-sm-3">
                                <div class="card-box widget-box-four">
                                    <div id="dashboard-1" class="widget-box-four-chart"><canvas width="80" height="80" style="display: inline-block; width: 80px; height: 80px; vertical-align: top;"></canvas></div>
                                    <div class="wigdet-four-content">
                                        <h4 class="m-t-0 font-16 m-b-5 text-overflow" title="Total Revenue">Medical</h4>
                                        <span style="font-size:80px; font-weight:bold; color:#21c18f;">
                                            <i class="mdi mdi-hospital"></i>
                                        </span>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div><!-- end col -->

                            <div class="col-sm-3">
                                <div class="card-box widget-box-four">
                                    <div id="dashboard-1" class="widget-box-four-chart"><canvas width="80" height="80" style="display: inline-block; width: 80px; height: 80px; vertical-align: top;"></canvas></div>
                                    <div class="wigdet-four-content">
                                        <h4 class="m-t-0 font-16 m-b-5 text-overflow" title="Total Revenue">Property</h4>
                                        <span style="font-size:80px; font-weight:bold; color:#21c18f;">
                                            <i class=" mdi mdi-home-modern"></i>
                                        </span>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div><!-- end col -->


                            <div class="col-sm-3">
                                <div class="card-box widget-box-four">
                                    <div id="dashboard-1" class="widget-box-four-chart"><canvas width="80" height="80" style="display: inline-block; width: 80px; height: 80px; vertical-align: top;"></canvas></div>
                                    <div class="wigdet-four-content">
                                        <h4 class="m-t-0 font-16 m-b-5 text-overflow" title="Total Revenue">Cafeteria</h4>
                                        <span style="font-size:80px; font-weight:bold; color:#21c18f;">
                                            <i class=" mdi mdi-food"></i>
                                        </span>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div><!-- end col -->


                            <div class="col-sm-3">
                                <div class="card-box widget-box-four">
                                    <div id="dashboard-1" class="widget-box-four-chart"><canvas width="80" height="80" style="display: inline-block; width: 80px; height: 80px; vertical-align: top;"></canvas></div>
                                    <div class="wigdet-four-content">
                                        <h4 class="m-t-0 font-16 m-b-5 text-overflow" title="Total Revenue">Settings</h4>
                                        <span style="font-size:80px; font-weight:bold; color:#21c18f;">
                                            <i class="mdi mdi-settings"></i>
                                        </span>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div><!-- end col -->


                            <div class="col-sm-3">
                                <div class="card-box widget-box-four">
                                    <div id="dashboard-1" class="widget-box-four-chart"><canvas width="80" height="80" style="display: inline-block; width: 80px; height: 80px; vertical-align: top;"></canvas></div>
                                    <div class="wigdet-four-content">
                                        <h4 class="m-t-0 font-16 m-b-5 text-overflow" title="Total Revenue">Point Of Sale</h4>
                                        <span style="font-size:80px; font-weight:bold; color:#21c18f;">
                                            <i class="mdi mdi-cart"></i>
                                        </span>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div><!-- end col -->

                            

                        </div>
</div>
@stop