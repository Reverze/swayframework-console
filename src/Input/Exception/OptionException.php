<?php

namespace Sway\Component\Console\Input\Exception;

class OptionException extends \Exception
{
    /**
     * Throws an exception when option's name is empty
     * @return \Sway\Component\Console\Input\Exception\OptionException
     */
    public static function emptyOptionName() : OptionException
    {
        return (new OptionException(sprintf("Option's name is empty (length is 0)")));
    }
    
    /**
     * Throws an exception when option's name is invalid
     * @param string $optionName
     * @param string $allowed
     * @return \Sway\Component\Console\Input\Exception\OptionException
     */
    public static function invalidOptionName(string $optionName, string $allowed) : OptionException
    {
        return (new OptionException(sprintf("Option's name '%s' is invalid. Allowed: '%s'", $optionName, $allowed)));
    }
    
    /**
     * Throws an exception when option is not exists at container
     * @param string $optionName
     * @return \Sway\Component\Console\Input\Exception\OptionException
     */
    public static function optionNotExists(string $optionName) : OptionException
    {
        return (new OptionException(sprintf("Option '%s' is not exists in container. Probably was not passed into script")));
    }
    
}


?>