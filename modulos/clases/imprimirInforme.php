<?php

require_once './clases/MYSQL.php';
require_once './clases/fpdf.php';

class pdf extends FPDF
{



    function header()
    {

        $this->SetFont('Arial', 'B', 16);

        $this->Cell(60);

        $this->Cell(160, 10, 'Reporte de productos', 0, 0, 'C');

        $this->Ln(20);

        $this->Cell(50, 10, 'id', 1, 0, 'C', 0);
        $this->Cell(50, 10, 'Nombre', 1, 0, 'C', 0);
        $this->Cell(50, 10, 'Cantidad', 1, 0, 'C', 0);
        $this->Cell(50, 10, 'Imagen', 1, 0, 'C', 0);
        $this->Cell(50, 10, 'Estado', 1, 1, 'C', 0);
    }


    function footer()
    {


        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Pagina') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}




$mysql = new MYSQL();

$mysql->conectar();
$consulta = $mysql->efectuarConsulta("SELECT * FROM productos.productos");

// Crear una instancia de la clase FPDF
$mysql->desconectar();



$FPDF = new PDF('L', 'mm', 'A4');
$FPDF->AddPage();
$FPDF->AliasNbPages();
$FPDF->SetFont('Arial', 'B', 16);

$estado = '';
while ($row = $consulta->fetch_array()) {
    if ($row['estado'] != 0) {
        $estado = 'Activo';
    } else {
        $estado = 'Inactivo';
    }

    $FPDF->Cell(50, 20, $row['id_producto'], 1, 0, 'C', 0);
    $FPDF->Cell(50, 20, $row['nombre_producto'], 1, 0, 'C', 0);
    $FPDF->Cell(50, 20, $row['cantidad'], 1, 0, 'C', 0);
    $FPDF->Cell(50, 20, $row['imagen'], 1, 0, 'C', 0);
    $FPDF->Cell(50, 20, $estado, 1, 1, 'C', 0);$FPDF->Image('../assets/media/productos/messi.jpg')
}

$FPDF->Output();
