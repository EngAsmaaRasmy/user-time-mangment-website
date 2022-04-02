<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PharmaciesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('pharmacy_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pharmacies = Pharmacy::all();

        return view('admin.pharmacies.index', compact('pharmacies'));
    }

    public function create()
    {
        abort_if(Gate::denies('pharmacy_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pharmacies.create');
    }

    public function store(Request $request)
    {
        $pharmacy = Pharmacy::create($request->all());

        return redirect()->route('admin.pharmacies.index');
    }

    public function edit(Pharmacy $pharmacy)
    {
        abort_if(Gate::denies('pharmacy_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pharmacies.edit', compact('pharmacy'));
    }

    public function update(Request $request, Pharmacy $Pharmacy)
    {
        $Pharmacy->update($request->all());

        return redirect()->route('admin.pharmacies.index');
    }

    public function show(Pharmacy $pharmacy)
    {
        abort_if(Gate::denies('pharmacy_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pharmacy->load('pharmacyTimes', 'pharmacyUsers');

        return view('admin.pharmacies.show', compact('pharmacy'));
    }

    public function destroy(Pharmacy $pharmacy)
    {
        abort_if(Gate::denies('school_class_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pharmacy->delete();

        return back();
    }

    public function massDestroy(Request $request)
    {
        Pharmacy::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
