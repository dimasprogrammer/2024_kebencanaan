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

    public function get_data()
    {
        $data = null;
        $bencana_terbaru = $this->_get_data_bencana_terbaru();
        $tanggalKejadian = $bencana_terbaru['tanggal_bencana'] ? tgl_surat($bencana_terbaru['tanggal_bencana']) : null;
        $tanggalKejadian = $bencana_terbaru['jam_bencana'] ? $tanggalKejadian . ' - ' . $bencana_terbaru['jam_bencana'] . ' WIB' : $tanggalKejadian;
        $taksiranKerugian = $bencana_terbaru['taksiran_kerugian'] ? "Rp. " . number_format($bencana_terbaru['taksiran_kerugian'], 0, ',', '.') : null;

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
        
        $data = [
            'bencana' => [
                'idBencana' => $bencana_terbaru['token_bencana'] ?? null,
                'jenisKejadian' => $bencana_terbaru['nm_bencana'] ?? null,
                'tanggalKejadian' => $tanggalKejadian ?? null,
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
            "optionBencanaMasaTanggap" =>[]
        ];
        return $data;
    }

    private function _get_data_bencana_terbaru()
    {
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
        $wilayah_terdampak = $this->_get_wilayah_terdampak($token_bencana);
        $kelnag_terdampak = [];
        if(count($wilayah_terdampak) > 0){
           foreach($wilayah_terdampak as $kd_kabkota => $kabkota){
                foreach($kabkota['data_kecamatan'] as $kd_kecamatan => $kecamatan){
                    foreach($kecamatan['data_kelnag'] as $kd_kelnag => $kelnag){
                        $data_korban = $this->_getDataKorbanJiwa($token_bencana, $kd_kelnag);
                        $wilayah_terdampak[$kd_kabkota]['data_kecamatan'][$kd_kecamatan]['data_kelnag'][$kd_kelnag]['data_korban'] = $data_korban;
                    }
                }
           }
        }
        return $wilayah_terdampak;
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
}