<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Route;
use App\Models\Idea;
use App\Models\Status;

class StatusFilters extends Component
{
    public $status = 'All';
    //public $status = ''; This way it won't show ?status= when status is empty
    public $statusCount;

    protected $queryString = [
        'status',
    ];

    /*protected $queryString = [ This way it won't show ?status= when status is empty
        'status' => ['except' => ''], 
        https://laravel-livewire.com/docs/2.x/query-string ("Keeping A Clean Query String" section)
    ];*/

    public function mount()
    {
        $this->statusCount = Status::getCount();
        
        if (Route::currentRouteName() === 'idea.show') {
            $this->status = null;
            $this->queryString = [];
        }
    }

    public function setStatus($newStatus)
    {
        $this->status = $newStatus;

        // dd(Route::currentRouteName());

        //if ($this->getPreviousRouteName() === 'idea.show') {
        return redirect()->route('idea.index', [
                'status' => $this->status,
            ]);
        //}
    }

    public function render()
    {
        return view('livewire.status-filters');
    }

    public function getPreviousRouteName()
    {
        return app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
    }
}
