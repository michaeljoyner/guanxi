<?php


namespace App\Social;


trait HasSocialLinks
{
    public function socialLinks()
    {
        return $this->morphMany(SocialLink::class, 'sociable');
    }

    public function setSocialLink($platform, $link)
    {
        return $this->socialLinks()->create([
            'platform' => $platform,
            'link' => $link
        ]);
    }

    public function updateSocialLinks($links)
    {
        $this->socialLinks->each(function($social_link) {
            $social_link->delete();
        });

        collect($links)->each(function($link, $platform) {
            $this->setSocialLink($platform, $link);
        });
    }

    public function getSocialLink($platform)
    {
        $socialLink = $this->socialLinks()->where('platform', $platform)->first();

        return $socialLink->link ?? null;
    }

    public function removeSocialLinks($platforms)
    {
        $this->socialLinks->filter(function($socialLink) use ($platforms) {
            return in_array($socialLink->platform, $platforms);
        })->each(function($socialLink) {
            $socialLink->delete();
        });
    }
}