<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
    
    public function CekKetersediaan($nik) {
        if ($this->db->get_where('pnggna__', array('Pengguna' => $nik))->num_rows() == 1) {
            $data = true;
        } else {
            $data = false;
        }
            
        return $data;
    }
            
    public function AmbilData($nik) {
        $data = $this->db->get_where('pnggna__', array('Pengguna' => $nik))->result();
            
        return $data;
    }
            
    public function MiniProfil($nik) {
        $this->db->select('NIK, Foto, NamaLengkap, JenisKelamin, dvsi_jbtan.Jabatan, TanggalMasuk');
        $this->db->from('krywn__');
        $this->db->join('dvsi_jbtan', 'krywn__.Jabatan = dvsi_jbtan.Id', 'inner');
        $this->db->where('NIK', $nik);
        $data = $this->db->get()->result();
            
        return $data;
    }
}

?>