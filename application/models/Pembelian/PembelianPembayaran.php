<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PembelianPembayaran extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
    
    public function AmbilDataSemua($tanggal_awal, $tanggal_akhir, $status, $no_pemasok) {
        $this->db->select('NoPembayaran, Tanggal, pmsk__.NoPemasok, pmsk__.NamaPemasok, TotalFaktur, NoCek, TanggalCek, pmblan_byr.Keterangan, pmblan_byr.Status');
        $this->db->from('pmblan_byr');
        $this->db->join('pmsk__', 'pmblan_byr.Pemasok = pmsk__.NoPemasok', 'inner');
        $this->db->where(array('Tanggal >=' => $tanggal_awal, 'Tanggal <=' => $tanggal_akhir));
            
        if (!(empty($no_pemasok) || $no_pemasok == 'Semua')) {
            $this->db->where('Pemasok', $no_pemasok);
        }
            
        switch ($status) {
            case 0 :
                $this->db->where('pmblan_byr.Status', '');
                break;
            case 1 :
                $this->db->where('pmblan_byr.Status', 'Buka Giro');
                break;
            case 2 :
                $this->db->where('pmblan_byr.Status', 'Dicairkan');
                break;
        }
        
        $data = $this->db->get()->result();
        
        return $data;
    }
    
    public function AmbilDataSatuan($no_pembayaran) {
        $this->db->select('NoPembayaran, Tanggal, pmsk__.NoPemasok, pmsk__.NamaPemasok, TotalFaktur, NoCek, TanggalCek, pmblan_byr.Keterangan, pmblan_byr.Status');
        $this->db->from('pmblan_byr');
        $this->db->join('pmsk__', 'pmblan_byr.Pemasok = pmsk__.NoPemasok', 'inner');
        $this->db->where('NoPembayaran', $no_pembayaran);
        
        $data = $this->db->get()->result();
        
        return $data;
    }
    
    public function SisaHutangSemua() {
        $data = 0;
        
        $this->db->select('SUM(TotalFaktur) AS TotalFaktur');
        $this->db->from('pmblan_byr');
        $this->db->where('Status', 'Buka Giro');
        
        foreach ($this->db->get()->result() as $result) {
            if ($result->TotalFaktur == null) {
                $data = 0;
            } else {
                $data = $result->TotalFaktur;
            }
        }
        
        return $data;
    }
    
    public function SisaHutangSatuan($no_pemasok) {
        $data = 0;
        
        $this->db->select('SUM(TotalFaktur) AS TotalFaktur');
        $this->db->from('pmblan_byr');
        $this->db->where(array('Pemasok' => $no_pemasok, 'Status' => 'Buka Giro'));
        
        foreach ($this->db->get()->result() as $result) {
            if ($result->TotalFaktur == null) {
                $data = 0;
            } else {
                $data = $result->TotalFaktur;
            }
        }
        
        return $data;
    }
    
    public function HapusDetail($no_pembayaran) {
        foreach ($this->db->get_where('pmblan_byr_dtl', array('NoPembayaran' => $no_pembayaran))->result() as $result) {
            $this->load->model('Pembelian/PembelianFaktur');
                
            $this->PembelianFaktur->UbahStatus($result->NoFaktur, 'Belum Lunas');
        }
                
        $this->db->delete('pmblan_byr_dtl', array('NoPembayaran' => $no_pembayaran));
    }
    
    public function TambahData($no_pembayaran, $tanggal, $no_pemasok, $no_faktur, $total_faktur, $no_cek, $tanggal_cek, $keterangan) {
        $this->db->insert('pmblan_byr', array('NoPembayaran' => $no_pembayaran, 'Tanggal' => $tanggal, 'Pemasok' => $no_pemasok, 'TotalFaktur' => $total_faktur, 'NoCek' => $no_cek, 'TanggalCek' => $tanggal_cek, 'Keterangan' => $keterangan, 'Status' => 'Buka Giro'));
        
        foreach ($no_faktur as $data) {
            $this->db->insert('pmblan_byr_dtl', array('NoPembayaran' => $no_pembayaran, 'NoFaktur' => $data));
            
            $this->load->model('Pembelian/PembelianFaktur');
            
            $this->PembelianFaktur->UbahStatus($data, 'Pembayaran');
        }
        
        $this->load->model('Pemasok/PemasokNilai');
        
        $this->PemasokNilai->PerbaruiSHVSPA($no_pemasok, $tanggal);
    }
    
    public function UbahData($no_pembayaran, $tanggal, $no_pemasok, $no_cek, $tanggal_cek, $keterangan, $status) {
        if (!empty($tanggal)) {
            $this->db->set('Tanggal', $tanggal);
        }
        
        if (!empty($no_pemasok)) {
            $this->db->set('Pemasok', $no_pemasok);
        }
        
        if (!empty($no_faktur)) {
            $this->db->set('NoFaktur', $no_faktur);
        }
        
        if (!empty($no_cek)) {
            $this->db->set('NoCek', $no_cek);
        }
        
        if (!empty($tanggal_cek)) {
            $this->db->set('TanggalCek', $tanggal_cek);
        }
        
        if (!empty($keterangan)) {
            $this->db->set('Keterangan', $keterangan);
        }
        
        if (!empty($status)) {
            $this->db->set('Status', $status);
        }
        
        $this->db->where('NoPembayaran', $no_pembayaran);
        $this->db->update('pmblan_byr');
        
        if ($status == 'Dicairkan') {
            $this->load->model('Pembelian/PembelianFaktur');
                
            foreach ($this->db->get_where('pmblan_byr_dtl', array('NoPembayaran' => $no_pembayaran))->result() as $result) {
                $this->PembelianFaktur->UbahStatus($result->NoFaktur, 'Lunas');
            }
        }
        
        $this->load->model('Pemasok/PemasokNilai');
        
        $this->PemasokNilai->PerbaruiSHVSPA($no_pemasok, $tanggal);
    }
    
    public function HapusData($no_pembayaran) {
        foreach ($this->AmbilDataSatuan($no_pembayaran) as $result) {
            $this->HapusDetail($no_pembayaran);
            
            $this->db->delete('pmblan_byr', array('NoPembayaran' => $no_pembayaran));

            if ($this->db->affected_rows() > 0) {
                date_default_timezone_set('Asia/Jakarta');

                $this->load->model('Pemasok/PemasokNilai');
                
                $this->PemasokNilai->PerbaruiSHVSPA($result->Pemasok, date('Y-m-d'));
                
                $data = 'Sukses Hapus';
            } else {
                $data = 'Gagal Hapus';
            }
        }
        
        return $data;
    }
}

?>