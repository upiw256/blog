document.addEventListener("DOMContentLoaded", function () {
    new Swiper(".swiper-container-news", {
        slidesPerView: 4, // Show 4 slides at a time
        spaceBetween: 20, // Space between slides
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination-news",
            clickable: true,
        },
        breakpoints: {
            768: {
                slidesPerView: 2, // Show 2 slides on smaller screens
            },
            576: {
                slidesPerView: 1, // Show 1 slide on very small screens
            },
        },
    });
});
