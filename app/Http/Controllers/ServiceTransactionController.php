<?php
namespace App\Http\Controllers;

use App\Models\ServiceTransaction;
use App\Models\User;
use App\Models\Customer;
use App\Models\Service;
use Illuminate\Http\Request;
// use App\Models\Warranty;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServiceTransactionController extends Controller
{
    public function index()
    {
        // $service_transactions = ServiceTransaction::with(['technician', 'customer', 'laptop', 'warranty'])->get();
        // $service_transactions = ServiceTransaction::all(); 
        $service_transactions = ServiceTransaction::orderBy('transaction_id', 'desc')->paginate(10);
        $total = ServiceTransaction::count();
        return view('service_transactions.index', compact('service_transactions','total'));
    }

    public function create()
    {
        $cashier = Auth::user(); // Fetch all users from the users table
        $customers = Customer::all(); // Fetch customers with their laptops
        $services = Service::all();

        $lastTransaction = ServiceTransaction::orderBy('transaction_id', 'desc')->first();
        $nextTransactionId = $lastTransaction ? $lastTransaction->transaction_id + 1 : 1;
        $nextInvoiceNumber = str_pad($nextTransactionId, 3, '0', STR_PAD_LEFT);

        return view('service_transactions.create', compact('cashier', 'customers', 'services', 'nextInvoiceNumber'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'invoice_number' => 'required|unique:service_transactions,invoice_number',
                // other validation rules...
            ]);

            $cashierId = $request->cashier_id;
            $customerId = $request->customer_id;

            // Remove currency formatting from total price
            $totalPrice = preg_replace('/[^0-9]/', '', $request->total_price); // Remove all non-numeric characters

            $cashier = User::findOrFail($cashierId); // Fail if not found
            $cashierName = $cashier->name;

            $customer = Customer::findOrFail($customerId); // Fail if not found
            $customerName = $customer->customer_name;

            // Create the service transaction
            $transaction = new ServiceTransaction($request->except('total_price', 'service_id'));
            $transaction->total_price = $totalPrice;
            $transaction->service_ids = json_encode($request->service_id); // Convert the service_ids array to a JSON string
            $transaction->quantities = json_encode($request->quantity); // Convert the quantities array to a JSON string
            $transaction->cashier_name = $cashierName;
            $transaction->customer_name = $customerName;
            $transaction->save();

            // Commit the transaction
            DB::commit();

            return redirect()->route('service_transactions.index')->with('success', 'Service transaction created successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction if an error occurs
            DB::rollBack();

            return redirect()->back()->withErrors(['error' => 'Failed to create service transaction: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        // $serviceTransaction = ServiceTransaction::with(['technician', 'customer', 'laptop', 'warranty'])->find($id);
        $serviceTransaction = ServiceTransaction::all()->find($id);
        $cashiers = User::all(); // Fetch all users from the users table
        $customers = Customer::all(); // Fetch customers with their laptops
        $services = Service::all();

        return view('service_transactions.edit', compact('serviceTransaction', 'cashiers', 'customers', 'services'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'invoice_number' => 'required|unique:service_transactions,invoice_number,' . $id . ',transaction_id',
            // other validation rules...
        ]);

        // Remove currency formatting from total price
        $totalPrice = preg_replace('/[^0-9]/', '', $request->total_price); // Remove all non-numeric characters

        $transaction = ServiceTransaction::find($id);
        $transaction->fill($request->except('total_price', 'service_id'));
        $transaction->total_price = $totalPrice;
        $transaction->service_ids = json_encode($request->service_id); // Convert the service_ids array to a JSON string
        $transaction->save();

        return redirect()->route('service_transactions.index')->with('success', 'Service transaction updated successfully.');
    }
    // public function getLaptopDetails($laptopId)
    // {
    //     $laptop = Laptop::find($laptopId);
    //     return response()->json($laptop);
    // }
    // public function destroy($id)
    // {
    //     $transaction = ServiceTransaction::find($id);
    //     $transaction->delete();

    //     return redirect()->route('service_transactions.index')->with('success', 'Service transaction deleted successfully.');
    // }
    public function showPayForm($transaction_id)
    {
        $transaction = ServiceTransaction::find($transaction_id);
        return view('service_transactions.pay', compact('transaction'));
    }

    public function processPayment(Request $request, $transaction_id)
    {
        try {
            DB::beginTransaction();

            $transaction = ServiceTransaction::find($transaction_id);
            $totalAmount = $transaction->total_price;
            $paymentAmount = preg_replace('/[^0-9]/', '', $request->payment_amount);

            if ($paymentAmount >= $totalAmount) {
                $changeAmount = $paymentAmount - $totalAmount;
                $transaction->status = 'completed';
                $transaction->save();

                DB::commit();

                // Setelah transaksi berhasil, update stok
                $serviceIds = json_decode($transaction->service_ids);
                $quantities = json_decode($transaction->quantities);

                foreach($serviceIds as $index => $serviceId) {
                    $service = Service::find($serviceId);
                    if ($service) {
                        if($service->stock < $quantities[$index]) {
                            return response()->json([
                                'success' => false,
                                'message' => "Insufficient stock for {$service->service_name}"
                            ], 400);
                        }
                        $service->decrement('stock', $quantities[$index]);
                    }
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Payment successful. Change: Rp. ' . number_format($changeAmount, 0, ',', '.')
                ]);
            } else {
                DB::rollBack();
                return response()->json([
                    'success' => false, 
                    'message' => 'Payment amount is less than the total amount.'
                ], 400);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error processing payment: ' . $e->getMessage()
            ], 500);
        }
    }
    public function show($transaction_id)
    {
        $serviceTransaction = ServiceTransaction::all()->find($transaction_id);
        $cashiers = User::all();
        $customers= Customer::all();
        $services = Service::all();

        return view('service_transactions.view', compact('serviceTransaction', 'cashiers', 'customers', 'services'));
    }
    public function print($transaction_id)
    {
        // $serviceTransaction = ServiceTransaction::with(['technician', 'customer', 'laptop', 'warranty'])->find($transaction_id);
        $serviceTransaction = ServiceTransaction::all()->find($transaction_id);
        $services = Service::all();

        return view('service_transactions.print', compact('serviceTransaction', 'services'));
    }
}
