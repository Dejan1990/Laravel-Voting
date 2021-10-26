<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Livewire\Component;
use App\Http\Livewire\Traits\WithAuthRedirects;
//use App\Exceptions\DuplicateVoteException;
//use App\Exceptions\VoteNotFoundException;

class IdeaShow extends Component
{
    use WithAuthRedirects;

    public $idea;
    public $votesCount;
    public $hasVoted;

    protected $listeners = [
        'statusWasUpdated',
        'statusWasUpdatedError',
        'ideaWasUpdated',
        'ideaWasMarkedAsSpam',
        'ideaWasMarkedAsNotSpam',
        'commentWasAdded',
        'commentWasDeleted'
    ];

    /*protected $listeners = [ ne bismo morali da dodajemo refresh() na vise mesta
        'statusWasUpdated' => '$refresh',
        'ideaWasUpdated' => '$refresh',
      ];*/

    public function mount(Idea $idea, $votesCount)
    {
        $this->idea = $idea;
        $this->votesCount = $votesCount;
        $this->hasVoted = $idea->isVotedByUser(auth()->user());
    }

    public function statusWasUpdated()
    {
        $this->idea->refresh();
    }

    public function statusWasUpdatedError()
    {
        $this->idea->refresh();
    }

    public function ideaWasUpdated()
    {
        $this->idea->refresh();
    }

    public function ideaWasMarkedAsSpam()
    {
        $this->idea->refresh();
    }

    public function ideaWasMarkedAsNotSpam()
    {
        $this->idea->refresh();
    }

    public function commentWasAdded()
    {
        $this->idea->refresh();
    }

    public function commentWasDeleted()
    {
        $this->idea->refresh();
    }

    public function vote()
    {
        if (auth()->guest()) {
            return $this->redirectToLogin();
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
        return view('livewire.idea-show');
    }
}
