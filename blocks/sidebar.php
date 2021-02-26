<?php
//$emailErr = $termsErr = "";
//$email = $terms = "";
//
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
//
//    if ($emailErr || $termsErr == true) {
//
//    }
//
//    if (empty($_POST["email"])) {
//        $emailErr = "Email required";
//    } else {
//        $email = test_input($_POST["email"]);
//        if (substr($email, -3) === '.co') {
//            $emailErr = "We are not accepting subscriptions from Colombia emails”.";
//        }
//        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//            $emailErr = "Wrong email format ";
//        }
//
//    }
//
//
//    if (empty($_POST["terms"])) {
//        $termsErr = "Terms required";
//    } else {
//        $terms = test_input($_POST["terms"]);
//    }
//}
//
//function test_input($data)
//{
//    $data = trim($data);
//    $data = stripslashes($data);
//    $data = htmlspecialchars($data);
//    return $data;
//}
//
//?>
<script>
    function validate() {

        let valid = true;
        valid = checkEmail($("#email"));
        valid = termsEmpty($("#terms"));
        $("#button").attr("disabled",true);
        if(valid) {
            $("#button").attr("disabled",false);
        }
    }

    function termsEmpty(obj) {
        let terms =$(obj).attr("terms");
        $("."+terms+"-validation").html("");
        $(obj).css("border","");
        if($(obj).val() == "") {
            $(obj).css("border","#FF0000 1px solid");
            $("."+terms+"-validation").html("Required");
            return false;
        }
        return true;
    }
    function checkEmpty(obj) {
        let email = $(obj).attr("email");

        $("."+email+"-validation").html("");
        $(obj).css("border","");
        if($(obj).val() == "") {
            $(obj).css("border","#FF0000 1px solid");
            $("."+email+"-validation").html("Required");
            return false;
        }

        return true;
    }
    function checkEmail(obj) {
        let result = true;

        let email = $(obj).attr("name");
        $("."+email+"-validation").html("");
        $(obj).css("border","");

        result = checkEmpty(obj);

        let input = obj.val();
        let toParse = input.substring(input.indexOf('.') + 1);
        let dollaz = parseFloat(toParse);

        if(!result) {
            $(obj).css("border","#FF0000 1px solid");
            $("."+email+"-validation").html("Email Required");
            return false;
        }
        if (toParse === 'co') {
            $("."+email+"-validation").html("We are not accepting subscriptions from Colombia emails");
            return false;
        }
        let email_regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,3})+$/;
        result = email_regex.test($(obj).val());
        if(!result) {
            $(obj).css("border","#FF0000 1px solid");
            $("."+email+"-validation").html("Invalid format");
            return false;
        }

        return result;
    }
</script>
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
        <form class="email" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="input-group"> <span class="email-validation validation-error" style="color: red"></span></div>
            <input id="email" type="text" name="email" placeholder="Enter Email" required class="input-control" onblur="validate()">

            <button type="submit" id="button" disabled="disabled">Send</button>
            <br>
            <p><input id="terms" type="checkbox" name="terms" required class="input-control" onblur="validate()"> I agree to <u>terms of service</u></p>
        </form>
    </div>

    <div id="socials">
        <a href="#" class="fa fa-facebook"></a>
        <a href="#" class="fa fa-twitter"></a>
        <a href="#" class="fa fa-instagram"></a>
        <a href="#" class="fa fa-youtube"></a>
    </div>

</div>