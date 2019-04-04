<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tambah extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        
        date_default_timezone_set('Asia/Jakarta');
	}
    
    public function DataPemasok() {
        $rules = array(
            ['field' => 'no_pemasok', 'label' => 'No. Pemasok', 'rules' => 'required|min_length[3]|alpha_numeric|is_unique[pmsk__.NoPemasok]'],
            ['field' => 'nama_pemasok', 'label' => 'Nama Pemasok', 'rules' => 'required|alpha_numeric_spaces'],
            ['field' => 'no_telepon_1', 'label' => 'No. Telepon', 'rules' => 'required'],
            ['field' => 'email', 'label' => 'E - Mail', 'rules' => 'valid_email'],
            ['field' => 'website', 'label' => 'Website', 'rules' => 'valid_url'],
            ['field' => 'alamat', 'label' => 'Alamat', 'rules' => 'required'],
            ['field' => 'kabupaten_kota', 'label' => 'KabupatenKota', 'rules' => 'required'],
            ['field' => 'provinsi', 'label' => 'Provinsi', 'rules' => 'required']
        );
        
        $message = array(
            'is_unique'             => '<span class="animated tada help-block fa fa-times-circle-o"> {field} sudah ada</span>',
            'min_length'            => '<span class="animated tada help-block fa fa-times-circle-o"> {field} minimal {param} karakter</span>',
            'required'              => '<span class="animated tada help-block fa fa-times-circle-o"> {field} tidak boleh kosong</span>',
            'alpha_numeric'         => '<span class="animated tada help-block fa fa-times-circle-o"> {field} hanya dapat di isi Huruf dan Angka</span>',
            'alpha_numeric_spaces'  => '<span class="animated tada help-block fa fa-times-circle-o"> {field} hanya dapat di isi Huruf, Angka, dan Spasi</span>',
            'valid_email'           => '<span class="animated tada help-block fa fa-times-circle-o"> {field} tidak valid</span>',
            'valid_url'             => '<span class="animated tada help-block fa fa-times-circle-o"> {field} tidak valid</span>'
        );
        
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message($message);
        
        if ($this->form_validation->run() == false) {
            $data = array('no_pemasok' => form_error('no_pemasok'), 'nama_pemasok' => form_error('nama_pemasok'), 'no_telepon_1' => form_error('no_telepon_1'), 'email' => form_error('email'), 'website' => form_error('website'), 'alamat' => form_error('alamat'), 'kabupaten_kota' => form_error('kabupaten_kota'), 'provinsi' => form_error('provinsi'));

            echo json_encode($data);
        } else {
            $no_pemasok = $this->input->post('no_pemasok');
            $nama_pemasok = $this->input->post('nama_pemasok');
            $no_telepon_1 = $this->input->post('no_telepon_1');
            $email = $this->input->post('email');
            $website = $this->input->post('website');
            $alamat_lengkap = $this->input->post('alamat');
            $kabupaten_kota = $this->input->post('kabupaten_kota');
            $provinsi = $this->input->post('provinsi');
            $kode_pos = $this->input->post('kode_pos');
            $nama_kontak = $this->input->post('nama_kontak');
            $no_telepon_2 = $this->input->post('no_telepon_2');
            $keterangan = $this->input->post('keterangan');
            
            $this->load->model('Pemasok/Pemasok');
            
            $this->Pemasok->TambahData($no_pemasok, $nama_pemasok, $no_telepon_1, $email, $website, $alamat_lengkap, $kabupaten_kota, $provinsi, $kode_pos, $nama_kontak, $no_telepon_2, $keterangan);
            
            echo json_encode('sukses');
        }
    }
    
    public function PersediaanAkhirPemasok() {
        $rules = array(
            ['field' => 'pemasok', 'label' => 'Pemasok', 'rules' => 'required'],
            ['field' => 'persediaan_akhir', 'label' => 'Persediaan Akhir', 'rules' => 'required']
        );
        
        $message = array(
            'required'  => '<span class="animated tada help-block fa fa-times-circle-o"> {field} tidak boleh kosong</span>'
        );
        
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message($message);
        
        if ($this->form_validation->run() == false) {
            $data = array('pemasok' => form_error('pemasok'), 'persediaan_akhir' => form_error('persediaan_akhir'));

            echo json_encode($data);
        } else {
            $tanggal = date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('tanggal'))));
            $no_pemasok = substr($this->input->post('pemasok'), 0, 3);
            $persediaan_akhir = str_replace(',', '.', str_replace('.', '', $this->input->post('persediaan_akhir')));
            
            $this->load->model('Pemasok/PemasokPersediaanAkhir');
            
            $this->PemasokPersediaanAkhir->TambahData($tanggal, $no_pemasok, $persediaan_akhir);
            
            echo json_encode('sukses');
        }
    }
    
    public function PesananPembelian() {
        $rules = array(
            ['field' => 'no_po', 'label' => 'No. PO', 'rules' => 'required|min_length[15]|alpha_numeric|is_unique[pmblan_psn.NoPO]'],
            ['field' => 'pemasok', 'label' => 'Pemasok', 'rules' => 'required'],
            ['field' => 'jumlah', 'label' => 'Jumlah', 'rules' => 'required']
        );
        
        $message = array(
            'is_unique'     => '<span class="animated tada help-block fa fa-times-circle-o"> {field} sudah ada</span>',
            'min_length'    => '<span class="animated tada help-block fa fa-times-circle-o"> {field} minimal {param} karakter</span>',
            'required'      => '<span class="animated tada help-block fa fa-times-circle-o"> {field} tidak boleh kosong</span>',
            'alpha_numeric' => '<span class="animated tada help-block fa fa-times-circle-o"> {field} hanya dapat di isi Huruf dan Angka</span>',
        );
        
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message($message);
        
        if ($this->form_validation->run() == false) {
            $data = array('no_po' => form_error('no_po'), 'pemasok' => form_error('pemasok'), 'jumlah' => form_error('jumlah'));

            echo json_encode($data);
        } else {
            $no_po = $this->input->post('no_po');
            $tanggal = date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('tanggal'))));
            $no_pemasok = substr($this->input->post('pemasok'), 0, 3);
            $jumlah = str_replace(',', '.', str_replace('.', '', $this->input->post('jumlah')));
            $keterangan = $this->input->post('keterangan');
            
            $this->load->model('Pembelian/PembelianPesanan');
            
            $this->PembelianPesanan->TambahData($no_po, $tanggal, $no_pemasok, $jumlah, $keterangan);
            
            echo json_encode('sukses');
        }
    }
    
    public function FakturPembelian() {
        $rules = array(
            ['field' => 'no_faktur', 'label' => 'No. Faktur', 'rules' => 'required|min_length[15]|alpha_numeric|is_unique[pmblan_fktr.NoFaktur]'],
            ['field' => 'pemasok', 'label' => 'Pemasok', 'rules' => 'required'],
            ['field' => 'nilai_faktur', 'label' => 'Nilai Faktur', 'rules' => 'required'],
            ['field' => 'no_po', 'label' => 'No. PO', 'rules' => 'required']
        );
        
        $message = array(
            'is_unique'     => '<span class="animated tada help-block fa fa-times-circle-o"> {field} sudah ada</span>',
            'min_length'    => '<span class="animated tada help-block fa fa-times-circle-o"> {field} minimal {param} karakter</span>',
            'required'      => '<span class="animated tada help-block fa fa-times-circle-o"> {field} tidak boleh kosong</span>',
            'alpha_numeric' => '<span class="animated tada help-block fa fa-times-circle-o"> {field} hanya dapat di isi Huruf dan Angka</span>',
        );
        
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message($message);
        
        if ($this->form_validation->run() == false) {
            $data = array('no_faktur' => form_error('no_faktur'), 'pemasok' => form_error('pemasok'), 'nilai_faktur' => form_error('nilai_faktur'), 'no_po' => form_error('no_po') );

            echo json_encode($data);
        } else {
            $no_faktur = $this->input->post('no_faktur');
            $tanggal = date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('tanggal'))));
            $no_pemasok = substr($this->input->post('pemasok'), 0, 3);
            $no_po = $this->input->post('no_po');
            $nilai_faktur = str_replace(',', '.', str_replace('.', '', $this->input->post('nilai_faktur')));
            $keterangan = $this->input->post('keterangan');

            $this->load->model('Pembelian/PembelianFaktur');
            
            $data = $this->PembelianFaktur->CekPO($no_po, $no_pemasok, $nilai_faktur, $keterangan);
            
            if ($data == 'invalid_nilai') {
                echo json_encode('invalid_nilai');
            } else {
                $this->PembelianFaktur->TambahData($no_faktur, $tanggal, $no_pemasok, $no_po, $nilai_faktur, $keterangan, $data);
                
                echo json_encode('sukses');
            }
        }
    }
    
    public function PembayaranPembelian() {
        $rules = array(
            ['field' => 'no_pembayaran', 'label' => 'No. Pembayaran', 'rules' => 'required|min_length[15]|alpha_numeric|is_unique[pmblan_byr.NoPembayaran]'],
            ['field' => 'pemasok', 'label' => 'Pemasok', 'rules' => 'required'],
            ['field' => 'total_faktur', 'label' => 'Total Faktur', 'rules' => 'required'],
            ['field' => 'no_cek', 'label' => 'No. Cek', 'rules' => 'required|min_length[9]|alpha_numeric_spaces|is_unique[pmblan_byr.NoCek]']
        );
        
        $message = array(
            'is_unique'             => '<span class="animated tada help-block fa fa-times-circle-o"> {field} sudah ada</span>',
            'min_length'            => '<span class="animated tada help-block fa fa-times-circle-o"> {field} minimal {param} karakter</span>',
            'required'              => '<span class="animated tada help-block fa fa-times-circle-o"> {field} tidak boleh kosong</span>',
            'alpha_numeric'         => '<span class="animated tada help-block fa fa-times-circle-o"> {field} hanya dapat di isi Huruf dan Angka</span>',
            'alpha_numeric_spaces'  => '<span class="animated tada help-block fa fa-times-circle-o"> {field} hanya dapat di isi Huruf, Angka, dan Spasi</span>',
        );
        
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message($message);
        
        if ($this->form_validation->run() == false) {
            $data = array('no_pembayaran' => form_error('no_pembayaran'), 'pemasok' => form_error('pemasok'), 'total_faktur' => form_error('total_faktur'), 'no_cek' => form_error('no_cek'));

            echo json_encode($data);
        } else {
            $no_pembayaran = $this->input->post('no_pembayaran');
            $tanggal = date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('tanggal'))));
            $no_pemasok = substr($this->input->post('pemasok'), 0, 3);
            $no_faktur = $this->input->post('no_faktur');
            $total_faktur = str_replace(',', '.', str_replace('.', '', $this->input->post('total_faktur')));
            $no_cek = $this->input->post('no_cek');
            $tanggal_cek = date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('tanggal_cek'))));
            $keterangan = $this->input->post('keterangan');
            
            $this->load->model('Pembelian/PembelianPembayaran');
            
            $this->PembelianPembayaran->TambahData($no_pembayaran, $tanggal, $no_pemasok, $no_faktur, $total_faktur, $no_cek, $tanggal_cek, $keterangan);
            
            echo json_encode('sukses');
        }
    }
    
    public function ProfitPenjualan() {
        $rules = array(
            ['field' => 'pemasok', 'label' => 'Pemasok', 'rules' => 'required'],
            ['field' => 'penjualan', 'label' => 'Penjualan', 'rules' => 'required'],
            ['field' => 'laba_kotor', 'label' => 'Laba Kotor', 'rules' => 'required']
        );
        
        $message = array(
            'required'  => '<span class="animated tada help-block fa fa-times-circle-o"> {field} tidak boleh kosong</span>'
        );
        
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message($message);
        
        if ($this->form_validation->run() == false) {
            $data = array('pemasok' => form_error('pemasok'), 'penjualan' => form_error('penjualan'), 'laba_kotor' => form_error('laba_kotor'));

            echo json_encode($data);
        } else {
            $no_pemasok = substr($this->input->post('pemasok'), 0, 3);
            $tanggal = date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('tanggal'))));
            $penjualan = str_replace(',', '.', str_replace('.', '', $this->input->post('penjualan')));
            $laba_kotor = str_replace(',', '.', str_replace('.', '', $this->input->post('laba_kotor')));
            
            $this->load->model('Penjualan/PenjualanProfit');
            
            $this->PenjualanProfit->TambahData($tanggal, $no_pemasok, $penjualan, $laba_kotor);
            
            echo json_encode('sukses');
        }
    }
}

?>