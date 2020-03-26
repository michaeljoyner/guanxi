<nav class="h-16 pl-6 bg-brand-purple text-white flex justify-between">
    <div class="flex items-center">
        <a class="navbar-brand" href="/admin">
            @include('svg.logo_icon', ['classes' => 'fill-current text-white h-8'])
        </a>
        <dropdown v-cloak
                  name="Content"
                  class="text-white hover:text-mustard h-12 flex items-center h-16 bg-deep-navy px-4">
            <div slot="dropdown_content"
                 class="py-3 text-right">
                <a class="block mb-2 hover:underline text-brand-purple" href="/admin/content/articles">Articles</a>
                @if(Auth::user()->isSuperAdmin())
                    <a class="block mb-2 hover:underline text-brand-purple" href="/admin/content/categories">Categories</a>
                    <a class="block mb-2 hover:underline text-brand-purple" href="/admin/content/tags">Tags</a>
                @endif
            </div>
        </dropdown>
        <dropdown v-cloak
                  name="Media"
                  class="text-white hover:text-mustard h-12 flex items-center h-16 bg-deep-navy px-4">
            <div slot="dropdown_content"
                 class="py-3 text-right">
                <a class="block mb-2 hover:underline text-brand-purple" href="/admin/media/photos">Photos</a>
                <a class="block mb-2 hover:underline text-brand-purple" href="/admin/media/artworks">Art</a>
                <a class="block mb-2 hover:underline text-brand-purple" href="/admin/media/videos">Videos</a>
            </div>
        </dropdown>


        <a href="/admin/profiles" class="mx-4 hover:underline">
            {{ Auth::user()->isSuperAdmin() ? 'Contributors' : 'My Profile' }}
        </a>
        @if(Auth::user()->isSuperAdmin())
            <a href="/admin/pages/about" class="px-4">About Page</a>
            <a href="/admin/testimonials" class="px-4">Testimonials</a>
        @endif
    </div>

    <div class="flex items-center">
        @if(Auth::user()->isSuperAdmin())
            <a class="hover:underline mx-4" href="/admin/users">Users</a>
        @endif
        <dropdown v-cloak
                  name="{{ auth()->user()->name }}"
                  class="flex items-center h-16 bg-brand-soft-purple px-4">
            <div slot="dropdown_content"
                 class="py-3 text-right">
                <a class="hover:underline text-brand-purple block mb-2"
                   href="/admin/profiles/{{ Auth::user()->profile->id }}">My Profile</a>
                <a class="hover:underline text-brand-purple block mb-2"
                   href="/admin/users/{{ Auth::user()->id }}/password/edit">Reset Password</a>
                <a class="hover:underline text-brand-purple block mb-2"
                   href="/admin/logout">Logout</a>
            </div>
        </dropdown>

    </div>

</nav>