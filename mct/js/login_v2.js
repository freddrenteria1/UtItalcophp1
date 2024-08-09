var url = "https://utitalco.com/mct/server/";

function login() {
    var doc = $("#doc").val();
    var clave = $("#clave").val();

    if (doc && clave != "") {
        if(doc == clave){
            $.post(
                url + "ingreso.php", {
                    doc: doc,
                    clave: clave,
                },
                function (resp) {
                    if (resp.msn == "Ok") {
                        localStorage.setItem('datosuser',JSON.stringify(resp))
                        sessionStorage.setItem("userfase", doc);
                        sessionStorage.setItem("nombres", resp.nombres);
                        sessionStorage.setItem('estado',resp.estado)
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

        }else{
            Swal.fire({
                position: "top-end",
                icon: "info",
                title: "Oops...",
                text: "Error en usuario o contraseña...!",
                showConfirmButton: false,
                timer: 1500,
            });
        }
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