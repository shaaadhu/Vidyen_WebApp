$(document).ready(function(){
  jQuery.validator.addMethod("noSpace", function(value, element) { 
    return value.indexOf(" ") < 0 && value != ""; 
  }, "No space please and don't leave it empty");
  $('#registration_iapsm_form').validate({
   rules:{
    registration:{
      required:true
  },
  title1:{
    required:true
  },
     fname:{
       required:true,
       minlength:4
      
     },
     age:{
      required:true,
      noSpace:true,
      digits:true
      
    },
    gender1:{
      required:true
    },
    upload:{
      required:true
    },
    upload_iapsm:{
      required:true,
       noSpace:true,
       digits:true
    },
    designation:{
      required:true
      
    },
    address:{
      required:true
     
    },
    city:{
      required:true
    
    },
    state:{
      required:true
    },
    pin:{
      required:true,
      noSpace:true,
      digits:true,
      minlength:6,
      maxlength:6
    },
    email:{
      required:true,
      email:true,
      noSpace:true
    },
    mobile_no:{
      required:true,
      noSpace:true,
      digits:true,
      minlength:10,
      maxlength:10
    },
    pre:{
      required:true
    },
    scientific_yes_no:{
      required:true
    },
    scientific:{
      required:true
    },
   //  medical_college:{
   //    required:true
   //  },
   //  medical_council:{
   //    required:true
   //  },
   //  registration_no:{
   //    required:true,
   //    digits:true
   // },
   messages:{
      registration:{
          required:"Choose type of program"
      },
      title1:{
        required:"Choose title"
      },
         fname:{
           required:"Please Enter full Name",
           minlength:"Name must be more then 4 character"
         },
         age:{
          required:"Enter Age",
          digits:"Age Must be in Letters"
          
        },
        gender1:{
          required:"Select Gender"
        },
        upload:{
          required:"Upload Document Verified By Head of Department/Principal"
        },
        upload_iapsm:{
          required:"Enter IAPSM Membership Number",
          digits:"IAPSM Member Number must be digit"
        },
        designation:{
          required:"Enter Designation"
        },
        address:{
          required:"Enter Address"
        },
        city:{
          required:"Enter City"
        },
        state:{
          required:"Select State"
        },
        pin:{
          required:"Enter Pincode",
          digits:"Pincode must be in digit",
          minlength:"Minimum 6 numbers Required",
          maxlength:"Maximum 6 numbers Required"
        },
        email:{
          required:"Enter email",
          // email:"Enter in Email formate"
        },
        mobile_no:{
          required:"Enter Mobile number",
          digits:"Mobile Number must be in digits",
          minlength:"Minimum 10 numbers Required",
          maxlength:"Maximum 10 numbers Required"
        },
        pre:{
          required:"Select Attending Pre Conference Yes/No"
        },
        scientific_yes_no:{
          required:"Select Scientific Presentation"
        },
        scientific:{
          required:"Select the Option Of Scientific Presentation"
        },
        // medical_college:{
        //   required:"Enter Medical college Name"
        // },
        // medical_council:{
        //   required:"Enter Name of Medical Council"
        // },
        // registration_no:{
        //   required:"Enter Council Registration Number", 
        //   digits:"Registration Number in Digits"
        // }
   }
   
  }
 });
  
 });