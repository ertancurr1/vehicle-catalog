/**
 * Vehicle Catalog - Main JavaScript
 */

document.addEventListener("DOMContentLoaded", function () {
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
