<?php
header('Content-Type: text/csv');
    require __DIR__ . "/vendor/autoload.php";
    use Goutte\Client;

    $client = new Client();
    $crawler = $client->request('GET', 'https://www.lemonde.fr/actualite');
    $r = [];
    $out = fopen('php://output', 'w');

    $crawler->filter('section.teaser')->each(function ($node) {
        global $r, $out;
        $url = $node->attr('href');
        $nom = trim($node->filter('.teaser')->text());        
        fputcsv($out, [$nom,$url]);
    });
    fclose($out);
?>