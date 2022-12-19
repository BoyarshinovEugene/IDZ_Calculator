<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ІДЗ: Калькулятор витрат</title>
</head>
<body style="background-color: blanchedalmond">
    <form method="post" style="position: fixed; top: 20%; left: 40%; border: solid; padding: 1em; width: 300px;">
        <h1 style="text-align: center;">Регістрація</h1>
        <hr>
        <label for="email"><b>Email</b></label><br>
        <input type="text" placeholder="Введіть Email" name="email" required style="width: 290px;"><br><br>

        <label for="psw"><b>Введіть пароль</b></label><br>
        <input type="password" placeholder="Введіть пароль" name="psw" required style="width: 290px;"><br><br>

        <label for="psw-repeat"><b>Повторіть пароль</b></label><br>
        <input type="password" placeholder="Повторіть пароль" name="psw-repeat" required style="width: 290px;"><br><br>
        <hr>
        <div class="container signin" style="margin: 0 auto; width: 120px;">
            <input type="submit" name="Rgt" value="Зареєструватися" />
        </div>
        <div class="container signin">
            <p style="text-align: center;">Вже є акаунт? <a href="index.php">Увійти</a>.</p>
        </div>
    </form>
    <?php
        session_start();

        $email = $_POST['email'];
        $pass = $_POST['psw'];
        $r_pass = $_POST['psw-repeat'];
        $f = 0;
        if(isset($_POST['Rgt'])){
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if ($pass == $r_pass){
                    $handle = fopen(__DIR__ . '/register_login.txt', "r");
                    while (!feof($handle) and $f == 0) {
                        $line = fgets($handle);
                        $lineArr = explode(' ', $line);
                        $user = $lineArr[0];
                        if($user == $_POST['email'])
                        {
                            $f = 1;
                        } 
                    }
                    fclose($handle);
                    if ($f == 0){
                        $handle = fopen(__DIR__ . '/register_login.txt', "a");
                        fputs($handle, $email);
                        fputs($handle, ' ');
                        fputs($handle, $pass . PHP_EOL);
                        fclose($handle);
                        header("Location: index.php");
                        $file = fopen(__DIR__ . '/' . $email . '.txt', "w");
                    } else{
                        echo '<center><font color="red">Такий користувач вже існує</font></center>';
                    }
                    
                } else {
                    echo '<center><font color="red">Паролі не співпадають</font></center>';
                }
            } else {
                echo '<center><font color="red">Некоректний Email</font></center>';
            }
        }
        
    ?>  
</body>
</html>