<?php
$phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");

$path_parts = pathinfo($phpSelf);
print '<!DOCTYPE HTML>';
print '<html id="'.$path_parts['filename'].'Background" lang="en">';
        
?>
    <head>
        <title>Climate Change</title>
        <meta charset="utf-8">
        <meta name="author" content="Nicholas Hanoian">
        <meta name="description" content="A look at the many different aspects of climate change" >
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../favicon.ico" rel="icon" type="image/x-icon">
        <link href="../css/custom.css" rel="stylesheet" type="text/css">
    
    
    <?php
    $debug = false;
    
    // This if statement allows us in the classroom to see what our variables are
    // This is NEVER done on a live site
    if(isset($_GET['debug'])) {
        $debug = true;
    }
    
// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// PATH SETUP
//
    
 $domain = '//';   
    
$server = htmlentities($_SERVER['SERVER_NAME'], ENT_QUOTES, 'UTF-8');
    
$domain .= $server;
    
    
    if($debug) {
        
        print '<p>php Self: '.$phpSelf.'</p>';
        print '<p>Path Parts<pre>';
        print_r($path_parts);
        print '</pre></p>';
    }
    
// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// include all libraries
//
// Common mistakeL not have the lib folder with these files.
// Google the difference between require and include
//
    print PHP_EOL.'<!-- include libraries -->'.PHP_EOL;
    
    require_once('lib/security.php');
    
    // notice this if statement only includes the functions if it is
    // form page. A common mistake is to make a form and call the page
    // join.php which means you need to change it below (or delete the if)
    if ($path_parts['filename'] == "form") {
        print PHP_EOL . '<!-- include form libraries -->' . PHP_EOL;
        include 'lib/validation-functions.php';
        include 'lib/mail-message.php';
    }
    
    print PHP_EOL.'<!-- finished including libraries -->'.PHP_EOL;
    ?>
    
    </head>
    <!-- ##################     Start of Body   ################## -->
    
    <?php
    print "<body id='".$path_parts['filename']."'>";
    
    include('header.php');
    include('nav.php');
    
    if ($debug) {
        print '<p>DBUG MODE IS ON</p>';
    }
    ?>