// Just some console art
console.log("%c PATH TRAVERSAL LABS ", "background: #00ff41; color: #000; font-size: 20px; font-weight: bold;");
console.log("System Initialized...");

// Add hover sound effect if desired (keeping it simple for now)
const cards = document.querySelectorAll('.card');

cards.forEach(card => {
    card.addEventListener('mouseenter', () => {
        // Aesthetic border flash handled by CSS
    });
});
