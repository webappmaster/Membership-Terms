<?php

class CRM_Membershipterms_Page_MembershipTerms extends CRM_Core_Page {

  public function run() {
    // Example: Set the page-title dynamically; alternatively, declare a static title in xml/Menu/*.xml
    CRM_Utils_System::setTitle(ts('MembershipTerms'));

    // Example: Assign a variable for use in a template
    $this->assign('currentTime', date('Y-m-d H:i:s'));

    //fetch membership terms for a given contact
    $cid = CRM_Utils_Array::value('cid', $_GET, 0);
    if(is_numeric($cid) && $cid > 0 )
    {
        $query = 'SELECT mt.start_date, mt.end_date, mt.contribution_id, mt.contact_id as cid from civicrm_membership_terms mt '
                . 'JOIN civicrm_contact c on c.id = mt.contact_id '
                . 'JOIN civicrm_contribution co on co.id = mt.contribution_id '
                . 'JOIN civicrm_membership m1 on m1.contact_id = c.id '
                . 'JOIN civicrm_membership m2 on m2.id = mt.membership_id '
                . 'WHERE mt.contact_id = %1';
        
        $params = [1 => [$cid, 'Integer']];
        $membership_terms = CRM_Core_DAO::executeQuery($query, $params)->fetchAll() ;
        
        //get contact details
        $contact = civicrm_api3('Contact', 'get', array(
          'sequential' => 1,
          'id' => $cid,
        ));
        
        //assign varaibles to smarty template
        $this->assign('membership_terms', $membership_terms);
        $this->assign('contact', isset($contact['values'][0])?$contact['values'][0]:[] );
    }
    
    parent::run();
  }

}
