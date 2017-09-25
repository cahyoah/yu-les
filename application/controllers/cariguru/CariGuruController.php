<?php

/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */
class CariGuruController extends CI_Controller{
    // json response array

    public function __construct()
    {
        parent::__construct();
         $this->load->model('cariguru/CariGuruModel');
        
    }
    public function getTeacher(){
       
        // json response array
        $response = array("error" => FALSE);          
        // create a new user
        $userGuru = $this->CariGuruModel->getAllTeacher();
        if ($userGuru) {
            error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
            $data['guru'] = $userGuru;

            $response = array();
            $posts = array();
            $pelajaran = array();
            foreach ($userGuru as $guru) 
            { 
                $posts[] = array(
                    
                    "id_pengajar"      =>  $guru->id_pengajar,
                    "name_pengajar"             =>  $guru->name_pengajar,
                    "email_pengajar"            =>  $guru->email_pengajar,
                    "no_telepon_pengajar"       =>  $guru->no_telepon_pengajar,
                    "jenjang_pengajar"          =>  $guru->jenjang_pengajar,
                    "status_aktif_pengajar"     => $guru->status_aktif_pengajar,
                    "status_order_pengajar"     => $guru->status_order_pengajar,
                    "longitude_pengajar"        => $guru->longitude_pengajar,
                    "biaya_pengajar"             => $guru->biaya_pengajar,
                    "latitude_pengajar"        => $guru->latitude_pengajar,
                    "pelajaran"       => $pelajaran[] = array(
                                            "ajar1"     => $guru->ajar1,
                                            "ajar2"     => $guru->ajar2,
                                            "ajar3"     => $guru->ajar3
                                            )                 
                    
                );
           
            } 
            $response['guru'] = $posts;
            echo json_encode($response);
   
    
                    
        } else {
            // user failed to store
            $response["error"] = TRUE;
            $response["error_msg"] = "Unknown error occurred in registration!";
            echo json_encode($response);
        }
    }
       
    public function getTeacherWithID(){
       
        // json response array
        $response = array("error" => FALSE);          
        // create a new user
        if (isset($_POST['id_pengajar'])) {
            $idPengajar = $_POST['id_pengajar'];
            $userGuru = $this->CariGuruModel->getTeacherWithID($idPengajar);
            if ($userGuru) {
                error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                $data['guru'] = $userGuru;

                $response = array();
                $posts = array();
                $pelajaran = array();
                foreach ($userGuru as $guru) 
                { 
                    $posts[] = array(
                        
                        "id_pengajar"      =>  $guru->id_pengajar,
                        "name_pengajar"             =>  $guru->name_pengajar,
                        "email_pengajar"            =>  $guru->email_pengajar,
                        "no_telepon_pengajar"       =>  $guru->no_telepon_pengajar,
                        "jenjang_pengajar"          =>  $guru->jenjang_pengajar,
                        "status_aktif_pengajar"     => $guru->status_aktif_pengajar,
                        "status_order_pengajar"     => $guru->status_order_pengajar,
                        "longitude_pengajar"        => $guru->longitude_pengajar,
                        "biaya_pengajar"             => $guru->biaya_pengajar,
                        "latitude_pengajar"        => $guru->latitude_pengajar,
                        "pelajaran"       => $pelajaran[] = array(
                                                "ajar1"     => $guru->ajar1,
                                                "ajar2"     => $guru->ajar2,
                                                "ajar3"     => $guru->ajar3
                                                )                 
                        
                    );
               
                } 
                $response["error"] = FALSE;
                $response['guru'] = $posts;
                echo json_encode($response);
       
        
                        
            } else {
                // user failed to store
                $response["error"] = TRUE;
                $response["error_msg"] = "Unknown error occurred in registration!";
                echo json_encode($response);
            }
        }

      
    }
       

   
}



?>

