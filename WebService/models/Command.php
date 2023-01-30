<?php
require_once ('WebService/modelWS/ModelX3.php');
class Command extends ModelX3 {


    function showList() {
		 $WS = "*";
        $WS_ORDER = "WPOH";

		$this->CAdxResultXml = $this->query ($WS_ORDER, $WS, 100 );
		$result = $this->CAdxResultXml->resultXml;
		// $result contient le fichier XML des réponses
		//$dom = new DomDocument ();
        $xml = simplexml_load_string($result);
        $json = json_encode($xml);
        $newArr = json_decode($json, true);
        //print_r($newArr);
        
		// $dom->loadXML ( $result );

		// $RES = $dom->getElementsByTagName ( 'LIN' );
		// $str = "<table class='table table-striped table-bordered table-condensed'>";
		// $str .= "<thead><tr> <th>Date de Commande </th> <th>Numero de Commande</th> <th>Site</th> <th>Client</th> </tr></thead><tbody>";

		// foreach ( $RES as $R ) {
		// 	$commande = $R->getElementsByTagName ( 'FLD' );
		// 	$str .= "<tr>";
		// 	foreach ( $commande as $c ) {
		// 		$str .= "<td>";
		// 		$val = $c->getAttribute ( 'NAME' );
		// 		$val2 = $c->nodeValue;
		// 		if ($val == "POHNUM") {
		// 			$str .= "<a HREF='page_soh_read.php?sohnum=$val2'>";
		// 			$str .= $c->nodeValue;
		// 			$str .= "</a>";
		// 		} elseif ($val == "DLVSTA") {
		// 			switch ($c->nodeValue) {
		// 				case 1 :
		// 					$str .= "Not delivered";
		// 					break;
		// 				case 2 :
		// 					$str .= "Partially delivered";
		// 					break;
		// 				case 3 :
		// 					$str .= "Delivered";
		// 					break;
		// 			}
		// 		} else {
		// 			$str .= $c->nodeValue;
		// 		}
		// 		$str .= "</td>";
		// 	}
		// 	$str .= "</tr>";
		// }
		// $str .= "</tbody></table>";
		// $str .= "</div>";
	
		// return $str;
        return $newArr;
	}

}

 ?>

