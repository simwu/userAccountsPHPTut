<!DOCTYPE HTML>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="../css/styles.css" />
    <title>Security Login</title>
</head>
<body>

    <form id="login-form" action="logindb.php" method="post">
        <h1 align="center">Login</h1>

        <p id="form-msg" class="msg"><?php print isset($formMessage) ? $formMessage : ''; ?></p>

        <section>
            <div>
                <label for="user-name">
                    <span>User Name: </span>
                    <input type="text" id="user-name" class="required" name="user-name" value="<?php print isset($user_name) ? $user_name : ''; ?>" title="Required. Enter a valid Email." />
                </label>
                <p class="err-msg"></p>
            </div>

            <div>
                <label for="password">
                <span>Password: </span>
                    <input type="password" id="password" class="required" name="password" value="<?php print isset($password) ? $password : ''; ?>" title="Required. 8-16 chars: at least 1 uppercase letter, 1 lowercase letter, 1 digit and 1 special char" />
                </label>
                <p class="err-msg"></p>
            </div>
        </section>

        <section>
            <div id="submit">
                <button id="submit-button" name="submit">Login</button>
                <button id="reset-button" name="reset">Reset</button>
            </div>
        </section>
    </form>
</body>