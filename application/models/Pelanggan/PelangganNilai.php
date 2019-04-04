<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PelangganNilai extends CI_Model {
	
	public function __construct(){
		parent::__construct();
        
	}
    
    public function AmbilDataSemua($status, $predikat) {
        $this->db->select('NoPelanggan, NamaPelanggan, Tanggal, plnggn__.Penjual, Pencapaian, Profit, UPL, Nilai, Predikat, Status');
        $this->db->from('plnggn_nli');
        $this->db->join('plnggn__', 'plnggn_nli.Pelanggan = plnggn__.NoPelanggan', 'inner');
        
        if (!($status == 'Tidak Aktif')) {
            $this->db->where('Status', 'Aktif');
        }
        
        if (!empty($predikat)) {
            $this->db->join('plnggn_trgt', 'plnggn_nli.Pelanggan = plnggn_trgt.Pelanggan', 'inner');
            $this->db->where('Predikat', $predikat);
        }
        
        $data = $this->db->get()->result();
       
        return $data;
    }
    
    public function AmbilDataSatuan($no_pelanggan, $status, $predikat) {
        $this->db->select('NoPelanggan, NamaPelanggan, Tanggal, Penjual, Pencapaian, Profit, UPL, Nilai, Predikat, Status');
        $this->db->from('plnggn_nli');
        $this->db->join('plnggn__', 'plnggn_nli.Pelanggan = plnggn__.NoPelanggan', 'inner');
        $this->db->where('NoPelanggan', $no_pelanggan);
        
        if (!($status == 'Tidak Aktif')) {
            $this->db->where('Status', 'Aktif');
        }
        
        if (!empty($predikat)) {
            $this->db->where('Predikat', $predikat);
        }
        
        $data = $this->db->get()->result();
       
        return $data;
    }
    
    public function AmbilPerPenjual($no_penjual, $pilihan) {
        $data = 0;
        
        $this->db->select('COUNT(Predikat) as Predikat');
        $this->db->from('plnggn_nli');
        $this->db->join('plnggn__', 'plnggn_nli.Pelanggan = plnggn__.NoPelanggan', 'inner');
        $this->db->join('plnggn_trgt', 'plnggn_nli.Pelanggan = plnggn_trgt.Pelanggan', 'inner');
        
        if ($pilihan != 'Total') {
            switch ($pilihan) {
                case 'A & B' :
                    $this->db->where(array('Predikat' => 'A', 'Predikat' => 'B'));
                    break;
                default :
                    $this->db->where('Predikat', $pilihan);
                    break;
            }
        }
        
        
        $this->db->where('plnggn_trgt.Penjual', $no_penjual);
        $this->db->group_by('plnggn_trgt.Penjual');
        
        foreach ($this->db->get()->result() as $result) {
            $data = $result->Predikat;
        }
        
        return $data;
    }
    
    public function AmbilPencapaianLama($no_pelanggan, $tanggal_awal, $tanggal_akhir) {
        $data = 0;
        
        $this->db->select('AVG(Pencapaian) AS Pencapaian');
        $this->db->from('plnggn_nli_old');
        $this->db->where(array('Pelanggan' => $no_pelanggan, 'Tanggal >=' => $tanggal_awal,'Tanggal <=' => $tanggal_akhir));
        $this->db->group_by('Pelanggan');
        
        foreach ($this->db->get()->result() as $result) {
            $data = $result->Pencapaian;
        }
       
        return $data;
    }
    
    public function AmbilProfitLama($no_pelanggan, $tanggal_awal, $tanggal_akhir) {
        $data = 0;
        
        $this->db->select('AVG(Profit) AS Profit');
        $this->db->from('plnggn_nli_old');
        $this->db->where(array('Pelanggan' => $no_pelanggan, 'Tanggal >=' => $tanggal_awal, 'Tanggal <=' => $tanggal_akhir));
        $this->db->group_by('Pelanggan');
        
        foreach ($this->db->get()->result() as $result) {
            $data = $result->Profit;
        }
       
        return $data;
    }
    
    public function AmbilUPLLama($no_pelanggan, $tanggal_awal, $tanggal_akhir) {
        $data = 0;
        
        $this->db->select('AVG(UPL) AS UPL');
        $this->db->from('plnggn_nli_old');
        $this->db->where(array('Pelanggan' => $no_pelanggan, 'Tanggal >=' => $tanggal_awal, 'Tanggal <=' => $tanggal_akhir));
        $this->db->group_by('Pelanggan');
        
        foreach ($this->db->get()->result() as $result) {
            $data = $result->UPL;
        }
       
        return $data;
    }
    
    public function AmbilPredikat($predikat, $tanggal_awal, $tanggal_akhir) {
        $data = 0;
        
        $this->db->select('Predikat, COUNT(Predikat) AS Jumlah');
        
        if (empty($tanggal_awal) && empty($tanggal_akhir)) {
            $this->db->from('plnggn_nli');
            $this->db->join('plnggn_trgt', 'plnggn_nli.Pelanggan = plnggn_trgt.Pelanggan', 'inner');
        } else {
            $this->db->from('plnggn_nli_old');
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
        if (empty($tanggal_awal) && empty($tanggal_akhir)) {
            $this->db->select('COUNT(plnggn_trgt.Pelanggan) as Jumlah');
            $this->db->from('plnggn_nli');
            $this->db->join('plnggn_trgt', 'plnggn_nli.Pelanggan = plnggn_trgt.Pelanggan', 'inner');
        } else {
            $this->db->select('COUNT(Pelanggan) as Jumlah');
            $this->db->from('plnggn_nli_old');
            $this->db->where(array('Tanggal >=' => $tanggal_awal, 'Tanggal <=' => $tanggal_akhir));
        }
        
        foreach ($this->db->get()->result() as $result) {
            $data = $result->Jumlah;
        }
       
        return $data;
    }
    
    public function HapusDataLama($no_pelanggan) {
        $this->db->delete('plnggn_nli_old', array('Pelanggan' => $no_pelanggan));
    }
    
    public function PerbaruiPencapaian($no_pelanggan, $tanggal) {
        foreach ($this->AmbilDataSatuan($no_pelanggan, null, null) as $result) {            
            date_default_timezone_set('Asia/Jakarta');
            
            if (date('d', strtotime($result->Tanggal)) <= 26) {
                $tanggal_parameter = date('Y-m-d', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($result->Tanggal)), 26, date('Y', strtotime($result->Tanggal))))));
            } else {
                $tanggal_parameter = date('Y-m-d', strtotime('+1 month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($result->Tanggal)), 26, date('Y', strtotime($result->Tanggal)))))));
            }
            
            if ($tanggal > $tanggal_parameter) {
                $this->db->insert('plnggn_nli_old', array('Pelanggan' => $no_pelanggan, 'Tanggal' => $result->Tanggal, 'Pencapaian' => $result->Pencapaian, 'Profit' => $result->Profit, 'UPL' => $result->UPL, 'Nilai' => $result->Nilai, 'Predikat' => $result->Predikat));
            }
            
            $this->load->model('Aplikasi/AplikasiBobot');
            $this->load->model('Fungsi/FungsiHariKerja');
            $this->load->model('Fungsi/FungsiPredikat');
            $this->load->model('Penjualan/PenjualanFaktur');
            $this->load->model('Pelanggan/PelangganTarget');
            
            if (date('d', strtotime($tanggal)) <= 26) {
                $bulan = bulan(date('m', strtotime($tanggal)), 'F').' '.date('Y', strtotime($tanggal));
                $tanggal_awal = date('Y-m-d', strtotime('-1 month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($tanggal)), 26, date('Y', strtotime($tanggal)))))));
                $tanggal_akhir = date('Y-m-d', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($tanggal)), 25, date('Y', strtotime($tanggal))))));
            } else {
                $bulan = bulan(date('m', strtotime('+2 month', strtotime($tanggal))), 'F').' '.date('Y', strtotime('+2 month', strtotime($tanggal)));              
                $tanggal_awal = date('Y-m-d', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($tanggal)), 26, date('Y', strtotime($tanggal))))));
                $tanggal_akhir = date('Y-m-d', strtotime('+1 month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($tanggal)), 25, date('Y', strtotime($tanggal)))))));
            }
            
            $total_nilai_faktur_satuan = $this->PenjualanFaktur->TotaNilaiFakturSatuan($tanggal_awal, $tanggal_akhir, $no_pelanggan);
            $target_pelanggan = ($this->PelangganTarget->AmbilTarget($bulan, $no_pelanggan) / $this->FungsiHariKerja->AmbilData($tanggal_awal, $tanggal_akhir)) * $this->FungsiHariKerja->AmbilData($tanggal_awal, date('Y-m-d'));
            
            if ($target_pelanggan == 0) {
                $total_pencapaian_target = 0;
            } else {
                $total_pencapaian_target = ($total_nilai_faktur_satuan / $target_pelanggan) * 100;
            
                if ($total_pencapaian_target > 100) {
                    $total_pencapaian_target = 100;
                }
            }
            
            $nilai = ($total_pencapaian_target * $this->AplikasiBobot->AmbilDataSatuan(2, 'Pencapaian')) + ($result->Profit * $this->AplikasiBobot->AmbilDataSatuan(2, 'Profit')) + ($result->UPL * $this->AplikasiBobot->AmbilDataSatuan(2, 'UPL'));
            
            $predikat = $this->FungsiPredikat->AmbilData($nilai);
            
            $this->db->update('plnggn_nli', array('Tanggal' => $tanggal, 'Pencapaian' => $total_pencapaian_target, 'Nilai' => $nilai, 'Predikat' => $predikat), array('Pelanggan' => $no_pelanggan));
        }
    }
    
    public function PerbaruiProfit($no_pelanggan, $tanggal) {
        foreach ($this->AmbilDataSatuan($no_pelanggan, null, null) as $result) {
            date_default_timezone_set('Asia/Jakarta');
            
            if (date('d', strtotime($result->Tanggal)) <= 26) {
                $tanggal_parameter = date('Y-m-d', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($result->Tanggal)), 26, date('Y', strtotime($result->Tanggal))))));
            } else {
                $tanggal_parameter = date('Y-m-d', strtotime('+1 month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($result->Tanggal)), 26, date('Y', strtotime($result->Tanggal)))))));
            }
            
            if ($tanggal > $tanggal_parameter) {
                $this->db->insert('plnggn_nli_old', array('Pelanggan' => $no_pelanggan, 'Tanggal' => $result->Tanggal, 'Pencapaian' => $result->Pencapaian, 'Profit' => $result->Profit, 'UPL' => $result->UPL, 'Nilai' => $result->Nilai, 'Predikat' => $result->Predikat));
            }
            
            $this->load->model('Aplikasi/AplikasiBobot');
            $this->load->model('Fungsi/FungsiPredikat');
            $this->load->model('Penjualan/PenjualanFaktur');
            $this->load->model('Penjualan/PenjualanLabaKotor');
            $this->load->model('Penjualan/PenjualanRetur');
            
            if (date('d', strtotime($tanggal)) <= 26) {
                $tanggal_awal = date('Y-m-d', strtotime('-1 month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($tanggal)), 26, date('Y', strtotime($tanggal)))))));
                $tanggal_akhir = date('Y-m-d', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($tanggal)), 25, date('Y', strtotime($tanggal))))));
            } else {
                $tanggal_awal = date('Y-m-d', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($tanggal)), 26, date('Y', strtotime($tanggal))))));
                $tanggal_akhir = date('Y-m-d', strtotime('+1 month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($tanggal)), 25, date('Y', strtotime($tanggal)))))));
            }
            
            $total_laba_kotor_semua = $this->PenjualanLabaKotor->TotaLabaKotorSemua($tanggal_awal, $tanggal_akhir, $result->Penjual);
            $total_nilai_faktur_semua = $this->PenjualanFaktur->TotaNilaiFakturSemua($tanggal_awal, $tanggal_akhir, $result->Penjual);
            $total_nilai_retur_semua = $this->PenjualanRetur->TotaNilaiReturSemua($tanggal_awal, $tanggal_akhir, $result->Penjual);
            
            $total_laba_kotor_satuan = $this->PenjualanLabaKotor->TotaLabaKotorSatuan($tanggal_awal, $tanggal_akhir, $no_pelanggan);
            $total_nilai_faktur_satuan = $this->PenjualanFaktur->TotaNilaiFakturSatuan($tanggal_awal, $tanggal_akhir, $no_pelanggan);
            $total_nilai_retur_satuan = $this->PenjualanRetur->TotaNilaiReturSatuan($tanggal_awal, $tanggal_akhir, $no_pelanggan);
            
            if ($total_nilai_faktur_semua - $total_nilai_retur_semua == 0) {
                $total_profit = 0;
            } else {
                $target_profit = $total_laba_kotor_semua / ($total_nilai_faktur_semua - $total_nilai_retur_semua);
                
                if ($total_nilai_faktur_satuan - $total_nilai_retur_satuan == 0) {
                    $total_profit = 0;
                } else {
                    $satuan_profit = $total_laba_kotor_satuan / ($total_nilai_faktur_satuan - $total_nilai_retur_satuan);
                    
                    if ($target_profit == 0) {
                        $total_profit = 0;
                    } else {
                        $total_profit = ($satuan_profit / $target_profit) * 100;

                        if ($total_profit > 100) {
                            $total_profit = 100;
                        }
                    }
                }
            }

            $nilai = ($result->Pencapaian * $this->AplikasiBobot->AmbilDataSatuan(2, 'Pencapaian')) + ($total_profit * $this->AplikasiBobot->AmbilDataSatuan(2, 'Profit')) + ($result->UPL * $this->AplikasiBobot->AmbilDataSatuan(2, 'UPL'));
            
            $predikat = $this->FungsiPredikat->AmbilData($nilai);
            
            $this->db->update('plnggn_nli', array('Tanggal' => $tanggal, 'Profit' => $total_profit, 'Nilai' => $nilai, 'Predikat' => $predikat), array('Pelanggan' => $no_pelanggan));
        }
    }
    
    public function PerbaruiUPL($no_pelanggan, $tanggal) {
        foreach ($this->AmbilDataSatuan($no_pelanggan, null, null) as $result) {
            date_default_timezone_set('Asia/Jakarta');
            
            if (date('d', strtotime($result->Tanggal)) <= 26) {
                $tanggal_parameter = date('Y-m-d', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($result->Tanggal)), 26, date('Y', strtotime($result->Tanggal))))));
            } else {
                $tanggal_parameter = date('Y-m-d', strtotime('+1 month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($result->Tanggal)), 26, date('Y', strtotime($result->Tanggal)))))));
            }
            
            if ($tanggal > $tanggal_parameter) {
                $this->db->insert('plnggn_nli_old', array('Pelanggan' => $no_pelanggan, 'Tanggal' => $result->Tanggal, 'Pencapaian' => $result->Pencapaian, 'Profit' => $result->Profit, 'UPL' => $result->UPL, 'Nilai' => $result->Nilai, 'Predikat' => $result->Predikat));
            }
            
            $this->load->model('Aplikasi/AplikasiBobot');
            $this->load->model('Fungsi/FungsiHariKerja');
            $this->load->model('Fungsi/FungsiPredikat');
            $this->load->model('Pelanggan/PelangganPiutang');
            $this->load->model('Penjualan/PenjualanFaktur');
            $this->load->model('Penjualan/PenjualanLabaKotor');
            $this->load->model('Penjualan/PenjualanRetur');
            
            if (date('d', strtotime($tanggal)) <= 26) {
                $tanggal_awal = date('Y-m-d', strtotime('-1 month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($tanggal)), 26, date('Y', strtotime($tanggal)))))));
                $tanggal_akhir = date('Y-m-d', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($tanggal)), 25, date('Y', strtotime($tanggal))))));
            } else {
                $tanggal_awal = date('Y-m-d', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($tanggal)), 26, date('Y', strtotime($tanggal))))));
                $tanggal_akhir = date('Y-m-d', strtotime('+1 month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($tanggal)), 25, date('Y', strtotime($tanggal)))))));
            }
            
            $total_piutang_semua  = $this->PelangganPiutang->TotaPiutangSemua($tanggal_awal, $tanggal_akhir, $result->Penjual);
            $total_nilai_faktur_semua = $this->PenjualanFaktur->TotaNilaiFakturSemua($tanggal_awal, $tanggal_akhir, $result->Penjual);
            $total_nilai_retur_semua = $this->PenjualanRetur->TotaNilaiReturSemua($tanggal_awal, $tanggal_akhir, $result->Penjual);
            
            $total_piutang_satuan = $this->PelangganPiutang->TotaPiutangSatuan($tanggal_awal, $tanggal_akhir, $no_pelanggan);
            $total_nilai_faktur_satuan = $this->PenjualanFaktur->TotaNilaiFakturSatuan($tanggal_awal, $tanggal_akhir, $no_pelanggan);
            $total_nilai_retur_satuan = $this->PenjualanRetur->TotaNilaiReturSatuan($tanggal_awal, $tanggal_akhir, $no_pelanggan);
            
            $jumlah_hari_kerja = $this->FungsiHariKerja->AmbilData($tanggal_awal, $tanggal_akhir);
            
            if ($jumlah_hari_kerja == 0) {
                $upl = 0;
            } else {
                if (($total_nilai_faktur_satuan - $total_nilai_retur_satuan) / $jumlah_hari_kerja == 0) {
                    $upl = 0;
                } else {
                    $upl = $total_piutang_satuan / (($total_nilai_faktur_satuan - $total_nilai_retur_satuan) / $jumlah_hari_kerja);
                }
            }

            if ($upl <= 26) {
                if ($upl < 5) {
                    $nilai_upl = (((5 - $upl) / 5) * (100 - 91) + 91);
                } else if ($upl > 20) {
                    $nilai_upl = (((20 - $upl) / 6) * (61 - 51) + 61);
                } else {
                    $nilai_upl = (((5 - $upl) / 15) * (91 - 61) + 91);
                }
            } else {
                $nilai_upl = 40;
            }
            
            $nilai = ($result->Pencapaian * $this->AplikasiBobot->AmbilDataSatuan(2, 'Pencapaian')) + ($result->Profit * $this->AplikasiBobot->AmbilDataSatuan(2, 'Profit')) + ($nilai_upl * $this->AplikasiBobot->AmbilDataSatuan(2, 'UPL'));
            
            $predikat = $this->FungsiPredikat->AmbilData($nilai);
            
            $this->db->update('plnggn_nli', array('Tanggal' => $tanggal, 'UPL' => $nilai_upl, 'Nilai' => $nilai, 'Predikat' => $predikat), array('Pelanggan' => $no_pelanggan));
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
                $this->db->insert('plnggn_nli_old', array('Pelanggan' => $result->NoPelanggan, 'Tanggal' => $result->Tanggal, 'Pencapaian' => $result->Pencapaian, 'Profit' => $result->Profit, 'UPL' => $result->UPL, 'Nilai' => $result->Nilai, 'Predikat' => $result->Predikat));
            }
            
            $this->load->model('Aplikasi/AplikasiBobot');
            $this->load->model('Fungsi/FungsiHariKerja');
            $this->load->model('Fungsi/FungsiPredikat');
            $this->load->model('Pelanggan/PelangganTarget');
            $this->load->model('Pelanggan/PelangganPiutang');
            $this->load->model('Penjualan/PenjualanFaktur');
            $this->load->model('Penjualan/PenjualanLabaKotor');
            $this->load->model('Penjualan/PenjualanRetur');
            
            if (date('d', strtotime($tanggal)) <= 26) {
                $bulan = bulan(date('m', strtotime($tanggal)), 'F').' '.date('Y', strtotime($tanggal));
                $tanggal_awal = date('Y-m-d', strtotime('-1 month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($tanggal)), 26, date('Y', strtotime($tanggal)))))));
                $tanggal_akhir = date('Y-m-d', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($tanggal)), 25, date('Y', strtotime($tanggal))))));
            } else {
                $bulan = bulan(date('m', strtotime('+2 month', strtotime($tanggal))), 'F').' '.date('Y', strtotime('+2 month', strtotime($tanggal)));              
                $tanggal_awal = date('Y-m-d', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($tanggal)), 26, date('Y', strtotime($tanggal))))));
                $tanggal_akhir = date('Y-m-d', strtotime('+1 month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($tanggal)), 25, date('Y', strtotime($tanggal)))))));
            }
            
            $target_pelanggan = ($this->PelangganTarget->AmbilTarget($bulan, $result->NoPelanggan) / $this->FungsiHariKerja->AmbilData($tanggal_awal, $tanggal_akhir)) * $this->FungsiHariKerja->AmbilData($tanggal_awal, date('Y-m-d'));
            
            $total_laba_kotor_semua = $this->PenjualanLabaKotor->TotaLabaKotorSemua($tanggal_awal, $tanggal_akhir, $result->Penjual);
            $total_piutang_semua  = $this->PelangganPiutang->TotaPiutangSemua($tanggal_awal, $tanggal_akhir, $result->Penjual);
            $total_nilai_faktur_semua = $this->PenjualanFaktur->TotaNilaiFakturSemua($tanggal_awal, $tanggal_akhir, $result->Penjual);
            $total_nilai_retur_semua = $this->PenjualanRetur->TotaNilaiReturSemua($tanggal_awal, $tanggal_akhir, $result->Penjual);
            
            $total_laba_kotor_satuan = $this->PenjualanLabaKotor->TotaLabaKotorSatuan($tanggal_awal, $tanggal_akhir, $result->NoPelanggan);
            $total_piutang_satuan = $this->PelangganPiutang->TotaPiutangSatuan($tanggal_awal, $tanggal_akhir, $result->NoPelanggan);
            $total_nilai_faktur_satuan = $this->PenjualanFaktur->TotaNilaiFakturSatuan($tanggal_awal, $tanggal_akhir, $result->NoPelanggan);
            $total_nilai_retur_satuan = $this->PenjualanRetur->TotaNilaiReturSatuan($tanggal_awal, $tanggal_akhir, $result->NoPelanggan);
            
            $jumlah_hari_kerja = $this->FungsiHariKerja->AmbilData($tanggal_awal, $tanggal_akhir);
            
            if ($target_pelanggan == 0) {
                $total_pencapaian_target = 0;
            } else {
                $total_pencapaian_target = ($total_nilai_faktur_satuan / $target_pelanggan) * 100;
            
                if ($total_pencapaian_target > 100) {
                    $total_pencapaian_target = 100;
                }
            }
            
            if ($total_nilai_faktur_semua - $total_nilai_retur_semua == 0) {
                $total_profit = 0;
            } else {
                $target_profit = $total_laba_kotor_semua / ($total_nilai_faktur_semua - $total_nilai_retur_semua);
                
                if ($total_nilai_faktur_satuan - $total_nilai_retur_satuan == 0) {
                    $total_profit = 0;
                } else {
                    $satuan_profit = $total_laba_kotor_satuan / ($total_nilai_faktur_satuan - $total_nilai_retur_satuan);
                    
                    if ($target_profit == 0) {
                        $total_profit = 0;
                    } else {
                        $total_profit = ($satuan_profit / $target_profit) * 100;

                        if ($total_profit > 100) {
                            $total_profit = 100;
                        }
                    }
                }
            }
            
            if ($jumlah_hari_kerja == 0) {
                $upl = 0;
            } else {
                if (($total_nilai_faktur_satuan - $total_nilai_retur_satuan) / $jumlah_hari_kerja == 0) {
                    $upl = 0;
                } else {
                    $upl = $total_piutang_satuan / (($total_nilai_faktur_satuan - $total_nilai_retur_satuan) / $jumlah_hari_kerja);
                }
            }

            if ($upl <= 26) {
                if ($upl < 5) {
                    $nilai_upl = (((5 - $upl) / 5) * (100 - 91) + 91);
                } else if ($upl > 20) {
                    $nilai_upl = (((20 - $upl) / 6) * (61 - 51) + 61);
                } else {
                    $nilai_upl = (((5 - $upl) / 15) * (91 - 61) + 91);
                }
            } else {
                $nilai_upl = 40;
            }
            
            $nilai = ($total_pencapaian_target * $this->AplikasiBobot->AmbilDataSatuan(2, 'Pencapaian')) + ($total_profit * $this->AplikasiBobot->AmbilDataSatuan(2, 'Profit')) + ($nilai_upl * $this->AplikasiBobot->AmbilDataSatuan(2, 'UPL'));
            
            $predikat = $this->FungsiPredikat->AmbilData($nilai);
            
            $this->db->update('plnggn_nli', array('Tanggal' => $tanggal, 'Pencapaian' => $total_pencapaian_target, 'Profit' => $total_profit, 'UPL' => $nilai_upl, 'Nilai' => $nilai, 'Predikat' => $predikat), array('Pelanggan' => $result->NoPelanggan));
        }
    }
}

?>