@extends('layout.plantilla')
@section('titulo','inicio')
@section('contenido')

<section id="product-slider">
        <div class="main-slider swiper-container">
            <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="swiper-slide">
                    <img src="/imagen/logo.jpeg" alt="Product 1">
                    <div class="swiper-slide-content">
                      <h2 class="text-3xl md:text-7xl font-bold text-white mb-2 md:mb-4">Women</h2>
                      <p class="mb-4 text-white md:text-2xl">Experience the best in sportswear with <br>our latest collection.</p>
                        <a href="/"
                            class="bg-primary hover:bg-transparent text-white hover:text-white border border-transparent hover:border-white font-semibold px-4 py-2 rounded-full inline-block">Shop
                            now</a>
                    </div>
                </div>


<section id="popular-products">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold mb-8">Nuestro productos</h2>
            <div class="flex flex-wrap -mx-4">

                <livewire:inicio>
</section id="popular-products">



    <!-- Brand section -->
    <section id="brands" class="bg-white py-16 px-4">
        <div class="container mx-auto max-w-screen-xl px-4 testimonials">
          <div class="text-center mb-12 lg:mb-20">
            <h2 class="text-5xl font-bold mb-4">Descubra <span class="text-primary">Nuestras Marcas</span></h2>
            <p class="my-7">Explora las principales marcas que presentamos en nuestra tienda</p>
        </div>
            <div class="swiper brands-swiper-slider">
                <div class="swiper-wrapper">
                    <!-- Brand Logo 1 -->
                    <div class="swiper-slide flex-none bg-gray-200 flex items-center justify-center rounded-md">
                        <img src="/assets/images/brands/html.svg" alt="Client Logo" class="max-h-full max-w-full">
                    </div>

                    <!-- Brand Logo 2 -->
                    <div class="swiper-slide flex-none bg-gray-200 flex items-center justify-center rounded-md">
                        <img src="/assets/images/brands/js.svg" alt="Client Logo" class="max-h-full max-w-full">
                    </div>

                    <!-- Brand Logo 3 -->
                    <div class="swiper-slide flex-none bg-gray-200 flex items-center justify-center rounded-md">
                        <img src="/assets/images/brands/laravel.svg" alt="Client Logo" class="max-h-full max-w-full">
                    </div>

                    <!-- Brand Logo 4 -->
                    <div class="swiper-slide flex-none bg-gray-200 flex items-center justify-center rounded-md">
                        <img src="/assets/images/brands/php.svg" alt="Client Logo" class="max-h-full max-w-full">
                    </div>

                    <!-- Brand Logo 5 -->
                    <div class="swiper-slide flex-none bg-gray-200 flex items-center justify-center rounded-md">
                        <img src="/assets/images/brands/react.svg" alt="Client Logo" class="max-h-full max-w-full">
                    </div>

                    <!-- Brand Logo 6 -->
                    <div class="swiper-slide flex-none bg-gray-200 flex items-center justify-center rounded-md">
                        <img src="/assets/images/brands/tailwind.svg" alt="Client Logo" class="max-h-full max-w-full">
                    </div>

                    <!-- Brand Logo 7 -->
                    <div class="swiper-slide flex-none bg-gray-200 flex items-center justify-center rounded-md">
                      <img src="/assets/images/brands/typescript.svg" alt="Client Logo" class="max-h-full max-w-full">
                    </div>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
    </section>

    <!-- Banner section -->
    <section id="banner" class="relative my-16">
        <div class="container mx-auto px-4 py-20 rounded-lg relative bg-cover bg-center" style="background-image: url('assets/images/banner1.jpg');">
            <div class="absolute inset-0 bg-black opacity-40 rounded-lg"></div>
            <div class="relative flex flex-col items-center justify-center h-full text-center text-white py-20">
                <h2 class="text-4xl font-bold mb-4">Welcome to Our Shop</h2>
                <div class="flex space-x-4">
                    <a href="#" class="bg-primary hover:bg-transparent text-white hover:text-primary border border-transparent hover:border-primary font-semibold px-4 py-2 rounded-full inline-block">Shop Now</a>
                    <a href="#" class="bg-primary hover:bg-transparent text-white hover:text-primary border border-transparent hover:border-primary font-semibold px-4 py-2 rounded-full inline-block">New Arrivals</a>
                    <a href="#" class="bg-primary hover:bg-transparent text-white hover:text-primary border border-transparent hover:border-primary font-semibold px-4 py-2 rounded-full inline-block">Sale</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog section -->
    <section class="py-16">
      <div class="text-center mb-12 lg:mb-20">
          <h2 class="text-5xl font-bold mb-4">Discover <span class="text-primary">Our</span> Blog</h2>
          <p class="my-7">Stay updated with the latest trends, tips, and stories in the world of fashion</p>
      </div>
      <div class="relative items-center w-full px-5 py-12 mx-auto md:px-12 lg:px-24 max-w-7xl">
          <div class="grid w-full grid-cols-1 gap-6 mx-auto lg:grid-cols-3">
              <div class="flex flex-col p-6 bg-white rounded-xl shadow-lg">
                  <img class="object-cover object-center w-full mb-8 rounded-xl" src="/assets/images/fashion-trends.jpg" alt="blog">
                  <h2 class="mb-2 text-xs font-semibold tracking-widest text-primary uppercase">Fashion Trends</h2>
                  <h1 class="mb-4 text-2xl font-semibold leading-none tracking-tighter text-gray-dark lg:text-3xl">Latest Shirt Trends for 2024</h1>
                  <p class="flex-grow text-base font-medium leading-relaxed text-gray-txt">Explore the hottest shirt trends of 2024. From bold prints to classic styles, stay ahead of the fashion curve with our expert insights.</p>
                  <div class="mt-8">
                      <a href="#" class="bg-primary border border-transparent hover:bg-transparent hover:border-primary text-white hover:text-primary font-semibold py-2 px-4 rounded-full w-full">Read more</a>
                  </div>
              </div>
              <div class="flex flex-col p-6 bg-white rounded-xl shadow-lg">
                  <img class="object-cover object-center w-full mb-8 rounded-xl" src="/assets/images/stylisng-tips.jpg" alt="blog">
                  <h2 class="mb-2 text-xs font-semibold tracking-widest text-primary uppercase">Styling Tips</h2>
                  <h1 class="mb-4 text-2xl font-semibold leading-none tracking-tighter text-gray-dark lg:text-3xl">How to Style Your Shirt for Any Occasion</h1>
                  <p class="flex-grow text-base font-medium leading-relaxed text-gray-txt">Learn how to style your shirt for different occasions, whether it's a casual day out or a formal event. Get tips from fashion experts.</p>
                  <div class="mt-8">
                      <a href="#" class="bg-primary border border-transparent hover:bg-transparent hover:border-primary text-white hover:text-primary font-semibold py-2 px-4 rounded-full w-full">Read more</a>
                  </div>
              </div>
              <div class="flex flex-col p-6 bg-white rounded-xl shadow-lg">
                  <img class="object-cover object-center w-full mb-8 rounded-xl" src="/assets/images/customer-stories.jpg" alt="blog">
                  <h2 class="mb-2 text-xs font-semibold tracking-widest text-primary uppercase">Customer Stories</h2>
                  <h1 class="mb-4 text-2xl font-semibold leading-none tracking-tighter text-gray-dark lg:text-3xl">Real Stories from Our Happy Customers</h1>
                  <p class="flex-grow text-base font-medium leading-relaxed text-gray-txt">Read about the experiences of our customers. Discover how our shirts have made a difference in their lives and their personal style.</p>
                  <div class="mt-8">
                      <a href="#" class="bg-primary border border-transparent hover:bg-transparent hover:border-primary text-white hover:text-primary font-semibold py-2 px-4 rounded-full w-full">Read more</a>
                  </div>
              </div>
          </div>
      </div>
    </section>



   
@endsection