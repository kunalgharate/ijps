<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class StateModel extends CI_Model 
    {
    	public function __construct()
        {
        	parent::__construct();
        }
        
        function getStates()
        {
			$this->db->select("pp_tblstate.*, pp_tblcountry.countryName");	
			$this->db->join('pp_tblcountry', 'pp_tblcountry.countryID = pp_tblstate.countryID');
            $this->db->order_by('stateID', 'desc');
            $result = $this->db->get('pp_tblstate');
            return $result->result_array();
        }
		
		function getStateAsPerCountry($countryID)
        {
            $query = $this->db->get_where('pp_tblstate', array('countryID' => $countryID));
            //return $query;
            return $query->result_array();
        }
	}
