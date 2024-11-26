<?php

namespace App\Services\Admin;

use App\Repositories\Eloquent\ContactRepository;

class ContactService extends BaseDashboardService
{
    public function __construct(ContactRepository $repository)
    {
        parent::__construct($repository);
    }
}
