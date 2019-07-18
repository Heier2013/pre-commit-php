#!/usr/local/bin/php
<?php
$msg_color_magenta = "\e[1;35m";
$msg_color_yellow = "\e[0;33m";
$msg_color_none = "\e[0m";

output("{$msg_color_yellow}Begin Check ..." . $msg_color_none);

// 接受脚本传递参数
array_shift($argv);
$fileList = $argv;

$illegalStr = 'Uilib';

$errorFileList = [];
foreach ($fileList as $file) {
    $fileStr = file_get_contents($file);

    if (false !== stripos($fileStr, $illegalStr)) {
        $errorFileList[] = $file;
    }
}
$errorCount = count($errorFileList);

if ($errorCount > 0) {
    output("{$msg_color_magenta}error count {$errorCount}{$msg_color_none}");

    $errFileStr = '';
    foreach ($errorFileList as $file) {
        $errFileStr .= $file . PHP_EOL;
    }
    output($errFileStr);

    exit(1);
}
exit(0);

function output($str)
{
    echo $str . PHP_EOL;
}