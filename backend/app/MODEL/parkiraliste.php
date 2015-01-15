<?php
include_once('../BASE/core.php');
include_once('../BASE/base.php');

class Parkiraliste{	
	    public $naziv = "";
        public $adresa = "";
        public $zemljopisnaSirina = "";
        public $zemljopisnaDuzina = "";
        public $brojMjesta = "";
        public $idTip = "";
        public $cijena = "";
    	
	
	public $id = -1;
	public $created_at = 0;
	public $updated_at = 0;
	
	
	private $className = "parkiraliste";
	
	
	public function __construct()
  	{
		$this->className = strtolower(__CLASS__);
	}
	
	public static function init($naziv,$adresa,$zemljopisnaSirina,$zemljopisnaDuzina,$brojMjesta,$idTip,$cijena)
  	{
		$instance = new self();
		$instance->className = strtolower(__CLASS__);
		
				$instance->naziv = $naziv;
        
        		$instance->adresa = $adresa;
        
        		$instance->zemljopisnaSirina = $zemljopisnaSirina;
        
        		$instance->zemljopisnaDuzina = $zemljopisnaDuzina;
        
        		$instance->brojMjesta = $brojMjesta;
        
        		$instance->idTip = $idTip;
        
        		$instance->cijena = $cijena;
        
        		
		return $instance;
  	}
	
	public function toArray()
	{
		return get_object_vars($this);
	}
	
	public function save()
	{
		
		if($this->id == -1)
		{
			$keyValues = array();
			
						$keyValues['naziv'] = $this->naziv;
            			$keyValues['adresa'] = $this->adresa;
            			$keyValues['zemljopisnaSirina'] = $this->zemljopisnaSirina;
            			$keyValues['zemljopisnaDuzina'] = $this->zemljopisnaDuzina;
            			$keyValues['brojMjesta'] = $this->brojMjesta;
            			$keyValues['idTip'] = $this->idTip;
            			$keyValues['cijena'] = $this->cijena;
            			
			
			$this->created_at = $keyValues['created_at'] = date("Y-m-d h:i:s");
			
			$id = Base::insert($this->className, $keyValues);
			
			$this->id = $id;
			$this->findById();
		}
		else
		{
			$keyValues = array();
			
						$keyValues['naziv'] = $this->naziv;
            			$keyValues['adresa'] = $this->adresa;
            			$keyValues['zemljopisnaSirina'] = $this->zemljopisnaSirina;
            			$keyValues['zemljopisnaDuzina'] = $this->zemljopisnaDuzina;
            			$keyValues['brojMjesta'] = $this->brojMjesta;
            			$keyValues['idTip'] = $this->idTip;
            			$keyValues['cijena'] = $this->cijena;
            			
			$this->updated_at = $keyValues['updated_at'] = date("Y-m-d h:i:s");
			
			$whereArray = array();
			$where['id'] = $this->id;
			
			Base::updateAND($this->className, $keyValues, $where);

			
			$this->findById();
			
		}
		
	}
	
	public static function find($id)
		{
			$model = new self;
			$where = array();
			$where['id'] = $id;
			$result = Base::selectAND(strtolower(__CLASS__), $where, false);
			

			$model->id = $result['id'];
			$model->created_at = $result['created_at'];
			$model->updated_at = $result['updated_at'];
			
						$model->naziv = $result['naziv'];
			 			$model->adresa = $result['adresa'];
			 			$model->zemljopisnaSirina = $result['zemljopisnaSirina'];
			 			$model->zemljopisnaDuzina = $result['zemljopisnaDuzina'];
			 			$model->brojMjesta = $result['brojMjesta'];
			 			$model->idTip = $result['idTip'];
			 			$model->cijena = $result['cijena'];
			              
			return $model;
		}
		
	private function findById()
		{

			$where = array();
			$where['id'] = $this->id;
			$result = Base::selectAND(strtolower(__CLASS__), $where, false);
			
			

			$this->id = $result['id'];
			$this->created_at = $result['created_at'];
			$this->updated_at = $result['updated_at'];
			
						$this->naziv = $result['naziv'];
			 			$this->adresa = $result['adresa'];
			 			$this->zemljopisnaSirina = $result['zemljopisnaSirina'];
			 			$this->zemljopisnaDuzina = $result['zemljopisnaDuzina'];
			 			$this->brojMjesta = $result['brojMjesta'];
			 			$this->idTip = $result['idTip'];
			 			$this->cijena = $result['cijena'];
			 		}

		
		
		public static function findAll()
		{
			$returnArray = array();
			$result = Base::selectAll(strtolower(__CLASS__));
			
			
			foreach($result as $element)
			{
				$model = new self;
				
				$model->id = $element['id'];
				$model->created_at = $element['created_at'];
				$model->updated_at = $element['updated_at'];
			
								$model->naziv = $element['naziv'];
                 				$model->adresa = $element['adresa'];
                 				$model->zemljopisnaSirina = $element['zemljopisnaSirina'];
                 				$model->zemljopisnaDuzina = $element['zemljopisnaDuzina'];
                 				$model->brojMjesta = $element['brojMjesta'];
                 				$model->idTip = $element['idTip'];
                 				$model->cijena = $element['cijena'];
                 				
				array_push($returnArray, $model);
			}
			
			return $returnArray;
		}
		
		public function destroy()
		{
			$where = array();
			$where['id'] = $this->id;
			
			Base::deleteAND($this->className, $where);
			
						$this->naziv = "";
            			$this->adresa = "";
            			$this->zemljopisnaSirina = "";
            			$this->zemljopisnaDuzina = "";
            			$this->brojMjesta = "";
            			$this->idTip = "";
            			$this->cijena = "";
            	
			$this->id = -1;
			$this->created_at = 0;
			$this->updated_at = 0;
	
			
			$this->className = "parkiraliste";
		}
		
		public function filter()
		{
			$returnArray = array();
			$elements = array();
			
			$elements['id'] = $this->id;
			$elements['created_at'] = $this->created_at;
			$elements['updated_at'] = $this->updated_at;
			
						$elements['naziv'] = $this->naziv;
			 			$elements['adresa'] = $this->adresa;
			 			$elements['zemljopisnaSirina'] = $this->zemljopisnaSirina;
			 			$elements['zemljopisnaDuzina'] = $this->zemljopisnaDuzina;
			 			$elements['brojMjesta'] = $this->brojMjesta;
			 			$elements['idTip'] = $this->idTip;
			 			$elements['cijena'] = $this->cijena;
			 			
			if($elements['id'] == "-1")
			{
				$elements['id'] = NULL;
			}
			
			$elements = array_filter($elements);
			
			
			
			$result = Base::selectAND(strtolower(__CLASS__), $elements);
			
			foreach($result as $element)
			{
				$model = new self;
				
				$model->id = $element['id'];
				$model->created_at = $element['created_at'];
				$model->updated_at = $element['updated_at'];
				
								$model->naziv = $element['naziv'];
                				$model->adresa = $element['adresa'];
                				$model->zemljopisnaSirina = $element['zemljopisnaSirina'];
                				$model->zemljopisnaDuzina = $element['zemljopisnaDuzina'];
                				$model->brojMjesta = $element['brojMjesta'];
                				$model->idTip = $element['idTip'];
                				$model->cijena = $element['cijena'];
                                 				
				array_push($returnArray, $model);
			}
			
			return $returnArray;
		}

}

?>
