<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of urusan_lainnya model
 *
 * @author Dimas Dwi Randa
 */

class Model_urusan_lainnya extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /*urusan_lainnya Get Data List*/
    var $search = array('a.nm_urusan_lainnya');
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
        return $this->db->count_all_results('cx_urusan_lainnya');
    }

    private function _get_datatables_query()
    {
        $this->db->select('a.id_urusan_lainnya,
                           a.nm_urusan_lainnya,
                           a.deskripsi,
                           a.id_status,');
        $this->db->from('cx_urusan_lainnya a');
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
        $this->db->order_by('a.id_urusan_lainnya ASC');
    }

    /*urusan_lainnya get data edit by id*/
    public function getDataDetailUrusanLainnya($id)
    {
        $this->db->where('id_urusan_lainnya', abs($id));
        $query = $this->db->get('cx_urusan_lainnya');
        return $query->row_array();
    }

    /* urusan_lainnya untuk insert data */
    public function insertDataUrusanLainnya()
    {
        //get data
        $create_by   = $this->app_loader->current_account();
        $create_date = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip   = $this->input->ip_address();
        $nm_urusan_lainnya   = escape($this->input->post('nm_urusan_lainnya', TRUE));
        $deskripsi   = escape($this->input->post('deskripsi', TRUE));
        //cek nama urusan_lainnya duplicate
        $this->db->where('nm_urusan_lainnya', $nm_urusan_lainnya);
        $qTot = $this->db->count_all_results('cx_urusan_lainnya');
        if ($qTot > 0)
            return array('response' => 'ERROR', 'nama' => $nm_urusan_lainnya);
        else {
            $data = array(
                'nm_urusan_lainnya'   => $nm_urusan_lainnya,
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
            $this->db->insert('cx_urusan_lainnya', $data);
            return array('response' => 'SUCCESS', 'nama' => $nm_urusan_lainnya);
        }
    }

    /* urusan_lainnya untuk update data */
    public function updateDataUrusanLainnya()
    {
        //get data
        $create_by   = $this->app_loader->current_account();
        $create_date = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip   = $this->input->ip_address();
        $id_urusan_lainnya     = $this->encryption->decrypt(escape($this->input->post('tokenId', TRUE)));
        $nm_urusan_lainnya   = escape($this->input->post('nm_urusan_lainnya', TRUE));
        $deskripsi   = escape($this->input->post('deskripsi', TRUE));
        //cek data by id
        $dataurusan_lainnya = $this->getDataDetailUrusanLainnya($id_urusan_lainnya);
        if (count($dataurusan_lainnya) <= 0)
            return array('response' => 'ERROR', 'nama' => '');
        else {
            //cek nama urusan_lainnya duplicate
            $this->db->where('nm_urusan_lainnya', $nm_urusan_lainnya);
            $this->db->where('id_urusan_lainnya !=', $id_urusan_lainnya);
            $qTot = $this->db->count_all_results('cx_urusan_lainnya');
            if ($qTot > 0)
                return array('response' => 'ERRDATA', 'nama' => $nm_urusan_lainnya);
            else {
                $data = array(
                    'nm_urusan_lainnya' => $nm_urusan_lainnya,
                    'deskripsi' => $deskripsi,
                    'mod_by'    => $create_by,
                    'mod_date'  => $create_date,
                    'mod_ip'    => $create_ip,
                    'id_status' => escape($this->input->post('id_status', TRUE))
                );
                /*query update*/
                $this->db->where('id_urusan_lainnya', abs($id_urusan_lainnya));
                $this->db->update('cx_urusan_lainnya', $data);
                return array('response' => 'SUCCESS', 'nama' => $nm_urusan_lainnya);
            }
        }
    }

    /* urusan_lainnya untuk delete data */
    public function deleteDataUrusanLainnya()
    {
        $id_urusan_lainnya = $this->encryption->decrypt(escape($this->input->post('tokenId', TRUE)));
        //cek data menu by id
        $datatematik  = $this->getDataDetailUrusanLainnya($id_urusan_lainnya);
        $nm_urusan_lainnya = !empty($datatematik) ? $datatematik['nm_urusan_lainnya'] : '';
        if (count($datatematik) <= 0)
            return array('response' => 'ERROR', 'nama' => '');
        else {
            $this->db->where('id_urusan_lainnya', abs($id_urusan_lainnya));
            $this->db->delete('cx_urusan_lainnya');
            return array('response' => 'SUCCESS', 'nama' => $nm_urusan_lainnya);
        }
    }
}

// This is the end of auth signin model
