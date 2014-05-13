<?php
  namespace WebDev;

  class AgentSteps extends LoginSteps {

    public static $agentData = array(
      'id'              => 1,
      'deleted_at'      => NULL,
      'org_email'       => 'test_owner@example.com',
      'org_name'        => 'Test Owner',
      'ind_affiliation' => 'my affiliation',
      'ind_role'        => NULL,
      'address1'        => 'my address 1',
      'address2'        => 'my address 2',
      'city'            => 'my city',
      'state'           => 'my',
      'postal_code'     => 'my postal code',
      'country'         => 'US',
      'phone'           => 'my phone',
      'web_address'     => 'http://mywebaddress.com',
      'type'            => 'Individual',
    );

    public static $agentAdminData = array(
      'id'               => 1,
      'deleted_at'       => NULL,
      'user_id'          => 5,
      'agent_id'         => 1,
      'is_registrar_for' => 1,
      'is_admin_for'     => 1,
    );

    public static $agentUserData = array(
      'id'               => 2,
      'deleted_at'       => NULL,
      'user_id'          => 1,
      'agent_id'         => 1,
      'is_registrar_for' => 0,
      'is_admin_for'     => 0,
    );

    function seeEmptyAgentList() {
      $I = $this;
    }

    function seeSingleAgentList() {
      $I = $this;
    }

    function amOnAgentListPage() {
      $I = $this;
    }
  }
