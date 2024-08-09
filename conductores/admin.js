
server = 'https://utitalco.com/conductores/server/';
arrayDatos = null

buscarInsp();

function buscarInsp(){
     
    $.post(server+'buscarInsp.php', {},
    function(resp){
        console.log(resp)
        if(resp != null){
            arrayDatos = resp
            cargarInfo()
        }else{
            Swal.fire({
                title: "Información!",
                text: "No hay inspecciones realizadas...",
                icon: "info"
              });
        }
    })
}

function cargarInfo(){

    var html = ''

    for(var i=0; i<arrayDatos.length; i++){
        html += `
            <tr>
                <td> ${arrayDatos[i].fecha} </td>
                <td> ${arrayDatos[i].placa} </td>
                <td> ${arrayDatos[i].ods} </td>
                <td> ${arrayDatos[i].planta} </td>
                <td> ${arrayDatos[i].conductor} </td>
                <td> ${arrayDatos[i].doccond} </td>
                <td> ${arrayDatos[i].observaciones} </td>
                <td> <button class="btn btn-info" onclick="ver(${arrayDatos[i].id})" >Ver</button> </td>
            </tr>
        `
    }

    $('#tlbDatos').html(html)


}

function ver(id){
    console.log(id)
    sessionStorage.setItem("idInsp", id)
    location = "insp.html"
}