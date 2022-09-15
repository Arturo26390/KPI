function grafica_pastel(cantidades, opcion) {

    if(opcion == "1"){
        var url = 'http://localhost/Proyectos/kpi/ajax.php';
    }else{
        if(opcion == "2"){
            var url = 'http://localhost/Proyectos/kpi/ajax2.php';
        }
    }

    var vector_cantidades = cantidades.split("|");
    var total = vector_cantidades[0];
    var informacion = vector_cantidades[1];
    var incidencia = vector_cantidades[2];
    var conciliado = vector_cantidades[3];
    var captura = vector_cantidades[4];
    var pagado = vector_cantidades[5];
    var planta = vector_cantidades[6];
    $.ajax(
        {
            url : url,
            type: "POST",
                data: {
                    datos: 2,
                    cantidades: cantidades
                    }
        })
            .done(function(data) {
                console.log(data);
                $("#graficas").html(data);
            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

            if (typeof (Chart) === 'undefined') { return; }

                console.log('init_chart_doughnut');

                /* GRAFICA 1*/

                if ($('.grafica_sin_informacion').length) {

                    var chart_doughnut_settings = {
                        type: 'doughnut',
                        tooltipFillColor: "rgba(51, 51, 51, 0.55)",
                        data: {
                            labels: [
                                "S/I",
                                "Diferencia"
                            ],
                            datasets: [{
                                data: [informacion, total-informacion],
                                backgroundColor: [
                                    "#f75305",
                                    "#1e548a",
                                ],
                                hoverBackgroundColor: [
                                    "#f28450",
                                    "#7ab5f0",
                                ]
                            }]
                        },
                        options: {
                            legend: false,
                            responsive: false
                        }
                    }

                    $('.grafica_sin_informacion').each(function () {

                        var chart_element = $(this);
                        var chart_doughnut = new Chart(chart_element, chart_doughnut_settings);

                    });

                }

                /* GRAFICA 2*/

                if ($('.grafica_incidencia').length) {

                    var chart_doughnut_settings = {
                        type: 'doughnut',
                        tooltipFillColor: "rgba(51, 51, 51, 0.55)",
                        data: {
                            labels: [
                                "Con Incidencia",
                                "Diferencia"
                            ],
                            datasets: [{
                                data: [incidencia, total-incidencia],
                                backgroundColor: [
                                    "#f75305",
                                    "#1e548a",
                                ],
                                hoverBackgroundColor: [
                                    "#f28450",
                                    "#7ab5f0",
                                ]
                            }]
                        },
                        options: {
                            legend: false,
                            responsive: false
                        }
                    }

                    $('.grafica_incidencia').each(function () {

                        var chart_element = $(this);
                        var chart_doughnut = new Chart(chart_element, chart_doughnut_settings);

                    });
                }

                /* GRAFICA 3*/

                if ($('.grafica_conciliado').length) {

                    var chart_doughnut_settings = {
                        type: 'doughnut',
                        tooltipFillColor: "rgba(51, 51, 51, 0.55)",
                        data: {
                            labels: [
                                "Conciliado",
                                "Diferencia"
                            ],
                            datasets: [{
                                data: [conciliado, total-conciliado],
                                backgroundColor: [
                                    "#f75305",
                                    "#1e548a",
                                ],
                                hoverBackgroundColor: [
                                    "#f28450",
                                    "#7ab5f0",
                                ]
                            }]
                        },
                        options: {
                            legend: false,
                            responsive: false
                        }
                    }

                    $('.grafica_conciliado').each(function () {

                        var chart_element = $(this);
                        var chart_doughnut = new Chart(chart_element, chart_doughnut_settings);

                    });

                }

                /* GRAFICA 4*/

                if ($('.grafica_en_captura').length) {

                    var chart_doughnut_settings = {
                        type: 'doughnut',
                        tooltipFillColor: "rgba(51, 51, 51, 0.55)",
                        data: {
                            labels: [
                                "En Captura",
                                "Diferencia"
                            ],
                            datasets: [{
                                data: [captura, total-captura],
                                backgroundColor: [
                                    "#f75305",
                                    "#1e548a",
                                ],
                                hoverBackgroundColor: [
                                    "#f28450",
                                    "#7ab5f0",
                                ]
                            }]
                        },
                        options: {
                            legend: false,
                            responsive: false
                        }
                    }

                    $('.grafica_en_captura').each(function () {

                        var chart_element = $(this);
                        var chart_doughnut = new Chart(chart_element, chart_doughnut_settings);

                    });

                }

                /* GRAFICA 5*/

                if ($('.grafica_pagado').length) {

                    var chart_doughnut_settings = {
                        type: 'doughnut',
                        tooltipFillColor: "rgba(51, 51, 51, 0.55)",
                        data: {
                            labels: [
                                "Pagado",
                                "Por Pagar"
                            ],
                            datasets: [{
                                data: [pagado, total-pagado],
                                backgroundColor: [
                                    "#f75305",
                                    "#1e548a",
                                ],
                                hoverBackgroundColor: [
                                    "#f28450",
                                    "#7ab5f0",
                                ]
                            }]
                        },
                        options: {
                            legend: false,
                            responsive: false
                        }
                    }

                    $('.grafica_pagado').each(function () {

                        var chart_element = $(this);
                        var chart_doughnut = new Chart(chart_element, chart_doughnut_settings);

                    });

                }
            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

            })
            .fail(function(data) {
                alert( "error" );
            })
            .always(function(data) {
            });
}

function Graficas(opcion){

    var planta = $("#planta").val();
    var tipo_pedimento = $("#to").val();
    var fecha1 = $("#fecha1").val();
    var fecha2 = $("#fecha2").val();
    var mes_concatenado = $("#mes").val();
    var semana_concatenada = $("#semana").val();

    //alert(mes_concatenado);
    //alert(semana_concatenada);

    if(opcion == "1"){
        var url = 'http://localhost/Proyectos/kpi/ajax.php';
        $("#intervalo_fechas_2").show();
        $("#intervalo_fechas").hide();
        $("#mes_cierre").hide();
        $("#semana_cierre").hide();
        $("#to").val('0')
    }else{
        if(opcion == "2"){
            var url = 'http://localhost/Proyectos/kpi/ajax2.php';
            $("#intervalo_fechas_2").hide();
        }
    }

    

    //alert(planta+" - "+tipo_pedimento+" - "+fecha1+" - "+fecha2+" - "+mes_concatenado);
    
    var formData = new FormData();
	formData.append('datos', 1);
    formData.append('planta', planta);
    formData.append('tipo_pedimento', tipo_pedimento);
    formData.append('fecha1', fecha1);
    formData.append('fecha2', fecha2);

    var vector_mes = mes_concatenado.split('-');
    var mes_digito =  vector_mes[1];
    switch (mes_digito) {
        case '01':
            var mes = 'ENE';    
        break;
        case '02':
            var mes = 'FEB';
        break;
        case '03':
            var mes = 'MAR';
        break;
        case '04':
            var mes = 'ABR';
        break;
        case '05':
            var mes = 'MAY';
        break;
        case '06':
            var mes = 'JUN';
        break;
        case '07':
            var mes = 'JUL';
        break;
        case '08':
            var mes = 'AGO';
        break;
        case '09':
            var mes = 'SEP';
        break;
        case '10':
            var mes = 'OCT';
        break;
        case '11':
            var mes = 'NOV';
        break;
        case '12':
            var mes = 'DIC';
        break;
        default:
            var mes = '';
        break;
    }
    //alert(semana_concatenada);
    formData.append('mes', mes+"-"+vector_mes[0]);
    formData.append('semana', semana_concatenada);

    if(tipo_pedimento != 0){
        if(tipo_pedimento == 'V1-ITE' || tipo_pedimento == 'V1-ITR'){
            $("#mes_cierre").show();
            $("#intervalo_fechas").hide();
            $("#intervalo_fechas_2").hide();
            $("#semana_cierre").hide();
            $("#semana").val('');
        }
        if(tipo_pedimento == 'V5-EXD' || tipo_pedimento == 'V5-IMD'){
            $("#semana_cierre").show();
            $("#intervalo_fechas").hide();
            $("#intervalo_fechas_2").hide();
            $("#mes_cierre").hide();
            $("#mes").val('');
        }
        if(tipo_pedimento == 'K1' || tipo_pedimento == 'R1' || tipo_pedimento == 'V1-EXD'){
            $("#intervalo_fechas").show();
            $("#intervalo_fechas_2").hide();
            $("#mes_cierre").hide();
            $("#semana_cierre").hide();
            $("#mes").val('');
            $("#semana").val('');
        }
    }

   
    $.ajax({
		url: url,
		type: 'post',
		data: formData,
		contentType: false,
		processData: false,
		success: function(response) {
            grafica_pastel(response, opcion);
            //alert("chido");
            console.log(response);
		}
	});
}

function cuadroResumen(){

    var planta = $("#planta").val();
    var tipo_pedimento = $("#to").val();
    var fecha1 = $("#fecha1_2").val();
    var fecha2 = $("#fecha2_2").val();
    var mes_concatenado = $("#mes").val();
    var semana_concatenada = $("#semana").val();
    //alert(planta+" - "+tipo_pedimento+" - "+fecha1+" - "+fecha2+" - "+mes_concatenado);

    var formData = new FormData();
	formData.append('datos', 1);
    formData.append('planta', planta);
    formData.append('tipo_pedimento', tipo_pedimento);
    formData.append('fecha1', fecha1);
    formData.append('fecha2', fecha2);
    
    
    var vector_mes = mes_concatenado.split('-');
    var mes_digito =  vector_mes[1];
    switch (mes_digito) {
        case '01':
            var mes = 'ENE';    
        break;
        case '02':
            var mes = 'FEB';
        break;
        case '03':
            var mes = 'MAR';
        break;
        case '04':
            var mes = 'ABR';
        break;
        case '05':
            var mes = 'MAY';
        break;
        case '06':
            var mes = 'JUN';
        break;
        case '07':
            var mes = 'JUL';
        break;
        case '08':
            var mes = 'AGO';
        break;
        case '09':
            var mes = 'SEP';
        break;
        case '10':
            var mes = 'OCT';
        break;
        case '11':
            var mes = 'NOV';
        break;
        case '12':
            var mes = 'DIC';
        break;
        default:
            var mes = '';
        break;
    }
    formData.append('mes', mes);
    formData.append('semana', semana_concatenada);
   

    var url = 'http://localhost/Proyectos/kpi/ajax.php';

    $.ajax({
		url: url,
		type: 'post',
		data: formData,
		contentType: false,
		processData: false,
		success: function(response) {
            grafica_pastel(response, 1);
            //alert("chido");
            console.log(response);
		}
	});
}

function lineaTiempo(fechas,cantidades,estatus){
		
    if( typeof ($.plot) === 'undefined'){ return; }
    
    console.log('init_flot_chart');
    console.log(fechas);
    console.log(cantidades);

    var vector_fechas = fechas.split("|");
    var vector_fechas2 = new Array();

    var vector_cantidades = cantidades.split("|");
    var vector_cantidades2 = new Array();

    for( var i = 0, j = vector_fechas.length; i < j; i++ ){
        if ( vector_fechas[ i ] ){
            vector_fechas2.push( vector_fechas[ i ] );
        }
    }

    for( var i = 0, j = vector_cantidades.length; i < j; i++ ){
        if ( vector_cantidades[ i ] ){
            vector_cantidades2.push( vector_cantidades[ i ] );
        }
    }

    
    var tamano_vector = parseInt(vector_fechas2.length);
    if(tamano_vector == 5){
        var fecha1 = new Date(vector_fechas2[0]).getTime();
        var fecha2 = new Date(vector_fechas2[1]).getTime();
        var fecha3 = new Date(vector_fechas2[2]).getTime();
        var fecha4 = new Date(vector_fechas2[3]).getTime();
        var fecha5 = new Date(vector_fechas2[4]).getTime();

        var fecha_aux = new Date(fecha5).add(3).days();
        var fecha6 =fecha_aux.getTime();
        
        var cantidad1 = vector_cantidades2[0];
        var cantidad2 = vector_cantidades2[1];
        var cantidad3 = vector_cantidades2[2];
        var cantidad4 = vector_cantidades2[3];
        var cantidad5 = vector_cantidades2[4];
        var cantidad6 = vector_cantidades2[4];
        
        var dias_totales = cantidad6;

        console.log("Vector tamaño 5");
        console.log(cantidad1);
        console.log(cantidad2);
        console.log(cantidad3);
        console.log(cantidad4);
        console.log(cantidad5);
        console.log(cantidad6);

        console.log(fecha1);
        console.log(fecha2);
        console.log(fecha3);
        console.log(fecha4);
        console.log(fecha5);
        console.log(fecha6);

        var chart_plot_02_data = [
            [fecha1, cantidad1],
            [fecha2, cantidad2],
            [fecha3, cantidad3],
            [fecha4, cantidad4],
            [fecha5, cantidad5],
            [fecha6, cantidad6]
        ];
    }
    if(tamano_vector == 4){
        var fecha1 = new Date(vector_fechas2[0]).getTime();
        var fecha2 = new Date(vector_fechas2[1]).getTime();
        var fecha3 = new Date(vector_fechas2[2]).getTime();
        var fecha4 = new Date(vector_fechas2[3]).getTime();

        if(estatus != "Pagado"){
            var fecha5 = new Date(Date.today()).getTime();
        }else{
            var fecha_aux = new Date(fecha4).add(3).days();
            var fecha5 =fecha_aux.getTime();
        }

        var cantidad1 = vector_cantidades2[0];
        var cantidad2 = vector_cantidades2[1];
        var cantidad3 = vector_cantidades2[2];
        var cantidad4 = vector_cantidades2[3];
        var cantidad5 = vector_cantidades2[3];

        var dias_totales = cantidad5;


        var chart_plot_02_data = [
            [fecha1, cantidad1],
            [fecha2, cantidad2],
            [fecha3, cantidad3],
            [fecha4, cantidad4],
            [fecha5, cantidad5]
        ];

        console.log("Vector tamaño 4");
        console.log(cantidad1);
        console.log(cantidad2);
        console.log(cantidad3);
        console.log(cantidad4);
        console.log(cantidad5);

        console.log(fecha1);
        console.log(fecha2);
        console.log(fecha3);
        console.log(fecha4);
        console.log(fecha5);
    }
    if(tamano_vector == 3){
        var fecha1 = new Date(vector_fechas2[0]).getTime();
        var fecha2 = new Date(vector_fechas2[1]).getTime();
        var fecha3 = new Date(vector_fechas2[2]).getTime();

        if(estatus != "Pagado"){
            var fecha4 = new Date(Date.today()).getTime();
        }else{
            var fecha_aux = new Date(fecha3).add(3).days();
            var fecha4 =fecha_aux.getTime();
        }
        
        var cantidad1 = vector_cantidades2[0];
        var cantidad2 = vector_cantidades2[1];
        var cantidad3 = vector_cantidades2[2];
        var cantidad4 = vector_cantidades2[2];

        var dias_totales = cantidad4;

        var chart_plot_02_data = [
            [fecha1, cantidad1],
            [fecha2, cantidad2],
            [fecha3, cantidad3],
            [fecha4, cantidad4]
        ];

        console.log("Vector tamaño 3");
        console.log(cantidad1);
        console.log(cantidad2);
        console.log(cantidad3);
        console.log(cantidad4);

        console.log(fecha1);
        console.log(fecha2);
        console.log(fecha3);
        console.log(fecha4);
    }
    if(tamano_vector == 2){
        var fecha1 = new Date(vector_fechas2[0]).getTime();
        var fecha2 = new Date(vector_fechas2[1]).getTime();

        if(estatus != "Pagado"){
            var fecha3 = new Date(Date.today()).getTime();
        }else{
            var fecha_aux = new Date(fecha2).add(3).days();
            var fecha3 =fecha_aux.getTime();
        }
        
        var cantidad1 = vector_cantidades2[0];
        var cantidad2 = vector_cantidades2[1];
        var cantidad3 = vector_cantidades2[1];

        var dias_totales = cantidad3;

        var chart_plot_02_data = [
            [fecha1, cantidad1],
            [fecha2, cantidad2],
            [fecha3, cantidad3]
        ];

        console.log("Vector tamaño 3");
        console.log(cantidad1);
        console.log(cantidad2);
        console.log(cantidad3);

        console.log(fecha1);
        console.log(fecha2);
        console.log(fecha3);
    }
    if(tamano_vector == 1){

    }

    var chart_plot_02_settings = {
        grid: {
            show: true,
            aboveData: true,
            color: "#3f3f3f",
            labelMargin: 10,
            axisMargin: 0,
            borderWidth: 0,
            borderColor: null,
            minBorderMargin: 5,
            clickable: true,
            hoverable: true,
            autoHighlight: true,
            mouseActiveRadius: 100
        },
        series: {
            lines: {
                show: true,
                fill: true,
                lineWidth: 2,
                steps: false
            },
            points: {
                show: true,
                radius: 4.5,
                symbol: "circle",
                lineWidth: 3.0
            }
        },
        legend: {
            position: "ne",
            margin: [0, -25],
            noColumns: 0,
            labelBoxBorderColor: null,
            labelFormatter: function(label, series) {
                return label + '&nbsp;&nbsp;';
            },
            width: 40,
            height: 1
        },
        colors: ['#96CA59', '#3F97EB', '#72c380', '#6f7a8a', '#f7cb38', '#5a8022', '#2c7282'],
        shadowSize: 0,
        tooltip: true,
        tooltipOpts: {
            content: "%s: %y.0",
            xDateFormat: "%d/%m",
        shifts: {
            x: -30,
            y: -50
        },
        defaultTheme: false
        },
        yaxis: {
            min: 0
        },
        xaxis: {
            mode: "time",
            minTickSize: [1, "day"],
            timeformat: "%d/%m/%y",
            min: chart_plot_02_data[0][0],
            max: chart_plot_02_data[tamano_vector][0]
        }
    };	
    
    
    if ($("#chart_plot_02").length){
        console.log('Plot2');
        
        $.plot( $("#chart_plot_02"), 
        [{ 
            label: "Dias del proceso", 
            data: chart_plot_02_data, 
            lines: { 
                fillColor: "rgba(150, 202, 89, 0.12)" 
            }, 
            points: { 
                fillColor: "#fff" } 
        }], chart_plot_02_settings);
        
    }
  
} 

function init_morris_charts(proveedores, plantas, dias) {

    console.log("Grafica Barras");
			
    var vec_proveedores = proveedores.split('|');
    var vec_plantas = plantas.split('|');
    var vec_dias = dias.split('|');


    if( typeof (Morris) === 'undefined'){ return; }
    console.log('init_morris_charts');
    
    if ($('#graph_bar').length){ 
        Morris.Bar({
          element: 'graph_bar',
          data: [
            {Proveedor: vec_proveedores[0], geekbench: vec_dias[0]},
            {Proveedor: vec_proveedores[1], geekbench: vec_dias[1]},
            {Proveedor: vec_proveedores[2], geekbench: vec_dias[2]},
            {Proveedor: vec_proveedores[3], geekbench: vec_dias[3]},
            {Proveedor: vec_proveedores[4], geekbench: vec_dias[4]},
            {Proveedor: vec_proveedores[5], geekbench: vec_dias[5]},
            {Proveedor: vec_proveedores[6], geekbench: vec_dias[6]},
            {Proveedor: vec_proveedores[7], geekbench: vec_dias[7]},
            {Proveedor: vec_proveedores[8], geekbench: vec_dias[8]},
            {Proveedor: vec_proveedores[9], geekbench: vec_dias[9]}
          ],
          xkey: 'Proveedor',
          ykeys: ['geekbench'],
          labels: ['Días'],
          barRatio: 0.4,
          barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
          xLabelAngle: 35,
          hideHover: 'auto',
          resize: true
        });

    }
};



function Reporte(){
    /*$("#divResultados").html('<center><img src="http://192.168.74.118/CAEP/Kanban/CAEP-Espere.gif" height="250"/></center>');*/
	var parametro = $("#parametro").val();
	var planta = $("#planta").val();
	var tipo_pedimento = $("#tipo_pedimento").val();
	var fecha1 = $("#fecha1").val();
	var fecha2 = $("#fecha2").val();
	var mes = $("#mes").val();
	
	$.ajax(
		{
		url : 'reporteExcel.php',
		type: "GET",
		data : {parametro: parametro,
                planta: planta,
                tipo_pedimento: tipo_pedimento,
                fecha1: fecha1,
                fecha2: fecha2,
                mes: mes
            }
		})
		.done(function(data) {
			$("#divResultados").html(data);
		})
		.fail(function(data) {
			alert( "error" );
		})
		.always(function(data2) {
		});	
}

function ReporteTT(proveedores, plantas, dias){
    /*$("#divResultados").html('<center><img src="http://192.168.74.118/CAEP/Kanban/CAEP-Espere.gif" height="250"/></center>');*/
	
	$.ajax(
		{
		url : 'reporteExcelTT.php',
		type: "GET",
		data : {
            proveedores: proveedores,
            plantas: plantas,
            dias: dias
            }
		})
		.done(function(data) {
			$("#divResultadosTT").html(data);
		})
		.fail(function(data) {
			alert( "error" );
		})
		.always(function(data2) {
		});	
}

function ReporteGeneral(){
    $("#divResultados").html("Cargando...");
	//var parametro = $("#parametro").val();
	var planta = $("#planta").val();
	var tipo_pedimento = $("#to").val();
	var fecha1 = $("#fecha1").val();
	var fecha2 = $("#fecha2").val();
	//var mes = $("#mes").val();
    var mes_concatenado = $("#mes").val();
    var semana_concatenada = $("#semana").val();


    var vector_mes = mes_concatenado.split('-');
    var mes_digito =  vector_mes[1];
    switch (mes_digito) {
        case '01':
            var mes = 'ENE';    
        break;
        case '02':
            var mes = 'FEB';
        break;
        case '03':
            var mes = 'MAR';
        break;
        case '04':
            var mes = 'ABR';
        break;
        case '05':
            var mes = 'MAY';
        break;
        case '06':
            var mes = 'JUN';
        break;
        case '07':
            var mes = 'JUL';
        break;
        case '08':
            var mes = 'AGO';
        break;
        case '09':
            var mes = 'SEP';
        break;
        case '10':
            var mes = 'OCT';
        break;
        case '11':
            var mes = 'NOV';
        break;
        case '12':
            var mes = 'DIC';
        break;
        default:
            var mes = '';
        break;
    }
    mes = mes+"-"+vector_mes[0]

    console.log(planta+" - "+tipo_pedimento+" - "+fecha1+" - "+fecha2+" - "+mes_concatenado+" - "+mes+" - "+semana_concatenada);



	$.ajax(
		{
		url : 'procesoReporteExcel.php',
		type: "GET",
		data : {planta: planta,
                tipo_pedimento: tipo_pedimento,
                fecha1: fecha1,
                fecha2: fecha2,
                mes: mes,
                semana: semana_concatenada
            }
		})
		.done(function(data) {
			$("#divResultados").html(data);
		})
		.fail(function(data) {
			alert( "error" );
		})
		.always(function(data2) {
		});	
}

function EliminaPed(valor){
    var valor = valor;
    if (window.confirm("Seguro quieres eliminar el pedimento "+valor)) {
        $.ajax(
            {
            url : 'EliminaPed.php',
            type: "GET",
            data : {
                pedimento: valor
                }
            })
            .done(function(data) {
                console.log(data);
                if(data == 1){
                   alert("Pedimento Eliminado");
                    location.reload(); 
                }
            })
            .fail(function(data) {
                alert( "error" );
            })
            .always(function(data2) {
            });
    }else{
        alert("No se elimino el pedimento");
        document.getElementById("check_"+valor).checked = false;
    }  
}

function IniciaTodo(){
    //grafica_pastel();
}