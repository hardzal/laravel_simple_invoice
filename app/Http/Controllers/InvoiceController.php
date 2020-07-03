<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoice = Invoice::with(['customer', 'detail'])->orderBy('created_at', 'DESC')->paginate(10);
        return view('invoice.index', compact('invoice'));
    }


    public function create()
    {
        $customers = Customer::orderBy('created_at', 'DESC')->paginate(10);
        return view('invoice.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'customer_id' => 'required|exists:customers,id'
        ]);

        try {
            $invoice = Invoice::create([
                'customer_id' => $request->customer_id,
                'total' => 0,
            ]);
            return redirect(route('invoice.edit', ['id' => $invoice->id]));
        } catch (\Exception $err) {
            return redirect()->back()->with(['error' => $err->getMessage()]);
        }
    }

    public function edit($id)
    {
        $invoice = Invoice::with(['customer', 'detail', 'detail.product'])->find($id);
        $products = Product::orderBy('title', 'ASC')->get();
        return view('invoice.edit', compact('invoice', 'products'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer'
        ]);

        try {
            $invoice = Invoice::find($id);
            $product = Product::find($request->product_id);
            $invoice_detail = $invoice->detail()->where('product_id', $product->id)->first();

            if ($invoice_detail) {
                $invoice_detail->update([
                    'qty' => $invoice_detail->qty + $request->qty
                ]);
            } else {
                InvoiceDetail::create([
                    'invoice_id' => $invoice->id,
                    'product_id' => $request->product_id,
                    'price' => $product->price,
                    'qty' => $request->qty
                ]);
            }

            return redirect()->back()->with(['success' => 'Produk berhasil disimpan!']);
        } catch (\Exception $err) {
            return redirect()->back()->with(['error' => $err->getMessage()]);
        }
    }

    public function deleteProduct($id)
    {
        $detail = InvoiceDetail::find($id);
        if ($detail->delete()) {
            return redirect()->back()->with([
                'success' => 'Produk berhasil dhapus dari invoice!'
            ]);
        } else {
            echo "hello?";
        }
    }

    public function delete($id)
    {
        $invoice = Invoice::find($id);
        $invoice->delete();
        return redirect()->back()->with(['success' => 'Data berhasil dihapus']);
    }

    public function generateInvoice($id)
    {
        $invoice = Invoice::with(['customer', 'detail', 'detail.product'])->find($id);
        $pdf = PDF::loadView('invoice.print', compact('invoice'))->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}
