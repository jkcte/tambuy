
// FIRST SLIDER (SHOPS)

const wrapper = document.querySelector(".wrapper");
const carousel = document.querySelector(".carousel");
const arrowBtns = document.querySelectorAll(".wrapper button");

const firstCardWidth = carousel.querySelector(".shop-card").offsetWidth;


const carouselChildrens = [...carousel.children];


let cardPerView = 4;

if (cardPerView > carouselChildrens.length) {
    cardPerView = carouselChildrens.length;
}

carouselChildrens.slice(-cardPerView).reverse().forEach(card => {
    carousel.insertAdjacentHTML("afterbegin", card.outerHTML);
});

carouselChildrens.slice(0, -cardPerView).forEach(card => {
    carousel.insertAdjacentHTML("beforeend", card.outerHTML);
});


let isDragging = false, startX, startScrollLeft, timeoutId;

arrowBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    carousel.scrollLeft += btn.id === "left" ? -firstCardWidth : firstCardWidth;
  });
});

const dragStart = (e) => {
  isDragging = true;
  carousel.classList.add("dragging");
  startX = e.pageX;
  startScrollLeft = carousel.scrollLeft;
};

const dragging = (e) => {
  if (!isDragging) return;
  carousel.scrollLeft = startScrollLeft - (e.pageX - startX);
};

const dragStop = () => {
  isDragging = false;
  carousel.classList.remove("dragging");
};


const autoPlay = () => {
    if(window.innerWidth < 800) return;
    timeoutId = setTimeout(() => {
        carousel.scrollLeft += firstCardWidth;
        if (carousel.scrollLeft >= carousel.scrollWidth - carousel.offsetWidth) {
            carousel.scrollLeft = 0;
        }
        autoPlay();
}, 3500);
}

autoPlay();



const infiniteScroll = () =>{
    if(carousel.scrollLeft === 0){
        carousel.classList.add("no-transition");
        carousel.scrollLeft = carousel.scrollWidth - (2 * carousel.offsetWidth);
        carousel.classList.remove("no-transition");
    } else if(Math.ceil(carousel.scrollLeft) === carousel.scrollWidth - carousel.offsetWidth){
        carousel.classList.add("no-transition");
        carousel.scrollLeft = carousel.offsetWidth;
        carousel.classList.remove("no-transition");
    }
    clearTimeout(timeoutId);
    if(!wrapper.matches(":hover")) autoPlay();
}

carousel.addEventListener("mousedown", dragStart);
carousel.addEventListener("mousemove", dragging);
carousel.addEventListener("mouseup", dragStop);
carousel.addEventListener("scroll", infiniteScroll);
wrapper.addEventListener("mouseenter", () => clearTimeout(timeoutId));
wrapper.addEventListener("mouseleave", autoPlay);



// SLIDER POPULAR ITEMS 
const slider = document.querySelector('.featured-products');
const prevBtn = document.querySelector('.prev-btn');
const nextBtn = document.querySelector('.next-btn');

let scrollAmount = 0;
const cardWidth = document.querySelector('.product-card').offsetWidth;

nextBtn.addEventListener('click', () => {
    scrollAmount += cardWidth;
    if (scrollAmount > slider.scrollWidth - slider.offsetWidth) {
        scrollAmount = slider.scrollWidth - slider.offsetWidth;
    }
    slider.scrollTo({
        top: 0,
        left: scrollAmount,
        behavior: 'smooth'
    });
});

prevBtn.addEventListener('click', () => {
    scrollAmount -= cardWidth;
    if (scrollAmount < 0) {
        scrollAmount = 0;
    }
    slider.scrollTo({
        top: 0,
        left: scrollAmount,
        behavior: 'smooth'
    });
});






let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName(".slide");
    if (n > slides.length) { slideIndex = 1 }
    if (n < 1) { slideIndex = slides.length }

    // Hide all slides
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }

    // Show the current slide
    slides[slideIndex - 1].style.display = "block";
}






// function showSection(sectionId) {
//     // Hide all sections
//     document.querySelectorAll('div.container').forEach(shop => {
//         shop.style.display = 'none';
//     });
//     // Show the selected section
//     document.getElementById(sectionId).style.display = 'flex';
// }

// showSection('seller1');

