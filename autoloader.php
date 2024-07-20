<?php
spl_autoload_register(function ($class) {
    // Zamień namespace na ścieżkę do plików
    $prefix = 'Offer\\';
    $base_dir = __DIR__ . '/class/';

    // Sprawdź, czy klasa używa prefixu namespace
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // Klasa nie używa namespace, zignoruj ją
        return;
    }

    // Pobierz nazwę klasy bez prefixu namespace
    $relative_class = substr($class, $len);

    // Zamień namespace na ścieżkę do plików i dodaj rozszerzenie .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // Jeśli plik istnieje, załaduj go
    if (file_exists($file)) {
        require $file;
    }
});
