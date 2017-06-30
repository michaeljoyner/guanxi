<?php


namespace App\Affiliates;


class AffiliatesRepository
{
    public function allPublished()
    {
        return Affiliate::published()->latest()->get();
    }

    public function bySlug($slug)
    {
        return Affiliate::where('slug', $slug)->firstOrFail();
    }

    public function getNextInLineAfter($affiliate)
    {
        $next = Affiliate::published()->where('created_at', '<', $affiliate->created_at)->latest()->first();

        if(! $next) {
            return Affiliate::published()->latest()->first();
        }

        return $next;
    }
}