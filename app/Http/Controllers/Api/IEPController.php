<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreIEPRequest;
use App\Http\Requests\UpdateIEPRequest;
use App\Http\Resources\IEPResource;
use App\Models\IEP;
use Illuminate\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\JsonResponse;

class IEPController extends Controller
{
    /**
     * Display a listing of IEPs.
     */
    public function index(): ResourceCollection
    {
        $this->authorize('viewAny', IEP::class);

        $ieps = IEP::with('student', 'createdBy', 'goals', 'accommodations')
            ->paginate(15);

        return IEPResource::collection($ieps);
    }

    /**
     * Store a newly created IEP.
     */
    public function store(StoreIEPRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['created_by_id'] = auth()->id();

        $iep = IEP::create($data);

        return response()->json(
            new IEPResource($iep->load('student', 'createdBy')),
            201
        );
    }

    /**
     * Display the specified IEP.
     */
    public function show(IEP $iep): IEPResource
    {
        $this->authorize('view', $iep);

        return new IEPResource($iep->load('student', 'createdBy', 'goals', 'accommodations'));
    }

    /**
     * Update the specified IEP.
     */
    public function update(UpdateIEPRequest $request, IEP $iep): IEPResource
    {
        $this->authorize('update', $iep);

        $iep->update($request->validated());

        return new IEPResource($iep);
    }

    /**
     * Remove the specified IEP.
     */
    public function destroy(IEP $iep): JsonResponse
    {
        $this->authorize('delete', $iep);

        $iep->delete();

        return response()->json(['message' => 'IEP deleted successfully'], 200);
    }
}
