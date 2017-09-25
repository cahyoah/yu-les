<?php



class AkunMuridModel extends CI_Model {


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
    public function storeUserMurid($name, $email, $password, $noTelepon) {
        $uuid = uniqid('', true);
        //$uuid = md5(time().".".rand().".".rand());
        if($this->checkID($uuid)){
            while ($this->checkID($uuid)) {
               $uuid = md5(time().".".rand().".".rand());
            }
        }
        $hash = $this->hashSSHA($password);
        $encrypted_password = $hash["encrypted"]; // encrypted password
        $salt = $hash["salt"]; // salt
        $data = array(
                    'id_murid' => $uuid,
                    'name' => $name,
                    'email_murid' => $email,
                    'no_telepon' => $noTelepon,
                    'encrypted_password' => $encrypted_password,
                    'salt' => $salt
                );

        // Calling model
        $id = $this->db->insert('murid',$data);
   

        // // check for successful store
        if ($id) {
            $stmt = $this->db->select()->from('murid')->where('email_murid', $email);
            $user = $stmt->get()->result();
            $stmt->close();
            
            return $user;
        } else {
            return false;
        }
    }

    public function updateNamaMurid($idPengguna, $name) {
        
       
        $data = array(                   
                    'name' => $name,
                    'updated_at' => date('Y-m-d H:i:s')
                    
                );

        // Calling model
         $this->db->where('id_murid', $idPengguna);
        $id = $this->db->update('murid',$data);
   

        // // check for successful store
        if ($id) {
            $stmt = $this->db->select()->from('murid')->where('id_murid', $idPengguna);
            $user = $stmt->get()->result();
            $stmt->close();
            print_r ($user);
            return $user;
        } else {
            return false;
        }
    }

    public function updateFotoProfil($idPengguna, $foto) {
        
       
 
             $data = array(                   
                    'foto_profil' => $foto,
                    'updated_at' => date('Y-m-d H:i:s')
                    
                );
            $this->db->where('id_murid', $idPengguna);
            $id = $this->db->update('murid',$data);
             
            
             
             // // check for successful store
            if ($id) {
                $stmt = $this->db->select()->from('murid')->where('id_murid', $idPengguna);
                $user = $stmt->get()->result();
                $stmt->close();
                print_r ($user);
                return $user;
            } else {
                return false;
            }
       
        


        
    }


    public function updateEmailMurid($idPengguna, $email) {
        
       
        $data = array(                   
                   
                    'email_murid' => $email,
                    
                    'updated_at' => date('Y-m-d H:i:s')
                    
                );

        // Calling model
         $this->db->where('id_murid', $idPengguna);
        $id = $this->db->update('murid',$data);
   

        // // check for successful store
        if ($id) {
            $stmt = $this->db->select()->from('murid')->where('id_murid', $idPengguna);
            $user = $stmt->get()->result();
            $stmt->close();
            print_r ($user);
            return $user;
        } else {
            return false;
        }
    }

     public function updatePasswordMurid($idPengguna, $password) {
        
        $hash = $this->hashSSHA($password);
        $encrypted_password = $hash["encrypted"]; // encrypted password
        $salt = $hash["salt"]; // salt
        $data = array(                   
                    
                    'encrypted_password' => $encrypted_password,
                    'salt' => $salt,
                    'updated_at' => date('Y-m-d H:i:s')
                    
                );

        // Calling model
         $this->db->where('id_murid', $idPengguna);
        $id = $this->db->update('murid',$data);
   

        // // check for successful store
        if ($id) {
            $stmt = $this->db->select()->from('murid')->where('id_murid', $idPengguna);
            $user = $stmt->get()->result();
            $stmt->close();
           
            return $user;
        } else {
            return false;
        }
    }

    public function updateNoTeleponMurid($idPengguna, $noTelepon) {
        
       
        $data = array(                   
                   
                    'no_telepon' => $noTelepon,
                    'updated_at' => date('Y-m-d H:i:s')
                    
                );

        // Calling model
         $this->db->where('id_murid', $idPengguna);
        $id = $this->db->update('murid',$data);
   

        // // check for successful store
        if ($id) {
            $stmt = $this->db->select()->from('murid')->where('id_murid', $idPengguna);
            $user = $stmt->get()->result();
            $stmt->close();
            print_r ($user);
            return $user;
        } else {
            return false;
        }
    }

   

    public function isEmailSame($idPengguna, $email){
        $this->db->select()->from('murid')->where('id_murid !=', $idPengguna)->where('email_murid', $email);
        
        $query = $this->db->get();
        
        if ($query->num_rows() > 0)
        {
          
            return true;
        }else{
         
            return false;
        }

    }
    public function isTelephoneNumberSame($idPengguna,$noTelepon){
        $this->db->select()->from('murid')->where('no_telepon', $noTelepon)->where('id_murid !=', $idPengguna);
        
        $query = $this->db->get();
        
        if ($query->num_rows() > 0)
        {
          
            return true;
        }else{
         
            return false;
        }

    }
    public function isExistedTelephoneNumber($noTelepon){
        $this->db->select()->from('murid')->where('no_telepon', $noTelepon);
        
        $query = $this->db->get();
        
        if ($query->num_rows() > 0)
        {
          
            return true;
        }else{
         
            return false;
        }

    }


    public function updateUser($idPengguna, $nama, $email, $noTelepon) {
        
       
        $data = array(                   
                    'id_murid' => $idPengguna,
                    'name' => $nama,
                    'email_murid' => $email,
                    'no_telepon' => $noTelepon,
                    'updated_at' => date('Y-m-d H:i:s')
                    
                );

        // Calling model
         $this->db->where('id_murid', $idPengguna);
        $id = $this->db->update('murid',$data);
   

        // // check for successful store
        if ($id) {
            $stmt = $this->db->select()->from('murid')->where('id_murid', $idPengguna);
            $user = $stmt->get()->result();
            $stmt->close();
           
            return $user;
        } else {
            return false;
        }
    }


    public function checkUserData($idPengguna, $name, $email,  $noTelepon){


        $this->db->select()->from('murid')->where('id_murid', $idPengguna)
        ->where('name', $name)
        ->where('email_murid', $email)
        ->where('no_telepon', $noTelepon);
        
        
        $query = $this->db->get();
       
     
        if ($query->num_rows() > 0)
        {
            return true;
           
        }else{
            
            return false;
        }

    }


    /**
     * Get user by email and password
     */
    public function getUserByEmailAndPassword($email, $password) {


        $this->db->select()->from('murid')->where('email_murid', $email);
        $user = $this->db->get()->result();

        if ($user) {
            // verifying user password
            $salt = $user[0]->salt;
            $encrypted_password = $user[0]->encrypted_password;
            $hash = $this->checkhashSSHA($salt, $password);
            // check for password equality
            if ($encrypted_password == $hash) {
                // user authentication details are correct
                return $user;
            }
        } else {
            return NULL;
        }
    }

    /**
     * Get user by email and password
     */
    public function checkPassword($idPengguna, $password) {


        $this->db->select()->from('murid')->where('id_murid', $idPengguna);
        $user = $this->db->get()->result();

        if ($user) {
            // verifying user password
            $salt = $user[0]->salt;
            $encrypted_password = $user[0]->encrypted_password;
            $hash = $this->checkhashSSHA($salt, $password);
            // check for password equality
           if($encrypted_password == $hash){
                
                return true;
            }else{
                return false;
            }
           

        } else {
            return NULL;
        }
    }


    /**
     * Check user is existed or not
     */
    public function isUserExisted($email) {
        
        $this->db->select()->from('murid')->where('email_murid', $email);
        
        $query = $this->db->get();
        
        if ($query->num_rows() > 0)
        {
            
            return true;
        }else{
           

            return false;
        }

    }

    /**
     * Encrypting password
     * @param password
     * returns salt and encrypted password
     */
    public function hashSSHA($password) {

        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }

    /**
     * Decrypting password
     * @param salt, password
     * returns hash string
     */
    public function checkhashSSHA($salt, $password) {

        $hash = base64_encode(sha1($password . $salt, true) . $salt);

        return $hash;
    }

    public function checkID($uuid){
         $this->db->select()->from('murid')->where('id_murid', $uuid);
        $user = $this->db->get()->result();
        if($user){
            return true;
        }else{
             return false;
        }
        

    }

}

?>
