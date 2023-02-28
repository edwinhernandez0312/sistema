<?php

use Dompdf\Dompdf;
use Dompdf\Options;

require_once 'vendor/autoload.php';

// Crea las opciones de configuración de Dompdf
$options = new Options();
$options->set('defaultFont', 'Arial');
$options->set('isRemoteEnabled', true);

// Crea una instancia de Dompdf con las opciones de configuración
$dompdf = new Dompdf($options);



// Carga la marca de agua desde un archivo
$watermark = 'img/watermark.png';


// Añade la imagen como marca de agua
$canvas = $dompdf->getCanvas();
$canvas->image($watermark, 0, 0, $canvas->get_width(), $canvas->get_height(), '', '', '', false, 100, '', false, false, 0);
// Lee el contenido HTML desde un archivo
$html = file_get_contents('img/archivo.html');
// Carga el HTML en Dompdf
$dompdf->loadHtml($html);

// Renderiza el PDF
$dompdf->render();
// Añade la marca de agua al PDF
$dompdf->getCanvas()->page_text(72, 720, 'CONFIDENCIAL', null, 12, array(0, 0, 0));

$dompdf->stream("archivo.pdf", array("Attachment" => false));
