<?php
// MySQL Server connection data
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_SERVER', 'localhost:3306');
DEFINE ('DB_NAME', 'security');
DEFINE ('USER_PROFILES_TABLE_NAME', 'user_profiles');
DEFINE ('ACCOUNTS_TABLE_NAME', 'accounts');

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

            // Retrieve validated form data
            // Workaround to bullshit PhpStorm problem ($_POST empty)
            $_POST = array();
            parse_str(file_get_contents('php://input'), $_POST);
            //var_dump($_POST);

            // Account
            $account_enabled        = 1;
            $company_name           = $_POST['company-name'];
            $company_name           = trim($company_name);
            $street_address         = $_POST['street-address'];
            $street_address         = trim($street_address);
            $city                   = $_POST['city'];
            $city                   = trim($city);
            $state                  = $_POST['state'];
            $state                  = trim($state);
            $zipcode                = $_POST['zipcode'];
            $zipcode                = trim($zipcode);
            $office_phone           = $_POST['office-phone'];
            $office_phone           = trim($office_phone);

            // Strip all phone number formating characters
            $office_phone_format    = array('(', ')', '-', ' ', '.');
            $office_phone_strip     = array('', '', '', '', '');
            $office_phone           = str_replace($office_phone_format, $office_phone_strip, $office_phone);

            // Admin User Profile
            $user_profile_enabled   = 1;
            $user_type              = 1;
            $first_name             = $_POST['first-name'];
            $first_name             = trim($first_name);
            $last_name              = $_POST['last-name'];
            $last_name              = trim($last_name);
            $user_name              = $_POST['user-name'];
            $user_name              = trim($user_name);
            $password               = $_POST['password'];
            $password               = trim($password);

            // Generate Salted Password Hash with bcrypt. DB column should be type BLOB(255).
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            // Display the Password Hash
            //print ("New password hash");
            //var_dump($password_hash);

            // Check if the Account exists and reject the new Account
            $sqlSelectQuery = "SELECT * FROM " . DB_NAME . "." . ACCOUNTS_TABLE_NAME . " WHERE company_name = '$company_name' AND office_phone = '$office_phone'";
            //var_dump($sqlSelectQuery);

            $result = mysqli_query($mysql_connection, $sqlSelectQuery);

            if(mysqli_num_rows($result) == 0) {
                // Check if the User Profile exists and reject the new User Profile
                $sqlSelectQuery = "SELECT * FROM " . DB_NAME . "." . USER_PROFILES_TABLE_NAME . " WHERE email = '$user_name'";
                //var_dump($sqlSelectQuery);

                $result = mysqli_query($mysql_connection, $sqlSelectQuery);

                // Or if ($result->num_rows == 0)
                if (mysqli_num_rows($result) == 0) {
                    // Insert the new Account
                    $sqlInsertQuery = "INSERT INTO " . DB_NAME . "." . ACCOUNTS_TABLE_NAME . " (ENABLED, COMPANY_NAME, STREET_ADDRESS, CITY, STATE, ZIPCODE, OFFICE_PHONE) VALUES('$account_enabled', '$company_name', '$street_address', '$city', '$state', '$zipcode', '$office_phone')";
                    //var_dump($sqlInsertQuery);

                    $result = mysqli_query($mysql_connection, $sqlInsertQuery);

                    if ($result) {
                        // Get the new Account ID
                        $account_id = $mysql_connection->insert_id;

                        // Insert the new Admin User Profile
                        $sqlInsertQuery = "INSERT INTO " . DB_NAME . "." . USER_PROFILES_TABLE_NAME . " (ENABLED, ACCOUNT_ID, USER_TYPE_ID, FIRST_NAME, LAST_NAME, EMAIL, PASSWORD) VALUES('$user_profile_enabled', '$account_id', '$user_type', '$first_name', '$last_name', '$user_name', '$password_hash')";
                        //var_dump($sqlInsertQuery);

                        $result = mysqli_query($mysql_connection, $sqlInsertQuery);

                        if ($result) {
                            $formMessage = "Admin user profile created.";
                            include('login.php');
                        }
                        else {
                            $formMessage = "Unable to create the Admin user profile for " . $user_name . ". Please try again later. " . mysqli_connect_error();
                            include('signup.php');
                        }
                    }
                    else {
                        $formMessage = "Unable to create an account for company " . $company_name . ". Please try again later. " . mysqli_connect_error();
                        include('signup.php');
                    }
                }
                else {
                    $formMessage = "A user profile with the user name " . $user_name . " already exists. Enter a different user name.";
                    include('signup.php');
                }
            }
            else {
                $formMessage = "An account for company " . $company_name . " already exists.";
                include('signup.php');
            }
        } else {
            $formMessage = "Could not connect to the " . DB_NAME . " database. " . mysqli_connect_error();
            include('login.php');
        }
    } else {
        $formMessage = "Could not connect to the MySQL Server. " . mysqli_connect_error();
        include('login.php');
    }
}
?>
