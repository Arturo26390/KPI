<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Reporte</title>
</head>

<body>
<?php
require_once 'PHPExcel.php';
include 'PHPExcel/IOFactory.php';
include("includes/conexiones.php");


//$parametro=$_GET["parametro"];
$planta_=$_GET["planta"];
$tipo_pedimento=$_GET["tipo_pedimento"];
$fecha1=$_GET['fecha1'];
$fecha2=$_GET['fecha2'];
$mes=$_GET['mes'];
if($mes == '-'){
	$mes = '';
}

//$semana=$_GET['semana'];

if(isset($_GET['semana'])){
	if($_GET['semana'] == ''){
		$semana_concatenada = '-';
		$semana = '-';
	}else{
		$semana_concatenada=str_replace("W","",$_GET['semana']);
		$vector_semana = explode("-",$semana_concatenada);
		$semana=$vector_semana[1]."-".$vector_semana[0];
	}
}else{
	$semana_concatenada = '-';
	$semana = '-';
}

if($semana == '-'){
	$semana = '';
}

if($planta_ == "0"){
	if($tipo_pedimento == "0"){
		if($fecha1 == '' || $fecha2 == ''){
			if($mes != ''){
				$consulta="SELECT * FROM DATOS_GRAFICAS WHERE MES_CIERRE = '".$mes."'";
			}else{
				if($semana != ''){
					$consulta="SELECT * FROM DATOS_GRAFICAS WHERE MES_CIERRE = '".$semana."'";
				}else{
					$consulta="SELECT * FROM DATOS_GRAFICAS";
				}
			}
		}else{
			$consulta="SELECT * FROM DATOS_GRAFICAS WHERE FECHA_PAGO BETWEEN '".$fecha1."' AND '".$fecha2."'";
		}
	}else{
		if($fecha1 == '' || $fecha2 == ''){
			if($mes != ''){
				$consulta="SELECT * FROM DATOS_GRAFICAS WHERE MES_CIERRE = '".$mes."' AND TIPO_DE_OPERACION = '".$tipo_pedimento."'";
			}else{
				if($semana != ''){
					$consulta="SELECT * FROM DATOS_GRAFICAS WHERE MES_CIERRE = '".$semana."' AND TIPO_DE_OPERACION = '".$tipo_pedimento."'";
				}else{
					$consulta="SELECT * FROM DATOS_GRAFICAS WHERE TIPO_DE_OPERACION = '".$tipo_pedimento."'";
				}
			}
		}else{
			$consulta="SELECT * FROM DATOS_GRAFICAS WHERE FECHA_PAGO BETWEEN '".$fecha1."' AND '".$fecha2."' AND TIPO_DE_OPERACION = '".$tipo_pedimento."'";
		}
	}
}else{
	if($tipo_pedimento == "0"){
		if($fecha1 == '' || $fecha2 == ''){
			if($mes != ''){
				$consulta="SELECT * FROM DATOS_GRAFICAS WHERE MES_CIERRE = '".$mes."' AND PLANTA = '".$planta_."'";
			}else{
				if($semana != ''){
					$consulta="SELECT * FROM DATOS_GRAFICAS WHERE MES_CIERRE = '".$semana."' AND PLANTA = '".$planta_."'";
				}else{
					$consulta="SELECT * FROM DATOS_GRAFICAS WHERE PLANTA = '".$planta_."'";
				}
			}
		}else{
			$consulta="SELECT * FROM DATOS_GRAFICAS WHERE FECHA_PAGO BETWEEN '".$fecha1."' AND '".$fecha2."' AND PLANTA = '".$planta_."'";
		}
	}else{
		if($fecha1 == '' || $fecha2 == ''){
			if($mes != ''){
				$consulta="SELECT * FROM DATOS_GRAFICAS WHERE MES_CIERRE = '".$mes."' AND TIPO_DE_OPERACION = '".$tipo_pedimento."' AND PLANTA = '".$planta_."'";
			}else{
				if($semana != ''){
					$consulta="SELECT * FROM DATOS_GRAFICAS WHERE MES_CIERRE = '".$semana."' AND TIPO_DE_OPERACION = '".$tipo_pedimento."' AND PLANTA = '".$planta_."'";
				}else{
					$consulta="SELECT * FROM DATOS_GRAFICAS WHERE TIPO_DE_OPERACION = '".$tipo_pedimento."' AND PLANTA = '".$planta_."'";
				}
			}
		}else{
			$consulta="SELECT * FROM DATOS_GRAFICAS WHERE FECHA_PAGO BETWEEN '".$fecha1."' AND '".$fecha2."' AND TIPO_DE_OPERACION = '".$tipo_pedimento."' AND PLANTA = '".$planta_."'";
		}
	}
}

//echo $consulta;


$ejecuta_consulta = mysqli_query($con_116, $consulta);


$select_hoy = "SELECT CURDATE() AS FECHA_HOY";
$ejecuta_select_hoy = mysqli_query($con_116, $select_hoy);
$row_hoy=mysqli_fetch_assoc($ejecuta_select_hoy);
$fecha_hoy     = $row_hoy['FECHA_HOY'];

$objPHPExcel = new PHPExcel();
$objPHPExcel->createSheet(1);


$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1','FECHA_PRIMER_CARGA')
->setCellValue('B1','FECHA_ULTIMA_CARGA')
->setCellValue('C1','REFERENCIA')
->setCellValue('D1','PLANTA')
->setCellValue('E1','PROVEEDOR')
->setCellValue('F1','IMMEX/NAC')
->setCellValue('G1','TIPO_DE_OPERACION')
->setCellValue('H1','NO_PEDIMENTO')
->setCellValue('I1','FECHA_INCIDENCIA')
->setCellValue('J1','FECHA_CONCILIADO')
->setCellValue('K1','FECHA_CAPTURA')
->setCellValue('L1','ANALISTA_META')
->setCellValue('M1','FECHA_PAGO')
->setCellValue('N1','ESTATUS')
;
$contador=2;


while($row=mysqli_fetch_assoc($ejecuta_consulta)){
	$FECHA_PRIMER_CARGA     = $row['FECHA_PRIMER_CARGA'];
	$FECHA_INICIO     = $row['FECHA_INICIO'];
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

	
	$objPHPExcel->getActiveSheet()->setTitle('RELACION'); 
	$objPHPExcel->getActiveSheet()->getStyle('A1:N1')->getFill()->applyFromArray(array(
		'type'       => PHPExcel_Style_Fill::FILL_SOLID,
		'startcolor' => array('rgb' => '3F78AC'),
		'endcolor'   => array('rgb' => '3F78AC')
	));
	$objPHPExcel->getActiveSheet()->getStyle('A1:N1')->applyFromArray(array(
		'font' => array(
			'name' => 'Arial',
			'size' => 8,
			'bold' => true,
			'color' => array(
				'rgb' => 'FFFFFF'
			),
		),
	));
	
	$objPHPExcel->getActiveSheet()->getStyle('A'.$contador.':N'.$contador)->applyFromArray(array('font' => array(
																										'name' => 'Arial', 'size' => 8,
																										'bold' => false, 'color' => array(
																											'rgb' => '000000'
																										), ), 'numberformat' => array(
																										'code' => '@',
																										), ));
	
	$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$contador, str_replace("0000-00-00","",$FECHA_PRIMER_CARGA)." ".str_replace("00:00:00","",$HORA_PRIMER_CARGA))
			->setCellValue('B'.$contador, str_replace("0000-00-00","",$FECHA_ULTIMA_CARGA)." ".str_replace("00:00:00","",$HORA_ULTIMA_CARGA))
			->setCellValue('C'.$contador, utf8_encode($REFERENCIA))
			->setCellValue('D'.$contador, utf8_encode($PLANTA))
			->setCellValue('E'.$contador, utf8_encode($PROVEEDOR))
			->setCellValue('F'.$contador, utf8_encode($IMMEX_NAC))
			->setCellValue('G'.$contador, utf8_encode($TIPO_DE_OPERACION))
			->setCellValue('H'.$contador, utf8_encode($NO_PEDIMENTO))
			->setCellValue('I'.$contador, str_replace("0000-00-00","",$FECHA_INCIDENCIA)." ".str_replace("00:00:00","",$HORA_INCIDENCIA))
			->setCellValue('J'.$contador, str_replace("0000-00-00","",$FECHA_CONCILIADO)." ".str_replace("00:00:00","",$HORA_CONCLIADO))
			->setCellValue('K'.$contador, str_replace("0000-00-00","",$FECHA_CAPTURA)." ".str_replace("00:00:00","",$HORA_CAPTURA))
			->setCellValue('L'.$contador, utf8_encode($ANALISTA_META))
			->setCellValue('M'.$contador, str_replace("0000-00-00","",$FECHA_PAGO)." ".str_replace("00:00:00","",$HORA_PAGO))
			->setCellValue('N'.$contador, utf8_encode($ESTATUS))
			;
	$contador++;
}
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('Reporte.xlsx');

echo "<a href='descargar.php?nombre=Reporte.xlsx'>Descargar</a>";

?>
</body>
</html>