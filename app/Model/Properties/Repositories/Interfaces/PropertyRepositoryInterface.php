<?php
namespace App\Model\Properties\Repositories\Interfaces;
use App\Model\Properties\Property;
use phpDocumentor\Reflection\Types\Boolean;

interface PropertyRepositoryInterface
{
    public function createProperty(array $data) : Property;

    public function updateProperty(array $data): Boolean;
}
