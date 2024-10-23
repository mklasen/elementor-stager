<?php
namespace mklasen\ElementorStager;

/**
 * Stager_Elementor_Component class
 * 
 * This class extends Elementor Pro's Action_Base to add Stager integration
 * to Elementor forms.
 */
class Stager_Elementor_Component extends \ElementorPro\Modules\Forms\Classes\Action_Base {
    /**
     * Get the name of the action
     *
     * @return string
     */
    public function get_name() {
        return 'stager';
    }

    /**
     * Get the label for the action
     *
     * @return string
     */
    public function get_label() {
        return __('Stager Registration', 'elementor-stager');
    }

    /**
     * Register the settings section for the Stager integration
     *
     * @param \Elementor\Widget_Base $widget The widget instance
     */
    public function register_settings_section($widget) {
        $widget->start_controls_section(
            'section_stager',
            [
                'label' => __('Stager', 'elementor-stager'),
                'condition' => [
                    'submit_actions' => $this->get_name(),
                ],
            ]
        );

        $widget->add_control(
            'stager_organization',
            [
                'label' => __('Organization', 'elementor-stager'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Your Stager organization name', 'elementor-stager'),
            ]
        );

        $widget->add_control(
            'stager_token',
            [
                'label' => __('Token', 'elementor-stager'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Your Stager API token', 'elementor-stager'),
            ]
        );

        $widget->add_control(
            'stager_email_field',
            [
                'label' => __('Email Field ID', 'elementor-stager'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Enter the ID of the email field', 'elementor-stager'),
            ]
        );

        $widget->end_controls_section();
    }

    /**
     * Handle exporting of Elementor data
     *
     * Removes sensitive Stager data from the exported element
     *
     * @param array $element The element being exported
     * @return array The modified element
     */
    public function on_export($element) {
        unset(
            $element['stager_organization'],
            $element['stager_token'],
            $element['stager_email_field']
        );

        return $element;
    }

    /**
     * Run the action
     *
     * This method is called when the form is submitted, but the actual
     * submission handling is done in the Elementor_Stager class.
     *
     * @param \ElementorPro\Modules\Forms\Classes\Form_Record $record
     * @param \ElementorPro\Modules\Forms\Classes\Ajax_Handler $ajax_handler
     */
    public function run($record, $ajax_handler) {
        // The actual submission is handled in the Elementor_Stager class
    }
}