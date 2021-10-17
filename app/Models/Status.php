<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    public function ideas()
    {
        return $this->hasMany(Idea::class);
    }

   /* public function getStatusClasses() //ne koristimo jer imamo clas-e u DB
    {  
        $allStatuses = [ // krace u odnosu na ovo dole
            'Open' => 'bg-gray-200',
            'Considering' => 'bg-purple text-white',
            'In Progress' => 'bg-yellow text-white',
            'Implemented' => 'bg-green text-white',
            'Closed' => 'bg-red text-white',
        ];
        return $allStatuses[$this->name];
        if ($this->name === 'Open') {
            return 'bg-gray-200';
        } else if ($this->name === 'Considering') {
            return 'bg-purple text-white';
        } else if ($this->name === 'In Progress') {
            return 'bg-yellow text-white';
        } else if ($this->name === 'Implemented') {
            return 'bg-green text-white';
        } else if ($this->name === 'Closed') {
            return 'bg-red text-white';
        }
        return 'bg-gray-200'; // u slucaju da nema poklapanja, ovo bi bila default-na
    } */
}
