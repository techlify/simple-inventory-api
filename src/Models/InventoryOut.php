<?php

namespace TechlifyInc\TechlifySimpleInventory\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Inventory\InventoryItem;
use App\Models\Customer\Customer;

class InventoryOut extends Model {

    use \Illuminate\Database\Eloquent\SoftDeletes;

    public function inventoryItem() {
        return $this->hasOne(InventoryItem::class, "id", "item_id");
    }

    public function customer() {
        return $this->hasOne(Customer::class, "cid", "customer_id")->withDefault([
                    "named" => "(none)",
                    "cid" => 0
        ]);
    }

    public function scopeFilter($query, $filters) {
        if (isset($filters['item']) && "" != trim($filters['item'])) {
            $query->whereHas('inventoryItem', function($q) use ($filters) {
                $q->where('description', 'LIKE', '%' . $filters['item'] . '%');
            })->get();
        }

        if (isset($filters['customer_id']) && "" != trim($filters['customer_id']) && intval($filters['customer_id']) > 0) {
            $query->whereHas('customer', function($q) use ($filters) {
                $q->where('cid', $filters['customer_id']);
            })->get();
        }

        if (isset($filters['date_to']) && "" != $filters['date_to']) {
            $query->where('dated', '<=', $filters['date_to']);
        }

        if (isset($filters['date_from']) && "" != $filters['date_from']) {
            $query->where('dated', '>=', $filters['date_from']);
        }
        if (isset($filters['item_id'])) {
            $query->where('item_id', '=', $filters['item_id']);
        }

        if (isset($filters['sort_by']) && "" != trim($filters['sort_by'])) {
            $sort = explode("|", $filters['sort_by']);
            $query->orderBy($sort[0], $sort[1]);
        }
        if (isset($filters['num_items']) && is_numeric($filters['num_items'])) {
            $query->limit($filters['num_items']);
        }

        if (isset($filters['items_without_customer']) && (true === $filters['items_without_customer'] || 'true' === $filters['items_without_customer'])) {
            $query->where('customer_id', '=', null);
        }
        
        if(isset($filters['serial_numbers']) && "" != trim($filters['serial_numbers'])) {
            $query->where('serial_numbers', 'LIKE', '%' . $filters['serial_numbers'] . '%');
        }
    }

}
