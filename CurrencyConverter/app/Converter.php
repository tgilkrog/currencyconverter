<?php

namespace App;

class Converter
{
    private $currencies = array();
    
    public function __construct($url)
    {
        $root = simplexml_load_string($url);

        if (!$root) {
            throw new \RuntimeException("Opstod en bette fejl");
        }

        foreach ($root->Cube->Cube->Cube as $node) {
            $this->currencies[(string)$node['currency']] = (string)$node['rate'];
        }
    }

    public function convert($amount, $from, $to)
    {  
        //Er den det samme så bare returner      
        if ($from == $to) {
            return $amount;
        }
        
        //Er value nul så retuner 0
        if ($amount == 0) {
            return 0;
        }
        
        //Hvis fra er EUR skal der bare ganges
        if ($from == 'EUR') {
            return $this->currencies[$to] * $amount;
        }

        //Er det til euro skal der divideres        
        if ($to == 'EUR') {
            return $amount / $this->currencies[$from];
        }
        
        //Er ingen af dem EUR skal vi finde ud af hvad $from er i EUR
        $amountInEur = $this->convert($amount, $from, 'EUR');
        
        //Herefter køre vi metoden igen med den nye amount
        return $this->convert($amountInEur, 'EUR', $to);
    }   
}
?>