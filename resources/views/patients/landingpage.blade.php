@extends('layouts.patient-layout')
@section('content')
    @include('components.patient.navbar')
    <!-- Health Slider Section -->
    <section class="w-full py-12 mt-16 bg-gradient-to-r from-teal-50 to-blue-50">
        <div class="container px-4 mx-auto">
            <h2 class="mb-8 text-3xl font-bold text-center text-gray-800">{{ __('landingpage.header1') }}</h2>

            <!-- Health Slider -->
            <div class="relative w-full max-w-5xl mx-auto">
                <div class="overflow-hidden shadow-xl rounded-xl">
                    <div id="slider-container" class="flex transition-transform duration-500 ease-in-out">
                        <!-- Slide 1 -->
                        <div class="min-w-full">
                            <div class="relative h-[300px] md:h-[400px] w-full">
                                <img src="{{ asset('health1.avif') }} " alt="{{ __('landingpage.image1') }}"
                                    class="object-cover w-full h-full" />
                                <div
                                    class="absolute inset-0 flex flex-col justify-end p-6 text-white bg-gradient-to-t from-black/70 to-transparent">
                                    <h3 class="mb-2 text-2xl font-bold">{{ __('landingpage.image1') }}</h3>
                                    <p class="text-lg">{{ __('landingpage.image1-text') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 2 -->
                        <div class="min-w-full">
                            <div class="relative h-[300px] md:h-[400px] w-full">
                                <img src="{{ asset('health2.jpg') }}" alt="{{ __('landingpage.image2') }}"
                                    class="object-cover w-full h-full" />
                                <div
                                    class="absolute inset-0 flex flex-col justify-end p-6 text-white bg-gradient-to-t from-black/70 to-transparent">
                                    <h3 class="mb-2 text-2xl font-bold">{{ __('landingpage.image2') }}</h3>
                                    <p class="text-lg">{{ __('landingpage.image2-text') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 3 -->
                        <div class="min-w-full">
                            <div class="relative h-[300px] md:h-[400px] w-full">
                                <img src="{{ asset('health3.jpg') }}" alt="{{ __('landingpage.image3') }}"
                                    class="object-cover w-full h-full" />
                                <div
                                    class="absolute inset-0 flex flex-col justify-end p-6 text-white bg-gradient-to-t from-black/70 to-transparent">
                                    <h3 class="mb-2 text-2xl font-bold">{{ __('landingpage.image3') }}</h3>
                                    <p class="text-lg">{{ __('landingpage.image3-text') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 4 -->
                        <div class="min-w-full">
                            <div class="relative h-[300px] md:h-[400px] w-full">
                                <img src="{{ asset('health4.jpg') }}" alt="{{ __('landingpage.image4') }}"
                                    class="object-cover w-full h-full" />
                                <div
                                    class="absolute inset-0 flex flex-col justify-end p-6 text-white bg-gradient-to-t from-black/70 to-transparent">
                                    <h3 class="mb-2 text-2xl font-bold">{{ __('landingpage.image4') }}</h3>
                                    <p class="text-lg">{{ __('landingpage.image4-text') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Arrows -->
                <button id="prev-slide"
                    class="absolute p-2 text-gray-800 transition-all duration-300 -translate-y-1/2 rounded-full shadow-md top-1/2 left-4 bg-white/80 hover:bg-white"
                    aria-label="Previous slide">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m15 18-6-6 6-6" />
                    </svg>
                </button>
                <button id="next-slide"
                    class="absolute p-2 text-gray-800 transition-all duration-300 -translate-y-1/2 rounded-full shadow-md top-1/2 right-4 bg-white/80 hover:bg-white"
                    aria-label="Next slide">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m9 18 6-6-6-6" />
                    </svg>
                </button>

                <!-- Dots Indicator -->
                <div id="slider-dots" class="flex justify-center mt-4 space-x-2">
                    <button data-index="0" class="w-6 h-3 transition-all duration-300 bg-teal-500 rounded-full"
                        aria-label="Go to slide 1"></button>
                    <button data-index="1" class="w-3 h-3 transition-all duration-300 bg-gray-300 rounded-full"
                        aria-label="Go to slide 2"></button>
                    <button data-index="2" class="w-3 h-3 transition-all duration-300 bg-gray-300 rounded-full"
                        aria-label="Go to slide 3"></button>
                    <button data-index="3" class="w-3 h-3 transition-all duration-300 bg-gray-300 rounded-full"
                        aria-label="Go to slide 4"></button>
                </div>
            </div>
        </div>
    </section>

    <!-- Hero Section -->
    <section class="py-20 bg-white">
        <div class="container px-4 mx-auto">
            <div class="flex flex-col items-center md:flex-row">
                <div class="mb-10 md:w-1/2 md:mb-0 md:pr-10">
                    <h1 class="mb-6 text-4xl font-bold text-gray-900 md:text-5xl">Your Health Journey Starts Here</h1>
                    <p class="mb-8 text-xl text-gray-600">We're dedicated to providing personalized healthcare
                        solutions that empower you to live your healthiest life.</p>
                    <button
                        class="px-8 py-3 font-semibold text-white transition duration-300 transform bg-teal-500 rounded-lg hover:bg-teal-600 hover:scale-105">
                        {{ __('landingpage.get_started') }}
                    </button>
                </div>
                <div class="md:w-1/2">
                    <div class="relative h-[400px] w-full rounded-2xl overflow-hidden shadow-2xl">
                        <img src="{{ asset('health1.avif') }}" alt="Healthcare professionals"
                            class="object-cover w-full h-full" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- {{ __('landingpage.services') }} Section -->
    <section class="py-20 bg-gray-50">
        <div class="container px-4 mx-auto">
            <h2 class="mb-4 text-3xl font-bold text-center text-gray-800">Our {{ __('landingpage.services') }}</h2>
            <p class="max-w-3xl mx-auto mb-12 text-xl text-center text-gray-600">
                Comprehensive healthcare solutions tailored to your unique needs
            </p>

            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Service Card 1 -->
                <div
                    class="p-6 transition-all duration-700 bg-white shadow-lg service-card rounded-xl hover:shadow-xl hover:-translate-y-1">
                    <div class="p-3 mb-4 rounded-full bg-teal-50 w-fit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="text-teal-500">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold text-gray-800">{{ __('landingpage.preventive_care') }}</h3>
                    <p class="text-gray-600">Stay ahead of health issues with our comprehensive preventive care
                        programs.</p>
                    <button class="flex items-center mt-4 font-medium text-teal-500 transition-colors hover:text-teal-600">
                        Learn more
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </button>
                </div>

                <!-- Service Card 2 -->
                <div
                    class="p-6 transition-all duration-700 bg-white shadow-lg service-card rounded-xl hover:shadow-xl hover:-translate-y-1">
                    <div class="p-3 mb-4 rounded-full bg-teal-50 w-fit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="text-teal-500">
                            <path d="m22 8-6 4 6 4V8Z"></path>
                            <rect width="14" height="12" x="2" y="6" rx="2" ry="2"></rect>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold text-gray-800">{{ __('landingpage.telemedicine') }}</h3>
                    <p class="text-gray-600">Connect with healthcare professionals from the comfort of your home.</p>
                    <button class="flex items-center mt-4 font-medium text-teal-500 transition-colors hover:text-teal-600">
                        Learn more
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </button>
                </div>

                <!-- Service Card 3 -->
                <div
                    class="p-6 transition-all duration-700 bg-white shadow-lg service-card rounded-xl hover:shadow-xl hover:-translate-y-1">
                    <div class="p-3 mb-4 rounded-full bg-teal-50 w-fit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="text-teal-500">
                            <rect width="8" height="4" x="8" y="2" rx="1" ry="1"></rect>
                            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                            <path d="m9 14 2 2 4-4"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold text-gray-800">{{ __('landingpage.personalized_plans') }}</h3>
                    <p class="text-gray-600">Health plans customized to your specific needs and goals.</p>
                    <button class="flex items-center mt-4 font-medium text-teal-500 transition-colors hover:text-teal-600">
                        Learn more
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </button>
                </div>

                <!-- Service Card 4 -->
                <div
                    class="p-6 transition-all duration-700 bg-white shadow-lg service-card rounded-xl hover:shadow-xl hover:-translate-y-1">
                    <div class="p-3 mb-4 rounded-full bg-teal-50 w-fit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="text-teal-500">
                            <path
                                d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold text-gray-800">{{ __('landingpage.image2') }}</h3>
                    <p class="text-gray-600">Support for your mental health with expert guidance and resources.</p>
                    <button class="flex items-center mt-4 font-medium text-teal-500 transition-colors hover:text-teal-600">
                        Learn more
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </button>
                </div>

                <!-- Service Card 5 -->
                <div
                    class="p-6 transition-all duration-700 bg-white shadow-lg service-card rounded-xl hover:shadow-xl hover:-translate-y-1">
                    <div class="p-3 mb-4 rounded-full bg-teal-50 w-fit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="text-teal-500">
                            <path
                                d="M12 20.94c1.5 0 2.75 1.06 4 1.06 3 0 6-8 6-12.22A4.91 4.91 0 0 0 17 5c-2.22 0-4 1.44-5 2-1-.56-2.78-2-5-2a4.9 4.9 0 0 0-5 4.78C2 14 5 22 8 22c1.25 0 2.5-1.06 4-1.06Z">
                            </path>
                            <path d="M12 7c1-.56 2.78-2 5-2a4.9 4.9 0 0 1 5 4.78c0 .7-.2 1.4-.4 2.22"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold text-gray-800">{{ __('landingpage.nutrition_guidance') }}</h3>
                    <p class="text-gray-600">Expert advice on nutrition to fuel your body and mind.</p>
                    <button class="flex items-center mt-4 font-medium text-teal-500 transition-colors hover:text-teal-600">
                        Learn more
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </button>
                </div>

                <!-- Service Card 6 -->
                <div
                    class="p-6 transition-all duration-700 bg-white shadow-lg service-card rounded-xl hover:shadow-xl hover:-translate-y-1">
                    <div class="p-3 mb-4 rounded-full bg-teal-50 w-fit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="text-teal-500">
                            <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold text-gray-800">{{ __('landingpage.image4') }}</h3>
                    <p class="text-gray-600">Tailored fitness regimens to help you achieve your health goals.</p>
                    <button class="flex items-center mt-4 font-medium text-teal-500 transition-colors hover:text-teal-600">
                        Learn more
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-white">
        <div class="container px-4 mx-auto">
            <h2 class="mb-12 text-3xl font-bold text-center text-gray-800">{{ __('landingpage.client_testimonials') }}
            </h2>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                <!-- Testimonial 1 -->
                <div class="p-6 bg-white shadow-lg rounded-xl">
                    <div class="flex items-center mb-4">
                        <div class="flex items-center justify-center w-12 h-12 mr-4 bg-teal-100 rounded-full">
                            <span class="text-xl font-bold text-teal-600">A</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold">fatima ar</h3>
                            <p class="text-gray-500">Patient</p>
                        </div>
                    </div>
                    <p class="text-gray-600">
                        "The personalized care I received has transformed my health journey. I feel empowered and
                        supported every step of the way."
                    </p>
                </div>

                <!-- Testimonial 2 -->
                <div class="p-6 bg-white shadow-lg rounded-xl">
                    <div class="flex items-center mb-4">
                        <div class="flex items-center justify-center w-12 h-12 mr-4 bg-teal-100 rounded-full">
                            <span class="text-xl font-bold text-teal-600">B</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold">ali ar</h3>
                            <p class="text-gray-500">Patient</p>
                        </div>
                    </div>
                    <p class="text-gray-600">
                        "The personalized care I received has transformed my health journey. I feel empowered and
                        supported every step of the way."
                    </p>
                </div>

                <!-- Testimonial 3 -->
                <div class="p-6 bg-white shadow-lg rounded-xl">
                    <div class="flex items-center mb-4">
                        <div class="flex items-center justify-center w-12 h-12 mr-4 bg-teal-100 rounded-full">
                            <span class="text-xl font-bold text-teal-600">C</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold">Dr Naima</h3>
                            <p class="text-gray-500">Patient</p>
                        </div>
                    </div>
                    <p class="text-gray-600">
                        "The personalized care I received has transformed my health journey. I feel empowered and
                        supported every step of the way."
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="pt-16 pb-8 text-white bg-gray-900">
        <div class="container px-4 mx-auto">
            <div class="grid grid-cols-1 gap-8 mb-12 md:grid-cols-2 lg:grid-cols-4">
                <!-- Company Info -->
                <div>
                    <h3 class="mb-4 text-xl font-bold">HealthHub</h3>
                    <p class="mb-4 text-gray-400">
                        Empowering you to take control of your health journey with personalized care and cutting-edge
                        solutions.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 transition-colors hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 transition-colors hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path
                                    d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z">
                                </path>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 transition-colors hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <rect width="20" height="20" x="2" y="2" rx="5" ry="5">
                                </rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 transition-colors hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z">
                                </path>
                                <rect width="4" height="12" x="2" y="9"></rect>
                                <circle cx="4" cy="4" r="2"></circle>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="mb-4 text-xl font-bold">Quick Links</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="#"
                                class="text-gray-400 transition-colors hover:text-white">{{ __('landingpage.home') }}</a>
                        </li>
                        <li>
                            <a href="#"
                                class="text-gray-400 transition-colors hover:text-white">{{ __('landingpage.about') }}
                                Us</a>
                        </li>
                        <li>
                            <a href="#"
                                class="text-gray-400 transition-colors hover:text-white">{{ __('landingpage.services') }}</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 transition-colors hover:text-white">Testimonials</a>
                        </li>

                        <li>
                            <a href="#"
                                class="text-gray-400 transition-colors hover:text-white">{{ __('landingpage.contact') }}</a>
                        </li>
                    </ul>
                </div>

                <!-- {{ __('landingpage.services') }} -->
                <div>
                    <h3 class="mb-4 text-xl font-bold">Our {{ __('landingpage.services') }}</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="#" class="text-gray-400 transition-colors hover:text-white">Preventive
                                Care</a>
                        </li>
                        <li>
                            <a href="#"
                                class="text-gray-400 transition-colors hover:text-white">{{ __('landingpage.telemedicine') }}</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 transition-colors hover:text-white">Personalized
                                Plans</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 transition-colors hover:text-white">Mental
                                Wellness</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 transition-colors hover:text-white">Nutrition
                                Guidance</a>
                        </li>
                    </ul>
                </div>

                <!-- {{ __('landingpage.contact') }} Info -->
                <div>
                    <h3 class="mb-4 text-xl font-bold">{{ __('landingpage.contact') }} Us</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="mr-2 h-5 w-5 text-teal-400 flex-shrink-0 mt-0.5">
                                <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            <span class="text-gray-400">123 Health Street, Wellness City, HC 12345</span>
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="flex-shrink-0 w-5 h-5 mr-2 text-teal-400">
                                <path
                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                </path>
                            </svg>
                            <span class="text-gray-400">(123) 456-7890</span>
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="flex-shrink-0 w-5 h-5 mr-2 text-teal-400">
                                <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                            </svg>
                            <span class="text-gray-400">info@healthhub.com</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Newsletter -->
            <div class="pt-8 pb-4 border-t border-gray-800">
                <div class="max-w-xl mx-auto text-center">
                    <h3 class="mb-4 text-xl font-bold">{{ __('landingpage.subscribe_newsletter') }}</h3>
                    <p class="mb-4 text-gray-400">{{ __('landingpage.newsletter_text') }}</p>
                    <div class="flex flex-col gap-2 sm:flex-row">
                        <input type="email" placeholder="{{ __('landingpage.your_email') }}"
                            class="flex-grow px-4 py-2 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" />
                        <button
                            class="px-6 py-2 text-white transition duration-300 bg-teal-500 rounded-lg hover:bg-teal-600">
                            {{ __('landingpage.subscribe') }}
                        </button>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="pt-8 mt-8 text-center border-t border-gray-800">
                <p class="text-gray-500">
                    &copy; @php echo date('landingpage.Y'); @endphp HealthHub. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Slider Functionality
        const sliderContainer = document.getElementById('slider-container');
        const sliderDots = document.getElementById('slider-dots').querySelectorAll('button');
        const prevButton = document.getElementById('prev-slide');
        const nextButton = document.getElementById('next-slide');
        let currentSlide = 0;
        const totalSlides = 4;

        function goToSlide(index) {
            currentSlide = index;
            sliderContainer.style.transform = `translateX(-${currentSlide * 100}%)`;

            // Update dots
            sliderDots.forEach((dot, i) => {
                if (i === currentSlide) {
                    dot.classList.add('bg-teal-500', 'w-6');
                    dot.classList.remove('bg-gray-300', 'w-3');
                } else {
                    dot.classList.remove('bg-teal-500', 'w-6');
                    dot.classList.add('bg-gray-300', 'w-3');
                }
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            goToSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            goToSlide(currentSlide);
        }

        // Set up event listeners
        prevButton.addEventListener('click', prevSlide);
        nextButton.addEventListener('click', nextSlide);

        sliderDots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                goToSlide(index);
            });
        });

        // Auto-advance slides
        let slideInterval = setInterval(nextSlide, 5000);

        // Pause auto-advance when user interacts with slider
        [prevButton, nextButton, ...sliderDots].forEach(el => {
            el.addEventListener('click', () => {
                clearInterval(slideInterval);
                slideInterval = setInterval(nextSlide, 5000);
            });
        });

        // Service Cards Animation
        const serviceCards = document.querySelectorAll('.service-card');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });

        serviceCards.forEach(card => {
            observer.observe(card);
        });
    </script>
@endsection
