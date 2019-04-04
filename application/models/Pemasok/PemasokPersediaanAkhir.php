<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PemasokPersediaanAkhir extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
    
    public function AmbilDataSemua($tanggal_akhir, $status) {
        $this->db->select('pmsk__.NoPemasok, pmsk__.NamaPemasok, SUM(PersediaanAkhir) as PersediaanAkhir, pmsk__.Status');
        $this->db->from('pmsk_prsdian_akhr');
        $this->db->join('pmsk__', 'pmsk_prsdian_akhr.Pemasok = pmsk__.NoPemasok', 'inner');
        
        if (!($status == 'Tidak Aktif')) {
            $this->db->where('pmsk__.Status', 'Aktif');
        }
        
        $this->db->where('Tanggal <=', $tanggal_akhir);
        $this->db->group_by('pmsk__.NoPemasok');
        $this->db->order_by('pmsk__.NoPemasok');
        
        $data = $this->db->get()->result();
        
        return $data;
    }
    
    public function AmbilDataSatuan($no_pemasok) {
        $this->db->select('pmsk__.NoPemasok, pmsk__.NamaPemasok, SUM(PersediaanAkhir) as PersediaanAkhir');
        $this->db->from('pmsk_prsdian_akhr');
        $this->db->join('pmsk__', 'pmsk_prsdian_akhr.Pemasok = pmsk__.NoPemasok', 'inner');
        $this->db->where('pmsk__.NoPemasok', $no_pemasok);
        $this->db->group_by('pmsk__.NoPemasok');
        $this->db->order_by('pmsk__.NoPemasok');
        
        $data = $this->db->get()->result();
        
        return $data;
    }
    
    public function SHVSPASemua() {
        if ($this->TotalSemua() == 0){
            $data = 100;
        } else {
            $this->load->model('Pembelian/PembelianFaktur');
            $this->load->model('Pembelian/PembelianPembayaran');

            $data = ($this->PembelianFaktur->NilaiFakturSemua() + $this->PembelianPembayaran->SisaHutangSemua()) / $this->TotalSemua();
        }
        
        return $data;
    }
    
    public function SHVSPASatuan($no_pemasok) {
        if ($this->TotalSatuan($no_pemasok) == 0){
            $data = 100;
        } else {
            $this->load->model('Pembelian/PembelianFaktur');
            $this->load->model('Pembelian/PembelianPembayaran');

            $data = ($this->PembelianFaktur->NilaiFakturSatuan($no_pemasok) + $this->PembelianPembayaran->SisaHutangSatuan($no_pemasok)) / $this->TotalSatuan($no_pemasok);
        }
        
        return $data;
    }
    
    public function TotalSemua() {
        $data = 0;
        
        $this->db->select('SUM(PersediaanAkhir) AS PersediaanAkhir');
        $this->db->from('pmsk_prsdian_akhr');
        
        foreach ($this->db->get()->result() as $result) {
            if ($result->PersediaanAkhir == null){
                $data = 0;
            } else {
                $data = $result->PersediaanAkhir;
            }
        }
        
        return $data;
    }
    
    public function TotalSatuan($no_pemasok) {
        $data = 0;
        
        $this->db->select('SUM(PersediaanAkhir) AS PersediaanAkhir');
        $this->db->from('pmsk_prsdian_akhr');
        $this->db->where('Pemasok', $no_pemasok);
        
        foreach ($this->db->get()->result() as $result) {
            if ($result->PersediaanAkhir == null){
                $data = 0;
            } else {
                $data = $result->PersediaanAkhir;
            }
        }
        
        return $data;
    }
    
    public function TambahData($tanggal, $no_pemasok, $persediaan_akhir) {
        $persediaan_akhir = $persediaan_akhir - $this->TotalSatuan($no_pemasok);

        $this->db->insert('pmsk_prsdian_akhr', array('Tanggal' => $tanggal, 'Pemasok' => $no_pemasok, 'PersediaanAkhir' => $persediaan_akhir));
        
        $this->load->model('Pemasok/PemasokNilai');
                        
        $this->PemasokNilai->PerbaruiSHVSPA($no_pemasok, $tanggal);
    }
    
    public function HapusData($no_pemasok) {
        $this->db->delete('pmsk_prsdian_akhr', array('Pemasok' => $no_pemasok));
            
        if ($this->db->affected_rows() > 0) {
            date_default_timezone_set('Asia/Jakarta');
            
            $this->load->model('Pemasok/PemasokNilai');

            $this->PemasokNilai->PerbaruiSHVSPA($no_pemasok, date('Y-m-d'));
                
            $data = 'Sukses Hapus';
        } else {
            $data = 'Gagal Hapus';
        }
        
        return $data;
    }
}

?>