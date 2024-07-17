<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of model odp
 *
 * @author Dimas Dwi Randa
 */

class Model_master extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getDataJenisBencana()
    {
        $this->db->order_by('id_jenis_bencana  ASC');
        $query = $this->db->get('cx_jenis_bencana');
        $jenis[''] = 'Pilih Jenis Bencana';
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $jenis[$row['id_jenis_bencana']] = $row['nm_bencana'];
            }
        }
        return $jenis;
    }

    public function getDataPusdalops()
    {
        $this->db->select('a.id_regency,
                           a.nm_regency');
        $this->db->from('wil_regency a');
        $this->db->order_by('id_regency', 'ASC');
        $query = $this->db->get();
        // $jenis[''] = 'Pilih Daerah';
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $jenis[$row['id_regency']] = $row['nm_regency'];
            }
        }
        return $jenis;
    }

    public function getDataUsersPersonal()
    {
        $this->db->select('a.fullname,
                           a.id_users');
        $this->db->from('xi_sa_users a');
        $this->db->join('xi_sa_users_privileges b', 'a.id_users = b.id_users', 'inner');
        $this->db->where('a.id_status', 1);
        $this->db->where('b.id_group', 6);
        $this->db->order_by('id_users', 'ASC');
        $query = $this->db->get();
        $jenis[''] = 'Pilih OPD Penanggung Jawab';
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $jenis[$row['id_users']] = $row['fullname'];
            }
        }
        return $jenis;
    }

    // public function getDataJenisBencana()
    // {
    //     $this->db->select('id_jenis_bencana,
    //                        nm_bencana');
    //     $this->db->from('cx_jenis_bencana');
    //     $this->db->order_by('id_jenis_bencana', 'ASC');
    //     // $this->db->where('id_status', 1);
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    public function getDataJenisBencanaGroup()
    {
        $this->db->where('id_status', 1);
        $this->db->order_by('id_jenis_bencana ASC');
        $query = $this->db->get('cx_jenis_bencana');
        return $query->result_array();
    }

    public function getDataUserAll()
    {
        $this->db->select('a.fullname,
                           a.id_users');
        $this->db->from('xi_sa_users a');
        $this->db->join('xi_sa_users_privileges b', 'a.id_users = b.id_users', 'inner');
        $this->db->where('a.id_status', 1);
        $this->db->where('b.id_group', 6);
        $this->db->order_by('id_users', 'ASC');
        $query = $this->db->get();
        $dd_users = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $dd_users[$row->id_users] = $row->fullname;
            }
        }
        return $dd_users;
    }

    public function getDataInstansi()
    {
        $this->db->order_by('id_instansi ASC');
        $query = $this->db->get('cx_instansi_prov');
        $dd_prov[''] = 'Pilih Provinsi';
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $dd_prov[$row['id_instansi']] = $row['nm_instansi'];
            }
        }
        return $dd_prov;
    }

    public function getDataProvince()
    {
        $this->db->where('id', '13');
        $this->db->order_by('id ASC');
        $query = $this->db->get('wa_province');
        $dd_prov[''] = 'Pilih Provinsi';
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $dd_prov[$row['id']] = $row['name'];
            }
        }
        return $dd_prov;
    }

    public function getDataRegency()
    {
        // $this->db->where('province_id', '13');
        $this->db->order_by('id_regency ASC');
        $query = $this->db->get('wil_regency');
        $dd_reg[''] = 'Pilih Daerah';
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $dd_reg[$row['id_regency']] = ($row['status'] == 1) ? "KAB " . $row['nm_regency'] : $row['nm_regency'];
            }
        }
        return $dd_reg;
    }

    public function getDataRegencyByProvince($id)
    {
        $this->db->where('province_id', $id);
        $this->db->order_by('status ASC');
        $this->db->order_by('name ASC');
        $query = $this->db->get('wil_regency');
        return $query->result_array();
    }

    public function getDataDistrictByRegency($id)
    {
        $this->db->where('id_regency', $id);
        $this->db->order_by('id_district ASC');
        $query = $this->db->get('wil_district');
        return $query->result_array();
    }

    public function getDataVillageByDistrict($id)
    {
        $this->db->where('id_district', $id);
        $this->db->order_by('id_village ASC');
        $query = $this->db->get('wil_village');
        return $query->result_array();
    }
}

// This is the end of auth signin model
