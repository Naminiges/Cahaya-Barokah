<?php

namespace App\Http\Controllers;

use App\Models\Buying;
use App\Models\BuyingDetail;
use App\Models\Service;
use DB;
use Illuminate\Http\Request;

class BuyingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buyings = Buying::with('buyingDetail') // Memuat relasi BuyingDetail
            ->orderBy('buying_invoice_id', 'desc')
            ->paginate(10);

        $total = Buying::count();
        return view('buyings.index', compact('buyings', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buyings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            
            // Create new buying record
            $buying = new Buying();
            $buying->buying_invoice_id = $request->buying_invoice_id;
            $buying->supplier_name = $request->supplier_name;
            $buying->order_date = $request->entry_date;
            $buying->save();

            // Store each product detail
            foreach($request->product_name as $index => $name) {
                $detail = new BuyingDetail();
                $detail->buying_invoice_id = $buying->buying_invoice_id;
                $detail->product_name = $name;
                $detail->product_supplier_price = $request->product_price[$index];
                $detail->exp_date = $request->exp_date[$index];
                $detail->quantity = $request->quantity[$index];
                $detail->save();
            }

            DB::commit();

            // Setelah transaksi berhasil, update stok
            foreach($request->product_name as $index => $name) {
                $service = Service::where('service_name', $name)->first();
                if ($service) {
                    $service->increment('stock', $request->quantity[$index]);
                }
            }

            return redirect()->route('buying.index')
                ->with('success', 'Transaction successfully added.');
                
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Ambil data buying berdasarkan ID
        $buying = Buying::with('buyingDetail')->findOrFail($id);
        $total = $buying->getTotalAmount();

        return view('buyings.view', compact('buying','total'));
    }

    public function print($id)
    {
        // Ambil data buying dengan relasi buyingDetail
        $buying = Buying::with('buyingDetail')->findOrFail($id);
        $total = $buying->getTotalAmount();

        return view('buyings.print', compact('buying','total'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buying $buying)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Buying $buying)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buying $buying)
    {
        //
    }
}
