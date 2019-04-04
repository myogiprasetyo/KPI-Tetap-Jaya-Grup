<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autentikasi extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        
	}
    
    public function index() {
        if ($this->session->userdata('Pengguna') != '') {
            redirect ('MenuUtama');
        } else {
            $this->load->model('Perusahaan');
            
            $data['konten'] = 'Autentikasi';
            $data['perusahaan'] = $this->Perusahaan->AmbilData();
        
            $this->load->view('index', $data);
        }
    }
    
    public function login() {
        $rules = array(
            ['field' => 'nik', 'label' => 'NIK', 'rules' => 'required'],
            ['field' => 'password', 'label' => 'Password', 'rules' => 'required']
        );
        
        $message = array(
            'required' => '<span class="help-block fa fa-times-circle-o"> {field} tidak boleh kosong</span>'
        );
            
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message($message);
        
        if ($this->form_validation->run() == false) {
            $data = array(
                'nik' => form_error('nik'),
                'password' => form_error('password')
            );

            echo json_encode($data);
        } else {
            $nik = $this->input->post('nik');
            $password = $this->input->post('password');
            
            $this->load->model('Pengguna');
            
            if ($this->Pengguna->CekKetersediaan($nik) == true) {
                foreach ($this->Pengguna->AmbilData($nik) as $data_pengguna) {
                    if ($data_pengguna->Password == md5($password)) {
                        $user = array(
                            'Pengguna' => $data_pengguna->Pengguna,
                            'KPIPemasokAkses' => $data_pengguna->KPIPemasokAkses,
                            'KPIPelangganAkses' => $data_pengguna->KPIPemasokAkses,
                            'KPIIndividuAkses' => $data_pengguna->KPIPemasokAkses,
                            'KPITeamAkses' => $data_pengguna->KPIPemasokAkses,
                            'PengaturanAkses' => $data_pengguna->KPIPemasokAkses
                        );
                        
                        $this->session->set_userdata($user);
                        
                        echo json_encode('login_sukses');
                    } else {
                        echo json_encode('invalid_password');
                    }
                }
            } else {
                echo json_encode('invalid_nik');
            }
        }
    }
    
    public function logout() {
        $this->session->unset_userdata('Pengguna');
        $this->session->unset_userdata('KPIPemasokAkses');
        $this->session->unset_userdata('KPIPelangganAkses');
        $this->session->unset_userdata('KPIIndividuAkses');
        $this->session->unset_userdata('KPITeamAkses');
        $this->session->unset_userdata('PengaturanAkses');
        
        $this->session->sess_destroy();
        
        $this->index();
    }
}

?>