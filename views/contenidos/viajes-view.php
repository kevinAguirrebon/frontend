<h4 class="mb-3">Todas los viajes</h4>
<div class="input-group jumbotron px-0  py-0 mb-0 py-2">
    <button type="button" class="btn btn-secondary" id="btn_modal_viajes" data-toggle="modal" data-target="#modal-default">
        <i class="fas fa-plus"></i> Crear viaje
    </button>
</div>
<div class="table-responsive">
    <table class="table table-striped table-sm table-bordered mb-0" style="font-size: 11px; width: 100%;" id="tabla_viajes">
        <thead>
            <tr style='background:#229954'>
                <th class="text-center" style='color: #FFF;width:5%'>Id</th>
                <th class="text-center" style='color: #FFF;width:10%'>Fecha</th>
                <th class="text-center" style='color: #FFF;width:10%'>Camión</th>
                <th class="text-center" style='color: #FFF;width:10%'>Documento</th>
                <th class="text-center" style='color: #FFF;width:20%'>Conductor</th>
                <th class="text-center" style='color: #FFF;width:10%'>Ruta</th>
                <th class="text-center" style='color: #FFF;width:10%'>Acciones</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
<div class="modal fade show" id='modal-default'>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Registrar Viaje</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id='modal_viajes_close'>
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="mt-2" id="form_viajes">
                <div class="form-group row">
                        <label htmlFor="inputEmail3" class="col-sm-3 col-form-label">Fecha</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" name="fecha" id="fecha_viaje"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label htmlFor="inputEmail3" class="col-sm-3 col-form-label">Camión</label>
                        <div class="col-sm-9">
                            <select type="text" class="form-control" name="camion" id="camion_viaje"/>
                                <option value="">Seleccione un placa*</option>

                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label htmlFor="inputEmail3" class="col-sm-3 col-form-label">Conductor</label>
                        <div class="col-sm-9">
                            <select type="text" class="form-control" name="conductor" id="conductor_viaje">
                                <option value="">Seleccione un documento*</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label htmlFor="inputEmail3" class="col-sm-3 col-form-label">Rutas</label>
                        <div class="col-sm-9">
                            <select type="text" class="form-control" name="ruta" id="ruta_viaje">
                                <option value="">Seleccione una ruta*</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-5 mt-4" id="header_modal_viajes">

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>