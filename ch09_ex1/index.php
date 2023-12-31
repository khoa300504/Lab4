<?php
//set default values
$name = '';
$email = '';
$phone = '';
$message = 'Enter some data and click on the Submit button.';

//process
$action = filter_input(INPUT_POST, 'action');

switch ($action) {
    case 'process_data':
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email');
        $phone = filter_input(INPUT_POST, 'phone');

        /*************************************************
         * validate and process the name
         ************************************************/
        // 1. make sure the user enters a name
        if($name == NULL)
        {
        $message = "Please enter username";
        break;
        }
        // 2. display the name with only the first letter capitalized
        $nameN = ucfirst($name); 

        /*************************************************
         * validate and process the email address
         ************************************************/
        // 1. make sure the user enters an email
        if($email == NULL)
        {
        $message = "Please enter email";
        break;
        }
        // 2. make sure the email address has at least one @ sign and one dot character
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = 'Please enter a valid email';
            break;
        }

        /*************************************************
         * validate and process the phone number
         ************************************************/
        // 1. make sure the user enters at least seven digits, not including formatting characters
        if($email == NULL || strlen($phone) < 7 || !is_numeric($phone))
        {
            $message = 'Please enter a format phone number';
        }
        else
        // 2. format the phone number like this 123-4567 or this 123-456-7890
        {
            if (strlen($phone) == 7) {
                $formattedPhone = substr($phone, 0, 3) . '-' . substr($phone, 3);
            } elseif (strlen($phone) > 7) {
                $formattedPhone = substr($phone, 0, 3) . '-' . substr($phone, 3, 3) . '-' . substr($phone, 6);
            }
        }

        /*************************************************
         * Display the validation message
         ************************************************/
        $message =
            "Hello $name,\n\n" .
            "Thank you for entering this data:\n\n" .
            "Name: $name\n" .
            "Email: $email\n" .
            "Phone: $formattedPhone\n";
}
include 'string_tester.php';
?>