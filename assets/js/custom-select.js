/**
 * kzyfilo — Modern Custom Select Dropdown Component
 * Automatically transforms standard <select class="form-select"> elements
 * into accessible, ultra-sleek, interactive custom dropdowns.
 */
document.addEventListener('DOMContentLoaded', () => {
    initCustomSelects();
});

function initCustomSelects(root = document) {
    const selects = root.querySelectorAll('select.form-select:not([data-custom-select-initialized])');
    
    selects.forEach(select => {
        // Skip multi-select or hidden selects
        if (select.multiple) return;
        
        select.setAttribute('data-custom-select-initialized', 'true');
        
        // Hide native select visually but keep it accessible for forms & events
        select.style.display = 'none';
        
        // Create custom select container
        const wrapper = document.createElement('div');
        wrapper.className = 'custom-select-wrapper';
        if (select.id) {
            wrapper.setAttribute('data-select-for', select.id);
        }
        
        // Copy inline styles like width/min-width
        if (select.style.minWidth) {
            wrapper.style.minWidth = select.style.minWidth;
        }
        if (select.style.width) {
            wrapper.style.width = select.style.width;
        }

        const selectedOption = select.options[select.selectedIndex] || select.options[0];
        const selectedText = selectedOption ? selectedOption.text : '';

        // Trigger Button
        const trigger = document.createElement('button');
        trigger.type = 'button';
        trigger.className = 'custom-select-trigger';
        trigger.setAttribute('aria-haspopup', 'listbox');
        trigger.setAttribute('aria-expanded', 'false');
        trigger.innerHTML = `
            <span class="custom-select-value">${escapeHtml(selectedText)}</span>
            <span class="custom-select-arrow" aria-hidden="true">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
            </span>
        `;

        // Dropdown Menu
        const dropdown = document.createElement('div');
        dropdown.className = 'custom-select-dropdown';
        dropdown.setAttribute('role', 'listbox');

        // Populate Options
        function renderOptions() {
            dropdown.innerHTML = '';
            Array.from(select.options).forEach((opt, idx) => {
                const optionEl = document.createElement('div');
                optionEl.className = 'custom-select-option' + (idx === select.selectedIndex ? ' is-selected' : '');
                optionEl.setAttribute('role', 'option');
                optionEl.setAttribute('data-value', opt.value);
                optionEl.setAttribute('aria-selected', idx === select.selectedIndex ? 'true' : 'false');
                optionEl.innerHTML = `
                    <span>${escapeHtml(opt.text)}</span>
                    <svg class="custom-select-option-check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                `;

                optionEl.addEventListener('click', (e) => {
                    e.stopPropagation();
                    select.selectedIndex = idx;
                    trigger.querySelector('.custom-select-value').textContent = opt.text;
                    
                    dropdown.querySelectorAll('.custom-select-option').forEach(el => {
                        el.classList.remove('is-selected');
                        el.setAttribute('aria-selected', 'false');
                    });
                    optionEl.classList.add('is-selected');
                    optionEl.setAttribute('aria-selected', 'true');
                    
                    closeDropdown(wrapper);
                    
                    // Dispatch change event to native select
                    select.dispatchEvent(new Event('change', { bubbles: true }));
                    select.dispatchEvent(new Event('input', { bubbles: true }));
                });

                dropdown.appendChild(optionEl);
            });
        }

        renderOptions();

        // Toggle dropdown on trigger click
        trigger.addEventListener('click', (e) => {
            e.stopPropagation();
            const isOpen = wrapper.classList.contains('is-open');
            // Close all other dropdowns
            document.querySelectorAll('.custom-select-wrapper.is-open').forEach(w => {
                if (w !== wrapper) closeDropdown(w);
            });

            if (isOpen) {
                closeDropdown(wrapper);
            } else {
                openDropdown(wrapper);
            }
        });

        // Sync if native select changes externally (e.g. form reset, JS filter)
        select.addEventListener('change', () => {
            const currentOpt = select.options[select.selectedIndex];
            if (currentOpt) {
                trigger.querySelector('.custom-select-value').textContent = currentOpt.text;
                dropdown.querySelectorAll('.custom-select-option').forEach((el, idx) => {
                    if (idx === select.selectedIndex) {
                        el.classList.add('is-selected');
                        el.setAttribute('aria-selected', 'true');
                    } else {
                        el.classList.remove('is-selected');
                        el.setAttribute('aria-selected', 'false');
                    }
                });
            }
        });

        // Insert custom element next to native select
        wrapper.appendChild(trigger);
        wrapper.appendChild(dropdown);
        select.parentNode.insertBefore(wrapper, select.nextSibling);
    });
}

function openDropdown(wrapper) {
    wrapper.classList.add('is-open');
    const trigger = wrapper.querySelector('.custom-select-trigger');
    if (trigger) trigger.setAttribute('aria-expanded', 'true');
}

function closeDropdown(wrapper) {
    wrapper.classList.remove('is-open');
    const trigger = wrapper.querySelector('.custom-select-trigger');
    if (trigger) trigger.setAttribute('aria-expanded', 'false');
}

// Global click outside listener
document.addEventListener('click', (e) => {
    document.querySelectorAll('.custom-select-wrapper.is-open').forEach(wrapper => {
        if (!wrapper.contains(e.target)) {
            closeDropdown(wrapper);
        }
    });
});

// Escape key listener
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        document.querySelectorAll('.custom-select-wrapper.is-open').forEach(wrapper => {
            closeDropdown(wrapper);
        });
    }
});

function escapeHtml(str) {
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

// Export for dynamic page updates
window.initCustomSelects = initCustomSelects;
