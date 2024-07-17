<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of korban_jiwa class
 *
 * @author Dimas Dwi Randa
 */

class Korban_jiwa extends SLP_Controller
{
    protected $_vwName  = '';
    protected $_uriName = '';
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_korban_jiwa' => 'mkorban_jiwa', 'master/model_master' => 'mmas'));
        $this->_vwName = 'korban';
        $this->_uriName = 'manajemen_data/korban_jiwa';
    }

    private function validasiDataValue()
    {
        $this->form_validation->set_rules('nama_korban_jiwa', 'Nama korban_jiwa', 'required|trim');
        validation_message_setting();
        if ($this->form_validation->run() == FALSE)
            return false;
        else
            return true;
    }

    public function index()
    {
        $this->breadcrumb->add('Dashboard', site_url('home'));
        $this->breadcrumb->add('Manajemen', '#');
        $this->breadcrumb->add('Korban Jiwa', site_url($this->_uriName));
        $this->session_info['page_name']     = 'Manajemen Data Korban Jiwa';
        $this->session_info['siteUri']       = $this->_uriName;
        $this->session_info['page_css']      = $this->load->view($this->_vwName . '/vcss', '', true);
        $this->session_info['page_js']       = $this->load->view($this->_vwName . '/vjs', array('siteUri' => $this->_uriName), true);
        $this->session_info['data_opd']      = "";
        $this->template->build($this->_vwName . '/vpage', $this->session_info);
    }

    public function listview()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $data = array();
            $session = $this->app_loader->current_account();
            if (isset($session)) {
                $param    = $this->input->post('param', TRUE);
                $dataList = $this->mkorban_jiwa->get_datatables($param);
                $no = $this->input->post('start');
                foreach ($dataList as $key => $dl) {
                    $no++;
                    $row = array();
                    $row[] = $no;
                    $row[] = $dl['tanggal_korban_jiwa'];
                    $data[] = $row;
                }
                $output = array(
                    "draw" => $this->input->post('draw'),
                    "recordsTotal" => $this->mkorban_jiwa->count_all(),
                    "recordsFiltered" => $this->mkorban_jiwa->count_filtered($param),
                    "data" => $data,
                );
            }
            //output to json format
            $this->output->set_content_type('application/json')->set_output(json_encode($output));
        }
    }

    public function create()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            if (!empty($session)) {
                if ($this->validasiDataValue() == FALSE) {
                    $result = array('status' => 'RC404', 'message' => $this->form_validation->error_array(), 'csrfHash' => $csrfHash);
                } else {
                    $data = $this->mkorban_jiwa->insertDatakorban_jiwa();
                    if ($data['response'] == 'ERROR') {
                        $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses insert data korban_jiwa baru pada tanggal ' . $data['nama'] . ' gagal, karena ditemukan nama yang sama'), 'csrfHash' => $csrfHash);
                    } else if ($data['response'] == 'SUCCESS') {
                        $result = array('status' => 'RC200', 'message' => 'Proses insert data korban_jiwa baru pada tanggal ' . $data['nama'] . ' sukses', 'csrfHash' => $csrfHash);
                    }
                }
            } else {
                $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses insert data korban_jiwa baru gagal, mohon coba kembali'), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    public function details()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            $token_korban_jiwa   = $this->input->post('token_korban_jiwa', TRUE);
            // var_dump($token);
            // die;
            if (!empty($token_korban_jiwa) and !empty($session)) {
                $data       = $this->mkorban_jiwa->getDataDetailkorban_jiwa($token_korban_jiwa);

                $row = array();
                $year    = substr($data['create_date'], 0, 4);
                $month  = substr($data['create_date'], 5, 2);

                if ($data['nama_file'] == '') {
                    $gambar = '';
                } else {
                    $gambar = '<a class="btn btn-primary btn-sm px-2" target="_blank" href="' . site_url('dokumen/korban_jiwa/' . $year . '/' . $month . '/' . $data['nama_file']) . '" > Lihat Foto </a>';
                }
                if ($data['nama_file_infografis'] == '') {
                    $infografis = '';
                } else {
                    $infografis = '<a class="btn btn-primary btn-sm px-2" target="_blank" href="' . site_url('dokumen/infografis/' . $year . '/' . $month . '/' . $data['nama_file_infografis']) . '" > Lihat Infografis </a>';
                }
                $row['gambar']              = !empty($gambar) ? $gambar : '';
                $row['infografis']          = !empty($infografis) ? $infografis : '';
                $row['token']               = !empty($data) ? $data['token_korban_jiwa'] : '';
                $row['tanggal_korban_jiwa']     = !empty($data) ? $data['tanggal_korban_jiwa'] : '';
                $row['kategori_tanggap']    = !empty($data) ? $data['kategori_tanggap'] : '';
                $row['id_regency']          = !empty($data) ? $data['id_regency'] : '';
                $row['id_district']         = !empty($data) ? $data['id_district'] : '';
                $row['id_village']          = !empty($data) ? $data['id_village'] : '';
                $row['jorong']              = !empty($data) ? $data['jorong'] : '';
                $row['id_jenis_korban_jiwa']    = !empty($data) ? $data['id_jenis_korban_jiwa'] : '';
                $row['nama_korban_jiwa']        = !empty($data) ? $data['nama_korban_jiwa'] : '';
                $row['keterangan_korban_jiwa']  = !empty($data) ? $data['keterangan_korban_jiwa'] : '';
                $row['penyebab_korban_jiwa']    = !empty($data) ? $data['penyebab_korban_jiwa'] : '';
                // $row['nama_file']           = !empty($data) ? $data['nama_file'] : '';
                $result = array('status' => 'RC200', 'message' => $row, 'csrfHash' => $csrfHash);
            } else {
                $result = array('status' => 'RC404', 'message' => array(), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    public function update()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            $contId   = escape($this->input->post('tokenId', TRUE));
            if (!empty($session) and !empty($contId)) {
                if ($this->validasiDataValue() == FALSE) {
                    $result = array('status' => 'RC404', 'message' => $this->form_validation->error_array(), 'csrfHash' => $csrfHash);
                } else {
                    $data = $this->mkorban_jiwa->updateDatakorban_jiwa();
                    if ($data['response'] == 'ERROR') {
                        $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses update data korban_jiwa gagal, karena data tidak ditemukan'), 'csrfHash' => $csrfHash);
                    } else if ($data['response'] == 'ERRDATA') {
                        $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses update data korban_jiwa dengan nama ' . $data['nama'] . ' gagal, karena ditemukan nama yang sama'), 'csrfHash' => $csrfHash);
                    } else if ($data['response'] == 'SUCCESS') {
                        $result = array('status' => 'RC200', 'message' => 'Proses update data korban_jiwa dengan nama ' . $data['nama'] . ' sukses', 'csrfHash' => $csrfHash);
                    }
                }
            } else {
                $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses update data korban_jiwa gagal, mohon coba kembali'), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    public function delete()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            $contId   = escape($this->input->post('tokenId', TRUE));

            if (!empty($session) and !empty($contId)) {
                $data = $this->mkorban_jiwa->deleteDatakorban_jiwa();

                if ($data['response'] == 'ERROR') {
                    $result = array('status' => 'RC404', 'message' => 'Proses delete data korban_jiwa gagal, karena data tidak ditemukan', 'csrfHash' => $csrfHash);
                } else if ($data['response'] == 'ERRDATA') {
                    $result = array('status' => 'RC404', 'message' => 'Proses delete data korban_jiwa dengan nama ' . $data['nama'] . ' gagal, karena data sedang digunakan', 'csrfHash' => $csrfHash);
                } else if ($data['response'] == 'SUCCESS') {
                    $result = array('status' => 'RC200', 'message' => 'Proses delete data korban_jiwa dengan nama ' . $data['nama'] . ' sukses', 'csrfHash' => $csrfHash);
                }
            } else {
                $result = array('status' => 0, 'message' => 'Proses delete data korban_jiwa gagal, mohon coba kembali', 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }
}

// This is the end of fungsi class
