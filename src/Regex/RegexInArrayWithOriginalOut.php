<?php 

namespace PlanckId\Regex;

class RegexInArrayWithOriginalOut extends RegexInOut
{   
    protected function get($data) {
        $matched = parent::get($data);
        
        return ['original' => $data, 'matched' => $matched];
    }
} 