<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unggah extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
	}
    
    public function DataPemasok() {
        $unggah['upload_path']   = 'assets/dist/file/upload/';
        $unggah['allowed_types'] = 'xlsx';
        $unggah['file_name']     = 'DataPemasok';
        $unggah['overwrite']     = true;
        $unggah['max_size']      = 5120;
        
        $this->upload->initialize($unggah);
        
        if ($this->upload->do_upload('unggah')) {
            $file_excel = new unggahexcel('assets/dist/file/upload/DataPemasok.xlsx', null);
            
            if (count($file_excel->Sheets()) == 1) {
                $this->load->model('Pemasok/Pemasok');
                
                $baris = 1;
                
                foreach ($file_excel as $kolom) {
                    if ($baris >= 9) {
                        $this->Pemasok->TambahData($kolom[0], $kolom[1], $kolom[2], $kolom[3], $kolom[4], $kolom[5], $kolom[6], $kolom[7], $kolom[8], $kolom[9], $kolom[10], $kolom[11]);
                    }
                    
                    $baris++;
                }
                
                $status = 'sukses';
            } else {
                $status = 'gagal';
            }
        } else {
            $status = 'gagal';
        }
        
        echo json_encode($status);
        
        unlink('assets/dist/file/upload/DataPemasok.xlsx');
    }
    
    public function PersediaanAkhirPemasok() {
        $unggah['upload_path']   = 'assets/dist/file/upload/';
        $unggah['allowed_types'] = 'xlsx';
        $unggah['file_name']     = 'PersediaanAkhirPemasok';
        $unggah['overwrite']     = true;
        $unggah['max_size']      = 5120;
        
        $this->upload->initialize($unggah);
        
        if ($this->upload->do_upload('unggah')) {
            $file_excel = new unggahexcel('assets/dist/file/upload/PersediaanAkhirPemasok.xlsx', null);
            
            if (count($file_excel->Sheets()) == 1) {
                $this->load->model('Pemasok/PemasokPersediaanAkhir');
                
                $baris = 1;
                
                foreach ($file_excel as $kolom) {
                    if ($baris >= 9) {
                        $this->PemasokPersediaanAkhir->TambahData($kolom[0], $kolom[1], $kolom[2]);
                    }
                    
                    $baris++;
                }
                
                $status = 'sukses';
            } else {
                $status = 'gagal';
            }
        } else {
            $status = 'gagal';
        }
        
        echo json_encode($status);
        
        unlink('assets/dist/file/upload/PersediaanAkhirPemasok.xlsx');
    }
    
    public function PesananPembelian() {
        $unggah['upload_path']   = 'assets/dist/file/upload/';
        $unggah['allowed_types'] = 'xlsx';
        $unggah['file_name']     = 'PesananPembelian';
        $unggah['overwrite']     = true;
        $unggah['max_size']      = 5120;
        
        $this->upload->initialize($unggah);
        
        if ($this->upload->do_upload('unggah')) {
            $file_excel = new unggahexcel('assets/dist/file/upload/PesananPembelian.xlsx', null);
            
            if (count($file_excel->Sheets()) == 1) {
                $this->load->model('Pembelian/PembelianPesanan');
                
                $baris = 1;
                
                foreach ($file_excel as $kolom) {
                    if ($baris >= 9) {
                        $this->PembelianPesanan->TambahData($kolom[0], $kolom[1], $kolom[2], $kolom[3], $kolom[4]);
                    }
                    
                    $baris++;
                }
                
                $status = 'sukses';
            } else {
                $status = 'gagal';
            }
        } else {
            $status = 'gagal';
        }
        
        echo json_encode($status);
        
        unlink('assets/dist/file/upload/PesananPembelian.xlsx');
    }
    
    public function FakturPembelian() {
        $unggah['upload_path']   = 'assets/dist/file/upload/';
        $unggah['allowed_types'] = 'xlsx';
        $unggah['file_name']     = 'FakturPembelian';
        $unggah['overwrite']     = true;
        $unggah['max_size']      = 5120;
        
        $this->upload->initialize($unggah);
        
        if ($this->upload->do_upload('unggah')) {
            $file_excel = new unggahexcel('assets/dist/file/upload/FakturPembelian.xlsx', null);
            
            if (count($file_excel->Sheets()) == 1) {
                $this->load->model('Pembelian/PembelianFaktur');
                
                $baris = 1;
                
                foreach ($file_excel as $kolom) {
                    if ($baris >= 9) {
                        $data = $this->PembelianFaktur->CekPO($kolom[3], $kolom[0], $kolom[4], $kolom[5]);
            
                        if ($data == 'invalid_nilai') {
                            $status = 'gagal';
                        } else {
                            $this->PembelianFaktur->TambahData($kolom[0], $kolom[1], $kolom[2], $kolom[3], $kolom[4], $kolom[5], $data);
                        }
                    }
                    
                    $baris++;
                }
                
                $status = 'sukses';
            } else {
                $status = 'gagal';
            }
        } else {
            $status = 'gagal';
        }
        
        echo json_encode($status);
        
        unlink('assets/dist/file/upload/FakturPembelian.xlsx');
    }
    
    public function ProfitPenjualan() {
        $unggah['upload_path']   = 'assets/dist/file/upload/';
        $unggah['allowed_types'] = 'xlsx';
        $unggah['file_name']     = 'ProfitPenjualan';
        $unggah['overwrite']     = true;
        $unggah['max_size']      = 5120;
        
        $this->upload->initialize($unggah);
        
        if ($this->upload->do_upload('unggah')) {
            $file_excel = new unggahexcel('assets/dist/file/upload/ProfitPenjualan.xlsx', null);
            
            if (count($file_excel->Sheets()) == 1) {
                $this->load->model('Penjualan/PenjualanProfit');
                
                $baris = 1;
                
                foreach ($file_excel as $kolom) {
                    if ($baris >= 9) {
                        $this->PenjualanProfit->TambahData($kolom[0], $kolom[1], $kolom[2], $kolom[3]);
                    }
                    
                    $baris++;
                }
                
                $status = 'sukses';
            } else {
                $status = 'gagal';
            }
        } else {
            $status = 'gagal';
        }
        
        echo json_encode($status);
        
        unlink('assets/dist/file/upload/ProfitPenjualan.xlsx');
    }
}

?>