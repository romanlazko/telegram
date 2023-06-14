<?php 
namespace Romanlazko\Telegram\Generators;

use Illuminate\Support\Facades\File;

class StubGenerator
{
    public static function generateStubFile($stubPath, $destinationPath, $replacements = [])
    {
        if (File::exists($stubPath)) {
            $content = File::get($stubPath); // Получение содержимого файла stub

            $modifiedContent = strtr($content, $replacements); // Замена плейсхолдеров в содержимом файла

            File::put($destinationPath, $modifiedContent); // Создание нового файла кода на основе измененного содержимого

            return true;
        }

        return false;
    }
}