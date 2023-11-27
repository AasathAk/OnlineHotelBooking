<?php

require_once('vendor/autoload.php');
use Dompdf\Dompdf;
$dompdf =new Dompdf();
$html ='<h1>hello</h1>';
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream();
?>