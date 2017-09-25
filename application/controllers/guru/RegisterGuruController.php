<?php

/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */
class RegisterGuruController extends CI_Controller{
    // json response array

    public function __construct()
    {
        parent::__construct();
         $this->load->model('guru/AkunGuruModel');
        
    }
    public function saveGuru(){
       
        // json response array
        $response = array("error" => FALSE);

        if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['no_telepon'])) {

            // receiving the post params
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $noTelepon = $_POST['no_telepon'];

            // check if user is already existed with the same email
            if ($this->AkunGuruModel->isUserExisted($email)) {
                // user already existed
                $response["error"] = TRUE;
                $response["error_msg"] = "User already existed with " . $email;
                echo json_encode($response);
            }else if ($this->AkunGuruModel->isExistedTelephoneNumber($noTelepon)){
                 $response["error"] = TRUE;
                $response["error_msg"] = "No Telepon sudah digunakan";
                echo json_encode($response);

            }else {
                // create a new user
                $user = $this->AkunGuruModel->storeUserGuru($name, $email, $password, $noTelepon);
                if ($user) {
                    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                    // user stored successfully
                    $response["error"] = FALSE;
                    $response["uid"] = $user[0]->id_pengajar;
                    $response["user"]["name"] = $user[0]->name_pengajar;
                    $response["user"]["email"] = $user[0]->email_pengajar;
                    $response["user"]["no_telepon"] = $user[0]->no_telepon_pengajar;
                    $response["user"]["created_at"] = $user[0]->created_at;
                    $response["user"]["updated_at"] = $user[0]->updated_at;
                    echo json_encode($response);
                    
                } else {
                    // user failed to store
                    $response["error"] = TRUE;
                    $response["error_msg"] = "Unknown error occurred in registration!";
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

