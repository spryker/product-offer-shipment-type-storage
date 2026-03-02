<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\ProductOfferShipmentTypeStorage\Dependency\Client;

use Generated\Shared\Transfer\StoreTransfer;

interface ProductOfferShipmentTypeStorageToStoreClientInterface
{
    public function getCurrentStore(): StoreTransfer;
}
