<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
</head>

<body>
    <?php
    $arr = array('YSJ', 'chicken', 'sushi', 'pizza');
    echo $arr[0] . '<br>';
    echo $arr[1] . '<br>';

    var_dump(count($arr));
    array_push($arr, 'bread');
    var_dump($arr);

    $i = 0;
    while ($i < count($arr)) {
        echo $arr[$i] . '<br>';
        $i = $i + 1;
    }
    ?>

</body>

</html>