<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">

<?php
if (isset($_GET['status']) && $_GET['status'] == 'success') {
    echo '<script>alert("Request submitted successfully.");</script>';
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/logo-deped.png" type="image/png">
    <title>ICT Service Request</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: url('images/matatag.jpeg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            justify-content: center;
            align-items: center;
        }
        .container {
            text-align: center;
            width: 80%;
            max-width: 600px;
            margin: auto;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        header {
            margin-bottom: 30px;
        }
        .logo {
            width: 180px;
            margin: auto;
            height: auto;
            display: block;
            margin-bottom: 20px;
        }
        h1 {
            font-size: 24px;
            color: #000;
            margin-bottom: 20px;
        }
        form {
            text-align: left;
        }
        label {
            display: block;
            font-weight: bold;
            color: #022B62;
            margin-bottom: 7px;
            margin-top: 20px;
            font-size: 15px;    
        }
        small{
            display: block;
            font-weight: medium;
            color: #022B62;
            margin-bottom: 8px;
            margin-top: 5px;
            font-size: 14px;
        }
        input[type="text"],
        select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            background: #fff;
            border: 2px solid #104481;
            border-radius: 5px;
            font-size: 16px;
            color: #333;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .paragraph {
            font-size: 16px;
            font-family: Arial, sans-serif;
            line-height: 24px;
            color: #333;
            margin-bottom: 20px;
        }
        .submit-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    .back-button {
        display: inline-block;
        background-color: #206F3C;
        color: #fff;
        padding: 12px;    
        border: none;
        border-radius: 10px;      
        font-size: 16px;
        cursor: pointer;
        order: 1;
        font-weight: bold;
        width: 100%;
        max-width: 250px;
        margin-top: 10px;
        text-decoration: none;
        text-align: center;
}

    .back-button:hover {
        background-color: #0d3a6a;
        text-decoration: none;
}

        input[type="submit"] {
            background-color: #206F3C;
            color: #fff;
            padding: 15px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            order: 2;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
            max-width: 300px;
            margin-top: 10px;

            
        }
        input[type="submit"]:hover {
            background-color: #0d3a6a;
        }
        textarea{
            text-align: center;
            width: 100%;
            max-width: 600px;
            margin: auto;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 7px;
        }
        footer {
            margin-top: 20px;
            color: #333;
            text-align: center;
            font-size: 15px;
            font-weight: bold;
        }
        .footer-logos {
            margin-top: 20px;
        }
        .footer-logo {
            width: 200px;
            height: auto;
            margin: 0 10px;
        }
        @media (max-width: 768px) {
            .container {
                width: 90%;
                padding: 1rem;
            }
            .logo {
                width: 150px;
            }
            h1 {
                font-size: 22px;
            }
        }
    </style>
 
<script>
    function showOptions() {
        var serviceType = document.getElementById("type_of_service").value;
        var ICTOptions = document.getElementById("ICT");
        var ResetOptions = document.getElementById("Reset");
        var CreationOptions = document.getElementById("Creation");
        // Handle the main service type options
        if (serviceType === "ICT") {
            ICTOptions.style.display = "block";
            ResetOptions.style.display = "none";
            CreationOptions.style.display = "none";
            document.getElementById("ICT_service").setAttribute("required", "true");
            resetResetFields();  // Clear Reset fields when switching away
            resetCreationFields();  // Clear Creation fields when switching away
            showICTOptions(); // Show specific ICT service options based on selection
        } else if (serviceType === "Email Reset") {
        ICTOptions.style.display = "none";
        ResetOptions.style.display = "block";
        CreationOptions.style.display = "none"; 
        document.getElementsByName("ResetOption")[0].required = true;
            document.getElementById("Reset_details1").setAttribute("required", "true");
            document.getElementById("Reset_details3").setAttribute("required", "true");
            document.getElementById("Reset_details2").setAttribute("required", "true");
            document.getElementById("Reset_details1").addEventListener("blur", validateDepEdEmail);
        document.getElementById("Reset_details1").addEventListener("change", validateDepEdEmail);
        document.getElementById("Reset_details2").addEventListener("blur", validateEmail);
        document.getElementById("Reset_details2").addEventListener("change", validateEmail);

    
    
            resetICTFields();  // Clear ICT fields when switching away
            resetCreationFields();  // Clear Creation fields when switching away
        
        } else if (serviceType === "Email Creation") {
            ICTOptions.style.display = "none";
            ResetOptions.style.display = "none";
            CreationOptions.style.display = "block";
            document.getElementsByName("CreationOption")[0].required = true;
            document.getElementById("Creation").setAttribute("required", "true");
            document.getElementById("Employee_Name").setAttribute("required", "true");
            document.getElementById("schoolid").setAttribute("required", "true");
            document.getElementById("plantilla_position").setAttribute("required", "true");
            document.getElementById("schoolid").setAttribute("required", "true");
            document.getElementById("personal_email").setAttribute("required", "true");
            document.getElementById("personal_email").addEventListener("change", validateEmail);
            document.getElementById("personal_email").addEventListener("blur", validateEmail);
            document.getElementById("personal_number").setAttribute("required", "true");
            document.getElementById("personal_number").addEventListener("change", validatePhone);
            document.getElementById("personal_number").addEventListener("blur", validatePhone);



            resetICTFields();  // Clear ICT fields when switching away
            resetResetFields();  // Clear Reset fields when switching away
        } else {
            ICTOptions.style.display = "none";
            ResetOptions.style.display = "none";
            CreationOptions.style.display = "none";
            resetICTFields();  // Clear ICT fields when switching away
            resetResetFields();  // Clear Reset fields when switching away
            resetCreationFields();  // Clear Creation fields when switching away
        }
    }

    function validateDepEdEmail() {
    const emailInput = document.getElementById("Reset_details1");
    const emailValue = emailInput.value.trim();
    const depEdDomainRegex = /\@deped\.gov\.ph$/i; // regex to match @deped.gov.ph domain

    if (!depEdDomainRegex.test(emailValue)) {
        emailInput.setCustomValidity("Please enter an email address with the @deped.gov.ph domain.");
        emailInput.reportValidity();
    } else {
        emailInput.setCustomValidity("");
    }
}
function validateEmail() {
    const emailInput = event.target;
    const emailValue = emailInput.value.trim();
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; // regex to match most common email formats

    if (!emailRegex.test(emailValue)) {
        emailInput.setCustomValidity("Please enter a valid email address.");
        emailInput.reportValidity();
    } else if (emailValue !== "") {
        emailInput.setCustomValidity(""); // clear custom validity message
    }
}
function validatePhone() {
    const phoneInput = event.target;
    const phoneValue = phoneInput.value.trim();
    const phoneRegex = /^(?:\+63|0)9\d{9}$/; // regex to match Philippine mobile numbers (e.g., +639123456789 or 09123456789)

    if (phoneValue === "") {
        phoneInput.setCustomValidity("Please enter a phone number.");
        phoneInput.reportValidity();
    } else if (!phoneRegex.test(phoneValue)) {
        phoneInput.setCustomValidity("Please enter a valid phone number (e.g., +639123456789 or 09123456789).");
        phoneInput.reportValidity();
    } else {
        phoneInput.setCustomValidity(""); // clear custom validity message
    }
}
function validateSixDigitNumber() {
    const sixDigitInput = event.target;
    const sixDigitValue = sixDigitInput.value.trim();
    const sixDigitRegex = /^\d{6}$/; // regex to match exactly 6 digits

    if (sixDigitValue === "") {
        sixDigitInput.setCustomValidity("Please enter a 6-digit number.");
        sixDigitInput.reportValidity();
    } else if (!sixDigitRegex.test(sixDigitValue)) {
        sixDigitInput.setCustomValidity("Please enter a valid 6-digit number.");
        sixDigitInput.reportValidity();
    } else {
        sixDigitInput.setCustomValidity(""); // clear custom validity message
    }
}
                // Function to show ICT-specific options based on the selected ICT service
                function showICTOptions() {
    const ICTServiceValue = document.getElementById("ICT_service").value;
    const Option1 = document.getElementById("Option1"); 
    const Option2 = document.getElementById("Option2");  
    const Option3 = document.getElementById("Option3"); 
    const Option4 = document.getElementById("Option4");
    const Option5 = document.getElementById("Option5");
    const Option6 = document.getElementById("Option6"); 

    // Hide and reset all options
    [Option1, Option2, Option3, Option4, Option5, Option6].forEach(option => {
        option.style.display = "none";
        option.querySelectorAll('input, select, textarea').forEach(input => {
            input.removeAttribute('required');
            input.value = "";
            if (input.type === "checkbox" || input.type === "radio") {
                input.checked = false;
            }
        });
    });

    // Show specific ICT service options based on selection
    if (ICTServiceValue === "Computer Software Maintenance/Troubleshooting") {
        Option1.style.display = "block";
        setRequiredForInputs(Option1);
    } else if (ICTServiceValue === "Computer Hardware Maintenance/Troubleshooting") {
        Option2.style.display = "block";
        setRequiredForInputs(Option2);
    } else if (ICTServiceValue === "Information, Education and Communication (IEC) Materials") {
        Option3.style.display = "block";
        setRequiredForInputs(Option3);
        enforceOneCheckboxSelected("Option3");
    } else if (ICTServiceValue === "Printer Maintenance") {
        Option4.style.display = "block";
        setRequiredForInputs(Option4);
    } else if (ICTServiceValue === "Technical Assistance to Trainings and Events") {
        Option5.style.display = "block";
        setRequiredForInputs(Option5);
        enforceOneCheckboxSelected("Option5");
    } else if (ICTServiceValue === "Send Documents using Division Email") {
        Option6.style.display = "block";
        setRequiredForInputs(Option6);
    }
}

function setRequiredForInputs(option) {
    option.querySelectorAll('input, select, textarea').forEach(input => {
        if (input.type !== "checkbox" && input.type !== "radio") {
            input.setAttribute('required', 'true');
        }
    });
}

function enforceOneCheckboxSelected(optionId) {
    const checkboxes = document.querySelectorAll(`#${optionId} input[type="checkbox"]`);
    
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            // Ensure only one checkbox is checked
            checkboxes.forEach(cb => {
                if (cb !== checkbox) {
                    cb.checked = false;
                }
            });
            
            // Check if at least one checkbox is selected
            const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
            checkboxes.forEach(cb => {
                if (anyChecked) {
                    cb.removeAttribute('required');
                } else {
                    cb.setAttribute('required', 'true');
                }
            });
        });
    });
}
    function resetICTFields() {
        var ICTInputs = document.querySelectorAll("#ICT input, #ICT select, #ICT textarea");
        ICTInputs.forEach(function(input) {
            input.value = "";
            if (input.type === "checkbox" || input.type === "radio") {
                input.checked = false;
            }
        });
        hideICTOptions();  // Hide all ICT options when switching away
    }

    // Function to reset all Email Reset-related fields
    function resetResetFields() {
        var ResetInputs = document.querySelectorAll("#Reset input, #Reset select, #Reset textarea");
        ResetInputs.forEach(function(input) {
            input.value = "";
            if (input.type === "checkbox" || input.type === "radio") {
                input.checked = false;
            }
        });
    }

    // Function to reset all Email Creation-related fields
    function resetCreationFields() {
        var CreationInputs = document.querySelectorAll("#Creation input, #Creation select, #Creation textarea");
        CreationInputs.forEach(function(input) {
            input.value = "";
            if (input.type === "checkbox" || input.type === "radio") {
                input.checked = false;
            }
        });
    }

    // Function to hide all ICT-specific options
    function hideICTOptions() {
        document.getElementById("Option1").style.display = "none";
        document.getElementById("Option2").style.display = "none";
        document.getElementById("Option3").style.display = "none";
        document.getElementById("Option4").style.display = "none";
        document.getElementById("Option5").style.display = "none";
        document.getElementById("Option6").style.display = "none";
        
        
    }
</script>




        </head>

        <body>
            <div class="container">
                <header>
                    <img src="images/logo-deped.png" alt="Division of General Trias City Logo" class="logo">
                    <h1>Division ICT Service Request</h1>
                </header>
                <form action="submit_request.php" method="post" enctype="multipart/form-data" >
                    <label for="user">Full Name*:</label>
                    <input type="text" id="user" name="user" required>

                    <label for="type_of_service">Type of Service*:</label>
                    <select id="type_of_service" name="type_of_service" onchange="showOptions()" required>
                        <option value="">Select Service Type</option>
                        <option value="ICT">ICT Technical Assistance</option>
                        <option value="Email Creation">DepED Email Creation</option>
                        <option value="Email Reset">DepED Email Reset</option>
                    </select>

                    <!-- ICT Technical Assistance Options -->
                    <div id="ICT" style="display:none;">
                        <label for="ICT_service">Select the specific service*:</label>
                        <select id="ICT_service" name="service_options[]" onchange="showOptions()" >
                            <option value="">Select Specific Service Type*</option>
                            <option value="Computer Software Maintenance/Troubleshooting">Computer Software Maintenance/Troubleshooting</option>
                            <option value="Computer Hardware Maintenance/Troubleshooting">Computer Hardware Maintenance/Troubleshooting</option>
                            <option value="Information, Education and Communication (IEC) Materials">Information, Education and Communication (IEC) Materials</option>
                            <option value="Printer Maintenance">Printer Maintenance</option>
                            <option value="Technical Assistance to Trainings and Events">Technical Assistance to Trainings and Events</option>
                            <option value="Send Documents using Division Email">Send Documents using Division Email</option>
                        </select>
                    </div>

                    <!-- Specific Service Open-ended Questions -->
                    
                    <div id="Option1" style="display:none;">
                    <label> Assistance for Computer Maintenance/Troubleshooting</label>
                    <small>Provide assistance in maintaining and troubleshooting computer. 
                        Whether it's resolving glitches, updating applications, or optimizing system performance, we ensure your digital environment runs seamlessly.  
                        From diagnosing hardware issues to upgrading components, we offer reliable solutions that keep your systems running smoothly</small>

                        <label for="details1">Describe the software issue*:</label>
                        <textarea id="details1" name="details1" rows="4" cols="82" placeholder="Your answer" ></textarea>
                        
                    </div>

                    <div id="Option2" style="display:none;">
                    <label> Assistance for Computer Maintenance/Troubleshooting</label>
                    <small>Provide assistance in maintaining and troubleshooting computer. 
                        Whether it's resolving glitches, updating applications, or optimizing system performance, we ensure your digital environment runs seamlessly.  
                        From diagnosing hardware issues to upgrading components, we offer reliable solutions that keep your systems running smoothly</small>

                        <label for="details2">Describe the hardware issue*:</label>
                        <textarea id="details2" name="details2" rows="4" cols="82" placeholder="Your answer" ></textarea>
                        
                    </div>

                    <div id="Option3" style="display:none;">
                        <label> Creation of Information, Education and Communication Materials</label>
                        <small>Crafting impactful IEC materials is important in getting your target audience's attention. We design informative and engaging content that effectively conveys your message, whether it's for education, awareness, or communication purposes.</small>
                        <label for="details3"> What format is the material?:</label>
                <select id="details3" name="details3">
                    <option value="">Select a format</option>
                    <option value="Picture">Picture</option>
                    <option value="Video">Video</option>
                    <option value="Others">Others</option>
                </select>
                        <label for="details31">Title of the Material*:</label>
                        <textarea id="details31" name="details31" rows="4" cols="82" placeholder="Your answer"></textarea>
                        <label for="details32">Give further details to include in the material*:</label>
                        <textarea id="details32" name="details32" rows="4" cols="82" placeholder="Your answer"></textarea>

                    </div>

                    <div id="Option4" style="display:none;">
                    <label> Printer Maintenance</label>
                        <small>Keep your printing tasks hassle-free with our ICT technical assistance for printer maintenance. From routine upkeep to addressing printing errors, we ensure your printers run smoothly for optimal productivity.</small>

                        <label for="details4">What is the maker and model*:</label>
                        <small>Example: Epson L3110,  Brother DCP-T720DW</small>
                        <textarea id="details4" name="details4" rows="4" cols="82" placeholder="Your answer" ></textarea>
                        <label for="details41">Describe the issue encountered*:</label>
                        <textarea id="details41" name="details41" rows="4" cols="82" placeholder="Your answer" ></textarea>
                    </div>

                    <div id="Option5" style="display:none;">
                    <label> Technical Assistance to Trainings and Events </label>
                        <small>Elevate your events and training sessions with our technical expertise. We offer  support for audiovisual equipment and resources, ensuring your audience's focus remains on the content.</small>
            
                        
                        <label for="details5"> Venue*:</label>
                    <select id="details5" name="details5">
                        <option value="">Select a venue</option>
                        <option value="Onsite">Onsite</option>
                        <option value="Online">Online</option>
                    </select>
                        <label for="details51">Inclusive Dates of the Event*:</label>
                        <textarea id="details51" name="details51" rows="4" cols="82" placeholder="Your answer" ></textarea>

                        <label for="details52"> Time duration*:</label>
                        <small>Example 9:00AM to 11:00AM</small>
                        <textarea id="details52" name="details52" rows="4" cols="82" placeholder="Your answer" ></textarea>

                        <label for="details53"> If onsite, indicate the venue location*:</label>
                        <textarea id="details53" name="details53" rows="4" cols="82" placeholder="Your answer" ></textarea>

                    </div>

                    <div id="Option6" style="display:none;">
                    <label>Send documents to Official Email*:</label>
                    <small>Use this option to request sending official documents (e.g. letters, communication, and responses) to an individual or to other offices.

    For bulk documents, you may send it directly to ict.gentri@deped.gov.ph with the subject: ICT Service Request - Documents for Sending</small>

                        <label for="details6">Recipient's email*:</label>
                        <small>You may include multiple emails separated by commas (,). You may also include which emails to copy furnish using "cc:".</small>
                        <textarea id="details6" name="details6" rows="4" cols="82" placeholder="Your answer" ></textarea>

                        <label for="details61">Document for Sending (Skip this if a hardcopy is already provided to the ICT Unit or sent to an email.)*:</label>
                        <small>You may include multiple emails separated by commas (,). You may also include which emails to copy furnish using "cc:".</small>
                        <input type="file" id="details61" name="details61">
                    </div>   
                <!-- Email Reset Options -->
                <div id="Reset" style="display:none;">
    <label>Which account needs reset*:</label>
    <select name="ResetOption" onchange="showOptions()">
        <option value="">Select an account</option>
        <option value="Google Workplace and Microsoft 365">Google Workplace and Microsoft 365</option>
        <option value="Google Workplace">Google Workplace</option>
        <option value="Microsoft 365">Microsoft 365</option>
    </select>



                <!-- Open-ended question text area -->
        <label for="Reset_details1"> DepEd Email for Reset*:</label>
        <small>Double check the email for request. Only the correct format will be accepted.</small>
        <textarea id="Reset_details1" name="Reset_details1" rows="4" cols="82" placeholder="@deped.gov.ph"></textarea>

        <label for="Reset_details3"> School ID*:</label>
<select id="Reset_details3" name="Reset_details3" onchange="showOptions()">
    <option value="">Select an Option</option>
    <option value="SDO">SDO</option>
    <option value="107944">107944</option>
    <option value="107957">107957</option>
    <option value="164008">164008</option>
    <option value="107946">107946</option>
    <option value="107946">107946</option>
    <option value="107964">107964</option>
    <option value="107959">107959</option>
    <option value="107960">107960</option>
    <option value="107945">107945</option>
    <option value="107947">107947</option>
    <option value="107948">107948</option>
    <option value="107949">107949</option>
    <option value="107953">107953</option>
    <option value="107950">107950</option>
    <option value="107951">107951</option>
    <option value="107961">107961</option>
    <option value="107962">107962</option>
    <option value="107952">107952</option>
    <option value="107963">107963</option>
    <option value="107954">107954</option>
    <option value="164020">164020</option>
    <option value="107965">107965</option>
    <option value="107966">107966</option>
    <option value="164017">164017</option>
    <option value="107955">107955</option>
    <option value="107956">107956</option>
    <option value="107967">107967</option>
    <option value="307802">307802</option>
    <option value="301194">301194</option>
    <option value="307812">307812</option>
    <option value="307801">307801</option>
    <option value="307823">307823</option>
    <option value="307822">307822</option>
    <option value="301214">301214</option>
    <option value="301223">301223</option>
    <option value="342285">342285</option>
</select>

    <label for="Reset_details2"> Personal Email*:</label>
    <small>Use a Gmail or Yahoo account. The temporary password of the personnel will be sent to this email.</small>
        <textarea id="Reset_details2" name="Reset_details2" rows="4" cols="82" placeholder="Your answer"></textarea>
    
    </div>   

                <!-- Email Creation Options -->
                <div id="Creation" style="display:none;">
    <label>Email Provider*</label>
    <select name="CreationOption" onchange="showOptions()">
        <option value="">Select an option</option>
        <option value="Google Workplace and Microsoft 365">Google Workplace and Microsoft 365</option>
        <option value="Google Workplace">Google Workplace</option>
        <option value="Microsoft 365">Microsoft 365</option>
    </select>


                        <label for="Employee_Name"> Name of Employee*:</label>
                        <small>Type the full name of the personnel (First Name, Middle Initial, Surname, Suffix)</small>
                        <textarea id="Employee_Name" name="Employee_Name" rows="4" cols="82"placeholder="Your answer" ></textarea>
                        <label for="schoolid"> School ID*:</label>
<select id="schoolid" name="schoolid" onchange="showOptions()">
    <option value="">Select an Option</option>
    <option value="SDO">SDO</option>
    <option value="107944">107944</option>
    <option value="107957">107957</option>
    <option value="164008">164008</option>
    <option value="107946">107946</option>
    <option value="107946">107946</option>
    <option value="107964">107964</option>
    <option value="107959">107959</option>
    <option value="107960">107960</option>
    <option value="107945">107945</option>
    <option value="107947">107947</option>
    <option value="107948">107948</option>
    <option value="107949">107949</option>
    <option value="107953">107953</option>
    <option value="107950">107950</option>
    <option value="107951">107951</option>
    <option value="107961">107961</option>
    <option value="107962">107962</option>
    <option value="107952">107952</option>
    <option value="107963">107963</option>
    <option value="107954">107954</option>
    <option value="164020">164020</option>
    <option value="107965">107965</option>
    <option value="107966">107966</option>
    <option value="164017">164017</option>
    <option value="107955">107955</option>
    <option value="107956">107956</option>
    <option value="107967">107967</option>
    <option value="307802">307802</option>
    <option value="301194">301194</option>
    <option value="307812">307812</option>
    <option value="307801">307801</option>
    <option value="307823">307823</option>
    <option value="307822">307822</option>
    <option value="301214">301214</option>
    <option value="301223">301223</option>
    <option value="342285">342285</option>
</select>
    <label for="plantilla_position"> Plantilla Position*:</label>
    <small>Please indicate the full position and no abbreviations 
    (example: Administrative Assistant III, Administrative Aide VI, Public Schools District Supervisor)</small>
        <textarea id="plantilla_position" name="plantilla_position" rows="4" cols="82"placeholder="Your answer" ></textarea>

    <label for="personal_email"> Personal Email*:</label>
    <small>Use a Gmail or Yahoo account. The account details will be sscent to this email.
    </small>
        <textarea id="personal_email" name="personal_email" rows="4" cols="82"placeholder="Your answer" ></textarea>

    <label for="personal_number"> Personal Phone Number*:</label>
    <small>This will be used for self-service password reset.</small>
        <textarea id="personal_number" name="personal_number" maxlength="13" rows="4" cols="82" placeholder="Your answer" ></textarea>
    
                    </div>  
            <div class="submit-container">
  <input type="submit" value="Submit">
  <a href="homepage.php" class="back-button">Back to Homepage</a>
</div>
        </form>
        <footer>
            <p>Let's Join Forces: Sa GenTri, Edukasyon ay Sulit mula sa Serbisyong may Malasakit<br>#GalingGenTriGalingGenTri</p>
            <div class="footer-logos">
                <img src="images/logos.png" alt="DepEd Logo" class="footer-logo">
            </div>
        </footer>
    </div>
</body>
</html>