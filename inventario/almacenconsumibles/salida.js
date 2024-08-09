
        var odsalm = sessionStorage.getItem('odsalm')
        var almacen = sessionStorage.getItem('almacen')
        var useralm = sessionStorage.getItem('useralm')
        var ubicacion = sessionStorage.getItem('ubicacion')

        $('#numods').html(odsalm + ' ' + ubicacion)

        if (useralm == null || useralm == "") {
            location = 'login.html';
        }

        var file = null

        var arrayItems = []
        var arrayItem = []
        var arrayItemSel = []
        var arrayCod = []

        var arraySelectItem = ''
        var totalItemsSelect = null

        var url = 'https://utitalco.com/inventario/server/'

        const hoy = new Date();

        function formatoFecha(fecha, formato) {
            const map = {
                dd: fecha.getDate(),
                mm: fecha.getMonth() + 1,
                yy: fecha.getFullYear().toString().slice(-2),
                yyyy: fecha.getFullYear()
            }

            return formato.replace(/dd|mm|yy|yyy/gi, matched => map[matched])
        }

        var fechahoy = formatoFecha(hoy, 'dd/mm/yy');

        $('#fecha').val(fechahoy)

        contarRegistros()
        cargarItems()

        function contarRegistros() {
            $.post(url + 'contarRegSalidasConsu.php', {
                    ods: odsalm,
                    ubicacion: ubicacion
                },
                function(resp) {
                    $('#numentrada').val(resp.num + 1)
                })
        }

        function cargarItems() {
            cargandoItems()
            $.post(url + 'cargarItemsConsu.php', {
                    ods: odsalm,
                    ubicacion: ubicacion
                },
                function(resp) {
                    arrayItems = resp

                    for (var i = 0; i < arrayItems.length; i++) {
                        var txtItem = '<option value="'+arrayItems[i].codigo + '|' + arrayItems[i].unidad + '|' + arrayItems[i].item+'"> '+arrayItems[i].item+' </option>'
                        arraySelectItem += txtItem;

                        arrayItem.push(arrayItems[i].codigo + '|' + arrayItems[i].unidad + '|' + arrayItems[i].item)
                        arrayCod.push(arrayItems[i].codigo)
                    }

                    // var availableTags = arrayItem;
                    // $("#item").autocomplete({
                    //     source: availableTags
                    // });

                    $('#selectitem').html(arraySelectItem)
                    
                    $('#selectitem').multiselect({
                        columns: 2,
                        placeholder: 'Seleccionar Items',
                        search: true,
                        searchOptions: {
                            'default': 'Buscar Items'
                        },
                        selectAll: true
                    });

                    var availableTags2 = arrayCod;
                    $("#codigo").autocomplete({
                        source: availableTags2
                    });

                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 500
                    })


                })
        }

        function agregar() {
            totalItemsSelect = $('#selectitem').val()

            var itemsel = $('#item').val()
            var cant = $('#cant').val()

            if (cant <= 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'Cantidad de item debe ser mayor a cero',
                    showConfirmButton: false,
                    timer: 3000
                })
            } else {
                //VERIFICA EXISTENCIAS ANTES DE CONTINUAL

                for(var a=0; a < totalItemsSelect.length; a++){

                        var partes = totalItemsSelect[a].split('|');
                        
                        var cod = partes[0]
                        var unid = partes[1]
                        var itemp = partes[2]

                


                            var index = null

                            for (var i = 0, len = arrayItemSel.length; i < len; i++) {
                                if (arrayItemSel[i].cod === cod) {
                                    index = i;
                                    break;
                                }
                            }

                            if (index != null) {
                                // Swal.fire({
                                //     position: 'top-end',
                                //     icon: 'info',
                                //     title: 'Item ya está registrado...',
                                //     showConfirmButton: false,
                                //     timer: 3000
                                // })
                            } else {
                                if (partes.length == 1) {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'info',
                                        title: 'Debe seleccionar un item del listado',
                                        showConfirmButton: false,
                                        timer: 3000
                                    })
                                } else {
                                    arrayItemSel.push({
                                        'cant': cant,
                                        'cod': cod,
                                        'unidad': unid,
                                        'item': itemp,
                                    })
                                }



                                $('#cant').val('1')
                                $('#item').val('')
                                $('#det').val('')

                                cargarSeleccionados()
                            }
                       
                }

                $('#cant').val('1')
                $('#item').val('')
                $('#det').val('')
                $('#selectitem').multiselect('reset');

                                

            }


            cargarSeleccionados()


        }

        function cargarSeleccionados() {
            var html = ''
            for (var i = 0; i < arrayItemSel.length; i++) {
                html += `
                <tr>
                    <td>${i+1}</td>
                    <td>
                        <input type="number" style="width: 80px; padding: 2px 2px; margin: 0px 0; box-sizing: border-box; font-size: 20px;" id="cantitem"  
                        value="${arrayItemSel[i].cant}" onchange="cambiarCant('${arrayItemSel[i].cod}', this)">
                    </td>
                    <td>${arrayItemSel[i].cod}</td>
                    <td>${arrayItemSel[i].unidad}</td>
                    <td>${arrayItemSel[i].item}</td>
                    <td><button type="button" class="btn btn-danger" onclick="borrarItem('${arrayItemSel[i].cod}')">X</button></td>
                </tr>
                `
            }
            $('#tablaDatos').html(html)
        }

        function borrarItem(coditem) {
            for (var i = 0, len = arrayItemSel.length; i < len; i++) {
                if (arrayItemSel[i].cod === coditem) {
                    index = i;
                    break;
                }
            }

            if (index !== -1) {
                arrayItemSel.splice(index, 1);
            }
            cargarSeleccionados()
        }

        function cambiarCant(coditem, e) {
            if (e.value > 0) {
                //VERIFICA EXISTENCIAS ANTES DE CONTINUAL
                var canti = e.value
                $.post(url + 'verificarExistencias.php', {
                        codigo: coditem,
                        cant: canti,
                        alm: 'AC' + odsalm + ubicacion
                    },
                    function(resp) {
                        if (resp.msn == 'Ok') {
                            for (var i = 0, len = arrayItemSel.length; i < len; i++) {
                                if (arrayItemSel[i].cod === coditem) {

                                    arrayItemSel[i].cant = canti
                                    break;
                                }
                            }
                            cargarSeleccionados()
                        } else {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'info',
                                title: resp.msn,
                                showConfirmButton: false,
                                timer: 3000
                            })
                        }
                    })


            }


        }

        function sumarItem(coditem) {
            for (var i = 0, len = arrayItemSel.length; i < len; i++) {
                if (arrayItemSel[i].cod === coditem) {
                    var canti = arrayItemSel[i].cant
                    canti++
                    arrayItemSel[i].cant = canti
                    break;
                }
            }

            cargarSeleccionados()
        }

        function restarItem(coditem) {
            for (var i = 0, len = arrayItemSel.length; i < len; i++) {
                if (arrayItemSel[i].cod === coditem) {
                    var canti = arrayItemSel[i].cant
                    canti--
                    if (canti < 1) {
                        canti = 1
                    }
                    arrayItemSel[i].cant = canti
                    break;
                }
            }

            cargarSeleccionados()
        }

        function cargando() {
            let timerInterval
            Swal.fire({
                title: 'Guardando!',
                html: 'Un momento por favor...',
                timer: 25000,
                timerProgressBar: true,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                    timerInterval = setInterval(() => {

                    }, 1000)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {

                }
            })
        }

        function guardar() {

            if (arrayItemSel.length == 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'Debe agregar items',
                    showConfirmButton: false,
                    timer: 3000
                })
            } else {
                if ($('#observaciones').val() != '') {
                    Swal.fire({
                        title: 'Desea guardar la Orden de Salida?',
                        text: 'Se actualizará el inventario',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, Guardar',
                        cancelButtonText: 'Cancelar',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        allowOutsideClick: false
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {

                            cargando()

                            var ced = $('#ced').val()
                            var nombres = $('#nombres').val()

                            var cedsup = $('#cedsup').val()
                            var supervisor = $('#supervisor').val()
                            var frente = $('#frente').val()

                            var itemsEntrada = JSON.stringify(arrayItemSel)
                            var observaciones = $('#observaciones').val()

                            var formData = new FormData();

                            formData.append('adjunto', file);
                            formData.append('ced', ced);
                            formData.append('nombres', nombres);
                            formData.append('cedsup', cedsup);
                            formData.append('supervisor', supervisor);
                            formData.append('frente', frente);
                            formData.append('ods', odsalm);
                            formData.append('ubicacion', ubicacion);
                            formData.append('items', itemsEntrada);
                            formData.append('observaciones', observaciones);
                            formData.append('user', useralm)



                            $.ajax({
                                url: url + 'guardarSalidaConsu.php',
                                type: 'post',
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function(response) {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'Registrada correctamente...',
                                        showConfirmButton: true
                                    }).then(() => {
                                        location = 'salidaimp.html?id=' + response.id
                                    })
                                }
                            })


                        }
                    })
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'info',
                        title: 'Debe agregar una observación...',
                        showConfirmButton: false,
                        timer: 3000
                    })
                }

            }

        }

        function buscarCodItem() {
            var codsel = $('#codigo').val()

            //busca el item
            $.post(url + 'buscarItemSel.php', {
                    cod: codsel
                },
                function(resp) {
                    var html = resp.codigo + '|' + resp.unidad + '|' + resp.item
                    $('#item').val(html)
                    $('#codigo').val('')
                    agregar()
                })
        }

        function mayus(e) {
            e.value = e.value.toUpperCase();
        }

        function buscarCed(ced) {
            $.post(url + 'buscarCed.php', {
                    ced: ced.value
                },
                function(resp) {
                    arrayDatosTrab = resp
                    $('#nombres').val(arrayDatosTrab.nombres)
                })
        }
        

        function buscarCedS(ced) {
            $.post(url + 'buscarCed.php', {
                    ced: ced.value
                },
                function(resp) {
                    arrayDatosTrab = resp
                    $('#supervisor').val(arrayDatosTrab.nombres)
                })
        }

        function adjuntar() {
            Swal.fire({
                title: 'Adjuntar archivo',
                html: `
                    <input type="file" id="adjunto"  class="form-control" placeholder="Adjunto...">
                `,
                showCancelButton: true,
                confirmButtonText: 'Adjuntar',
                cancelButtonText: 'No',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                allowOutsideClick: false
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    file = $('#adjunto')[0].files[0];
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Archivo cargado correctamente...',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        $('#archivo').html('<h4>Archivo: ' + file.name + '</h4>')
                    })
                }
            })
        }



        function rep() {
            location = 'repsalida.html'
        }

        function cargandoItems() {
            let timerInterval
            Swal.fire({
                title: 'Cargando items del inventario!',
                html: 'Un momento por favor...',
                timer: 25000,
                timerProgressBar: true,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                    timerInterval = setInterval(() => {

                    }, 1000)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {

                }
            })
        }


