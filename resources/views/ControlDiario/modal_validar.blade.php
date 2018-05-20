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

            <form  action="{{url('form_validar_asignacion')}}" id="login-form" class="smart-form" method="POST">

                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                <input type="hidden" id="id_asignacion" name="id_asignacion" value="{{$matAsig[0]->id_asignacion}}">
                <input type="hidden" id="ids_decos" name="ids_decos" value="{{$id_decos}}">
                <input type="hidden" id="ids_materiales" name="ids_materiales" value="{{$id_materiales}}">

                <fieldset>
                    <section>
                        <div class="row" style="margin-left: 0px;margin-right: 0px;">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tabla_decos">
                                    <thead>
                                    <tr>
                                        <th width="100%" colspan="3" style="text-align: center">Decodificadores</th>
                                    <tr>
                                        <th width="20%" style="text-align: center">#</th>
                                        <th width="40%" style="text-align: left">Serie</th>
                                        <th width="40%" style="text-align: left">Validar</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <input type="hidden" value="{{$i=1}}">

                                    @foreach($decosAsig as $dec)
                                        <tr>
                                            <td style="text-align: center">{{$i++}}</td>
                                            <td>{{$dec->serie}}</td>
                                            <td>
                                                <input type="checkbox" onchange="validar_decos(this , {{$dec->id_det_dec}})">
                                                <input type="hidden" id="deco_{{$dec->id_det_dec}}" name="deco_{{$dec->id_det_dec}}" value="0">
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </section>

                    <section>
                        <div class="row" style="margin-left: 0px;margin-right: 0px;">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="tabla_decos">
                                    <thead>
                                    <tr>
                                        <th width="100%" colspan="3" style="text-align: center">Materiales</th>
                                    <tr>
                                    <tr>
                                        <th width="20%" style="text-align: center">#</th>
                                        <th width="40%" style="text-align: left">Material</th>
                                        <th width="40%" style="text-align: left">Cantidad</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <input type="hidden" value="{{$i=1}}">
                                    @foreach($matAsig as $mat)
                                        <tr>
                                            <td style="text-align: center">{{$i++}}</td>
                                            <td>{{$mat->desc_material}}</td>
                                            <td>
                                                <input type="text" id="cantidad_despues_{{$mat->id_mat_asig}}" name="cantidad_despues_{{$mat->id_mat_asig}}" value="{{$mat->cantidad}}"/>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </section>
                </fieldset>
                <footer>
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Regresar
                    </button>
                    <button type="submit" class="btn btn-primary"> Validar</button>

                </footer>
            </form>


        </div>

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->