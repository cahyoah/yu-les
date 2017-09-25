<?php

/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */

class CariGuruModel extends CI_Model {


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
    public function getAllTeacher() {
        
        $id = $this->db->select()->from('pengajar');
        

        // // check for successful store
        if ($id) {
            $teacher = $id->get()->result();
            $id->close();
                
            return $teacher;
        } else {

            return false;
        }

        
    }

     public function getTeacherWithID($idPengajar) {
        
        $id = $this->db->select()->from('pengajar')->where('id_pengajar', $idPengajar);
        

        // // check for successful store
        if ($id) {
            $teacher = $id->get()->result();
            $id->close();
                
            return $teacher;
        } else {

            return false;
        }

        
    }

  

}

?>
