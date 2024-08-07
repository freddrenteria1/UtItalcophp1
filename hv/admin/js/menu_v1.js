const API = "https://utitalco.com/hv/server/";

var arrayDatos = []
var arrayCed = []
var arrayNombres = []

cargando()

if(!sessionStorage.getItem("bdhv")){
    cargarDatos()
}else{
    cargarDatosLocal()
}

function cargarDatos() {

        $.post(API+"cargarDatosPersonalLista_1.php",{},
        function(resp){

            console.log(resp)

            arrayDatos = resp

            sessionStorage.setItem("bdhv", JSON.stringify(arrayDatos))           

            for(var i=0; i<arrayDatos.length; i++){

                arrayCed.push(arrayDatos[i].doc)
                arrayNombres.push(arrayDatos[i].nombres)
                
            }

            
    
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    showConfirmButton: false,
                    width: 300,
                    timer: 500,
                }).then(()=>{
                    $("#ced").autocomplete({
                        source: arrayCed
                    });

                    $("#nombres").autocomplete({
                        source: arrayNombres
                    });
                })

            //this.cargarInfo(resp)
                 

        })
 
}

function cargarDatosLocal() {


        arrayDatos = JSON.parse(sessionStorage.getItem("bdhv"))

        for(var i=0; i<arrayDatos.length; i++){

            arrayCed.push(arrayDatos[i].doc)
            arrayNombres.push(arrayDatos[i].nombres)
            
        }

        

            Swal.fire({
                position: "top-end",
                icon: "success",
                showConfirmButton: false,
                width: 300,
                timer: 500,
            }).then(()=>{
                $("#ced").autocomplete({
                    source: arrayCed
                });

                $("#nombres").autocomplete({
                    source: arrayNombres
                });
            })

        //this.cargarInfo(resp)
             

     

}

function buscarCed(){
    console.log('open')
    var cedb = $('#ced').val()
    console.log(cedb)
    sessionStorage.setItem('docuser', cedb)
    location = 'hojadevida.html';
}

function buscarCedD(){
    console.log('open')
    var cedb = $('#ced').val()
    console.log(cedb)
    sessionStorage.setItem('docuser', cedb)
    location = 'documentos.html';
    
}

function buscarNombre(){

    console.log('open')
    var nombresb = $('#nombres').val()

    console.log(nombresb)

    for (var i = 0, len = arrayDatos.length; i < len; i++) {
        if (arrayDatos[i].nombres === nombresb) {

            index = i;
            var cedb = arrayDatos[i].doc

            sessionStorage.setItem('docuser', cedb)
            location = 'hojadevida.html';

            break;
        }
    }

}

function buscarNombreD(){

    console.log('open')
    var nombresb = $('#nombres').val()

    console.log(nombresb)

    for (var i = 0, len = arrayDatos.length; i < len; i++) {
        if (arrayDatos[i].nombres === nombresb) {

            index = i;
            var cedb = arrayDatos[i].doc

            sessionStorage.setItem('docuser', cedb)
            location = 'documentos.html';

            break;
        }
    }

}


function verTodo(){
    location = 'homelistado.html'
}


function abrirArchivo(e){
    console.log('open')
    var cedb = $('#ced').val()
    console.log(cedb)
    sessionStorage.setItem('docuser', cedb)
    location = 'hojadevida.html';
}

function cerrar(){
    sessionStorage.clear()
    location = '../index.html'
}

function cargando() {
    let timerInterval
    Swal.fire({
        title: 'Procesando datos...!',
        timer: 20000,
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading()
            const b = Swal.getHtmlContainer().querySelector('b')
            timerInterval = setInterval(() => {
                // b.textContent = Swal.getTimerLeft()
            }, 100)
        },
        willClose: () => {
            clearInterval(timerInterval)
        }
    }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {
            console.log('I was closed by the timer')
        }
    })
}



