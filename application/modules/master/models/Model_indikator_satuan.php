<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of indikator_satuan model
 *
 * @author Dimas Dwi Randa
 */

class Model_indikator_satuan extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /*indikator_satuan Get Data List*/
    var $search = array('a.nm_indikator_satuan');
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
        return $this->db->count_all_results('cx_indikator_satuan');
    }

    private function _get_datatables_query()
    {
        $this->db->select('a.id_indikator_satuan,
                           a.nm_indikator_satuan,
                           a.bobot_satuan,
                           a.id_status,
                           b.nm_indikator');
        $this->db->from('cx_indikator_satuan a');
        $this->db->join('cx_indikator b', 'a.id_indikator = b.id_indikator', 'inner');
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
        $this->db->order_by('a.id_indikator_satuan DESC');
    }

    /*indikator_satuan get data edit by id*/
    public function getDataDetailIndikatorSatuan($id)
    {
        $this->db->where('id_indikator_satuan', abs($id));
        $query = $this->db->get('cx_indikator_satuan');
        return $query->row_array();
    }

    /* indikator_satuan untuk insert data */
    public function insertDataIndikatorSatuan()
    {
        //get data
        $create_by           = $this->app_loader->current_account();
        $create_date         = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip           = $this->input->ip_address();
        $id_indikator        = escape($this->input->post('id_indikator', TRUE));
        $nm_indikator_satuan = escape($this->input->post('nm_indikator_satuan', TRUE));
        $bobot_satuan        = escape($this->input->post('bobot_satuan', TRUE));
        $id_status           = escape($this->input->post('id_status', TRUE));
        //cek nama indikator_satuan duplicate
        $this->db->where('nm_indikator_satuan', $nm_indikator_satuan);
        $qTot = $this->db->count_all_results('cx_indikator_satuan');
        if ($qTot > 0)
            return array('response' => 'ERROR', 'nama' => $nm_indikator_satuan);
        else {
            $data = array(
                'id_indikator'        => $id_indikator,
                'nm_indikator_satuan' => $nm_indikator_satuan,
                'bobot_satuan'        => $bobot_satuan,
                'create_by'           => $create_by,
                'create_date'         => $create_date,
                'create_ip'           => $create_ip,
                'mod_by'              => $create_by,
                'mod_date'            => $create_date,
                'mod_ip'              => $create_ip,
                'id_status'           => $id_status,
            );
            // print_r($data);
            // die;
            /*query insert*/
            $this->db->insert('cx_indikator_satuan', $data);
            return array('response' => 'SUCCESS', 'nama' => $nm_indikator_satuan);
        }
    }

    /* indikator_satuan untuk update data */
    public function updateDataIndikatorSatuan()
    {
        //get data
        $create_by      = $this->app_loader->current_account();
        $create_date    = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip      = $this->input->ip_address();
        $id_indikator_satuan   = $this->encryption->decrypt(escape($this->input->post('tokenId', TRUE)));
        $id_indikator        = escape($this->input->post('id_indikator', TRUE));
        $nm_indikator_satuan = escape($this->input->post('nm_indikator_satuan', TRUE));
        $bobot_satuan        = escape($this->input->post('bobot_satuan', TRUE));
        $id_status           = escape($this->input->post('id_status', TRUE));
        //cek data by id
        $dataindikator_satuan = $this->getDataDetailIndikatorSatuan($id_indikator_satuan);
        if (count($dataindikator_satuan) <= 0)
            return array('response' => 'ERROR', 'nama' => '');
        else {
            //cek nama indikator_satuan duplicate
            $this->db->where('nm_indikator_satuan', $nm_indikator_satuan);
            $this->db->where('id_indikator_satuan !=', $id_indikator_satuan);
            $qTot = $this->db->count_all_results('cx_indikator_satuan');
            if ($qTot > 0)
                return array('response' => 'ERRDATA', 'nama' => $nm_indikator_satuan);
            else {
                $data = array(
                    'id_indikator'        => $id_indikator,
                    'nm_indikator_satuan' => $nm_indikator_satuan,
                    'bobot_satuan'        => $bobot_satuan,
                    'mod_by'         => $create_by,
                    'mod_date'       => $create_date,
                    'mod_ip'         => $create_ip,
                    'id_status'      => $id_status
                );
                /*query update*/
                $this->db->where('id_indikator_satuan', abs($id_indikator_satuan));
                $this->db->update('cx_indikator_satuan', $data);
                return array('response' => 'SUCCESS', 'nama' => $nm_indikator_satuan);
            }
        }
    }

    /* indikator_satuan untuk delete data */
    public function deleteDataIndikatorSatuan()
    {
        $id_indikator_satuan = $this->encryption->decrypt(escape($this->input->post('tokenId', TRUE)));
        //cek data menu by id
        $dataindikator_satuan  = $this->getDataDetailIndikatorSatuan($id_indikator_satuan);
        $nm_indikator_satuan = !empty($dataindikator_satuan) ? $dataindikator_satuan['nm_indikator_satuan'] : '';
        if (count($dataindikator_satuan) <= 0)
            return array('response' => 'ERROR', 'nama' => '');
        else {
            $this->db->where('id_indikator_satuan', abs($id_indikator_satuan));
            $this->db->delete('cx_indikator_satuan');
            return array('response' => 'SUCCESS', 'nama' => $nm_indikator_satuan);
        }
    }
}

// This is the end of auth signin model
