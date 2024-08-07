
var odsq = null
var arrayEquipos = null
var especialidad = null
var url = "https://utitalco.com/calidad/033/server/";

var user = sessionStorage.getItem('usercal');
var tipouser = sessionStorage.getItem('tipouser');

if (user == null) {
    location = 'index.html'
}

if (tipouser == 'italco') {
    var html = '<img src="img/logo_m.png" width="150px" alt="">'
    $('#tipo').html(html)
} else {
    var html = '<img src="img/logoiguana.png" width="150px" alt="">'
    $('#tipo').html(html)
}

cargarDatos()

function cargarDatos(){
    $.post('https://utitalco.com/calidad/033/server/cargarFirmas.php', {               
            },
                function (resp) {
                    sessionStorage.setItem('bdFirmas', JSON.stringify(resp))
                })
}



function abrir(e) {



    if (e == 'ALISTAMIENTO') {
        location = 'alistamiento/menu.html'
    }

    if (e == 'DESMANTELAMIENTO') {
        location = 'desmantelamiento/menu.html'
    }

    if (e == 'MONTAJE') {
        location = 'montaje/menu.html'
    }

}


function selOds() {
    Swal.fire({
        title: 'Login',
        html: `Digite usuario, contraseña y Planta <br><br>
                    <div style="width: 50%; margin: auto;">
                       
                        usuario <br>
                        <input type="text" class="form-control" id="usercali">
                        <br>
                        Clave de acceso <br>
                        <input type="password" class="form-control" id="claveecp"> <br>

                    </div>
                `,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar'
    }).then((result) => {
        if (result.isConfirmed) {

            var usercali = $('#usercali').val()
            var claveecp = $('#claveecp').val()
            var odssel = '030'
            var planta = $('#planta').val()


            $.post('https://utitalco.com/calidad/033/weldbook/server/vingreso.php', {
                user: usercali,
                clave: claveecp
            },
                function (resp) {
                    if (resp.msn == 'Ok') {
                        sessionStorage.setItem('usercal', usercali)
                        sessionStorage.setItem('tipouser', resp.tipo)
                        localStorage.setItem('odsq', odssel)

                        if (resp.tipo == 'italco') {

                            location = 'weldbook/menu.html'
                        }


                    } else {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Acceso denegado...!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                })


        }
    })
}




function clave() {
    Swal.fire({
        title: 'Cambiar constraseña',
        html: `Clave actual <br>
                <input type="password" id="claveact" class="form-control" placeholder="Clave actual">
                Nueva Clave <br>
                <input type="password" id="claven" class="form-control" placeholder="Nueva Clave">
                `,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar'
    }).then((result) => {
        if (result.isConfirmed) {
            var claveact = $('#claveact').val()
            var claven = $('#claven').val()
            $.post(url + 'actClave.php', {
                claveact: claveact,
                claven: claven,
                user: user
            },
                function (resp) {
                    if (resp.msn == 'Ok') {
                        Swal.fire({
                            icon: 'info',
                            title: 'Contraseña...',
                            text: 'Acceso actualizado..!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    } else {
                        Swal.fire({
                            icon: 'info',
                            title: 'Contraseña...',
                            text: resp.msn,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }

                })
        }
    })
}


odsq = localStorage.getItem('odsq');

if (odsq == null || odsq == '') {
    location = './'
} else {
    $('#odsq').html(odsq)
}


function selEsp(esp) {

    if (esp == 'ROTATIVO') {
        sessionStorage.setItem('esp', esp)
        sessionStorage.setItem('servicio', "EJECUCIÓN")
        location = 'busquedaTagsFamilia.html';
    } else {
        if (esp == 'CONVERTIDOR') {
            sessionStorage.setItem('esp', esp)
            sessionStorage.setItem('servicio', "EJECUCIÓN")
            location = 'busquedaTagsFamilia.html';
        } else {
            sessionStorage.setItem('esp', esp)
            location = 'equipos.html'
        }
    }




}

function buscarTag() {
    location = "busquedaRca.html"
}

function buscar() {
    location = busqueda = "busquedaTags.html"
}

function informe() {
    location = 'informercakpi.html'
}

function salir() {
    location = 'index.html'
}
