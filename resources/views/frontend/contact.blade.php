<section class="title-section text-left text-sm-center revealator-slideup revealator-once revealator-delay1">
  <h1>get in <span>touch</span></h1>
  <span class="title-bg">contact</span>
</section>
<section class="main-content revealator-slideup revealator-once revealator-delay1">
  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-4">
        <h3 class="text-uppercase custom-title mb-0 ft-wt-600 pb-3">Don't be shy !</h3>
        <p class="open-sans-font mb-3">Feel free to get in touch with me. I am always open to discussing new projects, creative ideas or opportunities to be part of your visions.</p>
        <p class="open-sans-font custom-span-contact position-relative">
          <i class="fa fa-envelope-open position-absolute"></i>
          <span class="d-block">mail me</span><a href="mailto:{{!empty($company['email'])?$company['email']:''}}" style="text-decoration:none;color:white">{{!empty($company['email'])?$company['email']:''}}</a>
        </p>
        <p class="open-sans-font custom-span-contact position-relative">
          <i class="fa fa-phone-square position-absolute"></i>
          <span class="d-block">call me</span>{{!empty($company['mobile_number'])?'+91 '.$company['mobile_number']:''}}
        </p>
        <ul class="social list-unstyled pt-1 mb-5">
          <li class="facebook"><a title="Facebook" href="{{!empty($company['facebook_link'])?$company['facebook_link']:''}}"><i class="fa fa-facebook"></i></a>
          </li>
          <li class="twitter"><a title="Twitter" href="{{!empty($company['twitter_link'])?$company['twitter_link']:''}}"><i class="fa fa-twitter"></i></a>
          </li>
          <li class="youtube"><a title="Youtube" href="{{!empty($company['linkedin_link'])?$company['linkedin_link']:''}}"><i class="fa fa-linkedin"></i></a>
          </li>
        </ul>
      </div>
      <div class="col-12 col-lg-8">
        <form id="contactForm">
          <?php $captua_token = random_alphanumeric_string(6); ?>
          <input type="hidden" id="csrf" class="csrf" name="csrf_token" value="<?= $captua_token ?>">
          <div class="contactform">
            <div class="row">
              <div class="col-lg-4 col-md-4 col-sm-4">
                <input type="text" name="name" class="restrictedInput ucwords" id="your_name" autocomplete="off" placeholder="YOUR NAME">
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4">
                <input type="email" name="email" class="emailInput" id="your_email" autocomplete="off" placeholder="YOUR EMAIL">
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4">
                <input type="text" name="subject" class="restrictedInput ucwords" id="your_subject" autocomplete="off" placeholder="YOUR SUBJECT">
              </div>
              <div class="col-12">
                <textarea name="message" id="your_message" autocomplete="off" placeholder="YOUR MESSAGE"></textarea>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row gy-3">
                  <div class="col-5 row">
                    <div class=" col-10">
                      <div class="bgreprat">
                        <?= $captua_token; ?> 
                      </div>
                    </div>
                    <div class="col-2 pb-1 px-1">
                      <span class="bgreprat-refesh ps-0" style="cursor:pointer;" onclick="getRandomCaptcha()"><img
                        src="{{asset('refresh.png')}}" class="w-100"></span>
                    </div>
                  </div>
                  <div class="col-5">
                    <input type="text" name="match_captcha" maxlength="6" class="form-control" id="match_captcha"
                      autocomplete="off" placeholder="Enter Captcha" />
                  </div>
                </div>
              </div>
              <div class="col-12">
                <button type="button" id="submit" class="button" onclick="return validateContact()">
                <span class="button-text">Send Message</span>
                <span class="button-icon fa fa-send"></span>
                </button>
              </div>
              <div class="col-12 form-message">
                <span class="output_message text-center font-weight-600 text-uppercase"></span>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<script>
  function validateContact(){
    var your_name = $('#your_name').val().trim();
    var your_email = $('#your_email').val();
    var your_subject = $('#your_subject').val().trim();
    var your_message = $('#your_message').val().trim();
    var csrf = $('#csrf').val().trim();
    var entered_captcha = $('#match_captcha').val().trim();
  
  
    if (your_name === "") {
        toastr.error("Enter Your Full Name");
        return false;
    } else if (your_email === "") {
        toastr.error("Enter Your Email");
        return false;
    } else if (your_subject === "") {
        toastr.error("Enter Subject");
        return false;
    } else if (your_message === "") {
        toastr.error("Enter Your Detailed Message");
        return false;
    } else if (entered_captcha === "") {
        toastr.error("Enter Captcha");
        return false;
    } else if (entered_captcha !== csrf) {
        toastr.error("Invalid Captcha");
        return false;
    } else {
          
                $.ajax({
                    url: '{{ url('save-query') }}', // Replace this with the actual backend endpoint URL
                    type: 'POST',
                    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
                    data: {
                        'name': your_name,
                        'email': your_email,
                        'subject': your_subject,
                        'message': your_message,
                        'entered_captcha': entered_captcha,
                        'csrf': csrf,
                        
                    },
                    cache: false,
                    dataType: "json",
                    beforeSend: function () {
                        $('#submit').text('Please Wait...');
                        $('#submit').prop("disabled", true);
                    },
                    success: function (response) {
                        if (response.status === false) {
                            toastr.error(response.message);
                            $('#submit').text('Submit');
                            $('#submit').prop("disabled", false);
                            $('#match_captcha').val('');
                            getRandomCaptcha();
                        } else if (response.status === true) {
                            toastr.success(response.message);
                            $("#contactForm")[0].reset();
                            getRandomCaptcha();
                            $('#submit').text('Submit');
                            $('#submit').prop("disabled", false);
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle error if necessary
                        console.error(xhr, status, error);
  
                        Swal.fire("Error occurred. Please try again.");
                        $('#submit').text('Submit');
                            $('#submit').prop("disabled", false); // Show a generic error message
                    }
                });
            
        
    }
  }
</script>