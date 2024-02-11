<?php
// Encabezado para indicar que se va a descargar un archivo Excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="reporte.xlsx"');

// Incluir la clase de PhpSpreadsheet
require '../modulos/clases/vendor/autoload.php';

// Crear una instancia de Spreadsheet
$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

require './clases/MYSQL.php';

$mysql = new MYSQL();
$mysql->conectar();
$consulta = $mysql->efectuarConsulta("SELECT * FROM productos.productos");

$sheet->setCellValue('A1', 'Id');
$sheet->setCellValue('B1', 'Nombre');
$sheet->setCellValue('C1', 'Cantidad');
$sheet->setCellValue('D1', 'Imagen');
$sheet->setCellValue('E1', 'Estado');
$sheet->setCellValue('F1', 'Nombre Usuario');

$i = 2; // Empezamos desde la fila 2

while ($fila = mysqli_fetch_array($consulta)) {
    
    $estado = ($fila['estado'] == 1) ? 'Activo' : 'Inactivo';
    $consultaUser = $mysql->efectuarConsulta("SELECT nombre_usuario FROM productos.usuarios where usuarios.id_usuario = $fila[5]");
    while ($fila1 = mysqli_fetch_array($consultaUser)) {
        $sheet->setCellValue('A' . $i, $fila['id_producto']);
        $sheet->setCellValue('B' . $i, $fila['nombre_producto']);
        $sheet->setCellValue('C' . $i, $fila['cantidad']);
        $sheet->getRowDimension($i)->setRowHeight(50);
    
        // Insertar la imagen en la celda D
        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setName('Imagen');
        $drawing->setDescription('Imagen');
        $drawing->setPath(str_replace(" ../", "../", $fila['imagen']));
        $drawing->setHeight(50); // Tamaño de la imagen
        $drawing->setCoordinates('D' . $i);
        $drawing->setWorksheet($sheet);
        $sheet->setCellValue('E' . $i, $estado);
        $sheet->setCellValue('F' . $i, $fila1[0]);
        $i++;
    }
}

// Crea un objeto de Writer
$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
// Guarda el archivo en la salida
$writer->save('php://output');
$mysql->desconectar();