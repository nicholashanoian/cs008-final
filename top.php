<?php
$phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");

$path_parts = pathinfo($phpSelf);
print '<!DOCTYPE HTML>';
print '<html id="' . $path_parts['filename'] . 'Background" lang="en">';
?>
<head>
    <title>VGDB</title>
    <meta charset="utf-8">
    <meta name="author" content="Nicholas Hanoian and Chris McCabe">
    <meta name="description" content="A database of videogames" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="images/controller-icon.png" rel="icon" type="image/x-icon">
    <link href="css/custom.css" rel="stylesheet" type="text/css">

    <?php
    $debug = false;

    // This if statement allows us in the classroom to see what our variables are
    // This is NEVER done on a live site
    if (isset($_GET['debug'])) {
        $debug = true;
    }

// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// PATH SETUP
//

    $domain = '//';

    $server = htmlentities($_SERVER['SERVER_NAME'], ENT_QUOTES, 'UTF-8');

    $domain .= $server;


    if ($debug) {

        print '<p>php Self: ' . $phpSelf . '</p>';
        print '<p>Path Parts<pre>';
        print_r($path_parts);
        print '</pre></p>';
    }

    
    if(isset($_GET["genre"])){
        $genre = htmlentities($_GET['genre'], ENT_QUOTES, "UTF-8");    
    }
// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// include all libraries
//
// Common mistakeL not have the lib folder with these files.
// Google the difference between require and include
//
    print PHP_EOL . '<!-- include libraries -->' . PHP_EOL;

    require_once('lib/security.php');

    // notice this if statement only includes the functions if it is
    // form page. A common mistake is to make a form and call the page
    // join.php which means you need to change it below (or delete the if)
    if ($path_parts['filename'] == "form") {
        print PHP_EOL . '<!-- include form libraries -->' . PHP_EOL;
        include 'lib/validation-functions.php';
        include 'lib/mail-message.php';
    }

    if ($path_parts['filename'] == "game") {
        include 'lib/rating-gradient.php';
    }
    
    include 'lib/get-image-path-array.php';
    
    print PHP_EOL . '<!-- finished including libraries -->' . PHP_EOL;

    print PHP_EOL . '<!-- start reading data -->' . PHP_EOL;

    $myFolder = 'data/';

    $myFileName = 'games';

    $fileExt = '.csv';

    $filename = $myFolder . $myFileName . $fileExt;

    if ($debug)
        print '<p>filename is ' . $filename;

    $file = fopen($filename, "r");

    if ($debug) {
        if ($file) {
            print '<p>File Opened Succesful.</p>';
        } else {
            print '<p>File Open Failed.</p>';
        }
    }

    if ($file) {
        if ($debug)
            print '<p>Begin reading data into an array.</p>';

        // read the header row, copy the line for each header row
        // you have.
        $headers[] = fgetcsv($file);
        $headers = $headers[0];

        if ($debug) {
            print '<p>Finished reading headers.</p>';
            print '<p>My header array</p><pre>';
            print_r($headers);
            print '</pre>';
        }

        // read all the data
        while (!feof($file)) {
            $gameData[] = fgetcsv($file);
        }

        if ($debug) {
            print '<p>Finished reading data. File closed.</p>';
            print '<p>My data array<p><pre> ';
            print_r($gameData);
            print '</pre></p>';
        }

        fclose($file);
    } // ends if file was opened 

    print PHP_EOL . '<!-- end reading data -->' . PHP_EOL;
    ?>

</head>
<!-- ##################     Start of Body   ################## -->

<?php
print "<body id='" . $path_parts['filename'] . "'>";

include('header.php');
include('nav.php');

if ($debug) {
    print '<p>DEBUG MODE IS ON</p>';
}
?>