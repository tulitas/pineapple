<?php
 $emailErr = $termsErr = "";
 $email = $terms  = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty($_POST["email"])) {
        $emailErr = "Email required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Wrong email format ";
        }
    }



    if (empty($_POST["terms"])) {
        $termsErr = "Terms required";
    } else {
        $terms = test_input($_POST["terms"]);
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<div id="sidebar" style="width: 40%">
    <div id="navigation">
        <ul>

            <li id="home"><a href="#"><img src="/pictures/pinIcon.png" alt="Home"></a></li>
            <li id="about" style="float: right"><a href="#">About</a></li>
            <li id="hiw" style="float: right"><a href="#">How it works</a></li>
            <li id="contact" style="float: right"><a href="#">Contact</a></li>
        </ul>
    </div>

        <div id="header">
            <h2 id="them">Subscribe to newsletter</h2>
        </div>
        <p id="discount" style="text-align: left">
            Subscribe to our newsletterand get 10% discount on pineapple glasses.
        </p>


    <div id="subscribe">
        <form class="email" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input id="etext" type="text" name="email" placeholder="Enter Email" required>

            <button type="submit">Send</button><br>
            <span class="error" style="color: red"> <?php echo $emailErr;?></span>
            <p><input id="terms" type="checkbox" name="terms"> I agree to <u>terms of service</u></p>
            <span class="error" style="color: red"> <?php echo $termsErr;?></span>
        </form>

    </div>

<div id="socials">
    <a href="#" class="fa fa-facebook"></a>
    <a href="#" class="fa fa-twitter"></a>
    <a href="#" class="fa fa-instagram"></a>
    <a href="#" class="fa fa-youtube"></a>
</div>

</div>