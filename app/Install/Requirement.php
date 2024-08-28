<?php

namespace App\Install;

class Requirement
{
    public function extensions()
    {
        return [
            'PHP >= 8.*' => version_compare(phpversion(), '8.0.0'),
            'Intl PHP Extension' => extension_loaded('intl'),
            'OpenSSL PHP Extension' => extension_loaded('openssl'),
            'PDO PHP Extension' => extension_loaded('pdo'),
            'Mbstring PHP Extension' => extension_loaded('mbstring'),
            'Tokenizer PHP Extension' => extension_loaded('tokenizer'),
            'XML PHP Extension' => extension_loaded('xml'),
            'Ctype PHP Extension' => extension_loaded('ctype'),
            'JSON PHP Extension' => extension_loaded('json'),
        ];
    }

    public function directories()
    {
        return [
            '.env' => is_writable(base_path('.env')),
            'storage' => is_writable(storage_path()),
        ];
    }

    public function satisfied()
    {
        return collect($this->extensions())
            ->merge($this->directories())
            ->every(function ($item) {
                return $item;
            });
    }
}
