<?php

namespace Sway\Component\Console\Input;

class FlagContainer
{
    /**
     * Array which contains flags
     * @var string[]
     */
    private $flags = array();
    
    /**
     * Enables case sensitive
     * @var bool
     */
    private $caseSensitive = true;
    
    public function __construct()
    {
        if (empty($this->flags)){
            $this->flags = array();
        }
    }
    
    /**
     * Pushs flag into container
     * @param string $flag
     * @throws \Sway\Component\Console\Input\Exception\FlagException
     */
    public function push(string $flag)
    {
        if (strlen($flag) == 1){
            array_push ($this->flags, ($this->caseSensitive) ? $flag : strtolower($flag));
        }
        else{
            throw Exception\FlagException::onlyOneChar($flag);
        }
    }
    
    /**
     * Checks flag definition validity
     * @param string $def
     * @return bool
     */
    public static function isFlagDefinition(string $def) : bool
    {
        $flagDefinitionRegex = '/^\-[a-zA-Z]?$/';
        return (bool) preg_match($flagDefinitionRegex, $def);
    }
    
    /**
     * Gets flag from flag definition
     * @param string $def
     * @return string
     */
    public static function getFlagFromDefinition(string $def) : string
    {
        return str_replace("-", "", $def);
    }
    
    /**
     * Checks if container contains passed flag
     * @param string $flag
     * @return bool
     */
    public function has(string $flag) : bool
    {
        return (bool) in_array(($this->caseSensitive ? $flag : strtolower($flag)), $this->flags);
    }
    
    /**
     * Set status of case sensitive
     * @param bool $status
     */
    public function caseSensitive(bool $status)
    {
        $this->caseSensitive = $status;
    }
    
}


?>
