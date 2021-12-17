<div class="jumbotron px-0  py-1 mb-0 d-block" >
            <div class="d-flex justify-content-center">
                <h5 class="text-center mb-0">Viajes de Camiones</h5>
            </div>
        </div>
        <div class="my-2 d-flex">
            <div class="form-group d-flex my-0">
                <label style='padding:4px'>Fecha: </label>
                <input type="date" name="fecha_pomas" id="fecha_id_viaje" class="form-control"></input>
            </div>
            <div class="form-group d-flex my-0">
            <label style='padding:4px'>Placa: </label>
                <select name="placas" id='placa_id_viaje' class="form-control mx-3" style='width:200px'>  
                    <option value="">Seleccione una placa</option>
                </select>
            </div>
            <button class="btn btn-secondary" id="reload_viajes"><i class="fas fa-redo"></i></button>
        </div>
        <div class="table-responsive">
            <table class="table table-sm table-bordered"  style="font-size: 11px; width: 100%;"  id="table_lista_viajes">
                <thead>
                    <tr style='background:#229954'>
                        <th class="text-center" style='color: #FFF'>#</th>
                        <th class="text-center" style='color: #FFF'>Hora</th>
                        <th class="text-center" style='color: #FFF'>Finca</th>
                        <th class="text-center" style='color: #FFF'>Conductor</th>
                        <th class="text-center" style='color: #FFF'>Ultimo</th>
                        <th class="text-center" style='color: #FFF'>Orden</th>
                        <th class="text-center" style='color: #FFF'>Embarcadero</th>
                        <th class="text-center" style='color: #FFF'>Buques</th>
                    </tr>
                </thead>
                <tbody>
                   
                           
                    
                   
                </tbody>
            </table>
        </div>