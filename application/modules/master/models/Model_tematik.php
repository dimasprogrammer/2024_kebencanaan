<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of tematik model
 *
 * @author Dimas Dwi Randa
 */

class Model_tematik extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /*tematik Get Data List*/
    var $search = array('a.nm_tematik');
    public function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        return $this->db->count_all_results('cx_tematik');
    }

    private function _get_datatables_query()
    {
        $this->db->select('a.id_tematik,
                           a.nm_tematik,
                           a.deskripsi,
                           a.id_status,');
        $this->db->from('cx_tematik a');
        $i = 0;
        foreach ($this->search as $item) { // loop column
            if ($_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        $this->db->order_by('a.id_tematik ASC');
    }

    /*tematik get data edit by id*/
    public function getDataDetailTematik($id)
    {
        $this->db->where('id_tematik', abs($id));
        $query = $this->db->get('cx_tematik');
        return $query->row_array();
    }

    /* tematik untuk insert data */
    public function insertDataTematik()
    {
        //get data
        $create_by   = $this->app_loader->current_account();
        $create_date = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip   = $this->input->ip_address();
        $nm_tematik  = escape($this->input->post('nm_tematik', TRUE));
        $deskripsi   = escape($this->input->post('deskripsi', TRUE));
        $id_status   = escape($this->input->post('id_status', TRUE));
        //cek nama tematik duplicate
        $this->db->where('nm_tematik', $nm_tematik);
        $qTot = $this->db->count_all_results('cx_tematik');
        if ($qTot > 0)
            return array('response' => 'ERROR', 'nama' => $nm_tematik);
        else {
            $data = array(
                'nm_tematik'  => $nm_tematik,
                'deskripsi'   => $deskripsi,
                'create_by'   => $create_by,
                'create_date' => $create_date,
                'create_ip'   => $create_ip,
                'mod_by'      => $create_by,
                'mod_date'    => $create_date,
                'mod_ip'      => $create_ip,
                'id_status'   => $id_status,
            );
            // print_r($data);
            // die;
            /*query insert*/
            $this->db->insert('cx_tematik', $data);
            return array('response' => 'SUCCESS', 'nama' => $nm_tematik);
        }
    }

    /* tematik untuk update data */
    public function updateDataTematik()
    {
        //get data
        $create_by   = $this->app_loader->current_account();
        $create_date = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip   = $this->input->ip_address();
        $id_tematik     = $this->encryption->decrypt(escape($this->input->post('tokenId', TRUE)));
        $nm_tematik   = escape($this->input->post('nm_tematik', TRUE));
        $deskripsi   = escape($this->input->post('deskripsi', TRUE));
        //cek data by id
        $datatematik = $this->getDataDetailTematik($id_tematik);
        if (count($datatematik) <= 0)
            return array('response' => 'ERROR', 'nama' => '');
        else {
            //cek nama tematik duplicate
            $this->db->where('nm_tematik', $nm_tematik);
            $this->db->where('id_tematik !=', $id_tematik);
            $qTot = $this->db->count_all_results('cx_tematik');
            if ($qTot > 0)
                return array('response' => 'ERRDATA', 'nama' => $nm_tematik);
            else {
                $data = array(
                    'nm_tematik' => $nm_tematik,
                    'deskripsi' => $deskripsi,
                    'mod_by'    => $create_by,
                    'mod_date'  => $create_date,
                    'mod_ip'    => $create_ip,
                    'id_status' => escape($this->input->post('id_status', TRUE))
                );
                /*query update*/
                $this->db->where('id_tematik', abs($id_tematik));
                $this->db->update('cx_tematik', $data);
                return array('response' => 'SUCCESS', 'nama' => $nm_tematik);
            }
        }
    }

    /* tematik untuk delete data */
    public function deleteDataTematik()
    {
        $id_tematik = $this->encryption->decrypt(escape($this->input->post('tokenId', TRUE)));
        //cek data menu by id
        $datatematik  = $this->getDataDetailTematik($id_tematik);
        $nm_tematik = !empty($datatematik) ? $datatematik['nm_tematik'] : '';
        if (count($datatematik) <= 0)
            return array('response' => 'ERROR', 'nama' => '');
        else {
            $this->db->where('id_tematik', abs($id_tematik));
            $this->db->delete('cx_tematik');
            return array('response' => 'SUCCESS', 'nama' => $nm_tematik);
        }
    }
}

// This is the end of auth signin model
