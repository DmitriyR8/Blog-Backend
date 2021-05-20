<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface BlogArticleRepositoryInterface
 * @package App\Repositories\Contracts
 */
interface BlogArticleRepositoryInterface extends RepositoryInterface
{
    /**
     * @return mixed
     */
    public function getTopArticles();

    /**
     * @return mixed
     */
    public function getArticlesByViews();

    /**
     * @return mixed
     */
    public function getArticlesByPublishedDate();

    /**
     * @return mixed
     */
    public function getLastArticle();

    /**
     * @param $input
     * @return mixed
     */
    public function getAllArticles($input);

    /**
     * @param $slug
     * @return mixed
     */
    public function getArticleById($slug);

    /**
     * @param $input
     * @return mixed
     */
    public function searchByArticles($input);
}