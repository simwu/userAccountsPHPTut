<!DOCTYPE HTML>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../css/styles.css" />
    <script type="text/javascript" src="../js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <title>Security Home Page</title>
</head>
<body>
<header>
    <!-- Bootstrap Navigation Bar -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- The Navitation Bar -->
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                </button>

                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>

                <a class="navbar-brand" href="#">
                    <img class="navbar-brand" id="header-image" src="../img/help.png" alt="Logo" >
                </a>
            </div>

            <!--The Navigation Bar widgets -->
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                    <li>
                        <button id="home-btn" class="btn btn-default navbar-btn" type="button">
                            <a class="link" href="#" >Home</a>
                        </button>
                    </li>x

                    <?php
                        if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] === false) {
                            print "<li>";
                            print "<button id='login-btn' class='btn btn-default navbar-btn' type='button'>";
                            print "<a class='link' href='login.php'>Login</a>";
                            print "</button>";
                            print "</li>";
                        }
                        else {
                            print "<li>";
                            print "<button id='logoff-btn' class='btn btn-default navbar-btn' type='button'>";
                            print "<a class='link' href='logoffdb.php'>Logoff</a>";
                            print "</button>";
                            print "</li>";

                            print "<li>";
                            print "<button id='edit-btn' class='btn btn-default navbar-btn' type='button'>";
                            print "<a class='link' href='editprofile.php'>Edit Profile</a>";
                            print "</button>";
                            print "</li>";
                        }

                        if (isset($_SESSION["admin_logged_in"]) && $_SESSION["admin_logged_in"] === true) {
                            print "<li>";
                            print "<button id='account-btn' class='btn btn-default navbar-btn' type='button'>";
                            print "<a class='link' href='editaccountdb.php'>Account</a>";
                            print "</button>";
                            print "</li>";

                            print "<li>";
                            print "<button id='create-btn' class='btn btn-default navbar-btn' type='button'>";
                            print "<a class='link' href='#'>Create User Profile</a>";
                            print "</button>";
                            print "</li>";

                            print "<li>";
                            print "<button id='editu-btn' class='btn btn-default navbar-btn' type='button'>";
                            print "<a class='link' href='#'>Edit User Profile</a>";
                            print "</button>";
                            print "</li>";
                        }
                        else {
                            print "<li>";
                            print "<button id='signup-btn' class='btn btn-default navbar-btn' type='button'>";
                            print "<a class='link' href='signup.php'>Sign Up</a>";
                            print "</button>";
                            print "</li>";
                        }
                    ?>
                </ul>

                <!-- Search Bar -->
                <form class="navbar-form navbar-right" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>

                    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                </form>
            </div>
        </div>
    </nav>
    <p id="form-msg" class="msg"><?php print isset($formMessage) ? $formMessage : ''; ?></p>
</header>
</body>