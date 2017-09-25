<?php


class LocationMuridUpdateController extends CI_Controller{
    // json response array

    public function __construct()
    {
        parent::__construct();
         $this->load->model('murid/LocationMuridUpdateModel');
        
    }
    public function updateLocation(){
       
        // json response array
        $response = array("error" => FALSE);

        if (isset($_POST['id_murid']) && 
            isset($_POST['longitude']) && 
            isset($_POST['latitude']) ) {

            // receiving the post params
            $idMurid = $_POST['id_murid'];
            $longitude = $_POST['longitude'];
            $latitude = $_POST['latitude'];
          
         
            $user = $this->LocationMuridUpdateModel->updateLocation1($idMurid, $longitude, $latitude);
            if ($user) {
                error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                // user stored successfully
                $response["error"] = FALSE;
               
                $response["uid"] = $user[0]->id_pmurid;
                $response["user"]["latitude"] = $user[0]->longitude;
                $response["user"]["longitude"] = $user[0]->latitude;
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

