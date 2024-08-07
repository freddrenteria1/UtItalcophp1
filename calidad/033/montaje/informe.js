
        var odsq = '030';
        var datos = [];
        var url = "https://utitalco.com/calidad/033/montaje/weldbook/server/";

        var user = sessionStorage.getItem("usercal");
        var tipouser = sessionStorage.getItem("tipouser");

        var arrayFechas = []
        var arrayProg = []
        var arrayEje = []

        var arrayEquipos = []

        var arrayJprogT = []
        var arrayJejeT = []
        var arrayJpdtesT = []
        var arrayPprogT = []
        var arrayPejeT = []
        var arrayPpdtesT = []

        var arrayJprogC = []
        var arrayJejeC = []
        var arrayJpdtesC = []
        var arrayPprogC = []
        var arrayPejeC = []
        var arrayPpdtesC = []

        var arrayJprogTotal = []
        var arrayJejeTotal = []
        var arrayJpdtesTotal = []
        var arrayPprogTotal = []
        var arrayPejeTotal = []
        var arrayPpdtesTotal = []



        var datosLaterales = []
        var datosPiso = []
        var datosBanco = []
        var datosQuemadores = []
        var datosTecho = []
        var datosPantalla = []
        var datosCalentador = []
        var datosRiser = []
        var datosFrontal = []

        var arrayItemsBanco = []
        var arrayBancoPlan = []
        var arrayBancoEje = []
        var arrayBancoPdte = []

        var arrayItemsPiso = []
        var arrayPisoPlan = []
        var arrayPisoEje = []
        var arrayPisoPdte = []

        var arrayItemsLaterales = []
        var arrayLateralesPlan = []
        var arrayLateralesEje = []
        var arrayLateralesPdte = []

        var arrayItemsQuemadores = []
        var arrayQuemadoresPlan = []
        var arrayQuemadoresEje = []
        var arrayQuemadoresPdte = []

        var arrayItemsPantalla = []
        var arrayPantallaPlan = []
        var arrayPantallaEje = []
        var arrayPantallaPdte = []

        var arrayItemsTecho = []
        var arrayTechoPlan = []
        var arrayTechoEje = []
        var arrayTechoPdte = []

        var arrayItemsCalentador = []
        var arrayCalentadorPlan = []
        var arrayCalentadorEje = []
        var arrayCalentadorPdte = []

        var arrayItemsRiser = []
        var arrayRiserPlan = []
        var arrayRiserEje = []
        var arrayRiserPdte = []




        var ventana_ancho = $(window).width();
        var ventana_alto = $(window).height();
        ventana_ancho = ventana_ancho - 80;
        ventana_alto = ventana_alto - 220;

        if (ventana_ancho > 1300) {
            ventana_alto = ventana_alto - 220;
        } else {
            ventana_alto = 330;
        }

        let date = new Date();
        let output =
            String(date.getDate()).padStart(2, "0") +
            "-" +
            String(date.getMonth() + 1).padStart(2, "0") +
            "-" +
            date.getFullYear();

        let outputf =
            date.getFullYear() +
            "-" +
            String(date.getMonth() + 1).padStart(2, "0") +
            "-" +
            String(date.getDate()).padStart(2, "0");
             
            
           

        $("#fecha").html(output);

        var fechab = sessionStorage.getItem('fechab');
        

        if(fechab == null){
            fechab = outputf;
        }

        var fechabuscar = fechab


        $('#fechac').val(fechab)

        //cargarDatos();

        function cargando() {
            let timerInterval;
            Swal.fire({
                title: "Cargando indicadores...!",
                timer: 120000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const b = Swal.getHtmlContainer().querySelector("b");
                    timerInterval = setInterval(() => {
                        // b.textContent = Swal.getTimerLeft()
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                },
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    console.log("I was closed by the timer");
                }
            });
        }

        function cargandoPag() {
            let timerInterval;
            Swal.fire({
                title: "Procesando datos...!",
                timer: 120000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const b = Swal.getHtmlContainer().querySelector("b");
                    timerInterval = setInterval(() => {
                        // b.textContent = Swal.getTimerLeft()
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                },
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    console.log("I was closed by the timer");
                }
            });
        }

        //cargarInformePuntos();
       
        //cargarAvanceDiario()

        cargarWeldbook()
        cargarInformeSoldadura()
        cargarDatoCCMontaje()

        $("#ressoldadura").addClass("oculto");
        $("#cccontrolres").addClass("oculto");
        
        

        function cargarFecha(){
            fechabuscar = $('#fechac').val()
            sessionStorage.setItem('fechab', fechabuscar)
            location.reload()
        }

        function cargarWeldbook() {

            cargandoPag();

            $.post(url + "cJuntasEquiposGra.php", function (resp) {
                datos = resp;

                for (var i = 0; i < datos.length; i++) {
                    arrayEquipos.push(datos[i].especialidad)

                    arrayJprogT.push(datos[i].jpt)
                    arrayJejeT.push(datos[i].jet)
                    arrayJpdtesT.push(datos[i].jpdt)
                    arrayPprogT.push(datos[i].ppt)
                    arrayPejeT.push(datos[i].pet)
                    arrayPpdtesT.push(datos[i].ppdt)

                    arrayJprogC.push(datos[i].jpc)
                    arrayJejeC.push(datos[i].jec)
                    arrayJpdtesC.push(datos[i].jpdc)
                    arrayPprogC.push(datos[i].ppc)
                    arrayPejeC.push(datos[i].pec)
                    arrayPpdtesC.push(datos[i].ppdc)

                    arrayJprogTotal.push(datos[i].jptot)
                    arrayJejeTotal.push(datos[i].jetot)
                    arrayJpdtesTotal.push(datos[i].jtpdc)
                    arrayPprogTotal.push(datos[i].pptot)
                    arrayPejeTotal.push(datos[i].petot)
                    arrayPpdtesTotal.push(datos[i].ptpdc)
                }

                Swal.close();
                cargarGraficasWelbook();

            })
        }

        function cargarGraficasWelbook() {

            Highcharts.chart('figTallerJ', {
                 
                credits: {
                    enabled: false
                },
                chart: {
                    type: 'column',
                    height: 300,
                    
                    // options3d: {
                    //     enabled: true,
                    //     alpha: 15,
                    //     beta: 15,
                    //     viewDistance: 25,
                    //     depth: 40
                    // }
                },
                title: {
                    text: '<b>JUNTAS SOLDADAS POR ESPECIALIDAD TALLER</b>'
                },

                xAxis: {
                    categories: arrayEquipos,
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
                            enabled: true
                        }
                    }
                },
                series: [
                {
                    name: 'JUNTAS PROG',
                    data: arrayJprogT
                }, {
                    name: 'JUNTAS EJE',
                    data: arrayJejeT
                }, {
                    name: 'JUNTAS PDTES',
                    data: arrayJpdtesT
                } 
            ]
            });

            Highcharts.chart('figTallerP', {
                 
                credits: {
                    enabled: false
                },
                chart: {
                    type: 'column',
                    height: 300,
                    
                    // options3d: {
                    //     enabled: true,
                    //     alpha: 15,
                    //     beta: 15,
                    //     viewDistance: 25,
                    //     depth: 40
                    // }
                },
                title: {
                    text: '<b>PULGADAS DIAMETRALES POR ESPECIALIDAD TALLER</b>'
                },

                xAxis: {
                    categories: arrayEquipos,
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
                        stacking: 'normal',
                        dataLabels: {
                            enabled: true
                        }
                    }
                },
                series: [
                 
                    {
                        name: 'PULG PROG',
                        data: arrayPprogT,
                    }, {
                        name: 'PULG EJE',
                        data: arrayPejeT,
                        stack: 'PRO'
                    }, {
                        name: 'PULG PDTES',
                        data: arrayPpdtesT,
                        stack: 'PRO'
                    },
                ]
            });


            Highcharts.chart('figCampoJ', {
                 
                credits: {
                    enabled: false
                },
                chart: {
                    type: 'column',
                    height: 300,
                    
                },
                title: {
                    text: '<b>JUNTAS SOLDADAS POR ESPECIALIDAD CAMPO</b>'
                },

                xAxis: {
                    categories: arrayEquipos,
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
                            enabled: true
                        }
                    }
                },
                series: [
                {
                    name: 'JUNTAS PROG',
                    data: arrayJprogC
                }, {
                    name: 'JUNTAS EJE',
                    data: arrayJejeC
                }, {
                    name: 'JUNTAS PDTES',
                    data: arrayJpdtesC
                } 
            ]
            });

            Highcharts.chart('figCampoP', {
                 
                credits: {
                    enabled: false
                },
                chart: {
                    type: 'column',
                    height: 300,
                    
                },
                title: {
                    text: '<b>PULGADAS DIAMETRALES POR ESPECIALIDAD CAMPO</b>'
                },

                xAxis: {
                    categories: arrayEquipos,
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
                        stacking: 'normal',
                        pointPadding: 0.2,
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true
                        }
                    }
                },
                series: [
                 
                {
                    name: 'PULG PROG',
                    data: arrayPprogC
                }, {
                    name: 'PULG EJE',
                    data: arrayPejeC,
                    stack: 'PRO'
                }, {
                    name: 'PULG PDTES',
                    data: arrayPpdtesC,
                    stack: 'PRO'
                },
            ]
            });

            Highcharts.chart('figTotalJ', {
                 
                credits: {
                    enabled: false
                },
                chart: {
                    type: 'column',
                    height: 300,
                    
                },
                title: {
                    text: '<b>JUNTAS SOLDADAS POR ESPECIALIDAD TOTAL</b>'
                },

                xAxis: {
                    categories: arrayEquipos,
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
                            enabled: true
                        }
                    }
                },
                series: [
                {
                    name: 'JUNTAS PROG',
                    data: arrayJprogTotal
                }, {
                    name: 'JUNTAS EJE',
                    data: arrayJejeTotal
                }, {
                    name: 'JUNTAS PDTES',
                    data: arrayJpdtesTotal
                } 
            ]
            });

            Highcharts.chart('figTotalP', {
                 
                credits: {
                    enabled: false
                },
                chart: {
                    type: 'column',
                    height: 300,
                    
                },
                title: {
                    text: '<b>PULGADAS DIAMETRALES POR ESPECIALIDAD TOTAL</b>'
                },

                xAxis: {
                    categories: arrayEquipos,
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
                        stacking: 'normal',
                        pointPadding: 0.2,
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true
                        }
                    }
                },
                series: [
                 
                {
                    name: 'PULG PROG',
                    data: arrayPprogTotal
                }, {
                    name: 'PULG EJE',
                    data: arrayPejeTotal,
                    stack: 'PRO'
                }, {
                    name: 'PULG PDTES',
                    data: arrayPpdtesTotal,
                    stack: 'PRO'
                },
            ]
            });

        }

        function cargarInformeSoldadura() {
             
             $.post('https://utitalco.com/calidad/033/montaje/server/curvaSoldadura.php', {
                     ods: odsq,
                     fecha: fechab
                 },
                 function (resp) {
                    
                     console.log(resp)
 
                     arrayDatos = resp.soldp
 
                     for(var i=0; i<arrayDatos.length; i++ ){
                         arrayFechas.push(arrayDatos[i].fecha)
                         arrayProg.push(arrayDatos[i].progacum)
                         
                         // arrayFechas.push(arrayDatos[i].fecha)
                     }
 
                     arrayDatos = resp.solde
                     var arrayDatosTmp = resp.soldp
 
                     for(var i=0; i<arrayDatos.length; i++ ){
                         arrayEje.push(arrayDatos[i].ejeacum)
 
                         arrayProgAcum = arrayDatosTmp[i].progacum
                         arrayEjeAcum = arrayDatos[i].ejeacum
                         // arrayFechas.push(arrayDatos[i].fecha)
                     }
 
 
 
                     Swal.close()
 
                     cargarGraficasSoldadura()
  
 
                 })
         }
 
 
         function cargarGraficasSoldadura() {
 
             Highcharts.chart('figsold', {
                 colors: [
                     "#004236",
                     "#00c901",
                     "#F8F9F9 ",
                     "#C51111",
                     "#a4c639",
                     "#180272",
                     "#537b35",
                     "#a4c639",
                     "#537b35",
                     "#537b35",
                 ],
                 credits: {
                     enabled: false,
                 },
                 chart: {
                     type: 'spline',
                     height: 300,
                 },
                 tooltip: {
                     headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                     pointFormat: '<tr><td style="padding:0">{series.name}: </td>' +
                         '<td style="padding:0"><b>{point.y:.f} </b></td></tr>',
                     footerFormat: '</table>',
                     shared: true,
                     useHTML: true
                 },
                 title: {
                     text: 'CURVA SOLDADURA'
                 },
                 
                 xAxis: {
                     categories: arrayFechas
                 },
                 yAxis: {
                     title: {
                         text: 'CANT PULGADAS'
                     }
                 },
                 plotOptions: {
                     spline: {
                         dataLabels: {
                             enabled: true
                         },
                         enableMouseTracking: true
                     }
                 },
                 series: 
                 [
                     {
                     name: 'PROG ACUM',
                     data: arrayProg
                     },
                     {
                     name: 'EJE ACUM',
                     data: arrayEje
                     },
                 
                 ]
             });
 
             var desv = (arrayEjeAcum-arrayProgAcum).toFixed(2)
             desv = parseFloat(desv)
            
             Highcharts.chart('figavancediario', {
                  
                  credits: {
                      enabled: false
                  },
                  chart: {
                      type: 'column',
                      height: 600,
                      // options3d: {
                      //     enabled: true,
                      //     alpha: 15,
                      //     beta: 15,
                      //     viewDistance: 25,
                      //     depth: 40
                      // }
                  },
                  title: {
                      text: '<b>AVANCE DIARIO ACUMULADO SOLDADURA POR PULGADAS DIAMETRALES</b>'
                  },
  
                  xAxis: {
                      categories: ['PULGADAS'],
                      crosshair: true
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
                              enabled: true
                          }
                      }
                  },
                  series: [
                  {
                      name: 'PULG PROG',
                      data: [arrayProgAcum]
                  }, {
                      name: 'PULG EJE',
                      data: [arrayEjeAcum]
                  }
                  , {
                      name: 'DESVIACIÓN',
                      data: [desv]
                  }
              ]
              });
  
 
             
            
             
         }
         
         
          function cargarDatoCCMontaje() {

            cargandoPag();

            $.post(url + "cargarDatosCCMontajeInf.php", {fecha:fechab}, function (resp) {

              console.log(resp)

              Swal.close();

                datosLaterales = resp.lateral;
                datosPiso = resp.piso;
                datosTecho = resp.techo;
                datosPantalla = resp.pantalla;
                datosCalentador = resp.calentador;
                datosRiser = resp.riser;
                datosQuemadores = resp.quemadores;
                datosBanco = resp.banco;


                for(var i=0; i<datosBanco.length; i++){
                  arrayItemsBanco.push(datosBanco[i].actividad)
                  arrayBancoPlan.push(parseInt(datosBanco[i].totplan))
                  arrayBancoEje.push(parseInt(datosBanco[i].acumeje))
                  arrayBancoPdte.push(parseInt(datosBanco[i].pendiente))
                }

                for(var i=0; i<datosPiso.length; i++){
                  arrayItemsPiso.push(datosPiso[i].actividad)
                  arrayPisoPlan.push(parseInt(datosPiso[i].totplan))
                  arrayPisoEje.push(parseInt(datosPiso[i].acumeje))
                  arrayPisoPdte.push(parseInt(datosPiso[i].pendiente))
                }

                for(var i=0; i<datosLaterales.length; i++){
                  arrayItemsLaterales.push(datosLaterales[i].actividad)
                  arrayLateralesPlan.push(parseInt(datosLaterales[i].totplan))
                  arrayLateralesEje.push(parseInt(datosLaterales[i].acumeje))
                  arrayLateralesPdte.push(parseInt(datosLaterales[i].pendiente))
                }

                for(var i=0; i<datosQuemadores.length; i++){
                  arrayItemsQuemadores.push(datosQuemadores[i].actividad)
                  arrayQuemadoresPlan.push(parseInt(datosQuemadores[i].totplan))
                  arrayQuemadoresEje.push(parseInt(datosQuemadores[i].acumeje))
                  arrayQuemadoresPdte.push(parseInt(datosQuemadores[i].pendiente))
                }

                for(var i=0; i<datosPantalla.length; i++){
                  arrayItemsPantalla.push(datosPantalla[i].actividad)
                  arrayPantallaPlan.push(parseInt(datosPantalla[i].totplan))
                  arrayPantallaEje.push(parseInt(datosPantalla[i].acumeje))
                  arrayPantallaPdte.push(parseInt(datosPantalla[i].pendiente))
                }

                for(var i=0; i<datosTecho.length; i++){
                  arrayItemsTecho.push(datosTecho[i].actividad)
                  arrayTechoPlan.push(parseInt(datosTecho[i].totplan))
                  arrayTechoEje.push(parseInt(datosTecho[i].acumeje))
                  arrayTechoPdte.push(parseInt(datosTecho[i].pendiente))
                }

                for(var i=0; i<datosCalentador.length; i++){
                  arrayItemsCalentador.push(datosCalentador[i].actividad)
                  arrayCalentadorPlan.push(parseInt(datosCalentador[i].totplan))
                  arrayCalentadorEje.push(parseInt(datosCalentador[i].acumeje))
                  arrayCalentadorPdte.push(parseInt(datosCalentador[i].pendiente))
                }

                for(var i=0; i<datosRiser.length; i++){
                  arrayItemsRiser.push(datosRiser[i].actividad)
                  arrayRiserPlan.push(parseInt(datosRiser[i].totplan))
                  arrayRiserEje.push(parseInt(datosRiser[i].acumeje))
                  arrayRiserPdte.push(parseInt(datosRiser[i].pendiente))
                }

                graficasCC()

            })

          }

       
    function graficasCC(){
      
      
    //   Highcharts.chart('figCCBanco', {
    //     //colors: ['#FFD700', '#C0C0C0', '#CD7F32'],
    //     credits: {
    //                 enabled: false
    //             },
    //     chart: {
    //         type: 'column',
    //         inverted: true,
    //         polar: true
    //     },
    //     title: {
    //         text: 'Actividades Banco Principal',
    //         align: 'left'
    //     },
        
    //     tooltip: {
    //         outside: true
    //     },
    //     pane: {
    //         size: '85%',
    //         innerSize: '20%',
    //         endAngle: 270
    //     },
    //     xAxis: {
    //         tickInterval: 1,
    //         labels: {
    //             align: 'right',
    //             useHTML: true,
    //             allowOverlap: true,
    //             step: 1,
    //             y: 3,
    //             style: {
    //                 fontSize: '13px'
    //             }
    //         },
    //         lineWidth: 0,
    //         gridLineWidth: 0,
    //         categories: arrayItemsBanco
    //     },
    //     yAxis: {
    //         lineWidth: 0,
    //         tickInterval: 25,
    //         reversedStacks: false,
    //         endOnTick: true,
    //         showLastLabel: true,
    //         gridLineWidth: 0
    //     },
    //     plotOptions: {
    //         column: {
    //             stacking: 'normal',
    //             borderWidth: 0,
    //             pointPadding: 0,
    //             groupPadding: 0.15,
    //             borderRadius: '50%'
    //         }
    //     },
    //     series: [{
    //         name: 'Planeado',
    //         data: arrayBancoPlan
    //     }, {
    //         name: 'Ejecutado',
    //         data: arrayBancoEje
    //     }, {
    //         name: 'Pendiente',
    //         data: arrayBancoPdte
    //     }]
    // });



      Highcharts.chart('figCCBanco', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Actividades Banco Principal'
        },
        xAxis: {
            categories: arrayItemsBanco
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Goals'
            }
        },
        legend: {
            reversed: true
        },
        plotOptions: {
            series: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true
                }
            }
        },
        series: [{
            name: 'Planeado',
            data: arrayBancoPlan
        }, {
            name: 'Ejecutado',
            data: arrayBancoEje
        }, {
            name: 'Pendiente',
            data: arrayBancoPdte
        }]
    });
  

      Highcharts.chart('figCCPiso', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Actividades Pared Piso'
        },
        xAxis: {
            categories: arrayItemsPiso
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Goals'
            }
        },
        legend: {
            reversed: true
        },
        plotOptions: {
            series: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true
                }
            }
        },
        series: [{
            name: 'Planeado',
            data: arrayPisoPlan
        }, {
            name: 'Ejecutado',
            data: arrayPisoEje
        }, {
            name: 'Pendiente',
            data: arrayPisoPdte
        }]
    });
  
    Highcharts.chart('figCCLaterales', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Actividades Paredes Laterales'
        },
        xAxis: {
            categories: arrayItemsLaterales
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Goals'
            }
        },
        legend: {
            reversed: true
        },
        plotOptions: {
            series: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true
                }
            }
        },
        series: [{
            name: 'Planeado',
            data: arrayLateralesPlan
        }, {
            name: 'Ejecutado',
            data: arrayLateralesEje
        }, {
            name: 'Pendiente',
            data: arrayLateralesPdte
        }]
    });
  
    Highcharts.chart('figCCQuemadores', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Actividades Pared Quemadores'
        },
        xAxis: {
            categories: arrayItemsQuemadores
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Goals'
            }
        },
        legend: {
            reversed: true
        },
        plotOptions: {
            series: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true
                }
            }
        },
        series: [{
            name: 'Planeado',
            data: arrayQuemadoresPlan
        }, {
            name: 'Ejecutado',
            data: arrayQuemadoresEje
        }, {
            name: 'Pendiente',
            data: arrayQuemadoresPdte
        }]
    });
  
    Highcharts.chart('figCCPantalla', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Actividades Pared Pantalla'
        },
        xAxis: {
            categories: arrayItemsPantalla
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Goals'
            }
        },
        legend: {
            reversed: true
        },
        plotOptions: {
            series: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true
                }
            }
        },
        series: [{
            name: 'Planeado',
            data: arrayPantallaPlan
        }, {
            name: 'Ejecutado',
            data: arrayPantallaEje
        }, {
            name: 'Pendiente',
            data: arrayPantallaPdte
        }]
    });
  
    Highcharts.chart('figCCTecho', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Actividades Pared Techo'
        },
        xAxis: {
            categories: arrayItemsTecho
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Goals'
            }
        },
        legend: {
            reversed: true
        },
        plotOptions: {
            series: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true
                }
            }
        },
        series: [{
            name: 'Planeado',
            data: arrayTechoPlan
        }, {
            name: 'Ejecutado',
            data: arrayTechoEje
        }, {
            name: 'Pendiente',
            data: arrayTechoPdte
        }]
    });
  
    Highcharts.chart('figCCCalentador', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Actividades Súper Calentador'
        },
        xAxis: {
            categories: arrayItemsCalentador
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Goals'
            }
        },
        legend: {
            reversed: true
        },
        plotOptions: {
            series: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true
                }
            }
        },
        series: [{
            name: 'Planeado',
            data: arrayCalentadorPlan
        }, {
            name: 'Ejecutado',
            data: arrayCalentadorEje
        }, {
            name: 'Pendiente',
            data: arrayCalentadorPdte
        }]
    });
  
    Highcharts.chart('figCCRiser', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Actividades Riser'
        },
        xAxis: {
            categories: arrayItemsRiser
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Goals'
            }
        },
        legend: {
            reversed: true
        },
        plotOptions: {
            series: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true
                }
            }
        },
        series: [{
            name: 'Planeado',
            data: arrayRiserPlan
        }, {
            name: 'Ejecutado',
            data: arrayRiserEje
        }, {
            name: 'Pendiente',
            data: arrayRiserPdte
        }]
    });
  
  






  }
      
      
    function ver(e){
        console.log(e)
        if(e=='inicio'){
            $("#ccontrol").removeClass("oculto");
            $("#weldbook").removeClass("oculto");
            $("#ressoldadura").addClass("oculto");
            $("#cccontrolres").addClass("oculto");
            
        }
        if(e=='soldadura'){
            $("#weldbook").removeClass("oculto");
            $("#ressoldadura").removeClass("oculto");
            $("#ccontrol").addClass("oculto");
            $("#cccontrolres").addClass("oculto");
        }

        if(e=='ccontrol'){
            
            $("#ccontrol").removeClass("oculto");
            $("#cccontrolres").removeClass("oculto");
            $("#weldbook").addClass("oculto");
            $("#ressoldadura").addClass("oculto");
        }
    }
    
