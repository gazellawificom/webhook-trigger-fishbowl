<?php
// Trigger Parameters
//?name={name}&phone={phone}&email={email}&birthday={birthday}&time={time}

$gets = $_GET;

//======================================================================//
// CONFIGURATION
//======================================================================//  

/* This is the email address that this data will be posted to */
$sendto = 'XXXXXX';  // your@email.com

/* These are details needed from your Fishbowl Marketing account */
$user_user_subscribe_url = 'http://XXXXXXXX.fbmta.com/members/subscribe.aspx';  // http://youraccount.fbmta.com/members/subscribe.aspx
$user_guid = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX'; // A23465D0-FE25-2129-1930-348FA2E5A4B1
$user_user_list_id = 'XXXXXXXXXX'; // 17849029382
$user_storecode = 'XXX'; // 002 

if (isset($_GET['email'])) {
    // initial data
    $post_data = [];
    $post_data['Action'] = 'subscribe';
    $post_data['_InputSource_'] = 'w';
    $post_data['ListID'] = $user_list_id;
    $post_data['SiteGUID'] = $user_guid;
    $post_data['SuppressConfirmation'] = 'yes';

    // put here what you need
    $post_data['StoreCode'] = $user_storecode;

    /* [start] Collect data */

    // Birthdate / Yearless Date Field (1904/mm/dd)
    $birthdate = strip_tags($_GET['birthday']);

    // it can be in different formats: mm/dd or mm/dd/YYYY, so we must parse it
    if ($birthdate) {
        if (strlen($birthdate) > 5) {
            if (validateDateFormat($birthdate, 'm/d/Y')) {
                $birthdate = substr($birthdate, 0, -5);
                $post_data['Birthdate'] = '2017/' . $birthdate;
            }
        } else {
            if (validateDateFormat($birthdate, 'm/d')) {
                $post_data['Birthdate'] = '2017/' . $birthdate;
            }
        }
    }

    // EmailAddress / Email Address (200 Character Max) [Required]
    $email = filter_var($_GET['email'], FILTER_SANITIZE_EMAIL);
    if (strlen($email) > 0 && strlen($email) <= 200) {
        $post_data['EmailAddress'] = strtolower($email);
    }

    // FirstName / Text Field (100 Character Max)
    $first_name = strip_tags($_GET['name']);
    if (strlen($first_name) > 0 && strlen($first_name) <= 100) {
        $post_data['FirstName'] = $first_name;
    }

    // Phone / Text Field (100 Character Max)
    $phone = strip_tags($_GET['phone']);
    if (strlen($phone) > 0 && strlen($phone) <= 100) {
        $post_data['Phone'] = $phone;
    }

    /* [end] Collect data */

    // traverse array and prepare data for posting (key1=value1)
    $post_items = [];
    foreach ($post_data as $key => $value) {
        $post_items[] = $key . '=' . $value;
    }

    // create the final string to be posted using implode()
    $post_string = implode('&', $post_items);

    // create cURL connection
    $curl_connection = curl_init();

    // set options
    curl_setopt($curl_connection, CURLOPT_URL, $user_subscribe_url);
    curl_setopt($curl_connection, CURLOPT_POST, 1);
    curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1);

    // set data to be posted
    curl_setopt($curl_connection, CURLOPT_POSTFIELDS, $post_string);

    // perform our request
    $result = curl_exec($curl_connection);

    // show information regarding the request'-' .
    curl_error($curl_connection);

    echo $result;

    // close the connection
    curl_close($curl_connection);
} else {
    echo 'Not Data input';
}

/**
 * Validate date with specified format
 * @param string $date   date
 * @param string $format date format
 * @return bool true if date is correct, false if not
 */
function validateDateFormat($date, $format = 'Y/m/d')
{
    if (!$date) {
        return false;
    }
    DateTime::createFromFormat($format, $date);
    $date_errors = DateTime::getLastErrors();
    if ($date_errors['warning_count'] + $date_errors['error_count'] > 0) {
        return false;
    }
    return true;
}



// Email Message Configuration
$subject = 'Fishbowl Trigger Test';
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

$message = "
Name: $name <br>
Email: $email <br>
Time: $time <br>
Phone: $phone <br>
Birthday: $birthday <br> 
";
mail($sendto, $subject, $message, $headers);

// Example to save queries on disk
file_put_contents('data.log', $gets);  

?>