<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dorong extends CI_Controller {
	
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
    
    public function PesananPembelian() {
        
        $data['up_konten'] = 'Faktur Pembelian';
        $data['konten'] = 'Dorong';
        $data['icon'] = 'fa-cart-plus';
        $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
        $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(1);
        $data['perusahaan'] = $this->Perusahaan->AmbilData();
        
        $data['tanggal'] = date('d/m/Y');
        $data['no_po'] = $this->input->get('no_po');
        $data['pemasok'] = $this->input->get('no_pemasok');
        
        $this->load->model('Fungsi/FungsiNomorAkhir');
        
        $data['nomor_auto'] = $this->FungsiNomorAkhir->AmbilData('Faktur Pembelian', date('Y-m-d'));
        
        $this->load->view('index', $data);
    }
}

?>