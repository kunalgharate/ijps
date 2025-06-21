<?php
class ReferralController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ReferralModel');
        $this->load->library('form_validation'); // Ensure form validation is loaded
        $this->load->library('upload'); // Load the upload library here
    }

    // Display the dashboard
    public function index() {
        $data['requests'] = $this->ReferralModel->getRequests();
        $this->load->view('backoffice/referralprogram', $data);
    }

    // Method to handle the referral form submission (submitReferral)
    public function submitReferral() {
        // Validation rules
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('article_id', 'Article ID', 'required');
        $this->form_validation->set_rules('title_of_paper', 'Title of Paper', 'required');
        $this->form_validation->set_rules('upi_id', 'UPI ID', 'required');

        if ($this->form_validation->run() === FALSE) {
            // Return validation error in JSON format for AJAX
            echo json_encode(array('status' => 'error', 'msg' => strip_tags(validation_errors()))); // Strip tags for cleaner message
            return;
        }

        // Handle file upload
        $filePath = $this->uploadFile();
        if ($filePath === false) {
            echo json_encode(array('status' => 'error', 'msg' => 'File upload failed or file type is not supported.'));
            return;
        }

        // Collect form data
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'article_id' => $this->input->post('article_id'),
            'title_of_paper' => $this->input->post('title_of_paper'),
            'upi_id' => $this->input->post('upi_id'),
            'file_path' => $filePath // Save the uploaded file path
        );

        // Insert request data into the database
        $this->ReferralModel->insertRequest($data);

        // Send success response
        echo json_encode(array('status' => 'success', 'msg' => 'Referral submitted successfully.'));
    }

    // Add new request with validation
    public function addRequest() {
        // Validation rules
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('article_id', 'Article ID', 'required');
        $this->form_validation->set_rules('title_of_paper', 'Title of Paper', 'required');
        $this->form_validation->set_rules('upi_id', 'UPI ID', 'required');

        if ($this->form_validation->run() === FALSE) {
            // Handle validation errors (redirect or load view)
            redirect('backoffice/referral'); // Add error handling or flash messages as needed
        } else {
            $filePath = $this->uploadFile();
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'article_id' => $this->input->post('article_id'),
                'title_of_paper' => $this->input->post('title_of_paper'),
                'upi_id' => $this->input->post('upi_id'),
                'file_path' => $filePath // optional
            );

            $this->ReferralModel->insertRequest($data);
            redirect('backoffice/referral');
        }
    }

    // Update request status with validation
    public function updateRequest() {
        $id = $this->input->post('id');
        $data = array(
            'completed_status' => $this->input->post('completed_status')
        );
        
        $this->ReferralModel->updateRequest($id, $data);
        echo json_encode(array('status' => 'success', 'msg' => 'Status updated successfully.'));
    }

    // Delete request
    public function deleteRequest() {
        $id = $this->input->post('id');
        $this->ReferralModel->deleteRequest($id);
        echo json_encode(array('status' => 'success', 'msg' => 'Request deleted successfully.'));
    }

    // Upload file function
    private function uploadFile() {
        if (!isset($_FILES['payment_receipt']) || $_FILES['payment_receipt']['size'] == 0) {
            return null; // No file uploaded, return null if not mandatory
        }

        $config['upload_path'] = './uploads/referral/';
        $config['allowed_types'] = 'jpg|jpeg|png|tif|heic|pdf'; // Specify allowed file types
        $config['max_size'] = 4048; // Max size 4MB

        // Initialize upload library with the configuration
        $this->upload->initialize($config);

        if ($this->upload->do_upload('payment_receipt')) { // Ensure the field name matches the form
            return $this->upload->data('file_name');
        } else {
            // Handle upload error, return false
            return false;
        }
    }

    
}
?>
