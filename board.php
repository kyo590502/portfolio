<?php
    //データベースの設定
    $dsn = 'データベース名';
    $user = 'ユーザー名';
    $password = 'パスワード';
    
    ?>
    <!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="m5-1.css" rel="stylesheet" type="text/css" media="all">
    <title>掲示板</title>
</head>
<h1>掲示板</h1>
<body>
    <form action="" method="POST">
        <input type="text" name="name" placeholder="名前" class="box2" value="<?php
        if(!empty($_POST["editnum"])&&!empty($_POST["editpassword"])){
            $editnum=$_POST["editnum"];
            $password =$_POST["editpassword"];
            $sql = 'SELECT id FROM board';
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            foreach ($results as $result){
                $id =$result[0];
                if($editnum ==$id){
                    $sql = 'SELECT password FROM board where id=:id';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt->execute();
                    $results = $stmt->fetchAll();
                    foreach ($results as $result){
                        $targetpassword =$result[0];
                        if($targetpassword ==$password){
                            $sql = 'SELECT name FROM board where id=:id';
                            $stmt = $pdo->prepare($sql);
                            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                            $stmt->execute();
                            $results = $stmt->fetchAll();
                            //print_r($results);
                            foreach($results as $targetname){
                                echo $targetname[0];
                            }
                        }
                    }
                }
            }
        }
        
        ?>">
        <input type="text" name="comment" placeholder="コメント" class="box2" value="<?php
        if(!empty($_POST["editnum"])&&!empty($_POST["editpassword"])){
            $sql = 'SELECT id FROM board';
            $password =$_POST["editpassword"];
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            foreach ($results as $result){
                $id =$result[0];
                if($editnum ==$id){
                    $sql = 'SELECT password FROM board where id=:id';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt->execute();
                    $results = $stmt->fetchAll();
                    foreach ($results as $result){
                        $targetpassword =$result[0];
                        if($targetpassword ==$password){
                            $sql = 'SELECT comment FROM board where id=:id';
                            $stmt = $pdo->prepare($sql);
                            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                            $stmt->execute();
                            $results = $stmt->fetchAll();
                            //print_r($results);
                            foreach($results as $targetcomment){
                                echo $targetcomment[0];
                            }
                        }
                    }
                }
            }
        }
        ?>">
        <input type="text" name="password" placeholder="パスワード" class="box2" value="<?php
        if(!empty($_POST["editnum"])&&!empty($_POST["editpassword"])){
            $sql = 'SELECT id FROM board';
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            foreach ($results as $result){
                $id =$result[0];
                if($editnum ==$id){
                    $sql = 'SELECT password FROM board where id=:id';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt->execute();
                    $results = $stmt->fetchAll();
                    foreach ($results as $result){
                        $targetpassword =$result[0];
                        if($targetpassword ==$password){
                            $sql = 'SELECT password FROM board where id=:id';
                            $stmt = $pdo->prepare($sql);
                            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                            $stmt->execute();
                            $results = $stmt->fetchAll();
                            //print_r($results);
                            foreach($results as $targetpassword){
                                echo $targetpassword[0];
                            }
                        }
                    }
                }
            }
        }
        ?>">
        <input type="hidden" name="post-edit-num" class="box2" value="<?php
        if(!empty($_POST["editnum"])&&!empty($_POST["editpassword"])){
            $sql = 'SELECT id FROM board';
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            foreach ($results as $result){
                $id =$result[0];
                if($editnum ==$id){
                    $sql = 'SELECT password FROM board where id=:id';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt->execute();
                    $results = $stmt->fetchAll();
                    foreach ($results as $result){
                        $targetpassword =$result[0];
                        if($targetpassword ==$password){
                            echo $id;
                        }
                    }
                }
            }
        }
        ?>">
        <input href="#" type="submit" name="submit"class="btn-flat-border"></input>
    </form>
    <form action=""method="POST">
        <input type="number" name="deletenum" placeholder="削除番号" class="box2">
        <input type="text" name="deletepassword" placeholder="パスワード" class="box2">
        <input type="submit" name="submit" value="削除"　href="#" class="btn-flat-border"><br>
    </form>
    <form action=""method="POST">
        <input type="number" name="editnum" placeholder="編集番号" class="box2">
        <input type="text" name="editpassword" placeholder="パスワード" class="box2">
        <input type="submit" name="submit" value="編集"　href="#" class="btn-flat-border"><br>
    </form>
    
    <?php
    //編集
    if(!empty($_POST["post-edit-num"])){
        $sql = 'UPDATE board SET name=:name,comment=:comment,password=:password,date=:date WHERE id=:id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_INT);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $name = $_POST["name"];
        $comment =$_POST["comment"];
        $date =date('Y/m/d/ H:i:s');
        $password =$_POST["password"];
        $id =$_POST["post-edit-num"];
        $stmt->execute();
    }
    //投稿
    elseif(!empty($_POST['name'])&& !empty($_POST['comment'])&& !empty($_POST['password'])){
        $sql = $pdo -> prepare("INSERT INTO board (name, comment, password, date) VALUES (:name, :comment, :password, :date)");
        $sql -> bindParam(':name', $name, PDO::PARAM_STR);
        $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
        $sql -> bindParam(':password', $password, PDO::PARAM_STR);
        $sql -> bindParam(':date', $date, PDO::PARAM_STR);
        $name = $_POST["name"];
        $comment =$_POST["comment"];
        $password =$_POST["password"];
        $date =date('Y/m/d/ H:i:s');
        $sql -> execute();
    }
    
    //削除
    if(!empty($_POST["deletepassword"])&&!empty($_POST["deletenum"])){
        $password =$_POST["deletepassword"];
        $deletenum =$_POST["deletenum"];
        $sql = 'SELECT id FROM board';
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll();
        foreach($results as $result){
            $id =$result["id"];
            if($deletenum ==$id){
                $sql = 'SELECT password FROM board where id=:id';
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $results = $stmt->fetchAll();
                foreach ($results as $result){
                    $targetpassword =$result[0];
                    if($targetpassword==$password){
                        $sql = 'delete from board where id=:id';
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                        $stmt->execute();
                    }
                }
            }    
        }
    }
    ?>
    <div class="fashionable-box3">
    <p class="block">
        <?php
        //投稿全て表示
        $sql = 'SELECT * FROM board';
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll();
        foreach ($results as $row){
            //$rowの中にはテーブルのカラム名が入る
            echo $row['id'].', ';
            echo $row['name'].', ';
            echo $row['comment'].', ';
            echo $row['date'].'';
            //echo $row['password'].'<br>';
            echo "<hr>";
        }
        ?>
    </p>
</div>
</body>
</html>
