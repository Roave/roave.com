<% require themedCSS("pages/StreamPage") %>

<h2>$Title</h2>

<object type="application/x-shockwave-flash" 
        height="563" 
        width="1000" 
        id="twitch_tv" 
        data="http://www.twitch.tv/widgets/live_embed_player.swf?channel=$Channel" 
        bgcolor="#000000">
    <param name="allowFullScreen" value="true" />
    <param name="allowScriptAccess" value="always" />
    <param name="allowNetworking" value="all" />
    <param name="movie" value="http://www.twitch.tv/widgets/live_embed_player.swf" />
    <param name="flashvars" value="hostname=www.twitch.tv&channel=$Channel&auto_play=true&start_volume=25" />
</object>
<iframe src="http://roave.com/chat/" frameborder="0" scrolling="no"></iframe>
