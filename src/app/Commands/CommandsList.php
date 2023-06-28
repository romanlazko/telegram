<?php
namespace Romanlazko\Telegram\App\Commands;


class CommandsList 
{
    static protected $default_commands = [
        'admin'     => [
            DefaultCommands\DefaultCommand::class,
        ],
        'user'      => [
            UserCommands\StartCommand::class,
            UserCommands\HelpCommand::class,

            /** Send empty response, in case the transmitted command is not on this list, return empty Response **/
            // DefaultCommands\EmptyResponseCommand::class,
            
            /** Send text "It is default command", in case the transmitted command is not on this list, return Default text **/
            UserCommands\DefaultCommand::class,
            // UserCommands\ReferalCommand::class,
            UserCommands\AdvertisementCommand::class,

            /** Send update like pretty string, in case the transmitted command is not on this list, return Update like string **/
            // DefaultCommands\SendResultCommand::class,
        ],
        'supergroup' => [
            /** Send empty response, in case the transmitted command is not on this list, return empty Response **/
            DefaultCommands\EmptyResponseCommand::class,
            
            /** Send text "It is default command", in case the transmitted command is not on this list, return Default text **/
            // DefaultCommands\DefaultCommand::class           => ['/default'],

            /** Send update like pretty string, in case the transmitted command is not on this list, return Update like string **/
            // DefaultCommands\SendResultCommand::class        => ['/default'],
        ],
        'channel' => [
            /** Send empty response, in case the transmitted command is not on this list, return empty Response **/
            DefaultCommands\EmptyResponseCommand::class,
            
            /** Send text "It is default command", in case the transmitted command is not on this list, return Default text **/
            // DefaultCommands\DefaultCommand::class           => ['/default'],

            /** Send update like pretty string, in case the transmitted command is not on this list, return Update like string **/
            // DefaultCommands\SendResultCommand::class        => ['/default'],
        ],
        'default'   => [
            /** Send text "It is default command", in case the transmitted command is not on this list, return Default text **/
            // DefaultCommands\DefaultCommand::class           => ['/default'],

            /** Send update like pretty string, in case the transmitted command is not on this list, return Update like string **/
            // DefaultCommands\SendResultCommand::class,

            DefaultCommands\EmptyResponseCommand::class,
        ]
        
    ];

    static public function getCommandsList(?string $auth)
    {
        if ($auth AND isset(self::$default_commands[$auth])) {
            return self::$default_commands[$auth];
        }
        return self::$default_commands['default'];
    }

    static public function getAllCommandsList()
    {
        foreach (self::$default_commands as $auth => $commands) {
            $commands_list[$auth] = self::getCommandsList($auth);
        }
        return $commands_list;
    }
}
