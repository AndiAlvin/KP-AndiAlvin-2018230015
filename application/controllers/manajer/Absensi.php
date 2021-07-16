<?php
defined('BASEPATH') or die('No direct script access allowed!');

class Absensi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Absensi_model', 'absensi');
        $this->load->model('Karyawan_model', 'karyawan');
        $this->load->model('Jam_model', 'jam');
        $this->load->model('PenggajianModel');
        $this->load->helper('Tanggal');
    }

    public function index()
    {
        if (is_level('manajer')) {
            return $this->detail_absensi();
        } else {
            return $this->list_karyawan();
        }
    }

    public function list_karyawan()
    {
        $data['title'] = "List";
        $data['karyawan'] = $this->karyawan->get_all();
        $this->load->view('templates_manajer/header', $data);
        $this->load->view('templates_manajer/sidebar',);
        $this->load->view('manajer/absensi/list_karyawan', $data);
        $this->load->view('templates_manajer/footer');
    }
    public function detail($id)
    {
        $data['detail'] = $this->absensi->detail_data($id);
        $id_pegawai = @$this->uri->segment(3) ? $this->uri->segment(3) : $this->session->id_pegawai;
        $bulan = @$this->input->get('bulan') ? $this->input->get('bulan') : date('m');
        $tahun = @$this->input->get('tahun') ? $this->input->get('tahun') : date('Y');
        $data['title'] = "Absen";
        $data['karyawan'] = $this->karyawan->find($id_pegawai);

        $nama = $this->input->post('nama_pegawai');
        $data['absen'] = $this->absensi->get_absen($id_pegawai, $bulan, $tahun);
        $data['jam_kerja'] = (array) $this->jam->get_all();
        $data['all_bulan'] = bulan();
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['hari'] = hari_bulan($bulan, $tahun);

        $this->load->view('templates_manajer/header', $data);
        $this->load->view('templates_manajer/sidebar',);
        $this->load->view('manajer/absensi/detail', $data);
        $this->load->view('templates_manajer/footer');

        return $data;
    }

    public function detail_absensi($id)
    {
        $data = $this->detail_data_absen();
        $this->load->view('templates_manajer/header', $data);
        $this->load->view('templates_manajer/sidebar',);
        $this->load->view('manajer/absensi/detail', $data);
        $this->load->view('templates_manajer/footer');
    }

    public function check_absen()
    {
        $data['title'] = "Absen";
        $now = date('H:i:s');
        $data['absen'] = $this->absensi->absen_harian_user($this->session->id_pegawai)->num_rows();
        $this->load->view('templates_manajer/header', $data);
        $this->load->view('templates_manajer/sidebar',);
        $this->load->view('manajer/absensi/absen', $data);
        $this->load->view('templates_manajer/footer');
    }

    public function absen()
    {
        $data['title'] = "Absen";
        if (@$this->uri->segment(3)) {
            $keterangan = ucfirst($this->uri->segment(3));
        } else {
            $absen_harian = $this->absensi->absen_harian_user($this->session->id_pegawai)->num_rows();
            $keterangan = ($absen_harian < 2 && $absen_harian < 1) ? 'Masuk' : 'Pulang';
        }

        $data = [
            'tgl' => date('Y-m-d'),
            'waktu' => date('H:i:s'),
            'keterangan' => $keterangan,
            'id_pegawai' => $this->session->id_pegawai
        ];
        $result = $this->absensi->insert_data($data);
        if ($result) {
            $this->session->set_flashdata('response', [
                'status' => 'success',
                'message' => 'Absensi berhasil dicatat'
            ]);
        } else {
            $this->session->set_flashdata('response', [
                'status' => 'error',
                'message' => 'Absensi gagal dicatat'
            ]);
        }
        redirect('manajer/absensi/detail_absensi');
    }


    private function detail_data_absen()
    {
        $id_pegawai = @$this->uri->segment(3) ? $this->uri->segment(3) : $this->session->id_pegawai;
        $bulan = @$this->input->get('bulan') ? $this->input->get('bulan') : date('m');
        $tahun = @$this->input->get('tahun') ? $this->input->get('tahun') : date('Y');
        $data['title'] = "Absen";
        $data['karyawan'] = $this->karyawan->find($id_pegawai);

        $nama = $this->input->post('nama_pegawai');
        $data['absen'] = $this->absensi->get_absen($id_pegawai, $bulan, $tahun);
        $data['jam_kerja'] = (array) $this->jam->get_all();
        $data['all_bulan'] = bulan();
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['hari'] = hari_bulan($bulan, $tahun);


        return $data;
    }
}


/* End of File: d:\Ampps\www\project\absen-pegawai\application\controllers\Absensi.php */