<?php
    include ('top.php');
    $htmlName = 'txtUserEmailHere';
    $value = 'nhanoian@uvm.edu';
    $camelCase = preg_split('/(?=[A-Z])/', substr($htmlName, 3));
    $i = 1;
    foreach ($camelCase as $oneWord) {
        print ($oneWord);
        if ($i != count($camelCase)) {
            print (' ');
        }
        $i++;
    }

    print(': ' . '<span class="formInfo">' . htmlentities($value, ENT_QUOTES, "UTF-8") . '</span></p>');
?>