<?php
define('DATA_FILE', 'data.txt');

$count = getCounter(DATA_FILE);

// 現在の値を返却する
header('Content-type: application/json');
echo json_encode([
      'status' => true
    , 'count'  => $count
]);


/**
 * カウンターの値を取得
 * 
 * @param  string $file
 * @return integer
 */
function getCounter($file){
    $fp = fopen($file, 'r+');
    flock($fp, LOCK_EX);
    $buff = (int)fgets($fp);

    ftruncate($fp, 0);
    fseek($fp, 0);

    fwrite($fp, $buff+1);

    flock($fp, LOCK_UN);
    fclose($fp);

    return($buff);
}