<?php

namespace App\DataFixtures;

use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TaskFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $task = new Task();
        $task->setAuthor('Mike');
        $task->setTitle('Test Task');
        $task->setStatus(true);

        $manager->persist($task);

        $manager->flush();
    }
}
