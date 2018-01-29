<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Service\Validate;
use AppBundle\Entity\Post;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\User;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Core\User\UserInterface;

class UserController extends Controller
{
  /**
   * @param Request $request
   * @param $id
   * @Route("/api/user/update",name="update_user")
   * @Method({"PUT"})
   * @return JsonResponse
   */
  public function updateUser(Request $request, UserInterface $user)
  {
    $user = $this->getAction($user);

      /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
      $dispatcher = $this->get('event_dispatcher');

      $event = new GetResponseUserEvent($user, $request);
      $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

      if (null !== $event->getResponse()) {
          return $event->getResponse();
      }

      /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
      $formFactory = $this->get('fos_user.profile.form.factory');

      $form = $formFactory->createForm(['csrf_protection' => false]);
      $form->setData($user);

      $form->submit($request->request->all());

      if (!$form->isValid()) {
          return $form;
      }

      /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
      $userManager = $this->get('fos_user.user_manager');

      $event = new FormEvent($form, $request);
      $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

      $userManager->updateUser($user);

      // there was no override
      if (null === $response = $event->getResponse()) {
          return $this->routeRedirectView(
              'get_profile',
              ['user' => $user->getId()],
              Response::HTTP_NO_CONTENT
          );
      }

      // unsure if this is now needed / will work the same
      $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

      return $this->routeRedirectView(
          'get_profile',
          ['user' => $user->getId()],
          Response::HTTP_NO_CONTENT
      );
  }
}
