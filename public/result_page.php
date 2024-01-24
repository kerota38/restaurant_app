<?php
session_start();
unset($_SESSION["msg"]);
$n=$_SESSION['cnt'];
$m=$_SESSION['this_cnt'];
$items=$_SESSION['data'];
$max=10;# １ページの表示数
$now=$_GET['page_id'];
$first=($now-1)*$max;
$max_page=ceil($n / $max);
?>
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
    <div class="result">
    <?php echo $n;?> 件のレストランが見つかりました
    </div>
    <!-- 店情報 -->
    <?php
    for($i=0;$i<min($max,$m);$i++){?>
        <div class="shop">
        <div class="shop_name">
        <a href=<?php echo "/detail_page.php?number=" .$i."&page_id=".$now;?> ><?php echo $items[$i]['name']; ?></a>
        </div>
        <div>
        交通アクセス<br><?php echo $items[$i]['access']; ?>    
        </div>
        <div>
            <img class="picture" src=<?php echo $items[$i]['image']; ?> alt="店舗画像"> 
        </div>
        </div>
        <?php
    }
    ?>
    <div class="paging">
    <?php
    if(max(1,$now-2)!=min($max_page,$now+2)){
        if(max(1,$now-2)!=1){?>
            <a href="/search.php?page_id=1"><<</a>
            ...
        <?php }
        for($i=max(1,$now-2);$i<=min($max_page,$now+2);$i++){

            if ($i == $now) {
                echo $now; 
            } else {?>
                <a href=<?php echo "/search.php?page_id=" .$i;?> ><?php echo $i ?></a>
        <?php        }
        }
        if(min($max_page,$now+2)!=$max_page){?>
            ...
            <a href=<?php echo "/search.php?page_id=" .$max_page;?> >>></a>
        <?php }
    }
    ?>
    </div>
    <button class="back" type="button" onclick='location.href="./index.php"'>検索画面に戻る</button>
</body>
</html>