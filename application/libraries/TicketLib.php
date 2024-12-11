<?php

//use FPDF;

class TicketLib{

    public function __construct() {

        require_once(APPPATH . '../vendor/autoload.php');
        //require('fpdf/fpdf.php');
        //require_once(APPPATH . '../vendor/fpdf.php');
    }

    function Ticket() {
        // Puedes personalizar el encabezado aquí

        $pdf = new FPDF('P', 'mm', array(80, 250)); // Tamaño del ticket
        $pdf->AddPage();
        
        $pdf->SetMargins(5, 5, 5);
        $pdf->SetFont('Arial', 'B', 9);

        // Logo del restaurante
        $pdf->Image('img/logoo.png', 25, 0, 30);

        // Nombre del restaurante
        $pdf->Ln(3);
        $pdf->Cell(70, 5, 'Restaurante', 0, 1, 'C');

        $pdf->Ln(3);
        // Dirección
        $pdf->SetFont('Arial', '', 8);
        $pdf->MultiCell(70, 4, 'Av. Arco Bincentenario, Mza. 11,', 0, 'C');
        $pdf->MultiCell(70, 4, 'Lote 1119-33 Sm 255,', 0, 'C');
        $pdf->Cell(70, 4, mb_convert_encoding('77500 Cancún, Q.R.', 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');

        // Línea de separación
        $pdf->Ln(8);
        $pdf->Cell(70, 2, '-----------------------------------------------------------------', 0, 1, 'C');

        // Número de ticket y fecha-hora
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(21, 5, 'Num. de ticket: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(15, 5, '0001', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(19, 5, date('d/m/Y H:i'), 0, 1, 'R');

        // Atendido por
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(30, 5, 'Cliente: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(40, 5, 'Juan', 0, 1, 'R');

        // Número de mesa y comensales
        // $pdf->Cell(30, 5, 'Mesa: ', 0, 0, 'L');
        // $pdf->Cell(20, 5, 'D5', 0, 1, 'L');
        // $pdf->Cell(20, 5, 'Comensales: 4', 0, 1, 'R');

        // Línea de separación
        $pdf->Ln(2);
        $pdf->Cell(70, 2, '-----------------------------------------------------------------', 0, 1, 'C');

        // Descripción de productos
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(30, 4, 'Descripcion', 0, 0, 'L');
        $pdf->Cell(20, 4, 'Unidad', 0, 0, 'C');
        $pdf->Cell(20, 4, 'Precio', 0, 1, 'R');

        // Línea de separación
        $pdf->Cell(70, 2, '-----------------------------------------------------------------', 0, 1, 'C');

        // Ejemplo de productos
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(30, 5, 'Tacos', 0, 0, 'L');
        $pdf->Cell(20, 5, '3', 0, 0, 'C');
        $pdf->Cell(20, 5, '$90.00', 0, 1, 'R');

        $pdf->Cell(30, 5, 'Refresco', 0, 0, 'L');
        $pdf->Cell(20, 5, '2', 0, 0, 'C');
        $pdf->Cell(20, 5, '$50.00', 0, 1, 'R');

        // Subtotal, IVA, descuento y total
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 8);
        // $pdf->Cell(50, 5, 'Subtotal: ', 0, 0, 'R');
        // $pdf->Cell(20, 5, '$0.00', 0, 1, 'R');
        // $pdf->Cell(50, 5, 'Descuento: ', 0, 0, 'R');
        // $pdf->Cell(20, 5, '$0.00', 0, 1, 'R');
        $pdf->Cell(50, 5, 'Total: ', 0, 0, 'R');
        $pdf->Cell(20, 5, '$0.0', 0, 1, 'R');
        $pdf->Cell(50, 5, 'Importe: ', 0, 0, 'R');
        $pdf->Cell(20, 5, '$0.0', 0, 1, 'R');
        $pdf->Cell(50, 5, 'Cambio: ', 0, 0, 'R');
        $pdf->Cell(20, 5, '$0.0', 0, 1, 'R');

        // Promociones de descuento
        // $pdf->Ln(5);
        // $pdf->SetFont('Arial', 'B', 8);
        // $pdf->Cell(50, 5, 'Promociones aplicadas: ', 0, 1, 'L');
        // $pdf->SetFont('Arial', '', 8);
        // $pdf->Cell(70, 5, 'Descuento especial 10%', 0, 1, 'L');

        // Total de descuentos
        // $pdf->SetFont('Arial', 'B', 8);
        // $pdf->Cell(50, 5, 'Total de descuentos: ', 0, 0, 'R');
        // $pdf->SetFont('Arial', '', 8);
        // $pdf->Cell(20, 5, '$10.00', 0, 1, 'R');

        // Método de pago
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(50, 5, 'Metodo de pago: ', 0, 0, 'R');
        $pdf->Cell(20, 5, 'EFECTIVO', 0, 1, 'R');

        // Mensaje de agradecimiento
        $pdf->Ln(5);
        $pdf->SetFont('Arial', '', 8);
        $pdf->MultiCell(70, 5, 'Gracias por su visita. Si quieres obtener mas informacion sobre nuestros productos y promociones disponibles, visita nuestra pagina', 0, 'C');
        $pdf->SetFont('Arial', 'U', 8);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->MultiCell(70, 5, 'www.kotenjanal.com', 0, 'C');

        $pdf->Output('I', 'Ticket.pdf');
    }
}

?>