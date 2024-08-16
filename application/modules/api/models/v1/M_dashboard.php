<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of bencana model
 *
 * @author Ucupsalah
 */

class M_dashboard extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_data($token = "")
    {
        $data = null;
        $bencana_terbaru = $this->_get_data_bencana_terbaru($token);
        $tanggalKejadian = $bencana_terbaru['tanggal_bencana'] ? tgl_surat($bencana_terbaru['tanggal_bencana']) : null;
        $tanggalKejadian = $bencana_terbaru['jam_bencana'] ? $tanggalKejadian . ' - ' . $bencana_terbaru['jam_bencana'] . ' WIB' : $tanggalKejadian;
        $taksiranKerugian = $bencana_terbaru['taksiran_kerugian'] ? "Rp. " . number_format($bencana_terbaru['taksiran_kerugian'], 0, ',', '.') : null;

        
        $last_update_data = $this->_getLastUpdateData($bencana_terbaru['token_bencana']);
        $jam_update = explode(' ', $last_update_data['waktu_data']);
        $jam_update = $jam_update[1] ? $jam_update[1] : null;
        $jam_update = substr($jam_update, 0, 5) . ' WIB';
        $last_update_data = $last_update_data['waktu_data'] ? tgl_surat($last_update_data['waktu_data']) . ' - ' . $jam_update    : null;

        // get info grafis url
        $raw_created_date = explode(' ', $bencana_terbaru['create_date']);
        $splitted_created_date = explode('-', $raw_created_date[0]);
        $year = $splitted_created_date[0];
        $month = $splitted_created_date[1];
        $infoGrafisUrl = $bencana_terbaru['nama_file_infografis'] ? 
                            base_url('dokumen/infografis/' . $year . '/' . $month . '/' . $bencana_terbaru['nama_file_infografis']) 
                            : null;

        // get data kabkota terdampak
        $kabkota_terdampak = $this->_get_data_kabkota_terdampak($bencana_terbaru['token_bencana']);

        $total_wilayah_terdampak = $this->_get_data_total_wilayah_terdampak($bencana_terbaru['token_bencana']);
        $stats_bencana_tahun_ini = $this->_stats_bencana_tahun_ini();
        
        // get list bencana lainnya
        $list_bencana_lainnya = $this->_get_list_bencana_lainnya();

        $data = [
            'bencana' => [
                'idBencana' => $bencana_terbaru['token_bencana'] ?? null,
                'jenisKejadian' => $bencana_terbaru['nm_bencana'] ?? null,
                'tanggalKejadian' => $tanggalKejadian ?? null,
                'updateData' => $last_update_data ?? null,
                'totalWilayahTerdampak' => [
                    "kabkota" => $kabkota_terdampak ? count($kabkota_terdampak) : 0,
                    "kecamatan" => $total_wilayah_terdampak['kecamatan'] ?? 0,
                    "kelnag" => $total_wilayah_terdampak['kelnag'] ?? 0
                ],
                'taksiranKerugian' => $taksiranKerugian ?? null,
                'totalKorbanTerisolir' => 0,
                'infoGrafisUrl' => $infoGrafisUrl ?? null,
                'lokasiKejadian' => $kabkota_terdampak ?? [],
                'dampakBencana' => [
                    "jumlahKorban" => [
                        "meninggal" => 0,
                        "hilang" => 0,
                        "terluka" => 0,
                        "mengungsi" => 0
                    ],
                    "rumahRusak" => [
                        "rusakRingan" => 0,
                        "rusakSedang" => 0,
                        "rusakBerat" => 0,
                        "totalRusak" => 0
                    ],
                    "fasilitasRusak" => [
                        "sekolah" => 0,
                        "rumahIbadah" => 0,
                        "lainnya" => 0,
                        "totalRusak" => 0
                    ]
                ]
            ],
            'totalBencanaTahunIni' => [
                'longsor' => $stats_bencana_tahun_ini['1'] ?? 0,
                'banjir' => $stats_bencana_tahun_ini['3'] ?? 0,
                'kabakaran' => $stats_bencana_tahun_ini['5'] ?? 0,
                'cuacaEkstrem' => $stats_bencana_tahun_ini['6'] ?? 0,
                'erupsi' => $stats_bencana_tahun_ini['7'] ?? 0,
                'gempa' => $stats_bencana_tahun_ini['2'] ?? 0,
                'banjirBandang' => $stats_bencana_tahun_ini['4'] ?? 0,
                'abrasiPantai' => $stats_bencana_tahun_ini['8'] ?? 0,
            ],
            "optionBencanaMasaTanggap" => $list_bencana_lainnya ?? []
        ];
        return $data;
    }

    public function get_fotovideo($token)
    {
        //load data foto
        $last_update_foto = "";
        $this->db->where('token_bencana', $token);
        $this->db->from('ms_bencana_foto');
        $this->db->order_by('create_date', 'desc');
        $this->db->select('nama_file,judul_foto,create_date');
        $fotoRaw = $this->db->get()->result_array();
        $foto = [];
        if(count($fotoRaw) > 0){
            $last_update_foto = $fotoRaw[0]['create_date'];
            foreach($fotoRaw as $row){

                $raw_created_date = explode(' ', $row['create_date']);
                $splitted_created_date = explode('-', $raw_created_date[0]);
                $year = $splitted_created_date[0];
                $month = $splitted_created_date[1];

                $foto[] = [
                    "url" => base_url('dokumen/foto/' . $year . '/' . $month . '/' . $row['nama_file']),
                    "keterangan" => $row['judul_foto']
                ];
            }
        }

        //load data video
        $last_update_video = "";
        $this->db->where('token_bencana', $token);
        $this->db->from('ms_bencana_video');
        $this->db->order_by('create_date', 'desc');
        $this->db->select('link_video,judul_video,create_date');
        $videoRaw = $this->db->get()->result_array();
        $video = [];
        if(count($videoRaw) > 0){
            $last_update_video = $videoRaw[0]['create_date'];
            foreach($videoRaw as $row){
                $video[] = [
                    "url" => $row['link_video'],
                    "keterangan" => $row['judul_video']
                ];
            }
        }




        return [
            "updatedAt" => $last_update_foto < $last_update_video ? $last_update_foto : $last_update_video,
            "foto" => $foto,
            "video" => $video
        ];
    }

    private function _getLastUpdateData($token)
    {
        $this->db->select('a.waktu_data');
        $this->db->where('b.token_bencana', $token);
        $this->db->from('ms_bencana_korban a');
        $this->db->join('ms_bencana_detail b', 'b.token_bencana_detail = a.token_bencana_detail', 'INNER');
        $this->db->order_by('a.waktu_data', 'desc');
        $this->db->limit(1);
        $raw = $this->db->get()->row_array();
        return $raw;
    }

    private function _get_list_bencana_lainnya()
    {
        $this->db->select('a.token_bencana as id, b.nm_bencana as nama');
        $this->db->from('ms_bencana a');
        $this->db->join('cx_jenis_bencana b', 'b.id_jenis_bencana = a.id_jenis_bencana');
        $this->db->where('a.kategori_tanggap', 1);
        // $this->db->where('a.token_bencana !=', $token_bencana);
        $this->db->order_by('a.tanggal_bencana', 'desc');
        $raw = $this->db->get()->result_array();
        return $raw;
    }

    private function _get_data_bencana_terbaru($token = "")
    {
        if($token != ""){
            $this->db->where('a.token_bencana', $token);
        }
        $this->db->select('a.*, b.nm_bencana');
        $this->db->from('ms_bencana a');
        $this->db->join('cx_jenis_bencana b', 'b.id_jenis_bencana = a.id_jenis_bencana');
        $this->db->where('a.kategori_tanggap', 1);
        $this->db->where('a.id_status', 1);
        $this->db->order_by('a.tanggal_bencana', 'desc');
        $this->db->limit(1);
        $raw = $this->db->get()->row_array();
        return $raw;
    }

    private function _get_data_kabkota_terdampak($token_bencana)
    {
        $this->db->where('a.token_bencana', $token_bencana);
        $this->db->from('ms_bencana_detail a');
        $this->db->select('a.id_regency_penerima as id, b.nm_regency as nama');
        $this->db->join('wil_regency b', 'b.id_regency = a.id_regency_penerima', 'INNER');
        $raw = $this->db->get()->result_array();
        return $raw;
    }
    private function _get_data_total_wilayah_terdampak($token_bencana)
    {
        $data = [];
        $this->db->where('a.token_bencana', $token_bencana);
        $this->db->from('ms_bencana_detail a');
        $this->db->join('ms_bencana_korban b', 'b.token_bencana_detail = a.token_bencana_detail', 'INNER');
        $this->db->join('wil_village c', 'c.id_village = b.wil_village', 'INNER');
        $this->db->join('wil_district d', 'd.id_district =  SUBSTRING(b.wil_village, 1, 8)', 'INNER');
        $this->db->select('b.wil_village as kode_kelnag, c.name as kelnag,
                            SUBSTRING(b.wil_village, 1, 8) as kode_kecamatan, d.name as kecamatan');
        $this->db->group_by('b.wil_village, kelnag, kecamatan');
        $this->db->order_by('b.wil_village', 'ASC');
        $raw = $this->db->get()->result_array();
        if(count($raw) > 0){
            $index = -1;
            $kec = "";
            foreach($raw as $row){
                if($kec != $row['kecamatan']){
                    $index++;
                    $kec = $row['kecamatan'];
                    $data[$index] = [
                        "kode_kecamatan" => $row['kode_kecamatan'],
                        "kecamatan" => $row['kecamatan'],
                        "data_kelnag" => [
                            [
                                "kode_kelnag" => $row['kode_kelnag'],
                                "kelnag" => $row['kelnag']
                            ]
                        ]
                    ];
                }
                else{
                    $data[$index]['data_kelnag'][] = [
                        "kode_kelnag" => $row['kode_kelnag'],
                        "kelnag" => $row['kelnag']
                    ];
                }
            }
        }
        $kec_kelnag = $this->_hitung_kec_kelnag($data);
        return $kec_kelnag;
    }

    private function _hitung_kec_kelnag($data)
    {
        $kec = 0;
        $kelnag = 0;
        foreach($data as $row){
            $kec = $kec + 1;
            foreach($row['data_kelnag'] as $item){
                $kelnag = $kelnag + 1;
            }
        }
        return [
            "kecamatan" => $kec,
            "kelnag" => $kelnag
        ];
    }
    private function _stats_bencana_tahun_ini()
    {
        $data = [];
        $this->db->select('a.id_jenis_bencana, a.nm_bencana, count(a.id_jenis_bencana) as total');
        $this->db->from('cx_jenis_bencana a');
        $this->db->join('ms_bencana b','b.id_jenis_bencana = a.id_jenis_bencana','left');
        $this->db->where("date_part('year', b.tanggal_bencana) = " . date('Y'));
        $this->db->where("b.id_status", 1);
        $this->db->group_by('a.id_jenis_bencana, a.nm_bencana');
        $raw = $this->db->get()->result_array();
        if(count($raw) > 0){
            foreach($raw as $row){
                $data[$row['id_jenis_bencana']] = (int) $row['total'];
            }
        }
        return $data;
    }

    public function get_dampak_bencana($token_bencana)
    {
        $data = $this->_get_data_dampak_bencana($token_bencana);
        return $data;
    }

    private function _get_data_dampak_bencana($token)
    {
        $batas_waktu = 60 * 5; // 5 menit

        $this->db->order_by('timestamps', 'desc');
        $this->db->where('token_bencana', $token);
        $this->db->from('log_dampak_bencana');
        $this->db->limit(1);
        $raw = $this->db->get()->row_array();
        if(isset($raw['data'])){
            $tgl_data = new DateTime($raw['timestamps']);
            $current_time = new DateTime();
            $elapsed_time = get_time_difference_in_seconds($tgl_data, $current_time);
            if($elapsed_time < $batas_waktu){
                $data = json_decode($raw['data'], true);
            }
            else{
                $data = $this->_create_stat_dampak_bencana($token);
                $create_date = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);
    
                $create['token_bencana'] = $token;
                $create['data'] = json_encode($data, JSON_PRETTY_PRINT);
                $create['timestamps'] = $create_date;
    
                $this->db->insert('log_dampak_bencana', $create);
            }
        }
        else{
            $data = $this->_create_stat_dampak_bencana($token);
            $create_date = gmdate('Y-m-d H:i:s', time() + 60 * 60 * 7);

            $create['token_bencana'] = $token;
            $create['data'] = json_encode($data, JSON_PRETTY_PRINT);
            $create['timestamps'] = $create_date;

            $this->db->insert('log_dampak_bencana', $create);
        }
        return $data;
    }

    private function _create_stat_dampak_bencana($token)
    {
        $wilayah_terdampak = $this->_get_wilayah_terdampak($token);
        $stat_total = [];
        if(count($wilayah_terdampak) > 0){
            $korban_total = [];
            $kerusakan_total = [];
            $ternak_total = [];
            $i_total = 0;
            foreach($wilayah_terdampak as $kd_kabkota => $kabkota){
                $korban_kabkota = [];
                $kerusakan_kabkota = [];
                $ternak_kabkota = [];
                $i_kabkota = 0;
                foreach($kabkota['data_kecamatan'] as $kd_kecamatan => $kecamatan){
                    $korban_kec = [];
                    $kerusakan_kec = [];
                    $ternak_kec = [];
                    $i_kec = 0;
                    foreach($kecamatan['data_kelnag'] as $kd_kelnag => $kelnag){

                        // get data korban
                        $data_korban = $this->_getDataKorbanJiwa($token, $kd_kelnag);
                        $wilayah_terdampak[$kd_kabkota]['data_kecamatan'][$kd_kecamatan]['data_kelnag'][$kd_kelnag]['data_korban'] = $data_korban;

                        // get data kerusakan
                        $data_kerusakan = $this->_getDataKerusakan($token, $kd_kelnag);
                        $wilayah_terdampak[$kd_kabkota]['data_kecamatan'][$kd_kecamatan]['data_kelnag'][$kd_kelnag]['data_kerusakan'] = $data_kerusakan;

                        // get data ternak terdampak benana
                        $data_ternak = $this->_getDataTernak($token, $kd_kelnag);
                        $wilayah_terdampak[$kd_kabkota]['data_kecamatan'][$kd_kecamatan]['data_kelnag'][$kd_kelnag]['data_ternak'] = $data_ternak;

                        if($i_kec == 0){
                            $korban_kec = $data_korban;
                            $kerusakan_kec = $data_kerusakan;
                            $ternak_kec = $data_ternak;
                        }
                        else{
                            if(count($data_korban) > 0){ $korban_kec = $data_korban; }
                            if(count($data_kerusakan) > 0){ $kerusakan_kec = $data_kerusakan; }
                            if(count($data_ternak) > 0){ $ternak_kec = $data_ternak; }

                            // hitung akumulasi stat dampak bencana tingkat kecamatan
                            $korban_kec = $this->_sum_data_korban($korban_kec, $data_korban);
                            $kerusakan_kec = $this->_sum_data_kerusakan($kerusakan_kec, $data_kerusakan);
                            $ternak_kec = $this->_sum_data_ternak($ternak_kec, $data_ternak);
                        }
                        $i_kec++;
                    }
                    $wilayah_terdampak[$kd_kabkota]['data_kecamatan'][$kd_kecamatan]['data_korban'] = $korban_kec;
                    $wilayah_terdampak[$kd_kabkota]['data_kecamatan'][$kd_kecamatan]['data_kerusakan'] = $kerusakan_kec;
                    $wilayah_terdampak[$kd_kabkota]['data_kecamatan'][$kd_kecamatan]['data_ternak'] = $ternak_kec;
                }
                if($i_kabkota == 0){
                    $korban_kabkota = $korban_kec;
                    $kerusakan_kabkota = $kerusakan_kec;
                    $ternak_kabkota = $ternak_kec;
                }
                else{
                    if(count($korban_kec) > 0){ $korban_kabkota = $korban_kec; }
                    if(count($kerusakan_kec) > 0){ $kerusakan_kabkota = $kerusakan_kec; }
                    if(count($ternak_kec) > 0){ $ternak_kabkota = $ternak_kec; }

                    // hitung akumulasi stat dampak bencana tingkat kabkota
                    $korban_kabkota = $this->_sum_data_korban($korban_kabkota, $korban_kec);
                    $kerusakan_kabkota = $this->_sum_data_kerusakan($kerusakan_kabkota, $kerusakan_kec);
                    $ternak_kabkota = $this->_sum_data_ternak($ternak_kabkota, $ternak_kec);
                }
                $i_kabkota++;
                $wilayah_terdampak[$kd_kabkota]['data_korban'] = $korban_kabkota;
                $wilayah_terdampak[$kd_kabkota]['data_kerusakan'] = $kerusakan_kabkota;
                $wilayah_terdampak[$kd_kabkota]['data_ternak'] = $ternak_kabkota;
                
                if($i_total == 0){
                    $korban_total = $korban_kabkota;
                    $kerusakan_total = $kerusakan_kabkota;
                    $ternak_total = $ternak_kabkota;
                }
                else{
                    $korban_total = $this->_sum_data_korban($korban_total, $korban_kabkota);
                    $kerusakan_total = $this->_sum_data_kerusakan($kerusakan_total, $kerusakan_kabkota);
                    $ternak_total = $this->_sum_data_ternak($ternak_total, $ternak_kabkota);
                }
                $i_total++;
            }
            $total_stat['data_korban'] = $korban_total;
            $total_stat['data_kerusakan'] = $kerusakan_total;
            $total_stat['data_ternak'] = $ternak_total;
        }
        return [
            "wilayah_terdampak" => $wilayah_terdampak,
            "stat_total" => $total_stat
        ];
    }

    private function _get_wilayah_terdampak($token_bencana)
    {
        $data = [];
        $this->db->where('a.token_bencana', $token_bencana);
        $this->db->from('ms_bencana_detail a');
        $this->db->join('ms_bencana_korban b', 'b.token_bencana_detail = a.token_bencana_detail', 'INNER');
        $this->db->join('wil_village c', 'c.id_village = b.wil_village', 'INNER');
        $this->db->join('wil_district d', 'd.id_district =  SUBSTRING(b.wil_village, 1, 8)', 'INNER');
        $this->db->join('wil_regency e', 'e.id_regency =  SUBSTRING(b.wil_village, 1, 5)', 'INNER');
        $this->db->select('b.wil_village as kode_kelnag, c.name as kelnag,
                            SUBSTRING(b.wil_village, 1, 8) as kode_kecamatan, d.name as kecamatan,
                            SUBSTRING(b.wil_village, 1, 5) as kode_kabkota, e.nm_regency as kabkota');
        $this->db->group_by('b.wil_village, kelnag, kecamatan, kabkota');
        $this->db->order_by('b.wil_village', 'ASC');
        $raw = $this->db->get()->result_array();
        if(count($raw) > 0){
            $kabkota = "";
            $kec = "";
            foreach($raw as $row){
                if($kabkota != $row['kabkota']){
                    $kabkota = $row['kabkota'];
                    $data[$row['kode_kabkota']] = [
                        "kabkota" => $row['kabkota']
                    ];
                }
                if($kec != $row['kecamatan']){
                    $kec = $row['kecamatan'];
                    $data[$row['kode_kabkota']]['data_kecamatan'][$row['kode_kecamatan']] = [
                        "kecamatan" => $row['kecamatan']
                    ];
                }
                $data[$row['kode_kabkota']]['data_kecamatan'][$row['kode_kecamatan']]['data_kelnag'][$row['kode_kelnag']] = [
                    "kelnag" => $row['kelnag']
                ];
            }
        }
        return $data;   
    }
    private function _getDataKorbanJiwa($token = "", $wil_village = "")
    {
        $dataKorbanJiwa = [];
        $this->db->where('a.wil_village', $wil_village);
        $this->db->where('c.token_bencana', $token);
        $this->db->select('a.wil_village,
        a.waktu_data,
        a.create_date,
        count(a.id) as jumlah_data,
        b.name as nm_village');
        $this->db->from('ms_bencana_korban a');
        $this->db->join('wil_village b', 'b.id_village = a.wil_village', 'INNER');
        $this->db->join('ms_bencana_detail c', 'c.token_bencana_detail = a.token_bencana_detail', 'INNER');
        $this->db->group_by('a.wil_village, b.name, a.waktu_data, a.create_date');
        $this->db->order_by('a.waktu_data DESC, a.create_date DESC');
        $this->db->limit(1);
        $latest_data = $this->db->get()->row_array();

        if ($latest_data) {

            $this->db->select("a.id_jiwa, a.id_kondisi, b.nm_jiwa,c.nm_kondisi, a.jumlah_korban");
            $this->db->from('ms_bencana_korban a');
            $this->db->join('cx_korban_jiwa b', 'b.id = a.id_jiwa', 'INNER');
            $this->db->join('cx_korban_kondisi c', 'c.id = a.id_kondisi', 'INNER');
            $this->db->where('a.wil_village', $latest_data['wil_village']);
            $this->db->where('a.waktu_data', $latest_data['waktu_data']);
            $this->db->where('a.create_date', $latest_data['create_date']);
            $this->db->order_by('a.id ASC');
            $this->db->limit($latest_data['jumlah_data']);
            $dataKorbanJiwa = $this->db->get()->result_array();
        }

        $tJiwa_1 = 0;
        $tJiwa_2 = 0;
        $tJiwa_3 = 0;
        $tJiwa_4 = 0;
        $tJiwa_5 = 0;
        $tJiwa_6 = 0;
        $tJiwa_7 = 0;

        $tKondisi_1 = 0;
        $tKondisi_2 = 0;
        $tKondisi_3 = 0;
        $tKondisi_4 = 0;
        $tKondisi_5 = 0;

        foreach($dataKorbanJiwa as $row){
            if($row['id_kondisi'] == 1){
                $tKondisi_1 = $tKondisi_1 + $row['jumlah_korban'];
            }
            if($row['id_kondisi'] == 2){
                $tKondisi_2 = $tKondisi_2 + $row['jumlah_korban'];
            }
            if($row['id_kondisi'] == 3){
                $tKondisi_3 = $tKondisi_3 + $row['jumlah_korban'];
            }
            if($row['id_kondisi'] == 4){
                $tKondisi_4 = $tKondisi_4 + $row['jumlah_korban'];
            }
            if($row['id_kondisi'] == 5){
                $tKondisi_5 = $tKondisi_5 + $row['jumlah_korban'];
            }

            if($row['id_jiwa'] == 1){
                $tJiwa_1 = $tJiwa_1 + $row['jumlah_korban'];
            }
            if($row['id_jiwa'] == 2){
                $tJiwa_2 = $tJiwa_2 + $row['jumlah_korban'];
            }
            if($row['id_jiwa'] == 3){
                $tJiwa_3 = $tJiwa_3 + $row['jumlah_korban'];
            }
            if($row['id_jiwa'] == 4){
                $tJiwa_4 = $tJiwa_4 + $row['jumlah_korban'];
            }
            if($row['id_jiwa'] == 5){
                $tJiwa_5 = $tJiwa_5 + $row['jumlah_korban'];
            }
            if($row['id_jiwa'] == 6){
                $tJiwa_6 = $tJiwa_6 + $row['jumlah_korban'];
            }
            if($row['id_jiwa'] == 7){
                $tJiwa_7 = $tJiwa_7 + $row['jumlah_korban'];
            }
        }

        $total = [
            [
                'id_kondisi' => "1",
                'total' => (string) $tKondisi_1
            ],
            [
                'id_kondisi' => "2",
                'total' => (string) $tKondisi_2
            ],
            [
                'id_kondisi' => "3",
                'total' => (string) $tKondisi_3
            ],
            [
                'id_kondisi' => "4",
                'total' => (string) $tKondisi_4
            ],
            [
                'id_kondisi' => "5",
                'total' => (string) $tKondisi_5
            ],
            [
                'id_jiwa' => "1",
                'total' => (string) $tJiwa_1
            ],
            [
                'id_jiwa' => "2",
                'total' => (string) $tJiwa_2
            ],
            [
                'id_jiwa' => "3",
                'total' => (string) $tJiwa_3
            ],
            [
                'id_jiwa' => "4",
                'total' => (string) $tJiwa_4
            ],
            [
                'id_jiwa' => "5",
                'total' => (string) $tJiwa_5
            ],
            [
                'id_jiwa' => "6",
                'total' => (string) $tJiwa_6
            ],
            [
                'id_jiwa' => "7",
                'total' => (string) $tJiwa_7
            ]
        ];

        return [
            "data_korban_jiwa" => $dataKorbanJiwa,
            "total" => $total
        ];
    }

    private function _getDataKerusakan($token = "", $wil_village = "")
    {
        $result = [];
        $this->db->where('a.wil_village', $wil_village);
        $this->db->where('c.token_bencana', $token);
        $this->db->select('a.wil_village,
        a.waktu_data,
        a.create_date,
        count(a.id) as jumlah_data,
        b.name as nm_village');
        $this->db->from('ms_bencana_kerusakan a');
        $this->db->join('wil_village b', 'b.id_village = a.wil_village', 'INNER');
        $this->db->join('ms_bencana_detail c', 'c.token_bencana_detail = a.token_bencana_detail', 'INNER');
        $this->db->group_by('a.wil_village, b.name, a.waktu_data, a.create_date');
        $this->db->order_by('a.waktu_data DESC, a.create_date DESC');
        $this->db->limit(1);
        $latest_data = $this->db->get()->row_array();

        if ($latest_data) {

            $this->db->select('a.id_kerusakan, b.nm_jenis_sarana, a.rusak_ringan, a.rusak_sedang, a.rusak_berat');
            $this->db->from('ms_bencana_kerusakan a');
            $this->db->join('cx_jenis_sarana b', 'b.id = a.id_kerusakan', 'INNER');
            $this->db->where('a.wil_village', $latest_data['wil_village']);
            $this->db->where('a.waktu_data', $latest_data['waktu_data']);
            $this->db->where('a.create_date', $latest_data['create_date']);
            $this->db->order_by('a.id ASC');
            $this->db->limit($latest_data['jumlah_data']);
            $dataKerusakan = $this->db->get()->result_array();

            $this->db->select('a.id_kerusakan, b.nm_jenis_sarana, a.jml_terendam as jml');
            $this->db->from('ms_bencana_terendam a');
            $this->db->join('cx_jenis_sarana b', 'b.id = a.id_kerusakan', 'INNER');
            $this->db->where('a.wil_village', $latest_data['wil_village']);
            $this->db->where('a.waktu_data', $latest_data['waktu_data']);
            $this->db->where('a.create_date', $latest_data['create_date']);
            $this->db->order_by('a.id ASC');
            $this->db->limit($latest_data['jumlah_data']);
            $dataTerendam = $this->db->get()->result_array();

            $this->db->select('a.id_kerusakan, b.nm_jenis_sarana, a.jumlah_sarana as jml');
            $this->db->from('ms_bencana_sarana_lain a');
            $this->db->join('cx_jenis_sarana b', 'b.id = a.id_kerusakan', 'INNER');
            $this->db->where('a.wil_village', $latest_data['wil_village']);
            $this->db->where('a.waktu_data', $latest_data['waktu_data']);
            $this->db->where('a.create_date', $latest_data['create_date']);
            $this->db->order_by('a.id ASC');
            $this->db->limit($latest_data['jumlah_data']);
            $dataSaranaLainnya = $this->db->get()->result_array();

            $result = array(
                'kerusakan' => $dataKerusakan,
                'terendam' => $dataTerendam,
                'sarana_lainnya' => $dataSaranaLainnya
            );
        }
        return $result;
    }
    private function _getDataTernak($token = "", $wil_village = "")
    {
        $result = [];
        $this->db->where('a.wil_village', $wil_village);
        $this->db->where('c.token_bencana', $token);
        $this->db->select('a.wil_village,
                            a.waktu_data,
                            a.create_date,
                            count(a.id) as jumlah_data,
                            b.name as nm_village');
        $this->db->from('ms_bencana_ternak a');
        $this->db->join('wil_village b', 'b.id_village = a.wil_village', 'INNER');
        $this->db->join('ms_bencana_detail c', 'c.token_bencana_detail = a.token_bencana_detail', 'INNER');
        $this->db->group_by('a.wil_village, b.name, a.waktu_data, a.create_date');
        $this->db->order_by('a.waktu_data DESC, a.create_date DESC');
        $this->db->limit(1);
        $latest_data = $this->db->get()->row_array();

        if ($latest_data) {

            $this->db->select('a.id_jenis_ternak as id_ternak, b.nm_jenis_ternak as ternak, a.jumlah_ternak as jml');
            $this->db->from('ms_bencana_ternak a');
            $this->db->join('cx_jenis_ternak b', 'b.id = a.id_jenis_ternak', 'INNER');
            $this->db->where('a.wil_village', $latest_data['wil_village']);
            $this->db->where('a.waktu_data', $latest_data['waktu_data']);
            $this->db->where('a.create_date', $latest_data['create_date']);
            $this->db->order_by('a.id ASC');
            $this->db->limit($latest_data['jumlah_data']);
            $dataTernak = $this->db->get()->result_array();

            $result = array(
                'ternak' => $dataTernak
            );
        }
        return $result;
    }

    private function _sum_data_korban($nowData, $sumData)
    {
        if(count($sumData['data_korban_jiwa']) > 0 AND count($nowData['data_korban_jiwa']) > 0){
            foreach($sumData['data_korban_jiwa'] as $key => $row){
                $nowData['data_korban_jiwa'][$key]['jumlah_korban'] = 
                    (string) ($nowData['data_korban_jiwa'][$key]['jumlah_korban'] + $row['jumlah_korban']);
            }

            foreach($sumData['total'] as $key => $row){
                $nowData['total'][$key]['total'] = 
                    (string) ($nowData['total'][$key]['total'] + $row['total']);
            }
        }

        return $nowData;
    }
    private function _sum_data_kerusakan($nowData, $sumData)
    {
        if(isset($sumData['kerusakan']) AND count($nowData) > 0){
            foreach($sumData['kerusakan'] as $key => $row){
                $nowData['kerusakan'][$key]['rusak_ringan'] = 
                    (string) ($nowData['kerusakan'][$key]['rusak_ringan'] + $row['rusak_ringan']);
                $nowData['kerusakan'][$key]['rusak_sedang'] = 
                    (string) ($nowData['kerusakan'][$key]['rusak_sedang'] + $row['rusak_sedang']);
                $nowData['kerusakan'][$key]['rusak_berat'] = 
                (string) ($nowData['kerusakan'][$key]['rusak_berat'] + $row['rusak_berat']);
            }
        }
        if(isset($sumData['terendam']) AND count($nowData) > 0){
            foreach($sumData['terendam'] as $key => $row){
                $nowData['terendam'][$key]['jml'] = 
                (string) ($nowData['terendam'][$key]['jml'] + $row['jml']);
            }
        }
        if(isset($sumData['sarana_lainnya']) AND count($nowData) > 0){
            foreach($sumData['sarana_lainnya'] as $key => $row){
                $nowData['sarana_lainnya'][$key]['jml'] = 
                    (string) ($nowData['sarana_lainnya'][$key]['jml'] + $row['jml']);
            }
        }
        return $nowData;
    }
    private function _sum_data_ternak($nowData, $sumData)
    {
        if(isset($sumData['ternak']) AND count($nowData) > 0){
            foreach($sumData['ternak'] as $key => $row){
                $nowData['ternak'][$key]['jml'] = 
                (string) ($nowData['ternak'][$key]['jml'] + $row['jml']);
            }
        }
        return $nowData;
    }
}