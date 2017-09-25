<?php

/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */
class LoginGuruController extends CI_Controller{
    // json response array

    public function __construct()
    {
        parent::__construct();
        $this->load->model('guru/AkunGuruModel');
        
    }
    public function loginGuru(){
        
        // json response array
        $response = array("error" => FALSE);

        if (isset($_POST['email']) && isset($_POST['password'])) {

            // receiving the post params
            $email = $_POST['email'];
            $password = $_POST['password'];

            // get the user by email and password
            $user = $this->AkunGuruModel->getUserByEmailAndPassword($email, $password);

            if ($user != false) {
                // use is found
                error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                    // user stored successfully
                $response["error"] = FALSE;
                $response["uid"] = $user[0]->id_pengajar;
                $response["user"]["name"] = $user[0]->name_pengajar;
                $response["user"]["email"] = $user[0]->email_pengajar;
                $response["user"]["no_telepon"] = $user[0]->no_telepon_pengajar;
                $response["user"]["created_at"] = $user[0]->created_at_pengajar;
                $response["user"]["updated_at"] = $user[0]->updated_at_pengajar;
                $response["user"]["jenjang"] = $user[0]->jenjang_pengajar;
                $response["user"]["ajar1"] = $user[0]->ajar1;
                $response["user"]["ajar2"] = $user[0]->ajar2;
                $response["user"]["ajar3"] = $user[0]->ajar3;
                $response["user"]["biaya"] = $user[0]->biaya_pengajar;
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

