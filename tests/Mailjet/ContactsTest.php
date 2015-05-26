<?php

namespace Mailjet\API\Test;

use Mailjet\API\Client as Mailjet;

class ContactsTest extends \PHPUnit_Framework_TestCase
{
    protected $mailjet;

    public function setUp()
    {
        $this->mailjet = new Mailjet(getenv('API_KEY'), getenv('API_SECRET_KEY'));
    }

    public function testListContacts()
    {
        /* @link http://dev.mailjet.com/email-api/v3/contact/ */
        $this->mailjet->contact();

        $this->assertEquals(200, $this->mailjet->getResponseCode());
    }

    public function testCreateContactslist()
    {
        $params = array(
            'method'  => 'POST',
            'Address' => 'testcreatecontactslist@gmail.com',
            'Name'    => 'testCreateContactslist'
        );
        /* @link http://dev.mailjet.com/email-api/v3/contactslist/ */
        $this->mailjet->contactslist($params);

        $this->assertEquals(201, $this->mailjet->getResponseCode());
    }

    public function testDeleteLastContactslist()
    {
        /* @link http://dev.mailjet.com/email-api/v3/contactslist/ */
        $this->mailjet->contactslist();

        $lastid = $this->mailjet->_response->Data[count($this->mailjet->_response->Data) - 1]->ID;

        $params = array(
            'method' => 'DELETE',
            'ID'     => $lastid
        );
        $this->mailjet->contactslist($params);

        $this->assertEquals(204, $this->mailjet->getResponseCode());
    }
}
