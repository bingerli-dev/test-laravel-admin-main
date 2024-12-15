<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class K22Transaction extends BaseModel
{
    use HasFactory;

    protected $table = "k22_transaction";

    // 取消自动维护创建时间和更新时间字段
    public $timestamps = false;
}
