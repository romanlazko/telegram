<?php 
namespace Romanlazko\Telegram\Generators;

use Illuminate\Support\Facades\File;

class BotDirectoryGenerator
{
    public static function createBotDirectories($botName)
    {
        $baseDirectory = app_path('Bots');
        $botDirectory = $baseDirectory . '/' . $botName;
        
        if (!File::exists($baseDirectory)) {
            File::makeDirectory($baseDirectory);
        }
        
        if (!File::exists($botDirectory)) {
            File::makeDirectory($botDirectory);
        }
        
        self::createSubDirectories($botDirectory);
        self::createCommandsListFile($botDirectory, $botName);
        self::createBotProviderFile($botDirectory, $botName);
        self::createBotConfigFile($botDirectory, $botName);
        self::createBotWebFile($botDirectory, $botName);
    }
    
    private static function createSubDirectories($botDirectory)
    {
        $subDirectories = [
            'Commands/DefaultCommands',
            'Commands/UserCommands',
            'Commands/AdminCommands',
            'database/migrations',
            'resources/views/components',
            'Http/Controllers',
            'routes',
            'Providers',
            'Models',
        ];
        
        foreach ($subDirectories as $subDirectory) {
            $directory = $botDirectory . '/' . $subDirectory;
            
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }
        }
    }
    
    private static function createCommandsListFile($botDirectory, $botName)
    {
        $stubFile = __DIR__.'/../stubs/CommandsList.stub';
        $destinationFile = $botDirectory . '/Commands/CommandsList.php';

        if (!File::exists($destinationFile)) {
            $replacements = [
                "!bot_username!" => $botName,
            ];
            StubGenerator::generateStubFile($stubFile, $destinationFile, $replacements);
        }
    }

    private static function createBotProviderFile($botDirectory, $botName)
    {
        $stubFile = __DIR__.'/../stubs/BotProvider.stub';
        $botClassName = str_replace(' ', '', ucwords(str_replace('_', ' ', $botName))). "Provider";
        $destinationFile = $botDirectory . "/Providers/{$botClassName}.php";

        if (!File::exists($destinationFile)) {
            $replacements = [
                "!bot_username!" => $botName,
                "!bot_class_name!" => $botClassName
            ];
            StubGenerator::generateStubFile($stubFile, $destinationFile, $replacements);
        }
    }

    private static function createBotConfigFile($botDirectory, $botName)
    {
        $stubFile = __DIR__.'/../stubs/Config.stub';
        $destinationFile = $botDirectory . "/Config.php";

        if (!File::exists($destinationFile)) {
            $replacements = [
                "!bot_username!" => $botName,
            ];
            StubGenerator::generateStubFile($stubFile, $destinationFile, $replacements);
        }
    }

    private static function createBotWebFile($botDirectory, $botName)
    {
        $stubFile = __DIR__.'/../stubs/web.stub';
        $destinationFile = $botDirectory . "/routes/web.php";

        if (!File::exists($destinationFile)) {
            $replacements = [
                "!bot_username!" => $botName,
            ];
            StubGenerator::generateStubFile($stubFile, $destinationFile, $replacements);
        }
    }
}
    