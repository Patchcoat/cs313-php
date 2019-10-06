<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Week 03 Prove</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
        <script src="script.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="index.php">Gondolas For Sale</a>
                <ul class="nav navbar-nav navbar-right ml-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="cart.php">Cart
                        <span class="badge badge-secondary badge-pill" id="cart"></span></a>
                    </li>
                </ul>
            </div>
        </nav>
        </br></br></br>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <form method="post" action="confirm.php">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">Name</span>
                            </div>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">Address</span>
                            </div>
                            <input type="text" name="address" class="form-control">
                        </div>
                        <div class="row form-group">
                            <div class="input-group col">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">City</span>
                                </div>
                                <input type="text" name="city" class="form-control">
                            </div>
                            <div class="input-group col">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">State</span>
                                </div>
                                <input type="text" name="state" class="form-control">
                            </div>
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">Zip Code</span>
                            </div>
                            <input type="text" name="zip" class="form-control">
                        </div>
                        <div class="input-row">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="cart.php" role="button" class="btn btn-secondary">Back to Cart</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
