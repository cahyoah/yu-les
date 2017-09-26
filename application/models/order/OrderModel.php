<?php



class OrderModel extends CI_Model {


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
    public function storeOrder($idMurid, $alamatMurid, $noteMurid, $idPengajar, $mataPelajaran, $totalBayar) {
        $uuid = uniqid('', true);
        //$uuid = md5(time().".".rand().".".rand());
        if($this->checkID($uuid) || $uuid == 0){
            while ($this->checkID($uuid) || $uuid ==0) {
               $uuid = md5(time().".".rand().".".rand());
            }
        }
        $data = array(
                    'id_order' => $uuid,
                    'id_murid' => $idMurid,
                    'alamat_murid' => $alamatMurid,
                    'note_murid' => $noteMurid,
                    'id_pengajar' => $idPengajar,
                    'mata_pelajaran' => $mataPelajaran,
                    'total_bayar' => $totalBayar
                );

        // Calling model
        $alamat = $this->db->insert('order',$data);
   

        // // check for successful store
        if ($alamat) {
            $stmt = $this->db->select()->from('order')->where('id_order', $uuid);

            $user = $stmt->get()->result();
            $stmt->close();
            return $user;
        } else {
            return false;
        }
    }

    public function getOrderMuridByIdPengajar($idPengajar){

        $this->db->select('*')->from('order')->where('order.id_pengajar', $idPengajar);
        $this->db->join('murid', 'murid.id_murid = order.id_murid','left');
        $this->db->join('pengajar', 'pengajar.id_pengajar = order.id_pengajar','left');
        $this->db->order_by("waktu_pesan", "DESC");   
        $getOrder = $this->db->get()->result();
        if($getOrder){
            return $getOrder;              
            
        }else{
             return false;
        }
    }

    public function getOrderMuridByIdMurid($idMurid){

        $this->db->select('*')->from('order')->where('order.id_murid', $idMurid);

        $this->db->join('murid', 'murid.id_murid = order.id_murid','left');
        $this->db->join('pengajar', 'pengajar.id_pengajar = order.id_pengajar','left');
        $this->db->order_by("waktu_pesan", "DESC");   
        $getOrder = $this->db->get()->result();
        if($getOrder){
            return $getOrder;              
            
        }else{
             return false;
        }
    }

    public function getOrderMuridByIdOrder($idOrder){

        $this->db->select('*')->from('order')->where('order.id_order', $idOrder);

        $this->db->join('murid', 'murid.id_murid = order.id_murid','left');
        $this->db->join('pengajar', 'pengajar.id_pengajar = order.id_pengajar','left');
        $this->db->order_by("waktu_pesan", "DESC");   
        $getOrder = $this->db->get()->result();
        if($getOrder){
            return $getOrder;              
            
        }else{
             return false;
        }
    }

    public function getOrderDetailPengajarByIdOrder($idOrder){

        $this->db->select('*')->from('order')->where('order.id_order', $idOrder);

        $this->db->join('murid', 'murid.id_murid = order.id_murid','left');
        $this->db->join('pengajar', 'pengajar.id_pengajar = order.id_pengajar','left');
        $this->db->order_by("waktu_pesan", "DESC");   
        $getOrder = $this->db->get()->result();
        if($getOrder){
            return $getOrder;              
            
        }else{
             return false;
        }
    }

    public function changeOrderStatus($idOrder, $statusUbahan){
         $data = array(                   
                    'status_order' => $statusUbahan,
                    
                );

        // Calling model
         $this->db->where('id_order', $idOrder);
        $id = $this->db->update('order',$data);    
        
        if($id){
            return $id;              
            
        }else{
             return false;
        }
    }

    public function cancelOrder($idOrder){
         $data = array(                   
                    'status_order' => 'Dibatalkan',
                    
                );

        // Calling model
         $this->db->where('id_order', $idOrder);
        $id = $this->db->update('order',$data);    
        
        if($id){
            return $id;              
            
        }else{
             return false;
        }
    }


 
    public function checkID($uuid){
         $this->db->select()->from('order')->where('id_order', $uuid);
        $user = $this->db->get()->result();
        if($user){
            return true;
        }else{
             return false;
        }
        

    }
   

}

?>
