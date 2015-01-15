<?php
include_once('../BASE/core.php');
include_once('../BASE/base.php');

class Prijavljenikorisnik{	
	    public $idRegistriraniKorisnik = "";
        public $oib = "";
        public $datumRodenja = "";
        public $adresa = "";
        public $email = "";
        public $telefon = "";
        public $brojKartice = "";
        public $idPopusta = "";
    	
	
	public $id = -1;
	public $created_at = 0;
	public $updated_at = 0;
	
	
	private $className = "prijavljenikorisnik";
	
	
	public function __construct()
  	{
		$this->className = strtolower(__CLASS__);
	}
	
	public static function init($idRegistriraniKorisnik,$oib,$datumRodenja,$adresa,$email,$telefon,$brojKartice,$idPopusta)
  	{
		$instance = new self();
		$instance->className = strtolower(__CLASS__);
		
				$instance->idRegistriraniKorisnik = $idRegistriraniKorisnik;
        
        		$instance->oib = $oib;
        
        		$instance->datumRodenja = $datumRodenja;
        
        		$instance->adresa = $adresa;
        
        		$instance->email = $email;
        
        		$instance->telefon = $telefon;
        
        		$instance->brojKartice = $brojKartice;
        
        		$instance->idPopusta = $idPopusta;
        
        		
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
			
						$keyValues['idRegistriraniKorisnik'] = $this->idRegistriraniKorisnik;
            			$keyValues['oib'] = $this->oib;
            			$keyValues['datumRodenja'] = $this->datumRodenja;
            			$keyValues['adresa'] = $this->adresa;
            			$keyValues['email'] = $this->email;
            			$keyValues['telefon'] = $this->telefon;
            			$keyValues['brojKartice'] = $this->brojKartice;
            			$keyValues['idPopusta'] = $this->idPopusta;
            			
			
			$this->created_at = $keyValues['created_at'] = date("Y-m-d h:i:s");
			
			$id = Base::insert($this->className, $keyValues);
			
			$this->id = $id;
			$this->findById();
		}
		else
		{
			$keyValues = array();
			
						$keyValues['idRegistriraniKorisnik'] = $this->idRegistriraniKorisnik;
            			$keyValues['oib'] = $this->oib;
            			$keyValues['datumRodenja'] = $this->datumRodenja;
            			$keyValues['adresa'] = $this->adresa;
            			$keyValues['email'] = $this->email;
            			$keyValues['telefon'] = $this->telefon;
            			$keyValues['brojKartice'] = $this->brojKartice;
            			$keyValues['idPopusta'] = $this->idPopusta;
            			
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
			
						$model->idRegistriraniKorisnik = $result['idRegistriraniKorisnik'];
			 			$model->oib = $result['oib'];
			 			$model->datumRodenja = $result['datumRodenja'];
			 			$model->adresa = $result['adresa'];
			 			$model->email = $result['email'];
			 			$model->telefon = $result['telefon'];
			 			$model->brojKartice = $result['brojKartice'];
			 			$model->idPopusta = $result['idPopusta'];
			              
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
			
						$this->idRegistriraniKorisnik = $result['idRegistriraniKorisnik'];
			 			$this->oib = $result['oib'];
			 			$this->datumRodenja = $result['datumRodenja'];
			 			$this->adresa = $result['adresa'];
			 			$this->email = $result['email'];
			 			$this->telefon = $result['telefon'];
			 			$this->brojKartice = $result['brojKartice'];
			 			$this->idPopusta = $result['idPopusta'];
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
			
								$model->idRegistriraniKorisnik = $element['idRegistriraniKorisnik'];
                 				$model->oib = $element['oib'];
                 				$model->datumRodenja = $element['datumRodenja'];
                 				$model->adresa = $element['adresa'];
                 				$model->email = $element['email'];
                 				$model->telefon = $element['telefon'];
                 				$model->brojKartice = $element['brojKartice'];
                 				$model->idPopusta = $element['idPopusta'];
                 				
				array_push($returnArray, $model);
			}
			
			return $returnArray;
		}
		
		public function destroy()
		{
			$where = array();
			$where['id'] = $this->id;
			
			Base::deleteAND($this->className, $where);
			
						$this->idRegistriraniKorisnik = "";
            			$this->oib = "";
            			$this->datumRodenja = "";
            			$this->adresa = "";
            			$this->email = "";
            			$this->telefon = "";
            			$this->brojKartice = "";
            			$this->idPopusta = "";
            	
			$this->id = -1;
			$this->created_at = 0;
			$this->updated_at = 0;
	
			
			$this->className = "prijavljenikorisnik";
		}
		
		public function filter()
		{
			$returnArray = array();
			$elements = array();
			
			$elements['id'] = $this->id;
			$elements['created_at'] = $this->created_at;
			$elements['updated_at'] = $this->updated_at;
			
						$elements['idRegistriraniKorisnik'] = $this->idRegistriraniKorisnik;
			 			$elements['oib'] = $this->oib;
			 			$elements['datumRodenja'] = $this->datumRodenja;
			 			$elements['adresa'] = $this->adresa;
			 			$elements['email'] = $this->email;
			 			$elements['telefon'] = $this->telefon;
			 			$elements['brojKartice'] = $this->brojKartice;
			 			$elements['idPopusta'] = $this->idPopusta;
			 			
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
				
								$model->idRegistriraniKorisnik = $element['idRegistriraniKorisnik'];
                				$model->oib = $element['oib'];
                				$model->datumRodenja = $element['datumRodenja'];
                				$model->adresa = $element['adresa'];
                				$model->email = $element['email'];
                				$model->telefon = $element['telefon'];
                				$model->brojKartice = $element['brojKartice'];
                				$model->idPopusta = $element['idPopusta'];
                                 				
				array_push($returnArray, $model);
			}
			
			return $returnArray;
		}

}

?>
