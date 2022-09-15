<?php
    $nombre = $_GET["nombre"];
    echo $nombre;
	if (file_exists($nombre)) {
        echo "si";
        $downloadfilename = basename($nombre);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $downloadfilename);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($nombre));
        ob_clean();
        flush();
        readfile($nombre);
        unlink($nombre);
        exit;
    }
    else{
        echo "no";
    }
?>