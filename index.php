<?php

const MAX_JSON_SIZE = 2048;

$patterns = [
    "#[^a-zA-Z0-9/-]#",
    "#/#",
];

$replaces = [
    "",
    "-",
];

$uri = trim($_SERVER['REQUEST_URI'], "/");

$path = preg_replace($patterns, $replaces, $uri);
if (empty($path)) {
    $path = "default";
}

$data = [];
$directory = "/src/tmp";
$filename = "$directory/$path.json";

if (is_file($filename)) {
    $rawData = file_get_contents($filename, false, null, 0, MAX_JSON_SIZE);
    echo $rawData;
    $data = json_decode($rawData, true);
}

$fp = fopen($filename, "w+");
if (!$fp) {
    echo "Deu ruim!";
    return;
}

$data[] = [
    "headers" => getallheaders(),
    "post" => $_POST,
    "get" => $_GET,
];

fwrite($fp, json_encode($data), MAX_JSON_SIZE);
fclose($fp);

echo "<pre>";
print_r($data); 