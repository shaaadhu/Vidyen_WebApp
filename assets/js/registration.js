$(document).ready(function () {
  $("#yes1").click(function () {
    $("#am").show();

  });


  $("#no2").click(function () {
    var count = document.getElementById("acc_p_no").value;
    alert(count);
    for (var i = 0; i <= count; i++) {
      RemoveTextBox(div);
    }
    $("#am").hide();

  });

  $(".extra").click(function () {

    $("#nextback").show();
  });


  $("#scientific_yes_no").change(function () {
    $(this).find("option:selected").each(function () {
      var x = $(this).attr("value");
      if (x == 'Yes') {
        $("#sp").show();
      } else if (x == 'No') {
        $("#sp").hide();
      }

    });
  });
  /* 
  });
  function calrate() {
    var preval = $('#pre').attr("value");
    val = JSON.parse(preval);
    var topval = $('#type_of_program').attr("value");
    val = JSON.parse(topval);
    var pre_amt = preval.value;
    var pre_label = preval.label;
    var top_amt = topval.value;
    var top_label = topval.label;
    var tot_amt1 = parseInt(pre_amt, 10) + parseInt(top_amt, 10);
    $("#Amt").html(tot_amt1);
    $("#Amt1").val(tot_amt1);
    if(pre_label == 'Yes'){
    $('#summ_con').html(pre_label);
    }else if(pre_label == 'No'){
      $('#summ_con').html("N/A");
    }
    if(top_label == 'Yes'){
      $('#summ_type').html(top_label);
    }else if(top_label == 'No'){
      $('#summ_type').html("N/A");
    }
  
  } */

   $("#type_of_program").change(function () {
    $(this).find("option:selected").each(function () {
      var val = $(this).attr("value");
  
      if (val == '') {
        $(".show-div").hide();
        $('#summ_type').html("N/A");
        $("#Amt").html("0");
        $("#Amt1").val("0");
      } else {
     $('#pre').prop('selectedIndex', 0);
        $('#summ_con').html("N/A");
        val = JSON.parse(val);
        var id = val.id;
        var amt = val.value;
        var label = val.label;
        var summart_type = label + " : ₹  " + amt;   
        if (id) {
          $(".show-div").not("." + id).hide();
          $("." + id).show();
        } else {
          $(".show-div").hide();
        }

        if (id == 1){
          $(".kmc_div").hide();
        }
        else{
          $(".kmc_div").show();
        }

        $("#Amt").html(amt);
        $("#Amt1").val(amt);
        $('#summ_type').html(summart_type);
  
      }
    });
  }).change();
 $("#pre").change(function () {
    $(this).find("option:selected").each(function () {
      var val = $(this).attr("value");
      val = JSON.parse(val);
      var id = val.id;
      var amt = val.value;
      var label = val.label;
      var con_status = $('#summ_con').html();
      if (con_status == 'Yes') {
        var tot_amt = $("#Amt").html();
        var tot_amt1 = parseInt(tot_amt, 10) - parseInt(amt, 10);
      }
	if (con_status == 'No') {
        var tot_amt = $("#Amt").html();
        var tot_amt1 = parseInt(tot_amt, 10) + parseInt(amt, 10);
      }
	if(con_status == 'N/A'){
        if(label == 'Yes'){
          var tot_amt = $("#Amt").html();
          var tot_amt1 = parseInt(tot_amt, 10) + parseInt(amt, 10);
        }      }
        $("#Amt").html(tot_amt1);
        $("#Amt1").val(tot_amt1);
        $('#summ_con').html(label);

        $('#pre_val').val(id);
    });
    }).change(); 
});
/* 
$("#type_of_program").change(function () {

  total_amt();

}).change();

$("#pre").change(function () {

  total_amt();

}).change();

function total_amt() {
  const top_val = document.getElementById("type_of_program").value
  const pre_val = document.getElementById("pre").value
  var tot_amt = 0;
  var tot_amt1 = 0;
  console.log(top_val);
  top_val = JSON.parse(top_val);
  pre_val = JSON.pase(pre_val);
var top_amt = top_val.value;
var top_label = top_val.label;
var pre_amt = pre_val.value;
var pre_label = pre_val.label;
alert(top_amt);
alert(top_label);
alert(pre_amt);
alert(pre_label);
}
 */




function GetDynamicTextBox(value) {
  return '<br><label> Person Name </label><br><input required class="form-control"  name = "Accompanying[]" type="text" value = "' + value + '" /><br>' +
    '<input type="button" class="btn btn-danger" value="Remove This Person" onclick = "RemoveTextBox(this)" /> <br>'
}

function AddTextBox() {
  var div = document.createElement('DIV');
  div.innerHTML = GetDynamicTextBox("");
  document.getElementById("TextBoxContainer").appendChild(div);
  let count = document.getElementById("acc_p_no").value;
  let count1 = parseInt(count, 10) + parseInt('1', 10);
  let acc_P_amt = parseInt(count1, 10) * parseInt('3000', 10);
  document.getElementById("acc_p_no").value = count1;
  document.getElementById("summ_acc_p").innerHTML = count1;

  let amt = document.getElementById("Amt1").value;
  let tot_amt = parseInt(amt, 10) + parseInt(acc_P_amt, 10);
  document.getElementById("Amt").innerHTML = tot_amt;
  document.getElementById("sss").style.display = "none";
}

function RemoveTextBox(div) {
  document.getElementById("TextBoxContainer").removeChild(div.parentNode);
  let count = document.getElementById("acc_p_no").value;
  let count1 = parseInt(count, 10) - parseInt('1', 10);
  let acc_P_amt = parseInt(count1, 10) * parseInt('3000', 10);
  document.getElementById("acc_p_no").value = count1;
  document.getElementById("summ_acc_p").innerHTML = count1;

  let amt = document.getElementById("Amt1").value;
  let tot_amt = parseInt(amt, 10) + parseInt(acc_P_amt, 10);
  document.getElementById("Amt").innerHTML = tot_amt;
}


// data adding from form to data base.....................................................


/*  $(document).on('submit','#registration_iapsm_form',function(e) {
   e.preventDefault();
   alert("sfdgf");
    var formData=new FormData(this);
   var xhr=new XMLHttpRequest();
   alert("fdsfsd");
   xhr.open('POST','../insert/data_store.php',true);
   xhr.load=function() {
       
       if(xhr.status==200){
         //  alert("Successfully inserted");
       }
       else{
           //alert("Not inserted");
       }
       
   };
   xhr.send(formData);
 
  // $("#registration_iapsm_form")[0].reset();
}); */


// viewing data from database.....................................................


$(document).ready(function () {
  $.ajax({
    type: "GET",
    url: "ajax/view_register.php",
    dataType: "html",
    success: function (data) {
      $("#reg_data").html(data);

    }
  });
});


   // ------------------------------------------------------------------------------







