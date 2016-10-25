<?php
$talks = [];

$talks['better-reflection'] = [
    'title' => 'Mirror, Mirror on the Wall: Building a New PHP Reflection Library',
    'presenter' => 'James Titcumb',
    'rating' => 5,
    'events' => [
        [
            'name'   => 'Nomad PHP EU October 2016',
            'joindin' => false,
        ],
        [
            'name' => 'Dutch PHP Conference 2016',
            'joindin' => 'eb95d',
        ],
        [
            'name' => 'PHPBenelux Conference 2016',
            'joindin' => '9a5d8',
        ],
        [
            'name' => 'Nomad PHP US December 2015',
            'joindin' => '57214',
        ],
        [
            'name' => 'PHPem Unconference 2015',
            'joindin' => '0fb1e',
        ],
    ],
];
$talks['better-reflection']['abstract'] = <<<str
<p>Have you ever used PHP’s built in reflection, only to find you can’t do quite what you wanted? What about finding types for parameters or properties? What about reflecting on classes that aren’t loaded, so that you can modify them directly?</p>

<p>Better Reflection is an awesome new library that uses magical time-warp techniques* to improve on PHP’s built-in reflection by providing additional functionality. In this talk we’ll cover what reflection is all about, explore the cool features of Better Reflection already implemented, the difficulties we faced actually writing the thing, and how you can use Better Reflection in your projects to maximise your reflection-fu.</p>

<p>(*actual magic or time-warp not guaranteed)</p>
str;

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
        [
            'name'   => 'PHPSW: Coding Practices 2015',
            'joindin' => '8d81c',
        ],
    ],
];
$talks['defensive-php']['abstract'] = <<<str
    <p>Resistant, highly testable, safe and maintainable code... or not?</p>

    <p>There are a thousand ways to break your code, and a lot of ways to prevent that from happening.</p>

    <p>Let's explore defensive programming and learn how to protect our code from invalid usage.</p>

<iframe width="300" height="169" src="https://www.youtube-nocookie.com/embed/rzGeNYC3oz0?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
str;


$talks['modern-ibmi'] = [
    'title' => 'Bringing Modern PHP Development to IMB i',
    'presenter' => 'James Titcumb',
    'rating' => 5,
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

$talks['expressive-doctrine'] = [
    'title' => 'Kicking off with Zend Expressive and Doctrine ORM',
    'presenter' => 'James Titcumb',
    'rating' => 4,
    'events' => [
        [
            'name'   => 'ZendCon 2016',
            'joindin' => '7e95d',
        ],
        [
            'name'   => 'PHP North West 2016',
            'joindin' => 'ff04f',
        ],
    ],
];
$talks['expressive-doctrine']['abstract'] = <<<str
    <p>You've heard of the new Zend framework, Expressive, and you've heard it's the new hotness. In this talk, I will introduce the concepts of Expressive, how to bootstrap a simple application with the framework using best practices, and how to integrate a third party tool like Doctrine ORM.</p>
str;


$talks['sea-of-securit'] = [
    'title' => 'Dip Your Toes in the Sea of Security',
    'presenter' => 'James Titcumb',
    'rating' => 5,
    'events' => [
        [
            'name'    => 'PHP North West 2016',
            'joindin' => 'a1a05',
        ],
        [
            'name'    => 'phpDay 2016',
            'joindin' => 'fc2dc',
        ],
        [
            'name'    => 'PHP UK Conference 2016',
            'joindin' => 'c2bb0',
        ],
        [
            'name'    => 'PHPMiNDS January 2016',
            'joindin' => '0ad74',
        ],
        [
            'name'    => 'PHP Berkshire - November 2015',
            'joindin' => 'd91f9',
        ],
        [
            'name'    => 'Dutch PHP Conference 2015',
            'joindin' => '516ed',
        ],
        [
            'name'    => 'PHP Dorset UG June 2014',
            'joindin' => '71f93',
        ],
    ],
];
$talks['sea-of-securit']['abstract'] = <<<str
    <p>Security is an enormous topic, and it’s really, really complicated. If you’re not careful, you’ll find yourself vulnerable to any number of attacks which you definitely don’t want to be on the receiving end of. This talk will give you just a taster of the vast array of things there is to know about security in modern web applications, such as writing secure PHP web applications and securing a Linux server. Whether you are writing anything beyond a basic brochure website, or even developing a complicated business web application, this talk will give you insights to some of the things you need to be aware of.</p>
str;

$talks['tuning-nginx'] = [
    'title' => 'Tuning Nginx and PHP-FPM… The Right Way.',
    'presenter' => 'Evan Coury',
    'rating' => 5,
    'events' => [
        [
            'name'   => 'SunshinePHP 2015',
            'joindin' => '0f8ca',
        ],
        [
            'name'   => 'Nomad PHP US December 2014',
            'joindin' => '9ebef',
        ],
        [
            'name'   => 'ZendCon 2014',
            'joindin' => '9f3a9',
        ],
    ],
];
$talks['tuning-nginx']['abstract'] = <<<str
    <p>More and more large companies and websites are switching over to Nginx + PHP-FPM for increased performance and more efficient resource utilization. When properly tuned, this duo can be a perfect match for high traffic situations. However, it only takes one small oversight in the configuration to bring your site to a grinding halt under high load. Join Evan Coury, owner of Roave, as he shares all of his tips and tricks learned throughout years of high scalability consulting and running several extremely high traffic websites. We’ll cover how to optimally tune PHP-FPM worker pools, sysctl, and Nginx to get the most out of your servers. Additionally, we’ll cover adding additional capacity to handle traffic spikes, load balancing, and more.</p>
str;


$talks['maintainable-zf2-apps'] = [
    'title' => 'Writing Maintainable ZF2 Applications',
    'presenter' => 'Evan Coury',
    'rating' => 5,
    'events' => [
        [
            'name'   => 'php[world] 2014',
            'joindin' => '6330e',
        ],
        [
            'name'   => 'ZendCon 2014',
            'joindin' => 'c6845',
        ],
        [
            'name'   => 'SunshinePHP 2014',
            'joindin' => '7fe67',
        ],
        [
            'name' => 'Web & PHP Conference 2013',
            'joindin' => 'f0cf8',
        ],
    ],
];
$talks['maintainable-zf2-apps']['abstract'] = <<<str
    <p>Zend Framework 2 provides a lot of great tools and resources to help developers build quality applications. However, a lot of important architectural decisions are still left to the developer. What belongs in the controllers? What’s a service layer and why should you have one? What the %*$# is a model, really? In this session, Evan Coury, author of the new ZF2 module system, will lift the fog on all of these concepts, showing you how to use them to create a more maintainable and well architectured ZF2 application, while keeping the technical debt to a minimum.</p>
str;

$talks['nginx-speed'] = [
    'title' => 'Nginx: The Need for Speed',
    'presenter' => 'Evan Coury',
    'rating' => 5,
    'events' => [
        [
            'name'   => 'Dutch PHP Conference 2014',
            'joindin' => '1d652',
        ],
        [
            'name'   => 'ZendCon 2013',
            'joindin' => '59cfc',
        ],
    ],
];
$talks['nginx-speed']['abstract'] = <<<str
    <p>Nginx is a lightweight, high-performance web server which has been steadily rising in popularity and is used by many of the top websites on the internet. In this session, Evan will cover everything you need to know to get the most out of running your PHP site on Nginx, including PHP-FPM tuning, configuration best practices, common mistakes, tips and tricks--all backed by years of real-world experience running extremely high-traffic web services on Nginx.</p>

<iframe width="300" height="169" src="https://www.youtube-nocookie.com/embed/j1KApO0BXRA?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
str;

$talks['zf2-modules'] = [
    'title' => 'Introduction to Modules in Zend Framework 2',
    'presenter' => 'Evan Coury',
    'rating' => 5,
    'events' => [
        [
            'name'   => 'MidwestPHP 2014',
            'joindin' => '18a60',
        ],
        [
            'name'   => 'ZendCon 2013',
            'joindin' => '8aa2d',
        ],
        [
            'name'   => 'Dutch PHP Conference 2013',
            'joindin' => '08f21',
        ],
        [
            'name'   => 'SunshinePHP 2013',
            'joindin' => '19408',
        ],
    ],
];
$talks['zf2-modules']['abstract'] = <<<str
    <p>One of the highly anticipated new features of Zend Framework 2 is the introduction of an all new and powerful approach to modules. This new module system has been designed with flexibility, simplicity, performance, and re-usability in mind. Modules in ZF2 can contain just about anything: PHP code, including MVC functionality; library code; view scripts; and/or public assets such as images, CSS, and JavaScript. With compelling features such native, best-in-class Phar packaging support and event-driven design, the possibilities are truly endless. Join Evan Coury, the author of the new ZF2 module system, as he explains everything ZF2 modules have to offer.</p>

<iframe width="300" height="169" src="https://www.youtube-nocookie.com/embed/yu1e3KDFqk8?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
str;

return [
    'talks' => $talks,
];
