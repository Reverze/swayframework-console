<?php

namespace Sway\Component\Console\Input;

class Option
{
    /**
     * Option's name
     * @var string
     */
    private $optionName = null;
    
    /**
     * Option's value
     * @var mixed
     */
    private $optionValue = null;
    
    public function __construct(string $optionName, $optionValue)
    {
        if (empty($this->optionName) || !strlen($this->optionName)){
            /**
             * If passed option's name is empty
             */
            if (!strlen($optionName)){
                throw Exception\OptionException::emptyOptionName();
            }
            
            /**
             * Checks if option's name is valid.
             * If option's name throws an exception
             */
            if (!preg_match('/^[a-zA-Z]+$/', $optionName)){
                throw Exception\OptionException::invalidOptionName($optionName, '[a-zA-Z]');
            }
            
            $this->optionName = $optionName;
        }
        
        $this->optionValue = $optionValue; 
    }
    
    /**
     * Gets option's name
     * @return string
     */
    public function getName() : string
    {
        return $this->optionName;
    }
    
    /**
     * Gets option's value
     * @return mixed
     */
    public function getValue()
    {
        return $this->optionValue;
    }
    
}


?>