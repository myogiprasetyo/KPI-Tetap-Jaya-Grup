<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FungsiNotifikasi extends CI_Model {
	
	public function __construct(){
		parent::__construct();
    }
    
    public function PembayaranPembelian() {
        $data = 0;

        foreach ($this->db->get_where('pmblan_byr', array('Status' => 'Buka Giro'))->result() as $result) {
            $tanggal_awal = date('Y-m-d', strtotime($result->TanggalCek));
            $tanggal_akhir = date('Y-m-d');

            if ($tanggal_akhir > $tanggal_awal) {
                $selisih = (date_diff(new datetime($tanggal_awal), new datetime($tanggal_akhir)))->format('%a');
                
                if ($selisih > 7) {
                    $data += 1;
                }
            }
        }
        
        return $data;
    }
}

?>