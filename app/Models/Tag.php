<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Tag extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['title'];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }


    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array //метод от импортированной библиотеки Laravel Slugable - она создает уникальные(подставляет -1 или -2 для уникализации повторяющихся) человекоподобные УРЛы(конвертирует русские тайтлы в английские и меняет большие буквы на маленькие, и ставит тире между словами).
    {
        return [
            'slug' => [ //поле slug будет создаваться из введенных нами полей 'title'
                'source' => 'title'
            ]
        ];
    }

}
