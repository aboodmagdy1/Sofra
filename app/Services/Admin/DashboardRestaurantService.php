<?php

namespace App\Services\Admin;

use App\Models\Category;
use App\Repositories\Eloquent\RestaurantRepository;

class DashboardRestaurantService extends BaseDashboardService
{

    public function __construct(RestaurantRepository $repository)
    {
        parent::__construct($repository);
    }

    public function filterd(array $filters)
    {
        if (!empty($filters['name'])) {
            return $this->repository->filter(['name' => $filters['name']]);
        }
        // if category_id : then get
        if (!empty($filters['category_id'])) {
            $cetegory = Category::find($filters['category_id']);
            if ($cetegory) {
                return $cetegory->restaurants()->paginate(10) ?? [];
            }

            return collect(); // if no category found
        }
    }
}
