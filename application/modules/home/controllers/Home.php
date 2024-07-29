<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of home class
 *
 * @author Prima Aulia
 */

class Home extends SLP_Controller
{
    protected $_vwName  = '';
    protected $_uriName = '';
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Model_home' => 'mHome'));
        $this->_vwName  = '';
        $this->_uriName = 'home/home';
    }

    public function index()
    {
        $this->breadcrumb->add('Dashboard', site_url('home'));
        $this->breadcrumb->add('Nontpp', '#');
        $this->breadcrumb->add('Module', site_url($this->_uriName));
        $this->session_info['page_name'] = "Home";
        $this->session_info['page_css']     = '';
        $this->session_info['page_js']         = $this->load->view($this->_vwName . '/vjs', array('siteUri' => $this->_uriName), true);
        $this->session_info['data_pembayaran']   = "";
        $this->template->build('vpage', $this->session_info);
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
                $dataList = $this->mHome->get_datatables($param);


                $no = $this->input->post('start');
                foreach ($dataList as $key => $dl) {
                    $no++;
                    $row = array();
                    $dataDetail = $this->mHome->getDataPusdalopsTerdampak($dl['token_bencana']);

                    if ($dl['kategori_tanggap'] == 1) {
                        $tanggap = '<span class="badge badge-pill badge-danger">Tanggap Darurat</span>';
                    } else {
                        $tanggap = '<span class="badge badge-pill badge-warning">Non Tanggap Darurat</span>';
                    }
                    $row[] = $no;
                    $row[] = $dl['tanggal_bencana'];
                    $row[] = $dl['jenis_bencana'];
                    $row[] = $dl['nama_bencana'] . '<br>' . $tanggap;
                    $regencies = array();
                    foreach ($dataDetail as $value) {
                        $regency = !empty($value['nm_regency']) ? $value['nm_regency'] : 'Data not available';
                        $regencies[] = $regency;
                    }

                    // Combine all regencies into a single string, separated by commas
                    $row[] = implode(', ', $regencies);
                    $data[] = $row;
                }
                $output = array(
                    "draw" => $this->input->post('draw'),
                    "recordsTotal" => $this->mHome->count_all(),
                    "recordsFiltered" => $this->mHome->count_filtered($param),
                    "data" => $data,
                );
            }
            //output to json format
            $this->output->set_content_type('application/json')->set_output(json_encode($output));
        }
    }
}

// This is the end of home clas
