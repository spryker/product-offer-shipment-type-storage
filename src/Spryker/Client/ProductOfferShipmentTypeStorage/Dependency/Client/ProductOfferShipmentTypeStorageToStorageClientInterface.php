<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\ProductOfferShipmentTypeStorage\Dependency\Client;

interface ProductOfferShipmentTypeStorageToStorageClientInterface
{
    public function get(string $key): mixed;
}
