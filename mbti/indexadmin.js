server = 'https://utitalco.com/mbti/server/'

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

datos = []
perfiles = []


buscarDatos()

function buscarDatos(){
     
    $.post(server+'buscarDatosTodos.php',{},
    function(resp){
        console.log(resp)

        datos = resp.pruebas
        perfiles = resp.perfiles

        var html = ''

        for(var i=0; i<datos.length; i++){
            html += `
            <tr>
                <td>${datos[i].fecha_e}</td>
                <td>${datos[i].nombre}</td>
                <td>${datos[i].doc}</td>
                <td>${datos[i].fecha_n}</td>
                <td>${datos[i].edad}</td>
                <td>${datos[i].cargo}</td>
                <td><button class="btn btn-info" onclick="ver(${i})">Ver</button></td>
                

            </tr>
            `
        }

        $('#datosTabla').html(html)

        
    })
}

function  ver(e){

    var datosuser = []

    localStorage.setItem('arrayRespP1',datos[e].parte1)
    localStorage.setItem('arrayRespP2',datos[e].parte2)
    localStorage.setItem('arrayRespP3',datos[e].parte3)
    localStorage.setItem('arrayRespP4',datos[e].parte4)

    datosuser.push({
        'fecha':datos[e].fecha_e,
        'nombre':datos[e].nombre,
        'doc':datos[e].doc,
        'fecha_n':datos[e].fecha_n,
        'edad':datos[e].edad,
        'cargo':datos[e].cargo
    });

    localStorage.setItem('datosuser',JSON.stringify(datosuser))
    localStorage.setItem('perfiles',JSON.stringify(perfiles))

    
     
    location = 'final.html'
}