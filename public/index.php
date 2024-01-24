<?php
session_start();
unset($_SESSION['lat']);
unset($_SESSION['lng']);
unset($_SESSION['range']);
unset($_SESSION['data']);
unset($_SESSION['cnt']);
unset($_SESSION['lat']);
unset($_SESSION['lng']);
unset($_SESSION['this_cnt']);

?>
<script>
var lat=null;
var lng=null;
// Geolocation APIの取得確認
function getPosition(){
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(succesCallback,errorCallback);
    }else{
        document.getElementById("show_result").innerHTML="この端末では使用できません";
    }
}

// 取得成功時
async function succesCallback(position){
    lat=position.coords.latitude;
    lng=position.coords.longitude;
    document.getElementById("lat").innerHTML="緯度："+lat;
    document.getElementById("lng").innerHTML="経度："+lng;
    // phpにデータ送信
    const postData = new FormData(); 
    postData.set("latitude", lat);
    postData.set("longitude", lng);

    const data = {
      method: "POST",
      body: postData,
    };
    const res = await fetch("state.php", data);
    const d = await res.json();
    const json = await JSON.parse(d);

    // ボタンの色の変更
    var color=document.getElementById("search_button");
    color.style.color="red";
}

// 取得失敗時
function errorCallback(error){
    var error_msg="エラーが発生しました";
    switch(error.code){
        case 1:
            error_msg="位置情報の利用が許可されていません";
            break;
        case 2:
            error_msg="デバイスの位置が判定できません";
            break;
        case 3:
            error_msg="タイムアウトしました";
            break;
    }
    document.getElementById("show_result").innerHTML=error_msg;
}
</script>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>レストラン検索君</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <p class="title">レストラン検索君</p>
    <div class="state">
    現在地<br>
    <div id="lat">緯度：-</div>
    <div id="lng">経度：-</div>
    <button type="button" onclick="getPosition()">現在地更新</button>
    <div class="error" id="show_result"></div>
    </div>
    <form class="search" action="./search.php?page_id=1" method="POST">
    <label for="ranges">検索範囲</label>
    <select name="range">
        <option value="1">300m</option>
        <option value="2">500m</option>
        <option value="3">1000m</option>
        <option value="4">2000m</option>
        <option value="5">3000m</option>
    </select>
    <br>
    <button id="search_button" type="sumtit" style="color:gray;">検索</button>
    <div class="error"><?php 
    if(isset($_SESSION["msg"])){
        echo $_SESSION['msg'];
    }?>
    </div>    
    </form>
</body>
</html>