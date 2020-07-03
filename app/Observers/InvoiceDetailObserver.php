<?php

namespace App\Observers;

use App\Models\InvoiceDetail;

class InvoiceDetailObserver
{
    /**
     * @param \App\Model\InvoiceDetail
     * @return void
     */
    public function generateTotal($invoiceDetail)
    {
        $invoice_id = $invoiceDetail->invoice_id;

        $invoice_detail = InvoiceDetail::where('invoice_id', $invoice_id)->get();
        $total = $invoice_detail->sum(function ($index) {
            return $index->price * $index->qty;
        });

        $invoiceDetail->invoice()->update([
            'total' => $total
        ]);
    }
    /**
     * Handle the invoice detail "created" event.
     *
     * @param  \App\Models\InvoiceDetail  $invoiceDetail
     * @return void
     */
    public function created(InvoiceDetail $invoiceDetail)
    {
    }

    /**
     * Handle the invoice detail "updated" event.
     *
     * @param  \App\InvoiceDetail  $invoiceDetail
     * @return void
     */
    public function updated(InvoiceDetail $invoiceDetail)
    {
        $this->generateTotal($invoiceDetail);
    }

    /**
     * Handle the invoice detail "deleted" event.
     *
     * @param  \App\Models\InvoiceDetail  $invoiceDetail
     * @return void
     */
    public function deleted(InvoiceDetail $invoiceDetail)
    {
        $this->generateTotal($invoiceDetail);
    }

    /**
     * Handle the invoice detail "restored" event.
     *
     * @param  \App\InvoiceDetail  $invoiceDetail
     * @return void
     */
    public function restored(InvoiceDetail $invoiceDetail)
    {
        //
    }

    /**
     * Handle the invoice detail "force deleted" event.
     *
     * @param  \App\InvoiceDetail  $invoiceDetail
     * @return void
     */
    public function forceDeleted(InvoiceDetail $invoiceDetail)
    {
        //
    }
}
