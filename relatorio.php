<?php

require('fpdf/fpdf.php');
include('conexao.php');

$pdf = new FPDF();
$pdf->AddPage('L');

$pdf -> Image("logo.png", 10,10,40);

$pdf->SetFont('Arial','B',16);
$pdf->Cell(190,10,utf8_decode('Relatório de Clientes e Carros'),0,1,'C');

$pdf->Cell(
    190,
    10,
    'Gerado em: '.date('d/m/Y H:i:s'),
    0,
    1,
    'R'
);



$pdf->Ln(5);

$pdf->SetFont('Arial','B',10);

$pdf->Cell(10,10,'ID',1);
$pdf->Cell(90,10,'Cliente',1);
$pdf->Cell(35,10,'Contato',1);
$pdf->Cell(20,10,'Placa',1);
$pdf->Cell(40,10,'Veiculo',1);
$pdf->Cell(40,10,'Cadastrado Por',1);

$pdf->Ln();


$sql = "SELECT c.*, u.nome AS cadastrado_por 
        FROM clientes c
        INNER JOIN usuarios u ON c.usuario_id = u.id";

$res = $pdo->query($sql);

$pdf->SetFont('Arial','',10);

while($row = $res->fetch(PDO::FETCH_OBJ)){

    $pdf->Cell(10,10,$row->id,1);
    $pdf->Cell(90,10,utf8_decode($row->nome),1);
    $pdf->Cell(35,10,utf8_decode($row->telefone),1);
    $pdf->Cell(20,10,$row->carro_placa,1);
    $pdf->Cell(40,10,utf8_decode($row->carro_marca . ' - ' . $row->carro_modelo),1);
    
    
    $pdf->Cell(40,10,utf8_decode($row->cadastrado_por),1);

    $pdf->Ln();
}

$pdf->Output('I','relatorio_clientes.pdf');

?>