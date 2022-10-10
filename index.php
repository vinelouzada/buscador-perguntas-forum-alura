<?php

require "ForumPHPAlura.php";

$context = stream_context_create(
    array(
        "http" => array(
            "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
        )
    )
);

$url = 'https://cursos.alura.com.br/forum/subcategoria-php/todos/2';

$conteudoTotal = file_get_contents($url,false,$context);

$conteudo = fopen($url,"r",false,$context);
stream_filter_register("alura.perguntas.nao.respondidas",ForumPHPAlura::class);
stream_filter_append($conteudo,'alura.perguntas.nao.respondidas');

echo fread($conteudo,strlen($conteudoTotal));

