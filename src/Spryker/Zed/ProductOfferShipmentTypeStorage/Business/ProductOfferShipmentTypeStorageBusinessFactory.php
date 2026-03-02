<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductOfferShipmentTypeStorage\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\ProductOfferShipmentTypeStorage\Business\Deleter\ProductOfferShipmentTypeStorageDeleter;
use Spryker\Zed\ProductOfferShipmentTypeStorage\Business\Deleter\ProductOfferShipmentTypeStorageDeleterInterface;
use Spryker\Zed\ProductOfferShipmentTypeStorage\Business\Extractor\ProductOfferExtractor;
use Spryker\Zed\ProductOfferShipmentTypeStorage\Business\Extractor\ProductOfferExtractorInterface;
use Spryker\Zed\ProductOfferShipmentTypeStorage\Business\Extractor\ProductOfferShipmentTypeExtractor;
use Spryker\Zed\ProductOfferShipmentTypeStorage\Business\Extractor\ProductOfferShipmentTypeExtractorInterface;
use Spryker\Zed\ProductOfferShipmentTypeStorage\Business\Reader\ProductOfferShipmentTypeReader;
use Spryker\Zed\ProductOfferShipmentTypeStorage\Business\Reader\ProductOfferShipmentTypeReaderInterface;
use Spryker\Zed\ProductOfferShipmentTypeStorage\Business\Reader\ProductOfferShipmentTypeStorageReader;
use Spryker\Zed\ProductOfferShipmentTypeStorage\Business\Reader\ProductOfferShipmentTypeStorageReaderInterface;
use Spryker\Zed\ProductOfferShipmentTypeStorage\Business\Writer\ProductOfferEventsWriter;
use Spryker\Zed\ProductOfferShipmentTypeStorage\Business\Writer\ProductOfferEventsWriterInterface;
use Spryker\Zed\ProductOfferShipmentTypeStorage\Business\Writer\ProductOfferShipmentTypeEventsWriter;
use Spryker\Zed\ProductOfferShipmentTypeStorage\Business\Writer\ProductOfferShipmentTypeEventsWriterInterface;
use Spryker\Zed\ProductOfferShipmentTypeStorage\Business\Writer\ProductOfferShipmentTypeStorageWriter;
use Spryker\Zed\ProductOfferShipmentTypeStorage\Business\Writer\ProductOfferShipmentTypeStorageWriterInterface;
use Spryker\Zed\ProductOfferShipmentTypeStorage\Business\Writer\ShipmentTypeEventsWriter;
use Spryker\Zed\ProductOfferShipmentTypeStorage\Business\Writer\ShipmentTypeEventsWriterInterface;
use Spryker\Zed\ProductOfferShipmentTypeStorage\Dependency\Facade\ProductOfferShipmentTypeStorageToEventBehaviorFacadeInterface;
use Spryker\Zed\ProductOfferShipmentTypeStorage\Dependency\Facade\ProductOfferShipmentTypeStorageToProductOfferFacadeInterface;
use Spryker\Zed\ProductOfferShipmentTypeStorage\Dependency\Facade\ProductOfferShipmentTypeStorageToProductOfferShipmentTypeFacadeInterface;
use Spryker\Zed\ProductOfferShipmentTypeStorage\Dependency\Facade\ProductOfferShipmentTypeStorageToStoreFacadeInterface;
use Spryker\Zed\ProductOfferShipmentTypeStorage\ProductOfferShipmentTypeStorageDependencyProvider;

/**
 * @method \Spryker\Zed\ProductOfferShipmentTypeStorage\ProductOfferShipmentTypeStorageConfig getConfig()
 * @method \Spryker\Zed\ProductOfferShipmentTypeStorage\Persistence\ProductOfferShipmentTypeStorageEntityManagerInterface getEntityManager()
 * @method \Spryker\Zed\ProductOfferShipmentTypeStorage\Persistence\ProductOfferShipmentTypeStorageRepositoryInterface getRepository()
 */
class ProductOfferShipmentTypeStorageBusinessFactory extends AbstractBusinessFactory
{
    public function createProductOfferShipmentTypeStorageWriter(): ProductOfferShipmentTypeStorageWriterInterface
    {
        return new ProductOfferShipmentTypeStorageWriter(
            $this->createProductOfferShipmentTypeReader(),
            $this->createProductOfferShipmentTypeStorageDeleter(),
            $this->getEntityManager(),
            $this->createProductOfferShipmentTypeExtractor(),
            $this->getStoreFacade(),
        );
    }

    public function createProductOfferEventsWriter(): ProductOfferEventsWriterInterface
    {
        return new ProductOfferEventsWriter(
            $this->getEventBehaviorFacade(),
            $this->createProductOfferShipmentTypeStorageWriter(),
        );
    }

    public function createProductOfferShipmentTypeEventsWriter(): ProductOfferShipmentTypeEventsWriterInterface
    {
        return new ProductOfferShipmentTypeEventsWriter(
            $this->createProductOfferShipmentTypeReader(),
            $this->getEventBehaviorFacade(),
            $this->createProductOfferShipmentTypeStorageWriter(),
        );
    }

    public function createShipmentTypeEventsWriter(): ShipmentTypeEventsWriterInterface
    {
        return new ShipmentTypeEventsWriter(
            $this->createProductOfferShipmentTypeReader(),
            $this->getEventBehaviorFacade(),
            $this->createProductOfferShipmentTypeStorageWriter(),
        );
    }

    public function createProductOfferShipmentTypeReader(): ProductOfferShipmentTypeReaderInterface
    {
        return new ProductOfferShipmentTypeReader(
            $this->getConfig(),
            $this->createProductOfferShipmentTypeExtractor(),
            $this->getProductOfferShipmentTypeFacade(),
            $this->getProductOfferShipmentTypeStorageFilterPlugins(),
        );
    }

    public function createProductOfferShipmentTypeStorageDeleter(): ProductOfferShipmentTypeStorageDeleterInterface
    {
        return new ProductOfferShipmentTypeStorageDeleter(
            $this->getEntityManager(),
            $this->createProductOfferExtractor(),
            $this->getProductOfferFacade(),
        );
    }

    public function createProductOfferShipmentTypeStorageReader(): ProductOfferShipmentTypeStorageReaderInterface
    {
        return new ProductOfferShipmentTypeStorageReader(
            $this->getRepository(),
            $this->createProductOfferExtractor(),
            $this->getProductOfferFacade(),
        );
    }

    public function createProductOfferShipmentTypeExtractor(): ProductOfferShipmentTypeExtractorInterface
    {
        return new ProductOfferShipmentTypeExtractor();
    }

    public function createProductOfferExtractor(): ProductOfferExtractorInterface
    {
        return new ProductOfferExtractor();
    }

    public function getProductOfferShipmentTypeFacade(): ProductOfferShipmentTypeStorageToProductOfferShipmentTypeFacadeInterface
    {
        return $this->getProvidedDependency(ProductOfferShipmentTypeStorageDependencyProvider::FACADE_PRODUCT_OFFER_SHIPMENT_TYPE);
    }

    public function getProductOfferFacade(): ProductOfferShipmentTypeStorageToProductOfferFacadeInterface
    {
        return $this->getProvidedDependency(ProductOfferShipmentTypeStorageDependencyProvider::FACADE_PRODUCT_OFFER);
    }

    public function getStoreFacade(): ProductOfferShipmentTypeStorageToStoreFacadeInterface
    {
        return $this->getProvidedDependency(ProductOfferShipmentTypeStorageDependencyProvider::FACADE_STORE);
    }

    public function getEventBehaviorFacade(): ProductOfferShipmentTypeStorageToEventBehaviorFacadeInterface
    {
        return $this->getProvidedDependency(ProductOfferShipmentTypeStorageDependencyProvider::FACADE_EVENT_BEHAVIOR);
    }

    /**
     * @return list<\Spryker\Zed\ProductOfferShipmentTypeStorageExtension\Dependency\Plugin\ProductOfferShipmentTypeStorageFilterPluginInterface>
     */
    public function getProductOfferShipmentTypeStorageFilterPlugins(): array
    {
        return $this->getProvidedDependency(ProductOfferShipmentTypeStorageDependencyProvider::PLUGINS_PRODUCT_OFFER_SHIPMENT_TYPE_STORAGE_FILTER);
    }
}
