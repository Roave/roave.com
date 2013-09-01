<!DOCTYPE html>
<html lang="en">
    <head>
        <% base_tag %>
        <meta charset="utf-8">
        <title>$SiteConfig.Title - $Title</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <% require themedCSS('style') %>
        <% require themedCSS('layout') %>
        <% require themedCSS('typography') %>
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements --><!--[if lt IE 9]> <script src="js/html5shiv.js"></script> <![endif]-->
        <link href="$ThemeDir/images/favicon.png" rel="shortcut icon">
        <link href="$ThemeDir/images/favicon.ico" rel="shortcut icon">
        <link href="http://fonts.googleapis.com/css?family=Rambla" rel="stylesheet" type="text/css">
        <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    </head>
    <body class="$ClassName">
        <div class="wrap">
            <header>
                <div class="container">
                    <div class="logo small"></div>
                </div>
                <div class="navbar navbar-inverse navbar-static-top">
                    <div class="navbar-inner">
                        <div class="container">
                            <button class="btn btn-navbar" data-target=".nav-collapse" data-toggle="collapse" type="button">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <div class="nav-collapse collapse">
                                <ul class="nav">
                                    <% loop Menu(1) %>
                                    <li class="$LinkingMode">
                                        <a href="$Link">$MenuTitle</a>
                                    </li>
                                    <% end_loop %>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div class="main container">
                $Layout
            </div>
            <footer>
                <p class="copyright">&copy; Roave 2012-2013</p>
            </footer>
            <% require javascript('//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js') %>
            <% require javascript('themes/roave/javascript/bootstrap.js') %>
        </div>
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                },
                i[r].l = 1 * new Date();
                a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
            
            ga('create', 'UA-42058149-1', 'roave.com');
            ga('send', 'pageview');
        </script>
    </body>
</html>
