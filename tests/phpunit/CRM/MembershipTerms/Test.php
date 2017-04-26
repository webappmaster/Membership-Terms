<?php

use Civi\Test\HeadlessInterface;
use Civi\Test\HookInterface;
use Civi\Test\TransactionalInterface;

/**
 * Tests for Membership Terms API
 *
 * Tips:
 *  - With HookInterface, you may implement CiviCRM hooks directly in the test class.
 *    Simply create corresponding functions (e.g. "hook_civicrm_post(...)" or similar).
 *  - With TransactionalInterface, any data changes made by setUp() or test****() functions will
 *    rollback automatically -- as long as you don't manipulate schema or truncate tables.
 *    If this test needs to manipulate schema or truncate tables, then either:
 *       a. Do all that using setupHeadless() and Civi\Test.
 *       b. Disable TransactionalInterface, and handle all setup/teardown yourself.
 *
 * @group headless
 */
class CRM_MembershipTerms_Test extends \PHPUnit_Framework_TestCase implements HeadlessInterface, HookInterface, TransactionalInterface {

  protected $_apiversion;
  protected $_membershiptermID;
  protected $_membershiptermID2;
  protected $_contactID;
  protected $_membershipID;
  protected $_contributionID;
  protected $_startDATE;
  protected $_endDATE;
  protected $_entity;
  protected $_params;
    
  public function setUpHeadless() {
    // Civi\Test has many helpers, like install(), uninstall(), sql(), and sqlFile().
    // See: https://github.com/civicrm/org.civicrm.testapalooza/blob/master/civi-test.md
    return \Civi\Test::headless()
      ->installMe(__DIR__)
      ->apply();
  }

  public function setUp() {
    parent::setUp();
    $this->_apiversion = 3;
    $this->_contactID = $this->individualCreate();
    $this->_membershipID = $this->contactMembershipCreate(array('membership_type_id' => 'student','contact_id' => $this->_contactID));
    $this->_contributionID = $this->contributionCreate(array(
        'contact_id' => $this->_contactID,
        'is_test' => 1,
        'financial_type_id' => 1,
        'invoice_id' => 'abcd',
        'trxn_id' => 345,
      ));
    $this->_startDATE = date('Ymd');
    
    $this->_entity = 'MembershipTerms';
    $this->_params = array(
      'contact_id' => $this->_contactID,
      'membership_id' => $this->_membershipID,
      'contribution_id' => $this->_contributionID,
      'start_date' => $this->_startDATE,
    );
  }

  public function tearDown() {
    parent::tearDown();
  }

  /**
   * Test for Membership Term "create" method
   */
  public function testMembershiptermCreate() {
    $membershiptermID = $this->contactMembershiptermCreate($this->_params);
    //fwrite(STDERR, print_r($this->_params, true));
    //fwrite(STDERR, $membershiptermID);die;
    $params = ['id' => $membershiptermID];
    $result = $this->membershiptermGet($params);
    
    $this->assertGreaterThanOrEqual(1, $result['id']);
  }
  

  /**
   * Test for Membership Term "get" method
   */
  public function testMembershiptermGet()
  {
    $membershiptermID = $this->contactMembershiptermCreate($this->_params);
    
    $params = ['id' => $membershiptermID];
    $result = $this->membershiptermGet($params);
    $this->assertGreaterThanOrEqual(1, $result['id']);
  }
  
  
  /**
   * Test for Membership Term "delete" method
   */
  public function testMembershiptermDelete() {
    $membershiptermID = $this->contactMembershiptermCreate($this->_params);
    $this->assertGreaterThanOrEqual(1, $membershiptermID);
    
    //delete Membership Term
    $params = ['id'=>$membershiptermID];
    $result = $this->contactMembershiptermDelete($params);

    //fwrite(STDERR, print_r($result, true) );die;
    $this->assertEquals(0, $result['is_error']);
  }
  
  /**
   * Test for Membership Term "get" method by id and then resulted contact_id parameter
   */
  public function testGetWithParamsContactId() {
    $membershiptermID = $this->contactMembershiptermCreate($this->_params);
    
    $params = ['id'=> $membershiptermID];
    $result = $this->membershiptermGet($params);
    $this->assertGreaterThanOrEqual(1, $result['id']);
    
    $params = ['contact_id'=> $result['values'][$result['id']]['contact_id']];
    $result = $this->membershiptermGet($params);
    $this->assertEquals(1, $result['count']);
  }
  
  /**
   * Test for Membership Term "get" method for "in" and "not in" conditions
   */
  public function testGetInSyntax() {
    $this->_membershiptermID = $this->contactMembershiptermCreate($this->_params);
    $this->_membershiptermID2 = $this->contactMembershiptermCreate($this->_params);

    $params = array(
      'id' => array('IN' => array($this->_membershiptermID, $this->_membershiptermID2)),
    );
    $membershipterms = $this->membershiptermGet($params);
    $this->assertEquals(2, $membershipterms['count']);
    $this->assertEquals(array($this->_membershiptermID, $this->_membershiptermID2), array_keys($membershipterms['values']));
    $params = array(
      'id' => array('NOT IN' => array($this->_membershiptermID, 0)),
    );
    $membershipterms = $this->membershiptermGet($params);
    $this->assertEquals(1, $membershipterms['count']);
  }

  
  /*
   * Helper function for Membership Term "get" method
   */
  private function membershiptermGet($params)
  {
    $result = civicrm_api3('MembershipTerms', 'get', $params);
    return $result;
  }
  
  /*
   * Helper function for contact "create" method
   */
  private function individualCreate()
  {
    $result = civicrm_api3('Contact', 'create', array(
      'sequential' => 1,
      'contact_type' => "Individual",
      'first_name' => "Alpesh",
      'last_name' => "Panchal",
    ));
    
    //fwrite(STDERR, print_r($result, true) );
    //die;
    return $result['id'];
  }
  
  
  /*
   * Helper function for Membership "create" method
   */
  private function contactMembershipCreate($params)
  {
    $params = array_merge(array(
      'join_date' => date('Y-m-d'),
      'start_date' => date('Y-m-d'),
      'end_date' => date('Y-m-d', strtotime(date('Y-m-d'). ' + 1 year')) ,
      'source' => 'Payment',
      'membership_type_id' => 'Student',
    ), $params);
          
    $result = civicrm_api3('Membership', 'create', array(
      'sequential' => 1,
      'membership_type_id' => "Student",
      'contact_id' => $params['contact_id'],
    ));
    
    //fwrite(STDERR, print_r($result,true) );
    //die;
    return $result['id'];
    
  }
  
  
  /*
   * Helper function for contribution "create" method
   */
  private function contributionCreate($params)
  {
    $params = array_merge(array(
      'domain_id' => 1,
      'receive_date' => date('Ymd'),
      'total_amount' => 100.00,
      'fee_amount' => 5.00,
      'financial_type_id' => 1,
      'payment_instrument_id' => 1,
      'non_deductible_amount' => 10.00,
      'trxn_id' => 12345,
      'invoice_id' => 67890,
      'source' => 'SSF',
      'contribution_status_id' => 1,
    ), $params);

    $result = civicrm_api3('Contribution', 'create', $params);
    //fwrite(STDERR, print_r($result,true) );
    //die;
    return $result['id'];
  }
  
  /*
   * Helper function for membership term "create" method
   */
  private function contactMembershiptermCreate($params) {
      
    $params = array_merge(array(
      'contact_id' => $params['contact_id'],
      'membership_id' => $params['membership_id'],
      'contribution_id' => $params['contribution_id'],
      'start_date' => $params['start_date'],
    ), $params);

    $result = civicrm_api3('MembershipTerms', 'create', $params);
    
    return $result['id'];
  }
  
  /*
   * Helper function for membership term "delete" method
   */
  private function contactMembershiptermDelete($params) {
    $params = array_merge(array(
        'id' => $params['id'],
    ), $params);

    $result = civicrm_api3('MembershipTerms', 'delete', $params);
    
    return $result;
  }
  
}
