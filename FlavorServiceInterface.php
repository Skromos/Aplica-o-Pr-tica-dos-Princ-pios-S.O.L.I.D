<?php

namespace App\Services;

interface FlavorServiceInterface
{
    public function getAllFlavors();
    public function createFlavor(array $data);
    public function getFlavorById(string $id);
    public function updateFlavor(string $id, array $data);
    public function deleteFlavor(string $id);
}
