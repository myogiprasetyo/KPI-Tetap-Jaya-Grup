<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {
	
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

    public function update_all() {

    }
    
    public function index() {
        $cari_menu = $this->input->post('cari_menu');
        
        switch ($cari_menu) {
            case 'Data Toko' :
                $data = $this->DataPemasok();
                break;
            case 'Nilai Toko' :
                $data = $this->DataPemasok();
                break;
            case 'Data Kanvas' :
                $data = $this->PemasokNilai();
                break;
            case 'Nilai Kanvas' :
                $data = $this->DataPemasok();
                break;
            case 'Data Marketing' :
                $data = $this->PembelianPesanan();
                break;
            case 'Nilai Marketing' :
                $data = $this->DataPemasok();
                break;
            case 'Data Distribusi' :
                $data = $this->PembelianFaktur();
                break;
            case 'Nilai Distribusi' :
                $data = $this->DataPemasok();
                break;
            default :
                $data = $this->Dasbor();
                break;
        }
    }
    
    public function Dasbor() {
        $data['konten'] = 'Dasbor';
        $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
        $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(4);
        $data['perusahaan'] = $this->Perusahaan->AmbilData();
        
        $abjad = range('A', 'E');
        
        $this->load->model('Toko/TokoNilai');
        $this->load->model('Kanvas/KanvasNilai');
        $this->load->model('Sales/SalesNilai');
        $this->load->model('Distribusi/DistribusiNilai');
        
        $this->load->view('index', $data);
    }
}

?>