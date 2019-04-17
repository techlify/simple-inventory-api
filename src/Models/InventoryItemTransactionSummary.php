<?php

namespace TechlifyInc\TechlifySimpleInventory\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryItemTransactionSummary extends Model
{
    protected $table = 'inventory_items_transactions_summary_vu';
    protected $primaryKey = 'item_id';
}
