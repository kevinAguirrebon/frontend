<div class="jumbotron py-2 mb-0 mt-1">
            <div class="d-flex justify-content-center">
                <h3 class="mx-1">Programa diario</h3>
                <button class="btn btn-secondary" id="button_actulizar_alineacion"><i class="fas fa-redo"></i></button>
            </div>
        </div>
        <table class="table table-sm table-bordered">
            <thead>
                <tr style='background:#239B56'>
                    <th colSpan="2" class="text-center" width='32%'>
                        FECHA DE EMBARQUES ====>
                    </th>
                    <th class="px-0 py-0" width='16%'>
                        <input type="date" class="rounded-0 form-control" name="fecha" id="fecha_alineacion" style='padding-top:5px'/>
                    </th>
                    <th colspan="3" class="text-center" id="formato_fecha" width='48%'></th>
                </tr>
                <tr style='background:#2E86C1'>
                    <th class="text-center" style='color:#FFF'>Código</th>
                    <th class="text-center" style='color:#FFF'>Finca</th>
                    <th class="text-center" style='color:#FFF'>Pallets Alineados</th>
                    <th class="text-center" style='color:#FFF'>Pallets Reales</th>
                    <th class="text-center" style='color:#FFF'>Pallets Recogidos</th>
                    <th class="text-center" style='color:#FFF'>Pallets Restantes</th>
                </tr>
            </thead>
            <tbody id="body_alineacion">
                
              
                 
            </tbody>
        </table>

