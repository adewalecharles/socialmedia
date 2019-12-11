<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Lesson extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'lessons';

    protected $appends = [
        'image',
        'video',
        'downloadable_file',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'slug',
        'title',
        'active',
        'course_id',
        'decription',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function lessonTests()
    {
        return $this->hasMany(Test::class, 'lesson_id', 'id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function getImageAttribute()
    {
        $files = $this->getMedia('image');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
        });

        return $files;
    }

    public function getVideoAttribute()
    {
        return $this->getMedia('video');
    }

    public function getDownloadableFileAttribute()
    {
        return $this->getMedia('downloadable_file');
    }
}
