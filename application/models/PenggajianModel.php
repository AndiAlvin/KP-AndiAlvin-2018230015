<?php
class PenggajianModel extends CI_Model
{
    public function get_jam()
    {
        $result = $this->db->get('jam');
        return $result->result();
    }

    public function find_jam($id)
    {
        $this->db->where('id_jam', $id);
        $result = $this->db->get('jam');
        return $result->row();
    }


    public function update_jam($id, $data)
    {
        $this->db->where('id_jam', $id);
        $result = $this->db->update('jam', $data);
        return $result;
    }
    public function get_data($table)
    {
        return $this->db->get($table);
    }
    public function insert_data($data, $table)
    {
        $this->db->insert($table, $data);
    }
    public function update_data($table, $data, $where)
    {
        $this->db->update($table, $data, $where);
    }
    public function  delete_data($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function insert_batch($table = null, $data = array())
    {
        $jumlah = count($data);
        if ($jumlah > 0) {
            $this->db->insert_batch($table, $data);
        }
    }
    public function cek_login()
    {
        $username       = set_value('username');
        $password       = set_value('password');

        $result         = $this->db->where('username', $username)
            ->where('password', md5($password))
            ->limit(1)
            ->get('data_pegawai');
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return FALSE;
        }
    }
    public function get_keyword($keyword)
    {
        $this->db->select('*');
        $this->db->from('data_pegawai');
        $this->db->like('nama_pegawai', $keyword);
        $this->db->or_like('nik', $keyword);
        $this->db->or_like('jenis_kelamin', $keyword);
        $this->db->or_like('status', $keyword);
        $this->db->or_like('jabatan', $keyword);
        return $this->db->get()->result();
    }
    public function get_keywordjabatan($keyword)
    {
        $this->db->select('*');
        $this->db->from('data_jabatan');
        $this->db->like('nama_jabatan', $keyword);
        $this->db->or_like('gaji_pokok', $keyword);
        $this->db->or_like('tj_transport', $keyword);
        $this->db->or_like('uang_makan', $keyword);
        return $this->db->get()->result();
    }

    public function get_absen($id_pegawai, $bulan, $tahun)
    {
        $this->db->select("DATE_FORMAT(a.tgl, '%d-%m-%Y') AS tgl, a.waktu AS jam_masuk, (SELECT waktu FROM absensi al WHERE al.tgl = a.tgl AND id_pegawai = '6' AND al.keterangan != a.keterangan) AS jam_pulang");
        $this->db->where('id_pegawai', $id_pegawai);
        $this->db->where("DATE_FORMAT(tgl, '%m') = ", $bulan);
        $this->db->where("DATE_FORMAT(tgl, '%Y') = ", $tahun);
        $this->db->group_by("tgl");
        $result = $this->db->get('absensi a');
        return $result->result_array();
    }

    public function absen_harian_user($id_pegawai)
    {
        $today = date('Y-m-d');
        $this->db->where('tgl', $today);
        $this->db->where('id_pegawai', $id_pegawai);
        $data = $this->db->get('absensi');
        return $data;
    }

    public function insert_dataabsen($data)
    {
        $result = $this->db->insert('absensi', $data);
        return $result;
    }

    public function get_jam_by_time($time)
    {
        $this->db->where('start', $time, '<=');
        $this->db->or_where('finish', $time, '>=');
        $data = $this->db->get('jam');
        return $data->row();
    }

    function get_namapegawaisatu($id_pegawai)
    {
        $pegawaiambil = array();
        $this->db->select("*");
        $this->db->from("data_pegawai");
        $this->db->where("id_pegawai", $id_pegawai);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $pegawaiambil = $query->result();
        }
        return $pegawaiambil;
    }

    public function find($id_pegawai)
    {
        $this->db->join('data_jabatan', 'data_pegawai.jabatan = data_jabatan.id_jabatan', 'LEFT');
        $this->db->where('id_pegawai', $id_pegawai);
        $result = $this->db->get('data_pegawai');
        return $result->row_array();
    }
    public function get_all()
    {
        $this->db->join('data_jabatan', 'data_pegawai.jabatan = data_jabatan.id_jabatan', 'LEFT');
        $this->db->where('hak_akses', '2');
        $result = $this->db->get('data_pegawai');
        return $result->result();
    }
    public function detail_data($id_pegawai = NULL)
    {
        $query = $this->db->get_where('data_pegawai', array('id_pegawai' => $id_pegawai))->row();
        return $query;
    }
}
