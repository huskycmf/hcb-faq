<?php
namespace HcbFaq\Service;

use Doctrine\ORM\EntityManagerInterface;
use HcbFaq\Entity\Faq as FaqEntity;
use HcCore\Service\CommandInterface;
use HcbFaq\Stdlib\Service\Response\CreateResponse;

class CreateService implements CommandInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var CreateResponse
     */
    protected $createResponse;

    /**
     * @param EntityManagerInterface $entityManager
     * @param CreateResponse $createResponse
     */
    public function __construct(EntityManagerInterface $entityManager,
                                CreateResponse $createResponse)
    {
        $this->entityManager = $entityManager;
        $this->createResponse = $createResponse;
    }

    /**
     * @return CreateResponse
     */
    public function execute()
    {
        try {
            $this->entityManager->beginTransaction();

            $faqEntity = new FaqEntity();
            $faqEntity->setCreatedTimestamp(new \DateTime());

            $this->entityManager->persist($faqEntity);

            $this->entityManager->flush();

            $this->createResponse->setResource($faqEntity->getId());
            
            $this->entityManager->commit();
        } catch (\Exception $e) {
            $this->entityManager->rollback();
            $this->createResponse->error($e->getMessage())->failed();
            return $this->createResponse;
        }

        $this->createResponse->success();
        return $this->createResponse;
    }
}
