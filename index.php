<?php
require_once('db_connect.php');

//文字列のエスケープ処理
function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

try{
    //db接続
    $pdo = db_connect();
    //例外
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage());
}

if(isset($_POST['submit'])){
    $post = $_POST['post'];
    $name = $_POST['name'];
    $statement = $pdo->prepare("INSERT INTO posts (post, name, posted_date) VALUES (:post, :name, NOW())");
    $statement->bindParam(':post', $post, PDO::PARAM_STR);
    $statement->bindParam(':name', $name, PDO::PARAM_STR);
    $statement->execute();
    header("Location: " . $_SERVER['PHP_SELF']);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>チャット</title>
        <link rel="stylesheet" href="index.css" />
        <script src="script.js"></script>
    </head>
    <body>
        <!-- DBに関する処理はここでは行わないこと -->
        <div class="main-container">
            <p class="title">チャット</p>
            <div class="form-container">
                <form action="" method="post">
                    <div id="text-name">
                        名前 : <input type="text" name="name" value="" maxlength="24"/>
                    </div>
                    <div id="text-post">
                        本文 : <input type="text" name="post" value="" maxlength="140" placeholder="上限140文字"/>
                        <span id="text-post-num">0<span>
                    </div>
                    <div id="btn-submit">
                        <input type="submit" name="submit" value="投稿" />
                        <button id="btn-home">HOME</button>
                    </div>
                </form>
            </div>
            <hr />
            <div class="display-container">
                <?php 
                    //dbから値を取る PDOStatamentオブジェクトが返される
                    $rows = $pdo->query('SELECT * FROM posts ORDER BY id DESC');
                    foreach($rows as $row){
                        echo    "<div class='content' id='post__{$row['id']}'>
                                    <div class='header'>".h($row['name'])." : <span class='date'>".h($row['posted_date'])."</span></div>
                                    <div class='post'>".h($row['post'])."</div>
                                </div>";
                    }
                ?>
            </div>
        </div>
    </body>
</html>