<?php
class PayPage extends Page {
	private static $db = array(
		"SecretKey" => "Varchar(32)",
		"PublishableKey" => "Varchar(32)",
		"PaymentDescription" => "Text",
		"PaymentButtonLabel" => "Text",
		"PaymentPanelButtonLabel" => "Text",
	);
	
	public function getCMSFields() {
		$fields = parent::getCMSFields();
		
		$fields->addFieldToTab('Root.Main', TextField::create('SecretKey', 'Secret Key'), 'Content');
		$fields->addFieldToTab('Root.Main', TextField::create('PublishableKey', 'Publishable Key'), 'Content');
		$fields->addFieldToTab('Root.Main', TextField::create('PaymentDescription', 'Payment Description'), 'Content');
		$fields->addFieldToTab('Root.Main', TextField::create('PaymentButtonLabel', 'Payment Button Label'), 'Content');
		$fields->addFieldToTab('Root.Main', TextField::create('PaymentPanelButtonLabel', 'Payment Panel Button Label'), 'Content');
		
		$fields->removeByName("Content");
		
		return $fields;
	}
}

class PayPage_Controller extends Page_Controller {
	private static $allowed_actions = array(
		'index',
		'FormCreateCustomer',
	);
	
	public function FormCreateCustomer($request = null) {
		$fields = FieldList::create(
			TextField::create('Name')
				->setAttribute('placeholder', 'John Doe'),
			TextField::create('Street')
				->setAttribute('placeholder', '123 Main St'),
			TextField::create('City')
				->setAttribute('placeholder', 'Metropolis'),
			TextField::create('State')
				->setAttribute('placeholder', 'CA'),
			TextField::create('PostalCode', 'Postal Code')
				->setAttribute('placeholder', '90210'),
			TextField::create('Country')
				->setAttribute('placeholder', 'USA'),
		        LiteralField::create('StripeScript', $this->renderWith('StripeScript'))
		);
		
		$actions = FieldList::create(
			FormAction::create("ActionCreateCustomer")
		);
		
		return Form::create($this, __FUNCTION__, $fields, $actions);
	}
	
	public function ActionCreateCustomer($data, $form) {
		$request = $this->Request;
		
		Stripe::setApiKey($this->SecretKey);
		
		$customer = Stripe_Customer::create(array(
			'card' => $request->getVar('stripeToken'),
			'description' => $data['Name'],
			'metadata' => array(
				'Street' => $data['Street'],
				'City' => $data['City'],
				'State' => $data['State'],
				'PostalCode' => $data['PostalCode'],
				'Country' => $data['Country'],
			),
		));
		
		Debug::dump($customer);
	}
}
