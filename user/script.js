$('document').ready(function(){
    var username_state = false;
    var email_state = false;
    
    });		
     $('#email').on('blur', function(){
        var email = $('#email').val();
        if (email == '') {
            email_state = false;
            return;
        }
        $.ajax({
         url: 'register.php',
         type: 'post',
         data: {
             'email_check' : 1,
             'email' : email,
         },
         success: function(response){
             if (response == 'taken' ) {
             email_state = false;
             $('#email').parent().removeClass();
             $('#email').parent().addClass("form_error");
             $('#email').siblings("span").text('Sorry... Email already taken');
             }else if (response == 'not_taken') {
               email_state = true;
               $('#email').parent().removeClass();
               $('#email').parent().addClass("form_success");
               $('#email').siblings("span").text('Email available');
             }
         }
        });
    });
   
    $('#reg_btn').on('click', function(){
        var username = $('#username').val();
        var email = $('#email').val();
        var password = $('#password').val();
        if (username_state == false || email_state == false) {
         $('#error_msg').text('Fix the errors in the form first');
       }else{
         // proceed with form submission
         $.ajax({
             url: 'register.php',
             type: 'post',
             data: {
                 'save' : 1,
                 'email' : email,
                 'username' : username,
                 'password' : password,
             },
             success: function(response){
                 alert('user saved');
                 $('#username').val('');
                 $('#email').val('');
                 $('#password').val('');
             }
         });
        }
    });
