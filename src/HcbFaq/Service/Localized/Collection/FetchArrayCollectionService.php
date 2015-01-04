<?php
namespace HcbFaq\Service\Localized\Collection;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use HcbFaq\Entity\Faq as FaqEntity;
use HcCore\Service\Fetch\Paginator\ArrayCollection\ResourceDataServiceInterface;
use HcCore\Service\Filtration\Query\FiltrationServiceInterface;
use HcbStoreProduct\Service\Exception\InvalidResourceException;
use Zend\Stdlib\Parameters;

class FetchArrayCollectionService implements ResourceDataServiceInterface
{
    /**
     * @var FiltrationServiceInterface
     */
    protected $filtrationService;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     * @param FiltrationServiceInterface $filtrationService
     */
    public function __construct(EntityManagerInterface $entityManager,
                                FiltrationServiceInterface $filtrationService)
    {
        $this->entityManager = $entityManager;
        $this->filtrationService = $filtrationService;
    }

    /**
     * @param FaqEntity $faqEntity
     * @param Parameters $params
     *
     * @return ArrayCollection
     * @throws InvalidResourceException
     */
    public function fetch($faqEntity, Parameters $params = null)
    {
        if (!$faqEntity instanceof FaqEntity) {
            throw new InvalidResourceException('faqEntity must be compatible with type HcbFaq\Entity\Faq');
        }

        /* @var $localizedRepository \Doctrine\ORM\EntityRepository */
        $localizedRepository = $this->entityManager
                                    ->getRepository('HcbFaq\Entity\Faq\Localized');

        $qb = $localizedRepository->createQueryBuilder('l');

        $qb->join('l.locale', 'locale')
           ->where('l.faq = :faq');

        $qb->setParameter('faq', $faqEntity);

        if (is_null($params)) {
            $result = $qb->getQuery()->getResult();
        } else {
            $result = $this->filtrationService
                           ->apply($params, $qb, 'l', array('lang'=>'locale.locale'))
                           ->getQuery()->getResult();
        }

        if (!count($result)) {
            $result[0] = new FaqEntity\Localized();
            $result[0]->setFaq($faqEntity);
        }

        return new ArrayCollection($result);
    }
}
