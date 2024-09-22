<?php
$servername = "localhost";
$username = "u707137586_EV_Reg_T1_24";
$password = "DMKL0IYoP&4";
$dbname = "u707137586_EV_Reg_2024_T1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name, email, score, percentage FROM test WHERE percentage > 40 AND percentage < 96 AND emailSent = false";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $name = $row['name'];
        $recipient_email = $row['email'];
        $score = $row['score'];
        $percentage = $row['percentage'];

        $message = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f9f9f9;
                    color: #333;
                    padding: 20px;
                }
                .container {
                    background-color: #fff;
                    max-width: 600px;
                    margin: 20px auto;
                    padding: 20px;
                    border-radius: 10px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
                h2 {
                    color: #4CAF50;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-bottom: 20px;
                }
                table, th, td {
                    border: 1px solid #ddd;
                }
                th, td {
                    padding: 10px;
                    text-align: left;
                }
                .highlight {
                    color: #000000;
                    font-weight: bold;
                }
                .cta {
                    padding: 10px;
                    background-color: #4CAF50;
                    color: white;
                    text-align: center;
                    border-radius: 5px;
                    width: 200px;
                    text-decoration: none;
                    display: inline-block;
                    font-weight: bold;
                }
                .linkedin-link {
                    display: inline-block;
                    padding: 10px;
                    background-color: #0077B5;
                    color: white;
                    text-decoration: none;
                    border-radius: 5px;
                    font-weight: bold;
                }
                .visionastraa-list {
                    padding-left: 20px;
                    text-align: left;
                    margin-left: 16px;
                }

                .visionastraa-list li {
                    margin-bottom: 10px;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <p>Hello ' . htmlspecialchars($name) . ',</p>
                <p><b>Thank you very much for your interest in applying for our open positions for VisionAstraa EV Startup.</b></p>
                <p>Your Score from the recently conducted <b>Online Skill Assessment Test for VisionAstraa EV Startup</b> is:</p>
                <h2 class="highlight">' . htmlspecialchars($score) . '</h2>
                <p><b>We received over 5000+ applications from candidates across India.</b></p>
                <p>Only the candidates with scores above 95 are being considered for the next round of technical Interviews for our EV Startup.</p>
                <p>At this point, you havent cleared the cut-off required for moving on to the next round.</p>
                <h3>Criteria</h3>
                <table>
                    <tr>
                        <th>Marks</th>
                        <th>Status</th>
                    </tr>
                    <tr>
                        <td>96-100</td>
                        <td>Qualified for Next Round</td>
                    </tr>
                    <tr>
                        <td>71-95</td>
                        <td>Good, but failed to make cut. Can be considered after upskilling</td>
                    </tr>
                    <tr>
                        <td>41-70</td>
                        <td>Pass, but upskilling required</td>
                    </tr>
                    <tr>
                        <td>0-40</td>
                        <td>Failed</td>
                    </tr>
                </table>
                <p>************************************************************************</p>
                <p><b>Your Journey in EV Industry doesnt have to stop here!</b></p>
                <img src="https://www.visionastraa.com/image/ev-apply-email.png" alt="Upskill in EV Technologies" style="width:100%; max-width:600px;">
                <p>For candidates who are really serious about building a career in EV Industry, we have an 16-week <b>EV Powertrain Mastery Program</b> in Bengaluru.</p>
                <p><b>We have a small intake of only 60, with limited seats for the thousands of applications we received nationwide.</b></p>
                <p>Our next batch starts mid-October, reserve your seat today!</p>
                <a href="https://www.visionastraa.com/ev-application.html" style="padding: 10px; background-color: #4CAF50; color: white; text-align: center; border-radius: 5px; width: 200px; text-decoration: none; display: inline-block; font-weight: bold;">Apply Now</a>
                <p><b><u>Placements</u></b></p>
                <p>100% Placement from 2 ways:</p>
                <ol class="visionastraa-list">
                    <li>Top students from EV Academy would be absorbed in VisionAstraa EV Startup!</li>
                    <li>Top EV companies from India and abroad will be recruiting our upskilled students.</li>
                </ol>
                <p>For more details on the program, modules, mentors & potential recruiters, you can check our <a href="https://drive.google.com/file/d/1HJKflv-SE8R8_P4vkXeWw8N-cjSMfW_n/view?usp=sharing">Brochure</a> & <a href="https://www.visionastraa.com/ev-home.html">Website</a></p>
                <p>For any questions & further info, connect with us on LinkedIn:</p>
                <a href="https://www.linkedin.com/company/va-ev-academy" style="display: inline-block; padding: 10px; background-color: #0077B5; color: white; text-decoration: none; border-radius: 5px; font-weight: bold;">Follow us on LinkedIn</a>
                <br><br>
                <p>--</p>
                <p>Thanks,<br>Recruitment Team<br><a href="https://www.linkedin.com/company/visionastraa/">VisionAstraa Group</a></p>
            </div>
        </body>
        </html>';

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: VisionAstraa Group <visionastra360@gmail.com>" . "\r\n";

        if (mail($recipient_email, "Your EV Startup Assessment Result", $message, $headers)) {
            $update_sql = "UPDATE test SET emailSent = true WHERE email = '$recipient_email'";
            $conn->query($update_sql);
            echo "Email sent to " . htmlspecialchars($recipient_email) . "<br>";
        } else {
            echo "Failed to send email to " . htmlspecialchars($recipient_email) . "<br>";
        }
    }
} else {
    echo "No eligible recipients found.";
}

$conn->close();
?>
