<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tambah extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        
        date_default_timezone_set('Asia/Jakarta');
	}
    
    public function DataPelanggan() {
        $rules = array(
            ['field' => 'no_pelanggan', 'label' => 'No. Pelanggan', 'rules' => 'required|min_length[9]|is_unique[plnggn__.NoPelanggan]'],
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
            'is_unique'             => '<span class="animated tada help-block fa fa-times-circle-o"> {field} sudah ada</span>',
            'min_length'            => '<span class="animated tada help-block fa fa-times-circle-o"> {field} minimal {param} karakter</span>',
            'required'              => '<span class="animated tada help-block fa fa-times-circle-o"> {field} tidak boleh kosong</span>',
            'alpha_numeric_spaces'  => '<span class="animated tada help-block fa fa-times-circle-o"> {field} hanya dapat di isi Huruf, Angka, dan Spasi</span>',
            'valid_email'           => '<span class="animated tada help-block fa fa-times-circle-o"> {field} tidak valid</span>'
        );
        
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message($message);
        
        if ($this->form_validation->run() == false) {
            $data = array('no_pelanggan' => form_error('no_pelanggan'), 'nama_pelanggan' => form_error('nama_pelanggan'), 'no_telepon' => form_error('no_telepon'), 'email' => form_error('email'), 'alamat' => form_error('alamat'), 'kabupaten_kota' => form_error('kabupaten_kota'), 'provinsi' => form_error('provinsi'), 'rayon' => form_error('rayon'), 'penjual' => form_error('penjual'));

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
            
            $this->load->model('Pelanggan/Pelanggan');
            
            $this->Pelanggan->TambahData($no_pelanggan, $nama_pelanggan, $no_telepon, $email, $alamat_lengkap, $kabupaten_kota, $provinsi, $kode_pos, $kode_rayon, $no_penjual, $level_harga, $keterangan);
            
            echo json_encode('sukses');
        }
    }
    
    public function TargetPelanggan() {
        $rules = array(
            ['field' => 'bulan', 'label' => 'Bulan', 'rules' => 'required'],
            ['field' => 'pelanggan', 'label' => 'Pelanggan', 'rules' => 'required'],
            ['field' => 'penjual', 'label' => 'Penjual', 'rules' => 'required'],
            ['field' => 'target', 'label' => 'Target', 'rules' => 'required']
        );
        
        $message = array(
            'required'  => '<span class="animated tada help-block fa fa-times-circle-o"> {field} tidak boleh kosong</span>'
        );
        
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message($message);
        
        if ($this->form_validation->run() == false) {
            $data = array('bulan' => form_error('bulan'), 'pelanggan' => form_error('pelanggan'), 'penjual' => form_error('penjual'), 'target' => form_error('target'));

            echo json_encode($data);
        } else {
            $bulan = $this->input->post('bulan');
            $no_pelanggan = substr($this->input->post('pelanggan'), 0, 9);
            $no_penjual = substr($this->input->post('penjual'), 0, 3);
            $target = str_replace(',', '.', str_replace('.', '', $this->input->post('target')));
            
            $this->load->model('Pelanggan/PelangganTarget');
            
            $this->PelangganTarget->TambahData($bulan, $no_pelanggan, $no_penjual, $target);
            
            echo json_encode('sukses');
        }
    }
    
    public function PiutangPelanggan() {
        $rules = array(
            ['field' => 'tanggal', 'label' => 'Tanggal', 'rules' => 'required'],
            ['field' => 'pelanggan', 'label' => 'Pelanggan', 'rules' => 'required'],
            ['field' => 'piutang', 'label' => 'Piutang', 'rules' => 'required']
        );
        
        $message = array(
            'required'  => '<span class="animated tada help-block fa fa-times-circle-o"> {field} tidak boleh kosong</span>'
        );
        
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message($message);
        
        if ($this->form_validation->run() == false) {
            $data = array('tanggal' => form_error('tanggal'), 'pelanggan' => form_error('pelanggan'), 'piutang' => form_error('piutang'));

            echo json_encode($data);
        } else {
            $tanggal = date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('tanggal'))));
            $no_pelanggan = substr($this->input->post('pelanggan'), 0, 9);
            $no_penjual = substr($this->input->post('penjual'), 0, 3);
            $piutang = str_replace(',', '.', str_replace('.', '', $this->input->post('piutang')));
            
            $this->load->model('Pelanggan/PelangganPiutang');
            
            $this->PelangganPiutang->TambahData($tanggal, $no_pelanggan, $no_penjual, $piutang);
            
            echo json_encode('sukses');
        }
    }

    
    public function DataRayon() {
        $rules = array(
            ['field' => 'kode_rayon', 'label' => 'Kode Rayon', 'rules' => 'required|min_length[4]|alpha_numeric|is_unique[ryon__.KodeRayon]'],
            ['field' => 'nama_rayon', 'label' => 'Nama Rayon', 'rules' => 'required']
        );
        
        $message = array(
            'is_unique'     => '<span class="animated tada help-block fa fa-times-circle-o"> {field} sudah ada</span>',
            'min_length'    => '<span class="animated tada help-block fa fa-times-circle-o"> {field} minimal {param} karakter</span>',
            'required'      => '<span class="animated tada help-block fa fa-times-circle-o"> {field} tidak boleh kosong</span>',
            'alpha_numeric' => '<span class="animated tada help-block fa fa-times-circle-o"> {field} hanya dapat di isi Huruf dan Angka</span>'
        );
        
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message($message);
        
        if ($this->form_validation->run() == false) {
            $data = array('kode_rayon' => form_error('kode_rayon'), 'nama_rayon' => form_error('nama_rayon'));

            echo json_encode($data);
        } else {
            $kode_rayon = $this->input->post('kode_rayon');
            $nama_rayon = $this->input->post('nama_rayon');
            $keterangan = $this->input->post('keterangan');
            
            $this->load->model('Rayon');
            
            $this->Rayon->TambahData($kode_rayon, $nama_rayon, $keterangan);
            
            echo json_encode('sukses');
        }
    }
    
    public function DataPenjual() {
        $rules = array(
            ['field' => 'no_penjual', 'label' => 'No. Penjual', 'rules' => 'required|min_length[3]|numeric|is_unique[pnjual__.NoPenjual]'],
            ['field' => 'nama_penjual', 'label' => 'Nama Penjual', 'rules' => 'required|alpha_numeric_spaces']
        );
        
        $message = array(
            'is_unique'             => '<span class="animated tada help-block fa fa-times-circle-o"> {field} sudah ada</span>',
            'min_length'            => '<span class="animated tada help-block fa fa-times-circle-o"> {field} minimal {param} karakter</span>',
            'required'              => '<span class="animated tada help-block fa fa-times-circle-o"> {field} tidak boleh kosong</span>',
            'alpha_numeric_spaces'  => '<span class="animated tada help-block fa fa-times-circle-o"> {field} hanya dapat di isi Huruf, Angka, dan Spasi</span>',
            'numeric'               => '<span class="animated tada help-block fa fa-times-circle-o"> {field} hanya dapat di isi Angka</span>'
        );
        
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message($message);
        
        if ($this->form_validation->run() == false) {
            $data = array('no_penjual' => form_error('no_penjual'), 'nama_penjual' => form_error('nama_penjual'));

            echo json_encode($data);
        } else {
            $no_penjual = $this->input->post('no_penjual');
            $nama_penjual = $this->input->post('nama_penjual');
            $keterangan = $this->input->post('keterangan');
            
            $this->load->model('Penjual');
            
            $this->Penjual->TambahData($no_penjual, $nama_penjual, $keterangan);
            
            echo json_encode('sukses');
        }
    }
    
    public function FakturPenjualan() {
        $rules = array(
            ['field' => 'no_faktur', 'label' => 'No. Faktur', 'rules' => 'required|min_length[16]|is_unique[pnjualn_fktr.NoFaktur]'],
            ['field' => 'pelanggan', 'label' => 'Pelanggan', 'rules' => 'required'],
            ['field' => 'penjual', 'label' => 'Penjual', 'rules' => 'required'],
            ['field' => 'nilai_faktur', 'label' => 'Nilai Faktur', 'rules' => 'required']
        );
        
        $message = array(
            'is_unique'     => '<span class="animated tada help-block fa fa-times-circle-o"> {field} sudah ada</span>',
            'min_length'    => '<span class="animated tada help-block fa fa-times-circle-o"> {field} minimal {param} karakter</span>',
            'required'      => '<span class="animated tada help-block fa fa-times-circle-o"> {field} tidak boleh kosong</span>'
        );
        
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message($message);
        
        if ($this->form_validation->run() == false) {
            $data = array('no_faktur' => form_error('no_faktur'), 'pelanggan' => form_error('pelanggan'), 'penjual' => form_error('penjual'), 'nilai_faktur' => form_error('nilai_faktur'));

            echo json_encode($data);
        } else {
            $no_faktur = $this->input->post('no_faktur');
            $tanggal = date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('tanggal'))));
            $no_pelanggan = substr($this->input->post('pelanggan'), 0, 9);
            $no_penjual = substr($this->input->post('penjual'), 0, 3);
            $nilai_faktur = str_replace(',', '.', str_replace('.', '', $this->input->post('nilai_faktur')));
            $keterangan = $this->input->post('keterangan');

            $this->load->model('Penjualan/PenjualanFaktur');
            
            $this->PenjualanFaktur->TambahData($no_faktur, $tanggal, $no_pelanggan, $no_penjual, $nilai_faktur, $keterangan);
                
            echo json_encode('sukses');
        }
    }
    
    public function ReturPenjualan() {
        $rules = array(
            ['field' => 'no_retur', 'label' => 'No. Retur', 'rules' => 'required|min_length[16]|is_unique[pnjualn_rtr.NoRetur]'],
            ['field' => 'pelanggan', 'label' => 'Pelanggan', 'rules' => 'required'],
            ['field' => 'penjual', 'label' => 'Penjual', 'rules' => 'required'],
            ['field' => 'nilai_retur', 'label' => 'Nilai Retur', 'rules' => 'required']
        );
        
        $message = array(
            'is_unique'     => '<span class="animated tada help-block fa fa-times-circle-o"> {field} sudah ada</span>',
            'min_length'    => '<span class="animated tada help-block fa fa-times-circle-o"> {field} minimal {param} karakter</span>',
            'required'      => '<span class="animated tada help-block fa fa-times-circle-o"> {field} tidak boleh kosong</span>'
        );
        
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message($message);
        
        if ($this->form_validation->run() == false) {
            $data = array('no_retur' => form_error('no_retur'), 'pelanggan' => form_error('pelanggan'), 'penjual' => form_error('penjual'), 'nilai_faktur' => form_error('nilai_retur'));

            echo json_encode($data);
        } else {
            $no_retur = $this->input->post('no_retur');
            $tanggal = date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('tanggal'))));
            $no_pelanggan = substr($this->input->post('pelanggan'), 0, 9);
            $no_penjual = substr($this->input->post('penjual'), 0, 3);
            $nilai_retur = str_replace(',', '.', str_replace('.', '', $this->input->post('nilai_retur')));
            $keterangan = $this->input->post('keterangan');

            $this->load->model('Penjualan/PenjualanRetur');
            
            $this->PenjualanRetur->TambahData($no_retur, $tanggal, $no_pelanggan, $no_penjual, $nilai_retur, $keterangan);
                
            echo json_encode('sukses');
        }
    }
    
    public function LabaKotorPenjualan() {
        $rules = array(
            ['field' => 'pelanggan', 'label' => 'Pelanggan', 'rules' => 'required'],
            ['field' => 'penjual', 'label' => 'Penjual', 'rules' => 'required'],
            ['field' => 'laba_kotor', 'label' => 'Laba Kotor', 'rules' => 'required']
        );
        
        $message = array(
            'required'  => '<span class="animated tada help-block fa fa-times-circle-o"> {field} tidak boleh kosong</span>'
        );
        
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message($message);
        
        if ($this->form_validation->run() == false) {
            $data = array('pelanggan' => form_error('pelanggan'), 'penjual' => form_error('penjual'), 'laba_kotor' => form_error('laba_kotor'));

            echo json_encode($data);
        } else {
            $tanggal = date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('tanggal'))));
            $no_pelanggan = substr($this->input->post('pelanggan'), 0, 9);
            $no_penjual = substr($this->input->post('penjual'), 0, 3);
            $laba_kotor = str_replace(',', '.', str_replace('.', '', $this->input->post('laba_kotor')));
            
            $this->load->model('Penjualan/PenjualanLabaKotor');
            
            $this->PenjualanLabaKotor->TambahData($tanggal, $no_pelanggan, $no_penjual, $laba_kotor);
            
            echo json_encode('sukses');
        }
    }
}

?>