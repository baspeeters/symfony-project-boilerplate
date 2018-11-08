<?php

namespace App\Tests;

use Doctrine\ORM\Tools\SchemaTool;

class KernelTestCase extends \Symfony\Bundle\FrameworkBundle\Test\KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->updateSchema();
    }

    private function updateSchema(): void
    {
        $schemaTool = new SchemaTool($this->entityManager);
        $schemaTool->updateSchema($this
            ->entityManager
            ->getMetadataFactory()
            ->getAllMetadata()
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null; // avoid memory leaks
    }
}
