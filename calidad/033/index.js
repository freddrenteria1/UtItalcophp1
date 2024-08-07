
var odsq = null
var url = "https://utitalco.com/calidad/033/server/";

var usercal = sessionStorage.getItem('usercal');

function ingresar(){
    var usercali = $('#usercalidad').val()
    var claveecp = $('#clavecalidad').val()
    var odssel = '033'

    if(usercali.includes('@')){
        Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Oops...',
                    html: `El nombre de usuario no debe contener el @ <br> El usuario es la parte inicial de tu correo antes del @ `,
                    showConfirmButton: false,
                    timer: 5000
                })
    }else{
        cargando() 
        $.post(url + 'vingresoitalco.php', {
            user: usercali,
            clave: claveecp
        },
        function (resp) {
            console.log(resp)
            if (resp.msn == 'Ok') {

                if(resp.info.tipo == 'ecopetrol'){
                    sessionStorage.setItem('usercal', usercali)
                    sessionStorage.setItem('tipouser', resp.info.tipo)
                    sessionStorage.setItem('datosuserqaqc', JSON.stringify(resp.info))
                    localStorage.setItem('odsq', odssel)

                    location = 'menup.html'
                }else{
                    sessionStorage.setItem('usercal', usercali)
                    sessionStorage.setItem('tipouser', resp.info.tipo)
                    sessionStorage.setItem('datosuserqaqc', JSON.stringify(resp.info))
                    localStorage.setItem('odsq', odssel)

                    location = 'menup.html'
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
    
    
}

//cargarListado()

// if(usercal == null){
//     location = 'login.html'
// }

function check(e) {
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }

    // Patrón de entrada, en este caso solo acepta numeros y letras
    patron = /[A-Za-z0-9-_.]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

function veriAdmin() {
    Swal.fire({
        title: 'Verificar Permisos',
        html: `<input type="password" id="claveadmin" class="form-control" placeholder="Clave de acceso">
        `,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar'
    }).then((result) => {
        var claveadmin = $('#claveadmin').val()
        $.post(url + 'verificarAdmin.php', {
                clave: claveadmin
            },
            function (resp) {
                if (resp.msn == 'Ok') {
                    if (resp.nivel == '1') {
                        sessionStorage.setItem('usercalidad', resp.user)
                        location = 'admin.html';
                    } else {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Acceso denegado!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Acceso denegado!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            })
    })
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
            <hr>
            <center><a href="#" onclick="registro()" >Registrarse</a>

                
            </div>
        `,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar'
    }).then((result) => {
        if (result.isConfirmed) {


        }
    })
}

function informe() {
    location = 'informerca.html'
}


function cargando() {
    let timerInterval
    Swal.fire({
        title: 'Verificando credenciales!',
        html: 'Un momento por favor...',
        timer: 45000,
        timerProgressBar: true,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading()
            timerInterval = setInterval(() => {

            }, 1000)
        },
        willClose: () => {
            clearInterval(timerInterval)
        }
    }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {

        }
    })

}

function registro() {
    Swal.fire({
        title: 'Registro Usuario',
        html: `Digite Email y contraseña <br><br>
            <div style="width: 50%; margin: auto;">
                Nombres y Apellidos <br>
                <input type="text" class="form-control" id="nombres">
                <br>
                Email <br>
                <input type="text" class="form-control" id="emailr">
                <br>
                Clave de acceso <br>
                <input type="password" class="form-control" id="claver"> <br>
                Empresa <br>
                <input type="text" class="form-control" id="empresa">
                <br>
                
                 

            </div>
        `,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar'
    }).then((result) => {
        if (result.isConfirmed) {

            var nombres = $('#nombres').val()
            var empresa = $('#empresa').val()
            var email = $('#emailr').val()
            var clave = $('#claver').val()
            var odssel = '033'
             
            cargando()

            $.post(url + 'gregistro.php', {
                    nombres: nombres,
                    empresa: empresa,
                    user: email,
                    clave: clave
                },
                function (resp) {

                    

                    if (resp == 'Ok') {

                        Swal.fire({
                            position: 'top-end',
                            icon: 'info',
                            title: 'Registro...',
                            text: 'Registro creado y en proceso de activación de usuario.  Por correo electrónico se le notificará una vez esté activo en la plataforma...!',
                            showConfirmButton: false,
                            timer: 3500
                        })
                         

                    }  
                })


        }
    })
}

  
