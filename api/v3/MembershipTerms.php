<?php

/**
 * MembershipTerms.create API specification
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see http://wiki.civicrm.org/confluence/display/CRMDOC/API+Architecture+Standards
 */
function _civicrm_api3_membership_terms_create_spec(&$spec)
{
    //required parameters
    $spec['contact_id']['api.required']         = 1;
    $spec['contribution_id']['api.required']    = 1;
    $spec['membership_id']['api.required']      = 1;
    $spec['start_date']['api.required']         = 1;
    
    //default values
    $spec['start_date']['api.default']         = date("Y-m-d");
}

/**
 * MembershipTerms.create API
 *
 * @param array $params
 * @return array API result descriptor
 * @throws API_Exception
 */
function civicrm_api3_membership_terms_create($params)
{
    return _civicrm_api3_basic_create(_civicrm_api3_get_BAO(__FUNCTION__), $params);
}

/**
 * MembershipTerms.delete API
 *
 * @param array $params
 * @return array API result descriptor
 * @throws API_Exception
 */
function civicrm_api3_membership_terms_delete($params)
{   
    return _civicrm_api3_basic_delete(_civicrm_api3_get_BAO(__FUNCTION__), $params);
}



/**
 * MembershipTerms.get API
 *
 * @param array $params
 * @return array API result descriptor
 * @throws API_Exception
 */
function civicrm_api3_membership_terms_get($params)
{
    return _civicrm_api3_basic_get(_civicrm_api3_get_BAO(__FUNCTION__), $params);
}

