let carouselItems;
let activeImg;
let slideInterval;

window.onload = function() {
    carouselItems = document.querySelectorAll(".carousel-item");
    activeImg = 0;
    slideInterval = setInterval(nextSlide, 5000);
};

function showSlide(index) {
    console.log(1)
    carouselItems.forEach((item, i) => {
        item.classList.toggle("active", i === index);
    });
}

function nextSlide() {
    activeImg = (activeImg + 1) % carouselItems.length;
    showSlide(activeImg);
    resetInterval();
}

function prevSlide() {
    activeImg = (activeImg - 1 + carouselItems.length) % carouselItems.length;
    showSlide(activeImg);
    resetInterval();
}

function resetInterval() {
    clearInterval(slideInterval);
    slideInterval = setInterval(nextSlide, 5000);
}