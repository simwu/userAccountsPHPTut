<?php
// MySQL Server connection data
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_SERVER', 'localhost:3306');
DEFINE ('DB_NAME', 'security');
DEFINE ('USER_PROFILES_TABLE_NAME', 'user_profiles');
DEFINE ('ACCOUNTS_TABLE_NAME', 'accounts');

session_start();

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

            $account_id = $_SESSION["account_id"];

            // Check if the User Profile exists and reject the Edit Profile request if it does not
            $sqlSelectQuery = "SELECT * FROM " . DB_NAME . "." . ACCOUNTS_TABLE_NAME . " WHERE email = '$account_id'";
            //var_dump($sqlSelectQuery);

            $result = mysqli_query($mysql_connection, $sqlSelectQuery);

            // Or if ($result->num_rows > 0)
            if(mysqli_num_rows($result) > 0) {
                $column_names = " SET ";

                // Check for Company Name change
                $company_name = $_POST['company-name'];
                $company_name = trim($company_name);

                if (strlen($company_name) > 0) {
                    $column_names = $column_names . "COMPANY_NAME = '$company_name', ";
                }

                // Check for Street Address change
                $street_address  = $_POST['street-address'];
                $street_address  = trim($street_address);

                if (strlen($street_address) > 0) {
                    $column_names = $column_names . "STREET_ADDRESS = '$street_address', ";
                }

                // Check for City change
                $city = $_POST['city'];
                $city = trim($city);

                if (strlen($city) > 0) {
                    $column_names = $column_names . "CITY = '$city', ";
                }

                // Check for State change
                $state = $_POST['state'];
                $state = trim($state);

                if (strlen($state) > 0) {
                    $column_names = $column_names . "STATE = '$state', ";
                }

                // Check for Zipcode change
                $zipcode = $_POST['zipcode'];
                $zipcode = trim($zipcode);

                if (strlen($zipcode) > 0) {
                    $column_names = $column_names . "ZIPCODE = '$zipcode', ";
                }

                // Check for Office Phone change

                $office_phone           = $_POST['office-phone'];
                $office_phone           = trim($office_phone);

                // Strip all phone number formating characters
                $office_phone_format    = array('(', ')', '-', ' ', '.');
                $office_phone_strip     = array('', '', '', '', '');
                $office_phone           = str_replace($office_phone_format, $office_phone_strip, $office_phone);

                if (strlen($office_phone) > 0) {
                    $column_names = $column_names . "OFFICE_PHONE = '$office_phone', ";
                }

                // Update the Account
                // Remove last comma space from column names
                $column_names = substr($column_names, 0, strlen($column_names) - 2);

                $sqlUpdateQuery = "UPDATE " . DB_NAME . "." . ACCOUNTS_TABLE_NAME . $column_names . " WHERE EMAIL = '$account_id'";
                //var_dump($sqlUpdateQuery);

                // Check connection to MySQL Server
                if ($mysql_connection) {
                    if ($mysql_connection->query($sqlUpdateQuery) === TRUE) {
                        $formMessage = "Account updated successfully";
                    }
                    else {
                        $formMessage = "Error updating account: " . $mysql_connection->error;
                    }
                }
                else {
                    $formMessage = "Could not connect to the MySQL Server. " . mysqli_connect_error();
                }
                include('home.php');
            }
            else {
                $formMessage = "Unable to find Account for company " . $company_name . ". " . mysqli_connect_error();
                include('home.php');
            }
        }
        else {
            $formMessage = "Could not connect to the " . DB_NAME . " database. " . mysqli_connect_error();
            include('home.php');
        }
    }
    else {
        $formMessage = "Could not connect to the MySQL Server. " . mysqli_connect_error();
        include('home.php');
    }
}
else {

    // Attempt to connect to MySQL Server
    $mysql_connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);

    // Check connection to MySQL Server
    if ($mysql_connection) {
        // Attempt to connect to the MySQL database
        $db_connection = mysqli_select_db($mysql_connection, DB_NAME);

        // Check connection to the MySQL database
        if ($db_connection) {

            $account_id = $_SESSION["account_id"];

            // Check if the User Profile exists and reject the Edit Profile request if it does not
            $sqlSelectQuery = "SELECT * FROM " . DB_NAME . "." . ACCOUNTS_TABLE_NAME . " WHERE ACCOUNT_ID = '$account_id'";
            // var_dump($sqlSelectQuery);

            $result = mysqli_query($mysql_connection, $sqlSelectQuery);

            // Or if ($result->num_rows > 0)
            if(mysqli_num_rows($result) > 0) {

                $row = $result->fetch_row();

                $_SESSION["company_name"]   = $row[2];
                $_SESSION["street_address"] = $row[3];
                $_SESSION["city"]           = $row[4];
                $_SESSION["state"]          = $row[5];
                $_SESSION["zipcode"]        = $row[6];
                $_SESSION["office_phone"]   = $row[7];

                include('editaccount.php');
            }
            else {
                $formMessage = "Unable to find Account with that company. " . mysqli_connect_error();
                include('home.php');
            }
        }
        else {
            $formMessage = "Could not connect to the " . DB_NAME . " database. " . mysqli_connect_error();
            include('home.php');
        }
    }
    else {
        $formMessage = "Could not connect to the MySQL Server. " . mysqli_connect_error();
        include('home.php');
    }
}
?>