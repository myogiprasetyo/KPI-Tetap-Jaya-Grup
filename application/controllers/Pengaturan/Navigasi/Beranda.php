<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        
        if ($this->session->userdata('NIK') == '') {
            redirect ('Autentikasi');
        }
        
        $this->load->model('Karyawan/Karyawan');
        
        date_default_timezone_set('Asia/Jakarta');
	}
    
    public function index() {
        $cari_menu = $this->input->post('cari_menu');
        
        switch ($cari_menu) {
            case 'Profil Saya' :
                $this->ProfilSaya();
                break;
            case 'Karyawan' :
                $this->Karyawan();
                break;
            case 'PenggunaAplikasi' :
                $this->PenggunaAplikasi();
                break;
            case 'InfoPerusahaan' :
                $this->InfoPerusahaan();
                break;
            case 'PengaturanAplikasi' :
                $this->PengaturanAplikasi();
                break;
            case 'Tentang' :
                $this->Tentang();
                break;
            default :
                $this->ProfilSaya();
                break;
        }
    }
    
    public function ProfilSaya() {
        $this->load->model('Karyawan/Posisi');
        
        $data['konten'] = 'Profil Saya';
        $data['icon'] = 'fa-user';
        $data['karyawan'] = $this->Karyawan->Filter(array('NIK' => $this->session->userdata('NIK')))->result();
        $data['devisi'] = $this->Posisi->SemuaDevisi()->result();
        
        $this->load->view('pengaturan/index', $data);
    }
    
    public function Karyawan() {
        $data['konten'] = 'Karyawan';
        $data['icon'] = 'fa-users';
        $data['karyawan'] = $this->Karyawan->Filter(array('NIK' => $this->session->userdata('NIK')))->result();
        $data['tabel'] = $this->Karyawan->Semua()->result();
        
        $this->load->view('pengaturan/index', $data);
    }
    
    public function PenggunaAplikasi() {
        $data['konten'] = 'Pengguna Aplikasi';
        $data['icon'] = 'fa-users';
        $data['karyawan'] = $this->Karyawan->Filter(array('NIK' => $this->session->userdata('NIK')))->result();
        $data['semua_karyawan'] = $this->Karyawan->Semua()->result();
        
        $this->load->view('pengaturan/index', $data);
    }
    
    public function InfoPerusahaan() {
        $data['konten'] = 'Info Perusahaan';
        $data['icon'] = 'fa-gear';
        $data['karyawan'] = $this->Karyawan->Filter(array('NIK' => $this->session->userdata('NIK')))->result();
        
        $this->load->view('pengaturan/index', $data);
    }
    
    public function PengaturanAplikasi() {
        $data['konten'] = 'Pengaturan Aplikasi';
        $data['icon'] = 'fa-gear';
        $data['karyawan'] = $this->Karyawan->Filter(array('NIK' => $this->session->userdata('NIK')))->result();
        
        $this->load->view('pengaturan/index', $data);
    }
    
    public function Tentang() {
        $data['konten'] = 'Tentang';
        $data['icon'] = 'fa-info';
        $data['karyawan'] = $this->Karyawan->Filter(array('NIK' => $this->session->userdata('NIK')))->result();
        
        $this->load->view('pengaturan/index', $data);
    }
}
    
?>