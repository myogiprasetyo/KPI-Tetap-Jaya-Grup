<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PemasokNilai extends CI_Model {
	
	public function __construct(){
		parent::__construct();
        
	}
    
    public function AmbilDataSemua($status, $predikat) {
        $this->db->select('NoPemasok, NamaPemasok, Tanggal, Profit, SHVSPA, Terpenuhi, Nilai, Predikat, Status');
        $this->db->from('pmsk_nli');
        $this->db->join('pmsk__', 'pmsk_nli.Pemasok = pmsk__.NoPemasok', 'inner');
        
        if (!($status == 'Tidak Aktif')) {
            $this->db->where('Status', 'Aktif');
        }
        
        if (!empty($predikat)) {
            $data = $this->db->where('Predikat', $predikat);
        }
        
        $data = $this->db->get()->result();
       
        return $data;
    }
    
    public function AmbilDataSatuan($no_pemasok, $status, $predikat) {
        $this->db->select('NoPemasok, Tanggal, NamaPemasok, Profit, SHVSPA, Terpenuhi, Nilai, Predikat, Status');
        $this->db->from('pmsk_nli');
        $this->db->join('pmsk__', 'pmsk_nli.Pemasok = pmsk__.NoPemasok', 'inner');
        $data = $this->db->where('NoPemasok', $no_pemasok);
        
        if (!($status == 'Tidak Aktif')) {
            $this->db->where('Status', 'Aktif');
        }
        
        if (!empty($predikat)) {
            $data = $this->db->where('Predikat', $predikat);
        }
        
        $data = $this->db->get()->result();
       
        return $data;
    }
    
    public function AmbilProfitLama($no_pemasok, $tanggal_awal, $tanggal_akhir) {
        $data = 0;
        
        $this->db->select('AVG(Profit) AS Profit');
        $this->db->from('pmsk_nli_old');
        $this->db->where(array('Pemasok' => $no_pemasok, 'Tanggal >=' => $tanggal_awal,'Tanggal <=' => $tanggal_akhir));
        $this->db->group_by('Pemasok');
        
        foreach ($this->db->get()->result() as $result) {
            $data = $result->Profit;
        }
       
        return $data;
    }
    
    public function AmbilSHVSPALama($no_pemasok, $tanggal_awal, $tanggal_akhir) {
        $data = 0;
        
        $this->db->select('AVG(SHVSPA) AS SHVSPA');
        $this->db->from('pmsk_nli_old');
        $this->db->where(array('Pemasok' => $no_pemasok, 'Tanggal >=' => $tanggal_awal, 'Tanggal <=' => $tanggal_akhir));
        $this->db->group_by('Pemasok');
        
        foreach ($this->db->get()->result() as $result) {
            $data = $result->SHVSPA;
        }
       
        return $data;
    }
    
    public function AmbilTerpenuhiLama($no_pemasok, $tanggal_awal, $tanggal_akhir) {
        $data = 0;
        
        $this->db->select('AVG(Terpenuhi) AS Terpenuhi');
        $this->db->from('pmsk_nli_old');
        $this->db->where(array('Pemasok' => $no_pemasok, 'Tanggal >=' => $tanggal_awal, 'Tanggal <=' => $tanggal_akhir));
        $this->db->group_by('Pemasok');
        
        foreach ($this->db->get()->result() as $result) {
            $data = $result->Terpenuhi;
        }
       
        return $data;
    }
    
    public function AmbilPredikat($predikat, $tanggal_awal, $tanggal_akhir) {
        $data = 0;
        
        $this->db->select('Predikat, COUNT(Predikat) AS Jumlah');
        
        if (empty($tanggal_awal) && empty($tanggal_akhir)) {
            $this->db->from('pmsk_nli');
        } else {
            $this->db->from('pmsk_nli_old');
            $this->db->where(array('Tanggal >=' => $tanggal_awal, 'Tanggal <=' => $tanggal_akhir));
        }
        
        $this->db->where('Predikat', $predikat);
        $this->db->group_by('Predikat');
        $this->db->order_by('Predikat', 'ASC');
        
        foreach ($this->db->get()->result() as $result) {
            $data = $result->Jumlah;
        }
       
        return $data;
    }
    
    public function AmbilData($tanggal_awal, $tanggal_akhir) {
        $this->db->select('COUNT(Pemasok) as Jumlah');
        
        if (empty($tanggal_awal) && empty($tanggal_akhir)) {
            $this->db->from('pmsk_nli');
        } else {
            $this->db->from('pmsk_nli_old');
            $this->db->where(array('Tanggal >=' => $tanggal_awal, 'Tanggal <=' => $tanggal_akhir));
        }
        
        foreach ($this->db->get()->result() as $result) {
            $data = $result->Jumlah;
        }
       
        return $data;
    }
    
    public function HapusDataLama($no_pemasok) {
        $this->db->delete('pmsk_nli_old', array('Pemasok' => $no_pemasok));
    }
    
    public function PerbaruiTerpenuhi($no_pemasok, $tanggal) {
        foreach ($this->AmbilDataSatuan($no_pemasok, null, null) as $result) {
            date_default_timezone_set('Asia/Jakarta');
            
            if (date('d', strtotime($result->Tanggal)) <= 26) {
                $tanggal_parameter = date('Y-m-d', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($result->Tanggal)), 26, date('Y', strtotime($result->Tanggal))))));
            } else {
                $tanggal_parameter = date('Y-m-d', strtotime('+1 month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($result->Tanggal)), 26, date('Y', strtotime($result->Tanggal)))))));
            }
            
            if ($tanggal > $tanggal_parameter) {
                $this->db->insert('pmsk_nli_old', array('Pemasok' => $no_pemasok, 'Tanggal' => $result->Tanggal, 'Terpenuhi' => $result->Terpenuhi, 'SHVSPA' => $result->SHVSPA, 'Profit' => $result->Profit, 'Nilai' => $result->Nilai, 'Predikat' => $result->Predikat));
            }
            
            $this->load->model('Aplikasi/AplikasiBobot');
            $this->load->model('Fungsi/FungsiPredikat');
            $this->load->model('Pembelian/PembelianFaktur');
            
            $total_barang_terpenuhi = $this->PembelianFaktur->RerataTerpenuhiSatuan($no_pemasok);
            
            $nilai = ($total_barang_terpenuhi * $this->AplikasiBobot->AmbilDataSatuan(1, 'Terpenuhi')) + ($result->SHVSPA * $this->AplikasiBobot->AmbilDataSatuan(1, 'SH VS PA')) + ($result->Profit * $this->AplikasiBobot->AmbilDataSatuan(1, 'Profit'));
            
            $predikat = $this->FungsiPredikat->AmbilData($nilai);
            
            $this->db->update('pmsk_nli', array('Tanggal' => $tanggal, 'Terpenuhi' => $total_barang_terpenuhi, 'Nilai' => $nilai, 'Predikat' => $predikat), array('Pemasok' => $no_pemasok));
        }
    }
    
    public function PerbaruiSHVSPA($no_pemasok, $tanggal) {
        foreach ($this->AmbilDataSatuan($no_pemasok, null, null) as $result) {
            date_default_timezone_set('Asia/Jakarta');
            
            if (date('d', strtotime($result->Tanggal)) <= 26) {
                $tanggal_parameter = date('Y-m-d', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($result->Tanggal)), 26, date('Y', strtotime($result->Tanggal))))));
            } else {
                $tanggal_parameter = date('Y-m-d', strtotime('+1 month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($result->Tanggal)), 26, date('Y', strtotime($result->Tanggal)))))));
            }
            
            if ($tanggal > $tanggal_parameter) {
                $this->db->insert('pmsk_nli_old', array('Pemasok' => $no_pemasok, 'Tanggal' => $result->Tanggal, 'Terpenuhi' => $result->Terpenuhi, 'SHVSPA' => $result->SHVSPA, 'Profit' => $result->Profit, 'Nilai' => $result->Nilai, 'Predikat' => $result->Predikat));
            }
            
            $this->load->model('Aplikasi/AplikasiBobot');
            $this->load->model('Fungsi/FungsiPredikat');
            $this->load->model('Pemasok/PemasokPersediaanAkhir');
            
            $sh_vs_pa_semua = $this->PemasokPersediaanAkhir->SHVSPASemua();
            
            $sh_vs_pa_satuan = $this->PemasokPersediaanAkhir->SHVSPASatuan($no_pemasok);
            
            if ($sh_vs_pa_semua == 0) {
                $total_sh_vs_pa = 0;    
            } else {
                $total_sh_vs_pa = ($sh_vs_pa_satuan / $sh_vs_pa_semua) * 100;
                
                if ($total_sh_vs_pa > 100) {
                    $total_sh_vs_pa = 100;
                }
            }

            $nilai = ($result->Terpenuhi * $this->AplikasiBobot->AmbilDataSatuan(1, 'Terpenuhi')) + ($total_sh_vs_pa * $this->AplikasiBobot->AmbilDataSatuan(1, 'SH VS PA')) + ($result->Profit * $this->AplikasiBobot->AmbilDataSatuan(1, 'Profit'));
            
            $predikat = $this->FungsiPredikat->AmbilData($nilai);
            
            $this->db->update('pmsk_nli', array('Tanggal' => $tanggal, 'SHVSPA' => $total_sh_vs_pa, 'Nilai' => $nilai, 'Predikat' => $predikat), array('Pemasok' => $no_pemasok));
        }
    }
    
    public function PerbaruiProfit($no_pemasok, $tanggal) {
        foreach ($this->AmbilDataSatuan($no_pemasok, null, null) as $result) {
            date_default_timezone_set('Asia/Jakarta');
            
            if (date('d', strtotime($result->Tanggal)) <= 26) {
                $tanggal_parameter = date('Y-m-d', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($result->Tanggal)), 26, date('Y', strtotime($result->Tanggal))))));
            } else {
                $tanggal_parameter = date('Y-m-d', strtotime('+1 month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($result->Tanggal)), 26, date('Y', strtotime($result->Tanggal)))))));
            }
            
            if ($tanggal > $tanggal_parameter) {
                $this->db->insert('pmsk_nli_old', array('Pemasok' => $no_pemasok, 'Tanggal' => $result->Tanggal, 'Terpenuhi' => $result->Terpenuhi, 'SHVSPA' => $result->SHVSPA, 'Profit' => $result->Profit, 'Nilai' => $result->Nilai, 'Predikat' => $result->Predikat));
            }
            
            $this->load->model('Aplikasi/AplikasiBobot');
            $this->load->model('Fungsi/FungsiPredikat');
            $this->load->model('Penjualan/PenjualanProfit');
            
            $profit_semua = $this->PenjualanProfit->ProfitSemua();
            
            $profit_satuan = $this->PenjualanProfit->ProfitSatuan($no_pemasok);
            
            if ($profit_semua == 0) {
                $total_profit = 0;
            } else {
                $total_profit = ($profit_satuan / $profit_semua) * 100;

                if ($total_profit > 100) {
                    $total_profit = 100;
                }
            }
            
            $nilai = ($result->Terpenuhi * $this->AplikasiBobot->AmbilDataSatuan(1, 'Terpenuhi')) + ($result->SHVSPA * $this->AplikasiBobot->AmbilDataSatuan(1, 'SH VS PA')) + ($total_profit * $this->AplikasiBobot->AmbilDataSatuan(1, 'Profit'));
            
            $predikat = $this->FungsiPredikat->AmbilData($nilai);
            
            $this->db->update('pmsk_nli', array('Tanggal' => $tanggal, 'Profit' => $total_profit, 'Nilai' => $nilai, 'Predikat' => $predikat), array('Pemasok' => $no_pemasok));
        }
    }
    
    public function PerbaruiSemua($tanggal) {
        foreach ($this->AmbilDataSemua(null, null) as $result) {
            date_default_timezone_set('Asia/Jakarta');
            
            if (date('d', strtotime($result->Tanggal)) <= 26) {
                $tanggal_parameter = date('Y-m-d', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($result->Tanggal)), 26, date('Y', strtotime($result->Tanggal))))));
            } else {
                $tanggal_parameter = date('Y-m-d', strtotime('+1 month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($result->Tanggal)), 26, date('Y', strtotime($result->Tanggal)))))));
            }
            
            if ($tanggal > $tanggal_parameter) {
                $this->db->insert('pmsk_nli_old', array('Pemasok' => $result->NoPemasok, 'Tanggal' => $result->Tanggal, 'Terpenuhi' => $result->Terpenuhi, 'SHVSPA' => $result->SHVSPA, 'Profit' => $result->Profit, 'Nilai' => $result->Nilai, 'Predikat' => $result->Predikat));
            }
            
            $this->load->model('Aplikasi/AplikasiBobot');
            $this->load->model('Fungsi/FungsiPredikat');
            $this->load->model('Pemasok/PemasokPersediaanAkhir');
            $this->load->model('Pembelian/PembelianFaktur');
            $this->load->model('Penjualan/PenjualanProfit');
            
            $total_barang_terpenuhi = $this->PembelianFaktur->RerataTerpenuhiSatuan($result->NoPemasok);
            
            $sh_vs_pa_semua = $this->PemasokPersediaanAkhir->SHVSPASemua();
            $profit_semua = $this->PenjualanProfit->ProfitSemua();
            
            $sh_vs_pa_satuan = $this->PemasokPersediaanAkhir->SHVSPASatuan($result->NoPemasok);
            $profit_satuan = $this->PenjualanProfit->ProfitSatuan($result->NoPemasok);
            
            if ($sh_vs_pa_semua == 0) {
                $total_sh_vs_pa = 0;    
            } else {
                $total_sh_vs_pa = ($sh_vs_pa_satuan / $sh_vs_pa_semua) * 100;
                
                if ($total_sh_vs_pa > 100) {
                    $total_sh_vs_pa = 100;
                }
            }
            
            if ($profit_semua == 0) {
                $total_profit = 0;
            } else {
                $total_profit = ($profit_satuan / $profit_semua) * 100;

                if ($total_profit > 100) {
                    $total_profit = 100;
                }
            }

            $nilai = ($total_barang_terpenuhi * $this->AplikasiBobot->AmbilDataSatuan(1, 'Terpenuhi')) + ($total_sh_vs_pa * $this->AplikasiBobot->AmbilDataSatuan(1, 'SH VS PA')) + ($total_profit * $this->AplikasiBobot->AmbilDataSatuan(1, 'Profit'));
            
            $predikat = $this->FungsiPredikat->AmbilData($nilai);
            
            $this->db->update('pmsk_nli', array('Tanggal' => $tanggal, 'SHVSPA' => $total_sh_vs_pa, 'Nilai' => $nilai, 'Predikat' => $predikat), array('Pemasok' => $result->NoPemasok));
        }
    }
}

?>