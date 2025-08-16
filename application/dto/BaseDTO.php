<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Base Data Transfer Object (DTO)
 * 
 * Provides structure for transferring data between application layers
 * Ensures data integrity and type safety
 */
abstract class BaseDTO
{
    protected $data = [];
    protected $rules = [];
    protected $messages = [];
    
    public function __construct(array $data = [])
    {
        $this->fill($data);
        $this->validate();
    }
    
    /**
     * Fill DTO with data
     */
    public function fill(array $data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key) || method_exists($this, 'set' . ucfirst($key))) {
                $this->$key = $value;
            }
        }
        return $this;
    }
    
    /**
     * Convert DTO to array
     */
    public function toArray()
    {
        $array = [];
        $reflection = new ReflectionClass($this);
        $properties = $reflection->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED);
        
        foreach ($properties as $property) {
            $property->setAccessible(true);
            $name = $property->getName();
            
            if ($name !== 'rules' && $name !== 'messages') {
                $array[$name] = $property->getValue($this);
            }
        }
        
        return $array;
    }
    
    /**
     * Convert DTO to JSON
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }
    
    /**
     * Validate DTO data
     */
    public function validate()
    {
        $CI =& get_instance();
        $CI->load->library('form_validation');
        
        if (!empty($this->rules)) {
            $CI->form_validation->set_data($this->toArray());
            $CI->form_validation->set_rules($this->rules);
            
            if (!empty($this->messages)) {
                $CI->form_validation->set_message($this->messages);
            }
            
            if (!$CI->form_validation->run()) {
                throw new InvalidArgumentException($CI->form_validation->error_string());
            }
        }
        
        return true;
    }
    
    /**
     * Check if DTO is valid
     */
    public function isValid()
    {
        try {
            $this->validate();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    
    /**
     * Get validation errors
     */
    public function getErrors()
    {
        try {
            $this->validate();
            return [];
        } catch (Exception $e) {
            return [$e->getMessage()];
        }
    }
    
    /**
     * Magic getter
     */
    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        
        $method = 'get' . ucfirst($name);
        if (method_exists($this, $method)) {
            return $this->$method();
        }
        
        return null;
    }
    
    /**
     * Magic setter
     */
    public function __set($name, $value)
    {
        $method = 'set' . ucfirst($name);
        if (method_exists($this, $method)) {
            return $this->$method($value);
        }
        
        if (property_exists($this, $name)) {
            $this->$name = $value;
        }
    }
    
    /**
     * Magic isset
     */
    public function __isset($name)
    {
        return property_exists($this, $name) && isset($this->$name);
    }
    
    /**
     * Create DTO from array
     */
    public static function fromArray(array $data)
    {
        return new static($data);
    }
    
    /**
     * Create DTO from JSON
     */
    public static function fromJson($json)
    {
        $data = json_decode($json, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new InvalidArgumentException('Invalid JSON provided');
        }
        
        return new static($data);
    }
}
