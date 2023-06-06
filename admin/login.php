<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="" style="display:flex;justify-content: center;align-items: center;min-height: 90vh;margin:auto;">
        <div style="">
            <form style="border: blue 1px solid;width: 500px;height: 550px;padding: 20px;border-radius: 10px;box-shadow: 15px 18px 10px rgb(224, 223, 223);">
                <h1 style="text-align: center;margin-bottom: 30px;">Đăng nhập</h1>
                <div style="margin-top: 30px;">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label" style="font-size: 20px;">Username</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" style="height:45px;"> 
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label" style="font-size: 20px;">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" style="height:45px;">
                        <div class="d-flex align-items-center justify-content-between mt-2">
                            <div style="">
                                <input type="checkbox">
                                <label for="">Ghi nhớ mật khẩu</label>
                            </div>
                            <div ><a href="">Quên mật khẩu</a></div>
                        </div>
                    </div>
                </div>
         
                <div style="text-align: center;margin-top: 50px;"><button type="submit" class="btn btn-primary" style="width: 150px;height: 50px;font-size: 20px;font-weight: bold;" >Login</button></div>
            </form>
        </div>
    </div>
</body>
</html>