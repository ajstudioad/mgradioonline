<?php

$url = "https://api.zeno.fm/mounts/metadata/subscribe/0m42pr5q4ehvv";

$context = stream_context_create([
    "http" => [
        "method" => "GET",
        "header" => "Accept: text/event-stream"
    ]
]);

$stream = fopen($url, "r", false, $context);

if ($stream) {
    while (!feof($stream)) {
        $line = fgets($stream);
        if (strpos($line, "data:") === 0) {
            echo trim(substr($line,5));
            break;
        }
    }
    fclose($stream);
}
?>