<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Like;

class NewsController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
              
        $em = $this->getDoctrine()->getManager(); 
        
        $listNews = $em->getRepository('AppBundle:News')->findAll();
         
        return $this->render('@App/index.html.twig', array(
            'listNews' => $listNews,
                
        )); 
    }
    
    
    /**
     * @Route("/news/{id}", name="view_news", requirements={"id"="\d+"})
     */
      public function viewAction($id)
      {
        $em = $this->getDoctrine()->getManager();

        $news = $em->getRepository('AppBundle:News')->find($id);

        if (null === $news) {
          throw new NotFoundHttpException("La news d'id ".$id." n'existe pas.");
        }

        return $this->render('@App/view.html.twig', array(
          'news'           => $news
        ));
      }
    
    /**
     * @Route("/like", name="like")
     */
    public function likeAction(Request $request)
    {
               
        $newsId = $request->request->get('news');
        $userId = $request->request->get('user');

        $em = $this->getDoctrine()->getManager(); 

        $news = $em->getRepository('AppBundle:News')->find($newsId);
        $user = $em->getRepository('UtilisateurBundle:User')->find($userId);


        $like = new Like();
        $like->setNews($news);
        $like->setUser($user);

        $news->increaseLike();
        $user->addLike($like);

        $em->persist($like);
        $em->persist($news);
        $em->persist($user);
        $em->flush();


        $response = new Response(json_encode(array(
            'news' => $news,
            'user' => $user
        )));
        $response->headers->set('Content-Type', 'application/json');

        return $response;

    }
    
    /**
     * @Route("/unlike", name="unlike")
     */
    public function unlikeAction(Request $request)
    {
        $newsIdUnlike = $request->request->get('news');
        $userIdUnlike = $request->request->get('user');

        $em = $this->getDoctrine()->getManager(); 

        $newsUnlike = $em->getRepository('AppBundle:News')->find($newsIdUnlike);
        $userUnlike = $em->getRepository('UtilisateurBundle:User')->find($userIdUnlike);

        $likeToSuppress = $em->getRepository('AppBundle:Like')->findOneBy(array(
            'news' => $newsUnlike, 
            'user' => $userUnlike
        ));

        $userUnlike->removeLike($likeToSuppress);
        $em->remove($likeToSuppress);
        
        $em->flush($likeToSuppress);

        $newsUnlike->decreaseLike();
        
        $em->persist($newsUnlike);
        $em->persist($userUnlike);
        $em->flush();

        $response = new Response(json_encode(array(
            'news' => $newsIdUnlike,
            'user' => $userIdUnlike
        )));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
       
    
    }
    
}
