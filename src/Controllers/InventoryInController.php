<?php
namespace TechlifyInc\TechlifySimpleInventory\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use TechlifyInc\TechlifySimpleInventory\Models\InventoryIn;

class InventoryInController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filters = request(["item_id", "sort_by", "item", "date_to", "date_from", "num_items", "serial_numbers"]);
        $items = InventoryIn::filter($filters)
            ->with('inventoryItem')
            ->get();

        return ["items" => $items];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->hasPermission("inventory_in_create")) {
            return response()->json(['error' => "You are unauthorized to perform this action. "], 401);
        }

        $rules = [
            "item_id"  => "exists:inventory_items,id",
            "dated"    => "required|date",
            "quantity" => "required|integer",
        ];

        $this->validate(request(), $rules);

        $item = new InventoryIn();
        $item->item_id = request('item_id');
        $item->dated = request('dated');
        $item->quantity = request('quantity');
        $item->cost = request('cost', "");
        $item->details = request('details', "");
        $item->user_id = auth()->id();
        $item->serial_numbers = request('serial_numbers', "");

        if (!$item->save()) {
            //LoggerGuy::logInsertFailure(SalePayment::TYPE, $payment->toJson());
            return response()->json(['error' => "Failed to add the Inventory Item. "]);
        }

        //LoggerGuy::logInsertSuccess(SalePayment::TYPE, $item->wtid, $item->toJson());

        return ["item" => $item];
    }

    public function destroy($id)
    {
        $item = InventoryIn::find($id);

        if (null == $item) {
            return response()->json(['error' => "Invalid data sent. "], 422);
        }

        if (!$item->delete()) {
            return response()->json(['error' => "Failed to delete the record. "]);
        }

        return ["item" => $item, "success" => true, "message" => "Successfully deleted the record. "];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $item = InventoryIn::find($id);

        if (null == $item) {
            return response()->json(['error' => "Invalid inventory item data sent. "], 422);
        }

        $rules = [
            "dated"    => "required|date",
            "quantity" => "required|integer",
        ];

        $this->validate(request(), $rules);

        $item->dated = request('dated');
        $item->quantity = request('quantity');
        $item->cost = request('cost', "");
        $item->details = request('details', "");
        $item->serial_numbers = request('serial_numbers', "");

        if (!$item->save()) {
            return response()->json(['error' => "Failed to update the Inventory Item. "]);
        }

        return ["item" => $item, "success" => true, "message" => "Successfully updated Inventory Item. "];
    }
}
