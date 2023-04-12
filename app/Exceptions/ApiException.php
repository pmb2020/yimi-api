<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class ApiException extends Exception
{

    private mixed $data;
    public function __construct(array $codeResponse,$data=[])
    {
        $this->data=$data;
        [$code,$message] = $codeResponse;
        parent::__construct($message,$code);
    }

    public function report(): bool
    {
        return true;
    }

    public function render(){
        Log::error("api异常（code：{$this->getCode()}）：".$this->getMessage(),$this->data);
        return apiResponse($this->getCode(),$this->getMessage());
    }
}
