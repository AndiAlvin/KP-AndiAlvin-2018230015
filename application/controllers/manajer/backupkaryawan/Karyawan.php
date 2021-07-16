<?php
defined('BASEPATH') or die('No direct script access allowed!');

class Karyawan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Karyawan_model', 'karyawan');
    }

    public function index()
    {
        $data['karyawan'] = $this->karyawan->get_all();
        $this->load->view('templates_manajer/header', $data);
        $this->load->view('templates_manajer/sidebar',);
        $this->load->view('manajer/karyawan/index', $data);
        $this->load->view('templates_manajer/footer');
    }

    public function create()
    {
        $this->load->model('Divisi_model', 'divisi');
        $data['divisi'] = $this->divisi->get_all();
        $this->load->view('templates_manajer/header', $data);
        $this->load->view('templates_manajer/sidebar',);
        $this->load->view('manajer/karyawan/create', $data);
        $this->load->view('templates_manajer/footer');
    }

    public function store()
    {
        $post = $this->input->post();
        $data = [
            'nik' => $post['nik'],
            'nama_pegawai' => $post['nama_pegawai'],
            'username' => $post['username'],
            'password' => password_hash($post['password'], PASSWORD_DEFAULT),
            'jenis_kelamin' => $post['jenis_kelamin'],
            'jabatan' => $post['jabatan'],
            'tanggal_masuk' => $post['tanggal_masuk'],
            'status' => $post['status'],
            'hak_akses' => $post['hak_akses'],


        ];

        $result = $this->karyawan->insert_data($data);
        if ($result) {
            $response = [
                'status' => 'success',
                'message' => 'Data karyawan telah ditambahkan!'
            ];
            $redirect = 'manajer/karyawan/';
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Data karyawan gagal ditambahkan'
            ];
            $redirect = 'manajer/karyawan/create';
        }

        $this->session->set_flashdata('response', $response);
        redirect($redirect);
    }

    public function edit()
    {
        $id_pegawai = $this->uri->segment(3);
        $data['karyawan'] = $this->karyawan->find($id_pegawai);
        $this->load->view('templates_manajer/header', $data);
        $this->load->view('templates_manajer/sidebar',);
        $this->load->view('manajer/karyawan/edit', $data);
        $this->load->view('templates_manajer/footer');
    }

    public function update()
    {
        $post = $this->input->post();
        $data = [
            'nik' => $post['nik'],
            'nama' => $post['nama_pegawai'],
            'username' => $post['username'],
            'password' => password_hash($post['password'], PASSWORD_DEFAULT),
            'jenis_kelamin' => $post['jenis_kelamin'],
            'jabatan' => $post['jabatan'],
            'tanggal_masuk' => $post['tanggal_masuk'],
            'status' => $post['status'],
            'photo' => $post['photo'],
            'hak_akses' => $post['hak_akses'],
        ];

        if ($post['password'] !== '') {
            $data['password'] = password_hash($post['password'], PASSWORD_DEFAULT);
        }

        $result = $this->karyawan->update_data($post['id_pegawai'], $data);
        if ($result) {
            $response = [
                'status' => 'success',
                'message' => 'Data Karyawan berhasil diubah!'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Data Karyawan gagal diubah!'
            ];
        }

        $this->session->set_flashdata('response', $response);
        redirect('manajer/karyawan/');
    }

    public function destroy()
    {
        $id_pegawai = $this->uri->segment(3);
        $result = $this->karyawan->delete_data($id_pegawai);
        if ($result) {
            $response = [
                'status' => 'success',
                'message' => 'Data karyawan berhasil dihapus!'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Data karyawan gagal dihapus!'
            ];
        }

        header('Content-Type: application/json');
        echo $response;
    }
}



/* End of File: d:\Ampps\www\project\absen-pegawai\application\controllers\Karyawan.php */