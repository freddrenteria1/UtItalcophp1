
server = 'https://utitalco.com/conductores/server/';
arrayDatos = null
arrayInfo = null
arrayInsp = null


id = sessionStorage.getItem("idInsp")

buscarInsp()

function buscarInsp(){
     
    $.post(server+'cargarInsp.php', {id:id},
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
    arrayInfo = arrayDatos.veh
    arrayInsp = arrayDatos.insp

    $('#fecha').html(arrayInsp.fecha)
    $('#planta').html(arrayInsp.planta)
    $('#ods').html(arrayInsp.ods)

    $('#tipo').html(arrayInfo.tipo)
    $('#placa').html(arrayInfo.placa)
    $('#marca').html(arrayInfo.marca)
    $('#modelo').html(arrayInfo.modelo)
    $('#capacidad').html(arrayInfo.capacidad)

    $('#fechaultimo').html(arrayInfo.ultmant)
    $('#fechaproximo').html(arrayInfo.proxmant)

    $('#ultimokilom').html(arrayInfo.kiloultmant)
    $('#fechsoatexpe').html(arrayInfo.soatexp)
    $('#fechsoatven').html(arrayInfo.soatvence)
    $('#fechexpetecno').html(arrayInfo.tecnoexp)
    $('#fechventecno').html(arrayInfo.tecnovence)
    $('#kilominicial').html(arrayInsp.kilo)

    arrayItems = JSON.parse(arrayInsp.items)

    for(var i=0; i<arrayItems.length; i++){
        $('#item'+i).html(arrayItems[i].item)
    }

    $('#nombre1').html(arrayInsp.conductor)
     
    $('#vbconductor').attr('src', arrayInsp.firma);
    $('#partedelantera').attr('src', "https://utitalco.com/conductores/server/fotos/"+arrayInsp.fotoPD);
    $('#parteposterior').attr('src', "https://utitalco.com/conductores/server/fotos/"+arrayInsp.fotoPP);
    $('#ladoderecho').attr('src', "https://utitalco.com/conductores/server/fotos/"+arrayInsp.fotoLD);
    $('#ladoizquierdo').attr('src', "https://utitalco.com/conductores/server/fotos/"+arrayInsp.fotoLI);

    $('#obs').html(arrayInsp.observaciones)

}