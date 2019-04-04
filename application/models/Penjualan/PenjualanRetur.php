<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PenjualanRetur extends CI_Model {
	
	public function __construct(){
		parent::__construct();
        
	}
    
    public function AmbilDataSemua($no_penjual, $no_pelanggan, $tanggal_awal, $tanggal_akhir) {
        $this->db->select('NoRetur, Tanggal, NoPenjual, NamaPenjual, NoPelanggan, NamaPelanggan, NilaiRetur, pnjualn_rtr.Keterangan');
        $this->db->from('pnjualn_rtr');
        $this->db->join('pnjual__', 'pnjualn_rtr.Penjual = pnjual__.NoPenjual', 'inner');
        $this->db->join('plnggn__', 'pnjualn_rtr.Pelanggan = plnggn__.NoPelanggan', 'inner');
        $this->db->where(array('Tanggal >=' => $tanggal_awal, 'Tanggal <=' => $tanggal_akhir));
            
        if (!(empty($no_penjual) || $no_penjual == 'Semua')) {
            $this->db->where('NoPenjual', $no_penjual);
        }
        
        if (!(empty($no_pelanggan) || $no_pelanggan == 'Semua')) {
            $this->db->where('NoPelanggan', $no_pelanggan);
        }
        
        $data = $this->db->get()->result();
        
        return $data;
    }
    
    public function AmbilDataSatuan($no_retur) {
        $this->db->select('NoRetur, Tanggal, NoPelanggan, NamaPelanggan, NoPenjual, NamaPenjual, NilaiRetur, pnjualn_rtr.Keterangan');
        $this->db->from('pnjualn_rtr');
        $this->db->join('pnjual__', 'pnjualn_rtr.Penjual = pnjual__.NoPenjual', 'inner');
        $this->db->join('plnggn__', 'pnjualn_rtr.Pelanggan = plnggn__.NoPelanggan', 'inner');
        $this->db->where('NoRetur', $no_retur);
        
        $data = $this->db->get()->result();
        
        return $data;
        
    }
    
    public function TotaNilaiReturSemua($tanggal_awal, $tanggal_akhir, $no_penjual) {
        $this->db->select('SUM(NilaiRetur) as NilaiRetur');
        $this->db->from('pnjualn_rtr');
        
        if ($no_penjual >= 100) {
            $this->db->where('Penjual >=', 100);
        } else {
            $this->db->where('Penjual', $no_penjual);
        }
        
        $this->db->where(array('Tanggal >=' => $tanggal_awal, 'Tanggal <=' => $tanggal_akhir));
        
        foreach ($this->db->get()->result() as $result) {
            $data = $result->NilaiRetur;
        }
        
        return $data;
    }
    
    public function TotaNilaiReturSatuan($tanggal_awal, $tanggal_akhir, $no_pelanggan) {
        $this->db->select('SUM(NilaiRetur) as NilaiRetur');
        $this->db->from('pnjualn_rtr');
        $this->db->where(array('Tanggal >=' => $tanggal_awal, 'Tanggal <=' => $tanggal_akhir, 'Pelanggan' => $no_pelanggan));
        
        foreach ($this->db->get()->result() as $result) {
            $data = $result->NilaiRetur;
        }
        
        return $data;
    }
    
    public function TambahData($no_retur, $tanggal, $no_pelanggan, $no_penjual, $nilai_retur, $keterangan) {
        $this->db->insert('pnjualn_rtr', array('NoRetur' => $no_retur, 'Tanggal' => $tanggal, 'Penjual' => $no_penjual, 'Pelanggan' => $no_pelanggan, 'NilaiRetur' => $nilai_retur, 'Keterangan' => $keterangan));
        
        $this->load->model('Pelanggan/PelangganNilai');
        
        $this->PelangganNilai->PerbaruiProfit($no_pelanggan, $tanggal);
        $this->PelangganNilai->PerbaruiUPL($no_pelanggan, $tanggal);
    }
    
    public function UbahData($no_retur, $nilai_retur, $keterangan) {
        foreach ($this->AmbilDataSatuan($no_retur) as $result) {
            if (!empty($nilai_retur)) {
                $this->db->set('NilaiRetur', $nilai_retur);
            }
            
            if (!empty($keterangan)) {
                $this->db->set('Keterangan', $keterangan);
            }

            $this->db->where('NoRetur', $no_retur);
            $this->db->update('pnjualn_rtr');

            $this->load->model('Pelanggan/PelangganNilai');
        
            $this->PelangganNilai->PerbaruiProfit($result->NoPelanggan, $result->Tanggal);
            $this->PelangganNilai->PerbaruiUPL($result->NoPelanggan, $result->Tanggal);
        }
    }
    
    public function HapusData($no_retur) {
        foreach ($this->AmbilDataSatuan($no_retur) as $result) {
            $this->db->delete('pnjualn_rtr', array('NoRetur' => $no_retur));
            
            if ($this->db->affected_rows() > 0) {
                date_default_timezone_set('Asia/Jakarta');

                $this->load->model('Pelanggan/PelangganNilai');

                $this->PelangganNilai->PerbaruiProfit($result->NoPelanggan, date('Y-m-d'));
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