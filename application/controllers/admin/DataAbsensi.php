<?php

class DataAbsensi extends CI_Controller
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
        $data['title'] = "DataAbsensi Pegawai";

        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . $tahun;
        }


        $data['Absensi'] = $this->db->query(" SELECT data_kehadiran.*,
            data_pegawai.nama_pegawai,data_pegawai.jenis_kelamin,data_pegawai.jabatan
         FROM data_kehadiran
         INNER JOIN data_pegawai ON data_kehadiran.nik=data_pegawai.nik
         INNER JOIN data_jabatan ON data_pegawai.jabatan = data_jabatan.nama_jabatan 
         WHERE data_kehadiran.bulan='$bulantahun'
         ORDER BY data_pegawai.nama_pegawai ASC ")->result();



        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar',);
        $this->load->view('admin/DataAbsensi', $data);
        $this->load->view('templates_admin/footer');
    }

    public function InputAbsensi()
    {

        if ($this->input->post('submit', TRUE) == 'submit') {

            $post = $this->input->post();

            foreach ($post['bulan'] as $key => $value) {
                if ($post['bulan'][$key] != '' || $post['nik'][$key] != '') {
                    $simpan[] = array(
                        'bulan'                 => $post['bulan'][$key],
                        'nik'                   => $post['nik'][$key],
                        'nama_pegawai'          => $post['nama_pegawai'][$key],
                        'jenis_kelamin'         => $post['jenis_kelamin'][$key],
                        'nama_jabatan'          => $post['nama_jabatan'][$key],
                        'hadir'                 => $post['hadir'][$key],
                        'sakit'                 => $post['sakit'][$key],
                        'alpha'                 => $post['alpha'][$key],
                    );
                }
            }
            $this->PenggajianModel->insert_batch('data_kehadiran', $simpan);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data Berhasil Ditambahkan!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/DataAbsensi');
        }
        $data['title'] = "Form Input Absensi Pegawai";

        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . $tahun;
        }
        $data['Input_Absensi'] = $this->db->query("SELECT 
        data_pegawai.*, data_jabatan.nama_jabatan FROM data_pegawai
        INNER JOIN data_jabatan ON data_pegawai.jabatan=data_jabatan.nama_jabatan
        WHERE NOT EXISTS (SELECT * FROM data_kehadiran 
        WHERE bulan='$bulantahun' AND data_pegawai.nik=data_kehadiran.nik) ORDER BY data_pegawai.nama_pegawai ASC")->result();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar',);
        $this->load->view('admin/FormInputAbsensi', $data);
        $this->load->view('templates_admin/footer');
    }
    public function absensiKaryawan()
    {
        $name = $this->input->post('name');
        $kehadiran = $this->input->post('kehadiran');
        $jumlah = $this->input->post('jumlah');
        $alasan = $this->input->post('alasan');
        $date = date('d/m/Y');
        if ($name && $kehadiran && $jumlah && $alasan) {
            $absensiKaryawan = $this->karyawan->getAbsensiKaryawanByName($name);
            if ($absensiKaryawan[0]->id) {
                $updateAbsensiKaryawan = $this->karyawan->updateAbsensiKaryawan($absensiKaryawan[0]->id, $kehadiran, '+', $jumlah);
                $addAlasanKaryawan = $this->karyawan->addAlasanKaryawan($name, $alasan, $date);
                if ($updateAbsensiKaryawan == 1 || $addAlasanKaryawan == 1) {
                    $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Berhasil menambah absensi'));
                    redirect(base_url() . 'admin/AbsenHarian');
                } else {
                    $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Gagal menambah absensi'));
                    redirect(base_url() . 'admin/AbsenHarian');
                }
            } else {
                $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Gagal menambah absensi'));
                redirect(base_url() . 'admin/AbsenHarian');
            }
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Gagal menambah absensi'));
            redirect(base_url() . 'admin/AbsenHarian');
        }
    }
    public function messageAlert($type, $title)
    {
        $messageAlert = "
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
        });
    
        Toast.fire({
            type: '" . $type . "',
            title: '" . $title . "'
        });
        ";
        return $messageAlert;
    }
    public function absensi_karyawan()
    {
        $data['pegawai'] = $this->karyawan->getAllDataKaryawan();
        $this->load->view('admin/AbsenHarian', $data);
    }
}
