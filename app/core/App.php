<?php
namespace App\Core;

use Symfony\Component\Yaml\Yaml;

class App
{
    private static array $dependencies = [];

    /**
     * Charger dynamiquement les dépendances depuis service.yaml
     */
    private static function loadServices(): void
    {
        if (!empty(self::$dependencies)) return;

$path = __DIR__ . '/../config/service.yaml';

        if (!file_exists($path)) {
            throw new \Exception("Fichier de services non trouvé : $path");
        }

        $parsed = Yaml::parseFile($path);

        // Aplatir les sections (core, service, repository, etc.)
        foreach ($parsed as $category) {
            foreach ($category as $key => $class) {
                self::$dependencies[$key] = $class;
            } 
        }
    }

    /**
     * Fournit l'instance de la dépendance demandée
     */
    public static function getDependencies(string $key): mixed
    {
        self::loadServices();

        if (array_key_exists($key, self::$dependencies)) {
            $class = self::$dependencies[$key];

            if (class_exists($class)) {
                if (method_exists($class, 'getInstance')) {
                    return $class::getInstance();
                }
                return new $class();
            }

            throw new \Exception("Classe non trouvée : $class");
        }

        throw new \Exception("Clé de dépendance inconnue : $key");
    }
}
