<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input function
    function clean_input($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    // Get input values
    $orgName = clean_input($_POST['orgName'] ?? '');
    $engagement = clean_input($_POST['engagement'] ?? '');
    $yourName = clean_input($_POST['yourName'] ?? '');

    // Ratings
    $ratings = [];
    for ($i = 1; $i <= 9; $i++) {
        $key = 'q' . $i;
        $ratings[$key] = clean_input($_POST[$key] ?? 'No Response');
    }

    // Comments
    $pleased = clean_input($_POST['pleased'] ?? '');
    $changes = clean_input($_POST['changes'] ?? '');
    $comments = clean_input($_POST['comments'] ?? '');
    $testimonial = clean_input($_POST['testimonial'] ?? '');

    // Save to CSV
    $data = [
        $orgName, $engagement, $yourName,
        $ratings['q1'], $ratings['q2'], $ratings['q3'], $ratings['q4'],
        $ratings['q5'], $ratings['q6'], $ratings['q7'], $ratings['q8'], $ratings['q9'],
        $pleased, $changes, $comments, $testimonial
    ];

    $file = 'feedback_data.csv';
    $header = [
        'Organisation Name', 'Engagement Type', 'Your Name & Designation',
        'Q1', 'Q2', 'Q3', 'Q4', 'Q5', 'Q6', 'Q7', 'Q8', 'Q9',
        'Pleased', 'Changes', 'Comments', 'Testimonial'
    ];

    $file_exists = file_exists($file);
    if (($fp = fopen($file, 'a')) !== false) {
        if (!$file_exists) {
            fputcsv($fp, $header);
        }
        fputcsv($fp, $data);
        fclose($fp);
    } else {
        echo "<h2>Error saving data. Please try again later.</h2>";
        exit();
    }

    // ---------- Email Notification ----------
    $to = "girkarvinit2002@gmail.com";  // Change to your email
    $subject = "New Client Feedback Received";
    $message = "You have received new feedback from the Riskpro India Feedback Form:\n\n";
    $message .= "Organisation Name: $orgName\n";
    $message .= "Engagement Type: $engagement\n";
    $message .= "Name & Designation: $yourName\n\n";

    foreach ($ratings as $q => $ans) {
        $message .= strtoupper($q) . ": $ans\n";
    }

    $message .= "\nPleased With: $pleased\n";
    $message .= "Changes Suggested: $changes\n";
    $message .= "Other Comments: $comments\n";
    $message .= "Testimonial: $testimonial\n";

    $headers = "From: feedback@yourdomain.com";  // Change to a valid sender address

    // Send email
    mail($to, $subject, $message, $headers);

    // ---------- Confirmation HTML ----------
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Feedback Submitted</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background: #f0f8ff;
                padding: 40px;
                text-align: center;
                color: #333;
            }
            a {
                display: inline-block;
                margin-top: 20px;
                padding: 10px 20px;
                background-color: #5a8dee;
                color: white;
                text-decoration: none;
                border-radius: 5px;
            }
            a:hover {
                background-color: #3a6edc;
            }
        </style>
    </head>
    <body>
        <h2>Thank you for your feedback, <?php echo htmlspecialchars($yourName); ?>!</h2>
        <p>Your response has been recorded and emailed successfully.</p>
        <a href="Feedback_Form.html">Submit another response</a>
    </body>
    </html>
    <?php
} else {
    header("Location: Feedback_Form.html");
    exit();
}
?>
<?php
// End of submit.php
