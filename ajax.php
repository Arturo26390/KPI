<?php
include("includes/conexiones.php");
$datos =$_POST['datos'];

if($datos=='1'){
    $planta =$_POST['planta'];
    $tipo_pedimento =$_POST['tipo_pedimento'];
    if($planta!="0"){
        if(strlen($planta)>0){
            $concatenar1 = "  WHERE PLANTA = '".$planta."'";
        }else{
            $concatenar1 = '';
        }
        if($tipo_pedimento!="0"){
            $concatenar2 = " AND TIPO_DE_OPERACION = '".$tipo_pedimento."'";
        }else{
            $concatenar2 = '';
        }
    }else{
        $concatenar1 = '';
        if($tipo_pedimento!="0"){
            $concatenar2 = " WHERE TIPO_DE_OPERACION = '".$tipo_pedimento."'";
        }else{
            $concatenar2 = '';
        }
    }
    if($planta=='0' && $tipo_pedimento=='0'){
        $concatenar3 = 'WHERE ';
    }else{
        if(strlen($planta)>0){
            $concatenar3 = 'AND ';
        }else{
            $concatenar3 = 'WHERE ';
        }
       
    }

    
    $fecha1=$_POST['fecha1'];
    $fecha2=$_POST['fecha2'];
    $mes=$_POST['mes'];
    if(isset($_POST['semana'])){
        if($_POST['semana'] == ''){
            $semana_concatenada = '-';
            $semana = '-';
        }else{
            $semana_concatenada=str_replace("W","",$_POST['semana']);
            $vector_semana = explode("-",$semana_concatenada);
            $semana=$vector_semana[1]."-".$vector_semana[0];
        }
    }else{
        $semana_concatenada = '-';
        $semana = '-';
    }
    


    if(strlen($fecha1)>0 && strlen($fecha2)>0){
         $consulta="SELECT 
        (SELECT COUNT(NO_PEDIMENTO) FROM DATOS_GRAFICAS ".$concatenar1."".$concatenar2." ".$concatenar3."FECHA_PAGO BETWEEN '".$fecha1."' AND '".$fecha2."') AS TOTAL,
        (SELECT COUNT(NO_PEDIMENTO) FROM DATOS_GRAFICAS ".$concatenar1."".$concatenar2." ".$concatenar3."ESTATUS = 'Sin Informacion' AND FECHA_PAGO BETWEEN '".$fecha1."' AND '".$fecha2."') AS SIN_INFORMACION,
        (SELECT COUNT(NO_PEDIMENTO) FROM DATOS_GRAFICAS ".$concatenar1."".$concatenar2." ".$concatenar3."ESTATUS = 'Incidencia' AND FECHA_PAGO BETWEEN '".$fecha1."' AND '".$fecha2."') AS INCIDENCIA,
        (SELECT COUNT(NO_PEDIMENTO) FROM DATOS_GRAFICAS ".$concatenar1."".$concatenar2." ".$concatenar3."ESTATUS = 'Conciliado' AND FECHA_PAGO BETWEEN '".$fecha1."' AND '".$fecha2."') AS CONCILIADO,
        (SELECT COUNT(NO_PEDIMENTO) FROM DATOS_GRAFICAS ".$concatenar1."".$concatenar2." ".$concatenar3."ESTATUS = 'En Captura' AND FECHA_PAGO BETWEEN '".$fecha1."' AND '".$fecha2."') AS EN_CAPTURA,
        (SELECT COUNT(NO_PEDIMENTO) FROM DATOS_GRAFICAS ".$concatenar1."".$concatenar2." ".$concatenar3."ESTATUS = 'Pagado' AND FECHA_PAGO BETWEEN '".$fecha1."' AND '".$fecha2."') AS PAGADO";
    }else{
        if(strlen($mes)>1){
            $consulta="SELECT 
            (SELECT COUNT(NO_PEDIMENTO) FROM DATOS_GRAFICAS ".$concatenar1."".$concatenar2." ".$concatenar3."MES_CIERRE = '".$mes."') AS TOTAL,
            (SELECT COUNT(NO_PEDIMENTO) FROM DATOS_GRAFICAS ".$concatenar1."".$concatenar2." ".$concatenar3."ESTATUS = 'Sin Informacion' AND MES_CIERRE = '".$mes."') AS SIN_INFORMACION,
            (SELECT COUNT(NO_PEDIMENTO) FROM DATOS_GRAFICAS ".$concatenar1."".$concatenar2." ".$concatenar3."ESTATUS = 'Incidencia' AND MES_CIERRE = '".$mes."') AS INCIDENCIA,
            (SELECT COUNT(NO_PEDIMENTO) FROM DATOS_GRAFICAS ".$concatenar1."".$concatenar2." ".$concatenar3."ESTATUS = 'Conciliado' AND MES_CIERRE = '".$mes."') AS CONCILIADO,
            (SELECT COUNT(NO_PEDIMENTO) FROM DATOS_GRAFICAS ".$concatenar1."".$concatenar2." ".$concatenar3."ESTATUS = 'En Captura' AND MES_CIERRE = '".$mes."') AS EN_CAPTURA,
            (SELECT COUNT(NO_PEDIMENTO) FROM DATOS_GRAFICAS ".$concatenar1."".$concatenar2." ".$concatenar3."ESTATUS = 'Pagado' AND MES_CIERRE = '".$mes."') AS PAGADO";
        }
        else{
            if(strlen($semana)>1){
                $consulta="SELECT 
                (SELECT COUNT(NO_PEDIMENTO) FROM DATOS_GRAFICAS ".$concatenar1."".$concatenar2." ".$concatenar3."MES_CIERRE = '".$semana."') AS TOTAL,
                (SELECT COUNT(NO_PEDIMENTO) FROM DATOS_GRAFICAS ".$concatenar1."".$concatenar2." ".$concatenar3."ESTATUS = 'Sin Informacion' AND MES_CIERRE = '".$semana."') AS SIN_INFORMACION,
                (SELECT COUNT(NO_PEDIMENTO) FROM DATOS_GRAFICAS ".$concatenar1."".$concatenar2." ".$concatenar3."ESTATUS = 'Incidencia' AND MES_CIERRE = '".$semana."') AS INCIDENCIA,
                (SELECT COUNT(NO_PEDIMENTO) FROM DATOS_GRAFICAS ".$concatenar1."".$concatenar2." ".$concatenar3."ESTATUS = 'Conciliado' AND MES_CIERRE = '".$semana."') AS CONCILIADO,
                (SELECT COUNT(NO_PEDIMENTO) FROM DATOS_GRAFICAS ".$concatenar1."".$concatenar2." ".$concatenar3."ESTATUS = 'En Captura' AND MES_CIERRE = '".$semana."') AS EN_CAPTURA,
                (SELECT COUNT(NO_PEDIMENTO) FROM DATOS_GRAFICAS ".$concatenar1."".$concatenar2." ".$concatenar3."ESTATUS = 'Pagado' AND MES_CIERRE = '".$semana."') AS PAGADO";
            }else{
                $consulta="SELECT 
                (SELECT COUNT(NO_PEDIMENTO) FROM DATOS_GRAFICAS ".$concatenar1."".$concatenar2.") AS TOTAL,
                (SELECT COUNT(NO_PEDIMENTO) FROM DATOS_GRAFICAS ".$concatenar1."".$concatenar2." ".$concatenar3."ESTATUS = 'Sin Informacion') AS SIN_INFORMACION,
                (SELECT COUNT(NO_PEDIMENTO) FROM DATOS_GRAFICAS ".$concatenar1."".$concatenar2." ".$concatenar3."ESTATUS = 'Incidencia') AS INCIDENCIA,
                (SELECT COUNT(NO_PEDIMENTO) FROM DATOS_GRAFICAS ".$concatenar1."".$concatenar2." ".$concatenar3."ESTATUS = 'Conciliado') AS CONCILIADO,
                (SELECT COUNT(NO_PEDIMENTO) FROM DATOS_GRAFICAS ".$concatenar1."".$concatenar2." ".$concatenar3."ESTATUS = 'En Captura') AS EN_CAPTURA,
                (SELECT COUNT(NO_PEDIMENTO) FROM DATOS_GRAFICAS ".$concatenar1."".$concatenar2." ".$concatenar3."ESTATUS = 'Pagado') AS PAGADO";
            }
        }
    }
   
    //echo $consulta;

    $ejecuta_consulta = mysqli_query($con_116, $consulta);
    $row=mysqli_fetch_assoc($ejecuta_consulta);
    $total = $row['TOTAL'];
    $sin_informacion = $row['SIN_INFORMACION'];
    $incidencia = $row['INCIDENCIA'];
    $conciliado = $row['CONCILIADO'];
    $en_captura = $row['EN_CAPTURA'];
    $pagado = $row['PAGADO'];


    if(strlen($fecha1)>0 && strlen($fecha2)>0){
        echo $total."|".$sin_informacion."|".$incidencia."|".$conciliado."|".$en_captura."|".$pagado."|".$planta."|".$tipo_pedimento."|".$fecha1."|".$fecha2;
    }else{
        if(strlen($mes)>1){
            echo $total."|".$sin_informacion."|".$incidencia."|".$conciliado."|".$en_captura."|".$pagado."|".$planta."|".$tipo_pedimento."|".$mes."|0";
        }else{
            if(strlen($semana)>1){
                echo $total."|".$sin_informacion."|".$incidencia."|".$conciliado."|".$en_captura."|".$pagado."|".$planta."|".$tipo_pedimento."|".$semana."|0";
            }else{
                echo $total."|".$sin_informacion."|".$incidencia."|".$conciliado."|".$en_captura."|".$pagado."|".$planta."|".$tipo_pedimento."|".$fecha1."|".$fecha2;
            }   
        }
    }
   
    

}elseif($datos=='2'){
    $cantidades =$_POST['cantidades'];
    $vector_cantidades=explode("|",$cantidades);
    $total = $vector_cantidades[0];
    if($total>0){
        $informacion = round(($vector_cantidades[1] * 100) / $total);
        $incidencia =  round(($vector_cantidades[2] * 100) / $total);
        $conciliado =  round(($vector_cantidades[3] * 100) / $total);
        $captura =  round(($vector_cantidades[4] * 100) / $total);
        $pagado =  round((intval($vector_cantidades[5]) * 100) / $total);
    }else{
        $informacion = 0;
        $incidencia =  0;
        $conciliado =  0;
        $captura =  0;
        $pagado =  0;
    }
    
    $planta =  $vector_cantidades[6];
    $tipo_pedimento =  $vector_cantidades[7];

    if($vector_cantidades[9] == 0){
        $mes = $vector_cantidades[8];
        $fecha1 =  "";
        $fecha2 = "";
    }else{
        $fecha1 =  $vector_cantidades[8];
        $fecha2 =  $vector_cantidades[9];
        $mes =  "";
    }
    
    if($planta == '0'){
        if($tipo_pedimento=='0'){
            if(strlen($fecha1)>0 && strlen($fecha2)>0){
                $consulta_cantidades = "SELECT TIPO_DE_OPERACION, COUNT(TIPO_DE_OPERACION) AS CANTIDAD FROM DATOS_GRAFICAS WHERE ESTATUS = 'Pagado' AND FECHA_PAGO BETWEEN '".$fecha1."' AND '".$fecha2."' GROUP BY TIPO_DE_OPERACION";
            }else{
                if(strlen($mes)>0){
                    $consulta_cantidades = "SELECT TIPO_DE_OPERACION, COUNT(TIPO_DE_OPERACION) AS CANTIDAD FROM DATOS_GRAFICAS WHERE ESTATUS = 'Pagado' GROUP BY TIPO_DE_OPERACION AND MES_CIERRE = '".$mes."'";
                }else{
                    $consulta_cantidades = "SELECT TIPO_DE_OPERACION, COUNT(TIPO_DE_OPERACION) AS CANTIDAD FROM DATOS_GRAFICAS WHERE ESTATUS = 'Pagado' GROUP BY TIPO_DE_OPERACION";
                }
            }
        }else{
            if(strlen($fecha1)>0 && strlen($fecha2)>0){
                $consulta_cantidades = "SELECT TIPO_DE_OPERACION, COUNT(TIPO_DE_OPERACION) AS CANTIDAD FROM DATOS_GRAFICAS WHERE ESTATUS = 'Pagado' AND TIPO_DE_OPERACION = '".$tipo_pedimento."' AND FECHA_PAGO BETWEEN '".$fecha1."' AND '".$fecha2."' GROUP BY TIPO_DE_OPERACION";
            }else{
                if(strlen($mes)>0){
                    $consulta_cantidades = "SELECT TIPO_DE_OPERACION, COUNT(TIPO_DE_OPERACION) AS CANTIDAD FROM DATOS_GRAFICAS WHERE ESTATUS = 'Pagado' AND TIPO_DE_OPERACION = '".$tipo_pedimento."' AND MES_CIERRE = '".$mes."' GROUP BY TIPO_DE_OPERACION ";
                }else{
                    $consulta_cantidades = "SELECT TIPO_DE_OPERACION, COUNT(TIPO_DE_OPERACION) AS CANTIDAD FROM DATOS_GRAFICAS WHERE ESTATUS = 'Pagado' AND TIPO_DE_OPERACION = '".$tipo_pedimento."' GROUP BY TIPO_DE_OPERACION";
                }
            } 
        }
    }else{
        if($tipo_pedimento=='0'){
            if(strlen($fecha1)>0 && strlen($fecha2)>0){
                $consulta_cantidades = "SELECT TIPO_DE_OPERACION, COUNT(TIPO_DE_OPERACION) AS CANTIDAD FROM DATOS_GRAFICAS WHERE ESTATUS = 'Pagado' AND PLANTA = '".$planta."' AND FECHA_PAGO BETWEEN '".$fecha1."' AND '".$fecha2."' GROUP BY TIPO_DE_OPERACION";
            }else{
                if(strlen($mes)>0){
                    $consulta_cantidades = "SELECT TIPO_DE_OPERACION, COUNT(TIPO_DE_OPERACION) AS CANTIDAD FROM DATOS_GRAFICAS WHERE ESTATUS = 'Pagado' AND PLANTA = '".$planta."' AND MES_CIERRE = '".$mes."' GROUP BY TIPO_DE_OPERACION";
                }else{
                    $consulta_cantidades = "SELECT TIPO_DE_OPERACION, COUNT(TIPO_DE_OPERACION) AS CANTIDAD FROM DATOS_GRAFICAS WHERE ESTATUS = 'Pagado' AND PLANTA = '".$planta."' GROUP BY TIPO_DE_OPERACION";
                }
            }
        }else{
            if(strlen($fecha1)>0 && strlen($fecha2)>0){
                $consulta_cantidades = "SELECT TIPO_DE_OPERACION, COUNT(TIPO_DE_OPERACION) AS CANTIDAD FROM DATOS_GRAFICAS WHERE ESTATUS = 'Pagado' AND TIPO_DE_OPERACION = '".$tipo_pedimento."' AND PLANTA = '".$planta."' AND FECHA_PAGO BETWEEN '".$fecha1."' AND '".$fecha2."' GROUP BY TIPO_DE_OPERACION";
            }else{
                if(strlen($mes)>0){
                    $consulta_cantidades = "SELECT TIPO_DE_OPERACION, COUNT(TIPO_DE_OPERACION) AS CANTIDAD FROM DATOS_GRAFICAS WHERE ESTATUS = 'Pagado' AND TIPO_DE_OPERACION = '".$tipo_pedimento."' AND PLANTA = '".$planta."' AND MES_CIERRE = '".$mes."' GROUP BY TIPO_DE_OPERACION";
                }else{
                    $consulta_cantidades = "SELECT TIPO_DE_OPERACION, COUNT(TIPO_DE_OPERACION) AS CANTIDAD FROM DATOS_GRAFICAS WHERE ESTATUS = 'Pagado' AND TIPO_DE_OPERACION = '".$tipo_pedimento."' AND PLANTA = '".$planta."' GROUP BY TIPO_DE_OPERACION";
                }
            }
        }
    }
    //echo $consulta_cantidades;
    $ejecuta_consulta_cantidades = mysqli_query($con_116, $consulta_cantidades);
?>
<div class="centro1">
    <div class="col-md-4 col-sm-6 ">
        <div class="">
            <div class="x_content">
                <h2>Cuadro de Resumen</h2>
                <br>
                <?php  
                while($row_cantidades=mysqli_fetch_assoc($ejecuta_consulta_cantidades)){
                ?>
                <div class="widget_summary">
                    <div class="w_left w_25">
                    <p><?php echo $row_cantidades['TIPO_DE_OPERACION'];  ?></p>
                    </div>
                    <div class="w_center w_55">
                    <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $row_cantidades['CANTIDAD'];  ?>%;">
                        </div>
                    </div>
                    </div>
                    <div class="w_right w_20">
                    <p><?php echo $row_cantidades['CANTIDAD'];  ?></p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <?php 
                }
                ?>
            </div>
        </div>
    </div>
</div>
    <?php
    
}
?>
    