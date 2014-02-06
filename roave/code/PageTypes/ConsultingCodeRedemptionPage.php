<?php
class ConsultingCodeRedemptionPage extends Page {
    private static $db = array(
        'Instructions' => 'HTMLText',
    );

    public function getCMSFields() {
        $fields = parent::getCMSFields();
        
        $fields->addFieldToTab('Root.Main', HTMLEditorField::create('Instructions', 'Instructions after redemption'), 'Content');
        
        $fields->removeByName("Content");
        
        return $fields;
    }
}

class ConsultingCodeRedemptionPage_Controller extends Page_Controller {
    private static $allowed_actions = array(
        'index',
        'redeemed',
        'FormConsultingCodeRedemption',
    );

    public function index() {
        $redemptionForm = $this->FormConsultingCodeRedemption();
        
        if($specifiedCode = $this->getRequest()->getVar('c')) {
            $redemptionForm->Fields()->dataFieldByName('Code')->setValue($specifiedCode);
        }
    
        return array(
            'RedemptionForm' => $redemptionForm,
        );
    }
    
    public function redeemed() {
        if(!($redemptionID = Session::get('ConsultingCodeRedemptionID'))) {
            return $this->redirectBack();
        }
        
        if(!($code = ConsultingCodeRedemption::get()->byID($redemptionID)->Code())) {
            return $this->redirectBack();
        }
        
        return array(
            'ConsultingCode' => $code,
        );
    }
    
    public function FormConsultingCodeRedemption($request = null) {
        $fields = FieldList::create(
            TextField::create('Code'),
            TextField::create('Name'),
            EmailField::create('Email')
        );
        
        $actions = FieldList::create(
            FormAction::create("ActionConsultingCodeRedemption", "Redeem")
        );
        
        $required = RequiredFields::create(array(
            'Code',
            'Name',
            'Email',
        ));
        
        return Form::create($this, __FUNCTION__, $fields, $actions, $required);
    }
    
    public function ActionConsultingCodeRedemption($data, $form) {
        if(!($code = ConsultingCode::get()->filter(array(
            'Code' => $data['Code'],
        ))->first())) {
            $form->addErrorMessage('Code', 'Invalid code', 'bad');
            return $this->redirectBack();
        }
        
        if($code->Redemptions()->Count()) {
            $form->addErrorMessage('Code', 'Already redeemed', 'bad');
            return $this->redirectBack();
        }
        
        $redemption = ConsultingCodeRedemption::create();
        $redemption->CodeID = $code->ID;
        $redemption->Name = $data['Name'];
        $redemption->Email = $data['Email'];
        $redemption->write();
        
        Session::set('ConsultingCodeRedemptionID', $redemption->ID);
        
        return $this->redirect($this->Link('redeemed'));
    }
}
