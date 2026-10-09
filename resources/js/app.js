import Alpine from "alpinejs";
import AOS from "aos";
import "aos/dist/aos.css";
import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

// ============================================================
// SECTION: ABOUT US SLIDER
// ============================================================

function aboutUsSlider() {
    return {
        activeSlide: 0,
        activeGallery: 0,
        slides: [
            {
                title: "Tentang Kami",
            },
            {
                title: "Visi & Misi",
            },
        ],
        gallery: [
            {
                src: "https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=1400&q=85",
                alt: "Dokumentasi tim Arjuna Travora Nusantara",
            },
            {
                src: "https://images.unsplash.com/photo-1556761175-b413da4baf72?auto=format&fit=crop&w=1000&q=85",
                alt: "Kolaborasi dan kegiatan tim",
            },
            {
                src: "https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=1000&q=85",
                alt: "Lingkungan kerja perusahaan",
            },
            {
                src: "https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&w=1000&q=85",
                alt: "Kegiatan bersama tim",
            },
        ],
        init() {
            this.activeSlide = 0;
            this.activeGallery = 0;
        },
        next() {
            if (this.activeSlide < this.slides.length - 1) {
                this.activeSlide++;
                this.activeGallery =
                    (this.activeGallery + 1) % this.gallery.length;
            }
        },
        previous() {
            if (this.activeSlide > 0) {
                this.activeSlide--;
                this.activeGallery =
                    (this.activeGallery - 1 + this.gallery.length) %
                    this.gallery.length;
            }
        },
        selectGallery(index) {
            this.activeGallery = index;
        },
    };
}

// ============================================================
// GLOBAL VARIABLES
// ============================================================

window.Alpine = Alpine;
window.AOS = AOS;
window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;
window.aboutUsSlider = aboutUsSlider;

// ============================================================
// INITIALIZE ALPINE
// ============================================================

Alpine.start();

// ============================================================
// INITIALIZE AOS
// ============================================================

document.addEventListener("DOMContentLoaded", () => {
    AOS.init({
        duration: 800,
        easing: "ease-out-cubic",
        once: true,
        offset: 80,
        delay: 0,
    });
});

// ============================================================
// SECTION: KEUNGGULAN KAMI
// ============================================================

document.addEventListener("DOMContentLoaded", () => {
    const story = document.querySelector("#advantages-story");

    if (!story) {
        return;
    }

    const items = gsap.utils.toArray(".advantage-item");
    const images = gsap.utils.toArray(".advantage-image");

    if (!items.length || !images.length) {
        return;
    }

    let activeIndex = -1;

    // ========================================================
    // ACTIVATE ITEM
    // ========================================================

    function activateItem(index) {
        if (index === activeIndex) {
            return;
        }

        activeIndex = index;

        items.forEach((item, i) => {
            const title = item.querySelector(".advantage-title");
            const description = item.querySelector(".advantage-description");
            const line = item.querySelector(".advantage-line");
            const isActive = i === index;

            // ==================================================
            // ITEM
            // ==================================================

            gsap.set(item, {
                opacity: isActive ? 1 : 0.35,
            });

            // ==================================================
            // TITLE
            // ==================================================

            if (title) {
                gsap.set(title, {
                    color: isActive ? "#113883" : "#C9D2E3",
                    opacity: isActive ? 1 : 0.9,
                });
            }

            // ==================================================
            // DESCRIPTION
            // ==================================================

            if (description) {
                gsap.to(description, {
                    height: isActive ? "auto" : 0,
                    opacity: isActive ? 1 : 0,
                    duration: 0.2,
                    ease: "power1.out",
                    overwrite: true,
                });
            }

            // ==================================================
            // ACTIVE LINE
            // ==================================================

            if (line) {
                gsap.to(line, {
                    height: isActive ? "100%" : 0,
                    duration: 0.2,
                    ease: "power1.out",
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

        gsap.set(item, {
            opacity: i === 0 ? 1 : 0.35,
        });

        if (title) {
            gsap.set(title, {
                color: i === 0 ? "#113883" : "#C9D2E3",
                opacity: 1,
            });
        }

        if (description) {
            gsap.set(description, {
                height: i === 0 ? "auto" : 0,
                opacity: i === 0 ? 1 : 0,
            });
        }

        if (line) {
            gsap.set(line, {
                height: i === 0 ? "100%" : 0,
            });
        }
    });

    activeIndex = 0;

    const entranceObserver = new IntersectionObserver(
        (entries, observer) => {
            if (!entries[0].isIntersecting) {
                return;
            }

            items.forEach((item, i) => {
                gsap.fromTo(
                    item,
                    {
                        y: 35,
                    },
                    {
                        y: 0,
                        duration: 0.7,
                        delay: i * 0.15,
                        ease: "power2.out",
                        overwrite: true,
                    },
                );
            });

            observer.disconnect();
        },
        {
            threshold: 0.15,
        },
    );

    entranceObserver.observe(story);

    // ========================================================
    // SCROLL STORY
    // ========================================================

    ScrollTrigger.create({
        trigger: story,
        start: "top top",
        end: "bottom bottom",
        invalidateOnRefresh: true,
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
    // REFRESH SCROLLTRIGGER
    // ========================================================

    window.addEventListener("load", () => {
        ScrollTrigger.refresh();
    });
});

// ============================================================
// SECTION: LAYANAN KAMI
// ============================================================

document.addEventListener("DOMContentLoaded", () => {
    const story = document.querySelector("#services-story");
    const pin = document.querySelector("#services-pin");
    const viewport = document.querySelector("#services-viewport");
    const track = document.querySelector("#services-track");
    if (!story || !pin || !viewport || !track) {
        return;
    }
    const getScrollDistance = () => {
        return Math.max(0, track.scrollWidth - viewport.clientWidth);
    };
    gsap.to(track, {
        x: () => -getScrollDistance(),
        ease: "none",
        scrollTrigger: {
            trigger: story,
            start: () => {
                if (window.innerWidth < 640) {
                    return "top 120px";
                }
                if (window.innerWidth < 1024) {
                    return "top 140px";
                }
                return "top 180px";
            },
            end: () => `+=${getScrollDistance()}`,
            pin: pin,
            pinSpacing: true,
            scrub: 1,
            invalidateOnRefresh: true,
            anticipatePin: 1,
        },
    });
    window.addEventListener("resize", () => {
        ScrollTrigger.refresh();
    });
    window.addEventListener("load", () => {
        ScrollTrigger.refresh();
    });
});
