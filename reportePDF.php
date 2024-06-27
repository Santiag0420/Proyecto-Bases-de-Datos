<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo

    // Arial bold 15
    $this->SetFont('Arial','B',18);
    // Movernos a la derecha
    $this->Cell(30);
    // Título
    $this->Cell(140,20, utf8_decode('Informe de usuarios registrados'),0,0,'C');
    // Salto de línea
    $this->Ln(20);
    $this->Cell(100, 10, utf8_decode('Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa quod necessitatibus sapiente magni nam, quasi libero expedita explicabo minus vitae obcaecati deserunt. Provident esse mollitia minima amet aperiam dolorem dolor. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consequatur nam et quisquam fugit consectetur ipsum, facilis, fuga distinctio facere, magnam exercitationem dolore saepe at. Exercitationem dicta laborum et cumque sapiente!'),0,0,"L");
    $this->Cell(50,10,'Username', 1, 0, 'C',0);
    $this->Cell(100,10,'Email', 1, 0, 'C',0);
    $this->Cell(40,10,utf8_decode('Contraseña'), 1, 1, 'C',0);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
require 'includes/conexion.php';
$consulta = "SELECT usuario, archivo, fecha as cantidadArchivos FROM misarchivos group by usuario";
$resultado = $conexion->query($consulta);

$pdf = new PDF();
$pdf->AddPage();
$pdf-> AliasNbPages();
$pdf->SetFont('Arial','',16);

while($row = $resultado->fetch_assoc()){
    if(strlen($row['usuario'])>15 and strlen($row['usuario'])>15){
        $pdf->Cell(50,10,substr($row['usuario'],0,15), 1, 0, 'C',0);
        $pdf->Cell(100,10,substr($row['archivo'],0,15), 1, 0, 'C',0);
        $pdf->Cell(40,10,$row['fecha'], 1, 1, 'C',0);
    }else if(strlen($row['usuario'])>15){
        $pdf->Cell(50,10,substr($row['usuario'],0,15), 1, 0, 'C',0);
        $pdf->Cell(100,10,$row['archivo'], 1, 0, 'C',0);
        $pdf->Cell(40,10,$row['fecha'], 1, 1, 'C',0);
    }else if(strlen($row['archivo'])>15){
        $pdf->Cell(50,10,$row['usuario'], 1, 0, 'C',0);
        $pdf->Cell(100,10,substr($row['archivo'],0,15), 1, 0, 'C',0);
        $pdf->Cell(40,10,$row['fecha'], 1, 1, 'C',0);
    }
    
}

$pdf->Output();
?>