<?php

namespace App\Tests\Unit;

use App\Entity\Task;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskTest extends WebTestCase
{


    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    // Without login in this case off course
    public function testCanCreateTask(): void
    {
        $task = new Task();
        $task->setTitle('added');
        $task->setAuthor('added author');
        $task->setStatus(true);

        $taskRepository = $this->createMock(ObjectRepository::class);
        $taskRepository
            ->method('find')
            ->willReturn($task);

        $objectManager = $this->createMock(ObjectManager::class);
        $objectManager
            ->method('getRepository')
            ->willReturn($taskRepository);

        self::assertEquals('added', $task->getTitle());
        self::assertEquals('added author', $task->getAuthor());
        self::assertEquals(true, $task->getStatus());
    }
}