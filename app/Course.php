<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Course extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'courses';

    protected $appends = [
        'picture',
        'intro_video',
    ];

    protected $dates = [
        'start_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'slug',
        'title',
        'published',
        'start_date',
        'created_at',
        'updated_at',
        'deleted_at',
        'description',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function courseLessons()
    {
        return $this->hasMany(Lesson::class, 'course_id', 'id');
    }

    public function courseTests()
    {
        return $this->hasMany(Test::class, 'course_id', 'id');
    }

    public function getIntroVideoAttribute()
    {
        return $this->getMedia('intro_video')->last();
    }

    public function getPictureAttribute()
    {
        $file = $this->getMedia('picture')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
        }

        return $file;
    }

    public function getStartDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function teachers()
    {
        return $this->belongsToMany(User::class);
    }
}