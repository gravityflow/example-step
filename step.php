<?php
/**
Plugin Name: Example Gravity Flow Step
Description: Demonstrates how to create a custom step.
Version: 1.0
Author: Steve Henty
Author URI: https://www.stevenhenty.com
License: GPL-2.0+

Copyright 2019 Steven Henty

*/


/**
 * Wait until Gravity Flow is ready before extending Gravity_Flow_Step.
 */
add_action( 'gravityflow_loaded', function () {

	/**
	 * Class Example_Step
	 */
	class Example_Step extends Gravity_Flow_Step {

		/**
		 * The unique identifier for this step.
		 *
		 * @var string
		 */
		public $_step_type = 'example_step';

		/**
		 * Returns the label for the step type.
		 *
		 * @return string
		 */
		public function get_label() {
			return 'Example Step';
		}

		/**
		 * Process the step. Generate a license key and store it in field ID 3.
		 *
		 * @return bool Is the step complete?
		 */
		public function process() {

			$license_key = wp_generate_password();

			// Field ID 3 is the hidden field used to store the license key.
			$field_id = 3;

			GFAPI::update_entry_field( $this->get_entry_id(), $field_id, $license_key );

			// The step has finished so return true.
			return true;
		}
	}

	Gravity_Flow_Steps::register( new Example_Step() );
}
);
