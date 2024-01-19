<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class VehicleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Vehicle::class, 'vehicle');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $vehicles = QueryBuilder::for(Vehicle::class)
            ->allowedIncludes(['make', 'category'])
            ->allowedSorts(['id', 'model'])
            ->allowedFilters(['model', 'make.name', 'category.name'])
            ->paginate($request->get('paginate', 5));

        return response()->json($vehicles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVehicleRequest $request)
    {
        $data = $request->only(['daily_rate', 'model', 'category_id', 'make_id']);

        $result = Vehicle::create($data);

        return response()->json($result);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        return response()->json($vehicle);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        $data = $request->only(['daily_rate', 'model', 'category_id', 'make_id']);

        $vehicle->update($data);

        return response()->json($vehicle);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return response()->json($vehicle);
    }
}
