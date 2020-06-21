<?php

namespace App\Http\Controllers\Properties;

use App\Model\Properties\Repositories\PropertyRepository;
use App\Model\Properties\Requests\CreatePropertyRequest;
use App\Http\Controllers\Controller;

class PropertyController extends Controller
{

    /**
     * @var PropertyRepository
     */
    private $propertyRepo;

    /**
     * PropertyController constructor.
     * @param PropertyRepository $propertyRepository
     */
    public function __construct(
        PropertyRepository $propertyRepository

    )
    {
        $this->propertyRepo = $propertyRepository;
    }

    /**
     * @param CreatePropertyRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Model\Properties\Exceptions\PropertyCreateErrorException
     */
    public function store(CreatePropertyRequest $request)
    {
        $data = $request->input();

        $property = $this->propertyRepo->createProperty($data);

        $productRepo = new PropertyRepository($property);

        return response()->json(
            [
                'property_id' => $property->id,
                'message' => 'successfully created'
            ]
        );
    }
}
