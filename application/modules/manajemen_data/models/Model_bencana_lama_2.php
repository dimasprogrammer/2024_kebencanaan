<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of bencana model
 *
 * @author Dimas Dwi Randa
 */

class Model_bencana extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /*Fungsi Get Data List*/
    var $search = array('a.nama_bencana');
    public function get_datatables($param)
    {
        $this->_get_datatables_query($param);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_filtered($param)
    {
        $this->_get_datatables_query($param);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        return $this->db->count_all_results('ms_bencana');
    }

    private function _get_datatables_query($param)
    {
        $post = array();
        if (is_array($param)) {
            foreach ($param as $v) {
                $post[$v['name']] = $v['value'];
            }
        }

        $this->db->select('a.id_bencana,
                           a.token_bencana,
                           a.nama_bencana,
                           a.tanggal_bencana,
                           b.nm_regency');
        $this->db->from('ms_bencana a');
        $this->db->join('wil_regency b', 'b.id_regency = a.id_regency', 'INNER');
        // $this->db->join('cx_jenis_bencana b', 'a.id_jenis_bencana = b.id_jenis_bencana', 'inner');
        // if (!empty($id_tahapan_bencana)) {
        //     $this->db->where('a.id_tahapan_bencana', $id_tahapan_bencana);
        // }
        $i = 0;
        foreach ($this->search as $item) { // loop column
            if ($_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        $this->db->order_by('a.id_bencana DESC');
    }

    /*Fungsi get data edit by id*/
    public function getDataDetailBencana($token_bencana)
    {
        $this->db->select('a.id_bencana,
                           a.token_bencana,
                           a.tanggal_bencana,
                           a.kategori_tanggap,
                           a.id_regency,
                           a.id_district,
                           a.id_village,
                           a.jorong,
                           a.id_jenis_bencana,
                           a.nama_bencana,
                           a.keterangan_bencana,
                           a.penyebab_bencana,
                           a.nama_file,
                           a.nama_file_infografis,
                           a.id_status,
                           a.create_date,
                           b.nm_bencana as jenis_bencana');
        $this->db->from('ms_bencana a');
        $this->db->join('cx_jenis_bencana b', 'a.id_jenis_bencana = b.id_jenis_bencana', 'inner');
        $this->db->where('token_bencana', $token_bencana);
        $query = $this->db->get();
        return $query->row_array();
    }

    /* Fungsi untuk insert data */
    public function insertDataBencana()
    {
        //get data
        $token_bencana          =  $this->uuid->v4(true);
        $create_by              = $this->app_loader->current_user();
        $create_date            = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip              = $this->input->ip_address();
        $tanggal_bencana        = escape($this->input->post('tanggal_bencana', TRUE));
        $kategori_tanggap       = escape($this->input->post('kategori_tanggap', TRUE));
        $id_regency             = escape($this->input->post('id_regency', TRUE));
        $id_district            = escape($this->input->post('id_district', TRUE));
        $id_village             = escape($this->input->post('id_village', TRUE));
        $jorong                 = escape($this->input->post('jorong', TRUE));
        $id_jenis_bencana       = escape($this->input->post('id_jenis_bencana', TRUE));
        $nama_bencana           = escape($this->input->post('nama_bencana', TRUE));
        $keterangan_bencana     = escape($this->input->post('keterangan_bencana', TRUE));
        $penyebab_bencana       = escape($this->input->post('penyebab_bencana', TRUE));
        $nama_file              = escape($this->input->post('nama_file', TRUE));
        $nama_file_infografis   = escape($this->input->post('nama_file_infografis', TRUE));

        //cek nama fungsi duplicate
        $this->db->where('tanggal_bencana', $tanggal_bencana);
        $checkData = $this->db->count_all_results('ms_bencana');
        if ($checkData > 0) {
            return array('response' => 'ERROR', 'nama' =>  $tanggal_bencana);
        } else {
            $year    = date('Y');
            $month   = date('m');

            //--------------------------- foto bencana -------------------------------//
            $dirname = 'dokumen/bencana/' . $year . '/' . $month . '/';
            if (!is_dir($dirname)) {
                mkdir('./' . $dirname, 0777, TRUE);
            }

            $_FILES['file']['name']     = $_FILES['nama_file']['name'];
            $_FILES['file']['type']     = $_FILES['nama_file']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['nama_file']['tmp_name'];
            $_FILES['file']['error']    = $_FILES['nama_file']['error'];
            $_FILES['file']['size']     = $_FILES['nama_file']['size'];
            $config = array(
                'upload_path'      => './' . $dirname . '/',
                'allowed_types'    => 'png|jpg|jpeg|pdf',
                'file_name'        => 'file_' . date('YmdHis', strtotime($create_date)),
                'file_ext_tolower' => TRUE,
                'max_size'         => 5024,
                'max_filename'     => 0,
                'remove_spaces'    => TRUE,
            );

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('file')) {
                $nama_file = '';
            } else {
                $upload_data = $this->upload->data();
                $nama_file   = $upload_data['file_name'];
            }
            //--------------------------- foto bencana -------------------------------//

            //--------------------------- foto infografis -------------------------------//
            $dirname = 'dokumen/infografis/' . $year . '/' . $month . '/';
            if (!is_dir($dirname)) {
                mkdir('./' . $dirname, 0777, TRUE);
            }

            $_FILES['file']['name']     = $_FILES['nama_file_infografis']['name'];
            $_FILES['file']['type']     = $_FILES['nama_file_infografis']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['nama_file_infografis']['tmp_name'];
            $_FILES['file']['error']    = $_FILES['nama_file_infografis']['error'];
            $_FILES['file']['size']     = $_FILES['nama_file_infografis']['size'];
            $config = array(
                'upload_path'      => './' . $dirname . '/',
                'allowed_types'    => 'png|jpg|jpeg|pdf',
                'file_name'        => 'file_' . date('YmdHis', strtotime($create_date)),
                'file_ext_tolower' => TRUE,
                'max_size'         => 5024,
                'max_filename'     => 0,
                'remove_spaces'    => TRUE,
            );

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('file')) {
                $nama_file_infografis = '';
            } else {
                $upload_data = $this->upload->data();
                $nama_file_infografis   = $upload_data['file_name'];
            }
            //--------------------------- foto infografis -------------------------------//

            $data = array(
                'token_bencana'          => $token_bencana,
                'tanggal_bencana'        => !empty($tanggal_bencana) ? $tanggal_bencana : '',
                'kategori_tanggap'       => !empty($kategori_tanggap) ? $kategori_tanggap : '',
                'id_regency'             => !empty($id_regency) ? $id_regency : '',
                'id_district'            => !empty($id_district) ? $id_district : '',
                'id_village'             => !empty($id_village) ? $id_village : '',
                'jorong'                 => !empty($jorong) ? $jorong : '',
                'id_jenis_bencana'       => !empty($id_jenis_bencana) ? $id_jenis_bencana : '',
                'nama_bencana'           => !empty($nama_bencana) ? $nama_bencana : '',
                'keterangan_bencana'     => !empty($keterangan_bencana) ? $keterangan_bencana : '',
                'penyebab_bencana'       => !empty($penyebab_bencana) ? $penyebab_bencana : '',
                'nama_file'              => $nama_file,
                'nama_file_infografis'   => $nama_file_infografis,
                'id_status'              => 1,
                'create_by'              => $create_by,
                'create_date'            => $create_date,
                'create_ip'              => $create_ip,
                'mod_by'                 => $create_by,
                'mod_date'               => $create_date,
                'mod_ip'                 => $create_ip
            );
            // print_r($data);
            // die;
            /*query insert*/
            $this->db->insert('ms_bencana', $data);
            return array('response' => 'SUCCESS', 'nama' =>  $tanggal_bencana);
        }
    }

    public function unlink_data($directory, $year, $month, $ct)
    {
        if (!$ct == "") {
            $foto = $directory . '/' . $year . '/' . $month . '/' . $ct;
            if (file_exists($foto)) {
                unlink($foto);
            }
        }
    }

    /* Fungsi untuk update data */
    public function updateDataBencana()
    {
        //get data
        $create_by        = $this->app_loader->current_user();
        $create_date   = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip     = $this->input->ip_address();
        // $token_bencana     = escape($this->input->post('token_bencana', TRUE));
        $token_bencana = escape($this->input->post('tokenId', TRUE));
        $tanggal_bencana        = escape($this->input->post('tanggal_bencana', TRUE));
        $kategori_tanggap       = escape($this->input->post('kategori_tanggap', TRUE));
        $id_regency             = escape($this->input->post('id_regency', TRUE));
        $id_district            = escape($this->input->post('id_district', TRUE));
        $id_village             = escape($this->input->post('id_village', TRUE));
        $jorong                 = escape($this->input->post('jorong', TRUE));
        $id_jenis_bencana       = escape($this->input->post('id_jenis_bencana', TRUE));
        $nama_bencana           = escape($this->input->post('nama_bencana', TRUE));
        $keterangan_bencana     = escape($this->input->post('keterangan_bencana', TRUE));
        $penyebab_bencana       = escape($this->input->post('penyebab_bencana', TRUE));
        $nama_file              = escape($this->input->post('nama_file', TRUE));
        $nama_file_infografis   = escape($this->input->post('nama_file_infografis', TRUE));
        // var_dump($_FILES);
        // die;
        //cek data by id

        $year    = date('Y');
        $month   = date('m');

        //--------------------------- foto bencana -------------------------------//
        $dirname = 'dokumen/bencana/' . $year . '/' . $month . '/';
        if (!is_dir($dirname)) {
            mkdir('./' . $dirname, 0777, TRUE);
        }

        $_FILES['file']['name']     = $_FILES['nama_file']['name'];
        $filename = $_FILES['file']['name'];

        if ($filename != '') {
            $_FILES['file']['name']     = $_FILES['nama_file']['name'];
            $_FILES['file']['type']     = $_FILES['nama_file']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['nama_file']['tmp_name'];
            $_FILES['file']['error']    = $_FILES['nama_file']['error'];
            $_FILES['file']['size']     = $_FILES['nama_file']['size'];
            $config = array(
                'upload_path'         => './' . $dirname . '/',
                'allowed_types'     => 'png|jpg|jpeg|pdf',
                'file_name'            => 'file_' . date('YmdHis', strtotime($create_date)),
                'file_ext_tolower'    => TRUE,
                'max_size'             => 1024,
                'max_filename'         => 0,
                'remove_spaces'     => TRUE,
            );
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file')) {
                $nama_file = '';
            } else {
                $upload_data = $this->upload->data();
                $nama_file   = $upload_data['file_name'];
                $checkFile   = $this->getDataUpload($token_bencana);
                $file        = $checkFile['nama_file'];
                $year        = substr($checkFile['create_date'], 0, 4);
                $month       = substr($checkFile['create_date'], 5, 2);

                $dirname = 'dokumen/bencana/' . $year . '/' . $month . '/' . $file;
                if (file_exists($dirname)) {
                    unlink($dirname);
                }
                $dataGambar = array(
                    'nama_file'      => $nama_file
                );
                /*query update*/
                $this->db->where('token_bencana ', $token_bencana);
                $this->db->update('ms_bencana', $dataGambar);
            }
        } else {
            $dataBencana = array(
                'token_bencana'     => $token_bencana,
                'tanggal_bencana'        => !empty($tanggal_bencana) ? $tanggal_bencana : '',
                'kategori_tanggap'       => !empty($kategori_tanggap) ? $kategori_tanggap : '',
                'id_regency'             => !empty($id_regency) ? $id_regency : '',
                'id_district'            => !empty($id_district) ? $id_district : '',
                'id_village'             => !empty($id_village) ? $id_village : '',
                'jorong'                 => !empty($jorong) ? $jorong : '',
                'id_jenis_bencana'       => !empty($id_jenis_bencana) ? $id_jenis_bencana : '',
                'nama_bencana'           => !empty($nama_bencana) ? $nama_bencana : '',
                'keterangan_bencana'     => !empty($keterangan_bencana) ? $keterangan_bencana : '',
                'penyebab_bencana'       => !empty($penyebab_bencana) ? $penyebab_bencana : '',
                'mod_by'    => $create_by,
                'mod_date'  => $create_date,
                'mod_ip'    => $create_ip
            );
            /*query update*/
            $this->db->where('token_bencana ', $token_bencana);
            $this->db->update('ms_bencana', $dataBencana);
        }
        return array('response' => 'SUCCESS', 'nama' => $nama_bencana);
    }

    /* Fungsi untuk update data */
    public function updateDataShare()
    {
        //get data
        $create_by        = $this->app_loader->current_user();
        $create_date   = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip     = $this->input->ip_address();
        $token_bencana    = escape($this->input->post('tokenId', TRUE));
        $token_bencana_share    = escape($this->input->post('tokenIdShare', TRUE));
        $id_users_penerima   = escape($this->input->post('id_users_penerima', TRUE));
        // print_r($token_bencana_share);
        // die;
        // var_dump($_FILES);

        $dataShare = array(
            'token_bencana' => !empty($token_bencana) ? $token_bencana : '',
            'id_users_penerima' => !empty($id_users_penerima) ? $id_users_penerima : 0,
            'mod_by_prov'    => $create_by,
            'mod_date_prov'  => $create_date,
            'mod_ip_prov'    => $create_ip
        );

        /*query update*/
        $this->db->where('token_bencana_share ', $token_bencana_share);
        $this->db->update('ms_bencana_share', $dataShare);

        return array('response' => 'SUCCESS', 'nama' => '');
    }

    //--------------------------- FUNGSI UNTUK GET FILE BENCANA OPD -------------------------------//
    public function getDataUpload($token_bencana)
    {
        $this->db->select(' a.token_bencana, 
                            create_date,
                            a.nama_file,
                            a.nama_file_infografis');
        $this->db->from('ms_bencana a');
        $this->db->where('a.token_bencana', $token_bencana);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }
    //--------------------------- FUNGSI UNTUK GET FILE BENCANA OPD -------------------------------//
    //--------------------------- FUNGSI UNTUK DELETE FILE bencana OPD -------------------------------//

    //--------------------------- FUNGSI UNTUK DELETE FILE bencana OPD -------------------------------//

    public function getDataBencanaDetail($token_bencana)
    {
        $this->db->select('	a.id_bencana_share, 
							a.token_bencana, 
							a.token_bencana_share, 
							a.id_users_penerima,
                            c.fullname,
                            d.nm_instansi,
                            e.nm_regency');
        $this->db->from('ms_bencana_share a');
        $this->db->join('ms_bencana b', 'b.token_bencana = a.token_bencana', 'INNER');
        $this->db->join('xi_sa_users c', 'c.id_users = a.id_users_penerima', 'INNER');
        $this->db->join('cx_instansi_prov d', 'd.id_instansi = c.id_instansi', 'INNER');
        $this->db->join('wil_regency e', 'e.id_regency = c.id_regency', 'INNER');
        $this->db->where('a.token_bencana', $token_bencana);
        // $this->db->order_by('a.id_bencana_share DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    /*Fungsi get data edit by id*/
    public function getDataBencanaShare($token_bencana_share)
    {
        $this->db->select('	a.id_bencana_share, 
							a.token_bencana, 
							a.token_bencana_share, 
							a.id_users_penerima');
        $this->db->from('ms_bencana_share a');
        $this->db->join('ms_bencana b', 'b.token_bencana = a.token_bencana', 'INNER');
        $this->db->where('a.token_bencana_share', $token_bencana_share);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getDataCetakExcel($opd)
    {
        $this->db->select('a.id_bencana,
                           a.token_bencana,
                           a.nama_bencana,
                           a.id_jenis_bencana,
                           a.id_inisiator_bencana,
                           a.waktu_uji_coba,
                           a.waktu_penerapan,
                           a.id_tahapan_bencana,
                           a.waktu_penerapan,
                           a.status_bencana,
                           a.status_permohonan,
                           a.create_date,
                           b.nm_urusan_utama,
                           c.opd_id_name,
                           c.fullname,
                           d.nm_bentuk,
                           e.nm_urusan_utama');
        $this->db->from('ms_bencana a');
        $this->db->join('cx_urusan_utama b', 'a.id_urusan_utama = b.id_urusan_utama', 'inner');
        $this->db->join('xi_sa_users c', 'a.create_by = c.token_bencana', 'inner');
        $this->db->join('cx_bentuk_bencana d', 'a.id_bentuk_bencana = d.id_bentuk_bencana', 'inner');
        $this->db->join('cx_urusan_utama e', 'a.id_urusan_utama = e.id_urusan_utama', 'inner');
        if ($opd != '')
            $this->db->where('c.opd_id', $opd);
        $this->db->order_by('a.create_date DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
}

// This is the end of auth signin model
