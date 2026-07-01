document.addEventListener('DOMContentLoaded', function() {
    function setupRating(radioGroupName, displayElementId) {
        const radioButtons = document.querySelectorAll(`input[name="${radioGroupName}"]`);
        const displayElement = document.getElementById(displayElementId);
        
        if (!radioButtons.length || !displayElement) {
            console.warn(`Rating tidak ditemukan: ${radioGroupName} / ${displayElementId}`);
            return;
        }
        
        radioButtons.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.checked) {
                    displayElement.textContent = ` (Rating: ${this.value}⭐)`;
                }
            });
        });
    }
    

    setupRating('rating-laskar', 'laskar-rating-value');
    
   
    const searchForm = document.querySelector('#Dashboard form');
    const searchInput = document.querySelector('#Dashboard input[type="search"]');
    
    function filterBooks(keyword) {
        keyword = keyword.toLowerCase().trim();
        const bookContainers = document.querySelectorAll('#Koleksi .card, #Katalog .card, #Rekomendasi .box');
        
        let foundCount = 0;
        bookContainers.forEach(container => {
            const titleElement = container.querySelector('.card-title, h3, h4');
            const title = titleElement ? titleElement.innerText.toLowerCase() : '';
            const textElement = container.querySelector('.card-text');
            const description = textElement ? textElement.innerText.toLowerCase() : '';
            
            if (title.includes(keyword) || description.includes(keyword)) {
                container.style.display = '';
                foundCount++;
            } else {
                container.style.display = 'none';
            }
        });
        
        
        let noResultMsg = document.getElementById('no-search-result');
        if (!noResultMsg) {
            noResultMsg = document.createElement('div');
            noResultMsg.id = 'no-search-result';
            noResultMsg.className = 'alert alert-warning text-center mt-4';
            noResultMsg.style.display = 'none';
            const rekomendasiSection = document.getElementById('Rekomendasi');
            if (rekomendasiSection) {
                rekomendasiSection.insertAdjacentElement('afterend', noResultMsg);
            } else {
                document.querySelector('main').appendChild(noResultMsg);
            }
        }
        
        if (foundCount === 0 && keyword !== '') {
            noResultMsg.innerHTML = `🔍 Tidak ada buku yang ditemukan untuk kata kunci: "<strong>${keyword}</strong>"`;
            noResultMsg.style.display = 'block';
        } else {
            noResultMsg.style.display = 'none';
        }
    }
    
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const keyword = searchInput ? searchInput.value : '';
            filterBooks(keyword);
        });
    }
    
    if (searchInput) {
        searchInput.addEventListener('search', function() {
            if (this.value === '') filterBooks('');
        });
    }
    
    filterBooks('');
    

    const contactForm = document.querySelector('#Kontak form');
    const emailInput = document.querySelector('#email');
    const passwordInput = document.querySelector('#pwd');
    
    
    let validationMsg = document.getElementById('form-validation-message');
    if (!validationMsg) {
        validationMsg = document.createElement('div');
        validationMsg.id = 'form-validation-message';
        validationMsg.className = 'alert mt-3';
        validationMsg.style.display = 'none';
        contactForm.appendChild(validationMsg);
    }
    
    function showValidationMessage(message, isError = true) {
        validationMsg.textContent = message;
        validationMsg.className = `alert mt-3 ${isError ? 'alert-danger' : 'alert-success'}`;
        validationMsg.style.display = 'block';
        
    
        setTimeout(() => {
            validationMsg.style.display = 'none';
        }, 5000);
    }
    
    function validateForm() {
        let isValid = true;
        const email = emailInput.value.trim();
        const password = passwordInput.value.trim();
        
        
        emailInput.style.borderColor = '';
        passwordInput.style.borderColor = '';
        
        if (email === '') {
            showValidationMessage('Email harus diisi!', true);
            emailInput.style.borderColor = '#dc3545';
            isValid = false;
        } else if (!email.includes('@') || !email.includes('.')) {
            showValidationMessage('Format email tidak valid (harus mengandung @ dan .)', true);
            emailInput.style.borderColor = '#dc3545';
            isValid = false;
        }
        
        if (password === '') {
            if (isValid) showValidationMessage('Password harus diisi!', true);
            passwordInput.style.borderColor = '#dc3545';
            isValid = false;
        } else if (password.length < 4) {
            if (isValid) showValidationMessage('Password minimal 4 karakter!', true);
            passwordInput.style.borderColor = '#dc3545';
            isValid = false;
        }
        
        return isValid;
    }
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault(); 
            if (validateForm()) {
                showValidationMessage('Form berhasil dikirim! Terima kasih telah menghubungi kami.', false);
                contactForm.reset(); 
                const ratingSpan = document.getElementById('laskar-rating-value');
                if (ratingSpan) ratingSpan.textContent = '';
            }
        });
    }
    
  
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            if (targetId && targetId.startsWith('#')) {
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    e.preventDefault();
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });
    
    console.log('Lentera Aksara siap digunakan - Fitur: Search, Rating, Validasi Form, Smooth Scroll');
});