<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//use App\Exceptions\DuplicateVoteException;
//use App\Exceptions\VoteNotFoundException;

class Idea extends Model
{
    use HasFactory, Sluggable;

    const PAGINATION_COUNT = 10;

    protected $guarded = [];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function votes()
    {
        return $this->belongsToMany(User::class, 'votes');
    }

    public function isVotedByUser(?User $user) //?User-> make it optional -> u ovom slucaju user mozda nije ulogovan
    {
        if (!$user) { // ovo radimo zbog ?User $user
            return false;
        }

        return Vote::where('user_id', $user->id)
            ->where('idea_id', $this->id)
            ->exists();

        //return $this->votes()->where('user_id', $user->id)->exists();
    }

    public function vote(User $user)
    {
        /*if ($this->isVotedByUser($user)) { this is not need cause we use Livewire 2.6
            throw new DuplicateVoteException;
        }*/

        Vote::create([
            'idea_id' => $this->id,
            'user_id' => $user->id,
        ]);
    }

    public function removeVote(User $user)
    {
        Vote::where('idea_id', $this->id)
            ->where('user_id', $user->id)
            ->first()
            ->delete();

        /*
        Vote::where('idea_id', $this->id)
            ->where('user_id', $user->id)
            ->delete();
        */

        /*this is not need cause we use Livewire 2.6
        $voteToDelete = Vote::where('idea_id', $this->id)
            ->where('user_id', $user->id)
            ->first();
        if ($voteToDelete) {
            $voteToDelete->delete();
        } else {
            throw new VoteNotFoundException;
        }
        */
    } 

    /*public function vote(User $user)
    {
        $this->votes()->attach($user);
    }
    public function removeVote(User $user)
    {
        $this->votes()->detach($user);
    }*/

    /*public function toggle(User $user)
   {
        $this->isVotedByUser($user) ?
            $this->votes()->detach($user) : $this->votes()->attach($user);
    }*/
}
