const API = "https://utitalco.com/hvc/server/";


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

        async cargarDatos() {
            this.error = null;
            this.userhv = sessionStorage.getItem('userhv')

            if(this.userhv == null){
                location = 'index.html'
            }

            const datos = new FormData();                  
            datos.append("uservcf", this.user);

            try {
                const response = await fetch(API + "cargarDatosPersonal.php", {
                    method: "POST",
                    body: datos,
                });
                console.log(response);

                if (!response.ok) throw new Error("Erorr de conexión");
                const data = await response.json();
                if (data == null) throw new Error("Usuario no encontrado");
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
                
                

                
                 
            } catch (error) {
                this.error = error;
                console.log(this.error);
            } finally {
                
            }
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
        }




    },
});

const mountedApp = app.mount("#app");