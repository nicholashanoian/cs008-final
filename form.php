<?php
include 'top.php';
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1 Initialize variables
//
// SECTION: 1a.
// We print out the post array so that we can see our form is working.
//if ($debug) { //later you can uncomment the if statement
//print '<p>Post Arrays:</p><pre>';
//print_r($_POST);
//print '</pre>';
//}
// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1b Security
//
// define security variable to be used in SECTION 2a.

$thisURL = $domain . $phpSelf;


// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1c form variables
//
// Initialize varibles on for each form element
// in the order they appear on the form

$firstName = '';

$lastName = '';

$email = '';

$gameTitle = '';

$gameGenre = '';

$age = '';

$xbox = false;
$playstation = false;
$pc = false;
$nswitch = false;
$noPlatforms = false;



// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1d fomr error flags
//
//Initialize Error Flags one for each form element we validate
// in the order they  appear in section 1c.

$firstNameERROR = false;
$lastNameERROR = false;
$emailERROR = false;
$gameTitleERROR = false;
$gameGenreERROR = false;
$ageERROR = false;
$platformERROR = false;
$totalPlatformsChecked = 0;

// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1e misc variables
//
// create array to hold error messages filled (if any) in 2d displayed in 3c.
$errorMsg = array();

// array used to hold form values that will be written to a CSV file
$dataRecord = array();

// have we mailed the information to the user?
$mailed = false;

//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// SECTION: 2 Process for when the form is submitted
//
if (isset($_POST['btnSubmit'])) {

    //@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION: 2a Security
    //
    if (!securityCheck($thisURL)) {
        $msg = '<p>Sorry you cannot access this page. ';
        $msg .= 'Security breach detected and reported.</p>';
        die($msg);
    }





    //@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION: 2b Sanitize (clean) data
    // remove any potential JavaScript or html code from user's input on the
    // form. Note it is best to follow the same order as declared in section 1c.
    $firstName = htmlentities($_POST['txtFirstName'], ENT_QUOTES, 'UTF-8');
    $dataRecord[] = $firstName;

    $lastName = htmlentities($_POST['txtLastName'], ENT_QUOTES, 'UTF-8');
    $dataRecord[] = $lastName;

    $email = filter_var($_POST['txtEmail'], FILTER_SANITIZE_EMAIL);
    $dataRecord[] = $email;

    $gameTitle = htmlentities($_POST['txtGameTitle'], ENT_QUOTES, 'UTF-8');
    $dataRecord[] = $gameTitle;



    $gameGenre = htmlentities($_POST['lstGameGenre'], ENT_QUOTES, 'UTF-8');
    $dataRecord[] = $gameGenre;

    $age = htmlentities($_POST['radAge'], ENT_QUOTES, 'UTF-8');
    $dataRecord[] = $age;

    if (isset($_POST['chkXbox'])) {
        $xbox = true;
        $totalPlatformsChecked++;
    } else {
        $xbox = false;
    }
    $dataRecord[] = $xbox;

    if (isset($_POST['chkPlayStation'])) {
        $playstation = true;
        $totalPlatformsChecked++;
    } else {
        $playstation = false;
    }
    $dataRecord[] = $playstation;

    if (isset($_POST['chkPC'])) {
        $pc = true;
        $totalPlatformsChecked++;
    } else {
        $pc = false;
    }
    $dataRecord[] = $pc;

    if (isset($_POST['chkNintendoSwitch'])) {
        $nswitch = true;
        $totalPlatformsChecked++;
    } else {
        $nswitch = false;
    }
    $dataRecord[] = $nswitch;


    if (isset($_POST['chkNoPlatforms'])) {
        $noPlatforms = true;
        $totalPlatformsChecked++;
    } else {
        $noPlatforms = false;
    }
    $dataRecord[] = $noPlatforms;

    //@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION: 2c Validation
    //
    // Validation section. Check each value for possible errors, empty or
    // not what we expect. You will need an IF block for each element you will
    // check (see above section 1c and 1d). The if blocks should also be in the
    // order that the elements appear on your form so that the error messages
    // will be in the order they appear. errorMsg will be displayed on the form
    // see section 3b. The error flag ($emailERROR) will be used in section 3c.

    if ($firstName == '') {
        $errorMsg[] = 'Please enter your first name';
        $firstNameERROR = true;
    } elseif (!verifyAlphaNum($firstName)) {
        $errorMsg[] = 'Your first name appears to have extra characters.';
        $firstNameERROR = true;
    }

    if ($lastName == '') {
        $errorMsg[] = 'Please enter your last name';
        $lastNameERROR = true;
    } elseif (!verifyAlphaNum($lastName)) {
        $errorMsg[] = 'Your last name appears to have extra characters.';
        $lastNameERROR = true;
    }

    if ($email == '') {
        $errorMsg[] = 'Please enter your email address';
        $emailERROR = true;
    } elseif (!verifyEmail($email)) {
        $errorMsg[] = 'Your email address appears to be incorrect.';
        $emailERROR = true;
    }

    if ($gameTitle == '') {
        $errorMsg[] = "Please enter your game's title";
        $gameTitleERROR = true;
    } elseif (!verifyAlphaNum($gameTitle)) {
        $errorMsg[] = 'Your game title appears to have extra characters.';
        $lastNameERROR = true;
    }

    if ($gameGenre == '') {
        $errorMsg[] = 'Please choose a genre';
        $gameGenreERROR = true;
    }

    if ($age != 'under12' AND $age != '12_17' AND $age != '18_34' AND $age != '35_54' AND $age != 'over54') {
        $errorMsg[] = 'Please choose an age range';
        $ageERROR = true;
    }

    if ($totalPlatformsChecked < 1) {
        $errorMsg[] = 'Please choose at least one platform';
        $platformERROR = true;
    } elseif ($noPlatforms AND ( $xbox OR $playstation OR $pc OR $nswitch)) {
        $errorMsg[] = 'You cannot select "None of these" along with other options';
        $platformERROR = true;
    }




    //@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION: 2d Process Form - Passed Validation
    //
    // Process for when the form passes validation (the errorMsg array is empty)
    //
    if (!$errorMsg) {
        if ($debug)
            print PHP_EOL . '<p>Form is valid</p>';


        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        //
        // SECTION: 2e Save Data
        //
        // This block saves the data to a CSV file.
        $myFolder = 'data/';

        $myFileName = 'requests';

        $fileExt = '.csv';

        $filename = $myFolder . $myFileName . $fileExt;
        if ($debug)
            print PHP_EOL . '<p>filename is ' . $filename;

        // now we just open the file for append
        $file = fopen($filename, 'a');

        // write the form's information
        fputcsv($file, $dataRecord);

        // close the file
        fclose($file);


        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        //
        // SECTION: 2f Create message
        //
        // build a message to display on the screen in section 3a and to mail
        // to the person filling out the form (section 2g).
        $message = '<h3>Your information:</h3><div class=message>';
        $message .= '<ul style="list-style: none;">';

        foreach ($_POST as $htmlName => $value) {
            if ($htmlName != "btnSubmit") {
                $message .= '<li>';
                //breaks up the form names into words. for example
                // txtFirstName becomes First Name
                $camelCase = preg_split('/(?=[A-Z])/', substr($htmlName, 3));
                $i = 1;
                $message .= '<span class="formMessageHead">';
                foreach ($camelCase as $oneWord) {
                    $message .= $oneWord;
                    if ($i != count($camelCase)) { //remove extra space at end of label
                        if ($camelCase != ['', 'P', 'C'] AND $camelCase != ['', 'Play', 'Station']) { //prevent from printing "P C" instead of "PC" and "Play Station"
                            $message .= ' ';
                        }
                    }
                    $i++;
                }
                $value = htmlentities($value, ENT_QUOTES, "UTF-8");
                if ($value == 'Xbox' OR $value == 'PlayStation' OR $value == 'PC' OR
                        $value == 'Nintendo Switch'){
                    $value = 'Selected';
                }
                if ($value == 'None of these') {
                    $value = 'Selected';
                }
                if ($value == 'under12') {
                    $value = 'Under 12 years old';
                }
                if ($value == '12_17') {
                    $value = '12-17 years old';
                }
                if ($value == '18_34') {
                    $value = '18-34 years old';
                }
                if ($value == '35_54') {
                    $value = '35-54 years old';
                }
                if ($value == 'over54') {
                    $value = 'Over 54 years old';
                }
                
                
                $message .= ': ' . '</span><span class="formInfo">' . htmlentities($value, ENT_QUOTES, "UTF-8") . '</span></li>';
            }
        }
        $message .= '</ul></div>';
        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        //  
        // SECTION: 2g Mail to user
        //
        // Process for mailing a message which contains the form's data
        // the message was built in section 2f.
        $to = $email; // the person who filled out the form
        $cc = '';
        $bcc = '';

        $from = 'VGDB<mail@nhanoian.uvm.edu>';

        // subject of mail should make sense to your form
        $subject = 'Game Addition Request';

        $emailMessage = '<h2>Thanks for submitting your request!</h2>';
        $emailMessage .= '<figure><img src="https://nhanoian.w3.uvm.edu/cs008/cs008-final/images/pacman.jpg" alt=""></figure><!-- Photo courtesy of freecodecamp.org -->';
        $emailMessage .= $message;
        $emailMessage .= '<br><h3><a href="https://nhanoian.w3.uvm.edu/cs008/cs008-final/index.php">Video Game Database</a></h3>';


        $mailed = sendMail($to, $cc, $bcc, $from, $subject, $emailMessage);
    } // end form is valid
} //ends if form was submitted
//#########################################################################
//
// SECTION 3 Display Form
//
?>

<article id="main">

    <?php
//##################################
//
    // SECTION 3a.
//
    // If it's the first time coming to the form or there are errors we are going
// to display the form.
    if (isset($_POST['btnSubmit']) AND empty($errorMsg)) { //closing of if marked with: end body submit
        print '<h3>Thank you for submitting your suggestion.</h3>';

        print '<p class="form-heading">For your records, a copy of this data has ';

        if (!$mailed) {
            print "not ";
        }
        print 'been sent to: </p>';
        print '<p class="center message emailContainer"><span class="formInfo">' . $email . '</span></p>';

        print $message;
    } else {

        print '<br><h2>Are we missing a game you would like to see?</h2>';
        print '<p class="form-heading">Fill out the following form and we will look into it!</p>';

        //##################################
        //
        // SECTION 3b Error Messages
        //
        // display any error messages before we print out the form

        if ($errorMsg) {
            print '<div id="errors">' . PHP_EOL;
            print '<h3>Your form has the following mistakes that need to be fixed.</h3>' . PHP_EOL;
            print '<ol>' . PHP_EOL;

            foreach ($errorMsg as $err) {
                print '<li>' . $err . '</li>' . PHP_EOL;
            }

            print '</ol>' . PHP_EOL;
            print '</div>' . PHP_EOL;
        }

        //#######################################
        //
        // SECTION 3c html Form
        //
        /* Display the HTML form. Note that the action is to this same page.
         * $phpSelf is defined in top.php
         * NOTE the line:
         * value="<?php print $email; ?>
         * This makes the form sticky by displaying either the initial default 
         * value (line ??) or the value they typed in  (line ??)
         * NOTE this line:
         * <?php if($emailERROR) print 'class="mistake"'; ?>
         * This prints out a css class so that we can highlight the background 
         * etc. to make it stand out that a mistake happened here.
         */
        ?>

        <form action="<?php print $phpSelf; ?>"
              id="frmRequests"
              method="post">

            <fieldset class="contact">
                <legend>Contact Information</legend>
                <p>
                    <label class='required text-field' for='txtFirstName'>First Name</label>
                    <input autofocus
                    <?php if ($firstNameERROR) print 'class="mistake"'; ?>
                           id='txtFirstName'
                           maxlength='45'
                           name='txtFirstName'
                           onfocus='this.select()'
                           placeholder='Enter your first name'
                           tabindex='100'
                           type='text'
                           value='<?php print $firstName; ?>'
                           >
                </p>    

                <p>
                    <label class='required text-field' for='txtLastName'>Last Name</label>
                    <input 
                    <?php if ($lastNameERROR) print 'class="mistake"'; ?>
                        id='txtLastName'
                        maxlength='45'
                        name='txtLastName'
                        onfocus='this.select()'
                        placeholder='Enter your last name'
                        tabindex='110'
                        type='text'
                        value='<?php print $lastName; ?>'
                        >
                </p> 

                <p>
                    <label class="required text-field" for="txtEmail">Email</label>
                    <input 
                    <?php if ($emailERROR) print 'class="mistake"'; ?>
                        id="txtEmail"
                        maxlength="45"
                        name="txtEmail"
                        onfocus="this.select()"
                        placeholder="Enter a valid email address"
                        tabindex="120"
                        type="text"
                        value="<?php print $email; ?>"
                        >
                </p>            
            </fieldset> <!-- ends contact -->




            <fieldset class="formGameInfo">
                <legend>Your Game</legend>
                <p>
                    <label class='required text-field' for='txtGameTitle'>Game Title</label>
                    <input 
                    <?php if ($gameTitleERROR) print 'class="mistake"'; ?>
                        id='txtGameTitle'
                        maxlength='45'
                        name='txtGameTitle'
                        onfocus='this.select()'
                        placeholder='Enter the title of your game'
                        tabindex='201'
                        type='text'
                        value='<?php print $gameTitle; ?>'
                        >
                </p>
                <p>
                    <label class='required check-label'>Game Genre</label>
                    <select id='lstgameGenre' class="<?php if ($gameGenreERROR) print 'mistake'; ?>"
                            name='lstGameGenre'
                            tabindex='303'>

                        <option <?php if ($gameGenre == 'Role-Play') print 'selected'; ?>
                            value='Role-Play'>Role-Play</option>

                        <option <?php if ($gameGenre == 'Action') print 'selected'; ?>
                            value='Action'>Action</option>

                        <option <?php if ($gameGenre == 'Sports') print 'selected'; ?>
                            value='Sports'>Sports</option>

                        <option <?php if ($gameGenre == 'Other') print 'selected'; ?>
                            value='Other'>Other</option>



                    </select>
                </p>



            </fieldset>

            <fieldset class="radio">
                <legend>How old are you?</legend>
                <ul class="<?php if ($ageERROR) print 'mistake'; ?>">
                    <li>
                        <label class="radio-field">
                            <input type="radio"
                                   id="radAgeunder12"
                                   name="radAge"
                                   value="under12"
                                   tabindex="672"
                                   <?php if ($age == 'under12') print 'checked'; ?>>
                            Under 12 Years Old</label>
                    </li>

                    <li>
                        <label class="radio-field">
                            <input type="radio"
                                   id="radAge12_17"
                                   name="radAge"
                                   value="12_17"
                                   tabindex="682"
                                   <?php if ($age == '12_17') print 'checked'; ?>>

                            12-17 years old</label>
                    </li>

                    <li>
                        <label class="radio-field">
                            <input type="radio"
                                   id="radAge18_34"
                                   name="radAge"
                                   value="18_34"
                                   tabindex="692"
                                   <?php if ($age == '18_34') print 'checked'; ?>>

                            18-34 years old</label>
                    </li>

                    <li>
                        <label class="radio-field">
                            <input type="radio"
                                   id="radAge35_54"
                                   name="radAge"
                                   value="35_54"
                                   tabindex="695"
                                   <?php if ($age == '35_54') print 'checked'; ?>>

                            35-54 years old</label>
                    </li>

                    <li>
                        <label class="radio-field">
                            <input type="radio"
                                   id="radAgeover54"
                                   name="radAge"
                                   value="over54"
                                   tabindex="698"
                                   <?php if ($age == 'over54') print 'checked'; ?>>

                            Over 54 years old</label>
                    </li>
                </ul>

            </fieldset>



            <fieldset class='checkbox'>
                <legend>Which platform(s) do you use?</legend>
                <ul class="<?php if ($platformERROR) print "mistake"; ?>">
                    <li>
                        <label class="check-field">
                            <input <?php if ($xbox) print 'checked'; ?>
                                id="chkXbox"
                                name="chkXbox"
                                tabindex="801"
                                type="checkbox"
                                value="Xbox">
                            Xbox</label>
                    </li>

                    <li>
                        <label class="check-field">
                            <input <?php if ($playstation) print 'checked'; ?>
                                id="chkPlayStation"
                                name="chkPlayStation"
                                tabindex="811"
                                type="checkbox"
                                value="PlayStation">
                            PlayStation</label>
                    </li>

                    <li>
                        <label class="check-field">
                            <input <?php if ($pc) print 'checked'; ?>
                                id="chkPC"
                                name="chkPC"
                                tabindex="821"
                                type="checkbox"
                                value="PC">
                            PC</label>
                    </li>

                    <li>
                        <label class="check-field">
                            <input <?php if ($nswitch) print 'checked'; ?>
                                id="chkNintendoSwitch"
                                name="chkNintendoSwitch"
                                tabindex="831"
                                type="checkbox"
                                value="Nintendo Switch">
                            Nintendo Switch</label>
                    </li>

                    <li>
                        <label class="check-field">
                            <input <?php if ($noPlatforms) print 'checked'; ?>
                                id="chkNoPlatforms"
                                name="chkNoPlatforms"
                                tabindex="851"
                                type="checkbox"
                                value="None of these">
                            None of these</label>
                    </li>


                </ul>


            </fieldset>



















            <fieldset class="buttons">

                <input class="button" id="btnSubmit" name="btnSubmit" tabindex="900" type="submit" value="Submit">
            </fieldset>


        </form>

        <?php
    } // end body submit
    ?>

</article>

<?php include 'footer.php'; ?>

</body>
</html>