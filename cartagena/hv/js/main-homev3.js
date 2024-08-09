const API = "https://utitalco.com/cartagena/hv/server/";

const app = Vue.createApp({
    data() {
        return {
            tipodoc: '',
            doc: '',
            email: '',
            cont1: '',
            cont2: '',
            nombres: '',
            fnac: '',
            tel: '',
            arrayDatos: [],
            error: null,
            user: '',
            msn: ''
        };
    },

    created() {
        this.cargarDatos()
    },

    methods: {

        async cargarDatos() {
            this.error = null;
            this.user = sessionStorage.getItem('useritalco')

            if (this.user == null) {
                location = 'index.html'
            }

            const datos = new FormData();
            datos.append("uservcf", this.user);

            try {
                const response = await fetch(API + "cargarDatos.php", {
                    method: "POST",
                    body: datos,
                });
                console.log(response);

                if (!response.ok) throw new Error("Erorr de conexión");
                const data = await response.json();
                if (data == null) throw new Error("Usuario no encontrado");
                console.log(data);

                this.arrayDatos = data.info;

            } catch (error) {
                this.error = error;
                console.log(this.error);
            } finally {

            }
        },


        editarHV() {
            location = 'editarHV.html'
        },

        adjuntardoc() {
            location = 'documentos.html'
        },

        verHojaVida() {
            location = 'hojadevida.html'
        },

        async guardar() {
            

            if (this.tipodoc && this.doc && this.email && this.cont1 && this.cont2 && this.nombres && this.fnac && this.tel != '') {

                if (this.cont1 == this.cont2) {

                    const datos = new FormData();
                    datos.append("tipodoc", this.tipodoc);
                    datos.append("doc", this.doc);
                    datos.append("email", this.email);
                    datos.append("cont1", this.cont1);
                    datos.append("nombres", this.nombres);
                    datos.append("fnac", this.fnac);
                    datos.append("tel", this.tel);

                    try {
                        const response = await fetch(API + "guardar.php", {
                            method: "POST",
                            body: datos,
                        });
                        console.log(response);
                        if (!response.ok) throw new Error("Erro de conexión");
                        const data = await response.json();
                        if (data == null) throw new Error("No se guardó la información");
                        console.log(data);
                        sessionStorage.setItem('useritalco', this.email)
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            text: "Registro correcto...",
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
                        text: "Contraseñas no concuerdan...",
                        showConfirmButton: false,
                        timer: 2000,
                    });
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

        cerrar() {
            sessionStorage.clear()
            location = 'index.html'
        },

        ayuda() {
            Swal.fire({
                title: 'Ayuda',
                html: `
                <textarea id="mensaje" class="form-control" style="width:  100%; height: 150px;" placeholder="Enviar un mensaje..."></textarea>
                `,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Enviar',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {

                    this.msn = $('#mensaje').val()
                    this.enviarMensaje()

                } 
            })
        },

        async enviarMensaje(){
            
                    const datos = new FormData();
                    datos.append("email", this.arrayDatos.email);
                    datos.append("nombres", this.arrayDatos.nombres);
                    datos.append("mensaje", this.msn);

                    try {
                        const response = await fetch(API + "enviarMensaje.php", {
                            method: "POST",
                            body: datos,
                        });
                        console.log(response);
                        if (!response.ok) throw new Error("Erro de conexión");
                        const data = await response.json();
                        if (data == null) throw new Error("No se guardó la información");
                        console.log(data);
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            text: "Mensaje enviado a soporte técnico, muy pronto tendrá una respuesta en su correo electrónico.",
                            showConfirmButton: false,
                            timer: 3000,
                        })
                    } catch (error) {
                         
                    } finally {
                        // this.search = null;
                    }

        }



    },
});

const mountedApp = app.mount("#app");