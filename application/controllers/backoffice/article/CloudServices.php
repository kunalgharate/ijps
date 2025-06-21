<?php
class CloudServices extends CI_Controller {
    public function get_token() {
        // Generate a secure token
        $token = $this->generate_token();

        // Return the token in JSON format
        echo json_encode(['token' => $token]);
    }

    private function generate_token() {
        // Replace with logic to generate a secure token
        return base64_encode(json_encode([
            'user_id' => 'user123',
            'timestamp' => time(),
        ]));
    }
}
?>
