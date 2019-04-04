<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemasok extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
    
    public function AmbilDataSemua($status) {
        $this->db->select('*');
        $this->db->from('pmsk__');
        
        if (!($status == 'Tidak Aktif')) {
            $this->db->where('Status', 'Aktif');
        }
        
        $data = $this->db->get()->result();
        
        return $data;
    }
    
    public function AmbilDataSatuan($no_pemasok) {
        $data = $this->db->get_where('pmsk__', array('NoPemasok' => $no_pemasok))->result();
        
        return $data;
    }

    public function TambahData($no_pemasok, $nama_pemasok, $no_telepon_1, $email, $website, $alamat_lengkap, $kabupaten_kota, $provinsi, $kode_pos, $nama_kontak, $no_telepon_2, $keterangan) {
        if ($no_telepon_2 != '') {
            $no_telepon_2 = '+62 '.$no_telepon_2;
        }
            
        $this->db->insert('pmsk__', array('NoPemasok' => $no_pemasok, 'NamaPemasok' => $nama_pemasok, 'NoTelepon1' => '+62 '.$no_telepon_1, 'Email' => $email, 'Website' => $website, 'AlamatLengkap' => $alamat_lengkap, 'KabupatenKota' => $kabupaten_kota, 'Provinsi' => $provinsi, 'KodePos' => $kode_pos, 'NamaKontak' => $nama_kontak, 'NoTelepon2' => $no_telepon_2,  'SaldoAwal' => 0.00, 'Keterangan' => $keterangan, 'Status' => 'Aktif'));
    }
    
    public function UbahData($no_pemasok, $nama_pemasok, $no_telepon_1, $email, $website, $alamat_lengkap, $kabupaten_kota, $provinsi, $kode_pos, $nama_kontak, $no_telepon_2, $keterangan, $status) {
        if (!empty($nama_pemasok)) {
            $this->db->set('NamaPemasok', $nama_pemasok);
        }
        
        if (!empty($no_telepon_1)) {
            $this->db->set('NoTelepon1', $no_telepon_1);
        }
        
        if (!empty($email)) {
            $this->db->set('Email', $email);
        }
        
        if (!empty($website)) {
            $this->db->set('Website', $website);
        }
        
        if (!empty($alamat_lengkap)) {
            $this->db->set('AlamatLengkap', $alamat_lengkap);
        }
        
        if (!empty($kabupaten_kota)) {
            $this->db->set('KabupatenKota', $kabupaten_kota);
        }
        
        if (!empty($provinsi)) {
            $this->db->set('Provinsi', $provinsi);
        }
        
        if (!empty($kode_pos)) {
            $this->db->set('KodePos', $kode_pos);
        }
        
        if (!empty($nama_kontak)) {
            $this->db->set('NamaKontak', $nama_kontak);
        }
        
        if (!empty($no_telepon_2)) {
            $this->db->set('NoTelepon2', $no_telepon_2);
        }
        
        if (!empty($keterangan)) {
            $this->db->set('Keterangan', $keterangan);
        }
        
        if (!empty($status)) {
            $this->db->set('Status', $status);
        }
        
        $this->db->where('NoPemasok', $no_pemasok);
        $this->db->update('pmsk__');
    }
    
    public function HapusData($no_pemasok) {
        $this->db->delete('pmsk__', array('NoPemasok' => $no_pemasok));

        if ($this->db->affected_rows() > 0) {
            $data = 'Sukses Hapus';
        } else {
            $data = 'Gagal Hapus';
        }
        
        return $data;
    }
}

?>