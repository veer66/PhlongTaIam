<?php
namespace PhlongTaIam;

class PathSelector {
    function selectPath($paths) {
        $selectedPath = null;
        foreach($paths as $path) {
            if (is_null($selectedPath)) {        
                $selectedPath = $path;
            } else {
                if ($path["unk"] < $selectedPath["unk"]) {
                    $selectedPath = $path;
                } else if ($path["unk"] == $selectedPath["unk"]) {
                    if ($path["mw"] < $selectedPath["mw"]) {
                        $selectedPath = $path;
                    } else if ($path["mw"] == $selectedPath["mw"]) {
                        if ($path["w"] < $selectedPath["w"]) 
                            $selectedPath = $path;
                    }
                }
            }
        }
        return $selectedPath;
    }
}
?>
