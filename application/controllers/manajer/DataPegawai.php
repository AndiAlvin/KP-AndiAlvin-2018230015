<?php
class DataPegawai extends CI_Controller
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
        $data['title'] = "Data Pegawai";
        $data['pegawai'] = $this->PenggajianModel->get_data("data_pegawai")->result();
        $this->load->view('templates_manajer/header', $data);
        $this->load->view('templates_manajer/sidebar');
        $this->load->view('manajer/DataPegawai', $data);
        $this->load->view('templates_manajer/footer');
    }
    public function TambahData()
    {
        $data['title'] = "Tambah Data Pegawai";
        $data['jabatan'] = $this->PenggajianModel->get_data("data_jabatan")->result();
        $this->load->view('templates_manajer/header', $data);
        $this->load->view('templates_manajer/sidebar');
        $this->load->view('manajer/FormTambahPegawai', $data);
        $this->load->view('templates_manajer/footer');
    }
    public function TambahDataAksi()
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->TambahData();
        } else {
            $nik = $this->input->post('nik');
            $nama_pegawai = $this->input->post('nama_pegawai');
            $jenis_kelamin = $this->input->post('jenis_kelamin');
            $tanggal_masuk = $this->input->post('tanggal_masuk');
            $jabatan = $this->input->post('jabatan');
            $status = $this->input->post('status');
            $hak_akses = $this->input->post('hak_akses');
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));
            $photo = $_FILES['photo']['name'];
            if ($photo) {
                $config['upload_path'] = './assets/photo/';
                $config['max_size'] = '2048';
                $config['allowed_types'] = 'jpg|jpeg|png|tiff|svg';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('photo')) {
                    $photo = $this->upload->data("file_name");
                    $this->db->set('photo', $photo);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $data = array(
                'nik' => $nik,
                'nama_pegawai' => $nama_pegawai,
                'jenis_kelamin' => $jenis_kelamin,
                'jabatan' => $jabatan,
                'tanggal_masuk' => $tanggal_masuk,
                'status' => $status,
                'hak_akses' => $hak_akses,
                'username' => $username,
                'password' => $password,
                'photo' => $photo,

            );

            $this->PenggajianModel->insert_data($data, 'data_pegawai');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data Berhasil Ditambahkan!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('manajer/DataPegawai');
        }
    }

    public function UpdateData($id)
    {
        $where = array('id_pegawai' => $id);
        $data['title'] = 'Update Data Pegawai';
        $data['jabatan'] = $this->PenggajianModel->get_data("data_jabatan")->result();
        $data['pegawai'] = $this->db->query("SELECT * FROM data_pegawai WHERE id_pegawai = '$id'")->result();
        $this->load->view('templates_manajer/header', $data);
        $this->load->view('templates_manajer/sidebar');
        $this->load->view('manajer/FormUpdatePegawai', $data);
        $this->load->view('templates_manajer/footer');
    }
    public function UpdateDataAksi()
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->UpdateData();
        } else {
            $id = $this->input->post('id_pegawai');
            $nik = $this->input->post('nik');
            $nama_pegawai = $this->input->post('nama_pegawai');
            $jenis_kelamin = $this->input->post('jenis_kelamin');
            $tanggal_masuk = $this->input->post('tanggal_masuk');
            $jabatan = $this->input->post('jabatan');
            $status = $this->input->post('status');
            $hak_akses = $this->input->post('hak_akses');
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));
            $photo = $_FILES['photo']['name'];
            if ($photo) {
                $config['upload_path'] = './assets/photo/';
                $config['max_size'] = '2048';
                $config['allowed_types'] = 'jpg|jpeg|png|tiff|svg';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('photo')) {
                    $photo = $this->upload->data("file_name");
                    $this->db->set('photo', $photo);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $data = array(
                'nik' => $nik,
                'nama_pegawai' => $nama_pegawai,
                'jenis_kelamin' => $jenis_kelamin,
                'jabatan' => $jabatan,
                'tanggal_masuk' => $tanggal_masuk,
                'status' => $status,
                'username' => $username,
                'password' => $password,
                'hak_akses' => $hak_akses,

            );

            $where = array(
                'id_pegawai' => $id
            );

            $this->PenggajianModel->update_data('data_pegawai', $data, $where);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data Berhasil DiPerbarui!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('manajer/DataPegawai');
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nik', 'Nik', 'required');
        $this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('tanggal_masuk', 'tanggal_masuk', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
    }
    public function DeleteData($id)
    {
        $where = array('id_pegawai' => $id);
        $this->PenggajianModel->delete_data($where, 'data_pegawai');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Data Berhasil DiHapus!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('manajer/DataPegawai');
    }

    public function search()
    {
        $keyword = $this->input->post('keyword');
        $data['pegawai'] = $this->PenggajianModel->get_keyword($keyword);
        $this->load->view('templates_manajer/header', $data);
        $this->load->view('templates_manajer/sidebar');
        $this->load->view('manajer/DataPegawai', $data);
        $this->load->view('templates_manajer/footer');
    }
}
