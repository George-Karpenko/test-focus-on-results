<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegionStoreRequest;
use App\Http\Requests\RegionUpdateRequest;
use App\Http\Resources\RegionCollection;
use App\Http\Resources\RegionResource;
use App\Models\Region;
use Symfony\Component\HttpFoundation\Response;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new RegionCollection(Region::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegionStoreRequest $request)
    {
        return response([
            'data' => new RegionResource(Region::create($request->validated()))
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new RegionResource(Region::with('region')->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RegionUpdateRequest $request, Region $region)
    {
        return new RegionResource($region->update($request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Region $region)
    {
        $region->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
