<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PenjualanProfit extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
    
    public function AmbilDataSemua($tanggal_awal, $tanggal_akhir, $pemasok) {
        $this->db->select('No, Tanggal, pmsk__.NoPemasok, pmsk__.NamaPemasok, Penjualan, LabaKotor, Profit');
        $this->db->from('pnjualn_prft');
        $this->db->join('pmsk__', 'pnjualn_prft.Pemasok = pmsk__.NoPemasok', 'inner');
        $this->db->where(array('Status' => 'Aktif', 'Tanggal >=' => $tanggal_awal, 'Tanggal <=' => $tanggal_akhir));
        
        if (!(empty($pemasok) || $pemasok == 'Semua')) {
            $this->db->where('Pemasok', $pemasok);
        }
        
        $data = $this->db->get()->result();
        
        return $data;
    }
    
    public function AmbilDataSatuan($no) {
        $this->db->select('No, Tanggal, pmsk__.NoPemasok, pmsk__.NamaPemasok, Penjualan, LabaKotor, Profit');
        $this->db->from('pnjualn_prft');
        $this->db->join('pmsk__', 'pnjualn_prft.Pemasok = pmsk__.NoPemasok', 'inner');
        $this->db->where('No', $no);
        
        $data = $this->db->get()->result();
        
        return $data;
    }
    
    public function ProfitSemua() {
        $data = 0;
        
        $this->db->select('(SUM(LabaKotor) / SUM(Penjualan) * 100) as Profit');
        $this->db->from('pnjualn_prft');
        
        foreach ($this->db->get()->result() as $result) {
            if ($result->Profit == null) {
                $data = 0;
            } else {
                $data = $result->Profit;
            }
        }
        
        return $data;
    }
    
    public function ProfitSatuan($no_pemasok) {
        $data = 0;
        
        $this->db->select('(SUM(LabaKotor) / SUM(Penjualan) * 100) as Profit');
        $this->db->from('pnjualn_prft');
        $this->db->where('Pemasok', $no_pemasok);
        
        foreach ($this->db->get()->result() as $result) {
            if ($result->Profit == null) {
                $data = 0;
            } else {
                $data = $result->Profit;
            }
        }
        
        return $data;
    }
    
    public function TambahData($tanggal, $no_pemasok, $penjualan, $laba_kotor) {
        $profit = ($laba_kotor / $penjualan) * 100;
        
        $this->db->insert('pnjualn_prft', array('Tanggal' => $tanggal, 'Pemasok' => $no_pemasok, 'Penjualan' => $penjualan, 'LabaKotor' => $laba_kotor, 'Profit' => $profit));
        
        $this->load->model('Pemasok/PemasokNilai');
                        
        $this->PemasokNilai->PerbaruiProfit($no_pemasok, $tanggal);
    }
    
    public function UbahData($no, $tanggal, $no_pemasok, $penjualan, $laba_kotor) {
        if (!empty($tanggal)) {
            $this->db->set('Tanggal', $tanggal);
        }
        
        if (!empty($no_pemasok)) {
            $this->db->set('Pemasok', $no_pemasok);
        }
        
        if (!empty($penjualan)) {
            $this->db->set('Penjualan', $penjualan);
        }
        
        if (!empty($laba_kotor)) {
            $this->db->set('LabaKotor', $laba_kotor);
        }
        
        if (!(empty($penjualan) && empty($laba_kotor))) {
            $this->db->set('Profit', ($laba_kotor / $penjualan) * 100);
        }
        
        $this->db->where('No', $no);
        $this->db->update('pnjualn_prft');
        
        $this->load->model('Pemasok/PemasokNilai');
                        
        $this->PemasokNilai->PerbaruiProfit($no_pemasok, $tanggal);
    }
    
    public function HapusData($no) {
        foreach ($this->AmbilDataSatuan($no) as $result) {
            $this->db->delete('pnjualn_prft', array('No' => $no));
            
            if ($this->db->affected_rows() > 0) {
                date_default_timezone_set('Asia/Jakarta');

                $this->load->model('Pemasok/PemasokNilai');

                $this->PemasokNilai->PerbaruiProfit($result->NoPemasok, date('Y-m-d'));
                
                $data = 'Sukses Hapus';
            } else {
                $data = 'Gagal Hapus';
            }
        }
        
        return $data;
    }
}

?>