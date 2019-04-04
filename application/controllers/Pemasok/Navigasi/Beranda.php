<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        
        if ($this->session->userdata('Pengguna') == '') {
            redirect ('Autentikasi');
        }
        
        $this->load->model('Aplikasi/Aplikasi');
        $this->load->model('Fungsi/FungsiNotifikasi');
        $this->load->model('Pengguna');
        $this->load->model('Perusahaan');
        
        date_default_timezone_set('Asia/Jakarta');
	}

    public function update_all() {
        $this->load->model('Pemasok/PemasokNilai');
        
        $this->PemasokNilai->PerbaruiSemua(date('Y-m-d'));
        
        redirect ('Pemasok');
    }
    
    public function index() {
        $cari_menu = $this->input->post('cari_menu');
        
        switch ($cari_menu) {
            case 'Data Pemasok' :
                $data = $this->DataPemasok();
                break;
            case 'Nilai / Pemasok' :
                $data = $this->PemasokNilai();
                break;
            case 'Pesanan Pembelian' :
                $data = $this->PembelianPesanan();
                break;
            case 'Faktur Pembelian' :
                $data = $this->PembelianFaktur();
                break;
            case 'Pembayaran Pembelian' :
                $data = $this->PembayaranPembelian();
                break;
            case 'Persediaan Akhir' :
                $data = $this->PemasokPersediaanAkhir();
                break;
            case 'Penjualan' :
                $data = $this->Penjualan();
                break;
            default :
                $data = $this->Dasbor();
                break;
        }
    }
    
    public function Dasbor() {
        $data['konten'] = 'Dasbor';
        $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
        $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(1);
        $data['perusahaan'] = $this->Perusahaan->AmbilData();

        $data['notifikasi_total'] = $this->FungsiNotifikasi->PembayaranPembelian();
        $data['notifikasi_pembayaran'] = $this->FungsiNotifikasi->PembayaranPembelian();
        
        $abjad = range('A', 'E');
        
        $this->load->model('Pemasok/PemasokNilai');
        
        for ($bulan = 1; $bulan <= 7; $bulan++) {
            $data['nilai']['jumlah'] = $this->PemasokNilai->AmbilData(null, null);
            
            if (date('d') <= 26) {
                $tanggal_awal = strtotime('-'.(9 - $bulan).' month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 26))));
                $tanggal_akhir = strtotime('-'.(8 - $bulan).' month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 25))));
            } else {
                $tanggal_awal = strtotime('-'.(8 - $bulan).' month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 26))));
                $tanggal_akhir = strtotime('-'.(7 - $bulan).' month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 25))));
            }
            
            $data['nilai'][$bulan]['Bulan'] = bulan(date('m', $tanggal_awal), 'M').' - '.bulan(date('m', $tanggal_akhir), 'M');
            
            $jumlah_data = $this->PemasokNilai->AmbilData(date('Y-m-d', $tanggal_awal), date('Y-m-d', $tanggal_akhir));
            
            foreach ($abjad as $predikat) {
                $data['nilai'][$predikat] = $this->PemasokNilai->AmbilPredikat($predikat, null, null);
                
                if ($data['nilai']['jumlah'] == 0) {
                    $data['persentase'][$predikat] = 0;
                } else {
                    $data['persentase'][$predikat] = ($data['nilai'][$predikat] / $data['nilai']['jumlah']) * 100;
                }
                
                if ($jumlah_data == 0) {
                    $data['nilai'][$bulan][$predikat] = 0;
                } else {
                    $data['nilai'][$bulan][$predikat] = ($this->PemasokNilai->AmbilPredikat($predikat, date('Y-m-d', $tanggal_awal), date('Y-m-d', $tanggal_akhir)) / $jumlah_data) * 100;
                }
            }
        }
        
        $this->load->view('index', $data);
    }
    
    public function DataPemasok() {
        if (substr($this->session->userdata('KPIPemasokAkses'), 0, 2) == 0) {
            $this->Dasbor();
        } else {
            $status = $this->input->post('status');
        
            $data['pesan'] = $this->input->get('pesan');
            $data['up_konten'] = null;
            $data['konten'] = 'Data Pemasok';
            $data['icon'] = 'fa-user-secret';
            $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
            $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(1);
            $data['perusahaan'] = $this->Perusahaan->AmbilData();

            $data['notifikasi_total'] = $this->FungsiNotifikasi->PembayaranPembelian();
            $data['notifikasi_pembayaran'] = $this->FungsiNotifikasi->PembayaranPembelian();
                        
            $this->load->model('Pemasok/Pemasok');

            $data['data_tabel'] = $this->Pemasok->AmbilDataSemua($status);
            
            if ($status == 'Tidak Aktif') {
                $data['filter'] = true;
            } else {
                $data['filter'] = false;
            }
            
            $this->load->view('index', $data);
        }
    }
    
    public function PersediaanAkhirPemasok() {
        if (substr($this->session->userdata('KPIPemasokAkses'), 12, 2) == 0) {
            $this->Dasbor();
        } else {
            $tanggal_akhir = $this->input->post('tanggal_akhir');
            $status = $this->input->post('status');
            
            $data['pesan'] = $this->input->get('pesan');
            $data['up_konten'] = null;
            $data['konten'] = 'Persediaan Akhir / Pemasok';
            $data['icon'] = 'fa-user-secret';
            $data['notifikasi'] = $this->FungsiNotifikasi->PembayaranPembelian();
            $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
            $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(1);
            $data['perusahaan'] = $this->Perusahaan->AmbilData();
            
            $data['notifikasi_total'] = $this->FungsiNotifikasi->PembayaranPembelian();
            $data['notifikasi_pembayaran'] = $this->FungsiNotifikasi->PembayaranPembelian();

            if (empty($tanggal_akhir)) {
                $tanggal_akhir = date('d/m/Y');
            }

            $this->load->model('Pemasok/PemasokPersediaanAkhir');

            $data['data_tabel'] = $this->PemasokPersediaanAkhir->AmbilDataSemua(date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_akhir))), $status);

            $data['tanggal_akhir'] = $tanggal_akhir;

            if ($status == 'Tidak Aktif') {
                $data['filter'] = true;
            } else {
                $data['filter'] = false;
            }
            
            $data['total_persediaan_akhir'] = 0;

            $this->load->view('index', $data);
        }
    }
    
    public function NilaiPemasok() {
        if (substr($this->session->userdata('KPIPemasokAkses'), 2, 2) == 0) {
            $this->Dasbor();
        } else {
            $status = $this->input->post('status');
            $predikat = $this->input->get('predikat');

            $data['up_konten'] = null;
            $data['konten'] = 'Nilai / Pemasok';
            $data['icon'] = 'fa-user-secret';
            $data['notifikasi'] = $this->FungsiNotifikasi->PembayaranPembelian();
            $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
            $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(1);
            $data['perusahaan'] = $this->Perusahaan->AmbilData();

            $data['notifikasi_total'] = $this->FungsiNotifikasi->PembayaranPembelian();
            $data['notifikasi_pembayaran'] = $this->FungsiNotifikasi->PembayaranPembelian();
            
            $this->load->model('Aplikasi/AplikasiBobot');
            $this->load->model('Pemasok/PemasokNilai');
            
            $data['data_bobot'] = $this->AplikasiBobot->AmbilDataSemua(1);
            $data['data_tabel'] = $this->PemasokNilai->AmbilDataSemua($status, $predikat);
            
            if ($status == 'Tidak Aktif') {
                $data['filter'] = true;
            } else {
                $data['filter'] = false;
            }
        }
        
        $this->load->view('index', $data);
    }
    
    public function PesananPembelian() {
        if (substr($this->session->userdata('KPIPemasokAkses'), 5, 2) == 0) {
            $this->Dasbor();
        } else {
            $tanggal_awal = $this->input->post('tanggal_awal');
            $tanggal_akhir = $this->input->post('tanggal_akhir');
            $status = $this->input->post('sedang_diproses') + $this->input->post('diterima_penuh') + $this->input->post('ditutup');
            $pemasok = $this->input->post('pemasok');

            $data['up_konten'] = null;
            $data['pesan'] = $this->input->get('pesan');
            $data['konten'] = 'Pesanan Pembelian';
            $data['icon'] = 'fa-cart-plus';
            $data['notifikasi'] = $this->FungsiNotifikasi->PembayaranPembelian();
            $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
            $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(1);
            $data['perusahaan'] = $this->Perusahaan->AmbilData();

            $data['notifikasi_total'] = $this->FungsiNotifikasi->PembayaranPembelian();
            $data['notifikasi_pembayaran'] = $this->FungsiNotifikasi->PembayaranPembelian();
            
            if (empty($status)) {
                $status = 1;
            }

            if (empty($tanggal_awal)) {
                if (date('d') <= 26) {
                    $tanggal_awal = date('d/m/Y', strtotime('-1 month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 26)))));
                } else {
                    $tanggal_awal = date('d/m/Y', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 26))));
                    
                }
            }

            if (empty($tanggal_akhir)) {
                $tanggal_akhir = date('d/m/Y');
            }

            $this->load->model('Pemasok/Pemasok');
            $this->load->model('Pembelian/PembelianPesanan');
            
            $data['pemasok'] = $this->Pemasok->AmbilDataSemua(null);
            
            $data['data_tabel'] = $this->PembelianPesanan->AmbilDataSemua(date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_awal))), date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_akhir))), $status, $pemasok, 'Data');
            
            $data['jumlah_data'] = $this->PembelianPesanan->AmbilDataSemua(date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_awal))), date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_akhir))), $status, $pemasok, 'Jumlah');

            $data['pemasok_select'] = $pemasok;
            $data['tanggal_awal'] = $tanggal_awal;
            $data['tanggal_akhir'] = $tanggal_akhir;
            $data['status'] = $status;
            
            $data['total_umur'] = 0;
            $data['jumlah_jumlah'] = 0;
            

            $this->load->view('index', $data);
        }
    }
    
    public function FakturPembelian() {
        if (substr($this->session->userdata('KPIPemasokAkses'), 7, 2) == 0) {
            $this->Dasbor();
        } else {
            $tanggal_awal = $this->input->post('tanggal_awal');
            $tanggal_akhir = $this->input->post('tanggal_akhir');
            $status = $this->input->post('belum_lunas') + $this->input->post('pembayaran') + $this->input->post('lunas');
            $pemasok = $this->input->post('pemasok');

            $data['pesan'] = $this->input->get('pesan');
            $data['up_konten'] = null;
            $data['konten'] = 'Faktur Pembelian';
            $data['icon'] = 'fa-cart-plus';
            $data['notifikasi'] = $this->FungsiNotifikasi->PembayaranPembelian();
            $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
            $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(1);
            $data['perusahaan'] = $this->Perusahaan->AmbilData();

            $data['notifikasi_total'] = $this->FungsiNotifikasi->PembayaranPembelian();
            $data['notifikasi_pembayaran'] = $this->FungsiNotifikasi->PembayaranPembelian();
            
            if (empty($status)) {
                $status = 1;
            }

            if (empty($tanggal_awal)) {
                if (date('d') <= 26) {
                    $tanggal_awal = date('d/m/Y', strtotime('-1 month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 26)))));
                } else {
                    $tanggal_awal = date('d/m/Y', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 26))));
                    
                }
            }

            if (empty($tanggal_akhir)) {
                $tanggal_akhir = date('d/m/Y');
            }

            $this->load->model('Pemasok/Pemasok');
            $this->load->model('Pembelian/PembelianFaktur');

            $data['pemasok'] = $this->Pemasok->AmbilDataSemua(null);
            
            $data['data_tabel'] = $this->PembelianFaktur->AmbilDataSemua(date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_awal))), date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_akhir))), $status, $pemasok, 'Data');
            
            $data['jumlah_data'] = $this->PembelianFaktur->AmbilDataSemua(date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_awal))), date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_akhir))), $status, $pemasok, 'Jumlah');

            $data['pemasok_select'] = $pemasok;
            $data['tanggal_awal'] = $tanggal_awal;
            $data['tanggal_akhir'] = $tanggal_akhir;
            $data['status'] = $status;
            
            $data['total_umur'] = 0;
            $data['jumlah_nilai_faktur'] = 0;

            $this->load->view('index', $data);
        }
        
    }
    
    public function PembayaranPembelian() {
        if (substr($this->session->userdata('KPIPemasokAkses'), 9, 2) == 0) {
            $this->Dasbor();
        } else {
            $tanggal_awal = $this->input->post('tanggal_awal');
            $tanggal_akhir = $this->input->post('tanggal_akhir');
            $status = $this->input->post('buka_giro') + $this->input->post('dicairkan');
            $pemasok = $this->input->post('pemasok');

            $data['pesan'] = $this->input->get('pesan');
            $data['up_konten'] = null;
            $data['konten'] = 'Pembayaran Pembelian';
            $data['icon'] = 'fa-cart-plus';
            $data['notifikasi'] = $this->FungsiNotifikasi->PembayaranPembelian();
            $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
            $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(1);
            $data['perusahaan'] = $this->Perusahaan->AmbilData();

            $data['notifikasi_total'] = $this->FungsiNotifikasi->PembayaranPembelian();
            $data['notifikasi_pembayaran'] = $this->FungsiNotifikasi->PembayaranPembelian();
            
            if (empty($status)) {
                $status = 1;
            }

            if (empty($tanggal_awal)) {
                if (date('d') <= 26) {
                    $tanggal_awal = date('d/m/Y', strtotime('-1 month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 26)))));
                } else {
                    $tanggal_awal = date('d/m/Y', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 26))));
                    
                }
            }

            if (empty($tanggal_akhir)) {
                $tanggal_akhir = date('d/m/Y');
            }

            $this->load->model('Pemasok/Pemasok');
            $this->load->model('Pembelian/PembelianPembayaran');

            $data['pemasok'] = $this->Pemasok->AmbilDataSemua(null);
            
            $data['data_tabel'] = $this->PembelianPembayaran->AmbilDataSemua(date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_awal))), date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_akhir))), $status, $pemasok);
            
            $data['pemasok_select'] = $pemasok;
            $data['tanggal_awal'] = $tanggal_awal;
            $data['tanggal_akhir'] = $tanggal_akhir;
            $data['status'] = $status;

            $data['jumlah_jumlah_faktur'] = 0;

            $this->load->view('index', $data);
        }
    }
    
    public function ProfitPenjualan() {
        if (substr($this->session->userdata('KPIPemasokAkses'), 15, 2) == 0) {
            $this->Dasbor();
        } else {
            $tanggal_awal = $this->input->post('tanggal_awal');
            $tanggal_akhir = $this->input->post('tanggal_akhir');
            $pemasok = $this->input->post('pemasok');

            $data['pesan'] = $this->input->get('pesan');
            $data['up_konten'] = null;
            $data['konten'] = 'Profit / Penjualan';
            $data['icon'] = 'fa-cart-arrow-down';
            $data['notifikasi'] = $this->FungsiNotifikasi->PembayaranPembelian();
            $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
            $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(1);
            $data['perusahaan'] = $this->Perusahaan->AmbilData();

            $data['notifikasi_total'] = $this->FungsiNotifikasi->PembayaranPembelian();
            $data['notifikasi_pembayaran'] = $this->FungsiNotifikasi->PembayaranPembelian();
            
            if (empty($tanggal_awal)) {
                $tanggal_awal = date('d/m/Y', strtotime('-1 day', strtotime(date('Y-m-d'))));
            }

            if (empty($tanggal_akhir)) {
                $tanggal_akhir = date('d/m/Y');
            }

            $this->load->model('Pemasok/Pemasok');
            $this->load->model('Penjualan/PenjualanProfit');
            
            $data['pemasok'] = $this->Pemasok->AmbilDataSemua(null);
            
            $data['data_tabel'] = $this->PenjualanProfit->AmbilDataSemua(date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_awal))), date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_akhir))), $pemasok);

            $data['pemasok_select'] = $pemasok;
            $data['tanggal_awal'] = $tanggal_awal;
            $data['tanggal_akhir'] = $tanggal_akhir;
            
            $data['total_penjualan'] = 0;
            $data['total_laba_kotor'] = 0;
            $data['rerata_profit'] = 0;

            $this->load->view('index', $data);
        }
    }
}

?>