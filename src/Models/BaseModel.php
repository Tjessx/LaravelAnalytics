<?php

namespace BertBijnens\LaravelAnalytics\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $connection ='analytics';
}
