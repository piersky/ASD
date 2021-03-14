<?php

namespace App;

use Spatie\Valuestore\Valuestore;
use Auth;

class Settings extends Valuestore
{
    private $prefix;

    public function __construct()
    {
        if (!empty(Auth::id())) $this->prefix = Auth::id().'_';
    }

    public function put($key, $value = null){
        $name = $this->prefix.$key;
        return parent::put($name, $value);
    }

    public function has(string $key) : bool
    {
        $name = $this->prefix.'_'.$key;
        return parent::has($name);
    }

    public function get($key, $default = null){
        $name = $this->prefix.'_'.$key;
        return parent::get($name, $default);
    }

    public function forget($key){
        $name = $this->prefix.'_'.$key;
        return parent::forget($name);
    }
}
