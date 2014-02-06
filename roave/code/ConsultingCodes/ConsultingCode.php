<?php
class ConsultingCode extends DataObject {
    private static $summary_fields = array(
        'Code',
        'Minutes',
    );

    private static $db = array(
        'Code' => 'VarChar(255)',
        'Minutes' => 'Int',
    );
    
    private static $has_many = array(
        'Redemptions' => 'ConsultingCodeRedemption',
    );
    
    public function getCMSFields() {
        $fields = FieldList::create(new TabSet("Root"));
        
        $fields->addFieldsToTab("Root.Main", array(
            TextField::create('Code', 'Code', $this->Code?:substr(md5(microtime()), 0, 5)),
            NumericField::create('Minutes'),
        ));
        
        $fields->addFieldsToTab("Root.Redemptions", array(
            GridField::create('Redemptions', 'Redemptions', $this->Redemptions(), GridFieldConfig_RelationEditor::create())
        ));
        
        $this->extend('updateCMSFields', $fields);
        
        return $fields;
    }
}
