<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unggah extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
	}
    
    public function DataPelanggan() {
        $unggah['upload_path']   = 'assets/dist/file/upload/';
        $unggah['allowed_types'] = 'xlsx';
        $unggah['file_name']     = 'DataPelanggan';
        $unggah['overwrite']     = true;
        $unggah['max_size']      = 5120;
        
        $this->upload->initialize($unggah);
        
        if ($this->upload->do_upload('unggah')) {
            $file_excel = new unggahexcel('assets/dist/file/upload/DataPelanggan.xlsx', null);
            
            if (count($file_excel->Sheets()) == 1) {
                $this->load->model('Pelanggan/Pelanggan');
                
                $baris = 1;
                
                foreach ($file_excel as $kolom) {
                    if ($baris >= 9) {
                        $this->Pelanggan->TambahData($kolom[0], $kolom[1], $kolom[2], $kolom[3], $kolom[4], $kolom[5], $kolom[6], $kolom[7], $kolom[8], $kolom[9], $kolom[10], $kolom[11]);
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
        
        unlink('assets/dist/file/upload/DataPelanggan.xlsx');
    }
    
    public function TargetPelanggan() {
        $unggah['upload_path']   = 'assets/dist/file/upload/';
        $unggah['allowed_types'] = 'xlsx';
        $unggah['file_name']     = 'TargetPelanggan';
        $unggah['overwrite']     = true;
        $unggah['max_size']      = 5120;
        
        $this->upload->initialize($unggah);
        
        if ($this->upload->do_upload('unggah')) {
            $file_excel = new unggahexcel('assets/dist/file/upload/TargetPelanggan.xlsx', null);
            
            if (count($file_excel->Sheets()) == 1) {
                $this->load->model('Pelanggan/PelangganTarget');
                
                $baris = 1;
                
                foreach ($file_excel as $kolom) {
                    if ($baris >= 9) {
                        $this->PelangganTarget->TambahData($kolom[0], $kolom[1], $kolom[2], $kolom[3]);
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
        
        unlink('assets/dist/file/upload/TargetPelanggan.xlsx');
    }
    
    public function PiutangPelanggan() {
        $unggah['upload_path']   = 'assets/dist/file/upload/';
        $unggah['allowed_types'] = 'xlsx';
        $unggah['file_name']     = 'PiutangPelanggan';
        $unggah['overwrite']     = true;
        $unggah['max_size']      = 5120;
        
        $this->upload->initialize($unggah);
        
        if ($this->upload->do_upload('unggah')) {
            $file_excel = new unggahexcel('assets/dist/file/upload/PiutangPelanggan.xlsx', null);
            
            if (count($file_excel->Sheets()) == 1) {
                $this->load->model('Pelanggan/PelangganPiutang');
                
                $baris = 1;
                
                foreach ($file_excel as $kolom) {
                    if ($baris >= 9) {
                        $this->PelangganPiutang->TambahData($kolom[0], $kolom[1], $kolom[2], $kolom[3]);
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
        
        unlink('assets/dist/file/upload/PiutangPelanggan.xlsx');
    }
    
    public function DataRayon() {
        $unggah['upload_path']   = 'assets/dist/file/upload/';
        $unggah['allowed_types'] = 'xlsx';
        $unggah['file_name']     = 'DataRayon';
        $unggah['overwrite']     = true;
        $unggah['max_size']      = 5120;
        
        $this->upload->initialize($unggah);
        
        if ($this->upload->do_upload('unggah')) {
            $file_excel = new unggahexcel('assets/dist/file/upload/DataRayon.xlsx', null);
            
            if (count($file_excel->Sheets()) == 1) {
                $this->load->model('Rayon');
                
                $baris = 1;
                
                foreach ($file_excel as $kolom) {
                    if ($baris >= 8) {
                        $this->Rayon->TambahData($kolom[0], $kolom[1], $kolom[2]);
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
        
        unlink('assets/dist/file/upload/DataRayon.xlsx');
    }
    
    public function DataPenjual() {
        $unggah['upload_path']   = 'assets/dist/file/upload/';
        $unggah['allowed_types'] = 'xlsx';
        $unggah['file_name']     = 'DataPenjual';
        $unggah['overwrite']     = true;
        $unggah['max_size']      = 5120;
        
        $this->upload->initialize($unggah);
        
        if ($this->upload->do_upload('unggah')) {
            $file_excel = new unggahexcel('assets/dist/file/upload/DataPenjual.xlsx', null);
            
            if (count($file_excel->Sheets()) == 1) {
                $this->load->model('Penjual');
                
                $baris = 1;
                
                foreach ($file_excel as $kolom) {
                    if ($baris >= 8) {
                        $this->Penjual->TambahData($kolom[0], $kolom[1], $kolom[2]);
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
        
        unlink('assets/dist/file/upload/DataPenjual.xlsx');
    }
    
    public function FakturPenjualan() {
        $unggah['upload_path']   = 'assets/dist/file/upload/';
        $unggah['allowed_types'] = 'xlsx';
        $unggah['file_name']     = 'FakturPenjualan';
        $unggah['overwrite']     = true;
        $unggah['max_size']      = 5120;
        
        $this->upload->initialize($unggah);
        
        if ($this->upload->do_upload('unggah')) {
            $file_excel = new unggahexcel('assets/dist/file/upload/FakturPenjualan.xlsx', null);
            
            if (count($file_excel->Sheets()) == 1) {
                $this->load->model('Penjualan/PenjualanFaktur');
                
                $baris = 1;
                
                foreach ($file_excel as $kolom) {
                    if ($baris >= 9) {
                        $this->PenjualanFaktur->TambahData($kolom[0], $kolom[1], $kolom[2], $kolom[3], $kolom[4], $kolom[5]);
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
        
        unlink('assets/dist/file/upload/FakturPenjualan.xlsx');
    }
    
    public function ReturPenjualan() {
        $unggah['upload_path']   = 'assets/dist/file/upload/';
        $unggah['allowed_types'] = 'xlsx';
        $unggah['file_name']     = 'ReturPenjualan';
        $unggah['overwrite']     = true;
        $unggah['max_size']      = 5120;
        
        $this->upload->initialize($unggah);
        
        if ($this->upload->do_upload('unggah')) {
            $file_excel = new unggahexcel('assets/dist/file/upload/ReturPenjualan.xlsx', null);
            
            if (count($file_excel->Sheets()) == 1) {
                $this->load->model('Penjualan/PenjualanRetur');
                
                $baris = 1;
                
                foreach ($file_excel as $kolom) {
                    if ($baris >= 9) {
                        $this->PenjualanRetur->TambahData($kolom[0], $kolom[1], $kolom[2], $kolom[3], $kolom[4], $kolom[5]);
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
        
        unlink('assets/dist/file/upload/ReturPenjualan.xlsx');
    }
    
    public function LabaKotorPenjualan() {
        $unggah['upload_path']   = 'assets/dist/file/upload/';
        $unggah['allowed_types'] = 'xlsx';
        $unggah['file_name']     = 'LabaKotorPenjualan';
        $unggah['overwrite']     = true;
        $unggah['max_size']      = 5120;
        
        $this->upload->initialize($unggah);
        
        if ($this->upload->do_upload('unggah')) {
            $file_excel = new unggahexcel('assets/dist/file/upload/LabaKotorPenjualan.xlsx', null);
            
            if (count($file_excel->Sheets()) == 1) {
                $this->load->model('Penjualan/PenjualanLabaKotor');
                
                $baris = 1;
                
                foreach ($file_excel as $kolom) {
                    if ($baris >= 9) {
                        $this->PenjualanLabaKotor->TambahData($kolom[0], $kolom[1], $kolom[2], $kolom[3]);
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
        
        unlink('assets/dist/file/upload/LabaKotorPenjualan.xlsx');
    }
}

?>