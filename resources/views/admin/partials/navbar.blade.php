<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">
{{--                <img src="{{ asset('images/chars.jpg') }}" alt="logo"/>--}}
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="/admin">@include('svgicons.home')</a></li>
                <li class="dropdown">
                    <a href="#"
                       class="dropdown-toggle"
                       data-toggle="dropdown"
                       role="button"
                       aria-haspopup="true"
                       aria-expanded="false"
                    >Content <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/admin/content/articles">Articles</a></li>
                        @if(Auth::user()->isSuperAdmin())
                        <li><a href="/admin/content/categories">Categories</a></li>
                        <li><a href="/admin/content/tags">Tags</a></li>
                        @endif
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#"
                       class="dropdown-toggle"
                       data-toggle="dropdown"
                       role="button"
                       aria-haspopup="true"
                       aria-expanded="false"
                    >Media <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/admin/media/photos">Photos</a></li>
                        <li><a href="/admin/media/artworks">Art</a></li>
                        <li><a href="/admin/media/videos">Videos</a></li>
                    </ul>
                </li>
                {{--<li><a href="/admin/social">Social</a></li>--}}
                <li><a href="/admin/profiles">{{ Auth::user()->isSuperAdmin() ? 'Contributors' : 'My Profile' }}</a></li>
                @if(Auth::user()->isSuperAdmin())
                    {{--<li><a href="/admin/affiliates">Affiliates</a></li>--}}
                    <li><a href="/admin/pages/about">About Page</a></li>
                @endif

            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if(Auth::user()->isSuperAdmin())
                <li><a href="/admin/users">Users</a></li>
                @endif
                <li class="dropdown">
                    <a href="#"
                       class="dropdown-toggle"
                       data-toggle="dropdown"
                       role="button"
                       aria-haspopup="true"
                       aria-expanded="false"
                    >{{ Auth::user()->email }} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/admin/profiles/{{ Auth::user()->profile->id }}">My Profile</a></li>
                        <li><a href="/admin/users/{{ Auth::user()->id }}/password/edit">Reset Password</a></li>
                        <li><a href="/admin/logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>