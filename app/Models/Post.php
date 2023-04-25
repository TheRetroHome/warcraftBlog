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
        return $this->belongsTo(Category::class);   //1 пост = 1 категория
    }
    public function likes()
    {
        return $this->hasMany(Like::class);         //1 пост = много лайков
    }

    public function likedBy(User $user)
    {
        return $this->likes->contains('user_id', $user->id); //Используем в виде single (для отображения нужной кнопки)
    }

    public static function uploadImage(Request $request,$image = null){
        if ($request->hasFile('thumbnail')){    //Добавляем картинку в папку с соответствующей датой (если есть старая, удаляем её)
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
            return asset('images\default.png'); //Для вывода картинки. Если она есть выводим, если нет, выведем дефолтную
        }
        return asset("storage/{$this->thumbnail}");
    }
    public function getPostDate(){
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d F, Y');    //Для отображения даты в виде
    }
    public function scopeLike($query,$s){
        return $query->where('title','LIKE',"%{$s}%");  //Скоп для поиска постов
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
