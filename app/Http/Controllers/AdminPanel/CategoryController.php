<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::paginate(3); //Берём все категории и пагинируем по 3
        $pagination=$categories->links('pagination::bootstrap-4'); //Отправляем красивую пагинацию
        return view('admin.categories.index',compact('categories','pagination'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'=>'required',    //Валидируем
        ]);
        Category::create($data);    //Создаём
        return redirect()->route('category.index')->with('success','Категория успешно добавлена');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'title'=>'required',    //Валидируем
        ]);
        $category->update($data);   //Обновляем
        return redirect()->route('category.index')->with('success','Категория успешно редактирована!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if($category->posts()->count()){    //Если у этой категории есть привязанные посты, мы её не сможем удалить
            return redirect()->route('category.index')->with('error','Ошибка! У категории есть записи!');
        }
        $category->delete($category);
        return redirect()->route('category.index')->with('success','Категория успешно удалена!');
    }
}
