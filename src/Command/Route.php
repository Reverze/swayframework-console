<?php

namespace Sway\Component\Console\Command;

use Sway\Component\Console\Input\FlagContainer;
use Sway\Component\Console\Input\OptionContainer;

class Route
{
    /**
     * Route path (eg. cache:clear ...)
     * @var string
     */
    private $routePath = null;
    
    /**
     * Passed flags to route
     * @var \Sway\Component\Console\Input\FlagContainer
     */
    private $flagContainer = null;
    
    /**
     * Passed options to route (optionName => value)
     * @var \Sway\Component\Console\Input\OptionContainer 
     */
    private $optionContainer = null;
    
    public function __construct()
    {
 
    }
    
    /**
     * Creates a new instance of Route
     * @param string $routePath
     * @param FlagContainer $flagContainer
     * @param OptionContainer $optionContainer
     * @return \Sway\Component\Console\Command\Route
     */
    public static function create(string $routePath, FlagContainer $flagContainer, OptionContainer $optionContainer) : Route
    {
        $route = new Route();
        $route->setRoutePath($routePath);
        $route->setFlagContainer($flagContainer);
        $route->setOptionContainer($optionContainer);
    
        return $route;
    }
    
    /**
     * Checks if passed route's path is valid
     * @param string $routePath
     * @return boolean
     */
    public static function isValidRoutePath(string $routePath)
    {
        /**
         * Explodes route's path by ':'
         */
        $exploded = explode(":", $routePath);
        
        /**
         * Route's path consist of 2 parts (minimum)
         */
        if (sizeof($exploded) <= 1){
            return false;
        }
        
        /**
         * Regular expression for particular path's part
         */
        $partRegularExpression = '/^[a-zA-Z]+$/';
        
        foreach ($exploded as $part){
            if (!preg_match($partRegularExpression, $part)){
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * Sets route's path
     * @param string $routePath
     * @throws \Sway\Component\Console\Command\Exception\RouteException
     */
    public function setRoutePath(string $routePath)
    {
        if (static::isValidRoutePath($routePath)){
            $this->routePath = $routePath;
        }
        else{
            throw Exception\RouteException::invalidRoutePath($routePath);
        }     
    }
    
    /**
     * Sets flags container (only once possible)
     * @param FlagContainer $flagContainer
     * @throws \Sway\Component\Console\Command\Exception\RouteException
     */
    public function setFlagContainer(FlagContainer $flagContainer)
    {
        if (empty($this->flagContainer)){
            $this->flagContainer = $flagContainer;
        }
        else{
            throw Exception\RouteException::flagContainerAlreadyDefined();
        }
    }
    
    /**
     * Sets options container (only once possible)
     * @param OptionContainer $optionContainer
     * @throws \Sway\Component\Console\Command\Exception\RouteException
     */
    public function setOptionContainer(OptionContainer $optionContainer)
    {
        if (empty($this->optionContainer)){
            $this->optionContainer = $optionContainer;
        }
        else{
            throw Exception\RouteException::optionContainerAlreadyDefined();
        }
    }
    
    /**
     * Gets route's path
     * @return string
     */
    public final function getRoutePath() : string
    {
        return $this->routePath;
    }
}


?>

