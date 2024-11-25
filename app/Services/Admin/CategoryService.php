<?php

namespace App\Services\Admin;


use App\Models\Category;
use App\Repositories\Eloquent\CategoryRepository;
use Exception;
use Illuminate\Database\QueryException;

class CategoryService extends BaseDashboardService
{
    public function __construct(CategoryRepository $repository)
    {
        parent::__construct($repository);
    }
}
