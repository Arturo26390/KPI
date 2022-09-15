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
        <?php
            include("includes/conexiones.php");
            $parametro=$_GET["archivo"];
            $planta=$_GET["planta"];
            $tipo_pedimento=$_GET["tipo"];
            $fecha1=$_GET['fecha1'];
            $fecha2=$_GET['fecha2'];
            $mes=$_GET['mes'];


            if($planta=='0'){
                if($tipo_pedimento=='0'){
                    if(strlen($fecha1)>0 && strlen($fecha2)>0){
                        $consulta="SELECT * FROM DATOS_GRAFICAS_PRUEBAS WHERE ESTATUS = '".$parametro."' AND FECHA_PAGO BETWEEN '".$fecha1."' AND '".$fecha2."'";
                    }else{
                        if(strlen($mes)>0){
                            $consulta="SELECT * FROM DATOS_GRAFICAS_PRUEBAS WHERE ESTATUS = '".$parametro."' AND MES_CIERRE = '".$mes."'";         
                        }else{
                            $consulta="SELECT * FROM DATOS_GRAFICAS_PRUEBAS WHERE ESTATUS = '".$parametro."'";
                        }
                        
                    }
                }
                else{
                    if(strlen($fecha1)>0 && strlen($fecha2)>0){
                        $consulta="SELECT * FROM DATOS_GRAFICAS_PRUEBAS WHERE TIPO_DE_OPERACION = '".$tipo_pedimento."' AND ESTATUS = '".$parametro."' AND FECHA_PAGO BETWEEN '".$fecha1."' AND '".$fecha2."'";
                    }else{
                        if(strlen($mes)>0){
                            $consulta="SELECT * FROM DATOS_GRAFICAS_PRUEBAS WHERE TIPO_DE_OPERACION = '".$tipo_pedimento."' AND ESTATUS = '".$parametro."' AND MES_CIERRE = '".$mes."'";     
                        }else{
                            $consulta="SELECT * FROM DATOS_GRAFICAS_PRUEBAS WHERE TIPO_DE_OPERACION = '".$tipo_pedimento."' AND ESTATUS = '".$parametro."'";
                        }
                    }
                }
            }else{
                if($tipo_pedimento=='0'){
                    if(strlen($fecha1)>0 && strlen($fecha2)>0){
                        $consulta="SELECT * FROM DATOS_GRAFICAS_PRUEBAS WHERE PLANTA = '".$planta."' AND ESTATUS = '".$parametro."' AND FECHA_PAGO BETWEEN '".$fecha1."' AND '".$fecha2."'";
                    }else{
                        if(strlen($mes)>0){
                            $consulta="SELECT * FROM DATOS_GRAFICAS_PRUEBAS WHERE PLANTA = '".$planta."' AND ESTATUS = '".$parametro."' AND MES_CIERRE = '".$mes."'";    
                        }else{
                            $consulta="SELECT * FROM DATOS_GRAFICAS_PRUEBAS WHERE PLANTA = '".$planta."' AND ESTATUS = '".$parametro."'";
                        }
                    }
                }else{
                    if(strlen($fecha1)>0 && strlen($fecha2)>0){
                        $consulta="SELECT * FROM DATOS_GRAFICAS_PRUEBAS WHERE PLANTA = '".$planta."' AND TIPO_DE_OPERACION = '".$tipo_pedimento."' AND ESTATUS = '".$parametro."' AND FECHA_PAGO BETWEEN '".$fecha1."' AND '".$fecha2."'";
                    }else{
                        if(strlen($mes)>0){
                            $consulta="SELECT * FROM DATOS_GRAFICAS_PRUEBAS WHERE PLANTA = '".$planta."' AND TIPO_DE_OPERACION = '".$tipo_pedimento."' AND ESTATUS = '".$parametro."' AND MES_CIERRE = '".$mes."'";    
                        }else{
                            $consulta="SELECT * FROM DATOS_GRAFICAS_PRUEBAS WHERE PLANTA = '".$planta."' AND TIPO_DE_OPERACION = '".$tipo_pedimento."' AND ESTATUS = '".$parametro."'";
                        }

                        
                    }
                }
            }
            
            
            $ejecuta_consulta = mysqli_query($con_116, $consulta);
        ?>
        <div id="contenedor">
        <input id="parametro" type="hidden" value="<?php echo $parametro; ?>">
        <input id="planta" type="hidden"value="<?php echo $planta; ?>">
        <input id="tipo_pedimento" type="hidden"value="<?php echo $tipo_pedimento; ?>">
        <input id="fecha1" type="hidden"value="<?php echo $fecha1; ?>">
        <input id="fecha2" type="hidden"value="<?php echo $fecha2; ?>">
        <input id="mes" type="hidden"value="<?php echo $mes; ?>">

            <!--   CONTENIDO PRINCIPAL   -->
             <div id="principal">
                <center>
                    <h1>Detalle de Pedimentos "<?php echo $parametro; ?>"</h1>
                </center>
                <br>
                <div id="lista">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="clearfix"></div>
                            <div class="">
                                <img src="img/logo_excel.png" width="70px" onClick="Reporte()" style="cursor: pointer;">
                            </div>
                            
                            <div id="divResultados">
                            </div>
                            <?php
                            if($parametro == 'Pagado'){
                                ?>
                                    <h2 style="cursor: pointer;">
                                        <a href="Topten.php?archivo=Pagado&planta=<?php echo $planta; ?>&tipo=<?php echo $tipo_pedimento; ?>&fecha1=<?php echo $fecha1; ?>&fecha2=<?php echo $fecha2; ?>&mes=<?php echo $mes; ?>">
                                        <img src="img/logo_topten.png" width="50px" style="cursor: pointer;">
                                        </a>
                                    </h2>
                                <?php
                            }
                            ?>
                           
                            <div class="x_panel">
                                <div class="x_title">
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                                </div>
                                <div class="x_conent">
                                    <div class="table-responsive">
                                        <table id="datatable" class="table table-striped table-bordered detallePedimentos">
                                            <?php

                                            if($tipo_pedimento == 'K1' || $tipo_pedimento == 'R1'){
                                                if($parametro == 'En Captura'){
                                                    ?>
                                                        <thead>
                                                            <tr>   
                                                                <th>REFERENCIA</th>
                                                                <th>PLANTA</th>
                                                                <th>PROVEEDOR</th>
                                                                <th>IMMEX/NAC</th>
                                                                <th>TIPO_DE_OPERACION</th>
                                                                <th>NO_PEDIMENTO</th>
                                                                <th>ANALISTA_META</th>
                                                                <th>FECHA_CAPTURA</th>
                                                            </tr>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                while($row=mysqli_fetch_assoc($ejecuta_consulta)){
                                                                    $FECHA_PRIMER_CARGA     = $row['FECHA_PRIMER_CARGA'];
                                                                    $FECHA_INICIO           = $row['FECHA_INICIO'];
                                                                    $HORA_PRIMER_CARGA      = $row['HORA_PRIMER_CARGA'];
                                                                    $FECHA_ULTIMA_CARGA     = $row['FECHA_ULTIMA_CARGA'];
                                                                    $HORA_ULTIMA_CARGA      = $row['HORA_ULTIMA_CARGA'];
                                                                    $REFERENCIA             = $row['REFERENCIA'];
                                                                    $PLANTA                 = $row['PLANTA'];
                                                                    $PROVEEDOR              = $row['PROVEEDOR'];
                                                                    $IMMEX_NAC              = $row['IMMEX/NAC'];
                                                                    $TIPO_DE_OPERACION      = $row['TIPO_DE_OPERACION'];
                                                                    $NO_PEDIMENTO           = $row['NO_PEDIMENTO'];
                                                                    $FECHA_INCIDENCIA       = $row['FECHA_INCIDENCIA'];
                                                                    $HORA_INCIDENCIA        = $row['HORA_INCIDENCIA'];
                                                                    $FECHA_CONCILIADO       = $row['FECHA_CONCILIADO'];
                                                                    $HORA_CONCLIADO         = $row['HORA_CONCLIADO'];
                                                                    $FECHA_CAPTURA          = $row['FECHA_CAPTURA'];
                                                                    $HORA_CAPTURA           = $row['HORA_CAPTURA'];
                                                                    $ANALISTA_META          = $row['ANALISTA_META'];
                                                                    $FECHA_PAGO             = $row['FECHA_PAGO'];
                                                                    $HORA_PAGO              = $row['HORA_PAGO'];
                                                                    $ESTATUS                = $row['ESTATUS'];
                                                                    
    
                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo $REFERENCIA?></td>
                                                                        <td><?php echo $PLANTA?></td>
                                                                        <td><?php echo $PROVEEDOR?></td>
                                                                        <td><?php echo $IMMEX_NAC?></td>
                                                                        <td><?php echo $TIPO_DE_OPERACION?></td>
                                                                        <td><a href="lineaTiempo.php?pedimento=<?php echo $NO_PEDIMENTO; ?>"><?php echo $NO_PEDIMENTO?></a></td>
                                                                        <td><?php echo $ANALISTA_META?></td>
                                                                        <td><?php echo str_replace("0000-00-00","",$FECHA_CAPTURA)." ".str_replace("00:00:00","",$HORA_CAPTURA)?></td>
                                                                    </tr>
                                                                <?php
                                                                }
                                                            ?>
                                                        </tbody>
                                                    <?php
                                                    }
                                                    if($parametro == 'Pagado'){
                                                    ?>
                                                        <thead>
                                                            <tr>   
                                                                <th>REFERENCIA</th>
                                                                <th>PLANTA</th>
                                                                <th>PROVEEDOR</th>
                                                                <th>IMMEX/NAC</th>
                                                                <th>TIPO_DE_OPERACION</th>
                                                                <th>NO_PEDIMENTO</th>
                                                                <th>FECHA_CAPTURA</th>
                                                                <th>ANALISTA_META</th>
                                                                <th>FECHA_PAGO</th>
                                                            </tr>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                while($row=mysqli_fetch_assoc($ejecuta_consulta)){
                                                                    $FECHA_PRIMER_CARGA     = $row['FECHA_PRIMER_CARGA'];
                                                                    $FECHA_INICIO           = $row['FECHA_INICIO'];
                                                                    $HORA_PRIMER_CARGA      = $row['HORA_PRIMER_CARGA'];
                                                                    $FECHA_ULTIMA_CARGA     = $row['FECHA_ULTIMA_CARGA'];
                                                                    $HORA_ULTIMA_CARGA      = $row['HORA_ULTIMA_CARGA'];
                                                                    $REFERENCIA             = $row['REFERENCIA'];
                                                                    $PLANTA                 = $row['PLANTA'];
                                                                    $PROVEEDOR              = $row['PROVEEDOR'];
                                                                    $IMMEX_NAC              = $row['IMMEX/NAC'];
                                                                    $TIPO_DE_OPERACION      = $row['TIPO_DE_OPERACION'];
                                                                    $NO_PEDIMENTO           = $row['NO_PEDIMENTO'];
                                                                    $FECHA_INCIDENCIA       = $row['FECHA_INCIDENCIA'];
                                                                    $HORA_INCIDENCIA        = $row['HORA_INCIDENCIA'];
                                                                    $FECHA_CONCILIADO       = $row['FECHA_CONCILIADO'];
                                                                    $HORA_CONCLIADO         = $row['HORA_CONCLIADO'];
                                                                    $FECHA_CAPTURA          = $row['FECHA_CAPTURA'];
                                                                    $HORA_CAPTURA           = $row['HORA_CAPTURA'];
                                                                    $ANALISTA_META          = $row['ANALISTA_META'];
                                                                    $FECHA_PAGO             = $row['FECHA_PAGO'];
                                                                    $HORA_PAGO              = $row['HORA_PAGO'];
                                                                    $ESTATUS                = $row['ESTATUS'];
                                                                    
    
                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo $REFERENCIA?></td>
                                                                        <td><?php echo $PLANTA?></td>
                                                                        <td><?php echo $PROVEEDOR?></td>
                                                                        <td><?php echo $IMMEX_NAC?></td>
                                                                        <td><?php echo $TIPO_DE_OPERACION?></td>
                                                                        <td><a href="lineaTiempo.php?pedimento=<?php echo $NO_PEDIMENTO; ?>"><?php echo $NO_PEDIMENTO?></a></td>
                                                                        <td><?php echo str_replace("0000-00-00","",$FECHA_CAPTURA)." ".str_replace("00:00:00","",$HORA_CAPTURA)?></td>
                                                                        <td><?php echo $ANALISTA_META?></td>
                                                                        <td><?php echo str_replace("0000-00-00","",$FECHA_PAGO)." ".str_replace("00:00:00","",$HORA_PAGO)?></td>
                                                                    </tr>
                                                                <?php
                                                                }
                                                            ?>
                                                        </tbody>
                                                    <?php
                                                    }
                                            }else{
                                                if($parametro == 'Sin Informacion'){
                                                ?>
                                                    <thead>
                                                        <tr>
                                                            <th></th>  
                                                            <th>REFERENCIA</th>
                                                            <th>PLANTA</th>
                                                            <th>PROVEEDOR</th>
                                                            <th>IMMEX/NAC</th>
                                                            <th>TIPO_DE_OPERACION</th>
                                                            <th>NO_PEDIMENTO</th>
                                                            <th>ANALISTA_META</th>
                                                        </tr>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            while($row=mysqli_fetch_assoc($ejecuta_consulta)){
                                                                $FECHA_PRIMER_CARGA     = $row['FECHA_PRIMER_CARGA'];
                                                                $HORA_PRIMER_CARGA      = $row['HORA_PRIMER_CARGA'];
                                                                $FECHA_ULTIMA_CARGA     = $row['FECHA_ULTIMA_CARGA'];
                                                                $HORA_ULTIMA_CARGA      = $row['HORA_ULTIMA_CARGA'];
                                                                $REFERENCIA             = $row['REFERENCIA'];
                                                                $PLANTA                 = $row['PLANTA'];
                                                                $PROVEEDOR              = $row['PROVEEDOR'];
                                                                $IMMEX_NAC              = $row['IMMEX/NAC'];
                                                                $TIPO_DE_OPERACION      = $row['TIPO_DE_OPERACION'];
                                                                $NO_PEDIMENTO           = $row['NO_PEDIMENTO'];
                                                                $FECHA_INCIDENCIA       = $row['FECHA_INCIDENCIA'];
                                                                $HORA_INCIDENCIA        = $row['HORA_INCIDENCIA'];
                                                                $FECHA_CONCILIADO       = $row['FECHA_CONCILIADO'];
                                                                $HORA_CONCLIADO         = $row['HORA_CONCLIADO'];
                                                                $FECHA_CAPTURA          = $row['FECHA_CAPTURA'];
                                                                $HORA_CAPTURA           = $row['HORA_CAPTURA'];
                                                                $ANALISTA_META          = $row['ANALISTA_META'];
                                                                $FECHA_PAGO             = $row['FECHA_PAGO'];
                                                                $HORA_PAGO              = $row['HORA_PAGO'];
                                                                $ESTATUS                = $row['ESTATUS'];
                                                                

                                                            ?>
                                                                <tr>
                                                                    <td>
                                                                    <input type="checkbox" id="check_<?php echo $NO_PEDIMENTO?>" name="folio2[]" value="<? echo $NO_PEDIMENTO?>" onClick="EliminaPed('<?php echo $NO_PEDIMENTO?>')">
                                                                    </td>
                                                                    <td><?php echo $REFERENCIA?></td>
                                                                    <td><?php echo $PLANTA?></td>
                                                                    <td><?php echo $PROVEEDOR?></td>
                                                                    <td><?php echo $IMMEX_NAC?></td>
                                                                    <td><?php echo $TIPO_DE_OPERACION?></td>
                                                                    <td><?php echo $NO_PEDIMENTO?></td>
                                                                    <td><?php echo $ANALISTA_META?></td>
                                                                </tr>
                                                            <?php
                                                            }
                                                        ?>
                                                    </tbody>
                                                <?php
                                                }
                                                if($parametro == 'Incidencia'){
                                                ?>
                                                    <thead>
                                                        <tr>  
                                                            <th>FECHA_INICIO</th>
                                                            <th>FECHA_PRIMER_CARGA</th>
                                                            <th>FECHA_ULTIMA_CARGA</th>  
                                                            <th>REFERENCIA</th>
                                                            <th>PLANTA</th>
                                                            <th>PROVEEDOR</th>
                                                            <th>IMMEX/NAC</th>
                                                            <th>TIPO_DE_OPERACION</th>
                                                            <th>NO_PEDIMENTO</th>
                                                            <th>ANALISTA_META</th>
                                                            <th>FECHA_INCIDENCIA</th>
                                                        </tr>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            while($row=mysqli_fetch_assoc($ejecuta_consulta)){
                                                                $FECHA_PRIMER_CARGA     = $row['FECHA_PRIMER_CARGA'];
                                                                $FECHA_INICIO           = $row['FECHA_INICIO'];
                                                                $HORA_PRIMER_CARGA      = $row['HORA_PRIMER_CARGA'];
                                                                $FECHA_ULTIMA_CARGA     = $row['FECHA_ULTIMA_CARGA'];
                                                                $HORA_ULTIMA_CARGA      = $row['HORA_ULTIMA_CARGA'];
                                                                $REFERENCIA             = $row['REFERENCIA'];
                                                                $PLANTA                 = $row['PLANTA'];
                                                                $PROVEEDOR              = $row['PROVEEDOR'];
                                                                $IMMEX_NAC              = $row['IMMEX/NAC'];
                                                                $TIPO_DE_OPERACION      = $row['TIPO_DE_OPERACION'];
                                                                $NO_PEDIMENTO           = $row['NO_PEDIMENTO'];
                                                                $FECHA_INCIDENCIA       = $row['FECHA_INCIDENCIA'];
                                                                $HORA_INCIDENCIA        = $row['HORA_INCIDENCIA'];
                                                                $FECHA_CONCILIADO       = $row['FECHA_CONCILIADO'];
                                                                $HORA_CONCLIADO         = $row['HORA_CONCLIADO'];
                                                                $FECHA_CAPTURA          = $row['FECHA_CAPTURA'];
                                                                $HORA_CAPTURA           = $row['HORA_CAPTURA'];
                                                                $ANALISTA_META          = $row['ANALISTA_META'];
                                                                $FECHA_PAGO             = $row['FECHA_PAGO'];
                                                                $HORA_PAGO              = $row['HORA_PAGO'];
                                                                $ESTATUS                = $row['ESTATUS'];
                                                                

                                                            ?>
                                                                <tr>
                                                                    <td><?php echo str_replace("0000-00-00","",$FECHA_INICIO) ?></td>
                                                                    <td><?php echo str_replace("0000-00-00","",$FECHA_PRIMER_CARGA)." ".str_replace("00:00:00","",$HORA_PRIMER_CARGA) ?></td>
                                                                    <td><?php echo str_replace("0000-00-00","",$FECHA_ULTIMA_CARGA)." ".str_replace("00:00:00","",$HORA_ULTIMA_CARGA)?></td>
                                                                    <td><?php echo $REFERENCIA?></td>
                                                                    <td><?php echo $PLANTA?></td>
                                                                    <td><?php echo $PROVEEDOR?></td>
                                                                    <td><?php echo $IMMEX_NAC?></td>
                                                                    <td><?php echo $TIPO_DE_OPERACION?></td>
                                                                    <td><a href="lineaTiempo.php?pedimento=<?php echo $NO_PEDIMENTO; ?>"><?php echo $NO_PEDIMENTO?></a></td>
                                                                    <td><?php echo $ANALISTA_META?></td>
                                                                    <td><?php echo str_replace("0000-00-00","",$FECHA_INCIDENCIA)." ".str_replace("00:00:00","",$HORA_INCIDENCIA)?></td>
                                                                </tr>
                                                            <?php
                                                            }
                                                        ?>
                                                    </tbody>
                                                <?php
                                                }
                                                if($parametro == 'Conciliado'){
                                                ?>
                                                    <thead>
                                                        <tr>
                                                            <th>FECHA_INICIO</th>
                                                            <th>FECHA_PRIMER_CARGA</th>
                                                            <th>FECHA_ULTIMA_CARGA</th>    
                                                            <th>REFERENCIA</th>
                                                            <th>PLANTA</th>
                                                            <th>PROVEEDOR</th>
                                                            <th>IMMEX/NAC</th>
                                                            <th>TIPO_DE_OPERACION</th>
                                                            <th>NO_PEDIMENTO</th>
                                                            <th>ANALISTA_META</th>
                                                            <th>FECHA_CONCILIADO</th>
                                                        </tr>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            while($row=mysqli_fetch_assoc($ejecuta_consulta)){
                                                                $FECHA_PRIMER_CARGA     = $row['FECHA_PRIMER_CARGA'];
                                                                $FECHA_INICIO           = $row['FECHA_INICIO'];
                                                                $HORA_PRIMER_CARGA      = $row['HORA_PRIMER_CARGA'];
                                                                $FECHA_ULTIMA_CARGA     = $row['FECHA_ULTIMA_CARGA'];
                                                                $HORA_ULTIMA_CARGA      = $row['HORA_ULTIMA_CARGA'];
                                                                $REFERENCIA             = $row['REFERENCIA'];
                                                                $PLANTA                 = $row['PLANTA'];
                                                                $PROVEEDOR              = $row['PROVEEDOR'];
                                                                $IMMEX_NAC              = $row['IMMEX/NAC'];
                                                                $TIPO_DE_OPERACION      = $row['TIPO_DE_OPERACION'];
                                                                $NO_PEDIMENTO           = $row['NO_PEDIMENTO'];
                                                                $FECHA_INCIDENCIA       = $row['FECHA_INCIDENCIA'];
                                                                $HORA_INCIDENCIA        = $row['HORA_INCIDENCIA'];
                                                                $FECHA_CONCILIADO       = $row['FECHA_CONCILIADO'];
                                                                $HORA_CONCLIADO         = $row['HORA_CONCLIADO'];
                                                                $FECHA_CAPTURA          = $row['FECHA_CAPTURA'];
                                                                $HORA_CAPTURA           = $row['HORA_CAPTURA'];
                                                                $ANALISTA_META          = $row['ANALISTA_META'];
                                                                $FECHA_PAGO             = $row['FECHA_PAGO'];
                                                                $HORA_PAGO              = $row['HORA_PAGO'];
                                                                $ESTATUS                = $row['ESTATUS'];
                                                                

                                                            ?>
                                                                <tr>
                                                                    <td><?php echo str_replace("0000-00-00","",$FECHA_INICIO) ?></td>    
                                                                    <td><?php echo str_replace("0000-00-00","",$FECHA_PRIMER_CARGA)." ".str_replace("00:00:00","",$HORA_PRIMER_CARGA) ?></td>
                                                                    <td><?php echo str_replace("0000-00-00","",$FECHA_ULTIMA_CARGA)." ".str_replace("00:00:00","",$HORA_ULTIMA_CARGA)?></td>
                                                                    <td><?php echo $REFERENCIA?></td>
                                                                    <td><?php echo $PLANTA?></td>
                                                                    <td><?php echo $PROVEEDOR?></td>
                                                                    <td><?php echo $IMMEX_NAC?></td>
                                                                    <td><?php echo $TIPO_DE_OPERACION?></td>
                                                                    <td><a href="lineaTiempo.php?pedimento=<?php echo $NO_PEDIMENTO; ?>"><?php echo $NO_PEDIMENTO?></a></td>
                                                                    <td><?php echo $ANALISTA_META?></td>
                                                                    <td><?php echo str_replace("0000-00-00","",$FECHA_CONCILIADO)." ".str_replace("00:00:00","",$HORA_CONCLIADO)?></td>
                                                                </tr>
                                                            <?php
                                                            }
                                                        ?>
                                                    </tbody>
                                                <?php
                                                }
                                                if($parametro == 'En Captura'){
                                                ?>
                                                    <thead>
                                                        <tr>
                                                            <th>FECHA_INICIO</th>
                                                            <th>FECHA_PRIMER_CARGA</th>
                                                            <th>FECHA_ULTIMA_CARGA</th>    
                                                            <th>REFERENCIA</th>
                                                            <th>PLANTA</th>
                                                            <th>PROVEEDOR</th>
                                                            <th>IMMEX/NAC</th>
                                                            <th>TIPO_DE_OPERACION</th>
                                                            <th>NO_PEDIMENTO</th>
                                                            <th>ANALISTA_META</th>
                                                            <th>FECHA_CONCILIADO</th>
                                                            <th>FECHA_CAPTURA</th>
                                                        </tr>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            while($row=mysqli_fetch_assoc($ejecuta_consulta)){
                                                                $FECHA_PRIMER_CARGA     = $row['FECHA_PRIMER_CARGA'];
                                                                $FECHA_INICIO           = $row['FECHA_INICIO'];
                                                                $HORA_PRIMER_CARGA      = $row['HORA_PRIMER_CARGA'];
                                                                $FECHA_ULTIMA_CARGA     = $row['FECHA_ULTIMA_CARGA'];
                                                                $HORA_ULTIMA_CARGA      = $row['HORA_ULTIMA_CARGA'];
                                                                $REFERENCIA             = $row['REFERENCIA'];
                                                                $PLANTA                 = $row['PLANTA'];
                                                                $PROVEEDOR              = $row['PROVEEDOR'];
                                                                $IMMEX_NAC              = $row['IMMEX/NAC'];
                                                                $TIPO_DE_OPERACION      = $row['TIPO_DE_OPERACION'];
                                                                $NO_PEDIMENTO           = $row['NO_PEDIMENTO'];
                                                                $FECHA_INCIDENCIA       = $row['FECHA_INCIDENCIA'];
                                                                $HORA_INCIDENCIA        = $row['HORA_INCIDENCIA'];
                                                                $FECHA_CONCILIADO       = $row['FECHA_CONCILIADO'];
                                                                $HORA_CONCLIADO         = $row['HORA_CONCLIADO'];
                                                                $FECHA_CAPTURA          = $row['FECHA_CAPTURA'];
                                                                $HORA_CAPTURA           = $row['HORA_CAPTURA'];
                                                                $ANALISTA_META          = $row['ANALISTA_META'];
                                                                $FECHA_PAGO             = $row['FECHA_PAGO'];
                                                                $HORA_PAGO              = $row['HORA_PAGO'];
                                                                $ESTATUS                = $row['ESTATUS'];
                                                                

                                                            ?>
                                                                <tr>
                                                                    <td><?php echo str_replace("0000-00-00","",$FECHA_INICIO) ?></td>
                                                                    <td><?php echo str_replace("0000-00-00","",$FECHA_PRIMER_CARGA)." ".str_replace("00:00:00","",$HORA_PRIMER_CARGA) ?></td>
                                                                    <td><?php echo str_replace("0000-00-00","",$FECHA_ULTIMA_CARGA)." ".str_replace("00:00:00","",$HORA_ULTIMA_CARGA)?></td>
                                                                    <td><?php echo $REFERENCIA?></td>
                                                                    <td><?php echo $PLANTA?></td>
                                                                    <td><?php echo $PROVEEDOR?></td>
                                                                    <td><?php echo $IMMEX_NAC?></td>
                                                                    <td><?php echo $TIPO_DE_OPERACION?></td>
                                                                    <td><a href="lineaTiempo.php?pedimento=<?php echo $NO_PEDIMENTO; ?>"><?php echo $NO_PEDIMENTO?></a></td>
                                                                    <td><?php echo $ANALISTA_META?></td>
                                                                    <td><?php echo str_replace("0000-00-00","",$FECHA_CONCILIADO)." ".str_replace("00:00:00","",$HORA_CONCLIADO)?></td>
                                                                    <td><?php echo str_replace("0000-00-00","",$FECHA_CAPTURA)." ".str_replace("00:00:00","",$HORA_CAPTURA)?></td>
                                                                </tr>
                                                            <?php
                                                            }
                                                        ?>
                                                    </tbody>
                                                <?php
                                                }
                                                if($parametro == 'Pagado'){
                                                ?>
                                                    <thead>
                                                        <tr>   
                                                            <th>FECHA_INICIO</th> 
                                                            <th>FECHA_PRIMER_CARGA</th>
                                                            <th>FECHA_ULTIMA_CARGA</th>
                                                            <th>REFERENCIA</th>
                                                            <th>PLANTA</th>
                                                            <th>PROVEEDOR</th>
                                                            <th>IMMEX/NAC</th>
                                                            <th>TIPO_DE_OPERACION</th>
                                                            <th>NO_PEDIMENTO</th>
                                                            <th>FECHA_INCIDENCIA</th>
                                                            <th>FECHA_CONCILIADO</th>
                                                            <th>FECHA_CAPTURA</th>
                                                            <th>ANALISTA_META</th>
                                                            <th>FECHA_PAGO</th>
                                                        </tr>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            while($row=mysqli_fetch_assoc($ejecuta_consulta)){
                                                                $FECHA_PRIMER_CARGA     = $row['FECHA_PRIMER_CARGA'];
                                                                $FECHA_INICIO           = $row['FECHA_INICIO'];
                                                                $HORA_PRIMER_CARGA      = $row['HORA_PRIMER_CARGA'];
                                                                $FECHA_ULTIMA_CARGA     = $row['FECHA_ULTIMA_CARGA'];
                                                                $HORA_ULTIMA_CARGA      = $row['HORA_ULTIMA_CARGA'];
                                                                $REFERENCIA             = $row['REFERENCIA'];
                                                                $PLANTA                 = $row['PLANTA'];
                                                                $PROVEEDOR              = $row['PROVEEDOR'];
                                                                $IMMEX_NAC              = $row['IMMEX/NAC'];
                                                                $TIPO_DE_OPERACION      = $row['TIPO_DE_OPERACION'];
                                                                $NO_PEDIMENTO           = $row['NO_PEDIMENTO'];
                                                                $FECHA_INCIDENCIA       = $row['FECHA_INCIDENCIA'];
                                                                $HORA_INCIDENCIA        = $row['HORA_INCIDENCIA'];
                                                                $FECHA_CONCILIADO       = $row['FECHA_CONCILIADO'];
                                                                $HORA_CONCLIADO         = $row['HORA_CONCLIADO'];
                                                                $FECHA_CAPTURA          = $row['FECHA_CAPTURA'];
                                                                $HORA_CAPTURA           = $row['HORA_CAPTURA'];
                                                                $ANALISTA_META          = $row['ANALISTA_META'];
                                                                $FECHA_PAGO             = $row['FECHA_PAGO'];
                                                                $HORA_PAGO              = $row['HORA_PAGO'];
                                                                $ESTATUS                = $row['ESTATUS'];
                                                                

                                                            ?>
                                                                <tr>
                                                                    <td><?php echo str_replace("0000-00-00","",$FECHA_INICIO) ?></td>
                                                                    <td><?php echo str_replace("0000-00-00","",$FECHA_PRIMER_CARGA)." ".str_replace("00:00:00","",$HORA_PRIMER_CARGA) ?></td>
                                                                    <td><?php echo str_replace("0000-00-00","",$FECHA_ULTIMA_CARGA)." ".str_replace("00:00:00","",$HORA_ULTIMA_CARGA)?></td>
                                                                    <td><?php echo $REFERENCIA?></td>
                                                                    <td><?php echo $PLANTA?></td>
                                                                    <td><?php echo $PROVEEDOR?></td>
                                                                    <td><?php echo $IMMEX_NAC?></td>
                                                                    <td><?php echo $TIPO_DE_OPERACION?></td>
                                                                    <td><a href="lineaTiempo.php?pedimento=<?php echo $NO_PEDIMENTO; ?>"><?php echo $NO_PEDIMENTO?></a></td>
                                                                    <td><?php echo str_replace("0000-00-00","",$FECHA_INCIDENCIA)." ".str_replace("00:00:00","",$HORA_INCIDENCIA)?></td>
                                                                    <td><?php echo str_replace("0000-00-00","",$FECHA_CONCILIADO)." ".str_replace("00:00:00","",$HORA_CONCLIADO)?></td>
                                                                    <td><?php echo str_replace("0000-00-00","",$FECHA_CAPTURA)." ".str_replace("00:00:00","",$HORA_CAPTURA)?></td>
                                                                    <td><?php echo $ANALISTA_META?></td>
                                                                    <td><?php echo str_replace("0000-00-00","",$FECHA_PAGO)." ".str_replace("00:00:00","",$HORA_PAGO)?></td>
                                                                </tr>
                                                            <?php
                                                            }
                                                        ?>
                                                    </tbody>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
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

    <!-- Custom Theme Scripts -->
    <script src="includes/build/js/custom.js"></script>
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