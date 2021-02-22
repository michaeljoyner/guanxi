<?php


namespace App\Content;


interface CanBeFeatured
{
    public function bannerTitle($locale): string;

    public function fullSLug(): string;

    public function featureImage(): string;

    public function viewable(): bool;
}