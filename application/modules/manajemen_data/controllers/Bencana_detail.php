<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of bencana_detail class
 *
 * @author Dimas Dwi Randa
 */

class Bencana_detail extends SLP_Controller
{
    protected $_vwName  = '';
    protected $_uriName = '';
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_bencana_detail' => 'mbencana_detail', 'master/model_master' => 'mmas'));
        $this->_vwName = 'bencana_detail';
        $this->_uriName = 'manajemen_data/bencana_detail';
    }

    public function index()
    {
        $this->breadcrumb->add('Dashboard', site_url('home'));
        $this->breadcrumb->add('Manajemen', '#');
        $this->breadcrumb->add('Detail Bencana', site_url($this->_uriName));
        $this->session_info['page_name']     = 'Manajemen Data Detail Bencana';
        $this->session_info['siteUri']       = $this->_uriName;
        $this->session_info['page_css']      = $this->load->view($this->_vwName . '/vcss', '', true);
        $this->session_info['page_js']       = $this->load->view($this->_vwName . '/vjs', array('siteUri' => $this->_uriName), true);
        $this->session_info['data_opd']      = "";
        $this->template->build($this->_vwName . '/vpage', $this->session_info);
    }
}

// This is the end of fungsi class
