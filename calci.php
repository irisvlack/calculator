<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&display=swap');

        html {
            height: 100%;
            font-family: 'Roboto Mono', monospace;
            background: linear-gradient(45deg, #333, #666, #999, #ccc, #fff);
            background-size: 400% 400%;
            animation: gradientAnimation 15s ease infinite;
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            font-size: 3rem;
            font-weight: 700;
            text-align: center;
            color: #fff;
            text-shadow: 0 0 10px #fff;
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            background-color: #444;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.5);
            border-radius: 10px;
        }

        td, tr {
            padding: 10px;
        }

        .result {
            border: 1px solid #fff;
            background-color: #222;
            color: #fff;
            box-shadow: 0 0 10px #fff;
        }

        input[type="submit"] {
            background-color: #666;
            color: #fff;
            border: 1px solid #fff;
            border-radius: 5px;
            padding: 15px;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #fff;
            color: #000;
            box-shadow: 0 0 10px #fff;
        }

        input[type="text"] {
            text-align: right;
            background-color: #000;
            color: #fff;
            border: none;
            padding: 15px;
            font-size: 1.5rem;
            width: 100%;
        }

        .num input[type="submit"] {
            background-color: #999;
            color: #000;
        }

        .num input[type="submit"]:hover {
            box-shadow: 0 0 10px #999;
        }

        .op input[type="submit"] {
            background-color: #ccc;
            color: #000;
        }

        .op input[type="submit"]:hover {
            box-shadow: 0 0 10px #ccc;
        }

        .reset input[type="submit"] {
            background-color: #444;
            color: #fff;
        }

        .reset input[type="submit"]:hover {
            box-shadow: 0 0 10px #444;
        }
    </style>
</head>

<body>
<?php
$num = "";
$result = "";
$cookie_name1 = "num";
$cookie_value1 = "";
$cookie_name2 = "op";
$cookie_value2 = "";

if(isset($_POST['submit'])){
    $num = $_POST['display'].$_POST['submit'];
} else {
    $num = "";
}

if(isset($_POST['op'])){
    $cookie_value1 = $_POST['display'];
    setcookie($cookie_name1, $cookie_value1, time() + (24*60*60*30), "/");
 
    $cookie_value2 = $_POST['op'];
    setcookie($cookie_name2, $cookie_value2, time() + (24*60*60*30), "/");
}

if(isset($_POST['equals'])) {
    $num = $_POST['display'];
    switch($_COOKIE['op']) {
        case "+":
            $result = $_COOKIE['num'] + $num;
            break;
        case "-":
            $result = $_COOKIE['num'] - $num;
            break;
        case "x":
            $result = $_COOKIE['num'] * $num;
            break;
        case "÷":
            $result = $_COOKIE['num'] / $num;
            break;
        case "√x":
            $result = sqrt($_COOKIE['num']);
            break;
        case "x^2":
            $result = ($_COOKIE['num'])*($_COOKIE['num']);
            break;
        case "ln":
            $result = log($_COOKIE['num']);
            break;  
        case "log10":
            $result = log($_COOKIE['num'], 10);
            break;   
        case "sin":
            $result = sin($_COOKIE['num'] * M_PI/180);
            break; 
        case "cos":
            $result = cos($_COOKIE['num'] * M_PI/180);
            break;
        case "tan":
            $result = tan($_COOKIE['num'] * M_PI/180);
            break;
        case "cot":
            $result = 1/tan($_COOKIE['num'] * M_PI/180);
            break;
        case "cosec":
            $result = 1/sin($_COOKIE['num'] * M_PI/180);
            break;
        case "sec":
            $result = 1/cos($_COOKIE['num'] * M_PI/180);
            break;
        default:
            $result = "Invalid";
    }
    $num = $result;
}
?>
<div class="container">
    <form method="post">
        <table>
            <tr>
                <td colspan="5"><input class="result" type="text" name="display" value=<?php echo $num; ?>></td>
            </tr>
            <tr>
                <td><input type="submit" name="op" value="√x"></td>
                <td><input type="submit" name="op" value="x^2"></td>
                <td colspan="3" class="reset"><input type="submit" name="clear" value="C"></td>
                <td class="op"><input type="submit" name="op" value="÷"></td>
            </tr>
            <tr>
                <td><input type="submit" name="op" value="ln"></td>
                <td><input type="submit" name="op" value="log10"></td>
                <td class="num"><input type="submit" name="submit" value="7"></td>
                <td class="num"><input type="submit" name="submit" value="8"></td>
                <td class="num"><input type="submit" name="submit" value="9"></td>
                <td class="op"><input type="submit" name="op" value="x"></td>
            </tr>
            <tr>
                <td><input type="submit" name="op" value="sin"></td>
                <td><input type="submit" name="op" value="cos"></td>
                <td class="num"><input type="submit" name="submit" value="4"></td>
                <td class="num"><input type="submit" name="submit" value="5"></td>
                <td class="num"><input type="submit" name="submit" value="6"></td>
                <td class="op"><input type="submit" name="op" value="-"></td>
            </tr>
            <tr>
                <td><input type="submit" name="op" value="tan"></td>
                <td><input type="submit" name="op" value="cot"></td>
                <td class="num"><input type="submit" name="submit" value="1"></td>
                <td class="num"><input type="submit" name="submit" value="2"></td>
                <td class="num"><input type="submit" name="submit" value="3"></td>
                <td class="op"><input type="submit" name="op" value="+"></td>
            </tr>
            <tr>
                <td><input type="submit" name="op" value="cosec"></td>
                <td><input type="submit" name="op" value="sec"></td>
                <td colspan="2" class="num"><input type="submit" name="submit" value="0"></td>
                <td class="num"><input type="submit" name="submit" value="."></td>
                <td class="op"><input type="submit" name="equals" value="="></td>
            </tr>
        </table>
    </form>
</div>
</body>

</html>
