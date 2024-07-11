<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of indikator_parameter model
 *
 * @author Dimas Dwi Randa
 */

class Model_indikator_parameter extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /*indikator_parameter Get Data List*/
    var $search = array('a.nama_indikator_parameter');
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
        return $this->db->count_all_results('ms_indikator_nilai');
    }

    private function _get_datatables_query()
    {
        $this->db->select('a.id_indikator_nilai,
                           a.nilai_parameter,
                           a.token as token_indikator_nilai,
                           c.opd_id_name');
        $this->db->from('ms_indikator_nilai a');
        $this->db->join('ms_inovasi b', 'a.token = b.token', 'inner');
        $this->db->join('xi_sa_users c', 'a.create_by = c.token', 'inner');
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
        $this->db->order_by('a.id_indikator_nilai ASC');
    }

    public function getDataDetailIndikatorParameter($id)
    {
        $this->db->select('a.id_indikator_nilai, 
                           a.id_indikator_satuan,
                           a.id_indikator,
                           b.nm_indikator');
        $this->db->from('ms_indikator_nilai a');
        $this->db->from('cx_indikator b', 'a.id_indikator = b.id_indikator', 'inner');
        $this->db->where('a.id_indikator_nilai', abs($id));
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    /* indikator_parameter untuk update data */
    public function updateDataIndikatorParameter()
    {
        //get data
        $create_by      = $this->app_loader->current_account();
        $create_date    = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip      = $this->input->ip_address();
        $id_indikator_nilai   = $this->encryption->decrypt(escape($this->input->post('tokenId', TRUE)));
        $id_indikator_satuan   = escape($this->input->post('id_indikator_satuan', TRUE));
        //cek data by id

        $data = array(
            'id_indikator_satuan' => $id_indikator_satuan,
            'mod_by'              => $create_by,
            'mod_date'       => $create_date,
            'mod_ip'         => $create_ip
        );
        /*query update*/
        $this->db->where('id_indikator_nilai', abs($id_indikator_nilai));
        $this->db->update('ms_indikator_nilai', $data);
        return array('response' => 'SUCCESS', 'nama' => '');
    }

    /* indikator_parameter untuk delete data */
    public function deleteDataindikator_parameter()
    {
        $id_indikator_nilai = $this->encryption->decrypt(escape($this->input->post('tokenId', TRUE)));
        //cek data menu by id
        $dataindikator_parameter  = $this->getDataDetailIndikatorParameter($id_indikator_nilai);
        $nilai_parameter = !empty($dataindikator_parameter) ? $dataindikator_parameter['nilai_parameter'] : '';
        if (count($dataindikator_parameter) <= 0)
            return array('response' => 'ERROR', 'nama' => '');
        else {
            $this->db->where('id_indikator_nilai', abs($id_indikator_nilai));
            $this->db->delete('ms_indikator_nilai');
            return array('response' => 'SUCCESS', 'nama' => $nilai_parameter);
        }
    }
}

// This is the end of auth signin model
