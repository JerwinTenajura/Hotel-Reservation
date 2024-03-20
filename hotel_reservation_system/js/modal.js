const bookingModal = document.getElementById('bookingModal');
const bookNowBtn = document.getElementById('bookNowBtn');
const closeModal = document.getElementById('closeModal');

bookNowBtn.addEventListener('click', () => {
  bookingModal.style.display = 'block';
});

closeModal.addEventListener('click', () => {
  bookingModal.style.display = 'none';
});

window.addEventListener('click', (event) => {
  if (event.target === bookingModal) {
    bookingModal.style.display = 'none';
  }
});

const submitBooking = document.getElementById('submitBooking');
submitBooking.addEventListener('click', () => {
  // Handle booking submission here
  alert('Booking submitted!');
  bookingModal.style.display = 'none';
});