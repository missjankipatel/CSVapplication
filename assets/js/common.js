$(document).ready(function() {    
     // edit button action
    $(".openinput").click(function() {
        $(".rowtextbox").hide();
        $(".rowvalue").show();
        $(".saveinput").hide();
        $(".openinput").show();
        var openid = $(this).data('id');
        $("#openinput_" + openid).hide();
        $("#saveinput_" + openid).show();
        $(".showvalue_" + openid).hide();
        $(".inputopen_" + openid).show();
    });    
    // insert button action
    $("#insertform").click(function() {
        $(".listview").hide();
        $("#empform").show();
    });
    // cancel button action
    $("#cancelbtn").click(function() {
        $("#empform").trigger('reset');
        $("label.error").hide();
        $(".listview").show();
        $("#empform").hide();
    });	
    // submit with validation 
    $('body').on('click', '#submitbtn', function() {
        if(validateform())
        {
            // insert using AJAX
            $.ajax({
                url: 'common/ajax.php',
                data: $('#empform').serialize(),
                method: "POST",
                success: function(data) {
                        alert("Successfully added.");
                        location.reload();
                }
            });
        }
    });    
    // update data to csv
    $('body').on('click', '.saveinput', function() {
        var rowid = $(this).data('id');
        var fullname = $("#input_" + rowid + "_0").val();
        var email = $("#input_" + rowid + "_1").val();
        var phone = $("#input_" + rowid + "_2").val();
        var department = $("#input_" + rowid + "_3").val();
        var joiningdate = $("#input_" + rowid + "_4").val();
        if(fullname.trim() == '' || email.trim() == '' || phone.trim() == '' || department.trim() == '' || joiningdate.trim() == '') {
            alert("Please enter all details");
            return false;
        }
        if(email.trim() != ''){
            if(!ValidateEmail(email)){
                alert("Please enter valid email address.");
                return false;
            }
        } 
        if(phone.trim() != '' && isNaN(phone)){
            alert("Please enter valid phone number.");
            return false;
        } 
	// update using AJAX	
        $.ajax({
            url: 'common/ajax.php',
            data: {
                action: "update",
                rowid: rowid,
                fullname: fullname,
                email: email,
                phone: phone,
                department: department,
                joiningdate: joiningdate
            },
            method: "POST",
            success: function(data) {
                alert("Successfully updated.");
                location.reload();
            }
        });
    });
});
// validation of insertform
function validateform(){
    $("label.error").hide();
    var fullname = $("#fullname").val();
    var email = $("#email").val();
    var phone = $("#phone").val();
    var department = $("#department").val();
    var joiningdate = $("#joiningdate").val();
    var checkmyreturn = true;
    if(fullname.trim() == ''){
        $("#fullname-error").show();
        checkmyreturn = false;
    }
    if(email.trim() == ''){
        $("#email-error").show();
        checkmyreturn = false;
    }
    if(email.trim() != ''){
        if(!ValidateEmail(email)){
            $("#email-error").show();
            checkmyreturn = false;
        }
    }    
    if(phone.trim() == ''){
        $("#phone-error").show();
        checkmyreturn = false;
    }
    if(phone.trim() != '' && isNaN(phone)){
        $("#phone-error").show();
        checkmyreturn = false;
    }    
    if(department.trim() == ''){
        $("#department-error").show();
        checkmyreturn = false;
    }
    if(joiningdate.trim() == ''){
        $("#joiningdate-error").show();
        checkmyreturn = false;
    }    
    return checkmyreturn;
}
// validate email address
function ValidateEmail(mail) 
{
 if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(mail))
  {
    return true;
  }  
  return false;
}




