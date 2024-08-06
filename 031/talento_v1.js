
var odsq = null

var server = "https://utitalco.com/031/server/";

var arrayHoras = []
var arrayHisto = []
var arrayTurnos = []

var listafechas = []
var listaprog = []
var listaeje = []

$.post(server+'verTalento.php',{},
function(resp){
    arrayHoras = resp.horas 
    arrayHisto = resp.histo 
    arrayTurnos = resp.turnos 

    cargarGraficas()

})



function cargarGraficas() {

    for(var i=0; i<arrayHisto.length; i++){
        listafechas.push(arrayHisto[i].fecha)
        listaprog.push(arrayHisto[i].prog)
        listaeje.push(arrayHisto[i].eje)
    }
   

    Highcharts.chart("fig1", {
        credits: {
            enabled: false,
        },
        chart: {
            type: "column",
            styledMode: true,
            height: 300,
        },
        title: {
            text: "<b>DIA</b>",
        },

        xAxis: {
            categories: [
                "HORAS HOMBRE"
                
            ],
            crosshair: true,
        },

        yAxis: {
            min: 0,
            title: {
                text: "Cant",
            },
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:f}</b></td></tr>',
            footerFormat: "</table>",
            shared: true,
            useHTML: true,
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                },
            },
        },
        series: [{
                name: "DIRECTAS",
                data: [
                   parseInt( arrayHoras.progp)
                ],
            },
            {
                name: "INDIRECTAS",
                data: [
                    parseInt(arrayHoras.ejecp)
                ],
            },
        ],
    });

    Highcharts.chart("fig2", {
        credits: {
            enabled: false,
        },
        chart: {
            type: "column",
            styledMode: true,
            height: 300,
        },
        title: {
            text: "<b>ACUMULADO</b>",
        },

        xAxis: {
            categories: [
                "HORAS HOMBRE"
                
            ],
            crosshair: true,
        },

        yAxis: {
            min: 0,
            title: {
                text: "Cant",
            },
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:f}</b></td></tr>',
            footerFormat: "</table>",
            shared: true,
            useHTML: true,
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                },
            },
        },
        series: [{
                name: "DIRECTAS",
                data: [
                   parseInt( arrayHoras.proga)
                ],
            },
            {
                name: "INDIRECTAS",
                data: [
                    parseInt(arrayHoras.ejeca)
                ],
            },
        ],
    });

    Highcharts.chart("fig3", {
        credits: {
            enabled: false,
        },
        chart: {
            type: "column",
            styledMode: true,
            height: 300,
        },
        title: {
            text: "<b>TURNOS</b>",
        },

        xAxis: {
            categories: [
                "TURNO A","TURNO B", "TURNO C", "TURNO E", "TURNO F", "DESC", "TOTAL ACT"
                
            ],
            crosshair: true,
        },

        yAxis: {
            min: 0,
            title: {
                text: "Cant",
            },
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:f}</b></td></tr>',
            footerFormat: "</table>",
            shared: true,
            useHTML: true,
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                },
            },
        },
        series: [{
                name: "PESONAL",
                data: [
                   arrayTurnos.turnoa, arrayTurnos.turnob, arrayTurnos.turnoc, arrayTurnos.turnoe, arrayTurnos.turnof, arrayTurnos.desca, arrayTurnos.total
                ],
            }
        ],
    });

    Highcharts.chart("fig4", {
        credits: {
            enabled: false,
        },
        chart: {
            type: "column",
            styledMode: true,
            height: 300,
        },
        title: {
            text: null,
        },

        xAxis: {
            categories: listafechas,
            crosshair: true,
        },

        yAxis: {
            min: 0,
            title: {
                text: "Cant",
            },
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:f}</b></td></tr>',
            footerFormat: "</table>",
            shared: true,
            useHTML: true,
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                },
            },
        },
        series: [{
                name: "PROG",
                data: listaprog,
            },
            {
                name: "EJE",
                data: listaeje,
            },
        ],
    });


}

function inicio(){
    location = 'index.html'
}



