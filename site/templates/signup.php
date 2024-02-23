<?php snippet('header') ?>

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
            $config = include kirby()->root('config') . '/db.php';

            $host = 'localhost'; // This might be different for Crazy Domains
            $username = '***REMOVED***_ae24';
            $password = 'kk6aGGh7GrRdmCU';
            $database = '***REMOVED***_audible_edge_2024';


            // Create a connection
            $conn = new mysqli($config['host'], $config['username'], $config['password'], $config['database']);

            // $conn = new mysqli($host, $username, $password, $database);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } ?>
            <?php if (isset($_POST['name'], $_POST['phone'])) {
                $name = mysqli_real_escape_string($conn, $_POST['name']);
                $phone = mysqli_real_escape_string($conn, $_POST['phone']);
                $dateAdded = date('Y-m-d H:i:s'); // Current date and time

                // Prepare statement with `date_added`
                $stmt = $conn->prepare("INSERT INTO users (name, phone, date_added) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $name, $phone, $dateAdded); // 'sss' indicates three string parameters

                // Execute and check success
                if ($stmt->execute()) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
            }
            $conn->close();
            ?>
        </div>
    </section>
</main>
<?php snippet('footer') ?>