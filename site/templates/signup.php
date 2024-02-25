<?php snippet('header') ?>

<main class="main content-container index">

    <section id="col1" class="intro" style="max-width: 60ch;">
        <p>
            Sign up to our very special, very weird SMS
            newsletter. Intimate and candid connections with the quirky festival cohort, sent straight from the Audible Edge burner phone. No spam - just the occasional bit of mail art in your messaging app, especially around gig time. You can unsubscribe any time.
        </p>


    </section>

    <section id="col2" class="description" style="max-width: 60ch;">
        <details>
            <summary>Privacy and Data Protection</summary>
            <p>
                Tone List respects your privacy and is committed to protecting your personal data. The personal information you submit here, including your preferred name and phone number, will only be used for sending you our SMS newsletter and related communications about the Audible Edge festival.
            </p>
            <p>
                Your data will be securely stored on a private SQL server and retained only for the duration necessary to fulfill these purposes, not exceeding the conclusion of the Audible Edge festival. We implement appropriate technical and organizational measures to ensure a level of security appropriate to the risk.
            </p>
            <p>
                We will not share your personal data with any third parties without your explicit consent, except as required by law. You have the right to access, correct, or delete your personal data, and to restrict or object to its processing. You also have the right to data portability.
            </p>
            <p>
                If you wish to exercise any of these rights or have any questions about our privacy practices, please contact us at [your contact information]. You have the right to lodge a complaint with a supervisory authority if you believe we have not complied with the requirements of the GDPR or other data protection laws.
            </p>
            <p>
                By submitting your personal information, you acknowledge that you have read and understood this privacy statement and agree to the use of your data as outlined above.
            </p>
        </details>
    </section>

    <section id="col3" class="form">
        <div class="sms_form">
            <form method="post" action="<?= $page->url() ?>">
                <div class="field-group">
                    <div class="field">
                        <!-- <label for="name">Preferred Name</label><br> -->
                        <input type="text" id="name" name="name" required placeholder="Preferred Name">
                    </div>
                </div>
                <div class="field-group">
                    <!-- <label for="number">Phone</label><br>  -->
                    <div class="field">
                        <input type="tel" id="number" name="number" required placeholder="Phone">
                    </div>
                </div>


                <?php
                //Implement CSRF protection

                //csrf_field();
                //honeypot_field(); 
                ?>

                <!-- <button type="submit">Submit</button> -->
                <div class="pseudo-list-item">
                    <input class="button__link" type="submit" name="submit" value="Submit">
                </div>
            </form>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = ($_POST["name"]);
                $number = ($_POST["number"]);
                $dateAdded = date('Y-m-d H:i:s');

                // Database connection parameters
                $host = 'localhost';
                $username = '***REMOVED***_ae24';
                $password = 'kk6aGGh7GrRdmCU';
                $database = '***REMOVED***_audible_edge_2024';
                $usertable = "users";

                $conn = mysqli_connect($host, $username, $password, $database);

                // Check connection
                if ($conn === false) {
                    die("Error: could not connect. " . mysqli_connect_error());
                }

                $sql = "INSERT INTO $usertable (name, phone, date_added) VALUES ('$name', '$number', '$dateAdded');";

                if (mysqli_query($conn, $sql)) {
                    echo '<div class="form-container"><p class="form-text">Records successfully added!</p><p class="form-text">Welcome to the Audible Edge text line.</p></div>';
                } else {
                    echo '<div class="form-container"><p class="form-text">ERROR: Unable to execute $sql.</p></div>' . mysqli_error($conn);
                }

                mysqli_close($conn);

                // $config = include kirby()->root('config') . '/db.php';
                //// Create a connection
                // $conn = new mysqli($config['host'], $config['username'], $config['password'], $config['database']);

                // $conn = new mysqli($host, $username, $password, $database);

                //// Check connection
                // if ($conn->connect_error) {
                //     die("Connection failed: " . $conn->connect_error);
                // } 
            }
            ?>
            <?php

            // if (isset($_POST['name'], $_POST['phone'])) {
            //     $name = mysqli_real_escape_string($conn, $_POST['name']);
            //     $phone = mysqli_real_escape_string($conn, $_POST['phone']);
            //     $dateAdded = date('Y-m-d H:i:s'); // Current date and time

            //     // Prepare statement with `date_added`
            //     $stmt = $conn->prepare("INSERT INTO users (name, phone, date_added) VALUES (?, ?, ?)");
            //     $stmt->bind_param("sss", $name, $phone, $dateAdded); // 'sss' indicates three string parameters

            //     // Execute and check success
            //     if ($stmt->execute()) {
            //         echo "New record created successfully";
            //     } else {
            //         echo "Error: " . $stmt->error;
            //     }

            //     $stmt->close();
            // }
            // $conn->close();
            ?>
        </div>
    </section>
</main>
<?php snippet('footer') ?>