var url = "https://utitalco.com/calidad/028/vbk/server/";

var userfase = sessionStorage.getItem('userfase');
var nombres = sessionStorage.getItem('nombres')
var estado = sessionStorage.getItem('estado')

var datos=JSON.parse(localStorage.getItem('datosuser'))



if(estado=='NO'){
    $('#btncertificado').addClass('oculto')
    $('#fecha').html('')
    $('#puntaje').html('')
}else{
    
    $('#fecha').html('Última evaluación: '+datos.fecha)
    $('#puntaje').html('Puntaje: '+datos.puntaje + '/100')
}

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

function salir(){
    location = 'index.html'
}

function ver(){
    location = 'fase1.html'
}

function certificado(){
    window.open('lib/certificados/certificado.html', '_blank');
}