<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class CityModel extends CI_Model 
    {
    	public function __construct()
        {
        	parent::__construct();
        }
        
        function getCities()
        {
			$this->db->select("pp_tblcity.*, pp_tblstate.stateName");	
			$this->db->join('pp_tblstate', 'pp_tblstate.stateID = pp_tblcity.stateID');
            $this->db->order_by('cityID', 'desc');
            $result = $this->db->get('pp_tblcity');
            return $result->result_array();
        }
		
		function getCityAsPerState($stateID)
        {
            $query = $this->db->get_where('pp_tblcity', array('stateID' => $stateID));
            //return $query;
            return $query->result_array();
        }
	}
