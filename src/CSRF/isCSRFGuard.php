<?php

namespace CSRF;

/**
 * Interface isCSRFGuard
 * @package CSRF
 */
interface isCSRFGuard {

    /**
     * @param $key
     * @param $value
     */
    public function store_in_session($key,$value);

    /**
     * @param $key
     */
    public function unset_session($key);

    /**
     * @param $key
     * @return bool
     */
    public function get_from_session($key);

    /**
     * @param $unique_form_name
     * @return string
     */
    public function csrfguard_generate_token($unique_form_name);

    /**
     * @param $unique_form_name
     * @param $token_value
     * @return bool
     */
    public function csrfguard_validate_token($unique_form_name,$token_value);

} 