<?php


namespace Sway\Component\Console\Routing;


class RouteContainer
{
    /**
     * Stores command routes:
     *      routeName => className
     * @var array
     */
    private $routes = array();
    
    public function __construct() 
    {
       
    }
    
    /**
     * Stores routes from array
     * @param array $routes
     */
    public function wakeup(array $routes)
    {
        $this->routes = $routes;
    }
    
    /**
     * Transform container into array
     * @return array
     */
    public function toArray() : array
    {
        return $this->routes;
    }
    
    /**
     * Checks if container is empty
     * @return bool
     */
    public function isEmpty() : bool
    {
        if (!sizeof($this->routes)){
            return true;
        }
        else{
            return false;
        }
    }
    
    /**
     * Adds route into container
     * @param string $routeName
     * @param string $commandClass
     */
    public function addRoute(string $routeName, string $commandClass)
    {
        $this->routes[$routeName] = $commandClass;
    }
    
    /**
     * Removes route from container
     * @param string $routeName
     */
    public function removeRoute(string $routeName)
    {
        unset($this->routes[$routeName]);
    }
    
    /**
     * Checks if route is defined
     * @param string $routeName
     * @return bool
     */
    public function hasRoute(string $routeName) : bool
    {
        return array_key_exists($routeName, $this->routes);
    }
    
}


?>
