<?php
/**
 * Description of EloquentCompanyRepository.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Companies\Repositories;


use App\Models\Company;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class EloquentCompanyRepository
{

    public function searchWithCountryRelation(int $perPage): LengthAwarePaginator
    {
        return $this->search($perPage, [
            'city.country',
        ]);
    }

    public function search(int $perPage, array $with = []): LengthAwarePaginator
    {
        $qb = Company::query();
        if ($with) {
            $qb->with($with);
        }
        return $qb->paginate($perPage);
    }

    public function getByNameStart(string $name, int $limit, int $offset = 0): Collection
    {
        return Company::where('name', 'LIKE', $name . '%')
            ->take($limit)
            ->skip($offset)
            ->get();
    }

    public function findByName(string $name): Company
    {
        return Company::where('name', $name)->first();
    }

    public function createFromArray(
        array $data
    ): Company
    {
        return Company::create($data);
    }

}
