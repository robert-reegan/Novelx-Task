<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ListViewController extends Controller
{


    public function index()
    {
        $category = array(
            'categories' => array(),
            'parent_categories' => array()
        );
        $result = Category::get();

        foreach ($result as $list) {
            $category['categories'][$list['id']] = $list;
            $category['parent_categories'][$list['parent_id']][] = $list['id'];
        }

        $list = $this->buildTreeCategory(0, $category);

        return view('listing')->with('list', $list);
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
}
