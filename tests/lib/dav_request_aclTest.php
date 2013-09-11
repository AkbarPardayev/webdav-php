<?php
/**
 * Contains tests for the DAV_Request_ACL class
 * 
 * Copyright ©2013 SURFsara b.v., Amsterdam, The Netherlands
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at <http://www.apache.org/licenses/LICENSE-2.0>
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 * @package DAV
 * @subpackage tests
 */

/**
 * Contains tests for the DAV_Request_ACL class
 * @package DAV
 * @subpackage tests
 */
class DAV_Request_ACLTest extends PHPUnit_Framework_TestCase {

  public function testConstructor() {
    $_SERVER['REQUEST_URI'] = '/path';
    $obj = DAV_Test_Request_ACL::inst();
    
    $ace1 = new DAVACL_Element_ace( DAVACL::PRINCIPAL_ALL, false, array( DAVACL::PRIV_READ ), false );
    $ace2 = new DAVACL_Element_ace( '/path/to/user', false, array( DAVACL::PRIV_ALL ), false );
    $this->assertEquals( array( $ace1, $ace2 ), $obj->aces, 'DAV_Request_ACL::__construct() should parse input XML correctly' );
  }


  public function testHandle() {
    $this->assertTrue( false, 'continue with this test' );
  }

} // class DAV_Request_ACLTest


class DAV_Test_Request_ACL extends DAV_Request_ACL {

  public static function inst() {
    $class = __CLASS__;
    return new $class();
  }


  protected static function inputstring() {
    return <<<EOS
<?xml version="1.0" encoding="utf-8" ?>
<acl xmlns="DAV:">
  <ace>
    <principal>
      <all />
    </principal>
    <grant>
      <privilege>
        <read/>
      </privilege>
    </grant>
  </ace>
  <ace>
    <principal>
      <href><![CDATA[/path/to/user]]></href>
    </principal>
    <grant>
      <privilege>
        <all/>
      </privilege>
    </grant>
  </ace>
</acl>
EOS
    ;
  }

} // Class DAV_Test_Request_ACL

// End of file