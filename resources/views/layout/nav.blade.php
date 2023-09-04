<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
{{--        <a class="navbar-brand" href="/">電商網站</a>--}}
{{--        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--            <span class="navbar-toggler-icon"></span>--}}
{{--        </button>--}}
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">商品列表</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/contact_us">聯絡我們</a>
                </li>
                <li class="nav-item">

                </li>
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link"ㄏㄟ href="#">Pricing</a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link disabled" aria-disabled="true">Disabled</a>--}}
{{--                </li>--}}
            </ul>
        </div>
    </div>
    <div>
        <input type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#notifications" value="通知">
    </div>
</nav>
@include('layout.modal')
