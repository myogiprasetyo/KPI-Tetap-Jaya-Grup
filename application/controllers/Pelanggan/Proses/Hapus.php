<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hapus extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        
        date_default_timezone_set('Asia/Jakarta');
	}
    
    public function DataPelanggan() {
        $no_pelanggan = $this->input->get('no_pelanggan');
        
        $this->load->model('Pelanggan/Pelanggan');
        
        $data = $this->Pelanggan->HapusData($no_pelanggan);
        
        redirect ('Pelanggan/DataPelanggan?pesan='.$data);
    }
    
    public function TargetPelanggan() {
        $no = $this->input->get('no');
        
        $this->load->model('Pelanggan/PelangganTarget');
        
        $data = $this->PelangganTarget->HapusData($no);
        
        redirect ('Pelanggan/TargetPelanggan?pesan='.$data);
    }
    
    public function PiutangPelanggan() {
        $no = $this->input->get('no');
        
        $this->load->model('Pelanggan/PelangganPiutang');
        
        $data = $this->PelangganPiutang->HapusData($no);
        
        redirect ('Pelanggan/PiutangPelanggan?pesan='.$data);
    }
    
    public function DataRayon() {
        $kode_rayon = $this->input->get('kode_rayon');
        
        $this->load->model('Rayon');
        
        $data = $this->Rayon->HapusData($kode_rayon);
        
        redirect ('Pelanggan/DataRayon?pesan='.$data);
    }
    
    public function DataPenjual() {
        $no_penjual = $this->input->get('no_penjual');
        
        $this->load->model('Penjual');
        
        $data = $this->Penjual->HapusData($no_penjual);
        
        redirect ('Pelanggan/DataPenjual?pesan='.$data);
    }
    
    public function FakturPenjualan() {
        $no_faktur = $this->input->get('no_faktur');
        
        $this->load->model('Penjualan/PenjualanFaktur');
        
        $data = $this->PenjualanFaktur->HapusData($no_faktur);
        
        redirect ('Pelanggan/FakturPenjualan?pesan='.$data);
    }
    
    public function ReturPenjualan() {
        $no_retur = $this->input->get('no_retur');
        
        $this->load->model('Penjualan/PenjualanRetur');
        
        $data = $this->PenjualanRetur->HapusData($no_retur);
        
        redirect ('Pelanggan/ReturPenjualan?pesan='.$data);
    }
    
    public function LabaKotorPenjualan() {
        $no = $this->input->get('no');
        
        $this->load->model('Penjualan/PenjualanLabaKotor');
        
        $data = $this->PenjualanLabaKotor->HapusData($no);
        
        redirect ('Pelanggan/LabaKotorPenjualan?pesan='.$data);
    }
}

?>