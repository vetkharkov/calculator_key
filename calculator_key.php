<?php
session_start();
//-------------------
$clear = $_POST['C'];
$del = $_POST['Del'];
$rt = $_POST['res'];
$dot = $_POST['dot'];
$add = $_POST['add'];
$sub = $_POST['sub'];
$mul = $_POST['mul'];
$div = $_POST['div'];
//-------------------
// Если на сайт только-только зашли, обнуляем счетчик val.
if (!isset($_SESSION['val'])) $_SESSION['val'] = "";
//--------------------------------------------------
for ($i=0;$i<10;$i++) {
    $_SESSION['val'] = $_SESSION['val'] . $_POST["$i"];
}
//--------------------------------------------------
function getresult($a = 0, $b = 0, $operator = "+")
{
    switch ($operator) {
        case ("+"):
            return add($a, $b);
            break;
        case ("-"):
            return sub($a, $b);
            break;
        case ("*"):
            return mult($a, $b);
            break;
        case ("/"):
            return div($a, $b);
            break;
    }
}
//-----------------------------------------------
function add($a, $b)
{
    return $a + $b;
}
function sub($a, $b)
{
    return $a - $b;
}
function mult($a, $b)
{
    return $a * $b;
}
function div($a, $b)
{
    return $a / $b;
}
//-----------------------------------------------
if ($clear == "C") {
    $_SESSION['val'] = "";
}
if ($del == "Del") {
    $_SESSION['val'] = substr($_SESSION['val'], 0, -1);
}
if ($dot == ".") {
    $_SESSION['val'] .= ".";
}
if ($add == "+") {
    $_SESSION['val'] .= "+";
}
if ($sub == "-") {
    $_SESSION['val'] .= "-";
}
if ($mul == "*") {
    $_SESSION['val'] .= "*";
}
if ($div == "/") {
    $_SESSION['val'] .= "/";
}
//--------------------------------------------------
$val = $_SESSION['val'];
$result_a = preg_match_all('#[\Q +-*/ \E]?[\d]+[.]?[\d]*#',$val,$arg_a);
$result_o = preg_match('/[^.0-9]/',$arg_a[0][1],$o);
$result_b = preg_match('/[\d]+[.]?[\d]*/',$arg_a[0][1],$arg_b);
$a = $arg_a[0][0];
$b = $arg_b[0];
//--------------------------------------------------
$operator = $o[0];
$equally = " ";
if ($rt == "=") {
    $result = getresult($a, $b, $operator);
    $equally = "=";
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="vet">
    <title>Калькулятор</title>
    <style>
        h1 {
            padding:0px 0px;
            margin:0px 0px;
        }
        form {
            padding: 0px 0px;
            margin: 0px 0px;
        }
        @font-face {
            font-family: digital-7; /* Имя шрифта */
            src: url(digital-7.ttf); /* Путь к файлу со шрифтом */
        }
        p {
            font-size: xx-large;
            font-family: digital-7;
            padding:4px 5px 12px 5px;
            margin: 10px 20px;
            border: 2px #ccc solid;
            -moz-border-radius:  7px; /* Firefox */
            -webkit-border-radius:  7px; /* Safari 4 */
            border-radius:  7px; /* IE 9, Safari 5, Chrome */
            width: auto;
            line-height: 25px;
            background-color: #e3fffc
        }
        input {
            min-height: 50px;
            width: 90px;
            font-size: x-large;
            -moz-border-radius:  7px; /* Firefox */
            -webkit-border-radius:  7px; /* Safari 4 */
            border-radius:  7px; /* IE 9, Safari 5, Chrome */
        }
        div {
            background-color: #a5f7ff;
            margin: 10px auto;
            width: 400px;
            border: 2px #ccc solid;
            -moz-border-radius:  7px; /* Firefox */
            -webkit-border-radius:  7px; /* Safari 4 */
            border-radius:  7px; /* IE 9, Safari 5, Chrome */
        }
        }
    </style>
</head>
<body>
<h1 align="center">Калькулятор</h1>
<div align="center">
    <form action="" method="post">
        <p align="right"><?= "$a $operator $b " . "$equally " . "$result" ?>&#160;</p>
        <table width="250px" height ="300">
            <tr align="center">
                <td colspan="2"><input name="C" value="C" type="submit"></td>
                <td colspan="2"><input name="Del" value="Del" type="submit"></td>
            </tr>
            <tr align="center">
                <td><input name="1" value="1" type="submit"></td>
                <td><input name="2" value="2" type="submit"></td>
                <td><input name="3" value="3" type="submit"></td>
                <td><input name="add" value="+" type="submit"/></td>
            </tr>
            <tr align="center">
                <td><input name="4" value="4" type="submit"></td>
                <td><input name="5" value="5" type="submit"></td>
                <td><input name="6" value="6" type="submit"></td>
                <td><input name="sub" value="-" type="submit" /></td>
            </tr>
            <tr align="center">
                <td><input name="7" value="7" type="submit"></td>
                <td><input name="8" value="8" type="submit"></td>
                <td><input name="9" value="9" type="submit"></td>
                <td><input name="mul" value="*" type="submit" /></td>
            </tr>
            <tr align="center">
                <td><input name="dot" value="." type="submit"></td>
                <td><input name="0" value="0" type="submit"></td>
                <td><input name="res" value="=" type="submit"></td>
                <td><input name="div" value="/" type="submit" /></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>