<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of bencana_daerah class
 *
 * @author Dimas Dwi Randa
 */

class Bencana_daerah extends SLP_Controller
{
    protected $_vwName  = '';
    protected $_uriName = '';
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_bencana_daerah' => 'mbencana_daerah', 'master/model_master' => 'mmas'));
        $this->_vwName = 'bencana_daerah';
        $this->_uriName = 'manajemen_data/bencana_daerah';
    }

    private function validasiDataValue()
    {
        $this->form_validation->set_rules('nama_bencana_daerah', 'Nama bencana_daerah', 'required|trim');
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
        $this->breadcrumb->add('Bencana Daerah', site_url($this->_uriName));
        $this->session_info['page_name']     = 'Manajemen Data Bencana Daerah';
        $this->session_info['siteUri']       = $this->_uriName;
        $this->session_info['page_css']      = $this->load->view($this->_vwName . '/vcss', '', true);
        $this->session_info['page_js']       = $this->load->view($this->_vwName . '/vjs', array('siteUri' => $this->_uriName), true);
        // $this->session_info['jenis_bencana_daerah'] = $this->mmas->getDataJenisbencana_daerahGroup();
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
                $dataList = $this->mbencana_daerah->get_datatables($param);
                $no = $this->input->post('start');
                foreach ($dataList as $key => $dl) {
                    $no++;
                    $row = array();

                    $row[] = $no;
                    $row[] = $dl['nama_bencana'];
                    $row[] = $dl['tanggal_bencana'];
                    $row[] = $dl['penyebab_bencana'];
                    $row[] = $dl['nm_regency'];
                    $row[] = '
                        <a type="button" data-id="' . $dl['token_bencana_detail'] . '" class="btn btn-danger btn-sm px-2 waves-effect waves-light btnValidasi" title="Validasi Data">
                        <i class="fas fa-box-open"></i> Korban
                        </a>';
                    $row[] = '
                        <a type="button" data-id="' . $dl['token_bencana_detail'] . '" class="btn btn-warning btn-sm px-2 waves-effect waves-light btnKebutuhan" title="Lihat Data">
                        <i class="fas fa-box-open"></i> Kebutuhan
                        </a>
                        <a href="' . site_url('manajemen_data/bencana_daerah/detail_bencana/' . $dl['token_bencana_detail']) . '" type="button" class="btn btn-primary btn-sm px-2 waves-effect waves-light btnIndikator" title="Indikator Satuan">
                        <i class="far fa-folder-open"></i> Detail
                        </a>';
                    $data[] = $row;
                }
                $output = array(
                    "draw" => $this->input->post('draw'),
                    "recordsTotal" => $this->mbencana_daerah->count_all(),
                    "recordsFiltered" => $this->mbencana_daerah->count_filtered($param),
                    "data" => $data,
                );
            }
            //output to json format
            $this->output->set_content_type('application/json')->set_output(json_encode($output));
        }
    }

    public function details()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            $token_bencana_detail   = $this->input->post('token_bencana_detail', TRUE);
            // var_dump($token_bencana_detail);
            // die;
            if (!empty($token_bencana_detail) and !empty($session)) {
                $data = $this->mbencana_daerah->getDataDetailBencana($token_bencana_detail);
                $row = array();
                $row['token_bencana_detail'] = !empty($data) ? $data['token_bencana_detail'] : '';
                $row['kebutuhan_bencana']    = !empty($data) ? $data['kebutuhan_bencana'] : '';
                $result = array('status' => 'RC200', 'message' => $row, 'csrfHash' => $csrfHash);
            } else {
                $result = array('status' => 'RC404', 'message' => array(), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    public function createKebutuhan()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            if (!empty($session)) {
                $data = $this->mbencana_daerah->insertDataKebutuhan();
                if ($data['response'] == 'SUCCESS') {
                    $result = array('status' => 'RC200', 'message' => 'Proses insert data kebutuhan sukses', 'csrfHash' => $csrfHash);
                }
            } else {
                $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses insert data kebutuhan gagal, mohon coba kembali'), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }


    public function detail_bencana($token_bencana_detail)
    {
        $dataTokenBencana = $this->mbencana_daerah->addDataDetailBencanaDetail($token_bencana_detail);
        // print_r($dataTokenBencana);
        // die;
        if (count($dataTokenBencana) <= 0)
            redirect('manajemen_data/bencana_daerah');

        $this->breadcrumb->add('Dashboard', site_url('home'));
        $this->breadcrumb->add('Konfirmasi Indikator', '#');
        $this->breadcrumb->add('Indikator', site_url($this->_uriName));
        $this->breadcrumb->add('create_nilai', '#');
        $this->session_info['siteUri']   = $this->_uriName;
        $this->session_info['page_name'] = "Detail Bencana";
        $this->session_info['page_js']   = $this->load->view(
            $this->_vwName . '/vjs',
            array(
                'siteUri'       => $this->_uriName,
                'vkorbanjiwajs' => $this->load->view('bencana_daerah/vkorbanjiwa.js.php', '', true),
                'vkerusakanjs'  => $this->load->view('bencana_daerah/vkerusakan.js.php', '', true),
                'vternakjs'     => $this->load->view('bencana_daerah/vternak.js.php', '', true),
                'vbantuantersalurkanjs' => $this->load->view('bencana_daerah/vbantuantersalurkan.js.php', '', true),
                'vbantuanditerimajs' => $this->load->view('bencana_daerah/vbantuanditerima.js.php', '', true),
                'vbantuanrelawanjs' => $this->load->view('bencana_daerah/vbantuanrelawan.js.php', '', true)
            ),
            true
        );

        $this->session_info['data_village']        = $this->mbencana_daerah->getVillageBencana($token_bencana_detail);
        $this->session_info['token']               = $dataTokenBencana;
        $this->session_info['kondisi_korban']      = $this->mbencana_daerah->getDataKorbanKondisi();
        $this->session_info['master_data_korban']  = $this->mbencana_daerah->getMasterDataKorban();
        $this->session_info['korban_bencana']      = $this->mbencana_daerah->getDataKorbanBencana();
        $this->session_info['sarana_rusak']        = $this->mbencana_daerah->getDataJenisSaranaRusak();
        $this->session_info['sarana_terendam']     = $this->mbencana_daerah->getDataJenisSaranaTerendam();
        $this->session_info['sarana_lainnya']      = $this->mbencana_daerah->getDataJenisSaranaLainnya();
        $this->session_info['jenis_ternak']        = $this->mbencana_daerah->getDataJenisTernak();
        $this->session_info['bantuan_diterima']    = $this->mbencana_daerah->getDataJenisBantuanDiterima();
        $this->session_info['bantuan_disalurkan']  = $this->mbencana_daerah->getDataJenisBantuanTersalurkan();
        $this->session_info['jenis_sumber']        = $this->mbencana_daerah->getDataJenisSumber();
        $this->session_info['vkorbanjiwa']         = $this->load->view('bencana_daerah/vkorbanjiwa', $this->session_info, true);
        $this->session_info['vkerusakan']          = $this->load->view('bencana_daerah/vkerusakan', $this->session_info, true);
        $this->session_info['vternak']             = $this->load->view('bencana_daerah/vternak', $this->session_info, true);
        $this->session_info['vbantuantersalurkan'] = $this->load->view('bencana_daerah/vbantuantersalurkan', $this->session_info, true);
        $this->session_info['vbantuanditerima']    = $this->load->view('bencana_daerah/vbantuanditerima', $this->session_info, true);
        $this->session_info['vbantuanrelawan']     = $this->load->view('bencana_daerah/vbantuanrelawan', $this->session_info, true);
        $this->template->build($this->_vwName . '/vdetail', $this->session_info);
    }

    public function create($type)
    {
        $result = array();
        $csrfHash = $this->security->get_csrf_hash();
        if ($type == 'korbanjiwa') {
            $response = $this->mbencana_daerah->createKorbanJiwa();
            if ($response['status'] == 'success') {
                $result = $response;
                $result['status'] = "RC200";
            } else {
                $result = $response;
                $result['status'] = "RC422";
            }
        } else if ($type == 'kerusakan') {
            $response = $this->mbencana_daerah->createKerusakan();
            if ($response['status'] == 'success') {
                $result = $response;
                $result['status'] = "RC200";
            } else {
                $result = $response;
                $result['status'] = "RC422";
            }
        } else if ($type == 'ternak') {
            $response = $this->mbencana_daerah->createTernak();
            if ($response['status'] == 'success') {
                $result = $response;
                $result['status'] = "RC200";
            } else {
                $result = $response;
                $result['status'] = "RC422";
            }
        } else if ($type == 'tersalurkan') {
            $response = $this->mbencana_daerah->createTersalurkan();
            if ($response['status'] == 'success') {
                $result = $response;
                $result['status'] = "RC200";
            } else {
                $result = $response;
                $result['status'] = "RC422";
            }
        } else if ($type == 'diterima') {
            $response = $this->mbencana_daerah->createDiterima();
            if ($response['status'] == 'success') {
                $result = $response;
                $result['status'] = "RC200";
            } else {
                $result = $response;
                $result['status'] = "RC422";
            }
        } else if ($type == 'relawan') {
            $response = $this->mbencana_daerah->createRelawan();
            if ($response['status'] == 'success') {
                $result = $response;
                $result['status'] = "RC200";
            } else {
                $result = $response;
                $result['status'] = "RC422";
            }
        } else
            $result = array('status' => 'error', 'message' => 'Type not found', 'csrfHash' => $csrfHash);


        $result['csrfHash'] = $csrfHash;
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

    public function review($type)
    {
        if ($type == 'getDataKorbanJiwa') {
            $wil_village = $this->input->get('wil_village');
            $token_bencana_detail = $this->input->get('token_bencana_detail');
            $data = $this->mbencana_daerah->getDataKorbanJiwa($token_bencana_detail, $wil_village);
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else if ($type == 'getDataKerusakan') {
            $wil_village = $this->input->get('wil_village');
            $token_bencana_detail = $this->input->get('token_bencana_detail');
            $data = $this->mbencana_daerah->getDataKerusakan($token_bencana_detail, $wil_village);
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else if ($type == 'getDataTernak') {
            $wil_village = $this->input->get('wil_village');
            $token_bencana_detail = $this->input->get('token_bencana_detail');
            $data = $this->mbencana_daerah->getDataTernak($token_bencana_detail, $wil_village);
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else if ($type == 'getDataTersalurkan') {
            $wil_village = $this->input->get('wil_village');
            $token_bencana_detail = $this->input->get('token_bencana_detail');
            $data = $this->mbencana_daerah->getDataTersalurkan($token_bencana_detail, $wil_village);
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else if ($type == 'getDataDiterima') {
            $wil_village = $this->input->get('wil_village');
            $token_bencana_detail = $this->input->get('token_bencana_detail');
            $data = $this->mbencana_daerah->getDataDiterima($token_bencana_detail, $wil_village);
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else if ($type == 'getDataRelawan') {
            $wil_village = $this->input->get('wil_village');
            $token_bencana_detail = $this->input->get('token_bencana_detail');
            $data = $this->mbencana_daerah->getDataRelawan($token_bencana_detail, $wil_village);
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else
            $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => 'error', 'message' => 'Type not found')));
    }


    //----------- DIBAWAH INI ADALAH FUNGSI UNTUK VALIDASI DATA KORBAN ------------------//
    public function reviewValidasi()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            $token_bencana_detail   = $this->input->post('token_bencana_detail', TRUE);
            // var_dump($token);
            // die;
            if (!empty($token_bencana_detail) and !empty($session)) {
                $data       = $this->mbencana_daerah->getDataDetailBencana($token_bencana_detail);
                $row = array();

                $row['token']      = !empty($data) ? $data['token_bencana_detail'] : '';

                // $row['gambar']             = !empty($gambar) ? $gambar : '';
                $result = array(
                    'status' => 'RC200', 'message' => array(
                        'data' => $data
                    ),
                    'csrfHash' => $csrfHash
                );
            } else {
                $result = array('status' => 'RC404', 'message' => array(), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    public function listviewKorban()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $data = array();
            $session = $this->app_loader->current_account();
            if (isset($session)) {
                $param    = $this->input->post('param', TRUE);
                $token_bencana_detail = $this->input->post('token_bencana_detail');
                $dataListKorban = $this->mbencana_daerah->get_datatables_korban($param, $token_bencana_detail);
                $no = $this->input->post('start');
                foreach ($dataListKorban as $key => $dl) {
                    $no++;
                    $row = array();
                    $row[] = '<div class="custom-control custom-checkbox mt-0 pt-0">
                                    <input type="checkbox" class="custom-control-input" name="checkid[]" id="u_' . $dl['token_korban_jiwa'] . '" value="' . $dl['token_korban_jiwa'] . '">
                                    <label class="custom-control-label font-weight-bolder" for="u_' . $dl['token_korban_jiwa'] . '"></label>
                                </div>';
                    $row[] = $no;
                    // $row[] = $dl['token_bencana_detail'];
                    $row[] = $dl['nm_village'];
                    $row[] = $dl['waktu_data'];
                    $row[] = $dl['nm_kondisi'];
                    $row[] = $dl['nm_jiwa'];
                    $row[] = $dl['jumlah_korban'];
                    $row[] = convert_status_validasi($dl['status_validasi']);
                    $data[] = $row;
                }
                $output = array(
                    "draw" => $this->input->post('draw'),
                    "recordsTotal" => $this->mbencana_daerah->count_all_korban(),
                    "recordsFiltered" => $this->mbencana_daerah->count_filtered_korban($param, $token_bencana_detail),
                    "data" => $data,
                );
            }
            //output to json format
            $this->output->set_content_type('application/json')->set_output(json_encode($output));
        }
    }

    public function createValidasiKorban()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            if (!empty($session)) {
                $data = $this->mbencana_daerah->updateValidasiKorban();
                if ($data['response'] == 'SUCCESS') {
                    $result = array('status' => 'RC200', 'message' => 'Proses update data validasi korban sukses', 'csrfHash' => $csrfHash);
                }
            } else {
                $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses update data validasi korban gagal, mohon coba kembali'), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    //----------- DIBAWAH INI ADALAH FUNGSI UNTUK VALIDASI DATA KORBAN ------------------//

}

// This is the end of fungsi class
