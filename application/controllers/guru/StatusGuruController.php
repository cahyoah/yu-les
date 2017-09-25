<?php

/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */
class StatusGuruController extends CI_Controller{
    // json response array

    public function __construct()
    {
        parent::__construct();
         $this->load->model('guru/StatusGuruModel');
        
    }
   
     public function changeGuruOffState(){
       
        // json response array
        $response = array("error" => FALSE);

          
       if (isset($_POST['id_pengajar']) ) {

            // receiving the post params
            $idPengajar = $_POST['id_pengajar'];

            $getStatus = $this->StatusGuruModel->changeGuruOffState($idPengajar);
            
            if ($getStatus) {
                error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                $response["error"] = FALSE;
                
                echo json_encode($response);
   
                

            } else {
                // user failed to store
                $response["error"] = TRUE;
                $response["error_msg"] = "Unknown error occurred in registration!";
                echo json_encode($response);
            }
        } else {
            $response["error"] = TRUE;
            $response["error_msg"] = "Required parameters is missing!";
            echo json_encode($response);
        }
    }

    public function changeGuruOnState(){
       
        // json response array
        $response = array("error" => FALSE);

          
       if (isset($_POST['id_pengajar']) ) {

            // receiving the post params
            $idPengajar = $_POST['id_pengajar'];

            $getStatus = $this->StatusGuruModel->changeGuruOnState($idPengajar);
            
            if ($getStatus) {
                error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                $response["error"] = FALSE;
                
                echo json_encode($response);
   
                

            } else {
                // user failed to store
                $response["error"] = TRUE;
                $response["error_msg"] = "Unknown error occurred in registration!";
                echo json_encode($response);
            }
        } else {
            $response["error"] = TRUE;
            $response["error_msg"] = "Required parameters is missing!";
            echo json_encode($response);
        }
    }

     public function changeGuruOrderAvailableState(){
       
        // json response array
        $response = array("error" => FALSE);

          
       if (isset($_POST['id_pengajar']) ) {

            // receiving the post params
            $idPengajar = $_POST['id_pengajar'];

            $getStatus = $this->StatusGuruModel->changeGuruOrderAvailableState($idPengajar);
            
            if ($getStatus) {
                error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                $response["error"] = FALSE;
                
                echo json_encode($response);
   
                

            } else {
                // user failed to store
                $response["error"] = TRUE;
                $response["error_msg"] = "Unknown error occurred in registration!";
                echo json_encode($response);
            }
        } else {
            $response["error"] = TRUE;
            $response["error_msg"] = "Required parameters is missing!";
            echo json_encode($response);
        }
    }


     public function changeGuruOrderNotAvailableState(){
       
        // json response array
        $response = array("error" => FALSE);

          
       if (isset($_POST['id_pengajar']) ) {

            // receiving the post params
            $idPengajar = $_POST['id_pengajar'];

            $getStatus = $this->StatusGuruModel->changeGuruOrderNotAvailableState($idPengajar);
            
            if ($getStatus) {
                error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                $response["error"] = FALSE;
                
                echo json_encode($response);
   
                

            } else {
                // user failed to store
                $response["error"] = TRUE;
                $response["error_msg"] = "Unknown error occurred in registration!";
                echo json_encode($response);
            }
        } else {
            $response["error"] = TRUE;
            $response["error_msg"] = "Required parameters is missing!";
            echo json_encode($response);
        }
    }

    public function changeGuruOffAvailableState(){
       
        // json response array
        $response = array("error" => FALSE);

          
       if (isset($_POST['id_pengajar']) ) {

            // receiving the post params
            $idPengajar = $_POST['id_pengajar'];

            $getStatus = $this->StatusGuruModel->changeGuruOffState($idPengajar);
           
            if ($getStatus) {
                $getStatus1 = $this->StatusGuruModel->changeGuruOrderAvailableState($idPengajar);    
                if($getStatus1){
                    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                    $response["error"] = FALSE;
                    
                    echo json_encode($response);
                }
                               

            } else {
                // user failed to store
                $response["error"] = TRUE;
                $response["error_msg"] = "Unknown error occurred in registration!";
                echo json_encode($response);
            }
        } else {
            $response["error"] = TRUE;
            $response["error_msg"] = "Required parameters is missing!";
            echo json_encode($response);
        }
    }

     public function changeGuruOnAvailableState(){
       
        // json response array
        $response = array("error" => FALSE);

          
       if (isset($_POST['id_pengajar']) ) {

            // receiving the post params
            $idPengajar = $_POST['id_pengajar'];

            $getStatus = $this->StatusGuruModel->changeGuruOnState($idPengajar);
            $getStatus1 = $this->StatusGuruModel->changeGuruOrderNotAvailableState($idPengajar);
            if ($getStatus && $getStatus1) {
                error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                $response["error"] = FALSE;
                
                echo json_encode($response);
   
                

            } else {
                // user failed to store
                $response["error"] = TRUE;
                $response["error_msg"] = "Unknown error occurred in registration!";
                echo json_encode($response);
            }
        } else {
            $response["error"] = TRUE;
            $response["error_msg"] = "Required parameters is missing!";
            echo json_encode($response);
        }
    }

}



?>

