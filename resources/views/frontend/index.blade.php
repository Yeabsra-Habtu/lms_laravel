@extends('frontend.master')
@section('home')

@include('frontend.home.hero-area')<!-- end hero-area -->
<!--================================
        END HERO AREA
=================================-->

<!--======================================
        START FEATURE AREA
 ======================================-->
@include('frontend.home.feature-area')<!-- end feature-area -->
<!--======================================
       END FEATURE AREA
======================================-->

<!--======================================
        START CATEGORY AREA
======================================-->
@include('frontend.home.category-area')<!-- end category-area -->
<!--======================================
        END CATEGORY AREA
======================================-->

<!--======================================
        START COURSE AREA
======================================-->
@include('frontend.home.courses-area')<!-- end courses-area -->
<!--======================================
        END COURSE AREA
======================================-->

<!--======================================
        START COURSE AREA
======================================-->
@include('frontend.home.course-area-two')<!-- end courses-area -->
<!--======================================
        END COURSE AREA
======================================-->

<!-- ================================
       START FUNFACT AREA
================================= -->
@include('frontend.home.funfact')<!-- end funfact-area -->
<!-- ================================
       START FUNFACT AREA
================================= -->

<!--======================================
        START CTA AREA
======================================-->
@include('frontend.home.cta-area')<!-- end cta-area -->
<!--======================================
        END CTA AREA
======================================-->

<!--================================
         START TESTIMONIAL AREA
=================================-->
@include('frontend.home.testemonial-area')<!-- end testimonial-area -->
<!--================================
        END TESTIMONIAL AREA
=================================-->

<div class="section-block"></div>

<!--======================================
        START ABOUT AREA
======================================-->
@include('frontend.home.about-area')<!-- end about-area -->
<!--======================================
        END ABOUT AREA
======================================-->

<div class="section-block"></div>

<!--======================================
        START REGISTER AREA
======================================-->
@include('frontend.home.register-area')<!-- end register-area -->
<!--======================================
        END REGISTER AREA
======================================-->

<div class="section-block"></div>

<!-- ================================
       START CLIENT-LOGO AREA
================================= -->
@include('frontend.home.client-logo-area')<!-- end client-logo-area -->
<!-- ================================
       START CLIENT-LOGO AREA
================================= -->

<!-- ================================
       START BLOG AREA
================================= -->
@include('frontend.home.blog-area')<!-- end blog-area -->
<!-- ================================
       START BLOG AREA
================================= -->

<!--======================================
        START GET STARTED AREA
======================================-->
@include('frontend.home.get-started-area')<!-- end get-started-area -->
<!-- ================================
       START GET STARTED AREA
================================= -->

<!--======================================
        START SUBSCRIBER AREA
======================================-->
@include('frontend.home.subscribe-area')<!-- end subscriber-area -->
<!--======================================
        END SUBSCRIBER AREA
======================================-->
@endsection