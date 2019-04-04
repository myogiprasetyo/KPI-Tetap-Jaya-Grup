<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PenjualanLabaKotor extends CI_Model {
	
	public function __construct(){
		parent::__construct();
        
	}
    
    public function AmbilDataSemua($no_penjual, $no_pelanggan, $tanggal_awal, $tanggal_akhir) {
        $this->db->select('No, Tanggal, NoPelanggan, NamaPelanggan, NoPenjual, NamaPenjual, LabaKotor');
        $this->db->from('pnjualn_lba_ktr');
        $this->db->join('plnggn__', 'pnjualn_lba_ktr.Pelanggan = plnggn__.NoPelanggan', 'inner');
        $this->db->join('pnjual__', 'pnjualn_lba_ktr.Penjual = pnjual__.NoPenjual', 'inner');
        $this->db->where(array('Tanggal >=' => $tanggal_awal, 'Tanggal <=' => $tanggal_akhir));
        
        if (!(empty($no_penjual) || $no_penjual == 'Semua')) {
            $this->db->where('NoPenjual', $no_penjual);
        }

        if (!(empty($no_pelanggan) || $pelanggan == 'Semua')) {
            $this->db->where('NoPelanggan', $no_pelanggan);
        }
        
        $data = $this->db->get()->result();
        
        return $data;
    }
    
    public function AmbilDataSatuan($no) {
        $this->db->select('No, Tanggal, NoPelanggan, NamaPelanggan, NoPenjual, NamaPenjual, LabaKotor');
        $this->db->from('pnjualn_lba_ktr');
        $this->db->join('plnggn__', 'pnjualn_lba_ktr.Pelanggan = plnggn__.NoPelanggan', 'inner');
        $this->db->join('pnjual__', 'pnjualn_lba_ktr.Penjual = pnjual__.NoPenjual', 'inner');
        $this->db->where('No', $no);
        
        $data = $this->db->get()->result();
        
        return $data;
    }
    
    public function TotaLabaKotorSemua($tanggal_awal, $tanggal_akhir, $no_penjual) {
        $this->db->select('SUM(LabaKotor) as LabaKotor');
        $this->db->from('pnjualn_lba_ktr');
        
        if ($no_penjual >= 100) {
            $this->db->where('Penjual >=', 100);
        } else {
            $this->db->where('Penjual', $no_penjual);
        }
        
        $this->db->where(array('Tanggal >=' => $tanggal_awal, 'Tanggal <=' => $tanggal_akhir));
        
        foreach ($this->db->get()->result() as $result) {
            $data = $result->LabaKotor;
        }
        
        return $data;
    }
    
    public function TotaLabaKotorSatuan($tanggal_awal, $tanggal_akhir, $no_pelanggan) {
        $this->db->select('SUM(LabaKotor) as LabaKotor');
        $this->db->from('pnjualn_lba_ktr');
        $this->db->where(array('Tanggal >=' => $tanggal_awal, 'Tanggal <=' => $tanggal_akhir, 'Pelanggan' => $no_pelanggan));
        
        foreach ($this->db->get()->result() as $result) {
            $data = $result->LabaKotor;
        }
        
        return $data;
    }
    
    public function TambahData($tanggal, $no_pelanggan, $no_penjual, $laba_kotor) {
        $this->db->insert('pnjualn_lba_ktr', array('Tanggal' => $tanggal, 'Pelanggan' => $no_pelanggan, 'Penjual' => $no_penjual, 'LabaKotor' => $laba_kotor));
        
        $this->load->model('Pelanggan/PelangganNilai');
        
        $this->PelangganNilai->PerbaruiProfit($no_pelanggan, $tanggal);
    }
    
    public function UbahData($no, $no_penjual, $laba_kotor) {
        foreach ($this->AmbilDataSatuan($no) as $result) {
            if (!empty($no_penjual)) {
                $this->db->set('Penjual', $no_penjual);
            }
            
            if (!empty($laba_kotor)) {
                $this->db->set('LabaKotor', $laba_kotor);
            }
            
            $this->db->where('No', $no);
            $this->db->update('pnjualn_lba_ktr');

            $this->load->model('Pelanggan/PelangganNilai');
        
            $this->PelangganNilai->PerbaruiProfit($result->NoPelanggan, date('Y-m-d'));
        }
    }
    
    public function HapusData($no) {
        foreach ($this->AmbilDataSatuan($no) as $result) {
            $this->db->delete('pnjualn_lba_ktr', array('No' => $no));
            
            if ($this->db->affected_rows() > 0) {
                date_default_timezone_set('Asia/Jakarta');

                $this->load->model('Pelanggan/PelangganNilai');

                $this->PelangganNilai->PerbaruiProfit($result->NoPelanggan, date('Y-m-d'));
                
                $data = 'Sukses Hapus';
            } else {
                $data = 'Gagal Hapus';
            }
        }
        
        return $data;
    }
}

?>