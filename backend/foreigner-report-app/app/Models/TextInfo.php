<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextInfo extends Model
{
    /**
     * reportsテーブルとの多対多のリレーション
     */
    public function reports()
    {
        return $this->belongsToMany('App\Models\Report',
                                    'report_text_infos',
                                    'report_id',
                                    'text_id');
    }
}
