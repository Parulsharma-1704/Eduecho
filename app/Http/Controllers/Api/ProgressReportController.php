<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ProgressReportResource;
use App\Models\ProgressReport;
use Illuminate\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProgressReportController extends Controller
{
    /**
     * Display a listing of progress reports.
     */
    public function index(): ResourceCollection
    {
        $this->authorize('viewAny', ProgressReport::class);

        $reports = ProgressReport::with('student', 'generatedBy')
            ->paginate(15);

        return ProgressReportResource::collection($reports);
    }

    /**
     * Display the specified progress report.
     */
    public function show(ProgressReport $report): ProgressReportResource
    {
        $this->authorize('view', $report);

        return new ProgressReportResource($report->load('student', 'generatedBy'));
    }
}
