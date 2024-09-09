<?php
function get_http_status($url) {
    $headers = @get_headers($url);
    return substr($headers[0], 9, 3);
}

function ping($host, $port = 80, $timeout = 10) {
    $starttime = microtime(true);
    $file      = @fsockopen($host, $port, $errno, $errstr, $timeout);
    $stoptime  = microtime(true);
    $status    = 0;

    if (!$file) {
        $status = -1;  // If Site down
    } else {
        fclose($file);
        $status = ($stoptime - $starttime) * 1000;
        $status = floor($status);
    }
    return $status;
}

$url = "https://stuffmaker.net"; //Replace this with the URL you want to Ping
$host = parse_url($url, PHP_URL_HOST);

echo "HTTP Status: " . get_http_status($url) . "\n";
echo "Ping: " . ping($host) . " ms\n";

?>
