const API = "https://utitalco.com/hse/hitos/033/server/";
const DIRECTORIO = "https://utitalco.com/hse/hitos/033/archivos/";

const app = Vue.createApp({
  data() {
    return {
      search: null,
      result: null,
      error: null,
      codigo: null,
      id: null,
      entregable: null,
      elabora: null,
      estado: null,
      start: null,
      finish: null,
      observaciones: null,
      doc: null,
      docs: null,
      archivo: null,
      arrayHitos: [],
      user: null,
      listado: new Map(),
    };
  },

  created() {
    user = sessionStorage.getItem("userhitos");
    if (user == null) {
      this.login();
    } else {
      this.cargarDatos();
    }
  },

  methods: {
    async login() {
      await Swal.fire({
        title: "Login",
        html: `
                <input type="text" class="form-control" placeholder="Usuario" id="userhitos">
                <input type="password" class="form-control mt-2" placeholder="Contraseña" id="clave">
                `,
        focusConfirm: false,
        showCancelButton: true,
        allowOutsideClick: false,
      }).then((result) => {
        if (result.value) {
          var userhito = $("#userhitos").val();
          var clave = $("#clave").val();

          if (userhito == "oscar.caballero@utitalco.com" && clave == "13852164") {
            sessionStorage.setItem('userhitos',userhito)
            this.user = userhito
            this.cargarDatos();
          } else {
            
            if (userhito == "planeadorbca11@utitalco.com" && clave == "13722372") {
              sessionStorage.setItem('userhitos',userhito)
              this.user = userhito
              this.cargarDatos();

            }else{
              Swal.fire({
                position: "top-end",
                icon: "info",
                title: "Error en usuario o contraseña",
                showConfirmButton: false,
                timer: 1500,
              }).then(()=>{
                  location = "error.html"
              })

            }
          }
        }else{
          location = '../index.html'
        }
      });
    },

    async cargarDatos() {
      this.result = this.error = null;
      try {
        const response = await fetch(API + "verHitos.php");
        console.log(response);
        if (!response.ok) throw new Error("User not found");
        const data = await response.json();
        if (data == null) throw new Error("User not found");
        console.log(data);
        this.arrayHitos = data;
        console.log(this.arrayHitos)
        console.log(this.arrayHitos[0].codigo);
      } catch (error) {
        this.error = error;
        console.log(this.error);
      } finally {
        this.search = null;
      }
    },

    verFiles(id, doc) {
      console.log(doc);
      this.id = id;
      this.docs = JSON.parse(doc);
      console.log(JSON.parse(doc))
      var myModal = new bootstrap.Modal(
        document.getElementById("modalArchivos")
      );
      myModal.show();
    },

    async borrarFile(doc) {
      
      var arrayItemSel = this.docs;

      for (var i = 0, len = arrayItemSel.length; i < len; i++) {
        if (arrayItemSel[i].doc === doc) {
              index = i;
              break;
          }
      }

      if (index !== -1) {
          arrayItemSel.splice(index, 1);
      }

      this.docs = arrayItemSel;

      console.log(this.docs)

      const datos = new FormData();
      datos.append("archivo", JSON.stringify(arrayItemSel));
      datos.append("id", this.id);

      try {
        const response = await fetch(API + "borrarFile.php", {
          method: "POST",
          body: datos,
        });
        console.log(response);
        if (!response.ok) throw new Error("User not found");
        const data = await response.json();
        if (data == null) throw new Error("User not found");
        console.log(data);

        Swal.fire({
          position: "top-end",
          icon: "success",
          title: "Documento Borrado",
          showConfirmButton: false,
          timer: 1500,
        });

        this.cargarDatos();
      } catch (error) {
        this.error = error;
        console.log(this.error);
      } finally {
        this.search = null;
      }
    },

    agregar() {
      this.codigo =
        this.entregable =
        this.elabora =
        this.start =
        this.finish =
        this.error =
          null;
      var myModal = new bootstrap.Modal(
        document.getElementById("modalAgregar")
      );
      myModal.show();
    },

    agregarFile(id) {
      this.id = id;
      this.error = null;
      var myModal = new bootstrap.Modal(document.getElementById("modalFile"));
      myModal.show();
    },

    agregarObs(id, observaciones) {
      this.observaciones = null;

      this.id = id;
      this.observaciones = observaciones;

      var myModal = new bootstrap.Modal(document.getElementById("modalObs"));
      myModal.show();
    },

    abrirFile(doc) {
      window.open(DIRECTORIO + doc, "_blank");
    },

    editar(id, codigo, entregable, elabora, estado, start, finish) {
      this.codigo = codigo;
      this.id = id;
      this.entregable = entregable;
      this.elabora = elabora;
      this.estado = estado;
      this.start = start;
      this.finish = finish;

      var myModal = new bootstrap.Modal(document.getElementById("modalEditar"));
      myModal.show();
    },

    async borrar(id, entregable) {
      await Swal.fire({
        title: "Borrar",
        html: `
                ¿Desea eliminar el registro del entregable ${entregable} ?
                `,
        focusConfirm: false,
        showCancelButton: true,
      }).then((result) => {
        if (result.value) {
          this.Eliminar(id);

          Swal.fire("¡Actualizado!", "Item Borrado.", "success");
        }
      });
    },

    async subirFile() {
      this.cargando()
      var file = document.getElementById("file").files[0];

      const datos = new FormData();

      datos.append("archivo", file);
      datos.append("id", this.id);

      try {
        const response = await fetch(API + "subirFile.php", {
          method: "POST",
          body: datos,
        });
        console.log(response);
        
        const data = await response.json();
        // if (data == null) throw new Error("User not found");
        console.log(data);

        Swal.fire({
          position: "top-end",
          icon: "success",
          title: "Documento Cargado",
          showConfirmButton: false,
          timer: 1500,
        });

        this.cargarDatos();
      } catch (error) {
        this.error = error;
        console.log(this.error);
      } finally {
        this.search = null;
      }
    },

    async Eliminar(id) {
      const datos = new FormData();

      datos.append("id", id);

      try {
        const response = await fetch(API + "eliminar.php", {
          method: "POST",
          body: datos,
        });
        console.log(response);
        if (!response.ok) throw new Error("User not found");
        const data = await response.json();
        if (data == null) throw new Error("User not found");
        console.log(data);
        this.cargarDatos();
      } catch (error) {
        this.error = error;
        console.log(this.error);
      } finally {
        this.search = null;
      }
    },

    async guardar() {
      const datos = new FormData();

      datos.append("codigo", this.codigo);
      datos.append("entregable", this.entregable);
      datos.append("elabora", this.elabora);
      datos.append("start", this.start);
      datos.append("finish", this.finish);

      try {
        const response = await fetch(API + "guardar.php", {
          method: "POST",
          body: datos,
        });
        console.log(response);
        if (!response.ok) throw new Error("User not found");
        const data = await response.json();
        if (data == null) throw new Error("User not found");
        console.log(data);
        this.cargarDatos();
      } catch (error) {
        this.error = error;
        console.log(this.error);
      } finally {
        this.search = null;
      }
    },

    async actualizar() {
      const datos = new FormData();

      datos.append("id", this.id);
      datos.append("codigo", this.codigo);
      datos.append("entregable", this.entregable);
      datos.append("elabora", this.elabora);
      datos.append("start", this.start);
      datos.append("finish", this.finish);
      datos.append("estado", this.estado);

      try {
        const response = await fetch(API + "actualizar.php", {
          method: "POST",
          body: datos,
        });
        console.log(response);
        if (!response.ok) throw new Error("User not found");
        const data = await response.json();
        if (data == null) throw new Error("User not found");
        console.log(data);
        this.cargarDatos();
      } catch (error) {
        this.error = error;
        console.log(this.error);
      } finally {
        this.search = null;
      }
    },

    cargando() {
      let timerInterval
      Swal.fire({
          title: 'Subiendo archivo...!',
          timer: 300000,
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

    async guardarObs() {
      const datos = new FormData();

      datos.append("observacion", this.observaciones);
      datos.append("id", this.id);

      try {
        const response = await fetch(API + "guardarObs.php", {
          method: "POST",
          body: datos,
        });
        console.log(response);
        if (!response.ok) throw new Error("User not found");
        const data = await response.json();
        if (data == null) throw new Error("User not found");
        console.log(data);
        this.cargarDatos();
      } catch (error) {
        this.error = error;
        console.log(this.error);
      } finally {
        this.search = null;
      }
    },
  },
});

const mountedApp = app.mount("#app");
