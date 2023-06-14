<?php
namespace Romanlazko\Telegram\App\Entities;

/**
 * Abstract class BaseEntity
 *
 * @method string getJson()   All data in json format
 * @method string getString()   All data in string format
 * @method string getPrettyString()   All data in pretty string format
 */

abstract class BaseEntity 
{
    protected static $map = [];

    public static function fromRequest($data)
    {

        // if (is_array($data)) {
            // static::$bot_id = $bot_id;
			$instance = new static();
			$instance->map($data);

			return $instance;
		// }
    }

    public function map(array $data)
	{
		foreach (static::$map as $key => $item) {
			if (isset($data[$key]) && (!is_array($data[$key]) || (is_array($data[$key]) && !empty($data[$key])))) {
				if ($item === true) {
					$this->$key = $data[$key];
                } else if (is_array($item)) {
                    if ($item[0] === true) {
                        foreach ($data[$key] as $dataKey => $value) {
                            $this->$key[] = $value;
                        }
                    }else{
                        foreach ($data[$key] as $dataKey => $value) {
                            $this->$key[] = $item[0]::fromRequest($value);
                        }
                    }
                } else {
					$this->$key = $item::fromRequest($data[$key]);
				}
			}else{
                $this->$key = null;
            }
		}
	}

    /**
     * Perform to json
     *
     * @return string
     */
    public function getJson(): string
    {
        return json_encode($this, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Perform to pretty string
     *
     * @return string
     */
    public function getPrettyString(): string
    {
        $json = json_encode($this, JSON_UNESCAPED_UNICODE);
        $array = json_decode($json, true);
        return $this->toString($array);
    }

    /**
     * Perform to string
     *
     * @return string
     */
    private function toString(array $data): string
    {
        $string = '';
        foreach ($data as $key => $value) {
            if( is_array($value) ) {
                $string .= "\n"."$key : {".$this->toString($value)."}"."\n";
            }else if ($value !== null) {
                $string .= "$key: $value; ";
            }
        }
        return $string;
    }

    /**
     * Get a property from the current Entity
     *
     * @param string $property
     * @param mixed  $default
     *
     * @return mixed
     */
    public function getProperty(?string $property_name, $default = null)
    {
        return $this->$property_name ?? $default;
    }

    public function __call($method, $args)
    {
        $property_name = mb_strtolower(ltrim(preg_replace('/[A-Z]/', '_$0', substr($method, 3)), '_'));

        
        if (isset(static::$map[$property_name])) {
            if(isset($args) AND count($args) == 1 AND !in_array(null, $args)){
                $this->$property_name = $args[0];
            }
            return $this->getProperty($property_name);
        }
        
    }

    
}
