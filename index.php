<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ІДЗ: Калькулятор витрат</title>
</head>
<body style="background-color: blanchedalmond">
    <h1 style="text-align: center;">Калькулятор витрат</h1>
    <h2 style="text-align: center; color: blue">Для подальшої роботи необхідно увійти до вашого аккаунту</h2>
    <form method="post" style="position: fixed; top: 40%; left: 40%; border: solid; padding: 1em; text-align:center">
        Username: <input type="text" name="user" /> <br /><br />
        Password:  <input type="password" name="pass" /> <br /><br />
        <input type="submit" name="Reg" value="Регістрація" style="margin: 0 auto; width: 120px;" />
        <input type="submit" name="submit" value="Вхід" style="margin: 0 auto; width: 120px;" />
    </form>
    <?php
        session_start();

        if(isset($_POST['Reg'])){
            header("Location: RegisterForm.php");
        }

        $handle = fopen(__DIR__ . '/register_login.txt', "r");
        $lineArr;
        $f = 0;
        if(isset($_POST['submit'])){
            while (!feof($handle)) {
                $line = fgets($handle);
                $lineArr = explode(' ', $line);
                $user = $lineArr[0];
                $pass = $lineArr[1];
                if($user == $_POST['user'] AND $pass == $_POST['pass'].PHP_EOL)
                {
                    $_SESSION['admin'] = $user;
                    header("Location: LoginSuccess.php?get=$user");       
                } 
                else if ($f == 0) {
                    echo '<center><font color="red">Логін або пароль некоректні!</font></center>';
                    $f = 1;
                }
            }
        }
    ?>  
</body>
</html>