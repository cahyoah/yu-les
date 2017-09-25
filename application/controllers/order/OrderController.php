<?php

/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */
class OrderController extends CI_Controller{
    // json response array

    public function __construct()
    {
        parent::__construct();
         $this->load->model('order/OrderModel');
        
    }
    public function makeOrder(){
       
        // json response array
        $response = array("error" => FALSE);

          
       if (isset($_POST['idMurid']) && isset($_POST['alamatMurid']) && isset($_POST['noteMurid']) && isset($_POST['idPengajar']) && isset($_POST['mataPelajaran']) && isset($_POST['totalBayar'])) {

            // receiving the post params
            $idMurid = $_POST['idMurid'];
            $alamatMurid = $_POST['alamatMurid'];
            $noteMurid = $_POST['noteMurid'];
            $idPengajar = $_POST['idPengajar'];
            $mataPelajaran = $_POST['mataPelajaran'];
            $totalBayar = $_POST['totalBayar'];


            $makeOrder = $this->OrderModel->storeOrder($idMurid, $alamatMurid, $noteMurid, $idPengajar, $mataPelajaran, $totalBayar);
            if ($makeOrder) {
                error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                // user stored successfully
                $response["error"] = FALSE;
                $response["order"]["id_order"] = $makeOrder[0]->id_order;
                // $response["uid"] = $user[0]->id_murid;
                // $response["user"]["name"] = $user[0]->name;
                // $response["user"]["email"] = $user[0]->email;
                // $response["user"]["no_telepon"] = $user[0]->no_telepon;
                // $response["user"]["created_at"] = $user[0]->created_at;
                // $response["user"]["updated_at"] = $user[0]->updated_at;
                echo json_encode($response);
                    
            } else {
                // user failed to store
                $response["error"] = TRUE;
                $response["error_msg"] = "Unknown error occurred in registration!";
                echo json_encode($response);
            }
        } else {
            $response["error"] = TRUE;
            $response["error_msg"] = "Required parameters (name, email or password) is missing!";
            echo json_encode($response);
        }
    }
     
     public function getOrderMuridByIdPengajar(){
       
        // json response array
        $response = array("error" => FALSE);

          
       if (isset($_POST['id_pengajar']) ) {

            // receiving the post params
            $idPengajar = $_POST['id_pengajar'];

            $getOrder = $this->OrderModel->getOrderMuridByIdPengajar($idPengajar);
            
            if ($getOrder) {
                error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                $data['order'] = $getOrder;

                $response = array();
                $posts = array();
                foreach ($getOrder as $order) 
                { 
                    $posts[] = array(
                        
                        "id_order" => $order->id_order,
                        "nama_murid" => $order->name,
                        "alamat_murid" => $order->alamat_murid,
                        "note_murid" => $order->note_murid,
                        "durasi"    => $order->durasi,
                        "status_order" => $order->status_order,
                        "mata_pelajaran" => $order->mata_pelajaran,
                        "total_bayar" => $order->total_bayar,
                        "waktu_pesan" => $order->waktu_pesan,
                        "no_telepon_murid" => $order->no_telepon,
                        "email_murid" => $order->email_murid
                                                
                    );
               
                } 
                $response['order'] = $posts;
                echo json_encode($response);
   
                

            } else {
                // user failed to store
                $response["error"] = TRUE;
                $response["error_msg"] = "Unknown error occurred in registration!";
                echo json_encode($response);
            }
        } else {
            $response["error"] = TRUE;
            $response["error_msg"] = "Required parameters is missing!";
            echo json_encode($response);
        }
    }

    public function getOrderMuridByIdMurid(){
       
        // json response array
        $response = array("error" => FALSE);

          
       if (isset($_POST['idMurid']) ) {

            // receiving the post params
            $idMurid = $_POST['idMurid'];

            $getOrder = $this->OrderModel->getOrderMuridByIdMurid($idMurid);
            
            if ($getOrder) {
                error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                $data['order'] = $getOrder;

                $response = array();
                $posts = array();
                foreach ($getOrder as $order) 
                { 
                    $posts[] = array(
                        
                        "id_order" => $order->id_order,
                        "nama_pengajar" => $order->name_pengajar,
                        "alamat_murid" => $order->alamat_murid,
                        "note_murid" => $order->note_murid,
                        "durasi"    => $order->durasi,
                        "status_order" => $order->status_order,
                        "mata_pelajaran" => $order->mata_pelajaran,
                        "total_bayar" => $order->total_bayar,
                        "waktu_pesan" => $order->waktu_pesan,
                        "no_telepon_pengajar" => $order->no_telepon_pengajar,
                        "email_pengajar" => $order->email_pengajar
                                                
                    );
               
                } 
                $response['order'] = $posts;
                echo json_encode($response);
   
                

            } else {
                // user failed to store
                $response["error"] = TRUE;
                $response["error_msg"] = "Unknown error occurred in registration!";
                echo json_encode($response);
            }
        } else {
            $response["error"] = TRUE;
            $response["error_msg"] = "Required parameters is missing!";
            echo json_encode($response);
        }
    }

    public function getOrderMuridByIdOrder(){
       
        // json response array
        $response = array("error" => FALSE);

          
       if (isset($_POST['idOrder']) ) {

            // receiving the post params
            $idOrder = $_POST['idOrder'];

            $getOrder = $this->OrderModel->getOrderMuridByIdOrder($idOrder);
            
            if ($getOrder) {
                error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                $data['order'] = $getOrder;

                $response = array();
                $posts = array();
                foreach ($getOrder as $order) 
                { 
                    $posts[] = array(
                        
                        "id_order" => $order->id_order,
                        "nama_pengajar" => $order->name_pengajar,
                        "alamat_murid" => $order->alamat_murid,
                        "note_murid" => $order->note_murid,
                        "durasi"    => $order->durasi,
                        "status_order" => $order->status_order,
                        "mata_pelajaran" => $order->mata_pelajaran,
                        "total_bayar" => $order->total_bayar,
                        "waktu_pesan" => $order->waktu_pesan,
                        "jenjang_pengajar" => $order->jenjang_pengajar,
                        "no_telepon_pengajar" => $order->no_telepon_pengajar,
                        "email_pengajar" => $order->email_pengajar

                                                
                    );
               
                } 
                $response['order'] = $posts;
                echo json_encode($response);
   
                

            } else {
                // user failed to store
                $response["error"] = TRUE;
                $response["error_msg"] = "Unknown error occurred in registration!";
                echo json_encode($response);
            }
        } else {
            $response["error"] = TRUE;
            $response["error_msg"] = "Required parameters is missing!";
            echo json_encode($response);
        }
    }
    
     public function getOrderDetailPengajarByIdOrder(){
       
        // json response array
        $response = array("error" => FALSE);

          
       if (isset($_POST['id_order']) ) {

            // receiving the post params
            $idOrder = $_POST['id_order'];

            $getOrder = $this->OrderModel->getOrderDetailPengajarByIdOrder($idOrder);
            
            if ($getOrder) {
                error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                $data['order'] = $getOrder;

                $response = array();
                $posts = array();
                foreach ($getOrder as $order) 
                { 
                    $posts[] = array(
                        
                        "id_order" => $order->id_order,
                        "nama_murid" => $order->name,
                        "alamat_murid" => $order->alamat_murid,
                        "note_murid" => $order->note_murid,
                        "durasi"    => $order->durasi,
                        "status_order" => $order->status_order,
                        "mata_pelajaran" => $order->mata_pelajaran,
                        "total_bayar" => $order->total_bayar,
                        "waktu_pesan" => $order->waktu_pesan,
                        "no_telepon_murid" => $order->no_telepon,
                        "email_murid" => $order->email_murid,
                        "jenjang" => $order->jenjang_pengajar


                                                
                    );
               
                } 
                $response['order'] = $posts;
                echo json_encode($response);
   
                

            } else {
                // user failed to store
                $response["error"] = TRUE;
                $response["error_msg"] = "Unknown error occurred in registration!";
                echo json_encode($response);
            }
        } else {
            $response["error"] = TRUE;
            $response["error_msg"] = "Required parameters is missing!";
            echo json_encode($response);
        }
    }

    public function changeOrderStatus(){
         // json response array
        $response = array("error" => FALSE);

          
       if (isset($_POST['id_order']) && isset($_POST['status_ubahan']) ) {

            // receiving the post params
            $idOrder = $_POST['id_order'];
            $statusUbahan = $_POST['status_ubahan'];

            $getOrder = $this->OrderModel->changeOrderStatus($idOrder, $statusUbahan);
            
            if ($getOrder) {
                error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                $response["error"] = FALSE;
                
                echo json_encode($response);
                

            } else {
                // user failed to store
                $response["error"] = TRUE;
                $response["error_msg"] = "Unknown error occurred in registration!";
                echo json_encode($response);
            }
        } else {
            $response["error"] = TRUE;
            $response["error_msg"] = "Required parameters is missing!";
            echo json_encode($response);
        }
    }

     public function cancelOrderByIdOrder(){
       
        // json response array
        $response = array("error" => FALSE);

          
       if (isset($_POST['idOrder']) ) {

            // receiving the post params
            $idOrder = $_POST['idOrder'];

            $getOrder = $this->OrderModel->cancelOrder($idOrder);
            
            if ($getOrder) {
                error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                $response["error"] = FALSE;
                
                echo json_encode($response);
   
                

            } else {
                // user failed to store
                $response["error"] = TRUE;
                $response["error_msg"] = "Unknown error occurred in registration!";
                echo json_encode($response);
            }
        } else {
            $response["error"] = TRUE;
            $response["error_msg"] = "Required parameters is missing!";
            echo json_encode($response);
        }
    }

}



?>

