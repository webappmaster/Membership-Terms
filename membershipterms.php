<?php

require_once 'membershipterms.civix.php';
/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function membershipterms_civicrm_config(&$config)
{
    _membershipterms_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function membershipterms_civicrm_xmlMenu(&$files)
{
    _membershipterms_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function membershipterms_civicrm_install()
{
    _membershipterms_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function membershipterms_civicrm_postInstall()
{
    _membershipterms_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function membershipterms_civicrm_uninstall()
{
    _membershipterms_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function membershipterms_civicrm_enable()
{
    _membershipterms_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function membershipterms_civicrm_disable()
{
    _membershipterms_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function membershipterms_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL)
{
    return _membershipterms_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function membershipterms_civicrm_managed(&$entities)
{
    _membershipterms_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function membershipterms_civicrm_caseTypes(&$caseTypes)
{
    _membershipterms_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function membershipterms_civicrm_angularModules(&$angularModules)
{
    _membershipterms_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function membershipterms_civicrm_alterSettingsFolders(&$metaDataFolders = NULL)
{
    _membershipterms_civix_civicrm_alterSettingsFolders($metaDataFolders);
}


/**
 * Implements hook for contact page tab
 * Compatible with civicrm 4.6
 */
function membershipterms_civicrm_tabs( &$tabs, $contactID ) {
    
    //call membership terms page and retrieve its content
    $url = CRM_Utils_System::url('civicrm/membership-terms', "snippet=json&cid=$contactID");
    
    //call MembershipTerms api, getcount method
    $count = civicrm_api3('MembershipTerms', 'getcount', array(
      'sequential' => 1,
      'contact_id' => $contactID,
    ));
        
    $tabs[] = array(
        'id' => 'membershipterms',
        'url' => $url,
        'title' => 'Membershipterms',
        'weight' => 300,
        'count' => $count,
    );
}

/**
 * Implements hook for contact page tab
 * Compatible with civicrm 4.7
 */
function membershipterms_civicrm_tabset_111($tabsetName, &$tabs, $context)
{
    //Handle ajax call by javascript function.
    CRM_Core_Resources::singleton()->addScriptFile('com.example.membershipterms', 'js/membershipterms.js');
    
    //check if the tabset is Contact View Page
    if ($tabsetName == 'civicrm/contact/view')
    {
        // unset the contribition tab, i.e. remove it from the page
        //unset($tabs[1]);
        $contactId = $context['contact_id'];

        //call MembershipTerms api, getcount method
        $count = civicrm_api3('MembershipTerms', 'getcount', array(
          'sequential' => 1,
          'contact_id' => $contactId,
        ));
        
        // let's add a new "contribution" tab with a different name and put it last
        // this is just a demo, in the real world, you would create a url which would
        // return an html snippet etc.
        //$url = CRM_Utils_System::url('civicrm/contact/view/contribution', "reset=1&snippet=1&force=1&cid=$contactId");
        $url = CRM_Utils_System::url('civicrm/membership-terms', "snippet=json&cid=$contactId");
        // $url should return in 4.4 and prior an HTML snippet e.g. '<div><p>....';
        // in 4.5 and higher this needs to be encoded in json. E.g. json_encode(array('content' => <html form snippet as previously provided>));
        // or CRM_Core_Page_AJAX::returnJsonResponse($content) where $content is the html code
        // in the first cases you need to echo the return and then exit, if you use CRM_Core_Page method you do not need to worry about this.
        // print_r($tabs);die;
        $tabs[] = array(
            'id' => 'membershipterms',
            'url' => $url,
            'title' => 'Membershipterms',
            'weight' => 300,
            'count' => $count,
        );
    }
}

/**
 * Add new entity Membership Terms
 */
/** * Implements hook_civicrm_entityTypes. * * @param array $entityTypes *   Registered entity types. */
function membershipterms_civicrm_entityTypes(&$entityTypes)
{
    $entityTypes['CRM_Membershipterms_DAO_MembershipTerms'] = array('name' => 'MembershipTerms', 'class' => 'CRM_Membershipterms_DAO_MembershipTerms', 'table' => 'civicrm_membership_terms',);
}

/**
 * Add new MembershipTerm record
 * We will save this record on after membership payment entry is made. 
 * By using this hook, we make sure that we have all required fields id available to insert 
 * @param type $dao
 */
function membershipterms_civicrm_postSave_civicrm_membership_payment($dao)
{
    //get contact id
    $contact_id = CRM_Core_DAO::singleValueQuery('SELECT contact_id from civicrm_contribution'
            . ' WHERE id = %1', [1 => [$dao->contribution_id, 'Integer']] ) ;
    
    //get membership record by contact id
    $membership = $result = civicrm_api3('Membership', 'get', array(
                    'sequential' => 1,
                    'contact_id' => $contact_id,
                  ));  
    
    $membership_type_id = isset($membership['values'][0]['membership_type_id']) ? $membership['values'][0]['membership_type_id'] : 0;
    
    //get membership type record by $membership_type_id
    $membership_type = civicrm_api3('MembershipType', 'get', array(
      'sequential' => 1,
      'id' => $membership_type_id,
    ));
    
    //get membership duration unit from $membership_type
    $membership_duration_unit = ($membership_type['values'][0]['duration_unit']) ? $membership_type['values'][0]['duration_unit'] : '';
    $membership_duration_interval = ($membership_type['values'][0]['duration_interval']) ? $membership_type['values'][0]['duration_interval'] : '';
    
    //for lifetime membership, there is no end_date
    if($membership_duration_unit == 'lifetime')
    {
        $membership_end_date = null;
        $membership_start_date = date('Ymd', strtotime($membership['values'][0]['start_date']) );
    }
    else
    {
        $membership_end_date = date('Ymd', strtotime($membership['values'][0]['end_date']) );
        
        //get start date by substracting interval and duration e.g. (end_date - 3 years)
        //here we added +1 day so set start date to start after previous end date
        $membership_start_date = date('Ymd', strtotime( $membership['values'][0]['end_date'] . '+1 day -'.$membership_duration_interval.' '.$membership_duration_unit)) ;
    }
    
    //add membership term
    $myparams = [
        'start_date'        => $membership_start_date,
        'end_date'          => $membership_end_date,
        'membership_id'     => $dao->membership_id,
        'contact_id'        => $contact_id,
        'contribution_id'   => $dao->contribution_id,
    ];
    
    $membershipTerms = new CRM_Membershipterms_BAO_MembershipTerms();
    $membershipTerms -> create($myparams);
}

/**
 * MembershipTerms API Permission 
 * Users with access CiviCRM permission will be able to make api call of this extension
 * @return void
 */
function membershipterms_civicrm_alterAPIPermissions($entity, $action, &$params, &$permissions) {
    $permissions['membershipterms']['apicall'] = array('access CiviCRM');
} 