<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InventoryItemsSummaryViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE OR REPLACE VIEW inventory_items_transactions_summary_vu AS
            SELECT i.id as item_id, 
            (SELECT COALESCE(SUM(ii.quantity), 0) from inventory_ins ii WHERE ii.deleted_at IS NULL AND ii.item_id = i.id) AS total_ins,
            (SELECT COALESCE(SUM(io.quantity), 0) from inventory_outs io WHERE io.deleted_at IS NULL AND io.item_id = i.id) AS total_outs, 
            (
                (SELECT COALESCE(SUM(ii.quantity), 0) from inventory_ins ii WHERE ii.deleted_at IS NULL AND ii.item_id = i.id) - 
                (SELECT COALESCE(SUM(io.quantity), 0) from inventory_outs io WHERE io.deleted_at IS NULL AND io.item_id = i.id)
            ) as total_on_hand
            FROM inventory_items i
        ");   
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS inventory_items_transactions_summary_vu');
    }
}
