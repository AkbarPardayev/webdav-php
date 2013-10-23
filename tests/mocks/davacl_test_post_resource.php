<?php
/**
 * Contains the DAVACL_Test_Post_Resource class
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
 * A mock for DAVACL_Test_Resource
 * 
 * @internal
 * @package DAV
 * @subpackage tests
 */
class DAVACL_Test_Post_Resource extends DAVACL_Test_Resource {

  private $outputType = 'direct';


  public function setOutputType( $type ) {
    if ( $type === 'string' ) {
      $this->outputType = $type;
    }else{
      $this->outputType = 'direct';
    }
  }


  public function method_POST() {
    $output = 'DAVACL_Test_Post_Resource::method_POST() called with output as ' . $this->outputType . ' for resource ' . $this->path . "\n";
    switch ( $this->outputType ) {
      case 'string':
        return $output;
      default:
        print( $output );
      return;
    }
  }

} // Class DAVACL_Test_Post_Resource

// End of file