<?php
/**
 * Description of CountriesService.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Countries;


use App\Models\Country;
use App\Services\Countries\Handlers\CreateCountryHandler;
use App\Services\Countries\Repositories\CountryRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CountriesService
{

    private CountryRepositoryInterface $countryRepository;
    private CreateCountryHandler $createCountryHandler;

    public function __construct(
        CreateCountryHandler $createCountryHandler,
        CountryRepositoryInterface $countryRepository
    )
    {
        $this->createCountryHandler = $createCountryHandler;
        $this->countryRepository = $countryRepository;
    }

    /**
     * @param int $id
     * @return Country|null
     */
    public function findCountry(int $id)
    {
        return $this->countryRepository->find($id);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function searchCountries(): LengthAwarePaginator
    {
        return $this->countryRepository->search();
    }

    /**
     * @param array $data
     * @return Country
     */
    public function storeCountry(array $data): Country
    {
        $country = $this->createCountryHandler->handle($data);

        // do some logic

        return $country;
    }

    /**
     * @param Country $country
     * @param array $data
     * @return Country
     */
    public function updateCountry(Country $country, array $data): Country
    {
        return $this->countryRepository->updateFromArray($country, $data);
    }

}
