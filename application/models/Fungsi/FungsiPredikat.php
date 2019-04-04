<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FungsiPredikat extends CI_Model {
	
	public function __construct(){
		parent::__construct();
        
	}
    
    public function AmbilData($nilai) {
        if ($nilai >= 90.5) {
            $data = 'A';
        } else if ($nilai >= 80.5) {
            $data = 'B';
        } else if ($nilai >= 70.5) {
            $data = 'C';
        } else if ($nilai >= 60.5) {
            $data = 'D';
        } else if ($nilai < 60.5) {
            $data = 'E';
        } else {
            $data = 'E';
        }
        
        return $data;
    }
}

?>