<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/sass/app.scss')
    <title>電商網站 - 登入頁面</title>
</head>
<style>
    .border-radius{
        border-radius: 10rem;
    }
</style>
<body class="bg-primary">

<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card my-5">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h3">歡迎回來</h1>
                        <form action="/login" method="post">
                            <div class="mb-1">
                                <label for="exampleInputEmail1" class="form-label"></label>
                                <input type="email" class="form-control border-radius" id="exampleInputEmail1" name="email"
                                       aria-describedby="emailHelp" placeholder="輸入Email">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label "></label>
                                <input type="password" class="form-control border-radius" id="exampleInputPassword1" name="password"
                                       placeholder="密碼">
                                @csrf
                            </div>
                            @if($errors->any())
                                <p class="text-danger text-center">{{$errors->first()}}</p>
                            @endif
                            <button type="submit" class="btn btn-primary btn-block w-100 border-radius">登入</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
