<html>
    <head><title>Conditional Test</title></head>
<body>
    <?php
        $first=$_GET["firstName"]; $middle = $_GET["middleName"]; $last = $_GET["lastName"];
        print("Hi $first! Your full name is $last $middle $first. <br>");
        if ($first == $last){
            print("$first and $last are equal");
        }
        if ($first < $last){
            print("$first is less than $last");
        }
        if ($first > $last){
            print ("$first is greater than $last");
        }
        print("<br></br>");
        
        $grade1 = $_GET["grade1"]; $grade2 = $_GET["grade2"];
        $final = (2*$grade1+3*$grade2)/5;
        
        if ($final > 89){
            print ("Your final grade is $final. You got an A. Congratulations!");
        }
        else if ($final > 79){
            print ("Your final grade is $final. You got an B.");
        }
        else if ($final > 69){
            print ("Your final grade is $final. You got an C.");
        }
        else if ($final > 59){
            print ("Your final grade is $final. You got an D.");
        }
        else if ($final > 0){
            print ("Your final grade is $final. You got an F.");
        }
        else {
            print("Illegal grade less than 0. FInal grade = $final");
        }
    ?>
</body>
</html>