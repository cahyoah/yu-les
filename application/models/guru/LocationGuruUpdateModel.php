<?php

/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */

class LocationGuruUpdateModel extends CI_Model {


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
     * Updating User Address
     * returns user address details
     */
    public function updateLocation1($idPengajar, $longitude, $latitude) {
       
        $data = array(                    
                    'longitude_pengajar' => $longitude,
                    'latitude_pengajar' => $latitude
                );

        // Calling model
          $this->db->where('id_pengajar', $idPengajar);
        $location = $this->db->update('pengajar',$data);
   

        // // check for successful store
        if ($location) {
            $stmt = $this->db->select()->from('pengajar')->where('id_pengajar', $idPengajar);
            $position = $stmt->get()->result();
            $stmt->close();
            return $position;
        } else {
            return false;
        }
    }

    
   

}

?>
