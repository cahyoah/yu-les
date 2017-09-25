<?php



class StatusGuruModel extends CI_Model {


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

 
    public function changeGuruOffState($idPengajar){
         $data = array(                   
                    'status_aktif_pengajar' => 'Off',
                    
                );

        // Calling model
         $this->db->where('id_pengajar', $idPengajar);
        $id = $this->db->update('pengajar',$data);    
        
        if($id){
            return $id;              
            
        }else{
             return false;
        }
    }

    public function changeGuruOnState($idPengajar){
          $data = array(                   
                    'status_aktif_pengajar' => 'On',
                    
                );

        // Calling model
         $this->db->where('id_pengajar', $idPengajar);
        $id = $this->db->update('pengajar',$data);    
        
        if($id){
            return $id;              
            
        }else{
             return false;
        }
    }

    public function changeGuruOrderAvailableState($idPengajar){
         $data = array(                   
                    'status_order_pengajar' => "Not Ordered",
                    
                );

         // Calling model
         $this->db->where('id_pengajar', $idPengajar);
        $id = $this->db->update('pengajar',$data);    
        
        
        if($id){
            return $id;              
            
        }else{
             return false;
        }
    }

    public function changeGuruOrderNotAvailableState($idPengajar){
         $data = array(                   
                    'status_order_pengajar' => "Ordered",
                    
                );

        // Calling model
         $this->db->where('id_pengajar', $idPengajar);
        $id = $this->db->update('pengajar',$data);    
        
        
        if($id){
            return $id;              
            
        }else{
             return false;
        }
    }

    public function changeGuruOffStateAvailableState($idPengajar){
         $data = array(                   
                    'status_aktif_pengajar' => 'Off',
                    'status_order_pengajar' => 'Not Ordered'
                    
                );

        // Calling model
         $this->db->where('id_pengajar', $idPengajar);
        $id = $this->db->update('pengajar',$data);    
        
        if($id){
            return $id;              
            
        }else{
             return false;
        }
    }


}

?>
