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
 * $Id: dav_request_mkcol.php 3349 2011-07-28 13:04:24Z pieterb $
 **************************************************************************/

/**
 * File documentation (who cares)
 * @package DAV
 */

/**
 * Helper class for parsing LOCK request bodies.
 * @internal
 * @package DAV
 */
class DAV_Request_MKCOL extends DAV_Request {


/**
 * Checks and handles MKCOL request
 * @param DAV_Resource $resource
 * @return void
 * @throws DAV_Status
 */
protected function handle( $resource )
{

  if ($resource) {
    if ( $resource->isVisible() )
      throw new DAV_Status(DAV::HTTP_METHOD_NOT_ALLOWED);
    throw DAV::forbidden();
  }
  $resource = DAV::$REGISTRY->resource(dirname(DAV::getPath()));
  if ( !$resource or !$resource->isVisible() )
    throw new DAV_Status( DAV::HTTP_CONFLICT, 'Unable to MKCOL in unknown resource' );

  if ( ! $resource instanceof DAV_Collection )
    throw new DAV_Status(DAV::HTTP_METHOD_NOT_ALLOWED);
  if ( 0 < (int)@$_SERVER['CONTENT_LENGTH'] )
    throw new DAV_Status(DAV::HTTP_UNSUPPORTED_MEDIA_TYPE);
  $resource->assertLock();
  $resource->method_MKCOL( basename(DAV::getPath()) );
  DAV::redirect(DAV::HTTP_CREATED, DAV::getPath());
}


} // class

