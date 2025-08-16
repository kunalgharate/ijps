<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Base Service Class
 * 
 * Provides common functionality for all service classes
 * Handles business logic and coordinates between controllers and repositories
 */
abstract class BaseService
{
    protected $CI;
    protected $repository;
    protected $validator;
    
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->library('form_validation');
        $this->validator = $this->CI->form_validation;
    }
    
    /**
     * Get all records with pagination
     */
    public function getAll($page = 1, $perPage = 15, array $filters = [])
    {
        try {
            $criteria = $this->buildCriteria($filters);
            $orderBy = $this->getDefaultOrderBy();
            
            return $this->repository->paginate($page, $perPage, $criteria, $orderBy);
        } catch (Exception $e) {
            log_message('error', 'Service Error in getAll: ' . $e->getMessage());
            throw new Exception('Failed to retrieve records');
        }
    }
    
    /**
     * Get record by ID
     */
    public function getById($id)
    {
        try {
            $this->validateId($id);
            return $this->repository->find($id);
        } catch (Exception $e) {
            log_message('error', 'Service Error in getById: ' . $e->getMessage());
            throw new Exception('Failed to retrieve record');
        }
    }
    
    /**
     * Create new record
     */
    public function create(array $data)
    {
        try {
            $this->validateCreateData($data);
            
            $this->repository->beginTransaction();
            
            $result = $this->repository->create($data);
            
            if ($result) {
                $this->repository->commit();
                $this->afterCreate($result, $data);
                return $result;
            } else {
                $this->repository->rollback();
                throw new Exception('Failed to create record');
            }
        } catch (Exception $e) {
            $this->repository->rollback();
            log_message('error', 'Service Error in create: ' . $e->getMessage());
            throw $e;
        }
    }
    
    /**
     * Update record
     */
    public function update($id, array $data)
    {
        try {
            $this->validateId($id);
            $this->validateUpdateData($data);
            
            $existing = $this->repository->findOrFail($id);
            
            $this->repository->beginTransaction();
            
            $result = $this->repository->update($id, $data);
            
            if ($result) {
                $this->repository->commit();
                $updated = $this->repository->find($id);
                $this->afterUpdate($updated, $existing, $data);
                return $updated;
            } else {
                $this->repository->rollback();
                throw new Exception('Failed to update record');
            }
        } catch (Exception $e) {
            $this->repository->rollback();
            log_message('error', 'Service Error in update: ' . $e->getMessage());
            throw $e;
        }
    }
    
    /**
     * Delete record
     */
    public function delete($id)
    {
        try {
            $this->validateId($id);
            
            $existing = $this->repository->findOrFail($id);
            
            $this->repository->beginTransaction();
            
            $result = $this->repository->delete($id);
            
            if ($result) {
                $this->repository->commit();
                $this->afterDelete($existing);
                return true;
            } else {
                $this->repository->rollback();
                throw new Exception('Failed to delete record');
            }
        } catch (Exception $e) {
            $this->repository->rollback();
            log_message('error', 'Service Error in delete: ' . $e->getMessage());
            throw $e;
        }
    }
    
    /**
     * Validate ID parameter
     */
    protected function validateId($id)
    {
        if (!is_numeric($id) || $id <= 0) {
            throw new InvalidArgumentException('Invalid ID provided');
        }
    }
    
    /**
     * Build criteria from filters
     */
    protected function buildCriteria(array $filters)
    {
        $criteria = [];
        
        // Add default active filter if not specified
        if (!isset($filters['isActive'])) {
            $criteria['isActive'] = '1';
        }
        
        // Process other filters
        foreach ($filters as $key => $value) {
            if (!empty($value)) {
                $criteria[$key] = $value;
            }
        }
        
        return $criteria;
    }
    
    /**
     * Get default order by
     */
    protected function getDefaultOrderBy()
    {
        return ['created_at' => 'DESC'];
    }
    
    /**
     * Validate create data
     */
    protected function validateCreateData(array $data)
    {
        $rules = $this->getCreateValidationRules();
        
        if (!empty($rules)) {
            $this->validator->set_data($data);
            $this->validator->set_rules($rules);
            
            if (!$this->validator->run()) {
                throw new InvalidArgumentException($this->validator->error_string());
            }
        }
    }
    
    /**
     * Validate update data
     */
    protected function validateUpdateData(array $data)
    {
        $rules = $this->getUpdateValidationRules();
        
        if (!empty($rules)) {
            $this->validator->set_data($data);
            $this->validator->set_rules($rules);
            
            if (!$this->validator->run()) {
                throw new InvalidArgumentException($this->validator->error_string());
            }
        }
    }
    
    /**
     * Get create validation rules
     */
    protected function getCreateValidationRules()
    {
        return [];
    }
    
    /**
     * Get update validation rules
     */
    protected function getUpdateValidationRules()
    {
        return [];
    }
    
    /**
     * Hook called after successful create
     */
    protected function afterCreate($result, array $data)
    {
        // Override in child classes
    }
    
    /**
     * Hook called after successful update
     */
    protected function afterUpdate($updated, $original, array $data)
    {
        // Override in child classes
    }
    
    /**
     * Hook called after successful delete
     */
    protected function afterDelete($deleted)
    {
        // Override in child classes
    }
    
    /**
     * Log activity
     */
    protected function logActivity($action, $entityId = null, array $data = [])
    {
        // Implement activity logging
        log_message('info', "Service Activity: {$action} - Entity ID: {$entityId}");
    }
}
