<?php
    /**
     * Helper untuk merubah tanggal kedalam format Bahasa Indonesia
     *
     * Framework    : CodeIgniter 3
     * Category     : Helpers
     * Version      : 1.0
     * Author       : Muhammad Yogi Prasetyo (m.yogiprasetya@gmail.com)
     **/
    if (!function_exists('bulan')) {
        /**
         * Fungsi untuk merubah bulan kedalam format Bahasa Indonesia
         *
         * @param int bulan, char format bulan
         * @return string nama bulan dalam Bahasa Indonesia
         **/
        
        function bulan($bulan = null, $format = 'F') {
            if (empty($bulan)) {
                $bulan = date('m');
            }
            
            switch ($format) {
                case 'm' :
                    switch ($bulan) {
                        case 'Januari' :
                            $bulan = 1;
                            break;
                        case 'Februari' :
                            $bulan = 2;
                            break;
                        case 'Maret' :
                            $bulan = 3;
                            break;
                        case 'April' :
                            $bulan = 4;
                            break;
                        case 'Mei' :
                            $bulan = 5;
                            break;
                        case 'Juni' :
                            $bulan = 6;
                            break;
                        case 'Juli' :
                            $bulan = 7;
                            break;
                        case 'Agustus' :
                            $bulan = 8;
                            break;
                        case 'September' :
                            $bulan = 9;
                            break;
                        case 'Oktober' :
                            $bulan = 10;
                            break;
                        case 'November' :
                            $bulan = 11;
                            break;
                        case 'Desember' :
                            $bulan = 12;
                            break;
                        default:
                            $bulan = date('m');
                            break;
                    }
                    
                    break;
                case 'M' :
                    switch ($bulan) {
                        case 1 :
                            $bulan = 'Jan';
                            break;
                        case 2 :
                            $bulan = 'Feb';
                            break;
                        case 3 :
                            $bulan = 'Mar';
                            break;
                        case 4 :
                            $bulan = 'Apr';
                            break;
                        case 5 :
                            $bulan = 'Mei';
                            break;
                        case 6 :
                            $bulan = 'Jun';
                            break;
                        case 7 :
                            $bulan = 'Jul';
                            break;
                        case 8 :
                            $bulan = 'Agu';
                            break;
                        case 9 :
                            $bulan = 'Sep';
                            break;
                        case 10 :
                            $bulan = 'Okt';
                            break;
                        case 11 :
                            $bulan = 'Nov';
                            break;
                        case 12 :
                            $bulan = 'Des';
                            break;
                        default:
                            $bulan = date('M');
                            break;
                    }
                    
                    break;
                case 'F' :
                    switch ($bulan) {
                        case 1 :
                            $bulan = 'Januari';
                            break;
                        case 2 :
                            $bulan = 'Februari';
                            break;
                        case 3 :
                            $bulan = 'Maret';
                            break;
                        case 4 :
                            $bulan = 'April';
                            break;
                        case 5 :
                            $bulan = 'Mei';
                            break;
                        case 6 :
                            $bulan = 'Juni';
                            break;
                        case 7 :
                            $bulan = 'Juli';
                            break;
                        case 8 :
                            $bulan = 'Agustus';
                            break;
                        case 9 :
                            $bulan = 'September';
                            break;
                        case 10 :
                            $bulan = 'Oktober';
                            break;
                        case 11 :
                            $bulan = 'November';
                            break;
                        case 12 :
                            $bulan = 'Desember';
                            break;
                        default:
                            $bulan = date('F');
                            break;
                    }
                    
                break;
            }
            
            return $bulan;
        }
    }
?>