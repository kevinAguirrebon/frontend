<h4 class="mb-3">Total de Conductores Registrados</h4>
<div class="input-group jumbotron px-0  py-0 mb-0 py-2">
    <button type="button" class="btn btn-secondary" id="btn_modal_conductores" data-toggle="modal" data-target="#modal-default" >
        <i class="fas fa-plus"></i> Crear conductor
    </button>
</div>
<div class="table-responsive">
    <table class="table table-striped table-sm table-bordered mb-0"  style="font-size: 11px; width: 100%;" id="table_conductores">
        <thead>
            <tr style='background:#2E86C1' >
                <th class="text-center" style='color: #FFF;width:10%'>Documento</th>
                <th class="text-center" style='color: #FFF;width:20%'>Nombre Completo</th>
                <th class="text-center" style='color: #FFF;width:20%'>Fecha_Registro</th>
                <th class="text-center" style='color: #FFF;width:20%'>Estado</th>
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
        <h4 class="modal-title">Registrar Conductor</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id='modal_conductores_close'>
            <span aria-hidden="true">×</span>
        </button>
        </div>
        <div class="modal-body">
        <form class="mt-2" id="form_conductores">
            <div class="form-group row">
                <label htmlFor="inputEmail3" class="col-sm-3 col-form-label">Documento</label>
                <div class="col-sm-9">
                    <input type="text" class='form-control form-control-border' name="id_conductor" id="id_conductor" placeholder="ingrese el id"/>
                </div>
            </div>
            <div class="form-group row">
                <label htmlFor="inputEmail3" class="col-sm-3 col-form-label">Nombre</label>
                <div class="col-sm-9">
                    <input type="text" class='form-control form-control-border'  placeholder="Ingresa el nombre"  name="nombre" id="nombre" />
                </div>
            </div>
            <div class="form-group col-sm-5 mt-4" id="header_modal_conductores">
            </div>
        </form>
        </div>
    </div>
</div>
</div>