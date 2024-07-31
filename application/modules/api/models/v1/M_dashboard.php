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

        $data = [
            'bencana' => [
                'idBencana' => $bencana_terbaru['id_bencana'] ?? null,
                'jenisKejadian' => $bencana_terbaru['nm_bencana'] ?? null,
                'tanggalKejadian' => $tanggalKejadian ?? null,
                'totalWilayahTerdampak' => [
                    "kabkota" => $kabkota_terdampak ? count($kabkota_terdampak) : 0,
                    "kecamatan" => 0,
                    "kelnag" => 0
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
                'longsor' => 0,
                'banjir' => 0,
                'kabakaran' => 0,
                'cuacaEkstrem' => 0,
                'erupsi' => 0,
                'gempa' => 0,
                'banjirBandang' => 0,
                'abrasiPantai' => 0,
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
        
    }
}