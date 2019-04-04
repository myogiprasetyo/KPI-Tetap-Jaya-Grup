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
    
    public function DataPemasok() {
        $data['up_konten'] = 'Data Pemasok';
        $data['konten'] = 'Tambah';
        $data['icon'] = 'fa-user-secret';
        $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
        $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(1);
        $data['perusahaan'] = $this->Perusahaan->AmbilData();
        
        $this->load->view('index', $data);
    }
    
    public function PersediaanAkhirPemasok() {
        $data['up_konten'] = 'Persediaan Akhir / Pemasok';
        $data['konten'] = 'Tambah';
        $data['icon'] = 'fa-cubes';
        $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
        $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(1);
        $data['perusahaan'] = $this->Perusahaan->AmbilData();
        
        $data['tanggal'] = date('d/m/Y');
        
        $this->load->model('Pemasok/Pemasok');
        
        $data['pemasok'] = $this->Pemasok->AmbilDataSemua(null);
        
        $this->load->view('index', $data);
    }
    
    public function PesananPembelian() {
        $data['up_konten'] = 'Pesanan Pembelian';
        $data['konten'] = 'Tambah';
        $data['icon'] = 'fa-cart-plus';
        $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
        $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(1);
        $data['perusahaan'] = $this->Perusahaan->AmbilData();
        
        $data['tanggal'] = date('d/m/Y');
        
        $this->load->model('Pemasok/Pemasok');
        $this->load->model('Fungsi/FungsiNomorAkhir');
        
        $data['pemasok'] = $this->Pemasok->AmbilDataSemua(null);
        $data['nomor_auto'] = $this->FungsiNomorAkhir->AmbilData('Pesanan Pembelian', date('Y-m-d'));
        
        $this->load->view('index', $data);
    }
    
    public function FakturPembelian() {
        $data['up_konten'] = 'Faktur Pembelian';
        $data['konten'] = 'Tambah';
        $data['icon'] = 'fa-cart-plus';
        $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
        $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(1);
        $data['perusahaan'] = $this->Perusahaan->AmbilData();
        
        $data['tanggal'] = date('d/m/Y');
        
        $this->load->model('Pemasok/Pemasok');
        $this->load->model('Fungsi/FungsiNomorAkhir');
        
        $data['pemasok'] = $this->Pemasok->AmbilDataSemua(null);
        $data['nomor_auto'] = $this->FungsiNomorAkhir->AmbilData('Faktur Pembelian', date('Y-m-d'));
        
        $this->load->view('index', $data);
    }
    
    public function PembayaranPembelian() {
        $data['up_konten'] = 'Pembayaran Pembelian';
        $data['konten'] = 'Tambah';
        $data['icon'] = 'fa-cart-plus';
        $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
        $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(1);
        $data['perusahaan'] = $this->Perusahaan->AmbilData();
        
        $data['tanggal'] = date('d/m/Y');
        $data['tanggal_cek'] = date('d/m/Y');
        
        $this->load->model('Pemasok/Pemasok');
        $this->load->model('Fungsi/FungsiNomorAkhir');
        
        $data['pemasok'] = $this->Pemasok->AmbilDataSemua(null);
        $data['nomor_auto'] = $this->FungsiNomorAkhir->AmbilData('Pembayaran Pembelian', date('Y-m-d'));
        
        $this->load->view('index', $data);
    }
    
    public function ProfitPenjualan() {
        $data['up_konten'] = 'Profit / Penjualan';
        $data['konten'] = 'Tambah';
        $data['icon'] = 'fa-cart-plus';
        $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
        $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(1);
        $data['perusahaan'] = $this->Perusahaan->AmbilData();
        
        $data['tanggal'] = date('d/m/Y');
        
        $this->load->model('Pemasok/Pemasok');
        
        $data['pemasok'] = $this->Pemasok->AmbilDataSemua(null);
        
        $this->load->view('index', $data);
    }
}

?>