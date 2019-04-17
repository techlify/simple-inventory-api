<?php
namespace TechlifyInc\TechlifySimpleInventory\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use TechlifyInc\TechlifySimpleInventory\Models\InventoryItem;

class InventoryItemController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filters = request(["sort_by", "description", "num_items"]);
        $items = InventoryItem::filter($filters)
            ->with("user")
            ->with("transactionSummary")
            ->get();

        return array("items" => $items);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->hasPermission("inventory_item_create")) {
            return response()->json(['error' => "You are unauthorized to perform this action. "], 401);
        }

        $rules = [
            "measure"     => "required",
            "description" => "required",
        ];

        $this->validate(request(), $rules);

        $item = new InventoryItem();
        $item->description = request('description');
        $item->measure = request('measure');
        $item->user_id = auth()->id();

        if (!$item->save()) {
            //LoggerGuy::logInsertFailure(SalePayment::TYPE, $payment->toJson());
            return response()->json(['error' => "Failed to add the Inventory Item. "]);
        }

        //LoggerGuy::logInsertSuccess(SalePayment::TYPE, $item->wtid, $item->toJson());

        return array("item" => $item);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = InventoryItem::find($id);

        $item->transactionSummary;
        return ["item" => $item];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        if (!auth()->user()->hasPermission("inventory_item_update")) {
            return response()->json(['error' => "You are unauthorized to perform this action. "], 401);
        }

        $rules = [
            "measure"     => "required",
            "description" => "required",
        ];

        $this->validate(request(), $rules);

        $item = InventoryItem::find($id);

        if (null == $item) {
            return response()->json(['error' => "Invalid item data sent. "], 422);
        }

        $item->description = request('description');
        $item->measure = request('measure');

        if (!$item->save()) {
            return response()->json(['error' => "Failed to add the Inventory Item. "], 422);
        }

        return array("item" => $item);
    }
}
