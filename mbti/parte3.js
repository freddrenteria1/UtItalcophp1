server = 'https://utitalco.com/mbti/server/'

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

doc = getParameterByName('doc');
id = getParameterByName('id');

datos = []

datos = JSON.parse(sessionStorage.getItem('datosP'))




//buscarDatos()

function buscarDatos(){
    console.log(id)
    console.log(doc)
    $.post(server+'buscarDatos.php',{doc:doc, id:id},
    function(resp){
        console.log(resp)

        $('#nombre').val(resp.nombre)
        $('#doc').val(resp.doc)
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
        datos.pus({
            'nombre':nombre,
            'fechan':fechan,
            'edad':edad,
            'doc':doc,
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

'use strict';

const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const snap = document.getElementById("snap");
const errorMsgElement = document.querySelector('span#errorMsg');

const constraints = {
  audio: true,
  video: {
    width: 1280, height: 720
  }
};

// Access webcam
async function init() {
  try {
    const stream = await navigator.mediaDevices.getUserMedia(constraints);
    handleSuccess(stream);
  } catch (e) {
    errorMsgElement.innerHTML = `navigator.getUserMedia error:${e.toString()}`;
  }
}

// Success
function handleSuccess(stream) {
  window.stream = stream;
  video.srcObject = stream;
}

// Load init
init();

// Draw image
var context = canvas.getContext('2d');
snap.addEventListener("click", function() {
        context.drawImage(video, 0, 0, 300, 200);
});

arrayRespP3 = null

function siguiente(){

  arrayRespP3 = []

  for(var i=59; i<=78; i++){

    if($("#"+i+'-1').is(':checked')) { 
      resp = $('#'+i+'-1').val()
      arrayRespP3.push({
        'Preg':i,
        'resp':resp
      })
    }

    if($("#"+i+'-2').is(':checked')) { 
      resp = $('#'+i+'-2').val()
      arrayRespP3.push({
        'Preg':i,
        'resp':resp
      })
    }

  }

  if(arrayRespP3.length < 19){
    Swal.fire({
      position: "top-end",
      icon: "info",
      title: "Información",
      text:'Por favor registre todas las respuestas...',
      showConfirmButton: false,
      timer: 1500
    });
  }else{
    localStorage.setItem('arrayRespP3',JSON.stringify(arrayRespP3))
    location = "parte4.html"
  }

  console.log(arrayRespP3)


}