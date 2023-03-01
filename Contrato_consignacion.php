<?php
date_default_timezone_set('America/Bogota');
include('php/conexion.php');
include('php/funciones.php');
session_start();
if (!isset($_SESSION['TIPO_USUARIO'])) {
    header('Location: login.php');
    exit();
}
$usuario_actual = $_SESSION['ID_USUARIO'];
// Verificar si se envió el id del cliente a editar
if (isset($_GET['id'])) {
    $id_cliente = $_GET['id'];
} else {
    die('Error: no se ha especificado el id del cliente');
}

// Consulta SQL para obtener los datos del cliente a editar
$sql = "SELECT * FROM cliente WHERE ID_CLIENTE = $id_cliente";
$resultado = mysqli_query($conex, $sql);

// Comprobar si se encontró el cliente
if (mysqli_num_rows($resultado) == 0) {
    die('Error: no se encontró el cliente con id ' . $id_cliente);
}

// Obtener los datos del cliente
$fila = mysqli_fetch_assoc($resultado);
$Usuario_registro = $fila['USUARIO_REGISTRO_CLIENTE'];
$sql = "SELECT * FROM usuario WHERE ID_USUARIO=$Usuario_registro";
$resultado = mysqli_query($conex, $sql);
$usuario = mysqli_fetch_assoc($resultado);
require_once 'vendor/autoload.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array(
    'isRemoteEnabled' => true,
    'defaultFont' => 'Arial'
));
$dompdf->setOptions($options);

// Incluir la librería domPDF
ob_start();
?>
<style>
    p {
        text-align: justify;
    }
</style>
<div>
    <p>Entre los suscritos _____________________________________________________ con C.C. No.
        ___________________ de _______________, actuando como propietario del inmueble ubicado en
        _____________________________________________________, municipio ________________________________
        quien en adelante se denominará EL PROPIETARIO y CONSTRUCTORA INMOBILIARIA LAURA RIVERA S.A.S. con NIT
        900985803-9, representada legalmente por ROMAN GABRIEL APONTE FERRER, quien en adelante se denominará EL
        ADMINISTRADOR, se ha suscrito el siguiente contrato de ADMINISTRACIÓN para corretaje inmobiliario de arriendo, el
        cual se regirá por las normas del Código Civil y de Comercio y en especial por las cláusulas que a continuación se
        enumeran:
        PRIMERO: EL PROPIETARIO entrega al administrador para que éste administre en arrendamiento por cuenta y riesgo del
        consígnate, y autoriza para que se promueva el corretaje inmobiliario del bien inmueble ubicado en
        __________________________________________, municipio __________________, matrícula inmobiliaria No.
        _____________________. El inmueble cuenta además con los siguientes servicios públicos:
        Acueducto y alcantarillado si___ No___, Energía eléctrica si___ No___, Gas domiciliario si___ No___, Línea telefónica si___
        No___, TV cable si___ No___, Administración si___ No___.
        SEGUNDO: FACULTADES DEL ADMINISTRADOR- EL PROPIETARIO faculta AL ADMINISTRADOR, para que en su
        nombre y representación tramite y ejecute los asuntos que a continuación se enumeran así: a) Anunciar y promover por
        medios ordinarios e idóneos y bajo sus costas (Administrador), el arriendo del inmueble de que trata el presente contrato.
        b) Escoger a los arrendatarios, que a criterios de EL ADMINISTRADOR reúnan los requisitos exigidos por este, para
        calificar como arrendatario del inmueble. c) Celebrar los contratos de arrendamiento respectivos bajo las garantías que a
        juicio del ADMINISTRADOR sean oportunas. d) Recibir los Cánones y demás pagos a cargo de los arrendatarios. e)
        Arrendar el inmueble por el precio acordado con EL PROPIETARIO, teniendo en cuenta la calidad, ubicación del inmueble
        y las leyes vigentes en materia de arrendamiento, procurando el mejor beneficio para los propietarios. f) Otorgar
        autorizaciones a los arrendatarios para traslado o instalaciones de líneas de servicio telefónico, internet o de banda ancha
        al inmueble. g) Efectuar todas aquellas reparaciones locativas que legalmente correspondan a EL PROPIETARIO para la
        conservación del inmueble y faciliten su arrendamiento o las que estén encaminadas a satisfacer el goce pleno del
        inmueble, así como todas aquellas que sean ordenadas por las autoridades. h) Dar por terminado antes del vencimiento,
        por justa causa, el contrato de arriendo que se haya suscrito sobre el inmueble, e iniciar las acciones legales. i) Iniciar
        oportunamente, las acciones judiciales, administrativas y/o policivas de las que sea titular, tendiente a librar de
        perturbaciones a los arrendatarios. En el evento de que haya necesidad de promover procesos para obtener judicialmente
        la restitución del inmueble, los gastos del proceso serán aquellos que señale el correspondiente juzgado y los pagarán los
        arrendatarios.
        j) Descontar inmediatamente de los correspondientes cánones de arrendamiento que reciba, el valor de la comisión y el
        I.V.A. causado, además de los gastos y costos en que incurra EL ADMINISTRADOR por causa de la gestión que adelante,
        exceptuando los de comercialización del inmueble, así como también a descontar fianza de arrendamiento, reparaciones
        locativas, acciones judiciales, administrativas y/o policivas y demás, que demande el inmueble y que EL
        ADMINISTRADOR haya asumido de manera directa por autorización de EL PROPIETARIO. l) Poder: otorgar poder a un
        abogado para que inicie cualquier proceso judicial, administrativo o extrajudicial relacionado con el inmueble, e incluso
        para que eleven derechos de petición y cualquier tipo de recurso, en aras de defender los intereses de EL PROPIETARIO
        y del bien.
        TERCERO: El término señado para el contrato es indefinido o hasta que se logre el fin perseguido, es decir, el arriendo del
        bien inmueble ubicado en ______________________________, municipio ___________________, matrícula inmobiliaria
        No. ____________________. a.- cuando una de las partes lo considere pertinente, podrá prescindir del presente contrato de
        administración a través de comunicación escrita, siempre y cuando avisaré con 5 días de anticipación su decisión. b.- EL

        P
        A
        G
        E
        2

        PROPIETARIO exime a EL ADMINISTRADOR del pago de indemnizaciones por la cancelación del contrato. c.- En el evento
        de que el bien inmueble sea destruido o su estructura sea parcial o totalmente por fuerza mayor o caso fortuito, se podrá
        Prescindir del contrato sin que hubiere lugar a indemnización. d.- En el evento que llegaré a ocurrir los hechos
        mencionados en el literal c, EL PROPIETARIO excluye de toda responsabilidad a EL ADMINISTRADOR.
        CUARTO: FIJACIÓN DE CANON Y FORMA DE PAGO: El precio acordado con EL PROPIETARIO, por el cual se
        arrendará el inmueble será de _________________________________________________________ MIL PESOS m/c
        ($___________________ y consignados a la cuenta de Ahorros No. 83400028896 Del banco Bancolombia. EL
        PROPIETARIO pagará al ADMINISTRADOR por sus servicios una comisión equivalente al diez por ciento (10%) del
        canon de arrendamiento más IVA. Más dos puntos, cinco por ciento (2.5%) de la fianza de arriendo.
        QUINTO: DEDUCCIÓN MENSUAL: EL PROPIETARIO autoriza en forma expresa al ADMINISTRADOR, deducir
        mensualmente del monto total de los arrendamientos, la comisión estipulada, así como el valor del IVA y de los gastos en
        que incurriere en el desempeño de este contrato.
        SEXTO: OBLIGACIONES DEL ADMINISTRADOR: EL PROPIETARIO faculta al ADMINISTRADOR para: a.- Celebrar los
        contratos de arrendamientos respectivos, bajo las garantías que sean oportunas a su juicio y la fianza. b.- cobrar a los
        arrendatarios el valor de los arrendamientos y una vez recibidos entregarlos a EL PROPIETARIO mensualmente o, seguir
        las instrucciones que éste le dé sobre el particular, previa deducción de la comisión que corresponde al ADMINISTRADOR
        y de los gastos que éste haya efectuado por cuenta de EL PROPIETARIO. c.- Efectuar por cuenta de EL PROPIETARIO
        las reparaciones locativas que el ADMINISTRADOR juzgue convenientes para la conservación del inmueble o para
        facilitar su arrendamiento, previa comunicación y autorización de EL PROPIETARIO y/o las contempladas en el artículo
        1982 del Código Civil.
        SÉPTIMO: OBLIGACIONES DEL PROPIETARIO: a. - EL PROPIETARIO se compromete a pagar a El ADMINISTRADOR,
        una comisión del 10% más el IVA, más el 2.5% mensual de la prima de fianza de arrendamiento, del valor mensual del
        canon de arrendamiento, además reconocerá el valor de las estampillas y demás descuentos que se efectúen sobre el
        canon cuando el arrendatario sea una entidad oficial, para lo cual el administrador podrá descontar del valor total del
        arrendamiento de cada mes. b.- Rembolsar al ADMINISTRADOR el valor de los gastos en que esta incurre por
        negligencia, renuencia, mora o falta de decisión de EL PROPIETARIO en el mantenimiento del inmueble en buenas
        condiciones de habitabilidad. c.- En caso de que EL PROPIETARIO enajenaré el inmueble, le reconocerá al
        ADMINISTRADOR las comisiones faltantes hasta la fecha de terminación del contrato de administración del inmueble, de
        este modo se da por culminado dicho contrato. d.- En caso de venta del inmueble, EL PROPIETARIO deberá cumplir con
        los términos que la Ley de arrendamiento, Ley 820 de julio 10 de 2003, determina en sus artículos 22 numerales 7 y 8
        literal c y 23. e.- Asumir el costo de los gastos judiciales de cobranza y de restitución del inmueble, cuando la escogencia
        del arrendatario haya sido de su criterio y voluntad o en su defecto el abogado cobrará estos honorarios al inquilino o
        deudores solidarios a la culminación del negocio. f.- Fijar el valor del arrendamiento y respetar éste durante el término que
        fije la ley. g.- Respetar las políticas de incremento del arrendamiento que fije el ADMINISTRADOR, las cuales se basan en
        los ajustes autorizados por la ley y la justicia. o.- Abstenerse de ejecutar actos o convenios con los arrendatarios, sin el
        previo acuerdo o aceptación del ADMINISTRADOR. h.- En caso que el propietario no cuente con una cuenta bancaria
        autorizara a un tercero para que le sea consignado el valor del arrendamiento.
        OCTAVO: EL ADMINISTRADOR mantendrá informado a EL PROPIETARIO sobre ofertas y contacto que se presenten a
        efecto de obtener la autorización sobre el precio de arriendo, en caso de que el precio ofrecido fuere con personas
        potencialmente interesadas en adquirir el inmueble.
        NOVENO: EL ADMINISTRADOR se obliga a dar asesoría a EL PROPIETARIO y al ARRENDATARIO, en todas las
        gestiones y actuaciones relativas al arrendamiento del bien inmueble. Si EL PROPIETARIO optare por desechar estos
        servicios adicionales, la comisión se hará efectiva en su totalidad.

        P
        A
        G
        E
        2

        DÉCIMO. EL ADMINISTRADOR se obliga a comunicar en forma confidencial a EL PROPIETARIO sobre las observaciones
        Que los potenciales arrendatarios le hagan sobre el inmueble, su precio, etc. a efecto de que él tome las determinaciones
        que considere convenientes.
        DÉCIMO PRIMERO. EL ADMINISTRADOR ofrecerá el inmueble consignado, bajo las condiciones de pago autorizadas
        por EL PROPIETARIO.
        DÉCIMO SEGUNDO: GARANTÍA DE PAGO: El ADMINISTRADOR garantiza tanto el pago de arrendamientos, siempre y
        cuando el PROPIETARIO haya contratado a través del ADMINISTRADOR la fianza de arrendamiento.
        DÉCIMO TERCERO: PRÓRROGA DEL CONTRATO: Si en el desarrollo del presente contrato quedará algún mes un
        saldo a cargo del PROPIETARIO y a favor del ADMINISTRADOR (A) este contrato se considera prorrogado, aun cuando
        el PROPIETARIO haya manifestado su deseo de darlo por terminado, hasta tanto que dicho saldo a cargo del
        PROPIETARIO esté totalmente cubierto. Si fuere el ADMINISTRADOR (A) quien desearé terminar el contrato, una vez
        vencido el término de sesenta (60) días contados desde la fecha en que haya dado aviso a través de correo electrónico o
        por carta al PROPIETARIO, cesarán todas sus obligaciones y no podrá ser responsable por hecho alguno que ocurran
        después del plazo mencionado, y en ese evento, si por cualquier circunstancia resultaré algún saldo insoluto a favor del
        ADMINISTRADOR (A) por causa de su gestión, dicho valor será pagado por el PROPIETARIO al ADMINISTRADOR (A) o
        en su orden, a la presentación de la cuenta respectiva.
        DÉCIMO CUARTO: MERITO EJECUTIVO: Este contrato presta mérito ejecutivo para exigir el cumplimiento de todas las
        obligaciones contraídas entre las partes. Las partes renuncian expresamente a los requerimientos para el pago de las
        obligaciones derivadas del mismo
        DÉCIMO QUINTO: RESPONSABILIDAD DEL ADMINISTRADOR: EL ADMINISTRADOR: se hará responsable y
        cancelará los arrendamientos adeudados por los inquilinos, hasta el día en que estos hayan ocupado el inmueble objeto
        del presente contrato. El presente contrato no implica para EL ADMINISTRADOR (A), en ningún caso, responsabilidad
        alguna por falta de pago de las reparaciones, servicios públicos, cuota de administración y demás que deban cubrir los
        inquilinos, pero es entendido que procurara el oportuno pago de ellos y el cumplimiento esmerado de las estipulaciones de
        este convenio que le sean concernientes. En caso de existir el seguro o Fianza de las coberturas acordadas con EL
        PROPIETARIO, se efectuará el reembolso de estos, hasta el monto asegurado, cinco (5) días hábiles después de que la
        Compañía Aseguradora o Afianzadora haya pagado los servicios, para lo cual el PROPIETARIO deberá presentar
        previamente los recibos debidamente cancelados y la respectiva constancia de pago al ADMINISTRADOR (A). En igual
        sentido, El ADMINISTRADOR (A) no se hace responsable por hurtos, incendios, inundaciones, daños, y/o otros similares,
        que se presenten en la propiedad, o usos diferentes por terceros u ocupación de hecho
        DÉCIMO SEXTO: DESOCUPACIÓN DEL BIEN: Si el inmueble fuere desocupado por los arrendatarios después de
        vencido el término inicial del contrato de arrendamiento, no habrá lugar a indemnización alguna. Si el inmueble es
        desocupado durante el término inicial del arrendamiento, el PROPIETARIO autoriza al ADMINISTRADOR (A), para que
        llegado el caso negocie con los arrendatarios el valor de la indemnización prevista por el incumplimiento en el contrato de
        arrendamiento o los exonere, y su pago solo se hará efectivo en el momento en que sea recibido por el ADMINISTRADOR
        (A) y únicamente por el monto recaudado, descontando la respectiva comisión del 10% que se aplicará sobre el total de la
        suma recibida. En caso del ADMINISTRADOR aplicar procesos de restitución de inmueble arrendado por incumplimiento
        del contrato, por ser un riesgo para el mismo de recaudar efectivamente el dinero a través de un proceso judicial, el
        PROPIETARIO renuncia a la cláusula penal establecida en el contrato, y la deja a criterio del ADMINISTRADOR, cobrarla
        o no. En caso de cobrar la misma, este dinero será de propiedad exclusiva del ADMINISTRADOR.
        DÉCIMO SÉPTIMO: En el caso de que se llegue a presentar abandono del inmueble por parte del inquilino en cualquier
        momento, la Inmobiliaria procederá inmediatamente a tomar posesión del inmueble, para lo cual se informará al propietario,

        P
        A
        G
        E
        2

        bien sea para su devolución o para nuevamente colocarlo en arrendamiento. Hasta la fecha de recuperación del inmueble,
        se cancelará el valor del arrendamiento por $ __________________, quedando suspendida por este hecho la
        responsabilidad de la Inmobiliaria en el pago acordado.
        DÉCIMO OCTAVO: VENTA DEL INMUEBLE: En caso de que él (los) inmueble (s) objeto de este contrato fuere
        comprado por el arrendatario o por cualquier otra persona, EL PROPIETARIO cancelará a EL ADMINISTRADOR el valor
        de la comisión de venta, según tarifas vigentes. El administrador gestionará los trámites de venta respectivos, si así lo
        pidiere EL PROPIETARIO.
        DÉCIMO NOVENO: FALLECIMIENTO DEL PROPIETARIO: En caso de muerte de EL PROPIETARIO, EL
        ADMINISTRADOR, suspenderá la entrega de los arrendamientos hasta que sea notificado de la escritura pública donde
        se informe el nuevo propietario, sentencia judicial o con poder firmado por los herederos.
        VIGÉSIMO: EL PROPIETARIO manifiesta que obra de buena fe, no existiendo en su contra proceso de extinción de
        dominio por enriquecimiento ilícito derivado de cualquier tipo penal, y además que el inmueble a que se refiere este
        contrato está libre de pleitos o embargos vigentes; así mismo, EL PROPIETARIO se obliga a suministrar a LA
        INMOBILIARIA en forma fidedigna todos los datos sobre la titulación del inmueble, así como cualquier otro que permita
        ofertarlo sin incurrir en información que no corresponda con la realidad, tales como: capacidad eléctrica instalada,
        servicios instalados, restricciones de uso, defectos conocidos sobre cañerías, desagües, etc. Por lo tanto, es obligación de
        EL PROPIETARIO aportar a LA INMOBILIARIA al momento de realizar el contrato de arriendo: fotocopia de la parte
        normativa del reglamento de propiedad horizontal, manual de convivencia y cualquier otra reglamentación que opere en
        los inmuebles sometidos a este régimen. EL PROPIETARIO es el único y exclusivo responsable judicial, administrativa y
        patrimonialmente, sobre hechos relacionados con vicios redhibitorios, información inexacta que dé lugar a publicidad
        engañosa, errores de escrituración, así como sobre cualquier otro que pudiere derivar en cualquier clase de litigio; y por
        ello EL PROPIETARIO, mantendrá indemne a LA INMOBILIARIA de cualquier perjuicio, tanto durante la ejecución, como
        después de finalizado el presente contrato, en razón a lo cual las partes otorgan al presente numeral los efectos de cosa
        juzgada material.
        VIGÉSIMO PRIMERO: COMUNICACIONES: EL PROPIETARIO se obliga a comunicar única y exclusivamente a EL
        ADMINISTRADOR las observaciones, dudas o inconvenientes que surjan sobre el inmueble o sobre el potencial
        ARRENDATARIO. a.- Al tratarse EL ADMINISTRADOR de una persona jurídica cuyo objeto es la administración Inmobiliaria
        de bienes inmuebles para corretaje inmobiliario, EL PROPIETARIO acepta que solo podrá hacer responsable a EL
        ADMINISTRADOR de los hechos que el mismo comunique a este. b.- EL PROPIETARIO reconoce que su único canal
        exclusivo de comunicación con el ARRENDATARIO del inmueble es a través de EL ADMINISTRADOR. c.- En el evento que
        EL PROPIETARIO por medios ajenos a EL ADMINISTRADOR se comunique con el ARRENDATARIO del bien inmueble y
        exponga o llegue a acuerdos con este sobre daños, problemas, arreglos generados con el inmueble, excluye de cualquier
        responsabilidad a El Administrador.
        VIGÉSIMO SEGUNDO: Entre EL ADMINISTRADOR y EL PROPIETARIO no existirá relación laboral, toda vez que LA
        INMOBILIARIA actúa como contratista independiente.
        VIGÉSIMO TERCERO: EL PROPIETARIO acepta y reconoce que le ha sido socializada la política de tratamiento de datos
        personales por parte de EL ADMINISTRADOR y que autoriza el uso de los datos personales que ha suministrado para el
        presente contrato, se anexa política de tratamiento de datos el cual hace parte integral del presente contrato.
        VIGÉSIMO CUARTO: EL PROPIETARIO declara expresamente que el origen de sus ingresos proviene de actividad licita
        ejercida entre los parámetros legales y que se encuentran libres de las contempladas en el Código Penal Colombiano. a.-
        La información suministrada en el presente contrato son suministradas por EL PROPIETARIO, por lo tanto, toda falsedad,
        error u omisión en ellas será responsabilidad exclusiva del EL PROPIETARIO. PARÁGRAFO SEGUNDO: EL
        PROPIETARIO se obliga para con EL ADMINISTRADOR a mantener actualizada la información suministrada, para lo cual
        se comprometen a reportar por lo menos una vez cada 3 meses de ser necesario los cambios que se hayan generado

        P
        A
        G
        E
        2

        respecto a la información suministrada. Se anexa formulario de conocimiento del cliente, persona natural, el cual hace
        parte integral del contrato.
        VIGÉSIMO QUINTO: LAS PARTES reconocen la naturaleza confidencial de cualquier información que no sea del dominio
        Público y que haga parte de la política de tratamiento de datos, que llegue a tenerse en el proceso de celebración y
        ejecución de este contrato y se obligan a no utilizarla en beneficio propio o ajeno, ni a divulgar a ningún tercero, sin
        permiso previo escrito de la parte a la cual pertenece. A.- Las partes se comprometen a través de este contrato a guardar
        absoluta reserva y confidencialidad por 6 meses más posterior a la fecha de expiración del contrato. b.- Se excluye de la
        cláusula de confidencialidad, la información suministrada a empleados y colaboradores con ocasión al cumplimiento del
        contrato. c.- La cláusula de confidencialidad no será obligatoria en los eventos que la ley lo requiera, es decir; cuando por
        medio de orden legal emitida por autoridad legal competente se solicite el suministro de información, documentos y
        materiales. LAS PARTES acuerdan comunicar, dar aviso a la otra en caso de requerimiento judicial que verse sobre la
        información aquí suministrada o que pueda afectar el objeto del presente contrato. d.- Las obligaciones establecidas en
        esta cláusula, sobrevivirán a la expiración o terminación de este contrato.
        VIGÉSIMO SEXTO: LAS PARTES acuerdan y aceptan que el presente contrato, junto con los documentos que forman
        parte integral del mismo, y a los que haya lugar de conformidad con la ley, por contener obligaciones claras, expresas y
        exigibles, presta MÉRITO EJECUTIVO para exigir el pago de las sumas estipuladas por concepto de comisiones,
        honorarios, intereses moratorios, gestiones de cobro, así como cualquier otra suma a cargo de EL PROPIETARIO.
        Cualquier suma derivada del presente contrato, será exigible por la vía ejecutiva sin necesidad de los requerimientos
        previos ni constitución en mora de que tratan los Arts. 1594 y 1595 del Código Civil,
        derechos estos a los que renuncia expresamente EL PROPIETARIO, así como cualquier otro que sea establecido en
        alguna norma de carácter procesal o sustancial. Otorgándole las partes, al contenido del presente contrato, los efectos de
        cosa juzgada material.
        VIGÉSIMA SÉPTIMO: EL PROPIETARIO recibirá notificaciones en la dirección de residencia ______________________,
        municipio ___________________. Correo electrónico ____________________, teléfono __________________, dirección
        de trabajo ______________________________ y EL ADMINISTRADOR recibirá notificaciones en la Carrera 9 No. 5-39
        Barrio Centro de Villa del Rosario, correo electrónico Inmobiliarialaurarivera@gmail.com, teléfono 3043849768.

        En señal de conformidad, los contratantes suscriben este documento en dos ejemplares del mismo tenor y valor, a los
        ____________ ( ) días del mes de _____________ de _________ del municipio de Villa del Rosario.

        EL ADMINISTRADOR

        ______________________________________
        ROMAN GABRIEL APONTE FERRER
        REPRESENTANTE LEGAL
        CONSTRUCTORA INMOBILIARIA LAURA RIVERA SAS

        EL PROPIETARIO

        ______________________________________
        _________________________________
        C.C. _________
        TEL: ___________

        P
        A
        G
        E
        2

        E-mail: _____________</p>
</div>

<?php
$html = ob_get_clean();
$dompdf->loadHtml($html);
$dompdf->setPaper('letter');

$dompdf->render();

$dompdf->stream("archivo.pdf", array("Attachment" => false));
