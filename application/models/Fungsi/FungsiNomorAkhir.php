<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FungsiNomorAkhir extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
    
    public function AmbilData($tabel, $tanggal) {
        switch ($tabel) {
            case 'Data Pelanggan' :
                $data = '0001';
                
                $this->db->select('SUBSTRING(NoPelanggan, 5) AS Akhir');
                $this->db->from('plnggn__');
                
                break;
            case 'Pesanan Pembelian' :
                $data = '01';
                
                $this->db->select('SUBSTRING(NoPO, 14) AS Akhir');
                $this->db->from('pmblan_psn');
                
                break;
            case 'Faktur Pembelian' :
                $data = '01';
                
                $this->db->select('SUBSTRING(NoFaktur, 14) AS Akhir');
                $this->db->from('pmblan_fktr');
                
                break;
            case 'Pembayaran Pembelian' :
                $data = '01';
                
                $this->db->select('SUBSTRING(NoPembayaran, 14) AS Akhir');
                $this->db->from('pmblan_byr');
                
                break;
            case 'Faktur Penjualan' :
                $data = '001';
                
                $this->db->select('SUBSTRING(NoFaktur, 13) AS Akhir');
                $this->db->from('pnjualn_fktr');
                
                break;
            case 'Retur Penjualan' :
                $data = '001';
                
                $this->db->select('SUBSTRING(NoRetur, 13) AS Akhir');
                $this->db->from('pnjualn_rtr');
                
                break;
        }
        
        if (!empty($tanggal)) {
            $this->db->where('Tanggal', $tanggal);
        }
        
        $this->db->order_by('Akhir', 'DESC');
        $this->db->limit(1);
        
        foreach ($this->db->get()->result() as $result) {
            $add_nomor = $result->Akhir + 1;

            if ($tabel == 'Data Pelanggan') {
                switch (strlen($add_nomor)) {
                    case 1 :
                        $nol = '000';
                        break;
                    case 2 :
                        $nol = '00';
                        break;
                    case 3 :
                        $nol = '0';
                        break;
                    default :
                        $nol = '';
                        break;
                }
            } else if ($tabel == 'Faktur Penjualan' || $tabel == 'Retur Penjualan') {
                switch (strlen($add_nomor)) {
                    case 1 :
                        $nol = '00';
                        break;
                    case 2 :
                        $nol = '0';
                        break;
                    default :
                        $nol = '';
                        break;
                }
            } else if ($tabel == 'Pesanan Pembelian' || $tabel == 'Faktur Pembelian' || $tabel == 'Pembayaran Pembelian') {
                switch (strlen($add_nomor)) {
                    case 1 :
                        $nol = '0';
                        break;
                    default :
                        $nol = '';
                        break;
                }
            }

            $data = $nol.$add_nomor;
        }
        
        return $data;
    }
}

?>