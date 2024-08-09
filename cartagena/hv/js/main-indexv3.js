const API = "https://utitalco.com/cartagena/hv/server/";

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

        registro(){
            location = 'registro.html'
        },



    },
});

const mountedApp = app.mount("#app");