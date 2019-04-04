<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PelangganTarget extends CI_Model {
	
	public function __construct(){
		parent::__construct();
        
	}
    
    public function AmbilDataSemua($bulan, $no_penjual, $status) {
        $this->db->select('No, Bulan, NoPelanggan, NamaPelanggan, NoPenjual, NamaPenjual, Target, plnggn__.Status');
        $this->db->from('plnggn_trgt');
        $this->db->join('plnggn__', 'plnggn_trgt.Pelanggan = plnggn__.NoPelanggan', 'inner');
        $this->db->join('pnjual__', 'plnggn_trgt.Penjual = pnjual__.NoPenjual', 'inner');
        
        if (!empty($bulan)) {
            $this->db->where('Bulan', $bulan);
        }
        
        if (!empty($no_penjual)) {
            $this->db->where('NoPenjual', $no_penjual);
        }
        
        if (!($status == 'Tidak Aktif')) {
            $this->db->where('pnjual__.Status', 'Aktif');
        }
        
        $this->db->order_by('NoPelanggan');
        
        $data = $this->db->get()->result();
        
        return $data;
    }
    
    public function AmbilDataSatuan($no) {
        $this->db->select('No, Bulan, NoPelanggan, NamaPelanggan, NoPenjual, NamaPenjual, Target');
        $this->db->from('plnggn_trgt');
        $this->db->join('plnggn__', 'plnggn_trgt.Pelanggan = plnggn__.NoPelanggan', 'inner');
        $this->db->join('pnjual__', 'plnggn_trgt.Penjual = pnjual__.NoPenjual', 'inner');
        $this->db->where('No', $no);
        
        $data = $this->db->get()->result();
        
        return $data;
    }
    
    public function AmbilTarget($bulan, $no_pelanggan) {
        $data = 0;
        
        foreach ($this->db->get_where('plnggn_trgt', array('Bulan' => $bulan, 'Pelanggan' => $no_pelanggan))->result() as $result) {
            $data = $result->Target;
        }
        
        return $data;
    }
    
    public function AmbilPerPenjual($bulan, $no_penjual, $pilihan) {
        $data = 0;
        
        date_default_timezone_set('Asia/Jakarta');
        
        if (date('d') <= 26) {
            $tanggal_awal = date('Y-m-d', strtotime('-1 month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 25, date('Y'))))));
            $tanggal_akhir = date('Y-m-d', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 25, date('Y')))));
        } else {
            $tanggal_awal = date('Y-m-d', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 26, date('Y')))));
            $tanggal_akhir = date('Y-m-d', strtotime('+1 month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 25, date('Y'))))));
        }
        
        switch ($pilihan) {
            case 'Pencapaian' :
                $this->db->select('SUM(Target) as Target');
                break;
            case 'Pelanggan Efektif' :
                $this->db->select('COUNT(Pelanggan) as Target');
                break;
        }
        
        $this->db->from('plnggn_trgt');
        $this->db->join('plnggn__', 'plnggn_trgt.Pelanggan = plnggn__.NoPelanggan', 'inner');
        $this->db->where(array('plnggn_trgt.Penjual' => $no_penjual, 'Bulan' => $bulan));
        $this->db->group_by('plnggn_trgt.Penjual');
        
        foreach ($this->db->get()->result() as $result) {
            $this->load->model('Fungsi/FungsiHariKerja');
            
            $data = ($result->Target / $this->FungsiHariKerja->AmbilData($tanggal_awal, $tanggal_akhir)) * $this->FungsiHariKerja->AmbilData($tanggal_awal, $tanggal_akhir);
        }
        
        return $data;
    }
    
    public function AmbilPerRayon($bulan, $kode_rayon) {
        $data = 0;
        
        date_default_timezone_set('Asia/Jakarta');
        
        if (date('d') <= 26) {
            $tanggal_awal = date('Y-m-d', strtotime('-1 month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 25, date('Y'))))));
            $tanggal_akhir = date('Y-m-d', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 25, date('Y')))));
        } else {
            $tanggal_awal = date('Y-m-d', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 26, date('Y')))));
            $tanggal_akhir = date('Y-m-d', strtotime('+1 month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 25, date('Y'))))));
        }
        
        $this->db->select('SUM(Target) as Target');
        $this->db->from('plnggn_trgt');
        $this->db->join('plnggn__', 'plnggn_trgt.Pelanggan = plnggn__.NoPelanggan', 'inner');
        $this->db->where(array('Rayon' => $kode_rayon, 'Bulan' => $bulan));
        $this->db->group_by('Rayon');
        
        foreach ($this->db->get()->result() as $result) {
            $this->load->model('Fungsi/FungsiHariKerja');
            
            $data = ($result->Target / $this->FungsiHariKerja->AmbilData($tanggal_awal, $tanggal_akhir)) * $this->FungsiHariKerja->AmbilData($tanggal_awal, $tanggal_akhir);
        }
        
        return $data;
    }

    public function TambahData($bulan, $no_pelanggan, $no_penjual, $target) {
        if ($this->db->get_where('plnggn_trgt', array('Bulan' => $bulan, 'Pelanggan' => $no_pelanggan, 'Penjual' => $no_penjual))->num_rows() < 1) {
            $this->db->insert('plnggn_trgt', array('Bulan' => $bulan, 'Pelanggan' => $no_pelanggan, 'Penjual' => $no_penjual, 'Target' => $target));
        } else {
            foreach ($this->db->get_where('plnggn_trgt', array('Bulan' => $bulan, 'Pelanggan' => $no_pelanggan, 'Penjual' => $no_penjual))->result() as $result) {
                $this->db->update('plnggn_trgt', array('Target' => $target), array('No' => $result->No));
            }
        }
        
        date_default_timezone_set('Asia/Jakarta');
        
        $this->load->model('Pelanggan/PelangganNilai');

        $this->PelangganNilai->PerbaruiPencapaian($no_pelanggan, date('Y-m-d', strtotime(date('Y-m-d', mktime(0, 0, 0, bulan($bulan, 'm'), date('d'), date('Y'))))));
    }
    
    public function UbahData($no, $target) {
        foreach ($this->AmbilDataSatuan($no) as $result) {
            if (!empty($target)) {
                $this->db->set('Target', $target);
            }

            $this->db->where('No', $no);
            $this->db->update('plnggn_trgt');

            $this->load->model('Pelanggan/PelangganNilai');

            $this->PelangganNilai->PerbaruiPencapaian($result->NoPelanggan, date('Y-m-d', strtotime(date('Y-m-d', mktime(0, 0, 0, bulan($result->Bulan, 'm'), date('d'), date('Y'))))));
        }
    }
    
    public function HapusData($no) {
        foreach ($this->AmbilDataSatuan($no) as $result) {
            $this->db->delete('plnggn_trgt', array('No' => $no));

            if ($this->db->affected_rows() > 0) {
                date_default_timezone_set('Asia/Jakarta');

                $this->load->model('Pelanggan/PelangganNilai');

                $this->PelangganNilai->PerbaruiPencapaian($result->NoPelanggan, date('Y-m-d'));

                $data = 'Sukses Hapus';
            } else {
                $data = 'Gagal Hapus';
            }
        }
        
        return $data;
    }
}

?>