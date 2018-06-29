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
                <li>Decodificadores</li><li>Mantenimiento de Decodificadores</li>
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
                <a data-toggle="modal" href="#myModal" class="btn btn-labeled btn-primary"> <span class="btn-label">
                        <i class="glyphicon glyphicon-ok"></i></span>Nuevo Decodificador </a>
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
                        <h2>Tabla de Decodificadores </h2>

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
                                        <th width="30%">Smart Card</th>
                                        <th width="30%">Serie</th>
                                        <th width="10%">Estado</th>
                                        <th width="25%">Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($decos as $deco)
                                        <tr>
                                            <td>{{$deco->id_deco}}</td>
                                            <td>{{$deco->smart_card}}</td>
                                            <td>{{$deco->serie}}</td>
                                            <td>
                                                @if($deco->estado_deco == '1')
                                                    No asignado
                                                @endif
                                            </td>
                                            <td>
                                                <ul class="demo-btns">
                                                    <li>
                                                        <a href="javascript:editar_deco({{$deco->id_deco}});" class="btn btn-labeled btn-warning"> <span class="btn-label"><i class="glyphicon glyphicon-edit"></i></span>Editar</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:eliminar_deco({{$deco->id_deco}});" class="btn btn-labeled btn-danger"> <span class="btn-label"><i class="glyphicon glyphicon-remove"></i></span>Eliminar</a>
                                                    </li>
                                                </ul>
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

                        <form  action="{{url('form_guardar_deco')}}" id="login-form" class="smart-form" method="POST">
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <fieldset>
                                <section>
                                    <div class="row">
                                        <label class="label col col-2">SmartCard:</label>
                                        <div class="col col-4">
                                            <label class="input">
                                                <input type="text" name="smart_card" id="smart_card">
                                            </label>
                                        </div>

                                        <label class="label col col-2">Serie:</label>
                                        <div class="col col-4">
                                            <label class="input">
                                                <input type="text" name="serial" id="serial">
                                            </label>
                                        </div>
                                    </div>
                                </section>

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
        </div><!-- /.modal -->

        <div class="modal fade" id="myModalEditar" tabindex="-1" role="dialog">
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

                        <form  action="{{url('form_actualizar_deco')}}" id="login-form" class="smart-form" method="POST">
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <input type="hidden" name="id_deco" id="id_deco">
                            <fieldset>
                                <section>
                                    <div class="row">
                                        <label class="label col col-2">SmartCard:</label>
                                        <div class="col col-4">
                                            <label class="input">
                                                <input type="text" name="smart_card_editar" id="smart_card_editar">
                                            </label>
                                        </div>

                                        <label class="label col col-2">Serie:</label>
                                        <div class="col col-4">
                                            <label class="input">
                                                <input type="text" name="serial_editar" id="serial_editar">
                                            </label>
                                        </div>
                                    </div>
                                </section>

                            </fieldset>
                            <footer>
                                <button type="submit" class="btn btn-primary">
                                    Actualizar
                                </button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                    Cancelar
                                </button>

                            </footer>
                        </form>


                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


        <div class="modal fade" id="myModalEliminar" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background: #BBDEFB; color: white">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            &times;
                        </button>
                        <h4 class="modal-title">
                            Eliminar Trabajador
                        </h4>
                    </div>
                    <div class="modal-body no-padding">

                        <form  action="{{url('form_eliminar_deco')}}" id="login-form" class="smart-form" method="POST">
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <input type="hidden" name="id_deco_eliminar" id="id_deco_eliminar">
                            <fieldset>
                                <section>
                                    <div class="row">
                                        <label class="label col col-12">Esta seguro de eliminar el registro?</label>
                                        <label class="label col col-12">Se eliminará decodificador con serie <strong id="nombre"></strong> de forma permanente.</label>
                                    </div>
                                </section>

                            </fieldset>

                            <footer>
                                <button type="submit" class="btn btn-primary">
                                    Aceptar
                                </button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                    Cancelar
                                </button>

                            </footer>
                        </form>


                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </div>
    <!-- END MAIN PANEL -->
@endsection


@section('page-js-script')

    <script language="JavaScript" type="text/javascript" src="{{ asset('js/js_modules/decos.js') }}"></script>
@endsection
