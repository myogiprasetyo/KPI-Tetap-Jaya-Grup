<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FungsiHariKerja extends CI_Model {
	
	public function __construct(){
		parent::__construct();
        
        date_default_timezone_set('Asia/Jakarta');
	}
    
    public function AmbilData($tanggal_awal, $tanggal_akhir) {
        $hari_libur = 0;
        $hari_minggu = 0;
        
        $jumlah_hari = (date_diff(new datetime($tanggal_awal), new datetime($tanggal_akhir))->d) + 1;
        
        $this->db->select('COUNT(Tanggal) as Libur');
        $this->db->from('lbr__');
        $this->db->where(array('Tanggal >=' => $tanggal_awal, 'Tanggal <=' => $tanggal_akhir));

        foreach ($this->db->get()->result() as $result) {
            $hari_libur += $result->Libur;
        }
        
        for ($hari = 1; $hari < $jumlah_hari; $hari++) {
            if (date('w', strtotime('+'.$hari.' day', strtotime(date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($tanggal_awal)), date('d', strtotime($tanggal_awal))))))) == 0) {
                $hari_minggu += 1;
            }
        }
                
        $data = $jumlah_hari - ($hari_libur + $hari_minggu);
        
        return $data;
    }
}

?>