<?php
/*
+--------------------------------------------------------------------+
| CiviCRM version 4.7                                                |
+--------------------------------------------------------------------+
| Copyright CiviCRM LLC (c) 2004-2017                                |
+--------------------------------------------------------------------+
| This file is a part of CiviCRM.                                    |
|                                                                    |
| CiviCRM is free software; you can copy, modify, and distribute it  |
| under the terms of the GNU Affero General Public License           |
| Version 3, 19 November 2007 and the CiviCRM Licensing Exception.   |
|                                                                    |
| CiviCRM is distributed in the hope that it will be useful, but     |
| WITHOUT ANY WARRANTY; without even the implied warranty of         |
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.               |
| See the GNU Affero General Public License for more details.        |
|                                                                    |
| You should have received a copy of the GNU Affero General Public   |
| License and the CiviCRM Licensing Exception along                  |
| with this program; if not, contact CiviCRM LLC                     |
| at info[AT]civicrm[DOT]org. If you have questions about the        |
| GNU Affero General Public License or the licensing of CiviCRM,     |
| see the CiviCRM license FAQ at http://civicrm.org/licensing        |
+--------------------------------------------------------------------+
*/
/**
 * @package CRM
 * @copyright CiviCRM LLC (c) 2004-2017
 *
 * Generated from xml/schema/CRM/Contact/Group.xml
 * DO NOT EDIT.  Generated by CRM_Core_CodeGen
 * (GenCodeChecksum:f0c0283dd397c06e320397ca98628184)
 */
require_once 'CRM/Core/DAO.php';
require_once 'CRM/Utils/Type.php';
/**
 * CRM_Contact_DAO_Group constructor.
 */
class CRM_Membershipterms_DAO_MembershipTerms extends CRM_Core_DAO {
  /**
   * Static instance to hold the table name.
   *
   * @var string
   */
  static $_tableName = 'civicrm_membership_terms';
  /**
   * Should CiviCRM log any modifications to this table in the civicrm_log table.
   *
   * @var boolean
   */
  static $_log = true;
  /**
   * Membership Term ID
   *
   * @var int unsigned
   */
  public $id;
  /**
   * Contact Id
   *
   * @var int unsigned
   */
  public $contact_id;
  
  /**
   * Membership Id
   *
   * @var int unsigned
   */
  public $membership_id;
  
  /**
   * Membership Start Date
   *
   * @var date
   */
  public $start_date;
  
  /**
   * Membership End Date
   *
   * @var date
   */
  public $end_date;
  
  /**
   * Class constructor.
   */
  function __construct() {
    $this->__table = 'civicrm_membership_terms';
    parent::__construct();
  }
  /**
   * Returns foreign keys and entity references.
   *
   * @return array
   *   [CRM_Core_Reference_Interface]
   */
  static function getReferenceColumns() {
    if (!isset(Civi::$statics[__CLASS__]['links'])) {
      Civi::$statics[__CLASS__]['links'] = static ::createReferenceColumns(__CLASS__);
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName() , 'contact_id', 'civicrm_contact', 'id');
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName() , 'membership_id', 'civicrm_membership', 'id');
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName() , 'contribution_id', 'civicrm_contribution', 'id');
      CRM_Core_DAO_AllCoreTables::invoke(__CLASS__, 'links_callback', Civi::$statics[__CLASS__]['links']);
    }
    return Civi::$statics[__CLASS__]['links'];
  }
  /**
   * Returns all the column names of this table
   *
   * @return array
   */
  static function &fields() {
    if (!isset(Civi::$statics[__CLASS__]['fields'])) {
      Civi::$statics[__CLASS__]['fields'] = array(
        'id' => array(
          'name' => 'id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Membership Term Id') ,
          'description' => 'Membership Term Id',
          'required' => true,
          'table_name' => 'civicrm_membership_terms',
          'entity' => 'MembershipTerms',
          'bao' => 'CRM_Membershipterms_BAO_MembershipTerms',
        ) ,
        'contact_id' => array(
          'name' => 'contact_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Contact Id') ,
          'description' => 'FK to contact table.',
          'table_name' => 'civicrm_membership_terms',
          'entity' => 'MembershipTerms',
          'bao' => 'CRM_Membershipterms_BAO_MembershipTerms',
          'FKClassName' => 'CRM_Contact_DAO_Contact',
        ) ,        
        'membership_id' => array(
          'name' => 'membership_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Membership Id') ,
          'description' => 'FK to membership table.',
          'table_name' => 'civicrm_membership_terms',
          'entity' => 'MembershipTerms',
          'bao' => 'CRM_Membershipterms_BAO_MembershipTerms',
          'FKClassName' => 'CRM_Member_DAO_Membership',
        ) ,
        'contribution_id' => array(
          'name' => 'contribution_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Contribution Id') ,
          'description' => 'FK to contribution table.',
          'table_name' => 'civicrm_membership_terms',
          'entity' => 'MembershipTerms',
          'bao' => 'CRM_Membershipterms_BAO_MembershipTerms',
          'FKClassName' => 'CRM_Contribute_DAO_Contribution',
        ) ,
        'start_date' => array(
          'name' => 'start_date',
          'type' => CRM_Utils_Type::T_DATE,
          'title' => ts('Start Date') ,
          'description' => 'Start Date of Membership Term.',
          'dataPattern' => '/\d{4}-?\d{2}-?\d{2}/',
          'required' => true,
          'table_name' => 'civicrm_membership_terms',
          'entity' => 'MembershipTerms',
          'bao' => 'CRM_Membershipterms_BAO_MembershipTerms',
        ) ,
        'end_date' => array(
          'name' => 'end_date',
          'type' => CRM_Utils_Type::T_DATE,
          'title' => ts('End Date') ,
          'description' => 'End Date of Membership Term.',
          'dataPattern' => '/\d{4}-?\d{2}-?\d{2}/',  
          'required' => false,
          'table_name' => 'civicrm_membership_terms',
          'entity' => 'MembershipTerms',
          'bao' => 'CRM_Membershipterms_BAO_MembershipTerms',
        ) ,
        
      );
      CRM_Core_DAO_AllCoreTables::invoke(__CLASS__, 'fields_callback', Civi::$statics[__CLASS__]['fields']);
    }
    return Civi::$statics[__CLASS__]['fields'];
  }
  /**
   * Return a mapping from field-name to the corresponding key (as used in fields()).
   *
   * @return array
   *   Array(string $name => string $uniqueName).
   */
  static function &fieldKeys() {
    if (!isset(Civi::$statics[__CLASS__]['fieldKeys'])) {
      Civi::$statics[__CLASS__]['fieldKeys'] = array_flip(CRM_Utils_Array::collect('name', self::fields()));
    }
    return Civi::$statics[__CLASS__]['fieldKeys'];
  }
  /**
   * Returns the names of this table
   *
   * @return string
   */
  static function getTableName() {
    return CRM_Core_DAO::getLocaleTableName(self::$_tableName);
  }
  /**
   * Returns if this table needs to be logged
   *
   * @return boolean
   */
  function getLog() {
    return self::$_log;
  }
  /**
   * Returns the list of fields that can be imported
   *
   * @param bool $prefix
   *
   * @return array
   */
  static function &import($prefix = false) {
    $r = CRM_Core_DAO_AllCoreTables::getImports(__CLASS__, 'membershipterms', $prefix, array());
    return $r;
  }
  /**
   * Returns the list of fields that can be exported
   *
   * @param bool $prefix
   *
   * @return array
   */
  static function &export($prefix = false) {
    $r = CRM_Core_DAO_AllCoreTables::getExports(__CLASS__, 'membershipterms', $prefix, array());
    return $r;
  }
}
