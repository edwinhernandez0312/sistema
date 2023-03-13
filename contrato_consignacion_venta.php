<?php
setlocale(LC_ALL, "es_ES");
date_default_timezone_set('America/Bogota');
include('php/conexion.php');
include('php/funciones.php');
session_start();
if (!isset($_SESSION['TIPO_USUARIO'])) {
    header('Location: login.php');
    exit();
}
$usuario_actual = $_SESSION['ID_USUARIO'];
// Verificar si se envió el id del inmueble a mostrar
if (isset($_GET['ID_INMUEBLE'])) {
    $ID_INMUEBLE = $_GET['ID_INMUEBLE'];
} else {
    header('Location: 404.php');
}

// Consulta SQL para obtener los datos del inmueble a mostrar
$sql = "SELECT * FROM inmueble WHERE ID_INMUEBLE = $ID_INMUEBLE";
$resultado = mysqli_query($conex, $sql);

// Comprobar si se encontró el inmueble
if (mysqli_num_rows($resultado) == 0) {   
     header('Location: 404.php');
}

// Obtener los datos del inmueble
$inmueble = mysqli_fetch_assoc($resultado);
$Usuario_registro = $inmueble['USUARIO_CREACION_INMUEBLE'];
$propietario=$inmueble['PROPIETARIO'];
// Obtener los datos del propietario
$sql = "SELECT * FROM cliente WHERE ID_CLIENTE=$propietario";
$resultado = mysqli_query($conex, $sql);
$propietario = mysqli_fetch_assoc($resultado);
// Obtener los datos del usuario de registro
$sql = "SELECT * FROM usuario WHERE ID_USUARIO=$Usuario_registro";
$resultado = mysqli_query($conex, $sql);
$usuario = mysqli_fetch_assoc($resultado);

$valor_gas = strpos($inmueble['SERVICIOS'], "Gas");
if ($valor_gas !== false) {
    $gas="Si";
}else{
    $gas="No";    
}
$valor_tv = strpos($inmueble['SERVICIOS'], "Television");
if ($valor_tv !== false) {
    $tv="Si";
}else{
    $tv="No";
}
$valor_elec = strpos($inmueble['SERVICIOS'], "Sevicio de electricidad");
if ($valor_elec !== false) {
    $luz="Si";
}else{
    $luz="No";
}
$valor_agua = strpos($inmueble['SERVICIOS'], "Agua");
if ($valor_agua !== false){
    $agua="Si";
}else{
    $agua="No";
}
$valor_tel = strpos($inmueble['SERVICIOS'], "Telefono fijo");
if ($valor_tel !== false){
    $tel="Si";
}else{
    $tel="No";
}
$valor_seg = strpos($inmueble['SERVICIOS'], "Seguridad");
if ($valor_seg !== false) {
    $adm="Si";
}else{
    $adm="No";
}


$fecha_actual = date('d \d\e F \d\e Y'); // Obtener fecha actual en formato d de F de Y
$meses = array(
    'January' => 'enero',
    'February' => 'febrero',
    'March' => 'marzo',
    'April' => 'abril',
    'May' => 'mayo',
    'June' => 'junio',
    'July' => 'julio',
    'August' => 'agosto',
    'September' => 'septiembre',
    'October' => 'octubre',
    'November' => 'noviembre',
    'December' => 'diciembre'
);
$fecha_actual = strtr($fecha_actual, $meses);
$fecha_array = explode(" de", $fecha_actual);
$dia = $fecha_array[0];
$mes = $fecha_array[1];
$anio = $fecha_array[2];


//realizacion pdf
require('fpdf/fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        // Logo
        $this->Image('img/watermark.png', 0, 0, 210, 297);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Move to the right
        $this->Cell(80);
        // Line break
        $this->Ln(30);
    }

    function Footer()
    {
        // Watermark image

    }
}

// Crear instancia de la clase FPDF
$pdf = new PDF();

// Añadir página
$pdf->AddPage();


// Definir la fuente y el tamaño
$pdf->SetFont('Arial','B',10);

// Definir ancho de columna de texto
$col_width = 190;

// Agregar título del contrato
$pdf->Cell(0, 10, utf8_decode('CONTRATO DE CONSIGNACIÓN DE INMUEBLES VENTA'), 0, 1, 'C');

// Ajustar posición del MultiCell para que comience debajo del título
$pdf->Ln(10);

// Dividir el texto en párrafos
$text ='Entre los suscritos '.$propietario['NOMBRES'].' '.$propietario['APELLIDOS'].', mayor de edad e identificado con C.C. No. '.$propietario['CEDULA'].' actuando como propietario del inmueble ubicado en la '.$inmueble['DIRECCION'].', municipio '.$inmueble['MUNICIPIO'].' quien en adelante se denominará EL PROPIETARIO y CONSTRUCTORA INMOBILIARIA LAURA RIVERA S.A.S. con NIT 900985803-9, representada legalmente por ROMAN GABRIEL APONTE FERRER, quien en adelante se denominará EL MANDATARIO, se ha suscrito el siguiente contrato de consignación para corretaje inmobiliario de venta, el cual se regirá por las normas del Código Civil y de Comercio y en especial por las cláusulas que a continuación se enumeran:

PRIMERA: EL PROPIETARIO entrega a EL MANDATARIO para que éste administre en venta por cuenta y riesgo del propietario, y autoriza para que se promueva el corretaje inmobiliario del bien inmueble ubicado en '.$inmueble['DIRECCION'].', municipio '.$inmueble['MUNICIPIO'].' matricula inmobiliaria No. '.$inmueble['MATRICULA_INMUEBLE'].' El inmueble cuenta además con los siguientes servicios públicos:
    
Acueducto y alcantarillado: '.$agua.', Energía eléctrica: '.$luz.', Gas domiciliario: '.$gas.', Línea telefónica: '.$tel.', TV cable: '.$tv.', Administración: '.$adm.'.
    
SEGUNDO: La descripción del bien inmueble objeto se encuentra en el formulario para la consignación de inmuebles de la CONSTRUCTORA INMOBILIARIA, la cual fue diligenciada directamente por EL PROPIETARIO o siguiendo sus estrictas instrucciones, siendo su responsabilidad la veracidad de la información allí consagrada; dicho formulario hace parte integral del contrato de consignación o corretaje inmobiliario. PARÁGRAFO PRIMERO: EL PROPIETARIO garantiza al EL EL MANDATARIO que el inmueble es apto para el fin indicado, es decir que cuenta con los servicios básicos instalados y en funcionamiento y que el mismo no presenta fallas estructurales que lo pongan en peligro de derrumbarse, inundarse, etc. PARÁGRAFO SEGUNDO: Lo anterior vale tratándose a inmuebles construidos y no aplica a lotes carentes de servicios. PARÁGRAFO TERCERO: En el evento que el bien inmueble consignado cuente con fallas o daños que puedan constituir perjuicio al potencial comprador, el PROPIETARIO excluye de toda responsabilidad a EL MANDATARIO. 
    
TERCERO: El término señado para el contrato es indefinido o hasta que se logre el fin perseguido, es decir, la venta del bien inmueble. PARÁGRAFO PRIMERO: cuando una de las partes lo considere pertinente, podrá prescindir del presente contrato de mandato a través de comunicación escrita siempre y cuando avisare con 5 días de anticipación su decisión.    PARÁGRAFO SEGUNDO: EL PROPIETARIO exime al MANDATARIO del pago de indemnizaciones por la cancelación del contrato. PARÁGRAFO TERCERO: En el evento que el bien inmueble sea destruido o su estructura se pierda parcial o totalmente por fuerza mayor o caso fortuito, se podrá prescindir del contrato sin que hubiere lugar a indemnización. PARÁGRAFO CUARTO: En el evento que llegare a ocurrir los hechos mencionados en el parágrafo tercero del numeral tercero, el PROPIETARIO excluye de toda responsabilidad al MANDATARIO. 
    
CUARTO: EL PROPIETARIO faculta ampliamente a EL MANDATARIO para publicar, anunciar y exhibir el bien inmueble de la forma que considere oportuna y pertinente para el fin perseguido, así como de informar a los posibles compradores, el precio de venta, forma de pago y condiciones de la negociación. PARÁGRAFO PRIMERO: entre las facultades otorgadas EL MANDATARIO podrá fijar avisos o publicidad en el inmueble. En los casos de que el inmueble haga parte del régimen de propiedad horizontal, se autoriza fijar avisos publicitarios en la portería, siempre y cuando los reglamentos internos del condominio lo permitan. 
    
                                                                        DE LAS OBLIGACIONES DEL MANDATARIO

QUINTO: EL MANDATARIO se obliga a efectuar todas las gestiones profesionales de su organización de venta para promocionar el bien inmueble.
SEXTO: EL MANDATARIO se obliga a disponer del personal calificado para la búsqueda de potenciales clientes o compradores, a realizar el acompañamiento adecuado para mostrar el inmueble a los potenciales clientes o compradores, a ofrecer el inmueble a través de sus redes sociales para que sea visible a personas interesadas.
SEPTIMO: EL MANDATARIO mantendrá informado al PROPIETARIO sobre ofertas y contacto que se presenten a efecto de obtener la autorización sobre el precio de venta, en caso de que el precio ofrecido fuere con personas potencialmente interesadas en adquirir el inmueble. 
OCTAVO: EL MANDATARIO se obliga a dar asesoría al PROPIETARIO y al COMPRADOR, en todas las gestiones y actuaciones relativas a la venta del bien inmueble. Si el PROPIETARIO optare por desechar estos servicios adicionales, la comisión se hará efectiva en su totalidad.
NOVENO: EL MANDATARIO se obliga a comunicar en forma confidencial al PROPIETARIO sobre las observaciones que los potenciales compradores le hagan sobre el inmueble, su precio, etc. a efecto de que él tome las determinaciones que considere convenientes.
DECIMO: EL MANDANTARIO ofrecerá el inmueble consignado, bajo las condiciones de pago autorizadas por EL PROPIETARIO.
    
                                            OBLIGACIONES DEL PROPIETARIO RESPECTO A LA VENTA DEL INMUEBLE

DECIMO PRIMERO: EL PROPIETARIO se obliga a pagar A EL MANDATARIO un equivalente al 3% (Tres por ciento) + IVA si es urbano (o rural); dicho porcentaje sobre el precio total de la negociación del inmueble, a título de comisión, sin perjuicio de las cargas tributarias a que haya lugar; lo anterior, una vez firmada la promesa de compraventa, o en caso tal que no la hubiere, al momento de la firma de la escritura pública. PARÁGRAFO PRIMERO: EL PROPIETARIO acepta que, aunque el pago por parte del adquirente del inmueble se efectúe de forma fraccionada, éste pagará el total de la comisión pactada, una vez se concrete el negocio por parte de LA INMOBILIARIA o MANDATARIO. PARÁGRAFO SEGUNDO: Si LA INMOBILIARIA ha sido autorizada por cualquier medio, para recibir el dinero derivado de la compraventa del inmueble, EL PROPIETARIO autoriza expresamente la deducción del valor correspondiente a la comisión pactada. 
DECIMO SEGUNDO: La comisión la pagara el PROPIETARIO en caso de que la venta la efectué directamente el PROPIETARIO siempre y cuando la misma se haga a una persona que hubiere sido presentada por el MANDATARIO o alguno de sus representantes, bien a él o a un familiar del cliente, o que hubiere llegado al propietario en virtud de la publicidad efectuada, bien sea por los avisos colocados en el mismo inmueble o por cualquier sistema. La comisión se hace efectiva sobre el valor real de la venta, independientemente de la forma de pago pactada.
DECIMO TERCERO: Cuando luego de celebrado el acercamiento entre el vendedor y el comprador se cerrara el negocio a través de un documento de opción de venta o promesa de venta, las partes de común acuerdo resolvieren el contrato, EL MANDATARIO tendrá derecho a exigir el pago de una comisión remuneratoria de su gestión, la cual no será inferior a un 3% de las sumas recibidas hasta la fecha y que cuando la comisión ya hubiere sido cancelada total o parcial, las sumas pagadas no serán reembolsadas por el MANDATARIO, pues se considera que es su remuneración de trabajo de la empresa y de sus funcionarios de venta.
DECIMO CUARTO: EL PROPIETARIO avisara al MANDATARIO en forma oportuna, sobre cualquier determinación que tome, en el sentido de arrendarlo, no vender el inmueble, o de haberlo vendido, etc.
DECIMO QUINTO: EL PROPIETARIO deja indemne a EL MANDATARIO, de todo perjuicio que el comprador adujere haber sufrido por daños ocultos del inmueble que impidan su uso o por sufrir perturbaciones en el disfrute del mismo por parte de terceros que alegaren derechos sobre el inmueble o por actuaciones judiciales de terceros que le privaren de la tenencia o del disfrute del mismo.
DECIMO SEXTO: En caso tal que EL PROPIETARIO se constituya en mora en el pago de la comisión pactada frente a EL MANDATARIO, la suma adeudada causará intereses moratorios o corrientes a la tasa máxima autorizada y certificada. Esta obligación corre únicamente por cuenta de EL PROPIETARIO, inclusive en los casos en que se pacte con el adquirente del inmueble que la comisión se pagará de forma solidaria. 
DECIMO SEPTIMO: En los casos en que, firmada la promesa de venta, ésta no se materialice por causas atribuibles a EL PROPIETARIO, éste deberá pagar el valor total de la comisión a EL MANDATARIO. De igual manera, si una vez firmada la promesa de compraventa, o documento equivalente, el adquirente del inmueble incumple los compromisos y obligaciones adquiridas, será EL PROPIETARIO quien deba iniciar y cubrir los gastos que generen los procesos judiciales a que haya lugar.
DECIMO OCTAVO: En caso de que el MANDATARIO hubiere efectuado pagos por cuenta del PROPIETARIO para pagos de impuestos, reparaciones, servicios, etc., necesarios para poder ofrecer el inmueble y hacerlo apto para su venta, EL PROPIETARIO reembolsara esas sumas al MANDATARIO y autoriza para que sean deducidos de las sumas pagadas por el comprador del precio de venta o las pagara directamente si no se hubiere vendido. 
DECIMO NOVENO: Por toda suma que EL PROPIETARIO adeude a EL MANDATARIO por cualquier concepto, EL MANDATARIO queda facultado para cobrar intereses a la tasa bancaria           corriente.
VIGESIMO: Cuando EL PROPIETARIO sea quien presente a LA INMOBILIARIA un promitente comprador durante la ejecución del presente contrato; pagará el 100% del valor correspondiente a la comisión pactada por la gestión realizada para su comercialización.
VIGESIMO PRIMERO: En caso de producirse la falta absoluta del propietario del bien inmueble objeto del presente contrato, y se hubiese realizado el contrato de promesa de compraventa, LA INMOBILIARIA queda facultada para retener el dinero percibido del negocio y que tenga en su haber con el objetivo de subsanar los costos que se hayan generado por concepto de corretaje inmobiliario.
VIGESIMO SEGUNDO. EL PROPIETARIO se obliga entregar a EL MANDATARIO copia de la cédula de ciudadanía de EL PROPIETARIO o los posibles PROPIETARIOS, certificado de libertad y tradición no mayor a (30) días, avalúo catastral, último recibo de impuesto predial y copia de la escritura que acredite propiedad. 
    
                                                                                    DE LA RESPONSABILIDAD
    
VIGESIMO TERCERO: EL MANDATARIO no asume responsabilidad alguna por daños o robos durante el tiempo que el inmueble este ocupado como desocupado, pues sus servicios no comprenden los de vigilancia ni mantenimiento. PARÁGRAFO UNICO: EL MANDATARIO tampoco será responsable del pago de los servicios públicos domiciliarios, reparaciones al inmueble derivadas de caso fortuito, fuerza mayor, o conductas penales (Hurto, incendio, daño en bien ajeno, entre otros), perturbaciones por parte de terceros, ocupaciones ilegales o, de hecho. En los casos descritos responderá de forma exclusiva EL PROPIETARIO, y no podrá imputarse responsabilidad siquiera sumaría a LA INMOBILIARIA. 
VIGESIMO CUARTO: EL PROPIETARIO manifiesta que obra de buena fe, no existiendo en su contra proceso de extinción de dominio por enriquecimiento ilícito derivado de cualquier tipo penal, y además que el inmueble a que se refiere este contrato está libre de pleitos o embargos vigentes; así mismo, EL PROPIETARIO se obliga a suministrar a LA INMOBILIARIA en forma fidedigna todos los datos sobre la titulación del inmueble, así como cualquier otro que permita ofertarlo sin incurrir en información que no corresponda con la realidad, tales como: capacidad eléctrica instalada, servicios instalados, restricciones de uso, defectos conocidos sobre cañerías, desagües, etc. Por lo tanto, es obligación de EL PROPIETARIO aportar a LA INMOBILIARIA al momento de realizar el contrato de venta: fotocopia de la parte normativa del reglamento de propiedad horizontal, manual de convivencia y cualquier otra reglamentación que opere en los inmuebles sometidos a este régimen. EL PROPIETARIO, es el único y exclusivo responsable judicial, administrativa y patrimonialmente, sobre hechos relacionados con vicios redhibitorios, información inexacta que dé lugar a publicidad engañosa, errores de escrituración, así como sobre cualquier otro que pudiere derivar en cualquier clase de litigio; y por ello EL PROPIETARIO, mantendrá indemne a LA INMOBILIARIA de cualquier perjuicio, tanto durante la ejecución, como después de finalizado el presente contrato, en razón a lo cual las partes otorgan al presente numeral los efectos de cosa juzgada material.   

VIGESIMO QUINTO: El precio del inmueble para venta se fija en la suma de $ '.$inmueble['PRECIO_VENTA'].' el cual podrá ser modificado por EL PROPIETARIO, con base en las ofertas presentadas por EL MANDATARIO. 
    
PARAGRAFO PRIMERO: en Caso en que el propietario autoricé realizar la venta en un valor menor debido a las ofertas presentadas deberá cancelar a favor de la constructora e inmobiliaria Laura Rivera S.A.S. el valor correspondiente al 3% de comisión más IVA correspondiente, sobre el valor en que se realice la venta.
PARAGRAFO DOS: El propietario autoriza a la constructora e inmobiliaria Laura Rivera S.A.S. ofrecer el inmueble en un valor mayor al fijado como precio de venta, y autoriza a que el valor de sobreprecio sea cancelado a favor de la constructora inmobiliaria Laura Rivera S.A.S. como pago de la gestión de corretaje.
PARAGRAFO TERCERO: En caso de que EL CONSIGNANTE decida dar por terminado el presente contrato antes de la realización del negocio con el posible comprador, pagará a EL MANDATARIO la suma de CINCO por ciento (5%) del valor de la venta del inmueble.
    
VIGESIMO SEXTA: Entre EL MANDATARIO y EL PROPIETARIO no existirá relación laboral, toda vez que LA INMOBILIARIA actúa como contratista independiente. 

VIGESIMO SEPTIMO: EL PROPIETARIO acepta y reconoce que le ha sido socializada la política de tratamiento de datos personales por parte de EL MANDATARIO y que autoriza el uso de los datos personales que ha suministrado para el presente contrato, se anexa política de tratamiento de datos el cual hace parte integral del presente contrato. 

VIGESIMO OCTAVO: EL PROPIETARIO declara expresamente que el origen de sus ingresos proviene de actividad licita ejercida entre los parámetros legales y que se encuentran libres de las contempladas en el Código Penal Colombiano. a.- La información suministrada en el presente contrato son suministradas por EL PROPIETARIO, por lo tanto, toda falsedad, error u omisión en ellas será responsabilidad exclusiva del EL PROPIETARIO. PARÁGRAFO SEGUNDO: EL PROPIETARIO se obliga para con EL MANDATARIO a mantener actualizada la información suministrada, para lo cual se comprometen a reportar por lo menos una vez cada 3 meses de ser necesario los cambios que se hayan generado respecto a la información suministrada. Se anexa formulario de conocimiento del cliente persona natural el cual hace parte integral del contrato.

TRIGESIMO NOVENO LAS PARTES reconocen la naturaleza confidencial de cualquier información que no sea del dominio público y que haga parte de la política de tratamiento de datos, que llegue a tenerse en el proceso de celebración y ejecución de este contrato y se obligan a no utilizarla en beneficio propio o ajeno, ni a divulgar a ningún tercero, sin permiso previo escrito de la parte a la cual pertenece. PARÁGRAFO PRIMERO: Las partes se comprometen a través de este contrato a guardar absoluta reserva y confidencialidad por 6 meses más posterior a la fecha de expiración del contrato. PARÁGRAFO SEGUNDO: Se excluye de la cláusula de confidencialidad, la información suministrada a empleados y colaboradores con ocasión al cumplimiento del contrato. PARÁGRAFO TERCERO: La cláusula de confidencialidad no será obligatoria en los eventos que la ley lo requiera, es decir; cuando por medio de orden legal emitida por autoridad legal competente se solicite el suministro de información, documentos y materiales. LAS PARTES acuerdan comunicar dar aviso a la otra en caso de requerimiento judicial que verse sobre la información aquí suministrada o que pueda afectar el objeto del presente contrato. PARÁGRAFO CUARTO: Las obligaciones establecidas en esta cláusula, sobrevivirán a la expiración o terminación de este contrato.

TRIGESIMO: LAS PARTES acuerdan y aceptan que el presente contrato junto con los documentos que forman parte integral del mismo, y a los que haya lugar de conformidad con la ley, por contener obligaciones claras, expresas y exigibles, presta MÉRITO EJECUTIVO para exigir el pago de las sumas estipuladas por concepto de comisiones, honorarios, intereses moratorios, gestiones de cobro, así como cualquier otra suma a cargo de EL PROPIETARIO. Cualquier suma derivada del presente contrato, será exigible por la vía ejecutiva sin necesidad de los requerimientos previos ni constitución en mora de que tratan los Arts. 1594 y 1595 del Código Civil, derechos estos a los que renuncia expresamente EL PROPIETARIO, así como cualquier otro que sea establecido en alguna norma de carácter procesal o sustancial. Otorgándole las partes, al contenido del presente contrato, los efectos de cosa juzgada material. 

TRIGESIMO PRIMERA: EL PROPIETARIO recibirá notificaciones en la dirección de residencia '.$propietario['DIRECCION'].', municipio '.$propietario['MUNICIPIO_CLI'].', departamento '.$propietario['DEPARTAMENTO_CLI'].'. Correo electrónico '.$propietario['EMAIL'].', teléfono '.$propietario['TELEFONO'].', dirección de trabajo '.$propietario['DIRECCION_LAB'].' y el MANDATARIO recibirá notificaciones en la Carrera 9 No. 5-39 Barrio Centro de Villa del Rosario, correo electrónico Inmobiliarialaurarivera@gmail.com, teléfono 3043849768. 
    
En señal de conformidad, los contratantes suscriben este documento en dos ejemplares del mismo tenor y valor, a los '.numeros_letras_min($dia).' ('.$dia.') días del mes de'.$mes.' de'.$anio.' del municipio de Villa del Rosario.


EL ADMINISTRADOR



______________________________________
ROMAN GABRIEL APONTE FERRER
REPRESENTANTE LEGAL
CONSTRUCTORA INMOBILIARIA LAURA RIVERA SAS

EL PROPIETARIO



______________________________________
'.$propietario['NOMBRES'].' '.$propietario['APELLIDOS'].'
C.C. '.$propietario['CEDULA'].'
TEL: '.$propietario['TELEFONO'].'
E-mail: '.$propietario['EMAIL'];
$pdf->SetFont('Arial','',9);
// Justificar los párrafos
$paragraphs = $pdf->MultiCell($col_width, 5, utf8_decode($text), 0, 'J');
// Seleccionar fuente y tamaño de letra
$pdf->SetFont('Arial','B',8);

// Dibujar el rectángulo
$pdf->Rect(150, 45, 20, 30, 'D');

// Imprimir el texto "Huella" dentro del rectángulo
$pdf->SetXY(150, 75);
$pdf->Cell(20, 10, 'Huella', 0, 0, 'C');

// Dibujar el rectángulo
$pdf->Rect(150, 95, 20, 30, 'D');

// Imprimir el texto "Huella" dentro del rectángulo
$pdf->SetXY(150, 125);
$pdf->Cell(20, 10, 'Huella', 0, 0, 'C');

$nombre_pdf=utf8_decode('Consignacion_arriendo_'.$propietario['NOMBRES'].'_'.$propietario['APELLIDOS'].'_'.$propietario['CEDULA'].'.pdf');
// Guardar el PDF 
$pdf->Output($nombre_pdf, 'D');
