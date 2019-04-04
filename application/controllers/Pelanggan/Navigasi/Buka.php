<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buka extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        
        if ($this->session->userdata('Pengguna') == '') {
            redirect ('Autentikasi');
        }
        
        $this->load->model('Pengguna');
        $this->load->model('Aplikasi/Aplikasi');
        $this->load->model('Perusahaan');
        
        date_default_timezone_set('Asia/Jakarta');
	}
    
    public function DataPelanggan() {
        $no_pelanggan = $this->input->get('no_pelanggan');
        
        $data['up_konten'] = 'Data Pelanggan';
        $data['icon'] = 'fa-street-view';
        $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
        $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(2);
        $data['perusahaan'] = $this->Perusahaan->AmbilData();
        
        $this->load->model('Pelanggan/Pelanggan');
        $this->load->model('Penjual');
        $this->load->model('Rayon');
        
        foreach ($this->Pelanggan->AmbilDataSatuan($no_pelanggan) as $result) {
            $data['no_pelanggan'] = $result->NoPelanggan;   
            $data['nama_pelanggan'] = $result->NamaPelanggan;   
            $data['no_telepon'] = str_replace('+62', '', $result->NoTelepon);   
            $data['email'] = $result->Email;
            $data['alamat'] = $result->AlamatLengkap;   
            $data['kabupaten_kota'] = $result->KabupatenKota;   
            $data['provinsi'] = $result->Provinsi;   
            $data['kode_pos'] = $result->KodePos;   
            $data['no_rayon'] = $result->Rayon;   
            $data['no_penjual'] = $result->Penjual;
            $data['level_harga'] = $result->LevelHarga;
            $data['keterangan'] = $result->Keterangan;   
            $data['status'] = $result->Status;   
        
            $data['konten'] = $result->NamaPelanggan;
        }
        
        $data['penjual'] = $this->Penjual->AmbilDataSemua(null);
        $data['rayon'] = $this->Rayon->AmbilDataSemua(null);
        
        $this->load->view('index', $data);
    }
    
    public function TargetPelanggan() {
        $no = $this->input->get('no');
        
        $data['up_konten'] = 'Target / Pelanggan';
        $data['icon'] = 'fa-street-view';
        $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
        $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(2);
        $data['perusahaan'] = $this->Perusahaan->AmbilData();
        
        $this->load->model('Pelanggan/PelangganTarget');
        $this->load->model('Penjual');
        
        foreach ($this->PelangganTarget->AmbilDataSatuan($no) as $result) {
            $data['no'] = $result->No;   
            $data['bulan'] = $result->Bulan;   
            $data['pelanggan'] = $result->NoPelanggan.' - '.$result->NamaPelanggan;
            $data['penjual'] = $result->NoPenjual.' - '.$result->NamaPenjual;
            $data['target'] = $result->Target;   
        
            $data['konten'] = $result->NamaPelanggan;
        }
        
        $this->load->view('index', $data);
    }
    
    public function PiutangPelanggan() {
        $no = $this->input->get('no');
        
        $data['up_konten'] = 'Piutang / Pelanggan';
        $data['icon'] = 'fa-street-view';
        $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
        $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(2);
        $data['perusahaan'] = $this->Perusahaan->AmbilData();
        
        $this->load->model('Pelanggan/PelangganPiutang');
        
        foreach ($this->PelangganPiutang->AmbilDataSatuan($no) as $result) {
            $data['no'] = $result->No;   
            $data['tanggal'] = date('d/m/Y', strtotime(str_replace('-', '/', $result->Tanggal)));
            $data['pelanggan'] = $result->NoPelanggan.' - '.$result->NamaPelanggan;
            $data['penjual'] = $result->NoPenjual.' - '.$result->NamaPenjual;
            $data['piutang'] = $result->Piutang;
        
            $data['konten'] = $result->NamaPelanggan;
        }
        
        $this->load->view('index', $data);
    }
    
    public function GrafikNilaiPelanggan() {
        $no_pelanggan = $this->input->get('no_pelanggan');
        $nama_pelanggan = $this->input->get('nama_pelanggan');
        
        $data['up_konten'] = 'Nilai / Pelanggan';
        $data['konten'] = $nama_pelanggan;
        $data['icon'] = 'fa-street-view';
        $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
        $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(2);
        $data['perusahaan'] = $this->Perusahaan->AmbilData();
        
        $this->load->model('Pelanggan/PelangganNilai');
        
        for ($bulan = 1; $bulan <= 6; $bulan++) {
            if (date('d') <= 26) {
                $tanggal_awal = strtotime('-'.(9 - $bulan).' month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 26))));
                $tanggal_akhir = strtotime('-'.(8 - $bulan).' month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 25))));
            } else {
                $tanggal_awal = strtotime('-'.(8 - $bulan).' month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 26))));
                $tanggal_akhir = strtotime('-'.(7 - $bulan).' month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 25))));
            }
            
            $data['nilai'][$bulan] = array(
                'Bulan' => bulan(date('m', $tanggal_awal), 'M').' - '.bulan(date('m', $tanggal_akhir), 'M'),
                'Pencapaian' => $this->PelangganNilai->AmbilPencapaianLama($no_pelanggan, date('Y-m-d', $tanggal_awal), date('Y-m-d', $tanggal_akhir)),
                'Profit' => $this->PelangganNilai->AmbilProfitLama($no_pelanggan, date('Y-m-d', $tanggal_awal), date('Y-m-d', $tanggal_akhir)),
                'UPL' => $this->PelangganNilai->AmbilUPLLama($no_pelanggan, date('Y-m-d', $tanggal_awal), date('Y-m-d', $tanggal_akhir))
            );
        }
        
        foreach ($this->PelangganNilai->AmbilDataSatuan($no_pelanggan, null, null) as $sekarang) {
            if (date('d') <= 26) {
                $bulan = bulan(date('m', strtotime('-1 month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 26))))), 'M').' - '.bulan(date('m', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 25)))), 'M');
            } else {
                $bulan = bulan(date('m', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 26)))), 'M').' - '.bulan(date('m', strtotime('+1 month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 25))))), 'M');
            }
            
            $data['nilai'][7] = array(
                'Bulan' => $bulan,
                'Pencapaian' => $sekarang->Pencapaian,
                'Profit' => $sekarang->Profit,
                'UPL' => $sekarang->UPL
            );
        }

        $this->load->view('index', $data);
    }
    
    public function DataRayon() {
        $kode_rayon = $this->input->get('kode_rayon');
        
        $data['up_konten'] = 'Data Rayon';
        $data['icon'] = 'fa-map';
        $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
        $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(2);
        $data['perusahaan'] = $this->Perusahaan->AmbilData();
        
        $this->load->model('Rayon');
        
        foreach ($this->Rayon->AmbilDataSatuan($kode_rayon) as $result) {
            $data['kode_rayon'] = $result->KodeRayon;   
            $data['nama_rayon'] = $result->NamaRayon;
            $data['keterangan'] = $result->Keterangan;   
            $data['status'] = $result->Status;   
        
            $data['konten'] = $result->NamaRayon;
        }
        
        $this->load->view('index', $data);
    }
    
    public function DataPenjual() {
        $no_penjual = $this->input->get('no_penjual');
        
        $data['up_konten'] = 'Data Penjual';
        $data['icon'] = 'fa-tags';
        $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
        $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(2);
        $data['perusahaan'] = $this->Perusahaan->AmbilData();
        
        $this->load->model('Penjual');
        
        foreach ($this->Penjual->AmbilDataSatuan($no_penjual) as $result) {
            $data['no_penjual'] = $result->NoPenjual;   
            $data['nama_penjual'] = $result->NamaPenjual;
            $data['keterangan'] = $result->Keterangan;   
            $data['status'] = $result->Status;   
        
            $data['konten'] = $result->NamaPenjual;
        }
        
        $this->load->view('index', $data);
    }
    
    public function FakturPenjualan() {
        $no_faktur = $this->input->get('no_faktur');
        
        $data['up_konten'] = 'Faktur Penjualan';
        $data['icon'] = 'fa-shopping-cart';
        $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
        $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(2);
        $data['perusahaan'] = $this->Perusahaan->AmbilData();
        
        $this->load->model('Penjualan/PenjualanFaktur');
        
        foreach ($this->PenjualanFaktur->AmbilDataSatuan($no_faktur) as $result) {
            $data['no_faktur'] = $result->NoFaktur;   
            $data['tanggal'] = date('d/m/Y', strtotime(str_replace('-', '/', $result->Tanggal))); 
            $data['pelanggan'] = $result->NoPelanggan.' - '.$result->NamaPelanggan;   
            $data['penjual'] = $result->NoPenjual.' - '.$result->NamaPenjual;   
            $data['nilai_faktur'] = $result->NilaiFaktur;
            $data['keterangan'] = $result->Keterangan;
        
            $data['konten'] = $result->NamaPelanggan;
        }
        
        $this->load->view('index', $data);
    }
    
    public function ReturPenjualan() {
        $no_retur = $this->input->get('no_retur');
        
        $data['up_konten'] = 'Retur Penjualan';
        $data['icon'] = 'fa-shopping-cart';
        $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
        $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(2);
        $data['perusahaan'] = $this->Perusahaan->AmbilData();
        
        $this->load->model('Penjualan/PenjualanRetur');
        
        foreach ($this->PenjualanRetur->AmbilDataSatuan($no_retur) as $result) {
            $data['no_retur'] = $result->NoRetur;   
            $data['tanggal'] = date('d/m/Y', strtotime(str_replace('-', '/', $result->Tanggal))); 
            $data['pelanggan'] = $result->NoPelanggan.' - '.$result->NamaPelanggan;   
            $data['penjual'] = $result->NoPenjual.' - '.$result->NamaPenjual;   
            $data['nilai_retur'] = $result->NilaiRetur;
            $data['keterangan'] = $result->Keterangan;
        
            $data['konten'] = $result->NamaPelanggan;
        }
        
        $this->load->view('index', $data);
    }
    
    public function LabaKotorPenjualan() {
        $no = $this->input->get('no');
        
        $data['up_konten'] = 'Laba Kotor Penjualan';
        $data['icon'] = 'fa-shopping-cart';
        $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
        $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(2);
        $data['perusahaan'] = $this->Perusahaan->AmbilData();
        
        $this->load->model('Penjualan/PenjualanLabaKotor');
        $this->load->model('Penjual');
        
        foreach ($this->PenjualanLabaKotor->AmbilDataSatuan($no) as $result) {
            $data['no'] = $result->No;   
            $data['tanggal'] = date('d/m/Y', strtotime(str_replace('-', '/', $result->Tanggal))); 
            $data['pelanggan'] = $result->NoPelanggan.' - '.$result->NamaPelanggan;
            $data['no_penjual'] = $result->NoPenjual;
            $data['laba_kotor'] = $result->LabaKotor;
        
            $data['konten'] = $result->NamaPelanggan;
        }
        
        $data['penjual'] = $this->Penjual->AmbilDataSemua(null);
        
        $this->load->view('index', $data);
    }
}

?>