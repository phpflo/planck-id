<?php 

namespace PlanckId\Regex;

#use InvalidArgumentException;

class RegexInArrayWithOriginalOut extends RegexInOut
{   
    protected function get($data) {
        $matches = parent::get($data);
        
        return ['original' => $data, 'matched' => $matched];
    }
} 