$(document).ready(function(){
    $('.free__btn').click(function(){
        $('.darkSide').removeClass('hidden');
        $('.mailModal').removeClass('hidden');
    });

    $('.mailModal__close').click(function(){
        $('.darkSide').addClass('hidden');
        $('.mailModal').addClass('hidden');
    });

    $('#form').submit(function(e){
        e.preventDefault();
        let email = $('.mailModal__field').val();
       $.ajax({
          url: "/helpers/lib/PHPMailer/examples/gmail.php",
          type: "POST",
          // dataType: "html",
          data: {mail: email},
          success: function (responce) {
              if($('.result__form').hasClass('error'))
                $('.result__form').removeClass('error');
              $('.result__form').addClass('success');
              $('.result__form').text('Request sent. Your login information will be sent to you, within 15 mins. Please, check your spam folder.');

                // result = $.parseJSON(responce);
                // $('#result__form').html('Mail: ' + result.mail_modal + "отправлен");
          },
           error: function (responce) {
               if($('.result__form').hasClass('success'))
                $('.result__form').removeClass('success');
               $('.result__form').addClass('error');
               $('.result__form').text('Error. Try again later.');
               // $('#result__form').html('Ошибка при  отправке формы. Попробуйте позже');
           }
       });
    });
});