
       var server = 'https://utitalco.com/evaluaciones/evalsup/'

        function getParameterByName(name) {
            name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
            var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
                results = regex.exec(location.search);
            return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
        }

        const generarCodigo = (num) => {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let result1 = '';
            const charactersLength = characters.length;
            for (let i = 0; i < num; i++) {
                result1 += characters.charAt(Math.floor(Math.random() * charactersLength));
            }

            return result1;
        }

        window.onload = function() {
            var fecha = new Date(); //Fecha actual
            var mes = fecha.getMonth() + 1; //obteniendo mes
            var dia = fecha.getDate(); //obteniendo dia
            var ano = fecha.getFullYear(); //obteniendo año
            if (dia < 10)
                dia = '0' + dia; //agrega cero si el menor de 10
            if (mes < 10)
                mes = '0' + mes //agrega cero si el menor de 10
            document.getElementById('desde').value = ano + "-" + mes + "-" + dia;
            document.getElementById('hasta').value = ano + "-" + mes + "-" + dia;
        }

        //se verifica el usuario
        var nombres = ''
        var cargo = ''

        var evaluador = ''
        var cargoeval = ''

        var myArr = []
        var valor = 0;

        var codigo = ''

        var p1 = 0;
        var p2 = 0
        var p3 = 0
        var p4 = 0
        var p5 = 0
        var p6 = 0
        var p7 = 0
        var p8 = 0
        var p9 = 0
        var p10 = 0
        var p11 = 0

        var p12a = 0
        var p12b = 0
        var p13a = 0
        var p13b = 0
        var p13c = 0
        var p14a = 0
        var p14b = 0
        var p14c = 0
        var p14d = 0

        var p15a = 0
        var p15b = 0
        var p15c = 0
        var p16a = 0
        var p16b = 0
        var p17a = 0
        var p17b = 0
        var p17c = 0
        var p18a = 0
        var p18b = 0

        var p19a = 0
        var p19b = 0

        var p20a = 0
        var p20b = 0
        var p20c = 0
        var p20d = 0
        var p20e = 0
        var p21 = 0


        var arrayPrg = []
        var sum = 0
        var prom = 0


        //$('#collapseOne').collapse()

        cargoeval = sessionStorage.getItem('cargo')

        // if (cargoeval == 'LÍDER PLANEACIÓN') {
        //     ocultarPaneles()
        //     $('#evalliderplan').removeClass('oculto')
        // }
        if (cargoeval == 'LÍDER HSE') {
            ocultarPaneles()
            $('#evalliderhse').removeClass('oculto')
        }
        if (cargoeval == 'LÍDER LOGÍSTICA') {
            ocultarPaneles()
            $('#evalliderlog').removeClass('oculto')
        }
        if (cargoeval == 'LÍDER QAQC') {
            ocultarPaneles()
            $('#evalliderqaqc').removeClass('oculto')
        }
        if (cargoeval != 'LÍDER HSE' && cargoeval != 'LÍDER QAQC' && cargoeval != 'LÍDER LOGÍSTICA' && cargoeval != 'LÍDER PLANEACIÓN') {
            ocultarPaneles()
            $('#evaljefe').removeClass('oculto')
        }

        var user = sessionStorage.getItem('user');

        if (user == null) {

            location = 'login.html';

        } else {

            evaluador = sessionStorage.getItem('nombres')
            cargoeval = sessionStorage.getItem('cargo')

            $('#nombreeval').val(evaluador)
            $('#cargoeval').val(cargoeval)
        }

        function removeItemFromArr(arr, item) {
            var i = arr.indexOf(item);

            if (i !== -1) {
                arr.splice(i, 1);
            }
        }


        $("input[type='radio']").change(function() {

            valor = $(this).val()

            removeItemFromArr(arrayPrg, valor);

            myArr = valor.split("-");
            sum += parseInt(myArr[3])
            arrayPrg.push(valor)

            var numpg = myArr[1];

            if (numpg == "1") {
                p1 = parseInt(myArr[3])
            }
            if (numpg == "2") {
                p2 = parseInt(myArr[3])
            }
            if (numpg == "3") {
                p3 = parseInt(myArr[3])
            }
            if (numpg == "4") {
                p4 = parseInt(myArr[3])
            }
            if (numpg == "5") {
                p5 = parseInt(myArr[3])
            }
            if (numpg == "6") {
                p6 = parseInt(myArr[3])
            }
            if (numpg == "7") {
                p7 = parseInt(myArr[3])
            }
            if (numpg == "8") {
                p8 = parseInt(myArr[3])
            }
            if (numpg == "9") {
                p9 = parseInt(myArr[3])
            }
            if (numpg == "10") {
                p10 = parseInt(myArr[3])
            }
            if (numpg == "11") {
                p11 = parseInt(myArr[3])
            }
            if (numpg == "12a") {
                p12a = parseInt(myArr[3])
            }
            if (numpg == "12b") {
                p12b = parseInt(myArr[3])
            }
            if (numpg == "13a") {
                p13a = parseInt(myArr[3])
            }
            if (numpg == "13b") {
                p13b = parseInt(myArr[3])
            }
            if (numpg == "13c") {
                p13c = parseInt(myArr[3])
            }
            if (numpg == "14a") {
                p14a = parseInt(myArr[3])
            }
            if (numpg == "14b") {
                p14b = parseInt(myArr[3])
            }
            if (numpg == "14c") {
                p14c = parseInt(myArr[3])
            }
            if (numpg == "14d") {
                p14d = parseInt(myArr[3])
            }

            if (numpg == "15a") {
                p15a = parseInt(myArr[3])
            }
            if (numpg == "15b") {
                p15b = parseInt(myArr[3])
            }
            if (numpg == "15c") {
                p15c = parseInt(myArr[3])
            }
            if (numpg == "16a") {
                p16a = parseInt(myArr[3])
            }
            if (numpg == "16b") {
                p16b = parseInt(myArr[3])
            }
            if (numpg == "17a") {
                p17a = parseInt(myArr[3])
            }
            if (numpg == "17b") {
                p17b = parseInt(myArr[3])
            }
            if (numpg == "17c") {
                p17c = parseInt(myArr[3])
            }
            if (numpg == "18a") {
                p18a = parseInt(myArr[3])
            }
            if (numpg == "18b") {
                p18b = parseInt(myArr[3])
            }

            if (numpg == "19a") {
                p19a = parseInt(myArr[3])
            }

            if (numpg == "19b") {
                p19b = parseInt(myArr[3])
            }

            if (numpg == "20a") {
                p20a = parseInt(myArr[3])
            }
            if (numpg == "20b") {
                p20b = parseInt(myArr[3])
            }
            if (numpg == "20c") {
                p20c = parseInt(myArr[3])
            }
            if (numpg == "20d") {
                p20d = parseInt(myArr[3])
            }
            if (numpg == "20e") {
                p20e = parseInt(myArr[3])
            }
            if (numpg == "21") {
                p21 = parseInt(myArr[3])
            }




        });


        function ocultarPaneles() {
            $('#evaljefe').addClass('oculto')
            $('#evalliderplan').addClass('oculto')
            $('#evalliderhse').addClass('oculto')
            $('#evalliderlog').addClass('oculto')
            $('#evalliderqaqc').addClass('oculto')
        }



        function enviar() {

            var nombres = $('#nombres').val()
            var doc = $('#doc').val()
            var cargo = $('#cargo').val()
            var ods = $('#ods').val()
            var pinicial = $('#desde').val()
            var pfinal = $('#hasta').val()
            var observaciones = $('#observaciones').val()
            var planes = $('#planes').val()
            var compromisos = $('#compromisos').val()

            if (nombres != '' && doc != '' && cargo != '' && observaciones != '') {

                codigo = generarCodigo(10)

                sessionStorage.setItem('codigo', codigo)

                if (cargoeval == 'LÍDER PLANEACIÓN') {

                    $.post(server + 'guardarCalEvalSupPlan.php', {
                            codigo: codigo,
                            p12a: p12a,
                            p12b: p12b,
                            p13a: p13a,
                            p13b: p13b,
                            p13c: p13c,
                            p14a: p14a,
                            p14b: p14b,
                            p14c: p14c,
                            p14d: p14d
                        },
                        function(resp) {

                            var vcant = 0;

                            if (p12a != 0) {
                                vcant++;
                            }
                            if (p12b != 0) {
                                vcant++;
                            }
                            if (p13a != 0) {
                                vcant++;
                            }
                            if (p13b != 0) {
                                vcant++;
                            }
                            if (p13c != 0) {
                                vcant++;
                            }
                            if (p14a != 0) {
                                vcant++;
                            }
                            if (p14b != 0) {
                                vcant++;
                            }
                            if (p14c != 0) {
                                vcant++;
                            }
                            if (p14d != 0) {
                                vcant++;
                            }

                            var promSeccion = (p12a + p12b + p13a + p13b + p13c + p14a + p14b + p14c + p14d) / vcant;
                            promSeccion = Number(promSeccion.toFixed(2));

                            prom = Number(resp.prom.toFixed(2));

                            //se almacena la evaluación

                            $.post(server + 'guardarEvalSup.php', {
                                    codigo: codigo,
                                    evaluador: evaluador,
                                    cargoeval: cargoeval,
                                    pinicial: pinicial,
                                    pfinal: pfinal,
                                    observaciones: observaciones,
                                    planes: planes,
                                    compromisos: compromisos,
                                    nombres: nombres,
                                    doc: doc,
                                    cargo: cargo,
                                    ods: ods,
                                    prom: promSeccion
                                },
                                function(resp) {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'info',
                                        title: 'Correcto...',
                                        showConfirmButton: false,
                                        timer: 500
                                    })
                                    $('#bv').html('')
                                    $('#cuerpo').html('<center>Evaluación registrada de forma correcta. <button typye="button" class="btn btn-success" onclick="reiniciar()">Realizar otra evaluación</button> </center>')
                                })

                            Swal.fire({
                                position: 'top-end',
                                icon: 'info',
                                title: 'Correcto...',
                                showConfirmButton: false,
                                timer: 500
                            })

                        })
                }

                if (cargoeval == 'LÍDER HSE') {

                    $.post(server + 'guardarCalEvalSupHse.php', {
                            codigo: codigo,
                            p15a: p15a,
                            p15b: p15b,
                            p15c: p15c,
                            p16a: p16a,
                            p16b: p16b,
                            p17a: p17a,
                            p17b: p17b,
                            p17c: p17c,
                            p18a: p18a,
                            p18b: p18b
                        },
                        function(resp) {

                            var vcant = 0;

                            if (p15a != 0) {
                                vcant++;
                            }
                            if (p15b != 0) {
                                vcant++;
                            }
                            if (p15c != 0) {
                                vcant++;
                            }
                            if (p16a != 0) {
                                vcant++;
                            }
                            if (p16b != 0) {
                                vcant++;
                            }
                            if (p17a != 0) {
                                vcant++;
                            }
                            if (p17b != 0) {
                                vcant++;
                            }
                            if (p17c != 0) {
                                vcant++;
                            }
                            if (p18a != 0) {
                                vcant++;
                            }
                            if (p18b != 0) {
                                vcant++;
                            }


                            var promSeccion = (p15a + p15b + p15c + p16a + p16b + p17a + p17b + p17c + p18a + p18b) / vcant;
                            promSeccion = Number(promSeccion.toFixed(2));

                            prom = Number(resp.prom.toFixed(2));

                            //se almacena la evaluación

                            $.post(server + 'guardarEvalSup.php', {
                                    codigo: codigo,
                                    evaluador: evaluador,
                                    cargoeval: cargoeval,
                                    pinicial: pinicial,
                                    pfinal: pfinal,
                                    observaciones: observaciones,
                                    planes: planes,
                                    compromisos: compromisos,
                                    nombres: nombres,
                                    doc: doc,
                                    cargo: cargo,
                                    ods: ods,
                                    prom: promSeccion
                                },
                                function(resp) {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'info',
                                        title: 'Correcto...',
                                        showConfirmButton: false,
                                        timer: 500
                                    })
                                    $('#bv').html('')
                                    $('#cuerpo').html('<center>Evaluación registrada de forma correcta. <button typye="button" class="btn btn-success" onclick="reiniciar()">Realizar otra evaluación</button> </center>')
                                })

                            Swal.fire({
                                position: 'top-end',
                                icon: 'info',
                                title: 'Correcto...',
                                showConfirmButton: false,
                                timer: 500
                            })

                        })
                }

                if (cargoeval == 'LÍDER LOGÍSTICA') {

                    $.post(server + 'guardarCalEvalLog.php', {
                            codigo: codigo,
                            p19a: p19a,
                            p19b: p19b
                        },
                        function(resp) {

                            var vcant = 0;

                            if (p19a != 0) {
                                vcant++;
                            }
                            if (p19b != 0) {
                                vcant++;
                            }

                            var promSeccion = (p19a + p19b) / vcant;
                            promSeccion = Number(promSeccion.toFixed(2));

                            prom = Number(resp.prom.toFixed(2));

                            //se almacena la evaluación

                            $.post(server + 'guardarEvalSup.php', {
                                    codigo: codigo,
                                    evaluador: evaluador,
                                    cargoeval: cargoeval,
                                    pinicial: pinicial,
                                    pfinal: pfinal,
                                    observaciones: observaciones,
                                    planes: planes,
                                    compromisos: compromisos,
                                    nombres: nombres,
                                    doc: doc,
                                    cargo: cargo,
                                    ods: ods,
                                    prom: promSeccion
                                },
                                function(resp) {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'info',
                                        title: 'Correcto...',
                                        showConfirmButton: false,
                                        timer: 500
                                    })
                                    $('#bv').html('')
                                    $('#cuerpo').html('<center>Evaluación registrada de forma correcta. <button typye="button" class="btn btn-success" onclick="reiniciar()">Realizar otra evaluación</button> </center>')
                                })

                            Swal.fire({
                                position: 'top-end',
                                icon: 'info',
                                title: 'Correcto...',
                                showConfirmButton: false,
                                timer: 500
                            })

                        })
                }


                if (cargoeval == 'LÍDER QAQC') {


                    if(p20a != 0 && p20b != 0 && p20c != 0 && p20d != 0 && p20e != 0 && p21 != 0){

                        $.post(server + 'guardarCalEvalSupQaqc.php', {

                            codigo: codigo,
                            p20a: p20a,
                            p20b: p20b,
                            p20c: p20c,
                            p20d: p20d,
                            p20e: p20e,
                            p21: p21
                        },
                        function(resp) {

                            var vcant = 0;

                            if (p20a != 0) {
                                vcant++;
                            }
                            if (p20b != 0) {
                                vcant++;
                            }
                            if (p20c != 0) {
                                vcant++;
                            }
                            if (p20d != 0) {
                                vcant++;
                            }
                            if (p20e != 0) {
                                vcant++;
                            }
                            if (p21 != 0) {
                                vcant++;
                            }


                            var promSeccion = (p20a + p20b + p20c + p20d + p20e + p21) / vcant;
                            promSeccion = Number(promSeccion.toFixed(2));

                            prom = Number(resp.prom.toFixed(2));

                            //se almacena la evaluación

                            $.post(server + 'guardarEvalSup.php', {
                                    codigo: codigo,
                                    evaluador: evaluador,
                                    cargoeval: cargoeval,
                                    pinicial: pinicial,
                                    pfinal: pfinal,
                                    observaciones: observaciones,
                                    planes: planes,
                                    compromisos: compromisos,
                                    nombres: nombres,
                                    doc: doc,
                                    cargo: cargo,
                                    ods: ods,
                                    prom: promSeccion
                                },
                                function(resp) {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'info',
                                        title: 'Correcto...',
                                        showConfirmButton: false,
                                        timer: 500
                                    })
                                    $('#bv').html('')
                                    $('#cuerpo').html('<center>Evaluación registrada de forma correcta. <button typye="button" class="btn btn-success" onclick="reiniciar()">Realizar otra evaluación</button> </center>')
                                })

                            Swal.fire({
                                position: 'top-end',
                                icon: 'info',
                                title: 'Correcto...',
                                showConfirmButton: false,
                                timer: 500
                            })

                        })
                

                    }else{

                        Swal.fire({
                            position: 'top-end',
                            icon: 'info',
                            title: 'Por favor registre todos los datos',
                            showConfirmButton: false,
                            timer: 1500
                        })

                    }
                    
                
                }


                if (cargoeval != 'LÍDER HSE' && cargoeval != 'LÍDER QAQC' && cargoeval != 'LÍDER LOGÍSTICA' && cargoeval != 'LÍDER PLANEACIÓN') {

                    $.post(server + 'guardarCalEvalSup.php', {
                            codigo: codigo,
                            p1: p1,
                            p2: p2,
                            p3: p3,
                            p4: p4,
                            p5: p5,
                            p6: p6,
                            p7: p7,
                            p8: p8,
                            p9: p9,
                            p10: p10,
                            p11: p11
                        },
                        function(resp) {

                            var vcant = 0;

                            if (p1 != 0) {
                                vcant++;
                            }
                            if (p2 != 0) {
                                vcant++;
                            }
                            if (p3 != 0) {
                                vcant++;
                            }
                            if (p4 != 0) {
                                vcant++;
                            }
                            if (p5 != 0) {
                                vcant++;
                            }
                            if (p6 != 0) {
                                vcant++;
                            }
                            if (p7 != 0) {
                                vcant++;
                            }
                            if (p8 != 0) {
                                vcant++;
                            }
                            if (p9 != 0) {
                                vcant++;
                            }
                            if (p10 != 0) {
                                vcant++;
                            }
                            if (p11 != 0) {
                                vcant++;
                            }

                            var promSeccion = (p1 + p2 + p3 + p4 + p5 + p6 + p7 + p8 + p9 + p10 + p11) / vcant;
                            promSeccion = Number(promSeccion.toFixed(2));

                            prom = Number(resp.prom.toFixed(2));

                            //se almacena la evaluación

                            $.post(server + 'guardarEvalSup.php', {
                                    codigo: codigo,
                                    evaluador: evaluador,
                                    cargoeval: cargoeval,
                                    pinicial: pinicial,
                                    pfinal: pfinal,
                                    observaciones: observaciones,
                                    planes: planes,
                                    compromisos: compromisos,
                                    nombres: nombres,
                                    doc: doc,
                                    cargo: cargo,
                                    ods: ods,
                                    prom: promSeccion
                                },
                                function(resp) {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'info',
                                        title: 'Correcto...',
                                        showConfirmButton: false,
                                        timer: 500
                                    })
                                    $('#bv').html('')
                                    $('#cuerpo').html('<center>Evaluación registrada de forma correcta. <button typye="button" class="btn btn-success" onclick="reiniciar()">Realizar otra evaluación</button> </center>')
                                })

                            Swal.fire({
                                position: 'top-end',
                                icon: 'info',
                                title: 'Correcto...',
                                showConfirmButton: false,
                                timer: 500
                            })

                        })
                }



            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'Por favor registre todos los datos y una observación',
                    showConfirmButton: false,
                    timer: 1500
                })
            }

        }

        function reiniciar() {
            location.reload()
        }
