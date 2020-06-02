<?php namespace Talis\Services\AsyncScripts;

/**
 * Represents the entry point to any async
 * process.
 * All processes MUST implement a Main class
 * inheriting this class
 *
 * @author itaymoav
 */
abstract class aRequestHandler{
    protected   $params = [],
                $start_time,
                $logger = null
    ;
    
    /**
     * 
     */
    abstract public function execute();
    
    /**
     * Gets a string k/v/k/v/k/v and parses it into array
     *
     * @param string $request
     */
    protected function parseParams(array $request,\Talis\Logger\Streams\aLogStream $logger){
        $this->logger = $logger;
        $parts = explode('/', $request);
        $no_parts = count($parts);
        $last_get_index = '';
        for($i=0;$i<$no_parts;$i++){
            if($i%2 == 0){
                $last_get_index = base64_decode($parts[$i]);
            }else{
                $this->params[$last_get_index] = base64_decode($parts[$i]);
            }
        }
    }
    
    /**
     * place holder to inject stuff into constructor just after parsing the params.
     */
    protected function init(){}
    
    /**
     *
     * @param array $request
     */
    final public function __construct(array $request){
        $this->parseParams($request);
        $this->init();
        $this->start_time = time();
        $this->logger->debug("\n\n\n\n\n\n");
        $this->logger->debug("================================================== STARTING NEW ASYNC =======================================================================");
        $this->logger->debug("================================================== START TIME: <{$this->start_time}> =================================================================");
        $this->logger->debug($this->params);
        $this->logger->debug("\n\n\n\n\n\n");
    }
    
    /**
     * show time this process took
     */
    final public function conclusion(){
        $end_time = time();
        $total_time = $end_time - $this->start_time;
        $this->logger->debug("FINISHED async: Took me {$total_time} seconds");
    }
}

