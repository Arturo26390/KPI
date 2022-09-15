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
    ?>
    <body>
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
        <div id="principal" class="contenedorReporte">
            <div class="centro1">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Reportes</h2>
                            <div class="clearfix"></div>
                            <br>
                        </div>
                        <div class="x_content">
                            <div class="izquierda1">
                                <h1>Planta</h1>
                                <center>
                                <br>
                                <select name="select" id="planta">
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
                                </center>
                            </div>
                            <div class="centro">
                                <center> 
                                <h1>Tipo de Operación</h1>
                                <br>
                                
                                    <select name="to" id="to">
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
                                </center>
                            </div>
                            <div class="derecha1">
                                <center>
                                    <h1>Intervalo Fechas</h1>
                                    <br>
                                    <input id="fecha1_2" type="date">
                                    <input id="fecha2_2" type="date">
                                </center>
                            </div>
                            <div class="clearfix"></div>
                            <div class="centro2">
                                <button class="botones">Procesar</button>
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