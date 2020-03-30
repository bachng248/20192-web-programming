<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DateTimeFunction</title>
</head>

<body>
    <?php
    $keys = array('name1', 'name2', 'birthDay1', 'birthDay2');
    foreach ($keys as $key) {
        if (array_key_exists($key, $_GET)) {
            $$key = $_GET[$key];
        } else {
            $$key = '';
        }
    }

    function customeGetDate($date_string)
    {
        try {
            if ($date_string == '') {
                return NULL;
            }
            return date_create($date_string);
        } catch (Exception $e) {
            return NULL;
        }
    }

    function getDayDiff($birthDay1, $birthDay2)
    {
        $diff = date_diff($birthDay1, $birthDay2);
        return $diff->format("%R%a days");
    }

    function getYearDiff($birthDay1, $birthDay2)
    {
        $diff = date_diff($birthDay1, $birthDay2);
        return $diff->format("%R%y years");
    }

    function getAge($date)
    {
        $diff = date_diff(date_create(), $date);
        return $diff->format("%y");
    }

    function displayInfo($name, $date)
    {
        $date_string = date_format($date, "l, F j, Y");
        $age = getAge($date);
        echo "<br>$name: $date_string - $age years old";
    }

    $bd1 = customeGetDate($birthDay1);
    $bd2 = customeGetDate($birthDay2);
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="get">
        <table>
            <tr>
                <td>First Person's Name:</td>
                <td>
                    <input type="text" name="name1">
                </td>
            </tr>
            <tr>
                <td>First Person's BirthDay:</td>
                <td>
                    <input type="date" name="birthDay1">
                </td>
            </tr>

            <tr>
                <td>Second Person's Name:</td>
                <td>
                    <input type="text" name="name2">
                </td>
            </tr>
            <tr>
                <td>Second Person's BirthDay:</td>
                <td>
                    <input type="date" name="birthDay2">

                </td>
            </tr>
            <tr>
                <td><input align="left" type="submit" value="Submit"></td>
                <td><input align="right" type="reset" value="Reset"></td>
            </tr>
        </table>
    </form>

</body>
<?php
if ($name1 && $bd1 && $name2 && $bd2) {
    displayInfo($name1, $bd1);
    displayInfo($name2, $bd2);
    $dayDiff = getDayDiff($bd1, $bd2);
    $yearDiff = getYearDiff($bd1, $bd2);
    echo "<br>Different in days: $dayDiff";
    echo "<br>Different in years: $yearDiff";
} else {
    echo "Invalid date";
}
?>

</html>