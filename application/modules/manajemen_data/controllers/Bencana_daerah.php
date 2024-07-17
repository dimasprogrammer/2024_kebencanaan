<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of bencana_daerah class
 *
 * @author Dimas Dwi Randa
 */

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
                    $row[] = ' <a href="' . site_url('manajemen_data/bencana_daerah/detail_bencana/' . $dl['token_bencana_share']) . '" type="button" class="btn btn-gray btn-sm px-2 py-1 my-0 mx-0 waves-effect waves-light btnIndikator" title="Indikator Satuan">
                        <i class="far fa-folder-open"></i> Detail
                        </a>';
                    // $row[] = $dl['id_status'];
                    // $row[] = '<button type="button" class="btn btn-orange btn-sm px-2 py-1 my-0 mx-0 waves-effect waves-light btnEdit" data-id="' . $dl['token_bencana_share'] . '" title="Edit data"><i class="fas fa-pencil-alt"></i></button> <button type="button" class="btn btn-danger btn-sm px-2 py-1 my-0 mx-0 waves-effect waves-light btnDelete" data-id="' . $dl['token_bencana_share'] . '" title="Delete data"><i class="fas fa-trash-alt"></i></button>';
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

    public function detail_bencana($token_bencana_share)
    {
        $dataTokenBencana = $this->mbencana_daerah->addDataDetailBencanaShare($token_bencana_share);
        // print_r($dataTokenBencana);
        // die;
        if (count($dataTokenBencana) <= 0)
            redirect('manajemen_data/bencana_daerah');

        $this->breadcrumb->add('Dashboard', site_url('home'));
        $this->breadcrumb->add('Konfirmasi Indikator', '#');
        $this->breadcrumb->add('Indikator', site_url($this->_uriName));
        $this->breadcrumb->add('create_nilai', '#');

        $this->session_info['page_name']        = "Detail Indikator";
        $this->session_info['page_js']          = $this->load->view($this->_vwName . '/vjs', array('siteUri' => $this->_uriName), true);
        $this->session_info['token_bencana_share']    = $dataTokenBencana;
        $this->template->build($this->_vwName . '/vdetail', $this->session_info);
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
                    $data = $this->mbencana_daerah->insertDatabencana_daerah();
                    if ($data['response'] == 'ERROR') {
                        $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses insert data bencana_daerah baru pada tanggal ' . $data['nama'] . ' gagal, karena ditemukan nama yang sama'), 'csrfHash' => $csrfHash);
                    } else if ($data['response'] == 'SUCCESS') {
                        $result = array('status' => 'RC200', 'message' => 'Proses insert data bencana_daerah baru pada tanggal ' . $data['nama'] . ' sukses', 'csrfHash' => $csrfHash);
                    }
                }
            } else {
                $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses insert data bencana_daerah baru gagal, mohon coba kembali'), 'csrfHash' => $csrfHash);
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
            $token_bencana_daerah   = $this->input->post('token_bencana_daerah', TRUE);
            // var_dump($token);
            // die;
            if (!empty($token_bencana_daerah) and !empty($session)) {
                $data       = $this->mbencana_daerah->getDataDetailbencana_daerah($token_bencana_daerah);
                $dataDetail = $this->mbencana_daerah->getDatabencana_daerahDetail($data['token_bencana_daerah']);

                $row = array();
                $year    = substr($data['create_date'], 0, 4);
                $month  = substr($data['create_date'], 5, 2);
                if ($data['nama_file'] == '') {
                    $gambar = '';
                } else {
                    $gambar = '<a target="_blank" href="' . site_url('dokumen/bencana_daerah/' . $year . '/' . $month . '/' . $data['nama_file']) . '" > Lihat Gambar </a>';
                }
                $row['gambar']          = !empty($gambar) ? $gambar : '';
                $row['token']           = !empty($data) ? $data['token_bencana_daerah'] : '';
                $row['id_jenis_bencana_daerah']           = !empty($data) ? $data['id_jenis_bencana_daerah'] : '';
                $row['nama_bencana_daerah']    = !empty($data) ? $data['nama_bencana_daerah'] : '';
                $row['penyebab_bencana_daerah']    = !empty($data) ? $data['penyebab_bencana_daerah'] : '';
                $row['kategori_bencana_daerah']    = !empty($data) ? $data['kategori_bencana_daerah'] : '';
                $row['jumlah_kejadian']    = !empty($data) ? $data['jumlah_kejadian'] : '';
                $row['kategori_tanggap']    = !empty($data) ? $data['kategori_tanggap'] : '';
                $row['tanggal_bencana_daerah'] = !empty($data) ? $data['tanggal_bencana_daerah'] : '';
                $row['latitude']        = !empty($data) ? $data['latitude'] : '';
                $row['longitude']       = !empty($data) ? $data['longitude'] : '';
                $row['id_status']       = !empty($data) ? $data['id_status'] : '';
                $result = array(
                    'status' => 'RC200', 'message' => array(
                        'databencana_daerah'     => $data,
                        'dataDetailbencana_daerah' => $dataDetail
                    ),
                    'csrfHash' => $csrfHash
                );
            } else {
                $result = array('status' => 'RC404', 'message' => array(), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    public function detailShare()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            $token_bencana_daerah_share   = $this->input->post('token_bencana_daerah_share', TRUE);
            // var_dump($token);
            // die;
            if (!empty($token_bencana_daerah_share) and !empty($session)) {
                $data       = $this->mbencana_daerah->getDatabencana_daerahShare($token_bencana_daerah_share);
                $row = array();
                $row['token_bencana_daerah'] = !empty($data) ? $data['token_bencana_daerah'] : '';
                $row['token_bencana_daerah_share'] = !empty($data) ? $data['token_bencana_daerah_share'] : '';
                $row['id_users_penerima']   = !empty($data) ? $data['id_users_penerima'] : '';
                $result = array('status' => (($data != '') ? 'RC200' : 'RC404'), 'message' => $data, 'csrfHash' => $csrfHash);
            } else {
                $result = array('status' => 'RC404', 'message' => '', 'csrfHash' => $csrfHash);
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
                    $data = $this->mbencana_daerah->updateDatabencana_daerah();
                    if ($data['response'] == 'ERROR') {
                        $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses update data bencana_daerah gagal, karena data tidak ditemukan'), 'csrfHash' => $csrfHash);
                    } else if ($data['response'] == 'ERRDATA') {
                        $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses update data bencana_daerah dengan nama ' . $data['nama'] . ' gagal, karena ditemukan nama yang sama'), 'csrfHash' => $csrfHash);
                    } else if ($data['response'] == 'SUCCESS') {
                        $result = array('status' => 'RC200', 'message' => 'Proses update data bencana_daerah dengan nama ' . $data['nama'] . ' sukses', 'csrfHash' => $csrfHash);
                    }
                }
            } else {
                $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses update data bencana_daerah gagal, mohon coba kembali'), 'csrfHash' => $csrfHash);
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
                $data = $this->mbencana_daerah->updateDataShare();
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

    public function delete()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            $contId   = escape($this->input->post('tokenId', TRUE));

            if (!empty($session) and !empty($contId)) {
                $data = $this->mbencana_daerah->deleteDatabencana_daerah();

                if ($data['response'] == 'ERROR') {
                    $result = array('status' => 'RC404', 'message' => 'Proses delete data bencana_daerah gagal, karena data tidak ditemukan', 'csrfHash' => $csrfHash);
                } else if ($data['response'] == 'ERRDATA') {
                    $result = array('status' => 'RC404', 'message' => 'Proses delete data bencana_daerah dengan nama ' . $data['nama'] . ' gagal, karena data sedang digunakan', 'csrfHash' => $csrfHash);
                } else if ($data['response'] == 'SUCCESS') {
                    $result = array('status' => 'RC200', 'message' => 'Proses delete data bencana_daerah dengan nama ' . $data['nama'] . ' sukses', 'csrfHash' => $csrfHash);
                }
            } else {
                $result = array('status' => 0, 'message' => 'Proses delete data bencana_daerah gagal, mohon coba kembali', 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    public function export_to_pdf()
    {
        $token = $this->input->get('token', TRUE);

        $this->session_info['list_indikator']   = $this->mindi->getDataIndikator();
        $data['data'] = $this->mbencana_daerah->getDatabencana_daerahCetakPDF($token);
        // $data['data'] = 'panggil';


        // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        // $view_data   = base_url() . 'assets/img/balitbang.png';
        // var_dump($view_data);
        // die;
        // $path = $view_data;
        // $type = pathinfo($path, PATHINFO_EXTENSION);
        // $database = file_get_contents($path);

        // $data['test'] = REALPATH . '/assets/img/balitbang.png';

        // $data['base64'] = 'data:image/' . $type . ';base64,' . base64_encode($database);
        $this->load->library('pdfgenerator');
        // title dari pdf
        // $data['title_pdf']  =   'DATA USULAN ' . $data['data']['nama_bencana_daerah'];
        // filename dari pdf ketika didownload
        $file_pdf = "testubg";
        // setting paper
        $paper = 'legal';
        // $paper = 'legal';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        $html = $this->load->view($this->_vwName . '/vprint', $data, true);
        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }



    public function export_to_excel()
    {
        require realpath('vendor/autoload.php');

        $opd    = escape($this->input->get('opd', TRUE));
        $databencana_daerah = $this->mbencana_daerah->getDataCetakExcel($opd);

        $noRow = 0;
        $baseRow = 6;
        $spreadsheet = new Spreadsheet();
        $templatePath = 'repository/profil_excel.xlsx';
        $spreadsheet = IOFactory::load($templatePath);
        $activeWorksheet = $spreadsheet->getActiveSheet();
        if (count($databencana_daerah) > 0) {
            foreach ($databencana_daerah as $key => $dInov) {

                $dataBobot      = $this->mbencana_daerah->getTotalBobotByIdbencana_daerah($dInov['token']);
                $checkDataLink  = $this->mbencana_daerah->cekDokumenLink($dInov['token']);
                if ($dInov['id_jenis_bencana_daerah'] == 1) {
                    $jenis = 'Digital';
                } else {
                    $jenis = 'Non Digital';
                }

                if ($dInov['id_inisiator_bencana_daerah'] == 1) {
                    $inisiator = 'Kepala OPD';
                } else if ($dInov['id_inisiator_bencana_daerah'] == 2) {
                    $inisiator = 'Anggota DPRD';
                } else if ($dInov['id_inisiator_bencana_daerah'] == 3) {
                    $inisiator = 'OPD';
                } else if ($dInov['id_inisiator_bencana_daerah'] == 4) {
                    $inisiator = 'ASN';
                } else {
                    $inisiator = 'Masyarakat';
                }
                if ($dInov['id_tahapan_bencana_daerah'] == 1) {
                    $tahapan = 'Inisiatif';
                } else if ($dInov['id_tahapan_bencana_daerah'] == 2) {
                    $tahapan = 'Uji Coba';
                } else {
                    $tahapan = 'Masyarakat';
                }
                $create_date = $dInov['create_date'];
                $tanggal = tgl_indonesia($create_date);
                $noRow++;
                $row = $baseRow + $noRow;
                $activeWorksheet->insertNewRowBefore($row, 1);
                $activeWorksheet->setCellValue('A' . $row, $noRow);
                $activeWorksheet->setCellValue('B' . $row, isset($dInov['nama_bencana_daerah']) ? $dInov['nama_bencana_daerah'] : '-');
                $activeWorksheet->setCellValue('C' . $row, isset($dInov['opd_id_name']) ? $dInov['opd_id_name'] : '-');
                $activeWorksheet->setCellValue('D' . $row, isset($dInov['fullname']) ? $dInov['fullname'] : '-');
                $activeWorksheet->setCellValue('E' . $row, '-');
                $activeWorksheet->setCellValue('F' . $row, isset($dInov['nm_bentuk']) ? $dInov['nm_bentuk'] : '-');
                $activeWorksheet->setCellValue('G' . $row, isset($jenis) ? $jenis : '-');
                $activeWorksheet->setCellValue('H' . $row, isset($inisiator) ? $inisiator : '-');
                $activeWorksheet->setCellValue('I' . $row, isset($dInov['nm_urusan_utama']) ? $dInov['nm_urusan_utama'] : '-');
                $activeWorksheet->setCellValue('J' . $row, isset($dataBobot) ? $dataBobot : 0);
                $activeWorksheet->setCellValue('K' . $row, isset($tahapan) ? $tahapan : '-');
                $activeWorksheet->setCellValue('L' . $row, isset($tanggal) ? $tanggal : '-');
                $activeWorksheet->setCellValue('M' . $row, 'Tidak');
                $activeWorksheet->setCellValue('N' . $row, '-');
                $activeWorksheet->setCellValue('O' . $row, '-');
                $activeWorksheet->setCellValue('P' . $row, isset($checkDataLink['thumbnail']) ? $checkDataLink['thumbnail'] : '-');
            }
        } else {
            $row = $baseRow + 1;
            $activeWorksheet->insertNewRowBefore($row, 1);
            $activeWorksheet->setCellValue('A' . $row, 1);
            $activeWorksheet->setCellValue('B' . $row, '');
            $activeWorksheet->setCellValue('C' . $row, '');
            $activeWorksheet->setCellValue('D' . $row, '');
            $activeWorksheet->setCellValue('E' . $row, '');
            $activeWorksheet->setCellValue('F' . $row, '');
            $activeWorksheet->setCellValue('G' . $row, '');
            $activeWorksheet->setCellValue('H' . $row, '');
            $activeWorksheet->setCellValue('I' . $row, '');
            $activeWorksheet->setCellValue('J' . $row, '');
            $activeWorksheet->setCellValue('K' . $row, '');
            $activeWorksheet->setCellValue('L' . $row, '');
            $activeWorksheet->setCellValue('M' . $row, '');
            $activeWorksheet->setCellValue('N' . $row, '');
            $activeWorksheet->setCellValue('O' . $row, '');
            $activeWorksheet->setCellValue('P' . $row, '');
        }
        $activeWorksheet->removeRow($baseRow, 1);

        $fileName = 'contoh_spreadsheet.xlsx';

        // Atur header HTTP agar file dapat diunduh
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Tanggal di masa lalu
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // Selalu modifikasi
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        // Tulis file ke output
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}

// This is the end of fungsi class
