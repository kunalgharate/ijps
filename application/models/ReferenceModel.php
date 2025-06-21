<?php

class ReferenceModel extends CI_Model
{
    public function getList()
    {
        $postData = $this->input->post();
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; 
        $columnIndex = $postData['order'][0]['column']; 
        $columnName = $postData['columns'][$columnIndex]['data']; 
        $columnSortOrder = $postData['order'][0]['dir'];
        $searchValue = $postData['search']['value'];
    
       
        $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = "(title LIKE '%" . $searchValue . "%' OR 
                            description LIKE '%" . $searchValue . "%' OR
                            image LIKE '%" . $searchValue . "%' OR
                            url LIKE '%" . $searchValue . "%')";
        }
    
       
        $this->db->select('COUNT(*) as allcount');
        $totalRecords = $this->db->get('tbl_reference_books')->row()->allcount;
    
       
        $this->db->select('COUNT(*) as allcount');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $totalRecordwithFilter = $this->db->get('tbl_reference_books')->row()->allcount;
    
      
        $this->db->select('*');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->where('is_deleted', 0);
        // $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $this->db->order_by('id', 'desc');
        $records = $this->db->get('tbl_reference_books')->result();
    
      
        $data = array();
        foreach ($records as $record) {
            $data[] = array(
                'id' => $record->id,
                'title' => $record->title,
                'description' => '<div title="' . $record->description. '">' . $this->truncateText($record->description, 20) . '</div>',
                'image' => $record->image,
                'url' => $record->url,
                'action' => '<a href="javascript:void(0)" onclick="deleteReference(this);" data-id="' . $record->id . '" class="btn btn-sm"><i class="fa fa-trash"></i></a> <a href="javascript:void(0)" onclick="editReference(this);" data-id="' . $record->id . '" class="btn btn-sm"><i class="fa fa-edit"></i></a>
                ',
            );
        }
    
       
        $response = array(
            'draw' => intval($draw),
            'iTotalRecords' => $totalRecords,
            'iTotalDisplayRecords' => $totalRecordwithFilter,
            'aaData' => $data
        );
    
       return $response;
    }
    
    function truncateText($text, $length) {
    if (strlen($text) > $length) {
        $truncatedText = substr($text, 0, $length) . '...';
    } else {
        $truncatedText = $text;
    }
    return $truncatedText;
}
    
     
    public function deleteReference($id)
    {
        if($id!==''){           
            $data = array(
                'is_deleted' => 1                
            );
            
            $this->db->where('id ', $id);
            if($this->db->update('tbl_reference_books', $data)){
                return true;
            }else{
                return false;
            }
           
        }
       
    }
    public function getDataReference($id){
        $this->db->select('*');
        $this->db->where('id',$id);
         $records = $this->db->get('tbl_reference_books')->result();
         if(is_array( $records)){
             return  $records;
         }else{
             array();
         }

    }
    
      public function getPaymentList()
    {
        $postData = $this->input->post();
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; 
        $columnIndex = $postData['order'][0]['column']; 
        $columnName = $postData['columns'][$columnIndex]['data']; 
        $columnSortOrder = $postData['order'][0]['dir'];
        $searchValue = $postData['search']['value'];
    
       
        $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = "(title LIKE '%" . $searchValue . "%' OR 
                            description LIKE '%" . $searchValue . "%' OR
                            image LIKE '%" . $searchValue . "%' OR
                            url LIKE '%" . $searchValue . "%')";
        }
    
       
        $this->db->select('COUNT(*) as allcount');
        $totalRecords = $this->db->get('tbl_reference_books')->row()->allcount;
    
       
        $this->db->select('COUNT(*) as allcount');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $totalRecordwithFilter = $this->db->get('tbl_reference_books')->row()->allcount;
    
      
        $this->db->select('*');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->where('is_deleted', 0);
        // $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $this->db->order_by('id', 'desc');
        $records = $this->db->get('tbl_reference_books')->result();
    
      
        $data = array();
        foreach ($records as $record) {
            $data[] = array(
                'id' => $record->id,
                'title' => $record->title,
                'description' => '<div title="' . $record->description. '">' . $this->truncateText($record->description, 20) . '</div>',
                'image' => $record->image,
                'url' => $record->url,
                'action' => '<a href="javascript:void(0)" onclick="deleteReference(this);" data-id="' . $record->id . '" class="btn btn-sm"><i class="fa fa-trash"></i></a> <a href="javascript:void(0)" onclick="editReference(this);" data-id="' . $record->id . '" class="btn btn-sm"><i class="fa fa-edit"></i></a>
                ',
            );
        }
    
       
        $response = array(
            'draw' => intval($draw),
            'iTotalRecords' => $totalRecords,
            'iTotalDisplayRecords' => $totalRecordwithFilter,
            'aaData' => $data
        );
    
       return $response;
    }
}
