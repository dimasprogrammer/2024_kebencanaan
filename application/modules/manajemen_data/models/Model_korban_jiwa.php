<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of korban_jiwa model
 *
 * @author Dimas Dwi Randa
 */

class Model_korban_jiwa extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /*Fungsi Get Data List*/
    var $search = array('a.nama_korban_jiwa');
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
        return $this->db->count_all_results('ms_korban_jiwa');
    }

    private function _get_datatables_query($param)
    {
        $post = array();
        if (is_array($param)) {
            foreach ($param as $v) {
                $post[$v['name']] = $v['value'];
            }
        }

        $this->db->select('a.id_korban_jiwa,
                           a.token_korban_jiwa,
                           a.nama_korban_jiwa,
                           a.tanggal_korban_jiwa');
        $this->db->from('ms_korban_jiwa a');
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
        $this->db->order_by('a.id_korban_jiwa DESC');
    }

    /*Fungsi get data edit by id*/
    public function getDataDetailkorban_jiwa($token_korban_jiwa)
    {
        $this->db->select('a.id_korban_jiwa,
                           a.token_korban_jiwa,
                           a.tanggal_korban_jiwa,
                           a.kategori_tanggap,
                           a.id_regency,
                           a.id_district,
                           a.id_village,
                           a.jorong,
                           a.id_jenis_korban_jiwa,
                           a.nama_korban_jiwa,
                           a.keterangan_korban_jiwa,
                           a.penyebab_korban_jiwa,
                           a.nama_file,
                           a.nama_file_infografis,
                           a.id_status,
                           a.create_date,
                           b.nm_korban_jiwa as jenis_korban_jiwa');
        $this->db->from('ms_korban_jiwa a');
        $this->db->join('cx_jenis_korban_jiwa b', 'a.id_jenis_korban_jiwa = b.id_jenis_korban_jiwa', 'inner');
        $this->db->where('token_korban_jiwa', $token_korban_jiwa);
        $query = $this->db->get();
        return $query->row_array();
    }

    /* Fungsi untuk insert data */
    public function insertDatakorban_jiwa()
    {
        //get data
        $token_korban_jiwa          =  $this->uuid->v4(true);
        $create_by              = $this->app_loader->current_user();
        $create_date            = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip              = $this->input->ip_address();
        $tanggal_korban_jiwa        = escape($this->input->post('tanggal_korban_jiwa', TRUE));
        $kategori_tanggap       = escape($this->input->post('kategori_tanggap', TRUE));
        $id_regency             = escape($this->input->post('id_regency', TRUE));
        $id_district            = escape($this->input->post('id_district', TRUE));
        $id_village             = escape($this->input->post('id_village', TRUE));
        $jorong                 = escape($this->input->post('jorong', TRUE));
        $id_jenis_korban_jiwa       = escape($this->input->post('id_jenis_korban_jiwa', TRUE));
        $nama_korban_jiwa           = escape($this->input->post('nama_korban_jiwa', TRUE));
        $keterangan_korban_jiwa     = escape($this->input->post('keterangan_korban_jiwa', TRUE));
        $penyebab_korban_jiwa       = escape($this->input->post('penyebab_korban_jiwa', TRUE));
        $nama_file              = escape($this->input->post('nama_file', TRUE));
        $nama_file_infografis   = escape($this->input->post('nama_file_infografis', TRUE));

        //cek nama fungsi duplicate
        $this->db->where('tanggal_korban_jiwa', $tanggal_korban_jiwa);
        $checkData = $this->db->count_all_results('ms_korban_jiwa');
        if ($checkData > 0) {
            return array('response' => 'ERROR', 'nama' =>  $tanggal_korban_jiwa);
        } else {
            $year    = date('Y');
            $month   = date('m');

            //--------------------------- foto korban_jiwa -------------------------------//
            $dirname = 'dokumen/korban_jiwa/' . $year . '/' . $month . '/';
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
            //--------------------------- foto korban_jiwa -------------------------------//

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
                'token_korban_jiwa'          => $token_korban_jiwa,
                'tanggal_korban_jiwa'        => !empty($tanggal_korban_jiwa) ? $tanggal_korban_jiwa : '',
                'kategori_tanggap'       => !empty($kategori_tanggap) ? $kategori_tanggap : '',
                'id_regency'             => !empty($id_regency) ? $id_regency : '',
                'id_district'            => !empty($id_district) ? $id_district : '',
                'id_village'             => !empty($id_village) ? $id_village : '',
                'jorong'                 => !empty($jorong) ? $jorong : '',
                'id_jenis_korban_jiwa'       => !empty($id_jenis_korban_jiwa) ? $id_jenis_korban_jiwa : '',
                'nama_korban_jiwa'           => !empty($nama_korban_jiwa) ? $nama_korban_jiwa : '',
                'keterangan_korban_jiwa'     => !empty($keterangan_korban_jiwa) ? $keterangan_korban_jiwa : '',
                'penyebab_korban_jiwa'       => !empty($penyebab_korban_jiwa) ? $penyebab_korban_jiwa : '',
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
            $this->db->insert('ms_korban_jiwa', $data);
            return array('response' => 'SUCCESS', 'nama' =>  $tanggal_korban_jiwa);
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
    public function updateDatakorban_jiwa()
    {
        //get data
        $create_by        = $this->app_loader->current_user();
        $create_date   = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip     = $this->input->ip_address();
        // $token_korban_jiwa     = escape($this->input->post('token_korban_jiwa', TRUE));
        $token_korban_jiwa = escape($this->input->post('tokenId', TRUE));
        $tanggal_korban_jiwa        = escape($this->input->post('tanggal_korban_jiwa', TRUE));
        $kategori_tanggap       = escape($this->input->post('kategori_tanggap', TRUE));
        $id_regency             = escape($this->input->post('id_regency', TRUE));
        $id_district            = escape($this->input->post('id_district', TRUE));
        $id_village             = escape($this->input->post('id_village', TRUE));
        $jorong                 = escape($this->input->post('jorong', TRUE));
        $id_jenis_korban_jiwa       = escape($this->input->post('id_jenis_korban_jiwa', TRUE));
        $nama_korban_jiwa           = escape($this->input->post('nama_korban_jiwa', TRUE));
        $keterangan_korban_jiwa     = escape($this->input->post('keterangan_korban_jiwa', TRUE));
        $penyebab_korban_jiwa       = escape($this->input->post('penyebab_korban_jiwa', TRUE));
        $nama_file              = escape($this->input->post('nama_file', TRUE));
        $nama_file_infografis   = escape($this->input->post('nama_file_infografis', TRUE));
        // var_dump($_FILES);
        // die;
        //cek data by id

        $year    = date('Y');
        $month   = date('m');

        //--------------------------- foto korban_jiwa -------------------------------//
        $dirname = 'dokumen/korban_jiwa/' . $year . '/' . $month . '/';
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
                $checkFile   = $this->getDataUpload($token_korban_jiwa);
                $file        = $checkFile['nama_file'];
                $year        = substr($checkFile['create_date'], 0, 4);
                $month       = substr($checkFile['create_date'], 5, 2);

                $dirname = 'dokumen/korban_jiwa/' . $year . '/' . $month . '/' . $file;
                if (file_exists($dirname)) {
                    unlink($dirname);
                }
                $dataGambar = array(
                    'nama_file'      => $nama_file
                );
                /*query update*/
                $this->db->where('token_korban_jiwa ', $token_korban_jiwa);
                $this->db->update('ms_korban_jiwa', $dataGambar);
            }
        } else {
            $datakorban_jiwa = array(
                'token_korban_jiwa'     => $token_korban_jiwa,
                'tanggal_korban_jiwa'        => !empty($tanggal_korban_jiwa) ? $tanggal_korban_jiwa : '',
                'kategori_tanggap'       => !empty($kategori_tanggap) ? $kategori_tanggap : '',
                'id_regency'             => !empty($id_regency) ? $id_regency : '',
                'id_district'            => !empty($id_district) ? $id_district : '',
                'id_village'             => !empty($id_village) ? $id_village : '',
                'jorong'                 => !empty($jorong) ? $jorong : '',
                'id_jenis_korban_jiwa'       => !empty($id_jenis_korban_jiwa) ? $id_jenis_korban_jiwa : '',
                'nama_korban_jiwa'           => !empty($nama_korban_jiwa) ? $nama_korban_jiwa : '',
                'keterangan_korban_jiwa'     => !empty($keterangan_korban_jiwa) ? $keterangan_korban_jiwa : '',
                'penyebab_korban_jiwa'       => !empty($penyebab_korban_jiwa) ? $penyebab_korban_jiwa : '',
                'mod_by'    => $create_by,
                'mod_date'  => $create_date,
                'mod_ip'    => $create_ip
            );
            /*query update*/
            $this->db->where('token_korban_jiwa ', $token_korban_jiwa);
            $this->db->update('ms_korban_jiwa', $datakorban_jiwa);
        }
        return array('response' => 'SUCCESS', 'nama' => $nama_korban_jiwa);
    }

    /* Fungsi untuk update data */
    public function updateDataShare()
    {
        //get data
        $create_by        = $this->app_loader->current_user();
        $create_date   = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip     = $this->input->ip_address();
        $token_korban_jiwa    = escape($this->input->post('tokenId', TRUE));
        $token_korban_jiwa_share    = escape($this->input->post('tokenIdShare', TRUE));
        $id_users_penerima   = escape($this->input->post('id_users_penerima', TRUE));
        // print_r($token_korban_jiwa_share);
        // die;
        // var_dump($_FILES);

        $dataShare = array(
            'token_korban_jiwa' => !empty($token_korban_jiwa) ? $token_korban_jiwa : '',
            'id_users_penerima' => !empty($id_users_penerima) ? $id_users_penerima : 0,
            'mod_by_prov'    => $create_by,
            'mod_date_prov'  => $create_date,
            'mod_ip_prov'    => $create_ip
        );

        /*query update*/
        $this->db->where('token_korban_jiwa_share ', $token_korban_jiwa_share);
        $this->db->update('ms_korban_jiwa_share', $dataShare);

        return array('response' => 'SUCCESS', 'nama' => '');
    }

    //--------------------------- FUNGSI UNTUK GET FILE korban_jiwa OPD -------------------------------//
    public function getDataUpload($token_korban_jiwa)
    {
        $this->db->select(' a.token_korban_jiwa, 
                            create_date,
                            a.nama_file,
                            a.nama_file_infografis');
        $this->db->from('ms_korban_jiwa a');
        $this->db->where('a.token_korban_jiwa', $token_korban_jiwa);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }
    //--------------------------- FUNGSI UNTUK GET FILE korban_jiwa OPD -------------------------------//
    //--------------------------- FUNGSI UNTUK DELETE FILE korban_jiwa OPD -------------------------------//

    //--------------------------- FUNGSI UNTUK DELETE FILE korban_jiwa OPD -------------------------------//

    public function getDatakorban_jiwaDetail($token_korban_jiwa)
    {
        $this->db->select('	a.id_korban_jiwa_share, 
							a.token_korban_jiwa, 
							a.token_korban_jiwa_share, 
							a.id_users_penerima,
                            c.fullname,
                            d.nm_instansi,
                            e.nm_regency');
        $this->db->from('ms_korban_jiwa_share a');
        $this->db->join('ms_korban_jiwa b', 'b.token_korban_jiwa = a.token_korban_jiwa', 'INNER');
        $this->db->join('xi_sa_users c', 'c.id_users = a.id_users_penerima', 'INNER');
        $this->db->join('cx_instansi_prov d', 'd.id_instansi = c.id_instansi', 'INNER');
        $this->db->join('wil_regency e', 'e.id_regency = c.id_regency', 'INNER');
        $this->db->where('a.token_korban_jiwa', $token_korban_jiwa);
        // $this->db->order_by('a.id_korban_jiwa_share DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    /*Fungsi get data edit by id*/
    public function getDatakorban_jiwaShare($token_korban_jiwa_share)
    {
        $this->db->select('	a.id_korban_jiwa_share, 
							a.token_korban_jiwa, 
							a.token_korban_jiwa_share, 
							a.id_users_penerima');
        $this->db->from('ms_korban_jiwa_share a');
        $this->db->join('ms_korban_jiwa b', 'b.token_korban_jiwa = a.token_korban_jiwa', 'INNER');
        $this->db->where('a.token_korban_jiwa_share', $token_korban_jiwa_share);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getDataCetakExcel($opd)
    {
        $this->db->select('a.id_korban_jiwa,
                           a.token_korban_jiwa,
                           a.nama_korban_jiwa,
                           a.id_jenis_korban_jiwa,
                           a.id_inisiator_korban_jiwa,
                           a.waktu_uji_coba,
                           a.waktu_penerapan,
                           a.id_tahapan_korban_jiwa,
                           a.waktu_penerapan,
                           a.status_korban_jiwa,
                           a.status_permohonan,
                           a.create_date,
                           b.nm_urusan_utama,
                           c.opd_id_name,
                           c.fullname,
                           d.nm_bentuk,
                           e.nm_urusan_utama');
        $this->db->from('ms_korban_jiwa a');
        $this->db->join('cx_urusan_utama b', 'a.id_urusan_utama = b.id_urusan_utama', 'inner');
        $this->db->join('xi_sa_users c', 'a.create_by = c.token_korban_jiwa', 'inner');
        $this->db->join('cx_bentuk_korban_jiwa d', 'a.id_bentuk_korban_jiwa = d.id_bentuk_korban_jiwa', 'inner');
        $this->db->join('cx_urusan_utama e', 'a.id_urusan_utama = e.id_urusan_utama', 'inner');
        if ($opd != '')
            $this->db->where('c.opd_id', $opd);
        $this->db->order_by('a.create_date DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
}

// This is the end of auth signin model
