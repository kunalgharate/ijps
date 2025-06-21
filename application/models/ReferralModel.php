<?php
class ReferralModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Get all referral requests
    public function getRequests() {
        $this->db->order_by('created_date', 'DESC');
        $query = $this->db->get('referral_requests');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array(); // Return empty array if no records found
        }
    }

    // Insert new referral request
    public function insertRequest($data) {
        $this->db->insert('referral_requests', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id(); // Return the ID of the inserted request
        } else {
            return false; // Return false if insertion fails
        }
    }

    // Update referral request
    public function updateRequest($id, $data) {
        // Ensure $data contains 'completed_status'
        if (isset($data['completed_status'])) {
            $this->db->where('id', $id);
            $this->db->update('referral_requests', $data);

            if ($this->db->affected_rows() > 0) {
                return true; // Successfully updated
            } else {
                return false; // Return false if update fails
            }
        } else {
            return false; // Return false if no status to update
        }
    }

    // Delete referral request
    public function deleteRequest($id) {
        $this->db->where('id', $id);
        $this->db->delete('referral_requests');
        
        if ($this->db->affected_rows() > 0) {
            return true; // Successfully deleted
        } else {
            return false; // Return false if deletion fails
        }
    }
}
