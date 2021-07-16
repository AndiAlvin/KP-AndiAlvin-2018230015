<?php

class PotonganGaji extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('hak_akses') != '1') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Anda Belum Login</strong>
			<button type="button" class="close"
			data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('welcome');
        }
    }
    public function index()
    {
        $data['title'] = "Setting Potongan Gaji";
        $data['pot_gaji'] = $this->PenggajianModel->get_data('potongan_gaji')->result();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/PotonganGaji', $data);
        $this->load->view('templates_admin/footer');
    }
    public function TambahData()
    {
        $data['title'] = "Tambah Potongan Gaji";
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/FormPotonganGaji', $data);
        $this->load->view('templates_admin/footer');
    }
    public function TambahDataAksi()
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->TambahData();
        } else {
            $potongan           = $this->input->post('potongan');
            $jml_potongan           = $this->input->post('jml_potongan');
            $data = array(
                'potongan'          => $potongan,
                'jml_potongan'      => $jml_potongan
            );

            $this->PenggajianModel->insert_data($data, 'potongan_gaji');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data Berhasil Ditambahkan!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/PotonganGaji');
        }
    }
    public function UpdateData($id)
    {
        $where = array('id' => $id);
        $data['pot_gaji'] = $this->db->query("SELECT * FROM potongan_gaji WHERE id = '$id'")->result();
        $data['title'] = "Update Potongan Gaji";
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/UpdatePotonganGaji', $data);
        $this->load->view('templates_admin/footer');
    }
    public function UpdateDataAksi()
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->UpdateData();
        } else {
            $id             = $this->input->post('id');
            $potongan       = $this->input->post('potongan');
            $jml_potongan   = $this->input->post('jml_potongan');


            $data = array(
                'potongan' => $potongan,
                'jml_potongan' => $jml_potongan

            );

            $where = array(
                'id' => $id
            );

            $this->PenggajianModel->update_data('potongan_gaji', $data, $where);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data Berhasil DiUpdate!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/PotonganGaji');
        }
    }
    public function _rules()
    {
        $this->form_validation->set_rules('potongan', 'jenis potongan', 'required');
        $this->form_validation->set_rules('jml_potongan', 'jumlah potongan', 'required');
    }
    public function DeleteData($id)
    {
        $where = array('id' => $id);
        $this->PenggajianModel->delete_data($where, 'potongan_gaji');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Data Berhasil DiHapus!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('admin/PotonganGaji');
    }
}
