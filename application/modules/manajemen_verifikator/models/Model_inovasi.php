<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of inovasi model
 *
 * @author Dimas Dwi Randa
 */

class Model_inovasi extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /*Fungsi Get Data List*/
    var $search = array('nama_inovasi');
    public function get_datatables($id_tahapan_inovasi, $param)
    {
        $this->_get_datatables_query($id_tahapan_inovasi, $param);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_filtered($id_tahapan_inovasi, $param)
    {
        $this->_get_datatables_query($id_tahapan_inovasi, $param);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        return $this->db->count_all_results('ms_inovasi');
    }

    private function _get_datatables_query($id_tahapan_inovasi, $param)
    {
        $iduser = $this->app_loader->current_userid();
        $post = array();
        $id_opd = null;
        if (is_array($param)) {
            foreach ($param as $v) {
                $post[$v['name']] = $v['value'];
                if ($v['name'] == 'opd') {
                    $id_opd = $v['value'];
                }
            }
        }
        $this->db->select('a.id_inovasi,
                           a.token,
                           a.nama_inovasi,
                           a.waktu_uji_coba,
                           a.waktu_penerapan,
                           a.id_tahapan_inovasi,
                           a.waktu_penerapan,
                           a.status_inovasi,
                           a.status_permohonan,
                           a.create_date,
                           b.nm_urusan_utama,
                           c.opd_id_name');
        $this->db->from('ms_inovasi a');
        $this->db->join('cx_urusan_utama b', 'a.id_urusan_utama = b.id_urusan_utama', 'inner');
        $this->db->join('xi_sa_users c', 'a.create_by = c.token', 'inner');
        if (!empty($id_tahapan_inovasi)) {
            $this->db->where('a.id_tahapan_inovasi', $id_tahapan_inovasi);
        }
        if ($id_opd) {
            $this->db->where('c.opd_id', $id_opd);
        }
        if ($this->app_loader->is_operator()) {
            $this->db->where('a.create_by', $iduser);
        }
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
        $this->db->where('a.status_permohonan', 1);
        $this->db->order_by('a.id_inovasi ASC');
    }

    /*Fungsi get data edit by id*/
    public function getDataDetailInovasi($id)
    {
        $this->db->where('token', $id);
        $query = $this->db->get('ms_inovasi');
        return $query->row_array();
    }

    /* Fungsi untuk insert data */
    public function insertDataInovasi()
    {
        //get data
        $token                =  $this->uuid->v4(true);
        $iduser               = $this->app_loader->current_userid();
        $create_date          = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip            = $this->input->ip_address();
        $nama_inovasi         = escape($this->input->post('nama_inovasi', TRUE));
        $id_tahapan_inovasi   = escape($this->input->post('id_tahapan_inovasi', TRUE));
        $id_inisiator_inovasi = escape($this->input->post('id_inisiator_inovasi', TRUE));
        $id_jenis_inovasi     = escape($this->input->post('id_jenis_inovasi', TRUE));
        $id_bentuk_inovasi    = escape($this->input->post('id_bentuk_inovasi', TRUE));
        $id_tematik           = escape($this->input->post('id_tematik', TRUE));
        $id_urusan_utama      = escape($this->input->post('id_urusan_utama', TRUE));
        $id_urusan_lainnya    = escape($this->input->post('id_urusan_lainnya', TRUE));
        $waktuUjiCoba         = ($this->input->post('waktu_uji_coba', TRUE) != '') ? date_convert(escape($this->input->post('waktu_uji_coba', TRUE))) : '0000-00-00';
        $waktuPenerapan       = ($this->input->post('waktu_penerapan', TRUE) != '') ? date_convert(escape($this->input->post('waktu_penerapan', TRUE))) : '0000-00-00';
        $rancang_bangun       = escape($this->input->post('rancang_bangun', TRUE));
        $upload               = escape($this->input->post('upload', TRUE));

        //cek nama fungsi duplicate
        $data = array(
            'nama_inovasi'         => $nama_inovasi,
            'token'                => $token,
            'id_tahapan_inovasi'   => !empty($id_tahapan_inovasi) ? $id_tahapan_inovasi : 0,
            'id_inisiator_inovasi' => !empty($id_inisiator_inovasi) ? $id_inisiator_inovasi : 0,
            'id_jenis_inovasi'     => !empty($id_jenis_inovasi) ? $id_jenis_inovasi : 0,
            'id_bentuk_inovasi'    => !empty($id_bentuk_inovasi) ? $id_bentuk_inovasi : 0,
            'id_tematik'           => !empty($id_tematik) ? $id_tematik : 0,
            'id_urusan_utama'      => !empty($id_urusan_utama) ? $id_urusan_utama : 0,
            'id_urusan_lainnya'    => !empty($id_urusan_lainnya) ? $id_urusan_lainnya : 0,
            'waktu_uji_coba'       => $waktuUjiCoba,
            'waktu_penerapan'      => $waktuPenerapan,
            'rancang_bangun'       => $rancang_bangun,
            'status_inovasi'       => 0,
            'status_permohonan'    => 0,
            'create_by'            => $iduser,
            'create_date'          => $create_date,
            'create_ip'            => $create_ip,
            'mod_by'               => $iduser,
            'mod_date'             => $create_date,
            'mod_ip'               => $create_ip
        );

        // /*query insert*/
        $this->db->insert('ms_inovasi', $data);

        $year  = date('Y');
        $month = date('m');
        //insert file upload 
        // $id_pasar_file  =  $this->uuid->v4(true);


        foreach ($upload as $key => $i) {

            $_FILES['file']['name']     = $_FILES['nama_file']['name'][$i];
            $_FILES['file']['type']     = $_FILES['nama_file']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['nama_file']['tmp_name'][$i];
            $_FILES['file']['error']    = $_FILES['nama_file']['error'][$i];
            $_FILES['file']['size']     = $_FILES['nama_file']['size'][$i];

            $dirnamefile = 'dokumen/inovasi/' . $year . '/' . $month . '/';
            if (!is_dir($dirnamefile)) {
                mkdir('./' . $dirnamefile, 0777, TRUE);
            }

            $config = array(
                'upload_path'       => './' . $dirnamefile . '/',
                'allowed_types'     => 'png|jpg|jpeg|pdf',
                'file_name'         => 'foto_' .  $i . '_' . $token,
                'file_ext_tolower'  => TRUE,
                'max_size'          => 4024,
                'max_filename'      => 0,
                'remove_spaces'     => TRUE,
            );
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('file')) {
                $nama_file = '';
            } else {
                $upload_data = $this->upload->data();
                $nama_file   = $upload_data['file_name'];
            }

            $data_file = array(
                'id_category_file'  => $i,
                'token'             => $token,
                'nama_file'         => $nama_file,
                'id_status'         => 1,
                'create_by'         => $iduser,
                'create_date'       => $create_date,
                'create_ip'         => $create_ip,
                'mod_by'            => $iduser,
                'mod_date'          => $create_date,
                'mod_ip'            => $create_ip
            );

            /*query insert*/
            $this->db->insert('ms_inovasi_file', $data_file);
        }
        return array('response' => 'SUCCESS', 'nama' => $nama_inovasi);
    }

    private function getDataInovasiById($token)
    {
        $this->db->where('token', $token);
        $query = $this->db->get('ms_inovasi');
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
        $this->db->where('token', $id);
        $query = $this->db->get('ms_inovasi_file');
        return $query->result_array();
    }

    /* Fungsi untuk update data */
    public function updateDataInovasi()
    {
        $create_by            = $this->app_loader->current_account();
        $create_date          = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip            = $this->input->ip_address();
        $token                = escape($this->input->post('tokenId', TRUE));
        $nama_inovasi         = escape($this->input->post('nama_inovasi', TRUE));
        $id_tahapan_inovasi   = escape($this->input->post('id_tahapan_inovasi', TRUE));
        $id_inisiator_inovasi = escape($this->input->post('id_inisiator_inovasi', TRUE));
        $id_jenis_inovasi     = escape($this->input->post('id_jenis_inovasi', TRUE));
        $id_bentuk_inovasi    = escape($this->input->post('id_bentuk_inovasi', TRUE));
        $id_tematik           = escape($this->input->post('id_tematik', TRUE));
        $id_urusan_utama      = escape($this->input->post('id_urusan_utama', TRUE));
        $id_urusan_lainnya    = escape($this->input->post('id_urusan_lainnya', TRUE));
        $waktuUjiCoba         = ($this->input->post('waktu_uji_coba', TRUE) != '') ? date_convert(escape($this->input->post('waktu_uji_coba', TRUE))) : '0000-00-00';
        $waktuPenerapan       = ($this->input->post('waktu_penerapan', TRUE) != '') ? date_convert(escape($this->input->post('waktu_penerapan', TRUE))) : '0000-00-00';
        $rancang_bangun       = escape($this->input->post('rancang_bangun', TRUE));
        $rancang_perbaikan    = escape($this->input->post('rancang_perbaikan', TRUE));
        $status_inovasi       = escape($this->input->post('status_inovasi', TRUE));
        $upload               = escape($this->input->post('upload', TRUE));

        //get id bencana
        $dataInovasi = $this->getDataInovasiById($token);
        $token  = !empty($dataInovasi) ? $dataInovasi['token'] : '';

        $data = array(
            'nama_inovasi'         => $nama_inovasi,
            'token'                => $token,
            'id_tahapan_inovasi'   => !empty($id_tahapan_inovasi) ? $id_tahapan_inovasi : 0,
            'id_inisiator_inovasi' => !empty($id_inisiator_inovasi) ? $id_inisiator_inovasi : 0,
            'id_jenis_inovasi'     => !empty($id_jenis_inovasi) ? $id_jenis_inovasi : 0,
            'id_bentuk_inovasi'    => !empty($id_bentuk_inovasi) ? $id_bentuk_inovasi : 0,
            'id_tematik'           => !empty($id_tematik) ? $id_tematik : 0,
            'id_urusan_utama'      => !empty($id_urusan_utama) ? $id_urusan_utama : 0,
            'id_urusan_lainnya'    => !empty($id_urusan_lainnya) ? $id_urusan_lainnya : 0,
            'waktu_uji_coba'       => $waktuUjiCoba,
            'waktu_penerapan'      => $waktuPenerapan,
            'rancang_bangun'       => $rancang_bangun,
            'rancang_perbaikan'    => $rancang_perbaikan,
            'status_inovasi'       => $status_inovasi,
            'mod_by'               => $create_by,
            'mod_date'             => $create_date,
            'mod_ip'               => $create_ip
        );
        // print_r($upload);
        // die;
        $this->db->where('token', $token);
        $this->db->update('ms_inovasi', $data);

        //---------------- INSERT INSERT UPLOAD FILE--------------//
        foreach ($upload as $key => $i) {
            //get aata lama 
            $this->db->where('token', $token);
            $this->db->where('id_category_file', $i);
            $dataOld    = $this->db->get('ms_inovasi_file')->row_array();
            // print_r($dataOld);
            // die;
            $nameFile   = !empty($dataOld) ? $dataOld['nama_file'] : '';
            $createDate = !empty($dataOld) ? $dataOld['create_date'] : date('Y-m-d');
            $year       = date('Y', strtotime(($createDate)));
            $month      = date('m', strtotime(($createDate)));

            $_FILES['file']['name']     = $_FILES['nama_file']['name'][$i];
            $_FILES['file']['type']     = $_FILES['nama_file']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['nama_file']['tmp_name'][$i];
            $_FILES['file']['error']    = $_FILES['nama_file']['error'][$i];
            $_FILES['file']['size']     = $_FILES['nama_file']['size'][$i];

            $dirnamefile = 'dokumen/inovasi/' . $year . '/' . $month . '/';
            if (!is_dir($dirnamefile)) {
                mkdir('./' . $dirnamefile, 0777, TRUE);
            }
            $config = array(
                'upload_path'       => './' . $dirnamefile . '/',
                'allowed_types'     => 'png|jpg|jpeg|pdf',
                'file_name'         => 'foto_' . $i . '_' . $token . '.jpeg',
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
                $this->unlink_data('dokumen/', $year, $month, $nameFile);
                $upload_data = $this->upload->data();
                $nama_file   = $upload_data['file_name'];
            }

            if (count($dataOld) <= 0) {
                $data_file = array(
                    'token'            => $token,
                    'id_category_file' => $i,
                    'nama_file'        => $nama_file,
                    'mod_by'           => $create_by,
                    'mod_date'         => $create_date,
                    'mod_ip'           => $create_ip
                );
                /*query insert*/
                $this->db->insert('ms_inovasi_file', $data_file);
            } else {
                /*query update*/
                if ($nama_file != '') {
                    $this->db->set('nama_file', $nama_file);
                }
                $this->db->set('mod_date', $create_date);
                $this->db->set('mod_ip', $create_ip);
                $this->db->where('token', $token);
                $this->db->where('id_category_file', $i);
                $this->db->update('ms_inovasi_file');
            }
        }
        //---------------- END INSERT TABEL UPLOAD FILE --------------//
        return array('response' => 'SUCCESS', 'kode' => '', 'nama' => $nama_inovasi);
    }

    //--------------------------- FUNGSI UNTUK DELETE FILE INOVASI OPD -------------------------------//
    public function deleteDataInovasi()
    {
        $token = escape($this->input->post('tokenId', TRUE));
        $dataInovasi = $this->getDataDetailInovasi($token);
        $nama_inovasi = !empty($dataInovasi) ? $dataInovasi['nama_inovasi'] : '';
        $this->deleteDataFileInovasi($token);
        $this->deleteDataIndikatorFIle($token);
        $this->deleteDataIndikatorNilai($token);
        $this->deleteDataPermohonanRegistrasi($token);
        $this->db->where('token', $token);
        $this->db->delete('ms_inovasi');
        return array('response' => 'SUCCESS', 'nama' => $nama_inovasi);
    }

    public function getDataUploadFile($token)
    {
        $this->db->select(' 
                            a.create_date, 
							a.id_inovasi_file, 
							a.nama_file');
        $this->db->from('ms_inovasi_file a');
        $this->db->join('ms_inovasi b', 'b.token = a.token', 'INNER');
        $this->db->where('a.token', $token);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function deleteDataFileInovasi($token)
    {
        // $token = escape($this->input->post('token', TRUE));
        $checkFile     = $this->getDataUploadFile($token);
        foreach ($checkFile as $file) {
            $nama_file = $file['nama_file'];
            $year       = date('Y', strtotime(($file['create_date'])));
            $month      = date('m', strtotime(($file['create_date'])));
            if (($nama_file != "") && file_exists('dokumen/inovasi/' . $year . '/' . $month . '/' . $nama_file)) {
                $path = str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']);
                $direktori    = $path . 'dokumen/inovasi/' . $year . '/' . $month . '/';
                if (file_exists($direktori . '/' . $nama_file))
                    unlink($direktori . '/' . $nama_file);
            }
        }

        $this->db->where('token', $token);
        $this->db->delete('ms_inovasi_file');
    }
    //--------------------------- FUNGSI UNTUK DELETE FILE INOVASI OPD -------------------------------//

    //------------------------- FUNGSI UNTUK DELETE FILE PENDUKUNG INDIKATOR -------------------------//
    public function deleteDataIndikatorFIle($token)
    {
        $checkFile = $this->getDataIndikatorFile($token);
        $nama_file = $checkFile['nama_file'];
        $year       = date('Y', strtotime(($checkFile['create_date'])));
        $month      = date('m', strtotime(($checkFile['create_date'])));
        if (($nama_file != "") && file_exists('dokumen/pendukung/' . $year . '/' . $month . '/' . $nama_file)) {
            $path = str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']);
            $direktori    = $path . 'dokumen/pendukung/' . $year . '/' . $month . '/';
            if (file_exists($direktori . '/' . $nama_file))
                unlink($direktori . '/' . $nama_file);
        }
        $this->db->where('token', $token);
        $this->db->delete('ms_indikator_file');
    }

    public function getDataIndikatorFile($token)
    {
        $this->db->select(' 
                            a.id_indikator_file, 
                            a.create_date, 
							a.id_indikator, 
							a.token,
                            a.nama_file');
        $this->db->from('ms_indikator_file a');
        $this->db->join('ms_inovasi b', 'b.token = a.token', 'INNER');
        $this->db->where('a.token', $token);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }
    //------------------------- FUNGSI UNTUK DELETE FILE PENDUKUNG INDIKATOR -------------------------//

    //------------------------- FUNGSI UNTUK DELETE PARAMATER NILAI INDIKATOR ------------------------//

    public function deleteDataIndikatorNilai($token)
    {
        $this->getDataIndikatorNilai($token);
        //delete data file di table
        $this->db->where('token', $token);
        $this->db->delete('ms_indikator_nilai');
    }

    public function getDataIndikatorNilai($token)
    {
        $this->db->select('a.token');
        $this->db->from('ms_indikator_nilai a');
        $this->db->join('ms_inovasi b', 'b.token = a.token', 'INNER');
        $this->db->where('a.token', $token);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    //------------------------- FUNGSI UNTUK DELETE PARAMATER NILAI INDIKATOR ------------------------//

    //------------------------- FUNGSI UNTUK DELETE PERMOHONAN NOMOR REGISTRASI ------------------------//

    public function deleteDataPermohonanRegistrasi($token)
    {
        $this->getDataPermohonanRegistrasi($token);
        //delete data file di table
        $this->db->where('token', $token);
        $this->db->delete('ms_permohonan');
    }

    public function getDataPermohonanRegistrasi($token)
    {
        $this->db->select('a.token');
        $this->db->from('ms_permohonan a');
        $this->db->join('ms_inovasi b', 'b.token = a.token', 'INNER');
        $this->db->where('a.token', $token);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    //------------------------- FUNGSI UNTUK DELETE PERMOHONAN NOMOR REGISTRASI ------------------------//



    /* tematik untuk insert data */
    public function insertDataPermohonan()
    {
        //get data
        $iduser            = $this->app_loader->current_userid();
        $create_date       = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip         = $this->input->ip_address();
        $token             = escape($this->input->post('tokenId', TRUE));
        $nama_lengkap      = escape($this->input->post('nama_lengkap', TRUE));
        $jabatan           = escape($this->input->post('jabatan', TRUE));
        $instansi          = escape($this->input->post('instansi', TRUE));
        $no_hp             = escape($this->input->post('no_hp', TRUE));
        $email             = escape($this->input->post('email', TRUE));
        $status_permohonan = escape($this->input->post('status_permohonan', TRUE));

        //cek nama tematik duplicate
        $this->db->where('nama_lengkap', $nama_lengkap);
        $qTot = $this->db->count_all_results('ms_permohonan');
        if ($qTot > 0)
            return array('response' => 'ERROR', 'nama' => '');
        else {
            $data = array(
                'token'             => $token,
                'nama_lengkap'      => $nama_lengkap,
                'jabatan'           => $jabatan,
                'instansi'          => $instansi,
                'no_hp'             => $no_hp,
                'email'             => $email,
                'status_permohonan' => $status_permohonan,
                'create_by'         => $iduser,
                'create_date'       => $create_date,
                'create_ip'         => $create_ip,
                'mod_by'            => $iduser,
                'mod_date'          => $create_date,
                'mod_ip'            => $create_ip,
            );
            // print_r($data);
            // die;
            /*query insert*/
            $this->db->insert('ms_permohonan', $data);

            $dataPermohonan = array(
                'status_permohonan' => 1
            );
            /*query update*/
            $this->db->where('token', $token);
            $this->db->update('ms_inovasi', $dataPermohonan);
            return array('response' => 'SUCCESS', 'nama' => '');
        }
    }

    /*Fungsi get data edit by id*/
    public function getDataDetailPengirim($token)
    {
        $this->db->select(' a.token, 
							a.nama_lengkap, 
							a.jabatan, 
							a.instansi, 
							a.no_hp, 
							a.email, 
							a.status_permohonan');
        $this->db->from('ms_permohonan a');
        $this->db->join('ms_inovasi b', 'b.token = a.token', 'INNER');
        $this->db->where('a.token', $token);
        $query = $this->db->get();
        return $query->row_array();
    }
}

// This is the end of auth signin model
