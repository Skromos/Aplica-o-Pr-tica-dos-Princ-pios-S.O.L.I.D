<?php

namespace App\Services;

use App\Models\Flavor;
use App\Http\Enums\TamanhoEnum;

class FlavorService implements FlavorServiceInterface
{
    public function getAllFlavors()
    {
        return Flavor::select('id', 'sabor', 'preco', 'tamanho')->paginate(10);
    }

    public function createFlavor(array $data)
    {
        return Flavor::create([
            'sabor' => $data['sabor'],
            'preco' => $data['preco'],
            'tamanho' => TamanhoEnum::from($data['tamanho']),
        ]);
    }

    public function getFlavorById(string $id)
    {
        return Flavor::find($id);
    }

    public function updateFlavor(string $id, array $data)
    {
        $flavor = Flavor::find($id);

        if ($flavor) {
            $flavor->update($data);
        }

        return $flavor;
    }

    public function deleteFlavor(string $id)
    {
        $flavor = Flavor::find($id);

        if ($flavor) {
            $flavor->delete();
            return true;
        }

        return false;
    }
}
