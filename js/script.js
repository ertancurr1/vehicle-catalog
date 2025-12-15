/**
 * Vehicle Catalog - Main JavaScript
 */

document.addEventListener("DOMContentLoaded", function () {
  // ==================== TYPE SWITCHER ====================

  const typeSelector = document.getElementById("productType");

  if (typeSelector) {
    // Handle type change
    typeSelector.addEventListener("change", function () {
      const selectedType = this.value;

      // Hide all type-specific attribute containers
      const allTypeContainers = document.querySelectorAll(".type-attributes");
      allTypeContainers.forEach(function (container) {
        container.classList.remove("active");
      });

      // Show the selected type's container
      if (selectedType) {
        const activeContainer = document.getElementById(selectedType);
        if (activeContainer) {
          activeContainer.classList.add("active");
        }
      }
    });
  }

  // ==================== MASS DELETE CONFIRMATION ====================

  const deleteForm = document.getElementById("delete-form");

  if (deleteForm) {
    deleteForm.addEventListener("submit", function (e) {
      const checkboxes = document.querySelectorAll(".delete-checkbox:checked");

      if (checkboxes.length === 0) {
        e.preventDefault();
        alert("Please select at least one vehicle to delete.");
        return;
      }

      const confirmMessage = `Are you sure you want to delete ${checkboxes.length} vehicle(s)?`;

      if (!confirm(confirmMessage)) {
        e.preventDefault();
      }
    });
  }
});
