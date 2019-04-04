<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjual extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
    
    public function AmbilDataSemua($status) {
        $this->db->select('*');
        $this->db->from('pnjual__');
        
        if (!($status == 'Tidak Aktif')) {
            $this->db->where('Status', 'Aktif');
        }
        
        $data = $this->db->get()->result();
        
        return $data;
    }
    
    public function AmbilDataSatuan($no_penjual) {
        $data = $this->db->get_where('pnjual__', array('NoPenjual' => $no_penjual))->result();
        
        return $data;
    }
    
    public function JumlahData() {
        $data = $this->db->get('pnjual__')->num_rows();
        
        return $data;
    }
    
    public function AmbilPredikatPenjual($predikat) {
        $this->db->select('COUNT(Predikat) as Predikat');
        $this->db->from('plnggn__');
        $this->db->join('plnggn_nli', 'plnggn__.NoPelanggan = plnggn_nli.Pelanggan', 'inner');
        $this->db->join('pnjual__', 'plnggn__.Penjual = pnjual__.NoPenjual', 'right');
        $this->db->where('Predikat', $predikat);
        $this->db->group_by('NoPenjual');
        $this->db->order_by('NoPenjual');
        
        $data = $this->db->get()->result();

        return $data;
    }

    public function TambahData($no_penjual, $nama_penjual, $keterangan) {
        $this->db->insert('pnjual__', array('NoPenjual' => $no_penjual, 'NamaPenjual' => $nama_penjual, 'Keterangan' => $keterangan, 'Status' => 'Aktif'));
    }
    
    public function UbahData($no_penjual, $nama_penjual, $keterangan) {
        if (!empty($nama_penjual)) {
            $this->db->set('NamaPenjual', $nama_penjual);
        }
        
        if (!empty($keterangan)) {
            $this->db->set('Keterangan', $keterangan);
        }
        
        $this->db->where('NoPenjual', $no_penjual);
        $this->db->update('pnjual__');
    }
    
    public function HapusData($no_penjual) {
        $this->db->delete('pnjual__', array('NoPenjual' => $no_penjual));

        if ($this->db->affected_rows() > 0) {
            $data = 'Sukses Hapus';
        } else {
            $data = 'Gagal Hapus';
        }
        
        return $data;
    }
}

?>