<h4 class="mb-3">Todas las rutas</h4>
<div class="input-group jumbotron px-0  py-0 mb-0 py-2">
    <button type="button" class="btn btn-secondary" id="btn_modal_rutas" data-toggle="modal" data-target="#modal-default" >
        <i class="fas fa-plus"></i> Crear rutas
    </button>
</div>
<div class="table-responsive">
    <table class="table table-striped table-sm table-bordered mb-0"  style="font-size: 11px; width: 100%;" id="tabla_rutas">
        <thead>
            <tr style='background:#229954' >
                <th class="text-center" style='color: #FFF;width:20%'>Id</th>
                <th class="text-center" style='color: #FFF;width:20%'>Fecha</th>
                <th class="text-center" style='color: #FFF;width:30%'>Finca</th>
                <th class="text-center" style='color: #FFF;width:10%'>Opciones</th>
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
        <h4 class="modal-title">Registrar Ruta</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id='modal_rutas_close'>
            <span aria-hidden="true">×</span>
        </button>
        </div>
        <div class="modal-body">
        <form class="mt-2" id="form_rutas">
                <div class="form-group" id="rutas_anteriores">

                </div>
                <div class="form-group">
                  <label>Lugares</label>
                  <select class="fincas" multiple="multiple" data-placeholder="Selecciones un los lugares" style="width: 100%;" name='fincas[]' id="fincas">

                  </select>
                </div>
            <div class="form-group col-sm-5 mt-4" id="header_modal_rutas">
            </div>
        </form>
        </div>
    </div>
</div>
</div>