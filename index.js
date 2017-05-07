/*for front end */
  document.getElementById('toggleProfile').addEventListener('click', function () {
    [].map.call(document.querySelectorAll('.profile'), function(el) {
      el.classList.toggle('profile--open');
    });
  });
  function getcaptcha()
  {
    $.ajax({
      type: 'post',
      url: 'captcha.php',
      cache:false,
      success: function (response) {
        $('#captcha').attr('src','captcha.php')
      }
    });
  }
  $(document).ready(function(){
    $('#toggleProfile').on('click', function(){
      $('#bg-img').toggleClass('blurfilter');
      $('#toggleProfile').toggleClass('fixtop');
    });
  });
/*front end part ends here */

/*for validation of form fields */
var count = 0;
$(":text, :password").blur(function(){
  var data = {};
  var input = $(this).closest('input');
  var value = $(this).val();
  var key = $(this).attr('name');
  data[key]=value;
  $.ajax({
    type: 'post',
    url: 'validate.php',
    data:data,
    cache:false,
    success: function (response) {
      console.log(response);
     if(response == '1'){
       $(input).css('border-color','#00FF00');
       count= count+1;
     }
     else if(response == '0') {
       console.log('reached here');
       $(input).css('border-color','red');
       if(count == 3){
         count= count-1;
       }
       console.log('reached here too');
     }
     if(count == 3){
       $(".fade").fadeIn("slow","swing");
     }
     else if(count < 3){
       $(".fade").fadeOut("fast","swing");
     }
    }
  });
});
/* end of validating user input */
