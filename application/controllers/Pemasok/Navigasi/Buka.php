<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buka extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        
        if ($this->session->userdata('Pengguna') == '') {
            redirect ('Autentikasi');
        }
        
        $this->load->model('Pengguna');
        $this->load->model('Aplikasi/Aplikasi');
        $this->load->model('Perusahaan');
        
        date_default_timezone_set('Asia/Jakarta');
	}
    
    public function DataPemasok() {
        $no_pemasok = $this->input->get('no_pemasok');
        
        $data['up_konten'] = 'Data Pemasok';
        $data['icon'] = 'fa-user-secret';
        $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
        $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(1);
        $data['perusahaan'] = $this->Perusahaan->AmbilData();
        
        $this->load->model('Pemasok/Pemasok');
        
        foreach ($this->Pemasok->AmbilDataSatuan($no_pemasok) as $result) {
            $data['no_pemasok'] = $result->NoPemasok;   
            $data['nama_pemasok'] = $result->NamaPemasok;   
            $data['no_telepon_1'] = str_replace('+62', '', $result->NoTelepon1);   
            $data['email'] = $result->Email;   
            $data['website'] = str_replace('http://', '', $result->Website);
            $data['alamat'] = $result->AlamatLengkap;   
            $data['kabupaten_kota'] = $result->KabupatenKota;   
            $data['provinsi'] = $result->Provinsi;   
            $data['kode_pos'] = $result->KodePos;   
            $data['nama_kontak'] = $result->NamaKontak;   
            $data['no_telepon_2'] = str_replace('+62', '', $result->NoTelepon2);
            $data['keterangan'] = $result->Keterangan;   
            $data['status'] = $result->Status;   
        
            $data['konten'] = $result->NamaPemasok;
        }
        
        $this->load->view('index', $data);
    }
    
    
    public function PersediaanAkhirPemasok() {
        $no_pemasok = $this->input->get('no_pemasok');

        $data['up_konten'] = 'Persediaan Akhir / Pemasok';
        $data['icon'] = 'fa-user-secret';
        $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
        $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(1);
        $data['perusahaan'] = $this->Perusahaan->AmbilData();
        
        $this->load->model('Pemasok/PemasokPersediaanAkhir');
        
        foreach ($this->PemasokPersediaanAkhir->AmbilDataSatuan($no_pemasok) as $result) {
            $data['pemasok'] = $result->NoPemasok.' - '.$result->NamaPemasok;    
            $data['persediaan_akhir'] = $result->PersediaanAkhir;
            
            $data['konten'] = $result->NamaPemasok;
        }
        
        $this->load->view('index', $data);
    }
    
    
    public function GrafikNilaiPemasok() {
        $no_pemasok = $this->input->get('no_pemasok');
        $nama_pemasok = $this->input->get('nama_pemasok');
        
        $data['up_konten'] = 'Nilai / Pemasok';
        $data['konten'] = $nama_pemasok;
        $data['icon'] = 'fa-user-secret';
        $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
        $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(1);
        $data['perusahaan'] = $this->Perusahaan->AmbilData();
        
        $this->load->model('Pemasok/PemasokNilai');
        
        for ($bulan = 1; $bulan <= 6; $bulan++) {
            if (date('d') <= 26) {
                $tanggal_awal = strtotime('-'.(9 - $bulan).' month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 26))));
                $tanggal_akhir = strtotime('-'.(8 - $bulan).' month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 25))));
            } else {
                $tanggal_awal = strtotime('-'.(8 - $bulan).' month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 26))));
                $tanggal_akhir = strtotime('-'.(7 - $bulan).' month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 25))));
            }
            
            $data['nilai'][$bulan] = array(
                'Bulan' => bulan(date('m', $tanggal_awal), 'M').' - '.bulan(date('m', $tanggal_akhir), 'M'),
                'Profit' => $this->PemasokNilai->AmbilProfitLama($no_pemasok, date('Y-m-d', $tanggal_awal), date('Y-m-d', $tanggal_akhir)),
                'SH VS PA' => $this->PemasokNilai->AmbilSHVSPALama($no_pemasok, date('Y-m-d', $tanggal_awal), date('Y-m-d', $tanggal_akhir)),
                'Terpenuhi' => $this->PemasokNilai->AmbilTerpenuhiLama($no_pemasok, date('Y-m-d', $tanggal_awal), date('Y-m-d', $tanggal_akhir))
            );
        }
        
        foreach ($this->PemasokNilai->AmbilDataSatuan($no_pemasok, null, null) as $sekarang) {
            if (date('d') <= 26) {
                $bulan = bulan(date('m', strtotime('-1 month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 26))))), 'M').' - '.bulan(date('m', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 25)))), 'M');
            } else {
                $bulan = bulan(date('m', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 26)))), 'M').' - '.bulan(date('m', strtotime('+1 month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 25))))), 'M');
            }
            
            $data['nilai'][7] = array(
                'Bulan' => $bulan,
                'Profit' => $sekarang->Profit,
                'SH VS PA' => $sekarang->SHVSPA,
                'Terpenuhi' => $sekarang->Terpenuhi
            );
        }

        $this->load->view('index', $data);
    }
    
    public function PesananPembelian() {
        $no_po = $this->input->get('no_po');

        $data['up_konten'] = 'Pesanan Pembelian';
        $data['konten'] = $no_po;
        $data['icon'] = 'fa-cart-plus';
        $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
        $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(1);
        $data['perusahaan'] = $this->Perusahaan->AmbilData();
        
        $this->load->model('Pembelian/PembelianPesanan');
        
        foreach ($this->PembelianPesanan->AmbilDataSatuan($no_po) as $result) {
            $data['no_po'] = $result->NoPO;   
            $data['tanggal'] = date('d/m/Y', strtotime(str_replace('-', '/', $result->Tanggal)));
            $data['pemasok'] = $result->NoPemasok.' - '.$result->NamaPemasok;  
            $data['diterima'] = $result->Diterima;  
            $data['diproses'] = $result->Diproses;
            $data['keterangan'] = $result->Keterangan;  
            $data['status'] = $result->Status;  
        }
        
        $this->load->view('index', $data);
    }
    
    public function FakturPembelian() {
        $no_faktur = $this->input->get('no_faktur');

        $data['up_konten'] = 'Faktur Pembelian';
        $data['konten'] = $no_faktur;
        $data['icon'] = 'fa-cart-plus';
        $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
        $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(1);
        $data['perusahaan'] = $this->Perusahaan->AmbilData();
        
        $this->load->model('Pembelian/PembelianFaktur');
        
        foreach ($this->PembelianFaktur->AmbilDataSatuan($no_faktur) as $result) {
            $data['no_faktur'] = $result->NoFaktur;   
            $data['tanggal'] = date('d/m/Y', strtotime(str_replace('-', '/', $result->Tanggal)));
            $data['pemasok'] = $result->NoPemasok.' - '.$result->NamaPemasok;    
            $data['no_po'] = $result->NoPO;  
            $data['nilai_faktur'] = $result->NilaiFaktur;
            $data['keterangan'] = $result->Keterangan;  
        }
        
        $this->load->view('index', $data);
    }
    
    public function PembayaranPembelian() {
        $no_pembayaran = $this->input->get('no_pembayaran');

        $data['up_konten'] = 'Pembayaran Pembelian';
        $data['konten'] = $no_pembayaran;
        $data['icon'] = 'fa-cart-plus';
        $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
        $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(1);
        $data['perusahaan'] = $this->Perusahaan->AmbilData();
        
        $this->load->model('Pembelian/PembelianPembayaran');
        
        foreach ($this->PembelianPembayaran->AmbilDataSatuan($no_pembayaran) as $result) {
            $data['no_pembayaran'] = $result->NoPembayaran;   
            $data['tanggal'] = date('d/m/Y', strtotime(str_replace('-', '/', $result->Tanggal)));
            $data['pemasok'] = $result->NoPemasok.' - '.$result->NamaPemasok;    
            $data['total_faktur'] = $result->TotalFaktur;
            $data['no_cek'] = $result->NoCek;
            $data['tanggal_cek'] = date('d/m/Y', strtotime(str_replace('-', '/', $result->TanggalCek)));
            $data['keterangan'] = $result->Keterangan;  
            $data['status'] = $result->Status;
        }
        
        $this->load->view('index', $data);
    }
    
    public function ProfitPenjualan() {
        $no = $this->input->get('no');

        $this->load->model('Penjualan/PenjualanProfit');
        
        $data['up_konten'] = 'Profit / Penjualan';
        $data['icon'] = 'fa-cart-plus';
        $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
        $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(1);
        $data['perusahaan'] = $this->Perusahaan->AmbilData();
        
        foreach ($this->PenjualanProfit->AmbilDataSatuan($no) as $result) {
            $data['no'] = $result->No;   
            $data['tanggal'] = date('d/m/Y', strtotime(str_replace('-', '/', $result->Tanggal)));
            $data['pemasok'] = $result->NoPemasok.' - '.$result->NamaPemasok;    
            $data['penjualan'] = $result->Penjualan;
            $data['laba_kotor'] = $result->LabaKotor;  
            
            $data['konten'] = $result->NamaPemasok;
        }
        
        $this->load->view('index', $data);
    }
}

?>