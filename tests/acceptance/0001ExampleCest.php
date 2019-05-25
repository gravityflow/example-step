<?php

class ExampleCest {
	public function _before( \AcceptanceTester $I ) {
		$I->deleteAllPosts();
		$I->deleteAllEntries();
	}

	public function _after( \AcceptanceTester $I ) {
		$I->deleteAllEntries();
	}

	// tests
	public function tryToTest( \AcceptanceTester $I ) {
		$I->wantTo( 'Check the one-click approval works from the approval email.' );

		// Submit the form
		$I->amOnPage( '/license-request' );

		$I->see( 'License Request' );
		$I->fillField( 'First', 'Steve' );
		$I->fillField( 'Last', 'Henty' );
		$I->fillField( 'Email', 'test1@test.com' );
		$I->click( 'Submit' );
		$I->waitForText( 'Thanks for contacting us! We will get in touch with you shortly.', 3 );

		// The Approval step sends an email with the subject "New License Request from Steve"
		$I->amOnPage( '/email/new-license-request-from-steve' );
		$I->see( 'New license request from Steve' );
		$I->click( 'Approve' );

		// The Notification step sends an email with the subject "Your License Key"
		$I->amOnPage( '/email/your-license-key' );
		$I->waitForText( "Your License Key" );
		$I->see( "your license key for the demo workflow" );

		// The WPLoader module allows us to access all our WordPress code.
		$form_id         = GFFormsModel::get_form_id( 'License Request' );
		$search_criteria = array(
			'field_filters' => array(
				array(
					'key'   => '2',
					'value' => 'test1@test.com',
				),
			),
		);
		$entries         = GFAPI::get_entries( $form_id, $search_criteria );
		$I->assertNotEmpty( $entries );

		// The license key is stored in field ID 3.
		$license_key_in_entry = $entries[0]['3'];

		// Check the license key in the entry is the same as the one in the email.
		$I->see( $license_key_in_entry );
	}
}