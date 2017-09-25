<?php

/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */
class LocationGuruUpdateController extends CI_Controller{
    // json response array

    public function __construct()
    {
        parent::__construct();
         $this->load->model('guru/LocationGuruUpdateModel');
        
    }
    public function updateLocation(){
       
        // json response array
        $response = array("error" => FALSE);

        if (isset($_POST['id_pengajar']) && 
            isset($_POST['longitude']) && 
            isset($_POST['latitude']) ) {

            // receiving the post params
            $idPengajar = $_POST['id_pengajar'];
            $longitude = $_POST['longitude'];
            $latitude = $_POST['latitude'];
          
         
            $user = $this->LocationGuruUpdateModel->updateLocation1($idPengajar, $longitude, $latitude);
            if ($user) {
                error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                // user stored successfully
                $response["error"] = FALSE;
               
                $response["uid"] = $user[0]->id_pengajar;
                $response["user"]["latitude"] = $user[0]->longitude_pengajar;
                $response["user"]["longitude"] = $user[0]->latitude_pengajar;
                echo json_encode($response);
            } else {
                // user failed to store
                $response["error"] = TRUE;
                $response["error_msg"] = "Terjadi error saat update lokasi!";
                echo json_encode($response);
            }

          
        } else {
            $response["error"] = TRUE;
            $response["error_msg"] = "Required parameters (name, email or password) is missing!";
            echo json_encode($response);
        }
    }

     

   
}



?>

