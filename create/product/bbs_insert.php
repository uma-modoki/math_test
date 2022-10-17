<?php
    $name = $_GET['name'];
    $message = $_GET['message'];
    $category = $_GET['category'];
    $sub_category = $_GET['subcategory'];

    if($category == 'math_1') {
        $category = '数学検定';
    }
    else if($category == 'math_2') {
        $category = '算数検定';
    }

    try {
        require_once("../DBInfo.php");
        $pdo = new PDO(DBInfo::DSN, DBInfo::USER, DBInfo::PASSWORD);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'INSERT INTO math_test (date, name, category, subCategory, message) VALUES(NOW(), ?, ?, ?, ?)';
        $statement = $pdo->prepare($sql);

        $statement->bindValue(1, $name);
        $statement->bindValue(2, $category);
        $statement->bindValue(3, $sub_category);
        $statement->bindValue(4, $message);

        $pdo->beginTransaction();

        $statement->execute();

        $pdo->commit();
    }
    catch(PDOException $e) {
                            
        // $pdo が set されていて、トランザクション中であれば真
        if (isset($pdo) == true && $pdo->inTransaction() == true) {
            
            // PDO クラスの commit メソッドでロールバック
            $pdo->rollBack();
            print('ロールバックしました<br>');
        }
        
        // エラー情報の表示
        $code = $e->getCode();
        $message = $e->getMessage();
        print("{$code}/{$message}<br>");
        
    }
    // DB 切断
    $pdo = null;
    
    header('location:./bbs.php');