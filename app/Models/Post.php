<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['title', 'description', 'content', 'category_id', 'views', 'thumbnail'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps(); //Если хотите, чтобы ваша промежуточная таблица имела временные метки created_at и updated_at, которые автоматически поддерживаются Eloquent, метод withTimestamps при определении отношения
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array //метод от импортированной библиотеки Laravel Slugable - она создает уникальные(подставляет -1 или -2 для уникализации повторяющихся) ЧПУ.
    {
        return [
            'slug' => [ //поле slug будет создаваться из введенных нами полей 'title'
                'source' => 'title'
            ]
        ];
    }

    public static function uploadImage(Request $request, $image = null)
    {
        if($request->hasFile('thumbnail')) //Вы можете определить, есть ли в запросе файл, с помощью метода hasFile
        {
            $folder = date('Y-m-d');
            if($image){ //если передаем аргументом $image (это будет означать, что картинка выбрана в старой редакции статьи и ее нужно удалить, чтобы почистить данные), то она удаляется
                Storage::delete($image);
            }
            return $request->file('thumbnail')->store("images/{$folder}"); //По умолчанию метод store загружаемого файла будет использовать ваш диск по умолчанию. Диск устанавливается в config/filesystems.php и в .env. file() - выдает файл, видимый через request. В итоге возвращаем полный адрес картинки
        }
        return null;
    }
    public function getImage() //для файла edit. Если в текущей редакции файла есть картинка, она вернется. Если нет - вернется картинка "no_image.jpg"
    {
        if(!$this->thumbnail){
            return asset("no_image.jpg"); //После того как была создана символическая ссылка, вы можете создавать URL-адреса для сохраненных файлов, используя помощник asset. Функция asset генерирует URL для исходника
        }
        return asset("storage/{$this->thumbnail}");
    }

    public function getTitleAttribute($title)
    {
        return Str::ucfirst($title);
    }

    public function formattingTheCreationDate($date) //форматирует вывод даты создания поста
    {
      return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y');
    }
}
