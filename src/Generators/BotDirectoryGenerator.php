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
            self::createSubDirectories($botDirectory);
            self::createBotCommands($botDirectory, $botName, "UserCommands");
            self::createBotCommands($botDirectory, $botName, "AdminCommands");
            self::generateStubFiles($botDirectory, $botName);
        }
    }
    
    private static function createSubDirectories($botDirectory)
    {
        $subDirectories = [
            'Commands/UserCommands',
            'Commands/AdminCommands',
            'database/migrations',
            'database/seeders',
            'resources/views/components',
            'Http/Controllers',
            'Http/Requests',
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

    private static function createBotCommands($botDirectory, $botName, $auth)
    {
        $destinationCommands = [
            __DIR__.'/../stubs/StartCommand.stub'   => $botDirectory . "/Commands/$auth/StartCommand.php",
            __DIR__.'/../stubs/MenuCommand.stub'    => $botDirectory . "/Commands/$auth/MenuCommand.php",
            __DIR__.'/../stubs/HelpCommand.stub'    => $botDirectory . "/Commands/$auth/HelpCommand.php",
        ];

        foreach ($destinationCommands as $stubFile => $destinationFile) {
            if (!File::exists($destinationFile)) {
                $replacements = [
                    "!bot_username!"    => $botName,
                    "!auth_path!"       => $auth
                ];
                StubGenerator::generateStubFile($stubFile, $destinationFile, $replacements);
            }
        }
    }

    private static function generateStubFiles($botDirectory, $botName)
    {
        $botClassName = str_replace(' ', '', ucwords(str_replace('_', ' ', $botName))). "Provider";

        $destinationFiles = [
            __DIR__.'/../stubs/CommandsList.stub'           => $botDirectory . "/Commands/CommandsList.php",
            __DIR__.'/../stubs/BotProvider.stub'            => $botDirectory . "/Providers/{$botClassName}.php",
            __DIR__.'/../stubs/Config.stub'                 => $botDirectory . "/Config.php",
            __DIR__.'/../stubs/web.stub'                    => $botDirectory . "/routes/web.php",
            __DIR__.'/../stubs/responsive-nav-links.stub'   => $botDirectory . "/resources/views/components/responsive-nav-links.blade.php",
            __DIR__.'/../stubs/nav-links.stub'              => $botDirectory . "/resources/views/components/nav-links.blade.php",
            __DIR__.'/../stubs/page.stub'                   => $botDirectory . "/resources/views/page.blade.php",
        ];

        foreach ($destinationFiles as $stubFile => $destinationFile) {
            if (!File::exists($destinationFile)) {
                $replacements = [
                    "!bot_username!" => $botName,
                    "!bot_class_name!" => $botClassName
                ];
                StubGenerator::generateStubFile($stubFile, $destinationFile, $replacements);
            }
        }
    }
}
    