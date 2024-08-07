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
            tel: '',
            arrayDatos: [],
            arrayPerfil: [],
            arrayDatosPersonales: [],
            error:  null,
            userhv: ''
        };
    },

    created() {
        this.cargando()
        this.cargarDatos()
    },

    methods: {

        cargarDatos() {
            this.error = null;
            this.userhv = sessionStorage.getItem('userhv')

            if(this.userhv == null){
                location = 'index.html'
            }

            const datos = new FormData();                  
            datos.append("uservcf", this.user);

             
            axios.post(API + "cargarDatosPersonal_1.php", {}).then(response => {

                data = response.data


               
                console.log(data);

                this.arrayDatos = data;

                this.$nextTick(() => {
                    $('#tblData').DataTable({
                      "language": {
                        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                      },
                      dom: 'Bfrtip',
                      buttons: [
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5'
                      ]
                    });
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        showConfirmButton: false,
                        width: 300,
                        timer: 500,
                    })
                  })
                
                }) 

                
                 
             
        },
        
        descargarHV() {
             
        },

        async open(e){
            sessionStorage.setItem('docuser', e)
            location = 'hojadevida.html';
        },
       

        cerrar(){
            sessionStorage.clear()
            location = 'index.html'
        },

        cargando() {
            let timerInterval
            Swal.fire({
                title: 'Procesando datos...!',
                timer: 20000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                        // b.textContent = Swal.getTimerLeft()
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    console.log('I was closed by the timer')
                }
            })
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