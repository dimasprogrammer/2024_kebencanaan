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
                    $row[] = '<a href="' . site_url('manajemen_data/bencana_daerah/detail_bencana/' . $dl['token_bencana_detail']) . '" type="button" class="btn btn-primary btn-sm px-2 waves-effect waves-light btnIndikator" title="Indikator Satuan">
                        <i class="far fa-folder-open"></i> Detail Bencana
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

        $this->session_info['page_name']        = "Detail Indikator";
        $this->session_info['page_js']          = $this->load->view($this->_vwName . '/vjs', array('siteUri' => $this->_uriName), true);
        $this->session_info['token']    = $dataTokenBencana;
        $this->session_info['kondisi_korban'] = $this->mbencana_daerah->getDataKorbanKondisi();
        $this->session_info['master_data_korban'] = $this->mbencana_daerah->getMasterDataKorban();
        $this->session_info['korban_bencana']         = $this->mbencana_daerah->getDataKorbanBencana();
        $this->session_info['sarana_rusak'] = $this->mbencana_daerah->getDataJenisSaranaRusak();
        $this->session_info['sarana_terendam'] = $this->mbencana_daerah->getDataJenisSaranaTerendam();
        $this->session_info['sarana_lainnya'] = $this->mbencana_daerah->getDataJenisSaranaLainnya();
        $this->session_info['jenis_ternak'] = $this->mbencana_daerah->getDataJenisTernak();
        $this->session_info['bantuan_diterima'] = $this->mbencana_daerah->getDataJenisBantuanDiterima();
        $this->session_info['bantuan_disalurkan'] = $this->mbencana_daerah->getDataJenisBantuanTersalurkan();
        $this->session_info['jenis_sumber'] = $this->mbencana_daerah->getDataJenisSumber();
        $this->session_info['vkorbanjiwa'] = $this->load->view('bencana_daerah/vkorbanjiwa', $this->session_info, true);
        $this->session_info['vkerusakan'] = $this->load->view('bencana_daerah/vkerusakan', $this->session_info, true);
        $this->session_info['vternak'] = $this->load->view('bencana_daerah/vternak', $this->session_info, true);
        $this->session_info['vbantuantersalurkan'] = $this->load->view('bencana_daerah/vbantuantersalurkan', $this->session_info, true);
        $this->session_info['vbantuanditerima'] = $this->load->view('bencana_daerah/vbantuanditerima', $this->session_info, true);
        $this->session_info['vbantuanrelawan'] = $this->load->view('bencana_daerah/vbantuanrelawan', $this->session_info, true);
        $this->template->build($this->_vwName . '/vdetail', $this->session_info);
    }
}

// This is the end of fungsi class
