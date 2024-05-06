

/* START OF BIG SLIDER */
document.addEventListener("DOMContentLoaded", function () {
    let slider = document.querySelector('.big-slider .list');
    let items = document.querySelectorAll('.big-slider .list .item');
    let next = document.getElementById('next');
    let prev = document.getElementById('prev');
    let dots = document.querySelectorAll('.big-slider .dots li');

    let lengthItems = items.length - 1;
    let active = 0;
    let refreshInterval = setInterval(nextSlide, 5000);

    function nextSlide() {
        active = active < lengthItems ? active + 1 : 0;
        reloadSlider();
    }

    function prevSlide() {
        active = active > 0 ? active - 1 : lengthItems;
        reloadSlider();
    }

    next.addEventListener('click', nextSlide);
    prev.addEventListener('click', prevSlide);

    function reloadSlider() {
        slider.style.left = -items[active].offsetLeft + 'px';

        let last_active_dot = document.querySelector('.big-slider .dots li.active');
        last_active_dot.classList.remove('active');
        dots[active].classList.add('active');

        clearInterval(refreshInterval);
        refreshInterval = setInterval(nextSlide, 5000);
    }

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            active = index;
            reloadSlider();
        });
    });

    window.addEventListener('resize', reloadSlider);
});
/* END OF BIG SLIDER */

/* START OF SMALL SLIDER */
document.addEventListener('DOMContentLoaded', function() {
    const productContainers = document.querySelectorAll('.product-container');
    const nxtBtn = document.querySelectorAll('.nxt-btn');
    const preBtn = document.querySelectorAll('.pre-btn');

    productContainers.forEach((container, index) => {
        let slidesPerView = 5; // Default slides per view
        let containerWidth = container.offsetWidth;

        function updateSlidesPerView() {
            if (window.innerWidth <= 1023 && window.innerWidth > 767) {
                slidesPerView = 4;
            } else if (window.innerWidth <= 767 && window.innerWidth > 639) {
                slidesPerView = 2;
            } else {
                slidesPerView = 5;
            }
        }

        function updateContainerWidth() {
            containerWidth = container.offsetWidth;
        }

        updateSlidesPerView();

        window.addEventListener('resize', () => {
            updateSlidesPerView();
            updateContainerWidth();
        });

        nxtBtn[index].addEventListener('click', () => {
            container.scrollLeft += containerWidth / slidesPerView;
        });

        preBtn[index].addEventListener('click', () => {
            container.scrollLeft -= containerWidth / slidesPerView;
        });
    });
});

/* END OF SMALL SLIDER */

/* START OF CART */

/* Open-Close Sidebar */
document.addEventListener('DOMContentLoaded', function() {
    const openBtn = document.getElementById('open_cart_btn');
    const cart = document.getElementById('sidecart');
    const overlay = document.getElementById('overlay');
    const closeBtn = document.getElementById('close_btn');

    openBtn.addEventListener('click', openCart);
    closeBtn.addEventListener('click', closeCart);
    overlay.addEventListener('click', closeCart);

    function openCart() {
        cart.classList.add('open');
        overlay.classList.add('open');
    }

    function closeCart() {
        cart.classList.remove('open');
        overlay.classList.remove('open');
    }
});

/* END OF CART */