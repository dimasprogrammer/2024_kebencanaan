<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of bencana class
 *
 * @author Dimas Dwi Randa
 */

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class bencana extends SLP_Controller
{
    protected $_vwName  = '';
    protected $_uriName = '';
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_bencana' => 'mbencana', 'master/model_master' => 'mmas'));
        $this->_vwName = 'bencana';
        $this->_uriName = 'manajemen_data/bencana';
    }

    private function validasiDataValue()
    {
        $this->form_validation->set_rules('nama_bencana', 'Nama Bencana', 'required|trim');
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
        $this->breadcrumb->add('bencana', site_url($this->_uriName));
        $this->session_info['page_name']     = 'Manajemen Data Bencana';
        $this->session_info['siteUri']       = $this->_uriName;
        $this->session_info['page_css']      = $this->load->view($this->_vwName . '/vcss', '', true);
        $this->session_info['page_js']       = $this->load->view($this->_vwName . '/vjs', array('siteUri' => $this->_uriName), true);
        $this->session_info['jenis_bencana'] = $this->mmas->getDataJenisBencana();
        $this->session_info['users']         = $this->mmas->getDataUsersPersonal();
        $this->session_info['regency']      = $this->mmas->getDataRegency();
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
                $dataList = $this->mbencana->get_datatables($param);
                $no = $this->input->post('start');
                foreach ($dataList as $key => $dl) {
                    $no++;
                    $row = array();
                    $regency = strtoupper($dl['nm_regency']);
                    $row[] = $no;
                    $row[] = $dl['nama_bencana'] . '<br>' . $regency;
                    $row[] = $dl['tanggal_bencana'];
                    $row[] = '<a type="button" data-id="' . $dl['token_bencana'] . '" class="btn btn-primary btn-sm px-2 waves-effect waves-light btnEdit" title="Indikator Satuan">
                        <i class="far fa-folder-open"></i> Lihat Data
                        </a>';
                    $row[] = '<a href="' . site_url('manajemen_data/bencana_detail/index/' . $dl['token_bencana']) . '" type="button" class="btn btn-primary btn-sm px-2 waves-effect waves-light btnIndikator" title="Indikator Satuan">
                        <i class="far fa-folder-open"></i> Detail Bencana
                        </a>';
                    // $row[] = '<a type="button" data-id="' . $dl['token_bencana'] . '" class="btn btn-primary btn-sm px-2 waves-effect waves-light btnEdit" title="Indikator Satuan">
                    //     <i class="far fa-folder-open"></i> Lihat Data
                    //     </a>';
                    // $row[] = '<a type="button" data-id="' . $dl['token_bencana'] . '" class="btn btn-primary btn-sm px-2 waves-effect waves-light btnEdit" title="Indikator Satuan">
                    //     <i class="far fa-folder-open"></i> Lihat Data
                    //     </a>';
                    // $row[] = '  <a type="button" class="btn btn-primary btn-sm px-2 waves-effect waves-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"title="Indikator Satuan">
                    //     <i class="far fa-folder-open"></i> Lihat Data
                    //     </a>
                    //                 <div class="dropdown-menu">
                    //                     <a class="dropdown-item btnEdit" href="#">Bantuan Tersalurkan</a>
                    //                     <a class="dropdown-item" href="#">Bantuan Diterima</a>
                    //                     <a class="dropdown-item" href="#">Bantuan Relawan</a>
                    //                 </div>';
                    $data[] = $row;
                }
                $output = array(
                    "draw" => $this->input->post('draw'),
                    "recordsTotal" => $this->mbencana->count_all(),
                    "recordsFiltered" => $this->mbencana->count_filtered($param),
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
                    $data = $this->mbencana->insertDataBencana();
                    if ($data['response'] == 'ERROR') {
                        $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses insert data bencana baru pada tanggal ' . $data['nama'] . ' gagal, karena ditemukan nama yang sama'), 'csrfHash' => $csrfHash);
                    } else if ($data['response'] == 'SUCCESS') {
                        $result = array('status' => 'RC200', 'message' => 'Proses insert data bencana baru pada tanggal ' . $data['nama'] . ' sukses', 'csrfHash' => $csrfHash);
                    }
                }
            } else {
                $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses insert data bencana baru gagal, mohon coba kembali'), 'csrfHash' => $csrfHash);
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
            $token_bencana   = $this->input->post('token_bencana', TRUE);
            // var_dump($token);
            // die;
            if (!empty($token_bencana) and !empty($session)) {
                $data       = $this->mbencana->getDataDetailBencana($token_bencana);

                $row = array();
                $year    = substr($data['create_date'], 0, 4);
                $month  = substr($data['create_date'], 5, 2);

                if ($data['nama_file'] == '') {
                    $gambar = '';
                } else {
                    $gambar = '<a class="btn btn-primary btn-sm px-2" target="_blank" href="' . site_url('dokumen/bencana/' . $year . '/' . $month . '/' . $data['nama_file']) . '" > Lihat Foto </a>';
                }
                if ($data['nama_file_infografis'] == '') {
                    $infografis = '';
                } else {
                    $infografis = '<a class="btn btn-primary btn-sm px-2" target="_blank" href="' . site_url('dokumen/infografis/' . $year . '/' . $month . '/' . $data['nama_file_infografis']) . '" > Lihat Infografis </a>';
                }
                $row['gambar']              = !empty($gambar) ? $gambar : '';
                $row['infografis']          = !empty($infografis) ? $infografis : '';
                $row['token']               = !empty($data) ? $data['token_bencana'] : '';
                $row['tanggal_bencana']     = !empty($data) ? $data['tanggal_bencana'] : '';
                $row['kategori_tanggap']    = !empty($data) ? $data['kategori_tanggap'] : '';
                $row['id_regency']          = !empty($data) ? $data['id_regency'] : '';
                $row['id_district']         = !empty($data) ? $data['id_district'] : '';
                $row['id_village']          = !empty($data) ? $data['id_village'] : '';
                $row['jorong']              = !empty($data) ? $data['jorong'] : '';
                $row['id_jenis_bencana']    = !empty($data) ? $data['id_jenis_bencana'] : '';
                $row['nama_bencana']        = !empty($data) ? $data['nama_bencana'] : '';
                $row['keterangan_bencana']  = !empty($data) ? $data['keterangan_bencana'] : '';
                $row['penyebab_bencana']    = !empty($data) ? $data['penyebab_bencana'] : '';
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
                    $data = $this->mbencana->updateDatabencana();
                    if ($data['response'] == 'ERROR') {
                        $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses update data bencana gagal, karena data tidak ditemukan'), 'csrfHash' => $csrfHash);
                    } else if ($data['response'] == 'ERRDATA') {
                        $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses update data bencana dengan nama ' . $data['nama'] . ' gagal, karena ditemukan nama yang sama'), 'csrfHash' => $csrfHash);
                    } else if ($data['response'] == 'SUCCESS') {
                        $result = array('status' => 'RC200', 'message' => 'Proses update data bencana dengan nama ' . $data['nama'] . ' sukses', 'csrfHash' => $csrfHash);
                    }
                }
            } else {
                $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses update data bencana gagal, mohon coba kembali'), 'csrfHash' => $csrfHash);
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
                $data = $this->mbencana->deleteDatabencana();

                if ($data['response'] == 'ERROR') {
                    $result = array('status' => 'RC404', 'message' => 'Proses delete data bencana gagal, karena data tidak ditemukan', 'csrfHash' => $csrfHash);
                } else if ($data['response'] == 'ERRDATA') {
                    $result = array('status' => 'RC404', 'message' => 'Proses delete data bencana dengan nama ' . $data['nama'] . ' gagal, karena data sedang digunakan', 'csrfHash' => $csrfHash);
                } else if ($data['response'] == 'SUCCESS') {
                    $result = array('status' => 'RC200', 'message' => 'Proses delete data bencana dengan nama ' . $data['nama'] . ' sukses', 'csrfHash' => $csrfHash);
                }
            } else {
                $result = array('status' => 0, 'message' => 'Proses delete data bencana gagal, mohon coba kembali', 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    //get data kecamatan
    public function district()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            $regency = $this->input->get('regency', TRUE);

            if (!empty($regency) and !empty($session)) {
                $data = $this->mmas->getDataDistrictByRegency($regency);
                if (count($data) > 0) {
                    $row = array();
                    foreach ($data as $key => $val) {
                        $row['id']      = $val['id_district'];
                        $row['text'] = $val['name'];
                        $hasil[] = $row;
                    }
                    $result = array('status' => 'RC200', 'message' => $hasil, 'csrfHash' => $csrfHash);
                } else
                    $result = array('status' => 'RC404', 'message' => '', 'csrfHash' => $csrfHash);
            } else {
                $result = array('status' => 'RC404', 'message' => '', 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    //get data Kelurahan/desa/nagari
    public function village()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            $district = $this->input->get('district', TRUE);
            if (!empty($district) and !empty($session)) {
                $data = $this->mmas->getDataVillageByDistrict($district);
                if (count($data) > 0) {
                    $row = array();
                    foreach ($data as $key => $val) {
                        $row['id']      = $val['id_village'];
                        $row['text'] = $val['name'];
                        $hasil[] = $row;
                    }
                    $result = array('status' => 'RC200', 'message' => $hasil, 'csrfHash' => $csrfHash);
                } else
                    $result = array('status' => 'RC404', 'message' => '', 'csrfHash' => $csrfHash);
            } else {
                $result = array('status' => 'RC404', 'message' => '', 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }
}

// This is the end of fungsi class
