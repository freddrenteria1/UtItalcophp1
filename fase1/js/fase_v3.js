var url = "https://utitalco.com/calidad/028/vbk/server/";

var userfase = sessionStorage.getItem('userfase');
var nombres = sessionStorage.getItem('nombres')

var estado = sessionStorage.getItem('estado')

if(estado=='SI'){
    $('#btnevaluacion').addClass('oculto')
}

var numpag = 1;

$('#dropdownMenuButton1').html(nombres)

function login() {
    var doc = $("#doc").val();
    var clave = $("#clave").val();

    if (doc && clave != "") {
        $.post(
            url + "ingreso.php", {
                doc: doc,
                clave: clave,
            },
            function (resp) {
                if (resp.msn == "Ok") {
                    sessionStorage.setItem("userfase", doc);
                    sessionStorage.setItem("nombres", resp.nombres + ' ' + resp.apellidos);

                    location = "home.html";
                } else {
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "Oops...",
                        text: "Acceso denegado...!",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                }
            }
        );
    } else {
        Swal.fire({
            position: "top-end",
            icon: "info",
            title: "Oops...",
            text: "Ingrese su usuario y contraseña...!",
            showConfirmButton: false,
            timer: 1500,
        });
    }
}

var myCarousel = document.querySelector('#carouselExampleFade')
var carousel = new bootstrap.Carousel(myCarousel, {
  interval: 60000,
  wrap: false
})

function salir(){
    location = 'home.html'
}

function sumpag(){
    numpag++;
    if(numpag>64){
        numpag=64;
    }
    $('#pag').html('Página: '+numpag+'/64')
}

function restpag(){
    numpag--;
    if(numpag<1){
        numpag=1;
    }
    $('#pag').html('Página: '+numpag+'/64')
}

function evaluacion(){
    location = 'evaluacion.html'
}

