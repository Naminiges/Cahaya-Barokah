<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::orderBy('supplier_id', 'asc')->paginate(10);
        $total = Supplier::count();
        return view('suppliers.index', compact(['suppliers', 'total']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'supplier_id' => 'required',
            'name' => 'required',
            'contact_name' => 'required',
            'phone' => 'required|unique:suppliers,phone',
            'address' => 'required'
        ]);

        $supplier = Supplier::create($validation);

        if ($supplier) {
            session()->flash('success', 'supplier added successfully.');
            return redirect(route('suppliers.index'));
        } else {
            session()->flash('error', 'There was a problem adding the supplier.');
            return redirect(route('suppliers.create'));
        }
    }

    /**
     * Display the specified resource.
     */
    // public function show(Supplier $supplier)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    // Cari supplier berdasarkan supplier_id
    $supplier = Supplier::findOrFail($id); 

    // Return view dengan data supplier
    return view('suppliers.edit', compact('supplier'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        $validation = $request->validate([
            'name' => 'required',
            'contact_name' => 'required',
            'phone' => 'required|unique:suppliers,phone,' . $id . ',supplier_id',
            'address' => 'required',
        ]);

        $supplier->update($validation);

        if ($supplier) {
            session()->flash('success', 'supplier updated successfully.');
            return redirect(route('suppliers.index'));
        } else {
            session()->flash('error', 'There was a problem updating the supplier.');
            return redirect(route('suppliers.edit', $id));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        if ($supplier) {
            session()->flash('success', 'supplier deleted successfully.');
            return redirect(route('suppliers.index'));
        } else {
            session()->flash('error', 'There was a problem deleting the supplier.');
            return redirect(route('suppliers.index'));
        }
    }
}
