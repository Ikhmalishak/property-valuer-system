<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Drop the old view if it exists
        DB::statement("DROP VIEW IF EXISTS paid_invoices");

        // Create the new view with the updated name
        DB::statement("
            CREATE VIEW archives AS
            SELECT *
            FROM invoices
            WHERE status = 'paid'
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Revert back to the old name if rolled back
        DB::statement("DROP VIEW IF EXISTS archives");

        DB::statement("
            CREATE VIEW paid_invoices AS
            SELECT *
            FROM invoices
            WHERE status = 'paid'
        ");
    }
};