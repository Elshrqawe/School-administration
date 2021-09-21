<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Models\Grade;
class Section extends Model
{

    use HasTranslations;

    public $translatable = ['Name_Section'];


    protected $table = 'Sections';
    public $timestamps = true;
    protected $fillable = ['Name_Section', 'Grade_id','Class_id '];


    // علاقة بين الاقسام والصفوف لجلب اسم الصف في جدول الاقسام

    public function My_classs()
    {
        return $this->belongsTo('App\Models\Classroom', 'Class_id');
    }

    // علاقة  الاقسام  مع المعلمين
    public function teachers()
    {
        return $this->belongsToMany('App\Models\Teacher', 'teacher_section');
    }

}
