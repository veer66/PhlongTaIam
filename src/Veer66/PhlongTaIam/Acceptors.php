<?php
namespace PhlongTaIam;
class Acceptors
{
	public $creators;

	function __construct() 
	{
		$this->creators = array();
		$this->current = array();
		$this->tag = array();
	}

	function reset() {
		$this->current = array();
	}

	function transit($ch) {
		foreach ($this->creators as $creator) {
			$acceptor = $creator->createAcceptor($this->tag);
			if (!is_null($acceptor))
				$this->current[] = $acceptor;
		}


		$_current = array();
		$this->tag = array();

		for ($i = 0; $i < sizeof($this->current); $i++) {
			$_acceptor = $this->current[$i];
			$acceptor = $_acceptor->transit($ch);

			if (!$acceptor->isError) {
				$_current[] = $acceptor;
				if (!array_key_exists($acceptor->tag, $this->tag))
					$this->tag[$acceptor->tag] = array();
				$this->tag[$acceptor->tag] = $acceptor;
			}
		}
		$this->current = $_current;
	}

	function getFinalAcceptors() 
	{
		$finalAcceptors = array();
		foreach($this->current as $acceptor) {	
			if ($acceptor->isFinal) {
				$finalAcceptors[] = $acceptor;
			}
		}
		return $finalAcceptors;
	}
}
?>
