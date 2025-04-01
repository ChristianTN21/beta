
<?php
ob_start(); // Iniciar el almacenamiento en búfer de salida

require_once $_SERVER['DOCUMENT_ROOT'] . "/Estadia/config/connect_db.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Estadia/config/BD.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Estadia/config/config.php";

$ClientID = "AeAu_f7LeBwCaoXBzFGATtN3Xk4jM4XbDC-NBO9oFMCY56D6xyfncLnUWany1s3LX_UrccWxfd4Q9Rc1";
$Secret = "EElzVRtUOc1lK0atVav09GN8KlvkuCHoKBgnzFjujtsRGZqXRPHw2hpS-RNc5ILcjCn5x8NViS46y9R0";

$login = curl_init("https://api.sandbox.paypal.com/v1/oauth2/token");
curl_setopt($login, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($login, CURLOPT_USERPWD, $ClientID . ":" . $Secret);
curl_setopt($login, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
$respuesta = curl_exec($login);

$objRespuesta = json_decode($respuesta);
$AccessToken = $objRespuesta->access_token;

$venta = curl_init("https://api.sandbox.paypal.com/v1/payments/payment/" . $_GET['paymentID']);
curl_setopt($venta, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $AccessToken));
curl_setopt($venta, CURLOPT_RETURNTRANSFER, TRUE);
$respuestaVenta = curl_exec($venta);

$objDatosTransaccion = json_decode($respuestaVenta);
$email = $objDatosTransaccion->payer->payer_info->email;
$state = $objDatosTransaccion->state;
$total = $objDatosTransaccion->transactions[0]->amount->total;
$currency = $objDatosTransaccion->transactions[0]->amount->currency;
$custom = $objDatosTransaccion->transactions[0]->custom;
$clave = explode("#", $custom);
$SID = $clave[0];
$nombreventa = openssl_decrypt($clave[1], COD, KEY);

ob_end_clean(); // Limpiar (borrar) el búfer de salida sin enviarlo

// Enlistar los datos de la variable custom
$datosCustom = explode("#", $custom);

// Incluir la biblioteca FPDF
require_once $_SERVER['DOCUMENT_ROOT'] . "/Estadia/RECEIPT-main/fpdf.php";

// Crear una instancia de FPDF con el diseño del ticket
$pdf = new FPDF('P', 'mm', array(80, 150)); // Ancho: 80mm, Altura: 150mm
$pdf->AddPage();

// Insertar imagen como fondo (reemplaza 'Logo-03.png' con la ruta de tu imagen)
$pdf->Image('../img_pagina/Logo-03.png', 0, 0, 80, 150);

// Configurar fuente y tamaño
$nombreventa = str_replace(',', "\n", $nombreventa);

// Configurar fuente y tamaño
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Ticket de Kafetzin-coffe', 0, 1, 'C');
$pdf->Cell(0, 5, '----------------------------------------', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
// Enlistar los datos de la variable $nombreventa




$pdf->Ln(5);
$pdf->MultiCell(0, 10, $nombreventa);
$pdf->Cell(0, 5, '------------------------------------------------', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Total: ' . $total . ' ' . $currency, 0, 1);
// Enlistar los datos de la variable custom


// Guardar el PDF en una variable
$previewPdfContent = $pdf->Output('', 'S');

// Mostrar el PDF en el navegador
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename=preview.pdf');
header('Content-Transfer-Encoding: binary');
header('Accept-Ranges: bytes');
echo $previewPdfContent;
exit();
?>

