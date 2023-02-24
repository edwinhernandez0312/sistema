<?php
// Incluir la librería domPDF
ob_start();
?>
<div>LA CONSTRUCTORA INMOBILIARIA LAURA RIVERA S.A.S. con NIT 900985803-9, con domicilio en la
Carrera 9 No. 5-39 Centro de Villa del Rosario, representada legalmente por ROMAN GABRIEL APONTE FERRER,
identificado con cédula de ciudadanía C.C. 1093772794 de Los Patios, quien para efectos del presente contrato se
denominará EL ARRENDADOR, por otro lado __________________, identificado(a) con la Cédula de Ciudadanía
__________________ expedida en __________________, actuando en nombre propio y domiciliado(a) en la ciudad de
__________________, quien para efectos de este contrato se denominara EL ARRENDATARIO, manifiestan que han
decidido celebrar un CONTRATO DE ARRENDAMIENTO (en adelante CONTRATO) de bien inmueble destinado a
VIVIENDA,</div>
<?php
$html = ob_get_clean();
//echo $html;
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array(
    'isRemoteEnabled' => true,
    'defaultFont' => 'Arial'
));
$dompdf->setOptions($options);

$html = '
    <style>
        p {
            text-align: justify;
        }
    </style>
    <h1>Título del documento</h1>
    <p>LA CONSTRUCTORA INMOBILIARIA LAURA RIVERA S.A.S. con NIT 900985803-9, con domicilio en la
    Carrera 9 No. 5-39 Centro de Villa del Rosario, representada legalmente por ROMAN GABRIEL APONTE FERRER,
    identificado con cédula de ciudadanía C.C. 1093772794 de Los Patios, quien para efectos del presente contrato se
    denominará EL ARRENDADOR, por otro lado __________________, identificado(a) con la Cédula de Ciudadanía
    __________________ expedida en __________________, actuando en nombre propio y domiciliado(a) en la ciudad de
    __________________, quien para efectos de este contrato se denominara EL ARRENDATARIO, manifiestan que han
    decidido celebrar un CONTRATO DE ARRENDAMIENTO (en adelante CONTRATO) de bien inmueble destinado a
    VIVIENDA,</p>
';

$dompdf->loadHtml($html);
$dompdf->setPaper('letter');
$dompdf->render();
$dompdf->stream("archivo.pdf", array("Attachment" => false));