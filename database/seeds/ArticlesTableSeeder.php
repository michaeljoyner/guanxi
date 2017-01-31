<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profile = \App\People\Profile::find(4);
        $profile2 = \App\People\Profile::find(5);
        $profile3 = \App\People\Profile::find(6);
        $profile4 = \App\People\Profile::find(7);

        factory(\App\Content\Article::class, 4)->create(['profile_id' => $profile->id, 'published' => true]);
        factory(\App\Content\Article::class, 4)->create(['profile_id' => $profile2->id, 'published' => true]);
        factory(\App\Content\Article::class, 4)->create(['profile_id' => $profile3->id, 'published' => true]);
        factory(\App\Content\Article::class, 4)->create(['profile_id' => $profile4->id, 'published' => true]);

        $taiwan = factory(\App\Content\Category::class)->create(['name' => ['en' => 'Taiwan', 'zh' => '雌醫']]);
        $world = factory(\App\Content\Category::class)->create(['name' => ['en' => 'World', 'zh' => '誒凹恩']]);
        $culture = factory(\App\Content\Category::class)->create(['name' => ['en' => 'Culture', 'zh' => '痾恩吃']]);
        $lifestyle = factory(\App\Content\Category::class)->create(['name' => ['en' => 'Lifestyle', 'zh' => '巫醫瘀恩']]);

        $cat_ids = collect([$taiwan->id, $world->id, $culture->id, $lifestyle->id]);

        \App\Content\Article::all()->each(function($article) use ($cat_ids) {
            $article->setCategories($cat_ids->random());
            $article->syncTags(factory(\App\Content\Tag::class, 3)->create());
        });
    }
}
