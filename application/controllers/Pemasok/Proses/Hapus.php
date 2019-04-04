<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hapus extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        
        date_default_timezone_set('Asia/Jakarta');
	}
    
    public function DataPemasok() {
        $no_pemasok = $this->input->get('no_pemasok');
        
        $this->load->model('Pemasok/Pemasok');
        
        $data = $this->Pemasok->HapusData($no_pemasok);
        
        redirect ('Pemasok/DataPemasok?pesan='.$data);
    }
    
    public function PersediaanAkhirPemasok() {
        $no_pemasok = $this->input->get('no_pemasok');
        
        $this->load->model('Pemasok/PemasokPersediaanAkhir');
        
        $data = $this->PemasokPersediaanAkhir->HapusData($no_pemasok);
        
        redirect ('Pemasok/PersediaanAkhirPemasok?pesan='.$data);
    }
    
    public function PesananPembelian() {
        $no_po = $this->input->get('no_po');
        
        $this->load->model('Pembelian/PembelianPesanan');
        
        $data = $this->PembelianPesanan->HapusData($no_po);
        
        redirect ('Pemasok/PesananPembelian?pesan='.$data);
    }
    
    public function FakturPembelian() {
        $no_faktur = $this->input->get('no_faktur');
        
        $this->load->model('Pembelian/PembelianFaktur');
        
        $data = $this->PembelianFaktur->HapusData($no_faktur);
        
        redirect ('Pemasok/FakturPembelian?pesan='.$data);
    }
   
    public function PembayaranPembelian() {
        $no_pembayaran = $this->input->get('no_pembayaran');
        
        $this->load->model('Pembelian/PembelianPembayaran');
        
        $data = $this->PembelianPembayaran->HapusData($no_pembayaran);
        
        redirect ('Pemasok/PembayaranPembelian?pesan='.$data);
    }
    
    public function ProfitPenjualan() {
        $no = $this->input->get('no');
        
        $this->load->model('Penjualan/PenjualanProfit');
        
        $data = $this->PenjualanProfit->HapusData($no);
        
        redirect ('Pemasok/ProfitPenjualan?pesan='.$data);
    }
}

?>