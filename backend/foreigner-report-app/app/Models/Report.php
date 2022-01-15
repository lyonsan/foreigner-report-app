<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    /**
     * m_subject_reportsテーブルとの1対多のリレーション
     */
    public function mSubjectReports()
    {
        return $this->hasMany(MSubjectReport::class);
    }

    /**
     * m_subjectsとの多対多のリレーション
     */
    public function mSubjects()
    {
        return $this->belongsToMany('App\Models\MSubject',
                                    'm_subject_reports',
                                    'report_id',
                                    'subject_id');
    }

    /**
     * text_infosとの多対多のリレーション
     */
    public function textInfos()
    {
        return $this->belongsToMany('App\Models\TextInfo',
                                    'report_text_infos',
                                    'report_id',
                                    'text_id');
    }
}
