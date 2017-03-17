<?php

namespace Sway\Component\Console\IO\Output;

use Sway\Component\Console\IO\Formatter\FormatterInterface;
use Sway\Component\Console\IO\Formatter\OutputFormatter;

class StreamOutput extends Output
{
    /**
     * Stream resource
     * @var resource
     */
    protected $streamResource = null;
    
    public function __construct($stream, FormatterInterface $formatter = null)
    {
        if (!is_resource($stream) || get_resource_type($stream) !== 'stream'){
            throw Exception\StreamOutputException::streamResourceNotSpecified();     
        }
        
        $this->streamResource = $stream;
        
        parent::__construct($formatter);
        
    }
    
    /**
     * Sets stream resource
     * @param resource $stream
     * @throws \Sway\Component\Console\IO\Output\Exception\StreamOutputException
     */
    public function setStream($stream)
    {
        if (!is_resource($stream) || get_resource_type($stream) !== 'stream'){
            throw Exception\StreamOutputException::streamResourceNotSpecified();
        }
        
        $this->streamResource = $stream;  
    }
    
    /**
     * Gets stream resource
     * @return resource
     */
    public function getStream()
    {
        return $this->streamResource;
    }
    
    /**
     * {@inheritdoc}
     * @throws \Sway\Component\Console\IO\Output\Exception\StreamOutputException
     */
    protected function afterWrite(string $message, bool $addNewLine) 
    {
        if ($addNewLine){
            if (!@fwrite($this->streamResource, $message) || !@fwrite($this->streamResource, PHP_EOL)){
                throw Exception\StreamOutputException::unableToWriteOutput();
            }
        }
        else{
            if (!@fwrite($this->streamResource, $message)){
                throw Exception\StreamOutputException::unableToWriteOutput();
            }
        }
        
        fflush($this->streamResource);
        
    }
    
}


?>
