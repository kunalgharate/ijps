 <?php


defined('BASEPATH') OR exit('No direct script access allowed');

class PaymentHistory extends CI_Controller {

    public function __construct() {
        parent::__construct();    
        $this->load->model('ReferenceModel');   
    }

    public function index() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('tbl_payment_details');
        $data = $query->result_array();
        $this->load->view('backoffice/payment_history', array('error' => ' ','items'=>$data ));
    }
    
     public function getList(){
        $postData = $this->input->post();   
        $data = $this->ReferenceModel->getPaymentList($postData);
        echo json_encode($data);
   }
    
   

}
?>