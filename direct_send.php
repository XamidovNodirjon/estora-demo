<?php

$host = 'uz03.ahost.uz';
$port = 465;
$user = 'notifications@estora.uz';
$pass = 'Estora2026!pass';
$to = 'nodirbek05102001@gmail.com';

$ctx = stream_context_create([
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    ]
]);

$fp = stream_socket_client("ssl://{$host}:{$port}", $errno, $errstr, 15, STREAM_CLIENT_CONNECT, $ctx);
if (!$fp) {
    echo "Connection failed: $errstr ($errno)\n";
    exit(1);
}

function cmd($fp, $cmd) {
    fputs($fp, $cmd . "\r\n");
    $res = '';
    while ($line = fgets($fp, 512)) {
        $res .= $line;
        if (substr($line, 3, 1) === ' ') break;
    }
    return $res;
}

function readR($fp) {
    $res = '';
    while ($line = fgets($fp, 512)) {
        $res .= $line;
        if (substr($line, 3, 1) === ' ') break;
    }
    return $res;
}

readR($fp);
cmd($fp, "EHLO localhost");
cmd($fp, "AUTH LOGIN");
cmd($fp, base64_encode($user));
cmd($fp, base64_encode($pass));
$mf = cmd($fp, "MAIL FROM: <{$user}>");
$rc = cmd($fp, "RCPT TO: <{$to}>");
$dt = cmd($fp, "DATA");

$msg = "From: Estora Real Estate <{$user}>\r\n";
$msg .= "To: <{$to}>\r\n";
$msg .= "Subject: Estora Tasdiqlash Kodi\r\n";
$msg .= "Content-Type: text/html; charset=UTF-8\r\n\r\n";
$msg .= "<h1>Salom Nodirbek!</h1><p>Sizning tasdiqlash kodingiz: <b>449911</b></p>\r\n.";

$res = cmd($fp, $msg);
cmd($fp, "QUIT");
fclose($fp);

if (str_contains($res, '250') || str_contains($res, 'OK')) {
    echo "SUCCESS: Email successfully delivered to {$to}!\n";
} else {
    echo "SERVER RESPONSE: " . $res . "\n";
}
