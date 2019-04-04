<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FungsiAmbil extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
    
    public function NoPO($no_pemasok) {
        $this->db->select('NoPO');
        $this->db->from('pmblan_psn');
        $this->db->join('pmsk__', 'pmblan_psn.Pemasok = pmsk__.NoPemasok', 'inner');
        $this->db->where(array('pmsk__.NoPemasok' => $no_pemasok, 'pmblan_psn.Status' => 'Sedang Diproses'));
        
        $data = $this->db->get()->result();
        
        return $data;
    }
    
    public function NoFaktur($no_pemasok) {
        $this->db->select('NoFaktur');
        $this->db->from('pmblan_fktr');
        $this->db->join('pmsk__', 'pmblan_fktr.Pemasok = pmsk__.NoPemasok', 'inner');
        $this->db->where(array('pmsk__.NoPemasok' => $no_pemasok, 'pmblan_fktr.Status' => 'Belum Lunas'));
        
        $data = $this->db->get()->result();
        
        return $data;
    }
    
    public function NilaiFaktur($no_faktur) {
        $this->db->select('NilaiFaktur');
        $this->db->from('pmblan_fktr');
        $this->db->join('pmsk__', 'pmblan_fktr.Pemasok = pmsk__.NoPemasok', 'inner');
        $this->db->where(array('pmblan_fktr.NoFaktur' => $no_faktur, 'pmblan_fktr.Status' => 'Belum Lunas'));
        
        $data = $this->db->get()->result();
        
        return $data;
    }
    
    public function Penjual($no_pelanggan) {
        $this->db->select('Penjual');
        $this->db->from('plnggn__');
        $this->db->where('NoPelanggan', $no_pelanggan);
        
        $data = $this->db->get()->result();
        
        return $data;
    }
}

?>