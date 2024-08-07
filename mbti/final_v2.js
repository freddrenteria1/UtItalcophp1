server = 'https://utitalco.com/mbti/server/'

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

doc = getParameterByName('doc');
id = getParameterByName('id');

datos = []
perfiles = []

datos = JSON.parse(sessionStorage.getItem('datosP'))

arrayRespP1 = JSON.parse(localStorage.getItem('arrayRespP1'))
arrayRespP2 = JSON.parse(localStorage.getItem('arrayRespP2'))
arrayRespP3 = JSON.parse(localStorage.getItem('arrayRespP3'))
arrayRespP4 = JSON.parse(localStorage.getItem('arrayRespP4'))

datosuser = JSON.parse(localStorage.getItem('datosuser'))
perfiles = JSON.parse(localStorage.getItem('perfiles'))

foto = datosuser[0].foto

$('#foto').attr('src',foto);

$('#fecha_e').html(datosuser[0].fecha)
$('#nombre').html(datosuser[0].nombre)
$('#doc').html(datosuser[0].doc)
$('#fecha_n').html(datosuser[0].fecha_n)
$('#edad').html(datosuser[0].edad)
$('#cargo').html(datosuser[0].cargo)

cantEP1 = 0;
cantEP2 = 0;
cantEP3 = 0;
cantEP4 = 0;

cantIP1 = 0;
cantIP2 = 0;
cantIP3 = 0;
cantIP4 = 0;

cantSP1 = 0;
cantSP2 = 0;
cantSP3 = 0;
cantSP4 = 0;

cantNP1 = 0;
cantNP2 = 0;
cantNP3 = 0;
cantNP4 = 0;

cantTP1 = 0;
cantTP2 = 0;
cantTP3 = 0;
cantTP4 = 0;

cantFP1 = 0;
cantFP2 = 0;
cantFP3 = 0;
cantFP4 = 0;

cantJP1 = 0;
cantJP2 = 0;
cantJP3 = 0;
cantJP4 = 0;

cantPP1 = 0;
cantPP2 = 0;
cantPP3 = 0;
cantPP4 = 0;


for( var i=0; i<arrayRespP1.length; i++ ){
    if(arrayRespP1[i].resp == 'E'){
        cantEP1++;
    }
    if(arrayRespP1[i].resp == 'I'){
        cantIP1++;
    }
    if(arrayRespP1[i].resp == 'S'){
        cantSP1++;
    }
    if(arrayRespP1[i].resp == 'N'){
        cantNP1++;
    }
    if(arrayRespP1[i].resp == 'T'){
        cantTP1++;
    }
    if(arrayRespP1[i].resp == 'F'){
        cantFP1++;
    }
    if(arrayRespP1[i].resp == 'J'){
        cantJP1++;
    }
    if(arrayRespP1[i].resp == 'P'){
        cantPP1++;
    }
}

for( var i=0; i<arrayRespP2.length; i++ ){
    if(arrayRespP2[i].resp == 'E'){
        cantEP2++;
    }
    if(arrayRespP2[i].resp == 'I'){
        cantIP2++;
    }
    if(arrayRespP2[i].resp == 'S'){
        cantSP2++;
    }
    if(arrayRespP2[i].resp == 'N'){
        cantNP2++;
    }
    if(arrayRespP2[i].resp == 'T'){
        cantTP2++;
    }
    if(arrayRespP2[i].resp == 'F'){
        cantFP2++;
    }
    if(arrayRespP2[i].resp == 'J'){
        cantJP2++;
    }
    if(arrayRespP2[i].resp == 'P'){
        cantPP2++;
    }
}

for( var i=0; i<arrayRespP3.length; i++ ){
    if(arrayRespP3[i].resp == 'E'){
        cantEP3++;
    }
    if(arrayRespP3[i].resp == 'I'){
        cantIP3++;
    }
    if(arrayRespP3[i].resp == 'S'){
        cantSP3++;
    }
    if(arrayRespP3[i].resp == 'N'){
        cantNP3++;
    }
    if(arrayRespP3[i].resp == 'T'){
        cantTP3++;
    }
    if(arrayRespP3[i].resp == 'F'){
        cantFP3++;
    }
    if(arrayRespP3[i].resp == 'J'){
        cantJP3++;
    }
    if(arrayRespP3[i].resp == 'P'){
        cantPP3++;
    }
}

for( var i=0; i<arrayRespP4.length; i++ ){
    if(arrayRespP4[i].resp == 'E'){
        cantEP4++;
    }
    if(arrayRespP4[i].resp == 'I'){
        cantIP4++;
    }
    if(arrayRespP4[i].resp == 'S'){
        cantSP4++;
    }
    if(arrayRespP4[i].resp == 'N'){
        cantNP4++;
    }
    if(arrayRespP4[i].resp == 'T'){
        cantTP4++;
    }
    if(arrayRespP4[i].resp == 'F'){
        cantFP4++;
    }
    if(arrayRespP4[i].resp == 'J'){
        cantJP4++;
    }
    if(arrayRespP4[i].resp == 'P'){
        cantPP4++;
    }
}

//TOTALES
totalE = cantEP1 + cantEP2 + cantEP3 + cantEP4;
totalI = cantIP1 + cantIP2 + cantIP3 + cantIP4;
totalS = cantSP1 + cantSP2 + cantSP3 + cantSP4;
totalN = cantNP1 + cantNP2 + cantNP3 + cantNP4;
totalT = cantTP1 + cantTP2 + cantTP3 + cantTP4;
totalF = cantFP1 + cantFP2 + cantFP3 + cantFP4;
totalJ = cantJP1 + cantJP2 + cantJP3 + cantJP4;
totalP = cantPP1 + cantPP2 + cantPP3 + cantPP4;

var resultados = []

resultados.push({
    'totalE':totalE,
    'totalI':totalI,
    'totalS':totalS,
    'totalN':totalN,
    'totalT':totalT,
    'totalF':totalF,
    'totalJ':totalJ,
    'totalP':totalP,
    
})

var letras = ''

if(totalE>=totalI){
    letras += 'E'
}

if(totalE<totalI){
    letras += 'I'
}

if(totalS>=totalN){
    letras += 'S'
}

if(totalS<totalN){
    letras += 'N'
}

if(totalT>=totalF){
    letras += 'T'
}

if(totalT<totalF){
    letras += 'F'
}

if(totalJ>=totalP){
    letras += 'J'
}

if(totalJ<totalP){
    letras += 'P'
}

for(var i=0; i<perfiles.length; i++){
    if(perfiles[i].perfil == letras){
        $('#perfil').html(perfiles[i].info)
    }
}


$('#letrasr').html('<h3>'+letras+'</h3>')

$('#totalE').html(totalE)
$('#totalI').html(totalI)
$('#totalS').html(totalS)
$('#totalN').html(totalN)
$('#totalT').html(totalT)
$('#totalF').html(totalF)
$('#totalJ').html(totalJ)
$('#totalP').html(totalP)

var html = ''

html += `
<tr>
    <td>E</td>
    <td>${cantEP1}</td>
    <td>${cantEP2}</td>
    <td>${cantEP3}</td>
    <td>${cantEP4}</td>
    <td>${totalE}</td>
</tr>

<tr>
    <td>I</td>
    <td>${cantIP1}</td>
    <td>${cantIP2}</td>
    <td>${cantIP3}</td>
    <td>${cantIP4}</td>
    <td>${totalI}</td>
</tr>

<tr>
    <td>S</td>
    <td>${cantSP1}</td>
    <td>${cantSP2}</td>
    <td>${cantSP3}</td>
    <td>${cantSP4}</td>
    <td>${totalS}</td>
</tr>

<tr>
    <td>N</td>
    <td>${cantNP1}</td>
    <td>${cantNP2}</td>
    <td>${cantNP3}</td>
    <td>${cantNP4}</td>
    <td>${totalN}</td>
</tr>

<tr>
    <td>T</td>
    <td>${cantTP1}</td>
    <td>${cantTP2}</td>
    <td>${cantTP3}</td>
    <td>${cantTP4}</td>
    <td>${totalT}</td>
</tr>

<tr>
    <td>F</td>
    <td>${cantFP1}</td>
    <td>${cantFP2}</td>
    <td>${cantFP3}</td>
    <td>${cantFP4}</td>
    <td>${totalF}</td>
</tr>

<tr>
    <td>J</td>
    <td>${cantJP1}</td>
    <td>${cantJP2}</td>
    <td>${cantJP3}</td>
    <td>${cantJP4}</td>
    <td>${totalJ}</td>
</tr>

<tr>
    <td>P</td>
    <td>${cantPP1}</td>
    <td>${cantPP2}</td>
    <td>${cantPP3}</td>
    <td>${cantPP4}</td>
    <td>${totalP}</td>
</tr>

`

$('#datosTabla1').html(html)



function guardar(){
    console.log('guardar...')
    var fotop = localStorage.getItem('fotoprueba')

    $.post(server+'guardarPrueba.php',{
        datos:JSON.stringify(datos), 
        foto:fotop, 
        parte1:JSON.stringify(arrayRespP1),
        parte2:JSON.stringify(arrayRespP2),
        parte3:JSON.stringify(arrayRespP3),
        parte4:JSON.stringify(arrayRespP4),
        resultados: JSON.stringify(resultados)
    }, function(resp){
        console.log(resp)
    })
}