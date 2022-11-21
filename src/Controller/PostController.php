<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Commentaire;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CommentaireType;
use Symfony\Component\HttpFoundation\Request;

class PostController extends AbstractController
{
    /**
     * @Route("/", name="app")
     */
    public function index(): Response
    {
        $posts = $this->getDoctrine()->getRepository(Post::class)->findAll();

        return $this->render('post/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    
    /**
     * @Route("/post/{id}", name="app_post")
     */
    public function post($id, Request $request): Response
    {
        $post = $this->getDoctrine()
            ->getRepository(Post::class)
            ->find($id);

        //creation de la commentaire

        $commentr = new Commentaire() ;

        $commentaireF = $this->createForm(CommentaireType::class, $commentr);
        $commentaireF->handleRequest($request);
        
        if($commentaireF->isSubmitted() && $commentaireF->isValid()){
            dd($commentr);
            $commentr->setPost($post);
            $parentid = $commentaireF->get("parentid")->getData();
            $em = $this->getDoctrine()->getManager();
            if($parentid != null){
                $parent = $em->getRepository(Commentaire::class)->find($parentid);
            }
            $em->persist($commentr);
            $em->flush();
            $this->addFlash('message', 'Votre commentaire est ajouté');
            
            return $this->redirectToRoute('app_post', ['slug' => $post->getSlug()]);
        }

        return $this->render('post/post.html.twig', [
            'post' => $post,
            'commentaire' => $commentaireF->createView()
        ]);
    }

}
