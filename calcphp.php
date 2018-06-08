<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Калькулятор PHP</title>
</head>
<body>
<?php
function Operation($numberA, $operation, $numberB)
{
    switch ($operation) {
        case '+':
            return $numberA + $numberB;
        case '-':
            return $numberA - $numberB;
        case '*':
            return $numberA * $numberB;
        case  '/':
            if ($numberB > 0)
                return $numberA / $numberB;
            else
                return null;
        default:
            return null;
    }
}

if ($_POST['A'] != null and $_POST['op'] != null and $_POST['B'] != null) {
    ?>
    <form action="calcphp.php" method="post">
        <input name="numberA" type="number" value="<?=$_POST['A'];?>" required>
        <select name="operation" size="5" required>
            <option disabled>Выберите операцию</option>
            <option value="+" <?php if($_POST['op'] == '+'){ ?>selected<? } ?>>+</option>
            <option value="-" <?php if($_POST['op'] == '-'){ ?>selected<? } ?>>-</option>
            <option value="*" <?php if($_POST['op'] == '*'){ ?>selected<? } ?>>*</option>
            <option value="/" <?php if($_POST['op'] == '/'){ ?>selected<? } ?>>/</option>
        </select>
        <input name="numberB" type="number" value="<?=$_POST['B'];?>" required>
        <b><input type="submit" value="="></b>
        <span style="padding-left: 10px;"><b><?
                $Answer = Operation($_POST['A'],$_POST['op'],$_POST['B']);
                if($Answer != null){ echo $Answer; } else { ?><span style="color: red">Ошибка!</span><? } ?></b></span>
    </form>
<? } else { ?>
<form action="calcphp.php" method="post">
    <input name="A" type="number" required>
    <select name="op" size="5" required>
        <option disabled>Выберите операцию</option>
        <option value="+">+</option>
        <option value="-">-</option>
        <option value="*">*</option>
        <option value="/">/</option>
    </select>
    <input name="B" type="number" required>
    <b><input type="submit" value="="></b>
</form>
<? } ?>
</body>
</html>