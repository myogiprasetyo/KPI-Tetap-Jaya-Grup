<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
    
    public function AmbilDataSemua($status) {
        $this->db->select('NoPelanggan, NamaPelanggan, NoTelepon, AlamatLengkap, KabupatenKota, Provinsi, KodePos, Email, NamaRayon, NamaPenjual, LevelHarga, plnggn__.Keterangan, plnggn__.Status');
        $this->db->from('plnggn__');
        $this->db->join('ryon__', 'plnggn__.Rayon = ryon__.KodeRayon', 'inner');
        $this->db->join('pnjual__', 'plnggn__.Penjual = pnjual__.NoPenjual', 'inner');
        
        if (!($status == 'Tidak Aktif')) {
            $this->db->where('plnggn__.Status', 'Aktif');
        }
        
        $data = $this->db->get()->result();
        
        return $data;
    }
    
    public function AmbilDataSatuan($no_pelanggan) {
        $data = $this->db->get_where('plnggn__', array('NoPelanggan' => $no_pelanggan))->result();
        
        return $data;
    }

    public function TambahData($no_pelanggan, $nama_pelanggan, $no_telepon, $email, $alamat_lengkap, $kabupaten_kota, $provinsi, $kode_pos, $kode_rayon, $no_penjual, $level_harga, $keterangan) {
        $this->db->insert('plnggn__', array('NoPelanggan' => $no_pelanggan, 'NamaPelanggan' => $nama_pelanggan, 'NoTelepon' => '+62 '.$no_telepon, 'Email' => $email, 'AlamatLengkap' => $alamat_lengkap, 'KabupatenKota' => $kabupaten_kota, 'Provinsi' => $provinsi, 'KodePos' => $kode_pos, 'Rayon' => $kode_rayon, 'Penjual' => $no_penjual, 'LevelHarga' => $level_harga, 'Keterangan' => $keterangan, 'Status' => 'Aktif'));
    }
    
    public function UbahData($no_pelanggan, $nama_pelanggan, $no_telepon, $email, $alamat_lengkap, $kabupaten_kota, $provinsi, $kode_pos, $kode_rayon, $no_penjual, $level_harga, $keterangan, $status) {
        if (!empty($nama_pelanggan)) {
            $this->db->set('NamaPelanggan', $nama_pelanggan);
        }
        
        if (!empty($no_telepon)) {
            $this->db->set('NoTelepon', $no_telepon);
        }
        
        if (!empty($email)) {
            $this->db->set('Email', $email);
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
        
        if (!empty($kode_rayon)) {
            $this->db->set('Rayon', $kode_rayon);
        }
        
        if (!empty($no_penjual)) {
            $this->db->set('Penjual', $no_penjual);
        }
        
        if (!empty($level_harga)) {
            $this->db->set('LevelHarga', $level_harga);
        }
        
        if (!empty($keterangan)) {
            $this->db->set('Keterangan', $keterangan);
        }
        
        if (!empty($status)) {
            $this->db->set('Status', $status);
        }
        
        $this->db->where('NoPelanggan', $no_pelanggan);
        $this->db->update('plnggn__');
    }
    
    public function HapusData($no_pelanggan) {
        $this->db->delete('plnggn__', array('NoPelanggan' => $no_pelanggan));

        if ($this->db->affected_rows() > 0) {
            $data = 'Sukses Hapus';
        } else {
            $data = 'Gagal Hapus';
        }
        
        return $data;
    }
}

?>