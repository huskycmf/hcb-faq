<?php
namespace HcbFaq\Service;

use HcbStoreProduct\Entity\Product as ProductEntity;
use HcbFaq\ORM\QueryBuilder\ProductDeal;
use HcbFaq\Strategy\FactoryStrategy;

class ProductDealPriceService
{
    /**
     * @var ProductDeal
     */
    protected $productDeal;

    /**
     * @var FactoryStrategy
     */
    protected $dealStrategyFactory;

    public function __construct(ProductDeal $productDeal,
                                FactoryStrategy $dealStrategyFactory)
    {
        $this->productDeal = $productDeal;
        $this->dealStrategyFactory = $dealStrategyFactory;
    }

    /**
     * @param ProductEntity $productEntity
     * @return float
     */
    public function get(ProductEntity $productEntity)
    {
        $dealQb = $this->productDeal->get($productEntity);

        /* @var $faqEntity \HcbFaq\Entity\Faq */
        $faqEntity = $dealQb->setMaxResults(1)->getQuery()
                             ->getOneOrNullResult();

        $dealPrice = $productEntity->getPriceDeal();

        if (is_null($faqEntity)) {
            if ($dealPrice) {
                return $dealPrice;
            }
            return $productEntity->getPrice();
        }

        $strategy = $this->dealStrategyFactory->createStrategy($faqEntity);
        $dealPrice = $strategy->getPrice($productEntity->getPrice());

        return $dealPrice;
    }
}
