<!DOCTYPE HTML>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="../css/styles.css" />
    <script type="text/javascript" src="../js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>
    <title>Security Edit Profile</title>
</head>
<body>

<form id="edit-profile-form" action="editprofiledb.php" method="post">
    <h1 align="center">Edit Profile</h1>
    <h4 align="center">Please enter current User Name and Password. </h4>
    <p id="form-msg" class="msg"><?php print isset($formMessage) ? $formMessage : ''; ?></p>

    <section>

        <div>
            <label for="current-user-name">
                <span>Current User Name (Email): </span>
                <input type="text" id="current-user-name" class="required" name="current-user-name" value="<?php print isset($current_user_name) ? $current_user_name : ''; ?>" title="Required. Enter a valid email address." />
            </label>
            <p class="err-msg"></p>
        </div>

        <div>
            <label for="current-password">
                <span>Current Password: </span>
                <input type="password" id="current-password" class="required" name="current-password" value="<?php print isset($current_password) ? $current_password : ''; ?>" title="Required." />
            </label>
            <p class="err-msg"></p>
        </div>

        <h4 align="center">Fill in desired changes below and leave the rest blank.</h4>

        <div>
            <label for="first-name">
                <span>First Name: </span>
                <input type="text" id="first-name" class="required" name="first-name" value="<?php print isset($first_name) ? $first_name : ''; ?>" title="Required." />
            </label>
            <p class="err-msg"></p>
        </div>

        <div>
            <label for="last-name">
                <span>Last Name: </span>
                <input type="text" id="last-name" class="required" name="last-name" value="<?php print isset($last_name) ? $last_name : ''; ?>" title="Required." />
            </label>
            <p class="err-msg"></p>
        </div>

        <div>
            <label for="new-user-name">
                <span>New User Name (Email): </span>
                <input type="text" id="new-user-name" class="required" name="new-user-name" value="<?php print isset($new_user_name) ? $new_user_name : ''; ?>" title="Required. Enter a valid email address." />
            </label>
            <p class="err-msg"></p>
        </div>

        <div>
            <label for="new-password">
                <span>New Password: </span>
                <input type="password" id="new-password" class="required" name="new-password" value="<?php print isset($new_password) ? $new_password : ''; ?>" title="Required. 8-16 chars: at least 1 uppercase letter, 1 lowercase letter, 1 digit and 1 special char (!@#$%^&*)" />
            </label>
            <p class="err-msg"></p>
        </div>


        <div>
            <label for="confirm-new-password">
                <span>Confirm Password: </span>
                <input type="password" id="confirm-new-password" class="required" name="confirm-new-password" value="<?php print isset($confirm_new_password) ? $confirm_password : ''; ?>" title="Required." />
            </label>
            <p class="err-msg"></p>
        </div>

    </section>

    <section>
        <div id="submit">
            <button id="submit-button" name="submit">Update</button>
            <button id="reset-button" name="reset">Reset</button>
        </div>
    </section>
</form>
</body>