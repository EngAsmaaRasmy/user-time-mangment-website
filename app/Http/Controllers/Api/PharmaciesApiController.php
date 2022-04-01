<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use Illuminate\Support\Facades\Gate;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PharmaciesApiController extends Controller
{
    use ApiResponser;

    public function index()
    {
        abort_if(Gate::denies('pharmacy_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pharmacy = Pharmacy::get();
        return $this->success(['pharmacy' => $pharmacy]);
    }

    public function store(Request $request)
    {
        $pharmacy = Pharmacy::create($request->all());

        return $this->success(['pharmacy' => $pharmacy], 'Pharmacy created successfully');
    }

    public function show(Pharmacy $pharmacy)
    {
        abort_if(Gate::denies('pharmacy_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $this->success(['pharmacy' => $pharmacy]);
    }

    public function update(Request $request, Pharmacy $pharmacy)
    {
        $pharmacy->update($request->all());

        return $this->success(['pharmacy' => $pharmacy], 'Pharmacy updated successfully');
    }

    public function destroy(Pharmacy $pharmacy)
    {
        abort_if(Gate::denies('pharmacy_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pharmacy->delete();

        return $this->success('', 'Pharmacy deleted Successfully');
    }
}
