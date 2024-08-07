const API = "https://utitalco.com/hv/server/";

const app = Vue.createApp({
    data() {
        return {
            doc: '',
            cont: '',
            error:  null,
            data: null
        };
    },

    created() {
        
    },

    methods: {

       

        async verificar() {
            

            if (this.doc && this.cont != '') {
                    const datos = new FormData();

                    datos.append("doc", this.doc);
                    datos.append("cont", this.cont);

                    try {
                        const response = await fetch(API + "verificar.php", {
                            method: "POST",
                            body: datos,
                        });
                        console.log(response);
                        if (!response.ok) throw new Error("Error de conexión");
                        const data = await response.json();
                        if (data.msn == 'Error') throw new Error("Usuario no registrado y/o error en contraseña");
                        console.log(data);

                        sessionStorage.setItem('useritalco', this.doc)
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            text: "Login correcto...",
                            showConfirmButton: false,
                            timer: 2000,
                        }).then(() => {

                            location = 'home.html'
                        })
                    } catch (error) {
                        this.error = error;
                        console.log(this.error);
                        Swal.fire({
                            position: "top-end",
                            icon: "info",
                            text: error,
                            showConfirmButton: false,
                            timer: 1500,
                        })
                    } finally {
                        // this.search = null;
                    }

                 

            } else {
                Swal.fire({
                    position: "top-end",
                    icon: "info",
                    text: "Por favor diligencie todos los campos...",
                    showConfirmButton: false,
                    timer: 2000,
                });
            }


        },

        async recuperar() {
            
            Swal.fire({
                title: 'Recuperar contraseña',
                html: `
                Número de Documento sin puntos
                <input type="number" class="form-control mt-2" id="cedtrab"> 
                `,
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    this.doc = $('#cedtrab').val()
                    if(this.doc != ""){

                        this.enviarDatos()

                        Swal.fire('Ayuda!', 'Se enviarán los datos de acceso al correo electrónico registrado con este documento...', 'success')
                    }else{
                        Swal.fire('Info!', 'Agregue un número de documento', 'info')
                    }
                } 
              })


        },

        async enviarDatos(){
            const datos = new FormData();

            datos.append("doc", this.doc);

            try {
                const response = await fetch(API + "verificarDatos.php", {
                    method: "POST",
                    body: datos,
                });
                console.log(response);
                if (!response.ok) throw new Error("Error de conexión");
                const data = await response.json();
                if (data.msn == 'Error') throw new Error("Usuario no registrado y/o error en contraseña");
                console.log(data);

                 
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    text: "Se ha enviado la contraseña al correo registrado con este documento...",
                    showConfirmButton: false,
                    timer: 5000,
                }).then(() => {

                    
                })
            } catch (error) {
                this.error = error;
                console.log(this.error);
                Swal.fire({
                    position: "top-end",
                    icon: "info",
                    text: error,
                    showConfirmButton: false,
                    timer: 1500,
                })
            } finally {
                // this.search = null;
            }
        },

        registro(){
            location = 'registro.html'
        },



    },
});

const mountedApp = app.mount("#app");