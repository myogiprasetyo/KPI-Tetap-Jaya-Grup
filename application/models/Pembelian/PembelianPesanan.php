<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PembelianPesanan extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
    
    public function AmbilDataSemua($tanggal_awal, $tanggal_akhir, $status, $pemasok, $pilihan) {
        $this->db->select('NoPO, Tanggal, pmsk__.NoPemasok, pmsk__.NamaPemasok, Diterima, Diproses, pmblan_psn.Keterangan, pmblan_psn.Status');
        $this->db->from('pmblan_psn');
        $this->db->join('pmsk__', 'pmblan_psn.Pemasok = pmsk__.NoPemasok', 'inner');
        $this->db->where(array('Tanggal >=' => $tanggal_awal, 'Tanggal <=' => $tanggal_akhir));
            
        if (!(empty($pemasok) || $pemasok == 'Semua')) {
            $this->db->where('Pemasok', $pemasok);
        }
            
        switch ($status) {
            case 0 :
                $this->db->where('pmblan_psn.Status', '');
                break;
            case 1 :
                $this->db->where('pmblan_psn.Status', 'Sedang Diproses');
                break;
            case 2 :
                $this->db->where('pmblan_psn.Status', 'Diterima Penuh');
                break;
            case 3 :
                $this->db->where_in('pmblan_psn.Status', array('Sedang Diproses', 'Diterima Penuh'));
                break;
            case 4 :
                $this->db->where('pmblan_psn.Status', 'Ditutup');
                break;
            case 5 :
                $this->db->where_in('pmblan_psn.Status', array('Sedang Diproses', 'Ditutup'));
                break;
            case 6 :
                $this->db->where_in('pmblan_psn.Status', array('Ditutup', 'Diterima Penuh'));
                break;
        }
        
        switch ($pilihan) {
            case 'Data' :
                $data = $this->db->get()->result();
                break;
            case 'Jumlah' :
                $data = $this->db->get()->num_rows();
                break;
            default :
                $data = $this->db->get()->result();
                break;
        }
        
        return $data;
    }
    
    public function AmbilDataSatuan($no_po) {
        $this->db->select('NoPO, Tanggal, pmsk__.NoPemasok, pmsk__.NamaPemasok, Diterima, Diproses, pmblan_psn.Keterangan, pmblan_psn.Status');
        $this->db->from('pmblan_psn');
        $this->db->join('pmsk__', 'pmblan_psn.Pemasok = pmsk__.NoPemasok', 'inner');
        $this->db->where('NoPO', $no_po);
        
        $data = $this->db->get()->result();
        
        return $data;
    }
    
    public function PerbaruiJumlah($no_po, $nilai_faktur, $terpenuhi) {
        foreach ($this->AmbilDataSatuan($no_po) as $result) {
            $diterima = $result->Diterima;
            $diproses = $result->Diproses;
            
            if (!empty($terpenuhi)) {
                if ($terpenuhi == 100) {
                    $this->db->update('pmblan_psn', array('Status' => 'Diterima Penuh', 'Diterima' => ($diterima + $nilai_faktur), 'Diproses' => 0), array('NoPO' => $no_po));
                } else {
                    $this->db->update('pmblan_psn', array('Diterima' => ($diterima + $nilai_faktur), 'Diproses' => ($diproses - $nilai_faktur)), array('NoPO' => $no_po));
                }
            } else {
                $this->db->update('pmblan_psn', array('Status' => 'Sedang Diproses', 'Diterima' => ($diterima - $nilai_faktur), 'Diproses' => ($diproses + $nilai_faktur)), array('NoPO' => $no_po));
            }
        }
    }
    
    public function TambahData($no_po, $tanggal, $no_pemasok, $jumlah, $keterangan) {
        $this->db->insert('pmblan_psn', array('NoPO' => $no_po, 'Tanggal' => $tanggal, 'Pemasok' => $no_pemasok, 'Diproses' => $jumlah, 'Keterangan' => $keterangan, 'Status' => 'Sedang Diproses'));
    }
    
    public function UbahData($no_po, $diproses, $keterangan, $status) {
        if ($diproses == 0) {
            $status = 'Diterima Penuh';
        } else {
            if (empty($status)) {
                $status = 'Sedang Diproses';
            }
        }

        if (!empty($diproses)) {
            $this->db->set('Diproses', $diproses);
        }
        
        if (!empty($keterangan)) {
            $this->db->set('Keterangan', $keterangan);
        }
        
        $this->db->set('Status', $status);
        $this->db->where('NoPo', $no_po);
        $this->db->update('pmblan_psn');
    }
    
    public function HapusData($no_po) {
        $this->db->delete('pmblan_psn', array('NoPO' => $no_po));

        if ($this->db->affected_rows() > 0) {
            $data = 'Sukses Hapus';
        } else {
            $data = 'Gagal Hapus';
        }
        
        return $data;
    }
}

?>