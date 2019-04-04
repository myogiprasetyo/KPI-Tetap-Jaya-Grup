<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MenuUtama extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        
        if ($this->session->userdata('Pengguna') == '') {
            redirect ('Autentikasi');
        }
        
        date_default_timezone_set('Asia/Jakarta');
	}
    
    public function index() {
        $this->load->model('Pengguna');
        $this->load->model('Aplikasi/Aplikasi');
        $this->load->model('Perusahaan');
        
        $data['konten'] = 'Menu Utama';
        
        $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
        
        $data['menu_utama'] = $this->Aplikasi->AmbilDataSemua();
        $data['perusahaan'] = $this->Perusahaan->AmbilData();
        
        $this->load->view('index', $data);
    }
}

?>