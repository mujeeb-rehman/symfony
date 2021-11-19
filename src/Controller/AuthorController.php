<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorType;
use App\Service\AuthorService;
use App\Service\PostService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/author", name="author_")
 * @property AuthorService $authorService
 * @property ValidatorInterface $validator
 */
class AuthorController extends AbstractController
{
    /**
     * @param AuthorService $authorService
     * @param ValidatorInterface $validator
     */
    public function __construct(AuthorService $authorService, ValidatorInterface $validator)
    {
        $this->authorService = $authorService;
        $this->validator = $validator;
    }

    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        // $authors = $this->getDoctrine()->getRepository(Author::class)->findAll();
        
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
             'authors' => $this->authorService->allAuthors()
        ]);
    }

    /**
     * @Route("/create", name="create", methods={"GET", "POST"})
     */
    public function create(Request $request): Response
    {
        $author = new Author();
        $form = $this->createForm(AuthorType::class, $author);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->authorService->createAuthor($author);
            $this->addFlash(
                'success',
                'Author created successfully!'
            );
            return $this->redirectToRoute('author_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('author/create.html.twig', [
            'author' => $author,
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(int $id): Response
    {
        return $this->render('author/show.html.twig', [
            'author' => $this->authorService->singleAuthor($id),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Author $author): Response
    {
        $form = $this->createForm(AuthorType::class, $author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->authorService->authorRepository->flush();
            $this->addFlash(
                'success',
                'Author Updated successfully!'
            );

            return $this->redirectToRoute('author_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('author/edit.html.twig', [
            'author' => $author,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"POST"})
     */
    public function delete(Request $request, Author $author, PostService $postService): Response
    {
        $posts = $postService->allPostsByAuthor($author);
        if(count($posts) > 0){
            $this->addFlash('danger', 'Could not delete author as there are posts associated with it!');
            return $this->redirectToRoute('author_index', [], Response::HTTP_SEE_OTHER);
        }

        if ($this->isCsrfTokenValid('delete'.$author->getId(), $request->request->get('_token'))) {
            $this->authorService->removeAuthor($author);
        }

        $this->addFlash(
            'success',
            'Author deleted successfully!'
        );

        return $this->redirectToRoute('author_index', [], Response::HTTP_SEE_OTHER);
    }

}
