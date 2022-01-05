<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MSubjectReport extends Model
{
    /**
     * reportsテーブルとの1対多のリレーション
     */
    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    /**
     * m_subjectsテーブルとの1対多のリレーション
     */
    public function mSubject()
    {
        return $this->belongsTo(MSubject::class);
    }
}
