<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\AddTaskType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ToDoListController extends AbstractController
{
    /**
     * @Route("/", name="todo")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $repository = $this->getDoctrine()->getRepository(Task::class);
        $tasks = $repository->findAll();
        $task = new Task();
        $form = $this->createForm(AddTaskType::class, $task, [
            'action' => $this->generateUrl('todo'),
            'method' => 'POST'
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();
            return $this->redirectToRoute('todo');
        }
        return $this->render('to_do_list/index.html.twig', [
            'task_form' => $form->createView(),
            'tasks' => $tasks
        ]);
    }

    /**
     * @Route("/delete/{id}", name="task_delete")
     * @param Request $request
     * @return Response
     */
    public function deleteAction(Request $request): Response
    {
        $taskId = $request->get('id');
        $task = $this->getDoctrine()->getRepository(Task::class )->findOneBy([
           'id' => $taskId
        ]);

        if(!$task) {
            throw new NotFoundHttpException('Task not found');
        }
        $this->getDoctrine()->getManager()->remove($task);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('todo');
    }
}
