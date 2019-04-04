<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'application/third_party/fpdf/fpdf.php';
    
class unduhpdf extends FPDF {

    function __construct($posisi = 'L', $ukuran = 'mm', $kertas = 'A4') {
        parent::__construct($posisi, $ukuran, $kertas);
    }
        
    function Header() {
        $this->Image($GLOBALS['image'], 10, 9, -5000);
        $this->Image($GLOBALS['image'], 277, 9, -5000);
        
        $this->SetFont('Arial', 'B', 18);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(277, 7, $GLOBALS['title'], 0, 1, 'C');
        
        $this->SetFont('Arial', 'B', 16);
        $this->SetTextColor(221, 75, 57);
        $this->Cell(277, 7, $GLOBALS['subtitle'], 0, 1, 'C');
        
        $this->Ln(10);
        
        $this->SetFont('Arial', 'B', 8);
        $this->SetTextColor(16, 174, 249);
        
        for ($no = 1; $no <= $GLOBALS['h_max']; $no++) {
            $this->Cell($GLOBALS['h_'.$no]['Width'], 5, $GLOBALS['h_'.$no]['Judul'], 'B', 0, $GLOBALS['h_'.$no]['Align']);
        }
        
        $this->Ln(5);
    }
        
    function Footer() {        
        $this->SetY(-15);    
        
        $lebar = $this->w;    
        
        $this->line($this->GetX(), $this->GetY(), $this->GetX() + $lebar - 20, $this->GetY());
        
        $this->SetY(-15);
        $this->SetX(0);        
        $this->Ln(1);
        
        $this->SetFont('Arial', 'I', 8);            
        $this->SetTextColor(0, 0, 0);
        
        $hal = 'Halaman : '.$this->PageNo().' dari {nb} halaman';
        $tanggal  = 'Di Unduh : '.date('d').' '.bulan(date('m'), 'F').' '.date('Y').' - '.date('H:i');
        
        $this->Cell($this->GetStringWidth($hal), 10, $hal);
        $this->Cell($lebar - $this->GetStringWidth($hal) - $this->GetStringWidth($tanggal) - 20);
        $this->Cell($this->GetStringWidth($tanggal), 10, $tanggal);    
    } 
}

?>
