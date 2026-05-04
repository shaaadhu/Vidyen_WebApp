 <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->

<style>
    .error{
      color: red;
    }
</style>
  
    <!-- Contact Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <?php if(isset($alert)) echo $alert; ?>
            <div class="row align-items-end mb-4">
                <div class="col-lg-6">
                    <h1 class="section-title mb-3">Contact Us </h1> 
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7 mb-5 mb-lg-0">
                    <div class="contact-form">
                        <div id="success"></div>
                        <?php echo Recaptcha::getScript(); ?>
                         <?php echo Recaptcha::renderScript('contact_form', 'contactForm'); ?>
                        <form name="sendMessage" id="contactForm" action="index.php?controller=home&action=save_contact" method="post">
                            <?php echo Csrf::field(); ?>

                            <div class="control-group">
                                <input type="text" class="form-control p-4" id="name" placeholder="Your Name" name="name"  required />
                                <p class="help-block text-danger"></p>
                            </div>  
                            <div class="form-row">
                                <div class="col-sm-6 control-group">
                                    <input type="text" class="form-control p-4" id="phone_number" placeholder="Your Mobile Number" name="phone_number"  required />
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="col-sm-6 control-group">
                                    <input type="text" class="form-control p-4" id="email" name="email" placeholder="Your Email" required/>
                                    <p class="help-block text-danger"></p>  
                                </div> 
                            </div>
                            <div class="control-group">
                                <input type="text" class="form-control p-4" id="subject" name="subject" placeholder="Subject" required/>    
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <textarea class="form-control p-4" rows="6" id="message" name="message"  placeholder="Message" required></textarea> 
                                <p class="help-block text-danger"></p>
                            </div>
                            
                            <div>
                                <button class="btn btn-primary btn-block py-3 px-5" type="submit" id="sendMessageButton">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-5" style="min-height: 400px;">
                    <div class="position-relative h-100 rounded overflow-hidden">
                        <iframe style="width: 100%; height: 100%; object-fit: cover;"
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15561.9768726737!2d74.8814156!3d12.8113086!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x7cc8905c5f9cf939!2sYenepoya%20(Deemed%20to%20be%20University)!5e0!3m2!1sen!2sin!4v1658133734362!5m2!1sen!2sin"
                        frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>

            </div>
        </div>
        
    </div>
    <!-- Contact End -->


 
  <script src="<?= ROOT ?>/assets/js/jquery.validate.js"></script>
  
<script type="text/javascript">
      $(document).ready(function(){
          jQuery.validator.addMethod("noSpace", function(value, element) { 
            return value.indexOf(" ") < 0 && value != ""; 
        }, "No space please and don't leave it empty");
          var contactForm = $('#contactForm');
if(contactForm.length){
          contactForm.validate({
             rules:{
                name:{
                  required:true,
                   noSpace: true 
              },
              phone_number:{
                  required:true,
                   noSpace: true 
              },
                email:{
                  required:true,
                  noSpace:true
              },
                subject:{
                  required:true,
                  noSpace:true
                
              },
                message:{
                   required:true,
                  noSpace:true
                  
              },
              messages:{
                name:{
                      required:"Please Enter Name"
                  }, 
                  email:{
                      required:"Please Enter Email Address"
                  }, 
                  subject:{
                      required:"Please Enter subject"
                  },   
                message:{
                    required:"Please Enter Message"
              }
  }

}
});
}
      });
  </script>