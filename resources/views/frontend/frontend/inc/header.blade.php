<header>
    <div class="top-header">
        <div class="container">
            <ul class="nav ml-5">
                <li class="nav-item active">
                    <a class="nav-link" href="#">SAVE MORE ON APP</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Sell on Daraz</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">CUSTOMER CARE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Track my order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">SIGNUP</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">ভাষা</a>
                </li>
            </ul>
        </div>
    </div>
    <nav class="fixed">
        <div class="container">
            <div class="download__company-app">
                <img src="{{ asset('frontend/img/d_app.png') }}" alt="download_app" height="40" width="170" class="img-fluid">
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('frontend/img/logo.png') }}" alt="logo" height="65" width="160"></a>
                </div>
                <div class="col-sm-7">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search in Daraz" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2"><i class="fas fa-search"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                   <div class="navigation__col">
                        <div class="seller-become-btn">
                            <a href="#" class="btn seller-registratin-btn">become a seller</a>
                        </div>
                        <div class="navigation_bar">
                            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                <ul class="navbar-nav">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="#">
                                            <button type="button" class="btn btn-primary cartI" data-toggle="modal" data-target="#cart"><i class="fas fa-2x fa-shopping-cart my-cart-icon"></i><span class="total-count"></span></button>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                   </div>
                </div>
            </div>
         
        </div>
    </nav>
</header>