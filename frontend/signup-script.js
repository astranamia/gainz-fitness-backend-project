document.addEventListener("DOMContentLoaded", () => {
  const cards = document.querySelectorAll(".sign-up-card");
  const nextButtons = document.querySelectorAll(".next-btn");
  const prevButtons = document.querySelectorAll(".prev-btn");
  let currentStep = 0;

  // Function to handle switching steps
  function showStep(stepIndex) {
    cards.forEach((card, index) => {
      if (index === stepIndex) {
        card.classList.add("active");
      } else {
        card.classList.remove("active");
      }
    });
  }

  // Next button click handler
  nextButtons.forEach((button) => {
    button.addEventListener("click", () => {
      // Get all inputs inside the current active card
      const currentCard = cards[currentStep];
      const inputs = currentCard.querySelectorAll("input, select");
      
      // Browser native validation check before moving to the next step
      let allValid = true;
      inputs.forEach(input => {
        if (!input.checkValidity()) {
          input.reportValidity(); // Shows the built-in browser error tooltip
          allValid = false;
        }
      });

      // If fields are valid, move forward
      if (allValid && currentStep < cards.length - 1) {
        currentStep++;
        showStep(currentStep);
      }
    });
  });

  // Back button click handler
  prevButtons.forEach((button) => {
    button.addEventListener("click", () => {
      if (currentStep > 0) {
        currentStep--;
        showStep(currentStep);
      }
    });
  });
});