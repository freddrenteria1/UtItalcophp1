
            var url = 'https://utitalco.com/proveedores/server/'
            var userprov = sessionStorage.getItem('userprov')
            var emp_login = sessionStorage.getItem('empresa')

            var a1
            var a2
            var a3
            var a4
            var a5
            var a6
            var a7
            var a8

            var arrayS1 = []
            var arrayS2 = []
            var arrayS3 = []
            var arrayS4 = []
            var arrayS5 = []
            var arrayS6 = []

            var arrayL1 = []
            var arrayL2 = []
            var arrayL3 = []

            var imgdoc = ` <img src="img/doc.webp" height="50px" alt="">`

            if (userprov == null) {
                location = 'login.html'
            } else {
                $('#emp_login').html(emp_login);
            }

            document.body.style.zoom = "75%";

            cargar_datos()
            cargar_datos_tribu()
            cargar_datos_com()
            cargar_datos_fin()
            cargar_datos_exp()
            cargar_doc()
            cargar_datos_seg()
            cargar_anexob()

            function subir(e) {
                console.log(e.id)
                if (e.id == 'docam') {
                    $('#viewdoccam').html(imgdoc)
                }
                if (e.id == 'docrut') {
                    $('#viewdocrut').html(imgdoc)
                }
                if (e.id == 'docestados') {
                    $('#viewdocestados').html(imgdoc)
                }
                if (e.id == 'docportafolio') {
                    $('#viewdocportafolio').html(imgdoc)
                }
                if (e.id == 'doccertarl') {
                    $('#viewdoccertarl').html(imgdoc)
                }
                if (e.id == 'dociso') {
                    $('#viewdociso').html(imgdoc)
                }
                if (e.id == 'docaccidentalidad') {
                    $('#viewdocacc').html(imgdoc)
                }

                if (e.id == 'doca1') {
                    $('#viewdoca1').html(imgdoc)
                }
                if (e.id == 'doca2') {
                    $('#viewdoca2').html(imgdoc)
                }
                if (e.id == 'doca3') {
                    $('#viewdoca3').html(imgdoc)
                }
                if (e.id == 'doca4') {
                    $('#viewdoca4').html(imgdoc)
                }
                if (e.id == 'doca5') {
                    $('#viewdoca5').html(imgdoc)
                }
                if (e.id == 'doca6') {
                    $('#viewdoca6').html(imgdoc)
                }
                if (e.id == 'doca7') {
                    $('#viewdoca7').html(imgdoc)
                }
                if (e.id == 'doca8') {
                    $('#viewdoca8').html(imgdoc)
                }
            }

            function subirArchivosDoc() {

                cargando()

                file1 = $('#docam')[0].files[0];
                file2 = $('#docrut')[0].files[0];
                file3 = $('#docestados')[0].files[0];
                file4 = $('#docportafolio')[0].files[0];
                file5 = $('#doccertarl')[0].files[0];
                file6 = $('#dociso')[0].files[0];

                var formData = new FormData();

                formData.append('file1', file1);
                formData.append('file2', file2);
                formData.append('file3', file3);
                formData.append('file4', file4);
                formData.append('file5', file5);
                formData.append('file6', file6);
                formData.append('user', userprov)

                $.ajax({
                    url: url + 'guardarDoc.php',
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Documentos Cargados...',
                            showConfirmButton: true
                        }).then(() => {

                        })
                    }
                })
            }

            function cargar_doc() {

                $.post(url + 'cargarDatosDoc.php', {
                    user: userprov
                }, function(resp) {

                    console.log(resp)

                    if (resp != null) {

                        if (resp.file1 != '') {
                            html = `<a href="https://utitalco.com/proveedores/server/archivos/${resp.file1}" target="_blank">
                                <img src="img/doc.webp" height="50px" alt=""></a>`
                            $('#viewdoccam').html(html)
                        }
                        if (resp.file2 != '') {
                            html = `<a href="https://utitalco.com/proveedores/server/archivos/${resp.file2}" target="_blank">
                                <img src="img/doc.webp" height="50px" alt=""></a>`
                            $('#viewdocrut').html(html)
                        }
                        if (resp.file3 != '') {
                            html = `<a href="https://utitalco.com/proveedores/server/archivos/${resp.file3}" target="_blank">
                                <img src="img/doc.webp" height="50px" alt=""></a>`
                            $('#viewdocestados').html(html)
                        }
                        if (resp.file4 != '') {
                            html = `<a href="https://utitalco.com/proveedores/server/archivos/${resp.file4}" target="_blank">
                                <img src="img/doc.webp" height="50px" alt=""></a>`
                            $('#viewdocportafolio').html(html)
                        }
                        if (resp.file5 != '') {
                            html = `<a href="https://utitalco.com/proveedores/server/archivos/${resp.file5}" target="_blank">
                                <img src="img/doc.webp" height="50px" alt=""></a>`
                            $('#viewdoccertarl').html(html)
                        }
                        if (resp.file6 != '') {
                            html = `<a href="https://utitalco.com/proveedores/server/archivos/${resp.file6}" target="_blank">
                                <img src="img/doc.webp" height="50px" alt=""></a>`
                            $('#viewdociso').html(html)
                        }


                    }



                })

            }

            function cargar_datos_seg() {
                $.post(url + 'cargarDatosSeg.php', {
                    user: userprov
                }, function(resp) {
                    console.log(resp)

                    if (resp != null) {

                        if (resp.archivo != "") {
                            html = `<a href="https://utitalco.com/proveedores/server/archivos/${resp.archivo}" target="_blank">
                                    <img src="img/doc.webp" height="50px" alt=""></a>`
                            $('#viewdocacc').html(html)
                        }

                        if (resp.s1 != "") {
                            arrayS1 = JSON.parse(resp.s1)
                            $('#s12018').val(arrayS1[0].A2018)
                            $('#s12019').val(arrayS1[0].A2019)
                            $('#s12020').val(arrayS1[0].A2020)
                            $('#s12021').val(arrayS1[0].A2021)
                            $('#s12022').val(arrayS1[0].A2022)
                        }

                        if (resp.s2 != "") {
                            arrayS2 = JSON.parse(resp.s2)
                            $('#s22018').val(arrayS2[0].A2018)
                            $('#s22019').val(arrayS2[0].A2019)
                            $('#s22020').val(arrayS2[0].A2020)
                            $('#s22021').val(arrayS2[0].A2021)
                            $('#s22022').val(arrayS2[0].A2022)
                        }


                        if (resp.s3 != "") {
                            arrayS3 = JSON.parse(resp.s3)
                            $('#s32018').val(arrayS3[0].A2018)
                            $('#s32019').val(arrayS3[0].A2019)
                            $('#s32020').val(arrayS3[0].A2020)
                            $('#s32021').val(arrayS3[0].A2021)
                            $('#s32022').val(arrayS3[0].A2022)
                        }

                        if (resp.s4 != "") {
                            arrayS4 = JSON.parse(resp.s4)
                            $('#s42018').val(arrayS4[0].A2018)
                            $('#s42019').val(arrayS4[0].A2019)
                            $('#s42020').val(arrayS4[0].A2020)
                            $('#s42021').val(arrayS4[0].A2021)
                            $('#s42022').val(arrayS4[0].A2022)
                        }

                        if (resp.s5 != '') {
                            arrayS5 = JSON.parse(resp.s5)
                            $('#s52018').val(arrayS5[0].A2018)
                            $('#s52019').val(arrayS5[0].A2019)
                            $('#s52020').val(arrayS5[0].A2020)
                            $('#s52021').val(arrayS5[0].A2021)
                            $('#s52022').val(arrayS5[0].A2022)
                        }

                        if (resp.s6 != '') {
                            arrayS6 = JSON.parse(resp.s6)
                            $('#s62018').val(arrayS6[0].A2018)
                            $('#s62019').val(arrayS6[0].A2019)
                            $('#s62020').val(arrayS6[0].A2020)
                            $('#s62021').val(arrayS6[0].A2021)
                            $('#s62022').val(arrayS6[0].A2022)
                        }

                        if (resp.l1 != '') {
                            arrayL1 = JSON.parse(resp.l1)
                            $('#l12018').val(arrayL1[0].A2018)
                            $('#l12019').val(arrayL1[0].A2019)
                            $('#l12020').val(arrayL1[0].A2020)
                            $('#l12021').val(arrayL1[0].A2021)
                            $('#l12022').val(arrayL1[0].A2022)
                        }

                        if (resp.l2 != '') {
                            arrayL2 = JSON.parse(resp.l2)
                            $('#l22018').val(arrayL2[0].A2018)
                            $('#l22019').val(arrayL2[0].A2019)
                            $('#l22020').val(arrayL2[0].A2020)
                            $('#l22021').val(arrayL2[0].A2021)
                            $('#l22022').val(arrayL2[0].A2022)
                        }

                        if (resp.l3 != '') {
                            arrayL3 = JSON.parse(resp.l3)
                            $('#l32018').val(arrayL3[0].A2018)
                            $('#l32019').val(arrayL3[0].A2019)
                            $('#l32020').val(arrayL3[0].A2020)
                            $('#l32021').val(arrayL3[0].A2021)
                            $('#l32022').val(arrayL3[0].A2022)
                        }
                    }

                })
            }

            function cargar_datos() {
                $.post(url + 'cargarDatosProv.php', {
                    user: userprov
                }, function(resp) {

                    if (resp != null) {

                        console.log(resp)

                        $('#empresa').val(resp.empresa)
                        $('#tipodoc').val(resp.tipodoc)
                        $('#docemp').val(resp.docemp)
                        $('#replegal').val(resp.replegal)
                        $('#cedreplegal').val(resp.cedreplegal)
                        $('#dirofi').val(resp.dirofi)
                        $('#tel').val(resp.tel)
                        $('#email').val(resp.email)
                        $('#web').val(resp.web)
                        $('#pais').val(resp.pais)
                        $('#ciudad').val(resp.ciudad)
                        $('#nombcont').val(resp.nombcont)
                        $('#cargonombcont').val(resp.cargonombcont)
                        $('#emailnombcont').val(resp.emailnombcont)
                        $('#telnombcont').val(resp.telnombcont)
                        $('#nombcom').val(resp.nombcom)
                        $('#cargonombcom').val(resp.cargonombcom)
                        $('#emailnombcom').val(resp.emailnombcom)
                        $('#telnombcom').val(resp.telnombcom)
                        $('#tipocta').val(resp.tipocta)
                        $('#codbanco').val(resp.codbanco)
                        $('#entidad').val(resp.entidad)
                        $('#numcuenta').val(resp.numcuenta)
                        $('#titularcta').val(resp.titularcta)
                    }

                })
            }

            function cargar_datos_tribu() {
                $.post(url + 'cargarDatosTrib.php', {
                    user: userprov
                }, function(resp) {

                    if (resp != null) {

                        console.log(resp)

                        tipoact = resp.tipoact
                        if (tipoact == 'Comercial') {
                            $('#actcomercial').prop('checked', true);
                        }
                        if (tipoact == 'Servicios') {
                            $('#actservicios').prop('checked', true);
                        }
                        if (tipoact == 'Industrial') {
                            $('#actindustrial').prop('checked', true);
                        }

                        tipopersona = resp.tipopersona
                        if (tipopersona == 'Natural') {
                            $('#tiponatural').prop('checked', true);
                        }
                        if (tipopersona == 'Jurídica') {
                            $('#tipojuridica').prop('checked', true);
                        }
                        if (tipopersona == 'Natural responsable de IVA') {
                            $('#tiponatrespiva').prop('checked', true);
                        }

                        regimen = resp.regimen
                        if (regimen == 'Común') {
                            $('#regcomun').prop('checked', true);
                        }
                        if (regimen == 'Simplificado') {
                            $('#regsimple').prop('checked', true);
                        }

                        $('#actprincipal').val(resp.actprincipal)

                        grancontri = resp.grancontri
                        if (grancontri == 'SI') {
                            $('#grancontrisi').prop('checked', true);
                            $('#resgrancontri').val(resp.resgran)
                            $('#fecharesgrancontri').val(resp.fecharesgran)
                        }
                        if (grancontri == 'NO') {
                            $('#grancontrino').prop('checked', true);
                        }

                        autoretenedor = resp.autoretenedor

                        if (autoretenedor == 'SI') {
                            $('#autoretesi').prop('checked', true);
                            $('#resautorete').val(resp.resauto)
                            $('#fecharesautorete').val(resp.fecharesauto)
                        }
                        if (autoretenedor == 'NO') {
                            $('#autoreteno').prop('checked', true);
                        }

                        excentorete = resp.excentorete
                        if (excentorete == 'SI') {
                            $('#excentoretesi').prop('checked', true);
                            $('#resexcentorete').val(resp.resexcentorete)
                            $('#fecharesexcentorete').val(resp.fecharesexcentorete)
                        }
                        if (excentorete == 'NO') {
                            $('#excentoreteno').prop('checked', true);
                        }

                        excentoica = resp.excentoica
                        if (excentoica == 'SI') {
                            $('#excentoicasi').prop('checked', true);
                            $('#resexcentoica').val(resp.resexcentoica)
                            $('#fecharesexcentoica').val(resp.fecharesexcentoica)
                        }
                        if (excentoica == 'NO') {
                            $('#excentoicano').prop('checked', true);
                        }

                        $('#ciiu').val(resp.ciiu)
                        $('#fechaciiu').val(resp.fechaciiu)
                        $('#tarifaica').val(resp.tarifaica)
                        $('#ciudadtarifaica').val(resp.ciudadica)
                    }

                })
            }

            function cargar_datos_com() {
                $.post(url + 'cargarDatosCom.php', {
                    user: userprov
                }, function(resp) {

                    if (resp != null) {

                        console.log(resp)

                        formapago = resp.formapago

                        if (formapago == 'Contraentrega') {
                            $('#contraentrega').prop('checked', true);
                        }
                        if (formapago == 'Anticipado') {
                            $('#anticipado').prop('checked', true);
                        }
                        if (formapago == 'Crédito') {
                            $('#credito').prop('checked', true);
                        }

                        $('#diasplazo').val(resp.plazo)
                        $('#bien1').val(resp.servicio1)
                        $('#bien2').val(resp.servicio2)
                        $('#bien3').val(resp.servicio3)

                        $('#refemp1').val(resp.emp1)
                        $('#servemp1').val(resp.servicioemp1)
                        $('#contactoemp1').val(resp.contactoemp1)
                        $('#telemp1').val(resp.telcontactoemp1)

                        $('#refemp2').val(resp.emp2)
                        $('#servemp2').val(resp.servicioemp2)
                        $('#contactoemp2').val(resp.contactoemp2)
                        $('#telemp2').val(resp.telcontactoemp2)
                    }

                })
            }

            function cargar_datos_fin() {
                $.post(url + 'cargarDatosFin.php', {
                    user: userprov
                }, function(resp) {

                    if (resp != null) {

                        console.log(resp)

                        $('#totactcorr').val(resp.activoscorr)
                        $('#totactnocorr').val(resp.activosnocorr)
                        $('#totpascorr').val(resp.pasivocorr)
                        $('#totpasnocorr').val(resp.pasivonocorr)
                        $('#totpat').val(resp.patrimonio)

                        $('#toting').val(resp.ingresos)
                        $('#totgastos').val(resp.gastos)
                        $('#totcostos').val(resp.costos)
                        $('#totutilneta').val(resp.utilidad)

                    }

                })
            }

            function cargar_datos_exp() {
                $.post(url + 'cargarDatosExp.php', {
                    user: userprov
                }, function(resp) {

                    if (resp != null) {

                        console.log(resp)

                        $('#clienteexp1').val(resp.cliente1)
                        $('#objexp1').val(resp.contratoc1)
                        $('#diasexp1').val(resp.plazoc1)
                        $('#finicioexp1').val(resp.finicioc1)
                        $('#ffinexp1').val(resp.ffinc1)
                        $('#valorexp1').val(resp.valorc1)

                        $('#clienteexp2').val(resp.cliente2)
                        $('#objexp2').val(resp.contratoc2)
                        $('#diasexp2').val(resp.plazoc2)
                        $('#finicioexp2').val(resp.finicioc2)
                        $('#ffinexp2').val(resp.ffinc2)
                        $('#valorexp2').val(resp.valorc2)

                        $('#clienteexp3').val(resp.cliente3)
                        $('#objexp3').val(resp.contratoc3)
                        $('#diasexp3').val(resp.plazoc3)
                        $('#finicioexp3').val(resp.finicioc3)
                        $('#ffinexp3').val(resp.ffinc3)
                        $('#valorexp3').val(resp.valorc3)
                    }

                })
            }

            function cargar_anexob() {

                $.post(url + 'cargarDatosAnexoB.php', {
                    user: userprov
                }, function(resp) {

                    if (resp != null) {

                        console.log('Anexo b')
                        console.log(resp)

                        var a1 = resp[0].estado;
                        var obs1 = resp[0].obs;
                        var archivo1 = resp[0].archivo;

                        if (a1 == "SI") {
                            $('#a1si').prop('checked', true);
                        }
                        if (a1 == "NO") {
                            $('#a1no').prop('checked', true);
                        }
                        if (a1 == "NA") {
                            $('#a1na').prop('checked', true);
                        }
                        $('#obsea1').val(obs1)
                        if (archivo1 != "") {
                            var html = `<a href="https://utitalco.com/proveedores/server/archivos/${archivo1}" target="_blank">
                <img src="img/doc.webp" height="50px" alt=""></a>`
                            $('#viewdoca1').html(html)
                        }

                        var a = resp[1].estado;
                        var obs = resp[1].obs;
                        var archivo = resp[1].archivo;

                        if (a == "SI") {
                            $('#a2si').prop('checked', true);
                        }
                        if (a == "NO") {
                            $('#a2no').prop('checked', true);
                        }
                        if (a == "NA") {
                            $('#a2na').prop('checked', true);
                        }
                        $('#obsea2').val(obs)
                        if (archivo != "") {
                            var html = `<a href="https://utitalco.com/proveedores/server/archivos/${archivo}" target="_blank">
                <img src="img/doc.webp" height="50px" alt=""></a>`
                            $('#viewdoca2').html(html)
                        }

                        var a = resp[2].estado;
                        var obs = resp[2].obs;
                        var archivo = resp[2].archivo;

                        if (a == "SI") {
                            $('#a3si').prop('checked', true);
                        }
                        if (a == "NO") {
                            $('#a3no').prop('checked', true);
                        }
                        if (a == "NA") {
                            $('#a3na').prop('checked', true);
                        }
                        $('#obsea3').val(obs)
                        if (archivo != "") {
                            var html = `<a href="https://utitalco.com/proveedores/server/archivos/${archivo}" target="_blank">
                <img src="img/doc.webp" height="50px" alt=""></a>`
                            $('#viewdoca3').html(html)
                        }

                        var a = resp[3].estado;
                        var obs = resp[3].obs;
                        var archivo = resp[3].archivo;

                        if (a == "SI") {
                            $('#a4si').prop('checked', true);
                        }
                        if (a == "NO") {
                            $('#a4no').prop('checked', true);
                        }
                        if (a == "NA") {
                            $('#a4na').prop('checked', true);
                        }
                        $('#obsea4').val(obs)
                        if (archivo != "") {
                            var html = `<a href="https://utitalco.com/proveedores/server/archivos/${archivo}" target="_blank">
                <img src="img/doc.webp" height="50px" alt=""></a>`
                            $('#viewdoca4').html(html)
                        }

                        var a = resp[4].estado;
                        var obs = resp[4].obs;
                        var archivo = resp[4].archivo;

                        if (a == "SI") {
                            $('#a5si').prop('checked', true);
                        }
                        if (a == "NO") {
                            $('#a5no').prop('checked', true);
                        }
                        if (a == "NA") {
                            $('#a5na').prop('checked', true);
                        }
                        $('#obsea5').val(obs)
                        if (archivo != "") {
                            var html = `<a href="https://utitalco.com/proveedores/server/archivos/${archivo}" target="_blank">
                <img src="img/doc.webp" height="50px" alt=""></a>`
                            $('#viewdoca5').html(html)
                        }

                        var a = resp[5].estado;
                        var obs = resp[5].obs;
                        var archivo = resp[5].archivo;

                        if (a == "SI") {
                            $('#a6si').prop('checked', true);
                        }
                        if (a == "NO") {
                            $('#a6no').prop('checked', true);
                        }
                        if (a == "NA") {
                            $('#a6na').prop('checked', true);
                        }
                        $('#obsea6').val(obs)
                        if (archivo != "") {
                            var html = `<a href="https://utitalco.com/proveedores/server/archivos/${archivo}" target="_blank">
                <img src="img/doc.webp" height="50px" alt=""></a>`
                            $('#viewdoca6').html(html)
                        }

                        var a = resp[6].estado;
                        var obs = resp[6].obs;
                        var archivo = resp[6].archivo;

                        if (a == "SI") {
                            $('#a7si').prop('checked', true);
                        }
                        if (a == "NO") {
                            $('#a7no').prop('checked', true);
                        }
                        if (a == "NA") {
                            $('#a7na').prop('checked', true);
                        }
                        $('#obsea7').val(obs)
                        if (archivo != "") {
                            var html = `<a href="https://utitalco.com/proveedores/server/archivos/${archivo}" target="_blank">
                <img src="img/doc.webp" height="50px" alt=""></a>`
                            $('#viewdoca7').html(html)
                        }

                        var a = resp[7].estado;
                        var obs = resp[7].obs;
                        var archivo = resp[7].archivo;

                        if (a == "SI") {
                            $('#a8si').prop('checked', true);
                        }
                        if (a == "NO") {
                            $('#a8no').prop('checked', true);
                        }
                        if (a == "NA") {
                            $('#a8na').prop('checked', true);
                        }
                        $('#obsea8').val(obs)
                        if (archivo != "") {
                            var html = `<a href="https://utitalco.com/proveedores/server/archivos/${archivo}" target="_blank">
                <img src="img/doc.webp" height="50px" alt=""></a>`
                            $('#viewdoca8').html(html)
                        }


                    }
                })
            }

            function guardar_datos() {
                empresa = $('#empresa').val()
                tipodoc = $('#tipodoc').val()
                docemp = $('#docemp').val()
                replegal = $('#replegal').val()
                cedreplegal = $('#cedreplegal').val()
                dirofi = $('#dirofi').val()
                tel = $('#tel').val()
                email = $('#email').val()
                web = $('#web').val()
                pais = $('#pais').val()
                ciudad = $('#ciudad').val()
                nombcont = $('#nombcont').val()
                cargonombcont = $('#cargonombcont').val()
                emailnombcont = $('#emailnombcont').val()
                telnombcont = $('#telnombcont').val()
                nombcom = $('#nombcom').val()
                cargonombcom = $('#cargonombcom').val()
                emailnombcom = $('#emailnombcom').val()
                telnombcom = $('#telnombcom').val()
                tipocta = $('#tipocta').val()
                codbanco = $('#codbanco').val()
                entidad = $('#entidad').val()
                numcuenta = $('#numcuenta').val()
                titularcta = $('#titularcta').val()

                $.post(url + 'guardarDatosProv.php', {
                    user: userprov,
                    empresa: empresa,
                    tipodoc: tipodoc,
                    docemp: docemp,
                    replegal: replegal,
                    cedreplegal: cedreplegal,
                    dirofi: dirofi,
                    tel: tel,
                    email: email,
                    web: web,
                    pais: pais,
                    ciudad: ciudad,
                    nombcont: nombcont,
                    cargonombcont: cargonombcont,
                    emailnombcont: emailnombcont,
                    telnombcont: telnombcont,
                    nombcom: nombcom,
                    cargonombcom: cargonombcom,
                    emailnombcom: emailnombcom,
                    telnombcom: telnombcom,
                    tipocta: tipocta,
                    codbanco: codbanco,
                    entidad: entidad,
                    numcuenta: numcuenta,
                    titularcta: titularcta
                }, function(resp) {
                    if (resp.msn == 'Ok') {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Datos Cargados...',
                            showConfirmButton: true
                        })

                    } else {
                        alert(resp.msn)
                    }
                })



            }

            function guardar_info_trib() {

                if ($('#actcomercial').is(':checked')) {
                    actividad = 'Comercial'
                }
                if ($('#actservicios').is(':checked')) {
                    actividad = 'Servicios'
                }
                if ($('#actindustrial').is(':checked')) {
                    actividad = 'Industrial'
                }

                if ($('#tiponatural').is(':checked')) {
                    tipopersona = 'Natural'
                }
                if ($('#tipojuridica').is(':checked')) {
                    tipopersona = 'Jurídica'
                }
                if ($('#tiponatrespiva').is(':checked')) {
                    tipopersona = 'Natural responsable de IVA'
                }

                if ($('#regcomun').is(':checked')) {
                    regimen = 'Común'
                }
                if ($('#regsimple').is(':checked')) {
                    regimen = 'Simplificado'
                }

                actprincipal = $('#actprincipal').val()

                if ($('#grancontrisi').is(':checked')) {
                    grancontri = 'SI'
                }

                if ($('#grancontrino').is(':checked')) {
                    grancontri = 'NO'
                }

                resgrancontri = $('#resgrancontri').val()
                fecharesgrancontri = $('#fecharesgrancontri').val()

                if ($('#autoretesi').is(':checked')) {
                    autorete = 'SI'
                }

                if ($('#autoreteno').is(':checked')) {
                    autorete = 'NO'
                }

                resautorete = $('#resautorete').val()
                fecharesautorete = $('#fecharesautorete').val()

                if ($('#excentoretesi').is(':checked')) {
                    excentorete = 'SI'
                }

                if ($('#excentoreteno').is(':checked')) {
                    excentorete = 'NO'
                }

                resexcentorete = $('#resexcentorete').val()
                fecharesexcentorete = $('#fecharesexcentorete').val()

                if ($('#excentoicasi').is(':checked')) {
                    excentoica = 'SI'
                }

                if ($('#excentoicano').is(':checked')) {
                    excentoica = 'NO'
                }

                resexcentoica = $('#resexcentoica').val()
                fecharesexcentoica = $('#fecharesexcentoica').val()

                ciiu = $('#ciiu').val()
                fechaciiu = $('#fechaciiu').val()
                tarifaica = $('#tarifaica').val()
                ciudadtarifaica = $('#ciudadtarifaica').val()

                $.post(url + 'guardarDatosTribu.php', {
                    user: userprov,
                    actividad: actividad,
                    tipopersona: tipopersona,
                    regimen: regimen,
                    actprincipal: actprincipal,
                    grancontri: grancontri,
                    resgrancontri: resgrancontri,
                    fecharesgrancontri: fecharesgrancontri,
                    autorete: autorete,
                    resautorete: resautorete,
                    fecharesautorete: fecharesautorete,
                    excentorete: excentorete,
                    resexcentorete: resexcentorete,
                    fecharesexcentorete: fecharesexcentorete,
                    excentoica: excentoica,
                    resexcentoica: resexcentoica,
                    fecharesexcentoica: fecharesexcentoica,
                    ciiu: ciiu,
                    fechaciiu: fechaciiu,
                    tarifaica: tarifaica,
                    ciudadtarifaica: ciudadtarifaica
                }, function(resp) {
                    if (resp.msn == 'Ok') {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Datos Cargados...',
                            showConfirmButton: true
                        })

                    } else {
                        alert(resp.msn)
                    }
                })



            }

            function guardar_info_com() {

                if ($('#contraentrega').is(':checked')) {
                    formapago = 'Contraentrega'
                }
                if ($('#anticipado').is(':checked')) {
                    formapago = 'Anticipado'
                }
                if ($('#credito').is(':checked')) {
                    formapago = 'Crédito'
                }

                diasplazo = $('#diasplazo').val()
                bien1 = $('#bien1').val()
                bien2 = $('#bien2').val()
                bien3 = $('#bien3').val()

                refemp1 = $('#refemp1').val()
                servemp1 = $('#servemp1').val()
                contactoemp1 = $('#contactoemp1').val()
                telemp1 = $('#telemp1').val()

                refemp2 = $('#refemp2').val()
                servemp2 = $('#servemp2').val()
                contactoemp2 = $('#contactoemp2').val()
                telemp2 = $('#telemp2').val()

                $.post(url + 'guardarDatosCom.php', {
                    user: userprov,
                    formapago: formapago,
                    diasplazo: diasplazo,
                    bien1: bien1,
                    bien2: bien2,
                    bien3: bien3,
                    refemp1: refemp1,
                    servemp1: servemp1,
                    contactoemp1: contactoemp1,
                    telemp1: telemp1,
                    refemp2: refemp2,
                    servemp2: servemp2,
                    contactoemp2: contactoemp2,
                    telemp2: telemp2

                }, function(resp) {
                    if (resp.msn == 'Ok') {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Datos Cargados...',
                            showConfirmButton: true
                        })

                    } else {
                        alert(resp.msn)
                    }
                })

            }

            function guardarSeguridad() {

                s12018 = $('#s12018').val()
                s12019 = $('#s12019').val()
                s12020 = $('#s12020').val()
                s12021 = $('#s12021').val()
                s12022 = $('#s12022').val()

                var arrayS1 = []
                arrayS1.push({
                    'A2018': s12018,
                    'A2019': s12019,
                    'A2020': s12020,
                    'A2021': s12021,
                    'A2022': s12022
                })

                s22018 = $('#s22018').val()
                s22019 = $('#s22019').val()
                s22020 = $('#s22020').val()
                s22021 = $('#s22021').val()
                s22022 = $('#s22022').val()

                var arrayS2 = []
                arrayS2.push({
                    'A2018': s22018,
                    'A2019': s22019,
                    'A2020': s22020,
                    'A2021': s22021,
                    'A2022': s22022
                })

                s32018 = $('#s32018').val()
                s32019 = $('#s32019').val()
                s32020 = $('#s32020').val()
                s32021 = $('#s32021').val()
                s32022 = $('#s32022').val()

                var arrayS3 = []
                arrayS3.push({
                    'A2018': s32018,
                    'A2019': s32019,
                    'A2020': s32020,
                    'A2021': s32021,
                    'A2022': s32022
                })

                s42018 = $('#s42018').val()
                s42019 = $('#s42019').val()
                s42020 = $('#s42020').val()
                s42021 = $('#s42021').val()
                s42022 = $('#s42022').val()

                var arrayS4 = []
                arrayS4.push({
                    'A2018': s42018,
                    'A2019': s42019,
                    'A2020': s42020,
                    'A2021': s42021,
                    'A2022': s42022
                })

                s52018 = $('#s52018').val()
                s52019 = $('#s52019').val()
                s52020 = $('#s52020').val()
                s52021 = $('#s52021').val()
                s52022 = $('#s52022').val()

                var arrayS5 = []
                arrayS5.push({
                    'A2018': s52018,
                    'A2019': s52019,
                    'A2020': s52020,
                    'A2021': s52021,
                    'A2022': s52022
                })

                s62018 = $('#s62018').val()
                s62019 = $('#s62019').val()
                s62020 = $('#s62020').val()
                s62021 = $('#s62021').val()
                s62022 = $('#s62022').val()

                var arrayS6 = []
                arrayS6.push({
                    'A2018': s62018,
                    'A2019': s62019,
                    'A2020': s62020,
                    'A2021': s62021,
                    'A2022': s62022
                })

                l12018 = $('#l12018').val()
                l12019 = $('#l12019').val()
                l12020 = $('#l12020').val()
                l12021 = $('#l12021').val()
                l12022 = $('#l12022').val()

                var arrayL1 = []
                arrayL1.push({
                    'A2018': l12018,
                    'A2019': l12019,
                    'A2020': l12020,
                    'A2021': l12021,
                    'A2022': l12022
                })

                l22018 = $('#l22018').val()
                l22019 = $('#l22019').val()
                l22020 = $('#l22020').val()
                l22021 = $('#l22021').val()
                l22022 = $('#l22022').val()

                var arrayL2 = []
                arrayL2.push({
                    'A2018': l22018,
                    'A2019': l22019,
                    'A2020': l22020,
                    'A2021': l22021,
                    'A2022': l22022
                })

                l32018 = $('#l32018').val()
                l32019 = $('#l32019').val()
                l32020 = $('#l32020').val()
                l32021 = $('#l32021').val()
                l32022 = $('#l32022').val()

                var arrayL3 = []
                arrayL3.push({
                    'A2018': l32018,
                    'A2019': l32019,
                    'A2020': l32020,
                    'A2021': l32021,
                    'A2022': l32022
                })

                var formData = new FormData();

                file = $('#docaccidentalidad')[0].files[0];

                formData.append('user', userprov)
                formData.append('file', file)
                formData.append('arrayS1', JSON.stringify(arrayS1))
                formData.append('arrayS2', JSON.stringify(arrayS2))
                formData.append('arrayS3', JSON.stringify(arrayS3))
                formData.append('arrayS4', JSON.stringify(arrayS4))
                formData.append('arrayS5', JSON.stringify(arrayS5))
                formData.append('arrayS6', JSON.stringify(arrayS6))
                formData.append('arrayL1', JSON.stringify(arrayL1))
                formData.append('arrayL2', JSON.stringify(arrayL2))
                formData.append('arrayL3', JSON.stringify(arrayL3))
                cargando()
                $.ajax({
                    url: url + 'guardarDatosSeg.php',
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.msn == 'Ok') {

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Datos Cargados...',
                                showConfirmButton: true
                            }).then(() => {

                            })

                        } else {
                            alert(resp.msn)
                        }

                    }
                })
            }

            function guardar_info_fin() {

                totactcorr = $('#totactcorr').val()
                totactnocorr = $('#totactnocorr').val()
                totpascorr = $('#totpascorr').val()
                totpasnocorr = $('#totpasnocorr').val()
                totpat = $('#totpat').val()

                toting = $('#toting').val()
                totgastos = $('#totgastos').val()
                totcostos = $('#totcostos').val()
                totutilneta = $('#totutilneta').val()

                $.post(url + 'guardarDatosFin.php', {
                    user: userprov,
                    totactcorr: totactcorr,
                    totactnocorr: totactnocorr,
                    totpascorr: totpascorr,
                    totpasnocorr: totpasnocorr,
                    totpat: totpat,
                    toting: toting,
                    totgastos: totgastos,
                    totcostos: totcostos,
                    totutilneta: totutilneta

                }, function(resp) {
                    if (resp.msn == 'Ok') {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Datos Cargados...',
                            showConfirmButton: true
                        })

                    } else {
                        alert(resp.msn)
                    }
                })

            }

            function guardar_info_exp() {

                clienteexp1 = $('#clienteexp1').val()
                objexp1 = $('#objexp1').val()
                diasexp1 = $('#diasexp1').val()
                finicioexp1 = $('#finicioexp1').val()
                ffinexp1 = $('#ffinexp1').val()
                valorexp1 = $('#valorexp1').val()

                clienteexp2 = $('#clienteexp2').val()
                objexp2 = $('#objexp2').val()
                diasexp2 = $('#diasexp2').val()
                finicioexp2 = $('#finicioexp2').val()
                ffinexp2 = $('#ffinexp2').val()
                valorexp2 = $('#valorexp2').val()

                clienteexp3 = $('#clienteexp3').val()
                objexp3 = $('#objexp3').val()
                diasexp3 = $('#diasexp3').val()
                finicioexp3 = $('#finicioexp3').val()
                ffinexp3 = $('#ffinexp3').val()
                valorexp3 = $('#valorexp3').val()


                $.post(url + 'guardarDatosExp.php', {
                    user: userprov,
                    clienteexp1: clienteexp1,
                    objexp1: objexp1,
                    diasexp1: diasexp1,
                    finicioexp1: finicioexp1,
                    ffinexp1: ffinexp1,
                    valorexp1: valorexp1,
                    clienteexp2: clienteexp2,
                    objexp2: objexp2,
                    diasexp2: diasexp2,
                    finicioexp2: finicioexp2,
                    ffinexp2: ffinexp2,
                    valorexp2: valorexp2,
                    clienteexp3: clienteexp3,
                    objexp3: objexp3,
                    diasexp3: diasexp3,
                    finicioexp3: finicioexp3,
                    ffinexp3: ffinexp3,
                    valorexp3: valorexp3

                }, function(resp) {
                    if (resp.msn == 'Ok') {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Datos Cargados...',
                            showConfirmButton: true
                        })

                    } else {
                        alert(resp.msn)
                    }
                })

            }


            function guardar_anexob() {

                if ($('#a1si').is(':checked')) {
                    a1 = 'SI'
                }
                if ($('#a1no').is(':checked')) {
                    a1 = 'NO'
                }
                if ($('#a1na').is(':checked')) {
                    a1 = 'NA'
                }
                obsea1 = $('#obsea1').val()
                filea1 = $('#doca1')[0].files[0];

                if ($('#a2si').is(':checked')) {
                    a2 = 'SI'
                }
                if ($('#a2no').is(':checked')) {
                    a2 = 'NO'
                }
                if ($('#a2na').is(':checked')) {
                    a2 = 'NA'
                }

                obsea2 = $('#obsea2').val()
                filea2 = $('#doca2')[0].files[0];

                if ($('#a3si').is(':checked')) {
                    a3 = 'SI'
                }
                if ($('#a3no').is(':checked')) {
                    a3 = 'NO'
                }
                if ($('#a3na').is(':checked')) {
                    a3 = 'NA'
                }
                obsea3 = $('#obsea3').val()
                filea3 = $('#doca3')[0].files[0];

                if ($('#a4si').is(':checked')) {
                    a4 = 'SI'
                }
                if ($('#a4no').is(':checked')) {
                    a4 = 'NO'
                }
                if ($('#a4na').is(':checked')) {
                    a4 = 'NA'
                }
                obsea4 = $('#obsea4').val()
                filea4 = $('#doca4')[0].files[0];

                if ($('#a5si').is(':checked')) {
                    a5 = 'SI'
                }
                if ($('#a5no').is(':checked')) {
                    a5 = 'NO'
                }
                if ($('#a5na').is(':checked')) {
                    a5 = 'NA'
                }
                obsea5 = $('#obsea5').val()
                filea5 = $('#doca5')[0].files[0];

                if ($('#a6si').is(':checked')) {
                    a6 = 'SI'
                }
                if ($('#a6no').is(':checked')) {
                    a6 = 'NO'
                }
                if ($('#a6na').is(':checked')) {
                    a6 = 'NA'
                }
                obsea6 = $('#obsea6').val()
                filea6 = $('#doca6')[0].files[0];

                if ($('#a7si').is(':checked')) {
                    a7 = 'SI'
                }
                if ($('#a7no').is(':checked')) {
                    a7 = 'NO'
                }
                if ($('#a7na').is(':checked')) {
                    a7 = 'NA'
                }
                obsea7 = $('#obsea7').val()
                filea7 = $('#doca7')[0].files[0];

                if ($('#a8si').is(':checked')) {
                    a8 = 'SI'
                }
                if ($('#a8no').is(':checked')) {
                    a8 = 'NO'
                }
                if ($('#a8na').is(':checked')) {
                    a8 = 'NA'
                }
                obsea8 = $('#obsea8').val()
                filea8 = $('#doca8')[0].files[0];

                var arrayAnexoB = []

                if (a1 == undefined || a2 == undefined || a3 == undefined || a4 == undefined || a5 == undefined || a6 == undefined || a7 == undefined || a8 == undefined) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Por favor conteste SI o  No a todos los campos...',
                        showConfirmButton: true
                    })
                } else {
                    arrayAnexoB.push({
                        'A1': a1,
                        'obs': obsea1
                    })

                    arrayAnexoB.push({
                        'A2': a2,
                        'obs': obsea2
                    })

                    arrayAnexoB.push({
                        'A3': a3,
                        'obs': obsea3
                    })

                    arrayAnexoB.push({
                        'A4': a4,
                        'obs': obsea4
                    })

                    arrayAnexoB.push({
                        'A5': a5,
                        'obs': obsea5
                    })

                    arrayAnexoB.push({
                        'A6': a6,
                        'obs': obsea6
                    })

                    arrayAnexoB.push({
                        'A7': a7,
                        'obs': obsea7
                    })

                    arrayAnexoB.push({
                        'A8': a8,
                        'obs': obsea8
                    })

                    var formData = new FormData();

                    formData.append('user', userprov)

                    formData.append('filea1', filea1)
                    formData.append('filea2', filea2)
                    formData.append('filea3', filea3)
                    formData.append('filea4', filea4)
                    formData.append('filea5', filea5)
                    formData.append('filea6', filea6)
                    formData.append('filea7', filea7)
                    formData.append('filea8', filea8)

                    formData.append('arrayAnexoB', JSON.stringify(arrayAnexoB))

                    cargando()
                    $.ajax({
                        url: url + 'guardarDatosAnexoB.php',
                        type: 'post',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            console.log(response)
                            if (response.msn == 'Ok') {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Datos Cargados...',
                                    showConfirmButton: true
                                }).then(() => {

                                })

                            } else {
                                alert(resp.msn)
                            }

                        }
                    })
                }



            }

            function cargando() {
                let timerInterval
                Swal.fire({
                    title: 'Cargando archivos!',
                    html: 'Un momento por favor...',
                    timer: 15000,
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

            function calFrec2018() {
                s12018 = $('#s12018').val()
                s22018 = $('#s22018').val()
                l12018 = (s22018 * 1000000) / s12018
                $('#l12018').val(l12018)
                calGrav2018()
                calTrir2018()
            }

            function calGrav2018() {
                s12018 = $('#s12018').val()
                s42018 = $('#s42018').val()
                l22018 = (s42018 * 1000000) / s12018
                $('#l22018').val(l22018)
                calTrir2018()
            }

            function calTrir2018() {
                s12018 = $('#s12018').val()
                s22018 = $('#s22018').val()
                s32018 = $('#s32018').val()
                s42018 = $('#s42018').val()
                s52018 = $('#s52018').val()
                l32018 = ((s52018 + s32018 + s22018) * 1000000) / s12018
                $('#l32018').val(l32018)
            }

            function calFrec2019() {
                s12019 = $('#s12019').val()
                s22019 = $('#s22019').val()
                l12019 = (s22019 * 1000000) / s12019
                $('#l12019').val(l12019)
                calGrav2019()
                calTrir2019()
            }

            function calGrav2019() {
                s12019 = $('#s12019').val()
                s42019 = $('#s42019').val()
                l22019 = (s42019 * 1000000) / s12019
                $('#l22019').val(l22019)
                calTrir2019()
            }

            function calTrir2019() {
                s12019 = $('#s12019').val()
                s22019 = $('#s22019').val()
                s32019 = $('#s32019').val()
                s42019 = $('#s42019').val()
                s52019 = $('#s52019').val()
                l32019 = ((s52019 + s32019 + s22019) * 1000000) / s12019
                $('#l32019').val(l32019)
            }

            function calFrec2020() {
                s12020 = $('#s12020').val()
                s22020 = $('#s22020').val()
                l12020 = (s22020 * 1000000) / s12020
                $('#l12020').val(l12020)
                calGrav2020()
                calTrir2020()
            }

            function calGrav2020() {
                s12020 = $('#s12020').val()
                s42020 = $('#s42020').val()
                l22020 = (s42020 * 1000000) / s12020
                $('#l22020').val(l22020)
                calTrir2020()
            }

            function calTrir2020() {
                s12020 = $('#s12020').val()
                s22020 = $('#s22020').val()
                s32020 = $('#s32020').val()
                s42020 = $('#s42020').val()
                s52020 = $('#s52020').val()
                l32020 = ((s52020 + s32020 + s22020) * 1000000) / s12020
                $('#l32020').val(l32020)
            }

            function calFrec2021() {
                s12021 = $('#s12021').val()
                s22021 = $('#s22021').val()
                l12021 = (s22021 * 1000000) / s12021
                $('#l12021').val(l12021)
                calGrav2021()
                calTrir2021()
            }

            function calGrav2021() {
                s12021 = $('#s12021').val()
                s42021 = $('#s42021').val()
                l22021 = (s42021 * 1000000) / s12021
                $('#l22021').val(l22021)
                calTrir2021()
            }

            function calTrir2021() {
                s12021 = $('#s12021').val()
                s22021 = $('#s22021').val()
                s32021 = $('#s32021').val()
                s42021 = $('#s42021').val()
                s52021 = $('#s52021').val()
                l32021 = ((s52021 + s32021 + s22021) * 1000000) / s12021
                $('#l32021').val(l32021)
            }

            function calFrec2022() {
                s12022 = $('#s12022').val()
                s22022 = $('#s22022').val()
                l12022 = (s22022 * 1000000) / s12022
                $('#l12022').val(l12022)
                calGrav2022()
                calTrir2022()
            }

            function calGrav2022() {
                s12022 = $('#s12022').val()
                s42022 = $('#s42022').val()
                l22022 = (s42022 * 1000000) / s12022
                $('#l22022').val(l22022)
                calTrir2022()
            }

            function calTrir2022() {
                s12022 = $('#s12022').val()
                s22022 = $('#s22022').val()
                s32022 = $('#s32022').val()
                s42022 = $('#s42022').val()
                s52022 = $('#s52022').val()
                l32022 = ((s52022 + s32022 + s22022) * 1000000) / s12022
                $('#l32022').val(l32022)
            }

            function salir() {
                location = 'login.html'
            }
        