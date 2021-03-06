<?php


class UpdateAkunGuruController extends CI_Controller{
    // json response array

    public function __construct()
    {
        parent::__construct();
         $this->load->model('guru/AkunGuruModel');
        
    }

    public function updateFotoProfilMurid(){
        $response = array("error" => FALSE);

                //this is our upload folder 
        
        
       if(isset($_POST['id_murid']) and isset($_FILES['image']['name']) and isset($_POST['password'])){
           

            $idMurid = $_POST['id_murid'];    
           
            $passwordSekarang = $_POST['password'];

            if(!$this->AkunMuridModel->checkPassword($idMurid, $passwordSekarang)){
                $response["error"] = TRUE;
                $response["error_msg"] = "Password anda Salah";
                echo json_encode($response);
            }else{
                //this is our upload folder 
                 $upload_path = 'fotoprofil/';
                 
                 //Getting the server ip 
                 $server_ip = gethostbyname(gethostname());
                 
                 //creating the upload url 
                 $upload_url = 'http://'.$server_ip."/LesOnline/data pengguna/".$idMurid."/fotoprofil/"; 
                 
                 //response array 
                 $response = array(); 

               
                            //getting name from the request 
                 $idMurid= $_POST['id_murid'];
                    
                 //getting file info from the request 
                 $fileinfo = pathinfo($_FILES['image']['name']);
                 print_r ($fileinfo);
                 
                 //getting the file extension 
                 $extension = $fileinfo['extension'];
                 
                 //file url to store in the database 
                 $file_url = $upload_url . $fileinfo["basename"] ;
                 
                 //file path to upload in the server 
                 $file_path = $upload_path . $fileinfo["basename"] ; 
                 
                 //trying to save the file in the directory 
                 try{
                       if (!is_dir("data pengguna/".$idMurid."/fotoprofil")) {
                                mkdir("data pengguna/".$idMurid."/fotoprofil", 0777, TRUE);
                                
                        }
                        $config['file_name'] = $_FILES['image']['name'];
                        $config['upload_path'] = "data pengguna/".$idMurid."/fotoprofil";
                        $config['allowed_types'] = 'gif|jpg|png';
                        
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        print_r($config);
                        if ( ! $this->upload->do_upload('image'))
                        {
                            $error = $this->upload->display_errors();

                            print_r($error);
                        }
                        else
                        {
                            $data = $this->upload->data();

                            print_r($data);
                        }

                     $user = $this->AkunMuridModel->updateFotoProfil($idMurid, $file_url);       
                     //adding the path and name to database 
                     if($user){
                     
                         //filling response array with values 
                         $response['error'] = false; 
                         $response['url'] = $file_url; 
                     }
                     //if some error occurred 
                 }catch(Exception $e){
                     $response['error']=true;
                     $response['message']=$e->getMessage();
                 } 
                 //displaying the response 
                 echo json_encode($response);
                 
            }
            
            
        } else {

            $response["error"] = TRUE;
            $response["error_msg"] = "Required parameters (name, email or image) is missing!";
            echo json_encode($response);
        }

    }

    public function updateNamaMurid(){
        $response = array("error" => FALSE);

        if (isset($_POST['id_murid']) && isset($_POST['name'])&& isset($_POST['password_sekarang'])) {

            // receiving the post params
            $idMurid = $_POST['id_murid'];    
            $name = $_POST['name'];
            $passwordSekarang = $_POST['password_sekarang'];
         
            if(!$this->AkunMuridModel->checkPassword($idMurid, $passwordSekarang)){
                $response["error"] = TRUE;
                $response["error_msg"] = "Password anda Salah";
                echo json_encode($response);
            }else{
                             
                $user = $this->AkunMuridModel->updateNamaMurid($idMurid, $name);
                     
                
                if ($user) {
                    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                    // user stored successfully
                    $response["error"] = FALSE;
                    $response["uid"] = $user[0]->id_murid;
                    $response["user"]["name"] = $user[0]->name;
                    $response["user"]["email"] = $user[0]->email;
                    $response["user"]["password"] = $user[0]->password;
                    $response["user"]["no_telepon"] = $user[0]->no_telepon;
                    $response["user"]["created_at"] = $user[0]->created_at;
                    $response["user"]["updated_at"] = $user[0]->updated_at;
                    echo json_encode($response);
                } else {
                    // user failed to store
                    $response["error"] = TRUE;
                    $response["error_msg"] = "Terjadi error saat update data!";
                    echo json_encode($response);
                 }

                  
            }        

           
            
        } else {
            $response["error"] = TRUE;
            $response["error_msg"] = "Required parameters (name, email or password) is missing!";
            echo json_encode($response);
        }

    }

    public function updateEmailMurid(){
        // json response array
        $response = array("error" => FALSE);

        if (isset($_POST['id_murid']) &&  isset($_POST['email']) && isset($_POST['password_sekarang'])) {

            // receiving the post params
            $idMurid= $_POST['id_murid'];    
            $email = $_POST['email'];            
            $passwordSekarang = $_POST['password_sekarang'];
           
           
            if(!$this->AkunMuridModel->checkPassword($idMurid, $passwordSekarang)){
                $response["error"] = TRUE;
                $response["error_msg"] = "Password anda Salah";
                echo json_encode($response);
            }else{
                
                 // check if user is already existed with the same email
                if ($this->AkunMuridModel->isUserExisted($email)) {
                    // user already existed
                    $response["error"] = TRUE;
                    $response["error_msg"] = $email . " sudah digunakan";
                    echo json_encode($response);
                }
                else {
                    // create a new user
                    $user = $this->AkunMuridModel->updateEmailMurid($idMurid, $email);
                    if ($user) {
                        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                        // user stored successfully
                        $response["error"] = FALSE;
                        $response["uid"] = $user[0]->id_murid;
                        $response["user"]["name"] = $user[0]->name;
                        $response["user"]["email"] = $user[0]->email;
                        $response["user"]["password"] = $user[0]->password;
                        $response["user"]["no_telepon"] = $user[0]->no_telepon;
                        $response["user"]["created_at"] = $user[0]->created_at;
                        $response["user"]["updated_at"] = $user[0]->updated_at;
                        echo json_encode($response);
                    } else {
                        // user failed to store
                        $response["error"] = TRUE;
                        $response["error_msg"] = "Terjadi error saat update data!";
                        echo json_encode($response);
                    }
                           
                }   
               

                 
            }        

           
            
        } else {
            $response["error"] = TRUE;
            $response["error_msg"] = "Required parameters (name, email or password) is missing!";
            echo json_encode($response);
        }

    }

    public function updatePasswordPengajar(){
         // json response array
        $response = array("error" => FALSE);

        if (isset($_POST['id_pengajar']) && isset($_POST['password_baru'])  && isset($_POST['password_sekarang'])) {

            // receiving the post params
            $idPengajar = $_POST['id_pengajar'];    
            $passwordBaru = $_POST['password_baru'];           
            $passwordSekarang = $_POST['password_sekarang'];       


            if(!$this->AkunGuruModel->checkPassword($idPengajar, $passwordSekarang)){
                $response["error"] = TRUE;
                $response["error_msg"] = "Password anda Salah";
                echo json_encode($response);
            }else{
                $user = $this->AkunGuruModel->updatePasswordPengajar($idPengajar, $passwordBaru);
                       
                 
                if ($user) {
                    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                    // user stored successfully
                    $response["error"] = FALSE;
                    $response["uid"] = $user[0]->id_pengajar;
                    $response["user"]["name"] = $user[0]->name_pengajar;
                    $response["user"]["email"] = $user[0]->email_pengajar;
                    $response["user"]["password"] = $user[0]->encrypted_password_pengajar;
                    $response["user"]["no_telepon"] = $user[0]->no_telepon_pengajar;
                    $response["user"]["created_at"] = $user[0]->created_at_pengajar;
                    $response["user"]["updated_at"] = $user[0]->updated_at;
                    echo json_encode($response);
                } else {
                    // user failed to store
                    $response["error"] = TRUE;
                    $response["error_msg"] = "Terjadi error saat update data!";
                    echo json_encode($response);
                }

                
            }        

           
            
        } else {
            $response["error"] = TRUE;
            $response["error_msg"] = "Required parameters (name, email or password) is missing!";
            echo json_encode($response);
        }

    }


     public function updateNoTeleponMurid(){
       
        // json response array
        $response = array("error" => FALSE);

        if (isset($_POST['id_murid']) && isset($_POST['no_telepon'])  && isset($_POST['password_sekarang'])) {

            // receiving the post params
            $idMurid = $_POST['id_murid'];    
            
            $passwordSekarang = $_POST['password_sekarang'];
            $noTelepon = $_POST['no_telepon'];

          

            if(!$this->AkunMuridModel->checkPassword($idMurid, $passwordSekarang)){
                $response["error"] = TRUE;
                $response["error_msg"] = "Password anda Salah";
                echo json_encode($response);
            }else{
               

                    $user = $this->AkunMuridModel->updateNoTeleponMurid($idMurid,  $noTelepon);
                       
                    
                    if ($user) {
                        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                        // user stored successfully
                        $response["error"] = FALSE;
                        $response["uid"] = $user[0]->id_murid;
                        $response["user"]["name"] = $user[0]->name;
                        $response["user"]["email"] = $user[0]->email;
                        $response["user"]["password"] = $user[0]->password;
                        $response["user"]["no_telepon"] = $user[0]->no_telepon;
                        $response["user"]["created_at"] = $user[0]->created_at;
                        $response["user"]["updated_at"] = $user[0]->updated_at;
                        echo json_encode($response);
                    } else {
                        // user failed to store
                        $response["error"] = TRUE;
                        $response["error_msg"] = "Terjadi error saat update data!";
                         echo json_encode($response);
                    }

                  
            }        

           
            
        } else {
            $response["error"] = TRUE;
            $response["error_msg"] = "Required parameters (name, email or password) is missing!";
            echo json_encode($response);
        }
    }

    public function updateUserGuru(){
       
        // json response array
        $response = array("error" => FALSE);

        if (isset($_POST['id_pengajar']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password_sekarang']) && isset($_POST['no_telepon']) && isset($_POST['jenjang']) && isset($_POST['ajar1']) && isset($_POST['ajar2']) &&isset($_POST['ajar3']) && isset($_POST['biaya'])) {

            // receiving the post params
            $idPengajar = $_POST['id_pengajar'];    
            $name = $_POST['name'];
            $email = $_POST['email'];            
            $passwordSekarang = $_POST['password_sekarang'];
            $noTelepon = $_POST['no_telepon'];
            $jenjang = $_POST['jenjang'];
            $ajar1 = $_POST['ajar1'];
            $ajar2 = $_POST['ajar2'];
            $ajar3 = $_POST['ajar3'];
            $biaya = $_POST['biaya'];

            if(!isset($_POST['password_baru'])){
                $passwordBaru = $passwordSekarang;
            }else{
                $passwordBaru = $_POST['password_baru'];
            }


            if(!$this->AkunGuruModel->checkPassword($idPengajar, $passwordSekarang)){
                $response["error"] = TRUE;
                $response["error_msg"] = "Password anda Salah";
                echo json_encode($response);
            }else{
                if($this->AkunGuruModel->checkUserData($idPengajar, $name, $email , $noTelepon, $jenjang, $ajar1, $ajar2, $ajar3, $biaya)){
                    $response["error"] = TRUE;
                    $response["error_msg"] = "Data yang disimpan masih sama";
                    echo json_encode($response);
                }else{

                  
                        if($this->AkunGuruModel->isTelephoneNumberSame($idPengajar, $noTelepon)){
                            $response["error"] = TRUE;
                            $response["error_msg"] = "No Telepon sudah digunakan";
                            echo json_encode($response);
                        }else if($this->AkunGuruModel->isEmailSame($idPengajar, $email)){
                             $response["error"] = TRUE;
                            $response["error_msg"] = "Email sudah digunakan";
                            echo json_encode($response);

                        }else{
                             // create a new user
                            $user = $this->AkunGuruModel->updateUser($idPengajar, $name, $email,  $noTelepon, $jenjang, $ajar1, $ajar2, $ajar3, $biaya);
                            if ($user) {
                                error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                                // user stored successfully
                                $response["error"] = FALSE;
                                $response["uid"] = $user[0]->id_pengajar;
                                $response["user"]["name"] = $user[0]->name_pengajar;
                                $response["user"]["email"] = $user[0]->email_pengajar;
                                $response["user"]["password"] = $user[0]->password;
                                $response["user"]["no_telepon"] = $user[0]->no_telepon_pengajar;
                                $response["user"]["created_at"] = $user[0]->created_at_pengajar;
                                $response["user"]["updated_at"] = $user[0]->updated_at;
                                $response["user"]["jenjang"] = $user[0]->jenjang_pengajar;
                                $response["user"]["ajar1"] = $user[0]->ajar1;
                                $response["user"]["ajar2"] = $user[0]->ajar2;
                                $response["user"]["ajar3"] = $user[0]->ajar3;
                                $response["user"]["biaya"] = $user[0]->biaya_pengajar;
                                echo json_encode($response);
                            } else {
                                // user failed to store
                                $response["error"] = TRUE;
                                $response["error_msg"] = "Terjadi error saat update data!";
                                 echo json_encode($response);
                            } 
                        }
                       
  
                    
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

