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
    var $search = array('a.token_bencana_detail');
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
        return $this->db->count_all_results('ms_bencana_detail');
    }

    private function _get_datatables_query($param)
    {
        $post = array();
        if (is_array($param)) {
            foreach ($param as $v) {
                $post[$v['name']] = $v['value'];
            }
        }

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
        $this->db->order_by('a.id_bencana_detail DESC');
    }

    /*Fungsi get data edit by id*/
    public function addDataDetailBencanaDetail($token_bencana_detail)
    {
        $this->db->select('	a.id_bencana_detail, 
							a.token_bencana, 
							a.token_bencana_detail, 
							a.id_regency_penerima');
        $this->db->from('ms_bencana_detail a');
        $this->db->join('ms_bencana b', 'b.token_bencana = a.token_bencana', 'INNER');
        $this->db->where('a.token_bencana_detail', $token_bencana_detail);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getDataKorbanBencana()
    {
        $this->db->select('	a.id as id_bencana_korban, 
							a.token_bencana_detail, 
							a.jumlah_korban, 
							b.token_bencana, 
                            c.nm_kondisi,
                            d.nm_jiwa');
        $this->db->from('ms_bencana_korban a');
        $this->db->join('ms_bencana_detail b', 'b.token_bencana_detail = a.token_bencana_detail', 'INNER');
        $this->db->join('cx_korban_kondisi c', 'c.id = a.id_kondisi', 'INNER');
        $this->db->join('cx_korban_jiwa d', 'd.id = a.id_jiwa', 'INNER');
        // $this->db->where('a.token_bencana_detail', $token_bencana_detail);
        $this->db->order_by('a.id DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataKorbanKondisi()
    {
        $this->db->select('	a.id as id_kondisi, 
							a.nm_kondisi');
        $this->db->from('cx_korban_kondisi a');
        $this->db->order_by('a.id ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getMasterDataKorban()
    {
        $this->db->select("id, nm_jiwa");
        $this->db->from('cx_korban_jiwa');
        $this->db->order_by('id', "ASC");
        return $this->db->get()->result_array();
    }

    public function getDataJenisSaranaRusak()
    {
        $this->db->select('	a.id as id_jenis_sarana, 
							a.nm_jenis_sarana');
        $this->db->from('cx_jenis_sarana a');
        $this->db->where('a.flag', 1);
        $this->db->order_by('a.id ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataJenisSaranaTerendam()
    {
        $this->db->select('	a.id as id_jenis_sarana, 
							a.nm_jenis_sarana');
        $this->db->from('cx_jenis_sarana a');
        $this->db->where('a.flag', 2);
        $this->db->order_by('a.id ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataJenisSaranaLainnya()
    {
        $this->db->select('	a.id as id_jenis_sarana, 
							a.nm_jenis_sarana');
        $this->db->from('cx_jenis_sarana a');
        $this->db->where('a.flag', 3);
        $this->db->order_by('a.id ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataJenisTernak()
    {
        $this->db->select('	a.id as id_jenis_ternak, 
							a.nm_jenis_ternak');
        $this->db->from('cx_jenis_ternak a');
        $this->db->order_by('a.id ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataJenisBantuanDiterima()
    {
        $this->db->select('	a.id as id_jenis_bantuan, 
							a.nm_jenis_bantuan,
                            a.satuan');
        $this->db->from('cx_jenis_bantuan a');
        $this->db->where('a.flag', 1);
        $this->db->order_by('a.id ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataJenisBantuanTersalurkan()
    {
        $this->db->select('	a.id as id_jenis_bantuan, 
							a.nm_jenis_bantuan,
                            a.satuan');
        $this->db->from('cx_jenis_bantuan a');
        $this->db->where('a.flag', 1);
        $this->db->order_by('a.id ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataJenisSumber()
    {
        $this->db->select('	a.id as id_jenis_bantuan, 
							a.nm_jenis_bantuan');
        $this->db->from('cx_jenis_bantuan a');
        $this->db->where('a.flag', 2);
        $this->db->order_by('a.id ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getVillageBencana($token_bencana_detail)
    {
        $this->db->select('c.id_village, b.name as nm_district, c.name as nm_village');
        $this->db->from('ms_bencana_detail a');
        $this->db->join('wil_district b', 'b.id_regency = a.id_regency_penerima', 'INNER');
        $this->db->join('wil_village c', 'c.id_district = b.id_district', 'INNER');
        $this->db->where('a.token_bencana_detail', $token_bencana_detail);
        $query = $this->db->get();
        $datakelnag = $query->result();
        $data[''] = 'Pilih Kelurahan/ Nagari/ Desa';
        foreach($datakelnag as $kln)
        {
            $data[$kln->id_village] = $kln->nm_district . " - " . str_replace('\n', " ", $kln->nm_village);
        }
        return $data;
    }

    public function createKorbanJiwa()
    {
        $create_by   = $this->app_loader->current_account();
        $create_date = gmdate('Y-m-d H:i:s', time()+60*60*7);
        $create_ip   = $this->input->ip_address();
        
        $waktu_data = $this->input->post('data_date');
        $wil_village = $this->input->post('wil_village');
        $token_bencana_detail = $this->input->post('token_bencana_detail');
        $token_bencana = $this->input->post('token_bencana');

        $korbanjiwa = $this->input->post('jumlah_korban');
        if(!isset($korbanjiwa))
        {
            return array('status' => 'not_found', 'message' => 'Data tidak ditemukan');
        }

        $insertRow = [];

        foreach($korbanjiwa as $idkorban => $kondisi )
        {
            foreach($kondisi as $idkondisi => $value)
            {
                $insertRow[] = array(
                    'token_bencana_detail' => $token_bencana_detail,
                    'token_korban_jiwa' => $this->uuid->v4(true),

                    'id_kondisi' => $idkondisi,
                    'id_jiwa' => $idkorban,
                    'jumlah_korban' => $value,
                    'waktu_data' => $waktu_data,
                    'wil_village' => $wil_village,

                    'create_by' => $create_by,
                    'create_date' => $create_date,
                    'create_ip' => $create_ip,

                    'mod_by' => $create_by,
                    'mod_date' => $create_date,
                    'mod_ip' => $create_ip
                );
            }
        }

        $this->db->insert_batch('ms_bencana_korban', $insertRow);
        return array('status' => 'success', 'message' => 'Data berhasil disimpan', 'affected_rows' => $this->db->affected_rows());
    }

    public function getDataKorbanJiwa($token = "", $wil_village = "")
    {
        $status = "RC422";
        $message = "Data tidak ditemukan";
        $waktu_data = "";
        $create_date = "";
        $nm_village = "";
        $dataKorbanJiwa = [];


        if($wil_village != "")
        {
            $this->db->where('a.wil_village', $wil_village);
        }
        
        $this->db->where('a.token_bencana_detail', $token);
        $this->db->select('a.wil_village,
        a.waktu_data,
        a.create_date,
        count(a.id) as jumlah_data,
        b.name as nm_village');
        $this->db->from('ms_bencana_korban a');
        $this->db->join('wil_village b', 'b.id_village = a.wil_village', 'INNER');
        $this->db->group_by('a.wil_village, b.name, a.waktu_data, a.create_date');
        $this->db->order_by('a.waktu_data DESC, a.create_date DESC');
        $this->db->limit(1);
        $latest_data = $this->db->get()->row_array();
        
        if($latest_data)
        {
            $status = "RC200";
            $message = "Data ditemukan";
            $wil_village = $latest_data['wil_village'];
            $waktu_data = tgl_indo_time($latest_data['waktu_data']);
            $create_date = tgl_indo_time($latest_data['create_date']);
            $nm_village = $latest_data['nm_village'];

            $this->db->select('id, id_jiwa, id_kondisi, jumlah_korban');
            $this->db->from('ms_bencana_korban');
            $this->db->where('wil_village', $latest_data['wil_village']);
            $this->db->where('waktu_data', $latest_data['waktu_data']);
            $this->db->where('create_date', $latest_data['create_date']);
            $this->db->order_by('id ASC');
            $this->db->limit($latest_data['jumlah_data']);
            $dataKorbanJiwa = $this->db->get()->result_array();
        }
        return array(   'status' => $status, 
                        'message' => $message, 
                        'data' => $dataKorbanJiwa, 
                        'waktu_data' => $waktu_data, 
                        'create_date' => $create_date,
                        'wil_village' => $wil_village,
                        'nm_village' => $nm_village
                    );
    }
}

// This is the end of auth signin model
