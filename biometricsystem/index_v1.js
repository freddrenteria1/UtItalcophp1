

var server = 'https://utitalco.com/biometricsystem/server/'
var datos = []
var numods = ''
var arrayLugar = []
var listaLugar = ''
var arrayTurnos = []
var arrayTurnosList = []
var listaTurnos = ''
var arrayConceptos = []
var arrayCargos = []
var arrayFrentesTrab = []
var arrayGrupos = []
var listaGrupos = ''
var listaGruposOriginal = []
var listaCargos = ''
var listaFrentes = ''
var arraySubcontratistas = []
var listaSubcontra = ''
var arrayTrabajadores = []
var arrayNovedades = []

var arrayBusqueda = []
var arrayRespuestas = []

var fechaMarcacion = ''

var arrayConsolidado = []

var arrayFrenteGrafica = []
var arraryCantFrenteDir = []
var arraryCantFrenteIndir = []
var arrayCantFrenteTotal = []

var arrayAsistencia = []
var arrayUsers = []

var idtmp = null

var user = null
var cargaTablaTrab = null

user = sessionStorage.getItem('user')
numods = sessionStorage.getItem('ods')
privilegio = sessionStorage.getItem('privilegio')



if (user == null) {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Sesión no válida',
        footer: 'Solicite una clave al administrador'
    }).then(() => {
        location = 'login.html'
    })
}

cargarDatosEmp();
cargarLugar();
cargarFrentes();
cargarGrupos();
cargarTurnos();
cargarConceptos();
cargarCargos();
cargarSubcontratistas();
cargarTrabajadores();
cargarNovedades();
cargarUsers();

function cerrar(id) {
    $('#' + id).addClass('oculto');
}

function abrir(id) {
    $('#' + id).removeClass('oculto');
}

function salir() {
    sessionStorage.clear
    location = 'login.html'
}

function cargarSubcontratistas() {
    var html = ''
    $.post(server + 'cargarSubcontratistas.php', {},
        function (resp) {
            arraySubcontratistas = resp
            console.log(resp)

            for (var i = 0; i < arraySubcontratistas.length; i++) {
                listaSubcontra += `
                        <option value="${arraySubcontratistas[i].codigo}">${arraySubcontratistas[i].empresa}</option>
                    `
                html += `
                        <tr>
                            <td>${arraySubcontratistas[i].codigo}</td>
                            <td>${arraySubcontratistas[i].empresa}</td>
                            <td><span class="float-right rojo" onClick="borrarSubcontratista(${i})"><i class="fas fa-window-close"></i></span></td>
                        </tr>
                        `
            }
            $('#datosSubcontratistas').html(html)
            $('#emptrab').html(listaSubcontra)
        })
}

function guardarFrente() {
    var frentetrabg = $('#frentetrabg').val()
    var liderecp = $('#liderecp').val()

    $.post(server + 'guardarFrentetrab.php', {
        frentetrab: frentetrabg,
        liderecp: liderecp,
        ods: numods
    },
        function (resp) {
            if (resp.msn = 'Ok') {
                Swal.fire({
                    icon: 'success',
                    title: 'Frente',
                    text: 'Agregado...'
                })
                cargarFrentes()

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Frente no agregado'
                })
            }
        })
}


function guardarGrupo() {
    var ftrab = $('#listadofrentes').val()
    var grupo = $('#grupo').val()
    var supgrupo = $('#supgrupo').val()
    var docsup = $('#docsup').val()

    $.post(server + 'guardarGrupo.php', {
        frente: ftrab,
        grupo: grupo,
        supgrupo: supgrupo,
        docsup: docsup,
        ods: numods
    },
        function (resp) {
            if (resp.msn = 'Ok') {
                Swal.fire({
                    icon: 'success',
                    title: 'Grupo',
                    text: 'Agregado...'
                })
                cargarGrupos()

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Grupo no agregado'
                })
            }
        })
}

function cargarFrentes() {
    $.post(server + 'cargarFrentes.php', {
        ods: numods
    },
        function (resp) {
            arrayFrentesTrab = resp
            var html = ''
            listaFrentes = '<option value="">Seleccione un frente</option>'
            for (var i = 0; i < arrayFrentesTrab.length; i++) {
                listaFrentes +=
                    `<option value="${arrayFrentesTrab[i].frentetrab}">${arrayFrentesTrab[i].frentetrab}</option>`
                html += `
                            <tr>
                                <td>${arrayFrentesTrab[i].frentetrab}</td>
                                <td><button type="button" class="btn btn-warning" onclick="editarFrente('${i}')"><i class="fas fa-edit"></i></button>
                            </tr>
                        `
            }
            $('#datosFrentes').html(html)
            $('#frentestrab').html(listaFrentes)
            //$('#grupoasis').html(listaGrupos)
            var listg = '<option value="">Seleccione un Frente</option>';
            var listh = listg + '<option value="Todos">Todos</option>';

            listg += listaFrentes

            listh += listaFrentes


            $('#listadofrentes').html(listg)
            $('#frentetrab').html(listg)
            $('#frentetrab2').html(listg)
            $('#frentetrab3').html(listg)
            $('#frentetrab4').html(listh)
            $('#frentetrab5').html(listh)
            $('#frentetrab6').html(listh)

        })


}

function editarFrente(i) {
    var idfrente = arrayFrentesTrab[i].id
    var frentetrabe = arrayFrentesTrab[i].frentetrab
    var liderecpe = arrayFrentesTrab[i].liderecp
    Swal.fire({
        title: 'Editar Frente',
        html: `
                <label>Frente:</label>
                <input type="text" id="frentetrabedit" class="form-control" value="${frentetrabe}">
                <label>Líder ECP:</label>
                <input type="text" id="liderecpe" class="form-control" value="${liderecpe}">
                `,
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar'
    }).then((result) => {
        if (result.isConfirmed) {

            frentetrabe = $('#frentetrabedit').val()
            liderecpe = $('#liderecpe').val()

            $.post(server + 'actFrentes.php', {
                frente: frentetrabe,
                liderecp: liderecpe,
                id: idfrente
            },
                function (resp) {

                    cargarFrentes()

                    Swal.fire(
                        'Actualizado!',
                        'Frente actualizado.',
                        'success'
                    )

                });

        }
    })

}


function borrarGrupo(i) {
    var idgrupo = arrayGrupos[i].id
    var frentetrabe = arrayGrupos[i].frentetrab
    var grupo = arrayGrupos[i].grupo;

    Swal.fire({
        title: 'Borrar Grupo',
        html: `
                Desea borrar el grupo ${grupo} del frente ${frentetrabe} ?
                
                `,
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar'
    }).then((result) => {
        if (result.isConfirmed) {



            $.post(server + 'borrarGrupo.php', {
                id: idgrupo
            },
                function (resp) {

                    cargarGrupos()

                    Swal.fire(
                        'Actualizado!',
                        'Grupo borrado.',
                        'success'
                    )

                });

        }
    })

}


function editarGrupo(i) {
    var idgrupo = arrayGrupos[i].id
    var frentetrabe = arrayGrupos[i].frentetrab
    var grupo = arrayGrupos[i].grupo;

    Swal.fire({
        title: 'Editar Grupo',
        html: `
                <label>Frente:</label>
                <input type="text" id="frentetrabedit2" class="form-control" value="${frentetrabe}">
                <label>Grupo:</label>
                <input type="text" id="grupoedit" class="form-control" value="${grupo}">
                <label>Supervisor:</label>
                <input type="text" id="supedit" class="form-control" value="${arrayGrupos[i].supervisor}">
                <label>Doc:</label>
                <input type="text" id="docsupeedit" class="form-control" value="${arrayGrupos[i].doc}">
                `,
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar'
    }).then((result) => {
        if (result.isConfirmed) {

            frentetrabe = $('#frentetrabedit2').val()
            grupo = $('#grupoedit').val()
            var supg = $('#supedit').val()
            var docsg = $('#docsupeedit').val()


            $.post(server + 'actGrupo.php', {
                frente: frentetrabe,
                grupo: grupo,
                supervisor: supg,
                doc: docsg,
                id: idgrupo
            },
                function (resp) {

                    cargarGrupos()

                    Swal.fire(
                        'Actualizado!',
                        'Grupo actualizado.',
                        'success'
                    )

                });

        }
    })

}

function cargarListaGrupo2() {
    var frentesel = $('#frentetrab2').val()
    $.post(server + 'cargarGruposSel.php', {
        frente: frentesel,
        ods: numods
    },
        function (resp) {
            var arrayGruposS = resp
            var html = ''
            listaGrupos = ''
            $('#grupotrab2').html(listaGrupos)
            for (var i = 0; i < arrayGruposS.length; i++) {
                listaGrupos +=
                    `<option value="${arrayGruposS[i].grupo}">${arrayGruposS[i].grupo} - ${arrayGruposS[i].supervisor}</option>`
            }

            $('#grupotrab2').html(listaGrupos)

        })
}

function cargarListaGrupo3() {
    var frentesel = $('#frentetrab3').val()
    $.post(server + 'cargarGruposSel.php', {
        frente: frentesel,
        ods: numods
    },
        function (resp) {
            var arrayGruposS = resp
            var html = ''
            listaGrupos = '<option value="">Selecciones un grupo</option>'
            $('#grupotrab3').html(listaGrupos)
            for (var i = 0; i < arrayGruposS.length; i++) {
                listaGrupos +=
                    `<option value="${arrayGruposS[i].grupo}">${arrayGruposS[i].grupo} - ${arrayGruposS[i].supervisor}</option>`
            }

            $('#grupotrab3').html(listaGrupos)

        })
}

function cargarListaGrupo4() {
    var frentesel = $('#frentetrab_ph').val()
    $.post(server + 'cargarGruposSel.php', {
        frente: frentesel,
        ods: numods
    },
        function (resp) {
            var arrayGruposS = resp
            var html = ''
            listaGrupos = '<option value="">Selecciones un grupo</option>'
            $('#grupotrab3').html(listaGrupos)
            for (var i = 0; i < arrayGruposS.length; i++) {
                listaGrupos +=
                    `<option value="${arrayGruposS[i].grupo}">${arrayGruposS[i].grupo} - ${arrayGruposS[i].supervisor}</option>`
            }

            $('#grupo_ph').html(listaGrupos)

        })
}

function cargarListaGrupo() {
    var frentesel = $('#frentetrab').val()
    $.post(server + 'cargarGruposSel.php', {
        frente: frentesel,
        ods: numods
    },
        function (resp) {
            var arrayGruposS = resp
            var html = ''
            listaGrupos = ''
            $('#grupotrab').html(listaGrupos)
            for (var i = 0; i < arrayGruposS.length; i++) {
                listaGrupos +=
                    `<option value="${arrayGruposS[i].grupo}">${arrayGruposS[i].grupo} - ${arrayGruposS[i].supervisor}</option>`
            }

            $('#grupotrab').html(listaGrupos)

        })
}

function cargarListaGrupoI() {
    var frentesel = $('#frentetrab').val()
    $.post(server + 'cargarGruposSel.php', {
        frente: frentesel,
        ods: numods
    },
        function (resp) {
            var arrayGruposS = resp
            var html = ''
            listaGrupos = ''
            $('#grupotrab').html(listaGrupos)
            for (var i = 0; i < arrayGruposS.length; i++) {
                listaGrupos +=
                    `<option value="${arrayGruposS[i].grupo}">${arrayGruposS[i].grupo} - ${arrayGruposS[i].supervisor}</option>`
            }

            $('#grupotrab').html(listaGrupos)


        })
}

function cargarGrupos() {
    $.post(server + 'cargarGrupos.php', {
        ods: numods
    },
        function (resp) {
            arrayGrupos = resp
            var html = ''
            listaGrupos = ''
            listaGruposOriginal = ''
            for (var i = 0; i < arrayGrupos.length; i++) {
                listaGrupos +=
                    `<option value="${arrayGrupos[i].grupo}">${arrayGrupos[i].grupo} - ${arrayGrupos[i].frentetrab}</option>`
                listaGruposOriginal +=
                    `<option value="${arrayGrupos[i].grupo}">${arrayGrupos[i].grupo} - ${arrayGrupos[i].frentetrab}</option>`
                html += `
                            <tr>
                                <td>${arrayGrupos[i].frentetrab}</td>
                                <td>${arrayGrupos[i].grupo}</td>
                                <td>${arrayGrupos[i].supervisor}</td>
                                <td>
                                    <button type="button" class="btn btn-warning" onclick="editarGrupo(${i})"><i class="fas fa-edit"></i></button>
                                    <button type="button" class="btn btn-warning" onclick="borrarGrupo(${i})"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        `
            }
            $('#datosGrupos').html(html)
            //$('#grupotrab').html(listaGrupos)
            //$('#grupoasis').html(listaGrupos)
            var listg = '<option value="">Seleccione un Grupo/Frente</option>';
            listg += listaGrupos
            $('#gruponov').html(listg)
        })
}



function agregarSubcontratista() {
    var codsub = $('#codsub').val()
    var empresasub = $('#empresasub').val()


    $.post(server + 'guardarSubcontratista.php', {
        codsub: codsub,
        empresasub: empresasub
    },
        function (resp) {
            if (resp.msn = 'Ok') {
                Swal.fire({
                    icon: 'success',
                    title: 'Subcontratistas',
                    text: 'Subcontratista agregado...'
                })
                cargarSubcontratistas()

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Subcontratista no agregado'
                })
            }
        })
}

function cargarCargos() {
    var html = ''
    $.post(server + 'cargarCargos.php', {},
        function (resp) {
            arrayCargos = resp
            console.log(resp)
            for (var i = 0; i < arrayCargos.length; i++) {
                listaCargos += `
                            <option value="${arrayCargos[i].cargo}">${arrayCargos[i].cargo}</option>
                        `
                html += `
                        <tr>
                             
                            <td>${arrayCargos[i].cargo}</td>
                            <td><span class="float-right rojo" onClick="borrarCargo(${i})"><i class="fas fa-window-close"></i></span></td>
                        </tr>
                        `
            }
            $('#datosCargos').html(html)
            //$('#cargotrab').html(listaCargos)
        })
}

function agregarCargo() {
    var codcargo = $('#codcargo').val()
    var detcargo = $('#detcargo').val()


    $.post(server + 'guardarCargo.php', {

        detcargo: detcargo
    },
        function (resp) {
            if (resp.msn = 'Ok') {
                Swal.fire({
                    icon: 'success',
                    title: 'Cargos',
                    text: 'Cargo agregado...'
                })
                cargarCargos()

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Cargo no agregado'
                })
            }
        })
}

function agregarConcepto() {
    var codconcepto = $('#codconcepto').val()
    var detconcepto = $('#detconcepto').val()


    $.post(server + 'guardarConcepto.php', {
        codconcepto: codconcepto,
        detconcepto: detconcepto
    },
        function (resp) {
            if (resp.msn = 'Ok') {
                Swal.fire({
                    icon: 'success',
                    title: 'Concepto',
                    text: 'Concepto agregado...'
                })
                cargarConceptos()

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Concepto no agregado'
                })
            }
        })
}

function cargarConceptos() {
    var html = ''
    $.post(server + 'cargarConceptos.php', {},
        function (resp) {
            arrayConceptos = resp
            console.log(resp)
            var listanovedades = ''
            for (var i = 0; i < arrayConceptos.length; i++) {
                listanovedades += `
                        <option value="${arrayConceptos[i].concepto}">${arrayConceptos[i].concepto}</option>
                        `
                html += `
                        <tr>
                            <td>${arrayConceptos[i].codigo}</td>
                            <td>${arrayConceptos[i].concepto}</td>
                            <td><span class="float-right rojo" onClick="borrarConcepto(${i})"><i class="fas fa-window-close"></i></span></td>
                        </tr>
                        `
            }
            $('#datosConceptos').html(html)
            $('#novedad').html(listanovedades)
        })
}

function cargarTurnos() {
    var html = ''
    $.post(server + 'cargarTurnos.php', {},
        function (resp) {
            arrayTurnos = resp
            console.log(resp)
            arrayTurnosList = ''
            for (var i = 0; i < arrayTurnos.length; i++) {
                listaTurnos +=
                    `<option value="${arrayTurnos[i].codigo}">${arrayTurnos[i].codigo} :  ${arrayTurnos[i].hinicial} - ${arrayTurnos[i].hfinal}</option>`
                arrayTurnosList +=
                    `<option value="${arrayTurnos[i].codigo}">${arrayTurnos[i].codigo}</option>`
                html += `
                        <tr>
                            <td>${arrayTurnos[i].codigo}</td>
                            <td>${arrayTurnos[i].hinicial}</td>
                            <td>${arrayTurnos[i].hfinal}</td>
                            <td><span class="float-right rojo" onClick="borrarTurno(${i})"><i class="fas fa-window-close"></i></span></td>
                        </tr>
                        `
            }
            $('#datosTurnos').html(html)
            $('#turnotrab').html(listaTurnos)
            $('#turnotrab4').html(listaTurnos)
            $('#turnoasist').html(listaTurnos)

        })
}

function borrarSubcontratista(i) {
    var cod = arraySubcontratistas[i].codigo
    $.post(server + 'borrarSubcontratista.php', {
        cod: cod
    },
        function (resp) {
            cargarSubcontratistas()
        })
}

function borrarCargo(i) {
    var id = arrayCargos[i].id
    $.post(server + 'borrarCargo.php', {
        id: id
    },
        function (resp) {
            cargarCargos()
        })
}

function borrarConcepto(i) {
    var cod = arrayConceptos[i].codigo
    $.post(server + 'borrarConcepto.php', {
        cod: cod
    },
        function (resp) {
            cargarConceptos()
        })
}

function borrarTurno(i) {
    var turno = arrayTurnos[i].codigo
    $.post(server + 'borrarTurno.php', {
        turno: turno
    },
        function (resp) {
            cargarTurnos()
        })
}

function cargarLugar() {
    var html = ''
    $.post(server + 'cargarLugar.php', {},
        function (resp) {
            arrayLugar = resp
            console.log(resp)
            for (var i = 0; i < arrayLugar.length; i++) {
                listaLugar += `
                        <option value="${arrayLugar[i].lugar}">${arrayLugar[i].lugar}</option>
                        `
                html += `
                        <tr>
                            <td>${arrayLugar[i].lugar}</td>
                        </tr>
                        `
            }
            $('#lugartrabajo').html(html)
            $('#lugartrab').html(listaLugar)
        })
}

function agregarTurno() {
    var codigoturno = $('#codigoturno').val()
    var hinicial = $('#hinicial').val()
    var hfinal = $('#hfinal').val()

    $.post(server + 'guardarTurno.php', {
        codigoturno: codigoturno,
        hinicial: hinicial,
        hfinal: hfinal
    },
        function (resp) {
            if (resp.msn = 'Ok') {
                Swal.fire({
                    icon: 'success',
                    title: 'Turnos',
                    text: 'Turno agregado...'
                })
                cargarTurnos()

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Lugar no agregado'
                })
            }
        })
}

function cambiarTurnos() {
    var turno = $('#turnotrab4').val()
    var frentetrab = $('#frentetrab4').val()
    var grupo = $('#grupo_t').val()

    $.post(server + 'cambiarTurnos.php', {
        turno: turno,
        frente: frentetrab,
        grupo: grupo,
        ods: numods,
        user: user
    },
        function (resp) {
            if (resp.msn = 'Ok') {
                Swal.fire({
                    icon: 'success',
                    title: 'Turnos',
                    text: 'Turnos cambiados en el frente ' + frentetrab + ' Grupo: ' + grupo
                })
                location.reload()

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error al cambiar turnos'
                })
            }
        })
}

function agregarLugar() {
    var lugar = $('#lugar').val()
    $.post(server + 'guardarLugar.php', {
        lugar: lugar
    },
        function (resp) {
            if (resp.msn = 'Ok') {
                cargarLugar()
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Lugar no agregado'
                })
            }
        })
}

function actividades() {
    Swal.fire({
        title: 'Generar Actividades',
        html: `<hr>
                <div class="row" style="width: 100%;">
               
                   
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Fecha</label>
                            <input type="date" id="fechaact" class="form-control">
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Frente</label>
                            <select id="frentetrab_act" class="form-control">
                                ${listaFrentes}
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Turno</label>
                            <select id="turnoact" class="form-control">
                                ${listaTurnos}
                            </select>
                        </div>
                    </div>

                </div><hr>

                `,

        showCancelButton: true,
        confirmButtonText: 'Generar',
        cancelButtonText: 'Cancelar',
        showCloseButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            var fecha = $('#fechaact').val()
            var turnoac = $('#turnoact').val()
            var frentetrab = $('#frentetrab_act').val()
            window.open("actividades.html?fecha=" + fecha + "&ods=" + numods + "&frente=" + frentetrab +
                "&turno=" + turnoac, "_blank");
        }
    })
}

function planillas2() {
    Swal.fire({
        title: 'Generar Planillas de un Excel',
        html: `<hr>
                <div class="row" style="width: 100%;">
               
                   
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Fecha</label>
                            <input type="date" id="fechaplanillae" class="form-control">
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Frente</label>
                            <select id="frentetrab_e" class="form-control">
                                ${listaFrentes}
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Turno</label>
                            <select id="turnoplanillae" class="form-control">
                                ${listaTurnos}
                            </select>
                        </div>
                    </div>

                    

                </div><hr>

                `,

        showCancelButton: true,
        confirmButtonText: 'Generar',
        cancelButtonText: 'Cancelar',
        showCloseButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            var fecha = $('#fechaplanillae').val()
            var frentetrab = $('#frentetrab_e').val()
            var turnop = $('#turnoplanillae').val()
            var clasefirma = 'firmado'
            window.open("planillase.html?fecha=" + fecha + "&ods=" + numods + "&frente=" + frentetrab +
                "&turno=" + turnop + "&clasefirma=" + clasefirma, "_blank");
        }
    })
}

function correccion() {
    location = 'planillasc.html'
}

function planillas3() {
    Swal.fire({
        title: 'Generar Planilla Histórico',
        html: `<hr>
                <div class="row" style="width: 100%;">
               
                   
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Fecha</label>
                            <input type="date" id="fechaplanillae" class="form-control">
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Frente</label>
                            <select id="frentetrab_h" class="form-control" onchange="cargarGrupoH(this)">
                                ${listaFrentes}
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Grupo</label>
                            <select id="grupo_h" class="form-control">
                                
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Turno Anterior</label>
                            <select id="turnoplanillae" class="form-control">
                                ${listaTurnos}
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Turno Corregido</label>
                            <select id="turnoplanillaec" class="form-control">
                                ${listaTurnos}
                            </select>
                        </div>
                    </div>

                    

                </div><hr>

                `,

        showCancelButton: true,
        confirmButtonText: 'Generar',
        cancelButtonText: 'Cancelar',
        showCloseButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {

            var fecha = $('#fechaplanillae').val()
            var turnop = $('#turnoplanillae').val()
            var turnoc = $('#turnoplanillaec').val()
            var frente = $('#frentetrab_h').val()
            var grupo = $('#grupo_h').val()

            var clasefirma = 'firmado'
            window.open("planillashv1.html?fecha=" + fecha + "&ods=" + numods +
                "&turno=" + turnop + "&turnoc=" + turnoc + "&frente=" + frente + "&grupo=" + grupo, "_blank");
        }
    })
}


function repdescansos() {

    window.open("https://utitalco.com/biometricsystem/repDescansos.html ", "_blank");
}


function planillas() {
    Swal.fire({
        title: 'Generar Planillas',
        html: `<hr>
                <div class="row" style="width: 100%;">
               
                   
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Fecha</label>
                            <input type="date" id="fechaplanilla" class="form-control">
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Frente</label>
                            <select id="frentetrab_" class="form-control" onchange="cargarGrupo(this)">
                                ${listaFrentes}
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Grupo</label>
                            <select id="grupo_" class="form-control">
                                
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Turno</label>
                            <select id="turnoplanilla" class="form-control">
                                ${listaTurnos}
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Clase Firma</label>
                            <select id="clasefirma" class="form-control">
                                <option value='firmado'>Firma digital</option>
                                <option value='sinfirma'>Firma manual</option>
                            </select>
                        </div>
                    </div>

                </div><hr>

                `,

        showCancelButton: true,
        confirmButtonText: 'Generar',
        cancelButtonText: 'Cancelar',
        showCloseButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            var fecha = $('#fechaplanilla').val()
            var frentetrab = $('#frentetrab_').val()
            var grupop = $('#grupo_').val()
            var turnop = $('#turnoplanilla').val()
            var clasefirma = $('#clasefirma').val()
            window.open("planillasv1.html?fecha=" + fecha + "&ods=" + numods + "&frente=" + frentetrab + "&grupo=" + grupop +
                "&turno=" + turnop + "&clasefirma=" + clasefirma, "_blank");
        }
    })
}

function impMarcaciones() {
    Swal.fire({
        title: 'Importar Marcaciones',
        html: `<hr>
                <div class="row" style="width: 100%;">
               
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Fecha</label>
                            <input type="date" class="form-control" id="fechamarca" >
                        </div>
                        <div class="form-group">
                            <label for="">Archivo</label>
                            <input type="file" class="form-control" id="excelMarcaciones"  ref="excelMarcaciones" placeholder="Importar">
                        </div>
                    </div>
                </div><hr>
                `,

        showCancelButton: true,
        confirmButtonText: 'Importar',
        cancelButtonText: 'Cancelar',
        showCloseButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            var file = document.getElementById('excelMarcaciones').files[0]
            var fechamarca = $('#fechamarca').val()

            let formData = new FormData();
            formData.append('excel', file);
            formData.append('fecha', fechamarca);

            cargando2()

            if (fechamarca != ''){

                $.ajax({
                    url: server + 'subirMarcaciones.php',
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
    
                        console.log(response)
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        Toast.fire({
                            icon: 'success',
                            title: '¡Importado!',
                            text: 'Marcaciones importadas... Cantidad de registros: '
                        })
    
                        //location.reload()
    
                    }
                })

            }else{
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                Toast.fire({
                    icon: 'info',
                    title: '¡Alerta!',
                    text: 'Por favor selecciones una fecha... '
                })
            }



        }
    })
}

function cargando2() {
    let timerInterval
    Swal.fire({
        title: 'Cargando!',
        html: 'Un momento por favor...',
        timer: 60000,
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

function impMarcaciones2() {
    Swal.fire({
        title: 'Importar Marcaciones Caudata',
        html: `<hr>
                <div class="row" style="width: 100%;">
               
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Fecha</label>
                            <input type="date" class="form-control" id="fechamarca" >
                        </div>
                        <div class="form-group">
                            <label for="">Archivo</label>
                            <input type="file" class="form-control" id="excelMarcaciones"  ref="excelMarcaciones" placeholder="Importar">
                        </div>
                    </div>
                </div><hr>
                `,

        showCancelButton: true,
        confirmButtonText: 'Importar',
        cancelButtonText: 'Cancelar',
        showCloseButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            var file = document.getElementById('excelMarcaciones').files[0]
            var fechamarca = $('#fechamarca').val()

            let formData = new FormData();
            formData.append('excel', file);
            formData.append('fecha', fechamarca);

            $.ajax({
                url: server + 'subirMarcacionesCaudata.php',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {


                    arrayRespuestas = response
                    console.log(response)
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    Toast.fire({
                        icon: 'success',
                        title: '¡Importado!',
                        text: 'Marcaciones importadas...'
                    })

                    location.reload()

                }
            })

        }
    })
}

function impAsistencias() {
    Swal.fire({
        title: 'Importar Asistencias',
        html: `<hr>
                <div class="row" style="width: 100%;">
               
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Fecha</label>
                            <input type="date" class="form-control" id="fechaasistencia" >
                        </div>
                        <div class="form-group">
                            <label for="">Archivo</label>
                            <input type="file" class="form-control" id="excelAsistencias"  ref="excelAsistencias" placeholder="Importar">
                        </div>
                    </div>
                </div><hr>
                `,

        showCancelButton: true,
        confirmButtonText: 'Importar',
        cancelButtonText: 'Cancelar',
        showCloseButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            var file = document.getElementById('excelAsistencias').files[0]
            var fechamarca = $('#fechaasistencia').val()

            let formData = new FormData();
            formData.append('excel', file);
            formData.append('fecha', fechamarca);
            formData.append('ods', numods);

            $.ajax({
                url: server + 'subirAsistencias.php',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    Toast.fire({
                        icon: 'success',
                        title: '¡Importado!',
                        text: 'Asistencias importadas...'
                    })

                    location.reload()

                }
            })

        }
    })
}


function expMarcaciones() {
    Swal.fire({
        title: 'Generar archivo plano',
        html: `<hr>
                <h4>Exportar a Caudata</h4>
                <div class="row" style="width: 100%;">
               
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Fecha Inicio</label>
                            <input type="date" class="form-control" id="finicio" placeholder="">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Fecha Fin</label>
                            <input type="date" class="form-control" id="ffin" placeholder="">
                        </div>
                    </div>                   
                </div><hr>

                `,

        showCancelButton: true,
        confirmButtonText: 'Generar',
        cancelButtonText: 'Cancelar',
        showCloseButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            var finicio = $('#finicio').val()
            var ffin = $('#ffin').val()
            location = server + 'exportarAsistenciaCaudataCon.php?ods=' + numods + '&finicio=' + finicio + "&ffin=" + ffin

        }
    })
}

function cargarDatosEmp() {
    $.post(server + 'datosEmpresa.php', {},
        function (resp) {
            datos = resp
            $('#nit').val(resp.nit)
            $('#razon').val(resp.razon)
            $('#dir').val(resp.domicilio)
            $('#tel').val(resp.tel)
            $('#doc').val(resp.doc)
            $('#rep').val(resp.rep)
            $('#email').val(resp.email)
        })
}

function actEmpresa() {
    var nit = $('#nit').val()
    var razon = $('#razon').val()
    var dir = $('#dir').val()
    var tel = $('#tel').val()
    var ced = $('#doc').val()
    var rep = $('#rep').val()
    var email = $('#email').val()

    $.post(server + 'actEmpresa.php', {
        nit: nit,
        razon: razon,
        dir: dir,
        tel: tel,
        ced: ced,
        rep: rep,
        email: email
    },
        function (resp) {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Datos actualizados',
                showConfirmButton: false,
                timer: 1500
            })
        })
}

function cargarTrabajadoresSel() {
    var gruposel = $('#grupotrab2').val()
    var frentesel = $('#frentetrab2').val()


    $.post(server + 'cargarTrabajadoresSel.php', {
        frente: frentesel,
        grupo: gruposel,
        ods: numods
    },
        function (resp) {
            arrayTrabajadores = resp
            var html = ''
            $('#datosTrab').html(html)
            for (var i = 0; i < arrayTrabajadores.length; i++) {
                html += `
                        <tr>
                            <td><button type="button" class="btn btn-danger" onclick="editarTrab(${i})" ><i class="fas fa-edit"></i></button></td>
                            <td>${arrayTrabajadores[i].id}</td>
                            <td>${arrayTrabajadores[i].contrato}</td>
                            <td>${arrayTrabajadores[i].cedula}</td>
                            <td>${arrayTrabajadores[i].nombres} ${arrayTrabajadores[i].apellidos}</td>
                            <td>${arrayTrabajadores[i].cargo}</td>
                            <td style = "width: 300px">
                                <select class="form-control" id="grupo${i}" onchange="cambiarGrupo(${i})">
                                <option value="${arrayTrabajadores[i].frente}">${arrayTrabajadores[i].frente}</option>
                                ${listaGruposOriginal}
                                </select>
                            </td>
                            <td style = "width: 300px">
                                <select id="frenteTrabI${i}" class="form-control"  onchange="cambiarFrente(${i})">
                                    <option value="${arrayTrabajadores[i].frentetrab}">${arrayTrabajadores[i].frentetrab}</option>
                                    ${listaFrentes}
                                </select>
                            </td>
                            <td style="width: 110px;">
                                <select id="turnoi${i}" class="form-control" onchange="editarTurno(${i})">
                                    
                                    <option value="${arrayTrabajadores[i].turno}">${arrayTrabajadores[i].turno}</option>
                                    ${arrayTurnosList}
                                </select>
                            </td>
                            <td>${arrayTrabajadores[i].estado}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">`

                if (arrayTrabajadores[i].firma == '') {
                    html +=
                        `<button type="button" class="btn btn-danger" onclick="agregarFirma(${i})"><i class="fas fa-signature"></i></button>`
                } else {
                    html += `
                            <button type="button" class="btn btn-success" onclick="verfirma(${i})"><i class="fas fa-signature"></i></button>
                            `
                }

                html += `               
                                </div>
                            </td>
                        </tr>
                        `
            }
            $('#datosTrab').html(html)

            //cargarDataTable();
        })
}


function cargarTrabajadores() {
    $.post(server + 'cargarTrabajadores.php', {
        ods: numods
    },
        function (resp) {
            arrayTrabajadores = resp
            var html = ''
            for (var i = 0; i < arrayTrabajadores.length; i++) {
                if (arrayTrabajadores[i].est == 'Nuevo' || arrayTrabajadores[i].estado == 'Nuevo') {
                    var stilo = 'background-color: rgb(250, 165, 150);'
                } else {
                    var stilo = ''
                }
                html += `
                        <tr style='${stilo}'>
                            <td><button type="button" class="btn btn-danger" onclick="editarTrab(${i})" ><i class="fas fa-edit"></i></button></td>
                            <td>${arrayTrabajadores[i].id}</td>
                            <td>${arrayTrabajadores[i].contrato}</td>
                            <td>${arrayTrabajadores[i].cedula}</td>
                            <td>${arrayTrabajadores[i].nombres} ${arrayTrabajadores[i].apellidos}</td>
                            <td>${arrayTrabajadores[i].cargo}</td>
                            <td style = "width: 300px">
                                <select class="form-control" id="grupo${i}" onchange="cambiarGrupo(${i})">
                                <option value="${arrayTrabajadores[i].frente}">${arrayTrabajadores[i].frente}</option>
                                ${listaGrupos}
                                </select>
                            </td>
                            <td style = "width: 300px">
                                <select id="frenteTrabI${i}" class="form-control"  onchange="cambiarFrente(${i})">
                                    <option value="${arrayTrabajadores[i].frentetrab}">${arrayTrabajadores[i].frentetrab}</option>
                                    ${listaFrentes}
                                </select>
                            </td>
                            <td style="width: 110px;">
                                <select id="turnoi${i}" class="form-control" onchange="editarTurno(${i})">
                                    
                                    <option value="${arrayTrabajadores[i].turno}">${arrayTrabajadores[i].turno}</option>
                                    ${arrayTurnosList}
                                </select>
                            </td>
                            <td>${arrayTrabajadores[i].estado}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">`

                if (arrayTrabajadores[i].firma == '') {
                    html +=
                        `<button type="button" class="btn btn-danger" onclick="agregarFirma(${i})"><i class="fas fa-signature"></i></button>`
                } else {
                    html += `
                            <button type="button" class="btn btn-success" onclick="verfirma(${i})"><i class="fas fa-signature"></i></button>
                            `
                }

                html += `               
                                </div>
                            </td>
                        </tr>
                        `
            }
            $('#datosTrab').html(html)

            //cargarDataTable();
        })
}

function editarTrab(i) {

    idtmp = arrayTrabajadores[i].id

    $('#codtrab').val(arrayTrabajadores[i].contrato)
    $('#doctrab').val(arrayTrabajadores[i].cedula)
    $('#nombtrab').val(arrayTrabajadores[i].nombres)
    $('#apellidostrab').val(arrayTrabajadores[i].apellidos)
    $('#dirtrab').val(arrayTrabajadores[i].domicilio)
    $('#teltrab').val(arrayTrabajadores[i].telefono)
    $('#cargotrab').val(arrayTrabajadores[i].cargo)
    $('#turnotrab').val(arrayTrabajadores[i].turno)
    $('#emptrab').val(arrayTrabajadores[i].empresa)


    var html = `<option value="${arrayTrabajadores[i].frente}">${arrayTrabajadores[i].frente}</option>`
    $('#grupotrab').html(html)

    $('#frentetrab').val(arrayTrabajadores[i].frentetrab)
    $('#lugartrab').val(arrayTrabajadores[i].lugartrab)
    $('#acargo').val(arrayTrabajadores[i].acargo)
    $('#sistprecio').val(arrayTrabajadores[i].sistemaprecio)
    $('#tiponomina').val(arrayTrabajadores[i].tiponomina)
    $('#detpago').val(arrayTrabajadores[i].detpago)
    $('#finiciolabor').val(arrayTrabajadores[i].fingreso)
    $('#ffinallabor').val(arrayTrabajadores[i].fsalida)
    $('#estadotrab').val(arrayTrabajadores[i].estado)

    $('#btnacttrab').removeClass('oculto')
    $('#btncancelartrab').removeClass('oculto')
    $('#btnguardartrab').addClass('oculto')


}

function actTrab() {
    var codtrab = $('#codtrab').val()
    var doctrab = $('#doctrab').val()
    var nombtrab = $('#nombtrab').val()
    var apellidostrab = $('#apellidostrab').val()
    var dirtrab = $('#dirtrab').val()
    var teltrab = $('#teltrab').val()
    var cargotrab = $('#cargotrab').val()
    var turnotrab = $('#turnotrab').val()
    var emptrab = $('#emptrab').val()
    var grupotrab = $('#grupotrab').val()
    var frentetrab = $('#frentetrab').val()
    var lugartrab = $('#lugartrab').val()
    var acargo = $('#acargo').val()
    var sistprecio = $('#sistprecio').val()
    var tiponomina = $('#tiponomina').val()
    var detpago = $('#detpago').val()
    var finiciolabor = $('#finiciolabor').val()
    var ffinallabor = $('#ffinallabor').val()
    var estadotrab = $('#estadotrab').val()

    $.post(server + 'actTrab.php', {
        codigo: codtrab,
        doc: doctrab,
        nombres: nombtrab,
        apellidos: apellidostrab,
        dir: dirtrab,
        tel: teltrab,
        cargo: cargotrab,
        turno: turnotrab,
        empresa: emptrab,
        grupo: grupotrab,
        frentetrab: frentetrab,
        lugar: lugartrab,
        acargo: acargo,
        sistprecio: sistprecio,
        tiponomina: tiponomina,
        detpago: detpago,
        finicio: finiciolabor,
        ffinal: ffinallabor,
        estado: estadotrab,
        ods: numods,
        id: idtmp,
        user: user
    },
        function (resp) {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Datos actualizados',
                showConfirmButton: false,
                timer: 1500
            })
            cargarTrabajadores()
            limpiarTrab()
            $('#btnacttrab').addClass('oculto')
            $('#btncancelartrab').addClass('oculto')
            $('#btnguardartrab').removeClass('oculto')
        })

}

function cancelartrab() {

    $('#btnacttrab').addClass('oculto')
    $('#btncancelartrab').addClass('oculto')
    $('#btnguardartrab').removeClass('oculto')
    limpiarTrab()
}


function guardarTrab() {
    var codtrab = $('#codtrab').val()
    var doctrab = $('#doctrab').val()
    var nombtrab = $('#nombtrab').val()
    var apellidostrab = $('#apellidostrab').val()
    var dirtrab = $('#dirtrab').val()
    var teltrab = $('#teltrab').val()
    var cargotrab = $('#cargotrab').val()
    var turnotrab = $('#turnotrab').val()
    var emptrab = $('#emptrab').val()
    var frentetrab = $('#frentetrab').val()
    var grupotrab = $('#grupotrab').val()
    var lugartrab = $('#lugartrab').val()
    var acargo = $('#acargo').val()
    var sistprecio = $('#sistprecio').val()
    var tiponomina = $('#tiponomina').val()
    var detpago = $('#detpago').val()
    var finiciolabor = $('#finiciolabor').val()
    var ffinallabor = $('#ffinallabor').val()
    var estadotrab = $('#estadotrab').val()

    $.post(server + 'guardarTrab.php', {
        codigo: codtrab,
        doc: doctrab,
        nombres: nombtrab,
        apellidos: apellidostrab,
        dir: dirtrab,
        tel: teltrab,
        cargo: cargotrab,
        turno: turnotrab,
        empresa: emptrab,
        grupo: grupotrab,
        frentetrab: frentetrab,
        lugar: lugartrab,
        acargo: acargo,
        sistprecio: sistprecio,
        tiponomina: tiponomina,
        detpago: detpago,
        finicio: finiciolabor,
        ffinal: ffinallabor,
        estado: estadotrab,
        ods: numods,
        user: user
    },
        function (resp) {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Datos cargados',
                showConfirmButton: false,
                timer: 1500
            })
            cargarTrabajadores()
            limpiarTrab()
        })

}

function cargarDataTable() {

    if (cargaTablaTrab == null) {

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

        cargaTablaTrab = 1
    }
}


function importarTrab() {
    Swal.fire({
        title: 'Subir CSV',
        html: `
                
                    <input type="file" min="0" class="form-control"  id="excel" ref="excel" />
                
                `,
        showCancelButton: true,
        confirmButtonText: 'Subir',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            var file = document.getElementById('excel').files[0]

            let formData = new FormData();
            formData.append('excel', file);
            formData.append('ods', numods);

            $.ajax({
                url: server + 'subirExcelTrab.php',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {


                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    Toast.fire({
                        icon: 'success',
                        title: '¡Importado!',
                        text: 'Datos Cargados...'
                    })
                    cargarTrabajadores()

                }
            })

        }
    })
}

function guardarAsistencia() {
    var fechab = $('#fasis').val()

    $.post(server + 'guardarAsistencia.php', {
        fecha: fechab,
        ods: numods
    },
        function (resp) {
            console.log(resp.msn)
            if (resp.msn == 'Ok') {
                Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'Histórico almacenado...',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                if (resp.msn = 'Error') {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'danger',
                        title: 'No se puede guardar histórico con fechas anteriores...',
                        showConfirmButton: false,
                        timer: 3000
                    })
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'info',
                        title: resp.msn,
                        showConfirmButton: false,
                        timer: 3000
                    })
                }
            }
        })
}

function cargarConsolidado() {
    var fechab = $('#fasis2').val()

    $.post(server + 'buscarAsistencia.php', {
        fecha: fechab,
        ods: numods
    },
        function (resp) {
            arrayAsistencia = resp
            var cantDir = 0
            var cantIndir = 0
            var totpersonal = 0
            var totpersonalDir = 0
            var totpersonalInd = 0
            var html = ''
            arrayFrenteGrafica = []
            arraryCantFrenteDir = []
            arraryCantFrenteIndir = []
            arrayCantFrenteTotal = []

            arrayConsolidado = []

            for (var a = 0; a < arrayFrentesTrab.length; a++) {

                var frentet = arrayFrentesTrab[a].frentetrab;
                cant = 0;
                cantDir = 0
                cantIndir = 0

                for (var i = 0; i < arrayAsistencia.length; i++) {

                    if (arrayAsistencia[i].frentetrab == frentet && arrayAsistencia[i].tipo !=
                        'SIN MARCACIÓN') {
                        if (arrayAsistencia[i].tiponomina == 'Directo') {
                            cantDir++
                            totpersonalDir++
                        } else {
                            cantIndir++
                            totpersonalInd++
                        }
                        totpersonal++
                    }

                }

                var totalper = cantDir + cantIndir

                arrayConsolidado.push({
                    "frente": frentet,
                    'cantDir': cantDir,
                    'cantIndir': cantIndir,
                    'total': totalper
                })

            }

            html = `
                        <h2>Total personal: ${totpersonal}</h2>
                        `

            for (var b = 0; b < arrayConsolidado.length; b++) {
                arrayFrenteGrafica.push(arrayConsolidado[b].frente)
                arraryCantFrenteDir.push(arrayConsolidado[b].cantDir)
                arraryCantFrenteIndir.push(arrayConsolidado[b].cantIndir)
                arrayCantFrenteTotal.push(arrayConsolidado[b].total)
            }

            $('#consolidado').html(html)

            cargarGraficas()


        })
}


function buscarAsistencia() {

    var fechab = $('#fasis').val()
    fechaMarcacion = fechab;
    var turnoa = $('#turnoasist').val()


    $.post(server + 'buscarAsistenciaDiaria.php', {
        fecha: fechab,
        ods: numods,
        turno: turnoa
    },
        function (resp) {

            arrayAsistencia = resp.trabajadores
            arrayMarca = resp.marcaciones
            var html = ''


            for (var i = 0; i < arrayAsistencia.length; i++) {

                var doc = arrayAsistencia[i].id
                var enc = 0;
                var tipo = 'SIN MARCACIÓN'

                for (var a = 0; a < arrayMarca.length; a++) {
                    if (arrayMarca[a].doc == doc) {
                        var tipo = arrayMarca[a].tipo
                        enc = 1;
                        var fechamarca = arrayMarca[a].fecha
                        var horamarca = arrayMarca[a].hora
                        var idmarca = arrayMarca[a].idmarca
                    }
                }

                if (enc == 0) {
                    var stilo = 'background-color: rgb(250, 165, 150);'
                } else {
                    var stilo = ''
                }



                html += `
                             
                            <tr style="${stilo}">
                                <td>${arrayAsistencia[i].nombres}</td>
                                <td>${arrayAsistencia[i].cargo}</td>
                                <td>${fechamarca}</td>
                                <td>${horamarca}</td>
                                <td>${tipo}</td>
                                <td>${arrayAsistencia[i].frentetrab}</td>
                                <td>${arrayAsistencia[i].grupo}</td>
                                <td>${arrayAsistencia[i].supervisor}</td>
                                <td></td>
                                <td>`
                if (tipo == 'SIN MARCACIÓN') {
                    html += ` <button type="button" class="btn btn-danger" onclick="agregarMarca('${i}')">M</button>`
                } else {
                    html += ` <button type="button" class="btn btn-warning" onclick="cambiarMarca('${i}')">C</button>`
                }

                html += `</td>
                            </tr>
                        `
            }

            $('#listaAsistencia').html(html)
        })
}

function cargarTrabNov() {
    var grup = $('#grupotrab3').val()
    $.post(server + 'buscarTrabGrupo.php', {
        grupo: grup,
        ods: numods
    },
        function (resp) {
            var html = ''
            $('#trabnov').html(html)
            for (var i = 0; i < resp.length; i++) {
                html += `
                        <option value="${resp[i].cedula}">${resp[i].nombres}</option>
                        `
            }
            $('#trabnov').html(html)
        })
}

function agregarNovedadTodos() {
    var fecha = $('#fechanovtodos').val()
    var frentenovedad = $('#frentetrab5').val()

    Swal.fire({
        title: 'Agregar Novedad',
        text: 'Desea agregar descansos al personal?',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar'
    }).then((result) => {
        if (result.isConfirmed) {

            $.post(server + 'guardarNovedadTodos.php', {
                fecha: fecha,
                frente: frentenovedad,
                ods: numods
            },
                function (resp) {
                    cargarNovedades()
                })

        }
    })
}

function quitarNovedadTodos() {
    var fecha = $('#fechanovtodos').val()
    var frentenovedad = $('#frentetrab5').val()

    Swal.fire({
        title: 'Quitar Novedad',
        text: 'Desea borrar descansos?',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.post(server + 'quitarNovedadTodos.php', {
                fecha: fecha,
                frente: frentenovedad,
                ods: numods
            },
                function (resp) {
                    cargarNovedades()
                })

        }
    })
}

function agregarNovedad() {
    var doc = $('#trabnov').val()
    var fecha = $('#fechanov').val()
    var novedad = $('#novedad').val()

    $.post(server + 'guardarNovedad.php', {
        doc: doc,
        fecha: fecha,
        novedad: novedad,
        ods: numods
    },
        function (resp) {
            cargarNovedades()
        })
}

function cargarNovedades() {
    $.post(server + 'cargarNovedades.php', {
        ods: numods
    },
        function (resp) {
            arrayNovedades = resp
            var html = ''
            for (var i = 0; i < arrayNovedades.length; i++) {
                html += `
                        <tr>
                            <td>${arrayNovedades[i].fecha}</td>
                            <td>${arrayNovedades[i].codigo}</td>
                            <td>${arrayNovedades[i].doc}</td>
                            <td>${arrayNovedades[i].nombres}</td>
                            <td>${arrayNovedades[i].cargo}</td>
                            <td>${arrayNovedades[i].grupo}</td>
                            <td>${arrayNovedades[i].novedad}</td>
                            <td><button type="button" class="btn btn-danger" onclick="borrarNovedad(${i})">
                                <i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    `
            }
            $('#datosNovedades').html(html)
        })
}

function borrarNovedad(i) {
    var idnov = arrayNovedades[i].id
    $.post(server + 'borrarNovedad.php', {
        id: idnov
    },
        function (resp) {
            cargarNovedades()
        })
}

function guardarUser() {
    var nombreuser = $('#nombreuser').val()
    var emailuser = $('#emailuser').val()
    var claveuser = $('#claveuser').val()
    var numodsuser = $('#numodsuser').val()
    var odsuser = $('#odsuser').val()
    var voboitalco = $('#voboitalco').val()
    var voboecp = $('#voboecp').val()

    $.post(server + 'guardarUser.php', {
        nombres: nombreuser,
        email: emailuser,
        clave: claveuser,
        numods: numodsuser,
        ods: odsuser,
        voboitalco: voboitalco,
        voboecp: voboecp
    },
        function (resp) {
            cargarUsers()
        })

}

function cargarUsers() {
    var html = ''
    $.post(server + 'cargarUser.php', {},
        function (resp) {
            arrayUsers = resp
            for (var i = 0; i < arrayUsers.length; i++) {
                html += `
                        <tr>
                            <td>${arrayUsers[i].nombres}</td>
                            <td>${arrayUsers[i].email}</td>
                            <td>${arrayUsers[i].numods}</td>
                            <td>${arrayUsers[i].ods}</td>
                            <td>${arrayUsers[i].voboitalco}</td>
                            <td>${arrayUsers[i].voboecp}</td>
                            <td>
                                <button class="btn btn-sm btn-danger" onClick="borrarUser(${i})">B</button>
                                <button class="btn btn-sm btn-warning" onClick="editarUser(${i})">E</button>
                                 
                            </td>
                        </tr>
                    `
            }
            $('#datosUser').html(html)
        })
}

function borrarUser(i) {
    var id = arrayUsers[i].id
    var nombuser = arrayUsers[i].nombres

    Swal.fire({
        title: 'Borrar Usuario',
        html: `
                 ¿Desea borrar el registro de: ${nombuser} ?
                `,
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar'
    }).then((result) => {
        if (result.isConfirmed) {

            $.post(server + 'borrarUser.php', {
                id: id
            },
                function (resp) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Cambio realizado',
                        showConfirmButton: false,
                        timer: 1000
                    }).then(() => {
                        cargarUsers()
                    })

                })

        }
    })


}

function editarUser(i) {

    var id = arrayUsers[i].id
    var nombuser = arrayUsers[i].nombres
    var voboitalco = arrayUsers[i].voboitalco
    var voboecp = arrayUsers[i].voboecp


    Swal.fire({
        title: 'Editar Datos Firmas',
        html: `
                Firma Italco
                 <input type="text" class="form-control" id="voboitalcoedit" value="${voboitalco}">
                 Firma Ecopetrol
                 <input type="text" class="form-control" id="voboecopedit" value="${voboecp}">
                `,
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Actualizar'
    }).then((result) => {
        if (result.isConfirmed) {

            var vbitalco = $('#voboitalcoedit').val()
            var vbecop = $('#voboecopedit').val()

            $.post(server + 'editUser.php', {
                id: id,
                vbitalco: vbitalco,
                vbecop: vbecop
            },
                function (resp) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Cambios realizados',
                        showConfirmButton: false,
                        timer: 1000
                    }).then(() => {
                        cargarUsers()
                    })

                })

        }
    })



}

function limpiarTrab() {
    $('#codtrab').val('')
    $('#doctrab').val('')
    $('#nombtrab').val('')
    $('#apellidostrab').val('')
    $('#dirtrab').val('')
    $('#teltrab').val('')
    $('#cargotrab').val('')
    $('#turnotrab').val('')
    $('#emptrab').val('')
    $('#grupotrab').val('')
    $('#frentetrab').val('')
    $('#lugartrab').val('')
    $('#acargo').val('')
    $('#sistprecio').val('')
    $('#tiponomina').val('')
    $('#detpago').val('')
    $('#finiciolabor').val('')
    $('#ffinallabor').val('')
    $('#estadotrab').val('')
}

function expBio() {
    location = server + 'exportarBio.php?ods=' + numods
}

function exportrAsistencia() {
    var fechab = $('#fasis').val()
    location = server + 'exportarAsistencia.php?ods=' + numods + '&fecha=' + fechab

}

function verfirma(i) {
    window.open(arrayTrabajadores[i].firma, '_blank');
}

function agregarFirma(i) {
    var ced = arrayTrabajadores[i].cedula
    var id = arrayTrabajadores[i].id

    Swal.fire({
        title: 'Agregar Firma',
        html: `
                <input type="file" id="firma" class="form-control">
                `,
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Cargar'
    }).then((result) => {
        if (result.isConfirmed) {
            var file = $('#firma')[0].files[0];
            var formData = new FormData();

            formData.append('file', file);
            formData.append('id', id);
            formData.append('doc', ced);

            $.ajax({
                url: server + 'guardarFirma.php',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'info',
                        title: 'Correcto...',
                        showConfirmButton: false,
                        timer: 500
                    }).then(() => {
                        location.reload()
                    })

                }
            })


        }
    })
}

function cargarGraficas() {
    Highcharts.chart('grafconso', {
        colors: ['#01005e', '#00c901', '#efd520', '#bfbfbf', '#537b35', '#a4c639', '#537b35', '#a4c639',
            '#537b35'
        ],
        credits: {
            enabled: false
        },
        chart: {
            type: 'column',
            height: '350'
        },
        title: {
            text: 'INFORME PERSONAL'
        },

        xAxis: {
            categories: arrayFrenteGrafica,
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



        series: [{
            name: 'Directo',
            data: arraryCantFrenteDir,
        }, {
            name: 'Indirecto',
            data: arraryCantFrenteIndir,
        }, {
            name: 'Total',
            data: arrayCantFrenteTotal,
        }]
    });

}

function cambiarGrupo(i) {
    var gruposeli = $('#grupo' + i).val()
    var idtrab = arrayTrabajadores[i].id;

    $.post(server + 'actgrupoi.php', {
        id: idtrab,
        grupo: gruposeli,
        user: user
    },
        function (resp) {
            if (resp.msn == 'Ok') {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Cambio realizado',
                    showConfirmButton: false,
                    timer: 1000
                })
            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Oopss error al realizar cambio',
                    showConfirmButton: false,
                    timer: 1000
                })
            }
        })

}

function cambiarFrente(i) {
    var frentei = $('#frenteTrabI' + i).val()
    var idtrab = arrayTrabajadores[i].id;
    $.post(server + 'actfrente.php', {
        id: idtrab,
        frente: frentei,
        user: user
    },
        function (resp) {
            if (resp.msn == 'Ok') {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Cambio realizado',
                    showConfirmButton: false,
                    timer: 1000
                })
            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Oopss error al realizar cambio',
                    showConfirmButton: false,
                    timer: 1000
                })
            }
        })
}

function editarTurno(i) {
    var turnoi = $('#turnoi' + i).val()
    var idtrab = arrayTrabajadores[i].id;
    $.post(server + 'cambiarTurno.php', {
        id: idtrab,
        turno: turnoi,
        user: user
    },
        function (resp) {
            if (resp.msn == 'Ok') {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Cambio realizado',
                    showConfirmButton: false,
                    timer: 1000
                })
            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Oopss error al realizar cambio',
                    showConfirmButton: false,
                    timer: 1000
                })
            }
        })

}



function busarTrab() {
    Swal.fire({
        title: 'Buscar Trabajador',
        html: `
                 <input type="text" class="form-control" id="buscartrab" placeholder="Buscar por nombre ó cédula">
                `,
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Buscar'
    }).then((result) => {
        if (result.isConfirmed) {
            var buscartrab = $('#buscartrab').val()
            $.post(server + 'buscarTrab.php', {
                busqueda: buscartrab
            },
                function (resp) {
                    arrayBusqueda = resp
                    mostrarResultados()

                })


        }
    })
}

function mostrarResultados() {
    var htmltexto = `
            <div class="table-responsive">
            <table class="table table-striped" id="">
                <thead class="thead-dark">
                     
                    <th width="5%">ID</th>
                    <th>Código</th>
                    <th>Cédula</th>
                    <th>Trabajador</th>
                    <th width="7%">ODS</th>
                    <th>Cargo</th>
                    <th>Frente</th>
                    <th>Turno</th>
                    <th width="12%">Estado</th>
                    <th width="12%">F. Ingreso</th>
                    <th></th>
                     
                </thead>
                <tbody id="">
            `

    for (var i = 0; i < arrayBusqueda.length; i++) {
        htmltexto +=
            `
                <tr>
                    <td>${arrayBusqueda[i].id}</td>
                    <td>${arrayBusqueda[i].contrato}</td>
                    <td>${arrayBusqueda[i].cedula}</td>
                    <td>${arrayBusqueda[i].nombres} ${arrayBusqueda[i].apellidos}</td>
                    <td><input type="text" class="form-control" id="odscambio${i}" value="${arrayBusqueda[i].ods}"></td>
                    <td>${arrayBusqueda[i].cargo}</td>
                    <td>${arrayBusqueda[i].frente}</td>
                    <td>${arrayBusqueda[i].turno}</td>
                    <td><input type="text" class="form-control"  id="estadocambio${i}" value="${arrayBusqueda[i].estado}"></td>
                    <td><input type="text" class="form-control"  id="fingresocambio${i}" value="${arrayBusqueda[i].fingreso}"></td>
                    <td><button type="button" class="btn btn-success" onclick="actDatos('${i}')")>A</button></td>
                  
                </tr>
                `
    }

    htmltexto += `
            </tbody>
            </table></div>
            `
    Swal.fire({
        title: 'Buscar Trabajador',
        html: htmltexto,
        icon: 'info',
        width: 1300,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar'
    })
}

function actDatos(i) {
    var odscambio = $('#odscambio' + i).val()
    var estadocambio = $('#estadocambio' + i).val()
    var fingresocambio = $('#fingresocambio' + i).val()
    var idcambio = arrayBusqueda[i].id

    $.post(server + 'actTrabCambio.php', {
        id: idcambio,
        ods: odscambio,
        estado: estadocambio,
        fingreso: fingresocambio,
        user: user
    },
        function (resp) {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Datos actualizados',
                showConfirmButton: false,
                timer: 2000
            })
        })


}



function cambiarMarca(i) {
    var id = arrayAsistencia[i].id;
    var nombres = arrayAsistencia[i].nombres;

    for (var a = 0; a < arrayMarca.length; a++) {
        if (arrayMarca[a].doc == id) {
            var tipo = arrayMarca[a].tipo
            var idmarca = arrayMarca[a].idmarca
        }
    }




    if (tipo == 'Entrada') {
        var cambio = 'Salida'
    }
    if (tipo == 'Salida') {
        var cambio = 'Entrada'
    }

    Swal.fire({
        title: 'Cambiar Marcación',
        html: `
                Desea cambiar la marcación a ${nombres}  y colocar  ${cambio} ?
                `,
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Agregar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.post(server + 'cambiarMarca.php', {
                id: idmarca,
                fecha: fechaMarcacion,
                nombres: nombres,
                tipo: cambio
            },
                function (resp) {
                    if (resp.msn == 'Ok') {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Marcación cambiada',
                            showConfirmButton: false,
                            timer: 1000
                        })
                    } else {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Oopss error al cambiar marcación...',
                            showConfirmButton: false,
                            timer: 1000
                        })
                    }
                })
        }
    })


}


function agregarMarca(i) {
    var id = arrayAsistencia[i].id;
    var nombres = arrayAsistencia[i].nombres;

    Swal.fire({
        title: 'Agregar Marcación',
        html: `
                Desea agregar marcación a ${nombres} ?
                `,
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Agregar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.post(server + 'agregarMarca.php', {
                id: id,
                fecha: fechaMarcacion,
                nombres: nombres
            },
                function (resp) {
                    if (resp.msn == 'Ok') {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Marcación agregada',
                            showConfirmButton: false,
                            timer: 1000
                        }).then(() => {
                            buscarAsistencia()
                        })
                    } else {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Oopss error al agregar marcación...',
                            showConfirmButton: false,
                            timer: 1000
                        })
                    }
                })
        }
    })


}



function cargarDirectos() {
    var fdir = $('#fechadirectos').val()
    window.open("https://utitalco.com/biometricsystem/server/consolidadoTiempoDir.php?fecha=" + fdir +
        "&ods=" + numods, "_blank");
}

function cargarConsolidadoTiempo() {
    var finicio = $('#finiciopago').val()
    var ffinal = $('#ffinalpago').val()
    window.open("https://utitalco.com/biometricsystem/server/consolidadoTiempo.php?f1=" + finicio +
        "&f2=" + ffinal + "&ods=" + numods, "_blank");
}

function cargarConsolidadoTiempoDpto() {
    var finicio = $('#finiciodpto').val()
    var ffinal = $('#ffinaldpto').val()
    window.open("https://utitalco.com/biometricsystem/server/consolidadoHoras.php?f1=" + finicio +
        "&f2=" + ffinal, "_blank");
}

function cargarConsolidadoAusentismos() {
    var finicio = $('#finicioa').val()
    var ffinal = $('#ffinala').val()
    window.open("https://utitalco.com/biometricsystem/server/consolidadoAusentismos.php?f1=" + finicio +
        "&f2=" + ffinal, "_blank");
}

function informe() {
    Swal.fire({
        title: 'Generar excel',
        html: `<hr>
                <h4>Informe General Diario</h4>
                <div class="row" style="width: 100%;">
               
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Fecha</label>
                            <input type="date" class="form-control" id="fechainf" placeholder="">
                        </div>
                    </div>

                                    
                </div><hr>

                `,

        showCancelButton: true,
        confirmButtonText: 'Generar',
        cancelButtonText: 'Cancelar',
        showCloseButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            var fecha = $('#fechainf').val()
            location = server + 'informediariorh.php?ods=' + numods + '&fecha=' + fecha;

        }
    })
}



function cargarGrupoH(e) {
    var frentetrabs = e.value

    $.post(server + 'cargarGruposSel.php', {
        ods: numods,
        frente: frentetrabs
    },
        function (resp) {

            var arrayGruposS = resp
            var html = ''

            listaGrupos = '<option value="">Selecciones un grupo</option>'

            listaGrupos +=
                `<option value="TODOS">TODOS</option>`

            for (var i = 0; i < arrayGruposS.length; i++) {
                listaGrupos +=
                    `<option value="${arrayGruposS[i].grupo}">${arrayGruposS[i].grupo} - ${arrayGruposS[i].supervisor}</option>`
            }

            $('#grupo_h').html(listaGrupos)

        })


}

function cargarGrupo(e) {
    var frentetrabs = e.value

    $.post(server + 'cargarGruposSel.php', {
        ods: numods,
        frente: frentetrabs
    },
        function (resp) {

            var arrayGruposS = resp
            var html = ''

            listaGrupos = '<option value="">Selecciones un grupo</option>'

            listaGrupos +=
                `<option value="TODOS">TODOS</option>`

            for (var i = 0; i < arrayGruposS.length; i++) {
                listaGrupos +=
                    `<option value="${arrayGruposS[i].grupo}">${arrayGruposS[i].grupo} - ${arrayGruposS[i].supervisor}</option>`
            }

            $('#grupo_').html(listaGrupos)

        })


}

function cargarGrupoT(e) {
    var frentetrabs = e.value

    $.post(server + 'cargarGruposSel.php', {
        ods: numods,
        frente: frentetrabs
    },
        function (resp) {

            var arrayGruposS = resp
            var html = ''

            listaGrupos = '<option value="">Selecciones un grupo</option>'

            listaGrupos +=
                `<option value="TODOS">TODOS</option>`

            for (var i = 0; i < arrayGruposS.length; i++) {
                listaGrupos +=
                    `<option value="${arrayGruposS[i].grupo}">${arrayGruposS[i].grupo} - ${arrayGruposS[i].supervisor}</option>`
            }

            $('#grupo_t').html(listaGrupos)

        })


}


