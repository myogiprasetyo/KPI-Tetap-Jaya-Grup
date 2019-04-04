<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {
	
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
    
    public function update_all() {
        $this->load->model('Pelanggan/PelangganNilai');
        
        $this->PelangganNilai->PerbaruiSemua(date('Y-m-d'));
        
        redirect ('Pelanggan');
    }
    
    public function index() {
        $cari_menu = $this->input->post('cari_menu');
        
        switch ($cari_menu) {
            case 'Data Pelanggan' :
                $this->DataPelanggan();
                break;
            case 'Target / Pelanggan' :
                $this->TargetPelanggan();
                break;
            case 'Piutang / Pelanggan' :
                $this->TargetPelanggan();
                break;
            case 'Nilai / Pelanggan' :
                $this->NilaiPelanggan();
                break;
            case 'Data Rayon' :
                $this->DataRayon();
                break;
            case 'Data Penjual' :
                $this->DataPenjual();
                break;
            case 'Faktur Penjualan' :
                $this->FakturPenjualan();
                break;
            case 'Retur Penjualan' :
                $this->ReturPenjualan();
                break;
            case 'Laba Kotor Penjualan' :
                $this->LabaKotorPenjualan();
                break;
            default :
                $this->Dasbor();
                break;
        }
    }
    
    public function Dasbor() {
        $data['konten'] = 'Dasbor';
        $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
        $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(2);
        $data['perusahaan'] = $this->Perusahaan->AmbilData();
        
        $abjad = range('A', 'E');
        
        $this->load->model('Pelanggan/PelangganNilai');
        $this->load->model('Pelanggan/PelangganTarget');
        $this->load->model('Penjualan/PenjualanFaktur');
        $this->load->model('Penjual');
        $this->load->model('Rayon');
        
        for ($bulan = 1; $bulan <= 7; $bulan++) {
            $data['nilai']['jumlah'] = $this->PelangganNilai->AmbilData(null, null);
            
            if (date('d') <= 26) {
                $tanggal_awal = strtotime('-'.(9 - $bulan).' month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 26))));
                $tanggal_akhir = strtotime('-'.(8 - $bulan).' month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 25))));
            } else {
                $tanggal_awal = strtotime('-'.(8 - $bulan).' month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 26))));
                $tanggal_akhir = strtotime('-'.(7 - $bulan).' month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 25))));
            }
            
            $data['nilai'][$bulan]['Bulan'] = bulan(date('m', $tanggal_awal), 'M').' - '.bulan(date('m', $tanggal_akhir), 'M');
            
            $jumlah_data = $this->PelangganNilai->AmbilData(date('Y-m-d', $tanggal_awal), date('Y-m-d', $tanggal_akhir));
            
            foreach ($abjad as $predikat) {
                $data['nilai'][$predikat] = $this->PelangganNilai->AmbilPredikat($predikat, null, null);
                
                if ($data['nilai']['jumlah'] == 0) {
                    $data['persentase'][$predikat] = 0;
                } else {
                    $data['persentase'][$predikat] = ($data['nilai'][$predikat] / $data['nilai']['jumlah']) * 100;
                }
                
                if ($jumlah_data == 0) {
                    $data['nilai'][$bulan][$predikat] = 0;
                } else {
                    $data['nilai'][$bulan][$predikat] = ($this->PelangganNilai->AmbilPredikat($predikat, date('Y-m-d', $tanggal_awal), date('Y-m-d', $tanggal_akhir)) / $jumlah_data) * 100;
                }
            }
        }
        
        if (date('d') <= 26) {
            $bulan = $bulan = bulan(null, 'F').' '.date('Y');
            $tanggal_awal = date('Y-m-d', strtotime('-1 month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 26, date('Y'))))));
            $tanggal_akhir = date('Y-m-d', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 25, date('Y')))));
        } else {
            $bulan = bulan(date('m', strtotime('+2 month', date('m'))), 'F').' '.date('Y');
            $tanggal_awal = date('Y-m-d', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 26, date('Y')))));
            $tanggal_akhir = date('Y-m-d', strtotime('+1 month', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m'), 25, date('Y'))))));
        }
        
        $data['total_pelanggan_efektif_penjual']['Target'] = 0;
        $data['total_pelanggan_efektif_penjual']['Sudah Belanja'] = 0;
        $data['total_pelanggan_efektif_penjual']['Belum Belanja'] = 0;
        $data['total_pencapaian_penjual']['Target'] = 0;
        $data['total_pencapaian_penjual']['Pencapaian'] = 0;
        $data['total_predikat_penjual']['Predikat A'] = 0;
        $data['total_predikat_penjual']['Predikat B'] = 0;
        $data['total_predikat_penjual']['Predikat C'] = 0;
        $data['total_predikat_penjual']['Predikat D'] = 0;
        $data['total_predikat_penjual']['Predikat E'] = 0;
        $data['total_predikat_penjual']['Total'] = 0;
        
        if ($this->Rayon->JumlahData() < 1) {
            $data['total_pelanggan_efektif_penjual']['Persentase'] = 0;
            $data['total_pencapaian_penjual']['Persentase'] =  0;
            $data['total_predikat_penjual']['Persentase'] = 0;
            $data['limit_penjual'] = 0;
        } else {
            $no_penjual = 1;

            foreach ($this->Penjual->AmbilDataSemua(null) as $result) {
                if ($this->PelangganTarget->AmbilPerPenjual($bulan, $result->NoPenjual, 'Pelanggan Efektif') == 0){
                    $persentase_pelanggan_efektif_penjual = 0;
                } else {
                    $persentase_pelanggan_efektif_penjual = ($this->PenjualanFaktur->AmbilPerPenjual($tanggal_awal, $tanggal_akhir, $result->NoPenjual, 'Pelanggan Efektif') / $this->PelangganTarget->AmbilPerPenjual($bulan, $result->NoPenjual, 'Pelanggan Efektif')) * 100;

                    if ($persentase_pelanggan_efektif_penjual > 100) {
                        $persentase_pelanggan_efektif_penjual = 100;
                    }
                }
                
                $pelanggan_efektif_penjual_belum_belanja = number_format($this->PelangganTarget->AmbilPerPenjual($bulan, $result->NoPenjual, 'Pelanggan Efektif'), 0, ',', '.') - $this->PenjualanFaktur->AmbilPerPenjual($tanggal_awal, $tanggal_akhir, $result->NoPenjual, 'Pelanggan Efektif');
                
                if ($pelanggan_efektif_penjual_belum_belanja < 0) {
                    $pelanggan_efektif_penjual_belum_belanja = 0;
                }
                
                $data['pelanggan_efektif_penjual'][$no_penjual] = array(
                    'Penjual' => $result->NoPenjual.' - '.$result->NamaPenjual,
                    'Target' => number_format($this->PelangganTarget->AmbilPerPenjual($bulan, $result->NoPenjual, 'Pelanggan Efektif'), 0, ',', '.'),
                    'Sudah Belanja' => $this->PenjualanFaktur->AmbilPerPenjual($tanggal_awal, $tanggal_akhir, $result->NoPenjual, 'Pelanggan Efektif'),
                    'Belum Belanja' => $pelanggan_efektif_penjual_belum_belanja,
                    'Persentase' => $persentase_pelanggan_efektif_penjual
                );

                $data['total_pelanggan_efektif_penjual']['Target'] += number_format($this->PelangganTarget->AmbilPerPenjual($bulan, $result->NoPenjual, 'Pelanggan Efektif'), 0, ',', '.');
                $data['total_pelanggan_efektif_penjual']['Sudah Belanja'] += $this->PenjualanFaktur->AmbilPerPenjual($tanggal_awal, $tanggal_akhir, $result->NoPenjual, 'Pelanggan Efektif');
                $data['total_pelanggan_efektif_penjual']['Belum Belanja'] += number_format($this->PelangganTarget->AmbilPerPenjual($bulan, $result->NoPenjual, 'Pelanggan Efektif'), 0, ',', '.') - $this->PenjualanFaktur->AmbilPerPenjual($tanggal_awal, $tanggal_akhir, $result->NoPenjual, 'Pelanggan Efektif');

                if ($data['total_pelanggan_efektif_penjual']['Belum Belanja'] < 0) {
                    $data['total_pelanggan_efektif_penjual']['Belum Belanja'] = 0;
                }
                
                if ($data['total_pelanggan_efektif_penjual']['Target'] == 0) {
                    $data['total_pelanggan_efektif_penjual']['Persentase'] = 0;
                } else {
                    $data['total_pelanggan_efektif_penjual']['Persentase'] = ($data['total_pelanggan_efektif_penjual']['Sudah Belanja'] / $data['total_pelanggan_efektif_penjual']['Target']) * 100;

                    if ($data['total_pelanggan_efektif_penjual']['Persentase'] > 100) {
                        $data['total_pelanggan_efektif_penjual']['Persentase'] = 100;
                    }
                }

                if ($this->PelangganTarget->AmbilPerPenjual($bulan, $result->NoPenjual, 'Pencapaian') == 0){
                    $persentase_pencapaian_penjual = 0;
                } else {
                    $persentase_pencapaian_penjual = ($this->PenjualanFaktur->AmbilPerPenjual($tanggal_awal, $tanggal_akhir, $result->NoPenjual, 'Pencapaian') / $this->PelangganTarget->AmbilPerPenjual($bulan, $result->NoPenjual, 'Pencapaian')) * 100;

                    if ($persentase_pencapaian_penjual > 100) {
                        $persentase_pencapaian_penjual = 100;
                    }
                }

                $data['pencapaian_penjual'][$no_penjual] = array(
                    'Penjual' => $result->NoPenjual.' - '.$result->NamaPenjual,
                    'Target' => $this->PelangganTarget->AmbilPerPenjual($bulan, $result->NoPenjual, 'Pencapaian'),
                    'Pencapaian' => $this->PenjualanFaktur->AmbilPerPenjual($tanggal_awal, $tanggal_akhir, $result->NoPenjual, 'Pencapaian'),
                    'Persentase' => $persentase_pencapaian_penjual
                );

                $data['total_pencapaian_penjual']['Target'] += $this->PelangganTarget->AmbilPerPenjual($bulan, $result->NoPenjual, 'Pencapaian');
                $data['total_pencapaian_penjual']['Pencapaian'] += $this->PenjualanFaktur->AmbilPerPenjual($tanggal_awal, $tanggal_akhir, $result->NoPenjual, 'Pencapaian');

                if ($data['total_pencapaian_penjual']['Target'] == 0) {
                    $data['total_pencapaian_penjual']['Persentase'] =  0;
                } else {
                    $data['total_pencapaian_penjual']['Persentase'] = ($data['total_pencapaian_penjual']['Pencapaian'] / $data['total_pencapaian_penjual']['Target']) * 100;

                    if ($data['total_pencapaian_penjual']['Persentase'] > 100) {
                        $data['total_pencapaian_penjual']['Persentase'] = 100;
                    }
                }

                if ($this->PelangganNilai->AmbilPerPenjual($result->NoPenjual, 'Total') == 0){
                    $persentase_predikat_penjual = 0;
                } else {
                    $persentase_predikat_penjual = ($this->PelangganNilai->AmbilPerPenjual($result->NoPenjual, 'A & B') / $this->PelangganNilai->AmbilPerPenjual($result->NoPenjual, 'Total')) * 100;

                    if ($persentase_predikat_penjual > 100) {
                        $persentase_predikat_penjual = 100;
                    }
                }

                $data['predikat_penjual'][$no_penjual] = array(
                    'Penjual' => $result->NoPenjual.' - '.$result->NamaPenjual,
                    'Predikat A' => $this->PelangganNilai->AmbilPerPenjual($result->NoPenjual, 'A'),
                    'Predikat B' => $this->PelangganNilai->AmbilPerPenjual($result->NoPenjual, 'B'),
                    'Predikat C' => $this->PelangganNilai->AmbilPerPenjual($result->NoPenjual, 'C'),
                    'Predikat D' => $this->PelangganNilai->AmbilPerPenjual($result->NoPenjual, 'D'),
                    'Predikat E' => $this->PelangganNilai->AmbilPerPenjual($result->NoPenjual, 'E'),
                    'Pesentase Predikat A & B' => $persentase_predikat_penjual
                );

                $data['total_predikat_penjual']['Predikat A'] += $this->PelangganNilai->AmbilPerPenjual($result->NoPenjual, 'A');
                $data['total_predikat_penjual']['Predikat B'] += $this->PelangganNilai->AmbilPerPenjual($result->NoPenjual, 'B');
                $data['total_predikat_penjual']['Predikat C'] += $this->PelangganNilai->AmbilPerPenjual($result->NoPenjual, 'C');
                $data['total_predikat_penjual']['Predikat D'] += $this->PelangganNilai->AmbilPerPenjual($result->NoPenjual, 'D');
                $data['total_predikat_penjual']['Predikat E'] += $this->PelangganNilai->AmbilPerPenjual($result->NoPenjual, 'E');
                $data['total_predikat_penjual']['Total'] += $this->PelangganNilai->AmbilPerPenjual($result->NoPenjual, 'Total');

                if ($data['total_predikat_penjual']['Total'] == 0) {
                    $data['total_predikat_penjual']['Persentase'] = 0;
                } else {
                    $data['total_predikat_penjual']['Persentase'] = (($data['total_predikat_penjual']['Predikat A'] + $data['total_predikat_penjual']['Predikat B']) / $data['total_predikat_penjual']['Total']) * 100;

                    if ($data['total_predikat_penjual']['Persentase'] > 100) {
                        $data['total_predikat_penjual']['Persentase'] = 100;
                    }
                }

                $data['limit_penjual'] = $no_penjual++;
            }
        }
        
        $data['total_pencapaian_rayon']['Target'] = 0;
        $data['total_pencapaian_rayon']['Pencapaian'] = 0;
        
        if ($this->Rayon->JumlahData() < 1) {
            $data['total_pencapaian_rayon']['Persentase'] = 0;
            $data['limit_rayon'] = 0;
        } else {
            $no_rayon = 1;
            
            foreach ($this->Rayon->AmbilDataSemua(null) as $result) {
                if ($this->PelangganTarget->AmbilPerRayon($bulan, $result->KodeRayon) == 0) {
                    $persentase_pencapaian_rayon = 0;
                } else {
                    $persentase_pencapaian_rayon = ($this->PenjualanFaktur->AmbilPerRayon($tanggal_awal, $tanggal_akhir, $result->KodeRayon) / $this->PelangganTarget->AmbilPerRayon($bulan, $result->KodeRayon)) * 100;

                    if ($persentase_pencapaian_rayon > 100) {
                        $persentase_pencapaian_rayon = 100;
                    }
                }

                $data['pencapaian_rayon'][$no_rayon] = array(
                    'Rayon' => $result->KodeRayon.' - '.$result->NamaRayon,
                    'Target' => $this->PelangganTarget->AmbilPerRayon($bulan, $result->KodeRayon),
                    'Pencapaian' => $this->PenjualanFaktur->AmbilPerRayon($tanggal_awal, $tanggal_akhir, $result->KodeRayon),
                    'Persentase' => $persentase_pencapaian_rayon
                );

                $data['total_pencapaian_rayon']['Target'] += $this->PelangganTarget->AmbilPerRayon($bulan, $result->KodeRayon);
                $data['total_pencapaian_rayon']['Pencapaian'] += $this->PenjualanFaktur->AmbilPerRayon($tanggal_awal, $tanggal_akhir, $result->KodeRayon);

                if ($data['total_pencapaian_rayon']['Target'] == 0) {
                    $data['total_pencapaian_rayon']['Persentase'] = 0;
                } else {
                    $data['total_pencapaian_rayon']['Persentase'] = ($data['total_pencapaian_rayon']['Pencapaian'] / $data['total_pencapaian_rayon']['Target']) * 100;

                    if ($data['total_pencapaian_rayon']['Persentase'] > 100) {
                        $data['total_pencapaian_rayon']['Persentase'] = 100;
                    }
                }

                $data['limit_rayon'] = $no_rayon++;
            }
        }
        
        $this->load->view('index', $data);
    }
    
    public function DataPelanggan() {
        if (substr($this->session->userdata('KPIPelangganAkses'), 0, 2) == 0) {
            $this->Dasbor();
        } else {
            $status = $this->input->post('status');
        
            $data['pesan'] = $this->input->get('pesan');
            $data['up_konten'] = null;
            $data['konten'] = 'Data Pelanggan';
            $data['icon'] = 'fa-street-view';
            $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
            $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(2);
            $data['perusahaan'] = $this->Perusahaan->AmbilData();
                        
            $this->load->model('Pelanggan/Pelanggan');

            $data['data_tabel'] = $this->Pelanggan->AmbilDataSemua($status);
            
            if ($status == 'Tidak Aktif') {
                $data['filter'] = true;
            } else {
                $data['filter'] = false;
            }
            
            $this->load->view('index', $data);
        }
    }
    
    public function TargetPelanggan() {
        if (substr($this->session->userdata('KPIPelangganAkses'), 0, 2) == 0) {
            $this->Dasbor();
        } else {
            $bulan = $this->input->post('bulan');
            $no_penjual = $this->input->post('penjual');
            $status = $this->input->post('status');
        
            $data['pesan'] = $this->input->get('pesan');
            $data['up_konten'] = null;
            $data['konten'] = 'Target / Pelanggan';
            $data['icon'] = 'fa-street-view';
            $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
            $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(2);
            $data['perusahaan'] = $this->Perusahaan->AmbilData();
            
            if (empty($bulan)) {
                if (date('d') <= 26) {
                    $bulan = bulan(null, 'F').' '.date('Y');
                } else {
                    $bulan = bulan(date('m', strtotime('+2 month', strtotime(date('m')))), 'F').' '.date('Y', strtotime('+2 month', strtotime(date('Y'))));
                }
            }
            
            $this->load->model('Pelanggan/PelangganTarget');
            $this->load->model('Penjual');

            $data['penjual'] = $this->Penjual->AmbilDataSemua(null);
            
            $data['data_tabel'] = $this->PelangganTarget->AmbilDataSemua($bulan, $no_penjual, $status);
            
            if ($status == 'Tidak Aktif') {
                $data['filter'] = true;
            } else {
                $data['filter'] = false;
            }
            
            $data['bulan'] = $bulan;
            $data['penjual_select'] = $no_penjual;
    
            $data['total_target'] = 0;
            
            $this->load->view('index', $data);
        }
    }
    
    public function PiutangPelanggan() {
        if (substr($this->session->userdata('KPIPelangganAkses'), 12, 2) == 0) {
            $this->Dasbor();
        } else {
            $tanggal_awal = $this->input->post('tanggal_awal');
            $tanggal_akhir = $this->input->post('tanggal_akhir');
            $no_penjual = $this->input->post('penjual');
            $status = $this->input->post('status');

            $data['pesan'] = $this->input->get('pesan');
            $data['up_konten'] = null;
            $data['konten'] = 'Piutang / Pelanggan';
            $data['icon'] = 'fa-street-view';
            $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
            $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(2);
            $data['perusahaan'] = $this->Perusahaan->AmbilData();

            if (empty($tanggal_awal)) {
                $tanggal_awal = date('d/m/Y', strtotime('-1 day', strtotime(date('Y-m-d'))));
            }
            
            if (empty($tanggal_akhir)) {
                $tanggal_akhir = date('d/m/Y');
            }

            $this->load->model('Pelanggan/PelangganPiutang');
            $this->load->model('Penjual');

            $data['penjual'] = $this->Penjual->AmbilDataSemua(null);
            
            $data['data_tabel'] = $this->PelangganPiutang->AmbilDataSemua(date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_awal))), date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_akhir))), $no_penjual, $status);

            if ($status == 'Tidak Aktif') {
                $data['filter'] = true;
            } else {
                $data['filter'] = false;
            }
            
            $data['tanggal_awal'] = $tanggal_awal;
            $data['tanggal_akhir'] = $tanggal_akhir;
            $data['penjual_select'] = $no_penjual;
            
            $data['total_piutang'] = 0;

            $this->load->view('index', $data);
        }
    }
    
    public function NilaiPelanggan() {
        if (substr($this->session->userdata('KPIPelangganAkses'), 2, 2) == 0) {
            $this->Dasbor();
        } else {
            $status = $this->input->post('status');
            $predikat = $this->input->get('predikat');

            $this->load->model('Aplikasi/AplikasiBobot');
            $this->load->model('Pelanggan/PelangganNilai');

            $data['up_konten'] = null;
            $data['konten'] = 'Nilai / Pelanggan';
            $data['icon'] = 'fa-street-view';
            $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
            $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(2);
            $data['perusahaan'] = $this->Perusahaan->AmbilData();
            
            $data['data_bobot'] = $this->AplikasiBobot->AmbilDataSemua(2);
            $data['data_tabel'] = $this->PelangganNilai->AmbilDataSemua($status, $predikat);
            
            if ($status == 'Tidak Aktif') {
                $data['filter'] = true;
            } else {
                $data['filter'] = false;
            }
        }
        
        $this->load->view('index', $data);
    }
    
    public function DataRayon() {
        if (substr($this->session->userdata('KPIPelangganAkses'), 0, 2) == 0) {
            $this->Dasbor();
        } else {
            $status = $this->input->post('status');
        
            $data['pesan'] = $this->input->get('pesan');
            $data['up_konten'] = null;
            $data['konten'] = 'Data Rayon';
            $data['icon'] = 'fa-map';
            $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
            $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(2);
            $data['perusahaan'] = $this->Perusahaan->AmbilData();
                        
            $this->load->model('Rayon');

            $data['data_tabel'] = $this->Rayon->AmbilDataSemua($status);
            
            if ($status == 'Tidak Aktif') {
                $data['filter'] = true;
            } else {
                $data['filter'] = false;
            }

            $this->load->view('index', $data);
        }
    }
    
    public function DataPenjual() {
        if (substr($this->session->userdata('KPIPelangganAkses'), 0, 2) == 0) {
            $this->Dasbor();
        } else {
            $status = $this->input->post('status');
        
            $data['pesan'] = $this->input->get('pesan');
            $data['up_konten'] = null;
            $data['konten'] = 'Data Penjual';
            $data['icon'] = 'fa-tags';
            $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
            $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(2);
            $data['perusahaan'] = $this->Perusahaan->AmbilData();
                        
            $this->load->model('Penjual');

            $data['data_tabel'] = $this->Penjual->AmbilDataSemua($status);
            
            if ($status == 'Tidak Aktif') {
                $data['filter'] = true;
            } else {
                $data['filter'] = false;
            }
            
            $this->load->view('index', $data);
        }
    }
    
    public function FakturPenjualan() {
        if (substr($this->session->userdata('KPIPelangganAkses'), 7, 2) == 0) {
            $this->Dasbor();
        } else {
            $tanggal_awal = $this->input->post('tanggal_awal');
            $tanggal_akhir = $this->input->post('tanggal_akhir');
            $no_pelanggan = $this->input->post('pelanggan');
            $no_penjual = $this->input->post('penjual');

            $this->load->model('Pelanggan/Pelanggan');
            $this->load->model('Penjualan/PenjualanFaktur');
            $this->load->model('Penjual');

            $data['pesan'] = $this->input->get('pesan');
            $data['up_konten'] = null;
            $data['konten'] = 'Faktur Penjualan';
            $data['icon'] = 'fa-shopping-cart';
            $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
            $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(2);
            $data['perusahaan'] = $this->Perusahaan->AmbilData();

            if (empty($tanggal_awal)) {
                $tanggal_awal = date('d/m/Y', strtotime('-1 day', strtotime(date('Y-m-d'))));
            }

            if (empty($tanggal_akhir)) {
                $tanggal_akhir = date('d/m/Y');
            }

            $data['pelanggan'] = $this->Pelanggan->AmbilDataSemua(null);
            $data['penjual'] = $this->Penjual->AmbilDataSemua(null);
            
            $data['data_tabel'] = $this->PenjualanFaktur->AmbilDataSemua($no_penjual, $no_pelanggan, date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_awal))), date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_akhir))));

            $data['penjual_select'] = $no_penjual;
            $data['pelanggan_select'] = $no_pelanggan;
            $data['tanggal_awal'] = $tanggal_awal;
            $data['tanggal_akhir'] = $tanggal_akhir;
            
            $data['jumlah_nilai_faktur'] = 0;

            $this->load->view('index', $data);
        }
        
    }
    
    public function ReturPenjualan() {
        if (substr($this->session->userdata('KPIPelangganAkses'), 9, 2) == 0) {
            $this->Dasbor();
        } else {
            $tanggal_awal = $this->input->post('tanggal_awal');
            $tanggal_akhir = $this->input->post('tanggal_akhir');
            $no_pelanggan = $this->input->post('pelanggan');
            $no_penjual = $this->input->post('penjual');

            $this->load->model('Pelanggan/Pelanggan');
            $this->load->model('Penjualan/PenjualanRetur');
            $this->load->model('Penjual');

            $data['pesan'] = $this->input->get('pesan');
            $data['up_konten'] = null;
            $data['konten'] = 'Retur Penjualan';
            $data['icon'] = 'fa-shopping-cart';
            $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
            $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(2);
            $data['perusahaan'] = $this->Perusahaan->AmbilData();

            if (empty($tanggal_awal)) {
                $tanggal_awal = date('d/m/Y', strtotime('-1 day', strtotime(date('Y-m-d'))));
            }

            if (empty($tanggal_akhir)) {
                $tanggal_akhir = date('d/m/Y');
            }

            $data['pelanggan'] = $this->Pelanggan->AmbilDataSemua(null);
            $data['penjual'] = $this->Penjual->AmbilDataSemua(null);
            
            $data['data_tabel'] = $this->PenjualanRetur->AmbilDataSemua($no_penjual, $no_pelanggan, date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_awal))), date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_akhir))));

            $data['pelanggan_select'] = $no_pelanggan;
            $data['penjual_select'] = $no_penjual;
            $data['tanggal_awal'] = $tanggal_awal;
            $data['tanggal_akhir'] = $tanggal_akhir;
            
            $data['jumlah_nilai_retur'] = 0;

            $this->load->view('index', $data);
        }
    }
    
    public function LabaKotorPenjualan() {
        if (substr($this->session->userdata('KPIPelangganAkses'), 12, 2) == 0) {
            $this->Dasbor();
        } else {
            $tanggal_awal = $this->input->post('tanggal_awal');
            $tanggal_akhir = $this->input->post('tanggal_akhir');
            $no_pelanggan = $this->input->post('pelanggan');
            $no_penjual = $this->input->post('penjual');

            $this->load->model('Pelanggan/Pelanggan');
            $this->load->model('Penjualan/PenjualanLabaKotor');
            $this->load->model('Penjual');

            $data['pesan'] = $this->input->get('pesan');
            $data['up_konten'] = null;
            $data['konten'] = 'Laba Kotor Penjualan';
            $data['icon'] = 'fa-shopping-cart';
            $data['pengguna'] = $this->Pengguna->MiniProfil($this->session->userdata('Pengguna'));
            $data['aplikasi'] = $this->Aplikasi->AmbilDataSatuan(2);
            $data['perusahaan'] = $this->Perusahaan->AmbilData();

            if (empty($tanggal_awal)) {
                $tanggal_awal = date('d/m/Y', strtotime('-1 day', strtotime(date('Y-m-d'))));
            }

            if (empty($tanggal_akhir)) {
                $tanggal_akhir = date('d/m/Y');
            }

            $data['pelanggan'] = $this->Pelanggan->AmbilDataSemua(null);
            $data['penjual'] = $this->Penjual->AmbilDataSemua(null);
            
            $data['data_tabel'] = $this->PenjualanLabaKotor->AmbilDataSemua($no_penjual, $no_pelanggan, date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_awal))), date('Y-m-d', strtotime(str_replace('/', '-', $tanggal_akhir))));

            $data['pelanggan_select'] = $no_pelanggan;
            $data['penjual_select'] = $no_penjual;
            $data['tanggal_awal'] = $tanggal_awal;
            $data['tanggal_akhir'] = $tanggal_akhir;
            
            $data['total_laba_kotor'] = 0;

            $this->load->view('index', $data);
        }
    }
}

?>