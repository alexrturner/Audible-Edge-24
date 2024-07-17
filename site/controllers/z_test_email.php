<?php
// controllers/z_test_email.php
// This is a test controller to check if the email form is working

return function ($kirby, $pages, $page) {

    $alert = null;

    if ($kirby->request()->is('POST') && get('submit')) {
        dump($_POST); // check if you get into this if-statement at all
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

        // some of the data is invalid
        if ($invalid = invalid($data, $rules, $messages)) {
            $alert = $invalid;

            // the data is fine, let's send the email
        } else {
            dump($data);
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
                    $alert['error'] = 'The form could not be sent: ' . $error->getMessage();
                else :
                    $alert['error'] = 'The form could not be sent!';
                endif;
            }

            // no exception occurred, let's send a success message
            if (empty($alert) === true) {
                $success = 'Your message has been sent, thank you. We will get back to you soon!';
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
