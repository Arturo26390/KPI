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


$vector_proveedor=$_GET["proveedores"];
$vector_planta=$_GET["plantas"];
$vector_dias=$_GET["dias"];

$objPHPExcel = new PHPExcel();
$objPHPExcel->createSheet(1);

$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1','PROVEEDOR')
->setCellValue('B1','PLANTA')
->setCellValue('C1','DIAS')
;
$contador=2;

$objPHPExcel->getActiveSheet()->setTitle('RELACION'); 
$objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getFill()->applyFromArray(array(
	'type'       => PHPExcel_Style_Fill::FILL_SOLID,
	'startcolor' => array('rgb' => '3F78AC'),
	'endcolor'   => array('rgb' => '3F78AC')
));
$objPHPExcel->getActiveSheet()->getStyle('A1:C1')->applyFromArray(array(
	'font' => array(
		'name' => 'Arial',
		'size' => 8,
		'bold' => true,
		'color' => array(
			'rgb' => 'FFFFFF'
		),
	),
));





$proveedores = explode("|", $vector_proveedor);
$plantas = explode("|", $vector_planta);
$dias = explode("|", $vector_dias);
$var_aux = 1;
for($i=9; $i>=0; $i--){
	$celda = $var_aux+1;

	$objPHPExcel->getActiveSheet()->getStyle('A'.$celda.':C'.$celda)->applyFromArray(array('font' => array(
		'name' => 'Arial', 'size' => 8,
			'bold' => false, 'color' => array(
				'rgb' => '000000'
			), ), 'numberformat' => array(
			'code' => '@',
			), ));
	
	$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$celda, $proveedores[$i])
			->setCellValue('B'.$celda, $plantas[$i])
			->setCellValue('c'.$celda, $dias[$i]);
	$var_aux++;
}

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('Reporte TOPTEN.xlsx');

echo "<a onclick='ocultar();' href='descargar.php?nombre=Reporte TOPTEN.xlsx'>Descargar</a>";

?>
</body>
</html>