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
    <h2 style="text-align: center;">Витрати користувача: 
    <?php
        $get=$_GET['get'];
        echo $get;
    ?></h2>
    <form method="post" style="padding: 1em; width: 1480px; text-align: center;">
        <label for="spending"><b>Найменування: </b></label>
        <input type="text" name="spending" style="margin: auto 20px auto 20px; width: 200px;"/>
        <label for="cost"><b>Вартість: </b></label>
        <input type="text" name="cost" style="margin: auto 20px auto 20px; width: 200px;"/>
        <input type="submit" name="submit" value="Додати" style="margin: auto 20px auto 20px; width: 200px;" />
        <input type="submit" name="exit" value="Вийти" style="margin: auto 20px auto 20px; width: 200px;" />
    </form>
    <?php
        if (isset($_POST['submit'])){
            if (($_POST['spending'] != '') and ($_POST['cost'] != '')) {
                $spend = $_POST['spending'];
                $cost = $_POST['cost'];
                $get=$_GET['get'];
                $handle = fopen(__DIR__ . '/'. $get .'.txt', "a");
                fputs($handle, $spend);
                fputs($handle, ' ');
                fputs($handle, $cost . PHP_EOL);
                fclose($handle);
            } else {
                echo '<center><font color="red">Заповніть поля</font></center>';
            } 
        }
        if (isset($_POST['exit'])){
            header("Location: index.php");
        }
        
    ?></h2>
    <form method="post" style="border: solid; padding: 1em; background-color: white">
        <?php
            $price = 0;
            $get=$_GET['get'];
            $handle = fopen(__DIR__ . '/'. $get .'.txt', "r");
            while (!feof($handle)) {
                $line = fgets($handle);
                $lineArr = explode(' ', $line);
                $price += $lineArr[1];
                echo '<p>' . $line . '</p>';
            }
            echo '<center><h> Загальні витрати: ' . $price . '</h1></center>';
        ?>
    </form>
</body>
</html>

