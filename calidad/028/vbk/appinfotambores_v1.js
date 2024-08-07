const API = "https://utitalco.com/calidad/028/vbk/server/";

const app = Vue.createApp({
  data() {
    return {
      odsq: null,
      esp: null,
      fam: null,
      arrayTambores: [],
      listado: new Map(),
    };
  },

  created() {
    if (screen.width <= 1366) {
        document.body.style.zoom = "60%";
    } else {
        document.body.style.zoom = "80%";
    }

    this.odsq = localStorage.getItem('odsq');
    this.esp = sessionStorage.getItem('espdetalles')
    this.fam = sessionStorage.getItem('famdetalles')

    this.cargarDatos();
    
  },

  methods: {
     

    async cargarDatos() {
         
      this.result = this.error = null;
      try {
        const response = await fetch(API + "consultaEstaticos_Tambores.php");
        console.log(response);
        if (!response.ok) throw new Error("User not found");
        const data = await response.json();
        if (data == null) throw new Error("User not found");
        console.log(data);

        this.arrayTambores = data.tambores;
         
      } catch (error) {
        this.error = error;
        console.log(this.error);
      } finally {
        this.search = null;
      }
    },

    checkEstado(e){
        if(e=='PTE'){
            return true
        }else{
            return false
        }
    },

    checkOk(e){
        if(e=='OK'){
            return true
        }else{
            return false
        }
    }, 

    volver(){
        location = 'menucontrolfirmas.html'
    }


   
  },
});

const mountedApp = app.mount("#app");
