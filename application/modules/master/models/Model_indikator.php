<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of indikator model
 *
 * @author Dimas Dwi Randa
 */

class Model_indikator extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /*indikator Get Data List*/
    var $search = array('a.nm_indikator');
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
        return $this->db->count_all_results('cx_indikator');
    }

    private function _get_datatables_query()
    {
        $this->db->select('a.id_indikator,
                           a.nm_indikator,
                           a.keterangan,
                           a.informasi,
                           a.bobot,
                           a.data_pendukung,
                           a.jenis_file,
                           a.id_status,');
        $this->db->from('cx_indikator a');
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
        $this->db->order_by('a.id_indikator ASC');
    }

    /*indikator get data edit by id*/
    public function getDataDetailIndikator($id)
    {
        $this->db->where('id_indikator', abs($id));
        $query = $this->db->get('cx_indikator');
        return $query->row_array();
    }

    /* indikator untuk insert data */
    public function insertDataindikator()
    {
        //get data
        $create_by      = $this->app_loader->current_account();
        $create_date    = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip      = $this->input->ip_address();
        $nm_indikator   = escape($this->input->post('nm_indikator', TRUE));
        $keterangan     = escape($this->input->post('keterangan', TRUE));
        $informasi      = escape($this->input->post('informasi', TRUE));
        $bobot          = escape($this->input->post('bobot', TRUE));
        $data_pendukung = escape($this->input->post('data_pendukung', TRUE));
        $jenis_file     = escape($this->input->post('jenis_file', TRUE));
        $id_status      = escape($this->input->post('id_status', TRUE));
        //cek nama indikator duplicate
        $this->db->where('nm_indikator', $nm_indikator);
        $qTot = $this->db->count_all_results('cx_indikator');
        if ($qTot > 0)
            return array('response' => 'ERROR', 'nama' => $nm_indikator);
        else {
            $data = array(
                'nm_indikator'   => $nm_indikator,
                'keterangan'     => $keterangan,
                'informasi'      => $informasi,
                'bobot'          => $bobot,
                'data_pendukung' => $data_pendukung,
                'jenis_file'     => $jenis_file,
                'create_by'      => $create_by,
                'create_date'    => $create_date,
                'create_ip'      => $create_ip,
                'mod_by'         => $create_by,
                'mod_date'       => $create_date,
                'mod_ip'         => $create_ip,
                'id_status'      => $id_status,
            );
            // print_r($data);
            // die;
            /*query insert*/
            $this->db->insert('cx_indikator', $data);
            return array('response' => 'SUCCESS', 'nama' => $nm_indikator);
        }
    }

    /* indikator untuk update data */
    public function updateDataindikator()
    {
        //get data
        $create_by      = $this->app_loader->current_account();
        $create_date    = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip      = $this->input->ip_address();
        $id_indikator   = $this->encryption->decrypt(escape($this->input->post('tokenId', TRUE)));
        $nm_indikator   = escape($this->input->post('nm_indikator', TRUE));
        $keterangan     = escape($this->input->post('keterangan', TRUE));
        $informasi      = escape($this->input->post('informasi', TRUE));
        $bobot          = escape($this->input->post('bobot', TRUE));
        $data_pendukung = escape($this->input->post('data_pendukung', TRUE));
        $jenis_file     = escape($this->input->post('jenis_file', TRUE));
        $id_status      = escape($this->input->post('id_status', TRUE));
        //cek data by id
        $dataindikator = $this->getDataDetailIndikator($id_indikator);
        if (count($dataindikator) <= 0)
            return array('response' => 'ERROR', 'nama' => '');
        else {
            //cek nama indikator duplicate
            $this->db->where('nm_indikator', $nm_indikator);
            $this->db->where('id_indikator !=', $id_indikator);
            $qTot = $this->db->count_all_results('cx_indikator');
            if ($qTot > 0)
                return array('response' => 'ERRDATA', 'nama' => $nm_indikator);
            else {
                $data = array(
                    'nm_indikator'   => $nm_indikator,
                    'keterangan'     => $keterangan,
                    'informasi'      => $informasi,
                    'bobot'          => $bobot,
                    'data_pendukung' => $data_pendukung,
                    'jenis_file'     => $jenis_file,
                    'mod_by'         => $create_by,
                    'mod_date'       => $create_date,
                    'mod_ip'         => $create_ip,
                    'id_status'      => $id_status
                );
                /*query update*/
                $this->db->where('id_indikator', abs($id_indikator));
                $this->db->update('cx_indikator', $data);
                return array('response' => 'SUCCESS', 'nama' => $nm_indikator);
            }
        }
    }

    /* indikator untuk delete data */
    public function deleteDataindikator()
    {
        $id_indikator = $this->encryption->decrypt(escape($this->input->post('tokenId', TRUE)));
        //cek data menu by id
        $dataindikator  = $this->getDataDetailIndikator($id_indikator);
        $nm_indikator = !empty($dataindikator) ? $dataindikator['nm_indikator'] : '';
        if (count($dataindikator) <= 0)
            return array('response' => 'ERROR', 'nama' => '');
        else {
            $this->db->where('id_indikator', abs($id_indikator));
            $this->db->delete('cx_indikator');
            return array('response' => 'SUCCESS', 'nama' => $nm_indikator);
        }
    }
}

// This is the end of auth signin model
