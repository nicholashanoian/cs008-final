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

$email = "nhanoian@uvm.edu";

$gameTitle = '';

$gameGenre = '';

$season = '';

$bear = false;
$deer = false;
$moose = false;
$owl = false;
$raccoon = false;
$noAnimals = false;



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
$seasonERROR = false;
$animalERROR = false;
$totalAnimalsChecked = 0;

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
    
    $season = htmlentities($_POST['radSeason'], ENT_QUOTES, 'UTF-8');
    $dataRecord[] = $season;
    
    if (isset($_POST['chkBear'])) {
        $bear = true;
        $totalAnimalsChecked++;
    } else {
        $bear = false;
    }
    $dataRecord[] = $bear;
    
    if (isset($_POST['chkDeer'])) {
        $deer = true;
        $totalAnimalsChecked++;
    } else {
        $deer = false;
    }
    $dataRecord[] = $deer;
    
    if (isset($_POST['chkMoose'])) {
        $moose = true;
        $totalAnimalsChecked++;
    } else {
        $moose = false;
    }
    $dataRecord[] = $moose;
    
    if (isset($_POST['chkOwl'])) {
        $owl = true;
        $totalAnimalsChecked++;
    } else {
        $owl = false;
    }
    $dataRecord[] = $owl;
    
    if (isset($_POST['chkRaccoon'])) {
        $raccoon = true;
        $totalAnimalsChecked++;
    } else {
        $raccoon = false;
    }
    $dataRecord[] = $raccoon;

    if (isset($_POST['chkNoAnimals'])) {
        $noAnimals = true;
        $totalAnimalsChecked++;
    } else {
        $noAnimals = false;
    }
    $dataRecord[] = $noAnimals;


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
    
    if($gameGenre == '') {
        $errorMsg[] = 'Please choose a genre';
        $gameGenreERROR = true;
    }
    
    if ($season != 'Spring' AND $season != 'Summer' AND $season != 'Fall' AND $season != 'Winter') {
        $errorMsg[] = 'Please choose a favorite season';
        $seasonERROR = true;
    }
    
    if($totalAnimalsChecked < 1) {
        $errorMsg[] = 'Please choose at least one animal, or select the "None of these" option';
        $animalERROR = true;
    } elseif ($noAnimals AND ($bear OR $deer OR $moose OR $owl OR $raccoon)) {
        $errorMsg[] = 'You cannot select "None of these" along with other options';
        $animalERROR = true;
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

        $myFileName = 'registration';

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
                foreach ($camelCase as $oneWord) {
                    $message .= $oneWord;
                    if ($i != count($camelCase)) { //remove extra space at end of label
                        $message .= ' ';
                    }
                    $i++;
                }
                $value = htmlentities($value, ENT_QUOTES, "UTF-8");
                if($value == 'Bear' OR $value == 'Deer' OR $value == 'Moose' OR
                        $value == 'Owl' OR $value == 'Raccoon') {
                    $value = 'Selected';
                }
                if($value == 'None of these') {
                    $value = 'Selected';
                }
                $message .= ': ' . '<span class="formInfo">' . htmlentities($value, ENT_QUOTES, "UTF-8") . '</span></li>';
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

        $from = 'Save The Planet<mail@nhanoian.uvm.edu>';

        // subject of mail should make sense to your form
        $subject = 'Our Changing Planet';

        $emailMessage = '<h2>Thanks for joining!</h2>';
        $emailMessage .= '<fig><img src="https://nhanoian.w3.uvm.edu/cs008/images/camel.jpg" alt=""></fig><!-- Photo courtesy of UVM Bored -->';
        $emailMessage .= $message;
        $emailMessage .= '<br><h3><a href="https://nhanoian.w3.uvm.edu/cs008/lab10/index.php">Our Changing Planet</a></h3>';


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

        print '<div class="message"><p class="noBottom">For your records, a copy of this data has ';

        if (!$mailed) {
            print "not ";
        }
        print 'been sent to: </p>';
        print '<p class="center noTop"><span class="formInfo">' . $email . '</span></p></div>';

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
              id="frmRegister"
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




            <fieldset class="gameInfo">
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
            </fieldset>             
                
                
                
                
                
                
                
                
<!--                <ul class="<?php if ($genderERROR) print 'mistake'; ?>">
                    <li>
                        <label class="radio-field">
                            <input type="radio"
                                   id="radGenderMale"
                                   name="radGender"
                                   value="Male"
                                   tabindex="272"
                                   <?php if ($gender == 'Male') print 'checked'; ?>>
                            Male</label>
                    </li>

                    <li>
                        <label class="radio-field">
                            <input type="radio"
                                   id="radGenderFemale"
                                   name="radGender"
                                   value="Female"
                                   tabindex="282"
                                   <?php if ($gender == 'Female') print 'checked'; ?>>

                            Female</label>
                    </li>

                    <li>
                        <label class="radio-field">
                            <input type="radio"
                                   id="radGenderOther"
                                   name="radGender"
                                   value="Other"
                                   tabindex="292"
                                   <?php if ($gender == 'Other') print 'checked'; ?>>

                            Other</label>
                    </li>
                </ul>-->



            
            
            <fieldset class="listbox">
                <legend>What genre is your game?</legend>
                <select id='lstgameGenre' class="<?php if ($gameGenreERROR) print 'mistake';?>"
                        name='lstGameGenre'
                        tabindex='303'>
                            
                    <option <?php if ($gameGenre == 'Role-Play') print 'selected';?>
                        value='Role-Play'>Role-Play</option>
                    
                    <option <?php if ($gameGenre == 'Action') print 'selected';?>
                        value='Action'>Action</option>
                    
                    <option <?php if ($gameGenre == 'Sports') print 'selected';?>
                        value='Sports'>Sports</option>
                    
                    <option <?php if ($gameGenre == 'Other') print 'selected';?>
                        value='Other'>Other</option>
                    
                    
                    
                </select>
                
                
                
            </fieldset>
            
            <fieldset class="radio">
                <legend>What is your favorite season?</legend>
                <ul class="<?php if ($seasonERROR) print 'mistake'; ?>">
                    <li>
                        <label class="radio-field">
                            <input type="radio"
                                   id="radSeasonSpring"
                                   name="radSeason"
                                   value="Spring"
                                   tabindex="672"
                                   <?php if ($season == 'Spring') print 'checked'; ?>>
                            Spring</label>
                    </li>

                    <li>
                        <label class="radio-field">
                            <input type="radio"
                                   id="radSeasonSummer"
                                   name="radSeason"
                                   value="Summer"
                                   tabindex="682"
                                   <?php if ($season == 'Summer') print 'checked'; ?>>

                            Summer</label>
                    </li>

                    <li>
                        <label class="radio-field">
                            <input type="radio"
                                   id="radSeasonFall"
                                   name="radSeason"
                                   value="Fall"
                                   tabindex="692"
                                   <?php if ($season == 'Fall') print 'checked'; ?>>

                            Fall</label>
                    </li>

                    <li>
                        <label class="radio-field">
                            <input type="radio"
                                   id="radSeasonWinter"
                                   name="radSeason"
                                   value="Winter"
                                   tabindex="695"
                                   <?php if ($season == 'Winter') print 'checked'; ?>>

                            Winter</label>
                    </li>
                </ul>

            </fieldset>
            
            
            
            <fieldset class='checkbox'>
                <legend>Which animals have you seen in nature?</legend>
                <ul class="<?php if($animalERROR) print "mistake";?>">
                    <li>
                        <label class="check-field">
                            <input <?php if ($bear) print 'checked';?>
                                id="chkBear"
                                name="chkBear"
                                tabindex="801"
                                type="checkbox"
                                value="Bear">
                        Bear</label>
                    </li>
                    
                    <li>
                        <label class="check-field">
                            <input <?php if ($deer) print 'checked';?>
                                id="chkDeer"
                                name="chkDeer"
                                tabindex="811"
                                type="checkbox"
                                value="Deer">
                        Deer</label>
                    </li>
                    
                    <li>
                        <label class="check-field">
                            <input <?php if ($moose) print 'checked';?>
                                id="chkMoose"
                                name="chkMoose"
                                tabindex="821"
                                type="checkbox"
                                value="Moose">
                        Moose</label>
                    </li>
                    
                    <li>
                        <label class="check-field">
                            <input <?php if ($owl) print 'checked';?>
                                id="chkOwl"
                                name="chkOwl"
                                tabindex="831"
                                type="checkbox"
                                value="Owl">
                        Owl</label>
                    </li>
                    
                    <li>
                        <label class="check-field">
                            <input <?php if ($raccoon) print 'checked';?>
                                id="chkRaccoon"
                                name="chkRaccoon"
                                tabindex="841"
                                type="checkbox"
                                value="Raccoon">
                        Raccoon</label>
                    </li>
                    
                    <li>
                        <label class="check-field">
                            <input <?php if ($noAnimals) print 'checked';?>
                                id="chkNoAnimals"
                                name="chkNoAnimals"
                                tabindex="851"
                                type="checkbox"
                                value="None of these">
                        None of these</label>
                    </li>
                    
                    
                </ul>
                
                
            </fieldset>
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            

            <fieldset class="buttons">

                <input class="button" id="btnSubmit" name="btnSubmit" tabindex="900" type="submit" value="Register">
            </fieldset>


        </form>

        <?php
    } // end body submit
    ?>

</article>

<?php include 'footer.php'; ?>

</body>
</html>