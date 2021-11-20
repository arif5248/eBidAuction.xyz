@extends('frontend.master')
@section('contant')
    <!--Breadcrumb Section goes here-->
<div id="breadcrumb">
    <div class="container">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mr-2">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page">Televisions</li>
                    <li class="breadcrumb-item" aria-current="page">LED Televisions</li>
                    <li class="breadcrumb-item" aria-current="page">Vezio 40″ HD LED TV </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!--product details aria goes here-->
<section id="product" class="pb-5">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="xzoom-container">
                    <img class="xzoom img-fluid" id="xzoom-default" src="{{ asset('frontend/img/13-296x396.jpg') }}" xoriginal="{{ asset('frontend/img/13-600x834.jpg') }}" alt="pic" />
                    <div class="xzoom-thumbs mt-3">
                        <a href="img/13-600x834.jpg"><img class="xzoom-gallery" width="80" src="{{ asset('frontend/img/13-100x100.jpg') }}"  xpreview="{{ asset('frontend/img/13-296x396.jpg') }}" title="The description goes here"></a>

                        <a href="img/5-600x834.jpg"><img class="xzoom-gallery" width="80" src="{{ asset('frontend/img/5-100x100.jpg') }}" xpreview="{{ asset('frontend/img/5-296x396.jpg') }}" title="The description goes here"></a>

                        <a href="img/8-600x834.jpg"><img class="xzoom-gallery" width="80" src="{{ asset('frontend/img/8-100x100.jpg') }}" xpreview="{{ asset('frontend/img/8-296x396.jpg') }}" title="The description goes here"></a>

                        <a href="img/6-600x834.jpg"><img class="xzoom-gallery" width="80" src="{{ asset('frontend/img/6-100x100.jpg') }}" xpreview="{{ asset('frontend/img/6-296x396.jpg') }}" title="The description goes here"></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <h2 class="mb-2">Vezio 40″ HD LED TV</h2>
                <div class="review d-flex justify-content-between mb-2">
                    <p>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </p>
                    <p>no rating</p>
                </div>
                <div class="price">
                    <h2>৳ 14,790</h2>
                </div>
                <p class="mt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <div class="row">
                    <div class="col-8">
                        <div class="form-group mt-4">
                            <label for="quantity">Quantity</label>
                            <select class="form-control" id="quantity">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                            <button type="submit" class="btn-success mt-3"><a href="signIn.html" style="color:#FFFFFF">Buy Now</a></button>
                            <button type="submit" class="btn-success mt-3 cart-btn">Add to cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div>
                    <h5 class="mb-3">Delivery Options</h5>
                    <ul>
                        <li class="d-flex justify-content-between mb-2"><i class="fas fa-map-marker-alt"></i><p>Dhaka, Dhaka North</p> <a href="#">Change</a></li>
                        <li class="d-flex justify-content-between mb-2"><i class="fas fa-truck"></i><p>Home Delivery</p><p>৳ 155</p></li>
                        <li class="d-flex justify-content-between mb-2"><i class="far fa-money-bill-alt"></i><p>Cash on Delivery Available</p></li>
                    </ul>
                </div>
                <div>
                    <h5 class="d-flex justify-content-between mb-2">Return & Warranty</h5>
                    <ul>
                        <li class="d-flex justify-content-between mb-2"><i class="fas fa-undo-alt"></i><p>7 Days Returns</p></li>
                        <li class="d-flex justify-content-between mb-2"><i class="fas fa-tag"></i><p>5 Years Local seller warranty</p></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--description tab area goes here-->
        <div class="col-sm-12">
            <ul class="nav nav-tabs mt-5" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Additional Information</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <h5 class="pt-4">Paragraph text</h5>
                    <p class="pt-2">Nam tristique porta ligula, vel viverra sem eleifend nec. Nulla sed purus augue, eu euismod tellus. Nam mattis eros nec mi sagittis sagittis. Vestibulum suscipit cursus bibendum. Integer at justo eget sem auctor auctor eget vitae arcu. Nam tempor malesuada porttitor. Nulla quis dignissim ipsum. Aliquam pulvinar iaculis justo, sit amet interdum sem hendrerit vitae. Vivamus vel erat tortor. Nulla facilisi. In nulla quam, lacinia eu aliquam ac, aliquam in nisl.</p>
                    <h5 class="pt-4">Unordered list</h5>
                    <ol class="pt-2">
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                        <li>Maecenas ullamcorper est et massa mattis condimentum.</li>
                        <li>Vestibulum sed massa vel ipsum imperdiet malesuada id tempus nisl.</li>
                        <li>Etiam nec massa et lectus faucibus ornare congue in nunc.</li>
                        <li>Mauris eget diam magna, in blandit turpis.</li>
                    </ol>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <table class="table">
                        <tr>
                            <th scope="col">Weight</th>
                            <td scope="col">56 kg</td>
                        </tr>
                        <tr>
                            <th scope="col">Color</th>
                            <td scope="col">Blue, Pink</td>
                        </tr>
                        <tr>
                            <th scope="col">size</th>
                            <td scope="col"> Medium, Small</td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection