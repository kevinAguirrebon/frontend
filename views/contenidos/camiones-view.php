<h4 class="mb-3">Total de Camiones Registrados</h4>
<div class="input-group jumbotron px-0  py-0 mb-0 py-2">
    <button type="button" class="btn btn-secondary" id="btn_modal_camiones" data-toggle="modal" data-target="#modal-default" >
        <i class="fas fa-plus"></i> Crear camión
    </button>
</div>
<div class="table-responsive">
    <table class="table table-striped table-sm table-bordered mb-0"  style="font-size: 11px; width: 100%;" id="table_camiones">
        <thead>
            <tr style='background:#2E86C1' >
                <th class="text-center" style='color: #FFF;width:10%'>Placa</th>
                <th class="text-center" style='color: #FFF;width:20%'>Tipo_camion</th>
                <th class="text-center" style='color: #FFF;width:20%'>Capacidad</th>
                <th class="text-center" style='color: #FFF;width:20%'>Fecha</th>
                <th class="text-center" style='color: #FFF;width:20%'>Opciones</th>
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
        <h4 class="modal-title">Registrar Camión</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id='modal_camiones_close'>
            <span aria-hidden="true">×</span>
        </button>
        </div>
        <div class="modal-body">
        <form class="mt-2" id="form_camiones">
            <div class="form-group row">
                <label htmlFor="inputEmail3" class="col-sm-3 col-form-label">Placa</label>
                <div class="col-sm-9">
                    <input type="text" class='form-control form-control-border' name="id_camion" id="id_camion" placeholder="ingrese la placa"/>
                </div>
            </div>
            <div class="form-group row">
                <label htmlFor="inputEmail3" class="col-sm-3 col-form-label">Tipo camion</label>
                <div class="col-sm-9">
                <select class='form-control form-control-border' name="tipo" id="tipo_camion">
                </select>
                </div>
            </div>
            <div class="form-group row">
                <label htmlFor="inputEmail3" class="col-sm-3 col-form-label">Capacidad</label>
                <div class="col-sm-9">
                    <input type="text" class='form-control form-control-border'  placeholder="capacidad de pallets"  name="capacidad" id="capacidad" />
                </div>
            </div>
            <div class="form-group col-sm-5 mt-4" id="header_modal_camiones">
            </div>
        </form>
        </div>
    </div>
</div>
</div>

    