<?php

namespace Sway\Component\Console\Input\Exception;

class InputException extends \Exception
{
    /**
     * Throws an exception when flag is set and command is not chosen
     * @return \Sway\Component\Console\Input\Exception\InputException
     */
    public static function commandNotChosenBeforeFlag() : InputException
    {
        return (new InputException(sprintf("You must define command before set flag")));  
    }
    
    /**
     * Throws an exception when option is set and command is not chosen
     * @return \Sway\Component\Console\Input\Exception\InputException
     */
    public static function commandNotChosenBeforeOption() : InputException
    {
        return (new InputException(sprintf("You must define command before set options")));
    }
    
}


?>
