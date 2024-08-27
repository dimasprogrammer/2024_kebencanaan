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
        $id_regency = $this->app_loader->current_regencyID();
        // print_r($id_regency);
        // die;
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
        $this->db->where('b.id_status', 1);
        if ($this->app_loader->is_operator()) {
            $this->db->where('a.id_regency_penerima', $id_regency);
        }
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

    //-------------------- DIBAWAH INI FUNGSI UNTUK LISTVIEW VALIDASI KORBAN ------------------//
    /*Fungsi Get Data List*/
    public function get_datatables_korban($param, $token_bencana_detail)
    {
        $this->_get_datatables_query_korban($param, $token_bencana_detail);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_filtered_korban($param, $token_bencana_detail)
    {
        $this->_get_datatables_query_korban($param, $token_bencana_detail);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_korban()
    {
        return $this->db->count_all_results('ms_bencana_detail');
    }

    private function _get_datatables_query_korban($param, $token_bencana_detail)
    {
        $post = array();
        if (is_array($param)) {
            foreach ($param as $v) {
                $post[$v['name']] = $v['value'];
            }
        }

        $this->db->select('	a.id as id_bencana_korban, 
							a.token_bencana_detail, 
							a.token_korban_jiwa, 
							a.jumlah_korban,
                            a.status_validasi,
                            a.waktu_data,
                            a.wil_village,
                            b.token_bencana, 
                            c.nm_kondisi,
                            d.nm_jiwa,
                            e.name as nm_village');
        $this->db->from('ms_bencana_korban a');
        $this->db->join('ms_bencana_detail b', 'b.token_bencana_detail = a.token_bencana_detail', 'INNER');
        $this->db->join('cx_korban_kondisi c', 'c.id = a.id_kondisi', 'INNER');
        $this->db->join('cx_korban_jiwa d', 'd.id = a.id_jiwa', 'INNER');
        $this->db->join('wil_village e', 'e.id_village = a.wil_village', 'INNER');
        $this->db->where('a.status_validasi', 0);
        $this->db->where('a.token_bencana_detail', $token_bencana_detail);
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
        $this->db->order_by('a.id DESC');
    }

    /* Fungsi untuk update data */
    public function updateValidasiKorban()
    {
        $create_by   = $this->app_loader->current_account();
        $create_date = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip   = $this->input->ip_address();
        $token_bencana = escape($this->input->post('tokenId', TRUE));
        $status_validasi = escape($this->input->post('status_validasi', TRUE));
        foreach ($token_bencana as $idt) {

            $id = array(
                'status_validasi' => 1,
                'mod_by'            => $create_by,
                'mod_date'          => $create_date,
                'mod_ip'            => $create_ip
            );
            /*query update*/
            $this->db->where('token_korban_jiwa', $idt);
            $this->db->update('ms_bencana_korban', $id);
        }
        return array('response' => 'SUCCESS', 'nama' => '');
    }

    //-------------------- DIBAWAH INI FUNGSI UNTUK LISTVIEW VALIDASI KORBAN ------------------//

    /*Fungsi get data edit by id*/
    public function getDataDetailBencana($token_bencana_detail)
    {
        $this->db->select(' a.token_bencana_detail,
                            a.kebutuhan_bencana');
        $this->db->from('ms_bencana_detail a');
        $this->db->where('a.token_bencana_detail', $token_bencana_detail);
        $query = $this->db->get();
        return $query->row_array();
    }

    /* Fungsi untuk update data */
    public function insertDataKebutuhan()
    {
        $create_by   = $this->app_loader->current_account();
        $create_date = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip   = $this->input->ip_address();
        $token_bencana_detail = escape($this->input->post('tokenId', TRUE));
        $kebutuhan_bencana    = escape($this->input->post('kebutuhan_bencana', TRUE));
        $data = array(
            'kebutuhan_bencana' => $kebutuhan_bencana,
            'mod_by'            => $create_by,
            'mod_date'          => $create_date,
            'mod_ip'            => $create_ip
        );
        /*query update*/
        $this->db->where('token_bencana_detail', $token_bencana_detail);
        $this->db->update('ms_bencana_detail', $data);
        return array('response' => 'SUCCESS', 'nama' => '');
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
        $this->db->order_by('a.id DESC');
        $query = $this->db->get();
        return $query->result();
    }

    //--------------------- FUNGSI UNTUK GET DETAIL VALIDASI BENCANA --------------------------------//
    public function getDataDetailKorban($token_bencana_detail)
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
        $this->db->where('b.token_bencana_detail', $token_bencana_detail);
        $this->db->order_by('a.id DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    //--------------------- FUNGSI UNTUK GET DETAIL VALIDASI BENCANA --------------------------------//

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
        foreach ($datakelnag as $kln) {
            $data[$kln->id_village] = $kln->nm_district . " - " . str_replace('\n', " ", $kln->nm_village);
        }
        return $data;
    }

    public function createKorbanJiwa()
    {
        $create_by   = $this->app_loader->current_account();
        $create_date = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip   = $this->input->ip_address();

        $waktu_data = $this->input->post('data_date');
        $wil_village = $this->input->post('wil_village');
        $token_bencana_detail = $this->input->post('token_bencana_detail');
        $token_bencana = $this->input->post('token_bencana');

        $korbanjiwa = $this->input->post('jumlah_korban');
        if (!isset($korbanjiwa)) {
            return array('status' => 'not_found', 'message' => 'Data tidak ditemukan');
        }

        $insertRow = [];

        foreach ($korbanjiwa as $idkorban => $kondisi) {
            foreach ($kondisi as $idkondisi => $value) {
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

    public function createKerusakan()
    {
        $create_by   = $this->app_loader->current_account();
        $create_date = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip   = $this->input->ip_address();

        $waktu_data = $this->input->post('data_date');
        $wil_village = $this->input->post('wil_village');
        $token_bencana_detail = $this->input->post('token_bencana_detail');

        $rusak_ringan = $this->input->post('rusak_ringan');
        $rusak_sedang = $this->input->post('rusak_sedang');
        $rusak_berat = $this->input->post('rusak_berat');

        $dataKerusakan = [];
        foreach ($rusak_ringan as $key => $value) {
            $dataKerusakan[] = array(
                'token_bencana_detail' => $token_bencana_detail,
                'token_kerusakan' => $this->uuid->v4(true),

                'id_kerusakan' => $key,
                'rusak_ringan' => $value,
                'rusak_sedang' => $rusak_sedang[$key],
                'rusak_berat' => $rusak_berat[$key],

                'create_by' => $create_by,
                'create_date' => $create_date,
                'create_ip' => $create_ip,

                'mod_by' => $create_by,
                'mod_date' => $create_date,
                'mod_ip' => $create_ip,

                'waktu_data' => $waktu_data,
                'wil_village' => $wil_village
            );
        }
        $this->db->trans_start();
        $this->db->insert_batch('ms_bencana_kerusakan', $dataKerusakan);

        $dataTerendam = [];
        $jml_terendam = $this->input->post('jml_terendam');
        foreach ($jml_terendam as $key => $value) {
            $dataTerendam[] = array(
                'token_bencana_detail' => $token_bencana_detail,
                'token_terendam' => $this->uuid->v4(true),

                'id_kerusakan' => $key,
                'jml_terendam' => $value,

                'create_by' => $create_by,
                'create_date' => $create_date,
                'create_ip' => $create_ip,

                'waktu_data' => $waktu_data,
                'wil_village' => $wil_village
            );
        }
        $this->db->insert_batch('ms_bencana_terendam', $dataTerendam);

        $dataSaranaLainnya = [];
        $jml_sarana_lainnya = $this->input->post('jml_sarana_lainnya');
        foreach ($jml_sarana_lainnya as $key => $value) {
            $dataSaranaLainnya[] = array(
                'token_bencana_detail' => $token_bencana_detail,
                'token_sarana' => $this->uuid->v4(true),

                'id_kerusakan' => $key,
                'jumlah_sarana' => $value,

                'create_by' => $create_by,
                'create_date' => $create_date,
                'create_ip' => $create_ip,

                'waktu_data' => $waktu_data,
                'wil_village' => $wil_village
            );
        }
        $this->db->insert_batch('ms_bencana_sarana_lain', $dataSaranaLainnya);
        $this->db->trans_complete();
        if ($this->db->trans_status()  ===  FALSE) {
            return array('status' => 'error', 'message' => 'Data gagal disimpan', 'affected_rows' => $this->db->affected_rows());
        }
        return array('status' => 'success', 'message' => 'Data berhasil disimpan', 'affected_rows' => $this->db->affected_rows());
    }

    public function createTernak()
    {
        $create_by   = $this->app_loader->current_account();
        $create_date = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip   = $this->input->ip_address();

        $waktu_data = $this->input->post('data_date');
        $wil_village = $this->input->post('wil_village');
        $token_bencana_detail = $this->input->post('token_bencana_detail');

        $jumlah_ternak = $this->input->post('jumlah_ternak');
        // print_r($token_bencana_detail);
        // die;
        // if (empty($jumlah_ternak) || !is_array($jumlah_ternak)) {
        //     return array('status' => 'error', 'message' => 'Jumlah ternak tidak valid');
        // }

        $dataTernak = [];
        foreach ($jumlah_ternak as $key => $value) {
            $dataTernak[] = array(
                'token_bencana_detail' => $token_bencana_detail,
                'token_ternak'         => $this->uuid->v4(true),
                'id_jenis_ternak'      => $key,
                'jumlah_ternak'        => $value,
                'create_by'            => $create_by,
                'create_date'          => $create_date,
                'create_ip'            => $create_ip,
                'mod_by'               => $create_by,
                'mod_date'             => $create_date,
                'mod_ip'               => $create_ip,
                'waktu_data'           => $waktu_data,
                'wil_village'          => $wil_village
            );
        }
        // dd($dataTernak);

        $this->db->trans_start();
        $this->db->insert_batch('ms_bencana_ternak', $dataTernak);
        $this->db->trans_complete();

        if ($this->db->trans_status()  ===  FALSE) {
            return array('status' => 'error', 'message' => 'Data gagal disimpan', 'affected_rows' => $this->db->affected_rows());
        }
        return array('status' => 'success', 'message' => 'Data berhasil disimpan', 'affected_rows' => $this->db->affected_rows());
    }

    public function createTersalurkan()
    {
        $create_by   = $this->app_loader->current_account();
        $create_date = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip   = $this->input->ip_address();

        $waktu_data = $this->input->post('data_date');
        $wil_village = $this->input->post('wil_village');
        $token_bencana_detail = $this->input->post('token_bencana_detail');

        $jumlah_bantuan = $this->input->post('jumlah_bantuan');
        $dataTersalurkan = [];
        foreach ($jumlah_bantuan as $key => $value) {
            $dataTersalurkan[] = array(
                'token_bencana_detail' => $token_bencana_detail,
                'token_disalurkan'      => $this->uuid->v4(true),
                'id_jenis_bantuan'     => $key,
                'jumlah_bantuan'       => $value,
                'create_by'            => $create_by,
                'create_date'          => $create_date,
                'create_ip'            => $create_ip,
                'mod_by'               => $create_by,
                'mod_date'             => $create_date,
                'mod_ip'               => $create_ip,
                'waktu_data'           => $waktu_data,
                'wil_village'          => $wil_village
            );
        }
        $this->db->trans_start();
        $this->db->insert_batch('ms_bencana_disalurkan', $dataTersalurkan);

        $jumlah_sumber = $this->input->post('jumlah_sumber');
        $dataSumber = [];
        foreach ($jumlah_sumber as $key => $value) {
            $dataSumber[] = array(
                'token_bencana_detail'  => $token_bencana_detail,
                'token_sumber'          => $this->uuid->v4(true),
                'id_jenis_bantuan'      => $key,
                'jumlah_sumber'         => $value,
                'create_by'             => $create_by,
                'create_date'           => $create_date,
                'create_ip'             => $create_ip,
                'waktu_data'            => $waktu_data,
                'wil_village'           => $wil_village
            );
        }
        $this->db->insert_batch('ms_bencana_sumber', $dataSumber);
        $this->db->trans_complete();

        if ($this->db->trans_status()  ===  FALSE) {
            return array('status' => 'error', 'message' => 'Data gagal disimpan', 'affected_rows' => $this->db->affected_rows());
        }
        return array('status' => 'success', 'message' => 'Data berhasil disimpan', 'affected_rows' => $this->db->affected_rows());
    }

    public function createDiterima()
    {
        $create_by   = $this->app_loader->current_account();
        $create_date = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip   = $this->input->ip_address();

        $waktu_data = $this->input->post('data_date');
        $wil_village = $this->input->post('wil_village');
        $token_bencana_detail = $this->input->post('token_bencana_detail');

        $jumlah_bantuan = $this->input->post('jml_bantuan_diterima');
        $dataDiterima = [];
        foreach ($jumlah_bantuan as $key => $value) {
            $dataDiterima[] = array(
                'token_bencana_detail' => $token_bencana_detail,
                'token_diterima'       => $this->uuid->v4(true),
                'id_jenis_bantuan'     => $key,
                'jumlah_bantuan'       => $value,
                'create_by'            => $create_by,
                'create_date'          => $create_date,
                'create_ip'            => $create_ip,
                'mod_by'               => $create_by,
                'mod_date'             => $create_date,
                'mod_ip'               => $create_ip,
                'waktu_data'           => $waktu_data,
                'wil_village'          => $wil_village
            );
        }
        $this->db->trans_start();
        $this->db->insert_batch('ms_bencana_diterima', $dataDiterima);

        $jumlah_sumber = $this->input->post('jml_sumber_diterima');
        $dataSumber = [];
        foreach ($jumlah_sumber as $key => $value) {
            $dataSumber[] = array(
                'token_bencana_detail'  => $token_bencana_detail,
                'token_sumber'          => $this->uuid->v4(true),
                'id_jenis_bantuan'      => $key,
                'jumlah_sumber'         => $value,
                'create_by'             => $create_by,
                'create_date'           => $create_date,
                'create_ip'             => $create_ip,
                'waktu_data'            => $waktu_data,
                'wil_village'           => $wil_village,
                'diterima'              => 1
            );
        }
        $this->db->insert_batch('ms_bencana_sumber', $dataSumber);
        $this->db->trans_complete();

        if ($this->db->trans_status()  ===  FALSE) {
            return array('status' => 'error', 'message' => 'Data gagal disimpan', 'affected_rows' => $this->db->affected_rows());
        }
        return array('status' => 'success', 'message' => 'Data berhasil disimpan', 'affected_rows' => $this->db->affected_rows());
    }

    public function createRelawan()
    {
        $create_by   = $this->app_loader->current_account();
        $create_date = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip   = $this->input->ip_address();

        $waktu_data = $this->input->post('data_date');
        $wil_village = $this->input->post('wil_village');
        $token_bencana_detail = $this->input->post('token_bencana_detail');

        $nama_organisasi = $this->input->post('nama_organisasi');
        $jml_relawan = $this->input->post('jml_relawan');
        if (!isset($nama_organisasi)) {
            return array('status' => 'not_found', 'message' => 'Data tidak ditemukan');
        }

        $insertRow = [];

        foreach ($nama_organisasi as $key => $value) {

            $insertRow[] = array(
                'token_bencana_detail' => $token_bencana_detail,
                'token_relawan' => $this->uuid->v4(true),

                'nama_organisasi' => $value,
                'jml_relawan' => $jml_relawan[$key],
                'waktu_data' => $waktu_data,
                'wil_village' => $wil_village,

                'create_by' => $create_by,
                'create_date' => $create_date,
                'create_ip' => $create_ip
            );
        }

        $this->db->insert_batch('ms_bencana_relawan', $insertRow);
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


        if ($wil_village != "") {
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

        if ($latest_data) {
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
        return array(
            'status' => $status,
            'message' => $message,
            'data' => $dataKorbanJiwa,
            'waktu_data' => $waktu_data,
            'create_date' => $create_date,
            'wil_village' => $wil_village,
            'nm_village' => $nm_village
        );
    }

    public function getDataKerusakan($token = "", $wil_village = "")
    {
        $status = "RC422";
        $message = "Data tidak ditemukan";
        $waktu_data = "";
        $create_date = "";
        $nm_village = "";
        $result = [];


        if ($wil_village != "") {
            $this->db->where('a.wil_village', $wil_village);
        }

        $this->db->where('a.token_bencana_detail', $token);
        $this->db->select('a.wil_village,
        a.waktu_data,
        a.create_date,
        count(a.id) as jumlah_data,
        b.name as nm_village');
        $this->db->from('ms_bencana_kerusakan a');
        $this->db->join('wil_village b', 'b.id_village = a.wil_village', 'INNER');
        $this->db->group_by('a.wil_village, b.name, a.waktu_data, a.create_date');
        $this->db->order_by('a.waktu_data DESC, a.create_date DESC');
        $this->db->limit(1);
        $latest_data = $this->db->get()->row_array();

        if ($latest_data) {
            $status = "RC200";
            $message = "Data ditemukan";
            $wil_village = $latest_data['wil_village'];
            $waktu_data = tgl_indo_time($latest_data['waktu_data']);
            $create_date = tgl_indo_time($latest_data['create_date']);
            $nm_village = $latest_data['nm_village'];

            $this->db->select('id, id_kerusakan, rusak_ringan, rusak_sedang, rusak_berat');
            $this->db->from('ms_bencana_kerusakan');
            $this->db->where('wil_village', $latest_data['wil_village']);
            $this->db->where('waktu_data', $latest_data['waktu_data']);
            $this->db->where('create_date', $latest_data['create_date']);
            $this->db->order_by('id ASC');
            $this->db->limit($latest_data['jumlah_data']);
            $dataKerusakan = $this->db->get()->result_array();

            $this->db->select('id, id_kerusakan, jml_terendam');
            $this->db->from('ms_bencana_terendam');
            $this->db->where('wil_village', $latest_data['wil_village']);
            $this->db->where('waktu_data', $latest_data['waktu_data']);
            $this->db->where('create_date', $latest_data['create_date']);
            $this->db->order_by('id ASC');
            $this->db->limit($latest_data['jumlah_data']);
            $dataTerendam = $this->db->get()->result_array();

            $this->db->select('id, id_kerusakan, jumlah_sarana');
            $this->db->from('ms_bencana_sarana_lain');
            $this->db->where('wil_village', $latest_data['wil_village']);
            $this->db->where('waktu_data', $latest_data['waktu_data']);
            $this->db->where('create_date', $latest_data['create_date']);
            $this->db->order_by('id ASC');
            $this->db->limit($latest_data['jumlah_data']);
            $dataSaranaLainnya = $this->db->get()->result_array();

            $result = array(
                'kerusakan' => $dataKerusakan,
                'terendam' => $dataTerendam,
                'sarana_lainnya' => $dataSaranaLainnya
            );
        }
        return array(
            'status' => $status,
            'message' => $message,
            'data' => $result,
            'waktu_data' => $waktu_data,
            'create_date' => $create_date,
            'wil_village' => $wil_village,
            'nm_village' => $nm_village
        );
    }

    public function getDataTernak($token = "", $wil_village = "")
    {
        $status = "RC422";
        $message = "Data tidak ditemukan";
        $waktu_data = "";
        $create_date = "";
        $nm_village = "";
        $result = [];

        if ($wil_village != "") {
            $this->db->where('a.wil_village', $wil_village);
        }

        $this->db->where('a.token_bencana_detail', $token);
        $this->db->select(' a.wil_village,
                            a.waktu_data,
                            a.create_date,
                            count(a.id) as jumlah_data,
                            b.name as nm_village');
        $this->db->from('ms_bencana_ternak a');
        $this->db->join('wil_village b', 'b.id_village = a.wil_village', 'INNER');
        $this->db->group_by('a.wil_village, b.name, a.waktu_data, a.create_date');
        $this->db->order_by('a.waktu_data DESC, a.create_date DESC');
        $this->db->limit(1);
        $latest_data = $this->db->get()->row_array();

        if ($latest_data) {
            $status = "RC200";
            $message = "Data ditemukan";
            $wil_village = $latest_data['wil_village'];
            $waktu_data = tgl_indo_time($latest_data['waktu_data']);
            $create_date = tgl_indo_time($latest_data['create_date']);
            $nm_village = $latest_data['nm_village'];

            $this->db->select('id, id_jenis_ternak, jumlah_ternak');
            $this->db->from('ms_bencana_ternak');
            $this->db->where('wil_village', $latest_data['wil_village']);
            $this->db->where('waktu_data', $latest_data['waktu_data']);
            $this->db->where('create_date', $latest_data['create_date']);
            $this->db->order_by('id ASC');
            $this->db->limit($latest_data['jumlah_data']);
            $dataTernak = $this->db->get()->result_array();

            $result = array(
                'ternak' => $dataTernak
            );
        }
        return array(
            'status'      => $status,
            'message'     => $message,
            'data'        => $result,
            'waktu_data'  => $waktu_data,
            'create_date' => $create_date,
            'wil_village' => $wil_village,
            'nm_village'  => $nm_village
        );
    }

    public function getDataTersalurkan($token = "", $wil_village = "")
    {
        $status = "RC422";
        $message = "Data tidak ditemukan";
        $waktu_data = "";
        $create_date = "";
        $nm_village = "";
        $result = [];


        if ($wil_village != "") {
            $this->db->where('a.wil_village', $wil_village);
        }

        $this->db->where('a.token_bencana_detail', $token);
        $this->db->select(' a.wil_village,
                            a.waktu_data,
                            a.create_date,
                            count(a.id) as jumlah_data,
                            b.name as nm_village');
        $this->db->from('ms_bencana_disalurkan a');
        $this->db->join('wil_village b', 'b.id_village = a.wil_village', 'INNER');
        $this->db->group_by('a.wil_village, b.name, a.waktu_data, a.create_date');
        $this->db->order_by('a.waktu_data DESC, a.create_date DESC');
        $this->db->limit(1);
        $latest_data = $this->db->get()->row_array();

        if ($latest_data) {
            $status = "RC200";
            $message = "Data ditemukan";
            $wil_village = $latest_data['wil_village'];
            $waktu_data = tgl_indo_time($latest_data['waktu_data']);
            $create_date = tgl_indo_time($latest_data['create_date']);
            $nm_village = $latest_data['nm_village'];

            $this->db->select('id, id_jenis_bantuan, jumlah_bantuan');
            $this->db->from('ms_bencana_disalurkan');
            $this->db->where('wil_village', $latest_data['wil_village']);
            $this->db->where('waktu_data', $latest_data['waktu_data']);
            $this->db->where('create_date', $latest_data['create_date']);
            $this->db->order_by('id ASC');
            $this->db->limit($latest_data['jumlah_data']);
            $dataTersalurkan = $this->db->get()->result_array();

            $this->db->select('id, id_jenis_bantuan, jumlah_sumber');
            $this->db->from('ms_bencana_sumber');
            $this->db->where('wil_village', $latest_data['wil_village']);
            $this->db->where('waktu_data', $latest_data['waktu_data']);
            $this->db->where('create_date', $latest_data['create_date']);
            $this->db->where('diterima', 0);
            $this->db->order_by('id ASC');
            $this->db->limit($latest_data['jumlah_data']);
            $dataSumber = $this->db->get()->result_array();

            $result = array(
                'tersalurkan' => $dataTersalurkan,
                'sumber' => $dataSumber
            );
        }
        return array(
            'status' => $status,
            'message' => $message,
            'data' => $result,
            'waktu_data' => $waktu_data,
            'create_date' => $create_date,
            'wil_village' => $wil_village,
            'nm_village' => $nm_village
        );
    }

    public function getDataDiterima($token = "", $wil_village = "")
    {
        $status = "RC422";
        $message = "Data tidak ditemukan";
        $waktu_data = "";
        $create_date = "";
        $nm_village = "";
        $result = [];


        if ($wil_village != "") {
            $this->db->where('a.wil_village', $wil_village);
        }

        $this->db->where('a.token_bencana_detail', $token);
        $this->db->select(' a.wil_village,
                            a.waktu_data,
                            a.create_date,
                            count(a.id) as jumlah_data,
                            b.name as nm_village');
        $this->db->from('ms_bencana_diterima a');
        $this->db->join('wil_village b', 'b.id_village = a.wil_village', 'INNER');
        $this->db->group_by('a.wil_village, b.name, a.waktu_data, a.create_date');
        $this->db->order_by('a.waktu_data DESC, a.create_date DESC');
        $this->db->limit(1);
        $latest_data = $this->db->get()->row_array();

        if ($latest_data) {
            $status = "RC200";
            $message = "Data ditemukan";
            $wil_village = $latest_data['wil_village'];
            $waktu_data = tgl_indo_time($latest_data['waktu_data']);
            $create_date = tgl_indo_time($latest_data['create_date']);
            $nm_village = $latest_data['nm_village'];

            $this->db->select('id, id_jenis_bantuan, jumlah_bantuan');
            $this->db->from('ms_bencana_diterima');
            $this->db->where('wil_village', $latest_data['wil_village']);
            $this->db->where('waktu_data', $latest_data['waktu_data']);
            $this->db->where('create_date', $latest_data['create_date']);
            $this->db->order_by('id ASC');
            $this->db->limit($latest_data['jumlah_data']);
            $dataDiterima = $this->db->get()->result_array();

            $this->db->select('id, id_jenis_bantuan, jumlah_sumber');
            $this->db->from('ms_bencana_sumber');
            $this->db->where('wil_village', $latest_data['wil_village']);
            $this->db->where('waktu_data', $latest_data['waktu_data']);
            $this->db->where('create_date', $latest_data['create_date']);
            $this->db->where('diterima', 1);
            $this->db->order_by('id ASC');
            $this->db->limit($latest_data['jumlah_data']);
            $dataSumber = $this->db->get()->result_array();

            $result = array(
                'diterima' => $dataDiterima,
                'sumber'   => $dataSumber
            );
        }
        return array(
            'status' => $status,
            'message' => $message,
            'data' => $result,
            'waktu_data' => $waktu_data,
            'create_date' => $create_date,
            'wil_village' => $wil_village,
            'nm_village' => $nm_village
        );
    }

    public function getDataRelawan($token = "", $wil_village = "")
    {
        $status = "RC422";
        $message = "Data tidak ditemukan";
        $waktu_data = "";
        $create_date = "";
        $nm_village = "";
        $dataRelawan = [];


        if ($wil_village != "") {
            $this->db->where('a.wil_village', $wil_village);
        }

        $this->db->where('a.token_bencana_detail', $token);
        $this->db->select('a.wil_village,
        a.waktu_data,
        a.create_date,
        count(a.id) as jumlah_data,
        b.name as nm_village');
        $this->db->from('ms_bencana_relawan a');
        $this->db->join('wil_village b', 'b.id_village = a.wil_village', 'INNER');
        $this->db->group_by('a.wil_village, b.name, a.waktu_data, a.create_date');
        $this->db->order_by('a.waktu_data DESC, a.create_date DESC');
        $this->db->limit(1);
        $latest_data = $this->db->get()->row_array();

        if ($latest_data) {
            $status = "RC200";
            $message = "Data ditemukan";
            $wil_village = $latest_data['wil_village'];
            $waktu_data = tgl_indo_time($latest_data['waktu_data']);
            $create_date = tgl_indo_time($latest_data['create_date']);
            $nm_village = $latest_data['nm_village'];

            $this->db->select('id, nama_organisasi, jml_relawan');
            $this->db->from('ms_bencana_relawan');
            $this->db->where('wil_village', $latest_data['wil_village']);
            $this->db->where('waktu_data', $latest_data['waktu_data']);
            $this->db->where('create_date', $latest_data['create_date']);
            $this->db->order_by('id ASC');
            $this->db->limit($latest_data['jumlah_data']);
            $dataRelawan = $this->db->get()->result_array();
        }
        return array(
            'status' => $status,
            'message' => $message,
            'data' => $dataRelawan,
            'waktu_data' => $waktu_data,
            'create_date' => $create_date,
            'wil_village' => $wil_village,
            'nm_village' => $nm_village
        );
    }
}

// This is the end of auth signin model
