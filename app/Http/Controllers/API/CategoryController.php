<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Category;
use Validator;
use App\Http\Resources\Category as CategoryResource;
   
class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
    
        return $this->sendResponse(CategoryResource::collection($categories), 'Categories retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required',
            'image' => 'required|image|max:500|mimes:png,jpeg,jpg'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/categories', $filename);

            $category = Category::create([
                'name' => $request->name,
                'slug' => $request->name,
                'image' => $filename
            ]);

            $category_id = $category->id;
        }
   
        // $category = Category::create($input);
   
        return $this->sendResponse(new CategoryResource($category), 'Category created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
  
        if (is_null($category)) {
            return $this->sendError('Category not found.');
        }
   
        return $this->sendResponse(new CategoryResource($category), 'Category retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required',
            'image' => 'required|image|max:500|mimes:png,jpeg,jpg'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        // $category->name = $input['name'];
        // $category->slug = $input['slug'];
        // $category->save();

        $category = Category::find($id);
        $filename = $category->image;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/categories', $filename);
            File::delete(storage_path('app/public/categories/' . $category->image));
        }

        $category->update([
            'name' => $request->name,
            'image' => $filename
        ]);
   
        return $this->sendResponse(new CategoryResource($category), 'Category updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // $category->delete();
        $category = Category::find($id);
        File::delete(storage_path('app/public/categories/' . $category->image));
        $category->delete();

        $subcategory = Subcategory::where('category_id', $id)->get();

        foreach($subcategory as $v) {
            $v->delete();
        }
   
        return $this->sendResponse([], 'Category deleted successfully.');
    }
}