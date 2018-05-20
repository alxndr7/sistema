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

            <form  action="{{url('form_actualizar_material')}}" id="login-form" class="smart-form" method="POST">
                <fieldset>
                    <section>
                        <div class="row" style="margin-left: 0px;margin-right: 0px;">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="tabla_decos">
                                    <thead>
                                    <tr>
                                        <th width="20%" style="text-align: center">#</th>
                                        <th width="40%" style="text-align: left">Serie</th>
                                        <th width="40%" style="text-align: left">Smart Card</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <input type="hidden" value="{{$i=1}}">
                                    @foreach($decosAsig as $dec)
                                        <tr>
                                            <td style="text-align: center">{{$i++}}</td>
                                            <td>{{$dec->serie}}</td>
                                            <td>{{$dec->smart_card}}</td>
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

                </footer>
            </form>


        </div>

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->