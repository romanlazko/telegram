<?php
namespace Romanlazko\Telegram\App\Entities;

use Romanlazko\Telegram\App\Entities\BaseEntity;
use Closure;
use Romanlazko\Telegram\App\Config;

class InlineData extends BaseEntity
{
    public $inline_data = [];

    public $cast = false;

    public static function fromRequest($data = '')
    {
        $data = explode('|', $data);
        $instance = new static();
        $instance->map($data);

        return $instance;
        
    }

    public function map(array $data)
    {
        $i=0;
        $map = Config::get('inline_data');
        
        foreach ($map as $key => $value) {
            if (isset($data[$i]) AND !empty($data[$i])) {
                $this->inline_data[$key] = $data[$i];
            }
            else{
                $this->inline_data[$key] = '';
            }
            $i++;
        }
    }

    public function asArray()
    {
        return $this->inline_data;
    }

    public function __call($method, $args)
    {
        $property_name = mb_strtolower(ltrim(preg_replace('/[A-Z]/', '_$0', substr($method, 3)), '_'));

        if(isset($args) AND count($args) == 1 AND !in_array(null, $args)){
            $this->inline_data[$property_name] = $args[0];
        }
        
        if (isset($this->inline_data[$property_name]) AND !empty($this->inline_data[$property_name])) {
            return $this->inline_data[$property_name];
        }
        return Config::get('inline_data')[$property_name];

        // $inline_data = collect($this->inline_data)
        //     ->map(function($value, $key){
        //         if (empty($value) OR is_null($value)){
        //             return Config::get('inline_data')[$key];
        //         }
        //         return $value;
        //     })
        //     ->map(function($value, $key){
        //         if ($this->cast){
        //             if ($casts = Config::get('inline_casts')){
        //                 if (isset($casts[$key]) AND is_array($casts[$key])) {
        //                     $this->cast = false;
        //                     return $casts[$key][$value];
        //                 }
        //             }
        //         }
        //         return $value;
        //     });
        
        // return $inline_data->get($property_name);
    }

    public function asCast()
    {
        return CastedInlineData::fromRequest($this->inline_data);
    }

    public function unset(string $key = null): void
    {
        if ($key === null) {
            $this->map([
                $this->inline_data['button']
            ]);
        }else{
            $this->inline_data[$key] = Config::get('inline_data')[$key];
        }
    }
}