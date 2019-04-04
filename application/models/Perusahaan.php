<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perusahaan extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
    
    public function AmbilData() {
        $data = $this->db->get('prshaan__')->result();
        
        return $data;
    }
}

?>