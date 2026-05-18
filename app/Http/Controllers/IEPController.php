<?php

namespace App\Http\Controllers;

use App\Models\IEP;
use App\Http\Requests\StoreIEPRequest;
use App\Http\Requests\UpdateIEPRequest;
use Illuminate\Http\Request;

class IEPController extends Controller
{
    /**
     * Display a listing of IEPs.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', IEP::class);

        $ieps = IEP::with('student', 'createdBy')
            ->when($request->search, fn($q) => $q->whereHas('student', fn($q) => $q->whereHas('user', fn($q) => $q->where('name', 'like', "%{$request->search}%"))))
            ->paginate(15);

        return view('ieps.index', compact('ieps'));
    }

    /**
     * Show the form for creating a new IEP.
     */
    public function create()
    {
        $this->authorize('create', IEP::class);
        return view('ieps.create');
    }

    /**
     * Store a newly created IEP.
     */
    public function store(StoreIEPRequest $request)
    {
        $data = $request->validated();
        $data['created_by_id'] = auth()->id();
        $iep = IEP::create($data);
        return redirect()->back()->with('success', 'IEP created successfully.');
    }

    /**
     * Display the specified IEP.
     */
    public function show(IEP $iep)
    {
        $this->authorize('view', $iep);
        $iep->load('student', 'createdBy', 'goals', 'accommodations');
        return view('ieps.show', compact('iep'));
    }

    /**
     * Show the form for editing the specified IEP.
     */
    public function edit(IEP $iep)
    {
        $this->authorize('update', $iep);
        return view('ieps.edit', compact('iep'));
    }

    /**
     * Update the specified IEP.
     */
    public function update(UpdateIEPRequest $request, IEP $iep)
    {
        $this->authorize('update', $iep);
        $iep->update($request->validated());
        return redirect()->back()->with('success', 'IEP updated successfully.');
    }

    /**
     * Remove the specified IEP.
     */
    public function destroy(IEP $iep)
    {
        $this->authorize('delete', $iep);
        $iep->delete();
        return redirect()->back()->with('success', 'IEP deleted successfully.');
    }
}
