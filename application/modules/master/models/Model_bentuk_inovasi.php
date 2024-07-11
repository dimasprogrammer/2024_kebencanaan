<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of bentuk_inovasi model
 *
 * @author Dimas Dwi Randa
 */

class Model_bentuk_inovasi extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /*bentuk_inovasi Get Data List*/
    var $search = array('a.nm_bentuk');
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
        return $this->db->count_all_results('cx_bentuk_inovasi');
    }

    private function _get_datatables_query()
    {
        $this->db->select('a.id_bentuk_inovasi,
                           a.nm_bentuk,
                           a.deskripsi,
                           a.id_status,');
        $this->db->from('cx_bentuk_inovasi a');
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
        $this->db->order_by('a.id_bentuk_inovasi ASC');
    }

    /*bentuk_inovasi get data edit by id*/
    public function getDataDetailBentukInovasi($id)
    {
        $this->db->where('id_bentuk_inovasi', abs($id));
        $query = $this->db->get('cx_bentuk_inovasi');
        return $query->row_array();
    }

    /* bentuk_inovasi untuk insert data */
    public function insertDataBentukInovasi()
    {
        //get data
        $create_by   = $this->app_loader->current_account();
        $create_date = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip   = $this->input->ip_address();
        $nm_bentuk   = escape($this->input->post('nm_bentuk', TRUE));
        $deskripsi   = escape($this->input->post('deskripsi', TRUE));
        //cek nama bentuk_inovasi duplicate
        $this->db->where('nm_bentuk', $nm_bentuk);
        $qTot = $this->db->count_all_results('cx_bentuk_inovasi');
        if ($qTot > 0)
            return array('response' => 'ERROR', 'nama' => $nm_bentuk);
        else {
            $data = array(
                'nm_bentuk'   => $nm_bentuk,
                'deskripsi'   => $deskripsi,
                'create_by'   => $create_by,
                'create_date' => $create_date,
                'create_ip'   => $create_ip,
                'mod_by'      => $create_by,
                'mod_date'    => $create_date,
                'mod_ip'      => $create_ip,
                'id_status'   => escape($this->input->post('id_status', TRUE))
            );
            /*query insert*/
            $this->db->insert('cx_bentuk_inovasi', $data);
            return array('response' => 'SUCCESS', 'nama' => $nm_bentuk);
        }
    }

    /* bentuk_inovasi untuk update data */
    public function updateDataBentukInovasi()
    {
        //get data
        $create_by   = $this->app_loader->current_account();
        $create_date = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip   = $this->input->ip_address();
        $id_bentuk_inovasi     = $this->encryption->decrypt(escape($this->input->post('tokenId', TRUE)));
        $nm_bentuk   = escape($this->input->post('nm_bentuk', TRUE));
        $deskripsi   = escape($this->input->post('deskripsi', TRUE));
        //cek data by id
        $databentuk_inovasi = $this->getDataDetailBentukInovasi($id_bentuk_inovasi);
        if (count($databentuk_inovasi) <= 0)
            return array('response' => 'ERROR', 'nama' => '');
        else {
            //cek nama bentuk_inovasi duplicate
            $this->db->where('nm_bentuk', $nm_bentuk);
            $this->db->where('id_bentuk_inovasi !=', $id_bentuk_inovasi);
            $qTot = $this->db->count_all_results('cx_bentuk_inovasi');
            if ($qTot > 0)
                return array('response' => 'ERRDATA', 'nama' => $nm_bentuk);
            else {
                $data = array(
                    'nm_bentuk' => $nm_bentuk,
                    'deskripsi' => $deskripsi,
                    'mod_by'    => $create_by,
                    'mod_date'  => $create_date,
                    'mod_ip'    => $create_ip,
                    'id_status' => escape($this->input->post('id_status', TRUE))
                );
                /*query update*/
                $this->db->where('id_bentuk_inovasi', abs($id_bentuk_inovasi));
                $this->db->update('cx_bentuk_inovasi', $data);
                return array('response' => 'SUCCESS', 'nama' => $nm_bentuk);
            }
        }
    }

    /* bentuk_inovasi untuk delete data */
    public function deleteDataBentukInovasi()
    {
        $id_bentuk_inovasi = $this->encryption->decrypt(escape($this->input->post('tokenId', TRUE)));
        //cek data menu by id
        $dataBentukInovasi  = $this->getDataDetailBentukInovasi($id_bentuk_inovasi);
        $nm_bentuk = !empty($dataBentukInovasi) ? $dataBentukInovasi['nm_bentuk'] : '';
        if (count($dataBentukInovasi) <= 0)
            return array('response' => 'ERROR', 'nama' => '');
        else {
            $this->db->where('id_bentuk_inovasi', abs($id_bentuk_inovasi));
            $this->db->delete('cx_bentuk_inovasi');
            return array('response' => 'SUCCESS', 'nama' => $nm_bentuk);
        }
    }
}

// This is the end of auth signin model
