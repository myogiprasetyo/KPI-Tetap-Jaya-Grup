<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ubah extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        
        date_default_timezone_set('Asia/Jakarta');
	}
    
    public function DataPemasok() {
        $rules = array(
            ['field' => 'nama_pemasok', 'label' => 'Nama Pemasok', 'rules' => 'required|alpha_numeric_spaces'],
            ['field' => 'no_telepon_1', 'label' => 'No. Telepon', 'rules' => 'required'],
            ['field' => 'email', 'label' => 'E - Mail', 'rules' => 'valid_email'],
            ['field' => 'website', 'label' => 'Website', 'rules' => 'valid_url'],
            ['field' => 'alamat', 'label' => 'Alamat', 'rules' => 'required'],
            ['field' => 'kabupaten_kota', 'label' => 'KabupatenKota', 'rules' => 'required'],
            ['field' => 'provinsi', 'label' => 'Provinsi', 'rules' => 'required']
        );
        
        $message = array(
            'required'              => '<span class="animated tada help-block fa fa-times-circle-o"> {field} tidak boleh kosong</span>',
            'alpha_numeric_spaces'  => '<span class="animated tada help-block fa fa-times-circle-o"> {field} hanya dapat di isi Huruf, Angka, dan Spasi</span>',
            'valid_email'           => '<span class="animated tada help-block fa fa-times-circle-o"> {field} tidak valid</span>',
            'valid_url'             => '<span class="animated tada help-block fa fa-times-circle-o"> {field} tidak valid</span>'
        );
        
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message($message);
        
        if ($this->form_validation->run() == false) {
            $data = array('nama_pemasok' => form_error('nama_pemasok'), 'no_telepon_1' => form_error('no_telepon_1'), 'email' => form_error('email'), 'website' => form_error('website'), 'alamat' => form_error('alamat'), 'kabupaten_kota' => form_error('kabupaten_kota'), 'provinsi' => form_error('provinsi'));

            echo json_encode($data);
        } else {
            $no_pemasok = $this->input->post('no_pemasok');
            $nama_pemasok = $this->input->post('nama_pemasok');
            $no_telepon_1 = '+62'.$this->input->post('no_telepon_1');
            $email = $this->input->post('email');
            $website = $this->input->post('website');
            $alamat_lengkap = $this->input->post('alamat');
            $kabupaten_kota = $this->input->post('kabupaten_kota');
            $provinsi = $this->input->post('provinsi');
            $kode_pos = $this->input->post('kode_pos');
            $nama_kontak = $this->input->post('nama_kontak');
            $no_telepon_2 = '+62'.$this->input->post('no_telepon_2');
            $keterangan = $this->input->post('keterangan');
            $status = $this->input->post('status');
            
            $this->load->model('Pemasok/Pemasok');
            
            $this->Pemasok->UbahData($no_pemasok, $nama_pemasok, $no_telepon_1, $email, $website, $alamat_lengkap, $kabupaten_kota, $provinsi, $kode_pos, $nama_kontak, $no_telepon_2, $keterangan, $status);
            
            echo json_encode('sukses');
        }
    }
    
    public function PesananPembelian() {
        $rules = array(
           ['field' => 'diproses', 'label' => 'Diproses', 'rules' => 'required']
        );
        
        $message = array(
            'required'  => '<span class="animated tada help-block fa fa-times-circle-o"> {field} tidak boleh kosong</span>'
        );
        
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message($message);
        
        if ($this->form_validation->run() == false) {
            $data = array('diproses' => form_error('diproses'));

            echo json_encode($data);
        } else {
            $no_po = $this->input->post('no_po');
            $diproses = str_replace(',', '.', str_replace('.', '', $this->input->post('diproses')));
            $keterangan = $this->input->post('keterangan');
            $status = $this->input->post('status');

            $this->load->model('Pembelian/PembelianPesanan');
            
            $this->PembelianPesanan->UbahData($no_po, $diproses, $keterangan, $status);
            
            echo json_encode('sukses');
        }
    }
    
    public function FakturPembelian() {
        $rules = array(
            ['field' => 'nilai_faktur', 'label' => 'Nilai Faktur', 'rules' => 'required']
        );
        
        $message = array(
            'required'  => '<span class="animated tada help-block fa fa-times-circle-o"> {field} tidak boleh kosong</span>'
        );
        
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message($message);
        
        if ($this->form_validation->run() == false) {
            $data = array('nilai_faktur' => form_error('nilai_faktur'));

            echo json_encode($data);
        } else {
            $no_faktur = $this->input->post('no_faktur');
            $no_po = $this->input->post('no_po');
            $tanggal = date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('tanggal'))));
            $no_pemasok = substr($this->input->post('pemasok'), 0, 3);
            $nilai_faktur = str_replace(',', '.', str_replace('.', '', $this->input->post('nilai_faktur')));
            $keterangan = $this->input->post('keterangan');
            
            $this->load->model('Pembelian/PembelianFaktur');
            
            $data = $this->PembelianFaktur->CekPO($no_po, $no_pemasok, $nilai_faktur, $keterangan);
            
            if ($data == 'invalid_nilai') {
                echo json_encode('invalid_nilai');
            } else {
                $this->FakturPembelian->UbahData($no_faktur, $tanggal, $no_pemasok, $no_po, $nilai_faktur, $keterangan, $terpenuhi, $status);
                
                echo json_encode('sukses');
            }
        }
    }
    
    public function PembayaranPembelian() {
        $rules = array(
            ['field' => 'no_cek', 'label' => 'No. Cek', 'rules' => 'required|min_length[9]|alpha_numeric_spaces']
        );
        
        $message = array(
            'min_length'            => '<span class="help-block fa fa-times-circle-o"> {field} minimal {param} karakter</span>',
            'required'              => '<span class="animated tada help-block fa fa-times-circle-o"> {field} tidak boleh kosong</span>',
            'alpha_numeric_spaces'  => '<span class="animated tada help-block fa fa-times-circle-o"> {field} hanya dapat di isi Huruf, Angka, dan Spasi</span>',
        );
        
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message($message);
        
        if ($this->form_validation->run() == false) {
            $data = array('no_cek' => form_error('no_cek'));

            echo json_encode($data);
        } else {
            $no_pembayaran = $this->input->post('no_pembayaran');
            $tanggal = date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('tanggal'))));
            $no_pemasok = substr($this->input->post('pemasok'), 0, 3);
            $no_cek = $this->input->post('no_cek');
            $tanggal_cek = date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('tanggal_cek'))));
            $keterangan = $this->input->post('keterangan');
            $status = $this->input->post('status');
            
            $this->load->model('Pembelian/PembelianPembayaran');
            
            $this->PembelianPembayaran->UbahData($no_pembayaran, $tanggal, $no_pemasok, $no_cek, $tanggal_cek, $keterangan, $status);
            
            echo json_encode('sukses');
        }
    }
    
    public function ProfitPenjualan() {
        $rules = array(
            ['field' => 'penjualan', 'label' => 'Penjualan', 'rules' => 'required'],
            ['field' => 'laba_kotor', 'label' => 'Laba Kotor', 'rules' => 'required']
        );
        
        $message = array(
            'required'  => '<span class="animated tada help-block fa fa-times-circle-o"> {field} tidak boleh kosong</span>'
        );
        
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message($message);
        
        if ($this->form_validation->run() == false) {
            $data = array('penjualan' => form_error('penjualan'), 'laba_kotor' => form_error('laba_kotor'));

            echo json_encode($data);
        } else {
            $no = $this->input->post('no');
            $tanggal = date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('tanggal'))));
            $no_pemasok = substr($this->input->post('pemasok'), 0, 3);
            $penjualan = str_replace(',', '.', str_replace('.', '', $this->input->post('penjualan')));
            $laba_kotor = str_replace(',', '.', str_replace('.', '', $this->input->post('laba_kotor')));
            
            $this->load->model('Penjualan/PenjualanProfit');
            
            $this->PenjualanProfit->UbahData($no, $tanggal, $no_pemasok, $penjualan, $laba_kotor);
            
            echo json_encode('sukses');
        }
    }
}

?>