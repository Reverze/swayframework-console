<?php

namespace Sway\Component\Console\Input;

use Sway\Component\Console\Command\Route;
use Sway\Component\Console\Input\FlagContainer;
use Sway\Component\Console\Input\OptionContainer;

class ArgvInput
{
    /**
     * Array with raw arguments
     * @var string
     */
    private $rawArgv = array();
    
    /**
     * Matched command routes
     * @var \Sway\Component\Console\Command\Route[]
     */
    private $commandRoute = array();
    
    public function __construct(array $customArgv = array())
    {
        global $argv;
        
        if (isset($argv) && !sizeof($customArgv)){
            $this->rawArgv = $argv;
        }   
        
        if (sizeof($customArgv)){
            $this->rawArgv = $customArgv;
        }
        
        $this->parse();
    }
    
    private function parse()
    {
        /**
         * Matched route's path
         */
        $routePath = null;
        
        $flagContainer = new FlagContainer();
        
        $optionContainer = new OptionContainer();
        
        /**
         * We skip first element of array cuz is points to script file name
         */
        for ($pointer = 1; $pointer < sizeof($this->rawArgv); $pointer++){
            /**
             * Gets element on which we are currently working
             */
            $element = $this->rawArgv[$pointer];
            
            if (Route::isValidRoutePath($element)){
                /**
                 * On begins route call
                 */
                if (empty($routePath)){
                    $routePath = $element;
                }
                else{
                    /**
                     * Stores previous route call and prepared for new
                     */
                    $route = Route::create($routePath, $flagContainer, $optionContainer);
                    
                    $this->saveCommandRoute($route);
                    
                    $flagContainer = new FlagContainer();
                    $optionContainer = new OptionContainer();
                    $routePath = $element;
                }
            }
            
            if (FlagContainer::isFlagDefinition($element)){
                if (empty($routePath)){
                    throw Exception\InputException::commandNotChosenBeforeFlag();
                }
                else{
                    $flagContainer->push(FlagContainer::getFlagFromDefinition($element));
                }
            }
            
            if (OptionContainer::isOptionDefinition($element)){
                if (empty($routePath)){
                    throw Exception\InputException::commandNotChosenBeforeOption();
                }
                else{
                    $optionContainer->push(OptionContainer::getOptionName($element), $this->rawArgv[$pointer + 1]);
                    $pointer++;
                }
            }
        }
        
        /**
         * Saves the latest given command
         */
        if (!empty($routePath)){
            $route = Route::create($routePath, $flagContainer, $optionContainer);
            $this->saveCommandRoute($route);
        }
    }
    
    /**
     * Saves command route
     * @param Route $route
     */
    private function saveCommandRoute(Route $route)
    {
        array_push($this->commandRoute, $route);
    }
    
    /**
     * Gets command routes
     * @return \Sway\Component\Console\Command\Route[]
     */
    public function getCommandRoutes() : array
    {
        return $this->commandRoute;
    }
}


?>