<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of bencana_daerah class
 *
 * @author Ucupsalah
 */

class Dashboard extends SLP_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('v1/m_dashboard' => 'm_dashboard'));
    }

    public function get_data()
    {
        $data = $this->m_dashboard->get_data();
        $result['success'] = true;
        $result['kode'] = 200;
        $result['message'] = 'Success';
        $result['data'] = $data;
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }
}