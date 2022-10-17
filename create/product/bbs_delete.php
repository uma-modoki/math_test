<?php
    $id = $_GET['id'];
    $password = $_GET['password'];

    if($password == 'password') {
        try {
            require_once("../DBInfo.php");
            $pdo = new PDO(DBInfo::DSN, DBInfo::USER, DBInfo::PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = 'DELETE FROM math_test WHERE id=?';
            $statement = $pdo->prepare($sql);

            $statement->bindValue(1, $id);

            $pdo->beginTransaction();

            $statement->execute();

            $pdo->commit();
        }
        catch(PDOException $e) {
                            
            if (isset($pdo) == true && $pdo->inTransaction() == true) {
                
                $pdo->rollBack();
                print('ロールバックしました<br>');
            }
            
            $code = $e->getCode();
            $message = $e->getMessage();
            print("{$code}/{$message}<br>");
            
        }

        $pdo = null;
        
        header('location:./bbs.php');
    }
    else {
        print('パスワードが違います');
    }