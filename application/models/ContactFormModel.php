<?php

class ContactFormModel extends CI_Model
{
    function getEmployees($postData = null)
    {
        $response = array();
        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length'];
        $columnIndex = $postData['order'][0]['column'];
        $columnName = $postData['columns'][$columnIndex]['data'];
        $columnSortOrder = $postData['order'][0]['dir']; 
        $searchValue = $postData['search']['value']; 

      
        $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = " (name like '%" . $searchValue . "%' or 
          emailID like '%" . $searchValue . "%') ";
        }


     
        $this->db->select('count(*) as allcount');
        $records = $this->db->get('ijps_tblcontactformdata')->result();
        $totalRecords = $records[0]->allcount;

      
        $this->db->select('count(*) as allcount');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $records = $this->db->get('ijps_tblcontactformdata')->result();
        $totalRecordwithFilter = $records[0]->allcount;


       
        $this->db->select('*');
        if ($searchQuery != '')
        $this->db->where($searchQuery);
        $this->db->where('isActive',1);
        // $this->db->order_by($columnName, $columnSortOrder);
         $this->db->order_by('contactFormDataID', 'desc');
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get('ijps_tblcontactformdata')->result();

        $data = array();
        $srno=1;
        foreach ($records as $record) {

            $data[] = array(
                "contactFormDataID " => $record->contactFormDataID,
                "name" => $record->name,
                "emailID" => $record->emailID,
                "contactNumber" => $record->contactNumber,
                "subject" => $record->subject,
                "message" => $record->message,
                "createdDate" => $record->createdDate,
                "action" => '<a href="javascript:void(0)" onclick="deleteContact(this);" data-id="'.$record->contactFormDataID.'" class="btn btn-sm"><i class="fa fa-trash"></i>',
               
            );
        }

     
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        return $response;
    }

    public function deleteContact($id)
    {
        if($id!==''){           
            $data = array(
                'isActive' => 0               
            );
            
            $this->db->where('contactFormDataID ', $id);
            if($this->db->update('ijps_tblcontactformdata', $data)){
                return true;
            }else{
                return false;
            }
           
        }
       
    }
}
