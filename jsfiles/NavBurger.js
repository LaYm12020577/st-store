const navAnim = () => {
    const burger = document.querySelector(".burger");
    const nav = document.querySelector(".nav-links");
    const navLinks = document.querySelectorAll(".nav-links li");


    //  Toggle

    burger.addEventListener("click", () => {
        nav.classList.toggle("nav-active");

        //Animate items
        navLinks.forEach((link, index) => {
            if(link.style.animation) {
                link.style.animation = "";
            }else{
                link.style.animation = `navLinkMove 0.5s ease forwards ${index / 7 + 0.35}s`;
        }
        });
        // animated burger

        burger.classList.toggle("toggle");


    });

    
};

navAnim();