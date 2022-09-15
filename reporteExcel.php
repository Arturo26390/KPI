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


$parametro=$_GET["parametro"];
$planta=$_GET["planta"];
$tipo_pedimento=$_GET["tipo_pedimento"];
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
$ejecuta_consulta = mysqli_query($con_116, $consulta);
$select_hoy = "SELECT CURDATE() AS FECHA_HOY";
$ejecuta_select_hoy = mysqli_query($con_116, $select_hoy);
$row_hoy=mysqli_fetch_assoc($ejecuta_select_hoy);
$fecha_hoy     = $row_hoy['FECHA_HOY'];

$objPHPExcel = new PHPExcel();
$objPHPExcel->createSheet(1);

if($tipo_pedimento == 'K1' || $tipo_pedimento == 'R1'){
	if($parametro == 'En Captura'){
	
		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A1','REFERENCIA')
		->setCellValue('B1','PLANTA')
		->setCellValue('C1','PROVEEDOR')
		->setCellValue('D1','IMMEX/NAC')
		->setCellValue('E1','TIPO_DE_OPERACION')
		->setCellValue('F1','NO_PEDIMENTO')
		->setCellValue('G1','ANALISTA_META')
		->setCellValue('H1','FECHA_CAPTURA')
		->setCellValue('I1','DIAS_PROCESO')
		;
		$contador=2;
	
		while($row=mysqli_fetch_assoc($ejecuta_consulta)){
			$FECHA_PRIMER_CARGA     = $row['FECHA_PRIMER_CARGA'];
			$FECHA_INICIO     		= $row['FECHA_INICIO'];
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

			$DIAS_PROCESO = daysWeek($FECHA_CAPTURA, $fecha_hoy, $con_116);
			
			$objPHPExcel->getActiveSheet()->setTitle('RELACION'); 
			$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFill()->applyFromArray(array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '3F78AC'),
				'endcolor'   => array('rgb' => '3F78AC')
			));
			$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray(array(
				'font' => array(
					'name' => 'Arial',
					'size' => 8,
					'bold' => true,
					'color' => array(
						'rgb' => 'FFFFFF'
					),
				),
			));
			
			$objPHPExcel->getActiveSheet()->getStyle('A'.$contador.':I'.$contador)->applyFromArray(array('font' => array(
																												'name' => 'Arial', 'size' => 8,
																												'bold' => false, 'color' => array(
																													'rgb' => '000000'
																												), ), 'numberformat' => array(
																												'code' => '@',
																												), ));
			
			$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$contador, utf8_encode($REFERENCIA))
					->setCellValue('B'.$contador, utf8_encode($PLANTA))
					->setCellValue('C'.$contador, utf8_encode($PROVEEDOR))
					->setCellValue('D'.$contador, utf8_encode($IMMEX_NAC))
					->setCellValue('E'.$contador, utf8_encode($TIPO_DE_OPERACION))
					->setCellValue('F'.$contador, utf8_encode($NO_PEDIMENTO))
					->setCellValue('G'.$contador, utf8_encode($ANALISTA_META))
					->setCellValue('H'.$contador, str_replace("0000-00-00","",$FECHA_CAPTURA)." ".str_replace("00:00:00","",$HORA_CAPTURA))
					->setCellValue('I'.$contador, utf8_encode($DIAS_PROCESO));
			$contador++;
		}
	}
	if($parametro == 'Pagado'){
	
		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A1','REFERENCIA')
		->setCellValue('B1','PLANTA')
		->setCellValue('C1','PROVEEDOR')
		->setCellValue('D1','IMMEX/NAC')
		->setCellValue('E1','TIPO_DE_OPERACION')
		->setCellValue('F1','NO_PEDIMENTO')
		->setCellValue('G1','FECHA_CAPTURA')
		->setCellValue('H1','ANALISTA_META')
		->setCellValue('I1','FECHA_PAGO')
		->setCellValue('J1','DIAS_PROCESO')
		;
		$contador=2;
	
	
		while($row=mysqli_fetch_assoc($ejecuta_consulta)){
			$FECHA_PRIMER_CARGA     = $row['FECHA_PRIMER_CARGA'];
			$FECHA_INICIO     		= $row['FECHA_INICIO'];
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

			$DIAS_PROCESO = daysWeek($FECHA_CAPTURA, $FECHA_PAGO, $con_116);
			
			$objPHPExcel->getActiveSheet()->setTitle('RELACION'); 
			$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getFill()->applyFromArray(array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '3F78AC'),
				'endcolor'   => array('rgb' => '3F78AC')
			));
			$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->applyFromArray(array(
				'font' => array(
					'name' => 'Arial',
					'size' => 8,
					'bold' => true,
					'color' => array(
						'rgb' => 'FFFFFF'
					),
				),
			));
			
			$objPHPExcel->getActiveSheet()->getStyle('A'.$contador.':J'.$contador)->applyFromArray(array('font' => array(
																												'name' => 'Arial', 'size' => 8,
																												'bold' => false, 'color' => array(
																													'rgb' => '000000'
																												), ), 'numberformat' => array(
																												'code' => '@',
																												), ));
			
			$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$contador, utf8_encode($REFERENCIA))
					->setCellValue('B'.$contador, utf8_encode($PLANTA))
					->setCellValue('C'.$contador, utf8_encode($PROVEEDOR))
					->setCellValue('D'.$contador, utf8_encode($IMMEX_NAC))
					->setCellValue('E'.$contador, utf8_encode($TIPO_DE_OPERACION))
					->setCellValue('F'.$contador, utf8_encode($NO_PEDIMENTO))
					->setCellValue('G'.$contador, str_replace("0000-00-00","",$FECHA_CAPTURA)." ".str_replace("00:00:00","",$HORA_CAPTURA))
					->setCellValue('H'.$contador, utf8_encode($ANALISTA_META))
					->setCellValue('I'.$contador, str_replace("0000-00-00","",$FECHA_PAGO)." ".str_replace("00:00:00","",$HORA_PAGO))
					->setCellValue('J'.$contador, utf8_encode($DIAS_PROCESO));
					;
			$contador++;
		}
	}
}else{
	if($parametro == 'Sin Informacion'){

		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A1','REFERENCIA')
		->setCellValue('B1','PLANTA')
		->setCellValue('C1','PROVEEDOR')
		->setCellValue('D1','IMMEX/NAC')
		->setCellValue('E1','TIPO_DE_OPERACION')
		->setCellValue('F1','NO_PEDIMENTO')
		->setCellValue('G1','ANALISTA_META')
		->setCellValue('H1','DIAS_PROCESO')
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
		
			$DIAS_PROCESO = 0;	
			$objPHPExcel->getActiveSheet()->setTitle('RELACION'); 
			$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFill()->applyFromArray(array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '3F78AC'),
				'endcolor'   => array('rgb' => '3F78AC')
			));
			$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray(array(
				'font' => array(
					'name' => 'Arial',
					'size' => 8,
					'bold' => true,
					'color' => array(
						'rgb' => 'FFFFFF'
					),
				),
			));
			
			$objPHPExcel->getActiveSheet()->getStyle('A'.$contador.':H'.$contador)->applyFromArray(array('font' => array(
																												'name' => 'Arial', 'size' => 8,
																												'bold' => false, 'color' => array(
																													'rgb' => '000000'
																												), ), 'numberformat' => array(
																												'code' => '@',
																												), ));
					
			$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$contador, utf8_encode($REFERENCIA))
					->setCellValue('B'.$contador, utf8_encode($PLANTA))
					->setCellValue('C'.$contador, utf8_encode($PROVEEDOR))
					->setCellValue('D'.$contador, utf8_encode($IMMEX_NAC))
					->setCellValue('E'.$contador, utf8_encode($TIPO_DE_OPERACION))
					->setCellValue('F'.$contador, utf8_encode($NO_PEDIMENTO))
					->setCellValue('G'.$contador, utf8_encode($ANALISTA_META))
					->setCellValue('H'.$contador, utf8_encode($DIAS_PROCESO));
			$contador++;
		}
	}
	if($parametro == 'Incidencia'){
	
		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A1','FECHA_PRIMER_CARGA')
		->setCellValue('B1','FECHA_ULTIMA_CARGA')
		->setCellValue('C1','REFERENCIA')
		->setCellValue('D1','PLANTA')
		->setCellValue('E1','PROVEEDOR')
		->setCellValue('F1','IMMEX/NAC')
		->setCellValue('G1','TIPO_DE_OPERACION')
		->setCellValue('H1','NO_PEDIMENTO')
		->setCellValue('I1','ANALISTA_META')
		->setCellValue('J1','FECHA_INCIDENCIA')
		->setCellValue('K1','DIAS_PROCESO')
		;
		$contador=2;
	
		while($row=mysqli_fetch_assoc($ejecuta_consulta)){
			$FECHA_PRIMER_CARGA     = $row['FECHA_PRIMER_CARGA'];
			$FECHA_INICIO     		= $row['FECHA_INICIO'];
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

			$DIAS_PROCESO = daysWeek($FECHA_INICIO, $fecha_hoy, $con_116);
			
			$objPHPExcel->getActiveSheet()->setTitle('RELACION'); 
			$objPHPExcel->getActiveSheet()->getStyle('A1:K1')->getFill()->applyFromArray(array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '3F78AC'),
				'endcolor'   => array('rgb' => '3F78AC')
			));
			$objPHPExcel->getActiveSheet()->getStyle('A1:K1')->applyFromArray(array(
				'font' => array(
					'name' => 'Arial',
					'size' => 8,
					'bold' => true,
					'color' => array(
						'rgb' => 'FFFFFF'
					),
				),
			));
			
			$objPHPExcel->getActiveSheet()->getStyle('A'.$contador.':K'.$contador)->applyFromArray(array('font' => array(
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
				->setCellValue('I'.$contador, utf8_encode($ANALISTA_META))
				->setCellValue('J'.$contador, str_replace("0000-00-00","",$FECHA_INCIDENCIA)." ".str_replace("00:00:00","",$HORA_INCIDENCIA))
				->setCellValue('K'.$contador, utf8_encode($DIAS_PROCESO));
			$contador++;
		}
	}
	if($parametro == 'Conciliado'){
	
	$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A1','FECHA_PRIMER_CARGA')
	->setCellValue('B1','FECHA_ULTIMA_CARGA')
	->setCellValue('C1','REFERENCIA')
	->setCellValue('D1','PLANTA')
	->setCellValue('E1','PROVEEDOR')
	->setCellValue('F1','IMMEX/NAC')
	->setCellValue('G1','TIPO_DE_OPERACION')
	->setCellValue('H1','NO_PEDIMENTO')
	->setCellValue('I1','ANALISTA_META')
	->setCellValue('J1','FECHA_CONCILIADO')
	->setCellValue('K1','DIAS_PROCESO')
	;
	$contador=2;
	
	
		while($row=mysqli_fetch_assoc($ejecuta_consulta)){
			$FECHA_PRIMER_CARGA     = $row['FECHA_PRIMER_CARGA'];
			$FECHA_INICIO    		= $row['FECHA_INICIO'];
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
			
			$DIAS_PROCESO = daysWeek($FECHA_INICIO, $fecha_hoy, $con_116);

			$objPHPExcel->getActiveSheet()->setTitle('RELACION'); 
			$objPHPExcel->getActiveSheet()->getStyle('A1:K1')->getFill()->applyFromArray(array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '3F78AC'),
				'endcolor'   => array('rgb' => '3F78AC')
			));
			$objPHPExcel->getActiveSheet()->getStyle('A1:K1')->applyFromArray(array(
				'font' => array(
					'name' => 'Arial',
					'size' => 8,
					'bold' => true,
					'color' => array(
						'rgb' => 'FFFFFF'
					),
				),
			));
			
			$objPHPExcel->getActiveSheet()->getStyle('A'.$contador.':K'.$contador)->applyFromArray(array('font' => array(
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
				->setCellValue('I'.$contador, utf8_encode($ANALISTA_META))
				->setCellValue('J'.$contador, str_replace("0000-00-00","",$FECHA_CONCILIADO)." ".str_replace("00:00:00","",$HORA_CONCLIADO))
				->setCellValue('K'.$contador, utf8_encode($DIAS_PROCESO));
				
			$contador++;
		}
	}
	if($parametro == 'En Captura'){
	
		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A1','FECHA_PRIMER_CARGA')
		->setCellValue('B1','FECHA_ULTIMA_CARGA')
		->setCellValue('C1','REFERENCIA')
		->setCellValue('D1','PLANTA')
		->setCellValue('E1','PROVEEDOR')
		->setCellValue('F1','IMMEX/NAC')
		->setCellValue('G1','TIPO_DE_OPERACION')
		->setCellValue('H1','NO_PEDIMENTO')
		->setCellValue('I1','ANALISTA_META')
		->setCellValue('J1','FECHA_CONCILIADO')
		->setCellValue('K1','FECHA_CAPTURA')
		->setCellValue('L1','DIAS_PROCESO')
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

			
			$DIAS_PROCESO = daysWeek($FECHA_INICIO, $fecha_hoy, $con_116);
			
			$objPHPExcel->getActiveSheet()->setTitle('RELACION'); 
			$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getFill()->applyFromArray(array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '3F78AC'),
				'endcolor'   => array('rgb' => '3F78AC')
			));
			$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray(array(
				'font' => array(
					'name' => 'Arial',
					'size' => 8,
					'bold' => true,
					'color' => array(
						'rgb' => 'FFFFFF'
					),
				),
			));
			
			$objPHPExcel->getActiveSheet()->getStyle('A'.$contador.':L'.$contador)->applyFromArray(array('font' => array(
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
					->setCellValue('I'.$contador, utf8_encode($ANALISTA_META))
					->setCellValue('J'.$contador, str_replace("0000-00-00","",$FECHA_CONCILIADO)." ".str_replace("00:00:00","",$HORA_CONCLIADO))
					->setCellValue('K'.$contador, str_replace("0000-00-00","",$FECHA_CAPTURA)." ".str_replace("00:00:00","",$HORA_CAPTURA))
					->setCellValue('L'.$contador, utf8_encode($DIAS_PROCESO));
			$contador++;
		}
	}
	if($parametro == 'Pagado'){
	
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
		->setCellValue('N1','DIAS_PROCESO')
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

			$dias_4= daysWeek($FECHA_INICIO, $FECHA_PAGO, $con_116);
			$DIAS_PROCESO = $dias_4;
			
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
					->setCellValue('N'.$contador, utf8_encode($DIAS_PROCESO))
					;
			$contador++;
		}
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


$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('Reporte.xlsx');

echo "<a onclick='ocultar();' href='descargar.php?nombre=Reporte.xlsx'>Descargar</a>";

?>
</body>
</html>