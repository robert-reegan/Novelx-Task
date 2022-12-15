<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array(
                'category_name' => 'Parent1',
                'parent_id' => 0,
                'sort_order' => 0,
                'created_at' => date('Y-m-d H:i:s')
            ),
            array(
                'category_name' => 'Parent2',
                'parent_id' => 0,
                'sort_order' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ),
            array(
                'category_name' => 'Parent2_Child1',
                'parent_id' => 2,
                'sort_order' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ),
            array(
                'category_name' => 'Parent2_Child2',
                'parent_id' => 2,
                'sort_order' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ),
            array(
                'category_name' => 'Parent3',
                'parent_id' => 0,
                'sort_order' => 2,
                'created_at' => date('Y-m-d H:i:s')
            ),
            array(
                'category_name' => 'Parent3_Child1',
                'parent_id' => 5,
                'sort_order' => 2,
                'created_at' => date('Y-m-d H:i:s')
            ),
            array(
                'category_name' => 'Parent3_Child2',
                'parent_id' => 5,
                'sort_order' => 2,
                'created_at' => date('Y-m-d H:i:s')
            ),
            array(
                'category_name' => 'Parent3_Child3',
                'parent_id' => 5,
                'sort_order' => 2,
                'created_at' => date('Y-m-d H:i:s')
            ),
            array(
                'category_name' => 'Parent3_Child4',
                'parent_id' => 5,
                'sort_order' => 2,
                'created_at' => date('Y-m-d H:i:s')
            ),
            array(
                'category_name' => 'Parent4',
                'parent_id' => 0,
                'sort_order' => 3,
                'created_at' => date('Y-m-d H:i:s')
            ),
            array(
                'category_name' => 'Parent4_Child1',
                'parent_id' => 10,
                'sort_order' => 3,
                'created_at' => date('Y-m-d H:i:s')
            ),
            array(
                'category_name' => 'Parent4_Child2',
                'parent_id' => 10,
                'sort_order' => 3,
                'created_at' => date('Y-m-d H:i:s')
            ),
            array(
                'category_name' => 'Parent5',
                'parent_id' => 0,
                'sort_order' => 4,
                'created_at' => date('Y-m-d H:i:s')
            ),
            array(
                'category_name' => 'Parent6',
                'parent_id' => 0,
                'sort_order' => 5,
                'created_at' => date('Y-m-d H:i:s')
            ),

        );
        $catgory_list    = DB::table('categories')->count();
        if ($catgory_list == 0) {
            DB::table('categories')->insert($data);
        }
    }
}
