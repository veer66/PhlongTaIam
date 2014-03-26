<?php
namespace PhlongTaIam;
class PathInfoBuilder {
	function buildByAcceptors($path, $finalAcceptors, $i) 
	{
		$infos = array();
		foreach ($finalAcceptors as $acceptor) {
			$p = $i - $acceptor->strOffset + 1;
			$_info = $path[$p];            
			$info = array("p" => $p, 
						  "mw" => $_info["mw"] + $acceptor->mw,
                          "w" => $acceptor->w + $_info["w"],
                          "unk" => $acceptor->unk + $_info["unk"], 
                          "type" => $acceptor->type);
			if ($acceptor->type == "PART") {
				for($j = $p + 1; $j <= $i; $j++) {
					$path[j]["merge"] = $p;
				}
				$info["merge"] = $p;
			}
			if (!is_null($info)) 
				$infos[] = $info;
		}
		return $infos;
	}
  
	function fallback($path, $leftBoundary, $text, $i) 
	{
		$_info = $path[$leftBoundary];
		$ch = mb_substr($text, $i, 1, "UTF-8");
		mb_regex_encoding("UTF-8");
		if (mb_ereg("[\u0E48-\u0E4E]", $ch)) {
			if ($leftBoundary != 0) {
				$pathAtLeftBoundary = $path[$leftBoundary];
				$leftBoundary = $pathAtLeftBoundary["p"];
			}
			return array("p" => $leftBoundary,
						 "mw" => 0,
						 "w" => 1 + $_info["w"],
						 "unk" => 1 + $_info["unk"],
						 "type" => "UNK");      
		} else {
			return array("p" => $leftBoundary,
						 "mw" => $_info["mw"],
						 "w" => 1 + $_info["w"],
						 "unk" => 1 + $_info["unk"],
						 "type" => "UNK");
		}
	}

	function build($path, $finalAcceptors, $i, $leftBoundary, $text) {
		$basicPathInfos = $this->buildByAcceptors($path, $finalAcceptors, $i);
		if (sizeof($basicPathInfos) > 0) {
			return $basicPathInfos;
		} else {
			return array($this->fallback($path, $leftBoundary, $text, $i));
		}
	}
}
?>
