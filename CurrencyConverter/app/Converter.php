<?php

namespace App;

class Converter
{
    private $currencies = array();
    
    public function __construct()
    {
        $url = "http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml";
        $root = simplexml_load_string(file_get_contents($url));

        if (!$root) {
            throw new \RuntimeException("Opstod en bette fejl");
        }

        foreach ($root->Cube->Cube->Cube as $node) {
            $this->currencies[(string)$node['currency']] = (string)$node['rate'];
        }
    }

    public function getDat(){
        return $this->currencies;
    }

    public function convert($amount, $from, $to)
    {  
        //Er den det samme så bare returner      
        if ($from == $to) {
            return $amount;
        }
        
        //Er amount nul så retuner 0
        if ($amount == 0) {
            return 0;
        }
        
        //Hvis $from er EUR skal der bare ganges
        if ($from == 'EUR') {
            return $this->currencies[$to] * $amount;
        }

        //Er $to euro skal der divideres        
        if ($to == 'EUR') {
            return $amount / $this->currencies[$from];
        }

        //Er ingen af af dem EUR divideres de to currencies og derefter ganged med amount
        return $amount * ($this->currencies[$to] / $this->currencies[$from]);
    }   
}
?>
