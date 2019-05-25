<?php

$I = new AcceptanceTester( $scenario );

$I->wantTo( 'Test that the license request form works.' );
/**
$I->amOnUrl( 'https://twitter.com/WordPress' );

$I->see( 'Updates and other fun stuff related to https://WordPress.org');

 */

$I->wantTo( 'Check the one-click approval works from the approval email.' );


// Submit the form
$I->amOnPage( '/license-request' );

$I->see( 'License Request' );
$I->fillField( 'First', 'John' );
$I->fillField( 'Last', 'Smith' );
$I->fillField( 'Email', 'test2@test.com' );
$I->click( 'Submit' );
$I->waitForText( 'Thanks for contacting us! We will get in touch with you shortly.', 3 );

// The Approval step sends an email with the subject "New License Request From John"
$I->amOnPage( '/email/new-license-request-from-john' );
$I->waitForText( 'New license request from John' );
$I->see( 'Reject' );
$I->click( 'Reject' );

// The Approval step sends an email with the subject "License Request Rejected"
$I->amOnPage( '/email/license-request-rejected' );
$I->waitForText( 'License Request Rejected' );
$I->see( 'Your request has been rejected.' );
