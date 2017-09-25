<?php


class AlamatController extends CI_Controller{
    // json response array

    public function __construct()
    {
        parent::__construct();
         $this->load->model('AlamatModel');
        
    }
    public function saveAlamat(){
       
        // json response array
        $response = array("error" => FALSE);

        if (isset($_POST['id_pengguna']) && 
            isset($_POST['nama_alamat']) && 
            isset($_POST['atas_nama']) &&
            isset($_POST['no_telepon']) && 
            isset($_POST['provinsi']) &&
            isset($_POST['kota_kabupaten']) &&
            isset($_POST['kecamatan']) &&
            isset($_POST['kode_pos']) &&
            isset($_POST['alamat_lengkap'])) {

            // receiving the post params
            $idPengguna = $_POST['id_pengguna'];
            $namaAlamat = $_POST['nama_alamat'];
            $atasNama = $_POST['atas_nama'];
            $noTelepon = $_POST['no_telepon'];
            $provinsi = $_POST['provinsi'];
            $kotaKabupaten = $_POST['kota_kabupaten'];
            $kecamatan = $_POST['kecamatan'];
            $kodePos = $_POST['kode_pos'];
            $alamatLengkap = $_POST['alamat_lengkap'];
               // // check if user is already save the address
            if ($this->AlamatModel->isAlamatExisted($idPengguna, $namaAlamat, $atasNama, $noTelepon, $provinsi,            $kotaKabupaten, $kecamatan, $kodePos, $alamatLengkap)) {
                // user already existed
                $response["error"] = TRUE;
                $response["error_msg"] = "Alamat sudah ada!";
                echo json_encode($response);
               
            } else {
                $user = $this->AlamatModel->storeAlamat($idPengguna, $namaAlamat, $atasNama, $noTelepon, $provinsi,            $kotaKabupaten, $kecamatan, $kodePos, $alamatLengkap);
                if ($user) {
                    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                    // user stored successfully
                    $response["error"] = FALSE;
                    $response["status"] = "Penyimpanan Berhasil";
                    // $response["uid"] = $user[0]->id_pengguna;
                    // $response["user"]["name"] = $user[0]->name;
                    // $response["user"]["email"] = $user[0]->email;
                    // $response["user"]["created_at"] = $user[0]->created_at;
                    // $response["user"]["updated_at"] = $user[0]->updated_at;
                     echo json_encode($response);
                } else {
                    // user failed to store
                    $response["error"] = TRUE;
                    $response["error_msg"] = "Terjadi error saat menyimpan alamat!";
                    echo json_encode($response);
                }

          }
        } else {
            $response["error"] = TRUE;
            $response["error_msg"] = "Required parameters (name, email or password) is missing!";
            echo json_encode($response);
        }
    }

     public function updateAlamat(){
       
        // json response array
        $response = array("error" => FALSE);
      

        if (isset($_POST['id_pengguna']) && 
            isset($_POST['nama_alamat']) && 
            isset($_POST['atas_nama']) &&
            isset($_POST['no_telepon']) && 
            isset($_POST['provinsi']) &&
            isset($_POST['kota_kabupaten']) &&
            isset($_POST['kecamatan']) &&
            isset($_POST['kode_pos']) &&
            isset($_POST['alamat_lengkap'])) {

            // receiving the post params
            $idPengguna = $_POST['id_pengguna'];
            $namaAlamat = $_POST['nama_alamat'];
            $atasNama = $_POST['atas_nama'];
            $noTelepon = $_POST['no_telepon'];
            $provinsi = $_POST['provinsi'];
            $kotaKabupaten = $_POST['kota_kabupaten'];
            $kecamatan = $_POST['kecamatan'];
            $kodePos = $_POST['kode_pos'];
            $alamatLengkap = $_POST['alamat_lengkap'];
               // // check if user is already save the address
            if ($this->AlamatModel->isAlamatExisted($idPengguna, $namaAlamat, $atasNama, $noTelepon, $provinsi,            $kotaKabupaten, $kecamatan, $kodePos, $alamatLengkap)) {
                // user already existed
                $response["error"] = TRUE;
                $response["error_msg"] = "Alamat sudah ada!";
                echo json_encode($response);
               
            } else {
                $user = $this->AlamatModel->updateAlamat($idPengguna, $namaAlamat, $atasNama, $noTelepon, $provinsi,            $kotaKabupaten, $kecamatan, $kodePos, $alamatLengkap);
                if ($user) {
                    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                    // user stored successfully
                    $response["error"] = FALSE;
                    $response["status"] = "Penyimpanan Berhasil";
                    // $response["uid"] = $user[0]->id_pengguna;
                    // $response["user"]["name"] = $user[0]->name;
                    // $response["user"]["email"] = $user[0]->email;
                    // $response["user"]["created_at"] = $user[0]->created_at;
                    // $response["user"]["updated_at"] = $user[0]->updated_at;
                     echo json_encode($response);
                } else {
                    // user failed to store
                    $response["error"] = TRUE;
                    $response["error_msg"] = "Terjadi error saat menyimpan alamat!";
                    echo json_encode($response);
                }

          }
        } else {
            $response["error"] = TRUE;
            $response["error_msg"] = "Required parameters (name, email or password) is missing!";
            echo json_encode($response);
        }
    }

   
}



?>

