<?php
defined('BASEPATH') or die('No direct script access allowed!');

class Karyawan_model extends CI_Model
{
    public function get_all()
    {
        $this->db->join('data_jabatan', 'data_pegawai.jabatan = data_jabatan.id_jabatan', 'LEFT');
        $this->db->where('hak_akses', '2');
        $result = $this->db->get('data_pegawai');
        return $result->result();
    }

    public function find($id_pegawai)
    {
        $this->db->join('data_jabatan', 'data_pegawai.jabatan = data_jabatan.id_jabatan', 'LEFT');
        $this->db->where('id_pegawai', $id_pegawai);
        $result = $this->db->get('data_pegawai');
        // return $result->row();
        return $result->result_array();
    }

    public function insert_data($data)
    {
        $result = $this->db->insert('data_pegawai', $data);
        return $result;
    }

    public function update_data($id_pegawai, $data)
    {
        $this->db->where('id_pegawai', $id_pegawai);
        $result = $this->db->update('data_pegawai', $data);
        return $result;
    }

    public function delete_data($id_pegawai)
    {
        $this->db->where('id_pegawai', $id_pegawai);
        $result = $this->db->delete('data_pegawai');
        return $result;
    }
}


/* End of File: d:\Ampps\www\project\absen-pegawai\application\models\Karyawan_model.php */