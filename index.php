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
    <body onLoad="Graficas('1')">
        <!--   CABECERA   -->
        <header id="cabecera">
            <!-- LOGO -->
            <div id="logo">
                <img src="includes/build/images/LOGO_META_CAE.png" width="150px">
                <a href="index.php">
                    Seguimiento Operacion
                </a>  
            </div>

            <!--   MENU   -->
        
            <!--
            <nav id="menu">
                <ul>
                    <li>
                        <a href="index.php">Inicio</a>
                    </li>
                    <li>
                        <a href="index.php">Categoria 1</a>
                    </li>
                    <li>
                        <a href="index.php">Categoria 2</a>
                    </li>
                    <li>
                        <a href="index.php">Categoria 3</a>
                    </li>
                    <li>
                        <a href="index.php">Categoria 4</a>
                    </li>
                    <li>
                        <a href="index.php">Sobre mi</a>
                    </li>
                    <li>
                        <a href="index.php">Contacto</a>
                    </li>
                </ul>
            </nav>
            -->
            <div class="clearfix">

            </div>
        </header> 
        <div id="contenedor">
            <!--   CONTENIDO PRINCIPAL   -->
             <div id="principal">
                <center>
                    <h1>Informacion General</h1>
                </center>
                
                <div id="lista">
                    <div class="izquierda1">
                    <h2>Planta</h2>
                        <br>
                        <select name="select" id="planta" onchange="Graficas('1')">
                        <?php 
                            $query3=mysqlI_query($con_116, "SELECT PLANTA FROM DATOS_GRAFICAS GROUP BY PLANTA");
                        ?>
                            <option value="0">GENERAL</option>
                            <?php
                            while($row3=mysqlI_fetch_assoc($query3))
                            {
                                $nombre=$row3['PLANTA'];
                                ?>
                                <option value="<?php echo $nombre; ?>"><?php echo $nombre;?></option><?php
                            }?>
                        </select>
                    </div>
                    <div class="centro">
                            <h2>Generacion de Reportes</h2>
                            <br>
                            <!-- <a href="Reportes.php"><img src="img/logo_excel.png" width="70px" onClick="Reporte()" style="cursor: pointer;"></a> -->
                            <img src="img/logo_excel.png" width="70px" onClick="ReporteGeneral()" style="cursor: pointer;">
                            <br>
                            <div id="divResultados">
                            </div>
                    </div>
                    <div class="derecha1">
                        <h2>Tipo de Operación</h2>
                        <br>
                        <select name="to" id="to" onchange="Graficas('2')">
                        <?php 
                            $query3=mysqlI_query($con_116, "SELECT TIPO_DE_OPERACION FROM DATOS_GRAFICAS GROUP BY TIPO_DE_OPERACION");
                        ?>
                            <option value="0">GENERAL</option>
                            <?php
                            while($row3=mysqlI_fetch_assoc($query3))
                            {
                                $nombre=$row3['TIPO_DE_OPERACION'];
                                ?>
                                <option value="<?php echo $nombre; ?>"><?php echo $nombre;?></option><?php
                            }?>
                        </select>
                    </div>
                </div>

                <br><br><br><br><br>

                <div id="fechas_mes" class="centro1">
                    <div class="centro1">
                        <div id="fechas_mes" class="centro1">
                            <div id="intervalo_fechas_2">
                                <h2>Intervalo Fechas</h2>
                                <br>
                                <input id="fecha1_2" type="date">
                                <br><br>
                                <input id="fecha2_2" type="date" onchange="cuadroResumen()">
                            </div>
                        </div>
                    </div>
                    <div id="intervalo_fechas">
                        <h2>Intervalo Fechas</h2>
                        <br>
                        <input id="fecha1" type="date">
                        <br><br>
                        <input id="fecha2" type="date" onchange="Graficas('2')">
                    </div>
                    <div id="mes_cierre">
                        <h2>Mes de Cierre</h2>
                        <input type="month" name="mes" id="mes" onchange="Graficas('2')">
                    </div>
                    <div id="semana_cierre">
                        <h2>Semana de Cierre</h2>
                        <input type="week" name="semana" id="semana" onchange="Graficas('2')">
                    </div>
                </div>

                <br><br>
                <div id="graficas">

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