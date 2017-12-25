<?php

namespace App\Controller;

use App\Entity\Content;
use App\Repository\ContentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ContentController extends BaseController
{
    protected $contentRepository;

    public function __construct(ContentRepository $contentRepository)
    {
        $this->contentRepository = $contentRepository;
    }


    /**
     * @param Request $request
     * @param $slug
     * @return Response
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function index(Request $request,$slug)
    {
        try
        {
            $content = $this->contentRepository->findOneByReference($slug);
        } catch (\Exception $e)
        {
            return $this->error($e);
        }

        return $this->render('theme/default/content.html.twig',['content' => $content]);
    }
}
