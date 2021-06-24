<!doctype html>
<html lang="ko">

<head>
    <meta charset="utf-8">
    <title>Coding Factory</title>
    <style>
        p {
            font-family: "Times New Roman";
            font-style: italic;
            font-size: 1.3em;
        }
    </style>
</head>

<body>
    <?php
    $var1;
    $var2 = NULL;
    $var3 = "";
    $var4 = "Lorem";
    if (isset($var1)) {
        echo "<p>var1 is set.</p>";
    } else {
        echo "<p>var1 is not set.</p>";
    };
    if (isset($var2)) {
        echo "<p>var2 is set.</p>";
    } else {
        echo "<p>var2 is not set.</p>";
    };
    if (isset($var3)) {
        echo "<p>var3 is set.</p>";
    } else {
        echo "<p>var3 is not set.</p>";
    };
    if (isset($var4)) {
        echo "<p>var4 is set.</p>";
    } else {
        echo "<p>var4 is not set.</p>";
    };
    if (isset($var2, $var3)) {
        echo "<p>var2 and var3 are set.</p>";
    } else {
        echo "<p>var2 and var3 are not set.</p>";
    };
    if (isset($var3, $var4)) {
        echo "<p>var3 and var4 are set.</p>";
    } else {
        echo "<p>var3 and var4 are not set.</p>";
    };
    ?>
</body>

</html>