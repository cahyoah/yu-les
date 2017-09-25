<?php

/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */
class LoginMuridController extends CI_Controller{
    // json response array

    public function __construct()
    {
        parent::__construct();
        $this->load->model('murid/AkunMuridModel');
        
    }
    public function loginMurid(){
        
        // json response array
        $response = array("error" => FALSE);

        if (isset($_POST['email']) && isset($_POST['password'])) {

            // receiving the post params
            $email = $_POST['email'];
            $password = $_POST['password'];

            // get the user by email and password
            $user = $this->AkunMuridModel->getUserByEmailAndPassword($email, $password);

            if ($user != false) {
                // use is found
                error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                    // user stored successfully
                $response["error"] = FALSE;
                $response["uid"] = $user[0]->id_murid;
                $response["user"]["name"] = $user[0]->name;
                $response["user"]["email"] = $user[0]->email_murid;
                $response["user"]["no_telepon"] = $user[0]->no_telepon;
                $response["user"]["created_at"] = $user[0]->created_at;
                $response["user"]["updated_at"] = $user[0]->updated_at;
               
                echo json_encode($response);
            } else {
                // user is not found with the credentials
                $response["error"] = TRUE;
                $response["error_msg"] = "Username atau password salah. Silahkan coba lagi!";
                echo json_encode($response);
            }
        } else {
            // required post params is missing
            $response["error"] = TRUE;
            $response["error_msg"] = "Required parameters email or password is missing!";
            echo json_encode($response);
        }
    }

   
}



?>

