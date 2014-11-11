<?php
/**
 * Webshop (https://github.com/ibrahimabdullah/webshop)
 *
 * @link 	  https://github.com/ibrahimabdullah/webshop for the repo
 * @copyright Copyright (c) 2014 Ibrahim Abdullah
 * @license   MIT License (http://opensource.org/licenses/MIT)
 * @author    Ibrahim Abdullah <ibrahim.abdullah@outlook.com>
 */
namespace Webshop\Model;
use       Webshop\Webshop;
use       Webshop\Model\Exception as ModelException;

class Model {
    
	/**
	 * @var string
	 */
    protected static $table = '';
	
	/**
	 * @var array
	 */
	protected $data 	    = [];
	
	/**
	 * Flag to see if record has been altered
	 *
	 * @var boolean
	 */
	protected $dirty	    = false;
	
	/**
	 * Flag to see if record is new
	 *
	 * @var boolean
	 */
	protected $new_record   = false;
	
	/**
	 * @param int   $id
	 * @param array $data
	 */
    public function __construct($id = null, $data = []) {
		
		if (is_int($id) && count($data) == 0) {
			
			$this->data = static::find($id);
			
		} else if ($id === null) {
			
			$this->new_record = true;
			$this->data		  = $data;
			$this->dirty	  = true;
			
		} else {
			
			throw new ModelException('WRONG DATA SUPPLIED TO MODEL');
		}
    }
	
	/**
	 * @param string $field
	 */
	public function __get($field) {
		return (isset($this->data[$field]) ? $this->data[$field] : null);
	}
	
	/**
	 * @param string $field
	 * @param mixed  $value
	 */
	public function __set($field, $value) {
				
		$this->data[$field] = $value;
		$this->dirty		= true;
	}
	
	/**
	 * @return boolean
	 */
	public function dirty() {
		return $this->dirty;
	}
	
	/**
	 * @return boolean
	 */
	public function newRecord() {
		return $this->new_record;
	}
	
	/**
	 * @return boolean
	 */
	public function save() {

		$this->setTimeFields();

		$values    = array_map(function($value) {
			return (':' . $value); 
		}, array_keys($this->data));
		
		if ($this->dirty()) {
			
			if ($this->newRecord()) {

				$connection = Webshop::connection();
				$statement  = $connection->prepare('INSERT INTO `' . static::$table . '` (' . implode(', ', array_keys($this->data)) . ') VALUES(' . implode(', ', $values) . ')');
					
				foreach ($this->data as $fieldName => $valueName) {
					$statement->bindValue(':' . $fieldName, $valueName);
				}
				
				$statement->execute();
				
				$this->data = static::find($connection->lastInsertId());
				
			} else {
				
				$set = array();
				foreach ($this->data as $field => $value) {
					$set[] = $field . ' = :' . $field;
				}
				
				$statement = $connection->prepare('UPDATE `' . static::$table . '` SET ' . implode(', ', $set) . ' WHERE id = :id');
				
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
	
	/**
	 * @return void
	 */
	public function setTimeFields() {

		$currentDate   = new \DateTime('now', new \DateTimeZone('utc'));
		$formattedDate = $currentDate->format('Y-m-d H:i:s');
		
		foreach (array('created_at', 'updated_at') as $field) {
				
			if (false === $this->newRecord() && $field === 'created_at') {
				continue;
			}
				
			$this->data[$field] = $formattedDate;
		}
	}
	
	/**
	 * Finding a record
	 *
	 * @var int $id
	 */
	public static function find($id) {

		$select = \Webshop\Webshop::$db->prepare('SELECT * FROM `' . static::$table . '` WHERE `id` = :id LIMIT 1');
    	$select->bindParam(':id', $id, \PDO::PARAM_INT);
		$select->execute();
		
		$data = $select->fetch(\PDO::FETCH_ASSOC);
		
		if ($data === false) {
			throw new ModelException('RECORD ' . $id . ' FROM ' . static::$table . ' NOT FOUND');
		}
		
		return $data;
	}
	
	/**
	 * @return Model[]
	 */
    public static function getAll() {
    	
		$connection = Webshop::connection();
		$select  	= $connection->prepare('SELECT * FROM `' . static::$table . '`');
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