<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Repository Interface
 * 
 * Defines contract for all repository classes
 * Ensures consistent data access methods
 */
interface RepositoryInterface
{
    /**
     * Find record by ID
     * 
     * @param int $id
     * @return mixed|null
     */
    public function find($id);
    
    /**
     * Find record by ID or throw exception
     * 
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function findOrFail($id);
    
    /**
     * Find records by criteria
     * 
     * @param array $criteria
     * @param array $orderBy
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function findBy(array $criteria = [], array $orderBy = [], $limit = null, $offset = null);
    
    /**
     * Find first record by criteria
     * 
     * @param array $criteria
     * @param array $orderBy
     * @return mixed|null
     */
    public function findOneBy(array $criteria = [], array $orderBy = []);
    
    /**
     * Get all records
     * 
     * @param array $orderBy
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function findAll(array $orderBy = [], $limit = null, $offset = null);
    
    /**
     * Create new record
     * 
     * @param array $data
     * @return mixed
     */
    public function create(array $data);
    
    /**
     * Update record by ID
     * 
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, array $data);
    
    /**
     * Delete record by ID
     * 
     * @param int $id
     * @return bool
     */
    public function delete($id);
    
    /**
     * Count records by criteria
     * 
     * @param array $criteria
     * @return int
     */
    public function count(array $criteria = []);
    
    /**
     * Check if record exists
     * 
     * @param array $criteria
     * @return bool
     */
    public function exists(array $criteria);
    
    /**
     * Paginate records
     * 
     * @param int $page
     * @param int $perPage
     * @param array $criteria
     * @param array $orderBy
     * @return array
     */
    public function paginate($page = 1, $perPage = 15, array $criteria = [], array $orderBy = []);
}
