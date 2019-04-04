<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aplikasi extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
    
    public function AmbilDataSemua() {
        $this->db->select('aplksi__.Id, Logo, NamaAplikasi, Versi, Deskripsi, WarnaSkin, NamaClass');
        $this->db->from('aplksi__');
        $this->db->join('skn__', 'aplksi__.Skin = skn__.Id', 'inner');
        $this->db->join('anmsi__', 'aplksi__.Animasi = anmsi__.Id', 'inner');
        
        $data = $this->db->get()->result();
        
        return $data;
    }
    
    public function AmbilDataSatuan($id) {
        $this->db->select('aplksi__.Id, Logo, NamaAplikasi, Versi, Deskripsi, WarnaSkin, NamaClass');
        $this->db->from('aplksi__');
        $this->db->join('skn__', 'aplksi__.Skin = skn__.Id', 'inner');
        $this->db->join('anmsi__', 'aplksi__.Animasi = anmsi__.Id', 'inner');
        $this->db->where('aplksi__.Id', $id);
        
        $data = $this->db->get()->result();
        
        return $data;
    }
}

?>