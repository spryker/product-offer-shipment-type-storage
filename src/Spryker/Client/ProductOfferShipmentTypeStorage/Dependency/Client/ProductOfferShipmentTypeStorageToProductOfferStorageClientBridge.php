<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\ProductOfferShipmentTypeStorage\Dependency\Client;

use Generated\Shared\Transfer\ProductOfferStorageCollectionTransfer;
use Generated\Shared\Transfer\ProductOfferStorageCriteriaTransfer;

class ProductOfferShipmentTypeStorageToProductOfferStorageClientBridge implements ProductOfferShipmentTypeStorageToProductOfferStorageClientInterface
{
    /**
     * @var \Spryker\Client\ProductOfferStorage\ProductOfferStorageClientInterface
     */
    protected $productOfferStorageClient;

    /**
     * @param \Spryker\Client\ProductOfferStorage\ProductOfferStorageClientInterface $productOfferStorageClient
     */
    public function __construct($productOfferStorageClient)
    {
        $this->productOfferStorageClient = $productOfferStorageClient;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductOfferStorageCriteriaTransfer $productOfferStorageCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\ProductOfferStorageCollectionTransfer
     */
    public function getProductOfferStoragesBySkus(
        ProductOfferStorageCriteriaTransfer $productOfferStorageCriteriaTransfer
    ): ProductOfferStorageCollectionTransfer {
        return $this->productOfferStorageClient->getProductOfferStoragesBySkus($productOfferStorageCriteriaTransfer);
    }
}
