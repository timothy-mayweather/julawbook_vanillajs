<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class Functions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        $connection = config('database.default');
        if ($connection !== 'pgsql') {
            return;
        }
        
        $queries = [
            "create or replace function setVars(val json) returns void as $$
                declare tr record;
                begin
                    for tr in select * from json_each($1)
                        loop
                            insert into data_vars(key, value) VALUES (tr.key,tr.value) on conflict(key) do update set value=tr.value;
                        end loop;
                end
            $$ language plpgsql; ",
        
            "create or replace function suppressDelete() returns trigger as $$
                begin
                    if old.deleted_at is null and old.user_d is null then
                        return null;
                    end if;
                    return old;
                end
            $$ language plpgsql; ",
            
            "create or replace function resetUpdateTime() returns trigger as $$
                begin
                    if new.user_d is not null then
                        new.deleted_at = current_timestamp;
                    elsif new.user_ is null then
                        return null;
                    elsif old is distinct from new then
                        new.updated_at = current_timestamp;
                    end if;
                    return new;
                end
            $$ language plpgsql;"
        ];
        foreach ($queries as $query) {
            DB::statement($query);
        }
        
        /* function calls
         * do $$ begin perform setVars('{"op":"5","2":"lp"}'); end $$ language plpgsql;
         */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        $connection = config('database.default');
        if ($connection !== 'pgsql') {
            return;
        }
        
        $fn_array = ['setVars','suppressDelete','resetUpdateTime'];
        
        foreach ($fn_array as $value) {
            DB::statement('drop function if exists '.$value.'; ');
        }
    }
}
