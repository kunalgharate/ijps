<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Reference extends CI_Controller {

    public function __construct() {
        parent::__construct();    
        $this->load->model('ReferenceModel');   
    }

    public function index() {
        $query = $this->db->get('tbl_reference_books');
        $images = $query->result();
        $this->load->view('backoffice/reference', array('error' => ' ','items'=>$images ));
    }
    
    public function getList(){
        $postData = $this->input->post();   
       
        $data = $this->ReferenceModel->getList($postData);
        echo json_encode($data);
   }

   public function add(){
   
    $config['upload_path'] = './uploads/reference';
    $config['allowed_types'] = 'jpeg|jpg|png';
    $config['max_size'] = 1024 * 5;    

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('userfile')) {
        $error = $this->upload->display_errors();
    } else {
        $uploadedData = $this->upload->data();
    } 
    
    $data = array(
        'title' => $this->input->post('title'),
        'description' => $this->input->post('description'),
        'url' => $this->input->post('url'),
        'image' =>$uploadedData['file_name']        
    );       
    $this->db->insert('tbl_reference_books', $data);
    $this->session->set_userdata('toastrSuccess', 'Uploaded successfully...');
    redirect(UPLOAD_REFERENCEBK, 'refresh');
   }

   public function deleteRefe(){
    $id = $this->input->post('id');
    $result = $this->ReferenceModel->deleteReference($id);      
    if($result){
        echo json_encode(array('status'=>'success','msg'=>'Deleted Successfully..'));
    }else{
        echo json_encode(array('status'=>'error','msg'=>'Deletetion failed..'));
    }
}

public function editReference(){
    $id = $this->input->post('id');
    $result = $this->ReferenceModel->getDataReference($id);   
    
    echo json_encode(array('id'=>$result[0]->id,'title'=>$result[0]->title,'description'=>$result[0]->description,'image'=>$result[0]->image,'url'=>$result[0]->url));
    // echo "<pre>";print_r( $result );
}

    public function saveReferenceData(){
       
        $config['upload_path'] = './uploads/reference';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['max_size'] = 1024 * 5;    
        
        $this->load->library('upload', $config);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
           
            if ($_FILES['edit_userfile']['size'] > 0) {
               
                if (!$this->upload->do_upload('edit_userfile')) {
                   
                    $error = $this->upload->display_errors();
                  
                } else {
                  
                    $uploadedData = $this->upload->data();
                    $image = $uploadedData['file_name'];
                }
            } else {
              
                $image = $this->input->post('old_image'); 
            }
        
            $data = array(
                'title' => $this->input->post('edit_title'),
                'description' => $this->input->post('edit_description'),
                'url' => $this->input->post('edit_url'),
                'image' => $image
            );       
        
                $book_id = $this->input->post('edit_id'); 
                $this->db->where('id', $book_id);
                $this->db->update('tbl_reference_books', $data);
                 if ($this->db->affected_rows() > 0) {
                    $this->session->set_userdata('toastrSuccess', 'Updated successfully...');
                    redirect(UPLOAD_REFERENCEBK, 'refresh');
                   
                } else {
                   $this->session->set_userdata('toastrError', 'Updated successfully...');
                    redirect(UPLOAD_REFERENCEBK, 'refresh');
                   
                }
        }

    }

}
?>