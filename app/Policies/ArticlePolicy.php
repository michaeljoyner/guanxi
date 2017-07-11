<?php

namespace App\Policies;

use App\Content\Article;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if($user->isSuperAdmin()) {
            return true;
        }
    }

    public function view(User $user, Article $article)
    {
        return $user->profile->id === $article->author->id;
    }

    public function update(User $user, Article $article)
    {
        return $user->profile->id === $article->author->id;
    }

    public function delete(User $user, Article $article)
    {
        return $user->profile->id === $article->author->id;
    }
}
