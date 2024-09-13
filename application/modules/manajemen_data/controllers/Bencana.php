<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of bencana class
 *
 * @author Dimas Dwi Randa
 */

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
        $this->form_validation->set_rules('tanggal_bencana', 'Tanggal Bencana', 'required|trim');
        $this->form_validation->set_rules('kategori_tanggap', 'Kategori Tanggap', 'required|trim');
        $this->form_validation->set_rules('id_jenis_bencana', 'Jenis Bencana', 'required|trim');
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
        $this->session_info['page_name']     = 'Manajemen Data Master Bencana';
        $this->session_info['siteUri']       = $this->_uriName;
        $this->session_info['page_css']      = $this->load->view($this->_vwName . '/vcss', '', true);
        $this->session_info['page_js']       = $this->load->view($this->_vwName . '/vjs', array('siteUri' => $this->_uriName), true);
        $this->session_info['jenis_bencana'] = $this->mmas->getDataJenisBencana();
        $this->session_info['tanggap_bencana'] = $this->mmas->getDataTanggapBencana();
        $this->session_info['pusdalops']     = $this->mmas->getDataPusdalops();
        $this->session_info['regency']       = $this->mmas->getDataRegency();
        $this->session_info['data_opd']      = "";
        $this->template->build($this->_vwName . '/vpage', $this->session_info);
    }

    //-------------------------------------- FUNGSI UNTUK PROSES DATA BENCANA ------------------------------//
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

                    if ($dl['id_status'] == 0) {
                        $status = '<a type="button" data-id="' . $dl['token_bencana'] . '" class="btn btn-grey btn-sm px-2 waves-effect waves-light btnEdit" title="Draft">
                        <i class="fas fa-business-time"></i> Draft
                        </a>
                        <a type="button" data-id="' . $dl['token_bencana'] . '" class="btn btn-grey btn-sm px-2 waves-effect waves-light btnFoto" title="Foto">
                        <i class="fas fa-camera-retro"></i> Foto
                        </a>
                        <a type="button" data-id="' . $dl['token_bencana'] . '" class="btn btn-grey btn-sm px-2 waves-effect waves-light btnVideo" title="Video">
                        <i class="fas fa-file-video"></i> Video
                        </a>
                        <a type="button" data-id="' . $dl['token_bencana'] . '" class="btn btn-success btn-sm px-2 waves-effect waves-light btnKirim" title="Kirim">
                        <i class="fas fa-paper-plane"></i> Kirim
                        </a>
                        <a type="button" data-id="' . $dl['token_bencana'] . '" class="btn btn-danger btn-sm px-2 waves-effect waves-light btnDelete" title="Delete Data">
                        <i class="fas fa-trash-alt"></i> Delete
                        </a>';
                    } else {
                        $status = '
                        <a type="button" data-id="' . $dl['token_bencana'] . '" class="btn btn-grey btn-sm px-2 waves-effect waves-light btnFoto" title="Foto">
                        <i class="fas fa-camera-retro"></i> Foto
                        </a>
                        <a type="button" data-id="' . $dl['token_bencana'] . '" class="btn btn-grey btn-sm px-2 waves-effect waves-light btnVideo" title="Video">
                        <i class="fas fa-file-video"></i> Video
                        </a>
                        <a type="button" data-id="' . $dl['token_bencana'] . '" class="btn btn-warning btn-sm px-2 waves-effect waves-light btnEdit" title="Draft">
                        <i class="fas fa-business-time"></i> Ubah Data
                        </a>
                        <a type="button" data-id="' . $dl['token_bencana'] . '" class="btn btn-primary btn-sm px-2 waves-effect waves-light btnKirim" title="Lihat Data">
                        <i class="fas fa-box-open"></i> Lihat Data
                        </a>
                        ';
                    }

                    $row[] = $no;
                    $row[] = $dl['jenis_bencana'];
                    $row[] = $dl['nama_bencana'];
                    $row[] = hari($dl['tanggal_bencana']) . ', ' . tgl_indonesia($dl['tanggal_bencana']) . ', ' . $dl['jam_bencana'] . ' WIB';
                    $row[] = convert_to_rupiah($dl['taksiran_kerugian']);
                    $row[] = convert_status_bencana($dl['id_status']);
                    $row[] =  $status;
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
                $dataDetail = $this->mbencana->getDataBencanaDetail($data['token_bencana']);

                $row = array();
                $row['logo']               = !empty($gambar) ? $gambar : '';
                $row['token']              = !empty($data) ? $data['token_bencana'] : '';
                $row['tanggal_bencana']    = !empty($data) ? $data['tanggal_bencana'] : '';
                $row['jam_bencana']        = !empty($data) ? $data['jam_bencana'] : '';
                $row['kategori_tanggap']   = !empty($data) ? $data['kategori_tanggap'] : 0;
                $row['video_bencana']      = !empty($data) ? $data['video_bencana'] : '';
                $row['taksiran_kerugian']  = !empty($data) ? $data['taksiran_kerugian'] : 0;
                $row['id_jenis_bencana']   = !empty($data) ? $data['id_jenis_bencana'] : 0;
                $row['nama_bencana']       = !empty($data) ? $data['nama_bencana'] : '';
                $row['keterangan_bencana'] = !empty($data) ? $data['keterangan_bencana'] : '';
                $row['penyebab_bencana']   = !empty($data) ? $data['penyebab_bencana'] : '';
                $row['latitude']           = !empty($data) ? $data['latitude'] : '';
                $row['longitude']          = !empty($data) ? $data['longitude'] : '';
                $row['id_status']          = !empty($data) ? $data['id_status'] : '';
                $row['nama_file']          = !empty($data) ? $data['nama_file'] : '';
                $row['nama_file_infografis']          = !empty($data) ? $data['nama_file_infografis'] : '';
                $result = array(
                    'status' => 'RC200', 'message' => array(
                        'dataBencana'     => $data,
                        'dataDetailBencana' => $dataDetail
                    ),
                    'csrfHash' => $csrfHash
                );
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

    //-------------------------------------- FUNGSI UNTUK PROSES DATA BENCANA ------------------------------//

    //-------------------------------------- FUNGSI UNTUK PROSES KIRIM BENCANA KE DAERAH -------------------//

    public function review()
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
                $dataDetail = $this->mbencana->getDataBencanaDetail($data['token_bencana']);

                $row = array();

                $row['token']              = !empty($data) ? $data['token_bencana'] : '';
                $row['tanggal_bencana']    = !empty($data) ? $data['tanggal_bencana'] : '';
                $row['jam_bencana']        = !empty($data) ? $data['jam_bencana'] : '';
                $row['nm_tanggap']         = !empty($data) ? $data['nm_tanggap'] : '';
                $row['jenis_bencana']      = !empty($data) ? $data['jenis_bencana'] : '';
                $row['nama_bencana']       = !empty($data) ? $data['nama_bencana'] : '';
                $row['keterangan_bencana'] = !empty($data) ? $data['keterangan_bencana'] : '';
                $row['penyebab_bencana']   = !empty($data) ? $data['penyebab_bencana'] : '';
                $row['video_bencana']      = !empty($data) ? $data['video_bencana'] : '';
                $row['taksiran_kerugian']  = !empty($data) ? $data['taksiran_kerugian'] : '';
                $row['id_status']          = !empty($data) ? $data['id_status'] : '';
                $row['nama_file']          = !empty($data) ? $data['nama_file'] : '';
                $row['nama_file_infografis']          = !empty($data) ? $data['nama_file_infografis'] : '';

                // $row['id_regency_penerima']          = !empty($dataDetail) ? $dataDetail['id_regency_penerima'] : '';

                // $row['gambar']             = !empty($gambar) ? $gambar : '';
                $result = array(
                    'status' => 'RC200', 'message' => array(
                        'dataBencanaKirim'     => $data,
                        'dataDetailBencana' => $dataDetail
                    ),
                    'csrfHash' => $csrfHash
                );
            } else {
                $result = array('status' => 'RC404', 'message' => array(), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    public function kirim()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            $contId   = escape($this->input->post('tokenId', TRUE));
            if (!empty($session) and !empty($contId)) {
                $data = $this->mbencana->kirimDatabencana();
                if ($data['response'] == 'SUCCESS') {
                    $result = array('status' => 'RC200', 'message' => 'Proses kirim data bencana sukses', 'csrfHash' => $csrfHash);
                }
            } else {
                $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses kirim data bencana gagal, mohon coba kembali'), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    //-------------------------------------- FUNGSI UNTUK PROSES KIRIM BENCANA KE DAERAH -------------------//

    //-------------------------------------- FUNGSI UNTUK PROSES SHARE PUSDALOPS DAERAH --------------------//

    public function detailShare()
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
                $data       = $this->mbencana->getDataBencanaShare($token_bencana_detail);
                $row = array();
                $row['token_bencana'] = !empty($data) ? $data['token_bencana'] : '';
                $row['token_bencana_detail'] = !empty($data) ? $data['token_bencana_detail'] : '';
                $row['id_regency_penerima']   = !empty($data) ? $data['id_regency_penerima'] : '';
                $result = array('status' => (($data != '') ? 'RC200' : 'RC404'), 'message' => $data, 'csrfHash' => $csrfHash);
            } else {
                $result = array('status' => 'RC404', 'message' => '', 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }


    public function updateShare()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            $contId   = escape($this->input->post('tokenId', TRUE));
            if (!empty($session) and !empty($contId)) {
                $data = $this->mbencana->updateDataShare();
                if ($data['response'] == 'ERROR') {
                    $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses update data gagal, karena data tidak ditemukan'), 'csrfHash' => $csrfHash);
                } else if ($data['response'] == 'ERRDATA') {
                    $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses update data gagal, karena ditemukan yang sama'), 'csrfHash' => $csrfHash);
                } else if ($data['response'] == 'SUCCESS') {
                    $result = array('status' => 'RC200', 'message' => 'Proses update data sukses', 'csrfHash' => $csrfHash);
                }
            } else {
                $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses update data gagal, mohon coba kembali'), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    public function deletePusdalops()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            $tokenId   = escape($this->input->post('tokenId', TRUE));

            if (!empty($session) and !empty($tokenId)) {
                $data = $this->mbencana->deleteDataPusdalops();
                if ($data['response'] == 'ERROR') {
                    $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses update data gagal, karena data tidak ditemukan'), 'csrfHash' => $csrfHash);
                } else
                if ($data['response'] == 'SUCCESS') {
                    $result = array('status' => 'RC200', 'message' => 'Proses delete data pusdalops berhasil', 'csrfHash' => $csrfHash);
                }
            } else {
                $result = array('status' => 0, 'message' => 'Proses delete data pusdalops gagal, mohon coba kembali', 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }
    //-------------------------------------- FUNGSI UNTUK PROSES SHARE PUSDALOPS DAERAH --------------------//

    //------------------------------- FUNGSI UNTUK PROSES MULTI UPLOAD DOCUMENT BENCANA --------------------//
    public function reviewFoto()
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
                $dataFoto = $this->mbencana->getDataBencanaFoto($data['token_bencana']);
                $row = array();

                $row['token'] = !empty($data) ? $data['token_bencana'] : '';

                $result = array(
                    'status' => 'RC200', 'message' => array(
                        'data'     => $data,
                        'dataFoto' => $dataFoto
                    ),
                    'csrfHash' => $csrfHash
                );
            } else {
                $result = array('status' => 'RC404', 'message' => array(), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    public function createFoto()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            if (!empty($session)) {
                $data = $this->mbencana->insertDataFotoBencana();
                if ($data['response'] == 'ERROR') {
                    $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses insert foto gagal, karena ditemukan nama yang sama'), 'csrfHash' => $csrfHash);
                } else if ($data['response'] == 'SUCCESS') {
                    $result = array('status' => 'RC200', 'message' => 'Proses insert foto sukses', 'csrfHash' => $csrfHash);
                }
            } else {
                $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses insert foto gagal, mohon coba kembali'), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    public function deleteFoto()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session   = $this->app_loader->current_account();
            $csrfHash  = $this->security->get_csrf_hash();
            $id   = escape($this->input->post('tokenId', TRUE));
            if (!empty($session) and !empty($id)) {
                $data = $this->mbencana->deleteDataFotoBencana();
                if ($data['response'] == 'SUCCESS') {
                    $result = array('status' => 'RC200', 'message' => 'Proses delete Foto dengan sukses', 'csrfHash' => $csrfHash);
                }
            } else {
                $result = array('status' => 0, 'message' => 'Proses delete Foto gagal, coba kembali', 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    //------------------------------- FUNGSI UNTUK PROSES MULTI UPLOAD DOCUMENT BENCANA --------------------//

    //------------------------------- FUNGSI UNTUK PROSES MULTI VIDEO DOCUMENT BENCANA --------------------//
    public function reviewVideo()
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
                $dataVideo = $this->mbencana->getDataBencanaVideo($data['token_bencana']);
                // print_r($dataVideo);
                // die;
                $row = array();

                $row['token'] = !empty($data) ? $data['token_bencana'] : '';

                $result = array(
                    'status' => 'RC200', 'message' => array(
                        'data'     => $data,
                        'dataVideo' => $dataVideo
                    ),
                    'csrfHash' => $csrfHash
                );
            } else {
                $result = array('status' => 'RC404', 'message' => array(), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    public function createVideo()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            if (!empty($session)) {
                $data = $this->mbencana->insertDataVideoBencana();
                if ($data['response'] == 'ERROR') {
                    $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses insert video gagal, karena ditemukan nama yang sama'), 'csrfHash' => $csrfHash);
                } else if ($data['response'] == 'SUCCESS') {
                    $result = array('status' => 'RC200', 'message' => 'Proses insert video sukses', 'csrfHash' => $csrfHash);
                }
            } else {
                $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses insert video gagal, mohon coba kembali'), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    public function deleteVideo()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session   = $this->app_loader->current_account();
            $csrfHash  = $this->security->get_csrf_hash();
            $id   = escape($this->input->post('tokenId', TRUE));
            if (!empty($session) and !empty($id)) {
                $data = $this->mbencana->deleteDataVideoBencana();
                if ($data['response'] == 'SUCCESS') {
                    $result = array('status' => 'RC200', 'message' => 'Proses delete Foto dengan sukses', 'csrfHash' => $csrfHash);
                }
            } else {
                $result = array('status' => 0, 'message' => 'Proses delete Foto gagal, coba kembali', 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    //------------------------------- FUNGSI UNTUK PROSES MULTI VIDEO DOCUMENT BENCANA --------------------//
}

// This is the end of fungsi class
