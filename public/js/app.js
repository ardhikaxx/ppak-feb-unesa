/**
 * PPAk FEB UNESA - JavaScript Application Utilities
 * Modern, Lightweight, Vanilla JS micro-interactions
 */

document.addEventListener('DOMContentLoaded', function () {
  'use strict';

  // 1. Sticky Navbar Scroll State
  const navbar = document.querySelector('.navbar-ppak');
  const floatingHeader = document.querySelector('.navbar-floating-header');
  if (navbar) {
    const handleScroll = () => {
      if (window.scrollY > 20) {
        navbar.classList.add('navbar-scrolled');
        if (floatingHeader) floatingHeader.classList.add('scrolled');
      } else {
        navbar.classList.remove('navbar-scrolled');
        if (floatingHeader) floatingHeader.classList.remove('scrolled');
      }
    };
    window.addEventListener('scroll', handleScroll, { passive: true });
    handleScroll();
  }

  // 2. Dosen Category Filtering (Dosen & Pengajar page)
  const dosenFilterBtns = document.querySelectorAll('[data-dosen-filter]');
  const dosenItems = document.querySelectorAll('.dosen-item');

  if (dosenFilterBtns.length > 0 && dosenItems.length > 0) {
    dosenFilterBtns.forEach(btn => {
      btn.addEventListener('click', function () {
        dosenFilterBtns.forEach(b => {
          b.classList.remove('active', 'btn-ppak-primary');
          b.classList.add('btn-ppak-secondary');
        });
        this.classList.remove('btn-ppak-secondary');
        this.classList.add('active', 'btn-ppak-primary');

        const filterVal = this.getAttribute('data-dosen-filter');

        dosenItems.forEach(item => {
          const itemCategory = item.getAttribute('data-category');
          if (filterVal === 'all' || itemCategory === filterVal) {
            item.style.display = 'block';
          } else {
            item.style.display = 'none';
          }
        });
      });
    });
  }

  // 3. Galeri Category Filtering
  const galeriFilterBtns = document.querySelectorAll('[data-galeri-filter]');
  const galeriItems = document.querySelectorAll('.gallery-item');

  if (galeriFilterBtns.length > 0 && galeriItems.length > 0) {
    galeriFilterBtns.forEach(btn => {
      btn.addEventListener('click', function () {
        galeriFilterBtns.forEach(b => {
          b.classList.remove('active', 'btn-ppak-primary');
          b.classList.add('btn-ppak-secondary');
        });
        this.classList.remove('btn-ppak-secondary');
        this.classList.add('active', 'btn-ppak-primary');

        const filterVal = this.getAttribute('data-galeri-filter');

        galeriItems.forEach(item => {
          const itemCat = item.getAttribute('data-category');
          if (filterVal === 'all' || itemCat === filterVal) {
            item.style.display = 'block';
          } else {
            item.style.display = 'none';
          }
        });
      });
    });
  }

  // 4. Galeri Lightbox Modal Preview
  const galleryCards = document.querySelectorAll('[data-bs-gallery-img]');
  const modalImg = document.getElementById('galleryModalImage');
  const modalTitle = document.getElementById('galleryModalTitle');
  const modalDate = document.getElementById('galleryModalDate');

  if (galleryCards.length > 0 && modalImg) {
    galleryCards.forEach(card => {
      card.addEventListener('click', function () {
        const imgSrc = this.getAttribute('data-bs-gallery-img');
        const title = this.getAttribute('data-bs-gallery-title');
        const date = this.getAttribute('data-bs-gallery-date');

        modalImg.src = imgSrc;
        if (modalTitle) modalTitle.textContent = title;
        if (modalDate) modalDate.textContent = date;
      });
    });
  }

  // 5. Unduhan Document Search Filter
  const docSearchInput = document.getElementById('docSearchInput');
  const docRows = document.querySelectorAll('.doc-row');
  const docEmptyState = document.getElementById('docEmptyState');

  if (docSearchInput && docRows.length > 0) {
    docSearchInput.addEventListener('input', function () {
      const term = this.value.toLowerCase().trim();
      let visibleCount = 0;

      docRows.forEach(row => {
        const title = row.getAttribute('data-doc-title')?.toLowerCase() || '';
        const category = row.getAttribute('data-doc-category')?.toLowerCase() || '';

        if (title.includes(term) || category.includes(term)) {
          row.style.display = '';
          visibleCount++;
        } else {
          row.style.display = 'none';
        }
      });

      if (docEmptyState) {
        docEmptyState.style.display = visibleCount === 0 ? 'block' : 'none';
      }
    });
  }

  // 6. Share Link Copy to Clipboard (News Detail)
  const copyLinkBtn = document.getElementById('copyArticleLinkBtn');
  if (copyLinkBtn) {
    copyLinkBtn.addEventListener('click', function () {
      navigator.clipboard.writeText(window.location.href).then(() => {
        const originalText = this.innerHTML;
        this.innerHTML = '<i class="fa-solid fa-check me-1"></i> Tautan Disalin!';
        this.classList.remove('btn-ppak-secondary');
        this.classList.add('btn-success');
        setTimeout(() => {
          this.innerHTML = originalText;
          this.classList.remove('btn-success');
          this.classList.add('btn-ppak-secondary');
        }, 2500);
      });
    });
  }

  // 7. Helpdesk Form: native POST to server (CSRF + rate limited).
  // Success/error feedback is rendered server-side from session flash,
  // so no fake client-side success here - the form must really be saved.
});
