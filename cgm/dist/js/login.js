


var server = 'https://utitalco.com/cgm/server/'

function mensaje(title, msn){
    $.toast({
        heading: title,
        text: msn,
        position: 'top-right',
        loaderBg:'#e69a2a',
        icon: 'info',
        hideAfter: 2500, 
        stack: 6
    });
}


function verificar(){
    console.log('Verificar...')
    var usermat = $('#usermat').val()
    var clavemat = $('#clavemat').val()

    $.post(server + 'verificaruser.php', {usermat:usermat, clavemat:clavemat},
    function(resp){
        console.log(resp)
        if(resp.msn == 'Error'){
            Swal.fire({
                position: 'top-end',
                icon: 'info',
                html: 'Usuario y/o contraseña incorrecta...',
                showConfirmButton: false,
                timer: 1500
              })
        }else{
            sessionStorage.setItem('usermat',usermat)
            sessionStorage.setItem('tipousermat',resp.tipo)
            sessionStorage.setItem('ods','026 - PARADA GENERAL UOP I')
            location = 'index.html'
        }
    })
}