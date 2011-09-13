<?php

Class Concepto
{
		private $descendencia = array();
		private $hijos = array();
		private $padres = array();
		public $i = 0; //contador hijos
		public $n = 0; //contador descendencia
		public $x = 0; //contador padres
		public $ancestro;
		private $conceptId2;
		
	function __construct($concept)
	{
		$this->ancestro = $concept;
		$this->conceptId2 = $concept;	
	}
	
	private function hijos()
	{
		$consult = "SELECT CONCEPTID1 FROM Relationships WHERE CONCEPTID2 = $this->ancestro AND RELATIONSHIPTYPE = '116680003'";
		$con = mysql_query($consult);
		while ($row = mysql_fetch_row($con))
		{
			print $this->i." - ".$row[0]."\n\r";
			$this->i = $this->i+1;
			array_push($this->hijos, $row[0]);
		}
		
		return $this->hijos;
	}
	
	private function padres()
	{
		$consult = "SELECT CONCEPTID2 FROM Relationships WHERE CONCEPTID1 = $this->ancestro AND RELATIONSHIPTYPE = '116680003'";
		$con = mysql_query($consult);
		while ($row = mysql_fetch_row($con))
		{
			print $this->x." - ".$row[0]."\n\r";
			$this->x = $this->x+1;
			array_push($this->padres, $row[0]);
		}
		
		return $this->padres;
	}
	
	private function descendencia()
	{
		$consult = "SELECT CONCEPTID1 FROM Relationships WHERE CONCEPTID2 = $this->conceptId2 AND RELATIONSHIPTYPE = '116680003'";
		$con = mysql_query($consult);
	    
		if (isset($con))
		{
			while ($row = mysql_fetch_row($con))
			{
				if (!in_array($row[0], $this->descendencia)){
			   		print $this->n." - ".$row[0]."\n\r";
			   		$this->n = $this->n+1;
			   		array_push($this->descendencia, $row[0]);
			   		$this->conceptId2 = $row[0];
			   		$this->descendencia();
				}
			}
		}
		
		return $this->descendencia;
	}
	
	function getDescendencia()
	{
		if (isset($this->descendencia[0]))
		{
			return $this->descendencia;
		}else{
			print "Generando descendencia, esto puede durar varios minutos\n\r";
			return $this->descendencia();
		}
	}
	
	function getPadres()
	{
		if (isset($this->padres[0]))
		{
			return $this->padres;
		}else{
			print "Generando padres\n\r";
			return $this->padres();
		}
	}
	
	function getHijos()
	{
		if (isset($this->hijos[0]))
		{
			return $this->hijos;
		}else{
			print "Generando hijos\n\r";
			return $this->hijos();
		}
	}
	
}

?>