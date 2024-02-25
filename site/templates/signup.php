<?php snippet('header') ?>
<style>
    .form-container {
        padding: 8% 0 0;
        margin: auto;
        background-color: var(--cc-bg);

        max-width: 525px;
        min-height: 300px;
        margin-top: 100px;
        position: relative;
        border: 2px solid var(--cc-primary);
    }

    .form-text {
        max-width: 300px;
        position: relative;
        margin: auto;

        width: 100%;
        margin-bottom: 10px;
        background: rgba(0, 0, 0, 0.3);
        border: none;
        outline: none;
        color: #fff;
        text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3);
        /* border: 1px solid rgba(0, 0, 0, 0.3); */
    }
</style>

<main class="main content-container index">

    <section id="col1" class="intro" style="max-width: 60ch;">

    </section>

    <section id="col2" class="description" style="max-width: 60ch;">

    </section>

    <section id="col3" class="form" style="max-width: 60ch;">
        <div class="sms_form">
            <form method="post" action="<?= $page->url() ?>">
                <label for="name">Preferred Name</label>
                <input type="text" id="name" name="name" required>

                <label for="phone">Phone</label>
                <input type="tel" id="phone" name="phone" required>


                <?php
                //Implement CSRF protection

                //csrf_field();
                //honeypot_field(); 
                ?>

                <button type="submit">Submit</button>
            </form>
            <?php
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
                echo '<div class="form-container"><p class="form-text"> Records successfully added! Welcome to the Audible Edge 2022 text line.</p></div>';
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