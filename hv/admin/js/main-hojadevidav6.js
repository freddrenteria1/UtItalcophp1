const API = "https://utitalco.com/hv/server/";
var nivelActual = 0;
var datosniveleduc = null


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
            foto: '',
            fotohtml: '',

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
            edad: '',
            maxNivelEdu: '',
            arrayDatos: [],
            arrayDataInfop: [],
            arrayDataContacto: [],
            arrayDataDomicilio: [],
            arrayDataPerfil: [],
            arrayDataNivelEdu: [],
            arrayDataExpLab: [],
            arrayDataEduInformal: [],
            arrayDatosPersonales: [],
            arrayDatosContacto: [],
            arrayDatosDomicilio: [],
            arrayDatosPefil: [],
            arrayDatosNivelEdu: [],
            arrayDatosExpLab: [],
            arrayDatosEduInformal: [],
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
            this.user = sessionStorage.getItem('docuser')

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
                this.foto = data.infofoto.foto;
                

                if (data.infobasica.datospersonales != "") {
                    this.arrayDatosPersonales = JSON.parse(data.infobasica.datospersonales)
                    this.depdoc = this.arrayDatosPersonales.depdoc
                    this.mundoc = this.arrayDatosPersonales.mundoc
                    this.fdoc = this.arrayDatosPersonales.fdoc
                    this.estcivil = this.arrayDatosPersonales.estcivil
                    this.sexo = this.arrayDatosPersonales.sexo
                    this.gruposangre = this.arrayDatosPersonales.gruposangre
                    this.emergencia = this.arrayDatosPersonales.emergencia
                    this.numemergencia = this.arrayDatosPersonales.numemergencia
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
                    this.perfil = this.arrayDatosPefil.perfil.replace(/[æ]/gm, '\n')
                    this.sitlabact = this.arrayDatosPefil.sitlabact
                    this.proptransp = this.arrayDatosPefil.proptransp
                }

                if (data.infobasica.niveleducativo != "") {
                    this.arrayDatosNivelEdu = JSON.parse(data.infobasica.niveleducativo)
                    
                    datosniveleduc = this.arrayDatosNivelEdu
                   

                    for(i=0; i<datosniveleduc.length; i++){
                        if(datosniveleduc[i].niveleduc == 'Preescolar'){
                            var numNivel = 1;
                            if(nivelActual < numNivel){
                                nivelActual = numNivel
                                this.maxNivelEdu = datosniveleduc[i].niveleduc

                                this.arrayDataNivelEdu = {
                                    'niveleduc':datosniveleduc[i].niveleduc,
                                    'titulo':datosniveleduc[i].titulo,
                                    'paistit':datosniveleduc[i].paistit,
                                    'institucion':datosniveleduc[i].institucion,
                                    'estadotit':datosniveleduc[i].estadotit
                                } 
                            }
                        }
                        if(datosniveleduc[i].niveleduc == 'Básica Primaria(1-5)'){
                            var numNivel = 2;
                            if(nivelActual < numNivel){
                                nivelActual = numNivel
                                this.maxNivelEdu = datosniveleduc[i].niveleduc

                                this.arrayDataNivelEdu = {
                                    'niveleduc':datosniveleduc[i].niveleduc,
                                    'titulo':datosniveleduc[i].titulo,
                                    'paistit':datosniveleduc[i].paistit,
                                    'institucion':datosniveleduc[i].institucion,
                                    'estadotit':datosniveleduc[i].estadotit
                                } 
                            }
                        }
                        if(datosniveleduc[i].niveleduc == 'Básica Secundaria(6-9)'){
                            var numNivel = 3;
                            if(nivelActual < numNivel){
                                nivelActual = numNivel
                                this.maxNivelEdu = datosniveleduc[i].niveleduc

                                this.arrayDataNivelEdu = {
                                    'niveleduc':datosniveleduc[i].niveleduc,
                                    'titulo':datosniveleduc[i].titulo,
                                    'paistit':datosniveleduc[i].paistit,
                                    'institucion':datosniveleduc[i].institucion,
                                    'estadotit':datosniveleduc[i].estadotit
                                } 
                            }
                        }
                        if(datosniveleduc[i].niveleduc == 'Media (10-12)'){
                            var numNivel = 4;
                            if(nivelActual < numNivel){
                                nivelActual = numNivel
                                this.maxNivelEdu = datosniveleduc[i].niveleduc

                                this.arrayDataNivelEdu = {
                                    'niveleduc':datosniveleduc[i].niveleduc,
                                    'titulo':datosniveleduc[i].titulo,
                                    'paistit':datosniveleduc[i].paistit,
                                    'institucion':datosniveleduc[i].institucion,
                                    'estadotit':datosniveleduc[i].estadotit
                                } 
                            }
                        }
                        if(datosniveleduc[i].niveleduc == 'Técnica Laboral'){
                            var numNivel = 5;
                            if(nivelActual < numNivel){
                                nivelActual = numNivel
                                this.maxNivelEdu = datosniveleduc[i].niveleduc

                                this.arrayDataNivelEdu = {
                                    'niveleduc':datosniveleduc[i].niveleduc,
                                    'titulo':datosniveleduc[i].titulo,
                                    'paistit':datosniveleduc[i].paistit,
                                    'institucion':datosniveleduc[i].institucion,
                                    'estadotit':datosniveleduc[i].estadotit
                                } 
                            }
                        }
                        if(datosniveleduc[i].niveleduc == 'Técnica Profesional'){
                            var numNivel = 6;
                            if(nivelActual < numNivel){
                                nivelActual = numNivel
                                this.maxNivelEdu = datosniveleduc[i].niveleduc

                                this.arrayDataNivelEdu = {
                                    'niveleduc':datosniveleduc[i].niveleduc,
                                    'titulo':datosniveleduc[i].titulo,
                                    'paistit':datosniveleduc[i].paistit,
                                    'institucion':datosniveleduc[i].institucion,
                                    'estadotit':datosniveleduc[i].estadotit
                                } 
                            }
                        }
                        if(datosniveleduc[i].niveleduc == 'Tecnología'){
                            var numNivel = 7;
                            if(nivelActual < numNivel){
                                nivelActual = numNivel
                                this.maxNivelEdu = datosniveleduc[i].niveleduc

                                this.arrayDataNivelEdu = {
                                    'niveleduc':datosniveleduc[i].niveleduc,
                                    'titulo':datosniveleduc[i].titulo,
                                    'paistit':datosniveleduc[i].paistit,
                                    'institucion':datosniveleduc[i].institucion,
                                    'estadotit':datosniveleduc[i].estadotit
                                } 
                            }
                        }
                        if(datosniveleduc[i].niveleduc == 'Universitaria'){
                            var numNivel = 8;
                            if(nivelActual < numNivel){
                                nivelActual = numNivel
                                this.maxNivelEdu = datosniveleduc[i].niveleduc

                                this.arrayDataNivelEdu = {
                                    'niveleduc':datosniveleduc[i].niveleduc,
                                    'titulo':datosniveleduc[i].titulo,
                                    'paistit':datosniveleduc[i].paistit,
                                    'institucion':datosniveleduc[i].institucion,
                                    'estadotit':datosniveleduc[i].estadotit
                                } 
                            }
                        }
                        if(datosniveleduc[i].niveleduc == 'Especialización'){
                            var numNivel = 9;
                            if(nivelActual < numNivel){
                                nivelActual = numNivel
                                this.maxNivelEdu = datosniveleduc[i].niveleduc

                                this.arrayDataNivelEdu = {
                                    'niveleduc':datosniveleduc[i].niveleduc,
                                    'titulo':datosniveleduc[i].titulo,
                                    'paistit':datosniveleduc[i].paistit,
                                    'institucion':datosniveleduc[i].institucion,
                                    'estadotit':datosniveleduc[i].estadotit
                                } 
                            }
                        }
                        if(datosniveleduc[i].niveleduc == 'Maestría'){
                            var numNivel = 10;
                            if(nivelActual < numNivel){
                                nivelActual = numNivel
                                this.maxNivelEdu = datosniveleduc[i].niveleduc

                                this.arrayDataNivelEdu = {
                                    'niveleduc':datosniveleduc[i].niveleduc,
                                    'titulo':datosniveleduc[i].titulo,
                                    'paistit':datosniveleduc[i].paistit,
                                    'institucion':datosniveleduc[i].institucion,
                                    'estadotit':datosniveleduc[i].estadotit
                                } 
                            }
                        }
                        if(datosniveleduc[i].niveleduc == 'Doctorado'){
                            var numNivel = 11;
                            if(nivelActual < numNivel){
                                nivelActual = numNivel
                                this.maxNivelEdu = datosniveleduc[i].niveleduc

                                this.arrayDataNivelEdu = {
                                    'niveleduc':datosniveleduc[i].niveleduc,
                                    'titulo':datosniveleduc[i].titulo,
                                    'paistit':datosniveleduc[i].paistit,
                                    'institucion':datosniveleduc[i].institucion,
                                    'estadotit':datosniveleduc[i].estadotit
                                } 
                            }
                        }
                    }
                    
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

                this.calcularEdad(this.fnac)

            } catch (error) {
                this.error = error;
                console.log(this.error);
            } finally {

            }
        },

        editarHV() {
            location = 'editarHV.html'
        },

        verAdjuntos(){
            sessionStorage.setItem('docuser', this.doc)
            sessionStorage.setItem('nombreuser', this.nombres)
            location = 'documentos.html'
        },

        verHojaVida(){
            location = 'hojadevida.html'
        }, 

        cerrar() {
            sessionStorage.clear()
            location = 'index.html'
        },

        calcularEdad(fecha){
            var hoy = new Date();
            var cumpleanos = new Date(fecha);
            var edad = hoy.getFullYear() - cumpleanos.getFullYear();
            var m = hoy.getMonth() - cumpleanos.getMonth();

            if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
                edad--;
            }

            this.edad = edad;
        },

        
          

        genererPDF(){
            
            html2pdf(document.getElementById("hoja-de-vida"), {
				margin: 5,
  			    filename: this.doc + ".pdf",
                format: 'letter', 
                orientation: 'portrait',
                pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
			});
        }



    },
});

const mountedApp = app.mount("#app");