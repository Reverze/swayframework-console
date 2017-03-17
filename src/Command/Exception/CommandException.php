<?php

namespace Sway\Component\Console\Command\Exception;

class CommandException extends \Exception
{
    /**
     * Throws an exception when command has not defined route's path
     * @return \Sway\Component\Console\Command\Exception\CommandException
     */
    public static function emptyCommandRoutePath() : CommandException
    {
        return (new CommandException("Command has empty route's path"));
    }
}


?>
