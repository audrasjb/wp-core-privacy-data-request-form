# WordPress Core Privacy Data Request Form

Development of a new WordPress Core feature – Privacy Data Request front-end Forms.

Table of content:

- About
- [Context](https://github.com/audrasjb/wp-core-privacy-data-request-form#context)
- [Features / to-do list](https://github.com/audrasjb/wp-core-privacy-data-request-form#features--to-do-list)
- [Contributors](https://github.com/audrasjb/wp-core-privacy-data-request-form#contributors)
- [Screenshots](https://github.com/audrasjb/wp-core-privacy-data-request-form#screenshots)
- [Documentation](https://github.com/audrasjb/wp-core-privacy-data-request-form#documentation)

## About

The purpose of this repository is to prepare a future Privacy Data Request Form feature.

The feature is based on an existing plugin: [GDPR Data Request Form](https://wordpress.org/plugins/gdpr-data-request-form/), initially created by [@audrasjb](https://profiles.wordpress.org/audrasjb) and [@whodunitagency](https://profiles.wordpress.org/whodunitagency/).

In this repo, you’ll find the folders/files that have been modified from WordPress Core (current trunk).

To test/contribute, just copy these files in your WordPress install.

## Context

[See WordPress Core Privacy Team roadmap](https://make.wordpress.org/core/roadmap/privacy/):

> Front End User Initiated Requests (Feature Plugin)
> 
> In 4.9.6, the ability for an administrator to initiate a data export or data erasure for a user by email address was added. While this provided sites with the tools to be compliant with new laws and regulations, site owners are still left to find a way to accommodate those requests. Adding a way for users to initiate this request on their own would prove a more “out of the box” experience and decrease the burden on site administrators to initiate these requests themselves.
> Related tickets: #44013

## Features / to-do list

- ✅ PHP Function to display the Privacy Data Request Form: `wp_get_privacy_data_request_form()`
- ✅ New Core Widget: `WP_Widget_Data_Request`
- ✅ Add filters to handle strings customization in the forms
- ✅ Add possibility to choose either show remove request, export request, or both in PHP Function
- 🔲 Add possibility to choose either show remove request, export request, or both in Core Widget
- 🔲 Gutenberg Block
- 🔲 Accessibility audit
- 🔲 Security audit
- 🔲 Coding standards audit

## Contributors

- audrasjb
- whodunitagency
- xkon

## Documentation

### Filter: `privacy_data_request_form_defaults`

#### Description

`privacy_data_request_form_defaults` filters the default form output arguments. It is part of the function `wp_get_privacy_data_request_form()`.

#### Parameters

`$defaults` (array) (required) An array of default login form arguments. Default: None.

The defaults set in the `wp_get_privacy_data_request_form()` function are as follows:

	$defaults = array(
		'form_id'                => 'wp-privacy-form-' . $key_id,
		'label_select_request'   => esc_html__( 'Select your request:' ),
		'label_select_export'    => esc_html__( 'Export Personal Data' ),
		'label_select_remove'    => esc_html__( 'Remove Personal Data' ),
		'label_input_email'      => esc_html__( 'Your email address (required)' ),
		'label_input_captcha'    => esc_html__( 'Human verification (required):' ),
		'value_submit'           => esc_html__( 'Send Request' ),
		'request_type'           => 'both',
		'notice_success'         => esc_html__( 'Your enquiry have been submitted. Check your email to validate your data request.' ),
		'notice_error'           => esc_html__( 'Some errors occurred:' ),
		'notice_invalid_nonce'   => esc_html__( 'Security check failed, please refresh this page and try to submit the form again.' ),
		'notice_invalid_email'   => esc_html__( 'Invalid email address.' ),
		'notice_invalid_captcha' => esc_html__( 'Security check failed: invalid human verification field.' ),
		'notice_invalid_request' => esc_html__( 'Request type invalid, please refresh this page and try to submit the form again.' ),
		'notice_missing_field'   => esc_html__( 'All fields are required.' ),
		'notice_request_failed'  => esc_html__( 'Unable to initiate confirmation request. Please contact the administrator.' ),
	);

#### Example

```
add_filter( 'privacy_data_request_form_defaults', 'my_privacy_form' );
function my_privacy_form() {
	$args = array(
		'form_id'                => 'my_privacy_form_id'
		'label_select_request'   => 'Please select a request',
		'label_select_export'    => 'Export',
		'label_select_remove'    => 'Delete', 
		'label_input_captcha'    => 'Please prove you’re a human:',
		'value_submit'           => 'Send your request',
		'request_type'           => 'export',
		'notice_success'         => 'Thanks for your request… Check your email to validate your data request.',
		'notice_error'           => 'There is some errors!',
		'notice_invalid_nonce'   => 'The security nonce failed!',
		'notice_invalid_email'   => 'Your email is invalid',
		'notice_invalid_captcha' => 'Invalid mathematic result :-)',
		'notice_invalid_request' => 'Invalid request: please refresh the page and submit the form again!',
		'notice_missing_field'   => 'Missing fields',
		'notice_request_failed'  => 'Privacy Request failed. Please try again!',
	);
	return $args;
}
```

## Screenshots

### Admin Widget in the Widgets Screen

![Admin Widget in the Widget Screen](https://jeanbaptisteaudras.com/images/privacy-widget-admin.png)

### Public Widget Rendering in Twenty Nineteen (default styles)

![Public Widget Rendering in Twenty Nineteen (default styles)](https://jeanbaptisteaudras.com/images/privacy-widget-public.png)
