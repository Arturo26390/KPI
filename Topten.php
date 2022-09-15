<?php
include("includes/conexiones.php");
?>
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
    $parametro=$_GET["archivo"];
    $planta=$_GET["planta"];
    $tipo_pedimento=$_GET["tipo"];
    $fecha1=$_GET['fecha1'];
    $fecha2=$_GET['fecha2'];
    $mes=$_GET['mes'];


    if($planta=='0'){
        if($tipo_pedimento=='0'){
            if(strlen($fecha1)>0 && strlen($fecha2)>0){
                $consulta="SELECT * FROM DATOS_GRAFICAS WHERE ESTATUS = '".$parametro."' AND FECHA_PAGO BETWEEN '".$fecha1."' AND '".$fecha2."'";
            }else{
                if(strlen($mes)>0){
                    $consulta="SELECT * FROM DATOS_GRAFICAS WHERE ESTATUS = '".$parametro."' AND MES_CIERRE = '".$mes."'";         
                }else{
                    $consulta="SELECT * FROM DATOS_GRAFICAS WHERE ESTATUS = '".$parametro."'";
                }
                
            }
        }
        else{
            if(strlen($fecha1)>0 && strlen($fecha2)>0){
                $consulta="SELECT * FROM DATOS_GRAFICAS WHERE TIPO_DE_OPERACION = '".$tipo_pedimento."' AND ESTATUS = '".$parametro."' AND FECHA_PAGO BETWEEN '".$fecha1."' AND '".$fecha2."'";
            }else{
                if(strlen($mes)>0){
                    $consulta="SELECT * FROM DATOS_GRAFICAS WHERE TIPO_DE_OPERACION = '".$tipo_pedimento."' AND ESTATUS = '".$parametro."' AND MES_CIERRE = '".$mes."'";     
                }else{
                    $consulta="SELECT * FROM DATOS_GRAFICAS WHERE TIPO_DE_OPERACION = '".$tipo_pedimento."' AND ESTATUS = '".$parametro."'";
                }
            }
        }
    }else{
        if($tipo_pedimento=='0'){
            if(strlen($fecha1)>0 && strlen($fecha2)>0){
                $consulta="SELECT * FROM DATOS_GRAFICAS WHERE PLANTA = '".$planta."' AND ESTATUS = '".$parametro."' AND FECHA_PAGO BETWEEN '".$fecha1."' AND '".$fecha2."'";
            }else{
                if(strlen($mes)>0){
                    $consulta="SELECT * FROM DATOS_GRAFICAS WHERE PLANTA = '".$planta."' AND ESTATUS = '".$parametro."' AND MES_CIERRE = '".$mes."'";    
                }else{
                    $consulta="SELECT * FROM DATOS_GRAFICAS WHERE PLANTA = '".$planta."' AND ESTATUS = '".$parametro."'";
                }
            }
        }else{
            if(strlen($fecha1)>0 && strlen($fecha2)>0){
                $consulta="SELECT * FROM DATOS_GRAFICAS WHERE PLANTA = '".$planta."' AND TIPO_DE_OPERACION = '".$tipo_pedimento."' AND ESTATUS = '".$parametro."' AND FECHA_PAGO BETWEEN '".$fecha1."' AND '".$fecha2."'";
            }else{
                if(strlen($mes)>0){
                    $consulta="SELECT * FROM DATOS_GRAFICAS WHERE PLANTA = '".$planta."' AND TIPO_DE_OPERACION = '".$tipo_pedimento."' AND ESTATUS = '".$parametro."' AND MES_CIERRE = '".$mes."'";    
                }else{
                    $consulta="SELECT * FROM DATOS_GRAFICAS WHERE PLANTA = '".$planta."' AND TIPO_DE_OPERACION = '".$tipo_pedimento."' AND ESTATUS = '".$parametro."'";
                }
            }
        }
    }

    //echo $consulta."<br>";
    $ejecuta_consulta = mysqli_query($con_116, $consulta);
    $truncate_table=mysqli_query($con_116, "TRUNCATE TABLE TOPTEN");

    while($row=mysqli_fetch_assoc($ejecuta_consulta)){
        $FECHA_INICIO           = $row['FECHA_INICIO'];
        $PROVEEDOR              = $row['PROVEEDOR'];
        $FECHA_PAGO             = $row['FECHA_PAGO'];
        $PLANTA             = $row['PLANTA'];

        $dias_4= daysWeek($FECHA_INICIO, $FECHA_PAGO, $con_116);
        $DIAS_PROCESO = $dias_4;

        $insert_topten = "INSERT INTO TOPTEN (PROVEEDOR,DIAS_PROCESO,PLANTA) VALUES('".$PROVEEDOR."',".$DIAS_PROCESO.",'".$PLANTA."')";
        $ejcuta_insert_topten = mysqli_query($con_116,$insert_topten);
        //echo $insert_topten."<br>";
    }

    $consulta_topten = "SELECT * FROM
    (SELECT PLANTA, PROVEEDOR, MAX(DIAS_PROCESO) AS DIAS_PROCESO FROM TOPTEN GROUP BY PLANTA, PROVEEDOR ) AS TablaNueva
    ORDER BY DIAS_PROCESO DESC
    LIMIT 10;";

    
    $ejecuta_consulta_topten = mysqli_query($con_116, $consulta_topten);
    $vector_proveedor = $vector_dias = $vector_planta = '';
    while($row_topten=mysqli_fetch_assoc($ejecuta_consulta_topten)){
        $proveedor_topten              = $row_topten['PROVEEDOR'];
        $dias_top_ten             = $row_topten['DIAS_PROCESO'];
        $planta_topten             = $row_topten['PLANTA'];

        $vector_proveedor =  $proveedor_topten."|".$vector_proveedor;
        $vector_planta =  $planta_topten."|".$vector_planta;
        $vector_dias =  $dias_top_ten."|".$vector_dias;
    }
     
    ?>
    <body onLoad="init_morris_charts('<?php echo $vector_proveedor?>','<?php echo $vector_planta?>','<?php echo $vector_dias?>')">
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
            <center>
                <h1>Top Ten Proveedores</h1>
                <br><br>
            </center>
            <div class="clearfix"></div>
            <div class="col-md-6 col-sm-6  ">
                <div class="x_panel">
                    <div class="x_title">
                    <h2>Detalle <small>Proveedor / Planta</small></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Proveedor</th>
                                    <th>Planta</th>
                                    <th>Dias</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $proveedores = explode("|", $vector_proveedor);
                                $plantas = explode("|", $vector_planta);
                                $dias = explode("|", $vector_dias);
                                $var_aux = 1;
                                    for($i=9; $i>=0; $i--){
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo $var_aux; ?></th></th>
                                            <td><?php echo $proveedores[$i]?></td>
                                            <td><?php echo $plantas[$i]?></td>
                                            <td><?php echo $dias[$i]?></td>
                                        </tr>
                                        <?php
                                        $var_aux++;
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6  widget_tally_box">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Dias de Proceso</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="graph_bar" style="width:100%; height:200px;"></div>
                        <div class=" bg-white progress_summary"></div>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="">
                <h2 onClick="ReporteTT('<?php echo $vector_proveedor?>','<?php echo $vector_planta?>','<?php echo $vector_dias?>')" style="cursor: pointer;">
                    <img src="img/logo_excel.png" width="60px" onClick="ReporteTT('<?php echo $vector_proveedor?>','<?php echo $vector_planta?>','<?php echo $vector_dias?>')" style="cursor: pointer;">
                    <div id="divResultadosTT"></div>
                </h2>
            </div>
            
        </div>
        <div class="clearfix"></div>
</div>
        
        
        <!--   PIE DE PAGINA   -->
        <!--
        <footer id="pie">
            <p>Desarrollado por Arturo Reyes &copy; 2021</p>
        </footer>
        -->

    </body>
</html>
<?php
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
<script src="includes/build/js/controller.js"></script>
<!-- morris.js -->
<script src="includes/vendors/raphael/raphael.min.js"></script>
<script src="includes/vendors/morris.js/morris.min.js"></script>