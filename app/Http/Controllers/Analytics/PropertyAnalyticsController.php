<?php

namespace App\Http\Controllers\Analytics;

use App\Http\Controllers\Controller;

use App\Model\Properties\Requests\CreatePropertyRequest;
use App\Model\PropertyAnalytics\Repositories\PropertyAnalyticsRepository;
use App\Model\PropertyAnalytics\Requests\CreatePropertyAnalyticsRequest;
use App\Model\PropertyAnalytics\Requests\UpdatePropertyAnalyticsRequest;
use Illuminate\Http\Request;

class PropertyAnalyticsController extends Controller
{

    /**
     * @var
     */
    private $propertyAnalyticsRepo;


    /**
     * PropertyAnalyticsController constructor.
     * @param PropertyAnalyticsRepository $propertyAnalyticsRepository
     */
    public function __construct(PropertyAnalyticsRepository $propertyAnalyticsRepository)
    {
        $this->propertyAnalyticsRepo = $propertyAnalyticsRepository;
    }

    public function index(Request $request)
    {

    }

    public function summary(Request $request)
    {
        $data = $request->input();

        if(isset($data['suburb'])) $name = 'suburb';
        if(isset($data['state'])) $name = 'state';
        if(isset($data['country'])) $name = 'country';

        $propertySummary = $this->propertyAnalyticsRepo->getAllSummary($name, $data[$name]);

        return response()->json([ 'summary' => $propertySummary ]);
    }

    /**
     * @param CreatePropertyAnalyticsRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Model\PropertyAnalytics\Exceptions\PropertyAnalyticsCreateErrorException
     */
    public function store(CreatePropertyAnalyticsRequest $request)
    {

        $data = $request->input();

        $propertyAnalytics = $this->propertyAnalyticsRepo->createPropertyAnalytics($data);
        $PropertyAnalyticsRepo = new PropertyAnalyticsRepository($propertyAnalytics);

        if($request->has('analytic_types_id')) {
            $PropertyAnalyticsRepo->syncAnalyticTypes([$request->input('analytic_types_id')]);
        }
        else {
            $PropertyAnalyticsRepo->detachAnalyticTypes();
        }

        return response()->json([ 'property_analytics_id' => $propertyAnalytics->id, 'msg' => 'successfully created' ]);
    }

    /**
     * @param UpdatePropertyAnalyticsRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Model\PropertyAnalytics\Exceptions\PropertyAnalyticsCreateErrorException
     * @throws \App\Model\PropertyAnalytics\Exceptions\PropertyAnalyticsNotFoundException
     */
    public function update(UpdatePropertyAnalyticsRequest $request, int $id)
    {
        $propertyAnalytics = $this->propertyAnalyticsRepo->findPropertyAnalyticsById($id);
        $propertyAnalyticsRepo = new PropertyAnalyticsRepository($propertyAnalytics);

        $data = $request->input();

        if($request->has('analytic_types_id')) {
            $propertyAnalyticsRepo->syncAnalyticTypes([$request->input('analytic_types_id')]);
        }
        else {
            $propertyAnalyticsRepo->detachAnalyticTypes();
        }

        $propertyAnalyticsRepo->updatePropertyAnalytics($data);

        return response()->json([ 'property_analytics_id' => $propertyAnalytics->id, 'msg' => 'successfully updated' ]);
    }
}
