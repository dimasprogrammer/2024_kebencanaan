<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of bencana_daerah class
 *
 * @author Ucupsalah
 */

class Dashboard extends SLP_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('v1/m_dashboard' => 'm_dashboard'));
    }

    public function apiDocs()
    {
        $this->load->view('v1/documentation');
    }

    public function get_data()
    {
        $data = $this->m_dashboard->get_data();
        $result['success'] = true;
        $result['kode'] = 200;
        $result['message'] = 'Data Utama Dashboard Bencana';
        $result['data'] = $data;
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

    public function getRawData($token)
    {
        $data = $this->m_dashboard->get_dampak_bencana($token);
        $result['success'] = true;
        $result['kode'] = 200;
        $result['message'] = 'Data Mentah Dampak Bencana';
        $result['data'] = $data;
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

    public function get_dampak_bencana($token)
    {
        $data = $this->m_dashboard->get_dampak_bencana($token);
        $dampakBencana = [];
        if(isset($data['stat_total'])){
            $dampakBencana = $this->_create_formatDampakBencana($data['stat_total']);
        }

        $result['success'] = true;
        $result['kode'] = 200;
        $result['message'] = 'Data Dampak Bencana';
        $result['data'] = $dampakBencana;
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

    public function get_detail_bencana($token)
    {
        $data_detail1 = $this->m_dashboard->get_data($token);
        $data_detail2 = $this->m_dashboard->get_dampak_bencana($token);
        $detailBencana = $this->_detail_bencana_formatter($data_detail2);
        $bencana = [
            'idBencana' => $data_detail1['bencana']['idBencana'],
            'jenisKejadian' => $data_detail1['bencana']['jenisKejadian'],
            'namaBencana' => $data_detail1['bencana']['namaBencana'],
            'tanggalKejadian' => $data_detail1['bencana']['tanggalKejadian'],
            'updateData' => $data_detail1['bencana']['updateData'],
            'infoGrafisUrl' => $data_detail1['bencana']['infoGrafisUrl'],
            'lokasiKejadian' => $data_detail1['bencana']['lokasiKejadian']
        ];

        $detailBencana[0]['data']['taksiranKerugian'] = $data_detail1['bencana']['taksiranKerugian'];

        $result = [
            'success' => true,
            'kode' => 200,
            'message' => 'Data Detail Bencana',
            'data' => [
                'bencana' => $bencana,
                'dataDetail' => $detailBencana
            ]
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

    public function get_fotovideo($token)
    {
        $data = $this->m_dashboard->get_fotovideo($token);
        $result['success'] = true;
        $result['kode'] = 200;
        $result['message'] = 'Data Foto Video';
        $result['data'] = $data;
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }


    /**
     * ======================================================================================================================================================================================================
     * 
     * PRIVATE FUNCTION
     * 
     * ======================================================================================================================================================================================================
     */



    private function _detail_bencana_formatter($data)
    {
        $dataDetailBencana = [];
        $detailJumlahKorban = [];
        $detailKerusakan = [];
        $detailTernak = [];

        foreach($data['wilayah_terdampak'] as $key => $value){
            $detailJumlahKorban[] = [
                "namaKabkota" => $value['kabkota'],
                "data" => $this->_create_formatDetailJumlahKorban($value['data_korban']['data_korban_jiwa'])
            ];
            $detailKerusakan[] = [
                "namaKabkota" => $value['kabkota'],
                "data" => $this->_create_formatDetailKerusakan($value['data_kerusakan'])
            ];
            $detailTernak[] = [
                "namaKabkota" => $value['kabkota'],
                "data" => $this->_create_formatDetailTernak($value['data_ternak'])
            ];
        }

        $totalWilayahTerdampakKeseluruhan = $this->_hitung_total_wilayah_terdampak($data['wilayah_terdampak']);

        $keseluruhan = [
            "kode" => "0",
            "ket" => "Data Keseluruhan",
            "data" => [
                "taksiranKerugian" => "0",
                "totalKorbanTerisolir" => "0",
                "totalWilayahTerdampak" => [
                    "kabkota" => $totalWilayahTerdampakKeseluruhan['kabkota'] ?? 0,
                    "kecamatan" => $totalWilayahTerdampakKeseluruhan['kecamatan'] ?? 0,
                    "kelnag" => $totalWilayahTerdampakKeseluruhan['kelnag'] ?? 0
                ]
            ],
            "dampakBencana" => $this->_create_formatDampakBencana($data['stat_total']),
            "detailJumlahKorban" => $detailJumlahKorban,
            "detailKerusakan" => $detailKerusakan,
            "detailTernak" => $detailTernak
        ];

        $dataDetailBencana[] = $keseluruhan;

        foreach($data['wilayah_terdampak'] as $key => $value){
            $detailJumlahKorban = [];
            $detailKerusakan = [];
            $detailTernak = [];

            foreach($value['data_kecamatan'] as $index => $item){
                $detailJumlahKorban[] = [
                    "namaKecamatan" => $item['kecamatan'],
                    "data" => $this->_create_formatDetailJumlahKorban($item['data_korban']['data_korban_jiwa'])
                ];
                $detailKerusakan[] = [
                    "namaKecamatan" => $item['kecamatan'],
                    "data" => $this->_create_formatDetailKerusakan($item['data_kerusakan'])
                ];
                $detailTernak[] = [
                    "namaKecamatan" => $item['kecamatan'],
                    "data" => $this->_create_formatDetailTernak($value['data_ternak'])
                ];
            }
            $totalWilayahTerdampak = $this->_hitung_total_wilayah_terdampak($value['data_kecamatan']);
            $dataDetailBencana[] = [
                "kode" => $key,
                "ket" => $value['kabkota'],
                "data" => [
                    "taksiranKerugian" => "0",
                    "totalKorbanTerisolir" => "0",
                    "totalWilayahTerdampak" => [
                        "kecamatan" => $totalWilayahTerdampak['kecamatan'],
                        "kelnag" => $totalWilayahTerdampak['kelnag']
                    ]
                ],
                "dampakBencana" => $this->_create_formatDampakBencana($value),
                "detailJumlahKorban" => $detailJumlahKorban,
                "detailKerusakan" => $detailKerusakan,
                "detailTernak" => $detailTernak
            ];
        }

        return $dataDetailBencana;
    }

    private function _create_formatDetailKerusakan($data)
    {
        $detailKerusakan = [];
        // kode fasilitas rusak
        $fasilitasRusak = [
            "1" => "rumahRusak",
            "2" => "sekolah",
            "3" => "rumahIbadah",
            "4" => "posyandu",
            "5" => "puskesmas",
            "6" => "rumahSakit",
            "7" => "kantor",
            "8" => "rumah",
            "9" => "kk",
            "10" => "kios",
            "11" => "pabrik",
            "12" => "jembatan",
            "13" => "jalan",
            "14" => "sawah",
            "15" => "kebunHutan",
            "16" => "kolam",
            "17" => "irigasi",
            "18" => "bangunanLainnya"
        ];
        if(isset($data['kerusakan']) && isset($data['terendam']) && isset($data['sarana_lainnya'])){
            foreach($data['kerusakan'] as $key => $value){
                $detailKerusakan[$fasilitasRusak[$value['id_kerusakan']]] = [
                    "rusakRingan" => $value['rusak_ringan'],
                    "rusakSedang" => $value['rusak_sedang'],
                    "rusakBerat" => $value['rusak_berat'],
                    "totalRusak" => (string) ($value['rusak_ringan'] + $value['rusak_sedang'] + $value['rusak_berat'])
                ];
            }
            foreach($data['terendam'] as $key => $value){
                $detailKerusakan['rumahTerendam'][$fasilitasRusak[$value['id_kerusakan']]] = $value['jml'];
            }
            foreach($data['sarana_lainnya'] as $key => $value){
                $detailKerusakan['bangunanLainnya'][$fasilitasRusak[$value['id_kerusakan']]] = $value['jml'];
            }
        }
        return $detailKerusakan;
    }

    private function _create_formatDetailJumlahKorban($data)
    {
        $detailJumlahKorban = [];
        $jiwa = [
            "1" => "anakL",
            "2" => "anakP",
            "3" => "ibuHamil",
            "4" => "dewasaL",
            "5" => "dewasaP",
            "6" => "lansiaL",
            "7" => "lansiaP"
        ];
        $kondisi = [
            "1" => "meninggal",
            "2" => "hilang",
            "3" => "luka",
            "4" => "menderita",
            "5" => "mengungsi"
        ];
        if(isset($data)){
            foreach($data as $key => $value){
                $detailJumlahKorban[$kondisi[$value['id_kondisi']]][$jiwa[$value['id_jiwa']]] = $value['jumlah_korban'];
            }
        }
        foreach($detailJumlahKorban as $key => $value){
            $total = 0;
            foreach($value as $index => $item){
               $total = $total + $item;
            }
            $detailJumlahKorban[$key]['total'] = (string) $total;
        }
        return $detailJumlahKorban;
    }

    private function _create_formatDampakBencana($data)
    {
        $jumlahKorban = [
            "meninggal" => 0,
            "hilang" => 0,
            "luka" => 0,
            "mengungsi" => 0
        ];
        $rumahRusak = [
            "rusakRingan" => 0,
            "rusakSedang" => 0,
            "rusakBerat" => 0,
            "totalRusak" => 0
        ];
        $fasilitasRusak = [
            "sekolah" => 0,
            "rumahIbadah" => 0,
            "lainnya" => 0,
            "totalRusak" => 0
        ];
        /**
         * kode kondisi
         * 1 = Meninggal
         * 2 = Hilang
         * 3 = Luka/Sakit
         * 4 = Menderita
         * 5 = Mengungsi
         */
        if(isset($data['data_korban']['total'])){
            foreach($data['data_korban']['total'] as $key => $value){
                if(isset($value['id_kondisi'])){
                    if($value['id_kondisi'] == "1"){
                        $jumlahKorban['meninggal'] = $value['total'];
                    }
                    else if($value['id_kondisi'] == 2){
                        $jumlahKorban['hilang'] = $value['total'];
                    }
                    else if($value['id_kondisi'] == 3){
                        $jumlahKorban['luka'] = $value['total'];
                    }
                    else if($value['id_kondisi'] == 5){
                        $jumlahKorban['mengungsi'] = $value['total'];
                    }
                }
            }
        }

        /**
         * kode rumah rusak
         * 1 = Rumah
         * 2 = Sekolah / Sarana Pendidikan
         * 3 = Masjid / Tempat Ibadah
         */

        if(isset($data['data_kerusakan']['kerusakan'])){
            foreach($data['data_kerusakan']['kerusakan'] as $key => $value){
                if($value['id_kerusakan'] == 1){
                    $rumahRusak['rusakRingan'] = $value['rusak_ringan'];
                    $rumahRusak['rusakSedang'] = $value['rusak_sedang'];
                    $rumahRusak['rusakBerat'] = $value['rusak_berat'];
                    $rumahRusak['totalRusak'] = (string) ($value['rusak_ringan'] + $value['rusak_sedang'] + $value['rusak_berat']);
                }
                else if($value['id_kerusakan'] == 2){
                    $fasilitasRusak['sekolah'] = (string) ($value['rusak_ringan'] + $value['rusak_sedang'] + $value['rusak_berat']);
                }
                else if($value['id_kerusakan'] == 3){
                    $fasilitasRusak['rumahIbadah'] = (string) ($value['rusak_ringan'] + $value['rusak_sedang'] + $value['rusak_berat']);
                }
                else{
                    $fasilitasRusak['lainnya'] = $value['rusak_ringan'] + $value['rusak_sedang'] + $value['rusak_berat'];
                }
            }
        }
        if(isset($data['data_kerusakan']['sarana_lainnya'])){
            foreach($data['data_kerusakan']['sarana_lainnya'] as $key => $value){
                $fasilitasRusak['lainnya'] += $value['jml'];
            }
        }
        $fasilitasRusak['lainnya'] = (string) $fasilitasRusak['lainnya'];
        $fasilitasRusak['totalRusak'] = (string) ($fasilitasRusak['sekolah'] + $fasilitasRusak['rumahIbadah'] + $fasilitasRusak['lainnya']);  
        
        return [
            'jumlahKorban' => $jumlahKorban,
            'rumahRusak' => $rumahRusak,
            'fasilitasRusak' => $fasilitasRusak
        ];
    }

    private function _create_formatDetailTernak($data)
    {
        $result = [];
        if(isset($data['ternak'])){
            $ternak = $data['ternak'];
            foreach($ternak as $key => $value){
                $keyObj = str_replace(" ","", strtolower($value['ternak']));
                $result[$keyObj] = $value['jml'];
            }
        }
        return $result;
    }

    private function _hitung_total_wilayah_terdampak($data)
    {
        $totalWilayahTerdampak = [
            "kabkota" => 0,
            "kecamatan" => 0,
            "kelnag" => 0
        ];
        $totalWilayahTerdampak = $this->_hitungRecursive($data, $totalWilayahTerdampak);
        $totalWilayahTerdampak = [
            "kabkota" => (string) $totalWilayahTerdampak['kabkota'],
            "kecamatan" => (string) $totalWilayahTerdampak['kecamatan'],
            "kelnag" => (string) $totalWilayahTerdampak['kelnag']
        ];

        return $totalWilayahTerdampak;
    }

    private function _hitungRecursive($data, $totalWilayahTerdampak)
    {
        $i = 0;
        foreach($data as $key => $value){
            $no = 0;
            foreach($value as $index => $item){

                if($no == 0){
                    if($index == "kabkota"){
                        $totalWilayahTerdampak = $this->_hitungRecursive($value['data_kecamatan'], $totalWilayahTerdampak);
                        $totalWilayahTerdampak['kabkota'] = $totalWilayahTerdampak['kabkota'] + 1;
                    }
                    if($index == "kecamatan"){
                        $totalWilayahTerdampak = $this->_hitungRecursive($value['data_kelnag'], $totalWilayahTerdampak);
                        $totalWilayahTerdampak['kecamatan'] = $totalWilayahTerdampak['kecamatan'] + 1;
                    }
                    if($index == "kelnag"){
                        $totalWilayahTerdampak['kelnag'] = $totalWilayahTerdampak['kelnag'] + 1;
                    }
                }
                $no++;
            }
            $i++;
        }
        return $totalWilayahTerdampak;
    }
}