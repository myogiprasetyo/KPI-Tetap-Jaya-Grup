<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unduh extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        
        $this->load->model('Perusahaan');
        
        date_default_timezone_set('Asia/Jakarta');
	}
    
    function DataPemasok() {
        $pdf = new unduhpdf('L', 'mm', 'A4');
        
        foreach ($this->Perusahaan->AmbilData() as $data) {
            $GLOBALS['image'] = base_url().'assets/dist/img/logo/'.$data->Logo;
            $GLOBALS['title'] = 'KPI '.$data->NamaPerusahaan;
            $pdf->SetTitle($GLOBALS['title']);
        }
        
        $GLOBALS['subtitle'] = 'DATA PEMASOK';
        
        $status = $this->input->get('status');
        
        $this->load->model('Pemasok/Pemasok');
        
        $pemasok = $this->Pemasok->AmbilDataSemua($status);
        
        $GLOBALS['h_max'] = 3;
        
        $GLOBALS['h_1'] = array(
            'Judul' => 'Pemasok',
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
        
        foreach ($pemasok as $data) {
            $pdf->SetFont('Arial', '', 8);
            
            if ($data->Status == 'Tidak Aktif') {
                $pdf->SetTextColor(221, 75, 57);    
            } else {
                $pdf->SetTextColor(0, 0, 0);
            }
            
            $pdf->Cell(77, 5, $data->NoPemasok.' - '.$data->NamaPemasok, 0, 0);
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(165, 5, $data->AlamatLengkap.', '.$data->KabupatenKota.', '.$data->Provinsi.', '.$data->KodePos, 0, 0);
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(35, 5, $data->NoTelepon1, 0, 1);
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
            'Judul' => 'Website',
            'Width' => 50,
            'Align' => 'L'
        );
        
        $GLOBALS['h_4'] = array(
            'Judul' => 'Nama Kontak',
            'Width' => 50,
            'Align' => 'L'
        );
        
        $GLOBALS['h_5'] = array(
            'Judul' => 'No. Telepon Kontak',
            'Width' => 50,
            'Align' => 'L'
        );
        
        $pdf->AddPage();
        
        foreach ($pemasok as $data) {
            $pdf->SetFont('Arial', '', 8);
            
            if ($data->Status == 'Tidak Aktif') {
                $pdf->SetTextColor(221, 75, 57);    
            } else {
                $pdf->SetTextColor(0, 0, 0);
            }
            
            $pdf->Cell(77, 5, $data->NoPemasok.' - '.$data->NamaPemasok, 0, 0);
            
            if ($data->Email == '') {
                $pdf->SetFont('Arial', 'I', 8);
                $pdf->SetTextColor(221, 75, 57);
                $pdf->Cell(50, 5, '(NULL)', 0, 0);
            } else {
                $pdf->SetFont('Arial', '', 8);
                $pdf->SetTextColor(0, 0, 0);
                $pdf->Cell(50, 5, $data->Email, 0, 0);
            }
            
            if ($data->Website == '') {
                $pdf->SetFont('Arial', 'I', 8);
                $pdf->SetTextColor(221, 75, 57);
                $pdf->Cell(50, 5, '(NULL)', 0, 0);
            } else {
                $pdf->SetFont('Arial', '', 8);
                $pdf->SetTextColor(0, 0, 0);
                $pdf->Cell(50, 5, $data->Website, 0, 0);
            }
            
            if ($data->NamaKontak == '') {
                $pdf->SetFont('Arial', 'I', 8);
                $pdf->SetTextColor(221, 75, 57);
                $pdf->Cell(50, 5, '(NULL)', 0, 0);
            } else {
                $pdf->SetFont('Arial', '', 8);
                $pdf->SetTextColor(0, 0, 0);
                $pdf->Cell(50, 5, $data->NamaKontak, 0, 0);
            }
            
            if ($data->NoTelepon2 == '') {
                $pdf->SetFont('Arial', 'I', 8);
                $pdf->SetTextColor(221, 75, 57);
                $pdf->Cell(50, 5, '(NULL)', 0, 1);
            } else {
                $pdf->SetFont('Arial', '', 8);
                $pdf->SetTextColor(0, 0, 0);
                $pdf->Cell(50, 5, $data->NoTelepon2, 0, 1);
            }
        }
        
        $GLOBALS['h_max'] = 4;
        
        $GLOBALS['h_1'] = array(
            'Judul' => 'Pemasok',
            'Width' => 77,
            'Align' => 'L'
        );
        
        $GLOBALS['h_2'] = array(
            'Judul' => 'Saldo Awal',
            'Width' => 40,
            'Align' => 'C'
        );
        
        $GLOBALS['h_3'] = array(
            'Judul' => 'Keterangan',
            'Width' => 130,
            'Align' => 'L'
        );
        
        $GLOBALS['h_4'] = array(
            'Judul' => 'Status',
            'Width' => 30,
            'Align' => 'C'
        );
        
        $pdf->AddPage();
        
        foreach ($pemasok as $data) {
            $pdf->SetFont('Arial', '', 8);
            
            if ($data->Status == 'Tidak Aktif') {
                $pdf->SetTextColor(221, 75, 57);    
            } else {
                $pdf->SetTextColor(0, 0, 0);
            }
            
            $pdf->Cell(77, 5, $data->NoPemasok.' - '.$data->NamaPemasok, 0, 0);

            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(40, 5, 'Rp. '.number_format($data->SaldoAwal, 2, ',', '.'), 0, 0, 'R');

            if ($data->Keterangan == '') {
                $pdf->SetFont('Arial', 'I', 8);
                $pdf->SetTextColor(221, 75, 57);
                $pdf->Cell(130, 5, '(NULL)', 0, 0);
            } else {
                $pdf->SetFont('Arial', '', 8);
                $pdf->SetTextColor(0, 0, 0);
                $pdf->Cell(130, 5, $data->Keterangan, 0, 0);
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
        
        $pdf->Output('Data Pemasok ('.date('dmy').').pdf', 'I');
    }
    
    function PersediaanAkhirPemasok() {
        $pdf = new unduhpdf('L', 'mm', 'A4');
        
        foreach ($this->Perusahaan->AmbilData() as $data) {
            $GLOBALS['image'] = base_url().'assets/dist/img/logo/'.$data->Logo;
            $GLOBALS['title'] = 'KPI '.$data->NamaPerusahaan;
            $pdf->SetTitle($GLOBALS['title']);
        }
        
        $GLOBALS['subtitle'] = 'PERSEDIAAN AKHIR PEMASOK';
        
        $tanggal_akhir = $this->input->get('tanggal_akhir');
        $status = $this->input->get('status');
        
        $this->load->model('Pemasok/PemasokPersediaanAkhir');
        
        $persediaan_akhir = $this->PemasokPersediaanAkhir->AmbilDataSemua(date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_akhir))), $status);
        
        $total_persediaan_akhir = 0;
        
        $GLOBALS['h_max'] = 3;
        
        $GLOBALS['h_1'] = array(
            'Judul' => 'Pemasok',
            'Width' => 207,
            'Align' => 'L'
        );
        
        $GLOBALS['h_2'] = array(
            'Judul' => 'Persediaan Akhir',
            'Width' => 40,
            'Align' => 'C'
        );
        
        $GLOBALS['h_3'] = array(
            'Judul' => 'Status',
            'Width' => 30,
            'Align' => 'C'
        );
        
        $pdf->AddPage();
        
        foreach ($persediaan_akhir as $data) {
            $pdf->SetFont('Arial', '', 8);
            
            if ($data->Status == 'Tidak Aktif') {
                $pdf->SetTextColor(221, 75, 57);    
            } else {
                $pdf->SetTextColor(0, 0, 0);
            }
            
            $pdf->Cell(207, 5, $data->NoPemasok.' - '.$data->NamaPemasok, 0, 0);

            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(40, 5, 'Rp. '.number_format($data->PersediaanAkhir, 2, ',', '.'), 0, 0, 'R');

            $pdf->SetFont('Arial', '', 8);
            
            if ($data->Status == 'Tidak Aktif') {
                $pdf->SetTextColor(221, 75, 57);    
            } else {
                $pdf->SetTextColor(0, 0, 0);
            }
            
            $pdf->Cell(30, 5, $data->Status, 0, 1, 'C');
            
            $total_persediaan_akhir += $data->PersediaanAkhir;
        }
        
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(16, 174, 249);
        $pdf->Cell(207, 5, 'Total Persediaan Akhir', 'T', 0, 'C');
        $pdf->Cell(40, 5, 'Rp. '.number_format($total_persediaan_akhir, 2, ',', '.'), 'T', 0, 'R');
        $pdf->Cell(30, 5, '', 'T', 0);
        
        $pdf->AliasNbPages();
        
        $pdf->Output('Persediaan Akhir / Pemasok ('.date('dmy').').pdf', 'I');
    }
    
    function NilaiPemasok() {
        $pdf = new unduhpdf('L', 'mm', 'A4');
        
        foreach ($this->Perusahaan->AmbilData() as $data) {
            $GLOBALS['image'] = base_url().'assets/dist/img/logo/'.$data->Logo;
            $GLOBALS['title'] = 'KPI '.$data->NamaPerusahaan;
            $pdf->SetTitle($GLOBALS['title']);
        }
        
        $GLOBALS['subtitle'] = 'NILAI PEMASOK';
        
        $status = $this->input->get('status');
        
        $this->load->model('Aplikasi/AplikasiBobot');
        $this->load->model('Pemasok/PemasokNilai');
        
        $no = 2;
        
        $nilai = $this->PemasokNilai->AmbilDataSemua($status, null);
        
        $GLOBALS['h_max'] = 7;
        
        $GLOBALS['h_1'] = array(
            'Judul' => 'Pemasok',
            'Width' => 97,
            'Align' => 'L'
        );
        
        foreach ($this->AplikasiBobot->AmbilDataSemua(1) as $data) { 
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
            
            $pdf->Cell(97, 5, $data->NoPemasok.' - '.$data->NamaPemasok, 0, 0);

            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(30, 5, number_format($data->Profit, 1, ',', '.').'%', 0, 0, 'C');
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(30, 5, number_format($data->SHVSPA, 1, ',', '.').'%', 0, 0, 'C');
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(30, 5, number_format($data->Terpenuhi, 1, ',', '.').'%', 0, 0, 'C');
            
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
        
        $pdf->Output('Nilai / Pemasok ('.date('dmy').').pdf', 'I');
    }
    
    function PesananPembelian() {
        $pdf = new unduhpdf('L', 'mm', 'A4');
        
        foreach ($this->Perusahaan->AmbilData() as $data) {
            $GLOBALS['image'] = base_url().'assets/dist/img/logo/'.$data->Logo;
            $GLOBALS['title'] = 'KPI '.$data->NamaPerusahaan;
            $pdf->SetTitle($GLOBALS['title']);
        }
        
        $GLOBALS['subtitle'] = 'PESANAN PEMBELIAN';
        
        $tanggal_awal = $this->input->get('tanggal_awal');
        $tanggal_akhir = $this->input->get('tanggal_akhir');
        $status = $this->input->get('sedang_diproses') + $this->input->get('diterima_penuh') + $this->input->get('ditutup');
        $pemasok = $this->input->get('pemasok');
        
        $this->load->model('Pembelian/PembelianPesanan');
        
        $pesanan_pembelian = $this->PembelianPesanan->AmbilDataSemua(date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_awal))), date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_akhir))), $status, $pemasok, 'Data');

        $jumlah_data = 0;
        $total_umur = 0;
        $jumlah_jumlah = 0;
        
        $GLOBALS['h_max'] = 5;
        
        $GLOBALS['h_1'] = array(
            'Judul' => 'No. PO',
            'Width' => 40,
            'Align' => 'C'
        );
        
        $GLOBALS['h_2'] = array(
            'Judul' => 'Tanggal',
            'Width' => 40,
            'Align' => 'C'
        );
        
        $GLOBALS['h_3'] = array(
            'Judul' => 'Pemasok',
            'Width' => 127,
            'Align' => 'L'
        );
        
        $GLOBALS['h_4'] = array(
            'Judul' => 'Umur',
            'Width' => 30,
            'Align' => 'C'
        );
        
        $GLOBALS['h_5'] = array(
            'Judul' => 'Jumlah',
            'Width' => 40,
            'Align' => 'C'
        );
        
        $pdf->AddPage();
        
        foreach ($pesanan_pembelian as $data) {
            $pdf->SetFont('Arial', '', 8);
            
            switch ($data->Status) {
                case 'Sedang Diproses' :
                    $pdf->SetTextColor(243, 156, 18);
                    break;
                case 'Diterima Penuh' :
                    $pdf->SetTextColor(0, 166, 90);
                    break;
                case 'Ditutup' :
                    $pdf->SetTextColor(221, 75, 57);
                    break;
            }
            
            $pdf->Cell(40, 5, $data->NoPO, 0, 0, 'C');
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(40, 5, date('d', strtotime($data->Tanggal)).' '.bulan(date('m', strtotime($data->Tanggal)), 'F').' '.date('Y', strtotime($data->Tanggal)), 0, 0, 'C');
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(127, 5, $data->NoPemasok.' - '.$data->NamaPemasok, 0, 0);
            
            $pdf->SetFont('Arial', '', 8);
            
            if ($data->Diterima == 0) {
                $pdf->SetTextColor(221, 75, 57);    
                $umur = (new datetime(date('Y-m-d', strtotime($data->Tanggal))))->diff(new datetime(date('Y-m-d')))->days;
                $pdf->Cell(30, 5, $umur.' Hari', 0, 0, 'C');
            } else {
                $pdf->SetTextColor(0, 166, 90);    
                $umur = 0;
                $pdf->Cell(30, 5, 'Terfaktur', 0, 0, 'C');
            }

            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(40, 5, 'Rp. '.number_format($data->Diterima + $data->Diproses, 2, ',', '.'), 0, 1, 'R');
            
            $jumlah_data++;
            $total_umur += $umur;
            $jumlah_jumlah += ($data->Diterima + $data->Diproses);
        }
        
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(16, 174, 249);
        $pdf->Cell(207, 5, 'Rerata Umur & Total Jumlah', 'T', 0, 'C');
        $pdf->Cell(30, 5, round($total_umur / $jumlah_data).' Hari', 'T', 0, 'C');
        $pdf->Cell(40, 5, 'Rp. '.number_format($jumlah_jumlah, 2, ',', '.'), 'T', 0, 'R');
        
        $GLOBALS['h_max'] = 3;
        
        $GLOBALS['h_1'] = array(
            'Judul' => 'No. PO',
            'Width' => 40,
            'Align' => 'C'
        );
        
        $GLOBALS['h_2'] = array(
            'Judul' => 'Keterangan',
            'Width' => 197,
            'Align' => 'L'
        );
        
        $GLOBALS['h_3'] = array(
            'Judul' => 'Status',
            'Width' => 40,
            'Align' => 'C'
        );
        
        $pdf->AddPage();
        
        foreach ($pesanan_pembelian as $data){
            $pdf->SetFont('Arial', '', 8);
            
            switch ($data->Status) {
                case 'Sedang Diproses' :
                    $pdf->SetTextColor(243, 156, 18);
                    break;
                case 'Diterima Penuh' :
                    $pdf->SetTextColor(0, 166, 90);
                    break;
                case 'Ditutup' :
                    $pdf->SetTextColor(221, 75, 57);
                    break;
            }
            
            $pdf->Cell(40, 5, $data->NoPO, 0, 0, 'C');
            
            if ($data->Keterangan == '') {
                $pdf->SetFont('Arial', 'I', 8);
                $pdf->SetTextColor(221, 75, 57);
                $pdf->Cell(197, 5, '(NULL)', 0, 0);
            } else {
                $pdf->SetFont('Arial', '', 8);
                $pdf->SetTextColor(0, 0, 0);
                $pdf->Cell(197, 5, $data->Keterangan, 0, 0);
            }
            
            $pdf->SetFont('Arial', '', 8);
            
            switch ($data->Status) {
                case 'Sedang Diproses' :
                    $pdf->SetTextColor(243, 156, 18);
                    break;
                case 'Diterima Penuh' :
                    $pdf->SetTextColor(0, 166, 90);
                    break;
                case 'Ditutup' :
                    $pdf->SetTextColor(221, 75, 57);
                    break;
            }
            
            $pdf->Cell(40, 5, $data->Status, 0, 1, 'C');
        }
        
        $pdf->AliasNbPages();
        
        $pdf->Output('Pesanan Pembelian ('.date('dmy').').pdf', 'I');
    }
    
    function FakturPembelian() {
        $pdf = new unduhpdf('L', 'mm', 'A4');
        
        foreach ($this->Perusahaan->AmbilData() as $data) {
            $GLOBALS['image'] = base_url().'assets/dist/img/logo/'.$data->Logo;
            $GLOBALS['title'] = 'KPI '.$data->NamaPerusahaan;
            $pdf->SetTitle($GLOBALS['title']);
        }
        
        $GLOBALS['subtitle'] = 'FAKTUR PEMBELIAN';
        
        $tanggal_awal = $this->input->get('tanggal_awal');
        $tanggal_akhir = $this->input->get('tanggal_akhir');
        $status = $this->input->get('belum_lunas') + $this->input->get('pembayaran') + $this->input->get('lunas');
        $pemasok = $this->input->get('pemasok');
        
        $this->load->model('Pembelian/PembelianFaktur');
        
        $jumlah_data = 0;
        $total_umur = 0;
        $jumlah_nilai_faktur = 0;
        
        $faktur_pembelian = $this->PembelianFaktur->AmbilDataSemua(date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_awal))), date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_akhir))), $status, $pemasok, 'Data');
        
        $GLOBALS['h_max'] = 6;
        
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
            'Judul' => 'Pemasok',
            'Width' => 127,
            'Align' => 'L'
        );
        
        $GLOBALS['h_4'] = array(
            'Judul' => 'Umur',
            'Width' => 22,
            'Align' => 'C'
        );
        
        $GLOBALS['h_5'] = array(
            'Judul' => 'No. PO',
            'Width' => 32,
            'Align' => 'C'
        );
        
        $GLOBALS['h_6'] = array(
            'Judul' => 'Nilai Faktur',
            'Width' => 32,
            'Align' => 'C'
        );
        
        $pdf->AddPage();
        
        foreach ($faktur_pembelian as $data) {
            $pdf->SetFont('Arial', '', 8);
            
            switch ($data->Status) {
                case 'Belum Lunas' :
                    $pdf->SetTextColor(221, 75, 57);
                    break;
                case 'Pembayaran' :
                    $pdf->SetTextColor(243, 156, 18);
                    break;
                case 'Lunas' :
                    $pdf->SetTextColor(0, 166, 90);
                    break;
            }
            
            $pdf->Cell(32, 5, $data->NoFaktur, 0, 0, 'C');
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(32, 5, date('d', strtotime($data->TanggalFaktur)).' '.bulan(date('m', strtotime($data->TanggalFaktur)), 'F').' '.date('Y', strtotime($data->TanggalFaktur)), 0, 0, 'C');
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(127, 5, $data->NoPemasok.' - '.$data->NamaPemasok, 0, 0);
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 166, 90);
            
            if ($data->TanggalPO == null) { 
                $umur = 0;
            } else {
                $umur = (new datetime(date('Y-m-d', strtotime($data->TanggalFaktur))))->diff(new datetime(date('Y-m-d', strtotime($data->TanggalPO))))->days;
            }
            
            $pdf->Cell(22, 5, $umur.' Hari', 0, 0, 'C');

            if ($data->NoPO == null) { 
                $pdf->SetFont('Arial', '', 8);
                $pdf->SetTextColor(221, 75, 57);
                $pdf->Cell(32, 5, 'Tidak ada No. PO', 0, 0, 'C');
            } else {
                $pdf->SetFont('Arial', '', 8);
                $pdf->SetTextColor(0, 0, 0);
                $pdf->Cell(32, 5, $data->NoPO, 0, 0, 'C');
            }

            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(32, 5, 'Rp. '.number_format($data->NilaiFaktur, 2, ',', '.'), 0, 1, 'R');
            
            $jumlah_data++;
            $total_umur += $umur;
            $jumlah_nilai_faktur += $data->NilaiFaktur;
        }
        
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(16, 174, 249);
        $pdf->Cell(191, 5, 'Rerata Umur & Total Nilai Faktur', 'T', 0, 'C');
        $pdf->Cell(22, 5, round($total_umur / $jumlah_data).' Hari', 'T', 0, 'C');
        $pdf->Cell(32, 5, '', 'T', 0);
        $pdf->Cell(32, 5, 'Rp. '.number_format($jumlah_nilai_faktur, 2, ',', '.'), 'T', 0, 'R');
        
        $GLOBALS['h_max'] = 3;
        
        $GLOBALS['h_1'] = array(
            'Judul' => 'No. Faktur',
            'Width' => 32,
            'Align' => 'C'
        );
        
        $GLOBALS['h_2'] = array(
            'Judul' => 'Keterangan',
            'Width' => 213,
            'Align' => 'L'
        );
        
        $GLOBALS['h_3'] = array(
            'Judul' => 'Status',
            'Width' => 32,
            'Align' => 'C'
        );
        
        $pdf->AddPage();
        
        foreach ($faktur_pembelian as $data) {
            $pdf->SetFont('Arial', '', 8);
            
            switch ($data->Status) {
                case 'Belum Lunas' :
                    $pdf->SetTextColor(221, 75, 57);
                    break;
                case 'Pembayaran' :
                    $pdf->SetTextColor(243, 156, 18);
                    break;
                case 'Lunas' :
                    $pdf->SetTextColor(0, 166, 90);
                    break;
            }
            
            $pdf->Cell(32, 5, $data->NoFaktur, 0, 0, 'C');
            
            if ($data->Keterangan == '') {
                $pdf->SetFont('Arial', 'I', 8);
                $pdf->SetTextColor(221, 75, 57);
                $pdf->Cell(213, 5, '(NULL)', 0, 0);
            } else {
                $pdf->SetFont('Arial', '', 8);
                $pdf->SetTextColor(0, 0, 0);
                $pdf->Cell(213, 5, $data->Keterangan, 0, 0);
            }
            
            $pdf->SetFont('Arial', '', 8);
            
            switch ($data->Status) {
                case 'Belum Lunas' :
                    $pdf->SetTextColor(221, 75, 57);
                    break;
                case 'Pembayaran' :
                    $pdf->SetTextColor(243, 156, 18);
                    break;
                case 'Lunas' :
                    $pdf->SetTextColor(0, 166, 90);
                    break;
            }
            
            $pdf->Cell(32, 5, $data->Status, 0, 1, 'C');
        }
        
        $pdf->AliasNbPages();
        
        $pdf->Output('Faktur Pembelian ('.date('dmy').').pdf', 'I');
    }
    
    function PembayaranPembelian() {
        $pdf = new unduhpdf('L', 'mm', 'A4');
        
        foreach ($this->Perusahaan->AmbilData() as $data) {
            $GLOBALS['image'] = base_url().'assets/dist/img/logo/'.$data->Logo;
            $GLOBALS['title'] = 'KPI '.$data->NamaPerusahaan;
            $pdf->SetTitle($GLOBALS['title']);
        }
        
        $GLOBALS['subtitle'] = 'PEMBAYARAN PEMBELIAN';
        
        $tanggal_awal = $this->input->get('tanggal_awal');
        $tanggal_akhir = $this->input->get('tanggal_akhir');
        $status = $this->input->get('buka_giro') + $this->input->get('dicairkan');
        $pemasok = $this->input->get('pemasok');
        
        $this->load->model('Pembelian/PembelianPembayaran');
        
        $jumlah_jumlah_faktur = 0;
        
        $pembayaran_pembelian = $this->PembelianPembayaran->AmbilDataSemua(date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_awal))), date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_akhir))), $status, $pemasok);
        
        $GLOBALS['h_max'] = 6;
        
        $GLOBALS['h_1'] = array(
            'Judul' => 'No. Pembayaran',
            'Width' => 32,
            'Align' => 'C'
        );
        
        $GLOBALS['h_2'] = array(
            'Judul' => 'Tanggal',
            'Width' => 32,
            'Align' => 'C'
        );
        
        $GLOBALS['h_3'] = array(
            'Judul' => 'Pemasok',
            'Width' => 127,
            'Align' => 'L'
        );
        
        $GLOBALS['h_4'] = array(
            'Judul' => 'No. Cek',
            'Width' => 22,
            'Align' => 'C'
        );
        
        $GLOBALS['h_5'] = array(
            'Judul' => 'Tanggal Cel',
            'Width' => 32,
            'Align' => 'C'
        );
        
        $GLOBALS['h_6'] = array(
            'Judul' => 'Total Faktur',
            'Width' => 32,
            'Align' => 'C'
        );
        
        $pdf->AddPage();
        
        foreach ($pembayaran_pembelian as $data) {
            $pdf->SetFont('Arial', '', 8);
            
            switch ($data->Status) {
                case 'Buka Giro' :
                    $pdf->SetTextColor(243, 156, 18);
                    break;
                case 'Dicairkan' :
                    $pdf->SetTextColor(0, 166, 90);
                    break;
            }
            
            $pdf->Cell(32, 5, $data->NoPembayaran, 0, 0, 'C');
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(32, 5, date('d', strtotime($data->Tanggal)).' '.bulan(date('m', strtotime($data->Tanggal)), 'F').' '.date('Y', strtotime($data->Tanggal)), 0, 0, 'C');
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(127, 5, $data->NoPemasok.' - '.$data->NamaPemasok, 0, 0);
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(22, 5, $data->NoCek, 0, 0, 'C');
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(32, 5, date('d', strtotime($data->TanggalCek)).' '.bulan(date('m', strtotime($data->TanggalCek)), 'F').' '.date('Y', strtotime($data->TanggalCek)), 0, 0, 'C');

            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(32, 5, 'Rp. '.number_format($data->TotalFaktur, 2, ',', '.'), 0, 1, 'R');
            
            $jumlah_jumlah_faktur += $data->TotalFaktur;
        }
        
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(16, 174, 249);
        $pdf->Cell(245, 5, 'Total', 'T', 0, 'C');
        $pdf->Cell(32, 5, 'Rp. '.number_format($jumlah_jumlah_faktur, 2, ',', '.'), 'T', 0, 'R');
        
        $GLOBALS['h_max'] = 3;
        
        $GLOBALS['h_1'] = array(
            'Judul' => 'No. Pembayaran',
            'Width' => 32,
            'Align' => 'C'
        );
        
        $GLOBALS['h_2'] = array(
            'Judul' => 'Keterangan',
            'Width' => 213,
            'Align' => 'L'
        );
        
        $GLOBALS['h_3'] = array(
            'Judul' => 'Status',
            'Width' => 32,
            'Align' => 'C'
        );
        
        $pdf->AddPage();
        
        foreach ($pembayaran_pembelian as $data) {
            $pdf->SetFont('Arial', '', 8);
            
            switch ($data->Status) {
                case 'Buka Giro' :
                    $pdf->SetTextColor(243, 156, 18);
                    break;
                case 'Dicairkan' :
                    $pdf->SetTextColor(0, 166, 90);
                    break;
            }
            
            $pdf->Cell(32, 5, $data->NoPembayaran, 0, 0, 'C');
            
            if ($data->Keterangan == '') {
                $pdf->SetFont('Arial', 'I', 8);
                $pdf->SetTextColor(221, 75, 57);
                $pdf->Cell(213, 5, '(NULL)', 0, 0);
            } else {
                $pdf->SetFont('Arial', '', 8);
                $pdf->SetTextColor(0, 0, 0);
                $pdf->Cell(213, 5, $data->Keterangan, 0, 0);
            }
            
            $pdf->SetFont('Arial', '', 8);
            
            switch ($data->Status) {
                case 'Buka Giro' :
                    $pdf->SetTextColor(243, 156, 18);
                    break;
                case 'Dicairkan' :
                    $pdf->SetTextColor(0, 166, 90);
                    break;
            }
            
            $pdf->Cell(32, 5, $data->Status, 0, 1, 'C');
        }
        
        $pdf->AliasNbPages();
        
        $pdf->Output('Pembayaran Pembelian ('.date('dmy').').pdf', 'I');
    }
    
    function ProfitPenjualan() {
        $pdf = new unduhpdf('L', 'mm', 'A4');
        
        foreach ($this->Perusahaan->AmbilData() as $data) {
            $GLOBALS['image'] = base_url().'assets/dist/img/logo/'.$data->Logo;
            $GLOBALS['title'] = 'KPI '.$data->NamaPerusahaan;
            $pdf->SetTitle($GLOBALS['title']);
        }
        
        $GLOBALS['subtitle'] = 'PROFIT PENJUALAN';
        
        $tanggal_awal = $this->input->get('tanggal_awal');
        $tanggal_akhir = $this->input->get('tanggal_akhir');
        $pemasok = $this->input->get('pemasok');
        
        $this->load->model('Penjualan/PenjualanProfit');
        
        $no = 1;
        $total_penjualan = 0;
        $total_laba_kotor = 0;
        $rerata_profit = 0;
        
        $profit_penjualan = $this->PenjualanProfit->AmbilDataSemua(date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_awal))), date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_akhir))), $pemasok);
        
        
        $GLOBALS['h_max'] = 6;
        
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
            'Judul' => 'Pemasok',
            'Width' => 127,
            'Align' => 'L'
        );
        
        $GLOBALS['h_4'] = array(
            'Judul' => 'Penjualan',
            'Width' => 40,
            'Align' => 'C'
        );
        
        $GLOBALS['h_5'] = array(
            'Judul' => 'Laba Kotor',
            'Width' => 40,
            'Align' => 'C'
        );
        
        $GLOBALS['h_6'] = array(
            'Judul' => 'Profit',
            'Width' => 20,
            'Align' => 'C'
        );
        
        $pdf->AddPage();
        
        foreach ($profit_penjualan as $data) {
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(10, 5, $no++, 0, 0, 'C');
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(40, 5, date('d', strtotime($data->Tanggal)).' '.bulan(date('m', strtotime($data->Tanggal)), 'F').' '.date('Y', strtotime($data->Tanggal)), 0, 0, 'C');
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(127, 5, $data->NoPemasok.' - '.$data->NamaPemasok, 0, 0);
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(40, 5, 'Rp. '.number_format($data->Penjualan, 2, ',', '.'), 0, 0, 'R');
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(40, 5, 'Rp. '.number_format($data->LabaKotor, 2, ',', '.'), 0, 0, 'R');

            $pdf->SetFont('Arial', '', 8);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(20, 5, number_format($data->Profit, 1, ',', '.').'%', 0, 1, 'C');
            
            $total_penjualan += $data->Penjualan;
            $total_laba_kotor += $data->LabaKotor;
            $rerata_profit = $total_laba_kotor / $total_penjualan * 100;
        }
        
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetTextColor(16, 174, 249);
        $pdf->Cell(177, 5, 'Total', 'T', 0, 'C');
        $pdf->Cell(40, 5, 'Rp. '.number_format($total_penjualan, 2, ',', '.'), 'T', 0, 'R');
        $pdf->Cell(40, 5, 'Rp. '.number_format($total_laba_kotor, 2, ',', '.'), 'T', 0, 'R');
        $pdf->Cell(20, 5, number_format($rerata_profit, 1, ',', '.').'%', 'T', 1, 'C');
        
        $pdf->AliasNbPages();
        
        $pdf->Output('Profit / Penjualan ('.date('dmy').').pdf', 'I');
    }
}

?>