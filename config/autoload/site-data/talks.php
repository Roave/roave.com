<?php
$talks = [];

$talks['event-sourcing'] = [
    'title' => 'Event Sourcing: The good, the bad and the complicated',
    'presenter' => 'Marco Pivetta',
    'events' => [
        [
            'name'   => 'WebCamp Zagreb 2016',
            'joindin' => 'e33ae',
        ],
        [
            'name'   => 'ZendCon 2016',
            'joindin' => '67533',
        ],
        [
            'name'   => 'Dutch PHP Conference 2016',
            'joindin' => '41438',
        ],
        [
            'name'   => 'PHPUGFFM III/2016',
            'joindin' => '4df55',
        ],
    ],
];
$talks['event-sourcing']['abstract'] = <<<str
    <p>Event Sourcing can look like an attractive solution for any of your applications, but does it actually pay off?</p>

    <p>What if it is all just buzzwords and no gain?</p>

    <p>We’ll look at how we implemented event sourcing in our own app, code-reviews.io:</p>

    <ul>
        <li>what made us fast</li>
        <li>What made us super slow</li>
        <li>What made us cry</li>
    </ul>
str;


$talks['defensive-php'] = [
    'title' => 'Extremely Defensive PHP Programming',
    'presenter' => 'Marco Pivetta',
    'events' => [
        [
            'name'   => 'ZendCon 2016',
            'joindin' => '96b93',
        ],
        [
            'name'   => 'Dutch PHP Conference 2016',
            'joindin' => 'ee2bb',
        ],
        [
            'name'   => 'PHP South Coast Conference 2016',
            'joindin' => '77f23',
        ],
        [
            'name'   => 'PHPKonf Instanbul PHP Conference 2016',
            'joindin' => 'f62c4',
        ],
    ],
];
$talks['defensive-php']['abstract'] = <<<str
    <p>Resistant, highly testable, safe and maintainable code... or not?</p>

    <p>There are a thousand ways to break your code, and a lot of ways to prevent that from happening.</p>

    <p>Let's explore defensive programming and learn how to protect our code from invalid usage.</p>
str;


$talks['modern-ibmi'] = [
    'title' => 'Bringing Modern PHP Development to IMB i',
    'presenter' => 'James Titcumb',
    'events' => [
        [
            'name'   => 'ZendCon 2016',
            'joindin' => 'e425e',
        ],
    ],
];
$talks['modern-ibmi']['abstract'] = <<<str
    <p>Zend Server for IBM i has done a great job at allowing enterprise PHP applications to run smoothly on the IBM i platform. But what about developing for the platform? Having recently been hired for a PHP project on IBM i, we wanted to ensure the project was using the best practices possible. This involved embarking on a whole new collaborative journey - uniting expert platform knowledge with bleeding-edge modern PHP development practices. We'll show you the process our team went through on the project to revolutionize the client's development process by introducing database abstraction, unit tests, functional tests, continuous integration, automated deployment, and more.</p>
str;

return [
    'talks' => $talks,
];
