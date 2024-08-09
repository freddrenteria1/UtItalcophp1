const API = "https://utitalco.com/hv/server/";

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
            tel: ''
        };
    },

    created() {

    },

    methods: {

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
                        sessionStorage.setItem('useritalco', this.doc)
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            text: "Registro correcto...",
                            showConfirmButton: false,
                            timer: 2000,
                        }).then(()=>{
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



    },
});

const mountedApp = app.mount("#app");