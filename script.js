// Mobile navigation, active section link, and gentle scroll reveals.
const menuToggle = document.querySelector(".menu-toggle");
const navLinks = document.querySelector(".nav-links");
const navItems = document.querySelectorAll(".nav-link");

if (menuToggle && navLinks) {
  const closeMenu = () => {
    navLinks.classList.remove("is-open");
    menuToggle.setAttribute("aria-expanded", "false");
    menuToggle.setAttribute("aria-label", "Open navigation menu");
  };

  menuToggle.addEventListener("click", () => {
    const isOpen = navLinks.classList.toggle("is-open");
    menuToggle.setAttribute("aria-expanded", String(isOpen));
    menuToggle.setAttribute("aria-label", isOpen ? "Close navigation menu" : "Open navigation menu");
  });

  navItems.forEach((link) => link.addEventListener("click", closeMenu));
  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape") closeMenu();
  });
}

// Reveal content as it enters the screen. Keep everything visible if unsupported.
const revealItems = document.querySelectorAll(".reveal");
if ("IntersectionObserver" in window) {
  const revealObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("visible");
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.12 });
  revealItems.forEach((item) => revealObserver.observe(item));
} else {
  revealItems.forEach((item) => item.classList.add("visible"));
}

// Highlight the navigation item for the section currently being viewed.
const sections = document.querySelectorAll("main section[id]");
if ("IntersectionObserver" in window) {
  const sectionObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        navItems.forEach((link) => {
          const isCurrent = link.getAttribute("href") === `#${entry.target.id}`;
          link.classList.toggle("active", isCurrent);
        });
      }
    });
  }, { rootMargin: "-35% 0px -55% 0px" });
  sections.forEach((section) => sectionObserver.observe(section));
}


// Swipeable certificate gallery and click-to-enlarge preview.
const certificateCards = document.querySelectorAll(".certificate-card");
const certificateModal = document.querySelector("#certificate-modal");
const certificateModalImage = document.querySelector("#certificate-modal-image");
const certificateModalClose = document.querySelector(".certificate-modal-close");

if (certificateCards.length && certificateModal && certificateModalImage && certificateModalClose) {
  let lastCertificateTrigger = null;

  const closeCertificateModal = () => {
    certificateModal.classList.remove("is-open");
    certificateModal.setAttribute("aria-hidden", "true");
    document.body.classList.remove("certificate-modal-open");
    certificateModalImage.src = "";
    if (lastCertificateTrigger) lastCertificateTrigger.focus();
  };

  certificateCards.forEach((card) => {
    card.addEventListener("click", () => {
      const imagePath = card.dataset.certificate;
      const cardImage = card.querySelector("img");
      if (!imagePath || !cardImage) return;

      lastCertificateTrigger = card;
      certificateModalImage.src = imagePath;
      certificateModalImage.alt = cardImage.alt;
      certificateModal.classList.add("is-open");
      certificateModal.setAttribute("aria-hidden", "false");
      document.body.classList.add("certificate-modal-open");
      certificateModalClose.focus();
    });
  });

  certificateModalClose.addEventListener("click", closeCertificateModal);

  certificateModal.addEventListener("click", (event) => {
    if (event.target === certificateModal) closeCertificateModal();
  });

  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape" && certificateModal.classList.contains("is-open")) {
      closeCertificateModal();
    }
  });
}
