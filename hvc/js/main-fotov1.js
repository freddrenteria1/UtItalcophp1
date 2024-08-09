const API = "https://utitalco.com/hvc/server/";

const app = Vue.createApp({
    data() {
        return {
            tipodoc: '',
            doc: '',
            email: '',
            nombres: '',
            fnac: '',
            tel: '',
            tipodocumento: '',
            nombredoc: '',
            documento: '',
            arrayDatos: [],
            arrayDoc: [],
            foto: '',
            error: null,
            user: ''
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
                this.foto = data.infofoto.foto;


                this.tipodoc = this.arrayDatos.tipodoc
                this.doc = this.arrayDatos.doc
                this.email = this.arrayDatos.email
                this.nombres = this.arrayDatos.nombres
                this.fnac = this.arrayDatos.nacimiento
                this.tel = this.arrayDatos.tel

            } catch (error) {
                this.error = error;
                console.log(this.error);
            } finally {

            }
        },

        async encodeFileAsBase64URL(file) {
            return new Promise((resolve) => {
                const reader = new FileReader();
                reader.addEventListener('loadend', () => {
                    resolve(reader.result);
                });
                reader.readAsDataURL(file);
            });
        },

        async subir() {

                const datos = new FormData();

                var file = document.getElementById("file").files[0];

                const base64URL = await this.encodeFileAsBase64URL(file);

                datos.append("doc", this.doc);
                datos.append("archivo", base64URL);

                try {
                    const response = await fetch(API + "subirFoto.php", {
                        method: "POST",
                        body: datos,
                    });
                    console.log(response);
                    if (!response.ok) throw new Error("Erro de conexión");
                    const data = await response.json();
                    if (data == null) throw new Error("No se cargó la foto");
                    console.log(data);

                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        width: 300,
                        text: "Foto cargada...",
                        showConfirmButton: false,
                        timer: 2000,
                    }).then(() => {
                        this.tipodocumento = ''
                        this.nombredoc = ''
                        $('#file').val('')
                        this.cargarDatos()
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

        descargarFile(e) {
            //window.location.href = "https://utitalco.com/hvc/server/archivos/"+e;
            window.open('https://utitalco.com/hvc/server/archivos/' + e, '_blank');
        },

        async deleteFile(iddoc, titulodoc) {
            Swal.fire({
                title: 'Eliminar Documento',
                html: 'Desea eliminar ' + titulodoc + ' ?',
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: `Cancelar`,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {

                    this.borrarFile(iddoc)
                    
                }
            })
        },

        async borrarFile(iddoc) {
            const datos = new FormData();

            datos.append("doc", this.doc);
            datos.append("iddoc", iddoc);

            try {
                const response = await fetch(API + "borrarFile.php", {
                    method: "POST",
                    body: datos,
                });
                console.log(response);
                if (!response.ok) throw new Error("Erro de conexión");
                const data = await response.json();
                if (data == null) throw new Error("No se eliminó el documento");
                console.log(data);

                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    width: 200,
                    text: "Eliminado...",
                    showConfirmButton: false,
                    timer: 1500,
                }).then(() => {
                    this.cargarDatos()
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

        editarHV() {
            location = 'editarHV.html'
        },

        adjuntardoc() {
            location = 'documentos.html'
        },


        verHojaVida() {
            location = 'hojadevida.html'
        },

        cerrar() {
            sessionStorage.clear()
            location = 'index.html'
        },



    },
});

const mountedApp = app.mount("#app");