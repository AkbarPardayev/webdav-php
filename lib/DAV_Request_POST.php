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
 * $Id: dav_request_post.php 3349 2011-07-28 13:04:24Z pieterb $
 **************************************************************************/

/**
 * File documentation (who cares)
 * @package DAV
 */

/**
 * POST
 * @internal
 * @package DAV
 */
class DAV_Request_POST extends DAV_Request {


/**
 * Handles a POST request
 * @param DAV_Resource $resource
 * @return void
 * @throws DAV_Status
 */
public function handle($resource) {
  $resource->assertLock();
  $headers = array();
  try {
    ob_start();
    $entity = $resource->method_POST($headers);
  }
  catch (DAV_Status $e) {
    ob_end_clean();
    throw $e;
  }

  if ($length = ob_get_length()) {
    $headers['Content-Length'] = $length;
    DAV::header($headers);
    ob_end_flush();
    return;
  } else {
    ob_end_clean();
  }

  if (is_string($entity)) {
    $headers['Content-Length'] = strlen($entity);
    DAV::header($headers);
    echo $entity;
    return;
  }
  DAV::header($headers);
}


} // class

