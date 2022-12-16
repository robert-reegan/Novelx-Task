<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListViewController extends Controller
{


    public function index()
    {
        $category = array(
            'categories' => array(),
            'parent_categories' => array()
        );
        $result = Category::get()->toArray();


        $collection = collect($result);

        $cate_list = $collection->mapWithKeys(function ($item, $key) {
            return [$item['id'] => $item['category_name']];
        });


        foreach ($result as $list) {
            $category['categories'][$list['id']] = $list;
            $category['parent_categories'][$list['parent_id']][] = $list['id'];
        }

        $list = $this->buildTreeCategory(0, $category);

        return view('listing')->with('list', $list)->with('cate_list', $cate_list);
    }

    public function buildTreeCategory($parent, $category)
    {
        $html = "";

        if (isset($category['parent_categories'][$parent])) {

            $html .= "<ul>\n";
            foreach ($category['parent_categories'][$parent] as $cat_id) {

                if (!isset($category['parent_categories'][$cat_id])) {
                    $html .= "<li>\n  <a href='javascript:void(0)'>" . $category['categories'][$cat_id]['category_name'] . "</a>\n</li> \n";
                }
                if (isset($category['parent_categories'][$cat_id])) {
                    $html .= "<li>\n  <a href='javascript:void(0)'>" . $category['categories'][$cat_id]['category_name'] . "</a> \n";
                    $html .= $this->buildTreeCategory($cat_id, $category);
                    $html .= "</li> \n";
                }
            }
            $html .= "</ul> \n";
        }

        return $html;
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'sub_folder_name' => 'required',
            'parent_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'validation errors'], 400);
        }

        $sub_folder_name = $request->input('sub_folder_name');
        $parent_id = $request->input('parent_id');
        $data = array('category_name' => $sub_folder_name, "parent_id" => $parent_id, "sort_order" => $parent_id);
        $result = DB::table('categories')->insert($data);

        return redirect('/view');
    }
}
