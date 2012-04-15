<?php

/*
  Plugin Name: Topschool Wordpress plugin
  Plugin URI: http://www.iostudio.com
  Description: Used to submit form data to topschool
  Version 0.1.0
  Author: ioStudio
  Author URI: http://www.iostudio.com
  License: ioStudio
 */

/**
 * Description
 *
 * @author
 * @copyright ioStudio
 * @package
 * @subpackage
 * @version
 *
 */
// Add the action, this will run right before the GravityForms
add_action('wp', array('TopschoolPlugin', 'parseRequest'), 9);

/**
 * TopschoolPlugin class
 *
 * For this to work you will need Gravity Forms installed. Please see the Readme
 * file for more info.
 * 
 */
class TopschoolPlugin {

    /**
     * This checks to see if a gravity form has been submitted, if it has then
     * we will submit that info to Topschool
     *
     * @param WP $wp
     */
    public static function parseRequest(WP $wp) {
        // Check and see if a Gravity form has been submitted
        if (isset($_POST["gform_ajax"])) {
            parse_str($_POST["gform_ajax"]);
            require_once(GFCommon::get_base_path() . "/form_display.php");

            //looking up form id by form name
            if (!is_numeric($form_id))
                $form_id = RGFormsModel::get_form_id($form_id);

            //reading form metadata
            $form = RGFormsModel::get_form_meta($form_id, true);
            $form = RGFormsModel::add_default_properties($form);

            $submission_info = isset(GFFormDisplay::$submission[$form_id]) ? GFFormDisplay::$submission[$form_id] : false;

            if ($submission_info['is_valid']) {
                require_once realpath(__DIR__ . '/lib/topschool.class.php');
                $topschool = new Topschool();

                // We use this in case we need to attach a note to the record
                $tsNote = array();

                // loop through each field and get the values for what the user
                // has submitted and set those with topschool api
                foreach ($submission_info['form']['fields'] as $field) {
                    // ie: firstname
                    $topschoolKey = $field['adminLabel'];

                    // if the admin label has not been set, then we skip it
                    if (!$topschoolKey) {
                        continue;
                    }

                    // ie: input_1
                    $postKey = 'input_' . $field['id'];

                    // ie: setFirstname
                    $method = 'set' . ucfirst($topschoolKey);

                    // wrap this in a try incase something goes wrong
                    try {
                        // ie: ->setFirstname($_POST['input_1'])
                        $topschool->$method($_POST[$postKey]);
                    }
                    catch (Exception $e) {
                        $tsNote[] = sprintf('%s => %s', $field['label'], $_POST[$postKey]);
                    }
                }

                // check to see if we need to attach a note to the submission to
                // topschool
                if (count($tsNote)) {
                    $topschool->setNote(implode("\n", $tsNote));
                }

                // Submit the information to topschool
                $result = $topschool->submit();
            }
        }
    }

}