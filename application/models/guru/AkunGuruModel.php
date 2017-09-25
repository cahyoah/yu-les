<?php

/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */

class AkunGuruModel extends CI_Model {


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
    public function storeUserGuru($name, $email, $password, $noTelepon) {
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
                    'id_pengajar' => $uuid,
                    'name_pengajar' => $name,
                    'email_pengajar' => $email,
                    'no_telepon_pengajar' => $noTelepon,
                    'encrypted_password_pengajar' => $encrypted_password,
                    'salt_pengajar' => $salt
                );

        // Calling model
        $id = $this->db->insert('pengajar',$data);
   

        // // check for successful store
        if ($id) {
            $stmt = $this->db->select()->from('pengajar')->where('email_pengajar', $email);
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


    public function updateEmailPengajar($idPengguna, $email) {
        
       
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

     public function updatePasswordPengajar($idPengguna, $password) {
        
        $hash = $this->hashSSHA($password);
        $encrypted_password = $hash["encrypted"]; // encrypted password
        $salt = $hash["salt"]; // salt
        $data = array(                   
                    
                    'encrypted_password_pengajar' => $encrypted_password,
                    'salt_pengajar' => $salt,
                    'updated_at_pengajar' => date('Y-m-d H:i:s')
                    
                );

        // Calling model
         $this->db->where('id_pengajar', $idPengguna);
        $id = $this->db->update('pengajar',$data);
   

        // // check for successful store
        if ($id) {
            $stmt = $this->db->select()->from('pengajar')->where('id_pengajar', $idPengguna);
            $user = $stmt->get()->result();
            $stmt->close();
           
            return $user;
        } else {
            return false;
        }
    }

    public function updateNoTeleponPengajar($idPengguna, $noTelepon) {
        
       
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
        $this->db->select()->from('pengajar')->where('id_pengajar !=', $idPengguna)->where('email_pengajar', $email);
        
        $query = $this->db->get();
        
        if ($query->num_rows() > 0)
        {
          
            return true;
        }else{
         
            return false;
        }

    }
    public function isTelephoneNumberSame($idPengguna,$noTelepon){
        $this->db->select()->from('pengajar')->where('no_telepon_pengajar', $noTelepon)->where('id_pengajar !=', $idPengguna);
        
        $query = $this->db->get();
        
        if ($query->num_rows() > 0)
        {
          
            return true;
        }else{
         
            return false;
        }

    }
    public function isExistedTelephoneNumber($noTelepon){
        $this->db->select()->from('pengajar')->where('no_telepon_pengajar', $noTelepon);
        
        $query = $this->db->get();
        
        if ($query->num_rows() > 0)
        {
          
            return true;
        }else{
         
            return false;
        }

    }


    public function updateUser($idPengguna, $nama, $email, $noTelepon, $jenjang, $ajar1, $ajar2, $ajar3, $biaya) {
        
       
        $data = array(                   
                    'id_pengajar' => $idPengguna,
                    'name_pengajar' => $nama,
                    'email_pengajar' => $email,
                    'ajar1' => $ajar1,
                    'ajar2' => $ajar2,
                    'ajar3' => $ajar3,
                    'biaya_pengajar' => $biaya,
                    'no_telepon_pengajar' => $noTelepon,
                    'jenjang_pengajar'=> $jenjang
                    
                );

        // Calling model
         $this->db->where('id_pengajar', $idPengguna);
        $id = $this->db->update('pengajar',$data);
   

        // // check for successful store
        if ($id) {
            $stmt = $this->db->select()->from('pengajar')->where('id_pengajar', $idPengguna);
            $user = $stmt->get()->result();
            $stmt->close();
           
            return $user;
        } else {
            return false;
        }
    }


    public function checkUserData($idPengguna, $name, $email,  $noTelepon, $jenjang, $ajar1, $ajar2, $ajar3, $biaya){


        $this->db->select()->from('pengajar')->where('id_pengajar', $idPengguna)
        ->where('name_pengajar', $name)
        ->where('email_pengajar', $email)
        ->where('jenjang_pengajar', $jenjang)
        ->where('ajar1', $ajar1)
        ->where('ajar2', $ajar2)
        ->where('ajar3', $ajar3)
        ->where('biaya_pengajar', $biaya)
        ->where('no_telepon_pengajar', $noTelepon);
        
        
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


        $this->db->select()->from('pengajar')->where('email_pengajar', $email);
        $user = $this->db->get()->result();

        if ($user) {
            // verifying user password
            $salt = $user[0]->salt_pengajar;
            $encrypted_password = $user[0]->encrypted_password_pengajar;
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


        $this->db->select()->from('pengajar')->where('id_pengajar', $idPengguna);
        $user = $this->db->get()->result();

        if ($user) {
            // verifying user password
            $salt = $user[0]->salt_pengajar;
            $encrypted_password = $user[0]->encrypted_password_pengajar;
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
        
        $this->db->select()->from('pengajar')->where('email_pengajar', $email);
        
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
         $this->db->select()->from('pengajar')->where('id_pengajar', $uuid);
        $user = $this->db->get()->result();
        if($user){
            return true;
        }else{
             return false;
        }
        

    }

}

?>
