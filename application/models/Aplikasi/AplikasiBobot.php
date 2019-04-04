<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AplikasiBobot extends CI_Model {
	
	public function __construct(){
		parent::__construct();
        
	}
    
    public function AmbilDataSemua($id) {
        $this->db->select('AliasBobot, Bobot');
        $this->db->from('aplksi_bbt');
        $this->db->where('Id', $id);
        $this->db->order_by('AliasBobot');
        
        $data = $this->db->get()->result();
        
        return $data;
    }
    
    public function AmbilDataSatuan($id, $alias_bobot) {
        $data = 0;
        
        foreach ($this->db->get_where('aplksi_bbt', array('Id' => $id, 'AliasBobot' => $alias_bobot))->result() as $result) {
            $data = $result->Bobot / 100;
        }
        
        return $data;
    }
}

?>