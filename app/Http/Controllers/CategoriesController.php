<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{

    public function main(Request $request)
    {        
        if($request->has("add_category")){
            return $this->add($request);
        } 
        else  if($request->has("update_category")) {
            return $this->update($request);
        }
        else  if($request->has("delete_category")) {
            return$this->delete($request);
        }
    }

    public function add(Request $request)
    {
        $name = $request->input('category_name');
        $category = new Category;
        $category->user_id = Auth::id();
        $category->name = $name ;
        $category->save();
        return redirect()->to('categories');
    }

    public function update(Request $request)
    {
        $categories = $request->input('categories');
        if($categories == null) {
            return redirect()->to('categories');    
        }
        foreach ($categories as $id=>$name) {
            $new_category = Category::find($id);
            
            $new_category->update([
                'name'=> $name,
            ]);
        }
        return redirect()->to('categories');
    }

    public function delete(Request $request)
    {
        $id = $request->input('delete_category');
        $category = Category::find($id);
        $category->is_valid= 0;
        $category->save();
        return redirect()->to('categories');
    }
}
