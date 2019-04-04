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
            case 'No. PO' :
                $no_pemasok = $this->input->post('no_pemasok');
                $data = $this->FungsiAmbil->NoPO($no_pemasok);
                break;
            case 'No. Faktur' :
                $no_pemasok = $this->input->post('no_pemasok');
                $data = $this->FungsiAmbil->NoFaktur($no_pemasok);
                break;
            case 'Nilai Faktur' :
                $no_faktur = $this->input->post('no_faktur');
                $data = $this->FungsiAmbil->NilaiFaktur($no_faktur);
                break;
        }
        
        echo json_encode($data);
    }
}

?>