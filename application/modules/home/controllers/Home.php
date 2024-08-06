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
        $this->session_info['page_name']      = "Home";
        $this->session_info['page_css']       = '';
        $this->session_info['page_js']        = $this->load->view($this->_vwName . '/vjs', array('siteUri' => $this->_uriName), true);
        $this->session_info['longsor']        = $this->mHome->getBencanaLongsor();
        $this->session_info['banjir']         = $this->mHome->getBencanaBanjir();
        $this->session_info['kebakaran']      = $this->mHome->getBencanaKebakaran();
        $this->session_info['cuaca']          = $this->mHome->getBencanaCuaca();
        $this->session_info['erupsi']         = $this->mHome->getBencanaErupsi();
        $this->session_info['gempa_bumi']     = $this->mHome->getBencanaGempaBumi();
        $this->session_info['banjir_bandang'] = $this->mHome->getBencanaBanjirBandang();
        $this->session_info['abrasi_pantai']  = $this->mHome->getBencanaAbrasiPantai();
        $this->session_info['bencana']       = $this->mHome->getBencanaAll();
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

    public function detailFoto()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            $bencana_Id = $this->input->post('token_bencana', TRUE);
            if (!empty($bencana_Id) && !empty($session)) {
                $data = $this->mHome->getDataUpload($bencana_Id);
                $row['nama_file'] = !empty($data) ? $data['nama_file'] : '';

                if (!empty($data['create_date'])) {
                    $year = substr($data['create_date'], 0, 4);
                    $month = substr($data['create_date'], 5, 2);
                    if (!empty($row['nama_file'])) {
                        $image_html = '<img src="' . site_url('dokumen/bencana/' . $year . '/' . $month . '/' . $data['nama_file']) . '" alt="thumbnail" class="img-thumbnail rounded" style="width: 100%; height:400px;">';
                        $row['nama_file'] = $image_html;
                    } else {
                        $row['nama_file'] = '';
                    }
                }

                if (!empty($data['video_bencana'])) {
                    $video_url = $data['video_bencana'];
                    // Extract the YouTube video ID from the URL
                    parse_str(parse_url($video_url, PHP_URL_QUERY), $url_params);
                    $video_id = isset($url_params['v']) ? $url_params['v'] : '';
                    if ($video_id) {
                        // Generate the iframe HTML
                        $iframe = '<iframe class="img-thumbnail rounded"style="width: 100%; height:400px;" src="https://www.youtube.com/embed/' . $video_id . '" frameborder="0" allowfullscreen></iframe>';
                        $row['video_bencana'] = $iframe;
                    } else {
                        $row['video_bencana'] = '';
                    }
                } else {
                    $row['video_bencana'] = '';
                }

                $result = array('status' => 'RC200', 'message' => $row, 'csrfHash' => $csrfHash);
            } else {
                $result = array('status' => 'RC404', 'message' => array(), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }
}

// This is the end of home clas
