<?php

namespace mklasen\ElementorStager;

/**
 * Handle_Submission class
 * 
 * This class is responsible for processing form submissions and registering users with Stager.
 * It integrates with Elementor Pro's form submission process and sends the user's email to Stager API.
 */
class Handle_Submission
{
    /**
     * @var string The Stager organization name.
     */
    private $organization;

    /**
     * @var string The Stager API token.
     */
    private $token;

    /**
     * @var string The ID of the email field in the Elementor form.
     */
    private $email_field;

    /**
     * Handle the form submission and process the Stager registration.
     *
     * This method is invoked when a form is submitted. It checks if the Stager action
     * is enabled for the form, retrieves necessary settings, and sends a registration
     * request to the Stager API.
     *
     * @param \ElementorPro\Modules\Forms\Classes\Form_Record $record The form record object containing submitted data.
     * @param \ElementorPro\Modules\Forms\Classes\Ajax_Handler $ajax_handler The Ajax handler object for managing responses.
     */
    public function __invoke($record, $ajax_handler)
    {
        $form_settings = $record->get('form_settings');

        // Check if our action is enabled
        if (!in_array('stager', $form_settings['submit_actions'])) {
            return;
        }

        $this->organization = $form_settings['stager_organization'] ?? '';
        $this->token = $form_settings['stager_token'] ?? '';
        $this->email_field = $form_settings['stager_email_field'] ?? '';

        $form_data = $record->get_formatted_data();
        $email = $form_data[$this->email_field] ?? '';

        if (empty($email)) {
            $ajax_handler->add_error_message(__('Email field is empty.', 'elementor-stager'));
            return;
        }

        $url = "https://{$this->organization}.stager.co/api/ticketshop/optin/register?token={$this->token}&email={$email}";

        $response = wp_remote_post($url);

        if (is_wp_error($response)) {
            $ajax_handler->add_error_message(__('There was a problem registering with Stager.', 'elementor-stager'));
        } else {
            $ajax_handler->add_success_message(__('Successfully registered with Stager.', 'elementor-stager'));
        }
    }
}
