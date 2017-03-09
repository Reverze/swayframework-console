<?php

namespace Sway\Component\Console\Command\Exception;

class RouteException extends \Exception
{
    /**
     * Throws an exception when route's path has invalid format
     * @param string $routePath
     * @return \Sway\Component\Console\Command\Exception\RouteException
     */
    public static function invalidRoutePath(string $routePath) : RouteException
    {
        return (new RouteException(sprintf("Route '%s' has invalid format", $routePath)));
    }
    
    /**
     * Throws an exception when flag container is already defined
     * @return \Sway\Component\Console\Command\Exception\RouteException
     */
    public static function flagContainerAlreadyDefined() : RouteException
    {
        return (new RouteException("Flag's container is already defined. You cannot change it anymore"));
    }
    
    /**
     * Throws an exception when option container is already defined
     * @return \Sway\Component\Console\Command\Exception\RouteException
     */
    public static function optionContainerAlreadyDefined() : RouteException
    {
        return (new RouteException("Options container is already defined. You cannot change it anymore"));
    }
    
}

?>
