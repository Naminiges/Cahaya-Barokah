<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
{
    // $services = Service::orderBy('id_service', 'desc')->paginate(10); // ini kalo dari 61 ke 1
    $services = Service::orderBy('id_service', 'asc')->paginate(10);
    $total = Service::count();

    return view('services.index', compact('services', 'total'));
}
    

    public function create()
    {
        $suppliers = Supplier::all();
        return view('services.create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_name' => 'required',
            'service_price' => 'required|numeric',
            'stock' => 'required|integer',
            'supplier_id' => 'required'
        ]);

        Service::create([
            'service_name' => $request->service_name,
            'service_price' => $request->service_price,
            'stock' => $request->stock,
            'supplier_id' => $request->supplier_id, 
        ]);

        return redirect()->route('services.index')->with('success', 'Service added successfully.');
    }

    public function edit($id_service)
    {
        $service = Service::findOrFail($id_service);
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, $id_service)
    {
        $service = Service::findOrFail($id_service);

        $validation = $request->validate([
            'service_name' => 'required',
            'service_price' => 'required|numeric',
            'stock' => 'required|integer'
        ]);

        $service->update($validation);

        return redirect()->route('services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy($id_service)
    {
        $service = Service::findOrFail($id_service);
        $service->delete();

        return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
    }
}