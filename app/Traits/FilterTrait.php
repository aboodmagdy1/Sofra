<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait FilterTrait
{

    public function scopeFilter(Builder $builder, array $filters)
    {
        foreach ($filters as $field => $value) {
            if ($this->isFillable($field)) {
                // 3 cases

                // 1) $value is array and have operator and value like amount =>['operator' => '>', 'value' => 100]
                if (is_array($value) && isset($value['operator'], $value['value'])) {
                    $builder->where($field, $value['operator'], $value['value']);
                } elseif (!empty($value)) {
                    //2) value is array and needd to use whereIn like : status => [1,2,3]
                    if (is_array($value)) {
                        $builder->whereIn($field, $value);
                    }
                    // 
                    else {
                        $builder->where($field, $value); // 3) normal case where field = value
                    }
                }
            }
        }
        return $builder;
    }
}
