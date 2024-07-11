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
                           a.jam_bencana,
                           a.id_status,
                           b.nm_bencana');
        $this->db->from('ms_bencana a');
        $this->db->join('cx_jenis_bencana b', 'a.id_jenis_bencana = b.id_jenis_bencana', 'inner');
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
                           a.id_jenis_bencana,
                           a.nama_bencana,
                           a.tanggal_bencana,
                           a.jam_bencana,
                           a.latitude,
                           a.latitude,
                           a.longitude,
                           a.address,
                           a.id_status,
                           a.create_date,
                           a.nama_file,
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
        $token_bencana      =  $this->uuid->v4(true);
        $create_by             = $this->app_loader->current_user();
        $create_date        = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip          = $this->input->ip_address();
        $nama_bencana       = escape($this->input->post('nama_bencana', TRUE));
        $id_users            = escape($this->input->post('id_users', TRUE));
        // $group         = escape($this->input->post('groupid', TRUE));
        // $string = implode(".", $id_users);
        // print_r($id_users);
        // die;
        $id_jenis_bencana            = escape($this->input->post('id_jenis_bencana', TRUE));
        $tanggal_bencana            = escape($this->input->post('tanggal_bencana', TRUE));
        $jam_bencana        = escape($this->input->post('jam_bencana', TRUE));
        $latitude           = escape($this->input->post('latitude', TRUE));
        $longitude          = escape($this->input->post('longitude', TRUE));
        $address            = escape($this->input->post('address', TRUE));
        $nama_file          = escape($this->input->post('nama_file', TRUE));
        $id_status          = escape($this->input->post('id_status', TRUE));

        //cek nama fungsi duplicate
        $this->db->where('tanggal_bencana', $tanggal_bencana);
        $checkData = $this->db->count_all_results('ms_bencana');
        if ($checkData > 0) {
            return array('response' => 'ERROR', 'nama' =>  $tanggal_bencana);
        } else {
            $year    = date('Y');
            $month   = date('m');
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

            $data = array(
                'token_bencana'     => $token_bencana,
                'id_jenis_bencana'  => !empty($id_jenis_bencana) ? $id_jenis_bencana : 0,
                'nama_bencana'      => !empty($nama_bencana) ? $nama_bencana : '',
                'tanggal_bencana'           => !empty($tanggal_bencana) ? $tanggal_bencana : '',
                'jam_bencana'       => !empty($jam_bencana) ? $jam_bencana : '',
                'latitude'          => !empty($latitude) ? $latitude : '',
                'longitude'         => !empty($longitude) ? $longitude : '',
                'address'           => !empty($address) ? $address : '',
                'nama_file'         => $nama_file,
                'id_status'         => $id_status,
                'create_by'         => $create_by,
                'create_date'       => $create_date,
                'create_ip'         => $create_ip,
                'mod_by'            => $create_by,
                'mod_date'          => $create_date,
                'mod_ip'            => $create_ip
            );
            // print_r($data);
            // die;
            /*query insert*/
            $this->db->insert('ms_bencana', $data);
            $token_bencana_share      =  $this->uuid->v4(true);
            $jumlah_pengungsi = isset($post['jumlah_pengungsi']) && $post['jumlah_pengungsi'] !== '' ? $post['jumlah_pengungsi'] : NULL;
            $jumlah_terdampak = isset($post['jumlah_terdampak']) && $post['jumlah_terdampak'] !== '' ? $post['jumlah_terdampak'] : NULL;
            foreach ($id_users as $id) {
                $data_file = array(
                    'token_bencana_share' => $token_bencana_share,
                    'token_bencana'        => $token_bencana,
                    'id_users_penerima'    => $id,
                    'jumlah_pengungsi'     => $jumlah_pengungsi,
                    'jumlah_terdampak'     => $jumlah_terdampak,
                );
                /*query insert*/
                $this->db->insert('ms_bencana_share', $data_file);
            }
            return array('response' => 'SUCCESS', 'nama' =>  $tanggal_bencana);
        }
    }

    private function getDatabencanaById($token_bencana)
    {
        $this->db->where('token_bencana', $token_bencana);
        $query = $this->db->get('ms_bencana');
        return $query->row_array();
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

    /*Fungsi get data by id*/
    public function getDataFile($id)
    {
        $this->db->where('token_bencana', $id);
        $query = $this->db->get('ms_bencana_file');
        return $query->result_array();
    }

    /* Fungsi untuk update data */
    public function updateDatabencana()
    {
        $create_by            = $this->app_loader->current_account();
        $create_date          = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip            = $this->input->ip_address();
        $token_bencana                = escape($this->input->post('token_bencanaId', TRUE));
        $nama_bencana         = escape($this->input->post('nama_bencana', TRUE));
        $id_tahapan_bencana   = escape($this->input->post('id_tahapan_bencana', TRUE));
        $id_inisiator_bencana = escape($this->input->post('id_inisiator_bencana', TRUE));
        $id_jenis_bencana     = escape($this->input->post('id_jenis_bencana', TRUE));
        $id_bentuk_bencana    = escape($this->input->post('id_bentuk_bencana', TRUE));
        $id_tematik           = escape($this->input->post('id_tematik', TRUE));
        $id_urusan_utama      = escape($this->input->post('id_urusan_utama', TRUE));
        $id_urusan_lainnya    = escape($this->input->post('id_urusan_lainnya', TRUE));
        $waktuUjiCoba         = ($this->input->post('waktu_uji_coba', TRUE) != '') ? date_convert(escape($this->input->post('waktu_uji_coba', TRUE))) : '0000-00-00';
        $waktuPenerapan       = ($this->input->post('waktu_penerapan', TRUE) != '') ? date_convert(escape($this->input->post('waktu_penerapan', TRUE))) : '0000-00-00';
        $rancang_bangun       = escape($this->input->post('rancang_bangun', TRUE));
        $upload               = escape($this->input->post('upload', TRUE));

        // var_dump($upload);
        // die;

        //get id bencana
        $databencana = $this->getDatabencanaById($token_bencana);
        $token_bencana  = !empty($databencana) ? $databencana['token_bencana'] : '';

        $data = array(
            'nama_bencana'         => $nama_bencana,
            'token_bencana'                => $token_bencana,
            'id_tahapan_bencana'   => !empty($id_tahapan_bencana) ? $id_tahapan_bencana : 0,
            'id_inisiator_bencana' => !empty($id_inisiator_bencana) ? $id_inisiator_bencana : 0,
            'id_jenis_bencana'     => !empty($id_jenis_bencana) ? $id_jenis_bencana : 0,
            'id_bentuk_bencana'    => !empty($id_bentuk_bencana) ? $id_bentuk_bencana : 0,
            'id_tematik'           => !empty($id_tematik) ? $id_tematik : 0,
            'id_urusan_utama'      => !empty($id_urusan_utama) ? $id_urusan_utama : 0,
            'id_urusan_lainnya'    => !empty($id_urusan_lainnya) ? $id_urusan_lainnya : 0,
            'waktu_uji_coba'       => $waktuUjiCoba,
            'waktu_penerapan'      => $waktuPenerapan,
            'rancang_bangun'       => $rancang_bangun,
            'mod_by'               => $create_by,
            'mod_date'             => $create_date,
            'mod_ip'               => $create_ip
        );
        // print_r($upload);
        // die;
        $this->db->where('token_bencana', $token_bencana);
        $this->db->update('ms_bencana', $data);

        //---------------- INSERT INSERT UPLOAD FILE--------------//
        foreach ($upload as $key => $i) {
            // print_r($i);
            // die;
            //get aata lama 
            $this->db->where('token_bencana', $token_bencana);
            $this->db->where('id_category_file', $i);
            $dataOld    = $this->db->get('ms_bencana_file')->row_array();
            $nameFile   = !empty($dataOld) ? $dataOld['nama_file'] : '';
            $createDate = !empty($dataOld) ? $dataOld['create_date'] : date('Y-m-d');
            $year       = date('Y', strtotime(($createDate)));
            $month      = date('m', strtotime(($createDate)));

            $_FILES['file']['name']     = $_FILES['nama_file']['name'][$i];
            $_FILES['file']['type']     = $_FILES['nama_file']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['nama_file']['tmp_name'][$i];
            $_FILES['file']['error']    = $_FILES['nama_file']['error'][$i];
            $_FILES['file']['size']     = $_FILES['nama_file']['size'][$i];

            $dirnamefile = 'dokumen/bencana/' . $year . '/' . $month . '/';
            if (!is_dir($dirnamefile)) {
                mkdir('./' . $dirnamefile, 0777, TRUE);
            }
            $config = array(
                'upload_path'       => './' . $dirnamefile . '/',
                'allowed_types'     => 'png|jpg|jpeg|pdf',
                'file_name'         => 'foto_' . $i . '_' . $token_bencana . '.jpeg',
                'file_ext_tolower'  => TRUE,
                'max_size'          => 1024,
                'max_filename'      => 0,
                'remove_spaces'     => TRUE,
            );
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('file')) {
                $nama_file = '';
            } else {
                $this->unlink_data('dokumen/bencana/', $year, $month, $nameFile);
                $upload_data = $this->upload->data();
                $nama_file   = $upload_data['file_name'];
            }

            if (count($dataOld) <= 0) {
                $data_file = array(
                    'token_bencana'            => $token_bencana,
                    'id_category_file' => $i,
                    'nama_file'        => $nama_file,
                    'mod_by'           => $create_by,
                    'mod_date'         => $create_date,
                    'mod_ip'           => $create_ip
                );
                /*query insert*/
                $this->db->insert('ms_bencana_file', $data_file);
            } else {
                /*query update*/
                if ($nama_file != '') {
                    $this->db->set('nama_file', $nama_file);
                }
                $this->db->set('mod_date', $create_date);
                $this->db->set('mod_ip', $create_ip);
                $this->db->where('token_bencana', $token_bencana);
                $this->db->where('id_category_file', $i);
                $this->db->update('ms_bencana_file');
            }
        }
        //---------------- END INSERT TABEL UPLOAD FILE --------------//
        return array('response' => 'SUCCESS', 'kode' => '', 'nama' => $nama_bencana);
    }

    //--------------------------- FUNGSI UNTUK DELETE FILE bencana OPD -------------------------------//
    public function deleteDatabencana()
    {
        $token_bencana = escape($this->input->post('token_bencanaId', TRUE));
        $databencana = $this->getDataDetailbencana($token_bencana);
        $nama_bencana = !empty($databencana) ? $databencana['nama_bencana'] : '';
        $this->deleteDataFilebencana($token_bencana);
        $this->db->where('token_bencana', $token_bencana);
        $this->db->delete('ms_bencana');
        return array('response' => 'SUCCESS', 'nama' => $nama_bencana);
    }

    public function deleteDataDetailBencana()
    {
        $token_bencana_share = escape($this->input->post('token_bencana$token_bencana_shareId', TRUE));
        $databencana = $this->getDataDetailbencana($token_bencana_share);
        $nama_bencana = !empty($databencana) ? $databencana['nama_bencana'] : '';
        $this->deleteDataFilebencana($token_bencana_share);
        $this->db->where('token_bencana$token_bencana_share', $token_bencana_share);
        $this->db->delete('ms_bencana');
        return array('response' => 'SUCCESS', 'nama' => $nama_bencana);
    }

    public function getDataUploadFile($token_bencana)
    {
        $this->db->select(' 
                            a.create_date, 
							a.id_bencana_file, 
							a.nama_file');
        $this->db->from('ms_bencana_file a');
        $this->db->join('ms_bencana b', 'b.token_bencana = a.token_bencana', 'INNER');
        $this->db->where('a.token_bencana', $token_bencana);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function deleteDataFilebencana($token_bencana)
    {
        // $token_bencana = escape($this->input->post('token_bencana', TRUE));
        $checkFile     = $this->getDataUploadFile($token_bencana);
        foreach ($checkFile as $file) {
            $nama_file = $file['nama_file'];
            $year       = date('Y', strtotime(($file['create_date'])));
            $month      = date('m', strtotime(($file['create_date'])));
            if (($nama_file != "") && file_exists('dokumen/bencana/' . $year . '/' . $month . '/' . $nama_file)) {
                $path = str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']);
                $direktori    = $path . 'dokumen/bencana/' . $year . '/' . $month . '/';
                if (file_exists($direktori . '/' . $nama_file))
                    unlink($direktori . '/' . $nama_file);
            }
        }

        $this->db->where('token_bencana', $token_bencana);
        $this->db->delete('ms_bencana_file');
    }
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
