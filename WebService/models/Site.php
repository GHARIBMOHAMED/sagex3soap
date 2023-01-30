<?php
require_once ('WebService/modelWS/ModelX3.php');
class Site extends ModelX3 {

    
	function showSiteListe() {

		$WS = "*";
		$WS_ORDER = "WSITE";
		$this->CAdxResultXml = $this->query ($WS_ORDER, $WS, 100 );
		$result = $this->CAdxResultXml->resultXml;
        // $result contient le fichier XML des réponses
        $dom = new DomDocument();
        $dom->loadXML($result);
        $RES = $dom->getElementsByTagName('LIN');
        $str = '<select id="four">';
        // $str .= "";

        foreach ($RES as $R) {
            $commande = $R->getElementsByTagName('FLD');

            foreach ($commande as $c) {

                //$str .= "<td>";
                $val = $c->getAttribute('NAME');
                $val2 = $c->nodeValue;
                //echo $val .'<br>';
                if ($val == "FCY") {

                    $str .= '<option value="' . $val2 . '" >';
                    $str .= $val2;
                    $str .= "</option>";
                }
            }

        }
        $str .= "</select>";
        $str .= "</div>";

        return $str;
	}
	
	function create($WS) {
		$this->CAdxResultXml = $this->save ( Config::$WS_ORDER, $WS );
		$adxResultXml = $this->CAdxResultXml;
		$ret="";
		$messages = array();
		$status = $adxResultXml->status;
		if ($status == 1) {
			$ret.=ToolsWS::getSucces('Order created');
			//return $ret;
			// echo "order créée<BR/>";
		} else {
			$ret.=ToolsWS::getError('Order not created');
			//return $ret;
			// echo "Erreur, commande non créée<BR/>";
		}
			
		// echo "Messages: <BR/>";
		if (property_exists(get_class($adxResultXml), 'messages')){
			$messages = $adxResultXml->messages;
		
			foreach ( $messages as $value ) {
				$ret .= $value->message;
				$ret .= "<BR/>";
			}
		}
		// echo "resultXml<BR/>";
		// echo "$result2->resultXml<BR/>";
		if ($status == 0) {
		 return $ret;
		}
		$dom = new DomDocument ();
		$resultXml = $adxResultXml->resultXml;
		$dom->loadXML ( $resultXml );
		
		
		$fld = $dom->getElementsByTagName ( 'FLD' );
		$ret .= "<div class='row'>";
		
		foreach ( $fld as $f ) {	
			$val = $f->getAttribute ( 'NAME' );
			$val2 = $f->nodeValue;
			if ($val == "SOHNUM") {
					$ret .= "<div class='col-lg-5 col-md-3 col-sm-2'>";
					$ret .= "<table class='table table-striped table-bordered table-condensed'>";
					$ret .="<thead><tr><th>Order num</th>";
					$ret .="</tr></thead><tbody><tr><td><a HREF='page_soh_read.php?sohnum=".$val2."' >".$val2."</a>";
					$ret .="</td></tr></tbody></table>";
			}
		}
		return $ret;
	}
	
}

 ?>
