<?php
class GantiPassword extends CI_Controller
{
    public function index()
    {
        $data['title'] = "Ganti Password";
        $this->load->view('templates_pegawai/header', $data);
        $this->load->view('templates_pegawai/sidebar');
        $this->load->view('pegawai/FormGantiPassword', $data);
        $this->load->view('templates_pegawai/footer');
    }
    public function GantiPasswordAksi()
    {
        $PassBaru = $this->input->post('PassBaru');
        $UlangiPass = $this->input->post('UlangiPass');
        $this->form_validation->set_rules('PassBaru', 'Password Baru', 'required|matches[UlangiPass]');
        $this->form_validation->set_rules('UlangiPass', 'Ulangi Password', 'required');
        if ($this->form_validation->run() != FALSE) {
            $data = array('password' => md5($PassBaru));
            $id = array('id_pegawai' => $this->session->userdata('id_pegawai'));

            $this->PenggajianModel->update_data('data_pegawai', $data, $id);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Password Berhasil Diganti!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('welcome');
        } else {
            $data['title'] = "Ganti Password";
            $this->load->view('templates_pegawai/header', $data);
            $this->load->view('templates_pegawai/sidebar');
            $this->load->view('pegawai/FormGantiPassword', $data);
            $this->load->view('templates_pegawai/footer');
        }
    }
}
