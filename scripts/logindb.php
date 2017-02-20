<?php
// MySQL Server connection data
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_SERVER', 'localhost:3306');
DEFINE ('DB_NAME', 'security');
DEFINE ('USER_PROFILES_TABLE_NAME', 'user_profiles');
DEFINE ('LOGIN_TABLE_NAME', 'login');

// Check for POST request
if($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Attempt to connect to MySQL Server
    $mysql_connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);

    // Check connection to MySQL Server
    if ($mysql_connection) {
        // Attempt to connect to the MySQL database
        $db_connection = mysqli_select_db($mysql_connection, DB_NAME);

        // Check connection to the MySQL database
        if ($db_connection) {

            // Workaround to bullshit PhpStorm problem ($_POST empty)
            $_POST = array();
            parse_str(file_get_contents('php://input'), $_POST);
            //var_dump($_POST);

            $user_name = $_POST['user-name'];
            $user_name = trim($user_name);
            $password = $_POST['password'];
            $password = trim($password);

            // Check if the User Profile exists and retrieve the User Profile
            $sqlSelectQuery = "SELECT * FROM " . DB_NAME . "." . USER_PROFILES_TABLE_NAME . " WHERE email = '$user_name'";
            //var_dump($sqlSelectQuery);

            $result = mysqli_query($mysql_connection, $sqlSelectQuery);

            if ($result->num_rows > 0) {
                // Retrieve the User Profile
                $row = $result->fetch_row();
                // Retrieve the User Profile ID
                $user_profile_id = $row[0];
                // Retrieve the Account ID
                $account_id = $row[2];
                // Retrieve the User Type ID
                $user_type_id = $row[3];
                // Retrieve the stored password hash
                $stored_password_hash = $row[7];

                //print ("Stored password hash");
                //var_dump($stored_password_hash);

                // Verify the password
                if (password_verify($password, $stored_password_hash)) {
                    // Begin a session. Do not use md5(), it will produce the same hash for a user name.
                    $salt = mt_rand();
                    $session_id = hash('sha256', $user_name . $salt);
                    session_id($session_id);
                    session_start();

                    // Indicate this user is logged in
                    $_SESSION["user_profile_id"] = $user_profile_id;
                    $_SESSION["session_id"]      = $session_id;
                    $_SESSION["logged_in"]       = true;
                    $_SESSION["admin_logged_in"] = false;
                    $_SESSION["account_id"]      = $account_id;

                    // Indicate an Admin is logged in
                    if ($user_type_id == 1) {
                        $_SESSION["admin_logged_in"] = true;
                    }

                    // Add user profile to the Login table
                    $public_ip_address = get_ip_address();

                    // Insert the new Login table entry
                    $sqlInsertQuery = "INSERT INTO " . DB_NAME . "." . LOGIN_TABLE_NAME . " (USER_PROFILE_ID, PUBLIC_IP_ADDRESS, SESSION_ID) VALUES('$user_profile_id', '$public_ip_address', '$session_id')";
                    //var_dump($sqlInsertQuery);

                    $result = mysqli_query($mysql_connection, $sqlInsertQuery);

                    if ($result) {
                        $formMessage = "Successfully logged in.";
                    }
                    else {
                        $formMessage = "Unable to add entry to the Login table" . mysqli_connect_error();
                    }

                    include('home.php');

                    // FOR TEST PURPOSES ONLY
                    //$formMessage = "Valid user name and password.";
                    //include('login.php');
                }
                else {
                    $formMessage = "Invalid user name or password.";
                    include('login.php');

                    // FOR TEST PURPOSES ONLY
                    //$formMessage = "Invalid password.";
                    //include('login.php');
                }
            }
            else {
                $formMessage = "Invalid user name or password.";
                include('login.php');

                // FOR TEST PURPOSES ONLY
                //$formMessage = "Invalid user name.";
                //include('login.php');
            }
        }
        else {
            $formMessage = "Could not connect to the " . DB_NAME . " database. " . mysqli_connect_error();
            include('login.php');
        }
    }
    else {
        $formMessage = "Could not connect to the MySQL Server. " . mysqli_connect_error();
        include('login.php');
    }
}

function get_ip_address() {
    //Just get the headers if we can or else use the SERVER global
    if ( function_exists( 'apache_request_headers' ) ) {
        $headers = apache_request_headers();
    }
    else {
        $headers = $_SERVER;
    }

    // Get the forwarded IP if it exists. If the Web Server is running on the same machine as the client the IP address will be 127.0.0.1, same as localhost
    if ( array_key_exists( 'X-Forwarded-For', $headers ) && filter_var( $headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) ) {
        $ip_address = $headers['X-Forwarded-For'];
    }
    elseif ( array_key_exists( 'HTTP_X_FORWARDED_FOR', $headers ) && filter_var( $headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 )) {
        $ip_address = $headers['HTTP_X_FORWARDED_FOR'];
    }
    elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip_address = filter_var( $_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );
    }
    else {
        $ip_address = 'UNKNOWN';
    }

    return $ip_address;
}
?>
