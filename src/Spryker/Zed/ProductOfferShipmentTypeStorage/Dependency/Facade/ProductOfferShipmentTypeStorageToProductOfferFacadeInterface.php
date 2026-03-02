<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductOfferShipmentTypeStorage\Dependency\Facade;

use Generated\Shared\Transfer\ProductOfferCollectionTransfer;
use Generated\Shared\Transfer\ProductOfferCriteriaTransfer;

interface ProductOfferShipmentTypeStorageToProductOfferFacadeInterface
{
    public function getProductOfferCollection(
        ProductOfferCriteriaTransfer $productOfferCriteriaTransfer
    ): ProductOfferCollectionTransfer;
}
