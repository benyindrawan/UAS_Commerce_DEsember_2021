<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AdminAddCategoryComponent extends Component
{
    public $name;
    public $slug;

    public function generateslug()
    {
        $this->slug = Str::slug($this->name);
    }
    public function storeCategory()
    {
        DB::beginTransaction();

        try {
            $category = new Category();
            $category->name = $this->name;
            $category->slug = $this->slug;
            $category->save();

            DB::commit();
            session()->flash('message', 'Category has been created successfully!');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function render()
    {
        return view('livewire.admin.admin-add-category-component')->layout('layouts.base');
    }
}
