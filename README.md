# WordPress Core Pricacy Data Request Form

Development of a new WordPress Core Privacy Data Request Form.

## Description

The purpose of this repository is to prepare a future Privacy Data Request Form feature.

The feature is based on an existing plugin: [GDPR Data Request Form](https://wordpress.org/plugins/gdpr-data-request-form/), initially created by [@audrasjb](https://profiles.wordpress.org/audrasjb) and [@whodunitagency](https://profiles.wordpress.org/whodunitagency/).

In this repo, you’ll find the folders/files that have been modified from WordPress Core (current trunk).

## Context

[See WordPress Core Privacy Team roadmap](https://make.wordpress.org/core/roadmap/privacy/):

> Front End User Initiated Requests (Feature Plugin)
> 
> In 4.9.6, the ability for an administrator to initiate a data export or data erasure for a user by email address was added. While this provided sites with the tools to be compliant with new laws and regulations, site owners are still left to find a way to accommodate those requests. Adding a way for users to initiate this request on their own would prove a more “out of the box” experience and decrease the burden on site administrators to initiate these requests themselves.
> Related tickets: #44013

## Features

- PHP Function to display the Privacy Data Request Form: `wp_get_privacy_data_request_form()`
- New Core Widget: `WP_Widget_Data_Request`

### Upcoming features and to-do list

- Gutenberg Block
- Add filters to handle strings customization in the form
- Accessibility audit
- Security audit
- Coding standards audit

## Contributors

- audrasjb
- whodunitagency
- xkon

## Screenshots

Admin Widget in the Widget Screen:
![Admin Widget in the Widget Screen](https://jeanbaptisteaudras.com/images/privacy-widget-admin.png)

Public Widget Rendering in Twenty Nineteen (default styles):
![Public Widget Rendering in Twenty Nineteen (default styles)](https://jeanbaptisteaudras.com/images/privacy-widget-public.png)
