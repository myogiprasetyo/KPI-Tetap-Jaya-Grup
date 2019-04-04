<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pilihan extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        
        $this->load->model('Fungsi/FungsiAmbil');
	}
    
    public function AmbilData() {
        $pilihan = $this->input->post('pilihan');
        
        switch ($pilihan) {
            case 'No. Penjual' :
                $no_pelanggan = $this->input->post('no_pelanggan');
                $data = $this->FungsiAmbil->Penjual($no_pelanggan);
                break;
        }
        
        echo json_encode($data);
    }
}

?>