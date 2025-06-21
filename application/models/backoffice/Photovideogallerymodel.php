<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class PhotoVideoGalleryModel extends CI_Model 
    {
    	public function __construct()
        {
        	parent::__construct();
        }
        
        function getPhotoVideoGalleries()
        {
			$this->db->select("tblphotovideogallery.*, tblphotovideogallerycategory.name");
			$this->db->join('tblphotovideogallerycategory', 'tblphotovideogallery.photoVideoGallerycategoryID = tblphotovideogallerycategory.photoVideoGallerycategoryID');
            $this->db->order_by('photoVideoGalleryID', 'desc');
            $result = $this->db->get('tblphotovideogallery');
            return $result->result_array();
        }
		
		function setPinPhotoVideoGalleryCategory($table, $pin, $id, $pkey)
		{
			$this->db->set('pin', $pin);
			$this->db->where($pkey, $id);
			return $this->db->update($table);
		}
	}
