<?php 
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header('Content-Type: application/json; charset=UTF-8');
header("Access-Control-Allow-Credentials: true");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db_connect.php';

//クラスの生成
$obj = new db_connect();
if($_SERVER['REQUEST_METHOD'] === 'GET') {
    $year_month = $_GET['currentDate'];
    $sql = 'SELECT date FROM T_reserve WHERE DATE_FORMAT(date, "%Y-%m") = :year_month';
    try{
        $params = [':year_month' => $year_month];
        $result = $obj->select($sql, $params);
        echo json_encode($result);
    } catch(Exception $e){
        echo "データ検索に失敗しました。" . $e->getMessage();
    }
}
?>