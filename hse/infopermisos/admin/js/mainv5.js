const server = "https://utitalco.com/hse/infopermisos/server/";
document.body.style.zoom = "67%";

var arrayDatos = []
        var arrayTabla = []
        var arrayResp = []
        var html = ''

        var arrayTurnos = []
        var arrayPfrio = []
        var arrayPcaliente = []
        var arrayPelectrico = []
        var arraytotalp = []
        var arrayMraml = []
        var arrayMramm = []
        var arrayMramh = []
        var arrayMramvh = []
        var arraytotalmatriz = []

        var arrayCca1 = []
        var arrayCca2 = []
        var arrayCca3 = []
        var arrayCca5 = []
        var arrayCca6 = []
        var arrayCca7 = []
        var arraySsas = []
        var arraySsaes = []
        var arraytotalca = []

        var arrayPpra = []
        var arrayPprc = []
        var arrayPprg = []
        var arraytotalpr = []

        var arrayCca1n = []
        var arrayCca2n = []
        var arrayCca3n = []
        var arrayCca5n = []
        var arrayCca6n = []
        var arrayCca7n = []
        var arraySsasn = []
        var arraySsaesn = []
        var arraytotalcan = []

        var arrayPpran = []
        var arrayPprcn = []
        var arrayPprgn = []
        var arraytotalprn = []

        

        var arrayPpnuevos = []
        var arrayPprevalidados = []
        var arrayPpcerrados = []


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

          if (userhito == "u2100@utitalco.com" && clave == "ItalcoHse2023") {
            sessionStorage.setItem('userhitos',userhito)
            this.user = userhito
            this.cargarDatos();
          } else {
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
        }else{
          location = '../index.html'
        }
      });
    },

         

    async cargarDatos() {
       

      $.post(server+'informePermisos.php', {
        ods: '030'
    },


    function(resp) {
        arrayDatos = resp
        console.log(resp.tabla)
        arrayTabla = resp.tabla

        for (var i = 0; i < arrayDatos.turnos.length; i++) {
            arrayTurnos.push(arrayDatos.turnos[i].turno)
        }

        for (var i = 0; i < arrayDatos.datos.length; i++) {
            arrayPfrio.push(arrayDatos.datos[i].pfrio)
            arrayPcaliente.push(arrayDatos.datos[i].pcaliente)
            arrayPelectrico.push(arrayDatos.datos[i].pelectrico)
            arraytotalp.push(arrayDatos.datos[i].totalp)

            arrayMraml.push(arrayDatos.datos[i].raml)
            arrayMramm.push(arrayDatos.datos[i].ramm)
            arrayMramh.push(arrayDatos.datos[i].ramh)
            arrayMramvh.push(arrayDatos.datos[i].ramvh)
            arraytotalmatriz.push(arrayDatos.datos[i].totalmatriz)

            arrayCca1.push(arrayDatos.datos[i].ca1)
            arrayCca2.push(arrayDatos.datos[i].ca2)
            arrayCca3.push(arrayDatos.datos[i].ca3)
            arrayCca5.push(arrayDatos.datos[i].ca5)
            arrayCca6.push(arrayDatos.datos[i].ca6)
            arrayCca7.push(arrayDatos.datos[i].ca7)
            arraySsas.push(arrayDatos.datos[i].sas)
            arraySsaes.push(arrayDatos.datos[i].saes)
            arraytotalca.push(arrayDatos.datos[i].totalca)

            arrayPpra.push(arrayDatos.datos[i].pra)
            arrayPprc.push(arrayDatos.datos[i].prc)
            arrayPprg.push(arrayDatos.datos[i].prg)
            arraytotalpr.push(arrayDatos.datos[i].totalpr)

            arrayCca1n.push(arrayDatos.datos[i].ca1n)
            arrayCca2n.push(arrayDatos.datos[i].ca2n)
            arrayCca3n.push(arrayDatos.datos[i].ca3n)
            arrayCca5n.push(arrayDatos.datos[i].ca5n)
            arrayCca6n.push(arrayDatos.datos[i].ca6n)
            arrayCca7n.push(arrayDatos.datos[i].ca7n)
            arraySsasn.push(arrayDatos.datos[i].sasn)
            arraySsaesn.push(arrayDatos.datos[i].saesn)
            arraytotalcan.push(arrayDatos.datos[i].totalcan)

            arrayPpran.push(arrayDatos.datos[i].pran)
            arrayPprcn.push(arrayDatos.datos[i].prcn)
            arrayPprgn.push(arrayDatos.datos[i].prgn)
            arraytotalprn.push(arrayDatos.datos[i].totalprn)

             

            arrayPpnuevos.push(arrayDatos.datos[i].pnuevos)
            arrayPprevalidados.push(arrayDatos.datos[i].prevalidados)
            arrayPpcerrados.push(arrayDatos.datos[i].pcerrados)


        }



        

        html = ''
        for (var i = 0; i < arrayTabla.length; i++) {
            html += `
        <tr>
            <td style="width: 90px;">
                ${arrayTabla[i].num}
            </td>
            <td style="text-align: center;  width: 30px;">
                ${arrayTabla[i].pfrio == 0 ? "" : arrayTabla[i].pfrio}
            </td>
            <td  style="text-align: center;  width: 30px;">
                ${arrayTabla[i].pcaliente == 0 ? "" : arrayTabla[i].pcaliente} 
            </td>
            <td  style="text-align: center;  width: 30px;">
                ${arrayTabla[i].pelectrico == 0 ? "" : arrayTabla[i].pelectrico}
            </td>
            <td style="width: 400px;">
                ${arrayTabla[i].actividad}
            </td>
            <td style="width: 200px;">
                ${arrayTabla[i].especialidad}
            </td>
            <td style="width: 200px;">
                ${arrayTabla[i].supervisor}
            </td>
            <td style="width: 150px;">
                ${arrayTabla[i].area}
            </td>
            <td style="width: 150px;">
                ${arrayTabla[i].equipo}
            </td>
            <td style="width: 150px;">
                ${arrayTabla[i].planta}
            </td>
             
            <td style="text-align: center; width: 30px;">
                ${arrayTabla[i].raml == 0 ? "" : arrayTabla[i].raml}
            </td>
            <td style="text-align: center; width: 30px;">
                ${arrayTabla[i].ramm == 0 ? "" : arrayTabla[i].ramm}
            </td>
            <td style="text-align: center; width: 30px;">
                ${arrayTabla[i].ramh == 0 ? "" : arrayTabla[i].ramh}
            </td>
            <td style="text-align: center; width: 30px;">
                ${arrayTabla[i].ramvh == 0 ? "" : arrayTabla[i].ramvh}
            </td>
            <td style="text-align: center; width: 30px;">
                1
            </td>
            <td style="text-align: center; width: 30px;">
                ${arrayTabla[i].ca1 == 0 ? "" : arrayTabla[i].ca1}
            </td>
            <td style="text-align: center; width: 30px;">
                ${arrayTabla[i].ca2 == 0 ? "" : arrayTabla[i].ca2}
            </td>
            <td style="text-align: center; width: 30px;">
                ${arrayTabla[i].ca3 == 0 ? "" : arrayTabla[i].ca3}
            </td>
            <td style="text-align: center; width: 30px;">
                ${arrayTabla[i].ca5 == 0 ? "" : arrayTabla[i].ca5}
            </td>
            <td style="text-align: center; width: 30px;">
                ${arrayTabla[i].ca6 == 0 ? "" : arrayTabla[i].ca6}
            </td>
            <td style="text-align: center; width: 30px;">
                ${arrayTabla[i].ca7 == 0 ? "" : arrayTabla[i].ca7}
            </td>
            <td style="text-align: center; width: 30px;">
                ${arrayTabla[i].sas == 0 ? "" : arrayTabla[i].sas}
            </td>
            <td style="text-align: center; width: 30px;">
                ${arrayTabla[i].saes == 0 ? "" : arrayTabla[i].saes}
            </td>
            <td style="text-align: center; width: 30px;">
                ${arrayTabla[i].pra == 0 ? "" : arrayTabla[i].pra}
            </td>
            <td style="text-align: center; width: 30px;">
                ${arrayTabla[i].prc == 0 ? "" : arrayTabla[i].prc}
            </td>
            <td style="text-align: center; width: 30px;">
                ${arrayTabla[i].prg == 0 ? "" : arrayTabla[i].prg}
            </td>
            <td style="text-align: center; width: 30px;">
                ${arrayTabla[i].cvias == 0 ? "" : arrayTabla[i].cvias}
            </td>
            <td style="text-align: center; width: 30px;">
                ${arrayTabla[i].pizaje == 0 ? "" : arrayTabla[i].pizaje}
            </td>
            <td style="text-align: center; width: 30px;">
                ${arrayTabla[i].agua == 0 ? "" : arrayTabla[i].agua}
            </td>
           
        </tr>
        `
        }
        $('#datostabla').html(html)



         //GRAFICA PERMISOS DE TRABAJOS ELABORADOS 
      Highcharts.chart('figpertrabaesp2', {
        colors: ['#1f4e78', '#00c901', '#efd520', '#bfbfbf', '#537b35', '#a4c639', '#537b35', '#a4c639', '#537b35'],
        credits: {
            enabled: false
        },
        chart: {
            type: 'column'
        },
        title: {
            text: '<b>PERMISOS ELABORADOS ACUMULADOS</b>'
        },

        xAxis: {
            categories: arrayTurnos,
            crosshair: true,
            labels: {
                style: {
                    fontSize: '18px',
                }
            }
        },

        yAxis: {
            min: 0,
            title: {
                text: 'Cant',
            },
             
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    style: {
                        fontWeight: 'bold',
                        fontSize: '24px'
                    }
                }
                
             
            }
        },
        series: [{
            name: 'P. FRÍO',
            data: arrayPfrio,
            
        }, {
            name: 'P. CALIENTE',
            data: arrayPcaliente
        }, {
            name: 'P. ELÉCTRICO',
            data: arrayPelectrico
        }, {
            name: 'TOTAL',
            data: arraytotalp
        }]
    });


    Highcharts.chart('figmatrizram', {
        colors: ['#00c901', '#1f4e78', '#efd520', '#bfbfbf', '#537b35', '#a4c639', '#537b35', '#a4c639', '#537b35'],
        credits: {
            enabled: false
        },
        chart: {
            type: 'column'
        },
        title: {
            text: '<b>MATRIZ RAM PERMISOS ELABORADOS</b>'
        },

        xAxis: {
            categories: arrayTurnos,
            crosshair: true
        },

        yAxis: {
            min: 0,
            title: {
                text: 'Cant'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    style: {
                        fontWeight: 'bold',
                        fontSize: '24px'
                    }
                }
            }
        },
        series: [
        {
            name: 'BAJO',
            data: arrayMraml
        },
        {
            name: 'MEDIO',
            data: arrayMramm
        }, {
            name: 'ALTO',
            data: arrayMramh
        }, {
            name: 'MUY ALTO',
            data: arrayMramvh
        }, {
            name: 'TOTAL',
            data: arraytotalmatriz
        }]
    });


    Highcharts.chart('figcertificados', {
        colors: ['#00c901', '#1f4e78', '#efd520', '#bfbfbf', '#537b35', '#a4c639', '#537b35', '#a4c639', '#537b35'],
        credits: {
            enabled: false
        },
        chart: {
            type: 'column'
        },
        title: {
            text: '<b>CERTIFICADOS DE APOYO ELABORADOS</b>'
        },

        xAxis: {
            categories: arrayTurnos,
            crosshair: true
        },

        yAxis: {
            min: 0,
            title: {
                text: 'Cant'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    style: {
                        fontWeight: 'bold',
                        fontSize: '24px'
                    }
                }
            }
        },
        series: [{
            name: 'CA 1',
            data: arrayCca1
        }, {
            name: 'CA 2',
            data: arrayCca2
        }, {
            name: 'CA 3',
            data: arrayCca3
        }, {
            name: 'CA 5',
            data: arrayCca5
        }, {
            name: 'CA 6',
            data: arrayCca6
        }, {
            name: 'CA 7',
            data: arrayCca7
        }, {
            name: 'SAS',
            data: arraySsas
        }, {
            name: 'SAES',
            data: arraySsaes
        }, {
            name: 'TOTAL',
            data: arraytotalca
        }]
    });

     

   
    Highcharts.chart('figrescate', {
        colors: ['#1f4e78', '#00c901', '#efd520', '#bfbfbf', '#537b35', '#a4c639', '#537b35', '#a4c639', '#537b35'],
        credits: {
            enabled: false
        },
        chart: {
            type: 'column'
        },
        title: {
            text: '<b>PROCEDIMIENTOS DE RESCATE ELABORADOS</b>'
        },

        xAxis: {
            categories: arrayTurnos,
            crosshair: true
        },

        yAxis: {
            min: 0,
            title: {
                text: 'Cant'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    style: {
                        fontWeight: 'bold',
                        fontSize: '24px'
                    }
                }
            }
        },
        series: [{
            name: 'ALTURAS',
            data: arrayPpra
        }, {
            name: 'ESP. CONFINADOS',
            data: arrayPprc
        }, {
            name: 'GASES TOXICOS',
            data: arrayPprg
        }, {
            name: 'TOTAL',
            data: arraytotalpr
        }]
    });

     
     



    })

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

    async guardarFile(){
      
      var files = $('#excel')[0].files[0];
          
      if(files != null){

        var formData = new FormData();
        formData.append('excel', files);
        formData.append('ods', '030');

        $.ajax({
            url: server + 'guardarExcelPermisos.php',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response)
  
                if (response.msn == "Realizado...") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Reporte de AC...',
                        text: 'Excel cargado correctamente...!',
                        showConfirmButton: false,
                        timer: 3000
                    }).then(() => {
                        location.reload()
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Formato de archivo incorrecto...!',
                    })
                }
            }
        });

      }else{
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Selecciones un archivo csv...!',
      })
      }

    }



  },
});

const mountedApp = app.mount("#app");
