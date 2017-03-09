<?php

namespace Sway\Component\Console\IO\Output;

class ConsoleOutput extends StreamOutput
{
    public function __construct(Sway\Component\Console\IO\Formatter\FormatterInterface $formatter = null) 
    {
        parent::__construct($this->openStandardOutput(), $formatter);
    }
    
    /**
     * Opens standard output
     * @return resource
     * @throws \Sway\Component\Console\IO\Output\Exception\ConsoleOutputException
     */
    protected function openStandardOutput()
    {
        /**
         * Opens standard output stream and stores handler
         */
        $stream = @fopen('php://stdout', 'w');
        
        /**
         * If cannot open standard output stream, try another
         */
        if ($stream === false){
            /**
             * If cannot open second output stream, throw an exception
             */
            $stream = @fopen('php://output', 'w');
            
            if ($stream === false){
                throw Exception\ConsoleOutputException::cannotFindStandardOutputStream();
            }
            else{
                return $stream;
            }
        }
        else{
            return $stream;
        }
    }
    
}

?>