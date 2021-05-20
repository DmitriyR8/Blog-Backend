<?php

namespace App\Service\Search;

/**
 * Interface SearchServiceInterface
 * @package App\Service\Search
 */
interface SearchServiceInterface
{
    /**
     * @param $input
     * @return mixed
     */
    public function getResult($input);
}