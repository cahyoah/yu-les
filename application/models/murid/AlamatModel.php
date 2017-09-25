<?php


class AlamatModel extends CI_Model {


    // constructor
    function __construct() {
        // require_once 'DB_Connect.php';
        // // connecting to database
        // $db = new Db_Connect();
        // $this->conn = $db->connect();
    }

    // destructor
    function __destruct() {
        
    }

    /**
     * Storing new user
     * returns user details
     */
    public function storeAlamat($idPengguna, $namaAlamat, $atasNama, $noTelepon, $provinsi, $kotaKabupaten, $kecamatan, $kodePos, $alamatLengkap) {
       
        $data = array(
                    'id_pengguna' => $idPengguna,
                    'nama_alamat' => $namaAlamat,
                    'atas_nama' => $atasNama,
                    'no_telepon' => $noTelepon,
                    'provinsi' => $provinsi,
                    'kota_kabupaten'=> $kotaKabupaten,
                    'kecamatan' => $kecamatan,
                    'kode_pos' => $kodePos,
                    'alamat_lengkap' => $alamatLengkap
                );

        // Calling model
        $alamat = $this->db->insert('Alamat',$data);
   

        // // check for successful store
        if ($alamat) {
            $stmt = $this->db->select()->from('alamat')->where('id_pengguna', $idPengguna);
            $user = $stmt->get()->result();
            $stmt->close();
            print_r ($user);
            return $user;
        } else {
            return false;
        }
    }

    /**
     * Updating User Address
     * returns user address details
     */
    public function updateAlamat($idPengguna, $namaAlamat, $atasNama, $noTelepon, $provinsi, $kotaKabupaten, $kecamatan, $kodePos, $alamatLengkap) {
       
        $data = array(
                    'id_pengguna' => $idPengguna,
                    'nama_alamat' => $namaAlamat,
                    'atas_nama' => $atasNama,
                    'no_telepon' => $noTelepon,
                    'provinsi' => $provinsi,
                    'kota_kabupaten'=> $kotaKabupaten,
                    'kecamatan' => $kecamatan,
                    'kode_pos' => $kodePos,
                    'alamat_lengkap' => $alamatLengkap
                );

        // Calling model
        $alamat = $this->db->update('Alamat',$data);
   

        // // check for successful store
        if ($alamat) {
            $stmt = $this->db->select()->from('alamat')->where('id_pengguna', $idPengguna);
            $user = $stmt->get()->result();
            $stmt->close();
            print_r ($user);
            return $user;
        } else {
            return false;
        }
    }

     /**
     * Check user is existed or not
     */
    public function isAlamatExisted($idPengguna, $namaAlamat, $atasNama, $noTelepon, $provinsi, $kotaKabupaten, $kecamatan, $kodePos, $alamatLengkap){
        
        $this->db->select()->from('alamat') ->where('id_pengguna', $idPengguna)
                                            ->where('nama_alamat', $namaAlamat)
                                            ->where('atas_nama', $atasNama)
                                            ->where('no_telepon', $noTelepon)
                                            ->where('provinsi', $provinsi)
                                            ->where('kota_kabupaten', $kotaKabupaten)
                                            ->where('kecamatan', $kecamatan)
                                            ->where('kode_pos', $kodePos)
                                            ->where('alamat_lengkap', $alamatLengkap);
        
        $query = $this->db->get();
        
        if ($query->num_rows() > 0)
        {
            
            return true;
        }else{
             
            return false;
        }

    }

   

}

?>
