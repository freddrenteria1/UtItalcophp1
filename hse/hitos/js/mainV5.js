const API = "https://utitalco.com/hse/hitos/server/";
const DIRECTORIO = "https://utitalco.com/hse/hitos/archivos/";

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
      plan: null,
      eje: null,
      rev: null,
      apro: null,
      avance: null,
      listado: new Map(),
    };
  },

  created() {
    user = sessionStorage.getItem("userhitos");

    this.cargarDatos();

  },

  mounted() {
    this.tabla()
  },

  methods: {

    tabla() {
      
    },

    async login() {
      await Swal.fire({
        title: "Login",
        html: `
                <input type="text" class="form-control" placeholder="Usuario" id="userhitos">
                <input type="password" class="form-control mt-2" placeholder="Contraseña" id="clave">
                `,
        focusConfirm: false,
        showCancelButton: true,
      }).then((result) => {
        if (result.value) {
          var userhito = $("#userhitos").val();
          var clave = $("#clave").val();

          if (userhito == "planeadorbca11" && clave == "planeadorbca11*") {
            sessionStorage.setItem("userhitos", userhito);
            this.user = userhito;
            this.cargarDatos();
          } else {
            Swal.fire({
              position: "top-end",
              icon: "info",
              title: "Error en usuario o contraseña",
              showConfirmButton: false,
              timer: 1500,
            }).then(() => {
              location = "error.html";
            });
          }
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



        plan = eje = rev = apro = 0;

        for (var i = 0; i < data.length; i++) {
          if (data[i].estado == "Programado") {
            plan++;
          }
          if (data[i].estado == "Elaborado") {
            eje++;
          }
          if (data[i].estado == "Revisado") {
            rev++;
          }
          if (data[i].estado == "Aprobado") {
            apro++;
          }
        }

        avance = (eje / plan);

        this.plan = plan;
        this.eje = eje;
        this.rev = rev;
        this.apro = apro;
        this.avance = avance.toFixed(2);

        this.cargarGraficas();

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
        })

        console.log(this.arrayHitos[0].codigo);

      } catch (error) {
        this.error = error;
        console.log(this.error);
      } finally {
        this.search = null;
      }
    },

    cargarGraficas() {
      Highcharts.chart("fig", {
        colors: [
          "#01005e",
          "#00c901",
          "#efd520",
          "#bfbfbf",
          "#537b35",
          "#a4c639",
          "#537b35",
          "#a4c639",
          "#537b35",
        ],
        credits: {
          enabled: false,
        },
        chart: {
          type: "column",
        },
        title: {
          text: "<b>SEGUIMIENTO Y CONTROL</b>",
        },

        xAxis: {
          categories: ["CANT"],
          crosshair: true,
        },
        yAxis: {
          min: 0,
          title: {
            text: "Cant ",
          },
        },
        tooltip: {
          headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
          pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:f}</b></td></tr>',
          footerFormat: "</table>",
          shared: true,
          useHTML: true,
        },
        plotOptions: {
          column: {
            pointPadding: 0.2,
            borderWidth: 0,
            dataLabels: {
              enabled: true,
            },
          },
        },

        series: [{
            name: "Actividades Planeadas",
            data: [this.plan],
          },
          {
            name: "Actividades Ejecutadas",
            data: [this.eje],
          },
          {
            name: "Actividades en Revisión",
            data: [this.rev],
          },
          {
            name: "Actividades Aprobadas",
            data: [this.apro],
          },
        ],
      });



    },

    verFiles(id, doc) {
      console.log(doc);
      this.id = id;
      this.docs = JSON.parse(doc);
      var myModal = new bootstrap.Modal(
        document.getElementById("modalArchivos")
      );
      myModal.show();
    },

    async borrarFile(doc) {
      const datos = new FormData();
      datos.append("archivo", doc);
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
        if (!response.ok) throw new Error("User not found");
        const data = await response.json();
        if (data == null) throw new Error("User not found");
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