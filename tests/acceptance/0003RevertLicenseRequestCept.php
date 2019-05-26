<?php

$I = new AcceptanceTester( $scenario );

$I->wantTo( 'Test that the license request form works.' );
/**
$I->amOnUrl( 'https://twitter.com/WordPress' );

$I->see( 'Updates and other fun stuff related to https://WordPress.org');

 */

$I->deleteAllEntries();
// Submit the form
$I->amOnPage( '/license-request' );

$I->see( 'License Request' );
$I->fillField( 'First', 'Jane' );
$I->fillField( 'Last', 'Doe' );
$I->fillField( 'Email', 'jane@test.com' );
$I->click( 'Submit' );
$I->waitForText( 'Thanks for contacting us! We will get in touch with you shortly.', 3 );

// The Approval step sends an email with the subject "New License Request from Jane"
$I->amOnPage( '/email/new-license-request-from-jane' );
$I->see( 'New license request from Jane' );
$I->click( 'View Entry' );

$I->waitForText( 'jane@test.com' );

$I->click( 'Revert' );


$I->amOnPage( '/email/modify-request' );
$I->waitForText( 'Please give further details' );
$I->click( 'Click here to edit your message' );
$I->fillField( 'Message', 'Here are some more details' );
$I->click( 'Submit' );

$I->amOnPage( '/inbox' );
$I->click( 'License Request' );
$I->waitForText( 'jane@test.com' );
$I->click( 'Approve' );
$I->see( 'Status: Approved' );

//$I->deleteAllPosts();