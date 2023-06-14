<?php

namespace Romanlazko\Telegram\App;

use Closure;

/**
 * Config class for App\Telegram namespace
 */
class Config 
{
    public static $config = [
        'inline_data' => [
            'button'    => null,
            'temp'      => null,
        ],
    ];

    private $closure;

    /**
     * Initializes the Config class by merging the default config with the bot-specific config, if available
     * 
     * @param Telegram $telegram The Telegram instance
     *
     * @return void
     */

    public static function initialize(Telegram $telegram): void
    {
        $configsListClass  = "App\\Bots\\{$telegram->getBotChat()->getUsername()}\\Config";
        if (class_exists($configsListClass)) {
            $external_config = $configsListClass::getConfig() ?? $configsListClass::$config;
            foreach (self::$config as $key => $value) {
                if (array_key_exists($key, self::$config) AND array_key_exists($key, $external_config)) {
                    if (is_array($value)) {
                        self::$config[$key] += $external_config[$key];
                    }else{
                        self::$config[$key] = $external_config[$key];
                    }
                }
            }
            self::$config += $external_config;
        }
    }

    /**
     * Returns the value of the specified key from the default config array
     * 
     * @param string $key The key to retrieve from the default config array
     *
     * @return mixed The value of the specified key from the default config array
     */

    public static function get(string $key): mixed
    {
        return self::$config[$key] ?? null;
    }

    public static function cast(string $key): mixed
    {
        if ($casts = self::$config['casts'] AND isset($casts[$key]) AND !empty($casts[$key])){
            if (($fun = $casts[$key]) instanceof Closure){
                return $fun;
            }
            return $casts[$key];
        }
        return null;
    }

    public function call($param)
    {
        return $this->closure ? ($this->closure)($param) : null;
    }
}
