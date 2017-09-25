<?php


class LocationMuridUpdateModel extends CI_Model {


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
    public function updateLocation1($idMurid, $longitude, $latitude) {
       
        $data = array(
                    'id_murid' => $idMurid,
                    'longitude' => $longitude,
                    'latitude' => $latitude
                );

        // Calling model
        $location = $this->db->update('murid',$data);
   

        // // check for successful store
        if ($location) {
            $stmt = $this->db->select()->from('murid')->where('id_murid', $idMurid);
            $position = $stmt->get()->result();
            $stmt->close();
            print_r ($position);
            return $position;
        } else {
            return false;
        }
    }

    
   

}

?>
