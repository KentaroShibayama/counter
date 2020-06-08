<?php
define('DB_DSN', 'mysql:dbname=access;host=127.0.0.1');
define('DB_USER','senpai');
define('DB_PW','indocurry');

$dbh = connectDB(DB_DSN, DB_USER, DB_PW);

addCounter($dbh);

$count = getCounter($dbh);

// 現在の値を返却する
header('Content-type: application/json');
echo json_encode([
      'status' => true
    , 'count'  => $count
]);


/**
 * DBサーバへ接続
 * 
 * @param  string $dsn  接続先の情報(IPアドレス、DB名など)
 * @param  string $user ユーザーID
 * @param  string $pw   パスワード
 * @return object
 */
function connectDB($dsn,$user,$pw){
    $dbh = new PDO($dsn,$user,$pw);
    return($dbh);
}
/**
 * 1レコード追加する
 * 
 * @param  object $dbh
 * @return boolean
 */
function addCounter($dbh){
    $sql = 'INSERT INTO access_log(accesstime) VALUES(now())';

    $sth = $dbh->prepare($sql);
    $ret = $sth->execute();

    return($ret);
}
/**
 * カウンターの値を取得
 * 
 * @param  string $dbh
 * @return integer|boolean
 */
function getCounter($dbh){
    $sql = 'SELECT count(*) as count FROM access_log';

    $sth = $dbh->prepare($sql);
    $sth->execute();

    $buff = $sth->fetch(PDO::FETCH_ASSOC);
    if( $buff === false){
        return(false);
    }
    else{
        return( $buff['count'] );
    }
}