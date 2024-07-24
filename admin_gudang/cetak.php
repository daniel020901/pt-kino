<?php
ob_start();
include "./cetakbarang.php";
$content = ob_get_clean();

require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$dompdf = new Dompdf();

$dompdf->loadHtml($content);

$dompdf->setPaper('A4', 'landscape');

$dompdf->render();

$dompdf->stream("Permintaan", array("Attachment" => false));
?>
