<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PelangganPiutang extends CI_Model {
	
	public function __construct(){
		parent::__construct();
        
	}
    
    public function AmbilDataSemua($tanggal_awal, $tanggal_akhir, $no_penjual, $status) {
        $this->db->select('No, Tanggal, NoPelanggan, NamaPelanggan, NoPenjual, NamaPenjual, Piutang, plnggn__.Status');
        $this->db->from('plnggn_ptng');
        $this->db->join('plnggn__', 'plnggn_ptng.Pelanggan = plnggn__.NoPelanggan', 'inner');
        $this->db->join('pnjual__', 'plnggn_ptng.Penjual = pnjual__.NoPenjual', 'inner');
        
        if (!(empty($no_penjual) || $no_penjual == 'Semua')) {
            $this->db->where('NoPenjual', $no_penjual);
        }
        
        if (!($status == 'Tidak Aktif')) {
            $this->db->where('plnggn__.Status', 'Aktif');
        }
        
        $this->db->where(array('Tanggal >=' => $tanggal_awal, 'Tanggal <=' => $tanggal_akhir));
        $this->db->order_by('Tanggal', 'DESC');
        
        $data = $this->db->get()->result();
        
        return $data;
    }
    
    public function AmbilDataSatuan($no) {
        $this->db->select('No, Tanggal, NoPelanggan, NamaPelanggan, NoPenjual, NamaPenjual, Piutang');
        $this->db->from('plnggn_ptng');
        $this->db->join('plnggn__', 'plnggn_ptng.Pelanggan = plnggn__.NoPelanggan', 'inner');
        $this->db->join('pnjual__', 'plnggn_ptng.Penjual = pnjual__.NoPenjual', 'inner');
        $this->db->where('No', $no);
        
        $data = $this->db->get()->result();
        
        return $data;
    }
    
    public function TotaPiutangSemua($tanggal_awal, $tanggal_akhir, $no_penjual) {
        $this->db->select('SUM(Piutang) as Piutang');
        $this->db->from('plnggn_ptng');
        
        if ($no_penjual >= 100) {
            $this->db->where('Penjual >=', 100);
        } else {
            $this->db->where('Penjual', $no_penjual);
        }
        
        $this->db->where(array('Tanggal >=' => $tanggal_awal, 'Tanggal <=' => $tanggal_akhir));
        
        foreach ($this->db->get()->result() as $result) {
            $data = $result->Piutang;
        }
        
        return $data;
    }
    
    public function TotaPiutangSatuan($tanggal_awal, $tanggal_akhir, $no_pelanggan) {
        $this->db->select('SUM(Piutang) as Piutang');
        $this->db->from('plnggn_ptng');
        $this->db->where(array('Tanggal >=' => $tanggal_awal, 'Tanggal <=' => $tanggal_akhir, 'Pelanggan' => $no_pelanggan));
        
        foreach ($this->db->get()->result() as $result) {
            $data = $result->Piutang;
        }
        
        return $data;
    }

    public function TambahData($tanggal, $no_pelanggan, $no_penjual, $piutang) {
        if ($this->db->get_where('plnggn_ptng', array('Tanggal' => $tanggal, 'Pelanggan' => $no_pelanggan, 'Penjual' => $no_penjual))->num_rows() < 1) {
            $this->db->insert('plnggn_ptng', array('Tanggal' => $tanggal, 'Pelanggan' => $no_pelanggan, 'Penjual' => $no_penjual, 'Piutang' => $piutang));
        } else {
            foreach ($this->db->get_where('plnggn_ptng', array('Tanggal' => $tanggal, 'Pelanggan' => $no_pelanggan, 'Penjual' => $no_penjual))->result() as $result) {
                $this->db->update('plnggn_ptng', array('Piutang' => $piutang), array('No' => $result->No));
            }
        }
        
        $this->load->model('Pelanggan/PelangganNilai');
            
        $this->PelangganNilai->PerbaruiUPL($no_pelanggan, $tanggal);
    }
    
    public function UbahData($no, $piutang) {
        foreach ($this->AmbilDataSatuan($no) as $result) {
            if (!empty($piutang)) {
                $this->db->set('Piutang', $piutang);
            }

            $this->db->where('No', $no);
            $this->db->update('plnggn_ptng');
            
            $this->load->model('Pelanggan/PelangganNilai');
            
            $this->PelangganNilai->PerbaruiUPL($result->NoPelanggan, $result->Tanggal);
        }
    }
    
    public function HapusData($no) {
        foreach ($this->AmbilDataSatuan($no) as $result) {
            $this->db->delete('plnggn_ptng', array('No' => $no));

            if ($this->db->affected_rows() > 0) {
                date_default_timezone_set('Asia/Jakarta');

                $this->load->model('Pelanggan/PelangganNilai');

                $this->PelangganNilai->PerbaruiUPL($result->NoPelanggan, date('Y-m-d'));

                $data = 'Sukses Hapus';
            } else {
                $data = 'Gagal Hapus';
            }
        }
        
        return $data;
    }
}

?>