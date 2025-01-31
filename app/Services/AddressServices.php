<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AddressServices
{

    public function getZipCode(string $zipcode): array
    {
        return Http::get("https://viacep.com.br/ws/$zipcode/json/")
            ->throw()->json();
    }

}
