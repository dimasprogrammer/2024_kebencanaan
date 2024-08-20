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

    public function getDataDetailTokenBencana($token_bencana, $id_kondisi)
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
        $query = $this->db->get();

        $detail = array();
        if ($query->num_rows() <= 0)
            return array();
        else {
            foreach ($query->result_array() as $key => $val) {
                $detail[] = $val['token_bencana_detail'];
            }
            $check = $this->checkKorbanBencana($detail, $id_kondisi);
            return $check;
        }
    }

    public function checkKorbanBencana($detail, $id_kondisi)
    {
        $this->db->select(' sum(a.jumlah_korban) as jumlah_korban');
        $this->db->from('ms_bencana_korban a');
        $this->db->where_in('a.token_bencana_detail', $detail);
        $this->db->where('a.id_kondisi', $id_kondisi);
        $query = $this->db->get();
        if ($query->num_rows() <= 0)
            return 0;
        else {
            $jumlah = $query->row_array()['jumlah_korban'];
            return $jumlah;
        }
    }
    public function getDataKorbanBencana($token_bencana)
    {
        $this->db->select('	a.id as id_bencana_korban, 
							a.token_bencana_detail, 
						    a.jumlah_korban, 
							b.token_bencana, 
                            d.nm_kondisi,
                            e.nm_jiwa');
        $this->db->from('ms_bencana_korban a');
        $this->db->join('ms_bencana_detail b', 'b.token_bencana_detail = a.token_bencana_detail', 'INNER');
        $this->db->join('ms_bencana c', 'b.token_bencana = c.token_bencana', 'INNER');
        $this->db->join('cx_korban_kondisi d', 'd.id = a.id_kondisi', 'INNER');
        $this->db->join('cx_korban_jiwa e', 'e.id = a.id_jiwa', 'INNER');
        $this->db->where('b.token_bencana', $token_bencana);
        $this->db->where('d.id', 5);
        // $this->db->order_by('a.id DESC');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getBencanaLongsor()
    {
        $id_regency = $this->app_loader->current_regencyID();
        $this->db->select('
                            count(b.id_jenis_bencana) as total_longsor
                            ');
        $this->db->from('ms_bencana a');
        $this->db->join('cx_jenis_bencana b', 'b.id_jenis_bencana = a.id_jenis_bencana', 'inner');
        $this->db->where('b.id_jenis_bencana', 1);
        // if ($this->app_loader->is_operator()) {
        //     $this->db->where('a.id_regency_penerima', $id_regency);
        // }
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getBencanaAll()
    {
        $this->db->select('a.id_bencana,
                           a.token_bencana,
                           a.nama_bencana,
                           a.tanggal_bencana,
                           a.jam_bencana,
                           a.taksiran_kerugian,
                           a.kategori_tanggap,
                           a.id_status,
                           a.latitude,
                           a.longitude,
                           b.nm_bencana as jenis_bencana,
                           c.nm_tanggap');
        $this->db->from('ms_bencana a');
        $this->db->join('cx_jenis_bencana b', 'b.id_jenis_bencana = a.id_jenis_bencana', 'inner');
        $this->db->join('cx_tanggap_bencana c', 'c.id_tanggap_bencana = a.kategori_tanggap', 'inner');
        $this->db->where('a.id_status', 1);
        $this->db->where('a.token_bencana', 'CD3CC066C1674365B1958E7286FBEFAD');
        $this->db->limit(1);
        $this->db->order_by('a.tanggal_bencana DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getBencanaBanjir()
    {
        $id_regency = $this->app_loader->current_regencyID();
        $this->db->select('
                            count(b.id_jenis_bencana) as total_banjir
                            ');
        $this->db->from('ms_bencana_detail a');
        $this->db->join('ms_bencana b', 'b.token_bencana = a.token_bencana', 'INNER');
        $this->db->where('b.id_jenis_bencana', 3);
        if ($this->app_loader->is_operator()) {
            $this->db->where('a.id_regency_penerima', $id_regency);
        }
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getBencanaKebakaran()
    {
        $id_regency = $this->app_loader->current_regencyID();
        $this->db->select('
                            count(b.id_jenis_bencana) as total_kebakaran
                            ');
        $this->db->from('ms_bencana_detail a');
        $this->db->join('ms_bencana b', 'b.token_bencana = a.token_bencana', 'INNER');
        $this->db->where('b.id_jenis_bencana', 5);
        if ($this->app_loader->is_operator()) {
            $this->db->where('a.id_regency_penerima', $id_regency);
        }
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getBencanaCuaca()
    {
        $id_regency = $this->app_loader->current_regencyID();
        $this->db->select('
                            count(b.id_jenis_bencana) as total_cuaca
                            ');
        $this->db->from('ms_bencana_detail a');
        $this->db->join('ms_bencana b', 'b.token_bencana = a.token_bencana', 'INNER');
        $this->db->where('b.id_jenis_bencana', 7);
        if ($this->app_loader->is_operator()) {
            $this->db->where('a.id_regency_penerima', $id_regency);
        }
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getBencanaErupsi()
    {
        $id_regency = $this->app_loader->current_regencyID();
        $this->db->select('
                            count(b.id_jenis_bencana) as total_erupsi
                            ');
        $this->db->from('ms_bencana_detail a');
        $this->db->join('ms_bencana b', 'b.token_bencana = a.token_bencana', 'INNER');
        $this->db->where('b.id_jenis_bencana', 6);
        if ($this->app_loader->is_operator()) {
            $this->db->where('a.id_regency_penerima', $id_regency);
        }
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getBencanaGempaBumi()
    {
        $id_regency = $this->app_loader->current_regencyID();
        $this->db->select('
                            count(b.id_jenis_bencana) as total_gempa_bumi
                            ');
        $this->db->from('ms_bencana_detail a');
        $this->db->join('ms_bencana b', 'b.token_bencana = a.token_bencana', 'INNER');
        $this->db->where('b.id_jenis_bencana', 2);
        if ($this->app_loader->is_operator()) {
            $this->db->where('a.id_regency_penerima', $id_regency);
        }
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getBencanaBanjirBandang()
    {
        $id_regency = $this->app_loader->current_regencyID();
        $this->db->select('
                            count(b.id_jenis_bencana) as total_banjir_bandang
                            ');
        $this->db->from('ms_bencana_detail a');
        $this->db->join('ms_bencana b', 'b.token_bencana = a.token_bencana', 'INNER');
        $this->db->where('b.id_jenis_bencana', 4);
        if ($this->app_loader->is_operator()) {
            $this->db->where('a.id_regency_penerima', $id_regency);
        }
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getBencanaAbrasiPantai()
    {
        $id_regency = $this->app_loader->current_regencyID();
        $this->db->select('
                            count(b.id_jenis_bencana) as total_abrasi_pantai
                            ');
        $this->db->from('ms_bencana_detail a');
        $this->db->join('ms_bencana b', 'b.token_bencana = a.token_bencana', 'INNER');
        $this->db->where('b.id_jenis_bencana', 9);
        if ($this->app_loader->is_operator()) {
            $this->db->where('a.id_regency_penerima', $id_regency);
        }
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getDataUpload($token_bencana)
    {
        $this->db->select(' a.token_bencana, 
                            a.create_date,
                            a.nama_file,
                            a.video_bencana,
                            a.nama_file_infografis');
        $this->db->from('ms_bencana a');
        $this->db->where('a.token_bencana', $token_bencana);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }
}

// This is the end of auth signin model
