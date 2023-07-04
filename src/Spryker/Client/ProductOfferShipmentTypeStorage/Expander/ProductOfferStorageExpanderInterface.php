<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\ProductOfferShipmentTypeStorage\Expander;

use Generated\Shared\Transfer\ProductOfferStorageTransfer;

interface ProductOfferStorageExpanderInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductOfferStorageTransfer $productOfferStorageTransfer
     *
     * @return \Generated\Shared\Transfer\ProductOfferStorageTransfer
     */
    public function expandProductOfferStorageWithShipmentTypes(ProductOfferStorageTransfer $productOfferStorageTransfer): ProductOfferStorageTransfer;
}
