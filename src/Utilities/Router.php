<?php
namespace src\Utilities;
class Router
{
    /**
     * @var array
     */
    private $routes;
    /**
     * Ajoute un route au routeur
     * @param string $url - URL à détecter
     * @param string $file - Template à appeler
     */
    public function addRoute(string $url, string $file): void
    {
        $this->routes[] = [
            'url' => $url,
            'template' => $file
        ];
    }
    /**
     * Vérifie l'URL et renvoie l'enventuel fichier à appeler
     * @return string|null - Retourne l'éventuel template à appeler
     */
    /**
     * Vérifie l'URL et renvoie l'enventuel fichier à appeler
     * @return string|null - Retourne l'éventuel template à appeler
     */
    public function match(): ?string
    {
        // On récupère l'URL
        $url = $_SERVER['REQUEST_URI'];
        // On boucle dans les routes enregistrées
        foreach($this->routes as $route) {
            // Echappement
            $route['url'] = preg_replace('/\//', '\/', $route['url']);
            // Si la route correspond à l'URL
            if(preg_match('/^'.$route['url'].'$/', $url)) {
                // On retourne le template à exécuter
                return $route['template'];
            }
        }
        // Si aucune route n'a été trouvée, on retourne "null"
        return null;
    }
}