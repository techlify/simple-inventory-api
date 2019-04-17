<?php

namespace TechlifyInc\TechlifySimpleInventory\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{

    public function user()
    {
        return $this->belongsTo(\App\User::class, "uid", "id");
    }

    public function transactionSummary()
    {
        return $this->hasOne(InventoryItemTransactionSummary::class, "item_id", "id");
    }

    public function scopeFilter($query, $filters)
    {
        if(isset($filters['description']) && "" != trim($filters['description']))
        {
            $query->where('description', 'LIKE', '%' . $filters['description'] . '%');
        }
        
        if (isset($filters['sort_by']) && "" != trim($filters['sort_by']))
        {
            $sort = explode("|", $filters['sort_by']);

            switch ($sort[0])
            {
                default:
                    $query->orderBy($sort[0], $sort[1]);
                    break;
                case "stock":
                    $query->join('inventory_items_transactions_summary_vu', 'inventory_items.id', '=', 'inventory_items_transactions_summary_vu.item_id');
                    $query->orderBy('inventory_items_transactions_summary_vu.total_on_hand', $sort[1]);
                    break;
            }
        }
        if (isset($filters['num_items']) && is_numeric($filters['num_items']))
        {
            $query->limit($filters['num_items']);
        }
        
    }

}
