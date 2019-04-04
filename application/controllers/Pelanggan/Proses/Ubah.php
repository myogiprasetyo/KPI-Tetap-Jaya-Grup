<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ubah extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        
        date_default_timezone_set('Asia/Jakarta');
	}
    
    public function DataPelanggan() {
        $rules = array(
            ['field' => 'nama_pelanggan', 'label' => 'Nama Pelanggan', 'rules' => 'required|alpha_numeric_spaces'],
            ['field' => 'no_telepon', 'label' => 'No. Telepon', 'rules' => 'required'],
            ['field' => 'email', 'label' => 'E - Mail', 'rules' => 'valid_email'],
            ['field' => 'alamat', 'label' => 'Alamat', 'rules' => 'required'],
            ['field' => 'kabupaten_kota', 'label' => 'Kabupaten Kota', 'rules' => 'required'],
            ['field' => 'provinsi', 'label' => 'Provinsi', 'rules' => 'required'],
            ['field' => 'rayon', 'label' => 'Rayon', 'rules' => 'required'],
            ['field' => 'penjual', 'label' => 'Penjual', 'rules' => 'required']
        );
        
        $message = array(
            'required'              => '<span class="animated tada help-block fa fa-times-circle-o"> {field} tidak boleh kosong</span>',
            'alpha_numeric'         => '<span class="animated tada help-block fa fa-times-circle-o"> {field} hanya dapat di isi Huruf dan Angka</span>',
            'alpha_numeric_spaces'  => '<span class="animated tada help-block fa fa-times-circle-o"> {field} hanya dapat di isi Huruf, Angka, dan Spasi</span>',
            'valid_email'           => '<span class="animated tada help-block fa fa-times-circle-o"> {field} tidak valid</span>'
        );
        
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message($message);
        
        if ($this->form_validation->run() == false) {
            $data = array('nama_pelanggan' => form_error('nama_pelanggan'), 'no_telepon' => form_error('no_telepon'), 'email' => form_error('email'), 'alamat' => form_error('alamat'), 'kabupaten_kota' => form_error('kabupaten_kota'), 'provinsi' => form_error('provinsi'), 'rayon' => form_error('rayon'), 'penjual' => form_error('penjual'));

            echo json_encode($data);
        } else {
            $no_pelanggan = $this->input->post('no_pelanggan');
            $nama_pelanggan = $this->input->post('nama_pelanggan');
            $no_telepon = $this->input->post('no_telepon');
            $email = $this->input->post('email');
            $alamat_lengkap = $this->input->post('alamat');
            $kabupaten_kota = $this->input->post('kabupaten_kota');
            $provinsi = $this->input->post('provinsi');
            $kode_pos = $this->input->post('kode_pos');
            $kode_rayon = substr($this->input->post('rayon'), 0, 4);
            $no_penjual = substr($this->input->post('penjual'), 0, 3);
            $level_harga = $this->input->post('level_harga');
            $keterangan = $this->input->post('keterangan');
            $status = $this->input->post('status');
            
            $this->load->model('Pelanggan/Pelanggan');
            
            $this->Pelanggan->UbahData($no_pelanggan, $nama_pelanggan, $no_telepon, $email, $alamat_lengkap, $kabupaten_kota, $provinsi, $kode_pos, $kode_rayon, $no_penjual, $level_harga, $keterangan, $status);
            
            echo json_encode('sukses');
        }
    }
    
    public function TargetPelanggan() {
        $rules = array(
            ['field' => 'target', 'label' => 'Target', 'rules' => 'required']
        );
        
        $message = array(
            'required'  => '<span class="animated tada help-block fa fa-times-circle-o"> {field} tidak boleh kosong</span>'
        );
        
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message($message);
        
        if ($this->form_validation->run() == false) {
            $data = array('target' => form_error('target'));

            echo json_encode($data);
        } else {
            $no = $this->input->post('no');
            $target = str_replace(',', '.', str_replace('.', '', $this->input->post('target')));
            
            $this->load->model('Pelanggan/PelangganTarget');
            
            $this->PelangganTarget->UbahData($no, $no_penjual, $target);
            
            echo json_encode('sukses');
        }
    }
    
    public function PiutangPelanggan() {
        $rules = array(
            ['field' => 'piutang', 'label' => 'Piutang', 'rules' => 'required']
        );
        
        $message = array(
            'required'  => '<span class="animated tada help-block fa fa-times-circle-o"> {field} tidak boleh kosong</span>'
        );
        
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message($message);
        
        if ($this->form_validation->run() == false) {
            $data = array('piutang' => form_error('piutang'));

            echo json_encode($data);
        } else {
            $no = $this->input->post('no');
            $piutang = str_replace(',', '.', str_replace('.', '', $this->input->post('piutang')));
            
            $this->load->model('Pelanggan/PelangganPiutang');
            
            $this->PelangganPiutang->UbahData($no, $piutang);
            
            echo json_encode('sukses');
        }
    }

    
    public function DataRayon() {
        $rules = array(
            ['field' => 'nama_rayon', 'label' => 'Nama Rayon', 'rules' => 'required']
        );
        
        $message = array(
            'required'  => '<span class="animated tada help-block fa fa-times-circle-o"> {field} tidak boleh kosong</span>'
        );
        
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message($message);
        
        if ($this->form_validation->run() == false) {
            $data = array( 'nama_rayon' => form_error('nama_rayon'));

            echo json_encode($data);
        } else {
            $kode_rayon = $this->input->post('kode_rayon');
            $nama_rayon = $this->input->post('nama_rayon');
            $keterangan = $this->input->post('keterangan');
            
            $this->load->model('Rayon');
            
            $this->Rayon->UbahData($kode_rayon, $nama_rayon, $keterangan);
            
            echo json_encode('sukses');
        }
    }
    
    public function DataPenjual() {
        $rules = array(
            ['field' => 'nama_penjual', 'label' => 'Nama Penjual', 'rules' => 'required|alpha_numeric_spaces']
        );
        
        $message = array(
            'required'  => '<span class="animated tada help-block fa fa-times-circle-o"> {field} tidak boleh kosong</span>'
        );
        
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message($message);
        
        if ($this->form_validation->run() == false) {
            $data = array('nama_penjual' => form_error('nama_penjual'));

            echo json_encode($data);
        } else {
            $no_penjual = $this->input->post('no_penjual');
            $nama_penjual = $this->input->post('nama_penjual');
            $keterangan = $this->input->post('keterangan');
            
            $this->load->model('Penjual');
            
            $this->Penjual->UbahData($no_penjual, $nama_penjual, $keterangan);
            
            echo json_encode('sukses');
        }
    }
    
    public function FakturPenjualan() {
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
            $nilai_faktur = str_replace(',', '.', str_replace('.', '', $this->input->post('nilai_faktur')));
            $keterangan = $this->input->post('keterangan');

            $this->load->model('Penjualan/PenjualanFaktur');
            
            $this->PenjualanFaktur->UbahData($no_faktur, $nilai_faktur, $keterangan);
                
            echo json_encode('sukses');
        }
    }
    
    public function ReturPenjualan() {
        $rules = array(
            ['field' => 'nilai_retur', 'label' => 'Nilai Retur', 'rules' => 'required']
        );
        
        $message = array(
            'required'  => '<span class="animated tada help-block fa fa-times-circle-o"> {field} tidak boleh kosong</span>'
        );
        
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message($message);
        
        if ($this->form_validation->run() == false) {
            $data = array('nilai_faktur' => form_error('nilai_retur'));

            echo json_encode($data);
        } else {
            $no_retur = $this->input->post('no_retur');
            $nilai_retur = str_replace(',', '.', str_replace('.', '', $this->input->post('nilai_retur')));
            $keterangan = $this->input->post('keterangan');

            $this->load->model('Penjualan/PenjualanRetur');
            
            $this->PenjualanRetur->UbahData($no_retur, $nilai_retur, $keterangan);
                
            echo json_encode('sukses');
        }
    }
    
    public function LabaKotorPenjualan() {
        $rules = array(
            ['field' => 'laba_kotor', 'label' => 'Laba Kotor', 'rules' => 'required']
        );
        
        $message = array(
            'required'  => '<span class="animated tada help-block fa fa-times-circle-o"> {field} tidak boleh kosong</span>'
        );
        
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message($message);
        
        if ($this->form_validation->run() == false) {
            $data = array('laba_kotor' => form_error('laba_kotor'));

            echo json_encode($data);
        } else {
            $no = $this->input->post('no');
            $no_penjual = substr($this->input->post('penjual'), 0, 3);
            $laba_kotor = str_replace(',', '.', str_replace('.', '', $this->input->post('laba_kotor')));
            
            $this->load->model('Penjualan/PenjualanLabaKotor');
            
            $this->PenjualanLabaKotor->UbahData($no, $no_penjual, $laba_kotor);
            
            echo json_encode('sukses');
        }
    }
}

?>