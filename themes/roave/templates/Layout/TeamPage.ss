<section class="team">
    <header>
        <h1>$Title</h1>
    </header>
    <% loop TeamMembers %>
    <article class="member">
        <div class="photo">
            <img alt="$Title" src="$GravatarUrl?s=180&d=mm&r=g">
            <% if Certifications.exists %>
            <div class="certs">
            	<% if ZCEID %>
            	<a href="http://www.zend.com/en/yellow-pages#show-ClientCandidateID=$ZCEID">
            	<% end_if %>
                <% loop Certifications %>
                <div class="$Class"></div>
                <% end_loop %>
                <% if ZCEID %>
                </a>
                <% end_if %>
            </div>
            <% end_if %>
        </div>
        <header>
            <hgroup>
                <h1>$Title</h1>
            </hgroup>
            <div class="links">
                <% if GitHub %>
                <a class="team-link" href="$GitHub">
                    <i class="team-link-icon icon-github"></i>
                </a>
                <% end_if %>
                <% if Twitter %>
                <a class="team-link" href="$Twitter">
                    <i class="team-link-icon icon-twitter"></i>
                </a>
                <% end_if %>
                <% if Blog %>
                <a class="team-link" href="$Blog">
                    <i class="team-link-icon icon-rss"></i>
                </a>
                <% end_if %>
            </div>
        </header>
        $Bio
    </article>
    <hr>
    <% end_loop %>
</section>
