<?php

class CRM_Membershipterms_BAO_MembershipTerms extends CRM_Membershipterms_DAO_MembershipTerms
{
    /**
     * Create a new MembershipTerms based on array-data
     *
     * @param array $params key-value pairs
     * @return CRM_Membershipterms_DAO_MembershipTerms|NULL
     */
    public static function create($params)
    {
        $membershipTerms = new CRM_Membershipterms_DAO_MembershipTerms();
        $membershipTerms -> copyValues($params);
//        $membershipTerms->contact_id = $params['contact_id'];
//        $membershipTerms->membership_id = $params['membership_id'];
//        $membershipTerms->contribution_id = $params['contribution_id'];
//        $membershipTerms->start_date = $params['start_date'];
//        $membershipTerms->end_date = $params['end_date'];
        $membershipTerms -> save();
        return $membershipTerms;
    }
  
//    /**
//     * Get membership term records by contact id
//     *
//     * @param array $params key-value pairs
//     * @return array
//     */
//    public function get($params)
//    {
//        $query = 'SELECT mt.* from civicrm_membership_terms mt '
//                . 'JOIN civicrm_contact c on c.id = mt.contact_id '
//                . 'JOIN civicrm_contribution co on co.id = mt.contribution_id '
//                . 'JOIN civicrm_membership m1 on m1.contact_id = c.id '
//                . 'JOIN civicrm_membership m2 on m2.id = mt.membership_id '
//                . 'WHERE mt.contact_id = %1';
//        $params = [1 => [$params['contact_id'], 'Integer']];
//        return CRM_Core_DAO::executeQuery($query, $params)->fetchAll();
//    }
    
    /**
     * Get membership term records count by contact id
     *
     * @param array $params key-value pairs
     * @return integer 
     */
//    public function getcount($params)
//    {
//        $membershipTerms = new CRM_Membershipterms_DAO_MembershipTerms();
//        $membershipTerms->whereAdd('contact_id = '.$params['contact_id']);
//        return $membershipTerms->count();
//    }
    
    //get membership terms count by contact id
//    public static function del($id)
//    {   
//        $membershipTerms = new CRM_Membershipterms_DAO_MembershipTerms();
//        $membershipTerms->id = $id;
//        return $membershipTerms->delete();
//    }
}