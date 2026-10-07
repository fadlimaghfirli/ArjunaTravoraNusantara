//
import Alpine from "alpinejs";
import AOS from "aos";
import "aos/dist/aos.css";

import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

window.Alpine = Alpine;
window.AOS = AOS;

Alpine.start();

document.addEventListener("DOMContentLoaded", () => {
    AOS.init({
        duration: 800,
        easing: "ease-out-cubic",
        once: true,
        offset: 80,
        delay: 0,
    });
});

// ANIMASI SCROLL TRIGGER UNTUK SECTION ADVANTAGES STORY

gsap.registerPlugin(ScrollTrigger);

window.Alpine = Alpine;
window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;

Alpine.start();

// ============================================================
// SECTION: KEUNGGULAN KAMI
// ============================================================

document.addEventListener("DOMContentLoaded", () => {
    const story = document.querySelector("#advantages-story");

    if (!story) return;

    const items = gsap.utils.toArray(".advantage-item");
    const images = gsap.utils.toArray(".advantage-image");

    if (!items.length || !images.length) return;

    let activeIndex = -1;

    // ========================================================
    // ACTIVATE ITEM
    // ========================================================

    function activateItem(index) {
        if (index === activeIndex) return;

        activeIndex = index;

        items.forEach((item, i) => {
            const title = item.querySelector(".advantage-title");

            const description = item.querySelector(".advantage-description");

            const line = item.querySelector(".advantage-line");

            const isActive = i === index;

            // ==================================================
            // ITEM
            // ==================================================

            gsap.to(item, {
                opacity: isActive ? 1 : 0.35,
                duration: 0.35,
                ease: "power2.out",
                overwrite: true,
            });

            // ==================================================
            // TITLE
            // ==================================================

            if (title) {
                gsap.to(title, {
                    color: isActive ? "#113883" : "#C9D2E3",

                    opacity: isActive ? 1 : 0.9,

                    duration: 0.35,

                    ease: "power2.out",

                    overwrite: true,
                });
            }

            // ==================================================
            // DESCRIPTION
            // ==================================================

            if (description) {
                if (isActive) {
                    gsap.to(description, {
                        height: "auto",

                        opacity: 1,

                        duration: 0.4,

                        ease: "power2.out",

                        overwrite: true,
                    });
                } else {
                    gsap.to(description, {
                        height: 0,

                        opacity: 0,

                        duration: 0.3,

                        ease: "power2.out",

                        overwrite: true,
                    });
                }
            }

            // ==================================================
            // ACTIVE LINE
            // ==================================================

            if (line) {
                gsap.to(line, {
                    height: isActive ? "100%" : 0,

                    duration: 0.4,

                    ease: "power2.out",

                    overwrite: true,
                });
            }
        });

        // ====================================================
        // IMAGE CROSSFADE
        // ====================================================

        images.forEach((image, i) => {
            gsap.to(image, {
                opacity: i === index ? 1 : 0,

                scale: i === index ? 1 : 1.04,

                duration: 0.65,

                ease: "power2.out",

                overwrite: true,
            });
        });
    }

    // ========================================================
    // INITIAL STATE
    // ========================================================

    items.forEach((item, i) => {
        const title = item.querySelector(".advantage-title");

        const description = item.querySelector(".advantage-description");

        const line = item.querySelector(".advantage-line");

        // Item
        gsap.set(item, {
            opacity: i === 0 ? 1 : 0.35,
        });

        // Title
        if (title) {
            gsap.set(title, {
                color: i === 0 ? "#113883" : "#C9D2E3",

                opacity: 1,
            });
        }

        // Description
        if (description) {
            gsap.set(description, {
                height: i === 0 ? "auto" : 0,

                opacity: i === 0 ? 1 : 0,
            });
        }

        // Line
        if (line) {
            gsap.set(line, {
                height: i === 0 ? "100%" : 0,
            });
        }
    });

    // ========================================================
    // INITIAL ACTIVE STATE
    // ========================================================

    activeIndex = 0;

    // ========================================================
    // SCROLL STORY
    // ========================================================

    ScrollTrigger.create({
        trigger: story,

        start: "top top",

        end: "bottom bottom",

        onUpdate: (self) => {
            const progress = self.progress;

            const index = Math.min(
                items.length - 1,

                Math.floor(progress * items.length),
            );

            activateItem(index);
        },
    });

    // ========================================================
    // REFRESH
    // ========================================================

    window.addEventListener("load", () => {
        ScrollTrigger.refresh();
    });
});
