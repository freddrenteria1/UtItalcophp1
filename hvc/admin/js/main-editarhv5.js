const API = "https://utitalco.com/hvc/server/";



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
            user: ''
        };
    },

    created() {
        this.cargarDatos()
    },

    methods: {

        async cargarDatos() {
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
                    this.depnac = this.arrayDatosPersonales.depnac
                    this.municipionac = this.arrayDatosPersonales.municipionac
                    this.numhijos = this.arrayDatosPersonales.numhijos
                    this.rangohijos = this.arrayDatosPersonales.rangohijos
                    this.maparango = this.rangohijos
                    this.pobvul = this.arrayDatosPersonales.pobvul
                    this.cabfam = this.arrayDatosPersonales.cabfam
                    this.cargoasp = this.arrayDatosPersonales.cargoasp
                    this.postulado = this.arrayDatosPersonales.postulado
                }

                if (data.infobasica.datoscontacto != "") {
                    this.arrayDatosContacto = JSON.parse(data.infobasica.datoscontacto)
                    this.depresidencia = this.arrayDatosContacto.depresidencia
                    this.municipiores = this.arrayDatosContacto.municipiores
                    this.barrio = this.arrayDatosContacto.barrio
                    this.otrotel = this.arrayDatosContacto.otrotel
                    this.obscontacto = this.arrayDatosContacto.obscontacto

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

                }

                if (data.infobasica.domicilio != "") {
                    this.dir = data.infobasica.domicilio
                }

                if (data.infobasica.perfil != "") {
                    this.arrayDatosPefil = JSON.parse(data.infobasica.perfil)
                    
                    this.perfil = this.arrayDatosPefil.perfil.replace(/[æ]/g, '\n')
                    this.sitlabact = this.arrayDatosPefil.sitlabact
                    this.proptransp = this.arrayDatosPefil.proptransp
                }

                if (data.infobasica.niveleducativo != "") {
                    this.arrayDatosNivelEdu = JSON.parse(data.infobasica.niveleducativo)
                }

                if (data.infobasica.explaboral != "") {
                    this.arrayDatosExpLab = JSON.parse(data.infobasica.explaboral)
                }

                if (data.infobasica.edinformal != "") {
                    this.arrayDatosEduInformal = JSON.parse(data.infobasica.edinformal)
                }
                

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

                const datos = new FormData();
                
                this.arrayDatosCerti = {
                    'terr':this.terr,
                    'alturas':this.alturas,
                    'fvencealt':this.fvencealt,
                    'nivelespconf':this.nivelespconf,
                    'espconf':this.espconf,
                    'nivelnccer':this.nivelnccer,
                    'espnccer':this.espnccer,
                    'expnccer':this.expnccer
                }

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

                const datos = new FormData();
                
                this.arrayDatosEduInformal.push({
                    'tipocap':this.tipocap,
                    'instcap':this.instcap,
                    'estadocap':this.estadocap,
                    'ubicacap':this.ubicacap,
                    'programacap':this.programacap,
                    'duracioncap':this.duracioncap
                })

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
                    }).then(()=>{
                        this.tipocap = ''
                        this.instcap = ''
                        this.estadocap = ''
                        this.ubicacap =''
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

                const datos = new FormData();

                if($('#trabactual').prop('checked') && this.fretiro == ''){
                    this.fretiro = 'Trabajo aquí actualmente'
                }

                var funciones = this.funciones.replace(/(\r\n|\n|\r)/gm, "æ")
                funciones = funciones.replace(/["]/gm, "`")
                funciones = funciones.replace(/[']/gm, "`")
                
                this.arrayDatosExpLab.push({
                    'tipoexplab':this.tipoexplab,
                    'empresa':this.empresa,
                    'cargo':this.cargo,
                    'telemp':this.telemp,
                    'ubicaemp':this.ubicaemp,
                    'fingreso':this.fingreso,
                    'fretiro':this.fretiro,
                    'funciones':funciones
                })

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
                    }).then(()=>{
                        this.tipoexplab = ''
                        this.empresa = ''
                        this.cargo = ''
                        this.telemp =''
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

                const datos = new FormData();
                
                this.arrayDatosNivelEdu.push({
                    'niveleduc':this.niveleduc,
                    'titulo':this.titulo,
                    'paistit':this.paistit,
                    'institucion':this.institucion,
                    'estadotit':this.estadotit,
                    'fechafinal':this.fechafinal,
                    'obstit':this.obstit
                })

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
                    }).then(()=>{
                        this.niveleduc = ''
                        this.titulo = ''
                        this.paistit = ''
                        this.institucion =''
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

             
            if (this.tipodoc && this.doc && this.depdoc && this.mundoc && this.fdoc && this.email && this.estcivil && this.fnac && this.nombres && this.sexo && this.tel && this.nacionalidad && this.depnac && this.municipionac && this.depresidencia && this.municipiores && this.barrio && this.otrotel && this.dir && this.perfil && this.sitlabact && this.proptransp && this.numhijos && this.rangohijos && this.cabfam && this.pobvul != '') {

                const datos = new FormData();
                
                this.arrayDataInfop = {
                    'depdoc': this.depdoc,
                    'mundoc':  this.mundoc,
                    'fdoc': this.fdoc,
                    'estcivil':this.estcivil,
                    'sexo':this.sexo,
                    'nacionalidad':this.nacionalidad,
                    'depnac':this.depnac,
                    'municipionac':this.municipionac,   
                    'numhijos':this.numhijos,   
                    'rangohijos':this.rangohijos,   
                    'cabfam':this.cabfam,   
                    'pobvul':this.pobvul,
                    'cargoasp':this.cargoasp,
                    'postulado':this.postulado               
                }

                this.arrayDataContacto = {
                    'depresidencia':this.depresidencia,
                    'municipiores':this.municipiores,
                    'barrio':this.barrio,
                    'tel':this.tel,
                    'otrotel':this.otrotel,
                    'obscontacto':this.obscontacto                   
                }

                var perfil = this.perfil.replace(/(\r\n|\n|\r)/gm, "æ")
                perfil = perfil.replace(/["]/gm, "`")
                perfil = perfil.replace(/[']/gm, "`")

                this.arrayDataPerfil = {
                    'perfil':perfil,
                    'sitlabact':this.sitlabact,
                    'proptransp':this.proptransp                  
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

        editarHV() {
            location = 'editarHV.html'
        },

        adjuntardoc(){
            location = 'documentos.html'
        },

        adjuntarfoto(){
            location = 'foto.html'
        },

        verHojaVida(){
            location = 'hojadevida.html'
        }, 

        cerrar() {
            sessionStorage.clear()
            location = 'index.html'
        },



    },

    
});

const mountedApp = app.mount("#app");