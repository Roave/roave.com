<?php
class ConsultingCodeAdmin extends ModelAdmin {
    private static $managed_models = array(
        'ConsultingCode',
        'ConsultingCodeRedemption',
    );
    
    private static $url_segment = 'consultingcodes';
    
    private static $menu_title = 'Consulting Codes';
}
