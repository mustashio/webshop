<?php
namespace Webshop\Model;
use       \Webshop\Webshop as Webshop;

class Model {
    
    public static $table = '';
	public $data 		 = array();
	public $dirty		 = false;
	public $new_record	 = false;
	
    public function __construct($id = null, $data = array()) {
		
		if (is_int($id) && count($data) == 0) {
			
			$this->data = static::find($id);
			
		} else if ($id === null) {
			
			$this->new_record = true;
			$this->data		  = $data;
			$this->dirty	  = true;
			
		} else {
			
			throw new \Webshop\Model\Exception('WRONG DATA SUPPLIED TO MODEL');
		}
    }
	
	public function __get($field) {
		return (isset($this->data[$field]) ? $this->data[$field] : null);
	}
	
	public function __set($field, $value) {
				
		$this->data[$field] = $value;
		$this->dirty		= true;
	}
	
	public function isDirty() {
		return $this->dirty;
	}
	
	public function save() {

		$this->setTimeFields();

		$values    = array_map(function($value) {
			return (':' . $value); 
		}, array_keys($this->data));
		
		if ($this->dirty) {
			
			if ($this->new_record) {

				$statement = \Webshop\Webshop::$db->prepare('INSERT INTO `' . static::$table . '` (' . implode(', ', array_keys($this->data)) . ') VALUES(' . implode(', ', $values) . ')');
					
				foreach ($this->data as $fieldName => $valueName) {
					$statement->bindValue(':' . $fieldName, $valueName);
				}
				
				$statement->execute();
				
				$this->data = static::find(\Webshop\Webshop::$db->lastInsertId());
				
			} else {
				
				$set = array();
				foreach ($this->data as $field => $value) {
					$set[] = $field . ' = :' . $field;
				}
				
				$statement = \Webshop\Webshop::$db->prepare('UPDATE `' . static::$table . '` SET ' . implode(', ', $set) . ' WHERE id = :id');
				
				foreach ($this->data as $field => $value) {
					$statement->bindValue(':' . $field, $value);
				}
				
				$statement->execute();
			}
			
			return true;
			
		} else {
			
			return false;
		}
	}
	
	public function setTimeFields() {

		$currentDate   = new \DateTime('now', new \DateTimeZone('utc'));
		$formattedDate = $currentDate->format('Y-m-d H:i:s');
		
		foreach (array('created_at', 'updated_at') as $field) {
				
			if ($this->new_record === false && $field == 'created_at') {
				continue;
			}
				
			$this->data[$field] = $formattedDate;
		}
	}
	
	public static function find($id) {

		$select = \Webshop\Webshop::$db->prepare('SELECT * FROM `' . static::$table . '` WHERE `id` = :id LIMIT 1');
    	$select->bindParam(':id', $id, \PDO::PARAM_INT);
		$select->execute();
		
		$data = $select->fetch(\PDO::FETCH_ASSOC);
		
		if ($data === false) {
			throw new \Webshop\Model\Exception('RECORD ' . $id . ' FROM ' . static::$table . ' NOT FOUND');
		}
		
		return $data;
	}
	
    public static function getAll() {
    	
		$select  = \Webshop\Webshop::$db->prepare('SELECT * FROM `' . static::$table . '`');
		$select->execute();
		
		$results = $select->fetchAll(\PDO::FETCH_ASSOC);
		$records = array();
		$model   = get_called_class();

		foreach ($results as $result) {
			$records[] = new $model($result['id'], $result);
		}
		
		return $records;
    }
}