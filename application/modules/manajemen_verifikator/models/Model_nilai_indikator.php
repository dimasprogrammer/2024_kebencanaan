<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of nilai_indikator model
 *
 * @author Dimas Dwi Randa
 */

class Model_nilai_indikator extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /*Fungsi get data edit by id dan url*/
    public function addDataInovasiIndikator($token)
    {
        $this->db->select(' a.id_inovasi,
                            a.token,
                            a.nama_inovasi,
                            a.waktu_uji_coba,
                            a.waktu_penerapan,
                            a.id_tahapan_inovasi,
                            a.waktu_penerapan,
                            a.status_inovasi,
                            a.status_permohonan,
                            b.nm_urusan_utama,
                            c.opd_id_name');
        $this->db->from('ms_inovasi a');
        $this->db->join('cx_urusan_utama b', 'a.id_urusan_utama = b.id_urusan_utama', 'inner');
        $this->db->join('xi_sa_users c', 'a.create_by = c.token', 'inner');
        $this->db->where('a.token', $token);
        $query = $this->db->get();
        return $query->row_array();
    }

    // /*Fungsi Get Data List*/
    public function getDataIndikator()
    {
        $this->db->select(' a.id_indikator,
                            a.nm_indikator,
                            a.keterangan,
                            a.informasi,
                            a.bobot,
                            a.data_pendukung,
                            a.jenis_dokumen,
                            a.wajib_diisi,
							a.jenis_file,
                            a.id_status');
        $this->db->from('cx_indikator a');
        $this->db->order_by('a.id_indikator ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataIndikatorDetail($id_indikator)
    {
        $this->db->select(' a.id_indikator,
                            a.nm_indikator,
                            a.keterangan,
                            a.informasi,
                            a.bobot,
                            a.data_pendukung,
							a.jenis_file,
                            a.id_status');
        $this->db->from('cx_indikator a');
        $this->db->where('a.id_indikator', $id_indikator);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getDataIndikatorSatuan($id_indikator)
    {
        $this->db->where('id_indikator', $id_indikator);
        $this->db->order_by('id_indikator_satuan ASC');
        $query = $this->db->get('cx_indikator_satuan');
        return $query->result_array();
    }

    public function cekDokumenPendukung($tokenInovasi, $id_indikator)
    {
        $this->db->select('a.id_indikator_file, a.create_date, a.nama_file');
        $this->db->from('ms_indikator_file a');
        $this->db->where('a.token', $tokenInovasi);
        $this->db->where('a.id_indikator', $id_indikator);
        $dataDokumen = $this->db->get();
        return $dataDokumen;
    }

    public function cekDokumenLink($tokenInovasi, $id_indikator)
    {
        $this->db->select('a.id_indikator_link, a.create_date, a.link_youtube');
        $this->db->from('ms_indikator_link a');
        $this->db->where('a.token', $tokenInovasi);
        $this->db->where('a.id_indikator', $id_indikator);
        $dataDokumen = $this->db->get();
        return $dataDokumen;
    }

    public function cekCatatan($tokenInovasi, $id_indikator)
    {
        $this->db->select('a.id_indikator_catatan, a.create_date, a.catatan');
        $this->db->from('ms_indikator_catatan a');
        $this->db->where('a.token', $tokenInovasi);
        $this->db->where('a.id_indikator', $id_indikator);
        $dataDokumen = $this->db->get();
        return $dataDokumen;
    }


    public function getDataDokumenPendukung($id_indikator)
    {
        $this->db->select('a.id_indikator_file, a.create_date, a.nama_file');
        $this->db->from('ms_indikator_file a');
        $this->db->where('a.id_indikator', $id_indikator);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function countTotalBobot($id_indikator, $bobot_indikator, $id_indikator_satuan)
    {

        $this->db->select('a.id_indikator_satuan, a.bobot_satuan');
        $this->db->from('cx_indikator_satuan a');
        $this->db->where('a.id_indikator', $id_indikator);
        $this->db->where('a.id_indikator_satuan', $id_indikator_satuan);
        $this->db->limit(1);
        $dataNilai = $this->db->get();
        if ($dataNilai->num_rows() <= 0) {
            $parameter = 'Paramater Belum Ada';
            $bobot_satuan = '';
        } else {
            $bobot_satuan = !empty($dataNilai->row_array()) ? $dataNilai->row_array()['bobot_satuan'] : 0;
        }

        $total_bobot = !empty($bobot_satuan) ? $bobot_satuan * $bobot_indikator : $bobot_indikator;
        return $total_bobot;
    }


    /* tematik untuk insert data */
    public function insertDataIndikatorNilai()
    {
        //get data
        $iduser               = $this->app_loader->current_userid();
        $create_date = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip   = $this->input->ip_address();
        $tokenIndikator      = escape($this->input->post('tokenId', TRUE));
        $tokenInovasi        = escape($this->input->post('tokenIno', TRUE));
        $id_indikator_satuan = escape($this->input->post('id_indikator_satuan', TRUE));

        //cek nama tematik duplicate
        $this->db->where('id_indikator_satuan', $id_indikator_satuan);
        $this->db->where('token', $tokenInovasi);
        $qTot = $this->db->count_all_results('ms_indikator_nilai');
        if ($qTot > 0)
            return array('response' => 'ERROR', 'nama' => '');
        else {
            $detailIndikator = $this->getDataIndikatorDetail($tokenIndikator);
            $bobot_indikator = $detailIndikator['bobot'];
            $total_aja = $this->countTotalBobot($tokenIndikator, $bobot_indikator, $id_indikator_satuan, $tokenInovasi);
            $data = array(
                'id_indikator_satuan'   => $id_indikator_satuan,
                'id_indikator'          => $tokenIndikator,
                'token'                 => $tokenInovasi,
                'nilai_parameter'       => $total_aja,
                'create_by'             => $iduser,
                'create_date'           => $create_date,
                'create_ip'             => $create_ip,
                'mod_by'                => $iduser,
                'mod_date'              => $create_date,
                'mod_ip'                => $create_ip,
            );
            // print_r($data);
            // die;
            /*query insert*/
            $this->db->insert('ms_indikator_nilai', $data);
            return array('response' => 'SUCCESS', 'nama' => '');
        }
    }

    public function insertDataIndikatorFile()
    {
        //get data
        $iduser      = $this->app_loader->current_userid();
        $create_date = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip   = $this->input->ip_address();
        $tokenIndikator      = escape($this->input->post('tokenId', TRUE));
        $tokenInovasi        = escape($this->input->post('tokenIno', TRUE));
        $nomor_surat   = escape($this->input->post('nomor_surat', TRUE));
        $tanggalSurat         = ($this->input->post('tanggal_surat', TRUE) != '') ? date_convert(escape($this->input->post('tanggal_surat', TRUE))) : '0000-00-00';
        $tentang_surat   = escape($this->input->post('tentang_surat', TRUE));
        $tentang_surat       = escape($this->input->post('tentang_surat', TRUE));
        $nama_file   = escape($this->input->post('nama_file', TRUE));
        // var_dump($create_date);
        // die;
        //cek nama fungsi duplicate
        $year           = date('Y');
        $month           = date('m');
        $dirname       = 'dokumen/pendukung/' . $year . '/' . $month . '/';
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
            'file_name'        => 'file_' . $tokenIndikator . '_' . $tokenInovasi,
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
            'id_indikator'   => $tokenIndikator,
            'token'          => $tokenInovasi,
            'nomor_surat'    => $nomor_surat,
            'tanggal_surat'  => $tanggalSurat,
            'tentang_surat'  => $tentang_surat,
            'nama_file'      => $nama_file,
            'create_by'      => $iduser,
            'create_date'    => $create_date,
            'create_ip'      => $create_ip,
            'mod_by'         => $iduser,
            'mod_date'       => $create_date,
            'mod_ip'         => $create_ip
        );
        /*query insert*/
        $this->db->insert('ms_indikator_file', $data);
        return array('response' => 'SUCCESS', 'nama' => '');
    }

    /* tematik untuk insert data */
    public function insertDataIndikatorLink()
    {
        //get data
        $iduser               = $this->app_loader->current_userid();
        $create_date = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip   = $this->input->ip_address();
        $tokenIndikator      = escape($this->input->post('tokenId', TRUE));
        $tokenInovasi        = escape($this->input->post('tokenIno', TRUE));
        $link_youtube = escape($this->input->post('link_youtube', TRUE));

        //cek nama tematik duplicate
        $this->db->where('link_youtube', $link_youtube);
        $this->db->where('token', $tokenInovasi);
        $qTot = $this->db->count_all_results('ms_indikator_link');
        if ($qTot > 0)
            return array('response' => 'ERROR', 'nama' => '');
        else {
            $data = array(
                'link_youtube'   => $link_youtube,
                'id_indikator'          => $tokenIndikator,
                'token'                 => $tokenInovasi,
                'create_by'             => $iduser,
                'create_date'           => $create_date,
                'create_ip'             => $create_ip,
                'mod_by'                => $iduser,
                'mod_date'              => $create_date,
                'mod_ip'                => $create_ip,
            );
            // print_r($data);
            // die;
            /*query insert*/
            $this->db->insert('ms_indikator_link', $data);
            return array('response' => 'SUCCESS', 'nama' => '');
        }
    }

    /* tematik untuk insert data */
    public function insertDataIndikatorCatatan()
    {
        //get data
        $iduser               = $this->app_loader->current_userid();
        $create_date = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip   = $this->input->ip_address();
        $tokenIndikator      = escape($this->input->post('tokenId', TRUE));
        $tokenInovasi        = escape($this->input->post('tokenIno', TRUE));
        $catatan = escape($this->input->post('catatan', TRUE));

        //cek nama tematik duplicate
        $this->db->where('catatan', $catatan);
        $this->db->where('token', $tokenInovasi);
        $qTot = $this->db->count_all_results('ms_indikator_catatan');
        if ($qTot > 0)
            return array('response' => 'ERROR', 'nama' => '');
        else {
            $data = array(
                'catatan'   => $catatan,
                'id_indikator'          => $tokenIndikator,
                'token'                 => $tokenInovasi,
                'create_by'             => $iduser,
                'create_date'           => $create_date,
                'create_ip'             => $create_ip,
                'mod_by'                => $iduser,
                'mod_date'              => $create_date,
                'mod_ip'                => $create_ip,
            );
            // print_r($data);
            // die;
            /*query insert*/
            $this->db->insert('ms_indikator_catatan', $data);
            return array('response' => 'SUCCESS', 'nama' => '');
        }
    }

    /*tematik get data edit by id*/
    public function getDataDetailParameter($id)
    {
        $this->db->where('id_indikator_nilai', abs($id));
        $query = $this->db->get('ms_indikator_nilai');
        return $query;
    }

    /* tematik untuk delete data */
    public function deleteDataParameter()
    {
        $id_indikator_nilai = $this->encryption->decrypt(escape($this->input->post('tokenId', TRUE)));
        //cek data menu by id
        $datatematik  = $this->getDataDetailParameter($id_indikator_nilai);
        $nilai_parameter = !empty($datatematik) ? $datatematik->row_array()['nilai_parameter'] : '';
        if ($datatematik->num_rows() <= 0)
            return array('response' => 'ERROR', 'nama' => '');
        else {
            $this->db->where('id_indikator_nilai', abs($id_indikator_nilai));
            $this->db->delete('ms_indikator_nilai');
            return array('response' => 'SUCCESS', 'nama' => $nilai_parameter);
        }
    }

    public function getTotalBobotByIdInovasi($token)
    {
        $array_bobot = array();
        $dataIndikator = $this->mindi->getDataIndikator();
        foreach ($dataIndikator as $key => $val) {
            $bobot = $val->bobot;
            $this->db->select('a.id_indikator, 
                                           a.id_indikator_nilai,
                                           b.bobot_satuan');
            $this->db->from('ms_indikator_nilai a');
            $this->db->join('cx_indikator_satuan b', 'b.id_indikator_satuan = a.id_indikator_satuan', 'inner');
            $this->db->where('a.id_indikator', $val->id_indikator);
            $this->db->where('a.token', $token);
            $this->db->limit(1);
            $data = $this->db->get();
            if ($data->num_rows() > 0)
                $bobot_satuan = $data->row_array()['bobot_satuan'];
            else
                $bobot_satuan = 0;

            $array_bobot[] = $bobot * $bobot_satuan;
        }
        $total_bobot = array_sum($array_bobot);
        return $total_bobot;
        // if ($this->getFileCheck($token) == 5)
        //     return $total_bobot;
        // else return 9;
    }

    public function getSkorNilaiKematanganWajib($token)
    {
        $array_parameter = array();
        $array_dokumen = array();
        $dataIndikator = $this->mindi->getDataIndikatorWajib();
        $jumlah_indikator_wajib = !empty($dataIndikator) ? count($dataIndikator) : 0;;
        foreach ($dataIndikator as $key => $val) {
            $id_indikator = !empty($val->id_indikator) ? $val->id_indikator : 0;
            $jenis_dokumen = !empty($val->jenis_dokumen) ? $val->jenis_dokumen : 0;
            $parameter = $this->getCheckParameterIndikator($token, $id_indikator);
            $dokumen = $this->getFileCheckWajib($token, $id_indikator, $jenis_dokumen);
            $array_parameter[] = $parameter;
            $array_dokumen[] = $dokumen;
        }
        $total_parameter = array_sum($array_parameter);
        $total_dokumen   = array_sum($array_dokumen);
        if ($jumlah_indikator_wajib > $total_parameter || $jumlah_indikator_wajib > $total_dokumen)
            return 0;
        // return 'jml indikator' . $jumlah_indikator_wajib . 'total parameter' . $total_parameter . '' . 'total dokumen' . $total_dokumen . '';
        else
            return $this->getTotalBobotByIdInovasi($token);
    }

    // /*Fungsi Get Data List*/
    public function getDataIndikatorWajib()
    {
        $this->db->select(' a.id_indikator,
                            a.nm_indikator,
                            a.keterangan,
                            a.informasi,
                            a.bobot,
                            a.data_pendukung,
                            a.jenis_dokumen,
							a.jenis_file,
							a.wajib_diisi,
                            a.id_status');
        $this->db->from('cx_indikator a');
        $this->db->where('a.wajib_diisi', 'Y');
        $this->db->order_by('a.id_indikator ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getSkorKematanganCheck($token)
    {
        $array_parameter = array();
        $array_dokumen = array();
        $dataIndikator = $this->mindi->getDataIndikatorWajib();
        $jumlah_indikator_wajib = !empty($dataIndikator) ? count($dataIndikator) : 0;;
        foreach ($dataIndikator as $key => $val) {
            $id_indikator = !empty($val->id_indikator) ? $val->id_indikator : 0;
            $jenis_dokumen = !empty($val->jenis_dokumen) ? $val->jenis_dokumen : 0;
            $parameter = $this->getCheckParameterIndikator($token, $id_indikator);
            $dokumen = $this->getFileCheckWajib($token, $id_indikator, $jenis_dokumen);
            $array_parameter[] = $parameter;
            $array_dokumen[] = $dokumen;
        }
        $total_parameter = array_sum($array_parameter);
        $total_dokumen   = array_sum($array_dokumen);
        if ($jumlah_indikator_wajib > $total_parameter || $jumlah_indikator_wajib > $total_dokumen)
            return array('status' => FALSE, 'info' => '<span class="text-danger">Isi Parameter dan Dokumen dari indikator yang wajib diisi</span>');
        // return 'jml indikator' . $jumlah_indikator_wajib . 'total parameter' . $total_parameter . '' . 'total dokumen' . $total_dokumen . '';
        else
            return array('status' => TRUE, 'info' => $this->getTotalBobotByIdInovasi($token));
        // return $this->getTotalBobotByIdInovasi($token);
    }


    private function getCheckParameterIndikator($token, $id_indikator)
    {
        $this->db->select('a.id_indikator_nilai, a.id_indikator_satuan, b.bobot_satuan');
        $this->db->from('ms_indikator_nilai a');
        $this->db->join('cx_indikator_satuan b', 'a.id_indikator_satuan = b.id_indikator_satuan', 'inner');
        $this->db->where('a.id_indikator', $id_indikator);
        $this->db->where('a.token', $token);
        $this->db->limit(1);
        $dataNilai = $this->db->get();
        return $dataNilai->num_rows();
    }

    public function getFileCheckWajib($token, $id_indikator, $jenis_dokumen)
    {
        if ($jenis_dokumen == 1) {
            $this->db->select(' a.id_indikator_file, 
                            a.id_indikator,
                            a.token');
            $this->db->from('ms_indikator_file a');
            $this->db->where('a.token', $token);
            $this->db->where('a.id_indikator', $id_indikator);
            $data = $this->db->get();
            return $data->num_rows();
        } else {
            $this->db->select(' a.id_indikator_link, 
                                a.id_indikator,
                                a.token');
            $this->db->from('ms_indikator_link a');
            $this->db->where('a.token', $token);
            $this->db->where('a.id_indikator', $id_indikator);
            $data = $this->db->get();
            return $data->num_rows();
        }
    }

    public function getFileCheck($token)
    {
        $this->db->select(' a.id_indikator_file, 
                            a.id_indikator,
                            a.token');
        $this->db->from('ms_indikator_file a');
        $this->db->where('a.token', $token);
        $data = $this->db->get();
        return $data->num_rows();
    }

    public function getDataUpload($id)
    {
        $this->db->select('
                            a.create_date,
                            a.nama_file');
        $this->db->from('ms_indikator_file a');
        $this->db->where('a.id_indikator_file', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function deleteDataIndikatorFile($id)
    {
        // $id = $this->encryption->decrypt(escape($this->input->post('tokenId', TRUE)));
        $checkFile = $this->getDataUpload($id);

        $nama_file      = $checkFile['nama_file'];
        $year       = date('Y', strtotime($checkFile['create_date']));
        $month      = date('m', strtotime($checkFile['create_date']));
        if (($nama_file != "") && file_exists('dokumen/pendukung/' . $year . '/' . $month . '/' . $nama_file)) {
            $path = str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']);
            $direktori    = $path . 'dokumen/pendukung/' . $year . '/' . $month . '/';
            if (file_exists($direktori . '/' . $nama_file))
                unlink($direktori . '/' . $nama_file);
        }
        $this->db->where('id_indikator_file', $id);
        $this->db->delete('ms_indikator_file');
        return array('response' => 'SUCCESS', 'nama' => '');
    }

    /*tematik get data edit by id*/
    public function getDataDetailLink($id)
    {
        $this->db->where('id_indikator_link', abs($id));
        $query = $this->db->get('ms_indikator_link');
        return $query;
    }

    /* tematik untuk delete data */
    public function deleteDataLink()
    {
        $id_indikator_link = escape($this->input->post('tokenId', TRUE));
        //cek data menu by id
        $dataLink  = $this->getDataDetailLink($id_indikator_link);
        $link_youtube = !empty($dataLink) ? $dataLink->row_array()['link_youtube'] : '';
        if ($dataLink->num_rows() <= 0)
            return array('response' => 'ERROR', 'nama' => $link_youtube);
        else {
            $this->db->where('id_indikator_link', abs($id_indikator_link));
            $this->db->delete('ms_indikator_link');
            return array('response' => 'SUCCESS', 'nama' => $link_youtube);
        }
    }
}

// This is the end of auth signin model
