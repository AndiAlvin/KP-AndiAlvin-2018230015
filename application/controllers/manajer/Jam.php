<?php
class Jam extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('hak_akses') != '3') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Anda Belum Login</strong>
			<button type="button" class="close"
			data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('welcome');
        }
    }

    public function index()
    {
        $data['title'] = 'Update Data Jam';
        $data['set_jam'] = $this->PenggajianModel->get_data('jam')->result();
        $this->load->view('templates_manajer/header', $data);
        $this->load->view('templates_manajer/sidebar');
        $this->load->view('manajer/jam', $data);
        $this->load->view('templates_manajer/footer');
    }
    public function UpdateData($id)
    {
        $where = array('id_jam' => $id);
        $data['title'] = 'Update Data Jam';
        $data['set_jam'] = $this->db->query("SELECT * FROM jam WHERE id_jam = '$id'")->result();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('manajer/FormUpdatejam', $data);
        $this->load->view('templates_admin/footer');
    }
    public function UpdateDataAksi()
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->UpdateData();
        } else {
            $id = $this->input->post('id_jam');
            $start = $this->input->post('start');
            $finish = $this->input->post('finish');
        }
        $data = array(
            'start' => $start,
            'finish' => $finish,
        );

        $where = array(
            'id_jam' => $id
        );

        $this->PenggajianModel->update_data('jam', $data, $where);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data Berhasil DiPerbarui!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('manajer/jam');
    }
    public function _rules()
    {
        $this->form_validation->set_rules('start', 'Jam Mulai', 'required');
        $this->form_validation->set_rules('finish', 'Jam Selesai', 'required');
    }
}



/* End of File: d:\Ampps\www\project\absen-pegawai\application\controllers\Jam.php */