
		// var anchoTblCuerpo = $('#tblcuerpo').width();
		// $('#tblpie').width(anchoTblCuerpo)
		// $('#tblobs').width(anchoTblCuerpo)


		function agregarObs() {
			$('#tblobs').removeClass("oculto")
			$('#btnagregarObs').addClass("oculto")
		}

		var imagencargada = null
		var idImagen = null

		var clase = null

		var user = sessionStorage.getItem('usercal')

		var verifuser = sessionStorage.getItem('datosuserqaqc')

		if (verifuser != null) {
			var datosuserqaqc = JSON.parse(sessionStorage.getItem('datosuserqaqc'))
		} else {
			location = 'index.php'
		}

		var tipouser = sessionStorage.getItem('tipouser')

		if (tipouser == 'ecopetrol') {
			$("input, select,  textarea").prop('disabled', true);
			$('.ecp').prop('disabled', false)
			$('.ut').prop('disabled', true)
			//$("#info input").prop("disabled", true);
		}

		if (tipouser == 'italco') {
			// $("input, select,  textarea").prop('disabled', false);
			$('.ecp').prop('disabled', true)
			// $('.ut').prop('disabled', true)
			//$("#info input").prop("disabled", true);
		}

		$('.activo').prop('disabled', false)

		var items = []
		var listaArchivos = []
		var arrayInfo = []



		// Set up the canvas
		var canvas = document.querySelector("#canvas");
		var ctx = canvas.getContext("2d");
		ctx.strokeStyle = "#222222";
		ctx.lineWidth = 2;


		$btnDescargar = document.querySelector("#btnDescargar")
		$btnLimpiar = document.querySelector("#btnLimpiar")
		$btnGenerarDocumento = document.querySelector("#btnGenerarDocumento");



		// Get a regular interval for drawing to the screen
		window.requestAnimFrame = (function (callback) {
			return window.requestAnimationFrame ||
				window.webkitRequestAnimationFrame ||
				window.mozRequestAnimationFrame ||
				window.oRequestAnimationFrame ||
				window.msRequestAnimaitonFrame ||
				function (callback) {
					window.setTimeout(callback, 1000 / 60);
				};
		})();


		const limpiarCanvas = () => {
			// Colocar color blanco en fondo de canvas
			clearCanvas();
		};
		limpiarCanvas();
		$btnLimpiar.onclick = limpiarCanvas;
		// Escuchar clic del botón para descargar el canvas



		window.obtenerImagen = () => {
			return $canvas.toDataURL();
		};


		// Set up mouse events for drawing
		var drawing = false;
		var mousePos = {
			x: 0,
			y: 0
		};
		var lastPos = mousePos;
		canvas.addEventListener("mousedown", function (e) {
			drawing = true;
			lastPos = getMousePos(canvas, e);
		}, false);
		canvas.addEventListener("mouseup", function (e) {
			drawing = false;
		}, false);
		canvas.addEventListener("mousemove", function (e) {
			mousePos = getMousePos(canvas, e);
		}, false);

		// Set up touch events for mobile, etc
		canvas.addEventListener("touchstart", function (e) {
			mousePos = getTouchPos(canvas, e);
			var touch = e.touches[0];
			var mouseEvent = new MouseEvent("mousedown", {
				clientX: touch.clientX,
				clientY: touch.clientY
			});
			canvas.dispatchEvent(mouseEvent);
		}, false);
		canvas.addEventListener("touchend", function (e) {
			var mouseEvent = new MouseEvent("mouseup", {});
			canvas.dispatchEvent(mouseEvent);
		}, false);
		canvas.addEventListener("touchmove", function (e) {
			var touch = e.touches[0];
			var mouseEvent = new MouseEvent("mousemove", {
				clientX: touch.clientX,
				clientY: touch.clientY
			});
			canvas.dispatchEvent(mouseEvent);
		}, false);


		// Prevent scrolling when touching the canvas
		document.body.addEventListener("touchstart", function (e) {
			if (e.target == canvas) {
				e.preventDefault();
			}
		}, {
			passive: false
		});
		document.body.addEventListener("touchend", function (e) {
			if (e.target == canvas) {
				e.preventDefault();
			}
		}, false);
		document.body.addEventListener("touchmove", function (e) {
			if (e.target == canvas) {
				e.preventDefault();
			}
		}, false);

		// Get the position of the mouse relative to the canvas
		function getMousePos(canvasDom, mouseEvent) {
			var rect = canvasDom.getBoundingClientRect();
			return {
				x: mouseEvent.clientX - rect.left,
				y: mouseEvent.clientY - rect.top
			};
		}

		// Get the position of a touch relative to the canvas
		function getTouchPos(canvasDom, touchEvent) {
			var rect = canvasDom.getBoundingClientRect();
			return {
				x: touchEvent.touches[0].clientX - rect.left,
				y: touchEvent.touches[0].clientY - rect.top
			};
		}

		// Draw to the canvas
		function renderCanvas() {
            if (drawing) {
                ctx.moveTo(lastPos.x, lastPos.y);
                ctx.lineTo(mousePos.x, mousePos.y);
                ctx.lineWidth = 5;
                ctx.stroke();
                lastPos = mousePos;
            }
        }

		// Clear the canvas
		function clearCanvas() {
			canvas.width = canvas.width;
		}

		// Allow for animation
		(function drawLoop() {
			requestAnimFrame(drawLoop);
			renderCanvas();
		})();


		function abrirFirma(id, c) {

				clase = c
				idImagen = id;

				if(id == 100){
					limpiarCanvas()
						var myModal = new bootstrap.Modal(document.getElementById('modalFirma'))
						myModal.show()
				}

				if(clase == 'sup'){
					if($('#fechasup'+id).val()!= ""  &&  $('#horasup'+id).val()!= ""  ){
						
						pasarFirma()
					}else{
						Swal.fire({
							position: 'top-end',
							icon: 'info',
							title: 'Por favor registre primero fecha, hora...',
							showConfirmButton: false,
							timer: 2500
						})
					}
				}

				if(clase == 'q'){
					if($('#fechaq'+id).val()!= ""   &&  $('#horaq'+id).val()!= ""   ){
						pasarFirma()
					}else{
						Swal.fire({
							position: 'top-end',
							icon: 'info',
							title: 'Por favor registre primero fecha, hora...',
							showConfirmButton: false,
							timer: 2500
						})
					}
				}
				
				if(clase == 'ecp'){
					if($('#fechaecp'+id).val()!= ""  &&  $('#horaecp'+id).val()!= ""   ){
						pasarFirma()
					}else{
						Swal.fire({
							position: 'top-end',
							icon: 'info',
							title: 'Por favor registre primero fecha, hora, nombre y  # de registro...',
							showConfirmButton: false,
							timer: 2500
						})
					}
				}


		}



		function pasarFirma() {

			if ($('#poldatos').prop('checked')) {

				
				
				if(clase == 'sup'){
					document.querySelector("#firmasup" + idImagen).src = datosuserqaqc.firma;


					$('#nombresup' + idImagen).val(datosuserqaqc.nombres)
        			$('#registrosup' + idImagen).val(datosuserqaqc.documento)



					$('#firmasup' + idImagen).removeClass('oculto')
					$('#btnFirmarsup' + idImagen).hide()
					actFirmaSup()
				}

				if(clase == 'q'){
					document.querySelector("#firmaq" + idImagen).src = datosuserqaqc.firma;

					$('#nombreq' + idImagen).val(datosuserqaqc.nombres)
        			$('#registroq' + idImagen).val(datosuserqaqc.documento)


					$('#firmaq' + idImagen).removeClass('oculto')
					$('#btnFirmarq' + idImagen).hide()
					actFirmaSup()
				}

				if(clase == 'ecp'){
					document.querySelector("#firmaecp" + idImagen).src = datosuserqaqc.firma;

					$('#nombreecp' + idImagen).val(datosuserqaqc.nombres)
        			$('#registroecp' + idImagen).val(datosuserqaqc.documento)


					$('#firmaecp' + idImagen).removeClass('oculto')
					$('#btnFirmarecp' + idImagen).hide()
					actFirmaSup()
				}
				

				

			} else {
				Swal.fire({
					position: 'top-end',
					icon: 'info',
					title: 'Debe aceptar las políticas de protección de datos perasonales',
					showConfirmButton: false,
					timer: 1500
				})
			}

			if (idImagen == 100) {
				 
					guardarObs()
				}


			//document.querySelector("#btnfirmar").style.display = 'none';

		}

		function getParameterByName(name) {
			name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
			var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
				results = regex.exec(location.search);
			return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
		}

		var tag = getParameterByName('tag');
		var  lazo = getParameterByName('ing');


		var arrayDatos = []
		var arrayObs = []
		var arrayDoc = []
		var firmasItems = []
		var cmls = []

		odsq = localStorage.getItem('odsq');
		equipos = sessionStorage.getItem('equipo')
		alcance = sessionStorage.getItem('servicio')
		esp = sessionStorage.getItem('esp')

		var server = 'https://utitalco.online/calidad/033/montaje/server/';
		cargando()


		$.post(server + 'cargarMiscTub.php', {
				ods: odsq,
				tag: tag,
				lazo: lazo
			},
			function (resp) {
				arrayInfo =  resp
				arrayDatos = resp.datos
				arrayObs = resp.observaciones
				arrayDoc = resp.datos
				
				cargarDatos()


			})

		function actFirmaSup(){

			var fechasup = $('#fechasup'+idImagen).val()
			var horasup = $('#horasup'+idImagen).val()
			var nombresup = $('#nombresup'+idImagen).val()
			var registrosup = $('#registrosup'+idImagen).val()
			var img = document.getElementById("firmasup"+idImagen);
			if(fechasup != ''){
				var firmasup = img.src
			}else{
				var firmasup = ''
			}

			// console.log(fechasup)
			// console.log(horasup)
			// console.log(nombresup)
			// console.log(registrosup)
			// console.log(firmasup)

			var fechaq = $('#fechaq'+idImagen).val()
			var horaq = $('#horaq'+idImagen).val()
			var nombreq = $('#nombreq'+idImagen).val()
			var registroq = $('#registroq'+idImagen).val()
			var img = document.getElementById("firmaq"+idImagen);
			 
			if(fechaq != ''){
				var firmaq = img.src
			}else{
				var firmaq = ''
			}

			// console.log(fechaq)
			// console.log(horaq)
			// console.log(nombreq)
			// console.log(registroq)
			// console.log(firmaq)

			var fechaecp = $('#fechaecp'+idImagen).val()
			var horaecp = $('#horaecp'+idImagen).val()
			var nombreecp = $('#nombreecp'+idImagen).val()
			var registroecp = $('#registroecp'+idImagen).val()
			var img = document.getElementById("firmaecp"+idImagen);
			 
			if(fechaecp != ''){
				var firmaecp = img.src
			}else{
				var firmaecp = ''
			}

			// console.log(fechaecp)
			// console.log(horaecp)
			// console.log(nombreecp)
			// console.log(registroecp)
			// console.log(firmaecp)

			var arrayFirmas = []

			arrayFirmas.push({
				"fechasup": fechasup,
				"horasup": horasup,
				"nombresup": nombresup,
				"firmasup": firmasup,
				"registrosup": registrosup,
				"fechaq": fechaq,
				"horaq": horaq,
				"nombreq": nombreq,
				"firmaq": firmaq,
				"registroq": registroq,
				"fechaecp": fechaecp,
				"horaecp": horaecp,
				"nombreecp": nombreecp,
				"firmaecp": firmaecp,
				"registroecp": registroecp

			})

			console.log(arrayFirmas)

			$.post(server + 'actFirmasMiscTub.php', {
                    ods: odsq,
                    tag: tag,
					lazo:lazo,
					id:idImagen,
                    datos: JSON.stringify(arrayFirmas)
                },
                function (res) {
                    console.log(res)
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        width: 100,
                        showConfirmButton: false,
                        timer: 1500
                    })
                })

		}



		function actItem(id, e){
			// alert(id)
			// alert(e.value)
			// alert(e.id)

			$.post(server + 'actItemsMiscTub.php', {
                    ods: odsq,
                    tag: tag,
					lazo:lazo,
					id:id,
					item:e.id,
					valor:e.value
                },
                function (res) {
                    console.log(res)
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        width: 100,
                        showConfirmButton: false,
                        timer: 1500
                    })
                })

		}

		function cargarDatos() {

			$('#unidad').html(arrayDatos[0].unidad)
			$('#planta').html(arrayDatos[0].planta)
			$('#ods').html(arrayDatos[0].ods)
			$('#isometrico').html(arrayDatos[0].isometrico + '<br>TUBERÍA')
			$('#lazo').html(arrayDatos[0].lazo)

			var html = ''

			for(var i=0; i<arrayDatos.length; i++){

			var firmas = JSON.parse(arrayDatos[i].firmas);

			console.log(firmas)
			 

			html += `
							<tr>
								<td style="border-top: 2px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000"
									colspan=11 height="48" align="left" valign=middle bgcolor="#A6A6A6"><b>
										<font face="Arial Narrow" size=4>${i+1}. ACTIVIDADES DESARROLLADAS EN EL MISCELANEO </font>
									</b></td>
							</tr>
							
							<tr>
								<td style="border-left: 2px solid #000000" height="45" align="center" valign=middle bgcolor="#FFFFFF">

									<select id="item1" style="width: 70px;" class="" onchange="actItem(${arrayDatos[i].id}, this)">
										<option value="${arrayDatos[i].item1}">${arrayDatos[i].item1}</option>
										<option value="OK">OK</option>
										<option value="NA">NA</option>
									</select>

									
								</td>
								<td align="left" valign=middle bgcolor="#FFFFFF" colspan="3">
									<font face="Arial Narrow" size=4>Verificación de trabajos ejecutados </font>
								</td>

								<td align="left" valign=middle bgcolor="#FFFFFF"><b>
										<font face="Arial Narrow" size=4><br></font>
									</b></td>
								<td align="left" valign=middle bgcolor="#FFFFFF"><b>
										<font face="Arial Narrow" size=4>
											<select id="item2" style="width: 70px;" class=""  onchange="actItem(${arrayDatos[i].id}, this)">
												<option value="${arrayDatos[i].item2}">${arrayDatos[i].item2}</option>
												<option value="OK">OK</option>
												<option value="NA">NA</option>
											</select>
								</td>
								<td align="left" valign=middle bgcolor="#FFFFFF" colspan="4">
									<font face="Arial Narrow" size=4>Verificación de controles de calidad requeridos </font>
								</td>

								<td style="border-right: 2px solid #000000" align="left" valign=middle bgcolor="#FFFFFF"><b>
										<font face="Arial Narrow" size=3><br></font>
									</b></td>
							</tr>
							<tr>
								<td style="border-left: 2px solid #000000" height="42" align="center" valign=middle bgcolor="#FFFFFF">
									<select id="item3" style="width: 70px;" class=""  onchange="actItem(${arrayDatos[i].id}, this)">
										<option value="${arrayDatos[i].item3}">${arrayDatos[i].item3}</option>
										<option value="OK">OK</option>
										<option value="NA">NA</option>
									</select>
								</td>
								<td align="left" valign=middle bgcolor="#FFFFFF" colspan="3">
									<font face="Arial Narrow" size=4>Inspección Visual</font>
								</td>

								<td align="left" valign=middle bgcolor="#FFFFFF"><b>
										<font face="Arial Narrow" size=4><br></font>
									</b></td>
								<td align="left" valign=middle bgcolor="#FFFFFF"><b>
										<font face="Arial Narrow" size=4><br></font>
									</b></td>
								<td align="left" valign=middle bgcolor="#FFFFFF"><b>
										<font face="Arial Narrow" size=4><br></font>
									</b></td>
								<td align="left" valign=middle bgcolor="#FFFFFF"><b>
										<font face="Arial Narrow" size=4><br></font>
									</b></td>
								<td align="left" valign=middle bgcolor="#FFFFFF"><b>
										<font face="Arial Narrow" size=4><br></font>
									</b></td>
								<td align="left" valign=middle bgcolor="#FFFFFF"><b>
										<font face="Arial Narrow" size=3><br></font>
									</b></td>
								<td style="border-right: 2px solid #000000" align="left" valign=middle bgcolor="#FFFFFF"><b>
										<font face="Arial Narrow" size=3><br></font>
									</b></td>
							</tr>

							<tr>
								<td style="border-left: 2px solid #000000; border-right: 2px solid #000000;" colspan=11 height="52"
									align="left" valign=middle bgcolor="#999999"><b>
										<font face="Arial Narrow" size=4>DESCRIPCIÓN DE LA ACTIVIDAD</font>
									</b></td>
							</tr>
							<tr>
								<td style="border-left: 2px solid #000000; border-right: 2px solid #000000" colspan=11 height="117"
									align="justify" valign=middle bgcolor="#FFFFFF">
									<font face="Arial Narrow" size=4>
										${arrayDatos[i].actividad}	
									</font>
								</td>
							</tr>
							<tr>
								<td style="border-top: 2px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
									colspan=3 height="49" align="center" valign=middle bgcolor="#D9D9D9"><b>
										<font face="Arial Narrow" size=4>RESPONSABLES</font>
									</b></td>
								<td style="border-top: 2px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
									align="center" valign=middle bgcolor="#D9D9D9"><b>
										<font face="Arial Narrow" size=4>FECHA EJECUCIÓN</font>
									</b></td>
								<td style="border-top: 2px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
									align="center" valign=middle bgcolor="#D9D9D9"><b>
										<font face="Arial Narrow" size=4>HORA</font>
									</b></td>
								<td style="border-top: 2px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
									colspan=3 align="center" valign=middle bgcolor="#D9D9D9"><b>
										<font face="Arial Narrow" size=4>NOMBRES</font>
									</b></td>
								<td style="border-top: 2px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000"
									colspan=2 align="center" valign=middle bgcolor="#D9D9D9"><b>
										<font face="Arial Narrow" size=4>FIRMA</font>
									</b></td>
								<td style="border-top: 2px solid #000000; border-bottom: 1px solid #000000; border-right: 2px solid #000000"
									align="center" valign=middle bgcolor="#D9D9D9"><b>
										<font face="Arial Narrow" size=4>REGISTRO</font>
									</b></td>
							</tr>
							<tr>
								<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000"
									colspan=3 height="50" align="center" valign=middle bgcolor="#FFFFFF">
									<font face="Arial Narrow" size=4>SUPERVISOR EJECUTOR</font>
								</td>
								<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
									align="center" valign=middle bgcolor="#FFFFFF">
									<input type="date" id="fechasup${arrayDatos[i].id}" class="ut" value="${firmas[0].fechasup}">
									</td>
								<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
									align="left" valign=middle bgcolor="#FFFFFF">
									<input type="time" id="horasup${arrayDatos[i].id}" class="ut"  value="${firmas[0].horasup}"></td>
								<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
									colspan=3 align="left" valign=middle bgcolor="#FFFFFF">
									<input type="text" id="nombresup${arrayDatos[i].id}" class="ut"  value="${firmas[0].nombresup}"></td>

								<td colspan="2" style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center"
									valign=middle bgcolor="#FFFFFF">
									<center>`

										if(firmas[0].fechasup == ''){
												html += `
												<button type="button" class="btn btn-info btn-block ut oculto-impresion" id="btnFirmarsup${arrayDatos[i].id}"
													onclick="abrirFirma('${arrayDatos[i].id}', 'sup')">Firmar</button>
												<img src="" id="firmasup${arrayDatos[i].id}" width="130px" height="50px" class="oculto">
														`
										}else{
											html += `
												<img src="${firmas[0].firmasup}" id="firmasup${arrayDatos[i].id}" width="130px" height="50px" class="visible">
														`
										}

										html += `


									</center>
								</td>
								<td style="border-bottom: 1px solid #000000; border-right: 2px solid #000000" align="left" valign=middle
									bgcolor="#FFFFFF">
									<input type="text" id="registrosup${arrayDatos[i].id}"  class="ut"  value="${firmas[0].registrosup}">
								</td>
							</tr>
							<tr>
								<td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000" colspan=3 height="50"
									align="center" valign=middle bgcolor="#FFFFFF">
									<font face="Arial Narrow" size=4>QAQC</font>
								</td>
								<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
									align="center" valign=middle bgcolor="#FFFFFF">
									<input type="date" id="fechaq${arrayDatos[i].id}" class="ut"  value="${firmas[0].fechaq}"></td>
								<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
									align="left" valign=middle bgcolor="#FFFFFF">
									<input type="time" id="horaq${arrayDatos[i].id}" class="ut"  value="${firmas[0].horaq}"></td>
								<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
									colspan=3 align="left" valign=middle bgcolor="#FFFFFF">
									<input type="text" id="nombreq${arrayDatos[i].id}" class="ut"  value="${firmas[0].nombreq}"></td>

								<td colspan="2" style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center"
									valign=middle bgcolor="#FFFFFF">
									<center>`

										if(firmas[0].fechaq == ''){
												html += `
												<button type="button" class="btn btn-info btn-block ut oculto-impresion" id="btnFirmarq${arrayDatos[i].id}"
													onclick="abrirFirma('${arrayDatos[i].id}','q')">Firmar</button>
												<img src="" id="firmaq${arrayDatos[i].id}" width="130px" height="50px" class="oculto">
														`
										}else{
											html += `
												
												<img src="${firmas[0].firmaq}" id="firmaq${arrayDatos[i].id}" width="130px" height="50px" class="visible">
														`
										}

										html += `
									</center>
								</td>
								<td style="border-bottom: 1px solid #000000; border-right: 2px solid #000000" align="left" valign=middle
									bgcolor="#FFFFFF"><b>
										<input type="text" id="registroq${arrayDatos[i].id}"   class="ut"  value="${firmas[0].registroq}">
									</b></td>
							</tr>
							<tr>
								<td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000" colspan=3 height="50"
									align="center" valign=middle bgcolor="#FFFFFF"><b>
										<font face="Arial Narrow" size=3>GESTOR TÉCNICO ECOPETROL (1)</font>
									</b></td>
								<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
									align="center" valign=middle bgcolor="#FFFFFF">
									<input type="date" id="fechaecp${arrayDatos[i].id}" class="ecp"   value="${firmas[0].fechaecp}"></td>
								<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
									align="left" valign=middle bgcolor="#FFFFFF">
									<input type="time" id="horaecp${arrayDatos[i].id}" class="ecp"  value="${firmas[0].horaecp}"></td>
								<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
									colspan=3 align="left" valign=middle bgcolor="#FFFFFF">
									<input type="text" id="nombreecp${arrayDatos[i].id}" class="ecp"   value="${firmas[0].nombreecp}"></td>

								<td colspan="2" style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center"
									valign=middle bgcolor="#FFFFFF">
									<center>`

										if(firmas[0].fechaecp == ''){
												html += `
												<button type="button" class="btn btn-info btn-block ecp oculto-impresion" id="btnFirmarecp${arrayDatos[i].id}"
													onclick="abrirFirma('${arrayDatos[i].id}','ecp')">Firmar</button>
												<img src="" id="firmaecp${arrayDatos[i].id}" width="130px" height="50px" class="oculto">
														`
										}else{
											html += `
												
												<img src="${firmas[0].firmaecp}" id="firmaecp${arrayDatos[i].id}" width="130px" height="50px" class="visible">
														`
										}

										html += `
							</center>
								</td>
								<td style="border-bottom: 1px solid #000000; border-right: 2px solid #000000" align="left" valign=middle
									bgcolor="#FFFFFF"><b>
										<input type="text" id="registroecp${arrayDatos[i].id}" class="ecp"  value="${firmas[0].registroecp}">
									</b></td>
							</tr>
							<tr>
								<td style="border-top: 1px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000"
									colspan=11 height="37" align="left" valign=middle bgcolor="#FFFFFF">
									<font face="Arial Narrow" size=3>(1) La firma del gestor técnico no exime al ejecutor de la
										responsabilidad de garantizar que los trabajos fueron realizados con la calidad requerida y la
										responsabilidad contractual.</font>
								</td>
							</tr>
								`

								$('#datosTabla').html(html)

								veriUser()

			}

			//CARGAR OBSERVACIONES

			if (arrayObs != "") {
                var arrayObservaciones = arrayObs
                var html = ''
                for (var i = 0; i < arrayObservaciones.length; i++) {
                    html = `<b>Nota ${i+1}: </b>
                    ${arrayObservaciones[i].obs} | ${arrayObservaciones[i].nombre} | Registro: ${arrayObservaciones[i].registro} | Fecha: ${arrayObservaciones[i].fecha} | Firma: <span id="firm${i}" style="width: 60px;"></span> <br>--------------------------------------------------------------------------------------------------------------------------------------------------------------------<br>
                    `
                    $('#observaciones').append(html)
                    const imagef = document.createElement('img')
                    imagef.src = arrayObservaciones[i].firma
                    imagef.height = "60"
                    document.querySelector('#firm' + i).appendChild(imagef)

                }
            }


			//cargar archivos
			if(arrayDoc  != ""){
				listaArchivos = arrayDoc

			}

			Swal.close()


		}

		
		
		function mostraraviso() {
			let timerInterval
			Swal.fire({
				title: 'Políticas de protección de datos personales',
				text: 'En cumplimiento con la Ley 1581 de protección de datos personales, se le informa que los datos suministrados serán incorporados a una base de datos cuya finalidad es el registro de control de actividades RCA y las actuaciones que se deriven de dicha gestión, cuyo responsable del tratamiento es UT ITALCO. Mediante el registro de sus datos  a través de este formato usted autoriza a UT ITALCO, a tratar los datos con la finalidad descrita arriba.  Como Titular se le informa que podrá ejercer sus derechos de acceso y reclamos a través del correo de contacto pqrsbca@utitalco.com.',
				timer: 20000,
				timerProgressBar: true,
				didOpen: () => {
					Swal.showLoading()
					const b = Swal.getHtmlContainer().querySelector('b')
					timerInterval = setInterval(() => {
						b.textContent = Swal.getTimerLeft()
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
		}

		function cargando() {
			let timerInterval
			Swal.fire({
				title: 'Cargando formato...!',
				timer: 20000,
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
		}

		function verArchivos() {
			var htmltexto = ''
			for (var i = 0; i < arrayDatos.length; i++) {
				listaArchivos = JSON.parse(arrayDatos[i].doc)

				for (var a = 0;a< listaArchivos.length; a++) {
					htmltexto += `
					<a href='https://utitalco.com/calidad/030/server/archivos/${listaArchivos[a].archivo}' target='_blank'>${listaArchivos[a].archivo}</a> <br>
				`
				}
			}

			Swal.fire({
				title: '<strong>Lista de adjuntos</strong>',
				icon: 'info',
				html: `
			Pulse click sobre el archivo que desea descargar... <br>
			${htmltexto}
			`

			})
		}

		function adjuntar() {
            Swal.fire({
                title: 'Adjuntar archivo',
                html: `
                <input type="file" id="archivo" class="form-control" placeholder="Buscar..."> <br>
				Según el tamaño del archivo puede tardar un tiempo... espere el aviso de archivo cagado. 
                `,
                showCancelButton: true,
                confirmButtonText: 'Adjuntar'
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {

                    var formData = new FormData();
                    var files = $('#archivo')[0].files[0];
                    formData.append('archivo', files);
                    formData.append('ods', odsq);
                    formData.append('tag', tag);
					formData.append('lazo', lazo);
                    $.ajax({
                        url: server + 'guardarArchivoMiscTub.php',
                        type: 'post',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            console.log(response)

                            if (response.msn == "Ok") {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Archivo cargado correctamente...',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {

                                    location.reload();
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

                }
            })
        }
    
		function guardarObs() {
            var observacion = $('#obs100').val()
                observacion = observacion.replace(/(\r\n|\n|\r)/gm, " ")
				observacion = observacion.replace(/["]/gm, "``")
				observacion = observacion.replace(/[“]/gm, "``")
				observacion = observacion.replace(/[”]/gm, "``")
				observacion = observacion.replace(/[']/gm, "`")
            var nombreobs = $('#nombre100').val()
            var registroobs = $('#registro100').val()
            var img = document.getElementById("firma100");

            // crea un nuevo objeto `Date`
            var today = new Date();

            // obtener la fecha y la hora
            var now = today.toLocaleString();
            var firmaobs = img.src

			if(arrayObs != ""){

				var arrayLmp = arrayObs
			}else{
				var arrayLmp = []
			}

            arrayLmp.push({
                "obs": observacion,
                "nombre": nombreobs,
                "registro": registroobs,
                "firma": firmaobs,
                "fecha": now
            })

            $.post(server + 'actMiscTubObs.php', {
                    ods: odsq,
                    tag: tag,
					lazo:lazo,
                    datos: JSON.stringify(arrayLmp)
                },
                function (res) {
                    console.log(res)
                    location.reload()
                })

        }

		
		function veriUser(){
			if (tipouser == 'ecopetrol') {
				$("input, select,  textarea").prop('disabled', true);
				$('.ecp').prop('disabled', false)
				$('.ut').prop('disabled', true)
				//$("#info input").prop("disabled", true);
			}

			if (tipouser == 'italco') {
				// $("input, select,  textarea").prop('disabled', false);
				$('.ecp').prop('disabled', true)
				// $('.ut').prop('disabled', true)
				//$("#info input").prop("disabled", true);
			}

			$('.activo').prop('disabled', false)
		}



	