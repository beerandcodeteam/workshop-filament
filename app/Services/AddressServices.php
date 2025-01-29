<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AddressServices
{

    public function getZipCode(string $cep): array
    {
        return Http::get("https://viacep.com.br/ws/{$cep}/json")
            ->throw()->json();
    }

}
