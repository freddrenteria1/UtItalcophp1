server = 'https://utitalco.com/cartagena/mbti/server/'

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

doc = getParameterByName('doc');
id = getParameterByName('id');

datos = []


buscarDatos()

function buscarDatos(){
    console.log(id)
    console.log(doc)
    $.post(server+'buscarDatos.php',{doc:doc, id:id},
    function(resp){
        console.log(resp)

        $('#nombre').val(resp.nombre)
        $('#doc').val(resp.doc)
        $('#cargo').val(resp.cargo)
    })
}

function iniciar(){
    
    nombre = $('#nombre').val()
    fechan = $('#fechan').val()
    edad = $('#edad').val()
    doc = $('#doc').val()
    cargo = $('#cargo').val()
    fechaa = $('#fechaa').val()

    if(nombre != "" && fechan != '' && edad != '' && doc != '' && cargo != ''  && fechaa != ''){
        datos.push({
            'id':id,
            'nombre':nombre,
            'fechan':fechan,
            'edad':edad,
            'doc':doc,
            'cargo':cargo,
            'fechaa':fechaa,
        });
        sessionStorage.setItem('datosP', JSON.stringify(datos))
        location = "parte1.html"
    }else{
        Swal.fire({
            position: "top-end",
            icon: "info",
            title: "Información",
            text:'Por favor registre todos los campos',
            showConfirmButton: false,
            timer: 1500
          });
    }


}