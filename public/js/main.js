// zoom master plugin javascript

(function ($) {
    $(document).ready(function() {
        $('.xzoom, .xzoom-gallery').xzoom({zoomWidth: 400, title: true, tint: '#333', Xoffset: 15});
        $('.xzoom2, .xzoom-gallery2').xzoom({position: '#xzoom2-id', tint: '#ffa200'});
        $('.xzoom3, .xzoom-gallery3').xzoom({position: 'lens', lensShape: 'circle', sourceClass: 'xzoom-hidden'});
        $('.xzoom4, .xzoom-gallery4').xzoom({tint: '#006699', Xoffset: 15});
        $('.xzoom5, .xzoom-gallery5').xzoom({tint: '#006699', Xoffset: 15});

        //Integration with hammer.js
        var isTouchSupported = 'ontouchstart' in window;

        if (isTouchSupported) {
            //If touch device
            $('.xzoom, .xzoom2, .xzoom3, .xzoom4, .xzoom5').each(function(){
                var xzoom = $(this).data('xzoom');
                xzoom.eventunbind();
            });

            $('.xzoom, .xzoom2, .xzoom3').each(function() {
                var xzoom = $(this).data('xzoom');
                $(this).hammer().on("tap", function(event) {
                    event.pageX = event.gesture.center.pageX;
                    event.pageY = event.gesture.center.pageY;
                    var s = 1, ls;

                    xzoom.eventmove = function(element) {
                        element.hammer().on('drag', function(event) {
                            event.pageX = event.gesture.center.pageX;
                            event.pageY = event.gesture.center.pageY;
                            xzoom.movezoom(event);
                            event.gesture.preventDefault();
                        });
                    }

                    xzoom.eventleave = function(element) {
                        element.hammer().on('tap', function(event) {
                            xzoom.closezoom();
                        });
                    }
                    xzoom.openzoom(event);
                });
            });

            $('.xzoom4').each(function() {
                var xzoom = $(this).data('xzoom');
                $(this).hammer().on("tap", function(event) {
                    event.pageX = event.gesture.center.pageX;
                    event.pageY = event.gesture.center.pageY;
                    var s = 1, ls;

                    xzoom.eventmove = function(element) {
                        element.hammer().on('drag', function(event) {
                            event.pageX = event.gesture.center.pageX;
                            event.pageY = event.gesture.center.pageY;
                            xzoom.movezoom(event);
                            event.gesture.preventDefault();
                        });
                    }

                    var counter = 0;
                    xzoom.eventclick = function(element) {
                        element.hammer().on('tap', function() {
                            counter++;
                            if (counter == 1) setTimeout(openfancy,300);
                            event.gesture.preventDefault();
                        });
                    }

                    function openfancy() {
                        if (counter == 2) {
                            xzoom.closezoom();
                            $.fancybox.open(xzoom.gallery().cgallery);
                        } else {
                            xzoom.closezoom();
                        }
                        counter = 0;
                    }
                    xzoom.openzoom(event);
                });
            });

            $('.xzoom5').each(function() {
                var xzoom = $(this).data('xzoom');
                $(this).hammer().on("tap", function(event) {
                    event.pageX = event.gesture.center.pageX;
                    event.pageY = event.gesture.center.pageY;
                    var s = 1, ls;

                    xzoom.eventmove = function(element) {
                        element.hammer().on('drag', function(event) {
                            event.pageX = event.gesture.center.pageX;
                            event.pageY = event.gesture.center.pageY;
                            xzoom.movezoom(event);
                            event.gesture.preventDefault();
                        });
                    }

                    var counter = 0;
                    xzoom.eventclick = function(element) {
                        element.hammer().on('tap', function() {
                            counter++;
                            if (counter == 1) setTimeout(openmagnific,300);
                            event.gesture.preventDefault();
                        });
                    }

                    function openmagnific() {
                        if (counter == 2) {
                            xzoom.closezoom();
                            var gallery = xzoom.gallery().cgallery;
                            var i, images = new Array();
                            for (i in gallery) {
                                images[i] = {src: gallery[i]};
                            }
                            $.magnificPopup.open({items: images, type:'image', gallery: {enabled: true}});
                        } else {
                            xzoom.closezoom();
                        }
                        counter = 0;
                    }
                    xzoom.openzoom(event);
                });
            });

        } else {
            //If not touch device

            //Integration with fancybox plugin
            $('#xzoom-fancy').bind('click', function(event) {
                var xzoom = $(this).data('xzoom');
                xzoom.closezoom();
                $.fancybox.open(xzoom.gallery().cgallery, {padding: 0, helpers: {overlay: {locked: false}}});
                event.preventDefault();
            });

            //Integration with magnific popup plugin
            $('#xzoom-magnific').bind('click', function(event) {
                var xzoom = $(this).data('xzoom');
                xzoom.closezoom();
                var gallery = xzoom.gallery().cgallery;
                var i, images = new Array();
                for (i in gallery) {
                    images[i] = {src: gallery[i]};
                }
                $.magnificPopup.open({items: images, type:'image', gallery: {enabled: true}});
                event.preventDefault();
            });
        }
    });
})(jQuery);



// navbar fixed js goes here

$(document).ready(function() {

    $(window).scroll(function () {

        console.log($(window).scrollTop());

        if ($(window).scrollTop() > 500) {
            $('.fixed').addClass('fixed-top');
        }

        if ($(window).scrollTop() < 551) {
            $('.fixed').removeClass('fixed-top');
        }
    });
});

// add to cart js
$(function () {

    var goToCartIcon = function($addTocartBtn){
        var $cartIcon = $(".my-cart-icon");
        var $image = $('<img width="30px" height="30px" src="' + $addTocartBtn.data("image") + '"/>').css({"position": "fixed", "z-index": "999"});
        $addTocartBtn.prepend($image);
        var position = $cartIcon.position();
        $image.animate({
            top: position.top,
            left: position.left
        }, 500 , "linear", function() {
            $image.remove();
        });
    }

    $('.my-cart-btn').myCart({
        currencySymbol: '$',
        classCartIcon: 'my-cart-icon',
        classCartBadge: 'my-cart-badge',
        classProductQuantity: 'my-product-quantity',
        classProductRemove: 'my-product-remove',
        classCheckoutCart: 'my-cart-checkout',
        affixCartIcon: true,
        showCheckoutModal: true,
        numberOfDecimals: 2,
        cartItems: [
            {id: 1, name: 'product 1', summary: 'summary 1', price: 10, quantity: 1, image: 'images/img_1.png'},
            {id: 2, name: 'product 2', summary: 'summary 2', price: 20, quantity: 2, image: 'images/img_2.png'},
            {id: 3, name: 'product 3', summary: 'summary 3', price: 30, quantity: 1, image: 'images/img_3.png'}
        ],
        clickOnAddToCart: function($addTocart){
            goToCartIcon($addTocart);
        },
        afterAddOnCart: function(products, totalPrice, totalQuantity) {
            console.log("afterAddOnCart", products, totalPrice, totalQuantity);
        },
        clickOnCartIcon: function($cartIcon, products, totalPrice, totalQuantity) {
            console.log("cart icon clicked", $cartIcon, products, totalPrice, totalQuantity);
        },
        checkoutCart: function(products, totalPrice, totalQuantity) {
            var checkoutString = "Total Price: " + totalPrice + "\nTotal Quantity: " + totalQuantity;
            checkoutString += "\n\n id \t name \t summary \t price \t quantity \t image path";
            $.each(products, function(){
                checkoutString += ("\n " + this.id + " \t " + this.name + " \t " + this.summary + " \t " + this.price + " \t " + this.quantity + " \t " + this.image);
            });
            alert(checkoutString)
            console.log("checking out", products, totalPrice, totalQuantity);
        },
        getDiscountPrice: function(products, totalPrice, totalQuantity) {
            console.log("calculating discount", products, totalPrice, totalQuantity);
            return totalPrice * 0.5;
        }
    });

    $("#addNewProduct").click(function(event) {
        var currentElementNo = $(".row").children().length + 1;
        $(".row").append('<div class="col-md-3 text-center"><img src="images/img_empty.png" width="150px" height="150px"><br>product ' + currentElementNo + ' - <strong>$' + currentElementNo + '</strong><br><button class="btn btn-danger my-cart-btn" data-id="' + currentElementNo + '" data-name="product ' + currentElementNo + '" data-summary="summary ' + currentElementNo + '" data-price="' + currentElementNo + '" data-quantity="1" data-image="images/img_empty.png">Add to Cart</button><a href="#" class="btn btn-info">Details</a></div>')
    });
});
// js for list view and grid view

$('.simple-list-grid').simpleListGrid();


var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-36251023-1']);
_gaq.push(['_setDomainName', 'jqueryscript.net']);
_gaq.push(['_trackPageview']);

(function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();




var searchOpen = (function () {
    return {
        //main function to initiate the module
        init: function () {
            $(".search-box").on("click", function (e) {
                e.stopPropagation();
            });

            $(document).on("click", ".typed-search-box-shown", function (e) {
                $(this).removeClass("typed-search-box-shown");
                $(".typed-search-box").addClass("d-none");
            });
        },
    };
})();

$(function () {
    $("#category-menu-icon, #category-sidebar")
        .on("mouseover", function (event) {
            $("#hover-category-menu").show();
            $("#category-menu-icon").addClass("active");
        })
        .on("mouseout", function (event) {
            $("#hover-category-menu").hide();
            $("#category-menu-icon").removeClass("active");
        });

    $(".nav-search-box a").on("click", function (e) {
        e.preventDefault();
        $(".search-box").addClass("show");
        $('.search-box input[type="text"]').focus();
    });
    $(".search-box-back button").on("click", function () {
        $(".search-box").removeClass("show");
    });
    $("#side-filter,.filter-close").on("click", function (e) {
        e.preventDefault();
        if ($(".side-filter").hasClass("open")) {
            $(".side-filter").removeClass("open");
        } else {
            $(".side-filter").addClass("open");
        }
    });

    // if ($('.slick-slider').length > 0) {
    //     $('.slick-slider').each(function() {
    //         var $this = $(this);
    //         $this.slick({
    //             slidesToShow: 1,
    //             dots: true,
    //             prevArrow: '<button type="button" class="slick-prev"><span class="prev-icon"></span></button>',
    //             nextArrow: '<button type="button" class="slick-next"><span class="next-icon"></span></button>',
    //         });
    //     });
    // }

    /*
        Smooth scroll functionality for anchor links (animates the scroll
        rather than a sudden jump in the page)
    */
    $(".all-category-menu a").bind("click", function (e) {
        e.preventDefault(); // prevent hard jump, the default behavior

        var target = $(this).attr("href"); // Set the target as variable

        $("html, body")
            .stop()
            .animate(
                {
                    scrollTop: $(target).offset().top - 120,
                },
                600,
                function () {
                    // location.hash = target; //attach the hash (#jumptarget) to the pageurl
                }
            );

        return false;
    });

    // language flag select2
    $(".pickup-select").select2({
        templateResult: pickupInfo,
        escapeMarkup: function (m) {
            return m;
        },
    });
    function pickupInfo(state) {
        var address = $(state.element).data("address");
        var phone = $(state.element).data("phone");
        if (!address && !phone) return state.text;
        return (
            '<div class="pickup-name strong-600 heading-6 mb-2">' +
            state.text +
            '</div><div class="alpha-7 d-flex line-height-1_2 mb-2 pickup-address"><i class="la la-map-marker mr-1"></i>' +
            address +
            '</div><div class="alpha-7 d-flex line-height-1_2 pickup-number"><i class="la la-phone mr-1"></i>' +
            phone +
            "</div>"
        );
    }
    $(".pos-customer").select2({
        templateResult: posCustomerSelect,
        templateSelection: posCustomerSelect,
        escapeMarkup: function (m) {
            return m;
        },
    });
    function posCustomerSelect(state) {
        var contact = $(state.element).data("contact");
        if (!contact) return state.text;
        return (
            "<span class='d-flex justify-content-between'><span  class='flex-shrink-0'>" +
            state.text +
            "</span><span class='flex-grow-1 text-truncate ml-3 text-right'>" +
            contact +
            "</span></span>"
        );
    }
    $(document).on("click", function (e) {
        $('[data-toggle="popover"]').each(function () {
            if (
                !$(this).is(e.target) &&
                $(this).has(e.target).length === 0 &&
                $(".popover").has(e.target).length === 0
            ) {
                (
                    ($(this).popover("hide").data("bs.popover") || {})
                        .inState || {}
                ).click = false;
            }
        });
    });
    $(document).on('click', '.dropdown-menu', function (e) {
        e.stopPropagation();
    });
});

// Bootstrap selected
$(".sortSelect").each(function (index, element) {
    $(".sortSelect").select2({
        theme: "default sortSelectCustom",
    });
});
function morebrands(em) {
    if ($(em).hasClass("on")) {
        $(em).removeClass("on");
        $("#brands-collapse-box").removeClass("full");
        $(em).children("i").addClass("fa-plus").removeClass("fa-minus");
        $(em).children("span").html("More");
    } else {
        $(em).addClass("on");
        $("#brands-collapse-box").addClass("full");
        $(em).children("i").removeClass("fa-plus").addClass("fa-minus");
        $(em).children("span").html("Less");
    }
}
function sideMenuOpen(e) {
    event.preventDefault();
    $(e).find(".hamburger-icon").toggleClass("open");
    if ($(e).find(".hamburger-icon").hasClass("open")) {
        $(".side-menu-wrap,.side-menu-overlay")
            .removeClass("opacity-0")
            .addClass("opacity-1");
        $(".side-menu").removeClass("closed").addClass("open");
        $("body").addClass("side-menu-open");
    } else {
        $(".side-menu-wrap,.side-menu-overlay")
            .removeClass("opacity-1")
            .addClass("opacity-0");
        $(".side-menu").removeClass("open").addClass("closed");
        $("body").removeClass("side-menu-open");
    }
}
function sideMenuClose() {
    $(".side-menu-wrap,.side-menu-overlay")
        .removeClass("opacity-1")
        .addClass("opacity-0");
    $(".side-menu").removeClass("open").addClass("closed");
    if ($(".hamburger-icon").hasClass("open")) {
        $(".hamburger-icon").removeClass("open");
        $("body").removeClass("side-menu-open");
    }
}
function slickInit() {
    if ($(".slick-carousel").length > 0) {
        $(".slick-carousel")
            .not(".slick-initialized")
            .each(function () {
                var $this = $(this);

                var slidesRtl = false;

                var slidesPerViewXs = $this.data("slick-xs-items");
                var slidesPerViewSm = $this.data("slick-sm-items");
                var slidesPerViewMd = $this.data("slick-md-items");
                var slidesPerViewLg = $this.data("slick-lg-items");
                var slidesPerViewXl = $this.data("slick-xl-items");
                var slidesPerView = $this.data("slick-items");

                var slidesCenterMode = $this.data("slick-center");
                var slidesArrows = $this.data("slick-arrows");
                var slidesDots = $this.data("slick-dots");
                var slidesRows = $this.data("slick-rows");
                var slidesAutoplay = $this.data("slick-autoplay");

                slidesPerViewXs = !slidesPerViewXs
                    ? slidesPerView
                    : slidesPerViewXs;
                slidesPerViewSm = !slidesPerViewSm
                    ? slidesPerView
                    : slidesPerViewSm;
                slidesPerViewMd = !slidesPerViewMd
                    ? slidesPerView
                    : slidesPerViewMd;
                slidesPerViewLg = !slidesPerViewLg
                    ? slidesPerView
                    : slidesPerViewLg;
                slidesPerViewXl = !slidesPerViewXl
                    ? slidesPerView
                    : slidesPerViewXl;
                slidesPerView = !slidesPerView ? 1 : slidesPerView;
                slidesCenterMode = !slidesCenterMode ? false : slidesCenterMode;
                slidesArrows = !slidesArrows ? true : slidesArrows;
                slidesDots = !slidesDots ? false : slidesDots;
                slidesRows = !slidesRows ? 1 : slidesRows;
                slidesAutoplay = !slidesAutoplay ? false : slidesAutoplay;

                if ($("html").attr("dir") === "rtl") {
                    slidesRtl = true;
                }

                $this.slick({
                    slidesToShow: slidesPerView,
                    autoplay: slidesAutoplay,
                    dots: slidesDots,
                    arrows: slidesArrows,
                    infinite: true,
                    rtl: slidesRtl,
                    rows: slidesRows,
                    centerPadding: "0px",
                    centerMode: slidesCenterMode,
                    speed: 300,
                    prevArrow:
                        '<button type="button" class="slick-prev"><i class="la la-angle-left"></i></button>',
                    nextArrow:
                        '<button type="button" class="slick-next"><i class="la la-angle-right"></i></button>',
                    responsive: [
                        {
                            breakpoint: 1500,
                            settings: {
                                slidesToShow: slidesPerViewXl,
                            },
                        },
                        {
                            breakpoint: 1200,
                            settings: {
                                slidesToShow: slidesPerViewLg,
                            },
                        },
                        {
                            breakpoint: 992,
                            settings: {
                                slidesToShow: slidesPerViewMd,
                            },
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: slidesPerViewSm,
                                dots: true,
                                arrows: false,
                            },
                        },
                        {
                            breakpoint: 576,
                            settings: {
                                slidesToShow: slidesPerViewXs,
                                dots: true,
                                arrows: false,
                            },
                        },
                    ],
                });
            });
    }
}

$(document).ready(function () {
    searchOpen.init();
    var zoomXoffset = 20;
    var zoomposition = "right";
    if ($("html").attr("dir") === "rtl") {
        zoomXoffset = -20;
        zoomposition = "left";
    }
    $(".xzoom, .xzoom-gallery").xzoom({
        Xoffset: zoomXoffset,
        bg: true,
        tint: "#000",
        defaultScale: -1,
        position: zoomposition,
    });

    $(".tagsInput").tagsinput("items");

    // $('.summernote').summernote({
    //     height: 500,
    //     popover: {
    //         image: [],
    //         link: [],
    //         air: []
    //     }
    // });

    $(".editor").each(function (el) {
        var $this = $(this);
        var buttons = $this.data("buttons");
        buttons = !buttons
            ? "bold,underline,italic,hr,|,ul,ol,|,align,paragraph,|,image,table,link,undo,redo"
            : buttons;

        var editor = new Jodit(this, {
            uploader: {
                insertImageAsBase64URI: true,
            },
            toolbarAdaptive: false,
            defaultMode: "1",
            toolbarSticky: false,
            showXPathInStatusbar: false,
            buttons: buttons,
        });
    });

    $(".nav-tabs a").click(function () {
        $(this).tab("show");
    });

    slickInit();

    // color select select2
    $(".color-var-select").select2({
        templateResult: colorCodeSelect,
        templateSelection: colorCodeSelect,
        escapeMarkup: function (m) {
            return m;
        },
    });
    function colorCodeSelect(state) {
        var colorCode = $(state.element).val();
        if (!colorCode) return state.text;
        return (
            "<span class='color-preview' style='background-color:" +
            colorCode +
            ";'></span>" +
            state.text
        );
    }
});

$(window).on("load", function () {});

$(window)
    .scroll(function () {
        var scrollDistance = $(window).scrollTop();
        $(".sub-category-menu.active").each(function (i) {
            if ($(this).position().top + 120 <= scrollDistance) {
                $(".all-category-menu li.active").removeClass("active");
                $(".all-category-menu li").eq(i).addClass("active");
            }
        });

        var b = $(window).scrollTop();

        if (b > 120) {
            $(".logo-bar-area").addClass("sm-fixed-top");
        } else {
            $(".logo-bar-area").removeClass("sm-fixed-top");
        }
    })
    .scroll();

$(document).ajaxComplete(function () {
    $(".selectpicker").each(function (index, element) {
        $(".selectpicker").select2({});
    });
});


