<link rel="stylesheet" type="text/css" href="/js/validate.js">

<?php
$createDate = new DateTime();
$formateDate = $createDate->format('H:i:s Y.m.d');

require_once "../dataBase/config.php";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$email = $createDate = "";
$email_err = $createDate_err = "";

if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == "POST") {
    $input_email = trim($_POST["email"]);
    if (empty($input_email)) {
        $email_err = "Please enter a email.";
    } else {
        $email = $input_email;
    }

    $input_createDate = trim($_POST["createDate"]);
    if (empty($input_createDate)) {
        $createDate_err = "Were a date?";
    } else {
        $createDate = $input_createDate;
    }

    $sql = "INSERT INTO pineapple (email, createDate) VALUES (?, ?)";

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "ss", $param_email,
            $param_createDate);

        $param_email = $email;
        $param_createDate = $createDate;


        if (mysqli_stmt_execute($stmt)) {

            header("location: successMessage.php");
            exit();
        } else {
            echo "Something went wrong. Please try again later.";
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
}

?>
<script>
    function validate() {

        let valid = true;
        let valid2 = true;
        valid = checkEmail($("#email"));
        valid2 = termsEmpty($("#terms"));
        $("#button").attr("disabled", true);
        if (valid, valid2) {
            $("#button").attr("disabled", false);
        }
    }

    function termsEmpty(obj) {
        let terms = $(obj).attr("terms");
        $("." + terms + "-validation").html("");
        $(obj).css("border", "");
        if ($(obj).val() == "") {
            $(obj).css("border", "#FF0000 1px solid");
            $("." + terms + "-validation").html("Required");
            return false;
        }
        return true;
    }

    function checkEmpty(obj) {
        let email = $(obj).attr("email");

        $("." + email + "-validation").html("");
        $(obj).css("border", "");
        if ($(obj).val() == "") {
            $(obj).css("border", "#FF0000 1px solid");
            $("." + email + "-validation").html("Required");
            return false;
        }

        return true;
    }

    function checkEmail(obj) {
        let result = true;

        let email = $(obj).attr("name");
        $("." + email + "-validation").html("");
        $(obj).css("border", "");

        result = checkEmpty(obj);

        let input = obj.val();
        let toParse = input.substring(input.indexOf('.') + 1);

        if (!result) {
            $(obj).css("border", "#FF0000 1px solid");
            $("." + email + "-validation").html("Email Required");
            return false;
        }
        if (toParse === 'co') {
            $("." + email + "-validation").html("We are not accepting subscriptions from Colombia emails");
            return false;
        }
        let email_regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,3})+$/;
        result = email_regex.test($(obj).val());
        if (!result) {
            $(obj).css("border", "#FF0000 1px solid");
            $("." + email + "-validation").html("Invalid format");
            return false;
        }

        return result;
    }
</script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div id="sidebar" style="width: 40%">
    <div id="navigation">
        <ul>

            <li id="home"><a href="#"><img src="/images/icons8.png" alt="Home"></a></li>
            <li id="about" style="float: right"><a href="#">About</a></li>
            <li id="hiw" style="float: right"><a href="#">How it works</a></li>
            <li id="contact" style="float: right"><a href="#">Contact</a></li>
        </ul>
    </div>

    <div id="header">
        <h2 id="them">Subscribe to newsletter</h2>
    </div>
    <p id="discount" style="">
        Subscribe to our newsletterand get 10% discount on pineapple glasses.
    </p>
    <div id="subscribe">
        <form class="email" method="post" >
            <div class="input-group"><span class="email-validation validation-error" style="color: red"></span></div>
            <input id="email" type="text" name="email" placeholder="Enter Email" required class="input-control"
                   onblur="validate()">
            <button type="submit" id="button" disabled="disabled">Send</button>
            <br>
            <p><input id="terms" type="checkbox" name="terms" required class="input-control" onblur="validate()"> I
                agree to <u>terms of service</u></p>
            <input id="createDate" name="createDate" value="<?php echo $formateDate; ?>" style="visibility: hidden">
        </form>
    </div>

    <div id="socials">
        <a href="#" class="fa fa-facebook"></a>
        <a href="#" class="fa fa-twitter"></a>
        <a href="#" class="fa fa-instagram"></a>
        <a href="#" class="fa fa-youtube"></a>
    </div>
    <a href="../pages/subscribesList.php">Subrcribers</a>
</div>
