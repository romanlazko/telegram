<?php
namespace Romanlazko\Telegram\App\Entities;

use Closure;
use Romanlazko\Telegram\App\Config;

class CastedInlineData
{
    public $inline_data;

    public static function fromRequest(array $data)
    {
        $instance = new static();
        $instance->map($data);

        return $instance;
    }

    public function map(array $data)
    {
        $this->inline_data = collect($data)
            ->map(function($value, $key){
                if ($casts = Config::get('inline_casts') AND isset($casts[$key]) AND !empty($value)){
                    if (is_array($casts[$key])) {
                        return $casts[$key][$value];
                    }
                    else if (($fun = $casts[$key]) instanceof Closure){
                        return $fun($value);
                    }
                }
                return $value;
            });
        return $this;
    }

    public function asArray()
    {
        return $this->inline_data->toArray();
    }

    public function __call($method, $args)
    {
        $property_name = mb_strtolower(ltrim(preg_replace('/[A-Z]/', '_$0', substr($method, 3)), '_'));
        
        return $this->inline_data->get($property_name);
    }
}