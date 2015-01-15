<?php
include_once('../BASE/core.php');
include_once('../BASE/base.php');

class Registriranikorisnik{	
	    public $korisnickoIme = "";
        public $lozinka = "";
        public $ime = "";
        public $prezime = "";
    	
	
	public $id = -1;
	public $created_at = 0;
	public $updated_at = 0;
	
	
	private $className = "registriranikorisnik";
	
	
	public function __construct()
  	{
		$this->className = strtolower(__CLASS__);
	}
	
	public static function init($korisnickoIme,$lozinka,$ime,$prezime)
  	{
		$instance = new self();
		$instance->className = strtolower(__CLASS__);
		
				$instance->korisnickoIme = $korisnickoIme;
        
        		$instance->lozinka = $lozinka;
        
        		$instance->ime = $ime;
        
        		$instance->prezime = $prezime;
        
        		
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
			
						$keyValues['korisnickoIme'] = $this->korisnickoIme;
            			$keyValues['lozinka'] = $this->lozinka;
            			$keyValues['ime'] = $this->ime;
            			$keyValues['prezime'] = $this->prezime;
            			
			
			$this->created_at = $keyValues['created_at'] = date("Y-m-d h:i:s");
			
			$id = Base::insert($this->className, $keyValues);
			
			$this->id = $id;
			$this->findById();
		}
		else
		{
			$keyValues = array();
			
						$keyValues['korisnickoIme'] = $this->korisnickoIme;
            			$keyValues['lozinka'] = $this->lozinka;
            			$keyValues['ime'] = $this->ime;
            			$keyValues['prezime'] = $this->prezime;
            			
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
			
						$model->korisnickoIme = $result['korisnickoIme'];
			 			$model->lozinka = $result['lozinka'];
			 			$model->ime = $result['ime'];
			 			$model->prezime = $result['prezime'];
			              
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
			
						$this->korisnickoIme = $result['korisnickoIme'];
			 			$this->lozinka = $result['lozinka'];
			 			$this->ime = $result['ime'];
			 			$this->prezime = $result['prezime'];
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
			
								$model->korisnickoIme = $element['korisnickoIme'];
                 				$model->lozinka = $element['lozinka'];
                 				$model->ime = $element['ime'];
                 				$model->prezime = $element['prezime'];
                 				
				array_push($returnArray, $model);
			}
			
			return $returnArray;
		}
		
		public function destroy()
		{
			$where = array();
			$where['id'] = $this->id;
			
			Base::deleteAND($this->className, $where);
			
						$this->korisnickoIme = "";
            			$this->lozinka = "";
            			$this->ime = "";
            			$this->prezime = "";
            	
			$this->id = -1;
			$this->created_at = 0;
			$this->updated_at = 0;
	
			
			$this->className = "registriranikorisnik";
		}
		
		public function filter()
		{
			$returnArray = array();
			$elements = array();
			
			$elements['id'] = $this->id;
			$elements['created_at'] = $this->created_at;
			$elements['updated_at'] = $this->updated_at;
			
						$elements['korisnickoIme'] = $this->korisnickoIme;
			 			$elements['lozinka'] = $this->lozinka;
			 			$elements['ime'] = $this->ime;
			 			$elements['prezime'] = $this->prezime;
			 			
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
				
								$model->korisnickoIme = $element['korisnickoIme'];
                				$model->lozinka = $element['lozinka'];
                				$model->ime = $element['ime'];
                				$model->prezime = $element['prezime'];
                                 				
				array_push($returnArray, $model);
			}
			
			return $returnArray;
		}

}

?>
