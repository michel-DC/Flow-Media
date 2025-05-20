window.onload = function() {
  // Hide the body div and show loader initially
  document.getElementById('body').style.display = 'none';
  document.getElementById('loader').style.display = 'flex';
  
  setTimeout(() => {
    // After 2000ms, hide loader and show body div
    document.getElementById('loader').style.display = 'none';
    document.getElementById('body').style.display = '';
  }, 1000);
};