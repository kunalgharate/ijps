<?php

// Include iLovePDF SDK files manually
require_once APPPATH . 'third_party/ilovepdf/src/Ilovepdf.php';
require_once APPPATH . 'third_party/ilovepdf/src/Task.php';
require_once APPPATH . 'third_party/ilovepdf/src/CompressTask.php';
require_once APPPATH . 'third_party/ilovepdf/src/MergeTask.php';

use Ilovepdf\Ilovepdf;
use Ilovepdf\CompressTask;
use Ilovepdf\MergeTask;

class Ilovepdf_lib {
    private $ilovepdf;
    private $ci;
    
    public function __construct() {
        $this->ci =& get_instance(); // Load CI instance
        $this->ci->load->database(); // Load database

        // Fetch API keys dynamically
        $apiData = $this->getApiKeys();

        // print_r($apiData); die;
        if ($apiData) {
            $this->ilovepdf = new Ilovepdf($apiData->PublicKey, $apiData->SecretKey);
        } else {
            log_message('error', 'No active API keys found in ijps_tblapikey');
            throw new Exception('No active API keys found.');
        }
        
        // $this->ilovepdf = new Ilovepdf("project_public_47fcffc9127299a6cdd88f3dbsdadaasd2c40d9c_ilYye3dea150492d6be5e53ad8be79703a23c", "secret_key_1fd60ff845833c56a4becdsfds8f0f03011d5_LlZGvbae07d0ad542e56eb674e71d880bec39");
    }

    private function getApiKeys() {
        $query = $this->ci->db->select('PublicKey, SecretKey')
                              ->from('ijps_tblapikey')
                              ->where('isActive', 1) // Fetch only active API keys
                              ->order_by('createdDate', 'DESC') // Fetch the latest active key
                              ->limit(1)
                              ->get();

        return $query->row(); // Return a single row as an object
    }
    
    public function compressPDF($filePath) {
        try {
        // echo $filePath; die;
        // Define the download folder inside public_html
        $downloadPath = $_SERVER['DOCUMENT_ROOT'] . "/assetsbackoffice/uploads/article";
        
        // $projectPath = str_replace("https://ijpsjournal.com", "", "https://ijpsjournal.com/ijps_journal_demo");
        // $downloadPath = $_SERVER['DOCUMENT_ROOT'] . $projectPath . "/assetsbackoffice/uploads/article";
    
        // Ensure the folder exists
        if (!file_exists($downloadPath)) {
            mkdir($downloadPath, 0777, true);
        }
    
        // Initialize the compression task
        $task = new CompressTask($this->ilovepdf->getPublicKey(), $this->ilovepdf->getSecretKey()); 
    
        // Add file for compression
        $task->addFile($filePath);
        $task->execute();
    
        // Download the compressed file to the specified folder
        $task->download($downloadPath);
    
        // Generate the URL to access the file
        $downloadUrl = "https://ijpsjournal.com/assetsbackoffice/uploads/article";
    
        // echo "PDF successfully compressed! Download here: <a href='$downloadUrl' target='_blank'>$downloadUrl</a>";
        return ['status' => 'success', 'message' => 'PDF successfully compressed!', 'status_value' => '200'];

        } 
        catch (\Ilovepdf\Exceptions\AuthException $e) {
            return ['status' => 'error', 'message' => 'API Authentication failed. Please check your API keys.','status_value' => '100'];
        } catch (\Ilovepdf\Exceptions\UploadException $e) {
            return ['status' => 'error', 'message' => 'Upload error: ' . $e->getMessage(), 'status_value' => '300'];
        } catch (\Ilovepdf\Exceptions\ProcessException $e) {
            return ['status' => 'error', 'message' => 'Processing error: ' . $e->getMessage(), 'status_value' => '400'];
        } catch (\Ilovepdf\Exceptions\DownloadException $e) {
            return ['status' => 'error', 'message' => 'Download error: ' . $e->getMessage(), 'status_value' => '500'];
        } catch (\Ilovepdf\Exceptions\StartException $e) {
            return ['status' => 'error', 'message' => 'Task start error: ' . $e->getMessage(), 'status_value' => '600'];
        } catch (\Exception $e) {
            if ($e->getCode() == 429) {
                return ['status' => 'error', 'message' => 'Your API limit has expired. Please try again later.', 'status_value' => '700'];
            } else {
                return ['status' => 'error', 'message' => 'An error occurred: ' . $e->getMessage()];
            }
        }
    }

    
    // public function compressPDF($filePath) {
    //     // echo $filePath;
    //     // die;
    //     // echo $this->ilovepdf->getSecretKey(); die;  
    //     $task = new CompressTask($this->ilovepdf->getPublicKey(), $this->ilovepdf->getSecretKey());
          
    //     var_dump($task);
    //     die();
        

    //     $task->addFile($filePath);
    //     $task->execute();
    //     $task->download("downloads/");
    // }

    public function mergePDF($file1, $file2) {
        $task = new MergeTask($this->ilovepdf->getPublicKey(), $this->ilovepdf->getSecretKey());
        $task->addFile($file1);
        $task->addFile($file2);
        $task->execute();
        $task->download("downloads/");
    }
}
