<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Autentikasi';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* ---------------------------------------------------------------------------------------------------------------------- */

$route['Autentikasi'] = 'Autentikasi';
$route['MenuUtama'] = 'MenuUtama';

/* ---------------------------------------------------------------------------------------------------------------------- */

$route['Pemasok'] = 'Pemasok/Navigasi/Beranda';
    $route['Pemasok/update_all'] = 'Pemasok/Navigasi/Beranda/update_all';
    
    $route['Pemasok/DataPemasok'] = 'Pemasok/Navigasi/Beranda/DataPemasok';
        $route['Pemasok/Buka_DataPemasok'] = 'Pemasok/Navigasi/Buka/DataPemasok';
            $route['Pemasok/Ubah_DataPemasok_Proses'] = 'Pemasok/Proses/Ubah/DataPemasok';
            $route['Pemasok/Hapus_DataPemasok_Proses'] = 'Pemasok/Proses/Hapus/DataPemasok';

        $route['Pemasok/Tambah_DataPemasok'] = 'Pemasok/Navigasi/Tambah/DataPemasok';
            $route['Pemasok/Tambah_DataPemasok_Proses'] = 'Pemasok/Proses/Tambah/DataPemasok';

        $route['Pemasok/Unggah_DataPemasok_Proses'] = 'Pemasok/Proses/Unggah/DataPemasok';
        
        $route['Pemasok/Unduh_DataPemasok_Proses'] = 'Pemasok/Proses/Unduh/DataPemasok';

    $route['Pemasok/PersediaanAkhirPemasok'] = 'Pemasok/Navigasi/Beranda/PersediaanAkhirPemasok';
        $route['Pemasok/Buka_PersediaanAkhirPemasok'] = 'Pemasok/Navigasi/Buka/PersediaanAkhirPemasok';
            $route['Pemasok/Hapus_PersediaanAkhirPemasok_Proses'] = 'Pemasok/Proses/Hapus/PersediaanAkhirPemasok';

        $route['Pemasok/Tambah_PersediaanAkhirPemasok'] = 'Pemasok/Navigasi/Tambah/PersediaanAkhirPemasok';
            $route['Pemasok/Tambah_PersediaanAkhirPemasok_Proses'] = 'Pemasok/Proses/Tambah/PersediaanAkhirPemasok';    

        $route['Pemasok/Unggah_PersediaanAkhirPemasok_Proses'] = 'Pemasok/Proses/Unggah/PersediaanAkhirPemasok';
        
        $route['Pemasok/Unduh_PersediaanAkhirPemasok_Proses'] = 'Pemasok/Proses/Unduh/PersediaanAkhirPemasok';

    $route['Pemasok/NilaiPemasok'] = 'Pemasok/Navigasi/Beranda/NilaiPemasok';
        $route['Pemasok/Buka_GrafikNilaiPemasok'] = 'Pemasok/Navigasi/Buka/GrafikNilaiPemasok';

        $route['Pemasok/Unduh_NilaiPemasok_Proses'] = 'Pemasok/Proses/Unduh/NilaiPemasok';
    
    $route['Pemasok/PesananPembelian'] = 'Pemasok/Navigasi/Beranda/PesananPembelian';
        $route['Pemasok/Buka_PesananPembelian'] = 'Pemasok/Navigasi/Buka/PesananPembelian';
            $route['Pemasok/Ubah_PesananPembelian_Proses'] = 'Pemasok/Proses/Ubah/PesananPembelian';
            $route['Pemasok/Hapus_PesananPembelian_Proses'] = 'Pemasok/Proses/Hapus/PesananPembelian';
        
        $route['Pemasok/Tambah_PesananPembelian'] = 'Pemasok/Navigasi/Tambah/PesananPembelian';
            $route['Pemasok/Tambah_PesananPembelian_Proses'] = 'Pemasok/Proses/Tambah/PesananPembelian';

        $route['Pemasok/Unggah_PesananPembelian_Proses'] = 'Pemasok/Proses/Unggah/PesananPembelian';
        
        $route['Pemasok/Unduh_PesananPembelian_Proses'] = 'Pemasok/Proses/Unduh/PesananPembelian';

        $route['Pemasok/Dorong_PesananPembelian'] = 'Pemasok/Navigasi/Dorong/PesananPembelian';
    
    $route['Pemasok/FakturPembelian'] = 'Pemasok/Navigasi/Beranda/FakturPembelian';
        $route['Pemasok/Buka_FakturPembelian'] = 'Pemasok/Navigasi/Buka/FakturPembelian';
            $route['Pemasok/Ubah_FakturPembelian_Proses'] = 'Pemasok/Proses/Ubah/FakturPembelian';
            $route['Pemasok/Hapus_FakturPembelian_Proses'] = 'Pemasok/Proses/Hapus/FakturPembelian';

        $route['Pemasok/Tambah_FakturPembelian'] = 'Pemasok/Navigasi/Tambah/FakturPembelian';
            $route['Pemasok/Tambah_FakturPembelian_Proses'] = 'Pemasok/Proses/Tambah/FakturPembelian';

        $route['Pemasok/Unggah_FakturPembelian_Proses'] = 'Pemasok/Proses/Unggah/FakturPembelian';
        
        $route['Pemasok/Unduh_FakturPembelian_Proses'] = 'Pemasok/Proses/Unduh/FakturPembelian';

    $route['Pemasok/PembayaranPembelian'] = 'Pemasok/Navigasi/Beranda/PembayaranPembelian';
        $route['Pemasok/Buka_PembayaranPembelian'] = 'Pemasok/Navigasi/Buka/PembayaranPembelian';
            $route['Pemasok/Ubah_PembayaranPembelian_Proses'] = 'Pemasok/Proses/Ubah/PembayaranPembelian';
            $route['Pemasok/Hapus_PembayaranPembelian_Proses'] = 'Pemasok/Proses/Hapus/PembayaranPembelian';

        $route['Pemasok/Tambah_PembayaranPembelian'] = 'Pemasok/Navigasi/Tambah/PembayaranPembelian';
            $route['Pemasok/Tambah_PembayaranPembelian_Proses'] = 'Pemasok/Proses/Tambah/PembayaranPembelian';

        $route['Pemasok/Unggah_PembayaranPembelian_Proses'] = 'Pemasok/Proses/Unggah/PembayaranPembelian';
        
        $route['Pemasok/Unduh_PembayaranPembelian_Proses'] = 'Pemasok/Proses/Unduh/PembayaranPembelian';

    $route['Pemasok/ProfitPenjualan'] = 'Pemasok/Navigasi/Beranda/ProfitPenjualan';
        $route['Pemasok/Buka_ProfitPenjualan'] = 'Pemasok/Navigasi/Buka/ProfitPenjualan';
            $route['Pemasok/Ubah_ProfitPenjualan_Proses'] = 'Pemasok/Proses/Ubah/ProfitPenjualan';
            $route['Pemasok/Hapus_ProfitPenjualan_Proses'] = 'Pemasok/Proses/Hapus/ProfitPenjualan';
        
        $route['Pemasok/Tambah_ProfitPenjualan'] = 'Pemasok/Navigasi/Tambah/ProfitPenjualan';
            $route['Pemasok/Tambah_ProfitPenjualan_Proses'] = 'Pemasok/Proses/Tambah/ProfitPenjualan';

        $route['Pemasok/Unggah_ProfitPenjualan_Proses'] = 'Pemasok/Proses/Unggah/ProfitPenjualan';
        
        $route['Pemasok/Unduh_ProfitPenjualan_Proses'] = 'Pemasok/Proses/Unduh/ProfitPenjualan';

/* ---------------------------------------------------------------------------------------------------------------------- */

$route['Pelanggan'] = 'Pelanggan/Navigasi/Beranda';
    $route['Pelanggan/update_all'] = 'Pelanggan/Navigasi/Beranda/update_all';

    $route['Pelanggan/DataPelanggan'] = 'Pelanggan/Navigasi/Beranda/DataPelanggan';
        $route['Pelanggan/Buka_DataPelanggan'] = 'Pelanggan/Navigasi/Buka/DataPelanggan';
            $route['Pelanggan/Ubah_DataPelanggan_Proses'] = 'Pelanggan/Proses/Ubah/DataPelanggan';
            $route['Pelanggan/Hapus_DataPelanggan_Proses'] = 'Pelanggan/Proses/Hapus/DataPelanggan';

        $route['Pelanggan/Tambah_DataPelanggan'] = 'Pelanggan/Navigasi/Tambah/DataPelanggan';
            $route['Pelanggan/Tambah_DataPelanggan_Proses'] = 'Pelanggan/Proses/Tambah/DataPelanggan';

        $route['Pelanggan/Unggah_DataPelanggan_Proses'] = 'Pelanggan/Proses/Unggah/DataPelanggan';

        $route['Pelanggan/Unduh_DataPelanggan_Proses'] = 'Pelanggan/Proses/Unduh/DataPelanggan';

    $route['Pelanggan/TargetPelanggan'] = 'Pelanggan/Navigasi/Beranda/TargetPelanggan';
        $route['Pelanggan/Buka_TargetPelanggan'] = 'Pelanggan/Navigasi/Buka/TargetPelanggan';
            $route['Pelanggan/Ubah_TargetPelanggan_Proses'] = 'Pelanggan/Proses/Ubah/TargetPelanggan';
            $route['Pelanggan/Hapus_TargetPelanggan_Proses'] = 'Pelanggan/Proses/Hapus/TargetPelanggan';

        $route['Pelanggan/Tambah_TargetPelanggan'] = 'Pelanggan/Navigasi/Tambah/TargetPelanggan';
            $route['Pelanggan/Tambah_TargetPelanggan_Proses'] = 'Pelanggan/Proses/Tambah/TargetPelanggan';

        $route['Pelanggan/Unggah_TargetPelanggan_Proses'] = 'Pelanggan/Proses/Unggah/TargetPelanggan';

        $route['Pelanggan/Unduh_TargetPelanggan_Proses'] = 'Pelanggan/Proses/Unduh/TargetPelanggan';

    $route['Pelanggan/PiutangPelanggan'] = 'Pelanggan/Navigasi/Beranda/PiutangPelanggan';
        $route['Pelanggan/Buka_PiutangPelanggan'] = 'Pelanggan/Navigasi/Buka/PiutangPelanggan';
            $route['Pelanggan/Ubah_PiutangPelanggan_Proses'] = 'Pelanggan/Proses/Ubah/PiutangPelanggan';
            $route['Pelanggan/Hapus_PiutangPelanggan_Proses'] = 'Pelanggan/Proses/Hapus/PiutangPelanggan';

        $route['Pelanggan/Tambah_PiutangPelanggan'] = 'Pelanggan/Navigasi/Tambah/PiutangPelanggan';
            $route['Pelanggan/Tambah_PiutangPelanggan_Proses'] = 'Pelanggan/Proses/Tambah/PiutangPelanggan';

        $route['Pelanggan/Unggah_PiutangPelanggan_Proses'] = 'Pelanggan/Proses/Unggah/PiutangPelanggan';

        $route['Pelanggan/Unduh_PiutangPelanggan_Proses'] = 'Pelanggan/Proses/Unduh/PiutangPelanggan';

    $route['Pelanggan/NilaiPelanggan'] = 'Pelanggan/Navigasi/Beranda/NilaiPelanggan';
        $route['Pelanggan/Buka_GrafikNilaiPelanggan'] = 'Pelanggan/Navigasi/Buka/GrafikNilaiPelanggan';

        $route['Pelanggan/Unduh_NilaiPelanggan_Proses'] = 'Pelanggan/Proses/Unduh/NilaiPelanggan';

     $route['Pelanggan/DataRayon'] = 'Pelanggan/Navigasi/Beranda/DataRayon';
        $route['Pelanggan/Buka_DataRayon'] = 'Pelanggan/Navigasi/Buka/DataRayon';
            $route['Pelanggan/Ubah_DataRayon_Proses'] = 'Pelanggan/Proses/Ubah/DataRayon';
            $route['Pelanggan/Hapus_DataRayon_Proses'] = 'Pelanggan/Proses/Hapus/DataRayon';

        $route['Pelanggan/Tambah_DataRayon'] = 'Pelanggan/Navigasi/Tambah/DataRayon';
            $route['Pelanggan/Tambah_DataRayon_Proses'] = 'Pelanggan/Proses/Tambah/DataRayon';

        $route['Pelanggan/Unggah_DataRayon_Proses'] = 'Pelanggan/Proses/Unggah/DataRayon';

        $route['Pelanggan/Unduh_DataRayon_Proses'] = 'Pelanggan/Proses/Unduh/DataRayon';

    $route['Pelanggan/DataPenjual'] = 'Pelanggan/Navigasi/Beranda/DataPenjual';
        $route['Pelanggan/Buka_DataPenjual'] = 'Pelanggan/Navigasi/Buka/DataPenjual';
            $route['Pelanggan/Ubah_DataPenjual_Proses'] = 'Pelanggan/Proses/Ubah/DataPenjual';
            $route['Pelanggan/Hapus_DataPenjual_Proses'] = 'Pelanggan/Proses/Hapus/DataPenjual';

        $route['Pelanggan/Tambah_DataPenjual'] = 'Pelanggan/Navigasi/Tambah/DataPenjual';
            $route['Pelanggan/Tambah_DataPenjual_Proses'] = 'Pelanggan/Proses/Tambah/DataPenjual';

        $route['Pelanggan/Unggah_DataPenjual_Proses'] = 'Pelanggan/Proses/Unggah/DataPenjual';

        $route['Pelanggan/Unduh_DataPenjual_Proses'] = 'Pelanggan/Proses/Unduh/DataPenjual';

    $route['Pelanggan/FakturPenjualan'] = 'Pelanggan/Navigasi/Beranda/FakturPenjualan';
        $route['Pelanggan/Buka_FakturPenjualan'] = 'Pelanggan/Navigasi/Buka/FakturPenjualan';
            $route['Pelanggan/Ubah_FakturPenjualan_Proses'] = 'Pelanggan/Proses/Ubah/FakturPenjualan';
            $route['Pelanggan/Hapus_FakturPenjualan_Proses'] = 'Pelanggan/Proses/Hapus/FakturPenjualan';
        
        $route['Pelanggan/Tambah_FakturPenjualan'] = 'Pelanggan/Navigasi/Tambah/FakturPenjualan';
            $route['Pelanggan/Tambah_FakturPenjualan_Proses'] = 'Pelanggan/Proses/Tambah/FakturPenjualan';

        $route['Pelanggan/Unggah_FakturPenjualan_Proses'] = 'Pelanggan/Proses/Unggah/FakturPenjualan';

        $route['Pelanggan/Unduh_FakturPenjualan_Proses'] = 'Pelanggan/Proses/Unduh/FakturPenjualan';

    $route['Pelanggan/ReturPenjualan'] = 'Pelanggan/Navigasi/Beranda/ReturPenjualan';
        $route['Pelanggan/Buka_ReturPenjualan'] = 'Pelanggan/Navigasi/Buka/ReturPenjualan';
            $route['Pelanggan/Ubah_ReturPenjualan_Proses'] = 'Pelanggan/Proses/Ubah/ReturPenjualan';
            $route['Pelanggan/Hapus_ReturPenjualan_Proses'] = 'Pelanggan/Proses/Hapus/ReturPenjualan';
        
        $route['Pelanggan/Tambah_ReturPenjualan'] = 'Pelanggan/Navigasi/Tambah/ReturPenjualan';
            $route['Pelanggan/Tambah_ReturPenjualan_Proses'] = 'Pelanggan/Proses/Tambah/ReturPenjualan';

        $route['Pelanggan/Unggah_ReturPenjualan_Proses'] = 'Pelanggan/Proses/Unggah/ReturPenjualan';

        $route['Pelanggan/Unduh_ReturPenjualan_Proses'] = 'Pelanggan/Proses/Unduh/ReturPenjualan';

    $route['Pelanggan/LabaKotorPenjualan'] = 'Pelanggan/Navigasi/Beranda/LabaKotorPenjualan';
        $route['Pelanggan/Buka_LabaKotorPenjualan'] = 'Pelanggan/Navigasi/Buka/LabaKotorPenjualan';
            $route['Pelanggan/Ubah_LabaKotorPenjualan_Proses'] = 'Pelanggan/Proses/Ubah/LabaKotorPenjualan';
            $route['Pelanggan/Hapus_LabaKotorPenjualan_Proses'] = 'Pelanggan/Proses/Hapus/LabaKotorPenjualan';
        
        $route['Pelanggan/Tambah_LabaKotorPenjualan'] = 'Pelanggan/Navigasi/Tambah/LabaKotorPenjualan';
            $route['Pelanggan/Tambah_LabaKotorPenjualan_Proses'] = 'Pelanggan/Proses/Tambah/LabaKotorPenjualan';

        $route['Pelanggan/Unggah_LabaKotorPenjualan_Proses'] = 'Pelanggan/Proses/Unggah/LabaKotorPenjualan';

        $route['Pelanggan/Unduh_LabaKotorPenjualan_Proses'] = 'Pelanggan/Proses/Unduh/LabaKotorPenjualan';

/* ---------------------------------------------------------------------------------------------------------------------- */

$route['Karyawan'] = 'Karyawan/Navigasi/Beranda';
    $route['Karyawan/update_all'] = 'Karyawan/Navigasi/Beranda/update_all';

    $route['Karyawan/DataKaryawan'] = 'Karyawan/Navigasi/Beranda/DataKaryawan';
        $route['Karyawan/Buka_DataKaryawan'] = 'Karyawan/Navigasi/Buka/DataKaryawan';
            $route['Karyawan/Ubah_DataKaryawan_Proses'] = 'Karyawan/Proses/Ubah/DataKaryawan';
            $route['Karyawan/Hapus_DataKaryawan_Proses'] = 'Karyawan/Proses/Hapus/DataKaryawan';

        $route['Karyawan/Tambah_DataKaryawan'] = 'Karyawan/Navigasi/Tambah/DataKaryawan';
            $route['Karyawan/Tambah_DataKaryawan_Proses'] = 'Karyawan/Proses/Tambah/DataKaryawan';

        $route['Karyawan/Unggah_DataKaryawan_Proses'] = 'Karyawan/Proses/Unggah/DataKaryawan';

        $route['Karyawan/Unduh_DataKaryawan_Proses'] = 'Karyawan/Proses/Unduh/DataKaryawan';

/* ---------------------------------------------------------------------------------------------------------------------- */

$route['Tim'] = 'Tim/Navigasi/Beranda';
    $route['Tim/update_all'] = 'Tim/Navigasi/Beranda/update_all';

    $route['Tim/DataToko'] = 'Tim/Navigasi/Beranda/DataToko';
        $route['Tim/Buka_DataToko'] = 'Tim/Navigasi/Buka/DataToko';
            $route['Tim/Ubah_DataToko_Proses'] = 'Tim/Proses/Ubah/DataToko';
            $route['Tim/Hapus_DataToko_Proses'] = 'Tim/Proses/Hapus/DataToko';

        $route['Tim/Tambah_DataToko'] = 'Tim/Navigasi/Tambah/DataToko';
            $route['Tim/Tambah_DataToko_Proses'] = 'Tim/Proses/Tambah/DataToko';

        $route['Tim/Unggah_DataToko_Proses'] = 'Tim/Proses/Unggah/DataToko';

        $route['Tim/Unduh_DataToko_Proses'] = 'Tim/Proses/Unduh/DataToko';

/* ---------------------------------------------------------------------------------------------------------------------- */

$route['Pengaturan'] = 'Pengaturan/Navigasi/Beranda';
    $route['Pengaturan/Karyawan'] = 'Pengaturan/Navigasi/Beranda/Karyawan';
        $route['Pengaturan/Buka_Karyawan'] = 'Pengaturan/Navigasi/Buka/Karyawan';
            $route['Pemasok/Ubah_Karyawan_Proses'] = 'Pengaturan/Proses/Ubah/Karyawan';
            $route['Pemasok/Hapus_Karyawan_Proses'] = 'Pengaturan/Proses/Hapus/Karyawan';

        $route['Pemasok/Tambah_Karyawan'] = 'Pengaturan/Navigasi/Tambah/DataPemasok';
            $route['Pemasok/Tambah_Karyawan_Proses'] = 'Pengaturan/Proses/Tambah/Karyawan';

    $route['Pengaturan/PenggunaAplikasi'] = 'Pengaturan/Navigasi/Beranda/PenggunaAplikasi';