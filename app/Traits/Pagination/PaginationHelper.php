<?php
/**
 * Created by PhpStorm.
 * User: hemmaty
 * Date: 12/28/21
 * Time: 2:02 AM
 */

namespace App\Traits\Pagination;


use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

trait PaginationHelper
{

    protected function getPaginationAsArray($paginator){
        if ($paginator instanceof Paginator || $paginator instanceof LengthAwarePaginator) {
            return [
                'totalItems' => $paginator->total(),
                'perPage' => $paginator->perPage(),
                'page' => $paginator->currentPage(),
                'lastPage' => $paginator->lastPage(),
                'nextPageUrl' => $paginator->nextPageUrl(),
                'previousPageUrl' => $paginator->previousPageUrl(),
                'lastPageUrl' =>$paginator->url($paginator->lastPage()),
            ];
        }
        return [];
    }
}