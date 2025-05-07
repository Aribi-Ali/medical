<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>HealthTech - Your Health Partner</title>
    @vite(['resources/css/app.css'])

</head>

<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="fixed z-50 w-full shadow-sm navbar bg-white/80">
        <div class="container px-4 py-3 mx-auto">
            <div class="flex items-center justify-between">
                <div class="text-2xl font-bold text-primary">HealthTech</div>
                <div class="hidden space-x-8 md:flex">
                    <a href="#home" class="text-gray-600 transition hover:text-primary">Home</a>
                    <a href="#services" class="text-gray-600 transition hover:text-primary">Services</a>
                    <a href="#about" class="text-gray-600 transition hover:text-primary">About</a>
                    <a href="#contact" class="text-gray-600 transition hover:text-primary">Contact</a>
                </div>
                <button class="px-6 py-2 text-white transition rounded-full bg-primary hover:bg-primary/90">
                    Get Started
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="pt-24 pb-12 md:pt-32 md:pb-20">
        <div class="container px-4 mx-auto">
            <div class="flex flex-col items-center gap-12 md:flex-row">
                <div class="flex-1 animate-fade-in">
                    <h1 class="mb-6 text-4xl font-bold text-gray-900 md:text-6xl">
                        Your Health Journey Starts Here
                    </h1>
                    <p class="mb-8 text-lg text-gray-600">
                        Empowering you with innovative healthcare solutions. Monitor, manage, and improve your health
                        with our cutting-edge technology.
                    </p>
                    <button
                        class="px-8 py-3 text-lg text-white transition rounded-full shadow-lg bg-primary hover:bg-primary/90">
                        Learn More
                    </button>
                </div>
                <div class="flex-1">
                    <div id="slider" class="relative overflow-hidden shadow-2xl rounded-2xl">
                        <!-- Slides will be inserted here by JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-20 bg-gray-100">
        <div class="container px-4 mx-auto">
            <h2 class="mb-12 text-3xl font-bold text-center md:text-4xl">Our Services</h2>
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                <div class="p-6 bg-white shadow-lg service-card rounded-xl">
                    <div class="flex items-center justify-center w-12 h-12 mb-4 rounded-lg bg-primary/10">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-semibold">Health Monitoring</h3>
                    <p class="text-gray-600">Real-time health tracking and personalized insights for your well-being.
                    </p>
                </div>

                <div class="p-6 bg-white shadow-lg service-card rounded-xl">
                    <div class="flex items-center justify-center w-12 h-12 mb-4 rounded-lg bg-secondary/10">
                        <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-semibold">Virtual Consultations</h3>
                    <p class="text-gray-600">Connect with healthcare professionals from the comfort of your home.</p>
                </div>

                <div class="p-6 bg-white shadow-lg service-card rounded-xl">
                    <div class="flex items-center justify-center w-12 h-12 mb-4 rounded-lg bg-primary/10">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-semibold">Health Analytics</h3>
                    <p class="text-gray-600">Advanced analytics and insights to help you make informed health decisions.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 text-white bg-gray-900">
        <div class="container px-4 mx-auto">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-4">
                <div>
                    <h3 class="mb-4 text-xl font-bold">HealthTech</h3>
                    <p class="text-gray-400">Empowering better health through technology.</p>
                </div>
                <div>
                    <h4 class="mb-4 text-lg font-semibold">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 transition hover:text-white">About Us</a></li>
                        <li><a href="#" class="text-gray-400 transition hover:text-white">Services</a></li>
                        <li><a href="#" class="text-gray-400 transition hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="mb-4 text-lg font-semibold">Services</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 transition hover:text-white">Health Monitoring</a>
                        </li>
                        <li><a href="#" class="text-gray-400 transition hover:text-white">Virtual
                                Consultations</a></li>
                        <li><a href="#" class="text-gray-400 transition hover:text-white">Health Analytics</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="mb-4 text-lg font-semibold">Contact Us</h4>
                    <p class="text-gray-400">Email: contact@healthtech.com</p>
                    <p class="text-gray-400">Phone: (555) 123-4567</p>
                </div>
            </div>
            <div class="pt-8 mt-8 text-center text-gray-400 border-t border-gray-800">
                <p>&copy; 2024 HealthTech. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @vite(['resources/js/main.js'])
</body>

</html>
