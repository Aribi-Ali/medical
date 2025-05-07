// Slider functionality
const sliderImages = [
  'https://media.giphy.com/media/JTjiT1dvFdSpi/giphy.gif', // Health monitoring
  'https://media.giphy.com/media/3o7TKSjRrfIPjeiVyE/giphy.gif', // Doctor consultation
  'https://media.giphy.com/media/l46Cy1rHbQ92uuLXa/giphy.gif', // Health analytics
];

const slider = document.getElementById('slider');
let currentSlide = 0;

// Create slides
sliderImages.forEach((image, index) => {
  const slide = document.createElement('div');
  slide.className = `slide absolute top-0 left-0 w-full h-full ${index === 0 ? 'active' : ''}`;
  slide.style.transition = 'opacity 0.5s ease-in-out';

  const img = document.createElement('img');
  img.src = image;
  img.alt = `Health Service ${index + 1}`;
  img.className = 'object-cover w-full h-full rounded-2xl';

  slide.appendChild(img);
  slider.appendChild(slide);
});

// Automatic slider
function nextSlide() {
  const slides = document.querySelectorAll('.slide');
  slides[currentSlide].classList.remove('active');
  currentSlide = (currentSlide + 1) % slides.length;
  slides[currentSlide].classList.add('active');
}

setInterval(nextSlide, 3000);

// Smooth scroll for navigation
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute('href'));
    if (target) {
      target.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
      });
    }
  });
});

// Intersection Observer for fade-in animations
const observerOptions = {
  threshold: 0.1,
  rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('animate-fade-in');
      observer.unobserve(entry.target);
    }
  });
}, observerOptions);

// Observe all service cards
document.querySelectorAll('.service-card').forEach(card => {
  observer.observe(card);
});
