document.addEventListener("DOMContentLoaded", function () {
    const links = document.querySelectorAll('nav a[href^="index.html#"], nav a[href^="#"]');
    const sections = [];
    const stepImage = document.querySelector('.step-image');
    const steps = document.querySelectorAll('.step-card');

    let sliderInterval;

    links.forEach(link => {
        const href = link.getAttribute("href");
        const id = href.split("#")[1];
        const section = document.getElementById(id);
        if (section) sections.push({ id, element: section });

        link.addEventListener("click", function (e) {
            const currentPage = window.location.pathname.split("/").pop();
            if (currentPage === "" || currentPage === "index.html") {
                e.preventDefault();
                history.pushState(null, null, "#" + id);
                window.scrollTo({
                    top: section.offsetTop - 80,
                    behavior: "smooth"
                });
            }
        });
    });

    function activateScrollMode() {
        window.addEventListener("scroll", handleScroll);
        handleScroll();
    }

    function deactivateScrollMode() {
        window.removeEventListener("scroll", handleScroll);
    }

    function startSlider() {
        if (!stepImage || steps.length === 0) return;
        let index = 0;
        const images = Array.from(steps).map(step => step.getAttribute('data-img-src')).filter(Boolean);

        stepImage.src = images[index];

        sliderInterval = setInterval(() => {
            index = (index + 1) % images.length;
            stepImage.src = images[index];
        }, 3000);
    }

    function stopSlider() {
        clearInterval(sliderInterval);
    }

    function handleScroll() {
        let currentId = "";
        const scrollY = window.scrollY + 100;

        sections.forEach(({ id, element }) => {
            if (element.offsetTop <= scrollY && element.offsetTop + element.offsetHeight > scrollY) {
                currentId = id;
            }
        });

        links.forEach(link => {
            const href = link.getAttribute("href");
            const linkId = href.split("#")[1];
            if (linkId === currentId) {
                link.classList.add("active");
            } else {
                link.classList.remove("active");
            }
        });

        if (window.innerWidth >= 767 && stepImage && steps.length) {
            let currentStep = null;

            steps.forEach(step => {
                const rect = step.getBoundingClientRect();
                if (rect.top >= 0 && rect.top < window.innerHeight / 3) {
                    currentStep = step;
                }
            });

            if (currentStep) {
                const newSrc = currentStep.getAttribute('data-img-src');
                if (newSrc && stepImage.src !== newSrc) {
                    setTimeout(() => {
                        stepImage.src = newSrc;
                    }, 50);
                }
            }
        }
    }

    function checkMode() {
        if (window.innerWidth < 883) {
            deactivateScrollMode();
            stopSlider();
            startSlider();
        } else {
            stopSlider();
            activateScrollMode();
        }
    }

    window.addEventListener("resize", checkMode);
    checkMode();

    const burger = document.getElementById('burger');
    const menu = document.getElementById('burgerMenu');
    const headerLine = document.querySelector('.header-line');

    burger.addEventListener('click', function (e) {
        e.preventDefault();
        burger.classList.toggle('active');
        menu.classList.toggle('active');
        headerLine.classList.toggle('active');
    });
});
