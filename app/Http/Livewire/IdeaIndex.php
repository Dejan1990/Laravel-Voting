<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Livewire\Component;
//use App\Exceptions\DuplicateVoteException;
//use App\Exceptions\VoteNotFoundException;

class IdeaIndex extends Component
{
    public $idea;
    public $votesCount;
    public $hasVoted;

    public function mount(Idea $idea, $votesCount)
    {
        $this->idea = $idea;
        $this->votesCount = $votesCount;
        $this->hasVoted = $idea->voted_by_user;
    }

    public function vote()
    {
        if (! auth()->check()) {
            return redirect(route('login'));
        }

        if ($this->hasVoted) {
            $this->idea->removeVote(auth()->user());
            $this->votesCount--;
            $this->hasVoted = false;
        } else {
            $this->idea->vote(auth()->user());
            $this->votesCount++;
            $this->hasVoted = true;
        }


        /*if (auth()->guest()) { da koristimo toggle() ovako bi radili
            return redirect(route('login'));
        }
        $this->idea->toggle(auth()->user());
        if ($this->hasVoted) {
            $this->hasVoted = false;
            $this->votesCount--;
        } else {
            $this->hasVoted = true;
            $this->votesCount++;
        }*/
    }

    /*public function vote() this is not need cause we use Livewire 2.6
    {
        if (! auth()->check()) {
            return redirect(route('login'));
        }
        if ($this->hasVoted) {
            $this->idea->removeVote(auth()->user());
            try {
                $this->idea->removeVote(auth()->user());
            } catch (VoteNotFoundException $e) {
                // do nothing
            }
            $this->votesCount--;
            $this->hasVoted = false;
        } else {
            $this->idea->vote(auth()->user());
            try {
                $this->idea->vote(auth()->user());
            } catch (DuplicateVoteException $e) {
                // do nothing
            }
            $this->votesCount++;
            $this->hasVoted = true;
        }
    }*/

    public function render()
    {
        return view('livewire.idea-index');
    }
}
