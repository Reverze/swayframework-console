<?php

namespace Sway\Component\Console\IO\Input;

interface InputInteface
{
    /**
     * Reads input from stream
     * @param string $prompt
     */
    public function read(string $prompt = null);
    
    /**
     * Reads line input from stream
     * @param string $prompt
     */
    public function readLine(string $prompt = null);
    
    /**
     * Reads key from stream
     * @param string $prompt
     */
    public function readKey(string $prompt = null);
    
}

?>