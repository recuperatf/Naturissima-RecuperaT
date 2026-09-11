<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FourPModel extends Model
{
    public function getParsedUpdatedAtAttribute()
    {
        return date('Y/m/d', strtotime($this->updated_at));
    }

    public function getIsSealedTextAttribute()
    {
        return $this->is_sealed ? 'Sí' : 'No';
    }

    public function getHumanNameAttribute()
    {
        $classMapping = [
            'App\ProtocoloFisioterapia' => 'Protocolo de Fisioterapia',
            'App\HomePhysiotherapyProgram' => 'Programa Fisioterapéutico en Casa',
            'App\TerapeuticPlan' => 'Planes de tratamiento',
            'App\DiagnosisPlan' => 'Pruebas y medidas funcionales',
        ];
        return $classMapping[get_class($this)] ?? get_class($this);
    }

    static public function findResourceByType($keyword, $title, $author, $subject)
    {
        $returnQuery = self::where('is_sealed', true);
        $keyword = strtolower($keyword);
        if ($keyword) {
            $returnQuery->whereRaw("LOWER(name) like '%$keyword%'")
                ->orWhereHas('keywords', function ($query) use ($keyword) {
                    $query->whereRaw("LOWER(keywords.name) like '%$keyword%'");
                })
                ->orWhereRaw("LOWER(creator) like '%$keyword%'");
        }
        if ($title) {
            $returnQuery = $returnQuery->whereRaw("LOWER(name) like '%$title%'");
        }
        if ($author) {
            $returnQuery = $returnQuery->whereRaw("LOWER(creator) like '%$author%'");
        }
        return $returnQuery->get();
    }
}
