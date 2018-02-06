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

class ActionsController extends Controller
{

    /**
     * @param Request $request
     * @param Validate $validate
     * @return JsonResponse
     * @Route("/api/actions",name="create_actions")
     * @Method({"POST"})
     */
    public function createPost(Request $request,Validate $validate)
    {

        $data=$request->getContent();

        $actions=$this->get('jms_serializer')->deserialize($data,'AppBundle\Entity\Actions','json');


        $reponse=$validate->validateRequest($actions);

        if (!empty($reponse)){
            return new JsonResponse($reponse, Response::HTTP_BAD_REQUEST);
        }

        $em=$this->getDoctrine()->getManager();
        $em->persist($actions);

        $em->flush();


        $response=array(

            'code'=>0,
            'message'=>'Actions created!',
            'errors'=>null,
            'result'=>null

        );

        return new JsonResponse($response,Response::HTTP_CREATED);



    }


    /**
     * @Route("/api/actions",name="list_actions")
     * @Method({"GET"})
     */

    public function listActions()
    {

        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(
        'SELECT a
        FROM AppBundle\Entity\Actions a');

        $actions = $query->getResult();

        if (!count($actions)){
            $response=array(

                'code'=>1,
                'message'=>'No actions found!',
                'errors'=>null,
                'result'=>null

            );


            return new JsonResponse($response, Response::HTTP_NOT_FOUND);
        }


        $data=$this->get('jms_serializer')->serialize($actions,'json');

        $response=array(

            'code'=>0,
            'message'=>'success',
            'errors'=>null,
            'result'=>json_decode($data)

        );

        return new JsonResponse($response,200);


    }

     /**
     * @param Request $request
     * @param $id
     * @Route("/api/actions/{id}",name="update_actions")
     * @Method({"PUT"})
     * @return JsonResponse
     */
    public function updatePost(Request $request,$id,Validate $validate)
    {

        $actions=$this->getDoctrine()->getRepository('AppBundle:Actions')->find($id);

        if (empty($actions))
        {
            $response=array(

                'code'=>1,
                'message'=>'Action Not found !',
                'errors'=>null,
                'result'=>null

            );

            return new JsonResponse($response, Response::HTTP_NOT_FOUND);
        }

        $body=$request->getContent();


        $data=$this->get('jms_serializer')->deserialize($body,'AppBundle\Entity\Actions','json');


        $reponse= $validate->validateRequest($data);

        if (!empty($reponse))
        {
            return new JsonResponse($reponse, Response::HTTP_BAD_REQUEST);

        }
        
        $actions->setTitle($data->getTitle());
        $actions->setActionName($data->getActionName());
        $actions->setUserID($data->getUserID());
        $actions->setPatternFunction($data->getPatternFunction());
        $actions->setResult($data->getResult());
        $actions->setX($data->getX());
        $actions->setY($data->getY());
        $actions->setA($data->getA());
        $actions->setB($data->getB());
        $actions->setC($data->getC());

        $em=$this->getDoctrine()->getManager();
        $em->persist($actions);
        $em->flush();

        $response=array(

            'code'=>0,
            'message'=>'Action updated!',
            'errors'=>null,
            'result'=>null

        );

        return new JsonResponse($response,200);

    }

    /**
     * @Route("/api/actions/{id}",name="delete_action")
     * @Method({"DELETE"})
     */

    public function deletePost($id)
    {
        $actions=$this->getDoctrine()->getRepository('AppBundle:Actions')->find($id);

        if (empty($actions)) {

            $response=array(

                'code'=>1,
                'message'=>'Action Not Found !',
                'errors'=>null,
                'result'=>null

            );


            return new JsonResponse($response, Response::HTTP_NOT_FOUND);
        }

        $em=$this->getDoctrine()->getManager();

        $em->remove($actions);
        $em->flush();

        $response=array(

            'code'=>0,
            'message'=>'Action deleted !',
            'errors'=>null,
            'result'=>null

        );


        return new JsonResponse($response,200);



    }
}
