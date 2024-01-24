<?php
session_start();
$items=$_SESSION['data'];
$shop_number=$_GET['number'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, hieght=device-height, initial-scale=1.0">
    <title>レストラン検索君</title>
    <link rel="stylesheet" href="main.css">
    
</head>
<body>
    <p class="title">レストラン検索君</p>
    <div class="detail">
    <div class="detail_name">
        <?php echo $items[$shop_number]['name']; ?>    
    </div>
    <div class="subtitle">住所</div><?php echo $items[$shop_number]['address']; ?>    
    <div class="subtitle">交通アクセス</div><?php echo $items[$shop_number]['access']; ?>    
    <div class="subtitle">営業時間</div><?php echo $items[$shop_number]['open']; ?>    
    <?php echo $items[$shop_number]['open']; ?>    
    <a href=<?php echo $items[$shop_number]['url'];?> >ホームページはこちら</a>
    <img src=<?php echo $items[$shop_number]['image']; ?> alt="店舗画像"> 
    </div>
    <button class="back" type="button" onclick='location.href="./search.php?page_id=1"'>一覧画面に戻る</button>
    <br>
    <button class="back" type="button" onclick='location.href="./index.php"'>検索画面に戻る</button>
    
</body>
</html>