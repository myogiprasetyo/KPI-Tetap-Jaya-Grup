<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

require_once 'application/third_party/spreadsheet-reader-master/SpreadsheetReader.php';

class unggahexcel extends SpreadsheetReader {

    function __construct($lokasi = 'assets/dist/file/upload/format_example/default.xlsx', array $pilihan = null){
		parent::__construct($lokasi, $pilihan);
        
	}
}

?>