<?php

namespace App\Tests;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use PHPUnit\Framework\Exception;

class KernelTestCase extends \Symfony\Bundle\FrameworkBundle\Test\KernelTestCase
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * {@inheritDoc}
     * @throws \Exception
     */
    protected function setUp()
    {

        $this->entityManager = $this->getEntityManager();

        $this->updateSchema();
    }

    private function updateSchema(): void
    {
        $schemaTool = new SchemaTool($this->entityManager);
        $schemaTool->updateSchema($this
            ->getEntityManager()
            ->getMetadataFactory()
            ->getAllMetadata()
        );
    }

    private function getEntityManager(): EntityManager
    {
        if (empty($this->entityManager)) {
            $this->entityManager = $this->createEntityManager();
        }

        return $this->entityManager;
    }

    private function createEntityManager(): EntityManager
    {
        $kernel = self::bootKernel();

        $container = $kernel->getContainer();
        if (empty($container)) {
            throw new Exception('Kernel container not found');
        }

        $doctrine = $container->get('doctrine');
        $entityManager = $doctrine->getManager();
        if ($entityManager instanceof EntityManager) {
            return $entityManager;
        }

        throw new Exception('Doctrine container not found');
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        $entityManager = $this->entityManager;

        $entityManager->close();
        $entityManager = null; // avoid memory leaks
    }
}
