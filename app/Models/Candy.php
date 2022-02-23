<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candy extends Model
{
    use HasFactory;

    protected $fillable = [
       'name', 'cocoa_content', 'sugar_content'
    ];

    public static function csokisakCukortartalma() :float{
      $atlag =  Candy::where('cocoa_content', '>', 0)
        ->average('sugar_content');

        if($atlag === null) {
            return NAN;
        }
        return $atlag;
        /*
        $candies = Candy::all();

        $sum = 0;
        $count = 0;
        foreach($candies as $candy){
            if($candy -> cocoa_content > 0) {
                $sum += $candy->sugar_content;
                $count++;
            }
        }
        if($count === 0) {
            return NAN;
        }
        return floatval($sum) / $count;*/
    }

    public static function cukor_es_csoki_mentes_edessegek() {
        $darab = Candy::where([
            ['cocoa_content', '=', '0'],
            ['sugar_content', '=', '0']
            ])
        ->count('name');

        return $darab;
    }
}
