<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

    public function __construct() {
        parent::__construct();       
    }

    public function index() {
        $this->db->where('is_deleted','0');
        $query = $this->db->get('tbl_images');
        $images = $query->result();
        $this->load->view('backoffice/upload_form', array('error' => ' ','images'=>$images ));
    }
    
     public function process() {
       
        if (!empty($_FILES['userfile']['name'][0])) {
            $this->load->library('upload');
            
           
            $uploaded_files = array();
            
           
            foreach ($_FILES['userfile']['name'] as $key => $filename) {
               
                if ($_FILES['userfile']['name'][$key] != "") {
                   
                    $ext = pathinfo($_FILES['userfile']['name'][$key], PATHINFO_EXTENSION);
                    $createUrl = "createUrl-" . date('YmdHis') . "-" . $key . "." . $ext;
                    $target_file = FCPATH . 'uploads/createUrl/' . $createUrl;
    
                   
                    if (move_uploaded_file($_FILES['userfile']['tmp_name'][$key], $target_file)) {                        
                        $uploaded_files[] = $createUrl;
                    }
                }
            } 
            if(!empty($uploaded_files)){
                foreach ($uploaded_files as $key=> $filename) {
                    
                    $original_filename = $_FILES['userfile']['name'][$key];
                        $data = array(
                            'filename' => $filename,
                            'url' => base_url('uploads/createUrl/' . $filename), 
                             'original_filename' => $original_filename
                            
                        );       
                        $this->db->insert('tbl_images', $data);
                    // $config['image_library'] = 'gd2';
                    // $config['source_image'] =  FCPATH.'uploads/createUrl/' . $filename;
                    // $config['maintain_ratio'] = TRUE;
                    // $config['width'] = 800;
                    // $config['height'] = 600;
                    // $config['quality'] = '90%';
                    // $config['new_image'] =  FCPATH.'uploads/createUrl/';
                    // $config['create_thumb'] = FALSE;

                    // $this->load->library('image_lib', $config);

                    // if (!$this->image_lib->resize()) {
                    //     echo $this->image_lib->display_errors();
                    // } else {
                        
                    // }
                    
                    
                }
                $this->session->set_userdata('toastrSuccess', 'Uploaded successfully...');
	        	redirect(UPLOAD_IMAGES, 'refresh');
            }            
        }
    }
    
    // public function process() {
       
    //     if (!empty($_FILES['userfile']['name'][0])) {
    //         $this->load->library('upload');
            
           
    //         $uploaded_files = array();
            
           
    //         foreach ($_FILES['userfile']['name'] as $key => $filename) {
               
    //             if ($_FILES['userfile']['name'][$key] != "") {
                   
    //                 $ext = pathinfo($_FILES['userfile']['name'][$key], PATHINFO_EXTENSION);
    //                 $createUrl = "createUrl-" . date('YmdHis') . "-" . $key . "." . $ext;
    //                 $target_file = FCPATH . 'uploads/createUrl/' . $createUrl;
    
                   
    //                 if (move_uploaded_file($_FILES['userfile']['tmp_name'][$key], $target_file)) {                        
    //                     $uploaded_files[] = $createUrl;
    //                 }
    //             }
    //         } 
    //         if(!empty($uploaded_files)){
    //             foreach ($uploaded_files as $key=> $filename) {
    //                 $config['image_library'] = 'gd2';
    //                 $config['source_image'] =  FCPATH.'uploads/createUrl/' . $filename;
    //                 $config['maintain_ratio'] = TRUE;
    //                 $config['width'] = 800;
    //                 $config['height'] = 600;
    //                 $config['quality'] = '90%';
    //                 $config['new_image'] =  FCPATH.'uploads/createUrl/';
    //                 $config['create_thumb'] = FALSE;

    //                 $this->load->library('image_lib', $config);

    //                 if (!$this->image_lib->resize()) {
    //                     echo $this->image_lib->display_errors();
    //                 } else {
    //                  $original_filename = $_FILES['userfile']['name'][$key];
    //                     $data = array(
    //                         'filename' => $filename,
    //                         'url' => base_url('uploads/createUrl/' . $filename), 
    //                          'original_filename' => $original_filename
                            
    //                     );       
    //                     $this->db->insert('tbl_images', $data);
    //                 }
                    
                    
    //             }
    //             $this->session->set_userdata('toastrSuccess', 'Uploaded successfully...');
	   //     	redirect(UPLOAD_IMAGES, 'refresh');
    //         }            
    //     }
    // }

//     public function process() {
        
       
//              if ($_FILES['userfile']['name'] == "") {
// 				$createUrl = "";
// 			} else {
// 				$ext = substr(strrchr($_FILES['userfile']['name'], '.'), 1);
// 				$createUrl = "createUrl-" . date('YmdHis') . "." . $ext;
// 			}
// 			$target_file = FCPATH.'uploads/createUrl/'.$createUrl;
			
// 			if (move_uploaded_file($_FILES['userfile']['tmp_name'], $target_file)) {
// 			     $this->resizeImage($createUrl);
// 			} 
        

//     }

    private function resizeImage($filename) {
        $config['image_library'] = 'gd2';
        $config['source_image'] =  FCPATH.'uploads/createUrl/' . $filename;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 800;
        $config['height'] = 600;
        $config['quality'] = '90%';
        $config['new_image'] =  FCPATH.'uploads/createUrl/';
        $config['create_thumb'] = FALSE;

        $this->load->library('image_lib', $config);

        if (!$this->image_lib->resize()) {
            echo $this->image_lib->display_errors();
        } else {
           
            $this->storeImageDetails($filename);
        }
    }

    private function storeImageDetails($filename) {
        $data = array(
            'filename' => $filename,
            'url' => base_url('uploads/createUrl/' . $filename), 
            
        );       
        $this->db->insert('tbl_images', $data);
        $this->session->set_userdata('toastrSuccess', 'Uploaded successfully...');
		redirect(UPLOAD_IMAGES, 'refresh');
        
    }
    
    public function request(){
        $this->db->where('is_deleted','0');
         $this->db->order_by('id','desc');
        $query = $this->db->get('tbl_check_plagarism');
       
        $images = $query->result();
        $this->load->view('backoffice/request_plagarism', array('error' => ' ','request'=>$images ));
    }
    public function updateRequest(){
          $id = $this->input->post('id');
           if($id!==''){           
            $data = array(
                'completed_status' => 'Done'               
            );
            $this->db->where('id ', $id);
            if($this->db->update('tbl_check_plagarism', $data)){
               	echo json_encode(array('status'=>'success','msg'=>'Updated successfully...'));
            }else{
               	echo json_encode(array('status'=>'error','msg'=>'Error while updating...'));
            }
        }
    }
    public function deleteRequest()
    {
        $id = $this->input->post('id');
        if($id!==''){           
            $data = array(
                'is_deleted' => 1                
            );
            $this->db->where('id ', $id);
            if($this->db->update('tbl_check_plagarism', $data)){
               	echo json_encode(array('status'=>'success','msg'=>'Deleted successfully...'));
            }else{
               	echo json_encode(array('status'=>'error','msg'=>'Error while deleting...'));
            }
        }
    }
    
    public function deleteCreatedUrl()
    {
        
        $id = $this->uri->segment('4');
        if($id!==''){           
            $data = array(
                'is_deleted' => 1                
            );
            $this->db->where('id ', $id);
            if($this->db->update('tbl_images', $data)){
               
                $this->session->set_userdata('toastrSuccess', 'Deleted successfully...');
		        redirect(UPLOAD_IMAGES, 'refresh');
            }else{
                $this->session->set_userdata('toastrError', 'Error...');
		        redirect(UPLOAD_IMAGES, 'refresh');
            }
        }
    }

}
