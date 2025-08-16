<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Base Entity Class
 * 
 * Provides common functionality for all entities
 * Implements Active Record pattern with validation
 */
abstract class BaseEntity
{
    protected $attributes = [];
    protected $original = [];
    protected $fillable = [];
    protected $guarded = ['id'];
    protected $hidden = [];
    protected $casts = [];
    protected $dates = ['created_at', 'updated_at'];
    protected $primaryKey = 'id';
    protected $table;
    
    public function __construct(array $attributes = [])
    {
        $this->fill($attributes);
        $this->syncOriginal();
    }
    
    /**
     * Fill entity with data
     */
    public function fill(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            if ($this->isFillable($key)) {
                $this->setAttribute($key, $value);
            }
        }
        return $this;
    }
    
    /**
     * Set attribute value
     */
    public function setAttribute($key, $value)
    {
        // Apply casting
        if (isset($this->casts[$key])) {
            $value = $this->castAttribute($key, $value);
        }
        
        $this->attributes[$key] = $value;
        return $this;
    }
    
    /**
     * Get attribute value
     */
    public function getAttribute($key)
    {
        if (array_key_exists($key, $this->attributes)) {
            $value = $this->attributes[$key];
            
            // Apply casting
            if (isset($this->casts[$key])) {
                return $this->castAttribute($key, $value);
            }
            
            return $value;
        }
        
        return null;
    }
    
    /**
     * Magic getter
     */
    public function __get($key)
    {
        return $this->getAttribute($key);
    }
    
    /**
     * Magic setter
     */
    public function __set($key, $value)
    {
        $this->setAttribute($key, $value);
    }
    
    /**
     * Check if attribute is fillable
     */
    protected function isFillable($key)
    {
        if (in_array($key, $this->guarded)) {
            return false;
        }
        
        if (empty($this->fillable)) {
            return true;
        }
        
        return in_array($key, $this->fillable);
    }
    
    /**
     * Cast attribute to specified type
     */
    protected function castAttribute($key, $value)
    {
        $castType = $this->casts[$key];
        
        switch ($castType) {
            case 'int':
            case 'integer':
                return (int) $value;
            case 'float':
            case 'double':
                return (float) $value;
            case 'string':
                return (string) $value;
            case 'bool':
            case 'boolean':
                return (bool) $value;
            case 'array':
                return is_string($value) ? json_decode($value, true) : $value;
            case 'json':
                return json_decode($value, true);
            case 'datetime':
                return $value ? new DateTime($value) : null;
            default:
                return $value;
        }
    }
    
    /**
     * Convert entity to array
     */
    public function toArray()
    {
        $array = [];
        foreach ($this->attributes as $key => $value) {
            if (!in_array($key, $this->hidden)) {
                $array[$key] = $value;
            }
        }
        return $array;
    }
    
    /**
     * Convert entity to JSON
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }
    
    /**
     * Sync original attributes
     */
    protected function syncOriginal()
    {
        $this->original = $this->attributes;
    }
    
    /**
     * Check if entity has been modified
     */
    public function isDirty($key = null)
    {
        if ($key !== null) {
            return isset($this->attributes[$key]) && 
                   $this->attributes[$key] !== ($this->original[$key] ?? null);
        }
        
        return $this->attributes !== $this->original;
    }
    
    /**
     * Get dirty attributes
     */
    public function getDirty()
    {
        $dirty = [];
        foreach ($this->attributes as $key => $value) {
            if ($this->isDirty($key)) {
                $dirty[$key] = $value;
            }
        }
        return $dirty;
    }
    
    /**
     * Validate entity data
     */
    abstract public function validate();
    
    /**
     * Get validation rules
     */
    abstract protected function getValidationRules();
}
