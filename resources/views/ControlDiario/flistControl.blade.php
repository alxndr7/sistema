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
                <li>Control Diario</li><li>Asignacion de materiales y decos</li>
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
            <!-- widget grid -->
            <section id="widget-grid" class="">

                <!-- row -->
                <div class="row">

                    <!-- NEW WIDGET START -->
                    <article class="col-sm-12 col-md-6 col-lg-12">
                        <a data-toggle="modal" href="#myModal" class="btn btn-labeled btn-primary" onclick="add_validation()"> <span class="btn-label">
                        <i class="glyphicon glyphicon-ok"></i></span>Nueva Asignación</a>
                        <br><br>
                        <!-- Widget ID (each widget will need unique ID)-->
                        <div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-2" data-widget-editbutton="false">
                            <!-- widget options:
                            usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                            data-widget-colorbutton="false"
                            data-widget-editbutton="false"
                            data-widget-togglebutton="false"
                            data-widget-deletebutton="false"
                            data-widget-fullscreenbutton="false"
                            data-widget-custombutton="false"
                            data-widget-collapsed="true"
                            data-widget-sortable="false"

                            -->
                            <header>
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2>Tabla de Materiales </h2>

                            </header>

                            <!-- widget div-->
                            <div>

                                <!-- widget edit box -->
                                <div class="jarviswidget-editbox">
                                    <!-- This area used as dropdown edit box -->

                                </div>
                                <!-- end widget edit box -->

                                <!-- widget content -->
                                <div class="widget-body no-padding">

                                    <div class="table-responsive">

                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th width="5%">#</th>
                                                <th width="25%">Trabajador</th>
                                                <th width="15%">Orden De Trabajo</th>
                                                <th width="10%">IBS</th>
                                                <th width="15%">Tipo Servicio</th>
                                                <th width="10%">Decos</th>
                                                <th width="10%">Materiales</th>
                                                <th width="10%">Validar</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($detalle as $det)
                                                <tr>
                                                    <td>{{$det->id_asignacion}}</td>
                                                    <td>{{$det->nombre_trabajador}} {{$det->apellido_trabajador}}</td>
                                                    <td>{{$det->orden_trabajo}}</td>
                                                    <td>{{$det->ibs}}</td>
                                                    <td>{{$det->tipo_servicio}}</td>
                                                    <td>
                                                        <a href="javascript:ver_modal_decos({{$det->id_asignacion}});" class="btn btn-labeled btn-primary"> <span class="btn-label"><i class="fa fa-keyboard-o"></i></span>Ver</a>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:ver_modal_materiales({{$det->id_asignacion}});" class="btn btn-labeled btn-primary"> <span class="btn-label"><i class="fa fa-truck"></i></span>Ver</a>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:ver_modal_validar({{$det->id_asignacion}});" class="btn btn-labeled btn-danger"> <span class="btn-label"><i class="fa fa-edit"></i></span>Validar</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                <!-- end widget content -->

                            </div>
                            <!-- end widget div -->

                        </div>
                        <!-- end widget -->

                    </article>
                    <!-- WIDGET END -->
                </div>
            </section>

        </div>
        <!-- END MAIN CONTENT -->
        {{-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">

         </div>--}}

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            &times;
                        </button>
                        <h4 class="modal-title">
                            <img src="img/logo.png" width="150" alt="SmartAdmin">
                        </h4>
                    </div>
                    <div class="modal-body no-padding">
                        <form  action="{{url('form_guardar_asignacion')}}" id="nueva_asignacion" class="smart-form" method="POST" onkeypress="return event.keyCode != 13;">
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <input type="hidden" id="ids_dcos" name="ids_dcos">
                            <input type="hidden" id="ids_mate" name="ids_mate">
                            <fieldset>
                                <section>
                                    <div id="bootstrap-wizard-1" class="col-sm-12">
                                        <div class="form-bootstrapWizard">
                                            <ul class="bootstrapWizard form-wizard">
                                                <li class="active" data-target="#step1">
                                                    <a href="#tab1" data-toggle="tab"> <span class="step">1</span> <span class="title">Información Básica</span> </a>
                                                </li>
                                                <li data-target="#step2">
                                                    <a href="#tab2" data-toggle="tab"> <span class="step">2</span> <span class="title">Decodificadores</span> </a>
                                                </li>
                                                <li data-target="#step3">
                                                    <a href="#tab3" data-toggle="tab"> <span class="step">3</span> <span class="title">Materiales</span> </a>
                                                </li>
                                                <li data-target="#step4">
                                                    <a href="#tab4" data-toggle="tab"> <span class="step">4</span> <span class="title">Guardar</span> </a>
                                                </li>
                                            </ul>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane active smart-form" id="tab1">
                                                <fieldset>
                                                    <br>
                                                    <section class="col col-12">
                                                        <label class="label">
                                                            <h3><strong>Paso 1 </strong> - Información básica</h3>
                                                        </label>
                                                    </section>
                                                </fieldset>
                                                <fieldset>
                                                    <section class="col col-2">
                                                        <label class="label">Trabajador:</label>
                                                    </section>
                                                    <section class="col col-10">
                                                       {{-- <label class="select">
                                                            <select class="input" name="select_trabajador" id="select_trabajador" class="form-control">
                                                                <option value="0">Escoge Trabajador</option>
                                                                @foreach($trabajadores as $trab)
                                                                    <option value="{{$trab->id_trabajador}}">{{$trab->nombre_trabajador}} {{$trab->apellido_trabajador}}</option>
                                                                @endforeach
                                                            </select> <i></i>
                                                        </label>--}}
                                                                <div class="form-group">
                                                                        <select name="select_trabajador" id="select_trabajador" class="form-control">
                                                                            <option value="">Escoge Trabajador</option>
                                                                            @foreach($trabajadores as $trab)
                                                                                <option value="{{$trab->id_trabajador}}">{{$trab->nombre_trabajador}} {{$trab->apellido_trabajador}}</option>
                                                                            @endforeach
                                                                        </select>

                                                                </div>

                                                    </section>
                                                    <section class="col col-2">
                                                        <label class="label" style="text-align: right">Tipo:</label>
                                                    </section>
                                                    <section class="col col-4">
                                                        <div class="form-group">
                                                            <select name="select_tipo" id="select_tipo" class="form-control" onchange="validar_serv_inst(this.value)">
                                                                <option value="">Escoge Tipo</option>
                                                                <option value="Instalacion">Instalación</option>
                                                                <option value="Servicio">Servicio</option>
                                                            </select>

                                                        </div>

                                                    {{--    <label class="select">
                                                            <select class="input" name="select_tipo" id="select_tipo">
                                                                <option value="0">Escoge Tipo</option>
                                                                <option value="Instalacion">Instalación</option>
                                                                <option value="Servicio">Servicio</option>
                                                            </select> <i></i>
                                                        </label>--}}
                                                    </section>
                                                    <section class="col col-2">
                                                        <label class="label" style="text-align: right">Servicio:</label>
                                                    </section>
                                                    <section class="col col-4">
                                                        <div class="form-group">
                                                            <select name="select_tipo_serv" id="select_tipo_serv" class="form-control">
                                                                <option value="">Escoge Servicio</option>
                                                                <option value="Mudanza">Mudanza</option>
                                                                <option value="Adicional">Deco Adicional</option>
                                                                <option value="Otros">Otros Servicios</option>
                                                            </select>

                                                        </div>
                                                      {{--  <label class="select">
                                                            <select class="input" name="select_tipo_serv" id="select_tipo_serv">
                                                                <option value="0">Escoge Servicio</option>
                                                                <option value="Mudanza">Mudanza</option>
                                                                <option value="Adicional">Deco Adicional</option>
                                                                <option value="Otros">Otros Servicios</option>
                                                            </select> <i></i>
                                                        </label>--}}
                                                    </section>

                                                    <section class="col col-2">
                                                        <label class="label" style="text-align: right">IBS:</label>
                                                    </section>
                                                    <section class="col col-4">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <input class="form-control" name="ibs" id="ibs" placeholder="IBS Cliente">
                                                            </div>
                                                        </div>
                                                       {{-- <label class="input">
                                                            <input type="text" name="ibs" id="ibs" placeholder="IBS Cliente">
                                                        </label>--}}
                                                    </section>
                                                    <section class="col col-2">
                                                        <label class="label" style="text-align: right">O.T:</label>
                                                    </section>
                                                    <section class="col col-4">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <input class="form-control" name="orden_trabajo" id="orden_trabajo" placeholder="Orden de trabajo">
                                                            </div>
                                                        </div>
                                                     {{--   <label class="input">
                                                            <input type="text" name="orden_trabajo" id="orden_trabajo" placeholder="Orden de trabajo">
                                                        </label>--}}
                                                    </section>

                                                </fieldset>
                                            </div>
                                            <div class="tab-pane" id="tab2">
                                                <section>
                                                    <div class="row">
                                                        <label class="label col col-12">
                                                            <br><br>
                                                            <h3><strong>Paso 2 </strong> - Agregar Decos</h3>
                                                        </label>

                                                    </div>
                                                </section>
                                                <section>
                                                    <div class="row">
                                                        <label class="label col col-4" style="text-align: right">Decodificadores:</label>
                                                        <div class="col col-4">
                                                            <label class="select">
                                                                {{-- <select class="input" name="select_deco" id="select_deco">
                                                                     <option value="0">Escoge Deco</option>
                                                                     @foreach($decos as $deco)
                                                                         <option value="{{$deco->id_deco}}">{{$deco->serie}}</option>
                                                                     @endforeach
                                                                 </select>--}}
                                                                <input type="text" id="input_deco" onkeypress="ver_deco(event)">
                                                            </label>
                                                        </div>
                                                        <div class="col col-4">
                                                            {{--<label class="input">
                                                                <a href="javascript:agregar_deco();" class="btn btn-primary btn-circle"><i class="fa fa-plus"></i></a>
                                                            </label>--}}
                                                        </div>
                                                    </div>
                                                </section>
                                                <section>
                                                    <div class="row" style="margin-left: 0px;margin-right: 0px;">
                                                        <div class="table-responsive">

                                                            <table class="table table-bordered" id="tabla_decos">
                                                                <thead>
                                                                <tr>
                                                                    <th width="20%" style="text-align: center">#</th>
                                                                    <th width="60%" style="text-align: left">Serie</th>
                                                                    <th width="20%" style="text-align: center">Acción</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                            </table>

                                                        </div>

                                                    </div>
                                                </section>
                                            </div>
                                            <div class="tab-pane" id="tab3">
                                                <section>
                                                    <div class="row">
                                                        <label class="label col col-12">
                                                            <br><br>
                                                            <h3><strong>Paso 3 </strong> - Agregar Materiales</h3>
                                                        </label>
                                                    </div>
                                                </section>
                                              {{--  <section>
                                                    <div class="row">
                                                        <label class="label col col-2" style="text-align: right">Materiales:</label>
                                                        <div class="col col-4">
                                                            <label class="select">
                                                                <select class="input" name="select_material" id="select_material">
                                                                    <option value="0">Escoge Material</option>
                                                                    @foreach($materiales as $mat)
                                                                        <option value="{{$mat->id_material}}">{{$mat->desc_material}}</option>
                                                                    @endforeach
                                                                </select> <i></i>
                                                            </label>
                                                        </div>

                                                        <div class="col col-4">
                                                            <label class="input">
                                                                <input type="number" type="text" id="cantidad_select">
                                                            </label>
                                                        </div>

                                                        <div class="col col-2">
                                                            <label class="input">
                                                                <a href="javascript:add_validation();" class="btn btn-primary btn-circle"><i class="fa fa-plus"></i></a>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </section>--}}
                                                <section>
                                                    <div class="row" style="margin-left: 0px;margin-right: 0px;">
                                                        <div class="table-responsive">

                                                            <table class="table table-bordered" id="tabla_materiales">
                                                                <thead>
                                                                <tr>
                                                                    <th width="10%" style="text-align: center">#</th>
                                                                    <th width="50%" style="text-align: left">Material</th>
                                                                    <th width="20%" style="text-align: center">Cantidad</th>
                                                                    <th width="20%" style="text-align: center">Stock</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($materiales as $material)
                                                                    <tr>
                                                                        <td>{{$material->id_material}}</td>
                                                                        <td>{{$material->desc_material}}</td>
                                                                        <td>
                                                                            <input type="number" name="txt_cantidad_{{$material->id_material}}" id="txt_cantidad_{{$material->id_material}}" value="0"/>
                                                                        </td>
                                                                        <td>{{$material->total_material}}</td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>

                                                        </div>

                                                    </div>
                                                </section>
                                            </div>
                                            <div class="tab-pane" id="tab4">

                                                <fielset>
                                                    <section>
                                                        <div class="row">
                                                            <label class="label col col-12">
                                                                <br><br>
                                                                <h3><strong>Paso 4 </strong> - Guardar</h3>
                                                            </label>
                                                        </div>
                                                    </section>
                                                    <section>
                                                        <h1 class="text-center text-success"><strong><i class="fa fa-check fa-lg"></i> Completado</strong></h1>
                                                    </section>
                                                </fielset>
                                                    <section class="row">
                                                        <fielset>
                                                <section class="col col-4">
                                                </section>
                                                    <section class="col col-2">
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-primary form-control">
                                                                    Guardar
                                                                </button>

                                                            </div>
                                                    </section>
                                                    <section class="col col-2">
                                                        <div class="form-group">
                                                            <button type="button" class="btn btn-default form-control" data-dismiss="modal">
                                                                Cancelar
                                                            </button>

                                                        </div>
                                                    </section>
                                                    <section class="col col-4"></section>
                                                </fielset>

                                                </section>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <ul class="pager wizard no-margin">
                                                            <!--<li class="previous first disabled">
                                                            <a href="javascript:void(0);" class="btn btn-lg btn-default"> First </a>
                                                            </li>-->
                                                            <li class="previous disabled">
                                                                <a href="javascript:void(0);" class="btn btn-lg btn-default"> Anterior </a>
                                                            </li>
                                                            <!--<li class="next last">
                                                            <a href="javascript:void(0);" class="btn btn-lg btn-primary"> Last </a>
                                                            </li>-->
                                                            <li class="next">
                                                                <a href="javascript:void(0);" class="btn btn-lg txt-color-darken"> Siguiente </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </section>
                            </fieldset>
                        </form>


                    </div>
                </div>
            </div>
        </div>

        {{--<div class="modal fade" id="myModal1" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            &times;
                        </button>
                        <h4 class="modal-title">
                            <img src="img/logo.png" width="150" alt="SmartAdmin">
                        </h4>
                    </div>
                    <div class="modal-body no-padding">

                        <form  action="{{url('form_guardar_asignacion')}}" id="login-form" class="smart-form" method="POST" onkeypress="return event.keyCode != 13;">
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <input type="hidden" id="ids_dcos" name="ids_dcos">
                            <input type="hidden" id="ids_mate" name="ids_mate">
                            <fieldset>
                                <section>
                                    <div id="bootstrap-wizard-1" class="col-sm-12">
                                        <div class="form-bootstrapWizard">
                                            <ul class="bootstrapWizard form-wizard">
                                                <li class="active" data-target="#step1">
                                                    <a href="#tab1" data-toggle="tab"> <span class="step">1</span> <span class="title">Información Básica</span> </a>
                                                </li>
                                                <li data-target="#step2">
                                                    <a href="#tab2" data-toggle="tab"> <span class="step">2</span> <span class="title">Decodificadores</span> </a>
                                                </li>
                                                <li data-target="#step3">
                                                    <a href="#tab3" data-toggle="tab"> <span class="step">3</span> <span class="title">Materiales</span> </a>
                                                </li>
                                                <li data-target="#step4">
                                                    <a href="#tab4" data-toggle="tab"> <span class="step">4</span> <span class="title">Guardar</span> </a>
                                                </li>
                                            </ul>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane active smart-form" id="tab1">
                                                <fieldset>
                                                    <br>
                                                <section class="col col-12">
                                                    <label class="label">
                                                        <h3><strong>Paso 1 </strong> - Información básica</h3>
                                                    </label>
                                                </section>
                                                </fieldset>
                                                <fieldset>
                                                    <section class="col col-2">
                                                        <label class="label">Trabajador:</label>
                                                    </section>
                                                    <section class="col col-10">
                                                        <label class="select">
                                                            <select class="input" name="select_trabajador" id="select_trabajador">
                                                                <option value="0">Escoge Trabajador</option>
                                                                @foreach($trabajadores as $trab)
                                                                    <option value="{{$trab->id_trabajador}}">{{$trab->nombre_trabajador}} {{$trab->apellido_trabajador}}</option>
                                                                @endforeach
                                                            </select> <i></i>
                                                        </label>
                                                    </section>
                                                    <section class="col col-2">
                                                        <label class="label" style="text-align: right">Tipo:</label>
                                                    </section>
                                                    <section class="col col-4">
                                                        <label class="select">
                                                            <select class="input" name="select_tipo" id="select_tipo">
                                                                <option value="0">Escoge Tipo</option>
                                                                <option value="Instalacion">Instalación</option>
                                                                <option value="Servicio">Servicio</option>
                                                            </select> <i></i>
                                                        </label>
                                                    </section>
                                                    <section class="col col-2">
                                                        <label class="label" style="text-align: right">Servicio:</label>
                                                    </section>
                                                    <section class="col col-4">
                                                        <label class="select">
                                                            <select class="input" name="select_tipo_serv" id="select_tipo_serv">
                                                                <option value="0">Escoge Servicio</option>
                                                                <option value="Mudanza">Mudanza</option>
                                                                <option value="Adicional">Deco Adicional</option>
                                                                <option value="Otros">Otros Servicios</option>
                                                            </select> <i></i>
                                                        </label>
                                                    </section>

                                                    <section class="col col-2">
                                                        <label class="label" style="text-align: right">IBS:</label>
                                                    </section>
                                                    <section class="col col-4">
                                                        <label class="input">
                                                            <input type="text" name="ibs" id="ibs" placeholder="IBS Cliente">
                                                        </label>
                                                    </section>
                                                    <section class="col col-2">
                                                        <label class="label" style="text-align: right">O.T:</label>
                                                    </section>
                                                    <section class="col col-4">
                                                        <label class="input">
                                                            <input type="text" name="orden_trabajo" id="orden_trabajo" placeholder="Orden de trabajo">
                                                        </label>
                                                    </section>

                                                </fieldset>
                                            </div>
                                            <div class="tab-pane" id="tab2">
                                                <section>
                                                    <div class="row">
                                                        <label class="label col col-12">
                                                            <br><br>
                                                            <h3><strong>Paso 2 </strong> - Agregar Decos</h3>
                                                        </label>

                                                    </div>
                                                </section>
                                                <section>
                                                    <div class="row">
                                                        <label class="label col col-4" style="text-align: right">Decodificadores:</label>
                                                        <div class="col col-4">
                                                            <label class="select">
                                                                --}}{{-- <select class="input" name="select_deco" id="select_deco">
                                                                     <option value="0">Escoge Deco</option>
                                                                     @foreach($decos as $deco)
                                                                         <option value="{{$deco->id_deco}}">{{$deco->serie}}</option>
                                                                     @endforeach
                                                                 </select>--}}{{--
                                                                <input type="text" id="input_deco" onkeypress="ver_deco(event)">
                                                            </label>
                                                        </div>
                                                        <div class="col col-4">
                                                            --}}{{--<label class="input">
                                                                <a href="javascript:agregar_deco();" class="btn btn-primary btn-circle"><i class="fa fa-plus"></i></a>
                                                            </label>--}}{{--
                                                        </div>
                                                    </div>
                                                </section>
                                                <section>
                                                    <div class="row" style="margin-left: 0px;margin-right: 0px;">
                                                        <div class="table-responsive">

                                                            <table class="table table-bordered" id="tabla_decos">
                                                                <thead>
                                                                <tr>
                                                                    <th width="20%" style="text-align: center">#</th>
                                                                    <th width="60%" style="text-align: left">Serie</th>
                                                                    <th width="20%" style="text-align: center">Acción</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                            </table>

                                                        </div>

                                                    </div>
                                                </section>
                                            </div>
                                            <div class="tab-pane" id="tab3">
                                                <section>
                                                    <div class="row">
                                                        <label class="label col col-12">
                                                            <br><br>
                                                            <h3><strong>Paso 3 </strong> - Agregar Materiales</h3>
                                                        </label>
                                                    </div>
                                                </section>
                                                <section>
                                                    <div class="row">
                                                        <label class="label col col-2" style="text-align: right">Materiales:</label>
                                                        <div class="col col-4">
                                                            <label class="select">
                                                                <select class="input" name="select_material" id="select_material">
                                                                    <option value="0">Escoge Material</option>
                                                                    @foreach($materiales as $mat)
                                                                        <option value="{{$mat->id_material}}">{{$mat->desc_material}}</option>
                                                                    @endforeach
                                                                </select> <i></i>
                                                            </label>
                                                        </div>

                                                        <div class="col col-4">
                                                            <label class="input">
                                                                <input type="number" type="text" id="cantidad_select">
                                                            </label>
                                                        </div>

                                                        <div class="col col-2">
                                                            <label class="input">
                                                                <a href="javascript:agregar_material();" class="btn btn-primary btn-circle"><i class="fa fa-plus"></i></a>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </section>
                                                <section>
                                                    <div class="row" style="margin-left: 0px;margin-right: 0px;">
                                                        <div class="table-responsive">

                                                            <table class="table table-bordered" id="tabla_materiales">
                                                                <thead>
                                                                <tr>
                                                                    <th width="10%" style="text-align: center">#</th>
                                                                    <th width="50%" style="text-align: left">Material</th>
                                                                    <th width="20%" style="text-align: center">Cantidad</th>
                                                                    <th width="20%" style="text-align: center">Acción</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                            </table>

                                                        </div>

                                                    </div>
                                                </section>
                                            </div>
                                            <div class="tab-pane" id="tab4">
                                                <section>
                                                    <div class="row">
                                                        <label class="label col col-12">
                                                            <br><br>
                                                            <h3><strong>Paso 4 </strong> - Guardar</h3>
                                                        </label>
                                                    </div>
                                                </section>
                                                <section>
                                                    <h1 class="text-center text-success"><strong><i class="fa fa-check fa-lg"></i> Completado</strong></h1>
                                                    <h4 class="text-center">Click en guardar para finalizar</h4>
                                                    <br>
                                                    <br>
                                                </section>

                                            </div>

                                        </div>
                                    </div>
                                </section>

                                --}}{{--          <section>
                                              <div class="row">
                                                  <label class="label col col-2" style="text-align: right">Trabajador:</label>
                                                  <div class="col col-4">
                                                      <label class="select">
                                                          <select class="input" name="select_trabajador" id="select_trabajador">
                                                              <option value="0">Escoge Trabajador</option>
                                                                @foreach($trabajadores as $trab)
                                                                    <option value="{{$trab->id_trabajador}}">{{$trab->nombre_trabajador}} {{$trab->apellido_trabajador}}</option>
                                                                @endforeach
                                                          </select>
                                                      </label>
                                                  </div>
                                                  <label class="label col col-2" style="text-align: right">Tipo:</label>
                                                  <div class="col col-4">
                                                      <label class="select">
                                                          <select class="input" name="select_trabajador" id="select_trabajador">
                                                              <option value="0">Escoge Tipo</option>
                                                              <option value="Instalacion">Instalación</option>
                                                              <option value="Servicio">Servicio</option>
                                                          </select>
                                                      </label>
                                                  </div>

                                              </div>
                                          </section>
                                          <section>
                                              <div class="row">
                                                  <label class="label col col-2" style="text-align: right">IBS:</label>
                                                  <div class="col col-4">
                                                          <label class="input">
                                                              <input type="text" name="ibs" id="ibs" placeholder="IBS Cliente">
                                                          </label>
                                                  </div>

                                                  <label class="label col col-2" style="text-align: right">O.T:</label>
                                                  <div class="col col-4">
                                                      <label class="input">
                                                          <input type="text" name="orden_trabajo" id="orden_trabajo" placeholder="Orden de trabajo">
                                                      </label>
                                                  </div>
                                              </div>

                                          </section>

                                          <section>
                                              <div class="row">
                                                  <label class="label col col-4">Decodificadores: <a href="javascript:void(0);" class="btn btn-primary btn-circle"><i class="fa fa-plus"></i></a></label>
                                              </div>

                                          </section>

                                          <section>
                                              <div class="row">
                                                  <label class="label col col-8">Materiales: <a href="javascript:void(0);" class="btn btn-primary btn-circle"><i class="fa fa-plus"></i></a></label>

                                              </div>

                                          </section>

          --}}{{--
                            </fieldset>

                            <footer>
                                <button type="submit" class="btn btn-primary">
                                    Guardar
                                </button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                    Cancelar
                                </button>

                            </footer>
                        </form>


                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->--}}

        <div class="modal fade" id="myModalMateriales" tabindex="-1" role="dialog">

        </div><!-- /.modal -->
        <div class="modal fade" id="myModalDecos" tabindex="-1" role="dialog">

        </div><!-- /.modal -->

        <div class="modal fade" id="myModalValidar" tabindex="-1" role="dialog">
        </div><!-- /.modal -->

    </div>
    <!-- END MAIN PANEL -->
@endsection


@section('page-js-script')

    <script language="JavaScript" type="text/javascript" src="{{ asset('js/js_modules/control.js') }}"></script>
    <!-- PAGE RELATED PLUGIN(S) -->
    <script src="{{ asset('js/plugin/bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}"></script>
    <script src="{{ asset('js/plugin/fuelux/wizard/wizard.min.js')}}"></script>
    <script>
        $(document).ready(function() {
          /*  $(window).keydown(function(event){
                if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });*/


            var $validator = $("#nueva_asignacion").validate({

                rules: {
                    select_trabajador: {
                        required: true,
                    },
                    select_tipo:{
                        required: true,
                    },
                    ibs:{
                        required: true
                    },
                    select_tipo_serv:{
                        required: true
                    },
                    orden_trabajo:{
                        required: true
                    }
                },

                messages: {
                    ibs:{
                        required: "Campo Obligatorio",
                    },
                    select_tipo:{
                        required: "Campo Obligatorio"
                    },
                    select_trabajador:{
                        required: "Campo Obligatorio"
                    },
                    select_tipo_serv:{
                        required: "Campo Obligatorio"
                    },
                    orden_trabajo:{
                        required: "Campo Obligatorio"
                    }

                },

                highlight: function (element) {
                    $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                },
                unhighlight: function (element) {
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
                },
                errorElement: 'span',
                errorClass: 'help-block',
                errorPlacement: function (error, element) {
                    if (element.parent('.input-group').length) {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                }
            });

            $('#bootstrap-wizard-1').bootstrapWizard({
                'tabClass': 'form-wizard',
                'onNext': function (tab, navigation, index) {
                    //alert(1);
                    var $valid = $("#nueva_asignacion").valid();
                    if (!$valid) {
                        $validator.focusInvalid();
                        return false;
                    } else {
                        $('#bootstrap-wizard-1').find('.form-wizard').children('li').eq(index - 1).addClass(
                            'complete');
                        $('#bootstrap-wizard-1').find('.form-wizard').children('li').eq(index - 1).find('.step')
                            .html('<i class="fa fa-check"></i>');
                    }
                },
            onTabClick: function(tab, navigation, index) {
                //alert('on tab click disabled');
                return false;
            }
            });



        });
    </script>
@endsection
