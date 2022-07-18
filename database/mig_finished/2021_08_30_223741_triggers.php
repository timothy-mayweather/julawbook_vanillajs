<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class Triggers extends Migration
{
    public $tables = ['users','branches','branch_users','product_types','products','branch_products'];
    
    public $common_triggers = [
//        ['pre'=>'log_action_','when'=>'after insert or update','fn'=>'logAction()','tables'=>[]],
        ['pre'=>'suppress_delete_','when'=>'before delete','fn'=>'suppressDelete()','tables'=>[]],
        ['pre'=>'reset_updated_at_','when'=>'before update','fn'=>'resetUpdateTime()','tables'=>[]]
    ];
    
    /**
     * Create common triggers on the different tables
     *
     * @return void
     */
    public function createCommonTriggers(): void
    {
        foreach($this->common_triggers as $tr) {
            $tr['tables'] = $this->tables;
            foreach ($tr['tables'] as $table) {
                $query = 'create trigger ' . $tr['pre'] . $table . ' ' . $tr['when'] . ' on ' . $table . ' for each row execute function ' . $tr['fn'];
                DB::statement($query);
            }
        }
    }
    
    /**
     * Drop common triggers on the different tables
     *
     * @return void
     */
    public function dropCommonTriggers(): void
    {
        foreach($this->common_triggers as $tr) {
            $tr['tables'] = $this->tables;
            foreach ($tr['tables'] as $table) {
                $query = 'drop trigger if exists ' . $tr['pre'] . $table . ' on ' . $table;
                DB::statement($query);
            }
        }
    }
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        $this->createCommonTriggers();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        $this->dropCommonTriggers();
    }
}
