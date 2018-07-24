<?php

namespace BertBijnens\LaravelAnalytics\Models;

use Illuminate\Database\Eloquent\Model;

class UserAgent extends BaseModel {
    //TODO get data like platoform, browser, ...

    protected $fillable = ['name'];

    public static function getByName($name) {

        $ua = UserAgent::where('name', $name)->first();

        if(!$ua) {
            $ua = new UserAgent();
            $ua->name = $name;
            $ua->save();
        }

        return $ua;
    }
}
