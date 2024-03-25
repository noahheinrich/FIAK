<?php
function logToFile($log) {
    $data_string = var_export($log, true);
    file_put_contents('log.txt', $data_string . PHP_EOL, FILE_APPEND);
}