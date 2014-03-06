<% loop Sections %>
<section <% if SectionId.exists %>id="$SectionId"<% end_if %>>
    <div class="inner">
        $Content
        <% if ButtonLink.exists %>
        <a href="$ButtonLink" class="button">$ButtonText</a>
        <% end_if %>
    </div>
    <% if Clients.exists %>
    <ul class="client-list">
    	<% loop Clients %>
    	<li>
    		<a href="$Link"></a>
    		$Logo
    		$Description
    	</li>
    	<% end_loop %>
    </div>
    <% end_if %>
</section>
<% end_loop %>
