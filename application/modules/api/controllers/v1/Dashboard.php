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
            'tanggalKejadian' => $data_detail1['bencana']['tanggalKejadian'],
            'updateData' => "",
            'infoGrafisUrl' => $data_detail1['bencana']['infoGrafisUrl'],
            'lokasiKejadian' => $data_detail1['bencana']['lokasiKejadian']
        ];

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

    private function _detail_bencana_formatter($data)
    {
        $keseluruhan = [
            "kode" => "0",
            "ket" => "Data Keseluruhan",
            "data" => [
                "taksiranKerugian" => "0",
                "totalKorbanTerisolir" => "0",
                "totalWilayahTerdampak" => [
                    "kabkota" => "0",
                    "kecamatan" => "0",
                    "kelnag" => "0"
                ]
            ],
            "dampakBencana" => $this->_create_formatDampakBencana($data['stat_total'])
        ];
        return [$keseluruhan];
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
}