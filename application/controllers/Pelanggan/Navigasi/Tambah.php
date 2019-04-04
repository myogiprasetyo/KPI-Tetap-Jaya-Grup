<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tambah extends CI_Controller {
	
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
        $data['up_konten'] = 'Data Pelanggan';
        $data['konten'] = 'Tambah';
        $data['icon'] = 'fa-street-view';
        $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
        $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(2);
        $data['perusahaan'] = $this->Perusahaan->AmbilData();
        
        $this->load->model('Fungsi/FungsiNomorAkhir');
        $this->load->model('Penjual');
        $this->load->model('Rayon');
        
        $data['nomor_auto'] = $this->FungsiNomorAkhir->AmbilData('Data Pelanggan', null);
        $data['penjual'] = $this->Penjual->AmbilDataSemua(null);
        $data['rayon'] = $this->Rayon->AmbilDataSemua(null);
        
        $this->load->view('index', $data);
    }
    
    public function TargetPelanggan() {
        $data['up_konten'] = 'Target / Pelanggan';
        $data['konten'] = 'Tambah';
        $data['icon'] = 'fa-street-view';
        $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
        $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(2);
        $data['perusahaan'] = $this->Perusahaan->AmbilData();
        
        $this->load->model('Pelanggan/Pelanggan');
        $this->load->model('Penjual');
        
        $data['bulan'] = bulan(null, 'F').' '.date('Y');
        $data['pelanggan'] = $this->Pelanggan->AmbilDataSemua(null);
        $data['penjual'] = $this->Penjual->AmbilDataSemua(null);
        
        $this->load->view('index', $data);
    }
    
    public function PiutangPelanggan() {
        $data['up_konten'] = 'Piutang / Pelanggan';
        $data['konten'] = 'Tambah';
        $data['icon'] = 'fa-street-view';
        $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
        $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(2);
        $data['perusahaan'] = $this->Perusahaan->AmbilData();
        
        $this->load->model('Pelanggan/Pelanggan');
        $this->load->model('Penjual');
        
        $data['tanggal'] = date('d/m/Y');
        $data['pelanggan'] = $this->Pelanggan->AmbilDataSemua(null);
        $data['penjual'] = $this->Penjual->AmbilDataSemua(null);
        
        $this->load->view('index', $data);
    }
    
    public function DataRayon() {
        $data['up_konten'] = 'Data Rayon';
        $data['konten'] = 'Tambah';
        $data['icon'] = 'fa-map';
        $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
        $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(2);
        $data['perusahaan'] = $this->Perusahaan->AmbilData();
        
        $this->load->view('index', $data);
    }
    
    public function DataPenjual() {
        $data['up_konten'] = 'Data Penjual';
        $data['konten'] = 'Tambah';
        $data['icon'] = 'fa-tags';
        $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
        $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(2);
        $data['perusahaan'] = $this->Perusahaan->AmbilData();
        
        $this->load->view('index', $data);
    }
    
    public function FakturPenjualan() {
        $data['up_konten'] = 'Faktur Penjualan';
        $data['konten'] = 'Tambah';
        $data['icon'] = 'fa-shopping-cart';
        $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
        $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(2);
        $data['perusahaan'] = $this->Perusahaan->AmbilData();
        
        $this->load->model('Pelanggan/Pelanggan');
        $this->load->model('Fungsi/FungsiNomorAkhir');
        $this->load->model('Penjual');
        
        $data['tanggal'] = date('d/m/Y');
        $data['pelanggan'] = $this->Pelanggan->AmbilDataSemua(null);
        $data['nomor_auto'] = $this->FungsiNomorAkhir->AmbilData('Faktur Penjualan', date('Y-m-d'));
        $data['penjual'] = $this->Penjual->AmbilDataSemua(null);
        
        $this->load->view('index', $data);
    }
    
    public function ReturPenjualan() {
        $data['up_konten'] = 'Retur Penjualan';
        $data['konten'] = 'Tambah';
        $data['icon'] = 'fa-shopping-cart';
        $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
        $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(2);
        $data['perusahaan'] = $this->Perusahaan->AmbilData();
        
        $this->load->model('Pelanggan/Pelanggan');
        $this->load->model('Fungsi/FungsiNomorAkhir');
        $this->load->model('Penjual');
        
        $data['tanggal'] = date('d/m/Y');
        $data['pelanggan'] = $this->Pelanggan->AmbilDataSemua(null);
        $data['nomor_auto'] = $this->FungsiNomorAkhir->AmbilData('Retur Penjualan', date('Y-m-d'));
        $data['penjual'] = $this->Penjual->AmbilDataSemua(null);
        
        $this->load->view('index', $data);
    }
    
    public function LabaKotorPenjualan() {
        $data['up_konten'] = 'Laba Kotor Penjualan';
        $data['konten'] = 'Tambah';
        $data['icon'] = 'fa-shopping-cart';
        $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
        $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(2);
        $data['perusahaan'] = $this->Perusahaan->AmbilData();
        
        $this->load->model('Pelanggan/Pelanggan');
        $this->load->model('Penjual');
        
        $data['tanggal'] = date('d/m/Y');
        $data['pelanggan'] = $this->Pelanggan->AmbilDataSemua(null);
        $data['penjual'] = $this->Penjual->AmbilDataSemua(null);
        
        $this->load->view('index', $data);
    }
}

?>