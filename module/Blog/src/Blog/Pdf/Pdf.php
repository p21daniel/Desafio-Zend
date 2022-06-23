<?php

namespace Blog\Pdf;

use Fpdf\Fpdf;

/**
 * Class Pdf
 * @package Blog\Pdf
 */
class Pdf extends Fpdf
{

    /**
     * Header of PDF
     */
    function Header()
    {
        if ( $this->PageNo() === 1 ) {
            // Arial Bold 20
            $this->SetFont('Arial','B',20);
            $this->SetTextColor(128);
            // Move to the right (in this case with not landscape page, the title is centered)
            $this->Cell(80);
            // Title
            $this->Cell(30,10,utf8_decode('Relatório de Listagem de Postagens do Blog'),0,0,'C');
            // Line break
            $this->Ln(20);
        }
    }

    /**
     * Footer of PDF
     */
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }
}