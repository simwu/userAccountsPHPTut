<?php
// MySQL Server connection data
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_SERVER', 'localhost:3306');
DEFINE ('DB_NAME', 'security');
DEFINE ('USER_PROFILES_TABLE_NAME', 'user_profiles');

$update = true;

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

            $current_user_name  = $_POST['current-user-name'];
            $current_user_name  = trim($current_user_name);
            $current_password   = $_POST['current-password'];
            $current_password   = trim($current_password);

            // Check if the User Profile exists and reject the Edit Profile request if it does not
            $sqlSelectQuery = "SELECT * FROM " . DB_NAME . "." . USER_PROFILES_TABLE_NAME . " WHERE email = '$current_user_name'";
            //var_dump($sqlSelectQuery);

            $result = mysqli_query($mysql_connection, $sqlSelectQuery);

            // Or if ($result->num_rows > 0)
            if(mysqli_num_rows($result) > 0) {
                // Retrieve the User Profile
                $row = $result->fetch_row();
                // Retrieve the User Profile ID
                //$user_profile_id = $row[0];
                // Retrieve the stored password hash
                $stored_password_hash = $row[7];

                // Verify the password
                if (password_verify($current_password, $stored_password_hash)) {
                    $column_names = " SET ";

                    // Check for First Name change
                    $first_name  = $_POST['first-name'];
                    $first_name  = trim($first_name);

                    if (strlen($first_name) > 0) {
                        $column_names = $column_names . "FIRST_NAME = '$first_name', ";
                    }

                    // Check for Last Name change
                    $last_name  = $_POST['last-name'];
                    $last_name  = trim($last_name);

                    if (strlen($last_name) > 0) {
                        $column_names = $column_names . "LAST_NAME = '$last_name', ";
                    }

                    // Check for User Name change
                    $new_user_name  = $_POST['new-user-name'];
                    $new_user_name  = trim($new_user_name);

                    if (strlen($new_user_name) > 0) {
                        // Check if the User Profile exists and reject the User Name change
                        $sqlSelectQuery = "SELECT * FROM " . DB_NAME . "." . USER_PROFILES_TABLE_NAME . " WHERE email = '$new_user_name'";
                        //var_dump($sqlSelectQuery);

                        $result = mysqli_query($mysql_connection, $sqlSelectQuery);

                        // Or if ($result->num_rows == 0)
                        if(mysqli_num_rows($result) == 0) {

                            $column_names = $column_names . "EMAIL = '$new_user_name', ";
                        }
                        else {
                            $formMessage = "An account with the new user name " . $new_user_name . " already exists.";
                            //include('home.php');
                            $update = false;
                        }
                    }

                    // Check for Password change
                    $new_password           = $_POST['new-password'];
                    $new_password           = trim($new_password);
                    $confirm_new_password   = $_POST['confirm-new-password'];
                    $confirm_new_password   = trim($confirm_new_password);

                    if (strlen($new_password) > 0) {
                        if ($new_password == $confirm_new_password) {
                            // Generate Salted Password Hash with bcrypt. DB column should be type BLOB(255).
                            $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                            $column_names = $column_names . "PASSWORD = '$password_hash', ";
                        }
                        else {
                            $formMessage = "The new passwords do not match.";
                            $update = false;
                        }
                    }

                    // Update the User Profile
                    if ($update) {
                        // Remove last comma space from column names
                        $column_names = substr($column_names, 0, strlen($column_names) - 2);

                        $sqlUpdateQuery = "UPDATE " . DB_NAME . "." . USER_PROFILES_TABLE_NAME . $column_names . " WHERE EMAIL = '$current_user_name'";
                        //var_dump($sqlUpdateQuery);

                        // Check connection to MySQL Server
                        if ($mysql_connection) {
                            if ($mysql_connection->query($sqlUpdateQuery) === TRUE) {
                                $formMessage = "User profile updated successfully";
                            }
                            else {
                                $formMessage = "Error updating user profile: " . $mysql_connection->error;
                            }
                        }
                        else {
                            $formMessage = "Could not connect to the MySQL Server. " . mysqli_connect_error();
                        }

                        include('home.php');
                    }
                    else {
                        include('editprofile.php');
                    }
                }
                else {
                    $formMessage = "Invalid user name or password.";
                    include('editprofile.php');
                }
            }
            else {
                $formMessage = "Invalid user name or password.";
                include('editprofile.php');
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
