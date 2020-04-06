<?php
    function user_sort($a, $b){
        // smarts is all-important, so sort it first
        if ($b=='smarts'){
            return 1;
        }
        else if ($a=='smarts'){
            return -1;
        }
        return ($a == $b) ? 0 : ( ($a<$b) ? -1:1 );
    }
    
    $values = array('name' => 'Buzz Lightyear',
                   'email'=> 'buzz@starcomm',
                   'age'=>32,
                   'smarts'=>'some'
                );
    $values_ = $values;
    
    if(isset($_POST['submitted'])){
        $submitted = $_POST["submitted"];
    }
    else {
        $submitted = null;
    }
    
    if(isset($_POST['sort_type'])){
        $sort_type = $_POST["sort_type"];
    }
    else {
        $sort_type = null;
    }
    if ($submitted){
        if ($sort_type){
            if ($sort_type=='usort' || $sort_type == 'uksort' || $sort_type == 'uasort'){
                $sort_type($values, 'user_sort');
            }
            else {
                $sort_type($values);
            }
        }
    }
    
?>

<form action="UserSorting.php" method="post">
    <p>
        <input type="radio" name="sort_type" value="sort" checked="checked"/> Standard sort <br/>
        <input type="radio" name="sort_type" value="rsort" checked="checked"/> Reverse sort <br/>
        <input type="radio" name="sort_type" value="usort" checked="checked"/> User-defined sort <br/>
        <input type="radio" name="sort_type" value="ksort" checked="checked"/> Key sort <br/>
        <input type="radio" name="sort_type" value="krsort" checked="checked"/> Reverse key sort <br/>
        <input type="radio" name="sort_type" value="uksort" checked="checked"/> User-defined key sort <br/>
        <input type="radio" name="sort_type" value="asort" checked="checked"/> Value sort <br/>
        <input type="radio" name="sort_type" value="arsort" checked="checked"/> Reverse Value sort <br/>
        <input type="radio" name="sort_type" value="uasort" checked="checked"/> User-defined value sort <br/>
    </p>
    <p align="center">
        <input type="submit" value="Sort" name="submitted"/>
    </p>
    
    
    
    <p>
        Values <?= $submitted ? "sorted by $sort_type" : "unsorted";?>;
    </p>
    
    <ul>
        <?php
            foreach ($values as $key=>$value){
                echo "<li><b>$key</b>: $value</li>";
            }
        ?>
    </ul>
</form>