<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of bencana_daerah model
 *
 * @author Dimas Dwi Randa
 */

class Model_bencana_daerah extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /*Fungsi Get Data List*/
    var $search = array('a.token_bencana_share');
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
        return $this->db->count_all_results('ms_bencana_share');
    }

    private function _get_datatables_query($param)
    {
        $post = array();
        if (is_array($param)) {
            foreach ($param as $v) {
                $post[$v['name']] = $v['value'];
            }
        }

        $this->db->select('a.id_bencana_share,
                           a.token_bencana,
                           a.token_bencana_share,
                           a.id_users_penerima,
                           b.nama_bencana,
                           b.penyebab_bencana,
                           b.tanggal_bencana,
                           e.nm_regency');
        $this->db->from('ms_bencana_share a');
        $this->db->join('ms_bencana b', 'b.token_bencana = a.token_bencana', 'inner');
        $this->db->join('xi_sa_users c', 'c.id_users = a.id_users_penerima', 'inner');
        $this->db->join('cx_instansi_prov d', 'd.id_instansi = c.id_instansi', 'INNER');
        $this->db->join('wil_regency e', 'e.id_regency = c.id_regency', 'INNER');
        // if (!empty($id_tahapan_bencana_daerah)) {
        //     $this->db->where('a.id_tahapan_bencana_daerah', $id_tahapan_bencana_daerah);
        // }
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
        $this->db->order_by('a.id_bencana_share DESC');
    }

    /*Fungsi get data edit by id dan url*/
    public function addDataDetailBencanaShare($token_bencana_share)
    {
        $this->db->select('a.id_bencana_share,
                           a.token_bencana,
                           a.token_bencana_share,
                           a.id_users_penerima,
                           b.nama_bencana,
                           b.penyebab_bencana,
                           b.tanggal_bencana,
                           b.id_jenis_bencana,
                           b.kategori_bencana,
                           b.penyebab_bencana,
                           b.jumlah_kejadian,
                           b.kategori_tanggap,
                           b.latitude,
                           b.longitude,
                           c.nm_bencana as jenis_bencana');
        $this->db->from('ms_bencana_share a');
        $this->db->join('ms_bencana b', 'b.token_bencana = a.token_bencana', 'inner');
        $this->db->join('cx_jenis_bencana c', 'c.id_jenis_bencana = b.id_jenis_bencana', 'inner');
        $this->db->where('a.token_bencana_share', $token_bencana_share);
        $query = $this->db->get();
        return $query->row_array();
    }
}

// This is the end of auth signin model
