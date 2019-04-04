<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unduh extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        
        $this->load->model('Perusahaan');
        
        date_default_timezone_set('Asia/Jakarta');
	}
    
    function DataPelanggan() {
        $pdf = new unduhpdf('L', 'mm', 'A4');
        
        foreach ($this->Perusahaan->AmbilData() as $data) {
            $GLOBALS['image'] = base_url().'assets/dist/img/logo/'.$data->Logo;
            $GLOBALS['title'] = 'KPI '.$data->NamaPerusahaan;
            $pdf->SetTitle($GLOBALS['title']);
        }
        
        $GLOBALS['subtitle'] = 'DATA PELANGGAN';
        
        $status = $this->input->get('status');
        
        $this->load->model('Pelanggan/Pelanggan');
        
        $pelanggan = $this->Pelanggan->AmbilDataSemua($status);
        
        $GLOBALS['h_max'] = 3;
        
        $GLOBALS['h_1'] = array(
            'Judul' => 'Pelanggan',
            'Width' => 77,
            'Align' => 'L'
        );
        
        $GLOBALS['h_2'] = array(
            'Judul' => 'Alamat Lengkap',
            'Width' => 165,
            'Align' => 'L'
        );
        
        $GLOBALS['h_3'] = array(
            'Judul' => 'No. Telepon',
            'Width' => 35,
            'Align' => 'L'
        );
        
        $pdf->AddPage();
        
        foreach ($pelanggan as $data) {
            $pdf->SetFont('Arial', '', 8);
            
            if ($data->Status == 'Tidak Aktif') {
                $pdf->SetTextColor(221, 75, 57);    
            } else {
                $pdf->SetTextColor(0, 0, 0);
            }
            
            $pdf->Cell(77, 5, $data->NoPelanggan.' - '.$data->NamaPelanggan, 0, 0);
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(165, 5, $data->AlamatLengkap.', '.$data->KabupatenKota.', '.$data->Provinsi.', '.$data->KodePos, 0, 0);
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(35, 5, $data->NoTelepon, 0, 1);
        }
        
        $GLOBALS['h_max'] = 5;
        
        $GLOBALS['h_1'] = array(
            'Judul' => 'Pemasok',
            'Width' => 77,
            'Align' => 'L'
        );
        
        $GLOBALS['h_2'] = array(
            'Judul' => 'Email',
            'Width' => 50,
            'Align' => 'L'
        );
        
        $GLOBALS['h_3'] = array(
            'Judul' => 'Penjual',
            'Width' => 70,
            'Align' => 'L'
        );
        
        $GLOBALS['h_4'] = array(
            'Judul' => 'Rayon',
            'Width' => 70,
            'Align' => 'L'
        );
        
        $GLOBALS['h_5'] = array(
            'Judul' => 'Level Harga',
            'Width' => 10,
            'Align' => 'L'
        );
        
        $pdf->AddPage();
        
        foreach ($pelanggan as $data) {
            $pdf->SetFont('Arial', '', 8);
            
            if ($data->Status == 'Tidak Aktif') {
                $pdf->SetTextColor(221, 75, 57);    
            } else {
                $pdf->SetTextColor(0, 0, 0);
            }
            
            $pdf->Cell(77, 5, $data->NoPelanggan.' - '.$data->NamaPelanggan, 0, 0);
            
            if ($data->Email == '') {
                $pdf->SetFont('Arial', 'I', 8);
                $pdf->SetTextColor(221, 75, 57);
                $pdf->Cell(50, 5, '(NULL)', 0, 0);
            } else {
                $pdf->SetFont('Arial', '', 8);
                $pdf->SetTextColor(0, 0, 0);
                $pdf->Cell(50, 5, $data->Email, 0, 0);
            }
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(70, 5, $data->NamaRayon, 0, 0);
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(70, 5, $data->NamaPenjual, 0, 0);
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(10, 5, $data->LevelHarga, 0, 0);
        }
        
        $GLOBALS['h_max'] = 4;
        
        $GLOBALS['h_1'] = array(
            'Judul' => 'Pemasok',
            'Width' => 77,
            'Align' => 'L'
        );
        
        $GLOBALS['h_3'] = array(
            'Judul' => 'Keterangan',
            'Width' => 170,
            'Align' => 'L'
        );
        
        $GLOBALS['h_4'] = array(
            'Judul' => 'Status',
            'Width' => 30,
            'Align' => 'C'
        );
        
        $pdf->AddPage();
        
        foreach ($pelanggan as $data) {
            $pdf->SetFont('Arial', '', 8);
            
            if ($data->Status == 'Tidak Aktif') {
                $pdf->SetTextColor(221, 75, 57);    
            } else {
                $pdf->SetTextColor(0, 0, 0);
            }
            
            $pdf->Cell(77, 5, $data->NoPemasok.' - '.$data->NamaPemasok, 0, 0);

            if ($data->Keterangan == '') {
                $pdf->SetFont('Arial', 'I', 8);
                $pdf->SetTextColor(221, 75, 57);
                $pdf->Cell(170, 5, '(NULL)', 0, 0);
            } else {
                $pdf->SetFont('Arial', '', 8);
                $pdf->SetTextColor(0, 0, 0);
                $pdf->Cell(170, 5, $data->Keterangan, 0, 0);
            }

            $pdf->SetFont('Arial', '', 8);
            
            if ($data->Status == 'Tidak Aktif') {
                $pdf->SetTextColor(221, 75, 57);    
            } else {
                $pdf->SetTextColor(0, 0, 0);
            }
            
            $pdf->Cell(30, 5, $data->Status, 0, 1, 'C');

        }
        
        $pdf->AliasNbPages();
        
        $pdf->Output('Data Pelanggan ('.date('dmy').').pdf', 'I');
    }
    
    function TargetPelanggan() {
        $pdf = new unduhpdf('L', 'mm', 'A4');
        
        foreach ($this->Perusahaan->AmbilData() as $data) {
            $GLOBALS['image'] = base_url().'assets/dist/img/logo/'.$data->Logo;
            $GLOBALS['title'] = 'KPI '.$data->NamaPerusahaan;
            $pdf->SetTitle($GLOBALS['title']);
        }
        
        $GLOBALS['subtitle'] = 'TARGET PELANGGAN';
        
        $bulan = $this->input->get('bulan');
        $no_penjual = $this->input->get('penjual');
        $status = $this->input->get('status');
        
        $this->load->model('Pelanggan/PelangganTarget');
        
        $no = 1;
        $total_target = 0;
        
        $target = $this->PelangganTarget->AmbilDataSemua($bulan, $no_penjual, $status);
        
        $GLOBALS['h_max'] = 5;
        
        $GLOBALS['h_1'] = array(
            'Judul' => 'No.',
            'Width' => 10,
            'Align' => 'C'
        );
        
        $GLOBALS['h_2'] = array(
            'Judul' => 'Bulan',
            'Width' => 40,
            'Align' => 'C'
        );
        
        $GLOBALS['h_3'] = array(
            'Judul' => 'Pelanggan',
            'Width' => 97,
            'Align' => 'L'
        );
        
        $GLOBALS['h_4'] = array(
            'Judul' => 'Penjual',
            'Width' => 90,
            'Align' => 'L'
        );
        
        $GLOBALS['h_5'] = array(
            'Judul' => 'Target',
            'Width' => 40,
            'Align' => 'C'
        );
        
        $pdf->AddPage();
        
        foreach ($target as $data) {
            $pdf->SetFont('Arial', '', 8);
            
            if ($data->Status == 'Tidak Aktif') {
                $pdf->SetTextColor(221, 75, 57);    
            } else {
                $pdf->SetTextColor(0, 0, 0);
            }
            
            $pdf->Cell(10, 5, $no++, 0, 0, 'C');
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(40, 5, $data->Bulan, 0, 0, 'C');
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(97, 5, $data->NoPelanggan.' - '.$data->NamaPelanggan, 0, 0);
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(90, 5, $data->NoPenjual.' - '.$data->NamaPenjual, 0, 0);
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(40, 5, 'Rp. '.number_format($data->Target, 2, ',', '.'), 0, 1, 'R');
            
            $total_target += $data->Target;
        }
        
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(16, 174, 249);
        $pdf->Cell(237, 5, 'Total Target', 'T', 0, 'C');
        $pdf->Cell(40, 5, 'Rp. '.number_format($total_target, 2, ',', '.'), 'T', 0, 'R');
        
        $pdf->AliasNbPages();
        
        $pdf->Output('Target / Pelanggan ('.date('dmy').').pdf', 'I');
    }
    
    function PiutangPelanggan() {
        $pdf = new unduhpdf('L', 'mm', 'A4');
        
        foreach ($this->Perusahaan->AmbilData() as $data) {
            $GLOBALS['image'] = base_url().'assets/dist/img/logo/'.$data->Logo;
            $GLOBALS['title'] = 'KPI '.$data->NamaPerusahaan;
            $pdf->SetTitle($GLOBALS['title']);
        }
        
        $GLOBALS['subtitle'] = 'PIUTANG PELANGGAN';
        
        $tanggal_awal = $this->input->get('tanggal_awal');
        $tanggal_akhir = $this->input->get('tanggal_akhir');
        $no_penjual = $this->input->get('penjual');
        $status = $this->input->get('status');
        
        $this->load->model('Pelanggan/PelangganPiutang');
        
        $no = 1;
        $total_piutang = 0;
        
        $piutang = $this->PelangganPiutang->AmbilDataSemua(date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_awal))), date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_akhir))), $no_penjual, $status);
        
        $GLOBALS['h_max'] = 5;
        
        $GLOBALS['h_1'] = array(
            'Judul' => 'No.',
            'Width' => 10,
            'Align' => 'C'
        );
        
        $GLOBALS['h_2'] = array(
            'Judul' => 'Tanggal',
            'Width' => 40,
            'Align' => 'C'
        );
        
        $GLOBALS['h_3'] = array(
            'Judul' => 'Pelanggan',
            'Width' => 97,
            'Align' => 'L'
        );
        
        $GLOBALS['h_4'] = array(
            'Judul' => 'Penjual',
            'Width' => 90,
            'Align' => 'L'
        );
        
        $GLOBALS['h_5'] = array(
            'Judul' => 'Piutang',
            'Width' => 40,
            'Align' => 'C'
        );
        
        $pdf->AddPage();
        
        foreach ($piutang as $data) {
            $pdf->SetFont('Arial', '', 8);
            
            if ($data->Status == 'Tidak Aktif') {
                $pdf->SetTextColor(221, 75, 57);    
            } else {
                $pdf->SetTextColor(0, 0, 0);
            }
            
            $pdf->Cell(10, 5, $no++, 0, 0, 'C');
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(40, 5, $data->Tanggal, 0, 0, 'C');
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(97, 5, $data->NoPelanggan.' - '.$data->NamaPelanggan, 0, 0);
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(90, 5, $data->NoPenjual.' - '.$data->NamaPenjual, 0, 0);
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(40, 5, 'Rp. '.number_format($data->Piutang, 2, ',', '.'), 0, 1, 'R');
            
            $total_piutang += $data->Piutang;
        }
        
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(16, 174, 249);
        $pdf->Cell(237, 5, 'Total Target', 'T', 0, 'C');
        $pdf->Cell(40, 5, 'Rp. '.number_format($total_piutang, 2, ',', '.'), 'T', 0, 'R');
        
        $pdf->AliasNbPages();
        
        $pdf->Output('Piutang / Pelanggan ('.date('dmy').').pdf', 'I');
    }
    
    function NilaiPelanggan() {
        $pdf = new unduhpdf('L', 'mm', 'A4');
        
        foreach ($this->Perusahaan->AmbilData() as $data) {
            $GLOBALS['image'] = base_url().'assets/dist/img/logo/'.$data->Logo;
            $GLOBALS['title'] = 'KPI '.$data->NamaPerusahaan;
            $pdf->SetTitle($GLOBALS['title']);
        }
        
        $GLOBALS['subtitle'] = 'NILAI PELANGGAN';
        
        $status = $this->input->get('status');
        
        $this->load->model('Aplikasi/AplikasiBobot');
        $this->load->model('Pelanggan/PelangganNilai');
        
        $no = 2;
        
        $nilai = $this->PelangganNilai->AmbilDataSemua($status, null);
        
        $GLOBALS['h_max'] = 7;
        
        $GLOBALS['h_1'] = array(
            'Judul' => 'Pemasok',
            'Width' => 97,
            'Align' => 'L'
        );
        
        foreach ($this->AplikasiBobot->AmbilDataSemua(2) as $data) { 
            $GLOBALS['h_'.$no++] = array(
                'Judul' => $data->AliasBobot.' ('.$data->Bobot.'%)',
                'Width' => 30,
                'Align' => 'C'
            );
        }
        
        $GLOBALS['h_5'] = array(
            'Judul' => 'Nilai',
            'Width' => 30,
            'Align' => 'C'
        );
        
        $GLOBALS['h_6'] = array(
            'Judul' => 'Predikat',
            'Width' => 30,
            'Align' => 'C'
        );
        
        $GLOBALS['h_7'] = array(
            'Judul' => 'Status',
            'Width' => 30,
            'Align' => 'C'
        );
        
        $pdf->AddPage();
        
        foreach ($nilai as $data) {
            $pdf->SetFont('Arial', '', 8);
            
            if ($data->Status == 'Tidak Aktif') {
                $pdf->SetTextColor(221, 75, 57);    
            } else {
                $pdf->SetTextColor(0, 0, 0);
            }
            
            $pdf->Cell(97, 5, $data->NoPelanggan.' - '.$data->NamaPelanggan, 0, 0);

            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(30, 5, number_format($data->Pencapaian, 1, ',', '.').'%', 0, 0, 'C');
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(30, 5, number_format($data->Profit, 1, ',', '.').'%', 0, 0, 'C');
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(30, 5, number_format($data->UPL, 1, ',', '.').'%', 0, 0, 'C');
            
            $pdf->SetFont('Arial', '', 8);
            
            switch ($data->Predikat) {
                case 'A' :
                    $pdf->SetTextColor(0, 115, 183);
                    break;
                case 'B' :
                    $pdf->SetTextColor(0, 166, 90);
                    break;
                case 'C' :
                    $pdf->SetTextColor(243, 156, 18);
                    break;
                case 'D' :
                    $pdf->SetTextColor(255, 119, 1);
                    break;
                case 'E' :
                    $pdf->SetTextColor(221, 75, 57);
                    break;
            }
            
            $pdf->Cell(30, 5, number_format($data->Nilai, 1, ',', '.'), 0, 0, 'C');
            
            $pdf->SetFont('Arial', '', 8);
            
            switch ($data->Predikat) {
                case 'A' :
                    $pdf->SetTextColor(0, 115, 183);
                    break;
                case 'B' :
                    $pdf->SetTextColor(0, 166, 90);
                    break;
                case 'C' :
                    $pdf->SetTextColor(243, 156, 18);
                    break;
                case 'D' :
                    $pdf->SetTextColor(255, 119, 1);
                    break;
                case 'E' :
                    $pdf->SetTextColor(221, 75, 57);
                    break;
            }
            
            $pdf->Cell(30, 5, $data->Predikat, 0, 0, 'C');

            $pdf->SetFont('Arial', '', 8);
            
            if ($data->Status == 'Tidak Aktif') {
                $pdf->SetTextColor(221, 75, 57);    
            } else {
                $pdf->SetTextColor(0, 0, 0);
            }
            
            $pdf->Cell(30, 5, $data->Status, 0, 1, 'C');
        }
        
        $pdf->AliasNbPages();
        
        $pdf->Output('Nilai / Pelanggan ('.date('dmy').').pdf', 'I');
    }
    
    function DataRayon() {
        $pdf = new unduhpdf('L', 'mm', 'A4');
        
        foreach ($this->Perusahaan->AmbilData() as $data) {
            $GLOBALS['image'] = base_url().'assets/dist/img/logo/'.$data->Logo;
            $GLOBALS['title'] = 'KPI '.$data->NamaPerusahaan;
            $pdf->SetTitle($GLOBALS['title']);
        }
        
        $GLOBALS['subtitle'] = 'DATA RAYON';
        
        $status = $this->input->get('status');
        
        $this->load->model('Rayon');
        
        $rayon = $this->Rayon->AmbilDataSemua($status);
        
        $GLOBALS['h_max'] = 3;
        
        $GLOBALS['h_1'] = array(
            'Judul' => 'Rayon',
            'Width' => 97,
            'Align' => 'L'
        );
        
        $GLOBALS['h_2'] = array(
            'Judul' => 'Keterangan',
            'Width' => 150,
            'Align' => 'L'
        );
        
        $GLOBALS['h_3'] = array(
            'Judul' => 'Status',
            'Width' => 30,
            'Align' => 'C'
        );
        
        $pdf->AddPage();
        
        foreach ($rayon as $data) {
            $pdf->SetFont('Arial', '', 8);
            
            if ($data->Status == 'Tidak Aktif') {
                $pdf->SetTextColor(221, 75, 57);    
            } else {
                $pdf->SetTextColor(0, 0, 0);
            }
            
            $pdf->Cell(97, 5, $data->KodeRayon.' - '.$data->NamaRayon, 0, 0);
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(150, 5, $data->Keterangan, 0, 0);
            
            $pdf->SetFont('Arial', '', 8);
            
            if ($data->Status == 'Tidak Aktif') {
                $pdf->SetTextColor(221, 75, 57);    
            } else {
                $pdf->SetTextColor(0, 0, 0);
            }
            
            $pdf->Cell(30, 5, $data->Status, 0, 1, 'C');
        }
        
        $pdf->AliasNbPages();
        
        $pdf->Output('Data Rayon ('.date('dmy').').pdf', 'I');
    }
    
    function DataPenjual() {
        $pdf = new unduhpdf('L', 'mm', 'A4');
        
        foreach ($this->Perusahaan->AmbilData() as $data) {
            $GLOBALS['image'] = base_url().'assets/dist/img/logo/'.$data->Logo;
            $GLOBALS['title'] = 'KPI '.$data->NamaPerusahaan;
            $pdf->SetTitle($GLOBALS['title']);
        }
        
        $GLOBALS['subtitle'] = 'DATA PENJUAL';
        
        $status = $this->input->get('status');
        
        $this->load->model('Penjual');
        
        $penjual = $this->Penjual->AmbilDataSemua($status);
        
        $GLOBALS['h_max'] = 3;
        
        $GLOBALS['h_1'] = array(
            'Judul' => 'Penjual',
            'Width' => 77,
            'Align' => 'L'
        );
        
        $GLOBALS['h_2'] = array(
            'Judul' => 'Keterangan',
            'Width' => 170,
            'Align' => 'L'
        );
        
        $GLOBALS['h_3'] = array(
            'Judul' => 'Status',
            'Width' => 30,
            'Align' => 'C'
        );
        
        $pdf->AddPage();
        
        foreach ($penjual as $data) {
            $pdf->SetFont('Arial', '', 8);
            
            if ($data->Status == 'Tidak Aktif') {
                $pdf->SetTextColor(221, 75, 57);    
            } else {
                $pdf->SetTextColor(0, 0, 0);
            }
            
            $pdf->Cell(77, 5, $data->NoPenjual.' - '.$data->NamaPenjual, 0, 0);
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(170, 5, $data->Keterangan, 0, 0);
            
            $pdf->SetFont('Arial', '', 8);
            
            if ($data->Status == 'Tidak Aktif') {
                $pdf->SetTextColor(221, 75, 57);    
            } else {
                $pdf->SetTextColor(0, 0, 0);
            }
            
            $pdf->Cell(30, 5, $data->Status, 0, 1, 'C');
        }
        
        $pdf->AliasNbPages();
        
        $pdf->Output('Data Penjual ('.date('dmy').').pdf', 'I');
    }
    
    function FakturPenjualan() {
        $pdf = new unduhpdf('L', 'mm', 'A4');
        
        foreach ($this->Perusahaan->AmbilData() as $data) {
            $GLOBALS['image'] = base_url().'assets/dist/img/logo/'.$data->Logo;
            $GLOBALS['title'] = 'KPI '.$data->NamaPerusahaan;
            $pdf->SetTitle($GLOBALS['title']);
        }
        
        $GLOBALS['subtitle'] = 'FAKTUR PENJUALAN';
        
        $tanggal_awal = $this->input->get('tanggal_awal');
        $tanggal_akhir = $this->input->get('tanggal_akhir');
        $no_pelanggan = $this->input->get('pelanggan');
        $no_penjual = $this->input->get('penjual');
        
        $this->load->model('Penjualan/PenjualanFaktur');
        
        $jumlah_nilai_faktur = 0;
        
        $faktur_penjualan = $this->PenjualanFaktur->AmbilDataSemua($no_penjual, $no_pelanggan, date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_awal))), date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_akhir))));
        
        $GLOBALS['h_max'] = 5;
        
        $GLOBALS['h_1'] = array(
            'Judul' => 'No. Faktur',
            'Width' => 32,
            'Align' => 'C'
        );
        
        $GLOBALS['h_2'] = array(
            'Judul' => 'Tanggal',
            'Width' => 32,
            'Align' => 'C'
        );
        
        $GLOBALS['h_3'] = array(
            'Judul' => 'Pelanggan',
            'Width' => 97,
            'Align' => 'L'
        );
        
        $GLOBALS['h_4'] = array(
            'Judul' => 'Penjual',
            'Width' => 84,
            'Align' => 'L'
        );
        
        $GLOBALS['h_5'] = array(
            'Judul' => 'Nilai Faktur',
            'Width' => 32,
            'Align' => 'C'
        );
        
        $pdf->AddPage();
        
        foreach ($faktur_penjualan as $data) {
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(32, 5, $data->NoFaktur, 0, 0, 'C');
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(32, 5, date('d', strtotime($data->Tanggal)).' '.bulan(date('m', strtotime($data->Tanggal)), 'F').' '.date('Y', strtotime($data->Tanggal)), 0, 0, 'C');
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(97, 5, $data->NoPelanggan.' - '.$data->NamaPelanggan, 0, 0);
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(84, 5, $data->NoPenjual.' - '.$data->NamaPenjual, 0, 0);

            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(32, 5, 'Rp. '.number_format($data->NilaiFaktur, 2, ',', '.'), 0, 1, 'R');

            $jumlah_nilai_faktur += $data->NilaiFaktur;
        }
        
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(16, 174, 249);
        $pdf->Cell(245, 5, 'Total Nilai Faktur', 'T', 0, 'C');
        $pdf->Cell(32, 5, 'Rp. '.number_format($jumlah_nilai_faktur, 2, ',', '.'), 'T', 0, 'R');
        
        $GLOBALS['h_max'] = 2;
        
        $GLOBALS['h_1'] = array(
            'Judul' => 'No. Faktur',
            'Width' => 32,
            'Align' => 'C'
        );
        
        $GLOBALS['h_2'] = array(
            'Judul' => 'Keterangan',
            'Width' => 245,
            'Align' => 'L'
        );
        
        $pdf->AddPage();
        
        foreach ($faktur_penjualan as $data) {
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(32, 5, $data->NoFaktur, 0, 0, 'C');
            
            if ($data->Keterangan == '') {
                $pdf->SetFont('Arial', 'I', 8);
                $pdf->SetTextColor(221, 75, 57);
                $pdf->Cell(245, 5, '(NULL)', 0, 1);
            } else {
                $pdf->SetFont('Arial', '', 8);
                $pdf->SetTextColor(0, 0, 0);
                $pdf->Cell(245, 5, $data->Keterangan, 0, 1);
            }
        }
        
        $pdf->AliasNbPages();
        
        $pdf->Output('Faktur Penjualan ('.date('dmy').').pdf', 'I');
    }
    
    function ReturPenjualan() {
        $pdf = new unduhpdf('L', 'mm', 'A4');
        
        foreach ($this->Perusahaan->AmbilData() as $data) {
            $GLOBALS['image'] = base_url().'assets/dist/img/logo/'.$data->Logo;
            $GLOBALS['title'] = 'KPI '.$data->NamaPerusahaan;
            $pdf->SetTitle($GLOBALS['title']);
        }
        
        $GLOBALS['subtitle'] = 'RETUR PENJUALAN';
        
        $tanggal_awal = $this->input->get('tanggal_awal');
        $tanggal_akhir = $this->input->get('tanggal_akhir');
        $no_pelanggan = $this->input->get('pelanggan');
        $no_penjual = $this->input->get('penjual');
        
        $this->load->model('Penjualan/PenjualanRetur');
        
        $jumlah_nilai_retur = 0;
        
        $retur_penjualan = $this->PenjualanRetur->AmbilDataSemua($no_penjual, $no_pelanggan, date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_awal))), date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_akhir))));
        
        $GLOBALS['h_max'] = 5;
        
        $GLOBALS['h_1'] = array(
            'Judul' => 'No. Retur',
            'Width' => 32,
            'Align' => 'C'
        );
        
        $GLOBALS['h_2'] = array(
            'Judul' => 'Tanggal',
            'Width' => 32,
            'Align' => 'C'
        );
        
        $GLOBALS['h_3'] = array(
            'Judul' => 'Pelanggan',
            'Width' => 97,
            'Align' => 'L'
        );
        
        $GLOBALS['h_4'] = array(
            'Judul' => 'Penjual',
            'Width' => 84,
            'Align' => 'L'
        );
        
        $GLOBALS['h_5'] = array(
            'Judul' => 'Nilai Retur',
            'Width' => 32,
            'Align' => 'C'
        );
        
        $pdf->AddPage();
        
        foreach ($retur_penjualan as $data) {
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(32, 5, $data->NoRetur, 0, 0, 'C');
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(32, 5, date('d', strtotime($data->Tanggal)).' '.bulan(date('m', strtotime($data->Tanggal)), 'F').' '.date('Y', strtotime($data->Tanggal)), 0, 0, 'C');
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(97, 5, $data->NoPelanggan.' - '.$data->NamaPelanggan, 0, 0);
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(84, 5, $data->NoPenjual.' - '.$data->NamaPenjual, 0, 0);

            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(32, 5, 'Rp. '.number_format($data->NilaiRetur, 2, ',', '.'), 0, 1, 'R');

            $jumlah_nilai_retur += $data->NilaiRetur;
        }
        
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(16, 174, 249);
        $pdf->Cell(245, 5, 'Total Nilai Retur', 'T', 0, 'C');
        $pdf->Cell(32, 5, 'Rp. '.number_format($jumlah_nilai_retur, 2, ',', '.'), 'T', 0, 'R');
        
        $GLOBALS['h_max'] = 2;
        
        $GLOBALS['h_1'] = array(
            'Judul' => 'No. Retur',
            'Width' => 32,
            'Align' => 'C'
        );
        
        $GLOBALS['h_2'] = array(
            'Judul' => 'Keterangan',
            'Width' => 245,
            'Align' => 'L'
        );
        
        $pdf->AddPage();
        
        foreach ($retur_penjualan as $data) {
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(32, 5, $data->NoRetur, 0, 0, 'C');
            
            if ($data->Keterangan == '') {
                $pdf->SetFont('Arial', 'I', 8);
                $pdf->SetTextColor(221, 75, 57);
                $pdf->Cell(245, 5, '(NULL)', 0, 1);
            } else {
                $pdf->SetFont('Arial', '', 8);
                $pdf->SetTextColor(0, 0, 0);
                $pdf->Cell(245, 5, $data->Keterangan, 0, 1);
            }
        }
        
        $pdf->AliasNbPages();
        
        $pdf->Output('Retur Penjualan ('.date('dmy').').pdf', 'I');
    }
    
    function LabaKotorPenjualan() {
        $pdf = new unduhpdf('L', 'mm', 'A4');
        
        foreach ($this->Perusahaan->AmbilData() as $data) {
            $GLOBALS['image'] = base_url().'assets/dist/img/logo/'.$data->Logo;
            $GLOBALS['title'] = 'KPI '.$data->NamaPerusahaan;
            $pdf->SetTitle($GLOBALS['title']);
        }
        
        $GLOBALS['subtitle'] = 'LABA KOTOR PENJUALAN';
        
        $tanggal_awal = $this->input->get('tanggal_awal');
        $tanggal_akhir = $this->input->get('tanggal_akhir');
        $no_pelanggan = $this->input->get('pelanggan');
        $no_penjual = $this->input->get('penjual');
        
        $this->load->model('Penjualan/PenjualanLabaKotor');
        
        $no = 1;
        $jumlah_nilai_laba_kotor = 0;
        
        $laba_kotor_penjualan = $this->PenjualanLabaKotor->AmbilDataSemua($no_penjual, $no_pelanggan, date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_awal))), date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_akhir))));
        
        $GLOBALS['h_max'] = 5;
        
        $GLOBALS['h_1'] = array(
            'Judul' => 'No.',
            'Width' => 10,
            'Align' => 'C'
        );
        
        $GLOBALS['h_2'] = array(
            'Judul' => 'Tanggal',
            'Width' => 40,
            'Align' => 'C'
        );
        
        $GLOBALS['h_3'] = array(
            'Judul' => 'Pelanggan',
            'Width' => 97,
            'Align' => 'L'
        );
        
        $GLOBALS['h_4'] = array(
            'Judul' => 'Penjual',
            'Width' => 90,
            'Align' => 'L'
        );
        
        $GLOBALS['h_5'] = array(
            'Judul' => 'Laba Kotor',
            'Width' => 40,
            'Align' => 'C'
        );
        
        $pdf->AddPage();
        
        foreach ($laba_kotor_penjualan as $data) {
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(10, 5, $no++, 0, 0, 'C');
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(40, 5, date('d', strtotime($data->Tanggal)).' '.bulan(date('m', strtotime($data->Tanggal)), 'F').' '.date('Y', strtotime($data->Tanggal)), 0, 0, 'C');
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(97, 5, $data->NoPelanggan.' - '.$data->NamaPelanggan, 0, 0);
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(90, 5, $data->NoPenjual.' - '.$data->NamaPenjual, 0, 0);

            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(40, 5, 'Rp. '.number_format($data->LabaKotor, 2, ',', '.'), 0, 1, 'R');

            $jumlah_nilai_laba_kotor += $data->LabaKotor;
        }
        
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(16, 174, 249);
        $pdf->Cell(245, 5, 'Total Laba Kotor', 'T', 0, 'C');
        $pdf->Cell(32, 5, 'Rp. '.number_format($jumlah_nilai_laba_kotor, 2, ',', '.'), 'T', 0, 'R');
        
        $pdf->AliasNbPages();
        
        $pdf->Output('Laba Kotor Penjualan ('.date('dmy').').pdf', 'I');
    }
}

?>