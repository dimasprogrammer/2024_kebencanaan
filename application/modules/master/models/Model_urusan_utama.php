<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of urusan_utama model
 *
 * @author Dimas Dwi Randa
 */

class Model_urusan_utama extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /*urusan_utama Get Data List*/
    var $search = array('a.nm_urusan_utama');
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
        return $this->db->count_all_results('cx_urusan_utama');
    }

    private function _get_datatables_query()
    {
        $this->db->select('a.id_urusan_utama,
                           a.nm_urusan_utama,
                           a.deskripsi,
                           a.id_status,');
        $this->db->from('cx_urusan_utama a');
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
        $this->db->order_by('a.id_urusan_utama ASC');
    }

    /*urusan_utama get data edit by id*/
    public function getDataDetailUrusanUtama($id)
    {
        $this->db->where('id_urusan_utama', abs($id));
        $query = $this->db->get('cx_urusan_utama');
        return $query->row_array();
    }

    /* urusan_utama untuk insert data */
    public function insertDataUrusanUtama()
    {
        //get data
        $create_by   = $this->app_loader->current_account();
        $create_date = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip   = $this->input->ip_address();
        $nm_urusan_utama   = escape($this->input->post('nm_urusan_utama', TRUE));
        $deskripsi   = escape($this->input->post('deskripsi', TRUE));
        //cek nama urusan_utama duplicate
        $this->db->where('nm_urusan_utama', $nm_urusan_utama);
        $qTot = $this->db->count_all_results('cx_urusan_utama');
        if ($qTot > 0)
            return array('response' => 'ERROR', 'nama' => $nm_urusan_utama);
        else {
            $data = array(
                'nm_urusan_utama'   => $nm_urusan_utama,
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
            $this->db->insert('cx_urusan_utama', $data);
            return array('response' => 'SUCCESS', 'nama' => $nm_urusan_utama);
        }
    }

    /* urusan_utama untuk update data */
    public function updateDataUrusanUtama()
    {
        //get data
        $create_by   = $this->app_loader->current_account();
        $create_date = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip   = $this->input->ip_address();
        $id_urusan_utama     = $this->encryption->decrypt(escape($this->input->post('tokenId', TRUE)));
        $nm_urusan_utama   = escape($this->input->post('nm_urusan_utama', TRUE));
        $deskripsi   = escape($this->input->post('deskripsi', TRUE));
        //cek data by id
        $dataurusan_utama = $this->getDataDetailUrusanUtama($id_urusan_utama);
        if (count($dataurusan_utama) <= 0)
            return array('response' => 'ERROR', 'nama' => '');
        else {
            //cek nama urusan_utama duplicate
            $this->db->where('nm_urusan_utama', $nm_urusan_utama);
            $this->db->where('id_urusan_utama !=', $id_urusan_utama);
            $qTot = $this->db->count_all_results('cx_urusan_utama');
            if ($qTot > 0)
                return array('response' => 'ERRDATA', 'nama' => $nm_urusan_utama);
            else {
                $data = array(
                    'nm_urusan_utama' => $nm_urusan_utama,
                    'deskripsi' => $deskripsi,
                    'mod_by'    => $create_by,
                    'mod_date'  => $create_date,
                    'mod_ip'    => $create_ip,
                    'id_status' => escape($this->input->post('id_status', TRUE))
                );
                /*query update*/
                $this->db->where('id_urusan_utama', abs($id_urusan_utama));
                $this->db->update('cx_urusan_utama', $data);
                return array('response' => 'SUCCESS', 'nama' => $nm_urusan_utama);
            }
        }
    }

    /* urusan_utama untuk delete data */
    public function deleteDataUrusanUtama()
    {
        $id_urusan_utama = $this->encryption->decrypt(escape($this->input->post('tokenId', TRUE)));
        //cek data menu by id
        $datatematik  = $this->getDataDetailUrusanUtama($id_urusan_utama);
        $nm_urusan_utama = !empty($datatematik) ? $datatematik['nm_urusan_utama'] : '';
        if (count($datatematik) <= 0)
            return array('response' => 'ERROR', 'nama' => '');
        else {
            $this->db->where('id_urusan_utama', abs($id_urusan_utama));
            $this->db->delete('cx_urusan_utama');
            return array('response' => 'SUCCESS', 'nama' => $nm_urusan_utama);
        }
    }
}

// This is the end of auth signin model
