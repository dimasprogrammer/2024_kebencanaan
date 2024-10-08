<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of bencana model
 *
 * @author Dimas Dwi Randa
 */

class Model_bencana extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    //---------------------------- FUNGSI MODEL UNTUK DATA KEBENCANAAN -------------------------//

    /*Fungsi Get Data List*/
    var $search = array('a.nama_bencana', 'a.tanggal_bencana');
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
                           a.jam_bencana,
                           a.taksiran_kerugian,
                           a.id_status,
                           b.nm_bencana as jenis_bencana');
        $this->db->from('ms_bencana a');
        $this->db->join('cx_jenis_bencana b', 'b.id_jenis_bencana = a.id_jenis_bencana', 'left');
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

    /*Fungsi get data edit by id*/
    public function getDataDetailBencana($token_bencana)
    {
        $this->db->select('a.id_bencana,
                           a.token_bencana,
                           a.tanggal_bencana,
                           a.jam_bencana,
                           a.kategori_tanggap,
                           a.id_jenis_bencana,
                           a.nama_bencana,
                           a.keterangan_bencana,
                           a.penyebab_bencana,
                           a.nama_file,
                           a.nama_file_infografis,
                           a.video_bencana,
                           a.taksiran_kerugian,
                           a.latitude,
                           a.longitude,
                           a.id_status,
                           a.create_date,
                           b.nm_bencana as jenis_bencana,
                           c.nm_tanggap');
        $this->db->from('ms_bencana a');
        $this->db->join('cx_jenis_bencana b', 'a.id_jenis_bencana = b.id_jenis_bencana', 'inner');
        $this->db->join('cx_tanggap_bencana c', 'a.kategori_tanggap = c.id_tanggap_bencana', 'inner');
        $this->db->where('token_bencana', $token_bencana);
        $query = $this->db->get();
        return $query->row_array();
    }

    /* Fungsi untuk insert data */
    public function insertDataBencana()
    {
        //get data
        $token_bencana          =  $this->uuid->v4(true);
        $create_by              = $this->app_loader->current_user();
        $create_date            = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip              = $this->input->ip_address();
        $tanggal_bencana        = $this->input->post('tanggal_bencana', TRUE);
        $jam_bencana            = escape($this->input->post('jam_bencana', TRUE));
        $kategori_tanggap       = escape($this->input->post('kategori_tanggap', TRUE));
        $id_jenis_bencana       = escape($this->input->post('id_jenis_bencana', TRUE));
        $nama_bencana           = escape($this->input->post('nama_bencana', TRUE));
        $keterangan_bencana     = escape($this->input->post('keterangan_bencana', TRUE));
        $penyebab_bencana       = escape($this->input->post('penyebab_bencana', TRUE));
        $latitude               = escape($this->input->post('latitude', TRUE));
        $longitude              = escape($this->input->post('longitude', TRUE));
        $nama_file              = escape($this->input->post('nama_file', TRUE));
        $nama_file_infografis   = escape($this->input->post('nama_file_infografis', TRUE));
        $video_bencana          = escape($this->input->post('video_bencana', TRUE));
        $taksiran_kerugian      = escape($this->input->post('taksiran_kerugian', TRUE));
        $id_regency             = escape($this->input->post('id_regency', TRUE));

        //cek nama fungsi duplicate
        $year    = date('Y');
        $month   = date('m');

        //--------------------------- foto bencana -------------------------------//
        $dirname = 'dokumen/bencana/' . $year . '/' . $month . '/';
        if (!is_dir($dirname)) {
            mkdir('./' . $dirname, 0777, TRUE);
        }

        $_FILES['file']['name']     = $_FILES['nama_file']['name'];
        $_FILES['file']['type']     = $_FILES['nama_file']['type'];
        $_FILES['file']['tmp_name'] = $_FILES['nama_file']['tmp_name'];
        $_FILES['file']['error']    = $_FILES['nama_file']['error'];
        $_FILES['file']['size']     = $_FILES['nama_file']['size'];
        $config = array(
            'upload_path'      => './' . $dirname . '/',
            'allowed_types'    => 'png|jpg|jpeg|pdf',
            'file_name'        => 'file_bencana_' . date('YmdHis', strtotime($create_date)),
            'file_ext_tolower' => TRUE,
            'max_size'         => 5024,
            'max_filename'     => 0,
            'remove_spaces'    => TRUE,
        );

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('file')) {
            $nama_file = '';
        } else {
            $upload_data = $this->upload->data();
            $nama_file   = $upload_data['file_name'];
        }
        //--------------------------- foto bencana -------------------------------//

        //--------------------------- foto infografis -------------------------------//
        $dirname = 'dokumen/infografis/' . $year . '/' . $month . '/';
        if (!is_dir($dirname)) {
            mkdir('./' . $dirname, 0777, TRUE);
        }

        $_FILES['file']['name']     = $_FILES['nama_file_infografis']['name'];
        $_FILES['file']['type']     = $_FILES['nama_file_infografis']['type'];
        $_FILES['file']['tmp_name'] = $_FILES['nama_file_infografis']['tmp_name'];
        $_FILES['file']['error']    = $_FILES['nama_file_infografis']['error'];
        $_FILES['file']['size']     = $_FILES['nama_file_infografis']['size'];
        $config = array(
            'upload_path'      => './' . $dirname . '/',
            'allowed_types'    => 'png|jpg|jpeg|pdf',
            'file_name'        => 'file_infografis_' . date('YmdHis', strtotime($create_date)),
            'file_ext_tolower' => TRUE,
            'max_size'         => 5024,
            'max_filename'     => 0,
            'remove_spaces'    => TRUE,
        );

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('file')) {
            $nama_file_infografis = '';
        } else {
            $upload_data = $this->upload->data();
            $nama_file_infografis   = $upload_data['file_name'];
        }
        //--------------------------- foto infografis -------------------------------//

        $data = array(
            'token_bencana'          => $token_bencana,
            'tanggal_bencana'        => !empty($tanggal_bencana) ? $tanggal_bencana : '',
            'jam_bencana'            => !empty($jam_bencana) ? $jam_bencana : '',
            'kategori_tanggap'       => !empty($kategori_tanggap) ? $kategori_tanggap : 0,
            'id_jenis_bencana'       => !empty($id_jenis_bencana) ? $id_jenis_bencana : 0,
            'nama_bencana'           => !empty($nama_bencana) ? $nama_bencana : '',
            'keterangan_bencana'     => !empty($keterangan_bencana) ? $keterangan_bencana : '',
            'penyebab_bencana'       => !empty($penyebab_bencana) ? $penyebab_bencana : '',
            'nama_file'              => !empty($nama_file) ? $nama_file : '',
            'nama_file_infografis'   => !empty($nama_file_infografis) ? $nama_file_infografis : '',
            'video_bencana'          => !empty($video_bencana) ? $video_bencana : '',
            'taksiran_kerugian'      => !empty($taksiran_kerugian) ? $taksiran_kerugian : 0,
            'latitude'               => !empty($latitude) ? $latitude : '',
            'longitude'              => !empty($longitude) ? $longitude : '',
            'id_status'              => 0,
            'create_by'              => $create_by,
            'create_date'            => $create_date,
            'create_ip'              => $create_ip,
            'mod_by'                 => $create_by,
            'mod_date'               => $create_date,
            'mod_ip'                 => $create_ip
        );
        // print_r($data);
        // die;
        /*query insert*/
        $this->db->insert('ms_bencana', $data);
        foreach ((array)$id_regency as $key => $id) {
            $token_bencana_detail =  $this->uuid->v4(true);
            /*cek data kontrol*/
            $this->db->where('token_bencana_detail', $token_bencana_detail);
            $qTot = $this->db->count_all_results('ms_bencana_detail');
            if ($qTot <= 0) {
                $data = array(
                    'token_bencana'         => $token_bencana,
                    'token_bencana_detail'  => $token_bencana_detail,
                    'id_regency_penerima'   => $id,
                    'kebutuhan_bencana'     => '-',
                    'id_status'             => 0
                );
                $this->db->insert('ms_bencana_detail', $data);
            }
        }
        return array('response' => 'SUCCESS', 'nama' =>  $tanggal_bencana);
    }

    public function unlink_data($directory, $year, $month, $ct)
    {
        if (!$ct == "") {
            $foto = $directory . '/' . $year . '/' . $month . '/' . $ct;
            if (file_exists($foto)) {
                unlink($foto);
            }
        }
    }

    public function uploadFileBencana($nama_file, $dirname, $token_bencana, $nama_kolom, $nama_folder)
    {
        $create_date = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);

        $_FILES['file']['name']     = $nama_file['name'];
        $_FILES['file']['type']     = $nama_file['type'];
        $_FILES['file']['tmp_name'] = $nama_file['tmp_name'];
        $_FILES['file']['error']    = $nama_file['error'];
        $_FILES['file']['size']     = $nama_file['size'];
        $config = array(
            'upload_path'      => './' . $dirname . '/',
            'allowed_types'    => 'png|jpg|jpeg|pdf',
            'file_name'        => 'file_' . $nama_folder . '_' . date('YmdHis', strtotime($create_date)),
            'file_ext_tolower' => TRUE,
            'max_size'         => 50024,
            'max_filename'     => 0,
            'remove_spaces'    => TRUE,
        );
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file')) {
            $nama_file = '';
            return array('ERROR' => $this->upload->display_errors(),  '' => $nama_file);
        } else {
            $upload_data = $this->upload->data();
            $nama_file   = $upload_data['file_name'];
            $checkFile   = $this->getDataUpload($token_bencana);
            if ($checkFile == 0) {
                return 0;
            } else {
                $file        = $checkFile[$nama_kolom];

                $dirnameUpdateGambar = $dirname . $file;
                if (!empty($file)) {
                    if (file_exists($dirnameUpdateGambar)) {
                        unlink($dirnameUpdateGambar);
                    }
                }

                $dataGambar = array(
                    $nama_kolom => $nama_file,
                );
                /*query update*/
                $this->db->where('token_bencana ', $token_bencana);
                $this->db->update('ms_bencana', $dataGambar);

                return $dirnameUpdateGambar;
            }
        }
        // return $dirnameUpdateGambar;
    }

    /* Fungsi untuk update data */
    public function updateDataBencana()
    {
        //get data
        $create_by          = $this->app_loader->current_user();
        $create_date        = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip          = $this->input->ip_address();
        $token_bencana      = escape($this->input->post('tokenId', TRUE));
        $tanggal_bencana    = escape($this->input->post('tanggal_bencana', TRUE));
        $jam_bencana        = escape($this->input->post('jam_bencana', TRUE));
        $kategori_tanggap   = escape($this->input->post('kategori_tanggap', TRUE));
        $id_jenis_bencana   = escape($this->input->post('id_jenis_bencana', TRUE));
        $nama_bencana       = escape($this->input->post('nama_bencana', TRUE));
        $keterangan_bencana = escape($this->input->post('keterangan_bencana', TRUE));
        $penyebab_bencana   = escape($this->input->post('penyebab_bencana', TRUE));
        $latitude           = escape($this->input->post('latitude', TRUE));
        $longitude          = escape($this->input->post('longitude', TRUE));
        $id_regency         = escape($this->input->post('id_regency', TRUE));
        $video_bencana      = escape($this->input->post('video_bencana', TRUE));
        $taksiran_kerugian  = escape($this->input->post('taksiran_kerugian', TRUE));
        // var_dump($_FILES);
        // die;
        //cek data by id

        $Bencana           = $_FILES['nama_file'];
        $Infografis        = $_FILES['nama_file_infografis'];

        $year    = date('Y');
        $month   = date('m');

        $dirname = 'dokumen/bencana/' . $year . '/' . $month . '/';
        if (!is_dir($dirname)) {
            mkdir('./' . $dirname, 0777, TRUE);
        }

        $dirname_infografis = 'dokumen/infografis/' . $year . '/' . $month . '/';
        if (!is_dir($dirname_infografis)) {
            mkdir('./' . $dirname_infografis, 0777, TRUE);
        }

        if ($Bencana != '')
            $fotoBencana       = $this->uploadFileBencana($Bencana, $dirname, $token_bencana, 'nama_file', 'bencana');

        if ($Infografis != '')
            $infografisBencana = $this->uploadFileBencana($Infografis, $dirname_infografis, $token_bencana, 'nama_file_infografis', 'infografis');

        // var_dump($fotoBencana);
        // var_dump($infografisBencana);
        // die;
        //--------------------------- foto bencana -------------------------------//


        $dataBencana = array(
            'token_bencana'      => $token_bencana,
            'tanggal_bencana'    => !empty($tanggal_bencana) ? $tanggal_bencana : '',
            'jam_bencana'        => !empty($jam_bencana) ? $jam_bencana : '',
            'kategori_tanggap'   => !empty($kategori_tanggap) ? $kategori_tanggap : '',
            'id_jenis_bencana'   => !empty($id_jenis_bencana) ? $id_jenis_bencana : '',
            'nama_bencana'       => !empty($nama_bencana) ? $nama_bencana : '',
            'keterangan_bencana' => !empty($keterangan_bencana) ? $keterangan_bencana : '',
            'penyebab_bencana'   => !empty($penyebab_bencana) ? $penyebab_bencana : '',
            'video_bencana'      => !empty($video_bencana) ? $video_bencana : '',
            'taksiran_kerugian'  => !empty($taksiran_kerugian) ? $taksiran_kerugian : 0,
            'latitude'           => $latitude,
            'longitude'          => $longitude,
            'mod_by'             => $create_by,
            'mod_date'           => $create_date,
            'mod_ip'             => $create_ip
        );
        /*query update*/
        $this->db->where('token_bencana ', $token_bencana);
        $this->db->update('ms_bencana', $dataBencana);
        foreach ((array)$id_regency as $key => $id) {
            $token_bencana_detail =  $this->uuid->v4(true);
            /*cek data kontrol*/

            $cek = $this->db->get_where('ms_bencana_detail', array('token_bencana' => $token_bencana, 'id_regency_penerima' => $id));
            if ($cek->num_rows() == 0) {
                $data = array(
                    'token_bencana'        => $token_bencana,
                    'token_bencana_detail' => $token_bencana_detail,
                    'id_regency_penerima'  => $id,
                    'kebutuhan_bencana'    => '-',
                    'id_status'            => 0
                );
                $this->db->insert('ms_bencana_detail', $data);
            }
        }




        return array('response' => 'SUCCESS', 'nama' => $nama_bencana);
    }

    public function getDataUpload($token_bencana)
    {
        $this->db->select(' a.token_bencana, 
                            create_date,
                            a.nama_file,
                            a.nama_file_infografis');
        $this->db->from('ms_bencana a');
        $this->db->where('a.token_bencana', $token_bencana);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->row_array();
        else
            return 0;
    }

    //---------------------------- END FUNGSI MODEL UNTUK DATA KEBENCANAAN -------------------------//

    //---------------------------- FUNGSI MODEL UNTUK KIRIM KEBENCANAAN ----------------------------//

    /* Fungsi untuk update data */
    public function kirimDataBencana()
    {
        $token_bencana = escape($this->input->post('tokenId', TRUE));
        $dataBencana = array(
            'id_status'      => 1
        );
        /*query update*/
        $this->db->where('token_bencana ', $token_bencana);
        $this->db->update('ms_bencana', $dataBencana);

        return array('response' => 'SUCCESS', 'nama' => '');
    }


    //---------------------------- END FUNGSI MODEL UNTUK KIRIM KEBENCANAAN ----------------------------//

    //---------------------------- FUNGSI MODEL UNTUK SHARE PUSDALOPS ----------------------------//

    public function getDataBencanaDetail($token_bencana)
    {
        $this->db->select('	a.id_bencana_detail, 
							a.token_bencana, 
							a.token_bencana_detail, 
							a.id_regency_penerima,
                            c.nm_regency');
        $this->db->from('ms_bencana_detail a');
        $this->db->join('ms_bencana b', 'b.token_bencana = a.token_bencana', 'INNER');
        $this->db->join('wil_regency c', 'c.id_regency = a.id_regency_penerima', 'INNER');
        $this->db->where('a.token_bencana', $token_bencana);
        $this->db->order_by('a.id_bencana_detail DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    /*Fungsi get data edit by id*/
    public function getDataBencanaShare($token_bencana_detail)
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

    /* Fungsi untuk update data */
    public function updateDataShare()
    {
        //get data
        $create_by        = $this->app_loader->current_user();
        $create_date   = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip     = $this->input->ip_address();
        $token_bencana    = escape($this->input->post('tokenId', TRUE));
        $token_bencana_detail    = escape($this->input->post('tokenIdShare', TRUE));
        $id_regency_penerima   = escape($this->input->post('id_regency_penerima', TRUE));
        // print_r($token_bencana_detail);
        // die;
        // var_dump($_FILES);

        $dataShare = array(
            'token_bencana' => !empty($token_bencana) ? $token_bencana : '',
            'id_regency_penerima' => !empty($id_regency_penerima) ? $id_regency_penerima : 0,
            'mod_by'    => $create_by,
            'mod_date'  => $create_date,
            'mod_ip'    => $create_ip
        );

        /*query update*/
        $this->db->where('token_bencana_detail ', $token_bencana_detail);
        $this->db->update('ms_bencana_detail', $dataShare);

        return array('response' => 'SUCCESS', 'nama' => '');
    }

    public function deleteDataPusdalops()
    {
        $token = escape($this->input->post('tokenId', TRUE));
        $this->db->where('token_bencana_detail', $token);
        $this->db->delete('ms_bencana_detail');
        return array('response' => 'SUCCESS', 'nama' => '');
    }

    //---------------------------- END FUNGSI MODEL UNTUK SHARE PUSDALOPS ------------------------//

    //---------------------------- FUNGSI MODEL GET UNTUK UPLOAD MULTI FOTO BENCANA ----------------------------//
    public function getDataBencanaFoto($token_bencana)
    {
        $this->db->select('	a.id_bencana_foto, 
							a.token_bencana, 
							a.judul_foto, 
							a.nama_file, 
							a.create_date, 
							a.token_bencana_foto');
        $this->db->from('ms_bencana_foto a');
        $this->db->join('ms_bencana b', 'b.token_bencana = a.token_bencana', 'INNER');
        $this->db->where('a.token_bencana', $token_bencana);
        $this->db->order_by('a.id_bencana_foto DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    /* Fungsi untuk insert data */
    public function insertDataFotoBencana()
    {
        //get data
        $token_bencana_foto =  $this->uuid->v4(true);
        $create_by          = $this->app_loader->current_account();
        $create_date        = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip          = $this->input->ip_address();
        $token_bencana      = escape($this->input->post('tokenId', TRUE));
        $judul_foto         = escape($this->input->post('judul_foto', TRUE));
        $nama_foto_bencana  = escape($this->input->post('nama_foto_bencana', TRUE));

        $year    = date('Y');
        $month   = date('m');
        $dirname = 'dokumen/bencana/' . $year . '/' . $month . '/';
        if (!is_dir($dirname)) {
            mkdir('./' . $dirname, 0777, TRUE);
        }

        $_FILES['file']['name']     = $_FILES['nama_foto_bencana']['name'];
        $_FILES['file']['type']     = $_FILES['nama_foto_bencana']['type'];
        $_FILES['file']['tmp_name'] = $_FILES['nama_foto_bencana']['tmp_name'];
        $_FILES['file']['error']    = $_FILES['nama_foto_bencana']['error'];
        $_FILES['file']['size']     = $_FILES['nama_foto_bencana']['size'];
        $config = array(
            'upload_path'      => './' . $dirname . '/',
            'allowed_types'    => 'png|jpg|jpeg|pdf',
            'file_name'        => 'file_bencana_' . date('YmdHis', strtotime($create_date)),
            'file_ext_tolower' => TRUE,
            'max_size'         => 5024,
            'max_filename'     => 0,
            'remove_spaces'    => TRUE,
        );
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('file')) {
            $nama_foto_bencana = '';
        } else {
            $upload_data = $this->upload->data();
            $nama_foto_bencana   = $upload_data['file_name'];
        }
        $data = array(
            'token_bencana_foto' => $token_bencana_foto,
            'token_bencana'      => $token_bencana,
            'judul_foto'         => $judul_foto,
            'nama_file'          => $nama_foto_bencana,
            'id_status'          => 1,
            'create_by'          => $create_by,
            'create_date'        => $create_date,
            'create_ip'          => $create_ip,
            'mod_by'             => $create_by,
            'mod_date'           => $create_date,
            'mod_ip'             => $create_ip
        );
        /*query insert*/
        $this->db->insert('ms_bencana_foto', $data);
        return array('response' => 'SUCCESS', 'name' =>  $judul_foto);
    }

    public function getDataMultiUploadFoto($token_bencana_foto)
    {
        $this->db->select(' a.token_bencana_foto, 
                            a.create_date,
                            a.judul_foto,
                            a.nama_file');
        $this->db->from('ms_bencana_foto a');
        $this->db->where('a.token_bencana_foto', $token_bencana_foto);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function deleteDataFotoBencana()
    {
        $token_bencana_foto = escape($this->input->post('tokenId', TRUE));

        $checkFile = $this->getDataMultiUploadFoto($token_bencana_foto);
        // var_dump($checkFile['create_date']);
        // die;
        $file      = $checkFile['nama_file'];
        $year        = substr($checkFile['create_date'], 0, 4);
        $month       = substr($checkFile['create_date'], 5, 2);
        if (($file != "") && file_exists('dokumen/bencana/' . $year . '/' . $month . '/' . $file)) {
            $path = str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']);
            $direktori    = $path . 'dokumen/bencana/' . $year . '/' . $month . '/';
            if (file_exists($direktori . '/' . $file))
                unlink($direktori . '/' . $file);
        }
        $this->db->where('token_bencana_foto', $token_bencana_foto);
        $this->db->delete('ms_bencana_foto');
        return array('response' => 'SUCCESS', 'nama' => '');
    }

    //---------------------------- FUNGSI MODEL GET UNTUK UPLOAD MULTI FOTO BENCANA ----------------------------//

    //---------------------------- FUNGSI MODEL GET UNTUK UPLOAD MULTI VIDEO BENCANA ----------------------------//
    public function getDataBencanavideo($token_bencana)
    {
        $this->db->select('	a.id_bencana_video, 
							a.token_bencana, 
							a.judul_video, 
							a.link_video, 
							a.token_bencana_video');
        $this->db->from('ms_bencana_video a');
        $this->db->join('ms_bencana b', 'b.token_bencana = a.token_bencana', 'INNER');
        $this->db->where('a.token_bencana', $token_bencana);
        $this->db->order_by('a.id_bencana_video DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    /* Fungsi untuk insert data */
    public function insertDataVideoBencana()
    {
        //get data
        $token_bencana_video =  $this->uuid->v4(true);
        $create_by          = $this->app_loader->current_account();
        $create_date        = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
        $create_ip          = $this->input->ip_address();
        $token_bencana      = escape($this->input->post('tokenId', TRUE));
        $judul_video        = escape($this->input->post('judul_video', TRUE));
        $link_video         = escape($this->input->post('link_video', TRUE));
        $data = array(
            'token_bencana_video' => $token_bencana_video,
            'token_bencana'       => $token_bencana,
            'judul_video'         => $judul_video,
            'link_video'          => $link_video,
            'id_status'           => 1,
            'create_by'           => $create_by,
            'create_date'         => $create_date,
            'create_ip'           => $create_ip,
            'mod_by'              => $create_by,
            'mod_date'            => $create_date,
            'mod_ip'              => $create_ip
        );
        /*query insert*/
        $this->db->insert('ms_bencana_video', $data);
        return array('response' => 'SUCCESS', 'name' =>  $judul_video);
    }

    public function deleteDataVideoBencana()
    {
        $token_bencana_video = escape($this->input->post('tokenId', TRUE));
        $this->db->where('token_bencana_video', $token_bencana_video);
        $this->db->delete('ms_bencana_video');
        return array('response' => 'SUCCESS', 'nama' => '');
    }

    //---------------------------- FUNGSI MODEL GET UNTUK UPLOAD MULTI VIDEO BENCANA ----------------------------//

    public function deleteDataBencana()
    {
        $id = escape($this->input->post('tokenId', TRUE));
        $checkFile = $this->getDataUpload($id);

        $file  = $checkFile['nama_file'];
        $year  = substr($checkFile['create_date'], 0, 4);
        $month = substr($checkFile['create_date'], 5, 2);
        if (($file != "") && file_exists('dokumen/bencana/' . $year . '/' . $month . '/' . $file)) {
            $path = str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']);
            $direktori    = $path . 'dokumen/bencana/' . $year . '/' . $month . '/';
            if (file_exists($direktori . '/' . $file))
                unlink($direktori . '/' . $file);
        }

        $file_infografis = $checkFile['nama_file_infografis'];
        if (($file_infografis != "") && file_exists('dokumen/infografis/' . $year . '/' . $month . '/' . $file_infografis)) {
            $path = str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']);
            $direktori    = $path . 'dokumen/infografis/' . $year . '/' . $month . '/';
            if (file_exists($direktori . '/' . $file_infografis))
                unlink($direktori . '/' . $file_infografis);
        }

        // $file_infografis = $checkFile['nama_file_infografis'];

        // $dirnameInfografis = 'dokumen/infografis/' . $year . '/' . $month . '/' . $file_infografis;
        // if (file_exists($dirnameInfografis)) {
        //     unlink($dirnameInfografis);
        // }
        $dataBencana   = $this->getDataDetailBencana($id);
        $nama_bencana  = !empty($dataBencana) ? $dataBencana['nama_bencana'] : '';
        $this->db->where('token_bencana', $id);
        $this->db->delete('ms_bencana');
        $this->deletePusdalops($id);
        $this->deleteVideoMulti($id);
        // $this->deleteFotoBencanaMulti($id);
        return array('response' => 'SUCCESS', 'nama' => $nama_bencana);
    }

    public function deleteFotoBencanaMulti($id)
    {
        // $id = $this->encryption->decrypt(escape($this->input->post('idId', TRUE)));
        $checkFile     = $this->getDataUpload($id);
        //delete data file di table
        foreach ($checkFile as $file) {
            $nama_file     = $file['nama_file'];
            $year  = substr($checkFile['create_date'], 0, 4);
            $month = substr($checkFile['create_date'], 5, 2);
            if (($nama_file != "") && file_exists('dokumen/bencana/' . $year . '/' . $month . '/' . $nama_file)) {
                $path = str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']);
                $direktori    = $path . 'dokumen/bencana/' . $year . '/' . $month . '/';
                if (file_exists($direktori . '/' . $nama_file))
                    unlink($direktori . '/' . $nama_file);
            }
        }

        $this->db->where('token_bencana', $id);
        $this->db->delete('ms_bencana_foto');
    }

    public function deletePusdalops($id)
    {
        $this->getDataPusdalops($id);
        //delete data file di table
        $this->db->where('token_bencana', $id);
        $this->db->delete('ms_bencana_detail');
    }

    public function getDataPusdalops($id)
    {
        $this->db->select('a.token_bencana');
        $this->db->from('ms_bencana_detail a');
        $this->db->join('ms_bencana b', 'b.token_bencana = a.token_bencana', 'INNER');
        $this->db->where('a.token_bencana', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function deleteVideoMulti($id)
    {
        $this->getDataVideoMulti($id);
        //delete data file di table
        $this->db->where('token_bencana', $id);
        $this->db->delete('ms_bencana_video');
    }

    public function getDataVideoMulti($id)
    {
        $this->db->select('a.token_bencana');
        $this->db->from('ms_bencana_video a');
        $this->db->join('ms_bencana b', 'b.token_bencana = a.token_bencana', 'INNER');
        $this->db->where('a.token_bencana', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
}

// This is the end of auth signin model
