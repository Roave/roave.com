<section class="team">
    <div class="inner">
        <h1>$Title</h1>
        <% loop TeamMembers %>
        <div class="member media">
            <div class="img">
                <img src="$GravatarUrl?s=180&d=mm&r=g">
            </div>
            <div class="content">
                <h3>$Title</h3>
                $Bio
            </div>
        </div>
        <% end_loop %>
    </div>
</section>
