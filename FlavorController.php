<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlavorCreatRequest;
use App\Services\FlavorServiceInterface;
use Illuminate\Http\Request;

class FlavorController extends Controller
{
    protected $flavorService;

    public function __construct(FlavorServiceInterface $flavorService)
    {
        $this->flavorService = $flavorService;
    }

    public function index()
    {
        $flavors = $this->flavorService->getAllFlavors();

        return [
            'status' => 200,
            'message' => 'Sabores encontrados!!',
            'sabores' => $flavors
        ];
    }

    public function store(FlavorCreatRequest $request)
    {
        $flavor = $this->flavorService->createFlavor($request->all());

        return [
            'status' => 200,
            'message' => 'Sabor cadastrado com sucesso!!',
            'sabor' => $flavor
        ];
    }

    public function show(string $id)
    {
        $flavor = $this->flavorService->getFlavorById($id);

        if (!$flavor) {
            return [
                'status' => 404,
                'message' => 'Sabor não encontrado! Que triste!'
            ];
        }

        return [
            'status' => 200,
            'message' => 'Sabor encontrado com sucesso!!',
            'user' => $flavor
        ];
    }

    public function update(Request $request, string $id)
    {
        $flavor = $this->flavorService->updateFlavor($id, $request->all());

        if (!$flavor) {
            return [
                'status' => 404,
                'message' => 'Sabor não encontrado! Que triste!'
            ];
        }

        return [
            'status' => 200,
            'message' => 'Sabor atualizado com sucesso!!',
            'user' => $flavor
        ];
    }

    public function destroy(string $id)
    {
        $deleted = $this->flavorService->deleteFlavor($id);

        if (!$deleted) {
            return [
                'status' => 404,
                'message' => 'Sabor não encontrado! Que triste!'
            ];
        }

        return [
            'status' => 200,
            'message' => 'Sabor deletado com sucesso!!'
        ];
    }
}
