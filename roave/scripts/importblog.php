<?php
include(__DIR__."/../../cli/bootstrap.php");
DB::getConn()->transactionStart();

$oldDomain = 'http://roave.com';

$blog = BlogHolder::get()->filter("ParentID", 0)->First();

foreach(BlogEntry::get()->filter("ParentID", $blog->ID) as $existing) {
	$existing->deleteFromStage("Stage");
	$existing->deleteFromStage("Live");
	$existing->destroy();
}

$filename = $argv[1];

libxml_use_internal_errors(true);
$dom = new DOMDocument();
$dom->load($filename, LIBXML_NOERROR);

$xpath = new DOMXPath($dom);

$attachments = $xpath->query('//rss/channel/item[wp:post_type="attachment"]');

foreach($attachments as $attachment) {
	$url = $xpath->query("wp:attachment_url", $attachment)->item(0)->textContent;
	if(!($file = File::get()->filter("OldID", $xpath->query("wp:post_id", $attachment)->item(0)->textContent)->First())) {
		$file = new Image();
		$file->OldID = $xpath->query("wp:post_id", $attachment)->item(0)->textContent;
		
		$data = file_get_contents($url);
		if(!$data)
			continue;
		$path = ASSETS_DIR."/Uploads/".basename($url);
		file_put_contents(Director::baseFolder()."/{$path}", $data);
		unset($data);
		$file->Filename = $path;
	}
	
	$file->Title = $xpath->query("title", $attachment)->item(0)->textContent;
	$file->Name = basename($url);
	$file->ParentID = 1;
	
	$file->write();
}

DB::getConn()->transactionEnd();
DB::getConn()->transactionStart();

$posts = $xpath->query('//rss/channel/item[wp:post_type="post"]');

foreach($posts as $post) {
	if(!($entry = BlogEntry::get()->filter("OldID", $xpath->query("wp:post_id", $post)->item(0)->textContent)->First())) {
		$entry = new BlogEntry();
		$entry->OldID = $xpath->query("wp:post_id", $post)->item(0)->textContent;
	}
	
	$status = $xpath->query("wp:status", $post)->item(0)->textContent == "publish";
	
	$entry->ParentID = $blog->ID;
	$entry->Status = $status?"Published":"Draft";
	$entry->URLSegment = $xpath->query("wp:post_name", $post)->item(0)->textContent;
	$entry->Title = $xpath->query("title", $post)->item(0)->textContent;
	$entry->Date = $xpath->query("wp:post_date", $post)->item(0)->textContent;
	$entry->Content = parseWordpressContent($xpath->query("content:encoded", $post)->item(0)->textContent);
	
	$tags = $xpath->query('category[@domain="post_tag"]', $post);
	$tags_list = array();
	foreach($tags as $tag) {
		$tags_list[] = $tag->textContent;
	}
	$entry->Tags = implode(", ", $tags_list);
	/*
	$entry-> = $xpath->query("", $post)->item(0)->textContent;
	*/
	
	$entry->write();
	$entry->Created = $xpath->query("wp:post_date", $post)->item(0)->textContent;
	$entry->write();

	if($status)
		$entry->publish("Stage", "Live");
}
DB::getConn()->transactionEnd();

function parseWordpressContent($content) {
	global $oldDomain;

	$content = "<p>".str_replace(array(
		"\r\n\r\n",
		"\n\n"
	), array(
		"</p><p>",
		"</p><p>"
	), $content)."</p>";
	
	$content = preg_replace_callback('#\[caption id=".*" align="(.*)" width="(.*)" caption="(.*)"\](.*)\[/caption\]#U', function($matches) {
		$align = $matches[1];
		$width = $matches[2];
		$caption = $matches[3];
		$content = $matches[4];
		
		return "<div class=\"caption {$align}\" style=\"width: {$width}px;\">{$content}<p class=\"captiontext\">{$caption}</p></div>";
	}, $content);
	
	$content = preg_replace_callback('#<a href="('.$oldDomain.'/.*)"><img class="(.*)" title="(.*)" src=".*" alt=".*" width="(\d*)" height="(\d*)" /></a>#U', function($matches) {
		$url = $matches[1];
		$classes = explode(" ", $matches[2]);
		$title = $matches[3];
		$width = $matches[4];
		$height = $matches[5];
		
		foreach($classes as $key => $class) {
			if(substr($class, 0, 8) == "wp-image" || !strlen(trim($class)))
				unset($classes[$key]);
			else
				$classes[$key] = trim($class);
		}
		
		$fullSize = in_array("size-full", $classes);
		
		$attachment = Image::get()->filter("Name", basename($url))->First();
		if(!$attachment)
			return "<!-- Missing asset -->";
		
		$classes = implode(" ", $classes);
		$dimensions = $fullSize?:"width=\"{$width}\" height=\"{$height}\"";
		$result = "[file_link,id={$attachment->ID}]<img src=\"[file_link,id={$attachment->ID}]\" title=\"{$title}\" alt=\"{$attachment->Title}\" class=\"{$classes}\" {$dimensions} />[/file_link]";

		return $result;
	}, $content);
	
	
	return $content;
}


