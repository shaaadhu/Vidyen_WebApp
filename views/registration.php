
<style>
    .error{
      color: red;
    }
</style>
<style type="text/css">
    .spinner {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 120px;
      height: 120px;
      margin-top: -20px;
      margin-left: -20px;
      border-radius: 50%;
      border: 10px solid #ffff;
      border-top: 10px solid #1d2d77;
      border-right: 10px solid #ffff;
      border-bottom: 10px solid #1d2d77;
      animation: spin 2s linear infinite;
      z-index: 9999;
      -webkit-animation: spin 2s linear infinite;
      display: none;

    }

    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }
      100% {
        transform: rotate(360deg);
      }

    }

  </style> 
  <div class="spinner" id="spinner">
      
  </div>
<section id="registration-div" class="register-form mt-3" >
    <div class="container-fluid" >
        <div class="row">
            <div class="col-md-1 "></div>
            <div class="col-md-10">
                <!-- <div class="text-dark mt-5 ad text-center" style="font-weight:400;font-size: 29px; line-height: 20px;"><b>Register<span class="text-primary"> Now </span></b></div> -->
                <div class="text-dark mt-5 ad text-center" style="color:white;font-weight: 700;font-size: 45px; line-height: 55px;letter-spacing:1px;"><b>Register<span class="text-primary"> Now </span></b>
                </div>
                <div class="text-center">
                    <p>Please fill in the form below.</p>
                </div>

            </div>
        </div>
    </div>
</section>
<div class="container" >

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">

        <?php echo Recaptcha::getScript(); ?>
        <?php echo Recaptcha::renderScript('registration_form', 'registration_vidyen_form'); ?>

            <form id="registration_vidyen_form" method="POST">
                <?php echo Csrf::field(); ?>
                <div class="cards p-3">
                    <div role="tabpanel" class="tab-pane" id="dinfo">
                        <div class="row mt-3">
                            <div class=" col-md-2 mb-4">
                                <label for="title"><b>Name Prefix</b></label>
                                <select id="title" name="title1" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="Dr.">Dr.</option>
                                    <option value="Prof.">Prof.</option>
                                    <option value="Mr.">Mr.</option>
                                    <option value="Mrs.">Ms.</option>
                                    <option value="Miss.">Mrs.</option>
                                </select>
                            </div>
                            <div class=" col-md-10 mb-4">
                                <label for="full_name"><b>Full Name</b></label>
                                <input type="text" name="full_name" class="form-control" id="full_name" placeholder="Enter Your Full Name" required>
                            </div>
                            <div class=" col-md-6 mb-4">
                                <label for="age"><b>Age</b></label>
                                <input type="number" class="form-control" id="age" placeholder="Age" value="" name="age" required>
                            </div>
                            <div class=" col-md-6 mb-4">
                                <label for="gender"><b>Gender</b></label>
                                <select id="gender" name="gender" class="form-control" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class=" col-md-6 mb-4">
                                <label for="delegate_type"><b>Type of Delegate</b></label>
                                <select id="delegate_type" name="delegate_type" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="National">National</option>
                                    <option value="International">International</option>
                                </select>
                            </div>
                            <div class=" col-md-6 mb-4">
                                <label for="designation"><b>Designation</b></label>
                                <input type="text" name="designation" class="form-control" id="designation" placeholder="Enter Your Designation" required>
                            </div>
                            <div class=" col-md-12 mb-4">
                                <label for="college_name"><b>Name of the Medical/Dental College</b></label>
                                <input type="text" name="college_name" class="form-control" id="college_name" placeholder="Enter Name of Your College" required>
                            </div>
                            <div class=" col-md-12 mb-4">
                                <label for="university_name"><b>Name of the University</b></label>
                                <input type="text" name="university_name" class="form-control" id="university_name" placeholder="Enter Name of University" required>
                            </div>
                            <div class=" col-md-12 mb-4">
                                <label for="full_address"><b>Full Address</b></label>
                                <input type="text" name="full_address" class="form-control" id="full_address" placeholder="Enter The Full Address" required>
                            </div>
                            <div class=" col-md-6 mb-4">
                                <label for="city"><b>City</b></label>
                                <input type="text" name="city" class="form-control" id="city" placeholder="Enter City" required>
                            </div>
                            <div class=" col-md-6 mb-4">
                                <label for="state"><b>State</b></label>
                                <input type="text" name="state" class="form-control" id="state" placeholder="Enter State" required>
                            </div>
                            <div class=" col-md-6 mb-4">
                                <label for="country"><b>Country</b></label>
                                <input type="text" name="country" class="form-control" id="country" placeholder="Enter Country" required>
                            </div>
                            <div class=" col-md-6 mb-4">
                                <label for="pincode"><b>Pin Code</b></label>
                                <input type="text" name="pincode" class="form-control" id="pincode" placeholder="Enter Pincode" required>
                            </div>
                            <div class=" col-md-6 mb-4">
                                <label for="email"><b>Email Address</b></label>
                                <input type="email" name="email" class="form-control" id="email_reg" placeholder="Enter Your Email Address" required>
                                <div id="user_email_check" class="mt-1"></div>
                            </div>
                            <div class=" col-md-6 mb-4">
                                <label for="mobile"><b>Mobile No.</b></label>
                                <input type="number" class="form-control" id="mobile" placeholder="Enter Your Mobile No." value="" name="mobile" required>
                            </div>
                            <div class=" col-md-6 mb-4 pre_conference">
                                <label for="pre_conference"><b>Will you attend the Pre-Conference Workshops ?</b></label>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="pre_conference" id="pre_conference1" value="yes" required>
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="pre_conference" id="pre_conference2" value="no">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-6 mb-4 present">
                                <label for="pre_type"><b>Select the Pre-Conference you are interested in:</b></label>
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="pre_type[]" id="pre_type1" value="1" >Pre-conference 1
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="pre_type[]" id="pre_type2" value="2">
                                           Pre-conference 2
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="pre_type[]" id="pre_type3" value="3">
                                            Pre-conference 3
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="pre_type[]" id="pre_type4" value="4">
                                            Pre-conference 4
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-6 mb-4 present">
                                <label for="presentation"><b>Select the Scientific Presentations in the Conference you’d like to attend:</b></label>
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="presentation[]" id="presentation1" value="1" required>Workshops
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="presentation[]" id="presentation2" value="2">
                                            Oral Presentations for research submission
                                        </label>
                                    </div>
                                    <!-- <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="presentation[]" id="presentation3" value="3">
                                            Oral Presentations for oral communication
                                        </label>
                                    </div> -->
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="presentation[]" id="presentation4" value="4">
                                            Posters
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="presentation[]" id="presentation5" value="5">
                                            Yenvision- Lightning talk
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-5">
                            <button type="submit" id="submit_reg_btn"class="btn btn-primary">SUBMIT</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
   
</div>


</body>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script src="<?=ROOT?>/assets/js/jquery.validate.js"></script>

<script type="text/javascript">
   jQuery.validator.addMethod("noSpace", function(value, element) { 
    return value == '' || value.trim().length != 0;  
}, "No space please and don't leave it empty");
   jQuery.validator.addMethod("customEmail", function(value, element) { 
      return this.optional( element ) || /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test( value ); 
  }, "Please enter valid email address!");

var $add_userForm = $('#registration_vidyen_form');
if($add_userForm.length){
  $add_userForm.validate({
      rules:{
          full_name: {
              required: true,
              noSpace: true
          }
      },
      messages:{
          full_name: {
              required: 'Please enter Full Name!'
          }
      },
       errorPlacement: function(error, element) 
      {
        if (element.is(":checkbox")) 
        {
            error.prependTo(element.parents('.present'));
        }
        else if (element.is(":radio")) 
        {
            error.prependTo(element.parents('.pre_conference'));
        }
        else 
        { 
            error.insertAfter( element );
        }
        
       }
  });
}
var isSubmitting = false;
// $(document).ready(function(){
//     showspinner();
// });
$(document).on('submit','#registration_vidyen_form',function(e){
    e.preventDefault();

    if (isSubmitting) {
        return;
    }
     isSubmitting = true;
    var email_val=$('#email_exist').val();
    if(email_val=='0'){
        showspinner();
    
    $.ajax({
        url: "index.php?controller=home&action=register_user",
        type: "POST",
        data: $(this).serialize(),
        success: function(response) {
            if(response.trim() == "success") {
                alert("Thank you for registering with us. You will recive an email with further details including payment link. Kindly make the payment in order to complete your registration.");
                window.location.reload(); 
            } else {
                alert("Registration Failed. Please try again.");
            }
        }
    });
    }else{
       // alert("Email Address Exist already. Please Change email Address");
        $('#user_email_check').focus();
        isSubmitting = false;
    }

});
$('#email_reg').keyup(function() {
  var email=$('#email_reg').val();
  var token = $('input[name="csrf_token"]').val();
  $.ajax({
     url:"index.php?controller=home&action=check_email",
    // url:"./decyen/Ajax/email_availability.php",
    type:"POST",
    data:{
      email:email,
      csrf_token: token
    },
    success:function(data) {
      $('#user_email_check').html(data);
      //$('#submit_reg_btn').hide();

    }
  });

});
</script>
<script type="text/javascript">
    
function showspinner() {
  var spinner = document.getElementById("spinner");
   spinner.classList.add("spinner");
  spinner.style.display = "block";
}

// Stop the spinner animation after the page has loaded
function hideSpinner() {
  var spinner = document.getElementById("spinner");

    
    //setTimeout(function(){
spinner.classList.remove("spinner");
    //},3000);
  
}
</script>
