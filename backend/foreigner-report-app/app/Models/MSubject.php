<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MSubject extends Model
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
    public function reports()
    {
        return $this->belongsToMany('App\Models\Report',
                                    'm_subject_reports',
                                    'report_id',
                                    'subject_id');
    }
}
