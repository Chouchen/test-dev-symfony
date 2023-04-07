<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Commentaire;
use App\Form\CommentsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


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
    public function post($id, Request $request)
    {
        $post = $this->getDoctrine()
            ->getRepository(Post::class)
            ->find($id);

        //création de commentaire vide
        $comment = new Commentaire;

        // génère le formulaire
        $commentForm = $this->createForm(CommentsType::class, $comment);
        $commentForm->handleRequest($request);
        $commentdt = [];
        
        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            //dd($commentdt);
            // récupère les données saisies dans le formulaire
            $comment->setPoste($post);
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            // Return un json reponse
            
            $comments = $this->getDoctrine()->getRepository(Commentaire::class)->findBy(['poste' => $post]);
            
            foreach ($comments as $comment) {
                $commentdt[] = [
                    'id' => $comment->getId(),
                    'email' => $comment->getEmail(),
                    'nom' => $comment->getNom(),
                    'note' => $comment->getNote(),
                    'titre' => $comment->getTitre(),
                    'content' => $comment->getContenu(),
                ];
            } 
            $commentsHtml = $this->renderView('post/post.html.twig', ['comments' => $commentdt, 'post' => $post, 'formulaire' => $commentForm->createView()]);
            return new Response($commentsHtml);
        }
        // Get the comments from the database
        $comments = $this->getDoctrine()->getRepository(Commentaire::class)->findBy(['poste' => $post]);
        $commentdt = [];
        foreach ($comments as $comment) {
        $commentdt[] = [
            'id' => $comment->getId(),
            'email' => $comment->getEmail(),
            'nom' => $comment->getNom(),
            'note' => $comment->getNote(),
            'titre' => $comment->getTitre(),
            'content' => $comment->getContenu(),
        ];
        }
        return $this->render('post/post.html.twig', [
            'post' => $post,
            'formulaire' => $commentForm->createView(),
            'comments' => $commentdt
        ]);
    }

}
