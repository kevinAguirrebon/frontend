<!-- jQuery -->
<script src="<?php echo SERVERURL ?>views/assets/plugins/jquery/jquery.js"></script>
<!-- Bootstrap -->
<script src="<?php echo SERVERURL ?>views/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!--Icons-->
<script type="module" src="https://unpkg.com/ionicons@5.2.3/dist/ionicons/ionicons.esm.js"></script>
<!-- SELECT2 -->
<script src="<?php echo SERVERURL ?>views/assets/plugins/select2/js/select2.min.js"></script>
<!-- DataTables -->
<script src="<?php echo SERVERURL ?>views/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo SERVERURL ?>views/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo SERVERURL ?>views/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<!-- AdminLTE -->
<script src="<?php echo SERVERURL ?>views/assets/dist/js/adminlte.js"></script>
<!-- Alert -->
<script src="<?php echo SERVERURL ?>views/assets/configOthers/js/sweetalert2.min.js"></script>

<script>
    //config table
    let configLaguageDataTable = {
        "sProcessing":"Procesando...",
        "sLengthMenu":"Mostrar _MENU_ registros",
        "sZeroRecords":"No se encontraron resultados",
        "sEmptyTable":"Ningún dato disponible en esta tabla",
        "sInfo":"Mostrar reg. del _START_ al _END_ de _TOTAL_ reg.",
        "sInfoEmpty":"Mostrando reg. del 0 al 0 de 0 registros",
        "sInfoFiltered":"(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":"",
        "sSearch":"Buscar:",
        "sUrl":"",
        "sInfoThousands":",",
        "sLoadingRecords":"Cargando...",
        "oPaginate":{
        "sFirst":"Primero",
        "sLast":"Último",
        "sNext":"Siguiente",
        "sPrevious":"Anterior"
        },
        "oAria":{
            "sSortAscending":":Activar para ordenar la columna de manera ascendente",
            "sSortDescending":":Activar para ordenar la columna de manera descendente"
        },
        "buttons": {
            "copy": "Copiar",
            "colvis": "Visibilidad"
        }
    };
    //helper 
    const MESES = [
    "Enero",
    "Febrero",
    "Marzo",
    "Abril",
    "Mayo",
    "Junio",
    "Julio",
    "Agosto",
    "Septiembre",
    "Octubre",
    "Noviembre",
    "Diciembre",
  ];

    const Fecha = (date) =>{
        if(date){
            const f = new Date(date);
            const dia = f.getDate() + 1;
            const mes = f.getMonth();
            const year = f.getFullYear();
            return dia + ' de ' + MESES[mes] + ' del ' + year;
        }else{
            return 'No ha seleccionado una fecha';
        }
    }

    const fecha_format = () =>{
        const f = new Date();
        let dia = f.getDate();
        if(dia < 10){
         dia = '0'+dia;
        } 
        const mes = f.getMonth() + 1;
        const year = f.getFullYear();
        return year + '-' + (mes) + '-' + dia;
}
//
//var globa
    let alineacion = [];
    let camiones = [];
    let conductores = [];
    let rutas = [];
    let viajes = [];
    let pomas = [];
    let viajes_fecha = [];

//ALINEACION

    const getAlineacion  = async(fecha)=> {
        alineacion = [];
        const request = await fetch( `<?= APIURL ?>api/alineacion?id=${fecha}`);
        const response = await request.json();
        if(response.status){
            alineacion = response.data;
            cargar_tabla_alineacion(response.data,fecha);
        }
    }

    const fecha_alineacion = document.getElementById('fecha_alineacion');
        if(fecha_alineacion){
            fecha_alineacion.addEventListener('change', ()=>{
            getAlineacion(document.getElementById('fecha_alineacion').value);
        });
    }

    const boton_actualizar_Alineacion = document.getElementById('button_actulizar_alineacion');
    if(boton_actualizar_Alineacion){
        boton_actualizar_Alineacion.addEventListener('click', ()=>{
            getAlineacion(document.getElementById('fecha_alineacion').value);
        });
    }

    const cargar_tabla_alineacion = (data, fecha) =>{
        let body_alineacion = document.getElementById('body_alineacion');
        if(body_alineacion){
            document.getElementById('formato_fecha').innerHTML = Fecha(fecha);
            body_alineacion.innerHTML = '';
            if(data.length > 0){
                data.forEach(({codigo_finca,finca,avance,recogidas,restantes,alineacion}) => {
                body_alineacion.innerHTML += `
                    <tr>
                        <td class="text-center">${codigo_finca}</td>
                        <td class="text-center">${finca}</td>
                        <td class="text-center">${alineacion}</td>
                        <td class="text-center ${parseFloat(alineacion) >= parseFloat(avance)?'alineacion_active':'default_color'}">${avance}</td>
                        <td class="text-center ${parseFloat(recogidas) !== parseFloat(avance) ?'recogidas_active':'default_color'}">${recogidas}</td>
                        <td class="text-center ${parseFloat(restantes) !== 0 ?'restante_active':'default_color'}">${restantes}</td>
                    </tr>
                `
            })
            }else{
                body_alineacion.innerHTML += `
                    <tr>
                        <td colspan="6" class="text-center">No hay datos</td>
                    </tr>
                `;
            }
           
        }
    }

    //camiones
    const getCamiones = async() => {
        camiones = [];
        const request = await fetch( `<?= APIURL ?>api/camiones`);
        const response = await request.json();
        if(response.status){
            camiones.push(...response.data);
        }
    }

    const load_tabla_camiones = async() => {
        await getCamiones();
        if(camiones.length > 0){
            const data = camiones.map(({placa,tipo_camion,capacidad,fecha_registro}) => {
                return {
                    placa,
                    tipo_camion,
                    capacidad,
                    fecha_registro,
                    opciones: `
                    <div class="container">
                        <button class="btn btn-info btn-sm mx-2" onclick="modal_camiones_update('${placa}')" data-toggle="modal" data-target="#modal-default">
                            <i class="far fa-edit"></i></button> 
                        <button class="btn btn-danger btn-sm" onclick="delete_camion('${placa}')"><i class="far fa-trash-alt"></i></button>
                    </div>
                    `
                }
            });
            $('#table_camiones').DataTable({
                destroy: true,
                language: configLaguageDataTable,
                data: data,
                "columnDefs": [
                    {"className": "text-center", "targets": [2,3,4]}
                ],
            columns: [
                { data: 'placa' },
                { data: 'tipo_camion' },
                { data: 'capacidad' },
                { data: 'fecha_registro' },
                { data: 'opciones' },
            ]});
        }
        get_tipo_camiones();
    }

    const delete_camion = (id) => {
        swal({
            title: "Estas seguro?",
            text: "Una vez eliminado no podras recuperar el registro!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar",
            }).then(async (isConfirm)=>{
                if (isConfirm) {
                const request = await fetch(`<?= APIURL ?>api/camiones?id=${id}`,{
                        method: 'DELETE',
                        });
                const response = await request.json();
                if(response.status){
                    swal("Eliminado!", "Camion eliminado", "success");
                    load_tabla_camiones();
                }
                }
            });
    }
        

    const get_tipo_camiones = async() => {
        const request = await fetch(`<?= APIURL ?>api/tipoCamion`);
        const response = await request.json();
        if(response.status){
            let template = '';
            const data = response.data.map(({id,descripcion}) => {
                template += `
                    <option value="${id}">${descripcion}</option>
                `
            });
            document.getElementById('tipo_camion').innerHTML = template;
        }
    } 

    const guardar_camion = async() => {
        const id = document.getElementById('id_camion').value;
        const tipo = document.getElementById('tipo_camion').value;
        const capacidad = document.getElementById('capacidad').value;

        if(id && tipo && capacidad){
            const request = await fetch(`<?= APIURL ?>api/camiones`,{
                method: 'POST',
                body: JSON.stringify({data: {
                    id,
                    tipo,
                    capacidad
                }}),
            });
            const response = await request.json();
            if(response.status){
                swal({
                    title: 'Exito',
                    text: 'Se ha guardado el camion',
                    type: 'success',
                });
                document.getElementById('modal_camiones_close').click();
                load_tabla_camiones();
            }else{
                swal({
                    title: 'Error',
                    text: 'No se ha guardado el camion',
                    type: 'error',
                });
            }
        }else{
            swal({
                title: "Error",
                text: "Debe llenar todos los campos",
                type: "error",
            });
        }

    }

    const actualizar_camion = async (id_camion) => {
        const id = id_camion.toString();
        const tipo = document.getElementById('tipo_camion').value;
        const capacidad = document.getElementById('capacidad').value;

        if(id && tipo && capacidad){
            const request = await fetch(`<?= APIURL ?>api/camiones`,{
                method: 'PUT',
                body: JSON.stringify({data: {
                    id,
                    tipo,
                    capacidad
                }}),
            });
            const response = await request.json();
            if(response.status){
                swal({
                    title: 'Exito',
                    text: 'Se ha actualizado el camion',
                    type: 'success',
                });
                document.getElementById('modal_camiones_close').click();
                load_tabla_camiones();
            }else{
                swal({
                    title: 'Error',
                    text: 'No se ha actualizado el camion',
                    type: 'error',
                });
            }
        }else{
            swal({
                title: "Error",
                text: "Debe llenar todos los campos",
                type: "error",
            });
        }

    }

    const modal_camiones_update = async(id) => {
        console.log(id);
        const request = await fetch(`<?= APIURL ?>api/camiones?id=${id}`);
        const response = await request.json();
        if(response.status){
            document.getElementById('id_camion').value = response.data.id;
            document.getElementById('tipo_camion').value = response.data.tipo;
            document.getElementById('capacidad').value = response.data.capacidad;
            document.getElementById('id_camion').setAttribute('disabled',true);
            const div = document.getElementById('header_modal_camiones');
            if(div){
                div.innerHTML = `
                    <button type="button" class="btn btn-success" onclick="actualizar_camion(${id})">Actualizar</button>
                `;
            }
        }
        
    }

    const modal_camiones = document.getElementById('btn_modal_camiones');
    if(modal_camiones){
        modal_camiones.addEventListener('click', function(){
        document.getElementById('form_camiones').reset();
        document.getElementById('id_camion').removeAttribute('disabled');
        const div = document.getElementById('header_modal_camiones');
        if(div){
            div.innerHTML = `
                <button type="button" class="btn btn-success" onclick="guardar_camion()">Guardar</button>
            `;
        }
    });
    }

   

    // conductores

    const modal_conductores = document.getElementById('btn_modal_conductores');
    if(modal_conductores){
        modal_conductores.addEventListener('click', function(){
        document.getElementById('form_conductores').reset();
        document.getElementById('id_conductor').removeAttribute('disabled');
        const div = document.getElementById('header_modal_conductores');
        if(div){
            div.innerHTML = `
                <button type="button" class="btn btn-success" onclick="guardar_conductor()">Guardar</button>
            `;
        }
    });
    }

    const getConductores = async() => {
        conductores = [];
        const request = await fetch( `<?= APIURL ?>api/conductores`);
        const response = await request.json();
        if(response.status){
            conductores.push(...response.data);
        }
    }

    const load_tabla_conductores = async() => {
        await getConductores();
        if(conductores.length > 0){
            const data = conductores.map(({id,nombre,fecha,estado_id}) => {
                return {
                    id,nombre,fecha,estado_id,
                    opciones: `
                    <div class="container">
                        <button class="btn btn-info btn-sm mx-2" onclick="modal_conductores_update('${id}')" data-toggle="modal" data-target="#modal-default">
                            <i class="far fa-edit"></i></button> 
                        <button class="btn btn-danger btn-sm" onclick="delete_conductor('${id}')"><i class="far fa-trash-alt"></i></button>
                    </div>
                    `
                }
            });
            $('#table_conductores').DataTable({
                destroy: true,
                language: configLaguageDataTable,
                "columnDefs": [
                    {"className": "text-center", "targets": [2,3,4]}
                ],
                data: data,
            columns: [
                { data: 'id' },
                { data: 'nombre' },
                { data: 'fecha' },
                { data: 'estado_id' },
                { data: 'opciones' },
            ]});
        }
    }

    const modal_conductores_update = async(id) => {
        console.log(id);
        const request = await fetch(`<?= APIURL ?>api/conductores?id=${id}`);
        const response = await request.json();
        if(response.status){
            document.getElementById('id_conductor').value = response.data.id;
            document.getElementById('nombre').value = response.data.nombre;
            document.getElementById('id_conductor').setAttribute('disabled',true);
            const div = document.getElementById('header_modal_conductores');
            if(div){
                div.innerHTML = `
                    <button type="button" class="btn btn-success" onclick="actualizar_conductor(${id})">Actualizar</button>
                `;
            }
        }
        
    }

    const guardar_conductor = async() => {
        const id = document.getElementById('id_conductor').value;
        const nombre = document.getElementById('nombre').value;

        if(id && nombre){
            const request = await fetch(`<?= APIURL ?>api/conductores`,{
                method: 'POST',
                body: JSON.stringify({data: {
                    id: id,
                    nombre: nombre.toUpperCase(),
                }}),
            });
            const response = await request.json();
            if(response.status){
                swal({
                    title: 'Exito',
                    text: 'Se ha guardado el conductor',
                    type: 'success',
                });
                document.getElementById('modal_conductores_close').click();
                load_tabla_conductores();
            }else{
                swal({
                    title: 'Error',
                    text: 'No se ha guardado el conductor',
                    type: 'error',
                });
            }
        }else{
            swal({
                title: "Error",
                text: "Debe llenar todos los campos",
                type: "error",
            });
        }

    }

    const delete_conductor = (id) => {
        swal({
            title: "Estas seguro?",
            text: "Una vez eliminado no podras recuperar el registro!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar",
            }).then(async (isConfirm)=>{
                if (isConfirm) {
                const request = await fetch(`<?= APIURL ?>api/conductores?id=${id}`,{
                        method: 'DELETE',
                        });
                const response = await request.json();
                if(response.status){
                    swal("Eliminado!", "Conductor eliminado", "success");
                    load_tabla_conductores();
                }
                }
            });
    }

    const actualizar_conductor = async (id_conductor) => {
        const id = id_conductor.toString();
        const nombre = document.getElementById('nombre').value;

        if(id && nombre){
            const request = await fetch(`<?= APIURL ?>api/conductores`,{
                method: 'PUT',
                body: JSON.stringify({data: {
                    id: id,
                    nombre: nombre.toUpperCase(),
                }}),
            });
            const response = await request.json();
            if(response.status){
                swal({
                    title: 'Exito',
                    text: 'Se ha actualizado el conductor',
                    type: 'success',
                });
                document.getElementById('modal_conductores_close').click();
                load_tabla_conductores();
            }else{
                swal({
                    title: 'Error',
                    text: 'No se ha actualizado el conductor',
                    type: 'error',
                });
            }
        }else{
            swal({
                title: "Error",
                text: "Debe llenar todos los campos",
                type: "error",
            });
        }

    }
    //rutas
    const modal_rutas = document.getElementById('btn_modal_rutas');
    if(modal_rutas){
        modal_rutas.addEventListener('click', function(){
        document.getElementById('form_rutas').reset();
        const div = document.getElementById('header_modal_rutas');
        if(div){
            div.innerHTML = `
                <button type="button" class="btn btn-success" onclick="guardar_ruta()">Guardar</button>
            `;
        }
    });
    }

    const guardar_ruta = async() =>{
        let selected = $('.fincas').val();
        if(selected.length > 0){
            const orden =  selected.map((element,index) => { 
                return {
                    id: element,
                    orden: index + 1,
                }
            });
                const request = await fetch(`<?= APIURL ?>api/rutas`,{
                    method: 'POST',
                    body: JSON.stringify({data: orden}),
                });
                const response = await request.json();
                if(response.status){
                    swal({
                        title: 'Exito',
                        text: 'Se ha guardado la ruta',
                        type: 'success',
                    });
                 document.getElementById('modal_rutas_close').click();
                 load_tabla_rutas();
                }else{
                    swal({
                        title: 'Error',
                        text: 'No se ha guardado la ruta',
                        type: 'error',
                    });
                }
    }else{
        swal({
            title: "Error",
            text: "Debe seleccionar al menos una finca",
            type: "error",
        });
    }
}

    cargar_combox_fincas = async () => {
        const fincas = document.getElementById('fincas');
        if(fincas){
            const request = await fetch(`<?= APIURL ?>api/finca`)
            const response = await request.json();
            if(response.status){
                let template = '';
                response.data.forEach(item => {
                    template += `
                        <option value="${item.id}">${item.descripcion}</option>
                    `
                });
                document.getElementById('fincas').innerHTML = template;
            }
        }
    }

    const getRutas = async() => {
        rutas = [];
        const request = await fetch(`<?= APIURL ?>api/rutas`);
        const response = await request.json();
        if(response.status){
            rutas.push(...response.data);
        }
    }

    const load_tabla_rutas = async () => {
        await getRutas();
        if(rutas.length > 0){
            $('#tabla_rutas').DataTable().destroy();
            const data_final = [];
            for await (const item of rutas){
                const {id,fecha,rutas_det} = item;
                let template = '';
                rutas_det.forEach((item) => {
                    template += `<div><small class="badge badge-success mx-2">${item.orden}</small>${item.descripcion}</div>`;
                });

                data_final.push({
                    id: id,
                    fecha: fecha,
                    detalle: template,
                    opciones: `
                    <div class="container">
                        <button class="btn btn-info btn-sm mx-2" onclick="modal_rutas_update('${id}')" data-toggle="modal" data-target="#modal-default">
                            <i class="far fa-edit"></i></button> 
                        <button class="btn btn-danger btn-sm" onclick="delete_ruta('${id}')"><i class="far fa-trash-alt"></i></button>
                    </div>
                    `
                });
            }

            $('#tabla_rutas').DataTable({
                language: configLaguageDataTable,
                "columnDefs": [
                    {"className": "text-center", "targets": [0,1]}
                ],
                data: data_final,
                columns: [
                    { data: 'id' },
                    { data: 'fecha' },
                    { data: 'detalle' },
                    { data: 'opciones' },
                ]});
        }
    }

    const delete_ruta = (id) => {
        swal({
            title: "Estas seguro?",
            text: "Una vez eliminado no podras recuperar el registro!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar",
            }).then(async (isConfirm)=>{
                if (isConfirm) {
                const request = await fetch(`<?= APIURL ?>api/rutas?id=${id}`,{
                        method: 'DELETE',
                        });
                const response = await request.json();
                if(response.status){
                    swal("Eliminado!", "rutas eliminada", "success");
                    load_tabla_rutas();
                }else{
                    swal("Error", "No se ha eliminado la rutas", "error");
                }
                }
            });
    }

    const modal_rutas_update = (id) => {
        const data_id = rutas.filter(element => element.id === id);
        console.log(data_id);
        document.getElementById('rutas_anteriores').innerHTML = '';
        let fincas = '';
        data_id[0].rutas_det.forEach(item => {
            fincas += `<div><small class="badge badge-success mx-2">${item.orden}</small>${item.descripcion}</div>`;
        });
        document.getElementById('rutas_anteriores').innerHTML = fincas;
        document.getElementById('form_rutas').reset();
        const div = document.getElementById('header_modal_rutas');
        if(div){
            div.innerHTML = `
                <button type="button" class="btn btn-success" onclick="update_ruta('${id}')">Actualizar</button>
            `;
        }
    }

    const update_ruta = async (id) => {
        let selected = $('.fincas').val();
        if(selected.length > 0){
            const orden =  selected.map((element,index) => { 
                return {
                    id: element,
                    orden: index + 1,
                }
            });
            const request = await fetch(`<?= APIURL ?>api/rutas`,{
                method: 'PUT',
                body: JSON.stringify({
                    data: {id: id, data: orden}
                }),
            });
            const response = await request.json();
            if(response.status){
                swal({
                    title: 'Exito',
                    text: 'Se ha actualizado la ruta',
                    type: 'success',
                });
                document.getElementById('modal_rutas_close').click();
                load_tabla_rutas();
            }else{
                swal({
                    title: 'Error',
                    text: 'No se ha actualizado la ruta',
                    type: 'error',
                });
            }
        }else{
            swal({
                title: "Error",
                text: "Debe seleccionar al menos una finca",
                type: "error",
            });
        }
    }

    //vaijes
    const getViajes = async() => {
        viajes = [];
        const request = await fetch(`<?= APIURL ?>api/viajes`);
        const response = await request.json();
        if(response.status){
            viajes.push(...response.data);
        }
    }

    const load_tabla_viajes = async () => {
        await getViajes();
        if(viajes.length > 0){
            $('#tabla_viajes').DataTable().destroy();
            const data = viajes.map((viaje,index) => {
                return {
                    id: index + 1,
                    fecha: viaje.fecha,
                    placa: viaje.placa_id,
                    conductor: viaje.conductor_id,
                    nombre: viaje.nombre,
                    ruta: viaje.ruta_id,
                    opciones: `
                    <div class="container">
                        <button class="btn btn-info btn-sm mx-2" onclick="modal_viajes_update('${viaje.id}')" data-toggle="modal" data-target="#modal-default">
                            <i class="far fa-edit"></i></button> 
                        <button class="btn btn-danger btn-sm" onclick="delete_viaje('${viaje.id}')"><i class="far fa-trash-alt"></i></button>
                    </div>
                    `
                }
            });

            $('#tabla_viajes').DataTable({
                language: configLaguageDataTable,
                "columnDefs": [
                    {"className": "text-center", "targets": [0,1,2,5]}
                ],
                data: data,
                columns: [
                    { data: 'id' },
                    { data: 'fecha' },
                    { data: 'placa' },
                    { data: 'conductor' },
                    { data: 'nombre' },
                    { data: 'ruta' },
                    { data: 'opciones' },
                ]});
        }
    }

    const delete_viaje = (id) => {
        swal({
            title: "Estas seguro?",
            text: "Una vez eliminado no podras recuperar el registro!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar",
            }).then(async (isConfirm)=>{
                if (isConfirm) {
                const request = await fetch(`<?= APIURL ?>api/viajes?id=${id}`,{
                        method: 'DELETE',
                        });
                const response = await request.json();
                if(response.status){
                    swal("Eliminado!", "viaje eliminado", "success");
                    load_tabla_viajes();
                }else{
                    swal("Error", "No se ha eliminado el viaje", "error");
                }
                }
            });
    }

    const modal_viajes = document.getElementById('btn_modal_viajes');
    if(modal_viajes){
        modal_viajes.addEventListener('click', function(){
        document.getElementById('form_viajes').reset();
        const div = document.getElementById('header_modal_viajes');
        if(div){
            div.innerHTML = `
                <button type="button" class="btn btn-success" onclick="guardar_viaje()">Guardar</button>
            `;
        }
        load_cbxs_viajes();
    });
    }

    const load_cbxs_viajes = () =>{
        template_cbx_camion = '';
        camiones.forEach(item => {
            template_cbx_camion += `<option value="${item.placa}">${item.placa}</option>`;
        });
        document.getElementById('camion_viaje').innerHTML = template_cbx_camion;
        //
        template_cbx_conductor = '';
        conductores.forEach(item => {
            template_cbx_conductor += `<option value="${item.id}">${item.nombre}</option>`;
        });
        document.getElementById('conductor_viaje').innerHTML = template_cbx_conductor;
        //
        template_cbx_ruta = '';
        rutas.forEach(item => {
            template_cbx_ruta += `<option value="${item.id}">${item.id}</option>`;
        });
        document.getElementById('ruta_viaje').innerHTML = template_cbx_ruta;
    }

    const guardar_viaje = async() =>{
        const date = document.getElementById('fecha_viaje').value;
        const camion = document.getElementById('camion_viaje').value;
        const conductor = document.getElementById('conductor_viaje').value;
        const ruta = document.getElementById('ruta_viaje').value;
        if(date && camion && conductor && ruta){
            const peticion = await fetch(`<?= APIURL ?>api/viajes`,{
                method: 'POST',
                body: JSON.stringify({
                    data: {
                        fecha: date,
                        camion: camion,
                        conductor: conductor,
                        ruta: ruta,
                    }
                }),
            });
            const response = await peticion.json();
            if(response.status){
                swal({
                    title: 'Exito',
                    text: 'Se ha guardado el viaje',
                    type: 'success',
                });
                document.getElementById('modal_viajes_close').click();
                load_tabla_viajes();
            }else{
                swal({
                    title: 'Error',
                    text: 'No se ha guardado el viaje',
                    type: 'error',
                });
            }
        }else{
            swal({
                title: "Error",
                text: "Debe llenar todos los campos",
                type: "error",
            });
        }
    }

    const modal_viajes_update = async(id) => {
        await load_cbxs_viajes();
        const viaje = viajes.find(item => item.id == id);
        if(viaje){
            document.getElementById('form_viajes').reset();
            const div = document.getElementById('header_modal_viajes');
            if(div){
                div.innerHTML = `
                    <button type="button" class="btn btn-success" onclick="update_viaje('${id}')">Actualizar</button>
                `;
            }
            document.getElementById('fecha_viaje').value = viaje.fecha;
            document.getElementById('camion_viaje').value = viaje.placa_id;
            document.getElementById('conductor_viaje').value = viaje.conductor_id;
            document.getElementById('ruta_viaje').value = viaje.ruta_id;
        }
    }

    const update_viaje = async(id) => {
        const date = document.getElementById('fecha_viaje').value;
        const camion = document.getElementById('camion_viaje').value;
        const conductor = document.getElementById('conductor_viaje').value;
        const ruta = document.getElementById('ruta_viaje').value;
        if(date && camion && conductor && ruta){
            const peticion = await fetch(`<?= APIURL ?>api/viajes`,{
                method: 'PUT',
                body: JSON.stringify({
                    data: {
                        id: id,
                        fecha: date,
                        camion: camion,
                        conductor: conductor,
                        ruta: ruta,
                    }
                }),
            });
            const response = await peticion.json();
            if(response.status){
                swal({
                    title: 'Exito',
                    text: 'Se ha actualizado el viaje',
                    type: 'success',
                });
                document.getElementById('modal_viajes_close').click();
                load_tabla_viajes();
            }else{
                swal({
                    title: 'Error',
                    text: 'No se ha actualizado el viaje',
                    type: 'error',
                });
            }
        }else{
            swal({
                title: "Error",
                text: "Debe llenar todos los campos",
                type: "error",
            });
        }

    }
    //lista
    const get_pomas = async(fecha) =>{
        pomas = [];
        const peticion = await fetch(`<?= APIURL ?>api/pomas?id=${fecha}`);
        const response = await peticion.json();
        if(response.status){
            pomas = response.data;

        }
    }

    const fecha_id_viaje = document.getElementById('fecha_id_viaje');
    if(fecha_id_viaje){
        fecha_id_viaje.addEventListener('change', function(){
            const fecha = document.getElementById('fecha_id_viaje').value;
            get_pomas_lista(fecha);
        });
    }    
    
    const load_cbx_lista_placa = () => {
        const fecha = fecha_format();
        const fecha_id_viaje = document.getElementById('fecha_id_viaje');
        if(fecha_id_viaje){
            fecha_id_viaje.value = fecha;
        }
        
        get_pomas_lista(fecha);
    }

    const get_pomas_lista = async(fecha) => {
        await get_pomas(fecha);
        let placa_final = [];
        if(pomas.length > 0){
            const placa = pomas.map(({placa}) => {
                return placa.toUpperCase();
            })
            placa_final = Array.from(new Set(placa));
            let template_cbx_placa = ''; 
            placa_final.forEach(item => {
                template_cbx_placa += `<option value="${item}">${item}</option>`;
            });
            document.getElementById('placa_id_viaje').innerHTML = template_cbx_placa;
        }
        
        const placa_actual = document.getElementById('placa_id_viaje');
        if(placa_actual){
            cargar_viajes_table(placa_actual.value);
        }

    }
    const placa_id_viaje = document.getElementById('placa_id_viaje');
    if(placa_id_viaje){
        placa_id_viaje.addEventListener('change', function(){
            const placa = document.getElementById('placa_id_viaje').value;
            cargar_viajes_table(placa);
        });
    }
    const reload_viajes = document.getElementById('reload_viajes');
    if(reload_viajes){
        reload_viajes.addEventListener('click', function(){
            const placa = document.getElementById('placa_id_viaje').value;
        cargar_viajes_table(placa);
        });
    }


    const cargar_viajes_table = async (placa_actual) => {
        let horas_final = [];
        const horas = pomas.map(({hora}) => {
                return hora;
            })
        horas_final = (Array.from(new Set(horas))).sort();
        const filterForHora =  removeItemRepeatHora(horas_final,placa_actual);
        const filterForOrden =  removeItemRepeatOrden(filterForHora);
        const finalOperation =  removeItemRepeatHoraReducer(horas_final,filterForOrden,placa_actual);
    

        let template_table = '';
        if(finalOperation.length > 0){
            $('#table_lista_viajes').DataTable().destroy();
            let contador = 0;
            let data = [];
            for await (let item of finalOperation){   
                let buque = '';
                item.buque.map((element,index) => (
                    buque += `<li>${element}</li>`                       
                ))
                data.push({
                    id:1,
                    hora: item.hora,
                    finca: item.finca,
                    conductor: item.conductor,
                    ultimo: item.ultimo,
                    orden: item.orden,
                    embarcadero: item.embarcadero,
                    buque: buque,
                }) 
            }
            $('#table_lista_viajes').DataTable({
                language: configLaguageDataTable,
                "columnDefs": [
                    {"className": "text-center", "targets": [0,1,2,5]}
                ],
                data: data,
                columns: [
                    { data: 'id' },
                    { data: 'hora' },
                    { data: 'finca' },
                    { data: 'conductor' },
                    { data: 'ultimo' },
                    { data: 'orden' },
                    { data: 'embarcadero' },
                    { data: 'buque' },
                ]});

        }else{
            $('#table_lista_viajes').DataTable().destroy();
            $('#table_lista_viajes').DataTable({
                language: configLaguageDataTable,
                "columnDefs": [
                    {"className": "text-center", "targets": [0,1,2,5]}
                ],
                data: [],
                columns: [
                    { data: 'id' },
                    { data: 'hora' },
                    { data: 'finca' },
                    { data: 'conductor' },
                    { data: 'ultimo' },
                    { data: 'orden' },
                    { data: 'embarcadero' },
                    { data: 'buque' },
                ]});
        }
    }

    const removeItemRepeatHora = (dataHoras,placaActual) => {
        const filterForHora = [];
        dataHoras.forEach(element => {
            const ItemsTabla = pomas.filter(({hora,placa})=>{
                if(placaActual === placa && element === hora) {
                    return true;
                }
                return false;
            })
            if(ItemsTabla.length > 0){
                const buque = [];
                for (let i = 0; i < ItemsTabla.length; i++) {
                    buque.push(ItemsTabla[i].buque)
                }
                filterForHora.push({...ItemsTabla[0],buque});
            }
        })
        return filterForHora;
    }

    const removeItemRepeatHoraReducer = (dataHoras,dataReducer,placaActual) => {
        const filterForHora = [];
        dataHoras.forEach(element => {
            const ItemsTabla = dataReducer.filter(({hora,placa})=>{
                if(placaActual === placa && element === hora) {
                    return true;
                }
                return false;
            })
            if(ItemsTabla.length > 0){
                const buque = [];
                for (let i = 0; i < ItemsTabla.length; i++) {
                    buque.push(ItemsTabla[i].buque)
                }
                filterForHora.push({...ItemsTabla[0],buque: buque[0]});
            }
        })
        return filterForHora;
    }

    const removeItemRepeatOrden  = (datosOrden) => {
        const filterForOrden = [];
        datosOrden.forEach(element => {
            const ItemsTabla = datosOrden.filter(({finca,orden})=>{
                if(finca === element.finca && orden === element.orden) {
                    return true;
                }
                return false;
            })
            if(ItemsTabla.length > 0){
                const buque = [];
                for (let i = 0; i < ItemsTabla.length; i++) {
                    buque.push(...ItemsTabla[i].buque)
                }
                filterForOrden.push({...ItemsTabla[ItemsTabla.length - 1],buque});
            }
        })
        return filterForOrden;
    }
    //control

    const getViajesFecha = async(fecha) => {
        viajes_fecha = [];
        const request = await fetch( `<?= APIURL ?>api/viajes?id=${fecha}`);
        const response = await request.json();
        if(response.status){
            viajes_fecha.push(...response.data);
        }
    }

    load_table_control = async() => {
        let template = '';
        let count = 0;
        for await(viaje of viajes_fecha){
            let total_alineacion = 0;
            let capacidad = 0;
            let pallets = await camiones.find(({placa}) => placa === viaje.placa_id);
            console.log(pallets);
            if(pallets){
                capacidad = pallets.capacidad;
            }
            let det_template = '';
            await viaje.rutas_det.map(element => {
                const data = alineacion.find(({codigo_finca}) => codigo_finca === element.finca_id);
                if(data){
                    total_alineacion += parseFloat(data.restantes);
                }
                det_template += `
                    <tr>
                        <td width='15%'>${element.finca}</td>
                        <td width='10%'>${data? data.alineacion : 'N/A'}</td>
                        <td width='10%'>${data? data.avance : 'N/A'}</td>
                        <td width='10%'>${data? data.recogidas : 'N/A'}</td>
                        <td width='10%'>${data? data.restantes : 'N/A'}</td>
                    </tr>
                `
            })
            console.log(capacidad)
            template += `
            <tr>
                <td>${count++}</td>
                <td>${viaje.placa_id}</td>
                <td>${viaje.conductor}</td>
                <td>${viaje.nombre}</td>
                <td class="td_alineacion" colspan="5">
                    <table class="table mb-0">
                        <tbody style='background: #F4F6F9'>
                        ${det_template}
                        </tbody>
                    </table>
                </td>
                <td>${ Math.round(total_alineacion) }</td>
                <td>
                    <div class="progress-group" >
                            Pallets <span class="description-percentage text-danger">${Math.round((total_alineacion/capacidad * 100))}%</span>
                            <span class="float-right"><b>${Math.round(total_alineacion)}</b>/${capacidad}</span>
                            <div class="progress progress-sm">
                                <div class=${`progress-bar ${((total_alineacion/capacidad * 100) < 20)?'bg-danger': ((total_alineacion/capacidad * 100) < 80)? 'bg-warning' : 'bg-success'}`} width='${total_alineacion/capacidad * 100}%' />
                            </div>
                        </div>
                </td>
                <td>${ Math.floor((total_alineacion? total_alineacion : 0) / (capacidad ? capacidad : 0))}</td>
            </tr>
            `
        }
        document.getElementById('body_control').innerHTML = template;


    }
    




    //incial dom

    document.addEventListener('DOMContentLoaded', async function() {
        $('.fincas').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        })

        //load
        await getCamiones();
        await getConductores();
        await getRutas();
        await getViajes();

        const fecha = fecha_format()
        const fecha_alineacion_load = document.getElementById('fecha_alineacion');
        if(fecha_alineacion_load){
            fecha_alineacion_load.value = fecha;
            getAlineacion(fecha);
        }
        const fecha_control = document.querySelector('.fecha_control');
        if(fecha_control){
            document.querySelector('.fecha_control').innerHTML = fecha;
            await getAlineacion(fecha);
            await getViajesFecha(fecha);
            load_table_control();
        }

    
        //tablas
        const table_camiones_incial = document.getElementById('table_camiones');
        if(table_camiones_incial){
            load_tabla_camiones();
        }

        load_tabla_conductores();
        cargar_combox_fincas();



        load_tabla_rutas();


        load_tabla_viajes();


        load_cbx_lista_placa();
        
    });
</script>