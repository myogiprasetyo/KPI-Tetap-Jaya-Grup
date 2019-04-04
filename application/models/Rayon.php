<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rayon extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
    
    public function AmbilDataSemua($status) {
        $this->db->select('*');
        $this->db->from('ryon__');
        
        if (!($status == 'Tidak Aktif')) {
            $this->db->where('Status', 'Aktif');
        }
        
        $data = $this->db->get()->result();
        
        return $data;
    }
    
    public function AmbilDataSatuan($kode_rayon) {
        $data = $this->db->get_where('ryon__', array('KodeRayon' => $kode_rayon))->result();
        
        return $data;
    }
    
    public function JumlahData() {
        $data = $this->db->get('ryon__')->num_rows();
        
        return $data;
    }

    public function TambahData($kode_rayon, $nama_rayon, $keterangan) {
        $this->db->insert('ryon__', array('KodeRayon' => $kode_rayon, 'NamaRayon' => $nama_rayon, 'Keterangan' => $keterangan, 'Status' => 'Aktif'));
    }
    
    public function UbahData($kode_rayon, $nama_rayon, $keterangan) {
        if (!empty($nama_rayon)) {
            $this->db->set('NamaRayon', $nama_rayon);
        }
        
        if (!empty($keterangan)) {
            $this->db->set('Keterangan', $keterangan);
        }
        
        $this->db->where('KodeRayon', $kode_rayon);
        $this->db->update('ryon__');
    }
    
    public function HapusData($kode_rayon) {
        $this->db->delete('ryon__', array('KodeRayon' => $kode_rayon));

        if ($this->db->affected_rows() > 0) {
            $data = 'Sukses Hapus';
        } else {
            $data = 'Gagal Hapus';
        }
        
        return $data;
    }
}

?>