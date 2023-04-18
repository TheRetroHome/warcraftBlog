<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class Post extends Model
{
    protected $fillable = ['title','description','content','category_id','thumbnail'];
    use HasFactory;
    use Sluggable;
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public static function uploadImage(Request $request,$image = null){
        if ($request->hasFile('thumbnail')){
            if($image){
                Storage::disk('public')->delete($image);
            }
            $folder = date('Y-m-d');
            return  $request->file('thumbnail')->store("/images/{$folder}", 'public');
        }
        return null;
    }
    public function getImage(){
        if(!$this->thumbnail){
            return asset('no-image.png');
        }
        return asset("uploads/{$this->thumbnail}");
    }
}
