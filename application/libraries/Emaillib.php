

<?php 
require APPPATH.'third_party/PHPMailer/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Emaillib extends PHPMailer
{
    public function load(){
        
        $mail = new PHPMailer(true);
        
        $mail->isSMTP(); 
        $mail->SMTDebug=1;
        $mail->Host = 'smtp.hostinger.com'; 
        $mail->SMTPAuth = true; 
        $mail->Username = 'editor@ijpsjournal.com'; 
        $mail->Password = pass1; 
        $mail->SMTPSecure = 'ssl'; 
        $mail->Port = 465; 
        // Content
        $mail->isHTML(true); 
         $mail->setFrom('editor@ijpsjournal.com', 'International Journal of Pharmaceutical Sciences');
         $mail->addReplyTo('editor@ijpsjournal.com', 'International Journal of Pharmaceutical Sciences');
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => true,
                'verify_peer_name' => true,
                'allow_self_signed' => false
            )
        );
       
        return $mail;
    }

    
}
?>