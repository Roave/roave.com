<% loop Sections %>
<section <% if SectionId.exists %>id="$SectionId"<% end_if %>>
    <div class="inner">
        $Content
        <% if ButtonLink.exists %>
        <a href="$ButtonLink" class="button">$ButtonText</a>
        <% end_if %>
    </div>
</section>
<% end_loop %>
