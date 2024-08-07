const API = "https://utitalco.com/hv/server/";
var idNivel = null
var idN = null

$(document).ready(function(){
    $("#textfunciones").on('paste', function(e){
      e.preventDefault();
      alert('Esta acción está prohibida');
    })
    
    $("#textfunciones").on('copy', function(e){
      e.preventDefault();
      alert('Esta acción está prohibida');
    })
  })


const app = Vue.createApp({


    data() {
        return {

            tipodoc: '',
            doc: '',
            depdoc: '',
            mundoc: '',
            fdoc: '',
            email: '',
            cont1: '',
            cont2: '',
            nombres: '',
            fnac: '',
            tel: '',
            estcivil: '',
            sexo: '',
            gruposangre: '',
            emergencia: '',
            numemergencia: '',
            nacionalidad: '',
            depnac: '',
            municipionac: '',
            depresidencia: '',
            municipiores: '',
            barrio: '',
            otrotel: '',
            obscontacto: '',
            dir: '',
            numhijos: '',
            rangohijos: '',
            maparango: '',
            textoSelect: '',
            cabfam: '',
            pobvul: '',
            cargoasp: '',
            postulado: '',


            terr: '',
            alturas: '',
            fvencealt: '',
            espconf: '',
            nivelespconf: '',
            nivelnccer: '',
            espnccer: '',
            expnccer: '',

            perfil: '',
            sitlabact: '',
            proptransp: '',
            niveleduc: '',
            titulo: '',
            paistit: '',
            institucion: '',
            estadotit: '',
            fechafinal: '',
            obstit: '',
            tipoexplab: '',
            empresa: '',
            cargo: '',
            telemp: '',
            ubicaemp: '',
            fingreso: '',
            fretiro: '',
            funciones: '',
            tipocap: '',
            instcap: '',
            estadocap: '',
            programacap: '',
            ubicacap: '',
            duracioncap: '',
            arrayDatos: [],
            arrayDataInfop: [],
            arrayDataContacto: [],
            arrayDataDomicilio: [],
            arrayDataPerfil: [],
            arrayDataNivelEdu: [],
            arrayDataExpLab: [],
            arrayDataEduInformal: [],
            arrayDataCerti: [],
            arrayDatosPersonales: [],
            arrayDatosContacto: [],
            arrayDatosDomicilio: [],
            arrayDatosPefil: [],
            arrayDatosNivelEdu: [],
            arrayDatosExpLab: [],
            arrayDatosEduInformal: [],
            arrayDatosCerti: [],
            error: null,
            user: '',

            pdp: 20,
            pdc: 10,
            pd: 10,
            pp: 10,
            pc: 10,
            pne: 10,
            pf: 10,
            pdoc: 20,
            totporc: 0,
            totporcentaje: ''
        };
    },

    created() {
        this.cargarDatos()
    },

    methods: {

        async cargarDatos() {

            Swal.fire({
                icon: 'info',
                title: 'Recuerde!...',
                text: 'Debe subir foto actualizada con fondo blanco para validad la hoja de vida!',
                confirmButtonColor: '#3085d6',
              })

 

            this.error = null;
            this.user = sessionStorage.getItem('useritalco')

            if (this.user == null) {
                location = 'index.html'
            }

            const datos = new FormData();
            datos.append("uservcf", this.user);

            try {
                const response = await fetch(API + "cargarDatos.php", {
                    method: "POST",
                    body: datos,
                });
                console.log(response);

                if (!response.ok) throw new Error("Erorr de conexión");
                const data = await response.json();
                if (data == null) throw new Error("Usuario no encontrado");
                console.log(data);

                this.arrayDatos = data.info;

                if (data.infobasica.datospersonales != "") {
                    this.arrayDatosPersonales = JSON.parse(data.infobasica.datospersonales)

                    this.depdoc = this.arrayDatosPersonales.depdoc
                    this.mundoc = this.arrayDatosPersonales.mundoc
                    this.fdoc = this.arrayDatosPersonales.fdoc
                    this.estcivil = this.arrayDatosPersonales.estcivil
                    this.sexo = this.arrayDatosPersonales.sexo
                    this.nacionalidad = this.arrayDatosPersonales.nacionalidad
                    this.gruposangre = this.arrayDatosPersonales.gruposangre
                    this.emergencia = this.arrayDatosPersonales.emergencia
                    this.numemergencia = this.arrayDatosPersonales.numemergencia
                    this.depnac = this.arrayDatosPersonales.depnac
                    this.municipionac = this.arrayDatosPersonales.municipionac
                    this.numhijos = this.arrayDatosPersonales.numhijos
                    this.rangohijos = this.arrayDatosPersonales.rangohijos
                    this.maparango = this.rangohijos
                    this.pobvul = this.arrayDatosPersonales.pobvul
                    this.cabfam = this.arrayDatosPersonales.cabfam
                    this.cargoasp = this.arrayDatosPersonales.cargoasp
                    this.postulado = this.arrayDatosPersonales.postulado

                    if (this.depdoc || this.mundoc || this.fdoc || this.estcivil || this.sexo || this.nacionalidad || this.depnac || this.municipionac || this.numhijos || this.rangohijos || this.maparango || this.pobvul || this.cabfam || this.cargoasp || this.postulado == '') {
                        pdp = 0;
                    }
                }

                if (data.infobasica.datoscontacto != "") {
                    this.arrayDatosContacto = JSON.parse(data.infobasica.datoscontacto)
                    this.depresidencia = this.arrayDatosContacto.depresidencia
                    this.municipiores = this.arrayDatosContacto.municipiores
                    this.barrio = this.arrayDatosContacto.barrio
                    this.otrotel = this.arrayDatosContacto.otrotel
                    this.obscontacto = this.arrayDatosContacto.obscontacto

                    if (this.depresidencia || this.municipiores || this.barrio == '') {
                        pdc = 0;
                    }

                }

                if (data.infobasica.certificado != "") {
                    this.arrayDatosCerti = JSON.parse(data.infobasica.certificado)
                    this.terr = this.arrayDatosCerti.terr
                    this.alturas = this.arrayDatosCerti.alturas
                    this.fvencealt = this.arrayDatosCerti.fvencealt
                    this.espconf = this.arrayDatosCerti.espconf
                    this.nivelespconf = this.arrayDatosCerti.nivelespconf
                    this.nivelnccer = this.arrayDatosCerti.nivelnccer
                    this.espnccer = this.arrayDatosCerti.espnccer
                    this.expnccer = this.arrayDatosCerti.expnccer

                    if (this.terr || this.alturas || this.fvencealt || this.espconf || this.nivelespconf || this.nivelnccer || this.espnccer || this.expnccer == '') {
                        pc = 0;
                    }

                }

                if (data.infobasica.domicilio != "") {
                    this.dir = data.infobasica.domicilio
                    if (this.dir == '') {
                        pd = 0;
                    }
                }

                if (data.infobasica.perfil != "") {
                    this.arrayDatosPefil = JSON.parse(data.infobasica.perfil)

                    this.perfil = this.arrayDatosPefil.perfil
                    this.sitlabact = this.arrayDatosPefil.sitlabact
                    this.proptransp = this.arrayDatosPefil.proptransp

                    if (this.perfil || this.sitlabact || this.proptransp == '') {
                        pp = 0;
                    }
                }

                if (data.infobasica.niveleducativo != "") {
                    this.arrayDatosNivelEdu = JSON.parse(data.infobasica.niveleducativo)
                } else {
                    this.pne = 0;
                }

                if (data.infobasica.explaboral != "") {
                    this.arrayDatosExpLab = JSON.parse(data.infobasica.explaboral)
                }

                if (data.infobasica.edinformal != "") {
                    this.arrayDatosEduInformal = JSON.parse(data.infobasica.edinformal)
                }

                if (data.infofoto.foto == null || data.infofoto.foto == '') {
                    this.pf = 0;
                }

                if (data.archivos == null || data.archivos == '') {
                    this.pdoc = 0;
                }

                this.totporc = this.pdp + this.pdc + this.pd + this.pp + this.pc + this.pne + this.pf + this.pdoc;

                this.totporcentaje = `
                <div class="progress" style="height: 30px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width:` + this.totporc + `%">Hoja de vida ` + this.totporc + `% completa</div>
                </div>
                `

                $('#porcentaje').html(this.totporcentaje)


                console.log('Datos personales')
                console.log(this.arrayDatosPersonales.doc)

                this.tipodoc = this.arrayDatos.tipodoc
                this.doc = this.arrayDatos.doc
                this.email = this.arrayDatos.email
                this.nombres = this.arrayDatos.nombres
                this.fnac = this.arrayDatos.nacimiento
                this.tel = this.arrayDatos.tel



            } catch (error) {
                this.error = error;
                console.log(this.error);
            } finally {

            }
        },

        async guardarCert() {


            if (this.tipodoc && this.doc && this.terr && this.alturas && this.espconf && this.nivelespconf && this.nivelnccer && this.espnccer && this.expnccer != '') {

                this.arrayDatosCerti = {
                    'terr': this.terr,
                    'alturas': this.alturas,
                    'fvencealt': this.fvencealt,
                    'nivelespconf': this.nivelespconf,
                    'espconf': this.espconf,
                    'nivelnccer': this.nivelnccer,
                    'espnccer': this.espnccer,
                    'expnccer': this.expnccer
                }

                const datos = new FormData();
                datos.append("doc", this.doc);
                datos.append("arrayDatosCerti", JSON.stringify(this.arrayDatosCerti));

                try {
                    const response = await fetch(API + "actInfCert.php", {
                        method: "POST",
                        body: datos,
                    });
                    console.log(response);
                    if (!response.ok) throw new Error("Erro de conexión");
                    const data = await response.json();
                    if (data == null) throw new Error("No se actualizó la información");
                    console.log(data);

                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        text: "Hoja de vida actualizada...",
                        showConfirmButton: false,
                        timer: 2000,
                    })
                } catch (error) {
                    this.error = error;
                    console.log(this.error);
                    Swal.fire({
                        position: "top-end",
                        icon: "info",
                        text: error,
                        showConfirmButton: false,
                        timer: 1500,
                    })
                } finally {
                    // this.search = null;
                }



            } else {
                Swal.fire({
                    position: "top-end",
                    icon: "info",
                    text: "Por favor diligencie todos los campos...",
                    showConfirmButton: false,
                    timer: 2000,
                });
            }


        },


        async guardarCap() {


            if (this.tipodoc && this.doc && this.tipocap && this.instcap && this.estadocap && this.programacap && this.ubicacap && this.duracioncap != '') {

                this.arrayDatosEduInformal.push({
                    'tipocap': this.tipocap,
                    'instcap': this.instcap,
                    'estadocap': this.estadocap,
                    'ubicacap': this.ubicacap,
                    'programacap': this.programacap,
                    'duracioncap': this.duracioncap
                })

                const datos = new FormData();
                datos.append("doc", this.doc);
                datos.append("arrayDatosEduInformal", JSON.stringify(this.arrayDatosEduInformal));

                try {
                    const response = await fetch(API + "actInfoCap.php", {
                        method: "POST",
                        body: datos,
                    });
                    console.log(response);
                    if (!response.ok) throw new Error("Erro de conexión");
                    const data = await response.json();
                    if (data == null) throw new Error("No se actualizó la información");
                    console.log(data);

                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        text: "Hoja de vida actualizada...",
                        showConfirmButton: false,
                        timer: 2000,
                    }).then(() => {
                        this.tipocap = ''
                        this.instcap = ''
                        this.estadocap = ''
                        this.ubicacap = ''
                        this.programacap = ''
                        this.duracioncap = ''
                    })
                } catch (error) {
                    this.error = error;
                    console.log(this.error);
                    Swal.fire({
                        position: "top-end",
                        icon: "info",
                        text: error,
                        showConfirmButton: false,
                        timer: 1500,
                    })
                } finally {
                    // this.search = null;
                }



            } else {
                Swal.fire({
                    position: "top-end",
                    icon: "info",
                    text: "Por favor diligencie todos los campos...",
                    showConfirmButton: false,
                    timer: 2000,
                });
            }


        },

        async guardarExpLab() {

            if (this.tipodoc && this.doc && this.tipoexplab && this.empresa && this.cargo && this.ubicaemp && this.fingreso && this.funciones != '') {

                if ($('#trabactual').prop('checked') && this.fretiro == '') {
                    this.fretiro = 'Trabajo aquí actualmente'
                }

                var funciones = this.funciones.replace(/(\r\n|\n|\r)/gm, " ")
                funciones = funciones.replace(/["]/gm, "`")
                funciones = funciones.replace(/[“]/gm, "`")
                funciones = funciones.replace(/[”]/gm, "`")
                funciones = funciones.replace(/[']/gm, "`")

                funciones = funciones.trim()

                this.arrayDatosExpLab.push({
                    'tipoexplab': this.tipoexplab,
                    'empresa': this.empresa,
                    'cargo': this.cargo,
                    'telemp': this.telemp,
                    'ubicaemp': this.ubicaemp,
                    'fingreso': this.fingreso,
                    'fretiro': this.fretiro,
                    'funciones': funciones
                })

                const datos = new FormData();
                datos.append("doc", this.doc);
                datos.append("arrayDatosExpLab", JSON.stringify(this.arrayDatosExpLab));

                try {
                    const response = await fetch(API + "actInfoLab.php", {
                        method: "POST",
                        body: datos,
                    });
                    console.log(response);
                    if (!response.ok) throw new Error("Erro de conexión");
                    const data = await response.json();
                    if (data == null) throw new Error("No se actualizó la información");
                    console.log(data);

                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        text: "Hoja de vida actualizada...",
                        showConfirmButton: false,
                        timer: 2000,
                    }).then(() => {
                        this.tipoexplab = ''
                        this.empresa = ''
                        this.cargo = ''
                        this.telemp = ''
                        this.ubicaemp = ''
                        this.fingreso = ''
                        this.fretiro = ''
                        this.funciones = ''
                    })
                } catch (error) {
                    this.error = error;
                    console.log(this.error);
                    Swal.fire({
                        position: "top-end",
                        icon: "info",
                        text: error,
                        showConfirmButton: false,
                        timer: 1500,
                    })
                } finally {
                    // this.search = null;
                }



            } else {
                Swal.fire({
                    position: "top-end",
                    icon: "info",
                    text: "Por favor diligencie todos los campos...",
                    showConfirmButton: false,
                    timer: 2000,
                });
            }


        },

        async guardarNivelEduc() {


            if (this.tipodoc && this.doc && this.niveleduc && this.titulo && this.paistit && this.institucion && this.estadotit != '') {
                
                var inst = this.institucion.replace(/["]/gm, "`")
                inst = inst.replace(/[“]/gm, "`")
                inst = inst.replace(/[”]/gm, "`")
                inst = inst.replace(/[']/gm, "`")

                this.arrayDatosNivelEdu.push({
                    'niveleduc': this.niveleduc,
                    'titulo': this.titulo,
                    'paistit': this.paistit,
                    'institucion': inst,
                    'estadotit': this.estadotit,
                    'fechafinal': this.fechafinal,
                    'obstit': this.obstit
                })

                const datos = new FormData();
                datos.append("doc", this.doc);
                datos.append("arrayDatosNivelEdu", JSON.stringify(this.arrayDatosNivelEdu));

                try {
                    const response = await fetch(API + "actInfoEduc.php", {
                        method: "POST",
                        body: datos,
                    });
                    console.log(response);
                    if (!response.ok) throw new Error("Erro de conexión");
                    const data = await response.json();
                    if (data == null) throw new Error("No se actualizó la información");
                    console.log(data);

                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        text: "Hoja de vida actualizada...",
                        showConfirmButton: false,
                        timer: 2000,
                    }).then(() => {
                        this.niveleduc = ''
                        this.titulo = ''
                        this.paistit = ''
                        this.institucion = ''
                        this.estadotit = ''
                        this.obstit = ''
                    })
                } catch (error) {
                    this.error = error;
                    console.log(this.error);
                    Swal.fire({
                        position: "top-end",
                        icon: "info",
                        text: error,
                        showConfirmButton: false,
                        timer: 1500,
                    })
                } finally {
                    // this.search = null;
                }



            } else {
                Swal.fire({
                    position: "top-end",
                    icon: "info",
                    text: "Por favor diligencie todos los campos...",
                    showConfirmButton: false,
                    timer: 2000,
                });
            }


        },

        async actInfoBasica() {


            

                const datos = new FormData();

                this.arrayDataInfop = {
                    'depdoc': this.depdoc,
                    'mundoc': this.mundoc,
                    'fdoc': this.fdoc,
                    'estcivil': this.estcivil,
                    'sexo': this.sexo,
                    'gruposangre': this.gruposangre,
                    'emergencia': this.emergencia,
                    'numemergencia': this.numemergencia,
                    'nacionalidad': this.nacionalidad,
                    'depnac': this.depnac,
                    'municipionac': this.municipionac,
                    'numhijos': this.numhijos,
                    'rangohijos': this.rangohijos,
                    'cabfam': this.cabfam,
                    'pobvul': this.pobvul,
                    'cargoasp': this.cargoasp,
                    'postulado': this.postulado
                }

                this.arrayDataContacto = {
                    'depresidencia': this.depresidencia,
                    'municipiores': this.municipiores,
                    'barrio': this.barrio,
                    'tel': this.tel,
                    'otrotel': this.otrotel,
                    'obscontacto': this.obscontacto
                }

                var perfil = this.perfil.replace(/(\r\n|\n|\r)/gm, " ")
                perfil = perfil.replace(/["]/gm, "`")
                perfil = perfil.replace(/[']/gm, "`")
                perfil = perfil.replace(/[“]/gm, "`")
                perfil = perfil.replace(/[”]/gm, "`")

                this.arrayDataPerfil = {
                    'perfil': perfil,
                    'sitlabact': this.sitlabact,
                    'proptransp': this.proptransp
                }

                datos.append("tipodoc", this.tipodoc);
                datos.append("doc", this.doc);
                datos.append("email", this.email);
                datos.append("nombres", this.nombres);
                datos.append("fnac", this.fnac);
                datos.append("tel", this.tel);
                datos.append("dir", this.dir);
                datos.append("arrayDataInfop", JSON.stringify(this.arrayDataInfop));
                datos.append("arrayDataContacto", JSON.stringify(this.arrayDataContacto));
                datos.append("arrayDataPerfil", JSON.stringify(this.arrayDataPerfil));


                try {
                    const response = await fetch(API + "actInfoBasica.php", {
                        method: "POST",
                        body: datos,
                    });
                    console.log(response);
                    if (!response.ok) throw new Error("Erro de conexión");
                    const data = await response.json();
                    if (data == null) throw new Error("No se actualizó la información");
                    console.log(data);

                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        text: "Hoja de vida actualizada...",
                        showConfirmButton: false,
                        timer: 2000,
                    })
                } catch (error) {
                    this.error = error;
                    console.log(this.error);
                    Swal.fire({
                        position: "top-end",
                        icon: "info",
                        text: error,
                        showConfirmButton: false,
                        timer: 1500,
                    })
                } finally {
                    // this.search = null;
                }



            


        },

        editarEduInf(e){
            idN = e
            Swal.fire({
                html: `
                <div class="card">
                    <div class="card-header">
                        Editar Capacitaciones y Certificaciones
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 mt-2">
                                <span class="titp">Tipo capacitación o certificacion</span>
                                <select id="tipocap" class="form-control">
                                    <option value="${this.arrayDatosEduInformal[e].tipocap}">${this.arrayDatosEduInformal[e].tipocap}</option>
                                    <option value="Curso">Curso</option>
                                    <option value="Taller">Taller</option>
                                    <option value="Diplomado">Diplomado</option>
                                    <option value="Seminario">Seminario</option>
                                    <option value="Certificación de competencias">Certificación de
                                        competencias</option>
                                </select>
                            </div>

                            <div class="col-sm-12 mt-2">
                                <span class="titp">Nombre del programa</span>
                                <input type="text" id="programacap" class="form-control" value="${this.arrayDatosEduInformal[e].programacap}">
                            </div>

                            <div class="col-sm-12 mt-2">
                                <span class="titp">País</span>
                                <input type="text" id="ubicacap" class="form-control" value="${this.arrayDatosEduInformal[e].ubicacap}">
                            </div>

                            <div class="col-sm-12 mt-2">
                                <span class="titp">Institución</span>
                                <input type="text" id="instcap" class="form-control" value="${this.arrayDatosEduInformal[e].instcap}">
                            </div>

                            <div class="col-sm-6 mt-2">
                                <span class="titp">Estado</span>
                                <select id="estadocap" class="form-control">
                                    <option value="${this.arrayDatosEduInformal[e].estadocap}">${this.arrayDatosEduInformal[e].estadocap}</option>
                                    <option value="Certificado">Certificado</option>
                                    <option value="No Certificado">No Certificado</option>
                                </select>
                            </div>

                            <div class="col-sm-6 mt-2">
                                <span class="titp">Duración en horas</span>
                                <input type="number" id="duracioncap" class="form-control" value="${this.arrayDatosEduInformal[e].duracioncap}">
                            </div>

                        </div>

                    </div>
                </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Actualizar',
                cancelButtonText: `Cancelar`,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    this.tipocap = $('#tipocap').val()
                    this.programacap = $('#programacap').val()
                    this.instcap = $('#instcap').val()
                    this.ubicacap = $('#ubicacap').val()
                    this.estadocap = $('#estadocap').val()
                    this.ubicaemp = $('#ubicaemp').val()
                    this.duracioncap = $('#duracioncap').val()
                    
                    this.actItemEduInf()

                }
            })
        },
        
        async actItemEduInf(){

            this.arrayDatosEduInformal[idN].tipocap = this.tipocap
            this.arrayDatosEduInformal[idN].instcap = this.instcap
            this.arrayDatosEduInformal[idN].estadocap = this.estadocap
            this.arrayDatosEduInformal[idN].ubicacap = this.ubicacap
            this.arrayDatosEduInformal[idN].programacap = this.programacap
            this.arrayDatosEduInformal[idN].duracioncap = this.duracioncap
         
            const datos = new FormData();
            datos.append("doc", this.doc);
            datos.append("arrayDatosEduInformal", JSON.stringify(this.arrayDatosEduInformal));

            try {
                const response = await fetch(API + "actInfoCap.php", {
                    method: "POST",
                    body: datos,
                });
                console.log(response);
                if (!response.ok) throw new Error("Erro de conexión");
                const data = await response.json();
                if (data == null) throw new Error("No se actualizó la información");
                console.log(data);

                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    text: "Hoja de vida actualizada...",
                    showConfirmButton: false,
                    width: 300,
                    timer: 2000,
                }).then(() => {
                    this.tipocap = ''
                    this.instcap = ''
                    this.estadocap = ''
                    this.ubicacap = ''
                    this.programacap = ''
                    this.duracioncap = ''
                })
            } catch (error) {
                this.error = error;
                console.log(this.error);
                Swal.fire({
                    position: "top-end",
                    icon: "info",
                    text: error,
                    showConfirmButton: false,
                    timer: 1500,
                })
            } finally {
                // this.search = null;
            }


        },

        editarExp(e) {
            idN = e
            Swal.fire({
                html: `
                <div class="card">
                    <div class="card-header">
                        Editar Experiencia Laboral
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 mt-2">
                                <span class="titp">Tipo de experiencia laboral</span>
                                <select id="tipoexplab" class="form-control">
                                    <option value="${this.arrayDatosExpLab[e].tipoexplab}">${this.arrayDatosExpLab[e].tipoexplab}</option>
                                    <option value="Asalariado">Asalariado</option>
                                    <option value="Independiente">Independiente</option>
                                    <option value="Pasantía o Práctica Laboral">Pasantía o Práctica Laboral
                                    </option>
                                </select>
                            </div>

                            <div class="col-sm-12 mt-2">
                                <span class="titp">Nombre de la empresa</span>
                                <input type="text" id="empresa" class="form-control" value="${this.arrayDatosExpLab[e].empresa}">
                            </div>

                            <div class="col-sm-6 mt-2">
                                <span class="titp">Fecha de ingreso</span>
                                <input type="date" id="fingreso" class="form-control" value="${this.arrayDatosExpLab[e].fingreso}">
                            </div>

                            <div class="col-sm-6 mt-2">
                                
                                <span class="titp">Fecha de retiro</span>
                                <input type="date" id="fretiro" class="form-control" value="${this.arrayDatosExpLab[e].fretiro}">
                                <div class="form-check mt-2" style="font-size: 11px;">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="trabactualE">
                                    <label class="form-check-label" for="trabactualE">
                                        <b>Trabajo aquí actualmente</b>
                                    </label>
                                </div>
                            </div>

                            <div class="col-sm-6 mt-2">
                                <span class="titp">País</span>
                                <input type="text" id="ubicaemp" class="form-control" value="${this.arrayDatosExpLab[e].ubicaemp}">
                            </div>

                            <div class="col-sm-6 mt-2">
                                <span class="titp">Teléfono</span>
                                <input type="text" id="telemp" class="form-control" value="${this.arrayDatosExpLab[e].telemp}">
                            </div>

                            <div class="col-sm-12 mt-2">
                                <span class="titp">Cargo</span>
                                <input type="text" id="cargo" class="form-control" value="${this.arrayDatosExpLab[e].cargo}">
                            </div>

                            <div class="col-sm-12 mt-2">
                                <span class="titp">Funciones y logros</span>
                                <textarea id="funciones" class="form-control" style="width: 100%;"
                                    rows="5">${this.arrayDatosExpLab[e].funciones}</textarea>
                            </div>

                        </div>

                    </div>
                </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Actualizar',
                cancelButtonText: `Cancelar`,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    this.tipoexplab = $('#tipoexplab').val()
                    this.empresa = $('#empresa').val()
                    this.cargo = $('#cargo').val()
                    this.telemp = $('#telemp').val()
                    this.ubicaemp = $('#ubicaemp').val()
                    this.fingreso = $('#fingreso').val()
                    this.fretiro = $('#fretiro').val()

                    var funciones = $('#funciones').val()

                    funciones = funciones.replace(/(\r\n|\n|\r)/gm, " ")
                    funciones = funciones.replace(/["]/gm, "`")
                    funciones = funciones.replace(/[']/gm, "`")
                    funciones = funciones.replace(/[“]/gm, "`")
                    funciones = funciones.replace(/[”]/gm, "`")

                    funciones = funciones.trim()                     

                    this.funciones = funciones

                    if ($('#trabactualE').prop('checked') && $('#fretiro').val() == '') {
                        this.fretiro = 'Trabajo aquí actualmente'
                    }

                    this.actItemExp()

                }
            })
        },

        async actItemExp() {

            this.arrayDatosExpLab[idN].tipoexplab = this.tipoexplab
            this.arrayDatosExpLab[idN].empresa = this.empresa
            this.arrayDatosExpLab[idN].cargo = this.cargo
            this.arrayDatosExpLab[idN].telemp = this.telemp
            this.arrayDatosExpLab[idN].ubicaemp = this.ubicaemp
            this.arrayDatosExpLab[idN].fingreso = this.fingreso
            this.arrayDatosExpLab[idN].fretiro = this.fretiro
            this.arrayDatosExpLab[idN].funciones = this.funciones


            const datos = new FormData();
            datos.append("doc", this.doc);
            datos.append("arrayDatosExpLab", JSON.stringify(this.arrayDatosExpLab));

            try {
                const response = await fetch(API + "actInfoLab.php", {
                    method: "POST",
                    body: datos,
                });
                console.log(response);
                if (!response.ok) throw new Error("Error de conexión");
                const data = await response.json();
                if (data == null) throw new Error("No se actualizó la información");
                console.log(data);

                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    text: "Hoja de vida actualizada...",
                    showConfirmButton: false,
                    width: 300,
                    timer: 2000,
                }).then(() => {
                    this.tipoexplab = ''
                    this.empresa = ''
                    this.cargo = ''
                    this.telemp = ''
                    this.ubicaemp = ''
                    this.fingreso = ''
                    this.fretiro = ''
                    this.funciones = ''
                })
            } catch (error) {
                this.error = error;
                console.log(this.error);
                Swal.fire({
                    position: "top-end",
                    icon: "info",
                    text: error,
                    showConfirmButton: false,
                    timer: 1500,
                })
            } finally {
                // this.search = null;
            }
        },

        editar(e) {
            var tit = e
            for (var i = 0, len = this.arrayDatosNivelEdu.length; i < len; i++) {
                if (this.arrayDatosNivelEdu[i].titulo === tit) {
                    idN = i
                    break;
                }
            }


            Swal.fire({
                html: `
                    <div class="card mt-4">
                        <div class="card-header">
                            Editar Nivel Educativo
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 mt-2">
                                    <span class="titp">Nivel Educativo</span>
                                    <select id="niveleduc" class="form-control">
                                        <option value="${this.arrayDatosNivelEdu[idN].niveleduc}">${this.arrayDatosNivelEdu[idN].niveleduc}</option>
                                        <option value="Preescolar">Preescolar</option>
                                        <option value="Básica Primaria(1-5)">Básica Primaria(1-5)</option>
                                        <option value="Básica Secundaria(6-9)">Básica Secundaria(6-9)</option>
                                        <option value="Media (10-12)">Media (10-12)</option>
                                        <option value="Técnica Laboral">Técnica Laboral</option>
                                        <option value="Técnica Profesional">Técnica Profesional</option>
                                        <option value="Tecnología">Tecnología</option>
                                        <option value="Universitaria">Universitaria</option>
                                        <option value="Especialización">Especialización</option>
                                        <option value="Maestría">Maestría</option>
                                        <option value="Doctorado">Doctorado</option>
                                    </select>
                                </div>

                                <div class="col-sm-12 mt-2">
                                    <span class="titp">Título obtenido</span>
                                    <input type="text" id="titulo" class="form-control" value="${this.arrayDatosNivelEdu[idN].titulo}">
                                </div>

                                <div class="col-sm-12 mt-2">
                                    <span class="titp">País Título</span>
                                    <input type="text" id="paistit" class="form-control" value="${this.arrayDatosNivelEdu[idN].paistit}">
                                </div>

                                <div class="col-sm-12 mt-2">
                                    <span class="titp">Institución</span>
                                    <input type="text" id="institucion" class="form-control" value="${this.arrayDatosNivelEdu[idN].institucion}">
                                </div>

                                <div class="col-sm-6 mt-2">
                                    <span class="titp">Estado</span>
                                    <select id="estadotit" class="form-control">
                                        <option value="${this.arrayDatosNivelEdu[idN].estadotit}">${this.arrayDatosNivelEdu[idN].estadotit}</option>
                                        <option value="En Curso">En Curso</option>
                                        <option value="Incompleto">Incompleto</option>
                                        <option value="Graduado">Graduado</option>
                                    </select>
                                </div>

                                <div class="col-sm-6 mt-2">
                                    <span class="titp">Fecha de finalización</span>
                                    <input type="date" id="fechafinal" class="form-control" value="${this.arrayDatosNivelEdu[idN].fechafinal}">
                                </div>

                                <div class="col-sm-12 mt-2">
                                    <span class="titp">Observaciones</span>
                                    <input type="text" id="obstit" class="form-control" value="${this.arrayDatosNivelEdu[idN].obstit}">
                                </div>


                            </div>

                        </div>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Actualizar',
                cancelButtonText: `Cancelar`,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    this.niveleduc = $('#niveleduc').val()
                    this.titulo = $('#titulo').val()
                    this.paistit = $('#paistit').val()
                    this.institucion = $('#institucion').val()
                    this.estadotit = $('#estadotit').val()
                    this.fechafinal = $('#fechafinal').val()
                    this.obstit = $('#obstit').val()
                    this.actItemEduc()

                }
            })
        },

        async actItemEduc() {
            if (this.tipodoc && this.doc && this.niveleduc && this.titulo && this.paistit && this.institucion && this.estadotit != '') {


                this.arrayDatosNivelEdu[idN].niveleduc = this.niveleduc
                this.arrayDatosNivelEdu[idN].paistit = this.paistit
                this.arrayDatosNivelEdu[idN].titulo = this.titulo
                this.arrayDatosNivelEdu[idN].institucion = this.institucion
                this.arrayDatosNivelEdu[idN].estadotit = this.estadotit
                this.arrayDatosNivelEdu[idN].fechafinal = this.fechafinal
                this.arrayDatosNivelEdu[idN].obstit = this.obstit

                const datos = new FormData();
                datos.append("doc", this.doc);
                datos.append("arrayDatosNivelEdu", JSON.stringify(this.arrayDatosNivelEdu));

                try {
                    const response = await fetch(API + "actInfoEduc.php", {
                        method: "POST",
                        body: datos,
                    });
                    console.log(response);
                    if (!response.ok) throw new Error("Erro de conexión");
                    const data = await response.json();
                    if (data == null) throw new Error("No se actualizó la información");
                    console.log(data);

                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        text: "Hoja de vida actualizada...",
                        showConfirmButton: false,
                        width: 300,
                        timer: 2000,
                    }).then(() => {
                        this.niveleduc = ''
                        this.titulo = ''
                        this.paistit = ''
                        this.institucion = ''
                        this.estadotit = ''
                        this.obstit = ''
                    })
                } catch (error) {
                    this.error = error;
                    console.log(this.error);
                    Swal.fire({
                        position: "top-end",
                        icon: "info",
                        text: error,
                        showConfirmButton: false,
                        timer: 1500,
                    })
                } finally {
                    // this.search = null;
                }



            } else {
                Swal.fire({
                    position: "top-end",
                    icon: "info",
                    text: "Por favor diligencie todos los campos...",
                    showConfirmButton: false,
                    timer: 2000,
                });
            }
        },

        borrarEduInf(e) {
            Swal.fire({
                title: 'Borrar registro',
                text: 'Desea borrar este registro?',
                showCancelButton: true,
                confirmButtonText: 'Borrar',
                cancelButtonText: `Cancelar`,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    this.arrayDatosEduInformal.splice(e, 1);
                    this.borrarItemEduInf()
                }
            })
        },

        async borrarItemEduInf() {

            const datos = new FormData();
            datos.append("doc", this.doc);
            datos.append("arrayDatosEduInformal", JSON.stringify(this.arrayDatosEduInformal));

            try {
                const response = await fetch(API + "actInfoCap.php", {
                    method: "POST",
                    body: datos,
                });
                console.log(response);
                if (!response.ok) throw new Error("Erro de conexión");
                const data = await response.json();
                if (data == null) throw new Error("No se actualizó la información");
                console.log(data);

                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    text: "Hoja de vida actualizada...",
                    showConfirmButton: false,
                    width: 300,
                    timer: 2000,
                })
            } catch (error) {
                this.error = error;
                console.log(this.error);
                Swal.fire({
                    position: "top-end",
                    icon: "info",
                    text: error,
                    showConfirmButton: false,
                    timer: 1500,
                })
            } finally {
                // this.search = null;
            }

        },


        borrar(e) {
            var tit = e
            for (var i = 0, len = this.arrayDatosNivelEdu.length; i < len; i++) {
                if (this.arrayDatosNivelEdu[i].titulo === tit) {
                    idNivel = i
                    break;
                }
            }

            Swal.fire({
                title: 'Borrar registro',
                text: 'Desea borrar este registro: ' + tit + '?',
                showCancelButton: true,
                confirmButtonText: 'Borrar',
                cancelButtonText: `Cancelar`,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    this.arrayDatosNivelEdu.splice(idNivel, 1);
                    this.borrarItemEduc()

                }
            })



        },

        async borrarItemEduc() {

            const datos = new FormData();
            datos.append("doc", this.doc);
            datos.append("arrayDatosNivelEdu", JSON.stringify(this.arrayDatosNivelEdu));

            try {
                const response = await fetch(API + "actInfoEduc.php", {
                    method: "POST",
                    body: datos,
                });
                console.log(response);
                if (!response.ok) throw new Error("Error de conexión");
                const data = await response.json();
                if (data == null) throw new Error("No se actualizó la información");
                console.log(data);

                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    text: "Hoja de vida actualizada...",
                    showConfirmButton: false,
                    width: 300,
                    timer: 2000,
                }).then(() => {
                    this.niveleduc = ''
                    this.titulo = ''
                    this.paistit = ''
                    this.institucion = ''
                    this.estadotit = ''
                    this.obstit = ''
                })
            } catch (error) {
                this.error = error;
                console.log(this.error);
                Swal.fire({
                    position: "top-end",
                    icon: "info",
                    text: error,
                    showConfirmButton: false,
                    timer: 1500,
                })
            } finally {
                // this.search = null;
            }
        },

        borrarExp(e) {
            Swal.fire({
                title: 'Borrar registro',
                text: 'Desea borrar este registro?',
                showCancelButton: true,
                confirmButtonText: 'Borrar',
                cancelButtonText: `Cancelar`,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    this.arrayDatosExpLab.splice(e, 1);
                    this.borrarItemExp()
                }
            })
        },

        async borrarItemExp() {

            const datos = new FormData();
            datos.append("doc", this.doc);
            datos.append("arrayDatosExpLab", JSON.stringify(this.arrayDatosExpLab));

            try {
                const response = await fetch(API + "actInfoLab.php", {
                    method: "POST",
                    body: datos,
                });
                console.log(response);
                if (!response.ok) throw new Error("Erro de conexión");
                const data = await response.json();
                if (data == null) throw new Error("No se actualizó la información");
                console.log(data);

                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    text: "Hoja de vida actualizada...",
                    showConfirmButton: false,
                    width: 300,
                    timer: 2000,
                }).then(() => {
                    this.tipoexplab = ''
                    this.empresa = ''
                    this.cargo = ''
                    this.telemp = ''
                    this.ubicaemp = ''
                    this.fingreso = ''
                    this.fretiro = ''
                    this.funciones = ''
                })
            } catch (error) {
                this.error = error;
                console.log(this.error);
                Swal.fire({
                    position: "top-end",
                    icon: "info",
                    text: error,
                    showConfirmButton: false,
                    timer: 1500,
                })
            } finally {
                // this.search = null;
            }
        },

        editarHV() {
            location = 'editarHV.html'
        },

        adjuntardoc() {
            location = 'documentos.html'
        },

        adjuntarfoto() {
            location = 'foto.html'
        },

        verHojaVida() {
            location = 'hojadevida.html'
        },

        cerrar() {
            sessionStorage.clear()
            location = 'index.html'
        },

        descargarAnexos() {
            window.open('https://utitalco.com/hv/FORMATOS ANEXOS PARA CONTRATACION.pdf', '_blank');
        },

        descargarGab() {
            window.open('https://utitalco.com/hv/GAB-F-214 Certificación cumplimiento de perfiles ECP V2.xls', '_blank');
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