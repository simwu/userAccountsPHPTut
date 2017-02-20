<!DOCTYPE HTML>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="../css/styles.css" />
    <script type="text/javascript" src="../js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>
    <title>Security Edit Account</title>
</head>

<body>
<form id="edit-account-form" action="signupdb.php" method="post">
    <h1 align="center">Edit Account</h1>

    <p id="form-msg" class="msg"><?php print isset($formMessage) ? $formMessage : ''; ?></p>

    <section>
        <h3 align="center">Company</h3>
        <div>
            <label for="company-name">
                <span>Company Name: </span>
                <input type="text" id="company-name" class="required" name="company-name" value="<?php print isset($_SESSION["company_name"]) ? $_SESSION["company_name"] : ''; ?>" title="Required." />
                <abbr title="Required">*</abbr>
            </label>
            <p class="err-msg"></p>
        </div>

        <div>
            <label for="street-address">
                <span>Street Address: </span>
                <input type="text" id="street-address" class="required" name="street-address" value="<?php print isset($_SESSION["street_address"]) ? $_SESSION["street_address"] : ''; ?>" title="Required." />
                <abbr title="Required">*</abbr>
            </label>
            <p class="err-msg"></p>
        </div>

        <div>
            <label for="city">
                <span>City: </span>
                <input type="text" id="city" class="required" name="city" value="<?php print isset($_SESSION["city"]) ? $_SESSION["city"] : ''; ?>" title="Required." />
                <abbr title="Required">*</abbr>
            </label>
            <p class="err-msg"></p>
        </div>

        <div>
            <label for="state">
                <span>State:</span>
                <select id="state" name="state" class="required" title="Required. Select a State abreviation">
                    <option value="select-a-state" selected="selected">Select a State</option>
                    <option value="AL" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'AL') echo 'selected="selected"'; ?> >Alabama</option>
                    <option value="AK" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'AK') echo 'selected="selected"'; ?> >Alaska</option>
                    <option value="AZ" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'AZ') echo 'selected="selected"'; ?> >Arizona</option>
                    <option value="AR" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'AR') echo 'selected="selected"'; ?> >Arkansas</option>
                    <option value="CA" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'CA') echo 'selected="selected"'; ?> >California</option>
                    <option value="CO" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'CO') echo 'selected="selected"'; ?> >Colorado</option>
                    <option value="CT" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'CT') echo 'selected="selected"'; ?> >Connecticut</option>
                    <option value="DE" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'DE') echo 'selected="selected"'; ?> >Delaware</option>
                    <option value="DC" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'DC') echo 'selected="selected"'; ?> >District Of Columbia</option>
                    <option value="FL" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'FL') echo 'selected="selected"'; ?> >Florida</option>
                    <option value="GA" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'GA') echo 'selected="selected"'; ?> >Georgia</option>
                    <option value="HI" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'HI') echo 'selected="selected"'; ?> >Hawaii</option>
                    <option value="ID" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'ID') echo 'selected="selected"'; ?> >Idaho</option>
                    <option value="IL" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'IL') echo 'selected="selected"'; ?> >Illinois</option>
                    <option value="IN" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'IN') echo 'selected="selected"'; ?> >Indiana</option>
                    <option value="IA" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'IA') echo 'selected="selected"'; ?> >Iowa</option>
                    <option value="KS" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'KS') echo 'selected="selected"'; ?> >Kansas</option>
                    <option value="KY" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'KY') echo 'selected="selected"'; ?> >Kentucky</option>
                    <option value="LA" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'LA') echo 'selected="selected"'; ?> >Louisiana</option>
                    <option value="ME" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'ME') echo 'selected="selected"'; ?> >Maine</option>
                    <option value="MD" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'MD') echo 'selected="selected"'; ?> >Maryland</option>
                    <option value="MA" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'MA') echo 'selected="selected"'; ?> >Massachusetts</option>
                    <option value="MI" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'MI') echo 'selected="selected"'; ?> >Michigan</option>
                    <option value="MN" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'MN') echo 'selected="selected"'; ?> >Minnesota</option>
                    <option value="MS" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'MS') echo 'selected="selected"'; ?> >Mississippi</option>
                    <option value="MO" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'MO') echo 'selected="selected"'; ?> >Missouri</option>
                    <option value="MT" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'MT') echo 'selected="selected"'; ?> >Montana</option>
                    <option value="NE" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'NE') echo 'selected="selected"'; ?> >Nebraska</option>
                    <option value="NV" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'NV') echo 'selected="selected"'; ?> >Nevada</option>
                    <option value="NH" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'NH') echo 'selected="selected"'; ?> >New Hampshire</option>
                    <option value="NJ" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'NJ') echo 'selected="selected"'; ?> >New Jersey</option>
                    <option value="NM" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'NM') echo 'selected="selected"'; ?> >New Mexico</option>
                    <option value="NY" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'NY') echo 'selected="selected"'; ?> >New York</option>
                    <option value="NC" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'NC') echo 'selected="selected"'; ?> >North Carolina</option>
                    <option value="ND" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'ND') echo 'selected="selected"'; ?> >North Dakota</option>
                    <option value="OH" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'OH') echo 'selected="selected"'; ?> >Ohio</option>
                    <option value="OK" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'OK') echo 'selected="selected"'; ?> >Oklahoma</option>
                    <option value="OR" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'OR') echo 'selected="selected"'; ?> >Oregon</option>
                    <option value="PA" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'PA') echo 'selected="selected"'; ?> >Pennsylvania</option>
                    <option value="RI" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'RI') echo 'selected="selected"'; ?> >Rhode Island</option>
                    <option value="SC" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'SC') echo 'selected="selected"'; ?> >South Carolina</option>
                    <option value="SD" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'SD') echo 'selected="selected"'; ?> >South Dakota</option>
                    <option value="TN" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'TN') echo 'selected="selected"'; ?> >Tennessee</option>
                    <option value="TX" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'TX') echo 'selected="selected"'; ?> >Texas</option>
                    <option value="UT" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'UT') echo 'selected="selected"'; ?> >Utah</option>
                    <option value="VT" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'VT') echo 'selected="selected"'; ?> >Vermont</option>
                    <option value="VA" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'VA') echo 'selected="selected"'; ?> >Virginia</option>
                    <option value="WA" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'WA') echo 'selected="selected"'; ?> >Washington</option>
                    <option value="WV" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'WV') echo 'selected="selected"'; ?> >West Virginia</option>
                    <option value="WI" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'WI') echo 'selected="selected"'; ?> >Wisconsin</option>
                    <option value="WY" <?php if(isset ($_SESSION["state"]) AND $_SESSION["state"] == 'WY') echo 'selected="selected"'; ?> >Wyoming</option>
                </select>
                <abbr title="Required">*</abbr>
            </label>
            <p class="err-msg"></p>
        </div>

        <div>
            <label for="zipcode">
                <span>Zipcode: </span>
                <input type="text" id="zipcode" class="required" name="zipcode" value="<?php print isset($_SESSION["zipcode"]) ? $_SESSION["zipcode"] : ''; ?>" title="Required." />
                <abbr title="Required">*</abbr>
            </label>
            <p class="err-msg"></p>
        </div>

        <div>
            <label for="office-phone">
                <span>Office Phone: </span>
                <input type="text" id="office-phone" class="required" name="office-phone" placeholder="123 456 7890" value="<?php print isset($_SESSION["office_phone"]) ? $_SESSION["office_phone"] : ''; ?>" title="Required. Please format correctly." />
                <abbr title="Required">*</abbr>
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