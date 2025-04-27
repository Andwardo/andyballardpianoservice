const heroContainer = document.getElementById('hero-container');

function setRandomHeroImage(images) {
  const randomImage = images[Math.floor(Math.random() * images.length)];
  heroContainer.style.backgroundImage = `url('${randomImage}')`;
}

// Fetch images dynamically
fetch('php/get_hero_images.php')
  .then(response => response.json())
  .then(images => {
    if (images.length > 0) {
      setRandomHeroImage(images);
      setInterval(() => setRandomHeroImage(images), 60000); // every minute
    } else {
      console.error("No hero images found.");
    }
  })
  .catch(err => {
    console.error("Error fetching hero images:", err);
  });