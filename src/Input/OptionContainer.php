<?php

namespace Sway\Component\Console\Input;

class OptionContainer
{
    /**
     * 
     * @var \Sway\Component\Console\Input\Option[]
     */
    private $options = array();
    
    /**
     * Determines if case sensitive is enabled
     * @var bool
     */
    private $caseSensitive = true;
    
    /**
     * Determines if auto typing of option value is enabled
     * @var bool
     */
    private $autoTyping = true;
    
    public function __construct()
    {
        if (empty($this->options)){
            $this->options = array();
        }
    }
    
    /**
     * Pushs option into container
     * @param string $optionName
     * @param mixed $optionValue
     * @throws \Sway\Component\Console\Input\Exception\OptionException
     */
    public function push(string $optionName, $optionValue)
    {
        if (!strlen($optionName)){
            throw Exception\OptionException::emptyOptionName();
        }
        
        /**
         * If auto typing is enabled try to convert into proper type
         */
        if ($this->autoTyping){

            /**
             * If variable is numeric and integer
             */
            if (is_numeric($optionValue)){
                $optionValue = (double) $optionValue;
                
                if ($optionValue % 2 === 0){
                    $optionValue = (int) $optionValue;
                }
            }
            
            /**
             * If value is string, checks for json 
             */
            if (is_string($optionValue)){
                $tryToJson = json_decode($optionValue, true);
                
                
                if (is_array($tryToJson)){
                    $optionValue = $tryToJson;
                }
            }
        
        }
        
        $this->options[$this->caseSensitive ? $optionName : strtolower($optionName)] = $optionValue;
    }
    
    /**
     * Checks if option is defined in container
     * @param string $optionName
     * @return bool
     */
    public function has(string $optionName) : bool
    {
        return array_key_exists(($this->caseSensitive ? $optionName : strtolower($optionName)), $this->options);    
    }
    
    /**
     * Gets value under defined option.
     * @param string $optionName
     * @return bool
     * @throws \Sway\Component\Console\Input\Exception\OptionException
     * @see \Sway\Component\Console\Input\OptionContainer::has()
     */
    public function get(string $optionName) : bool
    {
        if ($this->has($optionName)){
            return $this->options[($this->caseSensitive ? $optionName : strtolower($optionName))];
        }
        else{
            throw Exception\OptionException::optionNotExists(($this->caseSensitive ? $optionName : strtolower($optionName)));
        }
        
    }
    
    /**
     * Checks if given element is option definition
     * @param string $def
     * @return bool
     */
    public static function isOptionDefinition(string $def) : bool
    {
        $optionDefinitionRegex = '/^\--[a-zA-Z\-]+?$/';
        return (bool) preg_match($optionDefinitionRegex, $def);
    }
    
    /**
     * Gets option's name from definition
     * @param string $def
     * @return bool
     */
    public static function getOptionName(string $def) : string
    {
        return substr($def, 2, strlen($def));
    }
}


?>
