<?php
session_start();
// 現在地の情報の有無
if(isset($_SESSION['lat'])!=true || isset($_SESSION['lng'])!=true){
    $_SESSION["msg"]="現在地更新ボタンを押してください";
    header("location:index.php");
    exit;
}
$page_id=$_GET['page_id'];
$lat=$_SESSION['lat'];
$lng=$_SESSION['lng'];
if(isset($_POST['range'])){
    $range=$_POST['range'];
    $_SESSION['range']=$range;
}else{
    $range=$_SESSION['range'];
}
$start=1+($page_id-1)*10;

// ホットペッパーグルメAPIから情報取得
$query = [
    'key' =>'***', //APIキー
    'lat' => $lat, // 緯度
    'lng' => $lng, // 経度
    'range' => $range, // 検索範囲
    'start' => $start,
    'format' => 'json', // レスポンス形式
];
$url = 'https://webservice.recruit.co.jp/hotpepper/gourmet/v1/?';
$url .= http_build_query($query);
$data=file_get_contents($url);
$json=json_decode($data);
// 必要な情報の記憶
$n=(integer)$json->results->results_available;
$m=(integer)$json->results->results_returned;

for($i=0;$i<count($json->results->shop);$i++){
    $items[$i]['name']    = (string)$json->results->shop[$i]->name;
    $items[$i]['address'] = (string)$json->results->shop[$i]->address;
    $items[$i]['access']  = (string)$json->results->shop[$i]->access;
    $items[$i]['image']   = (string)$json->results->shop[$i]->photo->pc->l;
    $items[$i]['open']    = (string)$json->results->shop[$i]->open;
    $items[$i]['url']     = (string)$json->results->shop[$i]->urls->pc;
    
}

// 検索結果ゼロ
if($n==0){
    $_SESSION["msg"]="範囲内にレストランは存在しません";
    header("location:index.php");
    exit;
}

$_SESSION['data']=$items;
$_SESSION['cnt']=$n;
$_SESSION['this_cnt']=$m;
header("location:result_page.php?page_id=".$page_id);
exit;
?>