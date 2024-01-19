<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class VehicleController extends Controller
{
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

    private function validateVehicle()
    {
        return [
            'daily_rate' => 'required|integer|min:2|max:100',
            'model' => 'required|string|min:5|max:255',
            'category_id' => 'required|exists:categories,id',
            'make_id' => 'required|exists:makes,id'
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only(['daily_rate', 'model', 'category_id', 'make_id']);

        $this->validate($request, $this->validateVehicle());

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
    public function update(Request $request, Vehicle $vehicle)
    {
        $data = $request->only(['daily_rate', 'model', 'category_id', 'make_id']);

        $this->validate($request, $this->validateVehicle());

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
