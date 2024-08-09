var server = 'https://utitalco.com/cgm/server/'
var arrayDatos = []
var arrayItems = []

var user = sessionStorage.getItem('usermat');

if(user == null){
    location = 'login.html';
}else{
    var ods = sessionStorage.getItem('ods');
    $('#ods').html(ods)
}


cargarDatos()


function mensaje(title, msn){
    $.toast({
        heading: title,
        text: msn,
        position: 'top-right',
        loaderBg:'#e69a2a',
        icon: 'info',
        hideAfter: 2500, 
        stack: 6
    });
}

function cargarDatos(){
    mensaje('Cargando...', 'Sincronizando información...')

    $.post(server + 'cargarDevoluciones.php',
    function(resp) {
        arrayDatos = resp
        console.log(resp)

        var html= ''

        for(var i=0; i<arrayDatos.length; i++){
            html += `
                <tr>
                    <td>${arrayDatos[i].id}</td>
                    <td>${arrayDatos[i].fecha}</td>
                    <td>${arrayDatos[i].ods}</td>
                    <td>${arrayDatos[i].almacen}</td>
                    <td>${arrayDatos[i].observaciones}</td>
                    <td>
                        <button class="btn btn-success btn-icon-anim btn-circle" onclick="verEntrada(${arrayDatos[i].id})"><i class="fa fa-folder-open-o"></i></button>
                    </td>
                     
                </tr>
            `
        }

        $('#datosEntradas').html(html)

        $('#tblData').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        });

                

    })
}

function verEntrada(id){
    location = "verdevmatecp.html?id="+id
}
