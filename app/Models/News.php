<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Model;

class News extends Model 
{
    use HasSlug, HasMedias;

    protected $fillable = [
        'published',
        'title',
        'description',
        'date',
        'medias',
    ];
    public array $publicAttributes = [
        'id',
        'published',
        'title',
        'description',
        'date_formatted',
        'medias',
    ];
    public $slugAttributes = [
        'title',
    ];
    public function getDateFormattedAttribute()
    {
        return $this->date ? $this->date->format('m/d/Y') : null;
    }
    public $mediasParams =[
        'image' =>  [
            'default'=>[
                [
                    'name' => 'default',
                    'ratio' => 'free'
                ]
            ]
        ]
                ];

    protected $casts = [
        'date' => 'datetime',
    ];

    private function processMedias($medias){
          if ($medias && count($medias) > 0) {
            $processedMedias = [];
            $roles = $medias
                ->unique('pivot.role')
                ->pluck('pivot.role');

            foreach ($roles as $role) {
                $images = $medias->imagesAsArraysWithCrops($role);
                $processedMedias[$role] = (is_array($images) && count($images) > 1) ? $images : reset($images);
            }

            $medias = $processedMedias;
            return $medias;
        }
    }
}
