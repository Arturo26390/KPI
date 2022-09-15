<?php
include("includes/conexiones.php");
$pedimento=$_GET["pedimento"];

$elimina_ped = "DELETE FROM CONTROL_NO_PED_PRUEBAS WHERE PED_IMPO = '".$pedimento."'";
$elimina_ped_datos_graficas = "DELETE FROM DATOS_GRAFICAS_PRUEBAS WHERE NO_PEDIMENTO = '".$pedimento."'";

$ejecuta_elimina_ped = mysqli_query($con_116, $elimina_ped);
$ejecuta_elimina_ped_datos_graficas = mysqli_query($con_116, $elimina_ped_datos_graficas);


if($ejecuta_elimina_ped){
    if($ejecuta_elimina_ped_datos_graficas){
        echo "1";
    }
}
?>