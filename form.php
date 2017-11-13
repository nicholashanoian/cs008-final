<?php
include 'top.php';
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1 Initialize variables
//
// SECTION: 1a.
// We print out the post array so that we can see our form is working.
//if ($debug) { //later you can uncomment the if statement
print '<p>Post Array:</p><pre>';
print_r($_POST);
print '</pre>';
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



$email = "";

// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1d fomr error flags
//
//Initialize Error Flags one for each form element we validate
// in the order they  appear in section 1c.


$emailERROR = false;

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
    $email = filter_var($_POST['txtEmail'], FILTER_SANITIZE_EMAIL);
    $dataRecord[] = $email;






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





    if ($email == '') {
        $errorMsg[] = 'Please enter your email address';
        $emailERROR = true;
    } elseif (!verifyEmail($email)) {
        $errorMsg[] = 'Your email address appears to be incorrect.';
        $emailERROR = true;
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

        foreach ($_POST as $htmlName => $value) {
            if ($htmlName != "btnSubmit") {
                $message .= '<p>';
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

                $message .= ': ' . '<span class="formInfo">' . htmlentities($value, ENT_QUOTES, "UTF-8") . '</span></p>';
            }
        }
        $message .= '</div>';
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
        $subject = 'Video Games';

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
    print '<h3>Thank you for providing your information.</h3>';

    print '<div class="message"><p class="noBottom">For your records, a copy of this data has ';

    if (!$mailed) {
        print "not ";
    }
    print 'been sent to: </p>';
    print '<p class="center noTop"><span class="formInfo">' . $email . '</span></p></div>';

    print $message;
} else {

    print '<br><h2>Are We Missing a Game? Submit a Review Proposal</h2>';
    print '<p class="form-heading">Please fill out the form below.</p>';

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
        <article id="form">
            <form action="<?php print $phpSelf; ?>"
                  id="frmRegister"
                  method="post">

                <fieldset class="contact">
                    <legend>Contact Information</legend>















                    <p>
                        <label class="required" for="txtEmail">Email</label>
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

                <fieldset class="buttons">

                    <input class="button" id="btnSubmit" name="btnSubmit" tabindex="900" type="submit" value="Register">
                </fieldset>
            </form>
        </article>

    <?php
} // end body submit
?>

</article>

    <?php include 'footer.php'; ?>

</body>
</html>