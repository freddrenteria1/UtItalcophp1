
server = 'https://utitalco.com/conductores/server/';
arrayDatos = null

buscarVehiculo();

function buscarVehiculo() {

  $.post(server + 'buscarVehiculo.php', {},
    function (resp) {
      console.log(resp)
      if (resp != null) {
        arrayDatos = resp
        cargarInfo()
      } else {
        Swal.fire({
          title: "Información!",
          text: "No hay registros realizados...",
          icon: "info"
        });
      }
    })
}

function cargarInfo() {

  var html = ''

  for (var i = 0; i < arrayDatos.length; i++) {
    html += `
            <tr>
                <td> ${arrayDatos[i].fecha} </td>
                <td> ${arrayDatos[i].placa} </td>
                <td> ${arrayDatos[i].tipo} </td>
                <td> ${arrayDatos[i].marca} </td>
                <td> ${arrayDatos[i].modelo} </td>
                <td> ${arrayDatos[i].capacidad} </td>
                <td> ${arrayDatos[i].ultmant} </td>
                <td> ${arrayDatos[i].kiloultmant} </td>
                <td> ${arrayDatos[i].proxmant} </td>
                <td> ${arrayDatos[i].soatexp} </td>
                <td> ${arrayDatos[i].soatvence} </td>
                <td> ${arrayDatos[i].tecnoexp} </td>
                <td> ${arrayDatos[i].tecnovence} </td>
                <td> <button type="button" class="btn btn-primary editbtn" onclick="editar('${i}')">
                EDITAR</button></td>
            </tr>
        `
  }

  $('#tlbRegistroveh').html(html)


}

function editar(i) {


  Swal.fire({
    title: "Actualizar registro",
    html: `
        <div class="form-group" id="formulario">
                <label for="">PLACA</label>
              <input type="text" name="placa" id="placa" class="form-control" value="${arrayDatos[i].placa}">
            </div>
            <div class="form-group">
                <label for="">TIPO</label>
              <input type="text" name="tipo" id="tipo" class="form-control" value="${arrayDatos[i].tipo}">
            </div>
            <div class="form-group">
                <label for="">MARCA</label>
              <input type="text" name="marca" id="marca" class="form-control" value="${arrayDatos[i].marca}">
            </div>
            <div class="form-group">
                <label for="">MODELO</label>
              <input type="text" name="modelo" id="modelo" class="form-control" value="${arrayDatos[i].modelo}">
            </div>
            <div class="form-group">
                <label for="">CAPACIDAD</label>
              <input type="text" name="capacidad" id="capacidad" class="form-control" value="${arrayDatos[i].capacidad}">
            </div>
            <div class="form-group">
                <label for="">ULT MANT</label>
              <input type="date" name="ultmant" id="ultmant" class="form-control" value="${arrayDatos[i].ultmant}">
            </div>
            <div class="form-group">
                <label for="">KILOMETRAJE</label>
              <input type="text" name="kiloultmant" id="kiloultmant" class="form-control" value="${arrayDatos[i].kiloultmant}">
            </div>
            <div class="form-group">
                <label for="">PROX MANT</label>
              <input type="date" name="proxmant" id="proxmant" class="form-control" value="${arrayDatos[i].proxmant}">
            </div>
            <div class="form-group">
                <label for="">SOAT EXP</label>
              <input type="date" name="soatexp" id="soatexp" class="form-control" value="${arrayDatos[i].soatexp}">
            </div>
            <div class="form-group">
                <label for="">SOAT VENCE</label>
              <input type="date" name="soatvence" id="soatvence" class="form-control" value="${arrayDatos[i].soatvence}">
            </div>
            <div class="form-group">
                <label for="">TECNO EXP</label>
              <input type="date" name="tecnoexp" id="tecnoexp" class="form-control" value="${arrayDatos[i].tecnoexp}">
            </div>
            <div class="form-group">
                <label for="">TECNO VENCE</label>
              <input type="date" name="tecnovence" id="tecnovence" class="form-control" value="${arrayDatos[i].tecnovence}">
            </div>
        `,
    showCancelButton: true,
    confirmButtonText: "Aceptar",
  }).then((result) => {
    /* lee lo datos modificados */
    if (result.isConfirmed) {

      var idRegistro = arrayDatos[i].id

      var placa = $('#placa').val()
      var tipo = $('#tipo').val()
      var marca = $('#marca').val()
      var modelo = $('#modelo').val()
      var capacidad = $('#capacidad').val()
      var ultmant = $('#ultmant').val()
      var kiloultmant = $('#kiloultmant').val()
      var proxmant = $('#proxmant').val()
      var soatexp = $('#soatexp').val()
      var soatvence = $('#soatvence').val()
      var tecnoexp = $('#tecnoexp').val()
      var tecnovence = $('#tecnovence').val()

      

      //TERMINE DE CAPTURAR LOS DATOS Y LUETO AGREGE LA FUNCION QUE ENVIA LOS DATOS A PHP PARA EDITARLOS

      $.post(server+'editarregistro.php',
      {
        id: idRegistro,
        placa:placa,
        tipo:tipo,
        marca:marca,
        modelo:modelo,
        capacidad:capacidad,
        ultmant:ultmant,
        kiloultmant:kiloultmant,
        proxmant:proxmant,
        soatexp:soatexp,
        soatvence:soatvence,
        tecnoexp:tecnoexp,
        tecnovence:tecnovence

      }, function(resp){
        console.log(resp)
        buscarVehiculo()
      })

      
    }

  });
}












