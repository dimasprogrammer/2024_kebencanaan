<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of jenis_bencana model
 *
 * @author Dimas Dwi Randa
 */

class Model_jenis_bencana extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /*jenis_bencana Get Data List*/
    var $search = array('a.nm_bencana');
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
        return $this->db->count_all_results('cx_jenis_bencana');
    }

    private function _get_datatables_query()
    {
        $this->db->select('a.id_jenis_bencana,
                           a.nm_bencana,
                           a.mod_date,
                           a.mod_by,
                           a.id_status');
        $this->db->from('cx_jenis_bencana a');
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
        $this->db->order_by('a.mod_date DESC');
    }

    /*jenis_bencana get data edit by id*/
    public function getDataDetailJenisBencana($id)
    {
        $this->db->where('id_jenis_bencana', abs($id));
        $query = $this->db->get('cx_jenis_bencana');
        return $query->row_array();
    }

    /* jenis_bencana untuk insert data */
    public function insertDataJenisBencana()
    {
        //get data
        $create_by   = $this->app_loader->current_account();
        $create_date = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip   = $this->input->ip_address();
        $nm_bencana = escape($this->input->post('nm_bencana', TRUE));
        //cek nama jenis_bencana duplicate
        $this->db->where('nm_bencana', $nm_bencana);
        $qTot = $this->db->count_all_results('cx_jenis_bencana');
        if ($qTot > 0)
            return array('response' => 'ERROR', 'nama' => $nm_bencana);
        else {
            $data = array(
                'nm_bencana'       => $nm_bencana,
                'create_by'         => $create_by,
                'create_date'       => $create_date,
                'create_ip'         => $create_ip,
                'mod_by'            => $create_by,
                'mod_date'          => $create_date,
                'mod_ip'            => $create_ip,
                'id_status'         => escape($this->input->post('status', TRUE))
            );
            /*query insert*/
            $this->db->insert('cx_jenis_bencana', $data);
            return array('response' => 'SUCCESS', 'nama' => $nm_bencana);
        }
    }

    /* jenis_bencana untuk update data */
    public function updateDatajenis_bencana()
    {
        //get data
        $create_by   = $this->app_loader->current_account();
        $create_date = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip   = $this->input->ip_address();
        $id_jenis_bencana     = $this->encryption->decrypt(escape($this->input->post('tokenId', TRUE)));
        $nm_bencana = escape($this->input->post('nm_bencana', TRUE));
        //cek data by id
        $datajenis_bencana = $this->getDataDetailJenisBencana($id_jenis_bencana);
        if (count($datajenis_bencana) <= 0)
            return array('response' => 'ERROR', 'nama' => '');
        else {
            //cek nama jenis_bencana duplicate
            $this->db->where('nm_bencana', $nm_bencana);
            $this->db->where('id_jenis_bencana !=', $id_jenis_bencana);
            $qTot = $this->db->count_all_results('cx_jenis_bencana');
            if ($qTot > 0)
                return array('response' => 'ERRDATA', 'nama' => $nm_bencana);
            else {
                $data = array(
                    'nm_bencana'       => $nm_bencana,
                    'mod_by'            => $create_by,
                    'mod_date'          => $create_date,
                    'mod_ip'            => $create_ip,
                    'id_status'         => escape($this->input->post('status', TRUE))
                );
                /*query update*/
                $this->db->where('id_jenis_bencana', abs($id_jenis_bencana));
                $this->db->update('cx_jenis_bencana', $data);
                return array('response' => 'SUCCESS', 'nama' => $nm_bencana);
            }
        }
    }

    /* jenis_bencana untuk delete data */
    public function deleteDataJenisBencana()
    {
        $id = $this->encryption->decrypt(escape($this->input->post('tokenId', TRUE)));
        //cek data by id
        $data_jenis   = $this->getDataDetailJenisBencana($id);
        $nm_bencana  = !empty($data_jenis) ? $data_jenis['nm_bencana'] : '';
        $this->db->where('id_jenis_bencana', abs($id));
        $this->db->delete('cx_jenis_bencana');
        return array('response' => 'SUCCESS', 'nama' => $nm_bencana);
    }
}

// This is the end of auth signin model
