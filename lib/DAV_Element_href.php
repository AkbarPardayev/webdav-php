<?php

/*·************************************************************************
 * Copyright ©2007-2011 Pieter van Beek, Almere, The Netherlands
 * 		    <http://purl.org/net/6086052759deb18f4c0c9fb2c3d3e83e>
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
 * $Id: dav_element_href.php 3364 2011-08-04 14:11:03Z pieterb $
 **************************************************************************/

/**
 * File documentation (who cares)
 * @package DAV
 */

/**
 * Set of DAV:href elements
 * @package DAV
 */
class DAV_Element_href {


/**
 * Array of properties.
 * @var array
 */
public $URIs;


/**
 * Constructor
 * 
 * @param  array|string  $URIs  Either an array of strings or a single string with the URI's to add
 */
public function __construct($URIs = null) {
  if (is_array($URIs))
    $this->URIs = $URIs;
  elseif ($URIs)
    $this->URIs = array("$URIs");
  else
    $this->URIs = array();
}


/**
 * Adds an URI to this href object
 * @param  string  $URI  The URI to add
 */
public function addURI($URI) {
  $this->URIs[] = $URI;
}


/**
 * An XML representation of the object.
 * @return string
 */
public function __toString() {
  if ( empty( $this->URIs ) ) {
    return '';
  }
  $urlEncodedURIs = array_map( array( 'DAV', 'encodeURIFullPath' ), $this->URIs );
  $xmlEncodedURIs = array_map( array( 'DAV', 'xmlescape'), $urlEncodedURIs );
  return
    '<D:href>' . implode(
      "</D:href>\n<D:href>", array_unique($xmlEncodedURIs)
    ). '</D:href>';
}


} // class DAV_Element_href

// End of file