<?php
// MySQL Server connection data
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_SERVER', 'localhost:3306');
DEFINE ('DB_NAME', 'security');
DEFINE ('USER_PROFILES_TABLE_NAME', 'user_profiles');
DEFINE ('LOGIN_TABLE_NAME', 'login');

// Attempt to connect to MySQL Server
$mysql_connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);

// Check connection to MySQL Server
if ($mysql_connection) {
    // Attempt to connect to the MySQL database
    $db_connection = mysqli_select_db($mysql_connection, DB_NAME);

    // Check connection to the MySQL database
    if ($db_connection) {

        session_start();
        $user_profile_id = $_SESSION["user_profile_id"];
        $session_id      = $_SESSION["session_id"];

        // Check if the Login entry exists
        $sqlSelectQuery = "SELECT * FROM " . DB_NAME . "." . LOGIN_TABLE_NAME . " WHERE user_profile_id = '$user_profile_id' AND session_id = '$session_id'";
        //var_dump($sqlSelectQuery);

        $result = mysqli_query($mysql_connection, $sqlSelectQuery);

        if ($result->num_rows > 0) {

            // Delete the Login entry
            $sqlDeleteQuery = "DELETE FROM " . DB_NAME . "." . LOGIN_TABLE_NAME . " WHERE user_profile_id = '$user_profile_id' AND session_id = '$session_id'";
            //var_dump($sqlDeleteQuery);

            $result = mysqli_query($mysql_connection, $sqlDeleteQuery);

            if ($result) {
                // Clean-up the login session
                unset($_SESSION['user_profile_id']);
                unset($_SESSION['session_id']);
                unset($_SESSION["logged_in"]);
                unset($_SESSION["admin_logged_in"]);
                unset($_SESSION["account_id"]);
                session_destroy();

                $formMessage = "Successfully logged off.";
            }
            else {
                $formMessage = "Unable to delete entry from the Login table" . mysqli_connect_error();
            }

            include('home.php');
        }
        else {
            $formMessage = "User not logged in.";
            include('home.php');

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
?>
