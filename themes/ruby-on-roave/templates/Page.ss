<!DOCTYPE html>
<html>
<head>
    <% base_tag %>
    <title>$SiteConfig.Title - $Title</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <% require css("http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,300italic,400,400italic,600,700,900&subset=latin,latin-ext") %>
    <% require css("http://fonts.googleapis.com/css?family=Source+Code+Pro") %>
    <% require themedCSS("reset") %>
    <% require themedCSS("tomorrow-night") %>
    <% require themedCSS("styles") %>
    <link href="$ThemeDir/images/favicon.png" rel="shortcut icon">
    <link href="$ThemeDir/images/favicon.ico" rel="shortcut icon">
</head>

<body>
    <header>
        <a href="/">
            <div id="logo">
                <img src="$ThemeDir/images/roave-logo-tiny.svg">
            </div>
        </a>
        <ul class="menu">
            <% loop Menu(1) %>
                <li><a href="$Link">$MenuTitle</a></li>
            <% end_loop %>
        </ul>
    </header>
    <div class="splash">
        <div class="zimg"></div>
        <div class="darken"></div>
        <h3>$SiteConfig.Tagline</h3>
    </div>
    <div class="container">
        $Layout
    </div>
    <footer>
        <ul>
            <li>
                <h3>About</h3>
                <p>$SiteConfig.About</p>
            </li>
            <li>
                <h3>Inquiries</h3>
                <p>$SiteConfig.Inquiries</p>
            </li>
            <li>
                <h3>Contact</h3>
                <p>$SiteConfig.Contact</p>
            </li>
        </ul>
        <hr>&copy; Roave $Now.Year</footer>
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
