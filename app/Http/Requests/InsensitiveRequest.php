<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class InsensitiveRequest extends FormRequest
{
    public function rules() : array 
    {
        return [];
    }

    public function has($key) : bool 
    {
        return !is_null($this->__get($key));
    }

    public function __get($key): mixed
    {
        foreach($this->all() as $index => $value)
        {
            if(strtolower($key) == strtolower($index))
            {
                return $value;
            }
        }
        
        return null;
    }
}