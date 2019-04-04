<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PenjualanFaktur extends CI_Model {
	
	public function __construct(){
		parent::__construct();
        
	}
    
    public function AmbilDataSemua($no_penjual, $no_pelanggan, $tanggal_awal, $tanggal_akhir) {
        $this->db->select('NoFaktur, Tanggal, NoPelanggan, NamaPelanggan, NoPenjual, NamaPenjual, NilaiFaktur, pnjualn_fktr.Keterangan');
        $this->db->from('pnjualn_fktr');
        $this->db->join('plnggn__', 'pnjualn_fktr.Pelanggan = plnggn__.NoPelanggan', 'inner');
        $this->db->join('pnjual__', 'pnjualn_fktr.Penjual = pnjual__.NoPenjual', 'inner');
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
    
    public function AmbilDataSatuan($no_faktur) {
        $this->db->select('NoFaktur, Tanggal, NoPelanggan, NamaPelanggan, NoPenjual, NamaPenjual, NilaiFaktur, pnjualn_fktr.Keterangan');
        $this->db->from('pnjualn_fktr');
        $this->db->join('plnggn__', 'pnjualn_fktr.Pelanggan = plnggn__.NoPelanggan', 'inner');
        $this->db->join('pnjual__', 'pnjualn_fktr.Penjual = pnjual__.NoPenjual', 'inner');
        $this->db->where('NoFaktur', $no_faktur);
        
        $data = $this->db->get()->result();
        
        return $data;
    }
    
    public function AmbilPerPenjual($tanggal_awal, $tanggal_akhir, $no_penjual, $pilihan) {
        $data = 0;
        
        switch ($pilihan) {
            case 'Pencapaian' :
                $this->db->select('SUM(NilaiFaktur) as Pencapaian');
                break;
            case 'Pelanggan Efektif' :
                $this->db->select('COUNT(NoFaktur) as Pencapaian');
                break;
        }
        
        $this->db->from('pnjualn_fktr');
        $this->db->join('plnggn_trgt', 'pnjualn_fktr.Pelanggan = plnggn_trgt.Pelanggan', 'inner');
        $this->db->where(array('plnggn_trgt.Penjual' => $no_penjual, 'Tanggal >=' => $tanggal_awal,'Tanggal <=' => $tanggal_akhir));
        $this->db->group_by('plnggn_trgt.Penjual');
        
        foreach ($this->db->get()->result() as $result) {
            $data = $result->Pencapaian;
        }
        
        return $data;
    }
    
    public function AmbilPerRayon($tanggal_awal, $tanggal_akhir, $kode_rayon) {
        $data = 0;
        
        $this->db->select('SUM(NilaiFaktur) as Pencapaian');
        $this->db->from('pnjualn_fktr');
        $this->db->join('plnggn_trgt', 'pnjualn_fktr.Pelanggan = plnggn_trgt.Pelanggan', 'inner');
        $this->db->join('plnggn__', 'pnjualn_fktr.Pelanggan = plnggn__.NoPelanggan', 'inner');
        $this->db->where(array('Rayon' => $kode_rayon, 'Tanggal >=' => $tanggal_awal, 'Tanggal <=' => $tanggal_akhir));
        $this->db->group_by('Rayon');
        
        foreach ($this->db->get()->result() as $result) {
            $data = $result->Pencapaian;
        }
        
        return $data;
    }
    
    public function PencapaianPenjualSatuan($no_penjual) {
        $this->db->select('SUM(NilaiFaktur) as NilaiFaktur');
        $this->db->from('plnggn__');
        $this->db->join('pnjualn_fktr', 'plnggn__.NoPelanggan = pnjualn_fktr.Pelanggan', 'inner');
        $this->db->join('pnjual__', 'plnggn__.Penjual = pnjual__.NoPenjual', 'inner');
        $this->db->where('NoPenjual', $no_penjual);
        
        $data = $this->db->get()->result();
        
        return $data;
    }
    
    public function TotaNilaiFakturSemua($tanggal_awal, $tanggal_akhir, $no_penjual) {
        $this->db->select('SUM(NilaiFaktur) as NilaiFaktur');
        $this->db->from('pnjualn_fktr');
        
        if ($no_penjual >= 100) {
            $this->db->where('Penjual >=', 100);
        } else {
            $this->db->where('Penjual', $no_penjual);
        }
        
        $this->db->where(array('Tanggal >=' => $tanggal_awal, 'Tanggal <=' => $tanggal_akhir));
        
        foreach ($this->db->get()->result() as $result) {
            $data = $result->NilaiFaktur;
        }
        
        return $data;
    }
    
    public function TotaNilaiFakturSatuan($tanggal_awal, $tanggal_akhir, $no_pelanggan) {
        $this->db->select('SUM(NilaiFaktur) as NilaiFaktur');
        $this->db->from('pnjualn_fktr');
        $this->db->where(array('Tanggal >=' => $tanggal_awal, 'Tanggal <=' => $tanggal_akhir, 'Pelanggan' => $no_pelanggan));
        
        foreach ($this->db->get()->result() as $result) {
            $data = $result->NilaiFaktur;
        }
        
        return $data;
    }
    
    public function TambahData($no_faktur, $tanggal, $no_pelanggan, $no_penjual, $nilai_faktur, $keterangan) {
        $this->db->insert('pnjualn_fktr', array('NoFaktur' => $no_faktur, 'Tanggal' => $tanggal, 'Pelanggan' => $no_pelanggan, 'Penjual' => $no_penjual, 'NilaiFaktur' => $nilai_faktur, 'Keterangan' => $keterangan));
        
        $this->load->model('Pelanggan/PelangganNilai');
        
        $this->PelangganNilai->PerbaruiPencapaian($no_pelanggan, $tanggal);
        $this->PelangganNilai->PerbaruiProfit($no_pelanggan, $tanggal);
        $this->PelangganNilai->PerbaruiUPL($no_pelanggan, $tanggal);
    }
    
    public function UbahData($no_faktur, $nilai_faktur, $keterangan) {
        foreach ($this->AmbilDataSatuan($no_faktur) as $result) {
            if (!empty($nilai_faktur)) {
                $this->db->set('NilaiFaktur', $nilai_faktur);
            }
            
            if (!empty($keterangan)) {
                $this->db->set('Keterangan', $keterangan);
            }

            $this->db->where('NoFaktur', $no_faktur);
            $this->db->update('pnjualn_fktr');

            $this->load->model('Pelanggan/PelangganNilai');
        
            $this->PelangganNilai->PerbaruiPencapaian($result->NoPelanggan, $result->Tanggal);
            $this->PelangganNilai->PerbaruiProfit($result->NoPelanggan, $result->Tanggal);
            $this->PelangganNilai->PerbaruiUPL($result->NoPelanggan, $result->Tanggal);
        }
    }
    
    public function HapusData($no_faktur) {
        foreach ($this->AmbilDataSatuan($no_faktur) as $result) {
            $this->db->delete('pnjualn_fktr', array('NoFaktur' => $no_faktur));
            
            if ($this->db->affected_rows() > 0) {
                date_default_timezone_set('Asia/Jakarta');

                $this->load->model('Pelanggan/PelangganNilai');

                $this->PelangganNilai->PerbaruiPencapaian($result->NoPelanggan, date('Y-m-d'));
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