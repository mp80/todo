<?php

namespace App\Tests\Controller;

use App\Entity\Task;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{

    /**
     * @var EntityManager
     */
    private $entityManager;

    private $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    // Check if records exist in database via Fixtures
    public function testTaskAvailableInDatabase(): void
    {
        $task = $this->entityManager
            ->getRepository(Task::class)
            ->findOneBy(['title' => 'Test Task'])
        ;
        self::assertSame('Test Task', $task->getTitle());
    }

    // Check is page is reachable and contains values from the Fixtures
    public function testTaskVisibleOnPage(): void
    {
        $this->client->request('GET', '/');
        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('.widget-heading', 'Test Task');
        self::assertSelectorTextContains('.widget-subheading', 'Mike');
    }
}