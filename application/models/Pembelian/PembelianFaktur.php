<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PembelianFaktur extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
    
    public function AmbilDataSemua($tanggal_awal, $tanggal_akhir, $status, $no_pemasok, $pilihan) {
        $this->db->select('NoFaktur, pmblan_fktr.Tanggal as TanggalFaktur, pmsk__.NoPemasok, pmsk__.NamaPemasok, pmblan_psn.Tanggal as TanggalPO, pmblan_fktr.NoPO, NilaiFaktur, pmblan_fktr.Keterangan, pmblan_fktr.Status, Terpenuhi');
        $this->db->from('pmblan_fktr');
        $this->db->join('pmsk__', 'pmblan_fktr.Pemasok = pmsk__.NoPemasok', 'inner');
        $this->db->join('pmblan_psn', 'pmblan_fktr.NoPO = pmblan_psn.NoPO', 'left');
        $this->db->where(array('pmblan_fktr.Tanggal >=' => $tanggal_awal, 'pmblan_fktr.Tanggal <=' => $tanggal_akhir));
            
        if (!(empty($no_pemasok) || $no_pemasok == 'Semua')) {
            $this->db->where('NoPemasok', $no_pemasok);
        }
            
        switch ($status) {
            case 0 :
                $this->db->where('pmblan_fktr.Status', '');
                break;
            case 1 :
                $this->db->where('pmblan_fktr.Status', 'Belum Lunas');
                break;
            case 2 :
                $this->db->where('pmblan_fktr.Status', 'Pembayaran');
                break;
            case 3 :
                $this->db->where_in('pmblan_fktr.Status', array('Belum Lunas', 'Pembayaran'));
                break;
            case 4 :
                $this->db->where('pmblan_fktr.Status', 'Lunas');
                break;
            case 5 :
                $this->db->where_in('pmblan_fktr.Status', array('Belum Lunas', 'Lunas'));
                break;
            case 6 :
                $this->db->where_in('pmblan_fktr.Status', array('Pembayaran', 'Lunas'));
                break;
        }
        
        switch ($pilihan) {
            case 'Data' :
                $data = $this->db->get()->result();
                break;
            case 'Jumlah' :
                $data = $this->db->get()->num_rows();
                break;
            default :
                $data = $this->db->get()->result();
                break;
        }
        
        return $data;
    }
    
    public function AmbilDataSatuan($no_faktur) {
        $this->db->select('NoFaktur, Tanggal, pmsk__.NoPemasok, pmsk__.NamaPemasok, NoPO, NilaiFaktur, pmblan_fktr.Keterangan');
        $this->db->from('pmblan_fktr');
        $this->db->join('pmsk__', 'pmblan_fktr.Pemasok = pmsk__.NoPemasok', 'inner');
        $this->db->where('NoFaktur', $no_faktur);
        
        $data = $this->db->get()->result();
        
        return $data;
    }
    
    public function CekPO($no_po, $no_pemasok, $nilai_faktur, $keterangan) {
        $data = 0;
        
        switch ($no_po) {
            case 'Tidak ada No. PO' :
                if (substr($keterangan, 0, 10) == 'Saldo Awal') {
                    $this->load->model('Pemasok/Pemasok');
                    
                    foreach ($this->Pemasok->AmbilDataSatuan($no_pemasok) as $result) {
                        $this->db->update('pmsk__', array('SaldoAwal' => ($result->SaldoAwal + $nilai_faktur)), array('NoPemasok' => $no_pemasok));
                    }
                }
                
                $data = 100;

                break;
            case 'Saldo Awal' :
                $this->load->model('Pemasok/Pemasok');
                
                foreach ($this->Pemasok->AmbilDataSatuan($no_pemasok) as $result) {
                    $this->db->update('pmsk__', array('SaldoAwal' => ($result->SaldoAwal + $nilai_faktur)), array('NoPemasok' => $no_pemasok));
                }
                
                $data = 100;
                
                break;
            default :
                $this->load->model('Pembelian/PembelianPesanan');
                
                foreach ($this->PembelianPesanan->AmbilDataSatuan($no_po) as $result) {
                    $diproses = $result->Diproses;

                    if ($nilai_faktur <= $diproses) {
                        $data = ($nilai_faktur / $diproses) * 100;
                        
                        $this->PembelianPesanan->PerbaruiJumlah($no_po, $nilai_faktur, $data);
                    } else {
                        $data = 'invalid_nilai';
                    }
                }
                
                break;
        }
        
        return $data;
    }
    
    public function RerataTerpenuhiSatuan($no_pemasok) {
        $data = 0;
        
        $this->db->select('AVG(Terpenuhi) as Terpenuhi');
        $this->db->from('pmblan_fktr');
        $this->db->where('Pemasok', $no_pemasok);
        
        foreach ($this->db->get()->result() as $result) {
            $data = $result->Terpenuhi;
        }
        
        return $data;
    }
    
    public function NilaiFakturSemua() {
        $data = 0;
        
        $this->db->select('SUM(NilaiFaktur) AS NilaiFaktur');
        $this->db->from('pmblan_fktr');
        $this->db->where('Status', 'Belum Lunas');
        
        foreach ($this->db->get()->result() as $result) {
            if ($result->NilaiFaktur == null) {
                $data = 0;
            } else {
                $data = $result->NilaiFaktur;
            }
        }
        
        return $data;
    }
    
    public function NilaiFakturSatuan($no_pemasok) {
        $data = 0;
        
        $this->db->select('SUM(NilaiFaktur) AS NilaiFaktur');
        $this->db->from('pmblan_fktr');
        $this->db->where(array('Pemasok' => $no_pemasok, 'Status' => 'Belum Lunas'));
        
        foreach ($this->db->get()->result() as $result) {
            if ($result->NilaiFaktur == null) {
                $data = 0;
            } else {
                $data = $result->NilaiFaktur;
            }
        }
        
        return $data;
    }
    
    public function UbahStatus($no_faktur, $status) {
        $this->db->update('pmblan_fktr', array('Status' => $status), array('NoFaktur' => $no_faktur));
    }
    
    public function TambahData($no_faktur, $tanggal, $no_pemasok, $no_po, $nilai_faktur, $keterangan, $terpenuhi) {
        switch ($no_po) {
            case 'Tidak ada No. PO' :
                $no_po = null;
                break;
            case 'Saldo Awal' :
                $no_po = null;
                $keterangan = 'Saldo Awal '.$keterangan;
                break;
        }
        
        $this->db->insert('pmblan_fktr', array('NoFaktur' => $no_faktur, 'Tanggal' => $tanggal, 'Pemasok' => $no_pemasok, 'NoPO' => $no_po, 'NilaiFaktur' => $nilai_faktur, 'Keterangan' => $keterangan, 'Terpenuhi' => $terpenuhi, 'Status' => 'Belum Lunas'));
        
        $this->load->model('Pemasok/PemasokNilai');
        
        $this->PemasokNilai->PerbaruiSHVSPA($no_pemasok, $tanggal);
        $this->PemasokNilai->PerbaruiTerpenuhi($no_pemasok, $tanggal);
    }
    
    public function UbahData($no_faktur, $tanggal, $no_pemasok, $no_po, $nilai_faktur, $keterangan, $terpenuhi, $status) {
        if (!empty($tanggal)) {
            $this->db->set('Tanggal', $tanggal);
        }
        
        if (!empty($no_pemasok)) {
            $this->db->set('Pemasok', $no_pemasok);
        }
        
        if (!empty($no_po)) {
            $this->db->set('NoPO', $no_po);
        }
        
        if (!empty($nilai_faktur)) {
            $this->db->set('NilaiFaktur', $nilai_faktur);
        }
        
        if (!empty($keterangan)) {
            $this->db->set('Keterangan', $keterangan);
        }
        
        if (!empty($terpenuhi)) {
            $this->db->set('Terpenuhi', $terpenuhi);
        }
        
        if (!empty($status)) {
            $this->db->set('Status', $status);
        }
        
        $this->db->where('NoFaktur', $no_faktur);
        $this->db->update('pmblan_fktr');
        
        $this->load->model('Pemasok/PemasokNilai');
        
        $this->PemasokNilai->PerbaruiSHVSPA($no_pemasok, $tanggal);
        $this->PemasokNilai->PerbaruiTerpenuhi($no_pemasok, $tanggal);
    }
    
    public function HapusData($no_faktur) {
        foreach ($this->AmbilDataSatuan($no_faktur) as $result) {
            $this->db->delete('pmblan_fktr', array('NoFaktur' => $no_faktur));

            if ($this->db->affected_rows() > 0) {
                date_default_timezone_set('Asia/Jakarta');
                
                if (substr($keterangan, 0, 10) == 'Saldo Awal') {
                    $this->load->model('Pemasok/Pemasok');
                    
                    foreach ($this->Pemasok->AmbilDataSatuan($result->NoPemasok) as $result) {
                        $this->db->update('pmsk__', array('SaldoAwal' => 0), array('NoPemasok' => $result->NoPemasok));
                    }
                } else {
                    $this->load->model('Pembelian/PembelianPesanan');
                    
                    $this->PembelianPesanan->PerbaruiJumlah($result->NoPO, $result->NilaiFaktur, null);
                }

                $this->load->model('Pemasok/PemasokNilai');
                
                $this->PemasokNilai->PerbaruiSHVSPA($result->Pemasok, date('Y-m-d'));
                $this->PemasokNilai->PerbaruiTerpenuhi($result->NoPemasok, date('Y-m-d'));

                $data = 'Sukses Hapus';
            } else {
                $data = 'Gagal Hapus';
            }
        }
        
        return $data;
    }
}

?>