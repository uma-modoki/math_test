<?php
    header('Expires: Tue, 1 Jan 2019 00:00:00 GMT');
    header('Last-Modified:' . gmdate( 'D, d M Y H:i:s' ) . 'GMT');
    header('Cache-Control:no-cache,no-store,must-revalidate,max-age=0');
    header('Cache-Control:pre-check=0,post-check=0',false);
    header('Pragma:no-cache');
?>
<?php
    function h($str) {
        return htmlspecialchars($str, null, 'UTF-8');
    }

    $terms = 0;
    $search_word = "";

    if(isset($_GET['search_word']) == true && $_GET['search_word'] != "") {
        $search_word = $_GET['search_word'];
        $terms = 0;
    }
    else if(isset($_GET['search_word1']) == true && $_GET['search_word1'] != "") {
        $search_word = $_GET['search_word1'];
        $terms = 1;
    }
    else if(isset($_GET['search_word2']) == true && $_GET['search_word2'] != "") {
        $search_word = $_GET['search_word2'];
        $terms = 2;
    }
    else if(isset($_GET['search_word3']) == true && $_GET['search_word3'] != "") {
        $search_word = $_GET['search_word3'];
        $terms = 3;
    }
    else if(isset($_GET['search_word4']) == true && $_GET['search_word4'] != "") {
        $search_word = $_GET['search_word4'];
        $terms = 4;
    }
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="./bbs.css">
        <title>数検受験者名簿</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="./bbs.js"></script>
    </head>
    <body>
        <header>
            <div id="line"></div>
            <h1>数検受験者名簿</h1>
        </header>
        <main>
            <noscript>
                JavaScriptを有効にしてください。
            </noscript>
            <h2>受験者名簿のメニュー</h2>
            <div id="menu">
                <section id="menu1">
                    <div id="menu1_tag">
                        <div class="menu_bar">
                            <div class="menu_title">
                                <h3>検索</h3>
                            </div>
                            <div class="button_pm">
                                <img id="button_s" src="../image/button-plus.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div id="menu1_main" class="menu_main">
                        <p>次のいずれか1つの項目を入力し、「検索」ボタンをクリックしてください。</p>
                        <form action="">
                            <table>
                                <tr>
                                    <td><label for="radio1">ID</label></td>
                                    <td>
                                        <input type="radio" id="radio1" name="radio" value="A" checked >
                                        <input type="text" name="search_word1" id="id" class="text">
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="radio2">名前</label></td>
                                    <td>
                                        <input type="radio" id="radio2" name="radio" value="B">
                                        <input type="text" name="search_word2" id="name" class="text">
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="radio3">カテゴリ</label></td>
                                    <td>
                                        <input type="radio" id="radio3" name="radio" value="C">
                                        <input type="text" name="search_word3" id="ctgr" class="text">
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="radio4">階級</label></td>
                                    <td>
                                        <input type="radio" id="radio4" name="radio" value="D">
                                        <input type="text" name="search_word4" id="class" class="text">
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="radio5">メッセージ</label></td>
                                    <td>
                                        <input type="radio" id="radio5" name="radio" value="E">
                                        <input type="text" name="search_word" id="text_massage" class="text">をメッセージに含む記事
                                    </td>
                                </tr>
                            </table>
                            <p>※項目未入力のまま検索ボタンを押すと、現在登録されている全ての受験者の名簿が表示されます</p>
                            <button type="submit" class="press">検索</button>
                        </form>
                    </div>
                </section>
                <section id="menu2">
                    <div id="menu2_tag">
                        <div class="menu_bar">
                            <div class="menu_title">
                                <h3>新規受験者の登録</h3>
                            </div>
                            <div class="button_pm">
                                <img id="button_n" src="../image/button-plus.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div id="menu2_main" class="menu_main">
                        <p>次の項目を入力し、「登録」ボタンをクリックしてください。</p>
                        <form action="./bbs_insert.php" method="get">
                            <table>
                                <tr>
                                    <td>お名前</td><td><input type="text" name="name" class="text" required></td>
                                </tr>
                                <tr>
                                    <td>カテゴリ</td>
                                    <td>
                                        <select name="category" id="category" class="select">
                                            <option value="math_1">数学検定</option>
                                            <option value="math_2">算数検定</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>階級</td>
                                    <td>
                                        <select name="subcategory" id="subcategory"class="select"></select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>メッセージ</td><td><input type="text" name="message" id="message" required></td>
                                </tr>
                            </table>
                            <button type="submit" id="press_insert" class="press">登録</button>
                        </form>
                    </div>
                </section>
                <section id="menu3">
                    <div id="menu3_tag">
                        <div class="menu_bar">
                            <div class="menu_title">
                                <h3>受験者名簿の削除</h3>
                            </div>
                            <div class="button_pm">
                                <img id="button_d" src="../image/button-plus.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div id="menu3_main" class="menu_main">
                        <p>次の項目を入力し、「削除」ボタンをクリックしてください。</p>
                        <form action="./bbs_delete.php" method="get">
                            <table>
                                <tr>
                                    <td>記事のID</td><td><input type="text" name="id" class="text" pattern="^[0-9]+$" title="数字のみ入力してください" required></td>
                                </tr>
                                <tr>
                                    <td>管理パスワード</td><td><input type="password" maxlength="8" pattern="^([0-9A-za-z]{4,8})$" title="4文字以上8文字以下の半角英数字で入力してください" name="password" id="password" class="text" required ></td>
                                </tr>
                                <tr>
                                    <td></td><td><input type="checkbox" id="checkbox"><label for="checkbox">パスワードの表示</label></td>
                                </tr>
                            </table>
                            <button type="submit" id="press_delete" class="press">削除</button>
                        </form>
                    </div>
                </section>
            </div>
            <div id="data_show">
                <h2>記事一覧</h2>
                <p>検索条件:
                    <?php 
                        if(isset($_GET['search_word']) && $_GET['search_word'] != "") {
                            $search_word = $_GET['search_word'];
                            $input_result = h($search_word);
                            print("メッセージに<u><b>{$input_result}</b></u>含む受験者");
                        }
                        else if(isset($_GET['search_word1']) && $_GET['search_word1'] != "") {
                            $search_word = $_GET['search_word1'];
                            $input_result = h($search_word);
                            print("ID番号が<u><b>{$input_result}</b></u>の受験者");
                        }
                        else if(isset($_GET['search_word2']) && $_GET['search_word2'] != "") {
                            $search_word = $_GET['search_word2'];
                            $input_result = h($search_word);
                            print("名前に<u><b>{$input_result}</b></u>を含む受験者");
                        }
                        else if(isset($_GET['search_word3']) && $_GET['search_word3'] != "") {
                            $search_word = $_GET['search_word3'];
                            $input_result = h($search_word);
                            print("カテゴリの名前に<u><b>{$input_result}</b></u>を含む受験者");
                        }
                        else if(isset($_GET['search_word4']) && $_GET['search_word4'] != "") {
                            $search_word = $_GET['search_word4'];
                            $input_result = h($search_word);
                            print("階級の名前に<u><b>{$input_result}</b></u>を含む受験者");
                        }
                        else {
                            print('なし');
                        }
                    ?>
                </p>
                <table id="table">
                    <?php
                        try {
                            // DB 接続
                            require_once('../DBInfo.php');
                            $pdo = new PDO(DBInfo::DSN, DBInfo::USER, DBInfo::PASSWORD);
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            if($search_word != "") {
                                $search_word_new = str_replace('%', '\%', $search_word);

                                if($terms == 0){
                                    $sql = "SELECT * FROM math_test WHERE message LIKE \"%{$search_word_new}%\" ORDER BY id DESC";
                                }
                                else if($terms == 1) {
                                    $sql = "SELECT * FROM math_test WHERE id = {$search_word_new} ORDER BY id DESC";
                                }
                                else if($terms == 2) {
                                    $sql = "SELECT * FROM math_test WHERE name LIKE \"%{$search_word_new}%\" ORDER BY id DESC";
                                }
                                else if($terms == 3) {
                                    $sql = "SELECT * FROM math_test WHERE category LIKE \"%{$search_word_new}%\" ORDER BY id DESC";
                                }
                                else if($terms == 4) {
                                    $sql = "SELECT * FROM math_test WHERE subCategory LIKE \"%{$search_word_new}%\" ORDER BY id DESC";
                                }

                                //$sql = "SELECT * FROM math_test WHERE message LIKE \"%{$search_word_new}%\" ORDER BY id DESC";

                                $statement = $pdo->query($sql);
                                
                                $data_count_1 = 0;
                                
                                while ($row = $statement->fetch()) {
                                    $data_count_1++;
                                    if($data_count_1 == 1) {
                                        print('<tr id="data_table"><th>ID</th><th>投稿日時</th><th>お名前</th><th>カテゴリ</th><th>階級</th><th>メッセージ</th></tr>');
                                    }
    
                                    print('<tr>');
                                    for($i=0; $i<6; $i++) {
                                        if($i == 5){
                                            print('<td id="unset">' . h($row[$i]) . '</td>');
                                        }
                                        else {
                                            print('<td id="normal">' . h($row[$i]) . '</td>');  
                                        }
                                    }
                                    print('</tr>');
                                }
                                if($data_count_1 == 0) {
                                    print('<h1 id="nothing">検索条件に一致する書き込みはありません</h1>');
                                }
                            }
                            else {
                                $sql = 'SELECT * FROM math_test ORDER BY id DESC';
                                $statement = $pdo->query($sql);
    
                                $data_count_2 = 0;
    
                                while ($row = $statement->fetch()) {
                                    $data_count_2++;
                                    if($data_count_2 == 1) {
                                        print('<tr id="data_table"><th>ID</th><th>投稿日時</th><th>お名前</th><th>カテゴリ</th><th>階級</th><th>メッセージ</th></tr>');
                                    }
    
                                    print('<tr>');
                                    for($i=0; $i<6; $i++) {
                                        if($i == 5){
                                            print('<td id="unset">' . h($row[$i]) . '</td>');
                                        }
                                        else {
                                            print('<td id="normal">' . h($row[$i]) . '</td>');  
                                        }
                                    }
                                    print('</tr>');
                                }
                            }
                        }
                        catch(PDOException $e) {
                            $code = $e->getCode();
                            $message = $e->getMessage();
                            print("{$code}/{$message}<br>");
                        }
                        $pdo = null;
                    ?>
                </table>
            </div>
        </main>
        <footer>
            <div id="footer_box">
                <div class="footer_box1">
                    <ul>
                        <li>
                            <a href="../../index.html">ポートフォリオ</a>
                        </li>
                    </ul>
                </div>
                <div class="footer_box1">
                    <p>Copyright🄫Yuma Sasaki All Rights Reserved</p>
                </div>
            </div>
        </footer>
    </body>
</html>