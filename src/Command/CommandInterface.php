<?php

namespace Sway\Component\Console\Command;

interface CommandInterface
{
    /**
     * Configures command
     */
    public function configure();
    
    /**
     * Do something before command will be executed
     */
    public function before();
    
}


?>
