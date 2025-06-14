const modal = document.getElementById('flightModal');
const openBtn = document.getElementById('openModal');
const closeBtn = document.getElementById('closeModal');

openBtn.addEventListener('click', () => {
    modal.classList.toggle('hidden');
});

closeBtn.addEventListener('click', () => {
    modal.classList.toggle('hidden');
});

// Optional: Close when clicking outside the modal content
window.addEventListener('click', (e) => {
    if (e.target === modal) {
        modal.classList.toggle('hidden');
    }
});