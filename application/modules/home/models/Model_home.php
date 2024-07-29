<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of nontpp model
 *
 * @author prima aulia
 */

class Model_home extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /*Fungsi Get Data List*/
    var $search = array('a.nama_bencana', 'a.nama_bencana');
    public function get_datatables($param)
    {
        $this->_get_datatables_query($param);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_filtered($param)
    {
        $this->_get_datatables_query($param);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        return $this->db->count_all_results('ms_bencana');
    }

    private function _get_datatables_query($param)
    {

        $post = array();
        if (is_array($param)) {
            foreach ($param as $v) {
                $post[$v['name']] = $v['value'];
            }
        }

        $this->db->select('a.id_bencana,
                           a.token_bencana,
                           a.nama_bencana,
                           a.tanggal_bencana,
                           a.taksiran_kerugian,
                           a.kategori_tanggap,
                           a.id_status,
                           b.nm_bencana as jenis_bencana,
                           c.nm_tanggap');
        $this->db->from('ms_bencana a');
        $this->db->join('cx_jenis_bencana b', 'b.id_jenis_bencana = a.id_jenis_bencana', 'inner');
        $this->db->join('cx_tanggap_bencana c', 'c.id_tanggap_bencana = a.kategori_tanggap', 'inner');
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
        $this->db->order_by('a.tanggal_bencana DESC');
    }

    public function getDataPusdalopsTerdampak($token_bencana)
    {
        $this->db->select('a.id_bencana_detail,
                           a.token_bencana,
                           a.token_bencana_detail,
                           a.id_regency_penerima,
                           b.nama_bencana,
                           b.penyebab_bencana,
                           b.tanggal_bencana,
                           c.nm_regency');
        $this->db->from('ms_bencana_detail a');
        $this->db->join('ms_bencana b', 'b.token_bencana = a.token_bencana', 'INNER');
        $this->db->join('wil_regency c', 'c.id_regency = a.id_regency_penerima', 'INNER');
        $this->db->where('a.token_bencana', $token_bencana);
        $this->db->order_by('a.id_bencana_detail DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
}

// This is the end of auth signin model
