jQuery(function($) {
    $("form input[id='check_all']").click(function() {

        var inputs = $("form input[type='checkbox']");

        for(var i = 0; i < inputs.length; i++) {
            var type = inputs[i].getAttribute("type");
            if(type == "checkbox") {
                if(this.checked) {
                    inputs[i].checked = true;
                } else {
                    inputs[i].checked = false;
                }
            }
        }
    });

    $("form input[id='submit']").click(function() {

        var count_checked = $("[name='data[]']:checked").length;
        if(count_checked == 0) {
            alert("Please select a subscribers(s) to export.");
            return false;
        }

    });
}); // jquery end