<?php
require_once ('WebService/modelWS/ModelX3.php');
class Four extends ModelX3
{


    function showFourList(){
        $WS = "*";
        $WS_ORDER = "WFOUR";
        $this->CAdxResultXml = $this->query($WS_ORDER, $WS, 100);
        
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
                if ($val == "BPSNAM") {

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
}

 ?>
