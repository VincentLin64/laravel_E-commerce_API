<nav class="navbar navbar-expand-lg bg-secondary mb-3" data-bs-theme="dark">
    <div class="container-fluid">
{{--        <a class="navbar-brand" href="/">電商網站</a>--}}
{{--        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--            <span class="navbar-toggler-icon"></span>--}}
{{--        </button>--}}
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" aria-current="page" href="/">商品列表</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('contact_us') ? 'active' : '' }}" aria-current="page" href="/contact_us">聯絡我們</a>
                </li>
            </ul>
        </div>
        <div>
            @auth
                <input type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#notifications" value="通知">
                <a href="/logout?type=web" class="btn btn-info" role="button">登出</a>
            @else
                <a href="/loginPage" class="btn btn-info" role="button">登入</a>
            @endauth
        </div>
    </div>


</nav>
@include('layout.modal')
