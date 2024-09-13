<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of nontpp model
 *
 * @author prima aulia
 * https://www.facebook.com/prima.aulia23
 */

class Mindex extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }
    
    public function getDashboardFirst(){
        $this->load->library('curl');
        $data = json_decode($this->curl->get('https://testing4.sumbarprov.go.id/2024_kebencanaan/api/v1/dashboard/get_data'), true);
        if($data['kode'] == 200){
            $data = $data['data'];
            $dataTotalBencana = array(
                'longsor'       => $data['totalBencanaTahunIni']['longsor'],
                'banjir'        => $data['totalBencanaTahunIni']['banjir'],
                'terban'        => $data['totalBencanaTahunIni']['terban'],
                'cuacaEkstrem'  => $data['totalBencanaTahunIni']['cuacaEkstrim'],
                'erupsi'        => $data['totalBencanaTahunIni']['erupsiGunungBerapi'],
                'gempa'         => $data['totalBencanaTahunIni']['gempaBumi'],
                'banjirBandang' => $data['totalBencanaTahunIni']['banjirBandang'],
                'abrasiPantai'  => $data['totalBencanaTahunIni']['abrasiPantai'],
            );

            
            $this->session->set_userdata('dataTotalBencana', $dataTotalBencana);
            $this->session->set_userdata('daben_info', $data['optionBencanaMasaTanggap']);
        }else{
            dd("error");
        }
        return $data;
    }

    public function dashboardOnChange($id){
        $this->load->library('curl');
        $data = json_decode($this->curl->get('https://testing4.sumbarprov.go.id/2024_kebencanaan/api/v1/dashboard/get_data/'.$id), true);
        return $data['data'];
    }

    public function getDataDetail($id){
        $this->load->library('curl');
        $data = json_decode($this->curl->get('https://testing4.sumbarprov.go.id/2024_kebencanaan/api/v1/dashboard/get_detail_bencana/'.$id), true);
        return $data['data'];
    }

    public function getDataDampak($id){
        $this->load->library('curl');
        $data = json_decode($this->curl->get('https://testing4.sumbarprov.go.id/2024_kebencanaan/api/v1/dashboard/get_dampak_bencana/'.$id), true);
        return $data['data'];
    }

    public function getDabenSeluruh(){
        $this->load->library('curl');
        $data = json_decode($this->curl->get('https://testing4.sumbarprov.go.id/2024_kebencanaan/api/v1/dashboard/get_list_bencana/all'), true);
        return $data['data'];
    }

    public function getDabenTanggap(){
        $this->load->library('curl');
        $data = json_decode($this->curl->get('https://testing4.sumbarprov.go.id/2024_kebencanaan/api/v1/dashboard/get_list_bencana/tanggap_darurat'), true);
        return $data['data'];
    }

    public function getDabenKategori(){
        $this->load->library('curl');
        $data = json_decode($this->curl->get('https://testing4.sumbarprov.go.id/2024_kebencanaan/api/v1/dashboard/get_list_bencana/jenis/1'), true);
        return $data['data'];
    }

}

// This is the end of auth signin model
