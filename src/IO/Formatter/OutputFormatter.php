<?php

namespace Sway\Component\Console\IO\Formatter;

class OutputFormatter implements FormatterInterface
{
    public function __construct()
    {
        
    }
    
    public function format($context) 
    {
        if (is_string($context)){
            return $context;
        }
        else{
            throw new \InvalidArgumentException("Expected string");
        }
    }
    
}


?>