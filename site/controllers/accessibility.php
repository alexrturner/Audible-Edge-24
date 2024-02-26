<?php
return function ($kirby, $pages, $page) {

    $alert = null;

    if ($kirby->request()->is('POST') && get('submit')) {

        // check the honeypot
        if (empty(get('website')) === false) {
            go($page->url());
            exit;
        }

        $data = [
            'name'  => get('name'),
            'pronouns' => get('pronouns'),
            'email' => get('email'),
            'phone' => get('phone'),
            'text'  => get('text')
        ];

        $rules = [
            'name'  => [],
            'pronouns' => [],
            'email' => ['email'],
            'phone' => ['phone'],
            'text'  => ['minLength' => 3, 'maxLength' => 3000],
        ];

        $messages = [
            'name'  => 'Please enter your name',
            'pronouns' => 'Please enter your pronouns',
            'email' => 'Please enter a valid email address',
            'phone' => 'Please enter a valid phone number',
            'text'  => 'Please enter your accessibility request'
        ];

        // ivalid data
        if ($invalid = invalid($data, $rules, $messages)) {
            $alert = $invalid;

            // valid data, send email
        } else {
            $host = 'localhost';
            $username = '***REMOVED***_ae24';
            $password = 'kk6aGGh7GrRdmCU';
            $database = '***REMOVED***_audible_edge_2024';
            $table = "accessibility_requests";

            $conn = mysqli_connect($host, $username, $password, $database);

            // Check connection
            if ($conn === false) {
                die("Error: could not connect. " . mysqli_connect_error());
            }


            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO $table (name, pronouns, email, phone, text) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $data['name'], $data['pronouns'], $data['email'], $data['phone'], $data['text']);


            // $sql = "INSERT INTO $table (name, phone, date_added) VALUES ('$name', '$number', '$dateAdded');";

            // if (mysqli_query($conn, $sql)) {
            //     echo '<div class="form-container"><p class="form-text">Records successfully added!</p><p class="form-text">Welcome to the Audible Edge text line.</p></div>';
            // } else {
            //     echo '<div class="form-container"><p class="form-text">ERROR: Unable to execute $sql.</p></div>' . mysqli_error($conn);
            // }

            // $stmt->close();
            // $conn->close();
            mysqli_close($conn);

            try {
                $kirby->email([
                    'template' => 'email',
                    'from'    => '***REMOVED***',
                    'replyTo'  => $data['email'],
                    'to'       => '***REMOVED***',
                    'subject'  => esc($data['name']) . ' (' . esc($data['pronouns']) . ') sent you an accessibility request via the AE website.',
                    'data'     => [
                        'text'   => esc($data['text']),
                        'sender' => esc($data['name'])
                    ]
                ]);
            } catch (Exception $error) {
                if (option('debug')) :
                    $alert['error'] = 'The form could not be sent: <strong>' . $error->getMessage() . '</strong>';
                else :
                    $alert['error'] = 'The form could not be sent!';
                endif;
            }

            // no exception occurred, send a success message
            if (empty($alert) === true) {
                $success = 'Your message has been sent, thank you. The Tone List team will get back to you soon.';
                $data = [];
            }
        }
    }

    return [
        'alert'   => $alert,
        'data'    => $data ?? false,
        'success' => $success ?? false
    ];
};
