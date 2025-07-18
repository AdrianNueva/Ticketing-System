<?php
include 'db.php';

$submissionSuccess = false; // Flag to track submission status

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = mysqli_real_escape_string($conn, $_POST['user']);
    $type_of_service = mysqli_real_escape_string($conn, $_POST['type_of_service']);

    if (empty($user) || empty($type_of_service)) {
        echo "User and service type are required.";
        exit();
    }

    // Initialize service details
    $service_details = '';

    // Handle ICT Technical Assistance options
    if ($type_of_service == "ICT") {
        if (isset($_POST['service_options'])) {
            $service_options = $_POST['service_options'];
            $specific_service = implode(", ", $service_options);

            if (isset($_POST['details1']) && !empty($_POST['details1'])) {
                $details1 = mysqli_real_escape_string($conn, $_POST['details1']);

                $service_details .= "Computer Software Maintenance | Software Issue: " . $details1 . "";
            }

            if (isset($_POST['details2']) && !empty($_POST['details2'])) {
                $details2 = mysqli_real_escape_string($conn, $_POST['details2']);
                
                $service_details .= "Computer Hardware Maintenance | Hardware Issue: " . $details2 . " ";
            }
            if (isset($_POST['details3']) && !empty($_POST['details3'])) {
                $IEC = $_POST['details3'];
                $details31 = mysqli_real_escape_string($conn, $_POST['details31']); // Title of the Material
                $details32 = mysqli_real_escape_string($conn, $_POST['details32']); // Further details
                
                // Construct the service details string
                $service_details .= "Creation of IEC Materials | Format: " . $IEC . " | Title: " . $details31 . " | Further details: " . $details32 . " ";
            } else {
                // Handle the case where no checkbox is selected
                $details_options = ""; // Or provide a default value if needed
            }
            
            if (isset($_POST['details4']) && !empty($_POST['details4'])) {
                $details4 = mysqli_real_escape_string($conn, $_POST['details4']);
                $details4_1 = isset($_POST['details41']) ? mysqli_real_escape_string($conn, $_POST['details41']) : '';
                $service_details .= "Printer Maintenance | Maker and Model: " . $details4 . " | Issue: " . $details4_1 . " ";
            }
            
            if (isset($_POST['details5']) && !empty($_POST['details5'])) {
                $TA = $_POST['details5'];
                $details5_1 = isset($_POST['details51']) ? mysqli_real_escape_string($conn, $_POST['details51']) : '';
                $details5_2 = isset($_POST['details52']) ? mysqli_real_escape_string($conn, $_POST['details52']) : '';
                $details5_3 = isset($_POST['details53']) ? mysqli_real_escape_string($conn, $_POST['details53']) : '';
                $service_details .= "Technical Assistance | Venue: " . $TA . " | Dates: " . $details5_1 . " | Duration: " . $details5_2 . " | Location: " . $details5_3 . " ";
            }  

            if (isset($_POST['details6']) && !empty($_POST['details6'])) {
                $details6 = mysqli_real_escape_string($conn, $_POST['details6']);
                
                // Handle file upload
                $details6_1 = "No file uploaded";
                if (isset($_FILES['details61']) && $_FILES['details61']['error'] == 0) {
                    $file_name = mysqli_real_escape_string($conn, $_FILES['details61']['name']);
                    $file_tmp = $_FILES['details61']['tmp_name'];
                    // Directory to upload files
                    $upload_dir = "uploads/";
                 $upload_file = $upload_dir . basename($file_name);
                    
                    if (move_uploaded_file($file_tmp, $upload_file)) {
                        $details6_1 = $file_name;  // Store the filename
                    } else {
                        $details6_1 = "Error uploading file";
                    }
                $service_details .= "Send documents to Official Email | Recipient email: " . $details6 . " | Document for Sending: " . $details6_1 ."";
                }
            }
        }
    } elseif ($type_of_service == "Email Reset") {
        $reset_options = isset($_POST['ResetOption']) ? $_POST['ResetOption'] : '';
        $resetDetails1 = mysqli_real_escape_string($conn, $_POST['Reset_details1']);
        $resetDetails3 = isset($_POST['Reset_details3']) ? $_POST['Reset_details3'] : '';
        $resetDetails2 = mysqli_real_escape_string($conn, $_POST['Reset_details2']);


        $service_details = "Reset Options: " . $reset_options . " | DepED email for Reset: " . $resetDetails1 . " | SchoolID: " . $resetDetails3 . " | Personal Email: " . $resetDetails2;
    } elseif ($type_of_service == "Email Creation") {
        $creation_options = isset($_POST['CreationOption']) ? $_POST['CreationOption'] : '';
        $employeeName = mysqli_real_escape_string($conn, $_POST['Employee_Name']);
        $SchoolID = isset($_POST['schoolid']) ? $_POST['schoolid'] : '';
        $plantillaPosition = mysqli_real_escape_string($conn, $_POST['plantilla_position']);
        $personalEmail = mysqli_real_escape_string($conn, $_POST['personal_email']);
        $personalNumber = mysqli_real_escape_string($conn, $_POST['personal_number']);

        $service_details = "Creation Options: " . $creation_options . " | Employee Name: " . $employeeName . " | SchoolID: " . $SchoolID . " | Plantilla Position: " . $plantillaPosition . " | Personal Email: " . $personalEmail . " | Personal Number: " . $personalNumber;
    }

    // Insert into the database
    $sql = "INSERT INTO requests (user, type_of_service, service_details) VALUES ('$user', '$type_of_service', '$service_details')";

    if (mysqli_query($conn, $sql)) {
        $submissionSuccess = true;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Submission</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: url('images/matatag.jpeg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            color: #333;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            width: 90%;
            max-width: 600px;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 40px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #104481;
            margin-bottom: 20px;
        }
        p {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
        }
        .back-button {
            padding: 10px 20px;
            background-color: #206F3C;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            display: inline-block;
        }
        .back-button:hover {
            background-color: #0d3a6a;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($submissionSuccess): ?>
            <h1>Request Submitted</h1>
            <p>Your request has been submitted successfully.</p>
            <a href="index.php" class="back-button">Back to Form</a>
        <?php else: ?>
            <h1>Error Submitting Request</h1>
            <p>There was an issue with your submission. Please try again.</p>
            <a href="index.php" class="back-button">Back to Form</a>
        <?php endif; ?>
    </div>
</body>
</html>
