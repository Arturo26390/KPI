<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Operacion Schneider</title>
        <!--  LIBRERIAS PARA LAS GRAFICAS -->
        <!-- Bootstrap -->
        <link href="includes/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="includes/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="includes/vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="includes/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
        
        <!-- bootstrap-progressbar -->
        <link href="includes/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
        <!-- JQVMap -->
        <link href="includes/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
        <!-- bootstrap-daterangepicker -->
        <link href="includes/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link rel="stylesheet" type="text/css" href="./includes/build/css/style.css">
        <link href="includes/build/css/custom.css" rel="stylesheet"> 
    </head>
    <?php
    include("includes/conexiones.php");
    $pedimento=$_GET["pedimento"];
    //$pedimento='1048981';
    $select_hoy = "SELECT CURDATE() AS FECHA_HOY";
    $ejecuta_select_hoy = mysqli_query($con_116, $select_hoy);
    $row_hoy=mysqli_fetch_assoc($ejecuta_select_hoy);
    $fecha_hoy     = $row_hoy['FECHA_HOY'];

    $select_fechas = "SELECT * FROM DATOS_GRAFICAS WHERE NO_PEDIMENTO = '".$pedimento."';";
    $ejecuta_select_fechas = mysqli_query($con_116, $select_fechas);
    $row=mysqli_fetch_assoc($ejecuta_select_fechas);
    $ESTATUS            = $row['ESTATUS'];
    $TIPO_OPERACION     = $row['TIPO_DE_OPERACION'];
    $PLANTA             = $row['PLANTA'];
    $PROVEEDOR          = $row['PROVEEDOR'];
    $ANALISTA_META      = $row['ANALISTA_META'];
    $IMMEX_NAC          = $row['IMMEX/NAC'];
    $FECHA_PRIMER_CARGA          = str_replace("'0000-00-00","",$row['FECHA_PRIMER_CARGA']);
    

    if($TIPO_OPERACION == 'K1' || $TIPO_OPERACION == 'R1'){
        if($ESTATUS=='Pagado'){
            $FECHA_INICIO           = $row['FECHA_INICIO'];
            $FECHA_INCIDENCIA       = $row['FECHA_INCIDENCIA'];
            $FECHA_CONCILIADO       = $row['FECHA_CONCILIADO'];
            $FECHA_CAPTURA          = $row['FECHA_CAPTURA'];
            $FECHA_PAGO             = $row['FECHA_PAGO'];
    
            if($FECHA_INCIDENCIA != '0000-00-00'){
                $dias_1= daysWeek($FECHA_INICIO, $FECHA_INCIDENCIA, $con_116);
                $dias_2= daysWeek($FECHA_INICIO, $FECHA_CONCILIADO, $con_116);
                $dias_3= daysWeek($FECHA_INICIO, $FECHA_CAPTURA, $con_116);
                $dias_4= daysWeek($FECHA_INICIO, $FECHA_PAGO, $con_116);
    
                $dias_transcurridos = $dias_4;
                
                $fechas_cadena = $FECHA_INICIO."|".$FECHA_INCIDENCIA."|".$FECHA_CONCILIADO."|".$FECHA_CAPTURA."|".$FECHA_PAGO;
                $cantidades_cadena = "0|".$dias_1."|".$dias_2."|".$dias_3."|".$dias_4;
            }else{
                $dias_1= daysWeek($FECHA_INICIO, $FECHA_CONCILIADO, $con_116);
                $dias_2= daysWeek($FECHA_INICIO, $FECHA_CAPTURA, $con_116);
                $dias_3= daysWeek($FECHA_INICIO, $FECHA_PAGO, $con_116);
    
                $dias_transcurridos = $dias_3;
    
                $fechas_cadena = $FECHA_INICIO."|".$FECHA_CONCILIADO."|".$FECHA_CAPTURA."|".$FECHA_PAGO;
                $cantidades_cadena = "0|".$dias_1."|".$dias_2."|".$dias_3;
            }
        }elseif($ESTATUS=='En Captura'){
            $FECHA_INICIO     = $row['FECHA_INICIO'];
            $FECHA_INCIDENCIA       = $row['FECHA_INCIDENCIA'];
            $FECHA_CONCILIADO       = $row['FECHA_CONCILIADO'];
            $FECHA_CAPTURA          = $row['FECHA_CAPTURA'];
    
            $dias_transcurridos = daysWeek($FECHA_INICIO, $fecha_hoy);
    
            if($FECHA_INCIDENCIA != '0000-00-00'){
                $dias_1= daysWeek($FECHA_INICIO, $FECHA_INCIDENCIA, $con_116);
                $dias_2= daysWeek($FECHA_INICIO, $FECHA_CONCILIADO, $con_116);
                $dias_3= daysWeek($FECHA_INICIO, $FECHA_CAPTURA, $con_116);
    
                
                
                $fechas_cadena = $FECHA_INICIO."|".$FECHA_INCIDENCIA."|".$FECHA_CONCILIADO."|".$FECHA_CAPTURA;
                $cantidades_cadena = "0|".$dias_1."|".$dias_2."|".$dias_3;
            }else{
                $dias_1= daysWeek($FECHA_INICIO, $FECHA_CONCILIADO, $con_116);
                $dias_2= daysWeek($FECHA_INICIO, $FECHA_CAPTURA, $con_116);
    
                
    
                $fechas_cadena = $FECHA_INICIO."|".$FECHA_CONCILIADO."|".$FECHA_CAPTURA;
                $cantidades_cadena = "0|".$dias_1."|".$dias_2;
            }
        }
    }else{
        if($ESTATUS=='Pagado'){
            $FECHA_INICIO           = $row['FECHA_INICIO'];
            $FECHA_INCIDENCIA       = $row['FECHA_INCIDENCIA'];
            $FECHA_CONCILIADO       = $row['FECHA_CONCILIADO'];
            $FECHA_CAPTURA          = $row['FECHA_CAPTURA'];
            $FECHA_PAGO             = $row['FECHA_PAGO'];
    
            if($FECHA_INCIDENCIA != '0000-00-00'){
                $dias_1= daysWeek($FECHA_INICIO, $FECHA_INCIDENCIA, $con_116);
                $dias_2= daysWeek($FECHA_INICIO, $FECHA_CONCILIADO, $con_116);
                $dias_3= daysWeek($FECHA_INICIO, $FECHA_CAPTURA, $con_116);
                $dias_4= daysWeek($FECHA_INICIO, $FECHA_PAGO, $con_116);
    
                $dias_transcurridos = $dias_4;
                
                $fechas_cadena = $FECHA_INICIO."|".$FECHA_INCIDENCIA."|".$FECHA_CONCILIADO."|".$FECHA_CAPTURA."|".$FECHA_PAGO;
                $cantidades_cadena = "0|".$dias_1."|".$dias_2."|".$dias_3."|".$dias_4;
            }else{
                $dias_1= daysWeek($FECHA_INICIO, $FECHA_CONCILIADO, $con_116);
                $dias_2= daysWeek($FECHA_INICIO, $FECHA_CAPTURA, $con_116);
                $dias_3= daysWeek($FECHA_INICIO, $FECHA_PAGO, $con_116);
    
                $dias_transcurridos = $dias_3;
    
                $fechas_cadena = $FECHA_INICIO."|".$FECHA_CONCILIADO."|".$FECHA_CAPTURA."|".$FECHA_PAGO;
                $cantidades_cadena = "0|".$dias_1."|".$dias_2."|".$dias_3;
            }
        }elseif($ESTATUS=='En Captura'){
            $FECHA_INICIO     = $row['FECHA_INICIO'];
            $FECHA_INCIDENCIA       = $row['FECHA_INCIDENCIA'];
            $FECHA_CONCILIADO       = $row['FECHA_CONCILIADO'];
            $FECHA_CAPTURA          = $row['FECHA_CAPTURA'];
    
            $dias_transcurridos = daysWeek($FECHA_INICIO, $fecha_hoy, $con_116);
    
            if($FECHA_INCIDENCIA != '0000-00-00'){
                $dias_1= daysWeek($FECHA_INICIO, $FECHA_INCIDENCIA, $con_116);
                $dias_2= daysWeek($FECHA_INICIO, $FECHA_CONCILIADO, $con_116);
                $dias_3= daysWeek($FECHA_INICIO, $FECHA_CAPTURA, $con_116);
    
                
                
                $fechas_cadena = $FECHA_INICIO."|".$FECHA_INCIDENCIA."|".$FECHA_CONCILIADO."|".$FECHA_CAPTURA;
                $cantidades_cadena = "0|".$dias_1."|".$dias_2."|".$dias_3;
            }else{
                $dias_1= daysWeek($FECHA_INICIO, $FECHA_CONCILIADO, $con_116);
                $dias_2= daysWeek($FECHA_INICIO, $FECHA_CAPTURA, $con_116);
    
                
    
                $fechas_cadena = $FECHA_INICIO."|".$FECHA_CONCILIADO."|".$FECHA_CAPTURA;
                $cantidades_cadena = "0|".$dias_1."|".$dias_2;
            }
    
        }elseif($ESTATUS=='Conciliado'){
            $FECHA_INICIO     = $row['FECHA_INICIO'];
            $FECHA_INCIDENCIA       = $row['FECHA_INCIDENCIA'];
            $FECHA_CONCILIADO       = $row['FECHA_CONCILIADO'];
    
            $dias_transcurridos = daysWeek($FECHA_INICIO, $fecha_hoy, $con_116);
    
            if($FECHA_INCIDENCIA != '0000-00-00'){
                $dias_1= daysWeek($FECHA_INICIO, $FECHA_INCIDENCIA, $con_116);
                $dias_2= daysWeek($FECHA_INICIO, $FECHA_CONCILIADO, $con_116);
    
                
                $fechas_cadena = $FECHA_INICIO."|".$FECHA_INCIDENCIA."|".$FECHA_CONCILIADO;
                $cantidades_cadena = "0|".$dias_1."|".$dias_2;
            }else{
                $dias_1= daysWeek($FECHA_INICIO, $FECHA_CONCILIADO, $con_116);
    
    
                $fechas_cadena = $FECHA_INICIO."|".$FECHA_CONCILIADO;
                $cantidades_cadena = "0|".$dias_1;
            }
    
        }elseif($ESTATUS=='Incidencia'){
            $FECHA_INICIO     = $row['FECHA_INICIO'];
            $FECHA_INCIDENCIA       = $row['FECHA_INCIDENCIA'];
    
            $dias_transcurridos = daysWeek($FECHA_INICIO, $fecha_hoy, $con_116);
    
            if($FECHA_INCIDENCIA != '0000-00-00'){
                $dias_1= daysWeek($FECHA_INICIO, $FECHA_INCIDENCIA, $con_116);
    
                
                $fechas_cadena = $FECHA_INICIO."|".$FECHA_INCIDENCIA;
                $cantidades_cadena = "0|".$dias_1;
            }else{
                $mostrar = "No Hay Información Para Mostrar";
                $fechas_cadena = $mostrar;
                $cantidades_cadena = $mostrar;
                
            }
    
        }elseif($ESTATUS=='Sin Informacion'){
            $mostrar = "No Hay Información Para Mostrar";
            $fechas_cadena = $mostrar;
            $cantidades_cadena = $mostrar;
        }
    }
    
    

    function daysWeek($inicio, $fin, $con_116){
    
        $start = new DateTime($inicio);
        $end = new DateTime($fin);

        //de lo contrario, se excluye la fecha de finalización (¿error?)
        $end->modify('+1 day');

        $interval = $end->diff($start);

        // total dias
        $days = $interval->days;

        // crea un período de fecha iterable (P1D equivale a 1 día)
        $period = new DatePeriod($start, new DateInterval('P1D'), $end);

        // almacenado como matriz, por lo que puede agregar más de una fecha feriada
        $holidays = array('2012-09-07');

        foreach($period as $dt) {
            $curr = $dt->format('D');

            // obtiene si es Sábado o Domingo
            if($curr == 'Sat' || $curr == 'Sun') {
                $days--;
            }elseif (in_array($dt->format('Y-m-d'), $holidays)) {
                $days--;
            }
        }
        $consulta_feriados = "SELECT * FROM `CONTROL_SEMANAS` WHERE FECHA BETWEEN '".$inicio."' AND '".$fin."' and DIA_FERIADO = 'SI'";
        $ejecuta_consulta_feriados = mysqli_query($con_116, $consulta_feriados);
        $feriados = mysqli_num_rows($ejecuta_consulta_feriados);

        return $days-$feriados;
    }
    ?>
    <body onload="lineaTiempo('<?php echo $fechas_cadena; ?>' ,' <?php echo $cantidades_cadena; ?>' ,' <?php echo $ESTATUS; ?>')">
        <!--   CABECERA   -->
        <header id="cabecera">
            <!-- LOGO -->
            <div id="logo">
                <img src="includes/build/images/LOGO_META_CAE.png" width="150px">
                <a href="index.php">
                    Seguimiento Operacion
                </a>  
            </div>
            <div class="clearfix">

            </div>
        </header>
    <div id="contenedor">
        <!--   CONTENIDO PRINCIPAL   -->
        <div id="principal">
            <div class="centro1">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Linea de Tiempo<small>Pedimento <?php echo $pedimento; ?></small> Analista Meta <small><?php echo $ANALISTA_META; ?></small></h2>
                            <div class="clearfix"></div>
                            <br>
                        </div>
                        <div class="x_content">
                            <div class="col-md-9 col-sm-12 ">
                                <div class="demo-container" style="height:280px">
                                    <div id="chart_plot_02" class="demo-placeholder"></div>
                                </div>
                                <div class="tiles">
                                    <?php
                                      if($TIPO_OPERACION == 'K1' || $TIPO_OPERACION == 'R1' || $TIPO_OPERACION == 'V1-ITR'){
                                        if($ESTATUS == 'Pagado'){
                                            if($FECHA_INCIDENCIA== '0000-00-00'){
                                                ?>
                                                <div class="col-md-2 tile">
                                                    <span>Inicio</span>
                                                    <h2><?php echo $FECHA_INICIO; ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <div class="col-md-2 tile">
                                                    <span>Captura</span>
                                                    <h2><?php echo $FECHA_CAPTURA;  ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <div class="col-md-2 tile">
                                                    <span>Pago</span>
                                                    <h2><?php echo $FECHA_PAGO    ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <?php
                                            }else{
                                                ?>
                                                <div class="col-md-2 tile">
                                                    <span>Inicio</span>
                                                    <h2><?php echo $FECHA_INICIO; ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <div class="col-md-2 tile">
                                                    <span>Conciliacion</span>
                                                    <h2><?php echo $FECHA_CONCILIADO; ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <div class="col-md-2 tile">
                                                    <span>Captura</span>
                                                    <h2><?php echo $FECHA_CAPTURA;  ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <div class="col-md-2 tile">
                                                    <span>Pago</span>
                                                    <h2><?php echo $FECHA_PAGO    ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <?php
                                            }
                                        }
                                        if($ESTATUS == 'En Captura'){ 
                                            if($FECHA_INCIDENCIA== '0000-00-00'){
                                            
                                                ?>
                                                <div class="col-md-2 tile">
                                                    <span>Inicio</span>
                                                    <h2><?php echo $FECHA_INICIO; ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <div class="col-md-2 tile">
                                                    <span>Conciliacion</span>
                                                    <h2><?php echo $FECHA_CONCILIADO; ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <div class="col-md-2 tile">
                                                    <span>Captura</span>
                                                    <h2><?php echo $FECHA_CAPTURA;  ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <?php
                                            }else{
                                                ?>
                                                <div class="col-md-2 tile">
                                                    <span>Inicio</span>
                                                    <h2><?php echo $FECHA_INICIO; ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <div class="col-md-2 tile">
                                                    <span>Incidencia</span>
                                                    <h2><?php echo $FECHA_INCIDENCIA; ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <div class="col-md-2 tile">
                                                    <span>Conciliacion</span>
                                                    <h2><?php echo $FECHA_CONCILIADO; ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <div class="col-md-2 tile">
                                                    <span>Captura</span>
                                                    <h2><?php echo $FECHA_CAPTURA;  ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <?php
                                            }
                                        }
                                      }else{
                                        if($ESTATUS == 'Pagado'){
                                            if($FECHA_INCIDENCIA== '0000-00-00'){
                                                ?>
                                                <div class="col-md-2 tile">
                                                    <span>Inicio</span>
                                                    <h2><?php echo $FECHA_INICIO; ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <div class="col-md-2 tile">
                                                    <span>Primer Carga</span>
                                                    <h2><?php echo $FECHA_PRIMER_CARGA; ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <div class="col-md-2 tile">
                                                    <span>Conciliacion</span>
                                                    <h2><?php echo $FECHA_CONCILIADO; ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <div class="col-md-2 tile">
                                                    <span>Captura</span>
                                                    <h2><?php echo $FECHA_CAPTURA;  ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <div class="col-md-2 tile">
                                                    <span>Pago</span>
                                                    <h2><?php echo $FECHA_PAGO    ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <?php
                                            }else{
                                                ?>
                                                <div class="col-md-2 tile">
                                                    <span>Inicio</span>
                                                    <h2><?php echo $FECHA_INICIO; ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <div class="col-md-2 tile">
                                                    <span>Primer Carga</span>
                                                    <h2><?php echo $FECHA_PRIMER_CARGA; ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <div class="col-md-2 tile">
                                                    <span>Incidencia</span>
                                                    <h2><?php echo $FECHA_INCIDENCIA; ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <div class="col-md-2 tile">
                                                    <span>Conciliacion</span>
                                                    <h2><?php echo $FECHA_CONCILIADO; ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <div class="col-md-2 tile">
                                                    <span>Captura</span>
                                                    <h2><?php echo $FECHA_CAPTURA;  ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <div class="col-md-2 tile">
                                                    <span>Pago</span>
                                                    <h2><?php echo $FECHA_PAGO    ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <?php
                                            }
                                        }
                                        if($ESTATUS == 'En Captura'){ 
                                            if($FECHA_INCIDENCIA== '0000-00-00'){
                                            
                                                ?>
                                                <div class="col-md-2 tile">
                                                    <span>Inicio</span>
                                                    <h2><?php echo $FECHA_INICIO; ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <div class="col-md-2 tile">
                                                    <span>Primer Carga</span>
                                                    <h2><?php echo $FECHA_PRIMER_CARGA; ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <div class="col-md-2 tile">
                                                    <span>Conciliacion</span>
                                                    <h2><?php echo $FECHA_CONCILIADO; ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <div class="col-md-2 tile">
                                                    <span>Captura</span>
                                                    <h2><?php echo $FECHA_CAPTURA;  ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <?php
                                            }else{
                                                ?>
                                                <div class="col-md-2 tile">
                                                    <span>Inicio</span>
                                                    <h2><?php echo $FECHA_INICIO; ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <div class="col-md-2 tile">
                                                    <span>Primer Carga</span>
                                                    <h2><?php echo $FECHA_PRIMER_CARGA; ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <div class="col-md-2 tile">
                                                    <span>Incidencia</span>
                                                    <h2><?php echo $FECHA_INCIDENCIA; ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <div class="col-md-2 tile">
                                                    <span>Conciliacion</span>
                                                    <h2><?php echo $FECHA_CONCILIADO; ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <div class="col-md-2 tile">
                                                    <span>Captura</span>
                                                    <h2><?php echo $FECHA_CAPTURA;  ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <?php
                                            }
                                        }
                                        if($ESTATUS == 'Conciliado'){
                                            if($FECHA_INCIDENCIA== '0000-00-00'){
                                                ?>
                                                <div class="col-md-2 tile">
                                                    <span>Inicio</span>
                                                    <h2><?php echo $FECHA_INICIO; ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <div class="col-md-2 tile">
                                                    <span>Primer Carga</span>
                                                    <h2><?php echo $FECHA_PRIMER_CARGA; ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <div class="col-md-2 tile">
                                                    <span>Conciliacion</span>
                                                    <h2><?php echo $FECHA_CONCILIADO; ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <?php
                                            }else{
                                                ?>
                                                <div class="col-md-2 tile">
                                                    <span>Inicio</span>
                                                    <h2><?php echo $FECHA_INICIO; ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <div class="col-md-2 tile">
                                                    <span>Primer Carga</span>
                                                    <h2><?php echo $FECHA_PRIMER_CARGA; ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <div class="col-md-2 tile">
                                                    <span>Incidencia</span>
                                                    <h2><?php echo $FECHA_INCIDENCIA; ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <div class="col-md-2 tile">
                                                    <span>Conciliacion</span>
                                                    <h2><?php echo $FECHA_CONCILIADO; ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                                <?php
                                            }
                                        }
                                        if($ESTATUS == 'Incidencia'){
                                            ?>
                                            <div class="col-md-2 tile">
                                                <span>Inicio</span>
                                                <h2><?php echo $FECHA_INICIO; ?></h2>
                                                <span class="sparkline11 graph" style="height: 160px;">
                                                        <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                </span>
                                            </div>
                                            <div class="col-md-2 tile">
                                                    <span>Primer Carga</span>
                                                    <h2><?php echo $FECHA_PRIMER_CARGA; ?></h2>
                                                    <span class="sparkline11 graph" style="height: 160px;">
                                                            <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                    </span>
                                                </div>
                                            <div class="col-md-2 tile">
                                                <span>Incidencia</span>
                                                <h2><?php echo $FECHA_INCIDENCIA; ?></h2>
                                                <span class="sparkline11 graph" style="height: 160px;">
                                                        <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                                </span>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                    
                                </div>
                                <br>
                                <div class="clearfix"></div>
                                <div class="tiles">
                                    <div class="col-md-2 tile">
                                    <span>Tipo de Operacion</span>
                                        <h2><?php echo $TIPO_OPERACION ?></h2>
                                        <span class="sparkline11 graph" style="height: 160px;">
                                                <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                        </span>
                                    </div>
                                    <div class="col-md-2 tile">
                                    <span>Estatus del Pedimento</span>
                                        <h2><?php echo $ESTATUS ?></h2>
                                        <span class="sparkline11 graph" style="height: 160px;">
                                                <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                        </span>
                                    </div>
                                    <div class="col-md-2 tile">
                                        <span>Planta</span>
                                        <h2><?php echo $PLANTA ?></h2>
                                        <span class="sparkline11 graph" style="height: 160px;">
                                                <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                        </span>
                                    </div>
                                    <div class="col-md-2 tile">
                                        <span>Proveedor</span>
                                        <h2><?php echo $PROVEEDOR ?></h2>
                                        <span class="sparkline11 graph" style="height: 160px;">
                                                <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                        </span>
                                    </div>
                                    <div class="col-md-2 tile">
                                        <span>IMMEX/NAC</span>
                                        <h2><?php echo $IMMEX_NAC ?></h2>
                                        <span class="sparkline11 graph" style="height: 160px;">
                                                <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                        </span>
                                    </div>
                                    
                                </div>
                                <div class="clearfix"></div>
                                <div class="tiles">
                                    <div class="col-md-2 tile">
                                        <span>Total de días transcurridos</span>
                                        <h2><?php echo $dias_transcurridos ?></h2>
                                        <span class="sparkline11 graph" style="height: 160px;">
                                                <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix">

        </div>
    </div>
        
        
        <!--   PIE DE PAGINA   -->
        <!--
        <footer id="pie">
            <p>Desarrollado por Arturo Reyes &copy; 2021</p>
        </footer>
        -->

    </body>
</html>
</script>
    <!-- jQuery -->
    <script src="includes/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="includes/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="includes/vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="includes/vendors/nprogress/nprogress.js"></script>
<!-- Chart.js -->
<script src="includes/vendors/Chart.js/dist/Chart.min.js"></script>
<!-- gauge.js -->
<script src="includes/vendors/gauge.js/dist/gauge.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="includes/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="includes/vendors/iCheck/icheck.min.js"></script>
<!-- Skycons -->
<script src="includes/vendors/skycons/skycons.js"></script>
<!-- Flot -->
<script src="includes/vendors/Flot/jquery.flot.js"></script>
<script src="includes/vendors/Flot/jquery.flot.pie.js"></script>
<script src="includes/vendors/Flot/jquery.flot.time.js"></script>
<script src="includes/vendors/Flot/jquery.flot.stack.js"></script>
<script src="includes/vendors/Flot/jquery.flot.resize.js"></script>
<!-- Flot plugins -->
<script src="includes/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
<script src="includes/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
<script src="includes/vendors/flot.curvedlines/curvedLines.js"></script>
<!-- DateJS -->
<script src="includes/vendors/DateJS/build/date.js"></script>
<!-- JQVMap -->
<script src="includes/vendors/jqvmap/dist/jquery.vmap.js"></script>
<script src="includes/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="includes/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="includes/vendors/moment/min/moment.min.js"></script>
<script src="includes/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- Custom Theme Scripts 
<script src="includes/build/js/custom.js"></script>-->
<script src="includes/build/js/controller.js"></script>

<script src="includes/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="includes/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="includes/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="includes/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="includes/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="includes/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="includes/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="includes/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="includes/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="includes/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="includes/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="includes/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="includes/vendors/jszip/dist/jszip.min.js"></script>
<script src="includes/vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="includes/vendors/pdfmake/build/vfs_fonts.js"></script>