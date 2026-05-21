<div class="content-wrapper bg-light">
    <div class="col-12 grid-margin">
        <div class="card p-3 shadow-lg">
            <div class="row">
                <div class="col-md-6">
                    <div class="text-dark ad text-center" style="color:white;font-weight: 700;font-size: 35px; line-height: 55px;letter-spacing:1px;"><b>Abstract<span class="text-primary"> Submission </span></b></div>
                </div>
                <div class="col-md-5 ">
                    <a href="<?= BASE ?>/assets/docs/Scientific Brochure_organized.pdf" target="_blank" class="btn btn-primary"> Download Abstract Submission Guidelines</a>
                </div>
                <div class="col-md-1 ">
                    <a class="btn  btn-primary btn-sm " onClick="history.go(-1);">Back</a>
                </div>
            </div>
            <div class="container">
                <form id="abstract_form" method="POST" class="abstract_form" action="index.php?controller=participant&action=abstract_save">
                    <?php echo Csrf::field(); ?>
                    <div role="tabpanel" class="tab-pane" id="dinfo">
                        <div class="row mt-5">
                            <div class="col-md-6">
                                <label for="title"><b>Conference Registration Id</b></label>
                                <!-- <input type="hidden" name="participant_id" value="<?php echo $confrenece ?>">      -->

                                <input type="text" name="register_id" required class="form-control" id="register_id" value="<?php echo $userid; ?>" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="last_name"><b>Type Of Presentation</b></label>
                                <select id="type_presentation" name="type_presentation" class="form-control" required>
                                    <option value="" selected>Choose type of presentation</option>
                                    <!-- <option value="Workshops">Workshops</option> -->
                                    <option value="Oral Presentations for research submission">Oral Presentations for research submission</option>
                                    <option value="Oral Presentations for Speciality Research">Oral Presentations for Speciality Research</option>
                                    <option value="Posters">Posters</option>
                                    <option value="Yenvision- Lightning talk">Yenvision- Lightning talk</option>
                                </select>
                            </div>
                           
                        </div>
                        <div class="row">
                            
                             <div class="col-md-6  mt-5">
                                <label for="first_name"><b>Sub-themes/categories</b></label>
                                <select id="sub_themes" name="sub_themes" required class="form-control">
                                    <option value="">Select Subtheme categories..</option>
                                    <option value="Assessment and Competency-Based Education">Assessment and Competency-Based Education</option>
                                    <option value="Teaching–Learning Innovations in the Digital Era">Teaching–Learning Innovations in the Digital Era</option>
                                    <option value="Quality Enhancement and Accreditation in Dental Education">Quality Enhancement and Accreditation in Dental Education</option>
                                    <option value="Interprofessional Education and Collaborative Practice (IPE)">Interprofessional Education and Collaborative Practice (IPE)</option>
                                    <option value="AI, Empathy, and Ethics in Modern Dental Practice">AI, Empathy, and Ethics in Modern Dental Practice</option>
                                    <option value="Faculty Development and Leadership for the Future">Faculty Development and Leadership for the Future</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-5">
                                <label for="cat_presentation"><b>Category Of Presentation</b></label>
                                <select id="cat_presentation" name="cat_presentation" class="form-control" required>
                                    <option value="" selected>Choose Category of presentation</option>
                                    <option value="Systematic Review / Metanalysis">Systematic Review / Metanalysis</option>
                                    <option value="Narrative Review">Narrative Review</option>
                                    <option value="Original Research Medical / Dental Education">Original Research Medical / Dental Education</option>
                                    <option value="Interprofessional Research">Interprofessional Research</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mt-5">
                                <label for=""><b>Title Of The Paper</b></label>
                                <input type="text" name="title_paper" required class="form-control" id="title_paper" placeholder="Enter Title of the Paper">
                            </div>

                            <div class="col-md-8 mt-5">
                                <label for=""><b>Keywords</b></label>
                                <textarea required class="form-control" placeholder="Enter Keywords(maximum 10 words)" name="keywords" id="keywords" cols="" rows=""></textarea>
                                <div class="words-leftKey"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mt-5">
                                <h3 class="text-primary mb-3">Name Of the Author(s) and Affiliations</h3>
                                <!-- <h4 class="text-primary mb-4"><u><b>First Author</b></u></h4>  -->
                            </div>
                        </div>

                        <div class="row mt-3 user-details" id="add_more_show">
                            <!-- <div class="user-details">
                                                <div class="user_data"> -->
                            <div class="col-md-4">
                                <label for=""><b>Prefix</b></label>
                                <select id="prefix" name="prefix[]" required class="form-control">
                                    <option value="">choose Prefix..</option>
                                    <option value="Dr">Dr</option>
                                    <option value="Mr">Mr</option>
                                    <option value="Mrs">Mrs</option>
                                    <option value="Miss">Miss</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for=""><b>First Name</b></label>
                                <input type="text" name="first_name[]" required class="form-control" id="first_name" placeholder="Enter Your First Name">
                            </div>
                            <div class="col-md-4 ">
                                <label for=""><b>Middle Name</b></label>
                                <input type="text" name="middle_name[]" class="form-control" id="middle_name" placeholder="Enter Your Last Name">
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for=""><b>Last Name</b></label>
                                <input type="text" name="last_name[]" class="form-control" id="last_name" placeholder="Enter Your Last Name">
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for=""><b>Email</b></label>
                                <input type="email" name="email[]" required class="form-control" id="email" placeholder="Enter Your Email" value="<?php echo $email; ?>">

                            </div>


                            <div class="col-md-4 mt-3">
                                <label for=""><b>Author</b></label>
                                <select id="type_author" name="type_author[]" required class="form-control">
                                    <option value="">Choose Author..</option>
                                    <option value="Presenting Author">Presenting Author</option>
                                    <option value="Co Author">Co Author</option>
                                </select>
                            </div>

                            <div class="col-md-4 mt-3">
                                <label for=""><b>Designation</b></label>
                                <input type="text" name="designation[]" required class="form-control" id="designation" placeholder="Enter Your Designation">
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for=""><b>Institution</b></label>
                                <input type="text" name="institution[]" required class="form-control" id="institution" placeholder="Enter Your Institution">
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for=""><b>City</b></label>
                                <input type="text" name="city[]" required class="form-control" id="city" placeholder="Enter Your City">
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for=""><b>State</b></label>
                                <input type="text" name="state[]" required class="form-control" id="state" placeholder="Enter Your State">
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for=""><b>Country</b></label>
                                <input type="text" name="country_name[]" class="form-control" id="country_name" placeholder="Enter Your Country Name">
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for=""><b>Pincode</b></label>
                                <input type="text" name="pincode[]" required class="form-control" id="pincode" placeholder="Enter Your pincode">
                            </div>

                            <div>
                                <hr>
                            </div>
                            <!-- </div>
                                            </div> -->
                        </div>



                        <div class="text-center mt-3 ">
                            <button id="add_more_coauthor" type="button" name="add_more_coauthor" required class="btn btn-primary btn btn-lg mt-4 text-white fw-bold p-3" value="" onclick="">Add More Author</button>
                        </div>


                        <div class=" mt-3">
                            <label for=""><b>Abstract Details (max 400 words)</b></label>
                            <textarea required class="form-control" placeholder="Submit Under Following Headings(Introduction,Objective(s) of the study,Methodology,Results,Conclusion)" name="abtract_details" id="abtract_details" rows="5" required></textarea>
                            <div class="words-left"></div>
                        </div>

                        <div class="row p-0 mt-5 mb-5 d-flex justify-content-center">
                            <div class="col-md-4"></div>
                            <div class="col-md-4 mt-1">
                                <button type="submit" class="btn btn-primary btn btn-lg rounded text-light fw-bold mt-2 sub" id="submit_abstract_button" name="submit">Submit</button>
                            </div>
                            <div class="col-md-4"></div>
                        </div>

                </form>
            </div>

        </div>
    </div>
</div>









<script>
    var wordLen = 250; // Maximum word length
    function checkWordLen(obj) {
        var len = obj.value.split(/[\s]+/);
        if (len.length > wordLen) {
            alert("You cannot put more than " + wordLen + " words in this text area.");
            obj.oldValue = obj.value != obj.oldValue ? obj.value : obj.oldValue;
            obj.value = obj.oldValue ? obj.oldValue : "";
            return false;
        }
        return true;
    }






    $(document).ready(function() {
        $('#add_more_coauthor').click(function() {
            $('.user-details').append('<div class="row mt-5 user_data" id="user_data">' +
                '<div class="col-md-4">' +
                '<label for=""><b>Prefixes</b></label>' +
                '<select id="prefix" name="prefix[]"  class="form-control" required="required">' +
                '<option value="">choose Prefixes..</option>' +
                '<option value="Dr">Dr</option>' +
                '<option value="Mr">Mr</option>' +
                '<option value="Mrs">Mrs</option>' +
                '<option value="Miss">Miss</option>' +
                '</select></div>' +
                '<div class="col-md-4">' +
                '<label for=""><b>First Name</b></label>' +
                '<input type="text" name="first_name[]" required="required" class="form-control" id="first_name" placeholder="Enter Your First Name" ></div>' +
                '<div class="col-md-4">' +
                '<label for=""><b>Middle Name</b></label>' +
                '<input type="text" name="middle_name[]"  class="form-control" id="middle_name" placeholder="Enter Your Last Name" ></div>' +
                '<div class="col-md-4 mt-3">' +
                '<label for=""><b>Last Name</b></label>' +
                '<input type="text" name="last_name[]"  class="form-control" id="last_name" placeholder="Enter Your Last Name" ></div>' +
                '<div class="col-md-4 mt-3">' +
                '<label for=""><b>Email</b></label>' +
                '<input type="text" name="email[]" required="required" class="form-control" id="email" placeholder="Enter Your Email" ></div>' +
                '<div class="col-md-4 mt-3">' +
                '<label for=""><b>Author</b></label>' +
                '<select id="type_author" name="type_author[]" required="required" class="form-control remove_author" >' +
                '<option value="">choose Author..</option>' +
                '<option value="Presenting Author" >Presenting Author</option><option value="Co Author">Co Author</option></select></div>' +
                '<div class="col-md-4 mt-3">' +
                '<label for=""><b>Designation</b></label>' +
                '<input type="text" name="designation[]" required="required" class="form-control" id="designation" placeholder="Enter Your Designation" ></div>' +
                '<div class="col-md-4 mt-3">' +
                '<label for=""><b>Institution</b></label>' +
                '<input type="text" name="institution[]" required="required" class="form-control" id="institution" placeholder="Enter Your Institution" ></div>' +
                '<div class="col-md-4 mt-3">' +
                '<label for=""><b>City</b></label>' +
                '<input type="text" name="city[]" required="required" class="form-control" id="city" placeholder="Enter Your City" ></div>' +
                '<div class="col-md-4 mt-3">' +
                '<label for=""><b>State</b></label>' +
                '<input type="text" name="state[]" required="required" class="form-control" id="state" placeholder="Enter Your State" ></div>' +
                '<div class="col-md-4 mt-3">' +
                '<label for=""><b>Country</b></label>' +
                '<input type="text" name="country_name[]" required="required" class="form-control" id="country_name" placeholder="Enter Your Country Name" ></div>' +
                '<div class="col-md-4 mt-3">' +
                '<label for=""><b>Pincode</b></label>' +
                '<input type="text" name="pincode[]" required="required" class="form-control" id="pincode" placeholder="Enter Your Pincode" ></div>' +
                '<div class="col-md-4 mt-3">' + '<button id="remove" type="button" name="remove" required="required" class="btn btn-primary btn btn-lg mt-4 text-white fw-bold p-3 remove-btn" value="" onclick="">Remove</button>' + '</div><div><hr></div></div>');
        });

        $("body").on("click", ".remove-btn", function(e) {
            $(this).parents('.user_data').remove();

        });

    });


    $(document).ready(function() {

        $('#add_more_coauthor').click(function(e) {
            let check = $("#type_author").val();
            let check2 = $(".remove_author").val();
            if (check == "Presenting Author" || check2 == "Presenting Author") {
                $(".remove_author").find('[value="Presenting Author"]').hide();
            }
        });

        var wordLen = 401,
            len; // Maximum word length for abstract details
        $('#abtract_details').keyup(function(event) {
            len = $('#abtract_details').val().split(/[\s]+/);
            if (len.length > wordLen) {
                if (event.keyCode == 46 || event.keyCode == 8) { // Allow backspace and delete buttons
                } else if (event.keyCode < 48 || event.keyCode > 57) { //all other buttons
                    event.preventDefault();
                }
            }
            console.log(len.length + " words are typed out of an available " + wordLen);
            wordsLeft = (wordLen) - len.length;
            $('.words-left').html(wordsLeft + ' words left');
            if (wordsLeft == 0) {
                $('#abtract_details').blur();
                $('.words-left').html('Cannot enter more than 400 words');
                $(".words-left").css("color", "red").prepend('<i class="fa fa-exclamation-triangle"></i>');
            }
        });



        var keywordLen = 11,
            keylen; // Maximum word length for keywords
        $('#keywords').keyup(function(event) {
            keylen = $('#keywords').val().split(/[\s]+/);
            if (keylen.length > keywordLen) {
                if (event.keyCode == 46 || event.keyCode == 8) { // Allow backspace and delete buttons
                } else if (event.keyCode < 48 || event.keyCode > 57) { //all other buttons
                    event.preventDefault();
                }
            }
            console.log(keylen.length + " words are typed out of an available " + keywordLen);
            wordsLeftkey = (keywordLen) - keylen.length;
            $('.words-leftKey').html(wordsLeftkey + ' words left');
            if (wordsLeftkey == 0) {
                $('#keywords').blur();
                $('.words-leftKey').html('Cannot enter more than 10 words');
                $(".words-leftKey").css("color", "red").prepend('<i class="fa fa-exclamation-triangle"></i>');
            }
        });



        // -----------------Length Check On SUbmission------------------
        var word_err = true; //abstract details
        function word_check() {

            len = $('#abtract_details').val().split(/[\s]+/);
            wordsLeft = (wordLen) - len.length;

            if (wordsLeft < 0) {

                $('.words-left').html("Cannot enter more than 400 words");
                $(".words-left").css("color", "red");
                $('.words-left').focus();
                word_err = false;
                return false;
                $('#abtract_details').focus();
            } else {
                $('.words-left').hide();
                word_err = true;
                //return true;
            }
        }

        var word_errkey = true; // key word
        function keyword_check() {

            keylen = $('#keywords').val().split(/[\s]+/);
            wordsLeftkey = (keywordLen) - keylen.length;

            if (wordsLeftkey < 0) {

                $('.words-leftKey').html("Cannot enter more than 10 words");
                $(".words-leftkey").css("color", "red");
                $('.words-leftkey').focus();
                word_errkey = false;
                return false;
                $('#keywords').focus();
            } else {
                $('.words-leftkey').hide();
                word_errkey = true;
                // return true;
            }
        }

        $('#submit_abstract_button').click(function() {
            word_check();
            keyword_check();

            if (word_err == true && word_errkey == true) {
                return true;

            } else {

                return false;
            }

        });

    });


   
    
document.getElementById("type_presentation").addEventListener("change", function () {

    const presentationType = this.value;
    const subThemes = document.getElementById("sub_themes");

    // Clear existing options
    subThemes.innerHTML = '<option value="">Select Subtheme categories..</option>';

    let options = [];

    if (presentationType === "Oral Presentations for research submission") {

        options = [
            "Assessment and Competency-Based Education",
            "Teaching–Learning Innovations in the Digital Era",
            "Quality Enhancement and Accreditation in Dental Education",
            "Interprofessional Education and Collaborative Practice (IPE)",
            "AI, Empathy, and Ethics in Modern Dental Practice",
            "Faculty Development and Leadership for the Future"
        ];

    } else if (presentationType === "Oral Presentations for Speciality Research") {

        options = [
            "Orthodontics",
            "Pedodontics",
            "Public Health Dentistry",
            "Periodontics",
            "Oral Surgery",
            "Oral Medicine and Radiology",
            "Prosthodontics",
            "Implantology",
            "Dental Materials",
            "Oral Pathology"
        ];

    } else if (presentationType === "Posters") {

        options = [
            "Assessment and Competency-Based Education",
            "Teaching–Learning Innovations in the Digital Era",
            "Quality Enhancement and Accreditation in Dental Education",
            "Interprofessional Education and Collaborative Practice (IPE)",
            "AI, Empathy, and Ethics in Modern Dental Practice",
            "Faculty Development and Leadership for the Future",
            "Orthodontics",
            "Pedodontics",
            "Public Health Dentistry",
            "Periodontics",
            "Oral Surgery",
            "Oral Medicine and Radiology",
            "Prosthodontics",
            "Implantology",
            "Dental Materials",
            "Oral Pathology"
        ];

    } else if (presentationType === "Yenvision- Lightning talk") {

                options = [
            "Assessment and Competency-Based Education",
            "Teaching–Learning Innovations in the Digital Era",
            "Quality Enhancement and Accreditation in Dental Education",
            "Interprofessional Education and Collaborative Practice (IPE)",
            "AI, Empathy, and Ethics in Modern Dental Practice",
            "Faculty Development and Leadership for the Future"
        ];
    }

    // Append new options
    options.forEach(function (item) {

        const option = document.createElement("option");

        option.value = item;
        option.textContent = item;

        subThemes.appendChild(option);
    });

});

</script>