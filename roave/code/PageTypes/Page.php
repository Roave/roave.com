<?php
class Page extends SiteTree {
	public function LinkingMode() {
		if($this->isCurrent()) {
			return 'active';
		} elseif($this->isSection()) {
			return 'section';
		} else {
			return 'link';
		}
	}
}

class Page_Controller extends ContentController {

}
