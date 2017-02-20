<!DOCTYPE HTML>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="../css/styles.css" />
    <script type="text/javascript" src="../js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>
    <title>Security Sign Up</title>
</head>

<body>
    <form id="signup-form" action="signupdb.php" method="post">
        <h1 align="center">Sign Up</h1>

        <p id="form-msg" class="msg"><?php print isset($formMessage) ? $formMessage : ''; ?></p>

        <section>
            <h3 align="center">Company</h3>
            <div>
                <label for="company-name">
                    <span>Company Name: </span>
                    <input type="text" id="company-name" class="required" name="company-name" value="<?php print isset($company_name) ? $company_name : ''; ?>" title="Required." />
                    <abbr title="Required">*</abbr>
                </label>
                <p class="err-msg"></p>
            </div>

            <div>
                <label for="street-address">
                    <span>Street Address: </span>
                    <input type="text" id="street-address" class="required" name="street-address" value="<?php print isset($street_address) ? $street_address : ''; ?>" title="Required." />
                    <abbr title="Required">*</abbr>
                </label>
                <p class="err-msg"></p>
            </div>

            <div>
                <label for="city">
                    <span>City: </span>
                    <input type="text" id="city" class="required" name="city" value="<?php print isset($city) ? $city : ''; ?>" title="Required." />
                    <abbr title="Required">*</abbr>
                </label>
                <p class="err-msg"></p>
            </div>

            <div>
                <label for="state">
                    <span>State:</span>
                    <select id="state" name="state" class="required" title="Required. Select a State abreviation">
                        <option value="select-a-state" selected="selected">Select a State</option>
                        <option value="AL">Alabama</option>
                        <option value="AK">Alaska</option>
                        <option value="AZ">Arizona</option>
                        <option value="AR">Arkansas</option>
                        <option value="CA">California</option>
                        <option value="CO">Colorado</option>
                        <option value="CT">Connecticut</option>
                        <option value="DE">Delaware</option>
                        <option value="DC">District Of Columbia</option>
                        <option value="FL">Florida</option>
                        <option value="GA">Georgia</option>
                        <option value="HI">Hawaii</option>
                        <option value="ID">Idaho</option>
                        <option value="IL">Illinois</option>
                        <option value="IN">Indiana</option>
                        <option value="IA">Iowa</option>
                        <option value="KS">Kansas</option>
                        <option value="KY">Kentucky</option>
                        <option value="LA">Louisiana</option>
                        <option value="ME">Maine</option>
                        <option value="MD">Maryland</option>
                        <option value="MA">Massachusetts</option>
                        <option value="MI">Michigan</option>
                        <option value="MN">Minnesota</option>
                        <option value="MS">Mississippi</option>
                        <option value="MO">Missouri</option>
                        <option value="MT">Montana</option>
                        <option value="NE">Nebraska</option>
                        <option value="NV">Nevada</option>
                        <option value="NH">New Hampshire</option>
                        <option value="NJ">New Jersey</option>
                        <option value="NM">New Mexico</option>
                        <option value="NY">New York</option>
                        <option value="NC">North Carolina</option>
                        <option value="ND">North Dakota</option>
                        <option value="OH">Ohio</option>
                        <option value="OK">Oklahoma</option>
                        <option value="OR">Oregon</option>
                        <option value="PA">Pennsylvania</option>
                        <option value="RI">Rhode Island</option>
                        <option value="SC">South Carolina</option>
                        <option value="SD">South Dakota</option>
                        <option value="TN">Tennessee</option>
                        <option value="TX">Texas</option>
                        <option value="UT">Utah</option>
                        <option value="VT">Vermont</option>
                        <option value="VA">Virginia</option>
                        <option value="WA">Washington</option>
                        <option value="WV">West Virginia</option>
                        <option value="WI">Wisconsin</option>
                        <option value="WY">Wyoming</option>
                    </select>
                    <abbr title="Required">*</abbr>
                </label>
                <p class="err-msg"></p>
            </div>

            <div>
                <label for="zipcode">
                    <span>Zipcode: </span>
                    <input type="text" id="zipcode" class="required" name="zipcode" value="<?php print isset($zipcode) ? $zipcode : ''; ?>" title="Required." />
                    <abbr title="Required">*</abbr>
                </label>
                <p class="err-msg"></p>
            </div>

            <div>
                <label for="office-phone">
                    <span>Office Phone: </span>
                    <input type="text" id="office-phone" class="required" name="office-phone" placeholder="123 456 7890" title="Required. Please format correctly." />
                    <abbr title="Required">*</abbr>
                </label>
                <p class="err-msg"></p>
            </div>

            <h3 align="center">Administrator</h3>
            <div>
                <label for="first-name">
                    <span>First Name: </span>
                    <input type="text" id="first-name" class="required" name="first-name" value="<?php print isset($first_name) ? $first_name : ''; ?>" title="Required." />
                    <abbr title="Required">*</abbr>
                </label>
                <p class="err-msg"></p>
            </div>

            <div>
                <label for="last-name">
                    <span>Last Name: </span>
                    <input type="text" id="last-name" class="required" name="last-name" value="<?php print isset($last_name) ? $last_name : ''; ?>" title="Required." />
                    <abbr title="Required">*</abbr>
                </label>
                <p class="err-msg"></p>
            </div>

            <div>
                <label for="user-name">
                    <span>User Name (Email): </span>
                    <input type="text" id="user-name" class="required" name="user-name" value="<?php print isset($user_name) ? $user_name : ''; ?>" title="Required. Enter a valid email address." />
                    <abbr title="Required">*</abbr>
                </label>
                <p class="err-msg"></p>
            </div>

            <div>
                <label for="password">
                    <span>Password: </span>
                    <input type="password" id="password" class="required" name="password" value="<?php print isset($password) ? $password : ''; ?>" title="Required. 8-16 chars: at least 1 uppercase letter, 1 lowercase letter, 1 digit and 1 special char (!@#$%^&*)" />
                    <abbr title="Required">*</abbr>
                </label>
                <p class="err-msg"></p>
            </div>
        </section>

        <section>
            <div id="submit">
                <button id="submit-button" name="submit">Sign Up</button>
                <button id="reset-button" name="reset">Reset</button>
            </div>
        </section>
    </form>
</body>