<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\RangeTime;
use Illuminate\Support\Facades\Gate;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TimesApiController extends Controller
{
    use ApiResponser;

    public function index()
    {
        abort_if(Gate::denies('dataRange_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $times = RangeTime::with(['pharmacy', 'user'])->get();
        return $this->success(['times' => $times]);
    }

    public function store(Request $request)
    {
        $time = RangeTime::create($request->all());

        return $this->success(['time' => $time], 'Time created successfully');
    }

    public function show(RangeTime $time)
    {
        abort_if(Gate::denies('dataRange_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $this->success(['time' => $time->load(['pharmacy', 'user'])]);
    }

    public function update(Request $request, RangeTime $time)
    {
        $time->update($request->all());

        return $this->success(['time' => $time], 'Time updated successfully');
    }

    public function destroy(RangeTime $time)
    {
        abort_if(Gate::denies('dataRange_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $time->delete();

        return $this->success('', 'Time deleted Successfully');
    }
}
