<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contactform extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();	
         
        if($this->session->userdata('userFullName') == ""|| $this->session->userdata('mailID') == "")
        {
            redirect(BACKOFFICE.'LoginController', 'refresh');
        } 	
        $this->load->helper('url');

        // Load model
        $this->load->model('ContactFormModel');
	}

    public function index(){
        $this->load->view(BACKOFFICE.'contactForm');        
    }
   
    public function getList(){
        $postData = $this->input->post();   
        $data = $this->ContactFormModel->getEmployees($postData);
        echo json_encode($data);
   }

   public function deleteContactus(){
        $id = $this->input->post('id');
        $result = $this->ContactFormModel->deleteContact($id);      
        if($result){
            echo json_encode(array('status'=>'success','msg'=>'Deleted Successfully..'));
        }else{
            echo json_encode(array('status'=>'error','msg'=>'Deletetion failed..'));
        }
   }
}