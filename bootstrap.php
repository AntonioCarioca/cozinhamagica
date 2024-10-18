<?php

use TightenCo\Jigsaw\Jigsaw;

use Symfony\Component\Yaml\Yaml;

$receitasDir = __DIR__ . '/source/cozinhamagica/receitas'; // Caminho da pasta de receitas
$outputFile = __DIR__ . '/source/receitas.json';

$receitas = [];

foreach (glob($receitasDir . '/*.md') as $arquivo) {
    $conteudo = file_get_contents($arquivo);

    // Pega o nome do arquivo sem a extensão ".md"
    $nomeArquivo = basename($arquivo, '.md');

    // Usa expressão regular para pegar o frontmatter
    if (preg_match('/^---(.*?)---/s', $conteudo, $matches)) {
        // Converte o YAML do frontmatter em array
        $frontmatter = Yaml::parse($matches[1]);

        // Adiciona o título e o link ao array
        if (isset($frontmatter['titulo'])) {
            // O link será baseado no nome do arquivo sem extensão
            $receitas[] = [
                'titulo' => $frontmatter['titulo'],
                'categoria' => $frontmatter['categoria'],
                'autor' => $frontmatter['autor'],
                'link' => "/cozinhamagica/receitas/{$nomeArquivo}" // Sem ".html"
            ];
        }
    }
}

// Gera o arquivo JSON com os títulos e links das receitas
file_put_contents($outputFile, json_encode($receitas, JSON_PRETTY_PRINT));



/** @var \Illuminate\Container\Container $container */
/** @var \TightenCo\Jigsaw\Events\EventBus $events */

/*
 * You can run custom code at different stages of the build process by
 * listening to the 'beforeBuild', 'afterCollections', and 'afterBuild' events.
 *
 * For example:
 *
 * $events->beforeBuild(function (Jigsaw $jigsaw) {
 *     // Your code here
 * });
 */
