<?php
/**
 * Description of CountryRepository.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Countries\Repositories;


use App\Models\Country;

class EloquentCountryRepository implements CountryRepositoryInterface
{

    public function find(?int $id): ?Country
    {
        if (!$id) {
            return null;
        }
        return Country::find($id);
    }

    public function search(array $filters = [])
    {
        return Country::paginate();
    }

    public function getList(array $filters = [])
    {
        return Country::all();
    }

    public function findByName(string $name): ?Country
    {
        return Country::where('name', $name)->first();
    }

    public function getCountriesByContinentName(string $continentName)
    {
        return Country::where('continent_name', $continentName)
            ->get();
    }

    public function createFromArray(array $data): Country
    {
        $country = new Country();
        $country->create($data);
        return $country;
    }

    public function updateFromArray(Country $country, array $data)
    {
        $country->update($data);
        return $country;
    }

}
