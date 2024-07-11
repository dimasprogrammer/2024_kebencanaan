<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of inovasi class
 *
 * @author Dimas Dwi Randa
 */

class Inovasi extends SLP_Controller
{
    protected $_vwName  = '';
    protected $_uriName = '';
    protected $_vwNameIndikator  = '';
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_inovasi' => 'minov', 'model_nilai_indikator' => 'mindi', 'master/model_master' => 'mmas', 'manajemen/model_users' => 'muser'));
        $this->_vwName = 'inovasi';
        $this->_vwNameIndikator = 'indikator';
        $this->_uriName = 'manajemen_verifikator/inovasi';
    }

    private function validasiDataValue()
    {
        $this->form_validation->set_rules('nama_inovasi', 'Nama inovasi', 'required|trim');
        validation_message_setting();
        if ($this->form_validation->run() == FALSE)
            return false;
        else
            return true;
    }

    private function validasiDataValuePermohonan()
    {
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
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
        $this->breadcrumb->add('inovasi', site_url($this->_uriName));
        $this->session_info['page_name']       = 'Manajemen Data Inovasi Instansi';
        $this->session_info['siteUri']         = $this->_uriName;
        $this->session_info['page_js']         = $this->load->view($this->_vwName . '/vjs', array('siteUri' => $this->_uriName), true);
        $this->session_info['bentuk_inovasi']  = $this->mmas->getDataBentukInovasi();
        $this->session_info['tematik']         = $this->mmas->getDataTematik();
        $this->session_info['urusan_utama']    = $this->mmas->getDataUrusanUtama();
        $this->session_info['urusan_lainnya']  = $this->mmas->getDataUrusanLainnya();
        $this->session_info['fileupload']  = $this->mmas->getJenisFile();
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
                $id_tahapan_inovasi = $this->input->post('id_tahapan_inovasi');
                $dataList = $this->minov->get_datatables($id_tahapan_inovasi, $param);
                $no = $this->input->post('start');
                foreach ($dataList as $key => $dl) {
                    $no++;
                    $row = array();
                    if ($dl['id_tahapan_inovasi'] == 1) {
                        $tahapan = 'Inisiatif';
                    } else if ($dl['id_tahapan_inovasi'] == 2) {
                        $tahapan = 'Uji Coba';
                    } else {
                        $tahapan = 'Penerapan';
                    }

                    $totalKematangan = $this->mindi->getSkorNilaiKematanganWajib($dl['token']);
                    $row[] = $no;
                    $row[] = $dl['opd_id_name'];
                    $row[] = $dl['nama_inovasi'];
                    $row[] = $dl['nm_urusan_utama'];
                    $row[] = tgl_indo($dl['waktu_uji_coba']);
                    $row[] = $tahapan;
                    $row[] = tgl_indo($dl['waktu_penerapan']);
                    $row[] = $totalKematangan;
                    $row[] = convert_status_inovasi($dl['status_inovasi']);
                    $row[] = '
                    <button type="button" class="btn btn-gray btn-sm px-2 py-1 my-0 mx-0 waves-effect waves-light btnExcel" data-id="' . $dl['token'] . '" title="Unduh Ringkasan Profil Excel"><i class="far fa-file-excel"></i></button>
                    <button type="button" class="btn btn-gray btn-sm px-2 py-1 my-0 mx-0 waves-effect waves-light btnPDF" data-id="' . $dl['token'] . '" title="Unduh Ringkasan Profil PDF"><i class="far fa-file-pdf"></i></button>
                    <a href="' . site_url('manajemen_verifikator/inovasi/nilai_indikator/' . $dl['token']) . '" type="button" class="btn btn-gray btn-sm px-2 py-1 my-0 mx-0 waves-effect waves-light btnIndikator" title="Indikator Satuan">
                    <i class="far fa-folder-open"></i>
                    </a><button type="button" class="btn btn-primary btn-m px-2 py-1 my-0 mx-0 waves-effect waves-light btnPengirim" data-id="' . $dl['token'] . '" title="Lihat Data Pengirim"><i class="fas fa-user-astronaut"></i></button>
                    <button type="button" class="btn btn-gray btn-sm px-2 py-1 my-0 mx-0 waves-effect waves-light btnEdit" data-id="' . $dl['token'] . '" title="Edit data"><i class="fas fa-pencil-alt"></i></button>
                    <button type="button" class="btn btn-danger btn-sm px-2 py-1 my-0 mx-0 waves-effect waves-light btnDelete" data-id="' . $dl['token'] . '" title="Hapus data"><i class="fas fa-trash-alt"></i></button>
                    ';
                    $data[] = $row;
                }
                $output = array(
                    "draw" => $this->input->post('draw'),
                    "recordsTotal" => $this->minov->count_all($id_tahapan_inovasi, $param),
                    "recordsFiltered" => $this->minov->count_filtered($id_tahapan_inovasi, $param),
                    "data" => $data,
                );
            }
            //output to json format
            $this->output->set_content_type('application/json')->set_output(json_encode($output));
        }
    }

    //------------------------------------------- CREATE, UPDATE DAN DELETE DATA INOVASI ------------------------------------------//
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
                    $data = $this->minov->insertDataInovasi();
                    if ($data['response'] == 'ERROR') {
                        $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses insert data inovasi baru dengan nama ' . $data['nama'] . ' gagal, karena ditemukan nama yang sama'), 'csrfHash' => $csrfHash);
                    } else if ($data['response'] == 'SUCCESS') {
                        $result = array('status' => 'RC200', 'message' => 'Proses insert data inovasi baru dengan nama ' . $data['nama'] . ' sukses', 'csrfHash' => $csrfHash);
                    }
                }
            } else {
                $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses insert data inovasi baru gagal, mohon coba kembali'), 'csrfHash' => $csrfHash);
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
            $contId   = $this->input->post('token', TRUE);
            if (!empty($contId) and !empty($session)) {
                $data = $this->minov->getDataDetailInovasi($contId);
                $detail = $this->minov->getDataFile($contId);
                $row = array();
                $row['nama_file'] = array();
                foreach ($detail as $key => $value) {
                    $year   = substr($value['create_date'], 0, 4);
                    $month  = substr($value['create_date'], 5, 2);
                    if ($value['nama_file'] == '') {
                        $gambar = '';
                    } else {
                        $gambar = '<a href="' . site_url('dokumen/inovasi/' . $year . '/' . $month . '/' . $value['nama_file']) . '" >' . $value['nama_file'] . '</a>';
                    }
                    $row['nama_file'][$value['id_category_file']] = '<a href="' . site_url('dokumen/inovasi/' . $year . '/' . $month . '/' . $value['nama_file']) . '" >' . $value['nama_file'] . '</a>';
                    $row['nama_file'][$value['id_category_file']] = $gambar;
                }
                $row['token']                = !empty($data) ? $data['token'] : '';
                $row['nama_inovasi']         = !empty($data) ? $data['nama_inovasi'] : '';
                $row['type_tahapan']         = !empty($data) ? $data['id_tahapan_inovasi'] : '';
                $row['type_inisiator']       = !empty($data) ? $data['id_inisiator_inovasi'] : '';
                $row['type_jenis']           = !empty($data) ? $data['id_jenis_inovasi'] : '';
                $row['id_bentuk_inovasi']    = !empty($data) ? $data['id_bentuk_inovasi'] : '';
                $row['id_tematik']           = !empty($data) ? $data['id_tematik'] : '';
                $row['id_urusan_utama']      = !empty($data) ? $data['id_urusan_utama'] : '';
                $row['id_urusan_lainnya']    = !empty($data) ? $data['id_urusan_lainnya'] : '';
                $row['waktu_uji_coba']       = !empty($data) ? $data['waktu_uji_coba'] : '';
                $row['waktu_penerapan']      = !empty($data) ? $data['waktu_penerapan'] : '';
                $row['rancang_bangun']       = !empty($data) ? $data['rancang_bangun'] : '';
                $row['rancang_perbaikan']    = !empty($data) ? $data['rancang_perbaikan'] : '';
                $row['status_inovasi']    = !empty($data) ? $data['status_inovasi'] : '';
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
                    $data = $this->minov->updateDataInovasi();
                    if ($data['response'] == 'ERROR') {
                        $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses update data inovasi gagal, karena data tidak ditemukan'), 'csrfHash' => $csrfHash);
                    } else if ($data['response'] == 'ERRDATA') {
                        $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses update data inovasi dengan nama ' . $data['nama'] . ' gagal, karena ditemukan nama yang sama'), 'csrfHash' => $csrfHash);
                    } else if ($data['response'] == 'SUCCESS') {
                        $result = array('status' => 'RC200', 'message' => 'Proses update data inovasi dengan nama ' . $data['nama'] . ' sukses', 'csrfHash' => $csrfHash);
                    }
                }
            } else {
                $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses update data inovasi gagal, mohon coba kembali'), 'csrfHash' => $csrfHash);
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
                $data = $this->minov->deleteDataInovasi();

                if ($data['response'] == 'ERROR') {
                    $result = array('status' => 'RC404', 'message' => 'Proses delete data inovasi gagal, karena data tidak ditemukan', 'csrfHash' => $csrfHash);
                } else if ($data['response'] == 'ERRDATA') {
                    $result = array('status' => 'RC404', 'message' => 'Proses delete data inovasi dengan nama ' . $data['nama'] . ' gagal, karena data sedang digunakan', 'csrfHash' => $csrfHash);
                } else if ($data['response'] == 'SUCCESS') {
                    $result = array('status' => 'RC200', 'message' => 'Proses delete data inovasi dengan nama ' . $data['nama'] . ' sukses', 'csrfHash' => $csrfHash);
                }
            } else {
                $result = array('status' => 0, 'message' => 'Proses delete data inovasi gagal, mohon coba kembali', 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    //------------------------------------------- CREATE, UPDATE DAN DELETE DATA INOVASI ------------------------------------------//

    //-------------------------------------- CREATE, UPDATE DAN DELETE DATA NILAI INDIKATOR ---------------------------------------//
    public function nilai_indikator($token)
    {
        $dataTokenInovasi = $this->mindi->addDataInovasiIndikator($token);
        // print_r($dataTokenInovasi);
        // die;
        if (count($dataTokenInovasi) <= 0)
            redirect('manajemen_data/inovasi');

        $this->breadcrumb->add('Dashboard', site_url('home'));
        $this->breadcrumb->add('Konfirmasi Indikator', '#');
        $this->breadcrumb->add('Indikator', site_url($this->_uriName));
        $this->breadcrumb->add('create_nilai', '#');

        $this->session_info['page_name']        = "Detail Indikator";
        $this->session_info['page_js']          = $this->load->view($this->_vwNameIndikator . '/vjs', array('siteUri' => $this->_uriName), true);
        $this->session_info['token_inovasi']    = $dataTokenInovasi;
        $this->session_info['list_indikator']   = $this->mindi->getDataIndikator();
        // $this->session_info['satuan_indikator'] = $this->mindi->getDataIndikatorSatuan();
        $this->template->build($this->_vwNameIndikator . '/vindikator', $this->session_info);
    }

    public function createNilai()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            if (!empty($session)) {
                $data = $this->mindi->insertDataIndikatorNilai();
                if ($data['response'] == 'ERROR') {
                    $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses insert data paramater gagal, karena parameter sudah di entrikan'), 'csrfHash' => $csrfHash);
                } else if ($data['response'] == 'SUCCESS') {
                    $result = array('status' => 'RC200', 'message' => 'Proses insert data paramater sukses', 'csrfHash' => $csrfHash);
                }
            } else {
                $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses insert data paramater gagal, mohon coba kembali'), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    public function detailsIndikator()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            $id_indikator   = $this->input->post('token', TRUE);
            if (!empty($id_indikator) and !empty($session)) {
                $data = $this->mindi->getDataIndikatorDetail($id_indikator);
                $dataSatuan = $this->mindi->getDataIndikatorSatuan($id_indikator);
                $row = array();
                // $row['token']        = !empty($data) ? $data['token'] : '';
                $row['id_indikator'] = !empty($data) ? $data['id_indikator'] : '';
                $row['indikator_satuan'] = !empty($dataSatuan) ? $dataSatuan : '';

                $result = array('status' => 'RC200', 'message' => $row, 'csrfHash' => $csrfHash);
            } else {
                $result = array('status' => 'RC404', 'message' => array(), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    //-------------------------------------- CREATE, UPDATE DAN DELETE DATA NILAI INDIKATOR ---------------------------------------//

    //-------------------------------------- CREATE, UPDATE DAN DELETE DATA INOVASI ----------------------------------------//
    public function detailsIndikatorFile()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            $id_indikator   = $this->input->post('token', TRUE);
            if (!empty($id_indikator) and !empty($session)) {
                $data = $this->mindi->getDataIndikatorDetail($id_indikator);
                $row = array();
                // $row['token']        = !empty($data) ? $data['token'] : '';
                $row['id_indikator'] = !empty($data) ? $data['id_indikator'] : '';

                $result = array('status' => 'RC200', 'message' => $row, 'csrfHash' => $csrfHash);
            } else {
                $result = array('status' => 'RC404', 'message' => array(), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    public function createFile()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            if (!empty($session)) {
                $data = $this->mindi->insertDataIndikatorFile();
                if ($data['response'] == 'ERROR') {
                    $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses insert data paramater gagal, karena parameter sudah di entrikan'), 'csrfHash' => $csrfHash);
                } else if ($data['response'] == 'SUCCESS') {
                    $result = array('status' => 'RC200', 'message' => 'Proses insert data paramater sukses', 'csrfHash' => $csrfHash);
                }
            } else {
                $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses insert data paramater gagal, mohon coba kembali'), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    public function detailUploadHasil()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            $token   = $this->input->post('token', TRUE);
            if (!empty($token) and !empty($session)) {
                $data = $this->minov->getDataDetailInovasi($token);
                $row = array();
                $row['token']        = !empty($data) ? $data['token'] : '';

                $result = array('status' => 'RC200', 'message' => $row, 'csrfHash' => $csrfHash);
            } else {
                $result = array('status' => 'RC404', 'message' => array(), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    public function createUploadHasil()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            if (!empty($session)) {
                $data = $this->minov->insertDataIndikatorFile();
                if ($data['response'] == 'ERROR') {
                    $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses insert data paramater gagal, karena parameter sudah di entrikan'), 'csrfHash' => $csrfHash);
                } else if ($data['response'] == 'SUCCESS') {
                    $result = array('status' => 'RC200', 'message' => 'Proses insert data paramater sukses', 'csrfHash' => $csrfHash);
                }
            } else {
                $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses insert data paramater gagal, mohon coba kembali'), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    //-------------------------------------- CREATE, UPDATE DAN DELETE DATA INOVASI ----------------------------------------//

    //-------------------------------------- CREATE, UPDATE DAN DELETE DATA PERMOHONAN INOVASI ----------------------------------------//
    public function detailPermohonan()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            $token   = $this->input->post('token', TRUE);
            if (!empty($token) and !empty($session)) {
                $data = $this->minov->getDataDetailInovasi($token);
                $row = array();
                $row['token']        = !empty($data) ? $data['token'] : '';

                $result = array('status' => 'RC200', 'message' => $row, 'csrfHash' => $csrfHash);
            } else {
                $result = array('status' => 'RC404', 'message' => array(), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    public function createPermohonan()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            if (!empty($session)) {
                if ($this->validasiDataValuePermohonan() == FALSE) {
                    $result = array('status' => 'RC404', 'message' => $this->form_validation->error_array(), 'csrfHash' => $csrfHash);
                } else {
                    $data = $this->minov->insertDataPermohonan();
                    if ($data['response'] == 'ERROR') {
                        $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses insert data Permohonan baru dengan nama ' . $data['nama'] . ' gagal, karena ditemukan nama yang sama'), 'csrfHash' => $csrfHash);
                    } else if ($data['response'] == 'SUCCESS') {
                        $result = array('status' => 'RC200', 'message' => 'Proses insert data Permohonan baru dengan nama ' . $data['nama'] . ' sukses', 'csrfHash' => $csrfHash);
                    }
                }
            } else {
                $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses insert data Permohonan baru gagal, mohon coba kembali'), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }
    //-------------------------------------- CREATE, UPDATE DAN DELETE DATA PERMOHONAN INOVASI ----------------------------------------//

    //-------------------------------------- DETAIL PENGIRIM ----------------------------------------//
    public function detailPengirim()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            $token   = $this->input->post('token', TRUE);
            if (!empty($token) and !empty($session)) {
                $data = $this->minov->getDataDetailPengirim($token);
                $row = array();
                $row['token']        = !empty($data) ? $data['token'] : '';
                $row['nama_lengkap'] = !empty($data) ? $data['nama_lengkap'] : '';
                $row['jabatan']      = !empty($data) ? $data['jabatan'] : '';
                $row['instansi']     = !empty($data) ? $data['instansi'] : '';
                $row['no_hp']        = !empty($data) ? $data['no_hp'] : '';
                $row['email']        = !empty($data) ? $data['email'] : '';

                $result = array('status' => 'RC200', 'message' => $row, 'csrfHash' => $csrfHash);
            } else {
                $result = array('status' => 'RC404', 'message' => array(), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }
    //-------------------------------------- DETAIL PENGIRIM ----------------------------------------//

    //-------------------------------------- CREATE, UPDATE DAN DELETE DATA PARAMETER -------------------------------------------//
    public function deleteParameter()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            $contId   = escape($this->input->post('tokenId', TRUE));

            if (!empty($session) and !empty($contId)) {
                $data = $this->mindi->deleteDataParameter();

                if ($data['response'] == 'ERROR') {
                    $result = array('status' => 'RC404', 'message' => 'Proses delete data parameter gagal, karena data tidak ditemukan', 'csrfHash' => $csrfHash);
                } else if ($data['response'] == 'ERRDATA') {
                    $result = array('status' => 'RC404', 'message' => 'Proses delete data parameter gagal, karena data sedang digunakan', 'csrfHash' => $csrfHash);
                } else if ($data['response'] == 'SUCCESS') {
                    $result = array('status' => 'RC200', 'message' => 'Proses delete data parameter sukses', 'csrfHash' => $csrfHash);
                }
            } else {
                $result = array('status' => 0, 'message' => 'Proses delete data parameter gagal, mohon coba kembali', 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    //-------------------------------------- DELETE FILE PENDUKUNG -------------------------------------------//
    public function deleteFilePendukung()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            $contId   = escape($this->input->post('tokenId', TRUE));

            if (!empty($session) and !empty($contId)) {
                $data = $this->mindi->deleteDataIndikatorFile($contId);
                if ($data['response'] == 'SUCCESS') {
                    $result = array('status' => 'RC200', 'message' => 'Proses delete data file pendukung sukses', 'csrfHash' => $csrfHash);
                }
            } else {
                $result = array('status' => 0, 'message' => 'Proses delete data file pendukung gagal, mohon coba kembali', 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }
    //-------------------------------------- DELETE FILE PENDUKUNG -------------------------------------------//

    //-------------------------------------- CREATE, UPDATE DAN DELETE DATA LINK -------------------------------------------//
    public function createLink()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            if (!empty($session)) {
                $data = $this->mindi->insertDataIndikatorLink();
                if ($data['response'] == 'ERROR') {
                    $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses insert data Link gagal, karena parameter sudah di entrikan'), 'csrfHash' => $csrfHash);
                } else if ($data['response'] == 'SUCCESS') {
                    $result = array('status' => 'RC200', 'message' => 'Proses insert data Link sukses', 'csrfHash' => $csrfHash);
                }
            } else {
                $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses insert data Link gagal, mohon coba kembali'), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    public function deleteLink()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            $contId   = escape($this->input->post('tokenId', TRUE));

            if (!empty($session) and !empty($contId)) {
                $data = $this->mindi->deleteDataLink();
                if ($data['response'] == 'ERROR') {
                    $result = array('status' => 'RC404', 'message' => 'Proses delete data Link gagal, karena data tidak ditemukan', 'csrfHash' => $csrfHash);
                } else if ($data['response'] == 'ERRDATA') {
                    $result = array('status' => 'RC404', 'message' => 'Proses delete data Link gagal, karena data sedang digunakan', 'csrfHash' => $csrfHash);
                } else if ($data['response'] == 'SUCCESS') {
                    $result = array('status' => 'RC200', 'message' => 'Proses delete data Link sukses', 'csrfHash' => $csrfHash);
                }
            } else {
                $result = array('status' => 0, 'message' => 'Proses delete data Link gagal, mohon coba kembali', 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }
    //-------------------------------------- CREATE, UPDATE DAN DELETE DATA LINK -------------------------------------------//

    //-------------------------------------- CREATE, UPDATE DAN DELETE DATA CATATAN -------------------------------------------//
    public function createCatatan()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            if (!empty($session)) {
                $data = $this->mindi->insertDataIndikatorCatatan();
                if ($data['response'] == 'ERROR') {
                    $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses insert data Catatan gagal, karena parameter sudah di entrikan'), 'csrfHash' => $csrfHash);
                } else if ($data['response'] == 'SUCCESS') {
                    $result = array('status' => 'RC200', 'message' => 'Proses insert data Catatan sukses', 'csrfHash' => $csrfHash);
                }
            } else {
                $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses insert data Catatan gagal, mohon coba kembali'), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }
    //-------------------------------------- CREATE, UPDATE DAN DELETE DATA CATATAN -------------------------------------------//
}

// This is the end of fungsi class
